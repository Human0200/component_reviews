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
        "CACHE_TIME" => ["DEFAULT" => 3600],
    ],
];
?>