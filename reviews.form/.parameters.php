<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = [
    "PARAMETERS" => [
        "PRODUCT_ID" => [
            "PARENT" => "BASE",
            "NAME" => "ID товара",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "IBLOCK_ID" => [
            "PARENT" => "BASE",
            "NAME" => "ID инфоблока отзывов",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "IBLOCK_TYPE" => [
            "PARENT" => "BASE",
            "NAME" => "Тип инфоблока",
            "TYPE" => "STRING",
            "DEFAULT" => "reviews",
        ],
        "BUTTON_TEXT" => [
            "PARENT" => "VISUAL",
            "NAME" => "Текст кнопки",
            "TYPE" => "STRING",
            "DEFAULT" => "Написать отзыв",
        ],
        "BUTTON_COLOR" => [
            "PARENT" => "VISUAL",
            "NAME" => "Цвет кнопки",
            "TYPE" => "STRING",
            "DEFAULT" => "#BF1E77",
        ],
        "CHECK_DUPLICATE" => [
            "PARENT" => "ADDITIONAL_SETTINGS",
            "NAME" => "Проверять дубликаты отзывов",
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ],
        "CHECK_TIME_LIMIT" => [
            "PARENT" => "ADDITIONAL_SETTINGS",
            "NAME" => "Ограничить частоту отзывов",
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ],
        "TIME_LIMIT_MINUTES" => [
            "PARENT" => "ADDITIONAL_SETTINGS",
            "NAME" => "Интервал между отзывами (минут)",
            "TYPE" => "STRING",
            "DEFAULT" => "5",
        ],
        "CACHE_TIME" => ["DEFAULT" => 3600],
    ],
    "GROUPS" => [
        "ADDITIONAL_SETTINGS" => [
            "NAME" => "Настройки защиты от спама",
        ],
    ],
];
?>