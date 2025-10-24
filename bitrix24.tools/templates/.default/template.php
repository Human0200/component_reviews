<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>

<!-- Tools :: Start-->
<section class="tools">
    <div class="container-fluid">
        <mark class="tools__mark"><?=htmlspecialchars($arResult['MARK_TEXT'])?></mark>
        <p class="tools__tagline">
            <span class="tools__tagline-row"><?=htmlspecialchars($arResult['TAGLINE_ROW_1'])?></span>
            <span class="tools__tagline-row"><?=htmlspecialchars($arResult['TAGLINE_ROW_2'])?></span>
        </p>
        <hr class="tools__line">
        <h2 class="tools__title"><?=htmlspecialchars($arResult['TITLE'])?></h2>
        
        <?php if(!empty($arResult['ITEMS'])): ?>
        <ul class="tools__list">
            <?php foreach($arResult['ITEMS'] as $index => $item): ?>
            <li>
                <div class="tools__card js-swiper-tools">
                    <div class="tools__card-head">
                        <h3 class="tools__card-title"><?=htmlspecialchars($item['NAME'])?></h3>
                        <span class="tools__card-number">
                            <span class="tools__card-number-in"><?=($index + 1)?></span>
                        </span>
                    </div>
                    <div class="tools__card-body">
                        <?php if(!empty($item['DESCRIPTIONS'])): ?>
                        <div class="tools__card-desc">
                            <div class="swiper swiper-tools-desc js-swiper-tools-desc">
                                <div class="swiper-wrapper">
                                    <?php foreach($item['DESCRIPTIONS'] as $desc): ?>
                                    <div class="swiper-slide">
                                        <p><?=nl2br(htmlspecialchars($desc))?></p>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if(!empty($item['IMAGES'])): ?>
                        <div class="tools__card-swiper">
                            <div class="swiper-tools">
                                <div class="swiper swiper-tools-slides js-swiper-tools-slides">
                                    <div class="swiper-wrapper">
                                        <?php foreach($item['IMAGES'] as $image): ?>
                                        <div class="swiper-slide">
                                            <picture class="tools__card-image">
                                                <img src="<?=htmlspecialchars($image)?>" alt="<?=htmlspecialchars($item['NAME'])?>">
                                            </picture>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="swiper swiper-tools-thumbs js-swiper-tools-thumbs">
                                    <div class="swiper-wrapper">
                                        <?php foreach($item['IMAGES'] as $image): ?>
                                        <div class="swiper-slide">
                                            <picture class="tools__card-image">
                                                <img src="<?=htmlspecialchars($image)?>" alt="<?=htmlspecialchars($item['NAME'])?>">
                                            </picture>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <div class="tools__card-control">
                            <button class="swiper-prev js-swiper-tools-prev">
                                <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.83398 17.5L4.77332 16.4393L3.71266 17.5L4.77332 18.5607L5.83398 17.5ZM27.709 19C28.5374 19 29.209 18.3284 29.209 17.5C29.209 16.6716 28.5374 16 27.709 16V17.5V19ZM14.584 8.75L13.5233 7.68934L4.77332 16.4393L5.83398 17.5L6.89464 18.5607L15.6446 9.81066L14.584 8.75ZM5.83398 17.5L4.77332 18.5607L13.5233 27.3107L14.584 26.25L15.6446 25.1893L6.89464 16.4393L5.83398 17.5ZM5.83398 17.5V19L27.709 19V17.5V16L5.83398 16V17.5Z" fill="currentColor" />
                                </svg>назад
                            </button>
                            <div class="swiper-pagination js-swiper-tools-pagination"></div>
                            <button class="swiper-next js-swiper-tools-next">вперед<svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M29.166 17.5L30.2267 16.4393L31.2873 17.5L30.2267 18.5607L29.166 17.5ZM7.29102 19C6.46259 19 5.79102 18.3284 5.79102 17.5C5.79102 16.6716 6.46259 16 7.29102 16V17.5V19ZM20.416 8.75L21.4767 7.68934L30.2267 16.4393L29.166 17.5L28.1054 18.5607L19.3554 9.81066L20.416 8.75ZM29.166 17.5L30.2267 18.5607L21.4767 27.3107L20.416 26.25L19.3554 25.1893L28.1054 16.4393L29.166 17.5ZM29.166 17.5V19L7.29102 19V17.5V16L29.166 16V17.5Z" fill="currentColor" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>
</section>
<!-- Tools :: End-->