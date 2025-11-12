<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule('iblock');

$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
$arParams['CACHE_TIME'] = intval($arParams['CACHE_TIME']) ?: 3600;
$arParams['TITLE'] = trim($arParams['TITLE']) ?: 'Тарифы наших работ';

if(!$arParams['IBLOCK_ID']) {
    ShowError('Не указан ID инфоблока');
    return;
}

// Кеширование
$cache = new CPHPCache();
$cache_id = 'tariffs_list_'.$arParams['IBLOCK_ID'];
$cache_path = '/tariffs/list/';

if($arParams['CACHE_TIME'] > 0 && $cache->InitCache($arParams['CACHE_TIME'], $cache_id, $cache_path)) {
    $arResult = $cache->GetVars();
} elseif($cache->StartDataCache()) {
    // Получаем элементы
    $arSelect = [
        'ID',
        'NAME',
        'PREVIEW_TEXT',
        'DETAIL_TEXT',
        'PROPERTY_HOURS',
        'PROPERTY_PRICE_MONTH',
        'PROPERTY_PRICE_YEAR',
        'PROPERTY_DISCOUNT',
        'PROPERTY_LINK',
        'PROPERTY_DEADLINE'
    ];
    
    $arFilter = [
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'ACTIVE' => 'Y'
    ];
    
    $dbElements = CIBlockElement::GetList(
        ['SORT' => 'ASC'],
        $arFilter,
        false,
        false,
        $arSelect
    );
    
    $arResult['TITLE'] = $arParams['TITLE'];
    $arResult['ITEMS'] = [];
    
    while($element = $dbElements->GetNext()) {
        // Преобразуем список услуг в массив
        $services = [];
        if($element['DETAIL_TEXT']) {
            $services = explode("\n", trim($element['DETAIL_TEXT']));
            $services = array_filter($services);
        }
        
        $arResult['ITEMS'][] = [
            'ID' => $element['ID'],
            'NAME' => $element['NAME'],
            'CAPTION' => $element['PREVIEW_TEXT'],
            'HOURS' => $element['PROPERTY_HOURS_VALUE'],
            'PRICE_MONTH' => $element['PROPERTY_PRICE_MONTH_VALUE'],
            'PRICE_YEAR' => $element['PROPERTY_PRICE_YEAR_VALUE'],
            'DISCOUNT' => $element['PROPERTY_DISCOUNT_VALUE'],
            'LINK' => $element['PROPERTY_LINK_VALUE'] ?: '#',
            'DEADLINE' => $element['PROPERTY_DEADLINE_VALUE'] ?: '5 дней',
            'SERVICES' => $services
        ];
    }
    
    $cache->EndDataCache($arResult);
}

$this->IncludeComponentTemplate();
?>