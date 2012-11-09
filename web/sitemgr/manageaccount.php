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
	# * FILE: /sitemgr/manageaccount.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$success = false;

	
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if ($smaccount) {
		
			if ((string_strlen($_POST["password"]))||(string_strlen($_POST["retype_password"]))) {
				$validate_sitemgrcurrentpassword = validate_sitemgrCurrentPassword($_POST, $_SESSION[SESS_SM_ID], $message_smpassword);
			} else {
				$validate_sitemgrcurrentpassword = true;
			}			
		    
			if (validate_smaccount($_POST, $message_smaccount) && $validate_sitemgrcurrentpassword) {

				if ($permission) {
					$permissions = $permission;
					$permission = 0;
					foreach ($permissions as $each_permission) {
						$permission += $each_permission;
					}
				} else {
					$permission = 0;
				}
				$_POST["permission"] = $permission;

				$smaccount = new SMAccount($_POST["id"]);
				$smaccount->makeFromRow($_POST);
				$smaccount->save();

				if ($password) {
					$smaccount->setString("password", $password);
					$smaccount->updatePassword();
				}

				$success = true;
				$message_smaccount = system_showText(LANG_SITEMGR_MANAGEACCOUNT_SUCCESSUPDATED) ;

			}
	    }		
		if ($changelogin) {
			$validate_sitemgrcurrentpassword = true;
			if ((string_strlen($password))||(string_strlen($retype_password))) {
				setting_get("sitemgr_password", $sitemgr_password);
				if ($sitemgr_password != md5($current_password)) {
					$validate_sitemgrcurrentpassword = false;
					$error_currentpassword = system_showText(LANG_SITEMGR_MSGERROR_CURRENTPASSWORDINCORRECT);
				}
			}
			if ($validate_sitemgrcurrentpassword && validate_SM_changelogin($_POST, $message_changelogin)) {
				if ($username) {
					setting_get("sitemgr_username", $sm_username);
					if ($username != $sm_username) {
						setting_set("sitemgr_username", $username);
						$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MANAGEACCOUNT_USERNAMEWASCHANGED);
					}
				}
				if ($password) {
					$pwDBObj = db_getDBObject(DEFAULT_DB, true);
					$sql = "UPDATE Setting SET value = ".db_formatString(md5($password))." WHERE name = 'sitemgr_password'";
					$pwDBObj->query($sql);
					$actions[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MANAGEACCOUNT_PASSWORDWASCHANGED);
				}
				if ($actions) {
					$success = true;
					$message_changelogin .= implode("<br />", $actions);
				}
			}
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	if ($_SESSION[SESS_SM_ID]) {
		$smaccount = new SMAccount($_SESSION[SESS_SM_ID]);
		$smaccount->extract();
	} else {
		setting_get("sitemgr_username", $username);
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
			<h1><?=string_ucwords(system_showText(LANG_SITEMGR_MANAGEACCOUNT_MANAGEYOURACCOUNT))?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? if ($_SESSION[SESS_SM_ID]) { ?>

				<form name="smaccount" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
					<input type="hidden" name="id" value="<?=$_SESSION[SESS_SM_ID]?>" />
					<? include(INCLUDES_DIR."/forms/form_smaccount.php"); ?>
					<table style="margin: 0 auto 0 auto;">
						<tr>
							<td>
								<button type="submit" name="smaccount" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
							</td>
						</tr>
					</table>
				</form>

			<? } else { ?>

				<form name="changelogin" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
					<? include(INCLUDES_DIR."/forms/form_changelogin.php"); ?>
					<table style="margin: 0 auto 0 auto;">
						<tr>
							<td>
								<button type="submit" name="changelogin" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
							</td>
						</tr>
					</table>
				</form>

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
