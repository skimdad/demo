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
	# * FILE: /sitemgr/import/stop.php
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
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	if (!$import_type){
		$import_type = "listing";
	}
	
	if ($id) {
		$import = new ImportLog($id);
		if ($import->getString("status") != "R" || $import->getString("action") == "NR") {
			header("Location: ".DEFAULT_URL."/sitemgr/import/importlog.php?import_type=".$import_type);
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/sitemgr/import/importlog.php?import_type=".$import_type);
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

		$import = new ImportLog($id);
		$import->setString("status", "W");
		$import->setString("type", $import_type);
		$import->save();
		
		if ($import_type == "listing"){
			$tableCron = "Control_Import_Listing";
		} elseif ($import_type == "event"){
			$tableCron = "Control_Import_Event";
		} else {
			$tableCron = "Control_Import_Listing";
		}

		$sqlLog = "SELECT COUNT(id) AS total FROM `ImportLog` WHERE `status` = 'P' AND type = '".$import_type."'";
		$resLog = $db->Query($sqlLog);
		$rowLog = mysql_fetch_assoc($resLog);
		if ($rowLog["total"] > 0) {
			$sqlCron = "UPDATE `$tableCron` SET `scheduled` = 'Y', `running` = 'N' WHERE `domain_id` = ".SELECTED_DOMAIN_ID;
		} else {
			$sqlCron = "UPDATE `$tableCron` SET `scheduled` = 'N', `running` = 'N' WHERE `domain_id` = ".SELECTED_DOMAIN_ID;
		}
		$dbMain->Query($sqlCron);

		$import->setHistory("LANG_SITEMGR_IMPORT_PROCESSWATINGTOSTOP");
		header("Location: ".DEFAULT_URL."/sitemgr/import/importlog.php?import_type=".$import_type);
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

?>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=string_ucwords(LANG_SITEMGR_NAVBAR_DATA_MANAGEMENT);?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include (INCLUDES_DIR."/tables/table_data_submenu.php"); ?>

			<div class="header-form"><?=system_showText(LANG_SITEMGR_IMPORT_STOPIMPORTPROCESS)?> - <?=$import->getString("filename")?></div>
			
			<div class="baseForm">

			<form name="stopimport" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				<input type="hidden" name="id" value="<?=$id?>" />
				<input type="hidden" name="import_type" value="<?=$import_type?>" />
				
				<br />
				<p><?=system_showText(LANG_SITEMGR_IMPORT_STOPIMPORT_MSG)?></p>
				<p class="informationMessage"><?=system_showText(LANG_SITEMGR_IMPORT_STOPIMPORT_QUESTION)?></p>
				<button type="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
				<button type="button" value="Cancel" class="input-button-form" onclick="document.getElementById('formimportstopcancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
			</form>
			<form id="formimportstopcancel" action="<?=DEFAULT_URL?>/sitemgr/import/importlog.php?import_type=<?=$import_type?>" method="post">
			</form>
			
			</div>

		</div>

	</div>

	<div id="bottom-content">&nbsp;</div>

</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
