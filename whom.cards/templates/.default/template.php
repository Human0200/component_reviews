<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>

<section class="whom">
    <div class="container-fluid">
        <mark class="whom__mark"><?=htmlspecialchars($arResult['MARK'])?></mark>
        <h2 class="whom__title"><?=htmlspecialchars($arResult['TITLE'])?></h2>
        
        <?php if (!empty($arResult['CARDS'])): ?>
        <ul class="whom__list">
            <?php foreach($arResult['CARDS'] as $card): ?>
            <li>
                <div class="whom__card">
                    <picture class="whom__card-image">
                        <img src="<?=htmlspecialchars($card['IMAGE'])?>" alt="">
                    </picture>
                    <div class="whom__card-front">
                        <h3 class="whom__card-title"><?=htmlspecialchars($card['TITLE'])?></h3>
                        <p class="whom__card-text">
                            <?php foreach($card['TEXT_PARTS'] as $index => $part): ?>
                                <?php if ($part['type'] === 'mark'): ?>
                                    <mark><?=htmlspecialchars($part['value'])?></mark>
                                <?php elseif ($part['type'] === 'text'): ?>
                                    <?php if ($part['value'] === 'от' || $part['value'] === 'до'): ?>
                                        <sub><?=htmlspecialchars($part['value'])?></sub>
                                    <?php else: ?>
                                        <?=htmlspecialchars($part['value'])?>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if ($index < count($card['TEXT_PARTS']) - 1): ?> <?php endif; ?>
                            <?php endforeach; ?>
                        </p>
                    </div>
                    <div class="whom__card-back">
                        <div class="whom__card-desc">
                            <em><?=htmlspecialchars($card['BACK_SUBTITLE'])?></em>
                            <h4><?=htmlspecialchars($card['BACK_TITLE'])?></h4>
                            <p><?=htmlspecialchars($card['BACK_TEXT'])?></p>
                        </div>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        
        <div class="whom__action">
            <a class="ui-btn ui-btn--dark" href="<?=htmlspecialchars($arResult['BUTTON_LINK'])?>" data-fancybox="">
                <?=htmlspecialchars($arResult['BUTTON_TEXT'])?>
            </a>
        </div>
    </div>
</section>