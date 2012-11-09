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
	# * FILE: /sitemgr/import/rollback.php
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
		if ((($import->getString("status") != "F") && ($import->getString("status") != "S")) || ($import->getString("action") == "NR")) {
			header("Location: ".DEFAULT_URL."/sitemgr/import/importlog.php?import_type=".$import_type);
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/sitemgr/import/importlog.php?import_type=".$import_type);
		exit;
	}
	$rollback = false;
	$needCron = false;

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if (($_SERVER["REQUEST_METHOD"] == "POST") && $confirmrollback && $id) {

		if ($import_type == "listing"){
			$scalability = LISTING_SCALABILITY_OPTIMIZATION;
		} elseif ($import_type == "event"){
			$scalability = EVENT_SCALABILITY_OPTIMIZATION;
		} else {
			$scalability = LISTING_SCALABILITY_OPTIMIZATION;
		}
        //CR 78240 
		$scalability = "on";
		if ($scalability == "on"){
			
			$import = new ImportLog($id);
			$import->setString("action", "NR");
			$import->setString("type", $import_type);
			$import->save();
			$rollback = true;
			$needCron = true;
			
		} else {

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			$import = new ImportLog($id);
			$import->setString("status", "C");
			$import->setString("type", $import_type);
			$import->save();
			
			if ($import_type == "listing"){
				$table = "Listing";
				$tableCron = "Control_Import_Listing";
			} elseif ($import_type == "event"){
				$table = "Event";
				$tableCron = "Control_Import_Event";
			} else {
				$table = "Listing";
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

			$import->setHistory("LANG_SITEMGR_IMPORT_PROCCESSCANCELLED");
			$num_itens = 0;
			$sql = "SELECT id FROM `$table` WHERE importID = ".db_formatNumber($import->getNumber("id"));
			$result = $db->query($sql);
			if ($result) {
				while ($row = mysql_fetch_assoc($result)) {
					$itemObj = new $table($row["id"]);
					if ($itemObj->getNumber("id") > 0) {
						$itemObj->Delete(SELECTED_DOMAIN_ID, false);
						$num_itens++;
					}
				}
			}

			if ($import_type == "listing"){
				system_countActiveListingByCategory();
				$field = "importID";
				$field2 = "domain_importID";
			} elseif ($import_type == "event"){
				system_countActiveItemByCategory("event");
				$field = "importID_event";
				$field2 = "domain_importID_event";
			} else {
				system_countActiveListingByCategory();
				$field = "importID";
				$field2 = "domain_importID";
			}
			
			$import->setHistory($num_itens."[".(($num_itens!=1)? "LANG_MSG_IMPORT_ITEM_ROLLEDBACK_PLURAL" : "LANG_MSG_IMPORT_ITEM_ROLLEDBACK")."].");
			$num_accounts = 0;
			$sql = "SELECT id FROM Account WHERE $field = ".db_formatNumber($import->getNumber("id"))." AND $field2 = ".db_formatNumber(SELECTED_DOMAIN_ID);
			$result = $dbMain->query($sql);
			if ($result) {
				while ($row = mysql_fetch_assoc($result)) {
					$accountObj = new Account($row["id"]);
					if ($accountObj->getNumber("id") > 0) {
						$accountObj->Delete();
						$num_accounts++;
					}
				}
			}
			$import->setHistory($num_accounts."[".(($num_accounts!=1)? "LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK_PLURAL" : "LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK")."].");
			$import->setHistory("LANG_SITEMGR_IMPORT_ROLLBACKDONE");
			$rollback = true;
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

			<? if (!$rollback) { ?>

				<div class="header-form">
					<?=system_showText(LANG_SITEMGR_IMPORT_ROLLBACK_MSGSTATUS1_1)?> "<?=$import->getString("filename")?>" <?=system_showText(LANG_SITEMGR_IMPORT_ROLLBACK_MSGSTATUS1_2)?> <?=format_date($import->getString("date"))?> <?=system_showText(LANG_SITEMGR_IMPORT_ROLLBACK_MSGSTATUS1_3)?> <?=(format_getTimeString($import->getNumber("time")))?>
				</div>

				<div class="baseForm">

					<form action="<?=DEFAULT_URL?>/sitemgr/import/rollback.php" method="post">				

						<p class="label">
							<?
							$accounts_imported = $import->getNumber("accounts_added");
							$itens_imported = $import->getNumber("itens_added");
							?>
							<?=system_showText(LANG_SITEMGR_IMPORT_THISIMPORTHASADDED)?> <?=$accounts_imported;?> <?=(($accounts_imported != 1) ? (system_showText(LANG_SITEMGR_ACCOUNT_PLURAL)) : (system_showText(LANG_SITEMGR_ACCOUNT)));?> <?=system_showText(LANG_SITEMGR_AND)?> <?=$itens_imported;?> <?=(($itens_imported != 1) ? (LANG_LABEL_ITEMS) : (LANG_LABEL_ITEM));?>, <?=system_showText(LANG_SITEMGR_IMPORT_ROLLBACK_MSGSTATUS1_4);?>.
						</p>

						<p class="informationMessage">
							<? if (($accounts_imported > 0) || ($itens_imported > 0)) { ?>
								<?=system_showText(LANG_SITEMGR_IMPORT_ROLLBACKQUESTION)?>
							<? } else  {?>
								<?=system_showText(LANG_SITEMGR_IMPORT_ROLLBACK_NORECORD)?>
							<? }?>
						</p>

						<input type="hidden" name="id" value="<?=$id?>" />
						<input type="hidden" name="import_type" value="<?=$import_type?>" />
						<input type="hidden" name="confirmrollback" value="1" />
						<button type="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
						<button type="button" value="Cancel" class="input-button-form" onclick="document.getElementById('formimportrollbakccancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

					</form>
					<form id="formimportrollbakccancel" action="<?=DEFAULT_URL?>/sitemgr/import/importlog.php?import_type=<?=$import_type?>" method="post">
					</form>

				</div>

			<? } else { ?>

				<div class="header-form">
					<?=($needCron ? system_showText(LANG_SITEMGR_IMPORT_ROLLBACK_FINISHMSG1_CRON) : system_showText(LANG_SITEMGR_IMPORT_ROLLBACK_FINISHMSG1))?> "<?=$import->getString("filename")?>" <?=system_showText(LANG_SITEMGR_IMPORT_ROLLBACK_FINISHMSG2)?> <?=format_date($import->getString("date"))?> <?=system_showText(LANG_SITEMGR_IMPORT_ROLLBACK_FINISHMSG3)?> <?=(format_getTimeString($import->getNumber("time")))?>
				</div>
				<p class="successMessage">
					<?
					if ($needCron){
						echo system_showText(LANG_SITEMGR_IMPORT_ROLLBACK_FINISHMSG_CRON);
					} else {
						echo system_showText(LANG_SITEMGR_IMPORT_ROLLBACK_FINISHMSG);
					}
					?>
				</p>
				<div class="baseForm">
					<form action="<?=DEFAULT_URL?>/sitemgr/import/importlog.php?import_type=<?=$import_type?>" method="post">
							<button type="submit" title="back" value="Back" class="input-button-form"><?=system_showText(LANG_SITEMGR_BACK)?></button>
					</form>
				</div>

			<? } ?>

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
