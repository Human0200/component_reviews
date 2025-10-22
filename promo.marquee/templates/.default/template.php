<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>

<section class="promo">
    <div class="container-fluid">
        <div class="promo__wrapper">
            <div class="promo__cube promo__cube--01"></div>
            <div class="promo__cube promo__cube--02"></div>
            <div class="promo__tagline"><?=htmlspecialchars($arResult['TAGLINE_TOP'])?></div>
            
            <?php if (!empty($arResult['ITEMS'])): ?>
            <div class="promo__marquee">
                <div class="promo__marquee-anim">
                    <ul class="promo__list">
                        <?php foreach($arResult['ITEMS'] as $item): ?>
                        <li><?=htmlspecialchars($item)?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="promo__marquee-anim">
                    <ul class="promo__list">
                        <?php foreach($arResult['ITEMS'] as $item): ?>
                        <li><?=htmlspecialchars($item)?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="promo__tagline"><?=htmlspecialchars($arResult['TAGLINE_BOTTOM'])?></div>
        </div>
    </div>
</section>