<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# eDirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /sitemgr/prefs/pricing.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	//increases frequently actions
	if (!isset($price)) system_setFreqActions('prefs_pricing','pricing');
	
	// Default CSS class for message
	$message_style = "successMessage";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		// Listing Default Prices
		if($listingdefaultprice) {

			foreach ($price as $priceLevel=>$priceValue) {
				$price[$priceLevel] = format_money($priceValue);
			}

			foreach ($free_category as $freeCategoryLevel=>$freeCategoryValue) {
				if ($freeCategoryValue > 0) $free_category[$freeCategoryLevel] = $freeCategoryValue;
				else $free_category[$freeCategoryLevel] = 0;
			}

			foreach ($category_price as $categoryPriceLevel=>$categoryPriceValue) {
				$category_price[$categoryPriceLevel] = format_money($categoryPriceValue);
			}

			if (validate_form("listingdefaultprice", $_POST, $message_listingdefaultprice)) {

				$listingLevelObj = new ListingLevel();
				foreach ($price as $priceLevel=>$priceValue) {
                    $listingLevelObj->updatePricing("price", $priceValue, $priceLevel);
				}

				foreach ($free_category as $freeCategoryLevel=>$freeCategoryValue) {
                    $listingLevelObj->updatePricing("free_category", $freeCategoryValue, $freeCategoryLevel);
				}

				foreach ($category_price as $categoryPriceLevel=>$categoryPriceValue) {
                    $listingLevelObj->updatePricing("category_price", $categoryPriceValue, $categoryPriceLevel);
				}

				if (!$error) {
                    header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/pricing.php?message=1&levelModule=listing#link");
                    exit;
				} else {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
					$message_style = "errorMessage";
				}

				if($actions) {
					$message_listingdefaultprice .= implode("<br />", $actions);
				}

			} else {
				$message_style = "errorMessage";
			}

		}

		// Event Default Prices
		else if($eventdefaultprice) {

			foreach ($price as $priceLevel=>$priceValue) {
				$price[$priceLevel] = format_money($priceValue);
			}

			if (validate_form("eventdefaultprice", $_POST, $message_eventdefaultprice)) {

				$eventLevelObj = new EventLevel();
				foreach ($price as $priceLevel=>$priceValue) {
                    $eventLevelObj->updatePricing("price", $priceValue, $priceLevel);
				}

				if (!$error) {
					 header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/pricing.php?message=1&levelModule=event#link");
                    exit;
				} else {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
					$message_style = "errorMessage";
				}

				if($actions) {
					$message_eventdefaultprice .= implode("<br />", $actions);
				}

			} else {
				$message_style = "errorMessage";
			}

		}

		// Banner Default Prices
		else if($bannerdefaultprice) {

			foreach ($price as $priceLevel=>$priceValue) {
				$price[$priceLevel] = format_money($priceValue);
			}
			
			foreach($impression_price as $impression_price_level => $impression_price_value){
				$impression_price[$impression_price_level] = format_money($impression_price_value);
			}
				
			if (validate_form("bannerdefaultprice", $_POST, $message_bannerdefaultprice)) {

				$bannerLevelObj = new BannerLevel();
				foreach ($price as $priceLevel=>$priceValue) {
                    $bannerLevelObj->updatePricing("price", $priceValue, $priceLevel);
				}

				foreach ($impression_block as $impression_block_level => $impression_block_value) {
                    $bannerLevelObj->updatePricing("impression_block", $impression_block_value, $impression_block_level);
				}

				foreach ($impression_price as $impression_price_level => $impression_price_value) {
                    $bannerLevelObj->updatePricing("impression_price", $impression_price_value, $impression_price_level);
				}

				if (!$error) {
					 header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/pricing.php?message=1&levelModule=banner#link");
                    exit;
				} else {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
					$message_style = "errorMessage";
				}

				if($actions) {
					$message_bannerdefaultprice .= implode("<br />", $actions);
				}

			} else {
				$message_style = "errorMessage";
			}

		}

		// Classified Default Prices
		else if($classifieddefaultprice) {

			foreach ($price as $priceLevel=>$priceValue) {
				$price[$priceLevel] = format_money($priceValue);
			}

			if (validate_form("classifieddefaultprice", $_POST, $message_classifieddefaultprice)) {

				$classifiedLevelObj = new ClassifiedLevel();
				foreach ($price as $priceLevel=>$priceValue) {
                    $classifiedLevelObj->updatePricing("price", $priceValue, $priceLevel);
				}
				if (!$error) {
					 header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/pricing.php?message=1&levelModule=classified#link");
                    exit;
				} else {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
					$message_style = "errorMessage";
				}

				if($actions) {
					$message_classifieddefaultprice .= implode("<br />", $actions);
				}

			} else {
				$message_style = "errorMessage";
			}

		}

		// Article Default Prices
		else if($articledefaultprice) {

			foreach ($price as $priceLevel=>$priceValue) {
				$price[$priceLevel] = format_money($priceValue);
			}

			if (validate_form("articledefaultprice", $_POST, $message_articledefaultprice)) {

				$articleLevelObj = new ArticleLevel();
				foreach ($price as $priceLevel=>$priceValue) {
                    $articleLevelObj->updatePricing("price", $priceValue, $priceLevel);
				}

				if (!$error) {
					 header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/pricing.php?message=1&levelModule=article#link");
                    exit;
				} else {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
					$message_style = "errorMessage";
				}

				if($actions) {
					$message_articledefaultprice .= implode("<br />", $actions);
				}

			} else {
				$message_style = "errorMessage";
			}

		}
		
		// update deals price (by Debiprasad 17th Aug., 2012)
		else if ($extradealspriceupdate) {
			foreach ($price as $priceLevel=>$priceValue) {
				$price[$priceLevel] = format_money($priceValue);
			}

			if (validate_form("extradealsprice", $_POST, $message_extradealsprice)) {
				$promotionPriceObj = new PromotionPrice();
				foreach ($price as $priceLevel=>$priceValue) {
					$promotionPriceObj->updatePricing($priceLevel, $priceValue);
				}
				if (!$error) {
					 header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/pricing.php?message=1&levelModule=promotion#link");
                    exit;
				} else {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
					$message_style = "errorMessage";
				}

				if($actions) {
					$message_extradealsprice .= implode("<br />", $actions);
				}

			} else {
				$message_style = "errorMessage";
			}
		}

	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=ucfirst(system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS))?> - <?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_PRICING))?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>			

			<br />

			<form name="listingdefaultprice" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				<? include(INCLUDES_DIR."/forms/form_listingdefaultprice.php"); ?>
				<table class="table-form">
					<tr>
						<td>
							<button type="submit" name="listingdefaultprice" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
						</td>
					</tr>
				</table>
			</form>

			<? if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on") { ?>
				<form name="extradealsprice" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
					<? include(INCLUDES_DIR."/forms/form_extra_deals_price.php"); ?>
					<table class="table-form">
						<tr>
							<td>
								<button type="submit" name="extradealspriceupdate" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
							</td>
						</tr>
					</table>
				</form>
			<? } ?>

			<? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") { ?>
				<form name="bannerdefaultprice" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
					<? include(INCLUDES_DIR."/forms/form_bannerdefaultprice.php"); ?>
					<table class="table-form">
						<tr>
							<td>
								<button type="submit" name="bannerdefaultprice" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
							</td>
						</tr>
					</table>
				</form>
			<? } ?>
			
			<? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
				<form name="eventdefaultprice" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
					<? include(INCLUDES_DIR."/forms/form_eventdefaultprice.php"); ?>
					<table class="table-form">
						<tr>
							<td>
								<button type="submit" name="eventdefaultprice" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
							</td>
						</tr>
					</table>
				</form>
			<? } ?>

			<? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
				<form name="classifieddefaultprice" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
					<? include(INCLUDES_DIR."/forms/form_classifieddefaultprice.php"); ?>
					<table class="table-form">
						<tr>
							<td>
								<button type="submit" name="classifieddefaultprice" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
							</td>
						</tr>
					</table>
				</form>
			<? } ?>

			<? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
				<form name="articledefaultprice" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
					<? include(INCLUDES_DIR."/forms/form_articledefaultprice.php"); ?>
					<table class="table-form">
						<tr>
							<td>
								<button type="submit" name="articledefaultprice" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
							</td>
						</tr>
					</table>
				</form>
			<? } ?>

		</div>
	</div>

	<div id="bottom-content">
		&nbsp;
	</div>

</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
