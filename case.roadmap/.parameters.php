<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = [
    "PARAMETERS" => [
        "MARK_TEXT" => [
            "PARENT" => "BASE",
            "NAME" => "Текст метки",
            "TYPE" => "STRING",
            "DEFAULT" => "Сроки и этапы работы над проектом",
        ],
        "TITLE" => [
            "PARENT" => "BASE",
            "NAME" => "Заголовок",
            "TYPE" => "STRING",
            "DEFAULT" => "Дорожная карта",
        ],
        "TABLE_HEADER_YEAR" => [
            "PARENT" => "BASE",
            "NAME" => "Год в заголовке таблицы",
            "TYPE" => "STRING",
            "DEFAULT" => "2024 год",
        ],
        "CACHE_TIME" => [
            "DEFAULT" => 3600,
        ],
    ],
    "GROUPS" => []
];

// Генерируем параметры для 10 этапов через цикл
for($i = 1; $i <= 10; $i++) {
    $groupName = "STEP_".$i;
    
    // Создаем группу
    $arComponentParameters["GROUPS"][$groupName] = [
        "NAME" => "Этап ".$i
    ];
    
    // Параметры этапа
    $arComponentParameters["PARAMETERS"]["STEP_".$i."_NAME"] = [
        "PARENT" => $groupName,
        "NAME" => "Название этапа",
        "TYPE" => "STRING",
        "DEFAULT" => "",
    ];
    
    $arComponentParameters["PARAMETERS"]["STEP_".$i."_DURATION"] = [
        "PARENT" => $groupName,
        "NAME" => "Срок выполнения",
        "TYPE" => "STRING",
        "DEFAULT" => "",
    ];
}
?>