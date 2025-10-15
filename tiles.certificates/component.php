<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// Обработка параметров
$arParams['IMAGE_BACK'] = trim($arParams['IMAGE_BACK']) ?: '/local/templates/leadspace/assets/images/certificates/01.webp';
$arParams['IMAGE_FRONT'] = trim($arParams['IMAGE_FRONT']) ?: '/local/templates/leadspace/assets/images/certificates/01.webp';
$arParams['CACHE_TIME'] = intval($arParams['CACHE_TIME']) ?: 3600;

// Передаем в результат
$arResult['IMAGE_BACK'] = $arParams['IMAGE_BACK'];
$arResult['IMAGE_FRONT'] = $arParams['IMAGE_FRONT'];

// Подключаем шаблон
$this->IncludeComponentTemplate();
?>