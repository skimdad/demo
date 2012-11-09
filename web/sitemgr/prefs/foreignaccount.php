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
	# * FILE: /sitemgr/prefs/foreignaccount.php
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
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	$_POST = array_map("trim", $_POST);
	extract($_POST);
	extract($_GET);

	//increases frequently actions
	if (!isset($foreignaccount)) system_setFreqActions('prefs_signinoptions','prefssign');

	$message_style = "successMessage";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$invalidID = false;
		if (!preg_match("/^[0-9]*$/", $foreignaccount_facebook_apiid)) {
			$error = true;
			$invalidID = true;
		}
		
		if(!$invalidID) {
			if (!setting_set("foreignaccount_openid", $foreignaccount_openid))
				if (!setting_new("foreignaccount_openid", $foreignaccount_openid))
					$error = true;
				
			if (!setting_set("foreignaccount_google", $foreignaccount_google))
				if (!setting_new("foreignaccount_google", $foreignaccount_google))
					$error = true;

			if (($foreignaccount_facebook && $foreignaccount_facebook_apisecret && $foreignaccount_facebook_apiid) || (!$foreignaccount_facebook && !$foreignaccount_facebook_apisecret && !$foreignaccount_facebook_apiid)) {
				if (!setting_set("foreignaccount_facebook", $foreignaccount_facebook))
					if (!setting_new("foreignaccount_facebook", $foreignaccount_facebook))
						$error = true;

				if (!setting_set("foreignaccount_facebook_apisecret", $foreignaccount_facebook_apisecret))
					if (!setting_new("foreignaccount_facebook_apisecret", $foreignaccount_facebook_apisecret))
						$error = true;

				if (!setting_set("foreignaccount_facebook_apiid", $foreignaccount_facebook_apiid))
					if (!setting_new("foreignaccount_facebook_apiid", $foreignaccount_facebook_apiid))
						$error = true;
			} else {
				$error = false;

				if ($foreignaccount_facebook_apisecret && $foreignaccount_facebook_apiid) {


					if (!setting_set("foreignaccount_facebook", $foreignaccount_facebook))
						if (!setting_new("foreignaccount_facebook", $foreignaccount_facebook))
							$error = true;

					if (!setting_set("foreignaccount_facebook_apisecret", $foreignaccount_facebook_apisecret))
						if (!setting_new("foreignaccount_facebook_apisecret", $foreignaccount_facebook_apisecret))
							$error = true;

					if (!setting_set("foreignaccount_facebook_apiid", $foreignaccount_facebook_apiid))
						if (!setting_new("foreignaccount_facebook_apiid", $foreignaccount_facebook_apiid))
							$error = true;
				} else if (!$foreignaccount_facebook || !$foreignaccount_facebook_apisecret || !$foreignaccount_facebook_apiid) {
					$error = true;
				}
			}
		}
		
		if (!$error) {
			$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_CONFIGURATIONWASCHANGED);
		} else {
			if ($invalidID) $actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR_API);
			else $actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_EMPTYKEYS);
			$message_style = "errorMessage";
		}
		if ($actions) {
			$message_foreignaccount .= implode("<br />", $actions);
		}

	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	/**
	 * OpenID Account
	 */
	setting_get("foreignaccount_openid", $foreignaccount_openid);
	if ($foreignaccount_openid) $foreignaccount_openid_checked = "checked";
	
	/**
	 * Facebook Account
	 */
	setting_get("foreignaccount_facebook", $foreignaccount_facebook);
	if ($foreignaccount_facebook) $foreignaccount_facebook_checked = "checked";
	if (!$foreignaccount_facebook_apisecret) setting_get("foreignaccount_facebook_apisecret", $foreignaccount_facebook_apisecret);
	if (!$foreignaccount_facebook_apiid) setting_get("foreignaccount_facebook_apiid", $foreignaccount_facebook_apiid);
	
	/**
	 * Google Account
	 */
	setting_get("foreignaccount_google", $foreignaccount_google);
	if ($foreignaccount_google) $foreignaccount_google_checked = "checked";

?>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=system_showText(LANG_SITEMGR_MENU_LOGINOPTIONS)?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<br />

			<form name="foreignaccount" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				<? include(INCLUDES_DIR."/forms/form_foreignaccount.php"); ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="foreignaccount" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
						</td>
					</tr>
				</table>
			</form>

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
