<!-- /local/templates/tkani/components/bitrix/catalog/main -->
<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

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

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$this->setFrameMode(true);

if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y')
{
	$basketAction = (isset($arParams['COMMON_ADD_TO_BASKET_ACTION']) ? array($arParams['COMMON_ADD_TO_BASKET_ACTION']) : array());
}
else
{
	$basketAction = (isset($arParams['DETAIL_ADD_TO_BASKET_ACTION']) ? $arParams['DETAIL_ADD_TO_BASKET_ACTION'] : array());
}

$isSidebar = ($arParams['SIDEBAR_DETAIL_SHOW'] == 'Y' && !empty($arParams['SIDEBAR_PATH']));
?>
<div class="section__product-review">

	
		<?

        $componentElementParams = array(
			'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
			'IBLOCK_ID' => $arParams['IBLOCK_ID'],
			'PROPERTY_CODE' => (isset($arParams['DETAIL_PROPERTY_CODE']) ? $arParams['DETAIL_PROPERTY_CODE'] : []),
			'META_KEYWORDS' => $arParams['DETAIL_META_KEYWORDS'],
			'META_DESCRIPTION' => $arParams['DETAIL_META_DESCRIPTION'],
			'BROWSER_TITLE' => $arParams['DETAIL_BROWSER_TITLE'],
			'SET_CANONICAL_URL' => $arParams['DETAIL_SET_CANONICAL_URL'],
			'BASKET_URL' => $arParams['BASKET_URL'],
			'SHOW_SKU_DESCRIPTION' => $arParams['SHOW_SKU_DESCRIPTION'],
			'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
			'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
			'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
			'CHECK_SECTION_ID_VARIABLE' => (isset($arParams['DETAIL_CHECK_SECTION_ID_VARIABLE']) ? $arParams['DETAIL_CHECK_SECTION_ID_VARIABLE'] : ''),
			'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
			'CACHE_TYPE' => $arParams['CACHE_TYPE'],
			'CACHE_TIME' => $arParams['CACHE_TIME'],
			'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
			'SET_TITLE' => $arParams['SET_TITLE'],
			'SET_LAST_MODIFIED' => $arParams['SET_LAST_MODIFIED'],
			'MESSAGE_404' => $arParams['~MESSAGE_404'],
			'SET_STATUS_404' => $arParams['SET_STATUS_404'],
			'SHOW_404' => $arParams['SHOW_404'],
			'FILE_404' => $arParams['FILE_404'],
			'PRICE_CODE' => $arParams['~PRICE_CODE'],
			'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
			'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
			'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
			'PRICE_VAT_SHOW_VALUE' => $arParams['PRICE_VAT_SHOW_VALUE'],
			'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'PRODUCT_PROPERTIES' => (isset($arParams['PRODUCT_PROPERTIES']) ? $arParams['PRODUCT_PROPERTIES'] : []),
			'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
			'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
			'LINK_IBLOCK_TYPE' => $arParams['LINK_IBLOCK_TYPE'],
			'LINK_IBLOCK_ID' => $arParams['LINK_IBLOCK_ID'],
			'LINK_PROPERTY_SID' => $arParams['LINK_PROPERTY_SID'],
			'LINK_ELEMENTS_URL' => $arParams['LINK_ELEMENTS_URL'],

			'OFFERS_CART_PROPERTIES' => (isset($arParams['OFFERS_CART_PROPERTIES']) ? $arParams['OFFERS_CART_PROPERTIES'] : []),
			'OFFERS_FIELD_CODE' => $arParams['DETAIL_OFFERS_FIELD_CODE'],
			'OFFERS_PROPERTY_CODE' => (isset($arParams['DETAIL_OFFERS_PROPERTY_CODE']) ? $arParams['DETAIL_OFFERS_PROPERTY_CODE'] : []),
			'OFFERS_SORT_FIELD' => $arParams['OFFERS_SORT_FIELD'],
			'OFFERS_SORT_ORDER' => $arParams['OFFERS_SORT_ORDER'],
			'OFFERS_SORT_FIELD2' => $arParams['OFFERS_SORT_FIELD2'],
			'OFFERS_SORT_ORDER2' => $arParams['OFFERS_SORT_ORDER2'],

			'ELEMENT_ID' => $arResult['VARIABLES']['ELEMENT_ID'],
			'ELEMENT_CODE' => $arResult['VARIABLES']['ELEMENT_CODE'],
			'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
			'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
			'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
			'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
			'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
			'CURRENCY_ID' => $arParams['CURRENCY_ID'],
			'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
			'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],
			'USE_ELEMENT_COUNTER' => $arParams['USE_ELEMENT_COUNTER'],
			'SHOW_DEACTIVATED' => $arParams['SHOW_DEACTIVATED'],
			'USE_MAIN_ELEMENT_SECTION' => $arParams['USE_MAIN_ELEMENT_SECTION'],
			'STRICT_SECTION_CHECK' => (isset($arParams['DETAIL_STRICT_SECTION_CHECK']) ? $arParams['DETAIL_STRICT_SECTION_CHECK'] : ''),
			'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
			'LABEL_PROP' => $arParams['LABEL_PROP'],
			'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
			'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
			'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
			'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
			'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
			'DISCOUNT_PERCENT_POSITION' => (isset($arParams['DISCOUNT_PERCENT_POSITION']) ? $arParams['DISCOUNT_PERCENT_POSITION'] : ''),
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
			'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
			'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
			'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
			'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
			'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
			'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
			'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
			'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
			'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
			'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
			'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),
			'MESS_PRICE_RANGES_TITLE' => (isset($arParams['~MESS_PRICE_RANGES_TITLE']) ? $arParams['~MESS_PRICE_RANGES_TITLE'] : ''),
			'MESS_DESCRIPTION_TAB' => (isset($arParams['~MESS_DESCRIPTION_TAB']) ? $arParams['~MESS_DESCRIPTION_TAB'] : ''),
			'MESS_PROPERTIES_TAB' => (isset($arParams['~MESS_PROPERTIES_TAB']) ? $arParams['~MESS_PROPERTIES_TAB'] : ''),
			'MESS_COMMENTS_TAB' => (isset($arParams['~MESS_COMMENTS_TAB']) ? $arParams['~MESS_COMMENTS_TAB'] : ''),
			'MAIN_BLOCK_PROPERTY_CODE' => (isset($arParams['DETAIL_MAIN_BLOCK_PROPERTY_CODE']) ? $arParams['DETAIL_MAIN_BLOCK_PROPERTY_CODE'] : ''),
			'MAIN_BLOCK_OFFERS_PROPERTY_CODE' => (isset($arParams['DETAIL_MAIN_BLOCK_OFFERS_PROPERTY_CODE']) ? $arParams['DETAIL_MAIN_BLOCK_OFFERS_PROPERTY_CODE'] : ''),
			'USE_VOTE_RATING' => $arParams['DETAIL_USE_VOTE_RATING'],
			'VOTE_DISPLAY_AS_RATING' => (isset($arParams['DETAIL_VOTE_DISPLAY_AS_RATING']) ? $arParams['DETAIL_VOTE_DISPLAY_AS_RATING'] : ''),
			'USE_COMMENTS' => $arParams['DETAIL_USE_COMMENTS'],
			'BLOG_USE' => (isset($arParams['DETAIL_BLOG_USE']) ? $arParams['DETAIL_BLOG_USE'] : ''),
			'BLOG_URL' => (isset($arParams['DETAIL_BLOG_URL']) ? $arParams['DETAIL_BLOG_URL'] : ''),
			'BLOG_EMAIL_NOTIFY' => (isset($arParams['DETAIL_BLOG_EMAIL_NOTIFY']) ? $arParams['DETAIL_BLOG_EMAIL_NOTIFY'] : ''),
			'VK_USE' => (isset($arParams['DETAIL_VK_USE']) ? $arParams['DETAIL_VK_USE'] : ''),
			'VK_API_ID' => (isset($arParams['DETAIL_VK_API_ID']) ? $arParams['DETAIL_VK_API_ID'] : 'API_ID'),
			'FB_USE' => (isset($arParams['DETAIL_FB_USE']) ? $arParams['DETAIL_FB_USE'] : ''),
			'FB_APP_ID' => (isset($arParams['DETAIL_FB_APP_ID']) ? $arParams['DETAIL_FB_APP_ID'] : ''),
			'BRAND_USE' => (isset($arParams['DETAIL_BRAND_USE']) ? $arParams['DETAIL_BRAND_USE'] : 'N'),
			'BRAND_PROP_CODE' => (isset($arParams['DETAIL_BRAND_PROP_CODE']) ? $arParams['DETAIL_BRAND_PROP_CODE'] : ''),
			'DISPLAY_NAME' => (isset($arParams['DETAIL_DISPLAY_NAME']) ? $arParams['DETAIL_DISPLAY_NAME'] : ''),
			'IMAGE_RESOLUTION' => (isset($arParams['DETAIL_IMAGE_RESOLUTION']) ? $arParams['DETAIL_IMAGE_RESOLUTION'] : ''),
			'PRODUCT_INFO_BLOCK_ORDER' => (isset($arParams['DETAIL_PRODUCT_INFO_BLOCK_ORDER']) ? $arParams['DETAIL_PRODUCT_INFO_BLOCK_ORDER'] : ''),
			'PRODUCT_PAY_BLOCK_ORDER' => (isset($arParams['DETAIL_PRODUCT_PAY_BLOCK_ORDER']) ? $arParams['DETAIL_PRODUCT_PAY_BLOCK_ORDER'] : ''),
			'ADD_DETAIL_TO_SLIDER' => (isset($arParams['DETAIL_ADD_DETAIL_TO_SLIDER']) ? $arParams['DETAIL_ADD_DETAIL_TO_SLIDER'] : ''),
			'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
			'ADD_SECTIONS_CHAIN' => (isset($arParams['ADD_SECTIONS_CHAIN']) ? $arParams['ADD_SECTIONS_CHAIN'] : ''),
			'ADD_ELEMENT_CHAIN' => (isset($arParams['ADD_ELEMENT_CHAIN']) ? $arParams['ADD_ELEMENT_CHAIN'] : ''),
			'DISPLAY_PREVIEW_TEXT_MODE' => (isset($arParams['DETAIL_DISPLAY_PREVIEW_TEXT_MODE']) ? $arParams['DETAIL_DISPLAY_PREVIEW_TEXT_MODE'] : ''),
			'DETAIL_PICTURE_MODE' => (isset($arParams['DETAIL_DETAIL_PICTURE_MODE']) ? $arParams['DETAIL_DETAIL_PICTURE_MODE'] : array()),
			'ADD_TO_BASKET_ACTION' => $basketAction,
			'ADD_TO_BASKET_ACTION_PRIMARY' => (isset($arParams['DETAIL_ADD_TO_BASKET_ACTION_PRIMARY']) ? $arParams['DETAIL_ADD_TO_BASKET_ACTION_PRIMARY'] : null),
			'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
			'DISPLAY_COMPARE' => (isset($arParams['USE_COMPARE']) ? $arParams['USE_COMPARE'] : ''),
			'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
			'USE_COMPARE_LIST' => 'Y',
			'BACKGROUND_IMAGE' => (isset($arParams['DETAIL_BACKGROUND_IMAGE']) ? $arParams['DETAIL_BACKGROUND_IMAGE'] : ''),
			'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
			'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),
			'SET_VIEWED_IN_COMPONENT' => (isset($arParams['DETAIL_SET_VIEWED_IN_COMPONENT']) ? $arParams['DETAIL_SET_VIEWED_IN_COMPONENT'] : ''),
			'SHOW_SLIDER' => (isset($arParams['DETAIL_SHOW_SLIDER']) ? $arParams['DETAIL_SHOW_SLIDER'] : ''),
			'SLIDER_INTERVAL' => (isset($arParams['DETAIL_SLIDER_INTERVAL']) ? $arParams['DETAIL_SLIDER_INTERVAL'] : ''),
			'SLIDER_PROGRESS' => (isset($arParams['DETAIL_SLIDER_PROGRESS']) ? $arParams['DETAIL_SLIDER_PROGRESS'] : ''),
			'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
			'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
			'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

			'USE_GIFTS_DETAIL' => $arParams['USE_GIFTS_DETAIL']?: 'Y',
			'USE_GIFTS_MAIN_PR_SECTION_LIST' => $arParams['USE_GIFTS_MAIN_PR_SECTION_LIST']?: 'Y',
			'GIFTS_SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
			'GIFTS_SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'],
			'GIFTS_DETAIL_PAGE_ELEMENT_COUNT' => $arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT'],
			'GIFTS_DETAIL_HIDE_BLOCK_TITLE' => $arParams['GIFTS_DETAIL_HIDE_BLOCK_TITLE'],
			'GIFTS_DETAIL_TEXT_LABEL_GIFT' => $arParams['GIFTS_DETAIL_TEXT_LABEL_GIFT'],
			'GIFTS_DETAIL_BLOCK_TITLE' => $arParams['GIFTS_DETAIL_BLOCK_TITLE'],
			'GIFTS_SHOW_NAME' => $arParams['GIFTS_SHOW_NAME'],
			'GIFTS_SHOW_IMAGE' => $arParams['GIFTS_SHOW_IMAGE'],
			'GIFTS_MESS_BTN_BUY' => $arParams['~GIFTS_MESS_BTN_BUY'],
			'GIFTS_PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
			'GIFTS_SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
			'GIFTS_SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
			'GIFTS_SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

			'GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT' => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT'],
			'GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE' => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE'],
			'GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE' => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE'],
		);

		if (isset($arParams['USER_CONSENT']))
		{
			$componentElementParams['USER_CONSENT'] = $arParams['USER_CONSENT'];
		}

		if (isset($arParams['USER_CONSENT_ID']))
		{
			$componentElementParams['USER_CONSENT_ID'] = $arParams['USER_CONSENT_ID'];
		}

		if (isset($arParams['USER_CONSENT_IS_CHECKED']))
		{
			$componentElementParams['USER_CONSENT_IS_CHECKED'] = $arParams['USER_CONSENT_IS_CHECKED'];
		}

		if (isset($arParams['USER_CONSENT_IS_LOADED']))
		{
			$componentElementParams['USER_CONSENT_IS_LOADED'] = $arParams['USER_CONSENT_IS_LOADED'];
		}

		$elementId = $APPLICATION->IncludeComponent(
			'bitrix:catalog.element',
			'',
			$componentElementParams,
			$component
		);
		?></div><?
		$GLOBALS['CATALOG_CURRENT_ELEMENT_ID'] = $elementId;
		$analogs = [];
		$db_props = CIBlockElement::GetProperty($arParams["IBLOCK_ID"], $elementId, array("sort" => "asc"), Array("CODE"=>"ANALOGS"));
		while($ar_props = $db_props->Fetch()){
			if($ar_props["VALUE"])
			$analogs[]=$ar_props["VALUE"];
		
		}
		if(!empty($analogs)){
			
	global $filterHit;
	$filterHit["ID"]=$analogs;?>
    <div id="analog_from_here"><?
    $APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"analogs",
	Array(
		"TITLE_SLIDER"=>"Хиты продаж",
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"ENLARGE_PRODUCT" => "STRICT",
		"FILTER_NAME" => "filterHit",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => array(),
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_LAZY_LOAD" => "Показать ещё",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_FIELD_CODE" => array("PREVIEW_TEXT","PREVIEW_PICTURE",""),
		"OFFERS_LIMIT" => "5",
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "desc",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "18",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array("BASE"),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"PRODUCT_DISPLAY_MODE" => "N",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_ROW_VARIANTS" => "[{\"VARIANT\":2,\"BIG_DATA\":false},{\"VARIANT\":2,\"BIG_DATA\":false},{\"VARIANT\":2,\"BIG_DATA\":false},{\"VARIANT\":2,\"BIG_DATA\":false},{\"VARIANT\":2,\"BIG_DATA\":false},{\"VARIANT\":2,\"BIG_DATA\":false}]",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"PROPERTY_CODE_MOBILE" => array(),
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("",""),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "Y",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);
    ?>
        </div>
            <?
		}
		
		
		if ($elementId > 0)
		{
			

			$recommendedData = array();
			$recommendedCacheId = array('IBLOCK_ID' => $arParams['IBLOCK_ID']);

			$obCache = new CPHPCache();
			if ($obCache->InitCache(36000, serialize($recommendedCacheId), '/catalog/recommended'))
			{
				$recommendedData = $obCache->GetVars();
			}
			elseif ($obCache->StartDataCache())
			{
				if (Loader::includeModule('catalog'))
				{
					$arSku = CCatalogSku::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
					$recommendedData['OFFER_IBLOCK_ID'] = (!empty($arSku) ? $arSku['IBLOCK_ID'] : 0);
					$recommendedData['IBLOCK_LINK'] = '';
					$recommendedData['ALL_LINK'] = '';
					$rsProps = CIBlockProperty::GetList(
						array('SORT' => 'ASC', 'ID' => 'ASC'),
						array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'PROPERTY_TYPE' => 'E', 'ACTIVE' => 'Y')
					);
					$found = false;
					while ($arProp = $rsProps->Fetch())
					{
						if ($found)
						{
							break;
						}

						if ($arProp['CODE'] == '')
						{
							$arProp['CODE'] = $arProp['ID'];
						}

						$arProp['LINK_IBLOCK_ID'] = intval($arProp['LINK_IBLOCK_ID']);
						if ($arProp['LINK_IBLOCK_ID'] != 0 && $arProp['LINK_IBLOCK_ID'] != $arParams['IBLOCK_ID'])
						{
							continue;
						}

						if ($arProp['LINK_IBLOCK_ID'] > 0)
						{
							if ($recommendedData['IBLOCK_LINK'] == '')
							{
								$recommendedData['IBLOCK_LINK'] = $arProp['CODE'];
								$found = true;
							}
						}
						else
						{
							if ($recommendedData['ALL_LINK'] == '')
							{
								$recommendedData['ALL_LINK'] = $arProp['CODE'];
							}
						}
					}

					if ($found)
					{
						if (defined('BX_COMP_MANAGED_CACHE'))
						{
							global $CACHE_MANAGER;
							$CACHE_MANAGER->StartTagCache('/catalog/recommended');
							$CACHE_MANAGER->RegisterTag('iblock_id_'.$arParams['IBLOCK_ID']);
							$CACHE_MANAGER->EndTagCache();
						}
					}
				}

				$obCache->EndDataCache($recommendedData);
			}

			if (!empty($recommendedData))
			{
				if ((!empty($recommendedData['IBLOCK_LINK']) || !empty($recommendedData['ALL_LINK']))&&false)
				{
					?>
					
							<div class="d-flex justify-content-center w-100">
								<div class="bg-viewed1">
									<h1>
										С этим товаром покупают
									</h1>
								</div>

							</div>
							<?
							$APPLICATION->IncludeComponent(
								'bitrix:catalog.recommended.products',
								'',
								array(
									'ID' => $elementId,
									'IBLOCK_ID' => $arParams['IBLOCK_ID'],
									'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
									'PROPERTY_LINK' => (!empty($recommendedData['IBLOCK_LINK']) ? $recommendedData['IBLOCK_LINK'] : $recommendedData['ALL_LINK']),
									'CACHE_TYPE' => $arParams['CACHE_TYPE'],
									'CACHE_TIME' => $arParams['CACHE_TIME'],
									'CACHE_FILTER' => $arParams['CACHE_FILTER'],
									'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
									'BASKET_URL' => $arParams['BASKET_URL'],
									'ACTION_VARIABLE' => (!empty($arParams['ACTION_VARIABLE']) ? $arParams['ACTION_VARIABLE'] : 'action').'_crp',
									'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
									'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
									'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
									'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
									'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
									'PAGE_ELEMENT_COUNT' => $arParams['ALSO_BUY_ELEMENT_COUNT'],
									'LINE_ELEMENT_COUNT' => $arParams['ALSO_BUY_ELEMENT_COUNT'],
									'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
									'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
									'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
									'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
									'PRICE_CODE' => $arParams['~PRICE_CODE'],
									'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
									'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
									'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
									'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
									'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
									'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
									'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
									'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
									'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
									'ADD_TO_BASKET_ACTION' => $basketAction,
									'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',

									'ELEMENT_SORT_FIELD' => $arParams['ELEMENT_SORT_FIELD'],
									'ELEMENT_SORT_ORDER' => $arParams['ELEMENT_SORT_ORDER'],
									'ELEMENT_SORT_FIELD2' => $arParams['ELEMENT_SORT_FIELD2'],
									'ELEMENT_SORT_ORDER2' => $arParams['ELEMENT_SORT_ORDER2'],

									'SET_TITLE' => 'N',
									'SET_BROWSER_TITLE' => 'N',
									'SET_META_KEYWORDS' => 'N',
									'SET_META_DESCRIPTION' => 'N',
									'SET_LAST_MODIFIED' => 'N',
									'ADD_SECTIONS_CHAIN' => 'N',

									'HIDE_BLOCK_TITLE' => 'Y',
									'SHOW_NAME' => 'Y',
									'SHOW_IMAGE' => 'Y',

									'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
									'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
									'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
									'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
									'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
									'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

									'LABEL_PROP_MULTIPLE' => $arParams['LABEL_PROP'],
									'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
									'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],

									'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
									'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
									'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

									'SHOW_PRODUCTS_'.$arParams['IBLOCK_ID'] => 'Y',
									'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
									'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],
									'OFFERS_FIELD_CODE' => $arParams['LIST_OFFERS_FIELD_CODE'],
									'PROPERTY_CODE_'.$arParams['IBLOCK_ID'] => (isset($arParams['LIST_PROPERTY_CODE']) ? $arParams['LIST_PROPERTY_CODE'] : []),
									'PROPERTY_CODE_MOBILE' => $arParams['LIST_PROPERTY_CODE_MOBILE'],
									'PROPERTY_CODE_'.$recommendedData['OFFER_IBLOCK_ID'] => (isset($arParams['LIST_OFFERS_PROPERTY_CODE']) ?  $arParams['LIST_OFFERS_PROPERTY_CODE'] : []),
									'CART_PROPERTIES_'.$arParams['IBLOCK_ID'] => (isset($arParams['PRODUCT_PROPERTIES']) ? $arParams['PRODUCT_PROPERTIES'] : []),
									'CART_PROPERTIES_'.$recommendedData['OFFER_IBLOCK_ID'] => (isset($arParams['OFFERS_CART_PROPERTIES']) ? $arParams['OFFERS_CART_PROPERTIES'] : []),
									'OFFER_TREE_PROPS_'.$recommendedData['OFFER_IBLOCK_ID'] => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
									'ADDITIONAL_PICT_PROP_'.$arParams['IBLOCK_ID'] => $arParams['ADD_PICT_PROP'],
									'ADDITIONAL_PICT_PROP_'.$recommendedData['OFFER_IBLOCK_ID'] => $arParams['OFFER_ADD_PICT_PROP'],
									'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
									'CURRENCY_ID' => $arParams['CURRENCY_ID'],

									'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
									'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
									'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),
								),
								$component
							);
							?>
					
					<?
				}

				if (!isset($arParams['DETAIL_SHOW_POPULAR']) || $arParams['DETAIL_SHOW_POPULAR'] != 'N')
				{
					?>
					<div class="d-flex justify-content-center w-100">
								<div class="bg-viewed1">
<!--                                    HERE-->
									<h1>
										С этим товаром покупают
									</h1>
								</div>

							</div>


							<?
                    $iblockId = 2;

                    $arFilter1 = array(
                        'IBLOCK_ID' => $iblockId, // Укажите ID вашего инфоблока
                        'ACTIVE'    => 'Y',
                        'CODE' => $arResult['VARIABLES']['SECTION_CODE'],// Выбрать только активные разделы
                    );

                    $arSort = array(
                        'SORT' => 'ASC', // Сортировка по индексу сортировки
                        'NAME' => 'ASC'  // Сортировка по названию
                    );

                    $arSelect = array(
                        'ID',
                        'NAME',
                        'DESCRIPTION',
                        'PICTURE',
                        'SECTION_ID',
                    );

                    $parentSectionId = \App\CustomElementSection::getMainParentSectionId($arResult['VARIABLES']['SECTION_CODE']);

                    $parentSectionIdParent = 0;
                    $specificSectionIds = [];

                    if($parentSectionId == 3118){
                        $sectionNum = 1;

                    } elseif ($parentSectionId == 2914){
                        $sectionNum = 2;
                    } elseif($parentSectionId == 2882){
                        $sectionNum = 3;
                    } elseif($parentSectionId == 2852){
                        $sectionNum = 4;
                    } elseif($parentSectionId == 2864){
                        $sectionNum = 5;
                    }

                    ?>

                    <?php
                    //$arResult['VARIABLES']['ELEMENT_CODE']
                    function getProductColor($elementCode)
                    {
                        CModule::IncludeModule('iblock');
                        $color = CIBlockElement::GetList(
                            [],
                            ['IBLOCK_ID' => 2, 'CODE' => $elementCode],
                        )->GetNextElement()->GetProperties()['COLOR']['VALUE_ENUM_ID'];

                        return $color;
                    }
                    function getProductColorName($elementCode)
                    {
                        CModule::IncludeModule('iblock');
                        $color = CIBlockElement::GetList(
                            [],
                            ['IBLOCK_ID' => 2, 'CODE' => $elementCode],
                        )->GetNextElement()->GetProperties()['COLOR']['VALUE'];

                        return $color;
                    }
                    $productColor = getProductColor($arResult['VARIABLES']['ELEMENT_CODE']);
                    $productColorName = getProductColorName($arResult['VARIABLES']['ELEMENT_CODE']);
                    ?>
                        <div class="d-flex align-items-center justify-content-center offer__filter"><?

                    if($sectionNum == 1){
                        //Швейная фурнитура?>
                        <a href="?SECTION_ID=3273#filterPost" class="d-block">
                                <div class="offer__filter__block d-flex flex-column align-items-center">
                                    <div>
                                        <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/Nitki.png" class="w-100 img-fluid" alt="">
                                    </div>
                                    <div>
                                        Нитки
                                    </div>
                                </div>
                        </a>
                        <a href="?SECTION_ID=2914#filterPost" class="d-block">
                            <div class="offer__filter__block d-flex flex-column align-items-center">
                                <div>
                                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/Rulon.png" class="w-100 img-fluid" alt="">
                                </div>
                                <div>
                                    Ткани Одеждные
                                </div>
                            </div>
                        </a>

                        <a href="?SECTION_ID=3210#filterPost" class="d-block">
                            <div class="offer__filter__block d-flex flex-column align-items-center">
                                <div>
                                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/Kruzevo.png" class="w-100 img-fluid" alt="">
                                </div>
                                <div>
                                    Кружево
                                </div>
                            </div>
                        </a>

                        <a href="?SECTION_ID=2835#filterPost">
                            <div class="offer__filter__block d-flex flex-column align-items-center">
                                <div>
                                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/Pryza.png" class="w-100 img-fluid" alt="">
                                </div>
                                <div>
                                    Все для шитья и рукоделия
                                </div>
                            </div>
                        </a>
                        <?


                    } elseif ($sectionNum == 2){ ?>
                        <a href="?SECTION_ID=3273#filterPost" class="d-block">
                            <div class="offer__filter__block d-flex flex-column align-items-center">
                                <div>
                                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/Nitki.png" class="w-100 img-fluid" alt="">
                                </div>
                                <div>
                                    Нитки
                                </div>
                            </div>
                        </a>
                        <a href="?SECTION_ID=3296#filterPost" class="d-block">
                            <div class="offer__filter__block d-flex flex-column align-items-center">
                                <div>
                                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/baton.png" class="w-100 img-fluid" alt="">
                                </div>
                                <div>
                                    Пуговицы
                                </div>
                            </div>
                        </a>
                        <a href="?SECTION_ID=3254#filterPost" class="d-block">
                            <div class="offer__filter__block d-flex flex-column align-items-center">
                                <div>
                                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/zip.png" class="w-100 img-fluid" alt="">
                                </div>
                                <div>
                                    Молнии
                                </div>
                            </div>
                        </a>
                        <a href="?SECTION_ID=3210#filterPost" class="d-block">
                            <div class="offer__filter__block d-flex flex-column align-items-center">
                                <div>
                                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/Kruzevo.png" class="w-100 img-fluid" alt="">
                                </div>
                                <div>
                                    Кружево
                                </div>
                            </div>
                        </a>
                    <?} elseif ($sectionNum == 3){
                        //Для постельного и интерьера?>
                            <a href="?SECTION_ID=3273#filterPost" class="d-block">
                                <div class="offer__filter__block d-flex flex-column align-items-center">
                                    <div>
                                        <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/Nitki.png" class="w-100 img-fluid" alt="">
                                    </div>
                                    <div>
                                        Нитки
                                    </div>
                                </div>
                            </a>
                    <?} elseif ($sectionNum == 4){
                        //Мебельные?>
                            <a href="?SECTION_ID=3273#filterPost" class="d-block">
                                <div class="offer__filter__block d-flex flex-column align-items-center">
                                    <div>
                                        <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/Nitki.png" class="w-100 img-fluid" alt="">
                                    </div>
                                    <div>
                                        Нитки
                                    </div>
                                </div>
                            </a>
                    <?} elseif ($sectionNum == 5){
                        //Пряжа?>
                        <a href="?SECTION_ID=3410#filterPost" class="d-block">
                            <div class="offer__filter__block d-flex flex-column align-items-center">
                                <div>
                                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/Pryza.png" class="w-100 img-fluid" alt="">
                                </div>
                                <div>
                                    Инструменты для вязания
                                </div>
                            </div>
                        </a>
                        <a href="?SECTION_ID=2838#filterPost" class="d-block">
                            <div class="offer__filter__block d-flex flex-column align-items-center">
                                <div>
                                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/bysi.png" class="w-100 img-fluid" alt="">
                                </div>
                                <div>
                                    Бусы
                                </div>
                            </div>
                        </a>
                    <?} else {
                        function getChilds(array $arr)
                        {
                            CModule::IncludeModule('iblock');
                            $result = [];
                            $ob = \Bitrix\Iblock\SectionTable::getList([
                                'filter' => ['IBLOCK_ID' => 2, 'IBLOCK_SECTION_ID' => $arr],
                                'select' => ['ID', 'CODE']
                            ]);
                            while($res = $ob->fetch())
                                $result[] = $res;

                            return $result;
                        }
                        function getElements(array $arr, $color)
                        {
                            CModule::IncludeModule('iblock');
                            $result = [];
//                                $ob = \Bitrix\Iblock\ElementTable::getList([
//                                    'filter' => ['IBLOCK_ID' => 2, 'IBLOCK_SECTION_ID' => $arr],
//                                    'select' => ['ID']
//                                ]);
                            $arFields = [];
                            if($color)
                                $arFields = ['IBLOCK_ID' => 2, 'IBLOCK_SECTION_ID' => $arr, '%PROPERTY_COLOR' => $color];
                            else
                                $arFields = ['IBLOCK_ID' => 2, 'IBLOCK_SECTION_ID' => $arr];

                            $ob = CIBlockElement::GetList(
                                [],
                                $arFields,
                            );




                            while($res = $ob->fetch())
                                $result[] = $res['ID'];

                            return $result;
                        }
                        function getSections($value)
                        {
                            CModule::IncludeModule('iblock');
                            $result = [];
                            $ob = CIBlockSection::GetList(
                                [],
                                ['IBLOCK_ID' => 2, 'UF_SECTION_TYPE' => $value]
                            );
                            while($res = $ob->fetch())
                                $result[] = $res['ID'];

                            return $result;
                        }
                        function getColor($codeElement)
                        {
                            CModule::IncludeModule('iblock');
                            $color = CIBlockElement::GetList(
                                [],
                                ['IBLOCK_ID' => 2, 'CODE' => $codeElement],
                            )->GetNextElement()->GetProperties()['COLOR']['VALUE_ENUM_ID'];

                            return $color;
                        }
                        function getValue($elementCode)
                        {
                            if(!CModule::IncludeModule('iblock'))
                                return false;

                            $sectionId = \Bitrix\Iblock\ElementTable::getList([
                                'filter' => [
                                    'CODE' => $elementCode,
                                    'IBLOCK_ID' => 2,
                                ],
                                'select' => ['IBLOCK_SECTION_ID']
                            ])->fetch()['IBLOCK_SECTION_ID'];

//                                var_dump($sectionId);

                            $result = CIBlockSection::GetList(
                                [],
                                ['IBLOCK_ID' => 2, 'ID' => $sectionId],
                                false,
                                ['UF_SECTION_TYPE']
                            )->Fetch()['UF_SECTION_TYPE'];

                            return $result;

                        }
                        function getCurSections($value, $color)
                        {
                            global $DB;

                            if(!CModule::IncludeModule('iblock'))
                                return false;
                            $sections = [];
                            $values = [];
                            foreach($value as $item)
                            {
                                $values[] = ['UF_SECTION_TYPE' => $item];
                            }
                            $values = array_merge(['LOGIC' => 'OR'], $values);
                            $obSection = CIBlockSection::GetList(
                                [],
                                [
                                    'IBLOCK_ID' => 2,
                                    //'UF_SECTION_TYPE' => $value
                                    $values
                                ],
                                false, ['*', 'UF_*']
                            );

                            while($resSection = $obSection->fetch())
                                $sections[] = $resSection['ID'];
                            //echo '<pre>'.print_r($sections,1).'</pre>';
                            $result = [];
                            if($color) {
                                $arFields = ['IBLOCK_ID' => 2, 'IBLOCK_SECTION_ID' => $sections, 'PROPERTY_COLOR' => $color];
                            }
                            else
                                $arFields = ['IBLOCK_ID' => 2, 'IBLOCK_SECTION_ID' => $sections];
                            $ob = CIBlockElement::GetList(
                                [],
                                $arFields,
                                false,
                                false,
                                ['*', 'PROPERTY_COLOR']
                            );
                            while($res = $ob->fetch())
                                $result[] = $res['ID'];
                            if(count($result) == 0)
                            {
                                $ob = CIBlockElement::GetList(
                                    [],
                                    ['IBLOCK_ID' => 2, 'IBLOCK_SECTION_ID' => $sections],
                                    false,
                                    false,
                                    ['*', 'PROPERTY_COLOR']
                                );
                                while($res = $ob->fetch())
                                    $result[] = $res['ID'];
                            }

                            return $result;
                        }
                        $filt = [];
                        $value = getValue($arResult['VARIABLES']['ELEMENT_CODE']);

                        if($value == 30)
                        {
                            $filt = getCurSections([29], getColor($arResult['VARIABLES']['ELEMENT_CODE']));
                        }
                        elseif($value == 29)
                        {
                            $filt = getCurSections([30, 41, 42, 43], getColor($arResult['VARIABLES']['ELEMENT_CODE']));
                        }
                        elseif($value == 43)
                        {
                            $filt = getCurSections([41, 42], getColor($arResult['VARIABLES']['ELEMENT_CODE']));
                        }
                        elseif($value == 41)
                        {
                            $filt = getCurSections([43, 42], getColor($arResult['VARIABLES']['ELEMENT_CODE']));
                        }
                        elseif($value == 42)
                        {
                            $filt = getCurSections([41, 43], getColor($arResult['VARIABLES']['ELEMENT_CODE']));
                        }
                        else
                        {
                            $filt = getCurSections([30], getColor($arResult['VARIABLES']['ELEMENT_CODE']));
                        }

                        $GLOBALS['arrFilterFav'] = array('ID' => $filt);

                        if(count($filt) > 0){
                            $APPLICATION->IncludeComponent(
                                'bitrix:catalog.section',
                                'offer',
                                array(
                                    "IN_PRODUCT"=>"Y",
                                    'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
                                    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
//									'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
//									'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
//                                    'SECTION_ID' => $textileSections,
                                    'ELEMENT_SORT_FIELD' => 'shows',
                                    'ELEMENT_SORT_ORDER' => 'desc',
                                    'ELEMENT_SORT_FIELD2' => 'sort',
                                    'ELEMENT_SORT_ORDER2' => 'asc',
                                    'PROPERTY_CODE' => (isset($arParams['LIST_PROPERTY_CODE']) ? $arParams['LIST_PROPERTY_CODE'] : []),
                                    'PROPERTY_CODE_MOBILE' => $arParams['LIST_PROPERTY_CODE_MOBILE'],
//									'INCLUDE_SUBSECTIONS' => $arParams['INCLUDE_SUBSECTIONS'],
                                    'BASKET_URL' => $arParams['BASKET_URL'],
                                    'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
                                    'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
//									'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
                                    'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
                                    'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
                                    'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                                    'CACHE_TIME' => $arParams['CACHE_TIME'],
                                    'CACHE_FILTER' => $arParams['CACHE_FILTER'],
                                    'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                                    'DISPLAY_COMPARE' => $arParams['USE_COMPARE'],
                                    'PRICE_CODE' => $arParams['~PRICE_CODE'],
                                    'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
                                    'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
                                    'PAGE_ELEMENT_COUNT' => 8,
                                    //'FILTER_IDS' => array('ID' => 27577),
                                    'FILTER_NAME' => 'arrFilterFav',

                                    "SET_TITLE" => "N",
                                    "SET_BROWSER_TITLE" => "N",
                                    "SET_META_KEYWORDS" => "N",
                                    "SET_META_DESCRIPTION" => "N",
                                    "SET_LAST_MODIFIED" => "N",
                                    "ADD_SECTIONS_CHAIN" => "N",

                                    'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
                                    'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
                                    'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
                                    'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
                                    'PRODUCT_PROPERTIES' => (isset($arParams['PRODUCT_PROPERTIES']) ? $arParams['PRODUCT_PROPERTIES'] : []),

                                    'OFFERS_CART_PROPERTIES' => (isset($arParams['OFFERS_CART_PROPERTIES']) ? $arParams['OFFERS_CART_PROPERTIES'] : []),
                                    'OFFERS_FIELD_CODE' => $arParams['LIST_OFFERS_FIELD_CODE'],
                                    'OFFERS_PROPERTY_CODE' => (isset($arParams['LIST_OFFERS_PROPERTY_CODE']) ? $arParams['LIST_OFFERS_PROPERTY_CODE'] : []),
                                    'OFFERS_SORT_FIELD' => $arParams['OFFERS_SORT_FIELD'],
                                    'OFFERS_SORT_ORDER' => $arParams['OFFERS_SORT_ORDER'],
                                    'OFFERS_SORT_FIELD2' => $arParams['OFFERS_SORT_FIELD2'],
                                    'OFFERS_SORT_ORDER2' => $arParams['OFFERS_SORT_ORDER2'],
                                    'OFFERS_LIMIT' => (isset($arParams['LIST_OFFERS_LIMIT']) ? $arParams['LIST_OFFERS_LIMIT'] : 0),

                                    'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
                                    'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
//									'USE_MAIN_ELEMENT_SECTION' => $arParams['USE_MAIN_ELEMENT_SECTION'],
                                    'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                                    'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                                    'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
                                    'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],

                                    'LABEL_PROP' => $arParams['LABEL_PROP'],
                                    'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
                                    'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
                                    'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                                    'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
                                    'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
                                    'PRODUCT_ROW_VARIANTS' => "[{'VARIANT':'3','BIG_DATA':false}]",
                                    'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
                                    'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
                                    'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
                                    'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
                                    'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

                                    'DISPLAY_TOP_PAGER' => 'N',
                                    'DISPLAY_BOTTOM_PAGER' => 'N',
                                    'HIDE_SECTION_DESCRIPTION' => 'Y',

                                    'RCM_TYPE' => isset($arParams['BIG_DATA_RCM_TYPE']) ? $arParams['BIG_DATA_RCM_TYPE'] : '',
                                    //'RCM_PROD_ID' => $elementId,
                                    //'RCM_PROD_ID' => 27577,
                                    'SHOW_FROM_SECTION' => 'Y',

                                    'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                                    'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
                                    'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                                    'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                                    'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
                                    'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                                    'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
                                    'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
                                    'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
                                    'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
                                    'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
                                    'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
                                    'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
                                    'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
                                    'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
                                    'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
                                    'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

                                    'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
                                    'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
                                    'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

                                    'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                                    'ADD_TO_BASKET_ACTION' => $basketAction,
                                    'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                                    'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                                    'COMPARE_NAME' => $arParams['COMPARE_NAME'],
                                    'USE_COMPARE_LIST' => 'Y',
                                    'BACKGROUND_IMAGE' => '',
                                    'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
                                ),
                                $component
                            );
                        } else {
                            echo '<div class="d-flex justify-content-center" style="font-size: 32px">

                                Товары Отсутствуют

                            </div>';
                        }
                    }

                        ?></div><?php





                    $APPLICATION->IncludeComponent(
                        "bitrix:catalog.smart.filter",
                        "filterOffer",
                        array(
                            "IBLOCK_TYPE" => "catalog", // Тип инфоблока
                            "IBLOCK_ID" => 2,   // ID инфоблока
                            "SECTION_ID" => $_REQUEST["SECTION_ID"], // Применение фильтра по SECTION_ID
                            //"FILTER_NAME" => "arrFilter", // Имя массива для фильтра
                            //"PRODUCT_COLOR" => $productColor,
                        ),
                        false
                    );

                    $sectionId = isset($_GET['SECTION_ID']) ? intval($_GET['SECTION_ID']) : 0;
//                    function getCurSections1($sectionId, $color)
//                    {
//                        if(!CModule::IncludeModule('iblock'))
//                            return false;
//
//                        if($color) {
//                            $arFields = ['IBLOCK_ID' => 2, 'IBLOCK_SECTION_ID' => $sectionId, 'PROPERTY_COLOR' => $color];
//                        }
//                        else
//                            $arFields = ['IBLOCK_ID' => 2, 'IBLOCK_SECTION_ID' => $sectionId];
//
//                        $ob = CIBlockElement::GetList(
//                            [],
//                            $arFields,
//                            false,
//                            false,
//                            ['*', 'PROPERTY_COLOR']
//                        );
//                        while($res = $ob->fetch())
//                            $result[] = $res['ID'];
//
//                        if(!$result)
//                        {
//                            $ob = CIBlockElement::GetList(
//                                [],
//                                ['IBLOCK_ID' => 2, 'IBLOCK_SECTION_ID' => $sectionId],
//                                false,
//                                false,
//                                ['*', 'PROPERTY_COLOR']
//                            );
//                            while($res = $ob->fetch())
//                                $result[] = $res['ID'];
//                        }
//
//                        return $result;
//                    }

                    if ($sectionId > 0) {
//                        var_dump($productColor);
////                        $filt = [];
//                        $resIsColor = CIBlockElement::GetList(
//                            [],
//                            [
//                                'IBLOCK_ID' => $iblockId,
//                                'IBLOCK_SECTION_ID' => $sectionId,
//                                //'PROPERTY_210_ENUM' => $productColor,
//                            ], false, false, ['ID']
//                        );
//                        watch($resIsColor);
                        $GLOBALS['arrFilter1'] = array('PROPERTY_COLOR_VALUE' => $productColorName);
                        //echo $productColor;
                        ?><div id="filterPost"><?
                            $APPLICATION->IncludeComponent(
                                "bitrix:catalog.section",
                                "offer",
                                array(
                                    "IBLOCK_TYPE" => "catalog", // Тип инфоблока
                                    "IBLOCK_ID" => $iblockId,   // ID инфоблока
                                    "SECTION_ID" => $sectionId, // ID выбранной секции
                                    "SECTION_CODE" => "",
                                    "SECTION_USER_FIELDS" => array(),
                                    "ELEMENT_SORT_FIELD" => "sort",
                                    "ELEMENT_SORT_ORDER" => "asc",
                                    "ELEMENT_SORT_FIELD2" => "id",
                                    "ELEMENT_SORT_ORDER2" => "desc",
//                                    "PRODUCT_COLOR" => $productColor,
                                    "FILTER_NAME" => "arrFilter1",
                                ),
                                false
                            );
                        ?></div><?php

                    }




//                    function getChilds(array $arr)
//                            {
//                                CModule::IncludeModule('iblock');
//                                $result = [];
//                                $ob = \Bitrix\Iblock\SectionTable::getList([
//                                    'filter' => ['IBLOCK_ID' => 2, 'IBLOCK_SECTION_ID' => $arr],
//                                    'select' => ['ID', 'CODE']
//                                ]);
//                                while($res = $ob->fetch())
//                                    $result[] = $res;
//
//                                return $result;
//                            }
//                    function getElements(array $arr, $color)
//                    {
//                        CModule::IncludeModule('iblock');
//                        $result = [];
////                                $ob = \Bitrix\Iblock\ElementTable::getList([
////                                    'filter' => ['IBLOCK_ID' => 2, 'IBLOCK_SECTION_ID' => $arr],
////                                    'select' => ['ID']
////                                ]);
//                        $arFields = [];
//                        if($color)
//                            $arFields = ['IBLOCK_ID' => 2, 'IBLOCK_SECTION_ID' => $arr, '%PROPERTY_COLOR' => $color];
//                        else
//                            $arFields = ['IBLOCK_ID' => 2, 'IBLOCK_SECTION_ID' => $arr];
//
//                        $ob = CIBlockElement::GetList(
//                            [],
//                            $arFields,
//                        );
//
//
//
//
//                        while($res = $ob->fetch())
//                            $result[] = $res['ID'];
//
//                        return $result;
//                    }
//                    function getSections($value)
//                    {
//                        CModule::IncludeModule('iblock');
//                        $result = [];
//                        $ob = CIBlockSection::GetList(
//                            [],
//                            ['IBLOCK_ID' => 2, 'UF_SECTION_TYPE' => $value]
//                        );
//                        while($res = $ob->fetch())
//                            $result[] = $res['ID'];
//
//                        return $result;
//                    }
//
//                    function getColor($codeElement)
//                    {
//                        CModule::IncludeModule('iblock');
//                        $color = CIBlockElement::GetList(
//                            [],
//                            ['IBLOCK_ID' => 2, 'CODE' => $codeElement],
//                        )->GetNextElement()->GetProperties()['COLOR']['VALUE_ENUM_ID'];
//
//                        return $color;
//                    }
//
////                            nitki 3273
//
//                    function getValue($elementCode)
//                    {
//                        if(!CModule::IncludeModule('iblock'))
//                            return false;
//
//                        $sectionId = \Bitrix\Iblock\ElementTable::getList([
//                            'filter' => [
//                                'CODE' => $elementCode,
//                                'IBLOCK_ID' => 2,
//                            ],
//                            'select' => ['IBLOCK_SECTION_ID']
//                        ])->fetch()['IBLOCK_SECTION_ID'];
//
////                                var_dump($sectionId);
//
//                        $result = CIBlockSection::GetList(
//                            [],
//                            ['IBLOCK_ID' => 2, 'ID' => $sectionId],
//                            false,
//                            ['UF_SECTION_TYPE']
//                        )->Fetch()['UF_SECTION_TYPE'];
//
//                        return $result;
//
//                    }
//
//                    function getCurSections($value, $color)
//                    {
//                        global $DB;
//
//                        if(!CModule::IncludeModule('iblock'))
//                            return false;
//                        $sections = [];
//                        $values = [];
//                        foreach($value as $item)
//                        {
//                            $values[] = ['UF_SECTION_TYPE' => $item];
//                        }
//                        $values = array_merge(['LOGIC' => 'OR'], $values);
//                        $obSection = CIBlockSection::GetList(
//                            [],
//                            [
//                                'IBLOCK_ID' => 2,
//                                //'UF_SECTION_TYPE' => $value
//                                $values
//                            ],
//                            false, ['*', 'UF_*']
//                        );
//
//                        while($resSection = $obSection->fetch())
//                            $sections[] = $resSection['ID'];
//                        //echo '<pre>'.print_r($sections,1).'</pre>';
//                        $result = [];
//                        if($color) {
//                            $arFields = ['IBLOCK_ID' => 2, 'IBLOCK_SECTION_ID' => $sections, 'PROPERTY_COLOR' => $color];
//                        }
//                        else
//                            $arFields = ['IBLOCK_ID' => 2, 'IBLOCK_SECTION_ID' => $sections];
//                        $ob = CIBlockElement::GetList(
//                            [],
//                            $arFields,
//                            false,
//                            false,
//                            ['*', 'PROPERTY_COLOR']
//                        );
//                        while($res = $ob->fetch())
//                            $result[] = $res['ID'];
//                        if(count($result) == 0)
//                        {
//                            $ob = CIBlockElement::GetList(
//                                [],
//                                ['IBLOCK_ID' => 2, 'IBLOCK_SECTION_ID' => $sections],
//                                false,
//                                false,
//                                ['*', 'PROPERTY_COLOR']
//                            );
//                            while($res = $ob->fetch())
//                                $result[] = $res['ID'];
//                        }
//
//                        return $result;
//                    }
//
//                    $filt = [];
//                    $value = getValue($arResult['VARIABLES']['ELEMENT_CODE']);
//
//                    if($value == 30)
//                    {
//                        $filt = getCurSections([29], getColor($arResult['VARIABLES']['ELEMENT_CODE']));
//                    }
//                    elseif($value == 29)
//                    {
//                        $filt = getCurSections([30, 41, 42, 43], getColor($arResult['VARIABLES']['ELEMENT_CODE']));
//                    }
//                    elseif($value == 43)
//                    {
//                        $filt = getCurSections([41, 42], getColor($arResult['VARIABLES']['ELEMENT_CODE']));
//                    }
//                    elseif($value == 41)
//                    {
//                        $filt = getCurSections([43, 42], getColor($arResult['VARIABLES']['ELEMENT_CODE']));
//                    }
//                    elseif($value == 42)
//                    {
//                        $filt = getCurSections([41, 43], getColor($arResult['VARIABLES']['ELEMENT_CODE']));
//                    }
//                    else
//                    {
//                        $filt = getCurSections([30], getColor($arResult['VARIABLES']['ELEMENT_CODE']));
//                    }

//                    $GLOBALS['arrFilterFav'] = array('ID' => $filt);

//                    if(count($filt) > 0){
//                        $APPLICATION->IncludeComponent(
//                            'bitrix:catalog.section',
//                            'offer',
//                            array(
//                                "IN_PRODUCT"=>"Y",
//                                'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
//                                'IBLOCK_ID' => $arParams['IBLOCK_ID'],
////									'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
////									'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
////                                    'SECTION_ID' => $textileSections,
//                                'ELEMENT_SORT_FIELD' => 'shows',
//                                'ELEMENT_SORT_ORDER' => 'desc',
//                                'ELEMENT_SORT_FIELD2' => 'sort',
//                                'ELEMENT_SORT_ORDER2' => 'asc',
//                                'PROPERTY_CODE' => (isset($arParams['LIST_PROPERTY_CODE']) ? $arParams['LIST_PROPERTY_CODE'] : []),
//                                'PROPERTY_CODE_MOBILE' => $arParams['LIST_PROPERTY_CODE_MOBILE'],
////									'INCLUDE_SUBSECTIONS' => $arParams['INCLUDE_SUBSECTIONS'],
//                                'BASKET_URL' => $arParams['BASKET_URL'],
//                                'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
//                                'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
////									'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
//                                'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
//                                'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
//                                'CACHE_TYPE' => $arParams['CACHE_TYPE'],
//                                'CACHE_TIME' => $arParams['CACHE_TIME'],
//                                'CACHE_FILTER' => $arParams['CACHE_FILTER'],
//                                'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
//                                'DISPLAY_COMPARE' => $arParams['USE_COMPARE'],
//                                'PRICE_CODE' => $arParams['~PRICE_CODE'],
//                                'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
//                                'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
//                                'PAGE_ELEMENT_COUNT' => 8,
//                                //'FILTER_IDS' => array('ID' => 27577),
////                                        'FILTER_NAME' => 'arrFilterFav',
//
//                                "SET_TITLE" => "N",
//                                "SET_BROWSER_TITLE" => "N",
//                                "SET_META_KEYWORDS" => "N",
//                                "SET_META_DESCRIPTION" => "N",
//                                "SET_LAST_MODIFIED" => "N",
//                                "ADD_SECTIONS_CHAIN" => "N",
//
//                                'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
//                                'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
//                                'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
//                                'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
//                                'PRODUCT_PROPERTIES' => (isset($arParams['PRODUCT_PROPERTIES']) ? $arParams['PRODUCT_PROPERTIES'] : []),
//
//                                'OFFERS_CART_PROPERTIES' => (isset($arParams['OFFERS_CART_PROPERTIES']) ? $arParams['OFFERS_CART_PROPERTIES'] : []),
//                                'OFFERS_FIELD_CODE' => $arParams['LIST_OFFERS_FIELD_CODE'],
//                                'OFFERS_PROPERTY_CODE' => (isset($arParams['LIST_OFFERS_PROPERTY_CODE']) ? $arParams['LIST_OFFERS_PROPERTY_CODE'] : []),
//                                'OFFERS_SORT_FIELD' => $arParams['OFFERS_SORT_FIELD'],
//                                'OFFERS_SORT_ORDER' => $arParams['OFFERS_SORT_ORDER'],
//                                'OFFERS_SORT_FIELD2' => $arParams['OFFERS_SORT_FIELD2'],
//                                'OFFERS_SORT_ORDER2' => $arParams['OFFERS_SORT_ORDER2'],
//                                'OFFERS_LIMIT' => (isset($arParams['LIST_OFFERS_LIMIT']) ? $arParams['LIST_OFFERS_LIMIT'] : 0),
//
//                                'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
//                                'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
////									'USE_MAIN_ELEMENT_SECTION' => $arParams['USE_MAIN_ELEMENT_SECTION'],
//                                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
//                                'CURRENCY_ID' => $arParams['CURRENCY_ID'],
//                                'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
//                                'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],
//
//                                'LABEL_PROP' => $arParams['LABEL_PROP'],
//                                'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
//                                'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
//                                'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
//                                'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
//                                'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
//                                'PRODUCT_ROW_VARIANTS' => "[{'VARIANT':'3','BIG_DATA':false}]",
//                                'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
//                                'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
//                                'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
//                                'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
//                                'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',
//
//                                'DISPLAY_TOP_PAGER' => 'N',
//                                'DISPLAY_BOTTOM_PAGER' => 'N',
//                                'HIDE_SECTION_DESCRIPTION' => 'Y',
//
//                                'RCM_TYPE' => isset($arParams['BIG_DATA_RCM_TYPE']) ? $arParams['BIG_DATA_RCM_TYPE'] : '',
//                                //'RCM_PROD_ID' => $elementId,
//                                //'RCM_PROD_ID' => 27577,
//                                'SHOW_FROM_SECTION' => 'Y',
//
//                                'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
//                                'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
//                                'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
//                                'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
//                                'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
//                                'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
//                                'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
//                                'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
//                                'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
//                                'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
//                                'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
//                                'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
//                                'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
//                                'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
//                                'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
//                                'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
//                                'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),
//
//                                'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
//                                'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
//                                'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),
//
//                                'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
//                                'ADD_TO_BASKET_ACTION' => $basketAction,
//                                'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
//                                'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
//                                'COMPARE_NAME' => $arParams['COMPARE_NAME'],
//                                'USE_COMPARE_LIST' => 'Y',
//                                'BACKGROUND_IMAGE' => '',
//                                'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
//                            ),
//                            $component
//                        );
//                    } else {
//                        echo '<div class="d-flex justify-content-center" style="font-size: 32px">
//
//                                Товары Отсутствуют
//
//                            </div>';
//                    }

							?>
						
					<?
				}?>
				</div><br>
				
				<div class="bg-benefit">
        <div class="container">
            <div class="row py-4 align-items-center">
                <div class="col-sm-4 h-100 col-12 border-r">
                    <div class="align-items-center d-flex item-ben">
                        <div class="pe-0 pe-lg-3 py-3 py-lg-0">
                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.80524 10.1243C7.67907 10.5467 5.81854 11.6703 4.33166 13.4299C2.01983 16.166 1.38712 19.682 2.61305 22.9803C3.36368 25.0002 5.09501 26.9286 7.06455 27.9387C9.43796 29.1559 12.7924 29.1639 15.165 27.9582L15.5672 27.7537L16.727 28.8777L17.8868 30.0016L16.727 31.1254L15.5672 32.2494L15.165 32.0425C14.9438 31.9287 14.3361 31.692 13.8145 31.5166C12.9377 31.2217 12.7357 31.1976 11.1368 31.1975C9.47589 31.1975 9.36555 31.2121 8.34759 31.5658C5.31447 32.6197 3.1748 34.8892 2.30288 37.9774C1.97097 39.1533 1.94631 41.5253 2.25435 42.6572C2.70141 44.2996 3.58225 45.8203 4.85525 47.1475C6.63143 48.9993 8.92898 49.9951 11.4364 50C16.2997 50.0093 20.2782 46.2251 20.582 41.3012C20.6712 39.8559 20.4656 38.5982 19.8962 37.1063C19.8449 36.972 20.1177 36.6773 20.9163 36.0046C21.9639 35.1222 22.0285 35.0864 22.5707 35.0864H23.1349L29.6594 41.4259C33.248 44.9127 36.4853 47.9944 36.8535 48.2744C38.2937 49.3692 39.7077 49.881 41.5417 49.9708C42.5594 50.0208 42.9305 49.9904 43.6962 49.7942C44.8985 49.4863 45.8654 48.9965 46.7811 48.2317C47.5902 47.5558 47.7967 47.2292 47.6891 46.7955C47.639 46.5931 44.7922 44.1288 37.8848 38.3086C32.5313 33.7976 28.1511 30.0598 28.1511 30.0021C28.1511 29.9446 32.5313 26.2065 37.8848 21.6952C44.793 15.8739 47.639 13.4102 47.6891 13.2077C47.7966 12.7744 47.5903 12.4475 46.785 11.7748C44.0397 9.48146 40.0696 9.40327 37.0553 11.5832C36.6375 11.8853 33.3342 15.009 29.7145 18.5247L23.1335 24.9167H22.57C22.0287 24.9167 21.9635 24.8806 20.9163 23.9985C20.1177 23.3259 19.8449 23.0312 19.8962 22.8968C20.4656 21.4049 20.6712 20.1473 20.582 18.702C20.3982 15.722 18.8946 13.1027 16.434 11.4758C15.545 10.888 14.1417 10.3208 13.0888 10.1237C12.3294 9.98158 10.5223 9.98181 9.80524 10.1243ZM13.2818 11.8013C14.9358 12.2296 16.4656 13.2361 17.4372 14.535C19.2085 16.9028 19.5231 19.7979 18.3103 22.5676C18.1385 22.9598 18.053 23.3151 18.0924 23.4739C18.1286 23.6202 18.6246 24.1246 19.2209 24.6215L20.2847 25.5079L19.5237 26.2215C19.1051 26.6141 18.641 27.1674 18.4922 27.4514C18.3435 27.7353 18.1796 27.9676 18.128 27.9676C18.0762 27.9676 17.5661 27.51 16.9942 26.9507C16.4223 26.3913 15.8759 25.9337 15.7799 25.9337C15.6839 25.9337 15.2036 26.1389 14.7127 26.3897C10.0711 28.76 4.73253 26.182 3.71122 21.077C3.35487 19.2961 3.70018 17.2713 4.63501 15.6591C4.86674 15.2596 5.48751 14.4905 6.01457 13.9499C6.81441 13.1297 7.14666 12.88 8.02281 12.4414C8.6003 12.1522 9.39913 11.845 9.79799 11.7584C10.8665 11.5267 12.2894 11.5442 13.2818 11.8013ZM43.8408 11.8808C44.5749 12.1415 45.7404 12.8306 45.6926 12.9759C45.6744 13.0311 41.5969 16.5025 36.6314 20.6901L27.6031 28.3039L27.3412 27.7458C27.0042 27.0276 26.2398 26.1695 25.5208 25.7022L24.9539 25.3338L25.3252 24.9721C28.7808 21.6075 36.711 13.9493 37.2964 13.4118C38.1401 12.6369 39.2496 12.03 40.3195 11.7582C41.2356 11.5254 43.0139 11.5874 43.8408 11.8808ZM10.4127 13.9759C8.84184 14.2793 7.13528 15.6702 6.39837 17.2476C4.23203 21.8846 8.90678 26.6311 13.4798 24.438C14.5144 23.9417 15.697 22.7235 16.21 21.6253C17.2202 19.4629 16.8426 17.1228 15.2168 15.472C13.9334 14.1689 12.2034 13.6301 10.4127 13.9759ZM12.625 15.6537C13.6043 15.96 14.4377 16.7205 14.8768 17.7086C15.1347 18.2887 15.1929 18.5786 15.1936 19.2844C15.1943 20.0299 15.1452 20.2507 14.8379 20.8829C14.3177 21.953 13.2748 22.9113 12.2976 23.2169C11.3711 23.5068 10.904 23.5072 9.98331 23.2192C8.44756 22.7389 7.41632 21.2878 7.41476 19.605C7.41376 18.5134 7.76129 17.7093 8.63589 16.7808C9.81595 15.5277 11.0804 15.1705 12.625 15.6537ZM24.3237 26.8182C24.9911 27.149 25.6666 27.8323 25.9964 28.5106C26.2058 28.941 26.2539 29.2224 26.2517 30.0016C26.2484 31.1303 26.0183 31.7189 25.2879 32.466C24.6484 33.1202 23.9849 33.4173 23.0307 33.4771C20.497 33.6358 18.7224 31.147 19.6257 28.702C19.9264 27.8881 20.7373 27.0531 21.5366 26.7343C22.3403 26.4138 23.583 26.4512 24.3237 26.8182ZM22.2674 27.8542C21.6449 28.044 21.1942 28.4272 20.907 29.011C20.5476 29.7416 20.5446 30.2554 20.8956 30.9687C21.5438 32.2861 23.1793 32.6301 24.2533 31.6749C25.2667 30.7738 25.3176 29.4185 24.3739 28.4628C23.7548 27.8358 23.0221 27.624 22.2674 27.8542ZM31.7163 29.488C31.5657 29.6406 31.4424 29.8716 31.4424 30.0016C31.4424 30.1315 31.5657 30.3626 31.7163 30.5151C31.9887 30.7911 32.0016 30.7925 34.2142 30.7925C36.2094 30.7925 36.4645 30.7711 36.6924 30.5842C36.8642 30.4433 36.9465 30.2547 36.9465 30.0016C36.9465 29.7485 36.8642 29.5599 36.6924 29.419C36.4645 29.2321 36.2094 29.2106 34.2142 29.2106C32.0016 29.2106 31.9887 29.2121 31.7163 29.488ZM39.0485 29.4721C38.7339 29.8114 38.74 30.2384 39.0641 30.5469C39.3117 30.7824 39.4158 30.7925 41.5745 30.7925C43.6779 30.7925 43.8413 30.7776 44.0497 30.5666C44.1737 30.441 44.2729 30.1899 44.2729 30.0016C44.2729 29.8132 44.1737 29.5621 44.0497 29.4366C43.8412 29.2254 43.6779 29.2106 41.5588 29.2106C39.3327 29.2106 39.2867 29.2153 39.0485 29.4721ZM46.3927 29.4366C46.2687 29.5621 46.1695 29.8132 46.1695 30.0016C46.1695 30.1899 46.2687 30.441 46.3927 30.5666C46.6012 30.7777 46.7645 30.7925 48.8836 30.7925C51.1097 30.7925 51.1557 30.7878 51.3939 30.5311C51.7085 30.1917 51.7024 29.7647 51.3783 29.4563C51.1307 29.2208 51.0266 29.2106 48.868 29.2106C46.7645 29.2106 46.6011 29.2255 46.3927 29.4366ZM53.75 29.419C53.5782 29.5599 53.496 29.7485 53.496 30.0016C53.496 30.2547 53.5782 30.4433 53.75 30.5842C53.9779 30.7711 54.233 30.7925 56.2282 30.7925C58.4408 30.7925 58.4538 30.7911 58.7261 30.5151C58.8767 30.3626 59 30.1315 59 30.0016C59 29.8716 58.8767 29.6406 58.7261 29.488C58.4538 29.2121 58.4408 29.2106 56.2282 29.2106C54.233 29.2106 53.9779 29.2321 53.75 29.419ZM23.2471 29.601C23.3977 29.7535 23.521 29.9246 23.521 29.9812C23.521 30.1941 23.0501 30.6796 22.8434 30.6796C22.5631 30.6796 22.1822 30.2891 22.1822 30.0016C22.1822 29.7337 22.5564 29.3236 22.8008 29.3236C22.8957 29.3236 23.0965 29.4485 23.2471 29.601ZM36.8332 39.4796C41.7227 43.605 45.7233 47.0137 45.7233 47.0547C45.7233 47.1908 44.4783 47.896 43.8408 48.1212C42.9636 48.4309 41.4194 48.492 40.4237 48.2566C39.3044 47.9918 38.1479 47.373 37.2756 46.572C36.706 46.0491 28.739 38.3549 25.3252 35.031L24.9539 34.6693L25.5208 34.301C26.2423 33.832 27.0214 32.9562 27.3371 32.259C27.5465 31.7967 27.6099 31.7356 27.7631 31.8476C27.8622 31.9198 31.9437 35.3543 36.8332 39.4796ZM18.4922 32.5518C18.641 32.8357 19.1051 33.3891 19.5237 33.7816L20.2847 34.4952L19.2209 35.3817C18.6246 35.8785 18.1286 36.3829 18.0924 36.5293C18.053 36.688 18.1385 37.0434 18.3103 37.4356C19.521 40.2004 19.2082 43.101 17.4448 45.4579C15.7312 47.7483 12.7193 48.8566 9.85378 48.251C9.42423 48.1602 8.6003 47.8498 8.02281 47.5611C7.14588 47.1226 6.81508 46.8743 6.01457 46.0533C4.91126 44.9216 4.3321 43.994 3.92967 42.7137C2.80138 39.1241 4.39637 35.2651 7.71879 33.5459C9.90956 32.4123 12.4078 32.4365 14.7127 33.6135C15.2036 33.8642 15.682 34.0694 15.7758 34.0694C15.8695 34.0694 16.4205 33.6118 17.0002 33.0525C17.5799 32.4931 18.0919 32.0355 18.138 32.0355C18.1841 32.0355 18.3435 32.2678 18.4922 32.5518ZM9.94839 35.1339C9.0073 35.3651 8.13773 35.8657 7.40372 36.5992C6.21004 37.792 5.6513 39.4408 5.88693 41.0752C6.12089 42.6973 7.23 44.4098 8.63912 45.3248C10.7391 46.6883 13.5176 46.3813 15.2593 44.5932C16.94 42.8678 17.3064 40.3293 16.1816 38.2025C15.769 37.4221 14.3416 35.976 13.6214 35.6086C12.4705 35.0213 11.1179 34.8465 9.94839 35.1339ZM12.7295 36.9437C13.504 37.3148 14.5134 38.3804 14.8995 39.2346C15.7963 41.2184 14.6913 43.7032 12.625 44.3495C11.7044 44.6375 11.2372 44.6371 10.3108 44.3472C9.33353 44.0416 8.29069 43.0833 7.77044 42.0132C7.46318 41.381 7.41409 41.1602 7.41476 40.4147C7.41543 39.7089 7.47367 39.419 7.73151 38.8389C8.5936 36.8993 10.8505 36.0435 12.7295 36.9437Z" fill="#BF1E77"></path>
                            </svg>

                        </div>
                        <div>
                            Режем ткань от 30 смс шагом в 10 см. Тесьму и кружево режем от 1 метра
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 h-100 col-12 border-r">
                    <div class="align-items-center justify-content-between d-flex item-ben">
                        <div class="pe-0 pe-lg-3 py-3 py-lg-0">
                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.6506 2.13059C11.2582 2.35416 11.2279 2.47158 11.2259 3.77959L11.2241 5.02382L8.69596 5.06691C6.21508 5.10916 6.15477 5.11638 5.4687 5.45309C4.57903 5.88983 3.78111 6.69106 3.34322 7.58732L3 8.28987V31.492V54.6942L3.32653 55.3943C3.78379 56.3747 4.61156 57.2212 5.5301 57.6474L6.28965 58H23.7735H41.2574L41.9488 57.6743C42.9166 57.2184 43.6816 56.4658 44.151 55.508L44.547 54.7002L44.6079 50.3908L44.6689 46.0814L50.639 42.1498C54.4713 39.626 56.773 38.0332 57.0672 37.7017C58.7415 35.8147 58.0764 32.7775 55.7562 31.7149C54.9311 31.337 53.5567 31.3257 52.7711 31.6904C52.4696 31.8303 50.541 33.0551 48.4855 34.4121C46.4299 35.769 44.7176 36.8793 44.6804 36.8793C44.6433 36.8793 44.5981 30.4468 44.5799 22.5846L44.547 8.28987L44.2789 7.71196C43.9666 7.0394 43.1521 6.11046 42.5249 5.7118C41.6362 5.14674 40.9756 5.04524 38.1892 5.04524H35.5919L35.59 3.79025C35.588 2.45015 35.5595 2.34535 35.135 2.12079C34.9237 2.00888 34.798 2.00888 34.5867 2.12079C34.1622 2.34535 34.1337 2.45015 34.1316 3.79025L34.1298 5.04524H31.0229H27.916L27.9142 3.79025C27.9121 2.45015 27.8836 2.34535 27.4591 2.12079C27.2479 2.00888 27.1221 2.00888 26.9109 2.12079C26.4864 2.34535 26.4579 2.45015 26.4558 3.79025L26.454 5.04524H23.408H20.362L20.3602 3.79025C20.3581 2.45015 20.3296 2.34535 19.9051 2.12079C19.6939 2.00888 19.5681 2.00888 19.3569 2.12079C18.9324 2.34535 18.9039 2.45015 18.9018 3.79025L18.9 5.04524H15.7931H12.6862L12.6844 3.79025C12.6823 2.45468 12.6529 2.34486 12.2373 2.12508C11.9207 1.95758 11.9547 1.95721 11.6506 2.13059ZM11.2241 7.41957C11.2241 8.25559 11.2033 8.32991 10.95 8.39492C10.4916 8.51246 9.79946 9.17559 9.51192 9.7726C8.77516 11.3019 9.56723 13.0938 11.1894 13.5676C13.8237 14.3372 15.8205 11.2242 14.0147 9.16274C13.7476 8.85774 13.3394 8.53928 13.1076 8.45504L12.6862 8.30187V7.40819V6.51451H15.7931H18.9V7.41957C18.9 8.28828 18.8875 8.3277 18.5882 8.40313C18.4166 8.44647 18.0359 8.70457 17.742 8.97687C16.4287 10.1934 16.621 12.2885 18.1346 13.253C19.5514 14.156 21.3334 13.6224 22.1153 12.061C22.3975 11.4973 22.3696 10.3855 22.0568 9.73648C21.7844 9.17069 21.0846 8.51001 20.6362 8.39492C20.3829 8.32991 20.362 8.25559 20.362 7.41957V6.51451H23.408H26.454L26.4482 7.40219L26.4426 8.28987L25.9304 8.54295C24.541 9.22959 24.0378 11.1668 24.9128 12.4609C26.2283 14.4062 29.1637 13.9518 29.8144 11.702C29.9841 11.1156 29.9936 10.899 29.8736 10.3601C29.7022 9.59029 28.973 8.68596 28.3375 8.45504L27.916 8.30187V7.40819V6.51451H31.0229H34.1298V7.40819V8.30187L33.7229 8.44977C33.0774 8.68437 32.4436 9.40933 32.2257 10.1622C31.983 11.0014 32.0796 11.6942 32.5415 12.4261C33.685 14.2381 36.3197 14.0729 37.3074 12.1275C37.6283 11.4954 37.619 10.4262 37.2866 9.73648C37.0142 9.17069 36.3145 8.51001 35.866 8.39492C35.6127 8.32991 35.5919 8.25559 35.5919 7.41957V6.51451H38.1059C39.741 6.51451 40.7952 6.56716 41.1214 6.66498C41.8054 6.87019 42.8368 7.89047 43.0116 8.53475C43.1041 8.87549 43.1448 13.427 43.1451 23.4895L43.1459 37.9547L41.7752 38.8429C41.0214 39.3314 40.336 39.8163 40.2522 39.9203C39.8855 40.376 40.2102 41.0422 40.7991 41.0422C41.0088 41.0422 42.9601 39.8238 46.5924 37.4247C49.6049 35.435 52.0814 33.8235 52.096 33.8433C52.4221 34.2899 52.8919 35.0502 52.8886 35.126C52.8849 35.2084 36.4942 46.0909 34.9854 47.0127L34.5319 47.2898L34.0934 46.6261L33.6549 45.9623L35.4799 44.7573C37.3875 43.4977 37.5834 43.2766 37.3156 42.6861C37.0475 42.0945 36.5738 42.2674 34.2649 43.7993L32.146 45.2052H26.4368C20.8899 45.2052 20.7206 45.2121 20.4839 45.45C20.3498 45.5847 20.2402 45.8051 20.2402 45.9398C20.2402 46.0745 20.3498 46.2949 20.4839 46.4295C20.7201 46.6669 20.89 46.6744 26.03 46.6744H31.3325L31.0838 47.1642L30.8352 47.6539H25.7814C20.8899 47.6539 20.7197 47.6618 20.4839 47.8988C20.3498 48.0335 20.2402 48.2539 20.2402 48.3886C20.2402 48.5232 20.3498 48.7436 20.4839 48.8783C20.719 49.1146 20.89 49.1232 25.3574 49.1232C27.9038 49.1232 29.9873 49.1555 29.9873 49.1952C29.9873 49.2347 29.7954 49.6118 29.5608 50.0334C29.0557 50.941 29.0187 51.3677 29.4221 51.6333C29.6729 51.7985 30.1284 51.8105 32.9899 51.728L36.2703 51.6332L39.644 49.3987C41.4996 48.1698 43.0496 47.1642 43.0885 47.1642C43.1273 47.1642 43.1425 48.8033 43.1221 50.8067C43.0868 54.2675 43.0718 54.4738 42.822 54.939C42.5143 55.512 42.037 55.9831 41.4401 56.3025C41.0307 56.5217 40.3308 56.5321 23.9218 56.5631L6.82988 56.5953L6.22568 56.3341C5.505 56.0225 4.8768 55.3613 4.59816 54.6212C4.41101 54.1238 4.39786 52.3114 4.42868 31.3084L4.46207 8.53475L4.79761 7.96112C4.98207 7.64572 5.30482 7.26469 5.51463 7.11458C6.23531 6.59887 6.66528 6.52553 9.00056 6.51989L11.2241 6.51451V7.41957ZM12.7897 10.0073C13.5093 10.6158 13.3512 11.7374 12.4951 12.0969C11.5958 12.4745 10.7368 11.9179 10.7368 10.9574C10.7368 9.84141 11.9368 9.28603 12.7897 10.0073ZM20.4932 10.0558C21.552 11.1198 20.1427 12.845 18.9039 12.0014C17.8238 11.266 18.2958 9.69792 19.5972 9.69792C20.0315 9.69792 20.2068 9.76795 20.4932 10.0558ZM28.0196 10.0073C28.4789 10.3958 28.5942 10.8866 28.3589 11.4525C27.8281 12.7294 25.9666 12.3443 25.9666 10.9574C25.9666 9.84141 27.1666 9.28603 28.0196 10.0073ZM35.7231 10.0558C36.7108 11.0484 35.5057 12.7372 34.2685 12.0943C33.0319 11.4516 33.4481 9.70783 34.8398 9.70061C35.262 9.69841 35.4377 9.76917 35.7231 10.0558ZM5.98505 10.4325C5.80217 10.6163 5.74137 10.8406 5.74137 11.3319C5.74137 12.067 5.97177 12.3916 6.4936 12.3916C6.96951 12.3916 7.20344 12.0353 7.20344 11.3106C7.20344 10.6176 6.92357 10.1877 6.4724 10.1877C6.33838 10.1877 6.11907 10.2979 5.98505 10.4325ZM6.16781 13.395C6.03379 13.4714 5.8838 13.5937 5.83458 13.6668C5.78536 13.7399 5.7443 15.5129 5.7432 17.6068C5.74149 21.1412 5.75733 21.4287 5.96421 21.6167C6.25846 21.8844 6.75068 21.8742 7.00179 21.5954C7.18041 21.3972 7.20319 20.9383 7.20161 17.5855C7.20051 15.5033 7.15945 13.739 7.11023 13.6649C7.03018 13.5445 6.54758 13.2429 6.44999 13.2523C6.42879 13.2544 6.30183 13.3186 6.16781 13.395ZM10.9694 18.1335C8.11016 19.0528 6.71645 22.3474 8.04218 25.0536C8.50407 25.9965 9.5018 26.9752 10.4623 27.4275C11.0847 27.7207 11.3071 27.7576 12.4488 27.7576C13.6903 27.7576 13.7664 27.7417 14.6645 27.2958C18.6594 25.3116 18.1807 19.4742 13.9135 18.1396C12.974 17.8457 11.8716 17.8434 10.9694 18.1335ZM14.1417 19.8073C16.3134 20.9951 16.5559 24.1341 14.5914 25.6262C13.8795 26.1669 13.3157 26.35 12.3675 26.3484C9.28225 26.3432 7.83127 22.3869 10.1471 20.2945C10.9354 19.5823 11.5492 19.3649 12.6334 19.4143C13.3038 19.4447 13.6379 19.5317 14.1417 19.8073ZM20.4839 20.9623C20.3498 21.097 20.2402 21.3174 20.2402 21.452C20.2402 21.5867 20.3498 21.8071 20.4839 21.9418C20.7234 22.1825 20.89 22.1867 30.1512 22.1867C39.1259 22.1867 39.5844 22.176 39.7764 21.9627C40.0428 21.667 40.0326 21.1724 39.7552 20.92C39.552 20.7352 38.7081 20.7174 30.13 20.7174C20.89 20.7174 20.7233 20.7217 20.4839 20.9623ZM12.9908 21.9418C12.4951 22.4132 12.0484 22.7989 11.9978 22.7989C11.9472 22.7989 11.729 22.6267 11.513 22.4162C10.869 21.7889 10.1276 21.9586 10.1276 22.7332C10.1276 23.0578 10.2656 23.2605 10.9089 23.8813C11.4135 24.3682 11.7918 24.6354 11.9765 24.6354C12.3601 24.6354 14.8838 22.2339 14.8811 21.8713C14.8789 21.5679 14.4013 21.0847 14.1035 21.0847C13.9872 21.0847 13.4864 21.4704 12.9908 21.9418ZM20.4839 23.4111C20.3498 23.5457 20.2402 23.7661 20.2402 23.9008C20.2402 24.0355 20.3498 24.2559 20.4839 24.3906C20.7199 24.6277 20.89 24.6354 25.8868 24.6354C30.7303 24.6354 31.0584 24.6217 31.2477 24.4115C31.514 24.1158 31.5039 23.6212 31.2265 23.3688C31.0266 23.187 30.4757 23.1662 25.8656 23.1662C20.89 23.1662 20.7199 23.1739 20.4839 23.4111ZM10.9694 30.3773C8.11016 31.2967 6.71645 34.5913 8.04218 37.2974C8.50407 38.2403 9.5018 39.2191 10.4623 39.6714C11.0847 39.9645 11.3071 40.0015 12.4488 40.0015C13.6903 40.0015 13.7664 39.9856 14.6645 39.5397C18.6594 37.5554 18.1807 31.718 13.9135 30.3835C12.974 30.0896 11.8716 30.0873 10.9694 30.3773ZM14.1417 32.0512C16.3134 33.239 16.5559 36.3779 14.5914 37.8701C13.8795 38.4108 13.3157 38.5938 12.3675 38.5922C9.28225 38.5871 7.83127 34.6307 10.1471 32.5384C10.9354 31.8261 11.5492 31.6088 12.6334 31.6582C13.3038 31.6885 13.6379 31.7756 14.1417 32.0512ZM55.2055 33.1143C55.5006 33.2659 55.9038 33.5943 56.1016 33.8442C56.6925 34.5908 56.6823 35.8285 56.0786 36.6166L55.8578 36.9048L54.6674 35.0939C54.0128 34.098 53.4514 33.2155 53.4198 33.1328C53.2825 32.7733 54.5165 32.7606 55.2055 33.1143ZM20.4839 33.2062C20.3498 33.3408 20.2402 33.5612 20.2402 33.6959C20.2402 33.8306 20.3498 34.051 20.4839 34.1857C20.7234 34.4264 20.89 34.4305 30.1512 34.4305C39.1259 34.4305 39.5844 34.4199 39.7764 34.2066C40.0428 33.9109 40.0326 33.4163 39.7552 33.1639C39.552 32.979 38.7081 32.9613 30.13 32.9613C20.89 32.9613 20.7233 32.9656 20.4839 33.2062ZM12.9908 34.1857C12.4951 34.6571 12.0484 35.0427 11.9978 35.0427C11.9472 35.0427 11.729 34.8706 11.513 34.6601C10.869 34.0327 10.1276 34.2024 10.1276 34.9771C10.1276 35.3017 10.2656 35.5043 10.9089 36.1252C11.4135 36.612 11.7918 36.8793 11.9765 36.8793C12.3601 36.8793 14.8838 34.4778 14.8811 34.1151C14.8789 33.8117 14.4013 33.3286 14.1035 33.3286C13.9872 33.3286 13.4864 33.7143 12.9908 34.1857ZM20.4839 35.6549C20.3498 35.7896 20.2402 36.01 20.2402 36.1447C20.2402 36.2794 20.3498 36.4998 20.4839 36.6344C20.7199 36.8716 20.89 36.8793 25.8868 36.8793C30.7303 36.8793 31.0584 36.8656 31.2477 36.6554C31.514 36.3597 31.5039 35.865 31.2265 35.6127C31.0266 35.4309 30.4757 35.4101 25.8656 35.4101C20.89 35.4101 20.7199 35.4178 20.4839 35.6549ZM54.1895 37.0648C54.4348 37.4362 54.6136 37.7587 54.5868 37.7813C54.5598 37.8041 50.4259 40.5337 45.4003 43.8474L36.2626 49.8722L36.0155 49.5608C35.8796 49.3895 35.674 49.0887 35.5585 48.8923L35.3486 48.535L44.5168 42.4724C49.5592 39.1379 53.6981 36.4052 53.7142 36.3996C53.7302 36.3941 53.9441 36.6935 54.1895 37.0648ZM10.9694 42.6212C8.11016 43.5406 6.71645 46.8352 8.04218 49.5413C8.50407 50.4842 9.5018 51.463 10.4623 51.9153C11.0847 52.2084 11.3071 52.2454 12.4488 52.2454C13.6903 52.2454 13.7664 52.2295 14.6645 51.7835C18.6594 49.7993 18.1807 43.9619 13.9135 42.6273C12.974 42.3335 11.8716 42.3311 10.9694 42.6212ZM14.1417 44.2951C16.3134 45.4828 16.5559 48.6218 14.5914 50.114C13.8795 50.6547 13.3157 50.8377 12.3675 50.8361C9.28225 50.831 7.83127 46.8746 10.1471 44.7822C10.9354 44.07 11.5492 43.8527 12.6334 43.902C13.3038 43.9324 13.6379 44.0195 14.1417 44.2951ZM12.9908 46.4295C12.4951 46.9009 12.0484 47.2866 11.9978 47.2866C11.9472 47.2866 11.729 47.1145 11.513 46.904C10.869 46.2766 10.1276 46.4463 10.1276 47.221C10.1276 47.5456 10.2656 47.7482 10.9089 48.3691C11.4135 48.8559 11.7918 49.1232 11.9765 49.1232C12.3601 49.1232 14.8838 46.7217 14.8811 46.359C14.8789 46.0556 14.4013 45.5725 14.1035 45.5725C13.9872 45.5725 13.4864 45.9582 12.9908 46.4295ZM33.6996 48.7086C34.2113 49.4906 34.6134 50.1453 34.5932 50.1633C34.5728 50.1813 33.7794 50.22 32.8299 50.2493L31.1037 50.3025L31.5959 49.3149C32.1217 48.26 32.6659 47.2866 32.73 47.2866C32.7514 47.2866 33.1877 47.9265 33.6996 48.7086Z" fill="#BF1E77"></path>
                            </svg>
                        </div>
                        <div>
                            Нет ограничений
                            по минимальному заказу

                        </div>
                    </div>
                </div>
                <div class="col-sm-4 h-100 col-12">
                    <div class="align-items-center d-flex item-ben">
                        <div class="pe-0 pe-lg-3 py-3 py-lg-0">
                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.454 6.14283C9.84245 6.40919 9.76006 6.60518 7.83954 12.3659L6 17.8835L6.02421 35.4892L6.04842 53.095L6.24191 53.354C6.34832 53.4966 6.55194 53.7002 6.69447 53.8065L6.95364 54H25.268C42.7987 54 43.6166 53.9925 44.38 53.8248C46.8106 53.2912 48.7517 52.2332 50.4914 50.4938C52.2332 48.7522 53.3 46.7937 53.8197 44.3834C54.0601 43.2683 54.0601 40.8074 53.8197 39.6924C53.3 37.2821 52.2332 35.3235 50.4914 33.5819C48.75 31.8408 46.7948 30.776 44.38 30.2535C43.308 30.0215 40.7157 30.0197 39.6882 30.2502C38.5732 30.5003 37.8237 30.7773 37.6707 30.9956C37.3853 31.4032 37.5957 31.982 38.086 32.1376C38.1889 32.1702 38.5808 32.1053 38.9569 31.9934C42.7267 30.8708 46.6824 31.8641 49.446 34.6272C52.6331 37.8139 53.4347 42.5532 51.4695 46.5912C48.2804 53.1439 39.7392 54.5644 34.5759 49.4009C31.4013 46.226 30.6267 41.3219 32.6648 37.3C33.4182 35.8132 34.6086 34.4277 35.9601 33.4647C36.8329 32.8427 36.9661 32.5432 36.5848 32.0587C36.2704 31.6589 35.864 31.7195 35.0402 32.2888C30.7367 35.2635 28.9252 41.1336 30.7623 46.1517C31.5956 48.4281 33.3371 50.6494 35.3249 51.9714C35.7378 52.2459 36.0932 52.4875 36.1147 52.5082C36.1362 52.5289 29.7073 52.5458 21.8284 52.5458H7.50286V35.6581V18.7704H14.259H21.0151V21.9176V25.0649L21.2455 25.2952L21.4757 25.5255H27.0205H32.5653L32.7956 25.2952L33.026 25.0649V21.9176V18.7704H39.7821H46.5382V24.1693V29.5683L46.7686 29.7985C47.0732 30.1033 47.5045 30.1033 47.8092 29.7985L48.0396 29.5683V23.7238V17.8791L46.2008 12.3637C44.2691 6.56953 44.1986 6.4029 43.5664 6.1388C43.1171 5.95116 10.8852 5.95501 10.454 6.14283ZM21.6561 8.4132C21.6298 9.29717 21.6342 9.31875 21.8904 9.53904C22.2193 9.82182 22.5292 9.82435 22.8518 9.54692C23.085 9.34633 23.1072 9.26274 23.1513 8.42108L23.1989 7.51196H24.7343H26.2698V12.3906V17.2693H24.4401H22.6103L22.6088 17.0113C22.608 16.8693 22.679 15.6493 22.7666 14.3001C22.9163 11.9943 22.9163 11.8322 22.7669 11.6041C22.474 11.1573 21.8455 11.1856 21.5454 11.6592C21.4462 11.8158 21.3629 12.6116 21.2405 14.5719L21.0721 17.2693H14.4358H7.79929L9.38669 12.5079C10.2597 9.88918 10.994 7.69378 11.0184 7.62923C11.0531 7.53729 12.2109 7.51196 16.3728 7.51196H21.6829L21.6561 8.4132ZM31.1325 12.2264C31.3011 14.8194 31.4372 17.0148 31.4349 17.1051C31.4311 17.2557 31.2795 17.2693 29.601 17.2693H27.7712V12.3906V7.51196H29.2986H30.826L31.1325 12.2264ZM44.6226 12.4141L46.2415 17.2693H39.6077H32.9739L32.6674 12.5548C32.4988 9.9618 32.3627 7.76612 32.365 7.67539C32.3689 7.51965 32.6675 7.51177 37.6864 7.53466L43.0035 7.55887L44.6226 12.4141ZM31.5246 21.3974V24.0244H27.0205H22.5165V21.3974V18.7704H27.0205H31.5246V21.3974ZM44.246 35.6816C44.1149 35.7977 43.1812 37.0537 42.1711 38.4727C41.161 39.8917 40.2973 41.066 40.2518 41.082C40.2064 41.0982 39.6878 40.7499 39.0994 40.308C38.0034 39.4849 37.6791 39.3594 37.3351 39.625C37.2536 39.6879 36.5463 40.5959 35.7633 41.6427C34.1829 43.7558 34.1041 43.942 34.5977 44.4002C35.0919 44.8591 40.9475 49.1994 41.2018 49.2954C41.3807 49.3629 41.5257 49.3611 41.683 49.2895C41.8181 49.2279 43.3396 47.1825 45.4899 44.1714C49.4181 38.6709 49.3603 38.7736 48.8137 38.2702C48.5804 38.0553 46.1968 36.3389 45.2731 35.7206C44.8168 35.4151 44.5579 35.4053 44.246 35.6816ZM46.3036 38.2821C46.7681 38.6101 47.1858 38.9115 47.232 38.9519C47.3104 39.0202 41.345 47.4795 41.2184 47.4795C41.1866 47.4795 40.0274 46.6305 38.6424 45.5928C37.0832 44.4246 36.1484 43.6653 36.1878 43.5991C36.2229 43.5402 36.6244 42.9967 37.0801 42.3914L37.9087 41.2906L39.0387 42.1334C40.2368 43.0268 40.5199 43.13 40.8725 42.8015C40.9756 42.7054 41.9211 41.4193 42.9738 39.9434L44.8876 37.2601L45.1734 37.4728C45.3305 37.5898 45.8391 37.954 46.3036 38.2821ZM9.23458 43.0188C9.08933 43.1639 9.00422 43.3563 9.00422 43.539C9.00422 43.7218 9.08933 43.9141 9.23458 44.0593L9.46486 44.2896H14.259H19.0531L19.2834 44.0593C19.4286 43.9141 19.5137 43.7218 19.5137 43.539C19.5137 43.3563 19.4286 43.1639 19.2834 43.0188L19.0531 42.7885H14.259H9.46486L9.23458 43.0188ZM9.23458 46.021C9.08933 46.1662 9.00422 46.3585 9.00422 46.5413C9.00422 46.724 9.08933 46.9164 9.23458 47.0615L9.46486 47.2918H14.259H19.0531L19.2834 47.0615C19.4286 46.9164 19.5137 46.724 19.5137 46.5413C19.5137 46.3585 19.4286 46.1662 19.2834 46.021L19.0531 45.7907H14.259H9.46486L9.23458 46.021ZM9.23458 49.0233C9.08933 49.1684 9.00422 49.3608 9.00422 49.5435C9.00422 49.7263 9.08933 49.9186 9.23458 50.0638L9.46486 50.2941H14.259H19.0531L19.2834 50.0638C19.4286 49.9186 19.5137 49.7263 19.5137 49.5435C19.5137 49.3608 19.4286 49.1684 19.2834 49.0233L19.0531 48.793H14.259H9.46486L9.23458 49.0233Z" fill="#BF1E77"></path>
                            </svg>


                        </div>
                        <div>
                            Доставим товар
                            в любую точку мира
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
	<link rel="stylesheet" href="/local/components/leadspace/reviews.form/templates/.default/style.css">
	<link rel="stylesheet" href="/local/components/leadspace/reviews.list/templates/.default/style.css">

	<section class="section__review">
					<div class="container pt-4">
						<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"reviews", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "DATE_ACTIVE_FROM",
			2 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "24",
		"IBLOCK_TYPE" => "data",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "STARS",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "reviews",
		"ELEMENT_ID" => $elementId,
	),
	false
);?>

<?$APPLICATION->IncludeComponent("bitrix:news.list", "questions", Array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
		"DISPLAY_DATE" => "Y",	// Выводить дату элемента
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"FIELD_CODE" => array(	// Поля
			0 => "DATE_ACTIVE_FROM",
			1 => "",
		),
		"FILTER_NAME" => "",	// Фильтр
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"IBLOCK_ID" => "25",	// Код информационного блока
		"IBLOCK_TYPE" => "data",	// Тип информационного блока (используется только для проверки)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"NEWS_COUNT" => "20",	// Количество новостей на странице
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "Новости",	// Название категорий
		"PARENT_SECTION" => "",	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"PROPERTY_CODE" => array(	// Свойства
			0 => "",
			1 => "STARS",
			2 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
		"COMPONENT_TEMPLATE" => "reviews"
	),
	false
);?>
					</div>
				</section>
	
	
	<div class="container">
				<?

				if (
					Loader::includeModule('catalog')
					&& (!isset($arParams['DETAIL_SHOW_VIEWED']) || $arParams['DETAIL_SHOW_VIEWED'] != 'N')
				)
				{
					?>
				
							<?
							$APPLICATION->IncludeComponent(
								'bitrix:catalog.products.viewed',
								'',
								array(
									'IBLOCK_MODE' => 'single',
									'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
									'IBLOCK_ID' => $arParams['IBLOCK_ID'],
									'ELEMENT_SORT_FIELD' => $arParams['ELEMENT_SORT_FIELD'],
									'ELEMENT_SORT_ORDER' => $arParams['ELEMENT_SORT_ORDER'],
									'ELEMENT_SORT_FIELD2' => $arParams['ELEMENT_SORT_FIELD2'],
									'ELEMENT_SORT_ORDER2' => $arParams['ELEMENT_SORT_ORDER2'],
									'PROPERTY_CODE_'.$arParams['IBLOCK_ID'] => (isset($arParams['LIST_PROPERTY_CODE']) ? $arParams['LIST_PROPERTY_CODE'] : []),
									'PROPERTY_CODE_'.$recommendedData['OFFER_IBLOCK_ID'] => (isset($arParams['LIST_OFFERS_PROPERTY_CODE']) ? $arParams['LIST_OFFERS_PROPERTY_CODE'] : []),
									'PROPERTY_CODE_MOBILE'.$arParams['IBLOCK_ID'] => $arParams['LIST_PROPERTY_CODE_MOBILE'],
									'BASKET_URL' => $arParams['BASKET_URL'],
									'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
									'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
									'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
									'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
									'CACHE_TYPE' => $arParams['CACHE_TYPE'],
									'CACHE_TIME' => $arParams['CACHE_TIME'],
									'CACHE_FILTER' => $arParams['CACHE_FILTER'],
									'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
									'DISPLAY_COMPARE' => $arParams['USE_COMPARE'],
									'PRICE_CODE' => $arParams['~PRICE_CODE'],
									'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
									'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
									'PAGE_ELEMENT_COUNT' => 4,
									'SECTION_ELEMENT_ID' => $elementId,

									"SET_TITLE" => "N",
									"SET_BROWSER_TITLE" => "N",
									"SET_META_KEYWORDS" => "N",
									"SET_META_DESCRIPTION" => "N",
									"SET_LAST_MODIFIED" => "N",
									"ADD_SECTIONS_CHAIN" => "N",

									'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
									'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
									'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
									'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
									'CART_PROPERTIES_'.$arParams['IBLOCK_ID'] => (isset($arParams['PRODUCT_PROPERTIES']) ? $arParams['PRODUCT_PROPERTIES'] : []),
									'CART_PROPERTIES_'.$recommendedData['OFFER_IBLOCK_ID'] => (isset($arParams['OFFERS_CART_PROPERTIES']) ? $arParams['OFFERS_CART_PROPERTIES'] : []),
									'ADDITIONAL_PICT_PROP_'.$arParams['IBLOCK_ID'] => $arParams['ADD_PICT_PROP'],
									'ADDITIONAL_PICT_PROP_'.$recommendedData['OFFER_IBLOCK_ID'] => $arParams['OFFER_ADD_PICT_PROP'],

									'SHOW_FROM_SECTION' => 'N',
									'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
									'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
									'CURRENCY_ID' => $arParams['CURRENCY_ID'],
									'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
									'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],

									'LABEL_PROP_'.$arParams['IBLOCK_ID'] => $arParams['LABEL_PROP'],
									'LABEL_PROP_MOBILE_'.$arParams['IBLOCK_ID'] => $arParams['LABEL_PROP_MOBILE'],
									'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
									'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
									'PRODUCT_ROW_VARIANTS' => "[{'VARIANT':'3','BIG_DATA':false}]",
									'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
									'ENLARGE_PROP_'.$arParams['IBLOCK_ID'] => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
									'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
									'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
									'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

									'OFFER_TREE_PROPS_'.$recommendedData['OFFER_IBLOCK_ID'] => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
									'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
									'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
									'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
									'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
									'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
									'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
									'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
									'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
									'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
									'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
									'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
									'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
									'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
									'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
									'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

									'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
									'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
									'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

									'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
									'ADD_TO_BASKET_ACTION' => $basketAction,
									'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
									'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
									'COMPARE_NAME' => $arParams['COMPARE_NAME'],
									'USE_COMPARE_LIST' => 'Y'
								),
								$component
							);
							?>
						
					
					<?
				}
			}
		}
		?>
