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
	# * FILE: /sitemgr/deal/deal.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	$promoLevelListing = new ListingLevel();
	$levels_all = $promoLevelListing->getLevelValues();
	foreach ($levels_all as $level_each) {
		if ( $promoLevelListing->getHasPromotion($level_each) == "y" ) $hasPromotion = true;
	}
	if ( PROMOTION_FEATURE != "on" ) exit;
	elseif ( !$hasPromotion ) exit;
	
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	if ($_POST["action"] == "useDeal" && $_POST["promotion_id"]){
		$dealObj = new Promotion();
		$dealObj->setPromoCode($_POST["promotion_id"], 1);
		die("OK");
	}
	if ($_POST["action"] == "freeUpDeal" && $_POST["promotion_id"]){
		$dealObj = new Promotion();
		$dealObj->setPromoCode($_POST["promotion_id"], 0);
		die("OK");
	}

	$url_redirect = "".DEFAULT_URL."/sitemgr/".PROMOTION_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	extract($_GET);
	extract($_POST);

	//increases frequently actions
	if (!isset($id)) system_setFreqActions("promotion_add", "PROMOTION_FEATURE");

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	include(EDIRECTORY_ROOT."/includes/code/promotion.php");

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
			<?
			if($id) 
				$prefix = string_ucwords(system_showText(LANG_SITEMGR_EDIT));
			else 
				$prefix = string_ucwords(system_showText(LANG_SITEMGR_MENU_ADD));
			?>
			<h1><?=$prefix?> <?=string_ucwords(system_showText(LANG_SITEMGR_PROMOTION))?></h1>
		</div>
	</div>
	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
			<?if (CUSTOM_PROMOTION_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>
			<? include(INCLUDES_DIR."/tables/table_promotion_submenu.php"); ?>
			
			<div class="baseForm">

				<form name="promotion" id="promotion" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="sitemgr" id="sitemgr" value="<?=$sitemgr?>" />
					<input type="hidden" name="id" value="<?=$id?>" />
					<input type="hidden" name="listing_id" value="<?=$listing_id?>" />
					<? include(INCLUDES_DIR."/forms/form_promotion.php"); ?>
					<input type="hidden" name="letter" value="<?=$letter?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />
					<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
					<button type="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
					<button type="button" value="Cancel" class="input-button-form" onclick="document.getElementById('formpromotioncancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
				</form>
				<form id="formpromotioncancel" action="<?=DEFAULT_URL?>/sitemgr/<?=PROMOTION_FEATURE_FOLDER?>/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">
					<input type="hidden" name="letter" value="<?=$letter?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />
					<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				</form>
			
			</div>
			<? } ?>

		</div>
	</div>
	<div id="bottom-content">&nbsp;</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		//DATE PICKER
		<?
		if ( DEFAULT_DATE_FORMAT == "m/d/Y" ) $date_format = "mm/dd/yy";
		elseif ( DEFAULT_DATE_FORMAT == "d/m/Y" ) $date_format = "dd/mm/yy";
		?>

		$("#start_date").datepicker({
			dateFormat: "<?=$date_format?>",
			changeMonth: true,
			changeYear: true,
            yearRange: "<?=date("Y")-1?>:<?=date("Y")+10?>"
		});
		$("#end_date").datepicker({
			dateFormat: "<?=$date_format?>",
			changeMonth: true,
			changeYear: true,
            yearRange: "<?=date("Y")?>:<?=date("Y")+10?>"
		});
    });
</script>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>