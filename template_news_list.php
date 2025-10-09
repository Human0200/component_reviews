<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

// Получаем ID элемента, если он доступен в контексте
$elementId = $arParams['ELEMENT_ID'] ?? 0;
?>

<div class="w-100 d-flex flex-column py-3">
	<a class="d-flex justify-content-between collapse-item text-uppercase border-bottom-pink" id="reviewlink" data-bs-toggle="collapse" href="#review" role="button" aria-expanded="true" aria-controls="">
		<div>
			<span>
				Отзывы
			</span>
		</div>
		<div>
			<svg width="18" height="11" viewBox="0 0 18 11" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M16.293 0.793457L17.7072 2.20767L9.00008 10.9148L0.292969 2.20767L1.70718 0.793457L9.00008 8.08635L16.293 0.793457Z" fill="#BF1E77" />
			</svg>
		</div>
	</a>
	<div class="collapse body-collapse pt-3" id="review">
		<div class="">
			<div class="row">
				<?php
				//print_r($arParams);
				// Включаем компонент списка отзывов
				$APPLICATION->IncludeComponent(
					"leadspace:reviews.list",
					".default",
					[
						"PRODUCT_ID" => $elementId,
						"IBLOCK_ID" => "29",
						"IBLOCK_CODE" => "product_reviews",
						"IBLOCK_TYPE" => "reviews",
						"PAGE_SIZE" => "10",
						"SORT_ORDER" => "DESC",
						"SHOW_GUEST_NAME" => "Гость",
						"DATE_FORMAT" => "d.m.Y",
						"CACHE_TIME" => 3600,
						"CACHE_TYPE" => "N"
					],
					false
				);
				$APPLICATION->IncludeComponent(
					"leadspace:reviews.form",
					"",
					[
						"PRODUCT_ID" => $elementId, // ID товара
						"IBLOCK_ID" => 29,   // ID инфоблока отзывов
						"IBLOCK_TYPE" => "reviews",
						"BUTTON_TEXT" => "Написать отзыв",
						"BUTTON_COLOR" => "#BF1E77",
						"CACHE_TYPE" => "N"
					]
				);
				?>
			</div>
		</div>
	</div>
</div>