<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>

<section class="team">
    <div class="container-fluid">
        <div class="team__head">
            <mark class="team__mark"><?=htmlspecialchars($arResult['SECTION_MARK'])?></mark>
            <h2 class="team__title"><?=htmlspecialchars($arResult['SECTION_TITLE'])?></h2>
            <hr class="team__line">
        </div>
        <div class="team__body">
            <p class="team__text"><?=htmlspecialchars($arResult['SECTION_TEXT'])?></p>
            <div class="team__wrapper">
                <picture class="team__cover">
                    <source media="(min-width: 992px)" srcset="<?=htmlspecialchars($arResult['COVER_IMAGE_DESKTOP'])?>">
                    <img alt="" src="<?=htmlspecialchars($arResult['COVER_IMAGE_MOBILE'])?>">
                </picture>
                
                <?php if (!empty($arResult['CARDS'])): ?>
                <ul class="team__list">
                    <?php foreach($arResult['CARDS'] as $card): ?>
                    <li>
                        <div class="team__card">
                            <div class="team__card-flip">
                                <div class="team__card-back">
                                    <?php for($j = 0; $j < $card['USERS_COUNT']; $j++): ?>
                                    <figure class="team__card-user">
                                        <picture class="team__card-user-image">
                                            <img alt="" src="assets/images/team/user-0<?=($j + 1)?>.webp">
                                        </picture>
                                        <figcaption class="team__card-user-figcaption">сотрудники</figcaption>
                                    </figure>
                                    <?php endfor; ?>
                                </div>
                                <div class="team__card-front">
                                    <span class="team__card-number"><?=htmlspecialchars($card['NUMBER'])?></span>
                                    <h3 class="team__card-title"><?=nl2br(htmlspecialchars($card['TITLE']))?></h3>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>