<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// Обработка параметров
$arParams['MARK_TEXT'] = trim($arParams['MARK_TEXT']) ?: 'Сроки и этапы работы над проектом';
$arParams['TITLE'] = trim($arParams['TITLE']) ?: 'Дорожная карта';
$arParams['TABLE_HEADER_YEAR'] = trim($arParams['TABLE_HEADER_YEAR']) ?: '2024 год';

// Передаем параметры
$arResult['MARK_TEXT'] = $arParams['MARK_TEXT'];
$arResult['TITLE'] = $arParams['TITLE'];
$arResult['TABLE_HEADER_YEAR'] = $arParams['TABLE_HEADER_YEAR'];

// Формируем массив этапов
$arResult['STEPS'] = [];

for($i = 1; $i <= 10; $i++) {
    $name = trim($arParams['STEP_'.$i.'_NAME']);
    
    if(!$name) continue;
    
    $duration = trim($arParams['STEP_'.$i.'_DURATION']);
    
    $arResult['STEPS'][] = [
        'NUMBER' => str_pad($i, 2, '0', STR_PAD_LEFT),
        'NAME' => $name,
        'DURATION' => $duration,
    ];
}

// Подключаем шаблон
$this->IncludeComponentTemplate();
?>