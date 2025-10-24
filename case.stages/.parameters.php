<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = [
    "PARAMETERS" => [
        "TITLE" => [
            "PARENT" => "BASE",
            "NAME" => "Заголовок секции",
            "TYPE" => "STRING",
            "DEFAULT" => "Этапы внедрения",
        ],
        "CACHE_TIME" => [
            "DEFAULT" => 3600,
        ],
    ],
    "GROUPS" => []
];

// Генерируем параметры для 7 этапов через цикл
for($i = 1; $i <= 7; $i++) {
    $groupName = "STAGE_".$i;
    
    // Создаем группу
    $arComponentParameters["GROUPS"][$groupName] = [
        "NAME" => "Этап ".$i
    ];
    
    // Параметры этапа
    $arComponentParameters["PARAMETERS"]["STAGE_".$i."_TITLE"] = [
        "PARENT" => $groupName,
        "NAME" => "Название этапа",
        "TYPE" => "STRING",
        "DEFAULT" => "",
    ];
    
    $arComponentParameters["PARAMETERS"]["STAGE_".$i."_TEXT"] = [
        "PARENT" => $groupName,
        "NAME" => "Описание (HTML)",
        "TYPE" => "TEXT",
        "DEFAULT" => "",
    ];
    
    $arComponentParameters["PARAMETERS"]["STAGE_".$i."_IMAGE"] = [
        "PARENT" => $groupName,
        "NAME" => "Изображение (URL)",
        "TYPE" => "STRING",
        "DEFAULT" => "",
    ];
}
?>