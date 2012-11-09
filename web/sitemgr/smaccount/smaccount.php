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
	# * FILE: /sitemgr/smaccount/smaccount.php
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

	// required because of the cookie var
	$username = "";

	extract($_GET);
	extract($_POST);	

	//increases frequently actions
	if (!isset($id)) system_setFreqActions('smaccount_add','smaaccount');

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		
		if (($password == '0' && string_strlen($password) < 4)) {
			$sucess = false;
			$message_smaccount = system_showText(LANG_MSG_ENTER_PASSWORD_WITH_MIN_CHARS)." ".PASSWORD_MIN_LEN." ".system_showText(LANG_LABEL_CHARACTERES).".";
		} else {
			if (validate_smaccount($_POST, $message_smaccount)) {

				if ($permission) {
					$permissions = $permission;
					$permission = 0;
					foreach ($permissions as $each_permission) {
						$permission += $each_permission;
						if ($each_permission == 4){ //if has permission for settings
							$permission += 10;		//add permission for email notifications and google prefs
					}
					}
				} else {
					$permission = 0;
				}
				$_POST["permission"] = $permission;
				if ($_POST["active"] && ($_POST["active"]!="y" && $_POST["active"]!="n"))
					$_POST["active"] = "y";
				$smaccount = new SMAccount($_POST);
				$smaccount->Save();

				if ($password) {
					$smaccount->setString("password", $password);
					$smaccount->updatePassword();
				}

				if ($id) {
					//$message = system_showText(LANG_SITEMGR_SMACCOUNT_SUCCESSUPDATED);
					$message = 5;
				} else {
					$newest = "1";
					//$message = system_showText(LANG_SITEMGR_SMACCOUNT_SUCCESSADDED);
					$message = 6;
				}

				header("Location: ".DEFAULT_URL."/sitemgr/smaccount/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&newest=".$newest."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
				exit;

			}
		}
		
		// removing slashes added if required
		$_POST = format_magicQuotes($_POST);
		$_GET  = format_magicQuotes($_GET);
		extract($_POST);
		extract($_GET);

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$smaccount = new SMAccount($id);
		$smaccount->extract();
	}

	extract($_POST);
	extract($_GET);

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
			<h1><?=system_showText(LANG_SITEMGR_SMACCOUNT_ACCOUNTINFORMATION)?></h1>
		</div>
	</div>
	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_smaccount_submenu.php"); ?>
			
			<div class="baseForm">

			<form name="smaccount" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" style="margin:0; padding:0">
				<input type="hidden" name="id" value="<?=$id?>" />

				<? include(INCLUDES_DIR."/forms/form_smaccount.php"); ?>

				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<button type="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
				<button type="button" value="Cancel" class="input-button-form" onclick="document.getElementById('formsmaccountcancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

			</form>
			<form id="formsmaccountcancel" action="<?=DEFAULT_URL?>/sitemgr/smaccount/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">

				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />

			</form>
			
			</div>

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
