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
	# * FILE: /sitemgr/googleprefs/googlemaps.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATING FEATURES
	# ----------------------------------------------------------------------------------------------------
	if (GOOGLE_MAPS_ENABLED != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	extract($_POST);
	extract($_GET);	

	//increases frequently actions
	if (!isset($google_maps_status)) system_setFreqActions('prefs_googlemaps','GOOGLE_MAPS_ENABLED');
    
    $googleStatus = new GoogleSettings(GOOGLE_MAPS_STATUS);

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	
	// Default CSS class for message
	$message_style = "errorMessage";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$googleSettingObj = new GoogleSettings(GOOGLE_MAPS_SETTING);
        $google_maps_key  = $googleSettingObj->formatValue($google_maps_key);
        $googleSettingObj->setString("value", $google_maps_key);
		$googleSettingObj->Save();
        $googleStatus->setString("value", $google_maps_status);
        $googleStatus->Save();
		$message_googlemaps = system_showText(LANG_SITEMGR_GOOGLEMAPS_SETTINGSSUCCESSCHANGED);
		$message_style = "successMessage";
	}

	# ----------------------------------------------------------------------------------------------------
	# DEFINES
	# ----------------------------------------------------------------------------------------------------
	$googleSettingObj = new GoogleSettings(GOOGLE_MAPS_SETTING);
    $google_maps_key = $googleSettingObj->getString("value");

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
					
			<form name="googleprefs" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">	
                
                <div class="tip-base tip-base-googleprefs">
					<h1><?=system_showText(LANG_SITEMGR_GOOGLEMAPS_TIP)?></h1>
                    <p><?=system_showText(LANG_SITEMGR_GOOGLEMAPS_TIP1)?></p>
					<p><a href="https://code.google.com/apis/console/" target="_blank"><?=system_showText(LANG_SITEMGR_GOOGLEMAPS_TIP2)?></a></p>
                    <br />
                    <p><a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/faq/faq.php?keyword=maps"?>" target="_blank"><?=system_showText(LANG_SITEMGR_GOOGLEMAPS_TIP3)?></a></p></p>
				</div>
                
				<? include(INCLUDES_DIR."/forms/form_google_maps.php"); ?>
                
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="googlemaps" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
						</td>
					</tr>
				</table>
			</form>

		</div>

	</div>

	<div id="bottom-content">

	</div>

</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
