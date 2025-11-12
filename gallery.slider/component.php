<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule('iblock');

// Обработка параметров
$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
$arParams['CACHE_TIME'] = intval($arParams['CACHE_TIME']) ?: 3600;
$arParams['TITLE'] = trim($arParams['TITLE']) ?: 'Сертификаты';

if(!$arParams['IBLOCK_ID']) {
    ShowError('Не указан ID инфоблока');
    return;
}

// Кеширование
$cache = new CPHPCache();
$cache_id = 'gallery_list_'.$arParams['IBLOCK_ID'];
$cache_path = '/gallery/list/';

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
        'PROPERTY_IMAGE',
        'PROPERTY_DATE',
        'PROPERTY_IS_DUAL'
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
    
    $arResult['TITLE'] = html_entity_decode($arParams['TITLE'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $arResult['ITEMS'] = [];
    
    while($element = $dbElements->GetNext()) {
        // Форматируем дату
        $date = '';
        if($element['PROPERTY_DATE_VALUE']) {
            $dateObj = new DateTime($element['PROPERTY_DATE_VALUE']);
            $date = $dateObj->format('d.m.Y');
        }
        
        // Получаем картинку
        $image = '';
        if($element['PROPERTY_IMAGE_VALUE']) {
            $image = CFile::GetPath($element['PROPERTY_IMAGE_VALUE']);
        } elseif($element['DETAIL_PICTURE']) {
            $image = CFile::GetPath($element['DETAIL_PICTURE']);
        } elseif($element['PREVIEW_PICTURE']) {
            $image = CFile::GetPath($element['PREVIEW_PICTURE']);
        }
        
        // Проверяем свойство "двойная карточка"
        $isDual = false;
        if(isset($element['PROPERTY_IS_DUAL_VALUE'])) {
            $isDual = ($element['PROPERTY_IS_DUAL_VALUE'] == 'Y' || 
                      $element['PROPERTY_IS_DUAL_VALUE'] == '1' || 
                      $element['PROPERTY_IS_DUAL_VALUE'] == 'да' ||
                      $element['PROPERTY_IS_DUAL_VALUE'] == 'Да');
        }
        
        $arResult['ITEMS'][] = [
            'ID' => $element['ID'],
            'NAME' => html_entity_decode($element['NAME'], ENT_QUOTES | ENT_HTML5, 'UTF-8'),
            'DETAIL_PAGE_URL' => $element['DETAIL_PAGE_URL'],
            'IMAGE' => $image,
            'DATE' => $date,
            'IS_DUAL' => $isDual
        ];
    }
    
    $cache->EndDataCache($arResult);
}

// Подключаем шаблон
$this->IncludeComponentTemplate();
?>