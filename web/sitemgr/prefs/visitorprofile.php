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
	# * FILE: /sitemgr/prefs/visitorprofile.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # VALIDATE FEATURE
    # ----------------------------------------------------------------------------------------------------
    
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

	// set cookie frequently actions
	if (!isset($status)) system_setFreqActions('prefs_socialnetwork','prefssn');
    
	// Default CSS class for message
	$message_style = "successMessage";

	if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["settings"]) {
		$socialObj = new SettingSocialNetwork('',SELECTED_DOMAIN_ID);
		$socialObj->setSectionSettings($_POST, $_POST["domain_id"]);
	} else if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["turn"]) {

		if (SOCIALNETWORK_FEATURE == "on") {
			$snStatus = "off";
		} else {
			$snStatus = "on";
		}

		if (!is_dir(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/socialnetwork")) {
			mkdir(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/socialnetwork");
		}

		$file = EDIRECTORY_ROOT."/custom/domain_".$_POST["domain_id"]."/socialnetwork/socialnetwork.inc.php";
		$file = fopen($file, 'w+');

		$buffer = "<?".PHP_EOL;
		$buffer .= "	define(\"SOCIALNETWORK_FEATURE\", \"".$snStatus."\");".PHP_EOL;
		$buffer .= "?>".PHP_EOL;

		fwrite($file, $buffer, strlen($buffer));
		fclose($file);

		$sql = " UPDATE `Setting_Social_Network` SET `value` = 'no'";
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID($_POST["domain_id"],$dbMain);
		$dbObj->query($sql);

		header("Location: ".DEFAULT_URL."/sitemgr/prefs/visitorprofile.php?s=".$snStatus);
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

	$socialObj = new SettingSocialNetwork('',SELECTED_DOMAIN_ID);
?>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=ucfirst(system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS))?> - <?=string_ucwords(system_showText(LANG_SITEMGR_SOCIALNETWORK))?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<br />

			<div class="header-form"><?=system_showText(LANG_SITEMGR_SN_MSG_CONFIGURE);?></div>
			<? if ($_GET["s"]) { ?>
				<p class="successMessage">
					<?=system_showText(LANG_SITEMGR_SETTINGS_YOURSETTINGSWERECHANGED);?>
				</p>
			<? } ?>
			<p class="informationMessage">
				<?=system_showText(LANG_SITEMGR_SN_MSG_DISABLE);?>
			</p>
			<form name="sn_disable" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				<input type="hidden" name="turn" value="turn" />
				<input type="hidden" name="domain_id" value="<?=SELECTED_DOMAIN_ID?>" />
				<? if (SOCIALNETWORK_FEATURE == "on") { ?>
					<button type="submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_MAINTENANCETURNOFF)?></button>
				<? } else { ?>
					<button type="submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_MAINTENANCETURNON)?></button>
				<? } ?>
			</form>

			<? if (SOCIALNETWORK_FEATURE == "on") { ?>
				<div class="header-form"><?=system_showText(LANG_SITEMGR_SN_MSG_CHANGE_SOCIAL_SETTINGS);?></div>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_SN_TIP);?>
				</p>

				<form name="social_network" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" class="default-form">
					<input type="hidden" name="settings" value="settings" />
					<? include(EDIRECTORY_ROOT."/includes/forms/form_socialnetwork.php"); ?>
					<input type="hidden" name="domain_id" value="<?=SELECTED_DOMAIN_ID?>" />
					<button type="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
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