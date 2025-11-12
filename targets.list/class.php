<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class ProjectTargetsComponent extends CBitrixComponent
{
    public function executeComponent()
    {
        $this->arResult = $this->prepareData();
        $this->includeComponentTemplate();
    }
    
    private function prepareData()
    {
        $arResult = [
            'TITLE' => $this->arParams['TITLE'],
            'ITEMS' => []
        ];

        // Формируем массив целей
        for ($i = 1; $i <= 3; $i++) {
            $arResult['ITEMS'][] = [
                'TITLE' => $this->arParams['TARGET_' . $i . '_TITLE'],
                'TEXT' => $this->arParams['TARGET_' . $i . '_TEXT']
            ];
        }

        return $arResult;
    }
}

