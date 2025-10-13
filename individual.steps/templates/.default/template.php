<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>

<section class="individual" id="individual">
    <div class="container-fluid">
        <div class="individual__head">
            <hr class="individual__line">
            <h2 class="individual__title">Индивидуальное внедрение</h2>
            <p class="individual__text">Автоматизируем бизнес под ваши потребности <b>за <?=count($arResult['ITEMS'])?> шагов</b>
            </p>
            <hr class="individual__line">
        </div>
        
        <?php if(!empty($arResult['ITEMS'])): ?>
        <div class="individual__body">
            <ul class="individual__list">
                <?php foreach($arResult['ITEMS'] as $item): ?>
                <li>
                    <div class="individual__card">
                        <div class="individual__card-head">
                            <span class="individual__card-number"><?=$item['NUMBER']?></span>
                            <figure class="individual__card-arrow">
                                <svg width="120" fill="none" height="120" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 60L101.061 58.9393L102.121 60L101.061 61.0607L100 60ZM25 61.5C24.1716 61.5 23.5 60.8284 23.5 60C23.5 59.1716 24.1716 58.5 25 58.5V60V61.5ZM70 30L71.0607 28.9393L101.061 58.9393L100 60L98.9393 61.0607L68.9393 31.0607L70 30ZM100 60L101.061 61.0607L71.0607 91.0607L70 90L68.9393 88.9393L98.9393 58.9393L100 60ZM100 60V61.5L25 61.5V60V58.5L100 58.5V60Z" fill="currentColor"></path>
                                </svg>
                            </figure>
                            <h3 class="individual__card-title"><?=htmlspecialchars($item['TITLE'])?></h3>
                            <figure class="individual__card-toggle">
                                <svg width="34" fill="none" height="34" viewBox="0 0 34 34" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-width="2" d="M25.456 16.9706L8.48542 16.9706" stroke="#101010" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path stroke-width="2" d="M16.9698 8.48542L16.9698 25.456" stroke="#101010" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </figure>
                        </div>
                        <div class="individual__card-body">
                            <div class="individual__card-body-in">
                                <?=$item['TEXT']?>
                            </div>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        
        <div class="individual__foot">
            <a class="ui-btn ui-btn--dark" href="#">заказать внедрение</a>
        </div>
        <?php endif; ?>
        
        <div class="individual__shutters">
            <span class="individual__shutters-slide"></span>
            <span class="individual__shutters-slide"></span>
            <span class="individual__shutters-slide"></span>
            <span class="individual__shutters-slide"></span>
            <span class="individual__shutters-slide"></span>
            <span class="individual__shutters-slide"></span>
            <span class="individual__shutters-slide"></span>
            <span class="individual__shutters-slide"></span>
        </div>
    </div>
</section>