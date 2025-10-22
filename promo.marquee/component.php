<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// Обработка параметров
$arParams['TAGLINE_TOP'] = trim($arParams['TAGLINE_TOP']) ?: 'купите лицензию через нас — и получите';
$arParams['TAGLINE_BOTTOM'] = trim($arParams['TAGLINE_BOTTOM']) ?: 'больше, чем просто доступ к Битрикс24';
$arParams['CACHE_TIME'] = intval($arParams['CACHE_TIME']) ?: 3600;

// Формируем массив пунктов
$arResult['ITEMS'] = [];

for ($i = 1; $i <= 5; $i++) {
    $item = trim($arParams['ITEM_'.$i]);
    if ($item) {
        $arResult['ITEMS'][] = $item;
    }
}

// Передаем параметры в результат
$arResult['TAGLINE_TOP'] = $arParams['TAGLINE_TOP'];
$arResult['TAGLINE_BOTTOM'] = $arParams['TAGLINE_BOTTOM'];

// Подключаем шаблон
$this->IncludeComponentTemplate();
?>