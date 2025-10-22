<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>

<section class="stack">
    <div class="container-fluid">
        <div class="stack__sticky">
            <mark class="stack__mark"><?=htmlspecialchars($arResult['MARK'])?></mark>
            <h2 class="stack__title"><?=htmlspecialchars($arResult['TITLE'])?></h2>
        </div>
        
        <?php if(!empty($arResult['ITEMS'])): ?>
        <ul class="stack__list">
            <?php foreach($arResult['ITEMS'] as $item): ?>
            <li>
                <div class="stack__card">
                    <div class="stack__card-head">
                        <span class="stack__card-number"><?=htmlspecialchars($item['NUMBER'])?></span>
                        <h3 class="stack__card-title"><?=htmlspecialchars($item['TITLE'])?></h3>
                    </div>
                    <div class="stack__card-body">
                        <p><?=htmlspecialchars($item['TEXT'])?></p>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
            
            <li>
                <div class="stack__request">
                    <h3 class="stack__request-title"><?=nl2br(htmlspecialchars($arResult['REQUEST_TITLE']))?></h3>
                    <div class="stack__request-action">
                        <a class="ui-btn ui-btn--gradient" href="<?=htmlspecialchars($arResult['BUTTON_LINK'])?>">
                            <?=htmlspecialchars($arResult['BUTTON_TEXT'])?>
                        </a>
                    </div>
                </div>
            </li>
        </ul>
        <?php endif; ?>
        
        <p class="stack__tagline">
            <span class="stack__tagline-row"><?=htmlspecialchars($arResult['TAGLINE_ROW_1'])?></span>
            <span class="stack__tagline-row"><?=htmlspecialchars($arResult['TAGLINE_ROW_2'])?></span>
        </p>
    </div>
</section>