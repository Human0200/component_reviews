<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = [
    "PARAMETERS" => [
        "TITLE" => [
            "PARENT" => "BASE",
            "NAME" => "Заголовок секции",
            "TYPE" => "STRING",
            "DEFAULT" => "Цели проекта",
        ],
        "CACHE_TIME" => [
            "DEFAULT" => 3600,
        ],
    ],
    "GROUPS" => []
];

// Генерируем параметры для 3 целей через цикл
for($i = 1; $i <= 3; $i++) {
    $groupName = "TARGET_".$i;
    
    // Создаем группу
    $arComponentParameters["GROUPS"][$groupName] = [
        "NAME" => "Цель ".$i
    ];
    
    // Параметры цели
    $arComponentParameters["PARAMETERS"]["TARGET_".$i."_TITLE"] = [
        "PARENT" => $groupName,
        "NAME" => "Название цели",
        "TYPE" => "STRING",
        "DEFAULT" => "",
    ];
    
    $arComponentParameters["PARAMETERS"]["TARGET_".$i."_TEXT"] = [
        "PARENT" => $groupName,
        "NAME" => "Описание цели",
        "TYPE" => "STRING",
        "DEFAULT" => "",
    ];
}