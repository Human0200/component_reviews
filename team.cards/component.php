<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// Обработка параметров
$arParams['SECTION_MARK'] = trim($arParams['SECTION_MARK']) ?: 'сотрудники';
$arParams['SECTION_TITLE'] = trim($arParams['SECTION_TITLE']) ?: 'Наши сотрудники регулярно проходят курсы повышения квалификации';
$arParams['SECTION_TEXT'] = trim($arParams['SECTION_TEXT']) ?: 'Что позволяет им оставаться в курсе последних тенденций и развивать свои навыки';
$arParams['COVER_IMAGE_DESKTOP'] = trim($arParams['COVER_IMAGE_DESKTOP']) ?: '/assets/images/team/cover-d.webp';
$arParams['COVER_IMAGE_MOBILE'] = trim($arParams['COVER_IMAGE_MOBILE']) ?: '/assets/images/team/cover-m.webp';
$arParams['CACHE_TIME'] = intval($arParams['CACHE_TIME']) ?: 3600;

// Формируем массив карточек
$arResult['CARDS'] = [];

for ($i = 1; $i <= 5; $i++) {
    $number = trim($arParams['CARD_'.$i.'_NUMBER']) ?: '0';
    $title = trim($arParams['CARD_'.$i.'_TITLE']) ?: '';
    $usersCount = intval($arParams['CARD_'.$i.'_USERS_COUNT']) ?: 3;
    
    if ($title) {
        $arResult['CARDS'][] = [
            'NUMBER' => $number,
            'TITLE' => $title,
            'USERS_COUNT' => $usersCount
        ];
    }
}

// Передаем параметры в результат
$arResult['SECTION_MARK'] = $arParams['SECTION_MARK'];
$arResult['SECTION_TITLE'] = $arParams['SECTION_TITLE'];
$arResult['SECTION_TEXT'] = $arParams['SECTION_TEXT'];
$arResult['COVER_IMAGE_DESKTOP'] = $arParams['COVER_IMAGE_DESKTOP'];
$arResult['COVER_IMAGE_MOBILE'] = $arParams['COVER_IMAGE_MOBILE'];

// Подключаем шаблон
$this->IncludeComponentTemplate();
?>