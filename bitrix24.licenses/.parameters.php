<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = [
    "PARAMETERS" => [
        "MARK_TEXT" => [
            "PARENT" => "BASE",
            "NAME" => "Текст метки (верхний текст)",
            "TYPE" => "STRING",
            "DEFAULT" => "Мы не просто продаем — мы помогаем вам использовать Битрикс24",
        ],
        "MARK_HIGHLIGHT" => [
            "PARENT" => "BASE",
            "NAME" => "Выделенный текст в метке",
            "TYPE" => "STRING",
            "DEFAULT" => "на полную мощность",
        ],
        "TITLE" => [
            "PARENT" => "BASE",
            "NAME" => "Заголовок раздела",
            "TYPE" => "STRING",
            "DEFAULT" => "Лицензии Битрикс24",
        ],
        "CAPTION" => [
            "PARENT" => "BASE",
            "NAME" => "Подпись рядом с заголовком",
            "TYPE" => "STRING",
            "DEFAULT" => "В соответствии с политикой 1С-Битрикс24 мы не продаем лицензии выше или ниже установленных цен",
        ],
        "IBLOCK_ID_CLOUD" => [
            "PARENT" => "BASE",
            "NAME" => "ID инфоблока для облачных лицензий",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "IBLOCK_ID_BOXED" => [
            "PARENT" => "BASE",
            "NAME" => "ID инфоблока для коробочных лицензий",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "IBLOCK_ID_SUBSCRIPTION" => [
            "PARENT" => "BASE",
            "NAME" => "ID инфоблока для подписок",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "FOOTER_TEXT" => [
            "PARENT" => "BASE",
            "NAME" => "Текст в подвале секции подписок",
            "TYPE" => "STRING",
            "DEFAULT" => "В таблице цены со скидкой 50% для тех, кто покупает подписку впервые",
        ],
        "CACHE_TIME" => [
            "DEFAULT" => 3600,
        ],
    ],
];
?>