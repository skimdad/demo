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
	# * FILE: /sitemgr/package/delete.php
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

	$url_redirect = "".DEFAULT_URL."/sitemgr/package";
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
	if ($id) {
		$packageObj = new Package($id);
	}	else {
		header("Location: ".DEFAULT_URL."/sitemgr/package/index.php?message=".$message."&screen=$screen&letter=$letter");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		/*
		 * Get account to save Log
		 */
		unset($aux_SMAccount);

		if (sess_getSMIdFromSession()){
			$smAccountObj = new SMAccount(sess_getSMIdFromSession());
			$aux_SMAccount = $smAccountObj->getString("name")." (".$smAccountObj->getString("username").")";
		} else {
			setting_get("sitemgr_username",$sitemgr_email);
			$aux_SMAccount = "Sitemgr"." (".$sitemgr_email.")";
		}

		$packageObj = new Package($_POST['id']);
		$packageObj->Delete($aux_SMAccount);
		$message = 2;
		header("Location: ".DEFAULT_URL."/sitemgr/package/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
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
		<div id="header-content"><h1><?=string_ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=system_showText(LANG_SITEMGR_PACKAGE_SING);?></h1></div>
	</div>
	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
			
			
			<div class="baseForm">

				<form name="package" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">

					<input type="hidden" name="id" value="<?=$id?>" />
					<div class="header-form">
						<?=string_ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=system_showText(LANG_SITEMGR_PACKAGE_SING);?> - <?=$packageObj->getString("title")?>
					</div>
					<p class="informationMessage">
						<?=system_showText(LANG_SITEMGR_PACKAGE_DELETEQUESTION)?>
					</p>
					<input type="hidden" name="letter" value="<?=$letter?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />
					<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
					<button type="submit" value="Submit" class="input-button-form">
						<?=system_showText(LANG_SITEMGR_SUBMIT)?>
					</button>
					<button type="button" value="Cancel" class="input-button-form" onclick="document.getElementById('formpackagedeletecancel').submit();">
						<?=system_showText(LANG_SITEMGR_CANCEL)?>
					</button>
				</form>
				<form id="formpackagedeletecancel" action="<?=DEFAULT_URL?>/sitemgr/package/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">
					<input type="hidden" name="letter" value="<?=$letter?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />
					<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
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
