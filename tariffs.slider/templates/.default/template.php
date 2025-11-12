<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>

<style>
/* Футер карточки - два блока слева и справа */
.tariffs__card-foot {
    display: flex;
    justify-content: space-between;
    align-items: last baseline;
    gap: 20px;
    padding: 0 20px;
}

/* Блок стоимости (слева) */
.tariffs__card-price-block {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.tariffs__card-price-label {
    font-family: Montserrat, sans-serif;
    font-weight: 400;
    font-size: 16px;
    line-height: 100%;
    letter-spacing: 0%;
    color: #101010;
}

.tariffs__card-price {
    font-family: Montserrat, sans-serif;
    font-weight: 500;
    font-size: 40px;
    line-height: 100%;
    letter-spacing: 0%;
    color: #101010;
}

/* Блок срока внедрения (справа) */
.tariffs__card-deadline-block {
    display: flex;
    flex-direction: column;
    gap: 5px;
    text-align: center;
}

.tariffs__card-deadline-label {
    font-family: Montserrat, sans-serif;
    font-weight: 400;
    font-size: 16px;
    line-height: 100%;
    letter-spacing: 0%;
    color: #101010;
}

.tariffs__card-deadline {
    font-family: Montserrat, sans-serif;
    font-weight: 500;
    font-size: 26px;
    line-height: 100%;
    letter-spacing: 0%;
    color: #101010;
}
</style>

<section class="tariffs">
    <div class="container-fluid">
        <h2 class="tariffs__title"><?=htmlspecialchars($arResult['TITLE'])?></h2>
        <div class="tariffs__swiper">
            <div class="swiper js-swiper-tariffs">
                <div class="swiper-wrapper">
                    <?php foreach($arResult['ITEMS'] as $item): ?>
                    <div class="swiper-slide">
                        <a class="tariffs__card" href="<?=htmlspecialchars($item['LINK'])?>" data-fancybox="">
                            <div class="tariffs__card-head">
                                <h3 class="tariffs__card-title"><?=htmlspecialchars($item['NAME'])?></h3>
                                <p class="tariffs__card-caption"><?=htmlspecialchars($item['CAPTION'])?></p>
                            </div>
                            <div class="tariffs__card-body">
                                <?php if(!empty($item['SERVICES'])): ?>
                                <ul class="tariffs__card-list">
                                    <?php foreach($item['SERVICES'] as $service): ?>
                                    <li><?=$service?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>
                            </div>
                            <div class="tariffs__card-foot">
                                <div class="tariffs__card-price-block">
                                    <div class="tariffs__card-price-label">Стоимость</div>
                                    <div class="tariffs__card-price">
                                        <?php if($item['PRICE_YEAR']): ?>
                                        <?=htmlspecialchars($item['PRICE_YEAR'])?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="tariffs__card-deadline-block">
                                    <div class="tariffs__card-deadline-label">Срок внедрения</div>
                                    <div class="tariffs__card-deadline">
                                        <?=htmlspecialchars($item['DEADLINE'] ?: '5 дней')?>
                                    </div>
                                </div>
                            </div>
                            <span class="tariffs__card-btn">Заказать внедрение</span>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-control">
                    <button class="swiper-prev js-swiper-tariffs-prev">
                        <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.83398 17.5L4.77332 16.4393L3.71266 17.5L4.77332 18.5607L5.83398 17.5ZM27.709 19C28.5374 19 29.209 18.3284 29.209 17.5C29.209 16.6716 28.5374 16 27.709 16V17.5V19ZM14.584 8.75L13.5233 7.68934L4.77332 16.4393L5.83398 17.5L6.89464 18.5607L15.6446 9.81066L14.584 8.75ZM5.83398 17.5L4.77332 18.5607L13.5233 27.3107L14.584 26.25L15.6446 25.1893L6.89464 16.4393L5.83398 17.5ZM5.83398 17.5V19L27.709 19V17.5V16L5.83398 16V17.5Z" fill="currentColor" />
                        </svg>назад
                    </button>
                    <button class="swiper-next js-swiper-tariffs-next">вперед<svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M29.166 17.5L30.2267 16.4393L31.2873 17.5L30.2267 18.5607L29.166 17.5ZM7.29102 19C6.46259 19 5.79102 18.3284 5.79102 17.5C5.79102 16.6716 6.46259 16 7.29102 16V17.5V19ZM20.416 8.75L21.4767 7.68934L30.2267 16.4393L29.166 17.5L28.1054 18.5607L19.3554 9.81066L20.416 8.75ZM29.166 17.5L30.2267 18.5607L21.4767 27.3107L20.416 26.25L19.3554 25.1893L28.1054 16.4393L29.166 17.5ZM29.166 17.5V19L7.29102 19V17.5V16L29.166 16V17.5Z" fill="currentColor" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>