<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule('iblock');

// Обработка параметров
$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
$arParams['CACHE_TIME'] = intval($arParams['CACHE_TIME']) ?: 3600;  
$arParams['TITLE'] = trim($arParams['TITLE']) ?: 'Шаги';


if(!$arParams['IBLOCK_ID']) {
    ShowError('Не указан ID инфоблока');
    return;
}

// Кеширование
$cache = new CPHPCache();
$cache_id = 'individual_steps_'.$arParams['IBLOCK_ID'];
$cache_path = '/individual/steps/';

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
        'PREVIEW_TEXT',
        'SORT'
    ];
    
    // Получаем элементы
    $dbElements = CIBlockElement::GetList(
        ['SORT' => 'ASC'],
        $filter,
        false,
        false,
        $arSelect
    );

    $arResult['TITLE'] = $arParams['TITLE'];
    
    $arResult['ITEMS'] = [];
    $counter = 1;
    
    while($element = $dbElements->GetNext()) {
        $arResult['ITEMS'][] = [
            'ID' => $element['ID'],
            'NUMBER' => str_pad($counter, 2, '0', STR_PAD_LEFT),
            'TITLE' => $element['NAME'],
            'TEXT' => $element['PREVIEW_TEXT']
        ];
        $counter++;
    }
    
    $cache->EndDataCache($arResult);
}

// Подключаем шаблон
$this->IncludeComponentTemplate();
?>