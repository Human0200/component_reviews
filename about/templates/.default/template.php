<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<style>
.about__card {
    position: relative;
}
.about__card-corner-text {
    position: absolute;
    top: 15px;
    left: 15px;
    font-family: Montserrat;
    font-weight: 400;
    font-style: normal;
    font-size: 24px;
    line-height: 100%;
    letter-spacing: 0%;
    color: #414141;
    z-index: 2;
    max-width: 80%;
}
@media (max-width: 768px) {
    .about__card-corner-text {
        display: none;
    }
}
</style>

<section class="about" id="about">
    <div class="container-fluid">
        <div class="about__head">
            <mark class="about__mark"><?=nl2br($arParams['MARK'])?></mark>
            <h2 class="about__title"><?=nl2br($arParams['TITLE'])?></h2>
            <p class="about__text"><?=nl2br($arParams['TEXT'])?></p>
        </div>
        <div class="about__body">
            <ul class="about__list">
                <?php for($i = 1; $i <= 3; $i++): ?>
                <li>
                    <div class="about__card">
                        <?php if(!empty($arParams["CARD_".$i."_CORNER_TEXT"])): ?>
                        <div class="about__card-corner-text">
                            <?=nl2br($arParams["CARD_".$i."_CORNER_TEXT"])?>
                        </div>
                        <?php endif; ?>
                        <div class="about__card-align">
                            <h3 class="about__card-title">
                                <span><?=nl2br($arParams["CARD_".$i."_NUMBER"])?></span>
                                <?php if(!empty($arParams["CARD_".$i."_SUFFIX"])): ?>
                                <sub><?=nl2br($arParams["CARD_".$i."_SUFFIX"])?></sub>
                                <?php endif; ?>
                            </h3>
                            <p class="about__card-text">
                                <?=nl2br($arParams["CARD_".$i."_TEXT"])?>
                            </p>
                        </div>
                    </div>
                </li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
</section>