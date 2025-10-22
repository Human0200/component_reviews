<?php
// components/custom/reviews.slider/.parameters.php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule('iblock');

$arIBlocks = [];
$dbIBlock = CIBlock::GetList(['SORT' => 'ASC'], ['ACTIVE' => 'Y']);
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
        "MARK" => [
            "PARENT" => "BASE",
            "NAME" => "Метка",
            "TYPE" => "STRING",
            "DEFAULT" => "отзывы",
        ],
        "TITLE" => [
            "PARENT" => "BASE",
            "NAME" => "Заголовок",
            "TYPE" => "STRING",
            "DEFAULT" => "Отзывы покупателей",
        ],
        "TEXT" => [
            "PARENT" => "BASE",
            "NAME" => "Текст под заголовком",
            "TYPE" => "TEXT",
            "DEFAULT" => "Нашим готовым решением пользуются уже 20 клиентов\nи мы регулярно получаем от них обратную связь.",
        ],
        "CACHE_TIME" => [
            "DEFAULT" => 3600,
        ],
    ],
];
?>