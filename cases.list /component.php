<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule('iblock');

// Обработка параметров
$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
$arParams['IBLOCK_CODE'] = trim($arParams['IBLOCK_CODE']);
$arParams['IBLOCK_TYPE'] = trim($arParams['IBLOCK_TYPE']);
$arParams['CASES_COUNT'] = intval($arParams['CASES_COUNT']) ?: 8;
$arParams['SORT_BY'] = trim($arParams['SORT_BY']) ?: 'SORT';
$arParams['SORT_ORDER'] = in_array($arParams['SORT_ORDER'], ['ASC', 'DESC']) ? $arParams['SORT_ORDER'] : 'ASC';
$arParams['CACHE_TIME'] = intval($arParams['CACHE_TIME']) ?: 3600;

$arParams['SECTION_MARK'] = trim($arParams['SECTION_MARK']) ?: 'Кейсы';
$arParams['SECTION_TITLE'] = trim($arParams['SECTION_TITLE']) ?: 'Мы работали и работаем';
$arParams['SECTION_TEXT'] = trim($arParams['SECTION_TEXT']) ?: 'Мы собрали весь наш опыт и подробно описали его, чтобы вы могли оценить наши возможности.';
$arParams['COUNTER_NUMBER'] = trim($arParams['COUNTER_NUMBER']) ?: '300+';
$arParams['COUNTER_TEXT'] = str_replace('\n', "\n", trim($arParams['COUNTER_TEXT']) ?: "Успешного внедрения\nCRM-системы в разные ниши");
$arParams['TAGLINE_ROW_1'] = str_replace('\n', "\n", trim($arParams['TAGLINE_ROW_1']) ?: "Эти кейсы — лишь малая\nчасть того");
$arParams['TAGLINE_ROW_2'] = str_replace('\n', "\n", trim($arParams['TAGLINE_ROW_2']) ?: "что мы можем\nпродемонстрировать");
$arParams['MARQUEE_TEXT'] = trim($arParams['MARQUEE_TEXT']) ?: 'О компании';
$arParams['SHOW_TAGS'] = $arParams['SHOW_TAGS'] === 'Y';

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
    ShowError('Инфоблок кейсов не найден');
    return;
}

// Кеширование
$cache = new CPHPCache();
$cache_id = 'cases_list_'.$arResult['IBLOCK_ID'].'_'.$arParams['CASES_COUNT'];
$cache_path = '/cases/list/';

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
        'DETAIL_PAGE_URL',
        'PREVIEW_PICTURE',
        'DETAIL_PICTURE',
        'PROPERTY_SPHERE',           // Сфера деятельности
        'PROPERTY_WORKPLACES_COUNT', // Количество рабочих мест
        'PROPERTY_LOGO',             // Логотип компании
        'PROPERTY_IMAGE',            // Дополнительное изображение
    ];
    
    // Параметры навигации
    $arNavParams = false;
    if($arParams['CASES_COUNT'] > 0) {
        $arNavParams = ['nTopCount' => $arParams['CASES_COUNT']];
    }
    
    // Получаем элементы
    $dbElements = CIBlockElement::GetList(
        [$arParams['SORT_BY'] => $arParams['SORT_ORDER']],
        $filter,
        false,
        $arNavParams,
        $arSelect
    );
    
    $arResult['ITEMS'] = [];
    $arResult['TAGS'] = [];
    
    while($element = $dbElements->GetNext()) {
        // Получаем изображение (приоритет: PROPERTY_IMAGE -> DETAIL_PICTURE -> PREVIEW_PICTURE)
        $image = '';
        if($element['PROPERTY_IMAGE_VALUE']) {
            $image = CFile::GetPath($element['PROPERTY_IMAGE_VALUE']);
        } elseif($element['DETAIL_PICTURE']) {
            $image = CFile::GetPath($element['DETAIL_PICTURE']);
        } elseif($element['PREVIEW_PICTURE']) {
            $image = CFile::GetPath($element['PREVIEW_PICTURE']);
        }
        
        // Получаем логотип
        $logo = '';
        if($element['PROPERTY_LOGO_VALUE']) {
            $logo = CFile::GetPath($element['PROPERTY_LOGO_VALUE']);
        }
        
        // Сфера деятельности
        $sphere = $element['PROPERTY_SPHERE_VALUE'] ?: '';
        
        // Добавляем в теги для фильтрации
        if($sphere && !in_array($sphere, $arResult['TAGS'])) {
            $arResult['TAGS'][] = $sphere;
        }
        
        // Количество рабочих мест
        $workplaces = $element['PROPERTY_WORKPLACES_COUNT_VALUE'] ?: '';
        
        $arResult['ITEMS'][] = [
            'ID' => $element['ID'],
            'NAME' => $element['NAME'],
            'DETAIL_PAGE_URL' => $element['DETAIL_PAGE_URL'],
            'IMAGE' => $image,
            'LOGO' => $logo,
            'SPHERE' => $sphere,
            'WORKPLACES_COUNT' => $workplaces
        ];
    }
    
    // Передаем параметры визуализации
    $arResult['SECTION_MARK'] = $arParams['SECTION_MARK'];
    $arResult['SECTION_TITLE'] = $arParams['SECTION_TITLE'];
    $arResult['SECTION_TEXT'] = $arParams['SECTION_TEXT'];
    $arResult['COUNTER_NUMBER'] = $arParams['COUNTER_NUMBER'];
    $arResult['COUNTER_TEXT'] = $arParams['COUNTER_TEXT'];
    $arResult['TAGLINE_ROW_1'] = $arParams['TAGLINE_ROW_1'];
    $arResult['TAGLINE_ROW_2'] = $arParams['TAGLINE_ROW_2'];
    $arResult['MARQUEE_TEXT'] = $arParams['MARQUEE_TEXT'];
    $arResult['SHOW_TAGS'] = $arParams['SHOW_TAGS'];
    
    $cache->EndDataCache($arResult);
}

// Подключаем шаблон
$this->IncludeComponentTemplate();
?>