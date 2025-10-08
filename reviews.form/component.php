<?php
// components/custom/reviews.form/component.php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class ReviewsFormComponent extends CBitrixComponent
{
    public function executeComponent()
    {
        if($this->request->isPost() && $this->request->getPost('add_review'))
        {
            $this->addReview();
        }
        
        $this->includeComponentTemplate();
    }
    
    private function addReview()
    {
        global $USER;
        
        $fields = [
            'NAME' => 'Отзыв о товаре ' . $this->arParams['PRODUCT_ID'],
            'IBLOCK_ID' => IBLOCK_REVIEWS_ID,
            'PREVIEW_TEXT' => $this->request->getPost('review_text'),
            'ACTIVE' => 'N' // На модерации
        ];
        
        $properties = [
            'PRODUCT_ID' => $this->arParams['PRODUCT_ID'],
            'USER_TYPE' => $USER->IsAuthorized() ? 'authorized' : 'guest'
        ];
        
        if($USER->IsAuthorized())
        {
            $properties['USER_ID'] = $USER->GetID();
        }
        else
        {
            // Для гостей можно добавить дополнительную проверку (капча и т.д.)
            $fields['NAME'] = 'Отзыв гостя о товаре ' . $this->arParams['PRODUCT_ID'];
        }
        
        $el = new CIBlockElement;
        if($el->Add($fields, false, false, $properties))
        {
            $this->arResult['SUCCESS'] = 'Ваш отзыв отправлен на модерацию';
        }
    }
}
?>