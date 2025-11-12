<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = [
    "PARAMETERS" => [
        "IMAGE" => [
            "PARENT" => "BASE",
            "NAME" => "Изображение",
            "TYPE" => "STRING",
            "DEFAULT" => "/assets/images/topbar/01.webp",
        ],
        "TAGLINE" => [
            "PARENT" => "BASE",
            "NAME" => "Слоган (над заголовком)",
            "TYPE" => "STRING",
            "DEFAULT" => "Банкроство физ.лиц это ответственная сфера, в которой нельзя упустить важные детали.",
        ],
        "TITLE" => [
            "PARENT" => "BASE",
            "NAME" => "Заголовок",
            "TYPE" => "STRING",
            "DEFAULT" => "Банкротсво физических лиц",
        ],
        "SUBTITLE" => [
            "PARENT" => "BASE",
            "NAME" => "Подзаголовок",
            "TYPE" => "STRING",
            "DEFAULT" => "Полностью готовое решение для ниши",
        ],
        "PRICE_OLD" => [
            "PARENT" => "PRICE",
            "NAME" => "Старая цена",
            "TYPE" => "STRING",
            "DEFAULT" => "35 000 р",
        ],
        "PRICE_NEW" => [
            "PARENT" => "PRICE",
            "NAME" => "Новая цена (число)",
            "TYPE" => "STRING",
            "DEFAULT" => "0",
        ],
        "PRICE_CURRENCY" => [
            "PARENT" => "PRICE",
            "NAME" => "Валюта",
            "TYPE" => "STRING",
            "DEFAULT" => "рублей",
        ],
        "PRICE_NOTE" => [
            "PARENT" => "PRICE",
            "NAME" => "Примечание к цене",
            "TYPE" => "STRING",
            "DEFAULT" => "*входит в счет приобретения\nгодовой лицензии черзе нас",
        ],
        "CARD_1_TEXT" => [
            "PARENT" => "CARD_1",
            "NAME" => "Карточка 1 - Текст",
            "TYPE" => "STRING",
            "DEFAULT" => "90% клиентов получили одобрение благодаря высокому уровню работы наших экспертов",
        ],
        "CARD_1_NUMBER" => [
            "PARENT" => "CARD_1",
            "NAME" => "Карточка 1 - Число",
            "TYPE" => "STRING",
            "DEFAULT" => "20+",
        ],
        "CARD_1_LABEL" => [
            "PARENT" => "CARD_1",
            "NAME" => "Карточка 1 - Подпись",
            "TYPE" => "STRING",
            "DEFAULT" => "установок",
        ],
        "CARD_2_TEXT" => [
            "PARENT" => "CARD_2",
            "NAME" => "Карточка 2 - Текст",
            "TYPE" => "STRING",
            "DEFAULT" => "Мы создали инструмент, который поможет вам быстро определить первые",
        ],
        "CARD_2_PREFIX" => [
            "PARENT" => "CARD_2",
            "NAME" => "Карточка 2 - Префикс (до)",
            "TYPE" => "STRING",
            "DEFAULT" => "до",
        ],
        "CARD_2_NUMBER" => [
            "PARENT" => "CARD_2",
            "NAME" => "Карточка 2 - Число",
            "TYPE" => "STRING",
            "DEFAULT" => "7",
        ],
        "CARD_2_LABEL" => [
            "PARENT" => "CARD_2",
            "NAME" => "Карточка 2 - Подпись",
            "TYPE" => "STRING",
            "DEFAULT" => "дней",
        ],
        "CARD_3_TEXT" => [
            "PARENT" => "CARD_3",
            "NAME" => "Карточка 3 - Текст",
            "TYPE" => "STRING",
            "DEFAULT" => "Наши эксперты всегда на связи в чате и зуме.",
        ],
        "CARD_3_PREFIX" => [
            "PARENT" => "CARD_3",
            "NAME" => "Карточка 3 - Префикс (от)",
            "TYPE" => "STRING",
            "DEFAULT" => "от",
        ],
        "CARD_3_NUMBER" => [
            "PARENT" => "CARD_3",
            "NAME" => "Карточка 3 - Число",
            "TYPE" => "STRING",
            "DEFAULT" => "150",
        ],
        "CARD_3_LABEL" => [
            "PARENT" => "CARD_3",
            "NAME" => "Карточка 3 - Подпись",
            "TYPE" => "STRING",
            "DEFAULT" => "т.р",
        ],
        "BUTTON_1_TEXT" => [
            "PARENT" => "ACTIONS",
            "NAME" => "Кнопка 1 - Текст",
            "TYPE" => "STRING",
            "DEFAULT" => "заказать внедрение",
        ],
        "BUTTON_1_LINK" => [
            "PARENT" => "ACTIONS",
            "NAME" => "Кнопка 1 - Ссылка",
            "TYPE" => "STRING",
            "DEFAULT" => "#",
        ],
        "BUTTON_1_CURSOR" => [
            "PARENT" => "ACTIONS",
            "NAME" => "Кнопка 1 - Текст курсора",
            "TYPE" => "STRING",
            "DEFAULT" => "Перейти",
        ],
        "BUTTON_2_TEXT" => [
            "PARENT" => "ACTIONS",
            "NAME" => "Кнопка 2 - Текст",
            "TYPE" => "STRING",
            "DEFAULT" => "Попробовать 7 дней бесплатно",
        ],
        "BUTTON_2_LINK" => [
            "PARENT" => "ACTIONS",
            "NAME" => "Кнопка 2 - Ссылка",
            "TYPE" => "STRING",
            "DEFAULT" => "#",
        ],
        "CACHE_TIME" => [
            "DEFAULT" => 3600,
        ],
    ],
    "GROUPS" => [
        "PRICE" => [
            "NAME" => "Цена"
        ],
        "CARD_1" => [
            "NAME" => "Карточка 1"
        ],
        "CARD_2" => [
            "NAME" => "Карточка 2"
        ],
        "CARD_3" => [
            "NAME" => "Карточка 3"
        ],
        "ACTIONS" => [
            "NAME" => "Кнопки действий"
        ],
    ]
];
?>
