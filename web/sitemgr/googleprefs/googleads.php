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
	# * FILE: /sitemgr/googleprefs/googleads.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATING FEATURES
	# ----------------------------------------------------------------------------------------------------
	if (GOOGLE_ADS_ENABLED != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	extract($_POST);
	extract($_GET);	

	//increases frequently actions
	if (!isset($google_ad_client)) system_setFreqActions('prefs_googleads','GOOGLE_ADS_ENABLED');

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	
	// Default CSS class for message
	$message_style = "errorMessage";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		$googleSettingObj = new GoogleSettings(GOOGLE_ADS_SETTING);
		$google_ad_client = $googleSettingObj->formatValue($google_ad_client);
		$googleSettingObj->setString("value", $google_ad_client);
		$googleSettingObj->Save();

		$googleSettingObj_Channel = new GoogleSettings(GOOGLE_ADS_CHANNEL_SETTING);
		$google_ad_channel = $googleSettingObj_Channel->formatValue($google_ad_channel);
		$googleSettingObj_Channel->setString("value", $google_ad_channel);
		$googleSettingObj_Channel->Save();

		$googleSettingObj_Status = new GoogleSettings(GOOGLE_ADS_STATUS);
		$google_ad_status = $googleSettingObj->formatValue($google_ad_status);
		$googleSettingObj_Status->setString("value", $google_ad_status);
		$googleSettingObj_Status->Save();
		
		$googleSettingObj_Type = new GoogleSettings(GOOGLE_ADS_TYPE);
		$google_ad_type = $googleSettingObj->formatValue($google_ad_type);
		$googleSettingObj_Type->setString("value", $google_ad_type);
		$googleSettingObj_Type->Save();

		$message_googleads = system_showText(LANG_SITEMGR_GOOGLEADS_SETTINGSSUCCESSCHANGED);
		$message_style = "successMessage";
	}

	# ----------------------------------------------------------------------------------------------------
	# DEFINES
	# ----------------------------------------------------------------------------------------------------	
	$googleSettingObj = new GoogleSettings(GOOGLE_ADS_SETTING);	
	$google_ad_client = $googleSettingObj->getString("value");

	$googleSettingObj_Channel = new GoogleSettings(GOOGLE_ADS_CHANNEL_SETTING);	
	$google_ad_channel = $googleSettingObj_Channel->getString("value");

	$googleSettingObj_Status = new GoogleSettings(GOOGLE_ADS_STATUS);	
	$google_ad_status = $googleSettingObj_Status->getString("value");
	
	$googleSettingObj_Type = new GoogleSettings(GOOGLE_ADS_TYPE);	
	$google_ad_type = $googleSettingObj_Type->getString("value");
    
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
				<p><a href="http://www.google.com/adsense/" target="_blank"><?=system_showText(LANG_SITEMGR_GOOGLEADS_TIP1)?></a></p>
			</div>

			<br />

			<form name="googleprefs" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				<? include(INCLUDES_DIR."/forms/form_google_ads.php"); ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="googleads" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
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
