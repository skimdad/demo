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
	# * FILE: /sitemgr/prefs/twilio.php
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
	if ($_SERVER['REQUEST_METHOD'] != "POST") system_setFreqActions('prefs_twilio','prefstwilio');

	$message_style = "successMessage";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		
		if ((($twilio_enabled_sms || $twilio_enabled_call) && $twilio_account_sid && $twilio_auth_token && $twilio_number) || (!$twilio_enabled_sms && !$twilio_enabled_call && !$twilio_account_sid && !$twilio_auth_token && !$twilio_number)) {
			
			if (!setting_set("twilio_enabled_sms", $twilio_enabled_sms))
				if (!setting_new("twilio_enabled_sms", $twilio_enabled_sms))
					$error = true;
				
			if (!setting_set("twilio_enabled_call", $twilio_enabled_call))
				if (!setting_new("twilio_enabled_call", $twilio_enabled_call))
					$error = true;
			
			if (!setting_set("twilio_account_sid", $twilio_account_sid))
				if (!setting_new("twilio_account_sid", $twilio_account_sid))
					$error = true;

			if (!setting_set("twilio_auth_token", $twilio_auth_token))
				if (!setting_new("twilio_auth_token", $twilio_auth_token))
					$error = true;

			if (!setting_set("twilio_number", $twilio_number))
				if (!setting_new("twilio_number", $twilio_number))
					$error = true;
				
			if (!setting_set("twilio_clicktocall_message", $twilio_clicktocall_message))
				if (!setting_new("twilio_clicktocall_message", $twilio_clicktocall_message))
					$error = true;
		} else {
			$error = false;
			
			if ($twilio_account_sid && $twilio_auth_token && $twilio_number) {

				if (!setting_set("twilio_enabled_sms", $twilio_enabled_sms))
				if (!setting_new("twilio_enabled_sms", $twilio_enabled_sms))
					$error = true;
				
				if (!setting_set("twilio_enabled_call", $twilio_enabled_call))
					if (!setting_new("twilio_enabled_call", $twilio_enabled_call))
						$error = true;

				if (!setting_set("twilio_account_sid", $twilio_account_sid))
					if (!setting_new("twilio_account_sid", $twilio_account_sid))
						$error = true;

				if (!setting_set("twilio_auth_token", $twilio_auth_token))
					if (!setting_new("twilio_auth_token", $twilio_auth_token))
						$error = true;

				if (!setting_set("twilio_number", $twilio_number))
					if (!setting_new("twilio_number", $twilio_number))
						$error = true;
					
				if (!setting_set("twilio_clicktocall_message", $twilio_clicktocall_message))
					if (!setting_new("twilio_clicktocall_message", $twilio_clicktocall_message))
						$error = true;
			} else if ((!$twilio_enabled_sms && !$twilio_enabled_call) || !$twilio_account_sid || !$twilio_auth_token || !$twilio_number) {
				$error = true;
			}

		}
		
		if ($twilio_enabled_call && !$twilio_clicktocall_message){
			$error = true;
		}
		
		if (!$error) {
			$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_TWILIO_CONFIGURATIONWASCHANGED);
		} else {
			$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_TWILIO_EMPTYKEYS);
			$message_style = "errorMessage";
		}
		if ($actions) {
			$message_twilio .= implode("<br />", $actions);
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
	
	if (!$twilio_enabled_sms) setting_get("twilio_enabled_sms", $twilio_enabled_sms);
	if (!$twilio_enabled_call) setting_get("twilio_enabled_call", $twilio_enabled_call);
	if (!$twilio_account_sid) setting_get("twilio_account_sid", $twilio_account_sid);
	if (!$twilio_auth_token) setting_get("twilio_auth_token", $twilio_auth_token);
	if (!$twilio_number) setting_get("twilio_number", $twilio_number);
	if (!$twilio_clicktocall_message) setting_get("twilio_clicktocall_message", $twilio_clicktocall_message);
	if ($twilio_enabled_sms) $twilio_checked_sms = "checked";
	if ($twilio_enabled_call) $twilio_checked_call = "checked";

?>

	<div id="main-right">

		<div id="top-content">
			<div id="header-content">
				<h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=system_showText(LANG_SITEMGR_TWILIO)?></h1>
			</div>
		</div>

		<div id="content-content">
			<div class="default-margin">

				<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
				<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
				<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

				<br />

				<form name="twilio" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
					<? include(INCLUDES_DIR."/forms/form_twilio.php"); ?>
					<table style="margin: 0 auto 0 auto;">
						<tr>
							<td>
								<button type="submit" name="twilio" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
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
