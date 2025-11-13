<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<div class="feedback-form-wrapper">
    <div class="feedback-form-header">
        <h3 class="feedback-form-title"><?= htmlspecialchars($arParams["TITLE"]) ?></h3>
    </div>
    
    <?php if ($arResult["SUCCESS"]): ?>
        <div class="feedback-form-success">
            <div class="success-icon">✓</div>
            <p><?= htmlspecialchars($arParams["SUCCESS_MESSAGE"]) ?></p>
        </div>
    <?php else: ?>
        
        <?php if (!empty($arResult["ERRORS"])): ?>
            <div class="feedback-form-errors">
                <?php foreach ($arResult["ERRORS"] as $error): ?>
                    <p class="error-message">⚠ <?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <button type="button" class="btn btn-default" onclick="toggleFeedbackForm('<?= $arResult["FORM_ID"] ?>')">
            <?= htmlspecialchars($arParams["BUTTON_TEXT"]) ?>
        </button>
        
        <div class="feedback-form-container" id="<?= $arResult["FORM_ID"] ?>" style="display: none;">
            <form method="post" class="feedback-form" onsubmit="return validateFeedbackForm(this)">
                <?= bitrix_sessid_post() ?>
                
                <div class="form-group">
                    <label for="name_<?= $arResult["FORM_ID"] ?>">Ваше имя <span class="required">*</span></label>
                    <input 
                        type="text" 
                        id="name_<?= $arResult["FORM_ID"] ?>" 
                        name="name" 
                        class="form-control"
                        value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
                        required
                    >
                </div>
                
                <div class="form-group">
                    <label for="phone_<?= $arResult["FORM_ID"] ?>">Телефон</label>
                    <input 
                        type="tel" 
                        id="phone_<?= $arResult["FORM_ID"] ?>" 
                        name="phone" 
                        class="form-control"
                        value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>"
                        placeholder="+7 (___) ___-__-__"
                    >
                </div>
                
                <div class="form-group">
                    <label for="email_<?= $arResult["FORM_ID"] ?>">Email</label>
                    <input 
                        type="email" 
                        id="email_<?= $arResult["FORM_ID"] ?>" 
                        name="email" 
                        class="form-control"
                        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                        placeholder="example@mail.ru"
                    >
                </div>
                
                <div class="form-group">
                    <label for="contact_method_<?= $arResult["FORM_ID"] ?>">Предпочтительный способ связи</label>
                    <select 
                        id="contact_method_<?= $arResult["FORM_ID"] ?>" 
                        name="contact_method" 
                        class="form-control"
                    >
                        <option value="">Выберите способ</option>
                        <option value="call" <?= ($_POST['contact_method'] ?? '') == 'call' ? 'selected' : '' ?>>Звонок</option>
                        <option value="email" <?= ($_POST['contact_method'] ?? '') == 'email' ? 'selected' : '' ?>>Письмо</option>
                        <option value="whatsapp" <?= ($_POST['contact_method'] ?? '') == 'whatsapp' ? 'selected' : '' ?>>WhatsApp</option>
                        <option value="telegram" <?= ($_POST['contact_method'] ?? '') == 'telegram' ? 'selected' : '' ?>>Telegram</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="message_<?= $arResult["FORM_ID"] ?>">Ваш вопрос <span class="required">*</span></label>
                    <textarea 
                        id="message_<?= $arResult["FORM_ID"] ?>" 
                        name="message" 
                        class="form-control"
                        rows="4"
                        required
                    ><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                </div>
                
                <div class="form-actions">
                    <button type="submit" name="feedback_submit" class="btn btn-default">
                        Отправить
                    </button>
                    <button type="button" class="btn btn-default" onclick="toggleFeedbackForm('<?= $arResult["FORM_ID"] ?>')">
                        Отмена
                    </button>
                </div>
            </form>
        </div>
        
    <?php endif; ?>
</div>