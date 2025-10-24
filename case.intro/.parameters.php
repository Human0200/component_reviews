<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = [
    "PARAMETERS" => [
        "TITLE_WORD" => [
            "PARENT" => "BASE",
            "NAME" => "Слово в заголовке (КЕЙС/ПРОЕКТ и т.д.)",
            "TYPE" => "STRING",
            "DEFAULT" => "КЕЙС",
        ],
        "SUBTITLE" => [
            "PARENT" => "BASE",
            "NAME" => "Подзаголовок (название кейса)",
            "TYPE" => "STRING",
            "DEFAULT" => "Продажа видеонаблюдения",
        ],
        "CARD_MARK" => [
            "PARENT" => "BASE",
            "NAME" => "Метка на карточке",
            "TYPE" => "STRING",
            "DEFAULT" => "Внедрение и настройка Битрикс24",
        ],
        "CARD_IMAGE" => [
            "PARENT" => "BASE",
            "NAME" => "Изображение (URL)",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "TAG_1" => [
            "PARENT" => "TAGS",
            "NAME" => "Тег 1",
            "TYPE" => "STRING",
            "DEFAULT" => "#воронка продаж и закупок",
        ],
        "TAG_2" => [
            "PARENT" => "TAGS",
            "NAME" => "Тег 2",
            "TYPE" => "STRING",
            "DEFAULT" => "#телефония и мессенджеры",
        ],
        "TAG_3" => [
            "PARENT" => "TAGS",
            "NAME" => "Тег 3",
            "TYPE" => "STRING",
            "DEFAULT" => "#Интеграция СБИС",
        ],
        "TAG_4" => [
            "PARENT" => "TAGS",
            "NAME" => "Тег 4",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "TAG_5" => [
            "PARENT" => "TAGS",
            "NAME" => "Тег 5",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "BUTTON_TEXT" => [
            "PARENT" => "BASE",
            "NAME" => "Текст кнопки",
            "TYPE" => "STRING",
            "DEFAULT" => "заказать внедрение",
        ],
        "BUTTON_LINK" => [
            "PARENT" => "BASE",
            "NAME" => "Ссылка кнопки",
            "TYPE" => "STRING",
            "DEFAULT" => "#",
        ],
        "WORKPLACES" => [
            "PARENT" => "TABLE",
            "NAME" => "Количество рабочих мест",
            "TYPE" => "STRING",
            "DEFAULT" => "20",
        ],
        "PROJECT_DAYS" => [
            "PARENT" => "TABLE",
            "NAME" => "Реализация проекта (дней)",
            "TYPE" => "STRING",
            "DEFAULT" => "7",
        ],
        "LICENSE" => [
            "PARENT" => "TABLE",
            "NAME" => "Лицензия",
            "TYPE" => "STRING",
            "DEFAULT" => "Коробочная версия Битрикс24 \"Корпоративный портал\"",
        ],
        "CACHE_TIME" => [
            "DEFAULT" => 3600,
        ],
    ],
    "GROUPS" => [
        "TAGS" => [
            "NAME" => "Теги"
        ],
        "TABLE" => [
            "NAME" => "Таблица"
        ],
    ]
];
?>