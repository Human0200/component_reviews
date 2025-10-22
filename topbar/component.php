<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// Обработка основных параметров
$arParams['IMAGE'] = trim($arParams['IMAGE']) ?: '/assets/images/topbar/01.webp';
$arParams['TAGLINE'] = trim($arParams['TAGLINE']) ?: 'Банкроство физ.лиц это ответственная сфера, в которой нельзя упустить важные детали.';
$arParams['TITLE'] = trim($arParams['TITLE']) ?: 'Банкротсво физических лиц';
$arParams['SUBTITLE'] = trim($arParams['SUBTITLE']) ?: 'Полностью готовое решение для ниши';

// Обработка цены
$arParams['PRICE_OLD'] = trim($arParams['PRICE_OLD']) ?: '35 000 р';
$arParams['PRICE_NEW'] = trim($arParams['PRICE_NEW']) ?: '0';
$arParams['PRICE_CURRENCY'] = trim($arParams['PRICE_CURRENCY']) ?: 'рублей';
$arParams['PRICE_NOTE'] = trim($arParams['PRICE_NOTE']) ?: '*входит в счет приобретения годовой лицензии черзе нас';

// Обработка карточек
$arResult['CARDS'] = [];

// Карточка 1
if (!empty($arParams['CARD_1_TEXT'])) {
    $arResult['CARDS'][] = [
        'TEXT' => trim($arParams['CARD_1_TEXT']),
        'NUMBER' => trim($arParams['CARD_1_NUMBER']) ?: '20+',
        'LABEL' => trim($arParams['CARD_1_LABEL']) ?: 'установок',
        'PREFIX' => '',
    ];
}

// Карточка 2
if (!empty($arParams['CARD_2_TEXT'])) {
    $arResult['CARDS'][] = [
        'TEXT' => trim($arParams['CARD_2_TEXT']),
        'NUMBER' => trim($arParams['CARD_2_NUMBER']) ?: '7',
        'LABEL' => trim($arParams['CARD_2_LABEL']) ?: 'дней',
        'PREFIX' => trim($arParams['CARD_2_PREFIX']) ?: 'до',
    ];
}

// Карточка 3
if (!empty($arParams['CARD_3_TEXT'])) {
    $arResult['CARDS'][] = [
        'TEXT' => trim($arParams['CARD_3_TEXT']),
        'NUMBER' => trim($arParams['CARD_3_NUMBER']) ?: '150',
        'LABEL' => trim($arParams['CARD_3_LABEL']) ?: 'т.р',
        'PREFIX' => trim($arParams['CARD_3_PREFIX']) ?: 'от',
    ];
}

// Обработка кнопок
$arResult['BUTTONS'] = [
    [
        'TEXT' => trim($arParams['BUTTON_1_TEXT']) ?: 'заказать внедрение',
        'LINK' => trim($arParams['BUTTON_1_LINK']) ?: '#',
        'CURSOR' => trim($arParams['BUTTON_1_CURSOR']) ?: 'Перейти',
        'CLASS' => 'ui-btn ui-btn--gradient',
    ],
    [
        'TEXT' => trim($arParams['BUTTON_2_TEXT']) ?: 'Попробовать 7 дней бесплатно',
        'LINK' => trim($arParams['BUTTON_2_LINK']) ?: '#',
        'CURSOR' => '',
        'CLASS' => 'ui-btn ui-btn--dark',
    ],
];

// Передаем параметры в результат
$arResult['IMAGE'] = $arParams['IMAGE'];
$arResult['TAGLINE'] = $arParams['TAGLINE'];
$arResult['TITLE'] = $arParams['TITLE'];
$arResult['SUBTITLE'] = $arParams['SUBTITLE'];
$arResult['PRICE_OLD'] = $arParams['PRICE_OLD'];
$arResult['PRICE_NEW'] = $arParams['PRICE_NEW'];
$arResult['PRICE_CURRENCY'] = $arParams['PRICE_CURRENCY'];
$arResult['PRICE_NOTE'] = $arParams['PRICE_NOTE'];

$arParams['CACHE_TIME'] = intval($arParams['CACHE_TIME']) ?: 3600;

// Подключаем шаблон
$this->IncludeComponentTemplate();
?>