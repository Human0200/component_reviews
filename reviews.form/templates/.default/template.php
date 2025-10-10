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
    position: relative;
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
    box-sizing: border-box;
}

.review-form textarea {
    height: 120px;
    resize: vertical;
}

.rating-stars {
    display: flex;
    gap: 10px;
    margin: 10px 0;
    flex-direction: row-reverse;
    justify-content: flex-end;
}

.rating-stars input {
    display: none;
}

.rating-stars label {
    font-size: 24px;
    color: #ddd;
    cursor: pointer;
    transition: color 0.2s;
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
    transition: background-color 0.3s;
}

.cancel-btn:hover {
    background-color: #5a6268;
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

.submit-btn:hover:not(:disabled) {
    background-color: #9a165c;
}

.submit-btn:disabled {
    background-color: #cccccc;
    cursor: not-allowed;
}

.loading {
    opacity: 0.7;
    pointer-events: none;
}

.errors {
    background-color: #f8d7da;
    color: #721c24;
    padding: 15px;
    border-radius: 4px;
    margin-bottom: 20px;
    border: 1px solid #f5c6cb;
}

.errors p {
    margin: 0 0 5px 0;
}

.errors p:last-child {
    margin-bottom: 0;
}

.success {
    background-color: #d4edda;
    color: #155724;
    padding: 20px;
    border-radius: 4px;
    margin-bottom: 20px;
    border: 1px solid #c3e6cb;
    text-align: center;
    font-weight: 500;
}

.loading-spinner {
    display: inline-block;
    width: 16px;
    height: 16px;
    border: 2px solid #ffffff;
    border-top: 2px solid transparent;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-right: 8px;
    vertical-align: middle;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.close-btn {
    position: absolute;
    top: 15px;
    right: 15px;
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #6c757d;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

.close-btn:hover {
    background-color: #f8f9fa;
    color: #495057;
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
            <input type="hidden" name="submit_review" value="1">
            <input type="hidden" name="ajax" value="Y">
            
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
                           value="<?= htmlspecialchars($_POST['guest_email'] ?? '') ?>" 
                           required
                           placeholder="example@mail.ru">
                </div>
            <?php endif; ?>
            
            <!-- Рейтинг -->
            <div class="form-group">
                <label>Оценка *</label>
                <div class="rating-stars">
                    <?php for ($i = 5; $i >= 1; $i--): ?>
                        <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>" 
                               <?= ($_POST['rating'] ?? '') == $i ? 'checked' : '' ?> required>
                        <label for="star<?= $i ?>" title="<?= $i ?> звезд">★</label>
                    <?php endfor; ?>
                </div>
                <small style="color: #6c757d; font-size: 12px;">Выберите оценку от 1 до 5 звезд</small>
            </div>
            
            <!-- Текст отзыва -->
            <div class="form-group">
                <label for="review_text">Текст отзыва *</label>
                <textarea id="review_text" name="review_text" required 
                          placeholder="Поделитесь вашим мнением о товаре..."><?= htmlspecialchars($_POST['review_text'] ?? '') ?></textarea>
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

function openReviewForm() {
    console.log('Opening review form');
    document.getElementById('reviewModal').style.display = 'block';
    document.body.style.overflow = 'hidden'; // Блокируем скролл страницы
    
    // Очищаем сообщения при открытии
    document.getElementById('formMessages').innerHTML = '';
    
    // Показываем форму (на случай если она была скрыта после успеха)
    document.getElementById('reviewForm').style.display = 'block';
    
    // Сбрасываем состояние кнопки
    setLoadingState(false);
}

function closeReviewForm() {
    console.log('Closing review form');
    document.getElementById('reviewModal').style.display = 'none';
    document.body.style.overflow = ''; // Восстанавливаем скролл
    
    // Сбрасываем форму при закрытии
    document.getElementById('reviewForm').reset();
    
    // Сбрасываем состояние
    isSubmitting = false;
    setLoadingState(false);
}

function showMessage(type, message) {
    const messagesDiv = document.getElementById('formMessages');
    const className = type === 'success' ? 'success' : 'errors';
    
    messagesDiv.innerHTML = `<div class="${className}">${message}</div>`;
    
    // Прокручиваем к сообщению
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
            
            console.log('Form submission started');
            setLoadingState(true);
            
            // Собираем данные формы
            const formData = new FormData(this);
            
            // Логируем данные формы для отладки
            console.log('Form data:');
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }
            
            // Отправляем AJAX запрос
            fetch('', {
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

// Автоматически открываем модальное окно если есть ошибки (для совместимости с обычной отправкой)
<?php if (!empty($arResult['ERRORS'])): ?>
    window.addEventListener('DOMContentLoaded', function() {
        console.log('Auto-opening form with errors:', <?= json_encode($arResult['ERRORS']) ?>);
        openReviewForm();
        showMessage('error', `<?php foreach ($arResult['ERRORS'] as $error): ?><p><?= htmlspecialchars($error) ?></p><?php endforeach; ?>`);
    });
<?php endif; ?>

// Автоматически открываем модальное окно если есть сообщение об успехе (для совместимости с обычной отправкой)
<?php if (!empty($arResult['SUCCESS_MESSAGE'])): ?>
    window.addEventListener('DOMContentLoaded', function() {
        console.log('Auto-opening form with success message');
        openReviewForm();
        showMessage('success', '<p><?= htmlspecialchars($arResult['SUCCESS_MESSAGE']) ?></p>');
        document.getElementById('reviewForm').style.display = 'none';
        
        setTimeout(() => {
            closeReviewForm();
        }, 3000);
    });
<?php endif; ?>

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

// Дополнительная отладка - логируем события открытия/закрытия
console.log('Review form script loaded');
</script>