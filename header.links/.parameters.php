<?php
// /local/components/custom/header.links/.parameters.php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = [
    "PARAMETERS" => [
        "HLBLOCK_ID" => [
            "PARENT" => "BASE",
            "NAME" => "ID Highload-блока",
            "TYPE" => "STRING",
            "DEFAULT" => "2",
        ],
        "SORT_FIELD" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => "Поле для сортировки",
            "TYPE" => "LIST",
            "VALUES" => [
                "UF_SORT" => "Сортировка",
                "UF_NAME" => "Название",
                "ID" => "ID записи",
            ],
            "DEFAULT" => "UF_SORT",
        ],
        "SORT_ORDER" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => "Направление сортировки",
            "TYPE" => "LIST",
            "VALUES" => [
                "ASC" => "По возрастанию",
                "DESC" => "По убыванию",
            ],
            "DEFAULT" => "ASC",
        ],
        "CACHE_TIME" => [
            "DEFAULT" => 3600,
        ],
    ],
];
?>