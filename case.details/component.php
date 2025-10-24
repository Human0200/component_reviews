<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// Обработка параметров
$arParams['BG_IMAGE'] = trim($arParams['BG_IMAGE']);
$arParams['MARK_TEXT'] = trim($arParams['MARK_TEXT']) ?: 'компания';

// Блок 1
$arParams['BLOCK_1_TITLE'] = trim($arParams['BLOCK_1_TITLE']) ?: 'О клиенте';
$arParams['BLOCK_1_TEXT'] = trim($arParams['BLOCK_1_TEXT']);
$arParams['BLOCK_1_CLIENT_NAME'] = trim($arParams['BLOCK_1_CLIENT_NAME']) ?: 'ВизорМОНИТОР';
$arParams['BLOCK_1_CLIENT_LINK'] = trim($arParams['BLOCK_1_CLIENT_LINK']) ?: '#';

// Блок 2
$arParams['BLOCK_2_TITLE'] = trim($arParams['BLOCK_2_TITLE']) ?: 'задачи клиента';
$arParams['BLOCK_2_TEXT'] = trim($arParams['BLOCK_2_TEXT']);

// Передаем в результат
$arResult['BG_IMAGE'] = $arParams['BG_IMAGE'];
$arResult['MARK_TEXT'] = $arParams['MARK_TEXT'];

$arResult['BLOCKS'] = [];

// Блок 1
if($arParams['BLOCK_1_TEXT']) {
    $arResult['BLOCKS'][] = [
        'TITLE' => $arParams['BLOCK_1_TITLE'],
        'TEXT' => $arParams['BLOCK_1_TEXT'],
        'CLIENT_NAME' => $arParams['BLOCK_1_CLIENT_NAME'],
        'CLIENT_LINK' => $arParams['BLOCK_1_CLIENT_LINK'],
    ];
}

// Блок 2
if($arParams['BLOCK_2_TEXT']) {
    $arResult['BLOCKS'][] = [
        'TITLE' => $arParams['BLOCK_2_TITLE'],
        'TEXT' => $arParams['BLOCK_2_TEXT'],
        'CLIENT_NAME' => '',
        'CLIENT_LINK' => '',
    ];
}

// Подключаем шаблон
$this->IncludeComponentTemplate();
?>