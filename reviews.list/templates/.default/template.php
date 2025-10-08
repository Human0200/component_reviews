<!-- components/custom/reviews.list/templates/.default/template.php -->
<div class="product-reviews">
    <h3>Отзывы о товаре (<?=$arResult['TOTAL_COUNT']?>)</h3>
    
    <?php if(empty($arResult['REVIEWS'])): ?>
        <p>Пока нет отзывов. Будьте первым!</p>
    <?php else: ?>
        <?php foreach($arResult['REVIEWS'] as $review): ?>
        <div class="review-item">
            <div class="review-header">
                <strong><?=htmlspecialchars($review['USER_NAME'])?></strong>
                <span class="review-date"><?=$review['DATE_FORMATTED']?></span>
                <?php if($review['RATING']): ?>
                    <span class="review-rating">Рейтинг: <?=$review['RATING']?>/5</span>
                <?php endif; ?>
            </div>
            <div class="review-text">
                <?=nl2br(htmlspecialchars($review['TEXT']))?>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>