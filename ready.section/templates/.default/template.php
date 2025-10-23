<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<section class="ready">
    <div class="container-fluid">
        <?php if ($arResult['SHOW_SERVICES']): ?>
        <div class="ready__services">
            <h2 class="ready__services-title"><?= $arResult['SERVICES_TITLE'] ?></h2>
            <ul class="ready__services-list">
                <?php foreach ($arResult['SERVICES'] as $service): ?>
                <li>
                    <div class="ready__services-card <?= $service['CLASS'] ?>">
                        <h3 class="ready__services-card-title"><?= $service['TITLE'] ?></h3>
                        <figure class="ready__services-card-figure">
                            <?php foreach ($service['ICONS'] as $icon): ?>
                                <img alt="" src="<?= $icon ?>">
                            <?php endforeach; ?>
                        </figure>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <?php if ($arResult['SHOW_BUSINESS'] && !empty($arResult['BUSINESS_ITEMS'])): ?>
        <div class="ready__business">
            <h2 class="ready__business-title"><?= $arResult['BUSINESS_TITLE'] ?></h2>
            <ul class="ready__business-list">
                <?php foreach ($arResult['BUSINESS_ITEMS'] as $item): ?>
                <li>
                    <div class="ready__business-card">
                        <h2 class="ready__business-card-title"><?= $item['NAME'] ?></h2>
                        <?php if ($item['IMAGE']): ?>
                        <picture class="ready__business-card-image">
                            <img alt="" src="<?= $item['IMAGE'] ?>">
                        </picture>
                        <?php endif; ?>
                        <?php if ($item['TEXT']): ?>
                        <p class="ready__business-card-text"><?= $item['TEXT'] ?></p>
                        <?php endif; ?>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>
    </div>
</section>