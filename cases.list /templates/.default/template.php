<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$this->setFrameMode(true);
?>

<section class="cases" id="cases">
    <div class="container-fluid">
        <span class="cases__cube cases__cube--01"></span>
        <span class="cases__cube cases__cube--02"></span>
        <mark class="cases__mark"><?=$arResult['SECTION_MARK']?></mark>
        <div class="cases__desc">
            <h3 class="cases__title"><?=$arResult['SECTION_TITLE']?></h3>
            <p class="cases__text"><?=nl2br($arResult['SECTION_TEXT'])?></p>
        </div>
        <div class="cases__tiles">
            <?php if($arResult['SHOW_TAGS'] && !empty($arResult['TAGS'])): ?>
            <ul class="cases__tags">
                <?php foreach($arResult['TAGS'] as $tag): ?>
                <li>#<?=htmlspecialchars($tag)?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <?php if(!empty($arResult['ITEMS'])): ?>
            <ul class="cases__list">
                <?php foreach($arResult['ITEMS'] as $item): ?>
                <?php
                $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => "Будет удалена вся информация, связанная с этой записью. Продолжить?"));
                ?>
                <li id="<?=$this->GetEditAreaId($item['ID']);?>">
                    <a class="cases__card" <?=!empty($item['DETAIL_PAGE_URL']) ? 'href="'.$item['DETAIL_PAGE_URL'].'"' : ''?>>
                        <span class="cases__card-overlap">Читать кейс</span>
                        <div class="cases__card-desc">
                            <?php if($item['SPHERE']): ?>
                            <h4 class="cases__card-title">#сфера <?=htmlspecialchars($item['SPHERE'])?></h4>
                            <?php endif; ?>
                            <?php if($item['WORKPLACES_COUNT']): ?>
                            <p class="cases__card-text">#кол-во рабочих мест — <?=htmlspecialchars($item['WORKPLACES_COUNT'])?></p>
                            <?php endif; ?>
                        </div>
                        <?php if($item['LOGO']): ?>
                        <picture class="cases__card-image">
                            <img alt="<?=htmlspecialchars($item['NAME'])?>" loading="lazy" src="<?=$item['LOGO']?>">
                        </picture>
                        <?php endif; ?>
                        <span class="cases__card-btn">Смотреть кейс<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.792 11.5393L20.1836 11.1482L20.5742 11.5393L20.1827 11.9304L19.792 11.5393ZM5.41323 12.0925C5.10775 12.0925 4.8604 11.8448 4.86076 11.5393C4.86112 11.2338 5.10906 10.9862 5.41455 10.9862L5.41389 11.5393L5.41323 12.0925ZM14.0476 5.78809L14.4392 5.39696L20.1836 11.1482L19.792 11.5393L19.4004 11.9304L13.656 6.17921L14.0476 5.78809ZM19.792 11.5393L20.1827 11.9304L14.4246 17.6817L14.0339 17.2906L13.6433 16.8994L19.4013 11.1482L19.792 11.5393ZM19.792 11.5393L19.7913 12.0925H5.41323L5.41389 11.5393L5.41455 10.9862H19.7927L19.792 11.5393Z" fill="currentColor" />
                            </svg>
                        </span>
                    </a>
                </li>
                <?php endforeach; ?>
                
                <li>
                    <div class="cases__place">
                        <h4 class="cases__place-title">Место
                            <br> для
                            <br> вашей
                            <br> компании
                        </h4>
                    </div>
                </li>
            </ul>
            <?php else: ?>
            <p class="cases__empty">Кейсы не найдены</p>
            <?php endif; ?>
        </div>
        <p class="cases__counter">
            <span class="cases__counter-number"><?=$arResult['COUNTER_NUMBER']?></span>
            <span class="cases__counter-text"><?=nl2br($arResult['COUNTER_TEXT'])?></span>
        </p>
        <p class="cases__tagline">
            <span class="cases__tagline-row"><?=nl2br($arResult['TAGLINE_ROW_1'])?></span>
            <span class="cases__tagline-row"><?=nl2br($arResult['TAGLINE_ROW_2'])?></span>
        </p>
        <div class="cases__marquee">
            <div class="cases__marquee-anim">
                <?php 
                if(!empty($arResult['MARQUEE_TITLES'])):
                    foreach($arResult['MARQUEE_TITLES'] as $title): 
                ?>
                    <span class="cases__marquee-text"><?=htmlspecialchars($title)?></span>
                    <span class="cases__marquee-line"></span>
                <?php 
                    endforeach;
                else:
                    for($i = 0; $i < 4; $i++):
                ?>
                    <span class="cases__marquee-text"><?=$arResult['MARQUEE_TEXT']?></span>
                    <span class="cases__marquee-line"></span>
                <?php 
                    endfor;
                endif;
                ?>
            </div>
            <div class="cases__marquee-anim" aria-hidden="true">
                <?php 
                if(!empty($arResult['MARQUEE_TITLES'])):
                    foreach($arResult['MARQUEE_TITLES'] as $title): 
                ?>
                    <span class="cases__marquee-text"><?=htmlspecialchars($title)?></span>
                    <span class="cases__marquee-line"></span>
                <?php 
                    endforeach;
                else:
                    for($i = 0; $i < 4; $i++):
                ?>
                    <span class="cases__marquee-text"><?=$arResult['MARQUEE_TEXT']?></span>
                    <span class="cases__marquee-line"></span>
                <?php 
                    endfor;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>