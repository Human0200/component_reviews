<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        "TITLE" => array(
            "PARENT" => "BASE",
            "NAME" => "Заголовок формы",
            "TYPE" => "STRING",
            "DEFAULT" => "Остались вопросы?",
        ),
        "BUTTON_TEXT" => array(
            "PARENT" => "BASE",
            "NAME" => "Текст кнопки",
            "TYPE" => "STRING",
            "DEFAULT" => "Написать",
        ),
        "SUCCESS_MESSAGE" => array(
            "PARENT" => "BASE",
            "NAME" => "Сообщение после отправки",
            "TYPE" => "STRING",
            "DEFAULT" => "Спасибо! Мы свяжемся с вами в ближайшее время.",
        ),
        "CACHE_TIME" => array("DEFAULT" => 3600),
    ),
);
?>