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
	# * FILE: /sitemgr/account/delete.php
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
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	if ($id) {
		$account = new Account($id);
	} else {
		//$message = system_showText(LANG_SITEMGR_ACCOUNT_NOTFOUND);
        $message = 2;
		header("Location: ".DEFAULT_URL."/sitemgr/account/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$account = new Account($_POST['id']);
		$account->delete();
		//$message = system_showText(LANG_SITEMGR_ACCOUNT_SUCCESSDELETED);
        $message = 3;
		header("Location: ".DEFAULT_URL."/sitemgr/account/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
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
		<div id="header-content">
			<h1><?=system_showText(LANG_SITEMGR_DELETE)?> <?=string_ucwords(system_showText(LANG_SITEMGR_ACCOUNT))?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? if ($message_delete) { ?>
				<div id="warning" class="errorMessage">&nbsp;<?=$message_delete?>&nbsp;</div>
			<? } ?>
			
			<div class="baseForm">

			<form name="account" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">

				<input type="hidden" name="id" value="<?=$id?>" />
				<div class="header-form">
					<?=system_showText(LANG_SITEMGR_DELETE)?> <?=string_ucwords(system_showText(LANG_SITEMGR_ACCOUNT))?> - <?=system_showAccountUserName($account->getString("username"))?>
				</div>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_ACCOUNT_DELETEQUESTION)?>
				</p>
						<? if (!DEMO_LIVE_MODE || ($account->getString("username") != "demo")) { ?>
								<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
								<input type="hidden" name="letter" value="<?=$letter?>" />
								<input type="hidden" name="screen" value="<?=$screen?>" />
								<button type="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
						<? } ?>
						<button type="button" value="Cancel" class="input-button-form" onclick="document.getElementById('formaccountdeletecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

			</form>
			<form id="formaccountdeletecancel" action="<?=DEFAULT_URL?>/sitemgr/account/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">

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
