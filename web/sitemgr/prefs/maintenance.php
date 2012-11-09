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
	extract($_POST);
	extract($_GET);	

	//increases frequently actions
	if (!isset($maintenance_mode)) system_setFreqActions('prefs_maintenancemode','prefsmaintenance');

	$message_style = "successMessage";

	if (($_SERVER['REQUEST_METHOD'] == "POST") && (!DEMO_LIVE_MODE)) {
		if($maintenance_mode == 'on') $maintenance_mode = 'off';
		else $maintenance_mode = 'on';
		if (!setting_set("maintenance_mode", $maintenance_mode))
			if (!setting_new("maintenance_mode", $maintenance_mode))
				$error = true;

		if (!$error) {
			$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_YOURSETTINGSWERECHANGED);
		} else {
			$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
			$message_style = "errorMessage";
		}
		
		if ($actions) {
			$message_maintenanceMode .= implode("<br />", $actions);
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
	setting_get("maintenance_mode", $maintenance_mode);
	if($maintenance_mode == 'on') $turnButton = LANG_SITEMGR_MAINTENANCETURNOFF;
	else $turnButton = LANG_SITEMGR_MAINTENANCETURNON;

?>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=system_showText(LANG_SITEMGR_SETTING_MAINTENANCE)?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>		

			<br />

			<? if (DEMO_LIVE_MODE) { ?>
				<p class="informationMessage"><?=system_showText(LANG_SITEMGR_MAINTENANCE_DEMO_MESSAGE);?></p>
			<? } else { ?>
				<form name="maintenancemode" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
					<? include(INCLUDES_DIR."/forms/form_maintenance.php"); ?>
					<table style="margin: 0 auto 0 auto;">
						<tr>
							<td>
								<button type="submit" name="maintenancemode" value="Submit" class="input-button-form"><?=system_showText($turnButton)?></button>
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
