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
	# * FILE: /sitemgr/classified/seocenter.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/sitemgr/".CLASSIFIED_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/classified_seocenter.php");

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
			<h1><?=system_showText(LANG_SITEMGR_CLASSIFIED_SING)?> <?=system_showText(LANG_SITEMGR_SEOCENTER)?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
			<?if (CUSTOM_CLASSIFIED_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>
			<? include(INCLUDES_DIR."/tables/table_classified_submenu.php"); ?>

			<br />

			<div class="header-form">
				<?=system_showText(LANG_SITEMGR_CLASSIFIED_SING)?> - <?=$classified->getString("title")?>
			</div>
			
			<div class="baseForm">

			<form name="classifiedseocenter" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

				<input type="hidden" name="id" id="id" value="<?=$id?>" />
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<? include(INCLUDES_DIR."/forms/form_classified_seocenter.php"); ?>

					<button type="submit" name="submit_button" class="input-button-form"><?=string_ucwords(system_showText(LANG_SITEMGR_SUBMIT))?></button>

					<button type="button" value="Cancel" class="input-button-form" onclick="document.getElementById('formclassifiedseocentercancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

			</form>

			<form id="formclassifiedseocentercancel" action="<?=DEFAULT_URL?>/sitemgr/<?=CLASSIFIED_FEATURE_FOLDER;?>/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">

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

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
