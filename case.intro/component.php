<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// Обработка параметров
$arParams['TITLE_WORD'] = trim($arParams['TITLE_WORD']) ?: 'КЕЙС';
$arParams['SUBTITLE'] = trim($arParams['SUBTITLE']) ?: 'Продажа видеонаблюдения';
$arParams['CARD_MARK'] = trim($arParams['CARD_MARK']) ?: 'Внедрение и настройка Битрикс24';
$arParams['CARD_IMAGE'] = trim($arParams['CARD_IMAGE']);
$arParams['BUTTON_TEXT'] = trim($arParams['BUTTON_TEXT']) ?: 'заказать внедрение';
$arParams['BUTTON_LINK'] = trim($arParams['BUTTON_LINK']) ?: '#';
$arParams['WORKPLACES'] = trim($arParams['WORKPLACES']) ?: '20';
$arParams['PROJECT_DAYS'] = trim($arParams['PROJECT_DAYS']) ?: '7';
$arParams['LICENSE'] = trim($arParams['LICENSE']) ?: 'Коробочная версия Битрикс24 "Корпоративный портал"';

// Передаем параметры в результат
$arResult['TITLE_WORD'] = $arParams['TITLE_WORD'];
$arResult['SUBTITLE'] = $arParams['SUBTITLE'];
$arResult['CARD_MARK'] = $arParams['CARD_MARK'];
$arResult['CARD_IMAGE'] = $arParams['CARD_IMAGE'];
$arResult['BUTTON_TEXT'] = $arParams['BUTTON_TEXT'];
$arResult['BUTTON_LINK'] = $arParams['BUTTON_LINK'];
$arResult['WORKPLACES'] = $arParams['WORKPLACES'];
$arResult['PROJECT_DAYS'] = $arParams['PROJECT_DAYS'];
$arResult['LICENSE'] = $arParams['LICENSE'];

// Собираем теги
$arResult['TAGS'] = [];
for($i = 1; $i <= 5; $i++) {
    $tag = trim($arParams['TAG_'.$i]);
    if($tag) {
        $arResult['TAGS'][] = $tag;
    }
}

// Подключаем шаблон
$this->IncludeComponentTemplate();
?>