<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>

<!-- Details :: Start-->
<section class="details">
    <div class="container-fluid">
        <?php if($arResult['BG_IMAGE']): ?>
        <picture class="details__image">
            <img src="<?=htmlspecialchars($arResult['BG_IMAGE'])?>" alt="">
        </picture>
        <?php endif; ?>
        
        <mark class="details__mark"><?=htmlspecialchars($arResult['MARK_TEXT'])?></mark>
        
        <?php if(!empty($arResult['BLOCKS'])): ?>
        <ul class="details__list">
            <?php foreach($arResult['BLOCKS'] as $block): ?>
            <li>
                <div class="details__card">
                    <h2 class="details__card-title"><?=htmlspecialchars($block['TITLE'])?></h2>
                    <div class="details__card-desc">
                        <?=nl2br( $block['TEXT'] )?>
                        
                        <?php if($block['CLIENT_NAME']): ?>
                        <p>
                            <b>Клиент: <a href="<?=htmlspecialchars($block['CLIENT_LINK'])?>"><?=htmlspecialchars($block['CLIENT_NAME'])?></a></b>
                        </p>
                        <?php endif; ?>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>
</section>
<!-- Details :: End-->