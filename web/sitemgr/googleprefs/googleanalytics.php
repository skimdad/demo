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
	# * FILE: /sitemgr/googleprefs/googleanalytics.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATING FEATURES
	# ----------------------------------------------------------------------------------------------------
	if (GOOGLE_ANALYTICS_ENABLED != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	extract($_POST);
	extract($_GET);	

	//increases frequently actions
	if (!isset($google_analytics_account)) system_setFreqActions('prefs_googleanalytics','GOOGLE_ANALYTICS_ENABLED');

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	
	// Default CSS class for message
	$message_style = "errorMessage";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		$googleSettingObj = new GoogleSettings(GOOGLE_ANALYTICS_SETTING);
		$google_analytics_account = $googleSettingObj->formatValue($google_analytics_account);
		$googleSettingObj->setString("value", $google_analytics_account);
		$googleSettingObj->Save();

		$googleSettingObj = new GoogleSettings(GOOGLE_ANALYTICS_FRONT_SETTING);
		$googleSettingObj->setString("value", $google_analytics_front);
		$googleSettingObj->Save();

		$googleSettingObj = new GoogleSettings(GOOGLE_ANALYTICS_MEMBERS_SETTING);
		$googleSettingObj->setString("value", $google_analytics_members);
		$googleSettingObj->Save();

		$googleSettingObj = new GoogleSettings(GOOGLE_ANALYTICS_SITEMGR_SETTING);
		$googleSettingObj->setString("value", $google_analytics_sitemgr);
		$googleSettingObj->Save();

		$message_googleanalytics = system_showText(LANG_SITEMGR_GOOGLEANALYTICS_SETTINGSSUCCESSCHANGED);
		$message_style = "successMessage";
	}

	# ----------------------------------------------------------------------------------------------------
	# DEFINES
	# ----------------------------------------------------------------------------------------------------	
	$googleSettingObj = new GoogleSettings(GOOGLE_ANALYTICS_SETTING);	
	$google_analytics_account = $googleSettingObj->getString("value");

	$googleSettingObj = new GoogleSettings(GOOGLE_ANALYTICS_FRONT_SETTING);
	$google_analytics_front = $googleSettingObj->getString("value");

	$googleSettingObj = new GoogleSettings(GOOGLE_ANALYTICS_MEMBERS_SETTING);
	$google_analytics_members = $googleSettingObj->getString("value");

	$googleSettingObj = new GoogleSettings(GOOGLE_ANALYTICS_SITEMGR_SETTING);
	$google_analytics_sitemgr = $googleSettingObj->getString("value");

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
			<h1><?=string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_GOOGLESETTINGS))?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_googleprefs_submenu.php"); ?>
			
			<div class="tip-base">
				<h1><?=string_ucwords(system_showText(LANG_SITEMGR_TIP))?>:</h1>
				<p><a href="http://www.google.com/analytics/" target="_blank"><?=system_showText(LANG_SITEMGR_GOOGLEANALYTICS_TIP1)?></a></p>
			</div>

			<br />

			<form name="googleprefs" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				<? include(INCLUDES_DIR."/forms/form_google_analytics.php"); ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="googleanalytics" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
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
