<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<section class="certificates">
    <div class="container-fluid">
        <div class="certificates__head">
            <mark class="certificates__mark"><?=$arResult['TITLE']?></mark>
            <h2 class="certificates__title"><?=$arResult['TITLE']?></h2>
            <p class="certificates__text">Ежегодно мы подтверждаем наши компетенции и статус официального партнера Битрикс24.</p>
        </div>
        <?php if(!empty($arResult['ITEMS'])): ?>
        <div class="certificates__body">
            <div class="certificates__swiper">
                <div class="swiper js-swiper-certificates">
                    <div class="swiper-wrapper">
                        <?php foreach($arResult['ITEMS'] as $arItem): ?>
                        <div class="swiper-slide">
                            <a class="certificates__card<?=$arItem['IS_DUAL'] ? ' is-dual' : ''?>" href="<?=htmlspecialchars($arItem['DETAIL_PAGE_URL'] ?: '#')?>">
                                <picture class="certificates__card-image">
                                    <img alt="<?=$arItem['NAME']?>" src="<?=htmlspecialchars($arItem['IMAGE'])?>">
                                </picture>
                                <div class="certificates__card-desc">
                                    <h3 class="certificates__card-title"><?=$arItem['NAME']?></h3>
                                    <?php if($arItem['DATE']): ?>
                                    <span class="certificates__card-time"><?=htmlspecialchars($arItem['DATE'])?></span>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-control">
                        <button class="swiper-prev js-swiper-certificates-prev">
                            <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.81348 17.5L4.75091 16.4413L3.69597 17.5L4.75091 18.5587L5.81348 17.5ZM27.6098 19C28.4383 19 29.1098 18.3284 29.1098 17.5C29.1098 16.6716 28.4383 16 27.6098 16V17.5V19ZM14.532 8.75L13.4695 7.69125L4.75091 16.4413L5.81348 17.5L6.87604 18.5587L15.5946 9.80875L14.532 8.75ZM5.81348 17.5L4.75091 18.5587L13.4695 27.3087L14.532 26.25L15.5946 25.1913L6.87604 16.4413L5.81348 17.5ZM5.81348 17.5V19L27.6098 19V17.5V16L5.81348 16V17.5Z" fill="currentColor" />
                            </svg>назад
                        </button>
                        <button class="swiper-next js-swiper-certificates-next">вперед<svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M29.167 17.5L30.2277 16.4393L31.2883 17.5L30.2277 18.5607L29.167 17.5ZM7.29199 19C6.46357 19 5.79199 18.3284 5.79199 17.5C5.79199 16.6716 6.46357 16 7.29199 16V17.5V19ZM20.417 8.75L21.4777 7.68934L30.2277 16.4393L29.167 17.5L28.1063 18.5607L19.3563 9.81066L20.417 8.75ZM29.167 17.5L30.2277 18.5607L21.4777 27.3107L20.417 26.25L19.3563 25.1893L28.1063 16.4393L29.167 17.5ZM29.167 17.5V19L7.29199 19V17.5V16L29.167 16V17.5Z" fill="currentColor" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>