<?php
// components/custom/reviews.list/.parameters.php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = [
    "PARAMETERS" => [
        "PRODUCT_ID" => [
            "PARENT" => "BASE",
            "NAME" => "ID товара",
            "TYPE" => "STRING",
            "DEFAULT" => "={$_REQUEST['ID']}",
        ],
        "IBLOCK_ID" => [
            "PARENT" => "BASE",
            "NAME" => "ID инфоблока отзывов",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "IBLOCK_CODE" => [
            "PARENT" => "BASE",
            "NAME" => "Код инфоблока отзывов",
            "TYPE" => "STRING",
            "DEFAULT" => "product_reviews",
        ],
        "IBLOCK_TYPE" => [
            "PARENT" => "BASE",
            "NAME" => "Тип инфоблока",
            "TYPE" => "STRING",
            "DEFAULT" => "reviews",
        ],
        "SORT_ORDER" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => "Порядок сортировки",
            "TYPE" => "LIST",
            "VALUES" => [
                "DESC" => "Сначала новые",
                "ASC" => "Сначала старые",
            ],
            "DEFAULT" => "DESC",
        ],
        "PAGE_SIZE" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => "Количество отзывов на странице",
            "TYPE" => "STRING",
            "DEFAULT" => "10",
        ],
        "SHOW_GUEST_NAME" => [
            "PARENT" => "VISUAL",
            "NAME" => "Показывать имя для гостей",
            "TYPE" => "STRING",
            "DEFAULT" => "Гость",
        ],
        "DATE_FORMAT" => [
            "PARENT" => "VISUAL",
            "NAME" => "Формат даты",
            "TYPE" => "STRING",
            "DEFAULT" => "d.m.Y",
        ],
        "CACHE_TIME" => [
            "DEFAULT" => 3600,
        ],
    ],
];
?>