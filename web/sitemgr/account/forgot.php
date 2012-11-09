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
	# * FILE: /sitemgr/account/forgot.php
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
	
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$account = new Account($id);
	} else {
		header("Location: ".DEFAULT_URL."/sitemgr/account/");
		exit;
	}

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$section = "members";
		include(INCLUDES_DIR."/code/forgot_password.php");
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
		<h1><?=string_ucwords(system_showText(LANG_SITEMGR_FORGOTTENPASSWORD))?></h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin">

	<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
	<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
	<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

	<? if ($_SERVER['REQUEST_METHOD'] != "POST") { ?>
	<div class="baseForm">
		<form name="account" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
			<input type="hidden" name="id" value="<?=$id?>" />
			<input type="hidden" name="username" value="<?=$account->getString("username")?>" />
			<div class="header-form">
				<?=system_showText(LANG_SITEMGR_ACCOUNT_FORGOTTENPASSWORDACCOUNT)?> - <?=$account->getString("username")?>
			</div>
			<p class="informationMessage">
				<?=system_showText(LANG_SITEMGR_ACCOUNT_FORGOTEMAILQUESTION)?>
			</p>
			
			<button type="submit" value="Yes" class="input-button-form"><?=system_showText(LANG_SITEMGR_YES)?></button>
		</form>
		<form action="<?=DEFAULT_URL?>/sitemgr/account/" method="post">
			<button type="submit" value="Cancel" class="input-button-form"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
		</form>
		
		</div>
	<? } else { ?>
		<? if ($message) { ?>
			<div id="warning" class="<?=$message_class;?>">
				&nbsp;<?=$message?>&nbsp;
			</div>
		<? } ?>
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
