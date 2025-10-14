<?php
// components/custom/individual.steps/.parameters.php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = [
    "PARAMETERS" => [
        "IBLOCK_ID" => [
            "PARENT" => "BASE",
            "NAME" => "ID инфоблока шагов внедрения",
            "TYPE" => "STRING",
            "DEFAULT" => "4",
        ],
        "CACHE_TIME" => [
            "DEFAULT" => 3600,
        ],
        "TITLE" => [
            "PARENT" => "BASE",
            "NAME" => "Заголовок",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
    ],
];
