<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Подключаем модули
CModule::IncludeModule('iblock');
CModule::IncludeModule('main');

// Обработка параметров
$arParams['PRODUCT_ID'] = intval($arParams['PRODUCT_ID']);
$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
$arParams['IBLOCK_TYPE'] = trim($arParams['IBLOCK_TYPE']) ?: 'reviews';
$arParams['BUTTON_TEXT'] = trim($arParams['BUTTON_TEXT']) ?: 'Написать отзыв';
$arParams['BUTTON_COLOR'] = trim($arParams['BUTTON_COLOR']) ?: '#BF1E77';

// Проверка авторизации пользователя
global $USER;
$arResult['IS_AUTHORIZED'] = $USER->IsAuthorized();
$arResult['CURRENT_USER_ID'] = $USER->GetID();
$arResult['CURRENT_USER_NAME'] = $USER->GetFullName();

// Если пользователь авторизован, получаем дополнительные данные
if ($arResult['IS_AUTHORIZED']) {
    $user = CUser::GetByID($arResult['CURRENT_USER_ID'])->Fetch();
    $arResult['CURRENT_USER_EMAIL'] = $user['EMAIL'];
    $arResult['CURRENT_USER_LOGIN'] = $user['LOGIN'];
}

// Функция получения ID значения для свойства USER_TYPE
function getUserTypeValue($isAuthorized) {
    if ($isAuthorized) {
        return 669; // ID для "Авторизованный"
    } else {
        return 670; // ID для "Гость"
    }
}

// Функция обработки формы
function processReviewForm(&$arParams, &$arResult) {
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
    if (!$arResult['IS_AUTHORIZED']) {
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
            "IBLOCK_ID"      => $arParams['IBLOCK_ID'],
            "NAME"           => "Отзыв о товаре " . $arParams['PRODUCT_ID'],
            "ACTIVE"         => "Y",
            "PREVIEW_TEXT"   => $fields['TEXT'],
        ];
        
        // Добавляем свойства - ВАЖНО: для списков используем ENUM_ID
        $propertyValues = [
            "PRODUCT_ID" => $arParams['PRODUCT_ID'],
            "RATING" => $fields['RATING'],
            "USER_TYPE" => getUserTypeValue($arResult['IS_AUTHORIZED']), // ID значения из списка
        ];
        
        if ($arResult['IS_AUTHORIZED']) {
            $propertyValues["USER_ID"] = $arResult['CURRENT_USER_ID'];
        } else {
            $propertyValues["GUEST_EMAIL"] = $fields['GUEST_EMAIL'];
        }
        
        $arLoadProductArray["PROPERTY_VALUES"] = $propertyValues;
        
        if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
            $arResult['SUCCESS_MESSAGE'] = 'Отзыв успешно добавлен!';
            // Очищаем POST чтобы форма не показывала введенные данные
            unset($_POST);
        } else {
            $errors[] = 'Ошибка при сохранении отзыва: ' . $el->LAST_ERROR;
        }
    }
    
    if (!empty($errors)) {
        $arResult['ERRORS'] = $errors;
    }
}

// Обработка отправки формы
if ($_POST['submit_review'] && check_bitrix_sessid()) {
    processReviewForm($arParams, $arResult);
}

// Передаем параметры в шаблон
$arResult['BUTTON_COLOR'] = $arParams['BUTTON_COLOR'];
$arResult['BUTTON_TEXT'] = $arParams['BUTTON_TEXT'];
$arResult['PRODUCT_ID'] = $arParams['PRODUCT_ID'];

$this->IncludeComponentTemplate();
?>