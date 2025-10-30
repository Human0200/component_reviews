<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>

<section class="feedback">
    <div class="container-fluid">
        <h2 class="feedback__title"><?=htmlspecialchars($arParams['SECTION_TITLE'] ?: 'Ответим на всё, что вас интересует')?></h2>
        <p class="feedback__text"><?=htmlspecialchars($arParams['SECTION_TEXT'] ?: 'Вы знаете цели, мы знаем инструмент. Создадим оптимальное решение вместе.')?></p>
        
        <?php if ($arResult["isFormErrors"] == "Y"): ?>
            <div class="feedback__errors" style="background: #fee; border: 1px solid #fcc; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                <?=$arResult["FORM_ERRORS_TEXT"]?>
            </div>
        <?php endif; ?>
        
        <?php if ($arResult["isFormNote"] != "Y"): ?>
            
            <form class="feedback__form js-validate" 
                  action="<?=POST_FORM_ACTION_URI?>" 
                  method="POST" 
                  enctype="multipart/form-data"
                  autocomplete="off">

                <?=bitrix_sessid_post()?>
                <input type="hidden" name="web_form_submit" value="Y">
                <input type="hidden" name="WEB_FORM_ID" value="<?=$arResult['arForm']['ID']?>">
                
                <div class="row">
                    <?php foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion): ?>
                        <?php 
                        // Скрываем комментарий (MESSAGE)
                        if ($FIELD_SID == 'MESSAGE') continue;
                        
                        // Получаем данные из STRUCTURE
                        $fieldData = $arQuestion["STRUCTURE"][0] ?? null;
                        if (!$fieldData) continue;
                        
                        $isPhone = ($FIELD_SID == 'PHONE');
                        $isEmail = ($FIELD_SID == 'EMAIL');
                        $isTextarea = ($fieldData["FIELD_HEIGHT"] > 1);
                        
                        // Формируем имя поля
                        $fieldName = "form_" . $fieldData["FIELD_TYPE"] . "_" . $fieldData["ID"];
                        
                        // Формируем правильные атрибуты
                        $inputClass = 'ui-placeholder__input' . ($isPhone ? ' js-mask-tel' : '');
                        
                        // Определяем тип поля
                        if ($isEmail) {
                            $inputType = 'email';
                        } elseif ($isPhone) {
                            $inputType = 'tel';
                        } else {
                            $inputType = 'text';
                        }
                        
                        $placeholder = htmlspecialchars($arQuestion["CAPTION"]);
                        $required = ($arQuestion["REQUIRED"] == "Y") ? ' required' : '';
                        ?>
                        
                        <div class="col-lg-6">
                            <div class="ui-placeholder">
                                <?php if ($isTextarea): ?>
                                    <textarea 
                                        class="<?=$inputClass?>" 
                                        name="<?=$fieldName?>" 
                                        placeholder="<?=$placeholder?>"<?=$required?>></textarea>
                                <?php else: ?>
                                    <input 
                                        class="<?=$inputClass?>" 
                                        name="<?=$fieldName?>" 
                                        placeholder="<?=$placeholder?>" 
                                        type="<?=$inputType?>"<?=$required?>>
                                <?php endif; ?>
                                <label class="ui-placeholder__label">
                                    <?=htmlspecialchars($arQuestion["CAPTION"])?>
                                    <?php if($arQuestion["REQUIRED"] == "Y"): ?>
                                        <sup>*</sup>
                                    <?php endif; ?>
                                </label>
                            </div>
                        </div>
                        
                    <?php endforeach; ?>
                </div>
                
                <?php if($arResult["isUseCaptcha"] == "Y" && !empty($arResult["CAPTCHACode"])): ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div style="margin: 20px 0; display: flex; align-items: center; gap: 20px;">
                                <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHACode"]?>">
                                <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHACode"]?>" 
                                     alt="CAPTCHA" 
                                     style="border: 1px solid #ddd; border-radius: 4px;">
                                <div class="ui-placeholder" style="flex: 1; max-width: 300px;">
                                    <input 
                                        class="ui-placeholder__input" 
                                        type="text" 
                                        name="captcha_word" 
                                        placeholder="Введите код с картинки"
                                        required>
                                    <label class="ui-placeholder__label">Код с картинки <sup>*</sup></label>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <label class="ui-check">
                    <input class="ui-check__input" name="agree" type="checkbox" required>
                    <span class="ui-check__checkbox"></span>
                    <span class="ui-check__text">Согласен и ознакомлен c 
                        <a href="<?=htmlspecialchars($arParams['PRIVACY_URL'] ?: '#')?>">политикой конфиденциальности</a> и 
                        <a href="<?=htmlspecialchars($arParams['PERSONAL_DATA_URL'] ?: '#')?>">обработкой персональных данных</a>
                    </span>
                </label>
                
                <div class="ui-action">
                    <button class="ui-btn ui-btn--dark" type="submit">
                        <?=htmlspecialchars($arParams['BUTTON_TEXT'] ?: 'отправить')?>
                    </button>
                </div>
            </form>
            
        <?php else: ?>
            <div class="feedback__success" style="background: #efe; border: 1px solid #cfc; padding: 30px; margin-top: 20px; text-align: center; border-radius: 5px;">
                <p style="color: #060; font-size: 18px; margin: 0;"><?=$arResult["FORM_NOTE"]?></p>
            </div>
        <?php endif; ?>
        
    </div>
</section>