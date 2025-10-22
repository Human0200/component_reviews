<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = [
    "PARAMETERS" => [
        "TAGLINE_TOP" => [
            "PARENT" => "BASE",
            "NAME" => "Верхний слоган",
            "TYPE" => "STRING",
            "DEFAULT" => "купите лицензию через нас — и получите",
        ],
        "TAGLINE_BOTTOM" => [
            "PARENT" => "BASE",
            "NAME" => "Нижний слоган",
            "TYPE" => "STRING",
            "DEFAULT" => "больше, чем просто доступ к Битрикс24",
        ],
        "ITEM_1" => [
            "PARENT" => "ITEMS",
            "NAME" => "Пункт 1",
            "TYPE" => "STRING",
            "DEFAULT" => "1. Бесплатную службу поддержки на весь срок действия лицензии.",
        ],
        "ITEM_2" => [
            "PARENT" => "ITEMS",
            "NAME" => "Пункт 2",
            "TYPE" => "STRING",
            "DEFAULT" => "2. Часы обучения для пользователей при покупке лицензии на год.",
        ],
        "ITEM_3" => [
            "PARENT" => "ITEMS",
            "NAME" => "Пункт 3",
            "TYPE" => "STRING",
            "DEFAULT" => "3. Быстрое подключение лицензии. Мы активируем лицензию в тот же день!",
        ],
        "ITEM_4" => [
            "PARENT" => "ITEMS",
            "NAME" => "Пункт 4",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "ITEM_5" => [
            "PARENT" => "ITEMS",
            "NAME" => "Пункт 5",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "CACHE_TIME" => [
            "DEFAULT" => 3600,
        ],
    ],
    "GROUPS" => [
        "ITEMS" => [
            "NAME" => "Список преимуществ"
        ],
    ]
];
?>