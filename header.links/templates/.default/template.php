<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!empty($arResult['LINKS'])): 
?>
<ul class="header__nav-menu">
    <?php foreach ($arResult['LINKS'] as $link): 
        // Определяем классы для ссылок
        $linkClass = 'header__nav-link';
        $linkAttrs = '';
        
        // Для якорных ссылок добавляем js-scrollto
        if (strpos($link['UF_LINK'], '#') === 0 && $link['UF_LINK'] !== '#modal-feedback') {
            $linkClass .= ' js-scrollto';
        }
        
        // Для модального окна добавляем data-fancybox
        if ($link['UF_LINK'] === '#modal-feedback') {
            $linkAttrs = ' data-fancybox';
            $linkContent = '<u>' . htmlspecialcharsbx($link['UF_NAME']) . '</u>';
        } else {
            $linkContent = htmlspecialcharsbx($link['UF_NAME']);
        }
    ?>
        <li>
            <a class="<?=$linkClass?>" href="<?=htmlspecialcharsbx($link['UF_LINK'])?>"<?=$linkAttrs?>>
                <?=$linkContent?>
            </a>
        </li>
    <?php endforeach; ?>
    
    <!-- Статические ссылки, которые всегда должны быть в меню 
    <li>
        <a class="header__nav-link js-scrollto" href="/#solutions">Готовые решения</a>
    </li>
    <li>
        <a class="header__nav-link js-scrollto" href="/#individual">Индивидуальное внедрение</a>
    </li>
    <li>
        <a class="header__nav-link js-scrollto" href="/#cases">Кейсы</a>
    </li>
    <li>
        <a class="header__nav-link js-scrollto" href="/#about">О компании</a>
    </li> -->
    <li>
        <a class="header__nav-link" data-fancybox href="#modal-feedback">
            <u>Связаться</u>
        </a>
    </li>
</ul>
<?php endif; ?>