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
	# * FILE: /sitemgr/listing/listing.php
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
	$url_base 	  = "".DEFAULT_URL."/sitemgr";
	$sitemgr 	  = 1;
	$item_form    = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	//increases frequently actions
	if (!isset($id)) system_setFreqActions('listing_add','listing');

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));
	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/listing.php");

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
			if ($id) $prefix = string_ucwords(system_showText(LANG_SITEMGR_EDIT)); else $prefix = string_ucwords(system_showText(LANG_SITEMGR_ADD));
			?>
			<h1><?=$prefix?> <?=system_showText(LANG_SITEMGR_LISTING_SING)?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_listing_submenu.php"); ?>
			
			<div class="baseForm">

			<form name="listing" id="listing" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">

				<!-- Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted)-->
				<input type="hidden" name="ieBugFix" value="1" />
				<!-- Microsoft IE Bug -->

				<input type="hidden" name="sitemgr" id="sitemgr" value="<?=$sitemgr?>" />
				<input type="hidden" name="id" id="id" value="<?=$id?>" />
				<input type="hidden" name="listingtemplate_id" value="<?=$listingtemplate_id?>" />
				<input type="hidden" name="level" value="<?=$level?>">
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<input type="hidden" name="gallery_hash" value="<?=$gallery_hash?>" />
				
				<? include(INCLUDES_DIR."/forms/form_listing.php"); ?>

				<button type="button" name="submit_button" class="input-button-form" value="Submit" onclick="JS_submit();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
				<button type="button" name="cancel" class="input-button-form" value="Cancel" onclick="document.getElementById('formlistingcancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

				<!-- Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted)-->
				<input type="hidden" name="ieBugFix2" value="1" /> 
				<!-- Microsoft IE Bug -->

			</form>

			<form id="formlistingcancel" action="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/<?=(($search_page) ? "search.php" : "index.php");?>" method="get">

				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />

			</form>
			
			</div>

		</div>
	</div>

	<div id="bottom-content">&nbsp;</div>

</div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>