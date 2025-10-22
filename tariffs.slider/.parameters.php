<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule('iblock');

// Получаем список инфоблоков
$arIBlocks = [];
$dbIBlock = CIBlock::GetList(
    ['SORT' => 'ASC'],
    ['ACTIVE' => 'Y']
);
while($arIBlock = $dbIBlock->Fetch()) {
    $arIBlocks[$arIBlock['ID']] = '['.$arIBlock['ID'].'] '.$arIBlock['NAME'];
}

$arComponentParameters = [
    "PARAMETERS" => [
        "IBLOCK_ID" => [
            "PARENT" => "BASE",
            "NAME" => "Инфоблок",
            "TYPE" => "LIST",
            "VALUES" => $arIBlocks,
            "REFRESH" => "Y",
        ],
        "TITLE" => [
            "PARENT" => "BASE",
            "NAME" => "Заголовок секции",
            "TYPE" => "STRING",
            "DEFAULT" => "Тарифы наших работ",
        ],
        "CACHE_TIME" => [
            "DEFAULT" => 3600,
        ],
    ],
];
?>