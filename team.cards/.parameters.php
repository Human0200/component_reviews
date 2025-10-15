<?php
// components/custom/team.cards/.parameters.php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = [
    "PARAMETERS" => [
        "SECTION_MARK" => [
            "PARENT" => "BASE",
            "NAME" => "Метка секции",
            "TYPE" => "STRING",
            "DEFAULT" => "сотрудники",
        ],
        "SECTION_TITLE" => [
            "PARENT" => "BASE",
            "NAME" => "Заголовок секции",
            "TYPE" => "STRING",
            "DEFAULT" => "Наши сотрудники регулярно проходят курсы повышения квалификации",
        ],
        "SECTION_TEXT" => [
            "PARENT" => "BASE",
            "NAME" => "Текст секции",
            "TYPE" => "STRING",
            "DEFAULT" => "Что позволяет им оставаться в курсе последних тенденций и развивать свои навыки",
        ],
        "COVER_IMAGE_DESKTOP" => [
            "PARENT" => "VISUAL",
            "NAME" => "Фоновое изображение (десктоп)",
            "TYPE" => "STRING",
            "DEFAULT" => "/assets/images/team/cover-d.webp",
        ],
        "COVER_IMAGE_MOBILE" => [
            "PARENT" => "VISUAL",
            "NAME" => "Фоновое изображение (мобильное)",
            "TYPE" => "STRING",
            "DEFAULT" => "/assets/images/team/cover-m.webp",
        ],
        "CARD_1_NUMBER" => [
            "PARENT" => "CARD_1",
            "NAME" => "Карточка 1 - Количество",
            "TYPE" => "STRING",
            "DEFAULT" => "4",
        ],
        "CARD_1_TITLE" => [
            "PARENT" => "CARD_1",
            "NAME" => "Карточка 1 - Название",
            "TYPE" => "STRING",
            "DEFAULT" => "Интерграторы",
        ],
        "CARD_1_USERS_COUNT" => [
            "PARENT" => "CARD_1",
            "NAME" => "Карточка 1 - Количество фото сотрудников",
            "TYPE" => "LIST",
            "VALUES" => [
                "1" => "1 фото",
                "2" => "2 фото",
                "3" => "3 фото",
            ],
            "DEFAULT" => "3",
        ],
        "CARD_2_NUMBER" => [
            "PARENT" => "CARD_2",
            "NAME" => "Карточка 2 - Количество",
            "TYPE" => "STRING",
            "DEFAULT" => "3",
        ],
        "CARD_2_TITLE" => [
            "PARENT" => "CARD_2",
            "NAME" => "Карточка 2 - Название",
            "TYPE" => "STRING",
            "DEFAULT" => "Бизнес-аналитики",
        ],
        "CARD_2_USERS_COUNT" => [
            "PARENT" => "CARD_2",
            "NAME" => "Карточка 2 - Количество фото сотрудников",
            "TYPE" => "LIST",
            "VALUES" => [
                "1" => "1 фото",
                "2" => "2 фото",
                "3" => "3 фото",
            ],
            "DEFAULT" => "2",
        ],
        "CARD_3_NUMBER" => [
            "PARENT" => "CARD_3",
            "NAME" => "Карточка 3 - Количество",
            "TYPE" => "STRING",
            "DEFAULT" => "2",
        ],
        "CARD_3_TITLE" => [
            "PARENT" => "CARD_3",
            "NAME" => "Карточка 3 - Название",
            "TYPE" => "STRING",
            "DEFAULT" => "Специалисты технической поддержки",
        ],
        "CARD_3_USERS_COUNT" => [
            "PARENT" => "CARD_3",
            "NAME" => "Карточка 3 - Количество фото сотрудников",
            "TYPE" => "LIST",
            "VALUES" => [
                "1" => "1 фото",
                "2" => "2 фото",
                "3" => "3 фото",
            ],
            "DEFAULT" => "2",
        ],
        "CARD_4_NUMBER" => [
            "PARENT" => "CARD_4",
            "NAME" => "Карточка 4 - Количество",
            "TYPE" => "STRING",
            "DEFAULT" => "2",
        ],
        "CARD_4_TITLE" => [
            "PARENT" => "CARD_4",
            "NAME" => "Карточка 4 - Название",
            "TYPE" => "STRING",
            "DEFAULT" => "Програмисты",
        ],
        "CARD_4_USERS_COUNT" => [
            "PARENT" => "CARD_4",
            "NAME" => "Карточка 4 - Количество фото сотрудников",
            "TYPE" => "LIST",
            "VALUES" => [
                "1" => "1 фото",
                "2" => "2 фото",
                "3" => "3 фото",
            ],
            "DEFAULT" => "2",
        ],
        "CARD_5_NUMBER" => [
            "PARENT" => "CARD_5",
            "NAME" => "Карточка 5 - Количество",
            "TYPE" => "STRING",
            "DEFAULT" => "5",
        ],
        "CARD_5_TITLE" => [
            "PARENT" => "CARD_5",
            "NAME" => "Карточка 5 - Название",
            "TYPE" => "STRING",
            "DEFAULT" => "Менеджеры проектов",
        ],
        "CARD_5_USERS_COUNT" => [
            "PARENT" => "CARD_5",
            "NAME" => "Карточка 5 - Количество фото сотрудников",
            "TYPE" => "LIST",
            "VALUES" => [
                "1" => "1 фото",
                "2" => "2 фото",
                "3" => "3 фото",
            ],
            "DEFAULT" => "3",
        ],
        "CACHE_TIME" => [
            "DEFAULT" => 3600,
        ],
    ],
    "GROUPS" => [
        "CARD_1" => [
            "NAME" => "Карточка 1"
        ],
        "CARD_2" => [
            "NAME" => "Карточка 2"
        ],
        "CARD_3" => [
            "NAME" => "Карточка 3"
        ],
        "CARD_4" => [
            "NAME" => "Карточка 4"
        ],
        "CARD_5" => [
            "NAME" => "Карточка 5"
        ],
    ]
];
?>