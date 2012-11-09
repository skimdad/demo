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
	# * FILE: /members/banner/edit.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BANNER_FEATURE != "on" || CUSTOM_BANNER_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_base = "".DEFAULT_URL."/members";
	$url_redirect = $url_base."/".BANNER_FEATURE_FOLDER;
	$members = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$banner = new Banner($id);
		if (sess_getAccountIdFromSession() != $banner->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/members/".BANNER_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		}
	}
	else {
		header("Location: ".DEFAULT_URL."/members/".BANNER_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
		exit;
	}

	include(EDIRECTORY_ROOT."/includes/code/banner.php");

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

		<? if ($process == "signup") { ?>
			<ul class="standardStep">
				<li class="standardStepAD"><?=system_showText(LANG_ENJOY_OUR_SERVICES)?></li>
				<li><span>1</span>&nbsp;<?=system_showText(LANG_LABEL_ORDER)?></li>
				<li><span>2</span>&nbsp;<?=system_showText(LANG_LABEL_CHECKOUT)?></li>
				<li class="stepActived"><span>3</span>&nbsp;<?=system_showText(LANG_LABEL_CONFIGURATION);?></li>
			</ul>
		<? } ?>

		<h2><?=system_showText(LANG_BANNER_EDIT);?></h2>

		<form name="banner" id="banner" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">

			<input type="hidden" name="process" id="process" value="<?=$process?>" />
			<input type="hidden" name="operation" value="update" />
			<input type="hidden" name="id" value="<?=$id?>" />
			<input type="hidden" name="account_id" value="<?=$acctId?>" />
			<input type="hidden" name="level" value="<?=$level?>" />
			<input type="hidden" name="letter" value="<?=$letter?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />

			<? include(INCLUDES_DIR."/forms/form_banner.php"); ?>
			
			<div class="baseButtons floatButtons">

				<p class="standardButton">
					<button type="submit" value="<?=system_showText(LANG_BUTTON_UPDATE)?>"><?=system_showText(LANG_BUTTON_UPDATE)?></button>
				</p>
				
			</div>

		</form>
		<form action="<?=DEFAULT_URL?>/members/<?=BANNER_FEATURE_FOLDER;?>/index.php" method="post">

			<input type="hidden" name="letter" value="<?=$letter?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />
					
			<div class="baseButtons floatButtons noPadding">

				<p class="standardButton">
					<button type="submit" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
				</p>
				
			</div>

		</form>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>