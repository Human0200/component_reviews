<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = [
    "GROUPS" => [
        "BRANDING" => [
            "NAME" => "Настройки брендинга",
            "SORT" => 100,
        ],
    ],
    "PARAMETERS" => [
        "HLBLOCK_ID" => [
            "PARENT" => "BASE",
            "NAME" => "ID Highload-блока",
            "TYPE" => "STRING",
            "DEFAULT" => "2",
        ],
        "SORT_FIELD" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => "Поле для сортировки",
            "TYPE" => "LIST",
            "VALUES" => [
                "UF_SORT" => "Сортировка",
                "UF_NAME" => "Название",
                "ID" => "ID записи",
            ],
            "DEFAULT" => "UF_SORT",
        ],
        "SORT_ORDER" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => "Направление сортировки",
            "TYPE" => "LIST",
            "VALUES" => [
                "ASC" => "По возрастанию",
                "DESC" => "По убыванию",
            ],
            "DEFAULT" => "ASC",
        ],
        "LOGO_SVG_PATH" => [
            "PARENT" => "BRANDING",
            "NAME" => "Путь к SVG логотипу",
            "TYPE" => "STRING",
            "DEFAULT" => SITE_TEMPLATE_PATH . "/assets/images/logo.svg",
        ],
        "LOGO_ALT" => [
            "PARENT" => "BRANDING",
            "NAME" => "Alt текст для логотипа",
            "TYPE" => "STRING",
            "DEFAULT" => "3D Group",
        ],
        "FAVICON_SVG" => [
            "PARENT" => "BRANDING",
            "NAME" => "Путь к favicon.svg",
            "TYPE" => "STRING",
            "DEFAULT" => SITE_TEMPLATE_PATH . "/assets/favicons/favicon.svg",
        ],
        "FAVICON_PNG" => [
            "PARENT" => "BRANDING",
            "NAME" => "Путь к favicon-96x96.png",
            "TYPE" => "STRING",
            "DEFAULT" => SITE_TEMPLATE_PATH . "/assets/favicons/favicon-96x96.png",
        ],
        "FAVICON_ICO" => [
            "PARENT" => "BRANDING",
            "NAME" => "Путь к favicon.ico",
            "TYPE" => "STRING",
            "DEFAULT" => SITE_TEMPLATE_PATH . "/assets/favicons/favicon.ico",
        ],
        "APPLE_TOUCH_ICON" => [
            "PARENT" => "BRANDING",
            "NAME" => "Путь к apple-touch-icon.png",
            "TYPE" => "STRING",
            "DEFAULT" => SITE_TEMPLATE_PATH . "/assets/favicons/apple-touch-icon.png",
        ],
        "CACHE_TIME" => [
            "DEFAULT" => 3600,
        ],
    ],
];
?>