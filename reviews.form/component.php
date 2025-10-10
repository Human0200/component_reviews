<?php
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
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
$arParams['CHECK_DUPLICATE'] = $arParams['CHECK_DUPLICATE'] !== 'N' ? 'Y' : 'N';
$arParams['CHECK_TIME_LIMIT'] = $arParams['CHECK_TIME_LIMIT'] !== 'N' ? 'Y' : 'N';
$arParams['TIME_LIMIT_MINUTES'] = intval($arParams['TIME_LIMIT_MINUTES']) ?: 5;

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

// Функция проверки существующих отзывов
function checkExistingReview(&$arParams, &$arResult, $guestEmail = null) {
    $filter = [
        "IBLOCK_ID" => $arParams['IBLOCK_ID'],
        "ACTIVE" => "Y",
        "PROPERTY_PRODUCT_ID" => $arParams['PRODUCT_ID'],
    ];
    
    // Для авторизованных пользователей проверяем по USER_ID
    if ($arResult['IS_AUTHORIZED']) {
        $filter["PROPERTY_USER_ID"] = $arResult['CURRENT_USER_ID'];
    } else {
        // Для гостей проверяем по email
        $filter["PROPERTY_GUEST_EMAIL"] = $guestEmail;
    }
    
    $res = CIBlockElement::GetList(
        [],
        $filter,
        false,
        false,
        ["ID", "DATE_CREATE"]
    );
    
    if ($review = $res->Fetch()) {
        return [
            'exists' => true,
            'review_id' => $review['ID'],
            'date' => $review['DATE_CREATE']
        ];
    }
    
    return ['exists' => false];
}

// Функция проверки временного интервала (защита от частых отзывов)
function checkReviewTimeLimit(&$arParams, &$arResult, $guestEmail = null) {
    $timeLimit = 300; // 5 минут между отзывами (можно настроить)
    
    $filter = [
        "IBLOCK_ID" => $arParams['IBLOCK_ID'],
        "ACTIVE" => "Y",
        ">=DATE_CREATE" => ConvertTimeStamp(time() - $timeLimit, "FULL")
    ];
    
    // Фильтр по пользователю
    if ($arResult['IS_AUTHORIZED']) {
        $filter["PROPERTY_USER_ID"] = $arResult['CURRENT_USER_ID'];
    } else {
        $filter["PROPERTY_GUEST_EMAIL"] = $guestEmail;
    }
    
    $res = CIBlockElement::GetList(
        ["DATE_CREATE" => "DESC"],
        $filter,
        false,
        false,
        ["ID", "DATE_CREATE"]
    );
    
    if ($recent = $res->Fetch()) {
        $timePassed = time() - MakeTimeStamp($recent['DATE_CREATE']);
        $timeLeft = ceil(($timeLimit - $timePassed) / 60);
        return [
            'too_soon' => true,
            'minutes_left' => $timeLeft
        ];
    }
    
    return ['too_soon' => false];
}

// Функция обработки формы
function processReviewForm(&$arParams, &$arResult) {
    global $USER, $APPLICATION;
    
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
    
    // Проверка на существующий отзыв к этому товару
    if (empty($errors)) {
        $existingCheck = checkExistingReview(
            $arParams, 
            $arResult, 
            $fields['GUEST_EMAIL'] ?? null
        );
        
        if ($existingCheck['exists']) {
            $errors[] = 'Вы уже оставили отзыв на этот товар';
        }
    }
    
    // Проверка на частоту отзывов (защита от спама)
    if (empty($errors)) {
        $timeCheck = checkReviewTimeLimit(
            $arParams, 
            $arResult, 
            $fields['GUEST_EMAIL'] ?? null
        );
        
        if ($timeCheck['too_soon']) {
            $errors[] = 'Пожалуйста, подождите ' . $timeCheck['minutes_left'] . 
                       ' мин. перед отправкой следующего отзыва';
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
            // Сбрасываем кеш инфоблока
            if (defined('BX_COMP_MANAGED_CACHE')) {
                $GLOBALS["CACHE_MANAGER"]->ClearByTag("iblock_id_" . $arParams['IBLOCK_ID']);
            }
            
            $arResult['SUCCESS_MESSAGE'] = 'Отзыв успешно добавлен!';
            return true;
        } else {
            $errors[] = 'Ошибка при сохранении отзыва: ' . $el->LAST_ERROR;
        }
    }
    
    if (!empty($errors)) {
        $arResult['ERRORS'] = $errors;
    }
    
    return false;
}

// Обработка отправки формы
if ($_POST['submit_review'] && check_bitrix_sessid()) {
    
    // Обрабатываем форму
    $success = processReviewForm($arParams, $arResult);
    
    // Если это AJAX запрос, выводим JSON ответ и завершаем выполнение
    if ($_POST['ajax'] === 'Y' || $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
        
        // Логируем для отладки
        AddMessage2Log("AJAX review form submission. Success: " . ($success ? 'true' : 'false'), "review_form");
        
        if ($success) {
            // Успешная отправка
            echo '<div class="success">';
            echo '<p>' . htmlspecialchars($arResult['SUCCESS_MESSAGE']) . '</p>';
            echo '</div>';
        } elseif (!empty($arResult['ERRORS'])) {
            // Есть ошибки
            echo '<div class="errors">';
            foreach ($arResult['ERRORS'] as $error) {
                echo '<p>' . htmlspecialchars($error) . '</p>';
            }
            echo '</div>';
            
            // Логируем ошибки
            AddMessage2Log("Review form errors: " . implode(", ", $arResult['ERRORS']), "review_form");
        } else {
            // Неизвестная ошибка
            echo '<div class="errors"><p>Произошла неизвестная ошибка</p></div>';
            AddMessage2Log("Review form unknown error", "review_form");
        }
        
        // Завершаем выполнение для AJAX
        CMain::FinalActions();
        die();
    } else {
        // Обычная отправка формы (не AJAX) - редирект
        if ($success) {
            LocalRedirect($APPLICATION->GetCurPageParam("review_success=Y", ["review_success"]));
        }
    }
}

// Проверка успешного добавления после редиректа (для не-AJAX)
if ($_GET['review_success'] === 'Y') {
    $arResult['SUCCESS_MESSAGE'] = 'Отзыв успешно добавлен!';
}

// Передаем параметры в шаблон
$arResult['BUTTON_COLOR'] = $arParams['BUTTON_COLOR'];
$arResult['BUTTON_TEXT'] = $arParams['BUTTON_TEXT'];
$arResult['PRODUCT_ID'] = $arParams['PRODUCT_ID'];

$this->IncludeComponentTemplate();
?>