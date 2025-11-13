<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

require_once($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/classes/FormAmoCRMHandler.php');

$arParams["TITLE"] = isset($arParams["TITLE"]) ? $arParams["TITLE"] : "Остались вопросы?";
$arParams["BUTTON_TEXT"] = isset($arParams["BUTTON_TEXT"]) ? $arParams["BUTTON_TEXT"] : "Написать";
$arParams["SUCCESS_MESSAGE"] = isset($arParams["SUCCESS_MESSAGE"]) ? $arParams["SUCCESS_MESSAGE"] : "Спасибо! Мы свяжемся с вами в ближайшее время.";

$arResult["FORM_ID"] = "feedback_form_" . rand(1000, 9999);
$arResult["ERRORS"] = [];
$arResult["SUCCESS"] = false;

// Обработка отправки формы
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["feedback_submit"])) {
    
    // Проверка токена безопасности
    if (!check_bitrix_sessid()) {
        $arResult["ERRORS"][] = "Ошибка безопасности. Обновите страницу и попробуйте снова.";
    } else {
        
        $name = trim($_POST["name"] ?? "");
        $phone = trim($_POST["phone"] ?? "");
        $email = trim($_POST["email"] ?? "");
        $message = trim($_POST["message"] ?? "");
        $contactMethod = trim($_POST["contact_method"] ?? "");
        
        // Валидация
        if (empty($name)) {
            $arResult["ERRORS"][] = "Укажите ваше имя";
        }
        
        if (empty($phone) && empty($email)) {
            $arResult["ERRORS"][] = "Укажите телефон или email";
        }
        
        if (empty($message)) {
            $arResult["ERRORS"][] = "Напишите ваш вопрос";
        }
        
        // Если ошибок нет - отправляем в amoCRM
        if (empty($arResult["ERRORS"])) {
            
            $formData = [
                'NAME' => $name,
                'PHONE' => $phone,
                'EMAIL' => $email,
                'MESSAGE' => $message,
                'CONTACT_METHOD' => $contactMethod,
                'PAGE_URL' => $_SERVER['HTTP_REFERER'] ?? $_SERVER['REQUEST_URI'],
            ];
            
            $leadData = [
                'lead' => [
                    'name' => 'Вопрос от ' . $name,
                    'responsible_user_id' => FormAmoCRMHandler::RESPONSIBLE_USER_ID,
                    'pipeline_id' => FormAmoCRMHandler::PIPELINE_ID,
                    'status_id' => FormAmoCRMHandler::STATUS_ID,
                    'created_at' => time(),
                ],
                'contact' => [],
                'notes' => []
            ];
            
            // Контакт
            if (!empty($name)) {
                $leadData['contact']['name'] = $name;
            }
            
            if (!empty($phone)) {
                $leadData['contact']['custom_fields_values'][] = [
                    'field_code' => 'PHONE',
                    'values' => [['value' => $phone, 'enum_code' => 'WORK']]
                ];
            }
            
            if (!empty($email)) {
                $leadData['contact']['custom_fields_values'][] = [
                    'field_code' => 'EMAIL',
                    'values' => [['value' => $email, 'enum_code' => 'WORK']]
                ];
            }
            
            // Примечания
            $leadData['notes'][] = '📋 Форма: Вопрос с сайта (компонент)';
            $leadData['notes'][] = 'Дата: ' . date('d.m.Y H:i:s');
            $leadData['notes'][] = 'Страница: ' . $formData['PAGE_URL'];
            
            if (!empty($contactMethod)) {
                $contactMethodLabel = FormAmoCRMHandler::CONTACT_METHOD_LABELS[$contactMethod] ?? $contactMethod;
                $leadData['notes'][] = '🔔 Предпочтительный способ связи: ' . $contactMethodLabel;
            }
            
            $leadData['notes'][] = '---';
            $leadData['notes'][] = 'ВОПРОС:';
            $leadData['notes'][] = $message;
            
            // Отправляем в amoCRM
            $leadId = FormAmoCRMHandler::createAmoCRMLead($leadData);
            
            if ($leadId) {
                $arResult["SUCCESS"] = true;
                
                // Очищаем POST, чтобы форма не заполнялась повторно
                $_POST = [];
            } else {
                $arResult["ERRORS"][] = "Ошибка отправки. Попробуйте позже или свяжитесь с нами по телефону.";
            }
        }
    }
}

$this->IncludeComponentTemplate();
?>