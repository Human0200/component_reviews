<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// Обработка параметров
$arParams['MARK_TEXT'] = trim($arParams['MARK_TEXT']) ?: 'что внутри';
$arParams['TAGLINE_ROW_1'] = trim($arParams['TAGLINE_ROW_1']) ?: 'Вместе с CRM-решением вы получите';
$arParams['TAGLINE_ROW_2'] = trim($arParams['TAGLINE_ROW_2']) ?: 'полный набор инструментов Битрикс24 для работы';
$arParams['TITLE'] = trim($arParams['TITLE']) ?: 'Что внутри готового решения?';

// Передаем текстовые параметры
$arResult['MARK_TEXT'] = $arParams['MARK_TEXT'];
$arResult['TAGLINE_ROW_1'] = $arParams['TAGLINE_ROW_1'];
$arResult['TAGLINE_ROW_2'] = $arParams['TAGLINE_ROW_2'];
$arResult['TITLE'] = $arParams['TITLE'];

// Формируем массив инструментов
$arResult['ITEMS'] = [];

for($toolNum = 1; $toolNum <= 2; $toolNum++) {
    $name = trim($arParams['TOOL_'.$toolNum.'_NAME']);
    
    if(!$name) continue;
    
    // Собираем описания
    $descriptions = [];
    for($i = 1; $i <= 5; $i++) {
        $desc = trim($arParams['TOOL_'.$toolNum.'_DESC_'.$i]);
        if($desc) {
            $descriptions[] = $desc;
        }
    }
    
    // Собираем изображения
    $images = [];
    for($i = 1; $i <= 5; $i++) {
        $image = trim($arParams['TOOL_'.$toolNum.'_IMAGE_'.$i]);
        if($image) {
            $images[] = $image;
        }
    }
    
    if(!empty($descriptions) || !empty($images)) {
        $arResult['ITEMS'][] = [
            'NAME' => $name,
            'DESCRIPTIONS' => $descriptions,
            'IMAGES' => $images,
        ];
    }
}

// Подключаем шаблон
$this->IncludeComponentTemplate();
?>