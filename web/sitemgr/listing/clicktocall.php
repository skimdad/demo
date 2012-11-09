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
	# * FILE: /sitemgr/listing/clicktocall.php
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

	$url_redirect = "".DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;
	
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));
	
	$errorPage = "$url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."";

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if (TWILIO_APP_ENABLED != "on" || TWILIO_APP_ENABLED_CALL != "on"){
		header("Location: ".DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER."/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}
	
	if ($id) {
		$level = new ListingLevel();
		$listing = new Listing($id);
        $accId = $listing->getNumber("account_id");
		if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
			header("Location: ".DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER."/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;
		}
		$listingHasClickToCall = $level->getHasCall($listing->getNumber("level"));
		if ((!$listingHasClickToCall) || ($listingHasClickToCall != "y")) {
			header("Location: ".$errorPage);
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER."/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/clicktocall.php");

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
			<h1><?=string_ucwords(system_showText(LANG_LABEL_CLICKTOCALL))?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_listing_submenu.php"); ?>

			<br />

			<div id="header-view">
				<?=LANG_SITEMGR_LISTING_SING;?> <?=string_ucwords(system_showText(LANG_LABEL_CLICKTOCALL))?> - <?=$listing->getString("title")?>
			</div>

			<div class="tip-base">
				<h1><?=system_showText(LANG_CLICKTOCALL_TIPTITLE)?></h1><br />
				<p style="text-align: justify;"><strong><?=system_showText(LANG_CLICKTOCALL_TIP1)?></strong></p><br />
				<span class="warning" style="text-align: justify;"><?=system_showText(LANG_CLICKTOCALL_TIP2)?></span>
				<span class="warning" style="text-align: justify;"><?=system_showText(LANG_CLICKTOCALL_TIP3)?></span>
				<span class="warning" style="text-align: justify;"><?=system_showText(LANG_CLICKTOCALL_TIP4)?></span>
				<span class="warning" style="text-align: justify;"><?=system_showText(LANG_CLICKTOCALL_TIP5)?></span>
			</div>


			<div class="baseForm">

				<form name="clicktocall_form" id="clicktocall_form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

					<input type="hidden" name="sitemgr" id="sitemgr" value="<?=$sitemgr?>" />
					<input type="hidden" name="id" id="id" value="<?=$id?>" />						
					<input type="hidden" name="item_title" id="item_title" value="<?=$item_title?>" />						
					<input type="hidden" name="module" id="module" value="<?=$module?>" />						
					<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
					<input type="hidden" name="letter" value="<?=$letter?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />

					<?
					include(INCLUDES_DIR."/forms/form_clicktocall.php");
					?>
					
					<button type="submit" name="submit_button" class="input-button-form" value="Submit">
						<?=system_showText(LANG_CLICKTOCALL_ACTIVATE)?>
					</button>
					<button type="button" name="check_button" id="buttonSaveCopy" class="input-button-form <?=!$enableSave ? "input-button-form-disabled" : ""?>" <?=!$enableSave ? " disabled=\"disabled\"" : "onclick=\"changeSendForm('checkClickToCall');\""?> value="validate" >
						<?=system_showText(LANG_MSG_SAVE_CHANGES)?>
					</button>
					<button type="button" name="check_button" class="input-button-form <?=!$itemObj->getString("clicktocall_number") ? "input-button-form-disabled" : "" ?>" <?=!$itemObj->getString("clicktocall_number") ? " disabled=\"disabled\"" : "onclick=\"changeSendForm('clearNumber');\""?> value="clear"  >
						<?=system_showText(LANG_BUTTON_CLEAR)?>
					</button>
					<button type="button" name="cancel" value="Cancel" class="input-button-form" onclick="document.getElementById('formlistingclicktocallcancel').submit();">
						<?=system_showText(LANG_BUTTON_CANCEL)?>
					</button>
				</form>
				<form id="formlistingclicktocallcancel" action="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/<?=(($search_page) ? "search.php" : "index.php");?>" method="get">

					<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
					<input type="hidden" name="letter" value="<?=$letter?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />

				</form>

			</div>
		</div>
	</div>

	<div id="bottom-content">

	</div>

</div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>