<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// Обработка параметров
$arParams['TITLE'] = trim($arParams['TITLE']) ?: 'Этапы внедрения';

// Передаем заголовок
$arResult['TITLE'] = $arParams['TITLE'];

// Формируем массив этапов
$arResult['STAGES'] = [];

for($i = 1; $i <= 7; $i++) {
    $title = trim($arParams['STAGE_'.$i.'_TITLE']);
    $text = html_entity_decode(trim($arParams['STAGE_'.$i.'_TEXT']));
    $image = trim($arParams['STAGE_'.$i.'_IMAGE']);
    
    // Добавляем этап только если заполнено название
    if($title) {
        $arResult['STAGES'][] = [
            'NUMBER' => str_pad($i, 2, '0', STR_PAD_LEFT),
            'TITLE' => $title,
            'TEXT' => $text,
            'IMAGE' => $image,
        ];
    }
}

// Подключаем шаблон
$this->IncludeComponentTemplate();
?>