<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class ReviewsFormComponent extends CBitrixComponent
{
    public function executeComponent()
    {
        // Подключаем модули
        CModule::IncludeModule('iblock');
        CModule::IncludeModule('main');

        // Обработка параметров
        $this->arParams['PRODUCT_ID'] = intval($this->arParams['PRODUCT_ID']);
        $this->arParams['IBLOCK_ID'] = intval($this->arParams['IBLOCK_ID']);
        $this->arParams['IBLOCK_TYPE'] = trim($this->arParams['IBLOCK_TYPE']) ?: 'reviews';
        $this->arParams['BUTTON_TEXT'] = trim($this->arParams['BUTTON_TEXT']) ?: 'Написать отзыв';
        $this->arParams['BUTTON_COLOR'] = trim($this->arParams['BUTTON_COLOR']) ?: '#BF1E77';

        // Проверка авторизации пользователя
        global $USER;
        $this->arResult['IS_AUTHORIZED'] = $USER->IsAuthorized();
        $this->arResult['CURRENT_USER_ID'] = $USER->GetID();
        $this->arResult['CURRENT_USER_NAME'] = $USER->GetFullName();

        // Если пользователь авторизован, получаем дополнительные данные
        if ($this->arResult['IS_AUTHORIZED']) {
            $user = CUser::GetByID($this->arResult['CURRENT_USER_ID'])->Fetch();
            $this->arResult['CURRENT_USER_EMAIL'] = $user['EMAIL'];
            $this->arResult['CURRENT_USER_LOGIN'] = $user['LOGIN'];
        }

        // Обработка отправки формы
        if ($_POST['submit_review'] && check_bitrix_sessid()) {
            $this->processForm();
        }

        // Передаем параметры в шаблон
        $this->arResult['BUTTON_COLOR'] = $this->arParams['BUTTON_COLOR'];
        $this->arResult['BUTTON_TEXT'] = $this->arParams['BUTTON_TEXT'];
        $this->arResult['PRODUCT_ID'] = $this->arParams['PRODUCT_ID'];

        $this->IncludeComponentTemplate();
    }

    // Функция обработки формы
    private function processForm()
    {
        global $USER;
        
        $errors = [];
        $fields = [];
        
        // Валидация данных
        $fields['RATING'] = intval($_POST['rating']);
        if ($fields['RATING'] < 1 || $fields['RATING'] > 5) {
            $errors[] = 'Укажите рейтинг от 1 до 5';
        }
        
        $fields['TEXT'] = trim($_POST['review_text']);
        if (empty($fields['TEXT'])) {
            $errors[] = 'Введите текст отзыва';
        }
        
        // Для неавторизованных пользователей проверяем email
        if (!$this->arResult['IS_AUTHORIZED']) {
            $fields['GUEST_EMAIL'] = trim($_POST['guest_email']);
            if (empty($fields['GUEST_EMAIL']) || !check_email($fields['GUEST_EMAIL'])) {
                $errors[] = 'Введите корректный email';
            }
        }
        
        // Если нет ошибок, сохраняем отзыв
        if (empty($errors)) {
            $el = new CIBlockElement;
            
            $arLoadProductArray = [
                "MODIFIED_BY"    => $USER->GetID(),
                "IBLOCK_ID"      => $this->arParams['IBLOCK_ID'],
                "NAME"           => "Отзыв о товаре " . $this->arParams['PRODUCT_ID'],
                "ACTIVE"         => "Y",
                "PREVIEW_TEXT"   => $fields['TEXT'],
            ];
            
            // Добавляем свойства
            $propertyValues = [
                "PRODUCT_ID" => $this->arParams['PRODUCT_ID'],
                "RATING" => $fields['RATING'],
            ];
            
            if ($this->arResult['IS_AUTHORIZED']) {
                $propertyValues["USER_TYPE"] = "Авторизованный";
                $propertyValues["USER_ID"] = $this->arResult['CURRENT_USER_ID'];
            } else {
                $propertyValues["USER_TYPE"] = "Гость";
                $propertyValues["GUEST_EMAIL"] = $fields['GUEST_EMAIL'];
            }
            
            $arLoadProductArray["PROPERTY_VALUES"] = $propertyValues;
            
            if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
                $this->arResult['SUCCESS_MESSAGE'] = 'Отзыв успешно добавлен!';
                // Очищаем POST чтобы форма не показывала введенные данные
                unset($_POST);
            } else {
                $errors[] = 'Ошибка при сохранении отзыва: ' . $el->LAST_ERROR;
            }
        }
        
        if (!empty($errors)) {
            $this->arResult['ERRORS'] = $errors;
        }
    }
}
?>