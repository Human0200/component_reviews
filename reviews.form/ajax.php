<?php
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('STOP_STATISTICS', true);

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request method');
}


if (!check_bitrix_sessid()) {
    echo '<div class="errors"><p>Неверная сессия. Обновите страницу.</p></div>';
    die();
}


CModule::IncludeModule('iblock');


$productId = intval($_POST['product_id']);
$iblockId = intval($_POST['iblock_id']);
$checkDuplicate = $_POST['check_duplicate'] === 'Y';
$checkTimeLimit = $_POST['check_time_limit'] === 'Y';
$timeLimitMinutes = intval($_POST['time_limit_minutes']) ?: 5;


if (!$productId || !$iblockId) {
    echo '<div class="errors"><p>Отсутствуют обязательные параметры</p></div>';
    die();
}

global $USER;
$isAuthorized = $USER->IsAuthorized();
$currentUserId = $USER->GetID();

$errors = [];
$success = false;


$rating = intval($_POST['rating']);
if ($rating < 1 || $rating > 5) {
    $errors[] = 'Укажите рейтинг от 1 до 5';
}


$reviewText = trim($_POST['review_text']);
if (empty($reviewText)) {
    $errors[] = 'Введите текст отзыва';
}


$guestEmail = null;
if (!$isAuthorized) {
    $guestEmail = trim($_POST['guest_email']);
    if (empty($guestEmail)) {
        $errors[] = 'Введите email';
    } elseif (!check_email($guestEmail)) {
        $errors[] = 'Введите корректный email';
    }
}


if (empty($errors) && $checkDuplicate) {
    $filter = [
        "IBLOCK_ID" => $iblockId,
        "ACTIVE" => "Y",
        "PROPERTY_PRODUCT_ID" => $productId,
    ];
    
    if ($isAuthorized) {
        $filter["PROPERTY_USER_ID"] = $currentUserId;
    } else {
        $filter["PROPERTY_GUEST_EMAIL"] = $guestEmail;
    }
    
    $res = CIBlockElement::GetList([], $filter, false, false, ["ID"]);
    if ($res->Fetch()) {
        $errors[] = 'Вы уже оставили отзыв на этот товар';
    }
}


if (empty($errors) && $checkTimeLimit) {
    $timeLimit = $timeLimitMinutes * 60;
    
    $filter = [
        "IBLOCK_ID" => $iblockId,
        "ACTIVE" => "Y",
        ">=DATE_CREATE" => ConvertTimeStamp(time() - $timeLimit, "FULL")
    ];
    
    if ($isAuthorized) {
        $filter["PROPERTY_USER_ID"] = $currentUserId;
    } else {
        $filter["PROPERTY_GUEST_EMAIL"] = $guestEmail;
    }
    
    $res = CIBlockElement::GetList(["DATE_CREATE" => "DESC"], $filter, false, false, ["ID", "DATE_CREATE"]);
    
    if ($recent = $res->Fetch()) {
        $timePassed = time() - MakeTimeStamp($recent['DATE_CREATE']);
        $timeLeft = ceil(($timeLimit - $timePassed) / 60);
        $errors[] = 'Пожалуйста, подождите ' . $timeLeft . ' мин. перед отправкой следующего отзыва';
    }
}


if (empty($errors)) {
    $el = new CIBlockElement;
    
    $reviewName = "Отзыв о товаре " . $productId;
    if ($isAuthorized) {
        $reviewName .= " от пользователя #" . $currentUserId;
    } else {
        $reviewName .= " от гостя";
    }
    
    $userTypeValue = $isAuthorized ? 669 : 670;
    
    $arLoadArray = [
        "MODIFIED_BY" => $isAuthorized ? $currentUserId : 1,
        "IBLOCK_ID" => $iblockId,
        "NAME" => $reviewName,
        "ACTIVE" => "N",
        "PREVIEW_TEXT" => $reviewText,
        "PROPERTY_VALUES" => [
            "PRODUCT_ID" => $productId,
            "RATING" => $rating,
            "USER_TYPE" => $userTypeValue,
        ]
    ];
    
    if ($isAuthorized) {
        $arLoadArray["PROPERTY_VALUES"]["USER_ID"] = $currentUserId;
    } else {
        $arLoadArray["PROPERTY_VALUES"]["GUEST_EMAIL"] = $guestEmail;
    }
    
    if ($newId = $el->Add($arLoadArray)) {
        
        if (defined('BX_COMP_MANAGED_CACHE')) {
            $GLOBALS["CACHE_MANAGER"]->ClearByTag("iblock_id_" . $iblockId);
        }
        
        $success = true;
        AddMessage2Log("Review added successfully. ID: " . $newId, "review_form");
    } else {
        $errors[] = 'Ошибка при сохранении: ' . $el->LAST_ERROR;
        AddMessage2Log("Review save error: " . $el->LAST_ERROR, "review_form");
    }
}


header('Content-Type: text/html; charset=UTF-8');

if ($success) {
    echo '<div class="success"><p>Отзыв успешно добавлен!</p></div>';
} elseif (!empty($errors)) {
    echo '<div class="errors">';
    foreach ($errors as $error) {
        echo '<p>' . htmlspecialchars($error) . '</p>';
    }
    echo '</div>';
} else {
    echo '<div class="errors"><p>Произошла неизвестная ошибка</p></div>';
}
?>