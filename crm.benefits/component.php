<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// Обработка основных параметров
$arParams['MARK'] = trim($arParams['MARK']) ?: 'СRM-система';
$arParams['TAGLINE_ROW_1'] = trim($arParams['TAGLINE_ROW_1']) ?: 'Мы создали готовую CRM-систему';
$arParams['TAGLINE_ROW_2'] = trim($arParams['TAGLINE_ROW_2']) ?: 'учитывая наш большой опыт данной ниши.';
$arParams['TITLE'] = trim($arParams['TITLE']) ?: 'СRM-система помогает:';
$arParams['CACHE_TIME'] = intval($arParams['CACHE_TIME']) ?: 3600;

// Формируем массив карточек
$arResult['CARDS'] = [];

for ($i = 1; $i <= 6; $i++) {
    $text = trim($arParams['CARD_'.$i.'_TEXT']);
    $icon = trim($arParams['CARD_'.$i.'_ICON']);
    
    if ($text && $icon) {
        $arResult['CARDS'][] = [
            'TEXT' => $text,
            'ICON' => $icon
        ];
    }
}

// Передаем параметры в результат
$arResult['MARK'] = $arParams['MARK'];
$arResult['TAGLINE_ROW_1'] = $arParams['TAGLINE_ROW_1'];
$arResult['TAGLINE_ROW_2'] = $arParams['TAGLINE_ROW_2'];
$arResult['TITLE'] = $arParams['TITLE'];

// Подключаем шаблон
$this->IncludeComponentTemplate();
?>