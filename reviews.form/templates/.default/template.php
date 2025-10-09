<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<style>
/* Контейнер для центрирования кнопки */
.review-form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin: 20px 0;
}

.review-form-btn {
    background-color: <?= $arResult['BUTTON_COLOR'] ?>;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 500;
    transition: background-color 0.3s;
}

.review-form-btn:hover {
    background-color: #9a165c;
}

.review-modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.review-modal-content {
    background-color: white;
    margin: 5% auto;
    padding: 30px;
    border-radius: 8px;
    width: 90%;
    max-width: 600px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.review-form .form-group {
    margin-bottom: 20px;
}

.review-form label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
}

.review-form input,
.review-form textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.review-form textarea {
    height: 120px;
    resize: vertical;
}

.rating-stars {
    display: flex;
    gap: 10px;
    margin: 10px 0;
}

.rating-stars input {
    display: none;
}

.rating-stars label {
    font-size: 24px;
    color: #ddd;
    cursor: pointer;
}

.rating-stars input:checked ~ label,
.rating-stars label:hover,
.rating-stars label:hover ~ label {
    color: #ffc107;
}

.form-actions {
    display: flex;
    gap: 10px;
    justify-content: flex-end;
    margin-top: 20px;
}

.cancel-btn {
    background-color: #6c757d;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
}

.submit-btn {
    background-color: <?= $arResult['BUTTON_COLOR'] ?>;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
}

.errors {
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    border-radius: 4px;
    margin-bottom: 20px;
}

.success {
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    border-radius: 4px;
    margin-bottom: 20px;
}
</style>

<!-- Контейнер с центрированной кнопкой -->
<div class="review-form-container">
    <button type="button" class="review-form-btn" onclick="openReviewForm()">
        <?= $arResult['BUTTON_TEXT'] ?>
    </button>
</div>

<!-- Модальное окно с формой -->
<div id="reviewModal" class="review-modal">
    <div class="review-modal-content">
        <h3>Написать отзыв</h3>
        
        <?php if (!empty($arResult['ERRORS'])): ?>
            <div class="errors">
                <?php foreach ($arResult['ERRORS'] as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($arResult['SUCCESS_MESSAGE'])): ?>
            <div class="success">
                <p><?= htmlspecialchars($arResult['SUCCESS_MESSAGE']) ?></p>
            </div>
        <?php else: ?>
            <!-- Форма показывается только если нет сообщения об успехе -->
            <form class="review-form" method="POST" action="">
                <?= bitrix_sessid_post() ?>
                <input type="hidden" name="submit_review" value="1">
                
                <!-- Поле для авторизованных пользователей -->
                <?php if ($arResult['IS_AUTHORIZED']): ?>
                    <div class="form-group">
                        <label>Вы авторизованы как:</label>
                        <input type="text" value="<?= htmlspecialchars($arResult['CURRENT_USER_NAME']) ?>" readonly>
                        <small>Отзыв будет привязан к вашему аккаунту</small>
                    </div>
                <?php else: ?>
                    <!-- Поле для гостей -->
                    <div class="form-group">
                        <label for="guest_email">Ваш email *</label>
                        <input type="email" id="guest_email" name="guest_email" 
                               value="<?= htmlspecialchars($_POST['guest_email'] ?? '') ?>" 
                               required>
                    </div>
                <?php endif; ?>
                
                <!-- Рейтинг -->
                <div class="form-group">
                    <label>Оценка *</label>
                    <div class="rating-stars">
                        <?php for ($i = 5; $i >= 1; $i--): ?>
                            <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>" 
                                   <?= ($_POST['rating'] ?? '') == $i ? 'checked' : '' ?> required>
                            <label for="star<?= $i ?>">★</label>
                        <?php endfor; ?>
                    </div>
                </div>
                
                <!-- Текст отзыва -->
                <div class="form-group">
                    <label for="review_text">Текст отзыва *</label>
                    <textarea id="review_text" name="review_text" required><?= htmlspecialchars($_POST['review_text'] ?? '') ?></textarea>
                </div>
                
                <div class="form-actions">
                    <button type="button" class="cancel-btn" onclick="closeReviewForm()">Отмена</button>
                    <button type="submit" class="submit-btn">Отправить отзыв</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>

<script>
function openReviewForm() {
    document.getElementById('reviewModal').style.display = 'block';
}

function closeReviewForm() {
    document.getElementById('reviewModal').style.display = 'none';
    
    // Очищаем GET-параметр review_success из URL
    if (window.location.search.includes('review_success')) {
        const url = new URL(window.location);
        url.searchParams.delete('review_success');
        window.history.replaceState({}, '', url);
    }
}

// Автоматически открываем модальное окно если есть ошибки
<?php if (!empty($arResult['ERRORS'])): ?>
    window.addEventListener('DOMContentLoaded', function() {
        openReviewForm();
    });
<?php endif; ?>

// Автоматически открываем модальное окно если есть сообщение об успехе
<?php if (!empty($arResult['SUCCESS_MESSAGE'])): ?>
    window.addEventListener('DOMContentLoaded', function() {
        openReviewForm();
        
        // Автоматически закрываем через 3 секунды и очищаем URL
        setTimeout(function() {
            closeReviewForm();
        }, 3000);
    });
<?php endif; ?>

// Закрытие модального окна при клике вне его
window.onclick = function(event) {
    var modal = document.getElementById('reviewModal');
    if (event.target == modal) {
        closeReviewForm();
    }
}
</script>