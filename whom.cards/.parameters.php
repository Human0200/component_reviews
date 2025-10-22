<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = [
    "PARAMETERS" => [
        "MARK" => [
            "PARENT" => "BASE",
            "NAME" => "Метка (mark)",
            "TYPE" => "STRING",
            "DEFAULT" => "для кого",
        ],
        "TITLE" => [
            "PARENT" => "BASE",
            "NAME" => "Заголовок",
            "TYPE" => "STRING",
            "DEFAULT" => "Кому подходит данное решение?",
        ],
        "BUTTON_TEXT" => [
            "PARENT" => "BASE",
            "NAME" => "Текст кнопки",
            "TYPE" => "STRING",
            "DEFAULT" => "Попробовать 7 дней бесплатно",
        ],
        "BUTTON_LINK" => [
            "PARENT" => "BASE",
            "NAME" => "Ссылка кнопки",
            "TYPE" => "STRING",
            "DEFAULT" => "#",
        ],
        
        // Карточка 1
        "CARD_1_IMAGE" => [
            "PARENT" => "CARD_1",
            "NAME" => "Карточка 1 - Изображение",
            "TYPE" => "STRING",
            "DEFAULT" => "/assets/images/whom/01.webp",
        ],
        "CARD_1_TITLE" => [
            "PARENT" => "CARD_1",
            "NAME" => "Карточка 1 - Заголовок",
            "TYPE" => "STRING",
            "DEFAULT" => "Частным юристам",
        ],
        "CARD_1_TEXT" => [
            "PARENT" => "CARD_1",
            "NAME" => "Карточка 1 - Текст (лицевая сторона)",
            "TYPE" => "STRING",
            "DEFAULT" => "от|1|до|5|сотрудников",
        ],
        "CARD_1_BACK_SUBTITLE" => [
            "PARENT" => "CARD_1",
            "NAME" => "Карточка 1 - Подзаголовок (обратная сторона)",
            "TYPE" => "STRING",
            "DEFAULT" => "Численность от 10 до 1 000 сотрудников",
        ],
        "CARD_1_BACK_TITLE" => [
            "PARENT" => "CARD_1",
            "NAME" => "Карточка 1 - Заголовок (обратная сторона)",
            "TYPE" => "STRING",
            "DEFAULT" => "Юридическим компаниям",
        ],
        "CARD_1_BACK_TEXT" => [
            "PARENT" => "CARD_1",
            "NAME" => "Карточка 1 - Текст (обратная сторона)",
            "TYPE" => "TEXT",
            "DEFAULT" => "Мы создали инструмент, который поможет вам быстро определить первые шаги и спланировать сбор документов, экономя время и фокусируясь на главном",
        ],
        
        // Карточка 2
        "CARD_2_IMAGE" => [
            "PARENT" => "CARD_2",
            "NAME" => "Карточка 2 - Изображение",
            "TYPE" => "STRING",
            "DEFAULT" => "/assets/images/whom/02.webp",
        ],
        "CARD_2_TITLE" => [
            "PARENT" => "CARD_2",
            "NAME" => "Карточка 2 - Заголовок",
            "TYPE" => "STRING",
            "DEFAULT" => "Небольшим компаниям",
        ],
        "CARD_2_TEXT" => [
            "PARENT" => "CARD_2",
            "NAME" => "Карточка 2 - Текст (лицевая сторона)",
            "TYPE" => "STRING",
            "DEFAULT" => "от|3|до|50|сотрудников",
        ],
        "CARD_2_BACK_SUBTITLE" => [
            "PARENT" => "CARD_2",
            "NAME" => "Карточка 2 - Подзаголовок (обратная сторона)",
            "TYPE" => "STRING",
            "DEFAULT" => "Численность от 10 до 1 000 сотрудников",
        ],
        "CARD_2_BACK_TITLE" => [
            "PARENT" => "CARD_2",
            "NAME" => "Карточка 2 - Заголовок (обратная сторона)",
            "TYPE" => "STRING",
            "DEFAULT" => "Юридическим компаниям",
        ],
        "CARD_2_BACK_TEXT" => [
            "PARENT" => "CARD_2",
            "NAME" => "Карточка 2 - Текст (обратная сторона)",
            "TYPE" => "TEXT",
            "DEFAULT" => "Мы создали инструмент, который поможет вам быстро определить первые шаги и спланировать сбор документов, экономя время и фокусируясь на главном",
        ],
        
        // Карточка 3
        "CARD_3_IMAGE" => [
            "PARENT" => "CARD_3",
            "NAME" => "Карточка 3 - Изображение",
            "TYPE" => "STRING",
            "DEFAULT" => "/assets/images/whom/02.webp",
        ],
        "CARD_3_TITLE" => [
            "PARENT" => "CARD_3",
            "NAME" => "Карточка 3 - Заголовок",
            "TYPE" => "STRING",
            "DEFAULT" => "Юридическим компаниям",
        ],
        "CARD_3_TEXT" => [
            "PARENT" => "CARD_3",
            "NAME" => "Карточка 3 - Текст (лицевая сторона)",
            "TYPE" => "STRING",
            "DEFAULT" => "от|10|до|1000|сотрудников",
        ],
        "CARD_3_BACK_SUBTITLE" => [
            "PARENT" => "CARD_3",
            "NAME" => "Карточка 3 - Подзаголовок (обратная сторона)",
            "TYPE" => "STRING",
            "DEFAULT" => "Численность от 10 до 1 000 сотрудников",
        ],
        "CARD_3_BACK_TITLE" => [
            "PARENT" => "CARD_3",
            "NAME" => "Карточка 3 - Заголовок (обратная сторона)",
            "TYPE" => "STRING",
            "DEFAULT" => "Юридическим компаниям",
        ],
        "CARD_3_BACK_TEXT" => [
            "PARENT" => "CARD_3",
            "NAME" => "Карточка 3 - Текст (обратная сторона)",
            "TYPE" => "TEXT",
            "DEFAULT" => "Мы создали инструмент, который поможет вам быстро определить первые шаги и спланировать сбор документов, экономя время и фокусируясь на главном",
        ],
        
        "CACHE_TIME" => [
            "DEFAULT" => 3600,
        ],
    ],
    "GROUPS" => [
        "CARD_1" => ["NAME" => "Карточка 1"],
        "CARD_2" => ["NAME" => "Карточка 2"],
        "CARD_3" => ["NAME" => "Карточка 3"],
    ]
];
?>