<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule('iblock');

// Обработка параметров
$arParams['MARK_TEXT'] = trim($arParams['MARK_TEXT']) ?: 'Мы не просто продаем — мы помогаем вам использовать Битрикс24';
$arParams['MARK_HIGHLIGHT'] = trim($arParams['MARK_HIGHLIGHT']) ?: 'на полную мощность';
$arParams['TITLE'] = trim($arParams['TITLE']) ?: 'Лицензии Битрикс24';
$arParams['CAPTION'] = trim($arParams['CAPTION']) ?: 'В соответствии с политикой 1С-Битрикс24 мы не продаем лицензии выше или ниже установленных цен';
$arParams['FOOTER_TEXT'] = trim($arParams['FOOTER_TEXT']) ?: 'В таблице цены со скидкой 50% для тех, кто покупает подписку впервые';

$arParams['IBLOCK_ID_CLOUD'] = intval($arParams['IBLOCK_ID_CLOUD']);
$arParams['IBLOCK_ID_BOXED'] = intval($arParams['IBLOCK_ID_BOXED']);
$arParams['IBLOCK_ID_SUBSCRIPTION'] = intval($arParams['IBLOCK_ID_SUBSCRIPTION']);
$arParams['CACHE_TIME'] = intval($arParams['CACHE_TIME']) ?: 3600;

// Кеширование
$cache = new CPHPCache();
$cache_id = 'bitrix24_licenses_'.md5(serialize($arParams));
$cache_path = '/bitrix24/licenses/';

if($arParams['CACHE_TIME'] > 0 && $cache->InitCache($arParams['CACHE_TIME'], $cache_id, $cache_path)) {
    $arResult = $cache->GetVars();
} elseif($cache->StartDataCache()) {
    
    // Передаем текстовые параметры
    $arResult['MARK_TEXT'] = $arParams['MARK_TEXT'];
    $arResult['MARK_HIGHLIGHT'] = $arParams['MARK_HIGHLIGHT'];
    $arResult['TITLE'] = $arParams['TITLE'];
    $arResult['CAPTION'] = $arParams['CAPTION'];
    $arResult['FOOTER_TEXT'] = $arParams['FOOTER_TEXT'];
    
    // Функция для получения лицензий из инфоблока
    function getLicenses($iblockId) {
        if(!$iblockId) return [];
        
        $arSelect = [
            'ID',
            'NAME',
            'PROPERTY_DESCRIPTION',
            'PROPERTY_EMPLOYEES',
            'PROPERTY_PRICE_MONTH',
            'PROPERTY_PRICE_YEAR',
            'PROPERTY_DISCOUNT',
            'PROPERTY_FEATURES',
            'PROPERTY_FEATURES_DISABLED',
            'PROPERTY_TYPE'
        ];
        
        $arFilter = [
            'IBLOCK_ID' => $iblockId,
            'ACTIVE' => 'Y'
        ];
        
        $dbElements = CIBlockElement::GetList(
            ['SORT' => 'ASC', 'NAME' => 'ASC'],
            $arFilter,
            false,
            false,
            $arSelect
        );
        
        $items = [];
        while($element = $dbElements->GetNextElement()) {
            $arFields = $element->GetFields();
            $arProps = $element->GetProperties();
            
            // Рассчитываем цену со скидкой
            $priceMonth = floatval($arProps['PRICE_MONTH']['VALUE']);
            $priceYear = floatval($arProps['PRICE_YEAR']['VALUE']);
            $discount = intval($arProps['DISCOUNT']['VALUE']);
            
            $priceYearDiscounted = $priceYear;
            if($discount > 0) {
                $priceYearDiscounted = $priceYear * (1 - $discount / 100);
            }
            
            // Обработка списка функций
            $features = [];
            if(is_array($arProps['FEATURES']['VALUE'])) {
                $features = $arProps['FEATURES']['VALUE'];
            }
            
            $featuresDisabled = [];
            if(is_array($arProps['FEATURES_DISABLED']['VALUE'])) {
                $featuresDisabled = $arProps['FEATURES_DISABLED']['VALUE'];
            }
            
            $items[] = [
                'ID' => $arFields['ID'],
                'NAME' => $arFields['NAME'],
                'DESCRIPTION' => $arProps['DESCRIPTION']['VALUE'],
                'EMPLOYEES' => $arProps['EMPLOYEES']['VALUE'],
                'PRICE_MONTH' => $priceMonth,
                'PRICE_YEAR' => $priceYear,
                'PRICE_YEAR_DISCOUNTED' => $priceYearDiscounted,
                'DISCOUNT' => $discount,
                'FEATURES' => $features,
                'FEATURES_DISABLED' => $featuresDisabled,
                'TYPE' => $arProps['TYPE']['VALUE']
            ];
        }
        
        return $items;
    }
    
    // Получаем облачные лицензии
    $arResult['CLOUD_LICENSES'] = getLicenses($arParams['IBLOCK_ID_CLOUD']);
    
    // Получаем коробочные лицензии
    $arResult['BOXED_LICENSES'] = getLicenses($arParams['IBLOCK_ID_BOXED']);
    
    // Получаем подписки
    $arResult['SUBSCRIPTIONS'] = getLicenses($arParams['IBLOCK_ID_SUBSCRIPTION']);
    
    $cache->EndDataCache($arResult);
}

// Подключаем шаблон
$this->IncludeComponentTemplate();
?>