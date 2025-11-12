<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>

<section class="solutions-grid">
    <div class="container-fluid">
        <h2 class="other__title"><?=htmlspecialchars($arResult['SECTION_TITLE'])?></h2>
        <?php if(!empty($arResult['ITEMS'])): ?>
        <div class="solutions-grid__items">
            <?php foreach($arResult['ITEMS'] as $item): ?>
            <?php $this->AddEditAction($item['ID'], '/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=' . $arResult['IBLOCK_ID'] . '&type=' . 'content' . '&ID=' . $item['ID'] . '', CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
            <div class="solutions-grid__item" id="<?= $this->GetEditAreaId($item['ID']) ?>">
                <a class="solutions-grid__card" <?=!empty($item['DETAIL_PAGE_URL']) ? 'href="'.$item['DETAIL_PAGE_URL'].'"' : ''?>></a>
                    <?php if($item['IMAGE']): ?>
                    <div class="solutions-grid__image">
                        <img src="<?=$item['IMAGE']?>" alt="<?=htmlspecialchars($item['NAME'])?>">
                    </div>
                    <?php endif; ?>
                    <div class="solutions-grid__content">
                        <h3 class="solutions-grid__title"><?=htmlspecialchars($item['NAME'])?></h3>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <p class="solutions-grid__empty">Нет доступных решений</p>
        <?php endif; ?>
    </div>
</section>