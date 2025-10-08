<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule('iblock');


$arParams['PRODUCT_ID'] = intval($arParams['PRODUCT_ID']);
$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
$arParams['IBLOCK_CODE'] = trim($arParams['IBLOCK_CODE']);
$arParams['IBLOCK_TYPE'] = trim($arParams['IBLOCK_TYPE']);
$arParams['SORT_ORDER'] = in_array($arParams['SORT_ORDER'], ['ASC', 'DESC']) ? $arParams['SORT_ORDER'] : 'DESC';
$arParams['PAGE_SIZE'] = intval($arParams['PAGE_SIZE']) ?: 10;
$arParams['SHOW_GUEST_NAME'] = trim($arParams['SHOW_GUEST_NAME']) ?: 'Гость';
$arParams['DATE_FORMAT'] = trim($arParams['DATE_FORMAT']) ?: 'd.m.Y';
$arParams['CACHE_TIME'] = intval($arParams['CACHE_TIME']) ?: 3600;

// Функция получения ID инфоблока
function getIblockId($arParams) {
    if($arParams['IBLOCK_ID'] > 0) {
        return $arParams['IBLOCK_ID'];
    }
    
    $filter = ['ACTIVE' => 'Y'];
    
    if($arParams['IBLOCK_CODE']) {
        $filter['CODE'] = $arParams['IBLOCK_CODE'];
    }
    
    if($arParams['IBLOCK_TYPE']) {
        $filter['TYPE'] = $arParams['IBLOCK_TYPE'];
    }
    
    $iblock = CIBlock::GetList([], $filter)->Fetch();
    
    return $iblock ? $iblock['ID'] : 0;
}

// Получаем ID инфоблока
$arResult['IBLOCK_ID'] = getIblockId($arParams);

if(!$arResult['IBLOCK_ID']) {
    ShowError('Инфоблок отзывов не найден');
    return;
}

if($arParams['PRODUCT_ID'] <= 0) {
    ShowError('Не указан ID товара');
    return;
}

// Кеширование
$cache = new CPHPCache();
$cache_id = 'reviews_list_'.$arParams['PRODUCT_ID'].'_'.$arParams['PAGE_SIZE'];
$cache_path = '/reviews/list/';

if($arParams['CACHE_TIME'] > 0 && $cache->InitCache($arParams['CACHE_TIME'], $cache_id, $cache_path)) {
    $arResult = $cache->GetVars();
} elseif($cache->StartDataCache()) {
    
  
    $filter = [
        'IBLOCK_ID' => $arResult['IBLOCK_ID'],
        'ACTIVE' => 'Y'
    ];
    

    $filter['PROPERTY_PRODUCT_ID'] = $arParams['PRODUCT_ID'];
    

    $arResult['TOTAL_COUNT'] = CIBlockElement::GetList(
        [],
        $filter,
        []
    );
    
    // Получаем отзывы
    $arSelect = [
        'ID',
        'NAME',
        'DATE_CREATE',
        'PREVIEW_TEXT',
        'PROPERTY_USER_ID',
        'PROPERTY_USER_TYPE', 
        'PROPERTY_GUEST_EMAIL',
        'PROPERTY_RATING'
    ];
    
    $arNavParams = false;
    if($arParams['PAGE_SIZE'] > 0) {
        $arNavParams = ['nTopCount' => $arParams['PAGE_SIZE']];
    }
    
    $dbReviews = CIBlockElement::GetList(
        ['DATE_CREATE' => $arParams['SORT_ORDER']],
        $filter,
        false,
        $arNavParams,
        $arSelect
    );
    
    $arResult['REVIEWS'] = [];
    
    while($review = $dbReviews->GetNext()) {
        $userName = $arParams['SHOW_GUEST_NAME'];
        
        if (isset($review['PROPERTY_USER_TYPE_VALUE']) && $review['PROPERTY_USER_TYPE_VALUE'] == 'Авторизованный') {
            if (isset($review['PROPERTY_USER_ID_VALUE']) && $review['PROPERTY_USER_ID_VALUE']) {
                $user = CUser::GetByID($review['PROPERTY_USER_ID_VALUE'])->Fetch();
                if($user) {
                    $userName = $user['NAME'] ?: $user['LOGIN'] ?: $user['EMAIL'];
                }
            }
        } elseif (isset($review['PROPERTY_GUEST_EMAIL_VALUE']) && $review['PROPERTY_GUEST_EMAIL_VALUE']) {
            $userName = $arParams['SHOW_GUEST_NAME'];
        }
        
        $arResult['REVIEWS'][] = [
            'ID' => $review['ID'],
            'USER_NAME' => $userName,
            'TEXT' => $review['PREVIEW_TEXT'],
            'DATE' => $review['DATE_CREATE'],
            'DATE_FORMATTED' => FormatDate($arParams['DATE_FORMAT'], MakeTimeStamp($review['DATE_CREATE'])),
            'RATING' => $review['PROPERTY_RATING_VALUE'] ?? null
        ];
    }
    
    $cache->EndDataCache($arResult);
}


$this->IncludeComponentTemplate();
?>