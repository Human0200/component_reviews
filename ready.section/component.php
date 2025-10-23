<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule('iblock');

// Обработка параметров
$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
$arParams['IBLOCK_CODE'] = trim($arParams['IBLOCK_CODE']);
$arParams['IBLOCK_TYPE'] = trim($arParams['IBLOCK_TYPE']);
$arParams['ITEMS_COUNT'] = intval($arParams['ITEMS_COUNT']) ?: 6;
$arParams['SORT_BY'] = trim($arParams['SORT_BY']) ?: 'SORT';
$arParams['SORT_ORDER'] = in_array($arParams['SORT_ORDER'], ['ASC', 'DESC']) ? $arParams['SORT_ORDER'] : 'ASC';
$arParams['CACHE_TIME'] = intval($arParams['CACHE_TIME']) ?: 3600;

$arParams['SERVICES_TITLE'] = trim($arParams['SERVICES_TITLE']) ?: '100+ готовых интеграций и сервисов!';
$arParams['BUSINESS_TITLE'] = trim($arParams['BUSINESS_TITLE']) ?: 'Интеграции с нишевыми сервисами для бизнеса';
$arParams['SHOW_SERVICES'] = $arParams['SHOW_SERVICES'] !== 'N';
$arParams['SHOW_BUSINESS'] = $arParams['SHOW_BUSINESS'] !== 'N';

// Функция получения ID инфоблока
function getIblockId($arParams) {
    if($arParams['IBLOCK_ID'] > 0) {
        return $arParams['IBLOCK_ID'];
    }
    
    $filter = ['ACTIVE' => 'Y'];
    
    if($arParams['IBLOCK_CODE']) {
        $filter['CODE'] = $arParams['IBLOCK_CODE'];
    }
    
    if($arParams['IBLOCK_TYPE']) {
        $filter['TYPE'] = $arParams['IBLOCK_TYPE'];
    }
    
    $iblock = CIBlock::GetList([], $filter)->Fetch();
    
    return $iblock ? $iblock['ID'] : 0;
}

// Получаем ID инфоблока
$arResult['IBLOCK_ID'] = getIblockId($arParams);

if(!$arResult['IBLOCK_ID']) {
    ShowError('Инфоблок бизнес-интеграций не найден');
    return;
}

// Кеширование
$cache = new CPHPCache();
$cache_id = 'business_integrations_'.$arResult['IBLOCK_ID'].'_'.$arParams['ITEMS_COUNT'];
$cache_path = '/business/integrations/';

if($arParams['CACHE_TIME'] > 0 && $cache->InitCache($arParams['CACHE_TIME'], $cache_id, $cache_path)) {
    $arResult = $cache->GetVars();
} elseif($cache->StartDataCache()) {
    
    // Фильтр
    $filter = [
        'IBLOCK_ID' => $arResult['IBLOCK_ID'],
        'ACTIVE' => 'Y'
    ];
    
    // Выборка полей
    $arSelect = [
        'ID',
        'NAME',
        'PREVIEW_TEXT',
        'DETAIL_TEXT',
        'PREVIEW_PICTURE',
        'PROPERTY_IMAGE'
    ];
    
    // Параметры навигации
    $arNavParams = false;
    if($arParams['ITEMS_COUNT'] > 0) {
        $arNavParams = ['nTopCount' => $arParams['ITEMS_COUNT']];
    }
    
    // Получаем элементы
    $dbElements = CIBlockElement::GetList(
        [$arParams['SORT_BY'] => $arParams['SORT_ORDER']],
        $filter,
        false,
        $arNavParams,
        $arSelect
    );
    
    $arResult['BUSINESS_ITEMS'] = [];
    
    while($element = $dbElements->GetNext()) {
        // Получаем изображение (приоритет: PROPERTY_IMAGE -> PREVIEW_PICTURE)
        $image = '';
        if($element['PROPERTY_IMAGE_VALUE']) {
            $image = CFile::GetPath($element['PROPERTY_IMAGE_VALUE']);
        } elseif($element['PREVIEW_PICTURE']) {
            $image = CFile::GetPath($element['PREVIEW_PICTURE']);
        }
        
        // Текст (приоритет: PREVIEW_TEXT -> DETAIL_TEXT)
        $text = $element['PREVIEW_TEXT'] ?: $element['DETAIL_TEXT'];
        
        $arResult['BUSINESS_ITEMS'][] = [
            'ID' => $element['ID'],
            'NAME' => $element['NAME'],
            'TEXT' => $text,
            'IMAGE' => $image
        ];
    }
    
    // Статические данные для сервисов
    $arResult['SERVICES'] = [
        [
            'TITLE' => 'Мессенджеры и<br>социальные сети',
            'ICONS' => [
                '/local/templates/leadspace/assets/images/ready/icon-viber.svg',
                '/local/templates/leadspace/assets/images/ready/icon-tg.svg',
                '/local/templates/leadspace/assets/images/ready/icon-wa.svg',
                '/local/templates/leadspace/assets/images/ready/icon-vk.svg'
            ],
            'CLASS' => 'ready__services-card--01'
        ],
        [
            'TITLE' => 'Онлайн-кассы, платежные<br>агрегаторы, эквайринг',
            'ICONS' => [
                '/local/templates/leadspace/assets/images/ready/icon-sber.svg',
                '/local/templates/leadspace/assets/images/ready/icon-tbank.svg',
                '/local/templates/leadspace/assets/images/ready/icon-ukassa.svg',
                '/local/templates/leadspace/assets/images/ready/icon-lifepay.svg',
                '/local/templates/leadspace/assets/images/ready/icon-robokassa.svg'
            ],
            'CLASS' => 'ready__services-card--02'
        ],
        [
            'TITLE' => 'Службы доставки и<br>телефонии',
            'ICONS' => [
                '/local/templates/leadspace/assets/images/ready/icon-mtc.svg',
                '/local/templates/leadspace/assets/images/ready/icon-yandex.svg',
                '/local/templates/leadspace/assets/images/ready/icon-cdek.svg',
                '/local/templates/leadspace/assets/images/ready/icon-post.svg',
                '/local/templates/leadspace/assets/images/ready/icon-rt.svg'
            ],
            'CLASS' => 'ready__services-card--03'
        ]
    ];
    
    // Передаем параметры
    $arResult['SERVICES_TITLE'] = $arParams['SERVICES_TITLE'];
    $arResult['BUSINESS_TITLE'] = $arParams['BUSINESS_TITLE'];
    $arResult['SHOW_SERVICES'] = $arParams['SHOW_SERVICES'];
    $arResult['SHOW_BUSINESS'] = $arParams['SHOW_BUSINESS'];
    
    $cache->EndDataCache($arResult);
}

// Подключаем шаблон
$this->IncludeComponentTemplate();