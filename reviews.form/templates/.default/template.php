<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Получаем путь к ajax.php
$componentPath = '/local/components/leadspace/reviews.form/ajax.php';


?>
<!-- подключаем стили -->
<link rel="stylesheet" href="style.css">
<style>
/* Контейнер для центрирования кнопки */
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
.submit-btn {
    background-color: <?= $arResult['BUTTON_COLOR'] ?>;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
    position: relative;
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
        <button type="button" class="close-btn" onclick="closeReviewForm()">&times;</button>
        <h3 style="margin-top: 0; margin-bottom: 20px;">Написать отзыв</h3>
        
        <div id="formMessages"></div>
        
        <form class="review-form" id="reviewForm" method="POST">
            <?= bitrix_sessid_post() ?>
            
            <!-- Скрытые поля с параметрами -->
            <input type="hidden" name="product_id" value="<?= $arResult['PRODUCT_ID'] ?>">
            <input type="hidden" name="iblock_id" value="<?= $arParams['IBLOCK_ID'] ?>">
            <input type="hidden" name="check_duplicate" value="<?= $arParams['CHECK_DUPLICATE'] ?>">
            <input type="hidden" name="check_time_limit" value="<?= $arParams['CHECK_TIME_LIMIT'] ?>">
            <input type="hidden" name="time_limit_minutes" value="<?= $arParams['TIME_LIMIT_MINUTES'] ?>">
            
            <!-- Поле для авторизованных пользователей -->
            <?php if ($arResult['IS_AUTHORIZED']): ?>
                <div class="form-group">
                    <label>Вы авторизованы как:</label>
                    <input type="text" value="<?= htmlspecialchars($arResult['CURRENT_USER_NAME']) ?>" readonly style="background-color: #f8f9fa;">
                    <small style="color: #6c757d; font-size: 12px;">Отзыв будет привязан к вашему аккаунту</small>
                </div>
            <?php else: ?>
                <!-- Поле для гостей -->
                <div class="form-group">
                    <label for="guest_email">Ваш email *</label>
                    <input type="email" id="guest_email" name="guest_email" 
                           required
                           placeholder="example@mail.ru">
                </div>
            <?php endif; ?>
            
            <!-- Рейтинг -->
            <div class="form-group">
                <label>Оценка *</label>
                <div class="rating-stars">
                    <?php for ($i = 5; $i >= 1; $i--): ?>
                        <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>" required>
                        <label for="star<?= $i ?>" title="<?= $i ?> звезд">★</label>
                    <?php endfor; ?>
                </div>
                <small style="color: #6c757d; font-size: 12px;">Выберите оценку от 1 до 5 звезд</small>
            </div>
            
            <!-- Текст отзыва -->
            <div class="form-group">
                <label for="review_text">Текст отзыва *</label>
                <textarea id="review_text" name="review_text" required 
                          placeholder="Поделитесь вашим мнением о товаре..."></textarea>
            </div>
            
            <div class="form-actions">
                <button type="button" class="cancel-btn" onclick="closeReviewForm()">Отмена</button>
                <button type="submit" class="submit-btn" id="submitBtn">
                    <span id="submitLoading" class="loading-spinner" style="display: none;"></span>
                    <span id="submitText">Отправить отзыв</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Глобальные переменные
let isSubmitting = false;
const AJAX_URL = '<?= $componentPath ?>';

function openReviewForm() {
    console.log('Opening review form');
    document.getElementById('reviewModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
    document.getElementById('formMessages').innerHTML = '';
    document.getElementById('reviewForm').style.display = 'block';
    setLoadingState(false);
}

function closeReviewForm() {
    console.log('Closing review form');
    document.getElementById('reviewModal').style.display = 'none';
    document.body.style.overflow = '';
    document.getElementById('reviewForm').reset();
    isSubmitting = false;
    setLoadingState(false);
}

function showMessage(type, message) {
    const messagesDiv = document.getElementById('formMessages');
    const className = type === 'success' ? 'success' : 'errors';
    messagesDiv.innerHTML = `<div class="${className}">${message}</div>`;
    messagesDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

function setLoadingState(loading) {
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const submitLoading = document.getElementById('submitLoading');
    const form = document.getElementById('reviewForm');
    
    if (loading) {
        submitBtn.disabled = true;
        submitText.textContent = 'Отправка...';
        submitLoading.style.display = 'inline-block';
        form.classList.add('loading');
        isSubmitting = true;
    } else {
        submitBtn.disabled = false;
        submitText.textContent = 'Отправить отзыв';
        submitLoading.style.display = 'none';
        form.classList.remove('loading');
        isSubmitting = false;
    }
}

// Обработчик отправки формы
document.addEventListener('DOMContentLoaded', function() {
    const reviewForm = document.getElementById('reviewForm');
    
    if (reviewForm) {
        reviewForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (isSubmitting) {
                console.log('Form is already submitting, skipping...');
                return;
            }
            
            //console.log('Form submission started');
            //console.log('AJAX URL:', AJAX_URL);
            setLoadingState(true);
            
            // Собираем данные формы
            const formData = new FormData(this);
            
            // Логируем данные формы для отладки
            console.log('Form data:');
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }
            
            // Отправляем AJAX запрос на отдельный файл
            fetch(AJAX_URL, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                console.log('Response status:', response.status, response.statusText);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.text();
            })
            .then(html => {
                console.log('Raw response HTML:', html);
                
                // Очищаем предыдущие сообщения
                document.getElementById('formMessages').innerHTML = '';
                
                // Создаем временный элемент для парсинга HTML
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = html;
                
                // Ищем сообщения об ошибках или успехе в ответе
                const errorsElement = tempDiv.querySelector('.errors');
                const successElement = tempDiv.querySelector('.success');
                
                if (successElement) {
                    // Показываем сообщение об успехе
                    showMessage('success', successElement.innerHTML);
                    
                    // Скрываем форму
                    document.getElementById('reviewForm').style.display = 'none';
                    
                    console.log('Form submitted successfully');
                    
                    // Автоматически закрываем через 3 секунды
                    setTimeout(() => {
                        closeReviewForm();
                        // Можно добавить обновление списка отзывов здесь
                    }, 3000);
                    
                } else if (errorsElement) {
                    // Показываем ошибки
                    showMessage('error', errorsElement.innerHTML);
                    console.error('Form errors:', errorsElement.textContent);
                } else {
                    // Общая ошибка - выводим больше информации в консоль
                    console.error('Unexpected response format. Full HTML:', html);
                    showMessage('error', '<p>Произошла ошибка при отправке отзыва. Проверьте консоль для подробностей.</p>');
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                console.error('Error details:', {
                    message: error.message,
                    stack: error.stack
                });
                showMessage('error', '<p>Произошла ошибка сети при отправке отзыва. Проверьте подключение к интернету.</p>');
            })
            .finally(() => {
                setLoadingState(false);
                console.log('Form submission finished');
            });
        });
    }
    
    // Улучшенная обработка звезд рейтинга
    const ratingStars = document.querySelectorAll('.rating-stars input[type="radio"]');
    ratingStars.forEach(star => {
        star.addEventListener('change', function() {
            console.log('Rating selected:', this.value);
        });
    });
});

// Закрытие модального окна при клике вне его
window.addEventListener('click', function(event) {
    const modal = document.getElementById('reviewModal');
    if (event.target === modal) {
        closeReviewForm();
    }
});

// Закрытие по ESC
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeReviewForm();
    }
});

// Предотвращаем закрытие при клике на содержимое модального окна
document.querySelector('.review-modal-content').addEventListener('click', function(event) {
    event.stopPropagation();
});

//console.log('Review form script loaded');
//console.log('AJAX handler URL:', AJAX_URL);
</script>