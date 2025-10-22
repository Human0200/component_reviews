<?php
// components/custom/crm.benefits/.parameters.php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = [
    "PARAMETERS" => [
        "MARK" => [
            "PARENT" => "BASE",
            "NAME" => "Метка (mark)",
            "TYPE" => "STRING",
            "DEFAULT" => "СRM-система",
        ],
        "TAGLINE_ROW_1" => [
            "PARENT" => "BASE",
            "NAME" => "Слоган - строка 1",
            "TYPE" => "STRING",
            "DEFAULT" => "Мы создали готовую CRM-систему",
        ],
        "TAGLINE_ROW_2" => [
            "PARENT" => "BASE",
            "NAME" => "Слоган - строка 2",
            "TYPE" => "STRING",
            "DEFAULT" => "учитывая наш большой опыт данной ниши.",
        ],
        "TITLE" => [
            "PARENT" => "BASE",
            "NAME" => "Заголовок",
            "TYPE" => "STRING",
            "DEFAULT" => "СRM-система помогает:",
        ],
        "CARD_1_TEXT" => [
            "PARENT" => "CARD_1",
            "NAME" => "Карточка 1 - Текст",
            "TYPE" => "STRING",
            "DEFAULT" => "Соблюдать\nсроки",
        ],
        "CARD_1_ICON" => [
            "PARENT" => "CARD_1",
            "NAME" => "Карточка 1 - Путь к SVG иконке",
            "TYPE" => "STRING",
            "DEFAULT" => '/assets/images/icons/clock.svg',
        ],
        "CARD_2_TEXT" => [
            "PARENT" => "CARD_2",
            "NAME" => "Карточка 2 - Текст",
            "TYPE" => "STRING",
            "DEFAULT" => "Контролировать работу сотрудников",
        ],
        "CARD_2_ICON" => [
            "PARENT" => "CARD_2",
            "NAME" => "Карточка 2 - Путь к SVG иконке",
            "TYPE" => "STRING",
            "DEFAULT" => '/assets/images/icons/users.svg',
        ],
        "CARD_3_TEXT" => [
            "PARENT" => "CARD_3",
            "NAME" => "Карточка 3 - Текст",
            "TYPE" => "STRING",
            "DEFAULT" => "Формировать автоматические отчеты",
        ],
        "CARD_3_ICON" => [
            "PARENT" => "CARD_3",
            "NAME" => "Карточка 3 - Путь к SVG иконке",
            "TYPE" => "STRING",
            "DEFAULT" => '/assets/images/icons/documents.svg',
        ],
        "CARD_4_TEXT" => [
            "PARENT" => "CARD_4",
            "NAME" => "Карточка 4 - Текст",
            "TYPE" => "STRING",
            "DEFAULT" => "Соблюдать\nсроки",
        ],
        "CARD_4_ICON" => [
            "PARENT" => "CARD_4",
            "NAME" => "Карточка 4 - Путь к SVG иконке",
            "TYPE" => "STRING",
            "DEFAULT" => '/assets/images/icons/clock.svg',
        ],
        "CARD_5_TEXT" => [
            "PARENT" => "CARD_5",
            "NAME" => "Карточка 5 - Текст",
            "TYPE" => "STRING",
            "DEFAULT" => "Контролировать работу сотрудников",
        ],
        "CARD_5_ICON" => [
            "PARENT" => "CARD_5",
            "NAME" => "Карточка 5 - Путь к SVG иконке",
            "TYPE" => "STRING",
            "DEFAULT" => '/assets/images/icons/users.svg',
        ],
        "CARD_6_TEXT" => [
            "PARENT" => "CARD_6",
            "NAME" => "Карточка 6 - Текст",
            "TYPE" => "STRING",
            "DEFAULT" => "Формировать автоматические отчеты",
        ],
        "CARD_6_ICON" => [
            "PARENT" => "CARD_6",
            "NAME" => "Карточка 6 - Путь к SVG иконке",
            "TYPE" => "STRING",
            "DEFAULT" => '/assets/images/icons/documents.svg',
        ],
        "CACHE_TIME" => [
            "DEFAULT" => 3600,
        ],
    ],
    "GROUPS" => [
        "CARD_1" => ["NAME" => "Карточка 1"],
        "CARD_2" => ["NAME" => "Карточка 2"],
        "CARD_3" => ["NAME" => "Карточка 3"],
        "CARD_4" => ["NAME" => "Карточка 4"],
        "CARD_5" => ["NAME" => "Карточка 5"],
        "CARD_6" => ["NAME" => "Карточка 6"],
    ]
];
?>