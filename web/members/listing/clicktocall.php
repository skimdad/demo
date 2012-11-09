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
	# * FILE: /members/listing/clicktocall.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	$url_redirect = "".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/members";
	$members = 1;
	
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));
	
	$errorPage = "$url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."";

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if (TWILIO_APP_ENABLED != "on" || TWILIO_APP_ENABLED_CALL != "on"){
		header("Location: ".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER."/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}
	
	if ($id) {
		$level = new ListingLevel();
		$listing = new Listing($id);
        $accId = $listing->getNumber("account_id");
		if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
			header("Location: ".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		}
		if (sess_getAccountIdFromSession() != $listing->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		}
		$listingHasClickToCall = $level->getHasCall($listing->getNumber("level"));
		if ((!$listingHasClickToCall) || ($listingHasClickToCall != "y")) {
			header("Location: ".$errorPage);
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/clicktocall.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");
?>

<div class="content">
	
	<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
	<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
	<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

	<h2><?=string_ucwords(system_showText(LANG_LABEL_CLICKTOCALL))?></h2>
	
	<ul class="list-view">
		<li class="list-back"><a href="<?=DEFAULT_URL?>/members/<?=LISTING_FEATURE_FOLDER;?>/<?=($search_page) ? "search.php" : "index.php"?>?screen=<?=$screen?>&letter=<?=$letter?>"><?=system_showText(LANG_LABEL_BACK);?></a></li>
	</ul>
	
	<h2 class="standardSubTitle"><?=system_showText(LANG_LISTING_FEATURE_NAME)?> <?=system_showText(LANG_LABEL_CLICKTOCALL)?> - <?=$listing->getString("title")?></h2>

	<form name="clicktocall_form" id="clicktocall_form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

		<input type="hidden" name="id" id="id" value="<?=$id?>" />						
		<input type="hidden" name="item_title" id="item_title" value="<?=$item_title?>" />						
		<input type="hidden" name="module" id="module" value="<?=$module?>" />						
		<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
		<input type="hidden" name="letter" value="<?=$letter?>" />
		<input type="hidden" name="screen" value="<?=$screen?>" />
		
		<div class="tip-base">
			<h1><?=system_showText(LANG_CLICKTOCALL_TIPTITLE)?></h1><br />
			<p style="text-align: justify;"><strong><?=system_showText(LANG_CLICKTOCALL_TIP1)?></strong></p><br />
			<span class="warning" style="text-align: justify;"><?=system_showText(LANG_CLICKTOCALL_TIP2)?></span>
			<span class="warning" style="text-align: justify;"><?=system_showText(LANG_CLICKTOCALL_TIP3)?></span>
			<span class="warning" style="text-align: justify;"><?=system_showText(LANG_CLICKTOCALL_TIP4)?></span>
			<span class="warning" style="text-align: justify;"><?=system_showText(LANG_CLICKTOCALL_TIP5)?></span>
		</div>

		<?
		include(INCLUDES_DIR."/forms/form_clicktocall.php");
		?>

		<div class="baseButtons baseButtonsClick">
		
			<p class="standardButton">
				<button type="submit" name="submit_button" value="Submit">
					<?=system_showText(LANG_CLICKTOCALL_ACTIVATE)?>
				</button>
			</p>

			<p class="standardButton <?=!$enableSave ? "standardButton-disabled" : ""?>" id="buttonSaveCopy" <?=!$enableSave ? " disabled=\"disabled\"" : "onclick=\"changeSendForm('checkClickToCall');\""?>>
				<button type="button" name="check_button" value="validate" >
					<?=system_showText(LANG_MSG_SAVE_CHANGES)?>
				</button>
			</p>

			<p class="standardButton <?=!$itemObj->getString("clicktocall_number") ? "standardButton-disabled" : "" ?>" <?=!$itemObj->getString("clicktocall_number") ? " disabled=\"disabled\"" : "onclick=\"changeSendForm('clearNumber');\""?>>
				<button type="button" name="check_button" value="clear" >
					<?=system_showText(LANG_BUTTON_CLEAR)?>
				</button>
			</p>

			<p class="standardButton">
				<button type="button" name="cancel" value="Cancel" class="input-button-form" onclick="document.getElementById('formlistingclicktocallcancel').submit();">
					<?=system_showText(LANG_BUTTON_CANCEL)?>
				</button>
			</p>
		
		</div>
	</form>
				<form id="formlistingclicktocallcancel" action="<?=DEFAULT_URL?>/members/<?=LISTING_FEATURE_FOLDER;?>/<?=(($search_page) ? "search.php" : "index.php");?>" method="get">

		<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
		<input type="hidden" name="letter" value="<?=$letter?>" />
		<input type="hidden" name="screen" value="<?=$screen?>" />

	</form>
</div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>