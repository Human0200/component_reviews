<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

// Подготовка данных
$arResult = [
    'TITLE' => $arParams['TITLE'] ?: 'Цели проекта',
    'ITEMS' => []
];

for ($i = 1; $i <= 3; $i++) {
    $title = $arParams['TARGET_' . $i . '_TITLE'] ?? '';
    $text = $arParams['TARGET_' . $i . '_TEXT'] ?? '';
    
    if ($title || $text) {
        $arResult['ITEMS'][] = [
            'TITLE' => $title,
            'TEXT' => $text
        ];
    }
}

$this->IncludeComponentTemplate();
?>