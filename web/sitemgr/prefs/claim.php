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
	# * FILE: /sitemgr/prefs/claim.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLAIM_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);	

	//increases frequently actions
	if (!isset($claim_approve)) system_setFreqActions('prefs_claim','CLAIM_FEATURE');

	if (!$clang) $clang = EDIR_DEFAULT_LANGUAGE;
	
	// Default CSS class for message
	$message_style = "successMessage";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($claim_options) {
			if(!setting_set("claim_approve", $claim_approve)) {
				if(!setting_new("claim_approve", $claim_approve)) {
					$error = true;
				}
			}
			if(!setting_set("claim_deny", $claim_deny)) {
				if(!setting_new("claim_deny", $claim_deny)) {
					$error = true;
				}
			}
			if(!setting_set("claim_approveemail", $claim_approveemail)) {
				if(!setting_new("claim_approveemail", $claim_approveemail)) {
					$error = true;
				}
			}
			if(!setting_set("claim_denyemail", $claim_denyemail)) {
				if(!setting_new("claim_denyemail", $claim_denyemail)) {
					$error = true;
				}
			}
			
			//if (trim($claim_textlink) == "") $claim_textlink = "Is this your ".LISTING_FEATURE_NAME."?";
			if (trim($claim_textlink) == "") $claim_textlink = "Claim";
			
			if(!customtext_set("claim_textlink", $claim_textlink, $clang)) {
				if(!customtext_new("claim_textlink", $claim_textlink, $clang)) {
					$error = true;
				}
			}
			
			if (!$error) {
				$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_CLAIM_CONFIGURATIONWASCHANGED);
			} else {
				$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
				$message_style = "errorMessage";
			}
			if($actions) {
				$message_claim_options .= implode("<br />", $actions);
			}
		}
	}
	
	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	setting_get("claim_approve", $claim_approve);
	if ($claim_approve) $claim_approve_checked = "checked";
	setting_get("claim_deny", $claim_deny);
	if ($claim_deny) $claim_deny_checked = "checked";
	setting_get("claim_approveemail", $claim_approveemail);
	if ($claim_approveemail) $claim_approveemail_checked = "checked";
	setting_get("claim_denyemail", $claim_denyemail);
	if ($claim_denyemail) $claim_denyemail_checked = "checked";
	customtext_get("claim_textlink", $claim_textlink, $clang);

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

<script language="javascript">
function changeComboLang (value) {
	if (value)
		window.location.href = "claim.php?clang="+value;
	return true;
}
</script>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=string_ucwords(system_showText(LANG_SITEMGR_CLAIM_CLAIMS))?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<form name="claim_options" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				<? include(INCLUDES_DIR."/forms/form_claim_options.php"); ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="claim_options" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
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
