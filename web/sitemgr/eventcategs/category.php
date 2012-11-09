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
	# * FILE: /sitemgr/eventcategs/category.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	if (!permission_hasSMPermSection(SITEMGR_PERMISSION_EVENTS)){
		header("Location: ".DEFAULT_URL."/sitemgr/");
		exit;
	}

	$url_redirect = "".DEFAULT_URL."/sitemgr/eventcategs";
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);	

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	//increases frequently actions
	if (!isset($id)) system_setFreqActions('eventcateg_add','EVENT_FEATURE');

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$table_category = "EventCategory";
	include(INCLUDES_DIR."/code/category.php");

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
			<h1><?=string_ucwords(system_showText(LANG_SITEMGR_EVENT_PLURAL))?> - <?=$_GET["id"]? system_showText(LANG_SITEMGR_EDIT) : system_showText(LANG_SITEMGR_ADD) ;?> <?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORY))?></h1>
		</div>
	</div>
	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
			<?if (CUSTOM_EVENT_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>
			<? include(INCLUDES_DIR."/tables/table_category_submenu.php"); ?>

			<br />
			
			<div class="baseForm">

			<form name="category" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

				<input type="hidden" id="id" name="id" value="<?=$id?>" />
				<input type="hidden" id="category_id" name="category_id" value="<?=$category_id?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />

				<? if ($id) { $subcategories = db_getFromDB("eventcategory", "category_id", $id, "all", "", "object", SELECTED_DOMAIN_ID);} ?>

				<? if ($message_category) { ?>
					<div id="warning" class="errorMessage"><?=$message_category?></div>
				<? } ?>
				
				<? include(INCLUDES_DIR."/forms/form_category.php"); ?>

				<button type="submit" name="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

			</form>
			<form action="<?=DEFAULT_URL?>/sitemgr/eventcategs/<?=(($search_page) ? "search.php" : "index.php");?>" method="get">

				<input type="hidden" id="category_id" name="category_id" value="<?=$category_id?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<button type="submit" name="cancel" value="Cancel" class="input-button-form"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

			</form>
			
			</div>
			<? } ?>
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
