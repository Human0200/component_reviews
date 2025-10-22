<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>

<section class="crm">
    <div class="container-fluid">
        <mark class="crm__mark"><?=htmlspecialchars($arResult['MARK'])?></mark>
        <p class="crm__tagline">
            <span class="crm__tagline-row"><?=htmlspecialchars($arResult['TAGLINE_ROW_1'])?></span>
            <span class="crm__tagline-row"><?=htmlspecialchars($arResult['TAGLINE_ROW_2'])?></span>
        </p>
        <hr class="crm__line">
        <h2 class="crm__title"><?=htmlspecialchars($arResult['TITLE'])?></h2>
        
        <?php if (!empty($arResult['CARDS'])): ?>
        <ul class="crm__list">
            <?php foreach($arResult['CARDS'] as $card): ?>
            <li>
                <div class="crm__card">
                    <figure class="crm__card-icon">
                        <img src="<?=htmlspecialchars($card['ICON'])?>" alt="">
                    </figure>
                    <p class="crm__card-text"><?=nl2br(htmlspecialchars($card['TEXT']))?></p>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>
</section>