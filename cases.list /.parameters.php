<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = [
    "PARAMETERS" => [
        "IBLOCK_ID" => [
            "PARENT" => "BASE",
            "NAME" => "ID инфоблока кейсов",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "IBLOCK_CODE" => [
            "PARENT" => "BASE",
            "NAME" => "Код инфоблока кейсов",
            "TYPE" => "STRING",
            "DEFAULT" => "cases",
        ],
        "IBLOCK_TYPE" => [
            "PARENT" => "BASE",
            "NAME" => "Тип инфоблока",
            "TYPE" => "STRING",
            "DEFAULT" => "content",
        ],
        "SECTION_MARK" => [
            "PARENT" => "VISUAL",
            "NAME" => "Метка секции",
            "TYPE" => "STRING",
            "DEFAULT" => "Кейсы",
        ],
        "SECTION_TITLE" => [
            "PARENT" => "VISUAL",
            "NAME" => "Заголовок секции",
            "TYPE" => "STRING",
            "DEFAULT" => "Мы работали и работаем",
        ],
        "SECTION_TEXT" => [
            "PARENT" => "VISUAL",
            "NAME" => "Текст секции",
            "TYPE" => "STRING",
            "DEFAULT" => "Мы собрали весь наш опыт и подробно описали его, чтобы вы могли оценить наши возможности.",
        ],
        "COUNTER_NUMBER" => [
            "PARENT" => "VISUAL",
            "NAME" => "Число счетчика",
            "TYPE" => "STRING",
            "DEFAULT" => "300+",
        ],
        "COUNTER_TEXT" => [
            "PARENT" => "VISUAL",
            "NAME" => "Текст счетчика",
            "TYPE" => "STRING",
            "DEFAULT" => "Умпешного внедрения\nCRM-системы в разные ниши",
        ],
        "TAGLINE_ROW_1" => [
            "PARENT" => "VISUAL",
            "NAME" => "Текст таглайн (строка 1)",
            "TYPE" => "STRING",
            "DEFAULT" => "Эти кейсы — лишь малая\nчасть того",
        ],
        "TAGLINE_ROW_2" => [
            "PARENT" => "VISUAL",
            "NAME" => "Текст таглайн (строка 2)",
            "TYPE" => "STRING",
            "DEFAULT" => "что мы можем\nпродемонстрировать",
        ],
        "MARQUEE_TEXT" => [
            "PARENT" => "VISUAL",
            "NAME" => "Текст бегущей строки",
            "TYPE" => "STRING",
            "DEFAULT" => "О компании",
        ],
        "CASES_COUNT" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => "Количество кейсов для вывода",
            "TYPE" => "STRING",
            "DEFAULT" => "8",
        ],
        "SORT_BY" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => "Поле сортировки",
            "TYPE" => "LIST",
            "VALUES" => [
                "SORT" => "Сортировка",
                "DATE_CREATE" => "Дата создания",
                "NAME" => "Название",
            ],
            "DEFAULT" => "SORT",
        ],
        "SORT_ORDER" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => "Порядок сортировки",
            "TYPE" => "LIST",
            "VALUES" => [
                "ASC" => "По возрастанию",
                "DESC" => "По убыванию",
            ],
            "DEFAULT" => "ASC",
        ],
        "SHOW_TAGS" => [
            "PARENT" => "VISUAL",
            "NAME" => "Показывать теги (хештеги)",
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ],
        "CACHE_TIME" => [
            "DEFAULT" => 3600,
        ],
    ],
];
?>