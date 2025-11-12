<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = [
    "PARAMETERS" => [
        "MARK" => [
            "PARENT" => "BASE",
            "NAME" => "Метка секции",
            "TYPE" => "STRING",
            "DEFAULT" => "О нас",
            "ROWS" => 3,
        ],
        "TITLE" => [
            "PARENT" => "BASE",
            "NAME" => "Заголовок секции",
            "TYPE" => "TEXTAREA",
            "DEFAULT" => "Начав с одного проекта, мы выросли в команду,",
            "ROWS" => 3,
        ],
        "TEXT" => [
            "PARENT" => "BASE",
            "NAME" => "Подзаголовок секции",
            "TYPE" => "TEXTAREA",
            "DEFAULT" => "которая сопровождает бизнесы на пути к автоматизации.",
            "ROWS" => 3,
        ],
        "CACHE_TIME" => [
            "DEFAULT" => 3600,
        ],
    ],
    "GROUPS" => []
];

// Генерируем параметры для 3 карточек через цикл
for($i = 1; $i <= 3; $i++) {
    $groupName = "CARD_".$i;
    
    // Создаем группу
    $arComponentParameters["GROUPS"][$groupName] = [
        "NAME" => "Карточка ".$i
    ];
    
    // Параметры карточки
    $arComponentParameters["PARAMETERS"]["CARD_".$i."_CORNER_TEXT"] = [
        "PARENT" => $groupName,
        "NAME" => "Текст в углу карточки",
        "TYPE" => "TEXTAREA",
        "DEFAULT" => "",
        "ROWS" => 3,
    ];
    
    $arComponentParameters["PARAMETERS"]["CARD_".$i."_NUMBER"] = [
        "PARENT" => $groupName,
        "NAME" => "Число",
        "TYPE" => "STRING",
        "DEFAULT" => "",
    ];
    
    $arComponentParameters["PARAMETERS"]["CARD_".$i."_SUFFIX"] = [
        "PARENT" => $groupName,
        "NAME" => "Суффикс (лет, +, и т.д.)",
        "TYPE" => "STRING",
        "DEFAULT" => "",
    ];
    
    $arComponentParameters["PARAMETERS"]["CARD_".$i."_TEXT"] = [
        "PARENT" => $groupName,
        "NAME" => "Описание",
        "TYPE" => "STRING",
        "DEFAULT" => "",
    ];
}