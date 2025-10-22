<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// Обработка основных параметров
$arParams['MARK'] = trim($arParams['MARK']) ?: 'для кого';
$arParams['TITLE'] = trim($arParams['TITLE']) ?: 'Кому подходит данное решение?';
$arParams['BUTTON_TEXT'] = trim($arParams['BUTTON_TEXT']) ?: 'Попробовать 7 дней бесплатно';
$arParams['BUTTON_LINK'] = trim($arParams['BUTTON_LINK']) ?: '#';
$arParams['CACHE_TIME'] = intval($arParams['CACHE_TIME']) ?: 3600;

// Функция для парсинга текста карточки
function parseCardText($text) {
    // Формат: "от|1|до|5|сотрудников"
    $parts = explode('|', $text);
    $result = [];
    
    foreach ($parts as $part) {
        $part = trim($part);
        // Проверяем, является ли часть числом
        if (is_numeric($part)) {
            $result[] = ['type' => 'mark', 'value' => $part];
        } else {
            $result[] = ['type' => 'text', 'value' => $part];
        }
    }
    
    return $result;
}

// Формируем массив карточек
$arResult['CARDS'] = [];

for ($i = 1; $i <= 3; $i++) {
    $image = trim($arParams['CARD_'.$i.'_IMAGE']);
    $title = trim($arParams['CARD_'.$i.'_TITLE']);
    $text = trim($arParams['CARD_'.$i.'_TEXT']);
    
    if ($title) {
        $arResult['CARDS'][] = [
            'IMAGE' => $image,
            'TITLE' => $title,
            'TEXT_PARTS' => parseCardText($text),
            'BACK_SUBTITLE' => trim($arParams['CARD_'.$i.'_BACK_SUBTITLE']),
            'BACK_TITLE' => trim($arParams['CARD_'.$i.'_BACK_TITLE']),
            'BACK_TEXT' => trim($arParams['CARD_'.$i.'_BACK_TEXT']),
        ];
    }
}

// Передаем параметры в результат
$arResult['MARK'] = $arParams['MARK'];
$arResult['TITLE'] = $arParams['TITLE'];
$arResult['BUTTON_TEXT'] = $arParams['BUTTON_TEXT'];
$arResult['BUTTON_LINK'] = $arParams['BUTTON_LINK'];

// Подключаем шаблон
$this->IncludeComponentTemplate();
?>