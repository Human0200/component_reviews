<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = [
    "PARAMETERS" => [
        "MARK_TEXT" => [
            "PARENT" => "BASE",
            "NAME" => "Текст метки (верхний текст)",
            "TYPE" => "STRING",
            "DEFAULT" => "что внутри",
        ],
        "TAGLINE_ROW_1" => [
            "PARENT" => "BASE",
            "NAME" => "Тэглайн - строка 1",
            "TYPE" => "STRING",
            "DEFAULT" => "Вместе с CRM-решением вы получите",
        ],
        "TAGLINE_ROW_2" => [
            "PARENT" => "BASE",
            "NAME" => "Тэглайн - строка 2",
            "TYPE" => "STRING",
            "DEFAULT" => "полный набор инструментов Битрикс24 для работы",
        ],
        "TITLE" => [
            "PARENT" => "BASE",
            "NAME" => "Заголовок секции",
            "TYPE" => "STRING",
            "DEFAULT" => "Что внутри готового решения?",
        ],
        
        // Блок 1
        "TOOL_1_NAME" => [
            "PARENT" => "TOOL_1",
            "NAME" => "Название инструмента",
            "TYPE" => "STRING",
            "DEFAULT" => "ЧАТ И ВИДЕОЗВОНКИ",
        ],
        "TOOL_1_DESC_1" => [
            "PARENT" => "TOOL_1",
            "NAME" => "Описание 1",
            "TYPE" => "TEXT",
            "DEFAULT" => "",
        ],
        "TOOL_1_DESC_2" => [
            "PARENT" => "TOOL_1",
            "NAME" => "Описание 2",
            "TYPE" => "TEXT",
            "DEFAULT" => "",
        ],
        "TOOL_1_DESC_3" => [
            "PARENT" => "TOOL_1",
            "NAME" => "Описание 3",
            "TYPE" => "TEXT",
            "DEFAULT" => "",
        ],
        "TOOL_1_DESC_4" => [
            "PARENT" => "TOOL_1",
            "NAME" => "Описание 4",
            "TYPE" => "TEXT",
            "DEFAULT" => "",
        ],
        "TOOL_1_DESC_5" => [
            "PARENT" => "TOOL_1",
            "NAME" => "Описание 5",
            "TYPE" => "TEXT",
            "DEFAULT" => "",
        ],
        "TOOL_1_IMAGE_1" => [
            "PARENT" => "TOOL_1",
            "NAME" => "Картинка 1 (URL)",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "TOOL_1_IMAGE_2" => [
            "PARENT" => "TOOL_1",
            "NAME" => "Картинка 2 (URL)",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "TOOL_1_IMAGE_3" => [
            "PARENT" => "TOOL_1",
            "NAME" => "Картинка 3 (URL)",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "TOOL_1_IMAGE_4" => [
            "PARENT" => "TOOL_1",
            "NAME" => "Картинка 4 (URL)",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "TOOL_1_IMAGE_5" => [
            "PARENT" => "TOOL_1",
            "NAME" => "Картинка 5 (URL)",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        
        // Блок 2
        "TOOL_2_NAME" => [
            "PARENT" => "TOOL_2",
            "NAME" => "Название инструмента",
            "TYPE" => "STRING",
            "DEFAULT" => "ЧАТ И ВИДЕОЗВОНКИ",
        ],
        "TOOL_2_DESC_1" => [
            "PARENT" => "TOOL_2",
            "NAME" => "Описание 1",
            "TYPE" => "TEXT",
            "DEFAULT" => "",
        ],
        "TOOL_2_DESC_2" => [
            "PARENT" => "TOOL_2",
            "NAME" => "Описание 2",
            "TYPE" => "TEXT",
            "DEFAULT" => "",
        ],
        "TOOL_2_DESC_3" => [
            "PARENT" => "TOOL_2",
            "NAME" => "Описание 3",
            "TYPE" => "TEXT",
            "DEFAULT" => "",
        ],
        "TOOL_2_DESC_4" => [
            "PARENT" => "TOOL_2",
            "NAME" => "Описание 4",
            "TYPE" => "TEXT",
            "DEFAULT" => "",
        ],
        "TOOL_2_DESC_5" => [
            "PARENT" => "TOOL_2",
            "NAME" => "Описание 5",
            "TYPE" => "TEXT",
            "DEFAULT" => "",
        ],
        "TOOL_2_IMAGE_1" => [
            "PARENT" => "TOOL_2",
            "NAME" => "Картинка 1 (URL)",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "TOOL_2_IMAGE_2" => [
            "PARENT" => "TOOL_2",
            "NAME" => "Картинка 2 (URL)",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "TOOL_2_IMAGE_3" => [
            "PARENT" => "TOOL_2",
            "NAME" => "Картинка 3 (URL)",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "TOOL_2_IMAGE_4" => [
            "PARENT" => "TOOL_2",
            "NAME" => "Картинка 4 (URL)",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "TOOL_2_IMAGE_5" => [
            "PARENT" => "TOOL_2",
            "NAME" => "Картинка 5 (URL)",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        
        "CACHE_TIME" => [
            "DEFAULT" => 3600,
        ],
    ],
    "GROUPS" => [
        "TOOL_1" => [
            "NAME" => "Инструмент 1"
        ],
        "TOOL_2" => [
            "NAME" => "Инструмент 2"
        ],
    ]
];
?>