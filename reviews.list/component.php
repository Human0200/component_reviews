<?php
// components/custom/reviews.list/component.php (упрощенная версия)
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class ReviewsListComponent extends CBitrixComponent
{
    public function onIncludeComponentLang()
    {
        $this->includeComponentLang(basename(__FILE__));
    }
    
    public function onPrepareComponentParams($arParams)
    {
        $arParams['PRODUCT_ID'] = intval($arParams['PRODUCT_ID']);
        $arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
        $arParams['IBLOCK_CODE'] = trim($arParams['IBLOCK_CODE']);
        $arParams['IBLOCK_TYPE'] = trim($arParams['IBLOCK_TYPE']);
        $arParams['SORT_ORDER'] = in_array($arParams['SORT_ORDER'], ['ASC', 'DESC']) ? $arParams['SORT_ORDER'] : 'DESC';
        $arParams['PAGE_SIZE'] = intval($arParams['PAGE_SIZE']) ?: 10;
        $arParams['SHOW_GUEST_NAME'] = trim($arParams['SHOW_GUEST_NAME']) ?: 'Гость';
        $arParams['DATE_FORMAT'] = trim($arParams['DATE_FORMAT']) ?: 'd.m.Y';
        $arParams['CACHE_TIME'] = intval($arParams['CACHE_TIME']) ?: 3600;
        
        return $arParams;
    }
    
    private function getIblockId()
    {
        if($this->arParams['IBLOCK_ID'] > 0) {
            return $this->arParams['IBLOCK_ID'];
        }
        
        $filter = ['ACTIVE' => 'Y'];
        
        if($this->arParams['IBLOCK_CODE']) {
            $filter['CODE'] = $this->arParams['IBLOCK_CODE'];
        }
        
        if($this->arParams['IBLOCK_TYPE']) {
            $filter['TYPE'] = $this->arParams['IBLOCK_TYPE'];
        }
        
        $iblock = CIBlock::GetList([], $filter)->Fetch();
        
        return $iblock ? $iblock['ID'] : 0;
    }
    
    public function executeComponent()
    {
        $this->arResult['IBLOCK_ID'] = $this->getIblockId();
        
        if(!$this->arResult['IBLOCK_ID']) {
            ShowError('Инфоблок отзывов не найден');
            return;
        }
        
        if($this->arParams['PRODUCT_ID'] <= 0) {
            ShowError('Не указан ID товара');
            return;
        }
        
        if($this->startResultCache($this->arParams['CACHE_TIME'], [$this->arParams['PRODUCT_ID'], $this->arParams['PAGE_SIZE']])) {
            $this->getReviews();
            $this->includeComponentTemplate();
        }
    }
    
    private function getReviews()
    {
        $filter = [
            'IBLOCK_ID' => $this->arResult['IBLOCK_ID'],
            'PROPERTY_PRODUCT_ID' => $this->arParams['PRODUCT_ID'],
            'ACTIVE' => 'Y'
        ];
        
        // Простая реализация без сложной навигации
        $dbReviews = CIBlockElement::GetList(
            ['DATE_CREATE' => $this->arParams['SORT_ORDER']],
            $filter,
            false,
            ['nTopCount' => $this->arParams['PAGE_SIZE'] > 0 ? $this->arParams['PAGE_SIZE'] : false],
            [
                'ID', 
                'NAME', 
                'DATE_CREATE', 
                'PREVIEW_TEXT', 
                'PROPERTY_USER_ID', 
                'PROPERTY_USER_TYPE',
                'PROPERTY_RATING'
            ]
        );
        
        $this->arResult['REVIEWS'] = [];
        $this->arResult['TOTAL_COUNT'] = CIBlockElement::GetList([], $filter, []);
        
        while($review = $dbReviews->GetNext()) {
            $this->arResult['REVIEWS'][] = [
                'ID' => $review['ID'],
                'USER_NAME' => $this->getUserName($review),
                'TEXT' => $review['PREVIEW_TEXT'],
                'DATE' => $review['DATE_CREATE'],
                'DATE_FORMATTED' => FormatDate($this->arParams['DATE_FORMAT'], MakeTimeStamp($review['DATE_CREATE'])),
                'RATING' => $review['PROPERTY_RATING_VALUE']
            ];
        }
    }
    
    private function getUserName($review)
    {
        if($review['PROPERTY_USER_TYPE_VALUE'] == 'authorized' && $review['PROPERTY_USER_ID_VALUE']) {
            $user = CUser::GetByID($review['PROPERTY_USER_ID_VALUE'])->Fetch();
            return $user['NAME'] ?: $user['LOGIN'] ?: $user['EMAIL'];
        }
        
        return $this->arParams['SHOW_GUEST_NAME'];
    }
}
?>