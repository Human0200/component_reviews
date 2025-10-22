<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule('iblock');

$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
$arParams['CACHE_TIME'] = intval($arParams['CACHE_TIME']) ?: 3600;
$arParams['MARK'] = trim($arParams['MARK']) ?: 'отзывы';
$arParams['TITLE'] = trim($arParams['TITLE']) ?: 'Отзывы покупателей';
$arParams['TEXT'] = trim($arParams['TEXT']) ?: 'Нашим готовым решением пользуются уже 20 клиентов и мы регулярно получаем от них обратную связь.';

if(!$arParams['IBLOCK_ID']) {
    ShowError('Не указан ID инфоблока');
    return;
}

// Кеширование
$cache = new CPHPCache();
$cache_id = 'reviews_list_'.$arParams['IBLOCK_ID'];
$cache_path = '/reviews/list/';

if($arParams['CACHE_TIME'] > 0 && $cache->InitCache($arParams['CACHE_TIME'], $cache_id, $cache_path)) {
    $arResult = $cache->GetVars();
} elseif($cache->StartDataCache()) {
    // Получаем элементы
    $arSelect = [
        'ID',
        'NAME',
        'PREVIEW_PICTURE',
        'DETAIL_PICTURE',
        'PROPERTY_IMAGE',
        'PROPERTY_IS_DUAL'
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
    
    $arResult['MARK'] = $arParams['MARK'];
    $arResult['TITLE'] = $arParams['TITLE'];
    $arResult['TEXT'] = $arParams['TEXT'];
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
        }
        
        $arResult['ITEMS'][] = [
            'ID' => $element['ID'],
            'NAME' => $element['NAME'],
            'IMAGE' => $image,
            'IS_DUAL' => $element['PROPERTY_IS_DUAL_VALUE'] ? true : false
        ];
    }
    
    $cache->EndDataCache($arResult);
}

$this->IncludeComponentTemplate();
?>