<style>
    .solutions__subtitle {
    margin: 0 0 20px 0;
    text-align: left;
    max-width: 100%;
    font-size: 24px;
}

/* Скрываем на мобильных и планшетах */
@media (max-width: 900px) {
    .solutions__subtitle {
        display: none;
    }
}
</style>
<section class="solutions" id="solutions">
    <div class="container-fluid">
        <div class="solutions__head">
            <h2 class="solutions__title"><?=$arResult['TITLE']?></h2>
            <p class="solutions__text">
                <small>Уже пользуются:</small> 170+ клиентов
            </p>
        </div>
        
        <!-- Добавленный текст ПЕРЕД карточками -->
        <div class="solutions__subtitle">
            <?=nl2br($arResult['SUBTITLE'])?>
        </div>
        
        <?php if(!empty($arResult['ITEMS'])): ?>
        <div class="solutions__body">
            <div class="solutions__swiper">
                <div class="swiper js-swiper-solutions">
                    <div class="swiper-wrapper">
                        <?php foreach($arResult['ITEMS'] as $item): ?>
                        <div class="swiper-slide">
                            <a class="solutions__card" href="<?=$item['DETAIL_PAGE_URL']?>">
                                <picture class="solutions__card-image">
                                    <img alt="<?=htmlspecialchars($item['NAME'])?>" src="<?=$item['IMAGE']?>">
                                </picture>
                                <div class="solutions__card-desc">
                                    <h3 class="solutions__card-title"><?=htmlspecialchars($item['NAME'])?></h3>
                                    <span class="solutions__card-btn">
                                        <span class="solutions__card-btn-text">уже настроили <b><?=htmlspecialchars($item['CLIENTS_COUNT'])?> клиентам</b>
                                        </span>
                                        <span class="solutions__card-btn-caption">Внутри решение
                                            <br> для вашего бизнеса
                                        </span>
                                        <svg class="solutions__card-btn-arrow" width="65" fill="none" height="65" viewBox="0 0 65 65" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M54.1322 32.592L55.1941 31.5313L56.2535 32.592L55.1916 33.6526L54.1322 32.592ZM13.8565 34.092C13.0281 34.092 12.3573 33.4204 12.3583 32.592C12.3593 31.7635 13.0317 31.092 13.8601 31.092L13.8583 32.592L13.8565 34.092ZM38.0418 16.4824L39.1037 15.4218L55.1941 31.5313L54.1322 32.592L53.0703 33.6526L36.9799 17.5431L38.0418 16.4824ZM54.1322 32.592L55.1916 33.6526L39.0629 49.7622L38.0035 48.7015L36.9441 47.6409L53.0728 31.5313L54.1322 32.592ZM54.1322 32.592L54.1304 34.092H13.8565L13.8583 32.592L13.8601 31.092H54.134L54.1322 32.592Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination js-swiper-solutions-pagination"></div>
                </div>
            </div>
        </div>
        <?php else: ?>
        <p class="solutions__empty">Нет доступных решений</p>
        <?php endif; ?>
    </div>
</section>