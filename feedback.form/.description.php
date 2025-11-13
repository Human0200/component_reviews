<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentDescription = array(
    "NAME" => "Форма обратной связи",
    "DESCRIPTION" => "Компонент для отправки вопросов в amoCRM",
    "ICON" => "/images/icon.gif",
    "SORT" => 10,
    "PATH" => array(
        "ID" => "custom",
        "NAME" => "Пользовательские компоненты",
        "CHILD" => array(
            "ID" => "feedback",
            "NAME" => "Формы обратной связи"
        )
    ),
);
?>