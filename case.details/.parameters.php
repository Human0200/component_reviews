<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = [
    "PARAMETERS" => [
        "BG_IMAGE" => [
            "PARENT" => "BASE",
            "NAME" => "Фоновое изображение (URL)",
            "TYPE" => "STRING",
            "DEFAULT" => "",
            
        ],
        "MARK_TEXT" => [
            "PARENT" => "BASE",
            "NAME" => "Текст метки",
            "TYPE" => "STRING",
            "DEFAULT" => "компания",
        ],
        
        // Блок 1 - О клиенте
        "BLOCK_1_TITLE" => [
            "PARENT" => "BLOCK_1",
            "NAME" => "Заголовок",
            "TYPE" => "STRING",
            "DEFAULT" => "О клиенте",
        ],
        "BLOCK_1_TEXT" => [
            "PARENT" => "BLOCK_1",
            "NAME" => "Текст",
            "TYPE" => "TEXTAREA",
            "DEFAULT" => "",
            "ROWS" => 2,
        ],
        "BLOCK_1_CLIENT_NAME" => [
            "PARENT" => "BLOCK_1",
            "NAME" => "Название клиента",
            "TYPE" => "STRING",
            "DEFAULT" => "ВизорМОНИТОР",
        ],
        "BLOCK_1_CLIENT_LINK" => [
            "PARENT" => "BLOCK_1",
            "NAME" => "Ссылка на сайт клиента",
            "TYPE" => "STRING",
            "DEFAULT" => "#",
        ],
        
        // Блок 2 - Задачи клиента
        "BLOCK_2_TITLE" => [
            "PARENT" => "BLOCK_2",
            "NAME" => "Заголовок",
            "TYPE" => "STRING",
            "DEFAULT" => "задачи клиента",
        ],
        "BLOCK_2_TEXT" => [
            "PARENT" => "BLOCK_2",
            "NAME" => "Текст",
            "TYPE" => "TEXTAREA",
            "DEFAULT" => "",
            "ROWS" => 2,
        ],
        
        "CACHE_TIME" => [
            "DEFAULT" => 3600,
        ],
    ],
    "GROUPS" => [
        "BLOCK_1" => [
            "NAME" => "Блок 1 - О клиенте"
        ],
        "BLOCK_2" => [
            "NAME" => "Блок 2 - Задачи клиента"
        ],
    ]
];
?>