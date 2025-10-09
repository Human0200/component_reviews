<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$this->addExternalCss($this->GetFolder().'/style.css');
?>

<div class="product-reviews" id="review">
    <?php if(empty($arResult['REVIEWS'])): ?>
        <p class="reviews-empty">Пока нет отзывов. Будьте первым!</p>
    <?php else: ?>
        <div class="reviews-grid">
            <?php foreach($arResult['REVIEWS'] as $review): ?>
            <div class="review-card">
                <div class="review-header">
                    <h3 class="review-author"><?=htmlspecialchars($review['USER_NAME'])?></h3>
                    <span class="review-date"><?=$review['DATE_FORMATTED']?></span>
                </div>
                
                <div class="review-rating">
                    <?php 
                    $rating = intval($review['RATING']);
                    for($i = 1; $i <= 5; $i++): 
                    ?>
                        <svg class="star <?=($i <= $rating) ? 'star-filled' : 'star-empty'?>" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="currentColor"/>
                        </svg>
                    <?php endfor; ?>
                </div>
                
                <div class="review-text">
                    <?=nl2br(htmlspecialchars($review['TEXT']))?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>