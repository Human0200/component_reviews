<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule('iblock');

// Обработка параметров
$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
$arParams['CACHE_TIME'] = intval($arParams['CACHE_TIME']) ?: 3600;

$arParams['TITLE'] = trim($arParams['TITLE']) ?: 'Решения';


if(!$arParams['IBLOCK_ID']) {
    ShowError('Не указан ID инфоблока');
    return;
}

// Кеширование
$cache = new CPHPCache();
$cache_id = 'solutions_list_'.$arParams['IBLOCK_ID'];
$cache_path = '/solutions/list/';

if($arParams['CACHE_TIME'] > 0 && $cache->InitCache($arParams['CACHE_TIME'], $cache_id, $cache_path)) {
    $arResult = $cache->GetVars();
} elseif($cache->StartDataCache()) {
    
    // Фильтр
    $filter = [
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'ACTIVE' => 'Y'
    ];
    
    // Выборка полей
    $arSelect = [
        'ID',
        'NAME',
        'DETAIL_PAGE_URL',
        'PREVIEW_PICTURE',
        'DETAIL_PICTURE',
        'PROPERTY_CLIENTS_COUNT',
        'PROPERTY_IMAGE',
        "PROPERTY_URL",
        "PROPERTY_LOGO",
        "PROPERTY_IMAGE"
    ];
    
    // Параметры навигации
    $arNavParams = false;
    
    // Получаем элементы
    $dbElements = CIBlockElement::GetList(
        ['SORT' => 'ASC'],
        $filter,
        false,
        $arNavParams,
        $arSelect
    );
    $arResult['TITLE'] = $arParams['TITLE'];
    
    $arResult['ITEMS'] = [];
    
    while($element = $dbElements->GetNext()) {
        // Получаем картинку
        $image = '';
        if($element['PROPERTY_IMAGE_VALUE']) {
            $image = CFile::GetPath($element['PROPERTY_IMAGE_VALUE']);
        } elseif($element['DETAIL_PICTURE']) {
            $image = CFile::GetPath($element['DETAIL_PICTURE']);
        } elseif($element['PREVIEW_PICTURE']) {
            $image = CFile::GetPath($element['PREVIEW_PICTURE']);
        } elseif($element['PROPERTY_LOGO_VALUE']) {
            $image = CFile::GetPath($element['PROPERTY_LOGO_VALUE']);
        } 
        
        // Количество клиентов
        $clientsCount = $element['PROPERTY_CLIENTS_COUNT_VALUE'] ?: '11';
        
        $arResult['ITEMS'][] = [
            'ID' => $element['ID'],
            'NAME' => $element['NAME'],
            'DETAIL_PAGE_URL' => $element['DETAIL_PAGE_URL'],
            'IMAGE' => $image,
            'CLIENTS_COUNT' => $clientsCount
        ];
    }
    
    $cache->EndDataCache($arResult);
}

// Подключаем шаблон
$this->IncludeComponentTemplate();
?>