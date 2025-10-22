<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>

<!-- License :: Start-->
<section class="license">
    <div class="container-fluid">
        <mark class="license__mark">
            <?=htmlspecialchars($arResult['MARK_TEXT'])?> 
            <mark><?=htmlspecialchars($arResult['MARK_HIGHLIGHT'])?></mark>
        </mark>
        
        <div class="license__group">
            <div class="license__group-head">
                <div class="row">
                    <div class="col-xl">
                        <h2 class="license__title"><?=htmlspecialchars($arResult['TITLE'])?></h2>
                    </div>
                    <div class="col-xl-auto">
                        <div class="license__caption">
                            <p><?=htmlspecialchars($arResult['CAPTION'])?></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="license__group-body">
                <div class="license__tabs" data-tabs>
                    <div class="license__tabs-control">
                        <button class="license__tabs-btn is-active" data-tabs-btn="cloud">Облачная версия</button>
                        <button class="license__tabs-btn" data-tabs-btn="boxed">Коробочная версия</button>
                    </div>
                    
                    <div class="license__tabs-wrapper">
                        <!-- Облачная версия -->
                        <div class="license__tabs-content is-active" data-tabs-content="cloud">
                            <button class="license__toggle license__toggle--right is-active" data-tabs-btn="boxed">
                                <svg width="43" height="43" viewBox="0 0 43 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.5 32.25L32.25 21.5L21.5 10.75" stroke="currentColor" stroke-width="2" />
                                    <path d="M10.75 32.25L21.5 21.5L10.75 10.75" stroke="currentColor" stroke-width="2" />
                                </svg>Коробочная версия<svg width="43" height="43" viewBox="0 0 43 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.5 32.25L32.25 21.5L21.5 10.75" stroke="currentColor" stroke-width="2" />
                                    <path d="M10.75 32.25L21.5 21.5L10.75 10.75" stroke="currentColor" stroke-width="2" />
                                </svg>
                            </button>
                            
                            <?php if(!empty($arResult['CLOUD_LICENSES'])): ?>
                            <div class="license__swiper">
                                <div class="swiper js-swiper-license">
                                    <div class="swiper-wrapper">
                                        <?php foreach($arResult['CLOUD_LICENSES'] as $license): ?>
                                        <div class="swiper-slide">
                                            <div class="license__card license__card--cloud">
                                                <div class="license__card-flip">
                                                    <!-- Лицевая сторона -->
                                                    <div class="license__card-front">
                                                        <div class="license__card-head">
                                                            <h3 class="license__card-title"><?=htmlspecialchars($license['NAME'])?></h3>
                                                            <p class="license__card-text"><?=htmlspecialchars($license['DESCRIPTION'])?></p>
                                                        </div>
                                                        <div class="license__card-body" data-ruler>
                                                            <p class="license__card-employees">
                                                                <span class="license__card-employees-number"><?=htmlspecialchars($license['EMPLOYEES'])?></span>
                                                                <span class="license__card-employees-text">сотрудников</span>
                                                                <span class="license__card-employees-mark"></span>
                                                            </p>
                                                            <hr class="license__card-line">
                                                            <p class="license__card-price">
                                                                <sup><?=number_format($license['PRICE_MONTH'], 0, '', ' ')?> ₽/мес.</sup>
                                                                <span>
                                                                    <?=number_format($license['PRICE_YEAR_DISCOUNTED'], 0, '', ' ')?> ₽/год
                                                                    <?php if($license['DISCOUNT'] > 0): ?>
                                                                    <mark>-<?=$license['DISCOUNT']?>%</mark>
                                                                    <?php endif; ?>
                                                                </span>
                                                                <sub>за всех пользователей</sub>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Обратная сторона -->
                                                    <div class="license__card-back">
                                                        <div class="license__card-head">
                                                            <h3 class="license__card-title"><?=htmlspecialchars($license['NAME'])?></h3>
                                                            <p class="license__card-text"><?=htmlspecialchars($license['DESCRIPTION'])?></p>
                                                        </div>
                                                        <div class="license__card-body" data-ruler>
                                                            <ul class="license__card-list">
                                                                <?php if(!empty($license['FEATURES'])): ?>
                                                                    <?php foreach($license['FEATURES'] as $feature): ?>
                                                                    <li><?=htmlspecialchars($feature)?></li>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                                
                                                                <?php if(!empty($license['FEATURES_DISABLED'])): ?>
                                                                    <?php foreach($license['FEATURES_DISABLED'] as $feature): ?>
                                                                    <li class="is-disabled"><?=htmlspecialchars($feature)?></li>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Коробочная версия -->
                        <div class="license__tabs-content" data-tabs-content="boxed">
                            <button class="license__toggle license__toggle--left" data-tabs-btn="cloud">
                                <svg width="43" height="43" viewBox="0 0 43 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.5 10.75L10.75 21.5L21.5 32.25" stroke="currentColor" stroke-width="2" />
                                    <path d="M32.25 10.75L21.5 21.5L32.25 32.25" stroke="currentColor" stroke-width="2" />
                                </svg>Облачная версия<svg width="43" height="43" viewBox="0 0 43 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.5 10.75L10.75 21.5L21.5 32.25" stroke="currentColor" stroke-width="2" />
                                    <path d="M32.25 10.75L21.5 21.5L32.25 32.25" stroke="currentColor" stroke-width="2" />
                                </svg>
                            </button>
                            
                            <?php if(!empty($arResult['BOXED_LICENSES'])): ?>
                            <div class="license__swiper">
                                <div class="swiper js-swiper-license">
                                    <div class="swiper-wrapper">
                                        <?php foreach($arResult['BOXED_LICENSES'] as $license): ?>
                                        <div class="swiper-slide">
                                            <div class="license__card license__card--boxed">
                                                <div class="license__card-flip">
                                                    <!-- Лицевая сторона -->
                                                    <div class="license__card-front">
                                                        <div class="license__card-head">
                                                            <h3 class="license__card-title"><?=htmlspecialchars($license['NAME'])?></h3>
                                                            <p class="license__card-text"><?=htmlspecialchars($license['DESCRIPTION'])?></p>
                                                        </div>
                                                        <div class="license__card-body" data-ruler>
                                                            <p class="license__card-employees">
                                                                <span class="license__card-employees-number"><?=htmlspecialchars($license['EMPLOYEES'])?></span>
                                                                <span class="license__card-employees-text">сотрудников</span>
                                                                <span class="license__card-employees-mark"></span>
                                                            </p>
                                                            <hr class="license__card-line">
                                                            <p class="license__card-price">
                                                                <small>Цена с НДС</small>
                                                                <span>
                                                                    <?=number_format($license['PRICE_YEAR_DISCOUNTED'], 0, '', ' ')?> ₽
                                                                    <?php if($license['DISCOUNT'] > 0): ?>
                                                                    <mark>-<?=$license['DISCOUNT']?>%</mark>
                                                                    <?php endif; ?>
                                                                </span>
                                                                <sub>навсегда</sub>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Обратная сторона -->
                                                    <div class="license__card-back">
                                                        <div class="license__card-head">
                                                            <h3 class="license__card-title"><?=htmlspecialchars($license['NAME'])?></h3>
                                                            <p class="license__card-text"><?=htmlspecialchars($license['DESCRIPTION'])?></p>
                                                        </div>
                                                        <div class="license__card-body" data-ruler>
                                                            <ul class="license__card-list">
                                                                <?php if(!empty($license['FEATURES'])): ?>
                                                                    <?php foreach($license['FEATURES'] as $feature): ?>
                                                                    <li><?=htmlspecialchars($feature)?></li>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                                
                                                                <?php if(!empty($license['FEATURES_DISABLED'])): ?>
                                                                    <?php foreach($license['FEATURES_DISABLED'] as $feature): ?>
                                                                    <li class="is-disabled"><?=htmlspecialchars($feature)?></li>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Секция подписок -->
        <?php if(!empty($arResult['SUBSCRIPTIONS'])): ?>
        <div class="subsc__group">
            <div class="subsc__group-head">
                <h2 class="subsc__title">Подписка</h2>
            </div>
            <div class="subsc__group-body">
                <div class="subsc__swiper">
                    <div class="swiper js-swiper-subsc">
                        <div class="swiper-wrapper">
                            <?php foreach($arResult['SUBSCRIPTIONS'] as $subscription): ?>
                            <div class="swiper-slide">
                                <div class="subsc__card <?=$subscription['TYPE'] == 'cloud' ? 'subsc__card--cloud' : 'subsc__card--boxed'?> <?=$subscription['TYPE'] == 'static' ? 'subsc__card--static' : ''?>">
                                    <div class="subsc__card-head">
                                        <p class="subsc__card-text">Для тарифа</p>
                                        <h3 class="subsc__card-title"><?=nl2br(htmlspecialchars($subscription['NAME']))?></h3>
                                    </div>
                                    <div class="subsc__card-body">
                                        <p class="subsc__card-employees">
                                            <span class="subsc__card-employees-number"><?=htmlspecialchars($subscription['EMPLOYEES'])?></span>
                                            <span class="subsc__card-employees-text">сотрудников</span>
                                        </p>
                                        <hr class="subsc__card-line">
                                        <p class="subsc__card-price">
                                            <small>Подписка 12 месяцев</small>
                                            <span>
                                                <?=number_format($subscription['PRICE_YEAR_DISCOUNTED'], 0, '', ' ')?> ₽
                                                <?php if($subscription['DISCOUNT'] > 0): ?>
                                                <mark>-<?=$subscription['DISCOUNT']?>%</mark>
                                                <?php endif; ?>
                                            </span>
                                            <sub>Цена с НДС</sub>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="subsc__group-foot">
                <p class="subsc__tagline">
                    <span class="subsc__tagline-row"><?=htmlspecialchars($arResult['FOOTER_TEXT'])?></span>
                </p>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
<!-- License :: End-->