<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


$arParams['PRODUCT_ID'] = intval($arParams['PRODUCT_ID']);
$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
$arParams['IBLOCK_TYPE'] = trim($arParams['IBLOCK_TYPE']) ?: 'reviews';
$arParams['BUTTON_TEXT'] = trim($arParams['BUTTON_TEXT']) ?: 'Написать отзыв';
$arParams['BUTTON_COLOR'] = trim($arParams['BUTTON_COLOR']) ?: '#BF1E77';
$arParams['CHECK_DUPLICATE'] = $arParams['CHECK_DUPLICATE'] !== 'N' ? 'Y' : 'N';
$arParams['CHECK_TIME_LIMIT'] = $arParams['CHECK_TIME_LIMIT'] !== 'N' ? 'Y' : 'N';
$arParams['TIME_LIMIT_MINUTES'] = intval($arParams['TIME_LIMIT_MINUTES']) ?: 5;


global $USER;
$arResult['IS_AUTHORIZED'] = $USER->IsAuthorized();
$arResult['CURRENT_USER_ID'] = $USER->GetID();
$arResult['CURRENT_USER_NAME'] = $USER->GetFullName();


if ($arResult['IS_AUTHORIZED']) {
    $user = CUser::GetByID($arResult['CURRENT_USER_ID'])->Fetch();
    $arResult['CURRENT_USER_EMAIL'] = $user['EMAIL'];
    $arResult['CURRENT_USER_LOGIN'] = $user['LOGIN'];
}


$arResult['BUTTON_COLOR'] = $arParams['BUTTON_COLOR'];
$arResult['BUTTON_TEXT'] = $arParams['BUTTON_TEXT'];
$arResult['PRODUCT_ID'] = $arParams['PRODUCT_ID'];

$this->IncludeComponentTemplate();
?>