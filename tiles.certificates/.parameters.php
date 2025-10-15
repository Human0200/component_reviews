<?php
// components/custom/tiles.certificates/.parameters.php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = [
    "PARAMETERS" => [
        "IMAGE_BACK" => [
            "PARENT" => "BASE",
            "NAME" => "Изображение для обратной стороны (.tiles__card-back)",
            "TYPE" => "STRING",
            "DEFAULT" => "/local/templates/leadspace/assets/images/tiles/cover.webp",
        ],
        "IMAGE_FRONT" => [
            "PARENT" => "BASE",
            "NAME" => "Изображение для лицевой стороны (.tiles__card-front)",
            "TYPE" => "STRING",
            "DEFAULT" => "/local/templates/leadspace/assets/images/tiles/cover.webp",
        ],
        "CACHE_TIME" => [
            "DEFAULT" => 3600,
        ],
    ],
];
?>