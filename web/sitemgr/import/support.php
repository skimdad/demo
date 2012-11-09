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
	# * FILE: /sitemgr/import/support.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# THIS PAGE IS ONLY USED BY THE SUPPORT TEAM TO SET THE CONTROL CRON TABLES WITH DFAULT VALUES
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();

	if (!sess_getSMIdFromSession()){
		header("Location: ".DEFAULT_URL."/sitemgr/");
	} else {
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$sql = "SELECT username FROM SMAccount WHERE id = ".sess_getSMIdFromSession();
		$row = mysql_fetch_assoc($dbMain->query($sql));
		if ($row["username"] != "arcalogin"){
			header("Location: ".DEFAULT_URL."/sitemgr/");
		} 
	}


	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$success = 0;

	if ($_GET["cron"]){

		if ($_GET["cron"] == "import"){
			if ($_GET["scheduled"] == "N"){
				$sql = "UPDATE Control_Import_Listing SET scheduled = 'Y' WHERE domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			} else if ($_GET["scheduled"] == "Y"){
				$sql = "UPDATE Control_Import_Listing SET scheduled = 'N' WHERE domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			}
			if ($_GET["running"] == "N"){
				$sql = "UPDATE Control_Import_Listing SET running = 'Y' WHERE domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			} else if ($_GET["running"] == "Y"){
				$sql = "UPDATE Control_Import_Listing SET running = 'N' WHERE domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			}
		}

		if ($_GET["cron"] == "prepare"){
			if ($_GET["running"] == "N"){
				$sql = "UPDATE Control_Cron SET running = 'Y' WHERE type = 'prepare_import' AND domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			} else if ($_GET["running"] == "Y"){
				$sql = "UPDATE Control_Cron SET running = 'N' WHERE type = 'prepare_import' AND domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			}
		}

		if ($_GET["cron"] == "rollback"){
			if ($_GET["running"] == "N"){
				$sql = "UPDATE Control_Cron SET running = 'Y' WHERE type = 'rollback_import' AND domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			} else if ($_GET["running"] == "Y"){
				$sql = "UPDATE Control_Cron SET running = 'N' WHERE type = 'rollback_import' AND domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			}
		}

		if (!$dbMain->mysql_error) {
			$success = 1;
		} else {
			$success = 2;
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	$sql = "SELECT scheduled, running, last_run_date, last_importlog FROM Control_Import_Listing WHERE domain_id = ".SELECTED_DOMAIN_ID;
	$row = mysql_fetch_assoc($dbMain->query($sql));

	$import_scheduled		= $row["scheduled"];
	$import_running			= $row["running"];
	$import_last_run_date	= $row["last_run_date"];
	$import_last_importlog	= $row["last_importlog"];

	$sql = "SELECT running, last_run_date FROM Control_Cron WHERE type = 'prepare_import' AND domain_id = ".SELECTED_DOMAIN_ID;
	$row = mysql_fetch_assoc($dbMain->query($sql));

	$prepareImport_running			= $row["running"];
	$prepareImport_last_run_date	= $row["last_run_date"];

	$sql = "SELECT running, last_run_date FROM Control_Cron WHERE type = 'rollback_import' AND domain_id = ".SELECTED_DOMAIN_ID;
	$row = mysql_fetch_assoc($dbMain->query($sql));

	$rollbackImport_running			= $row["running"];
	$rollbackImport_last_run_date	= $row["last_run_date"];

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------


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

			<div id="header-export">Control Cron Tables Status</div>
			<? if ($success!=0){?>
				<div id="logMessages">
					<p class=<?=($success == 1? "successMessage" : "errorMessage")?>><?=($success == 1 ? "Cron setting successfully changed!" : "Error trying to change the cron setting, please try again.")?></p>
				</div>
			<?}?>
			
			<br class="clear" />

			<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE" >
				<tr>
					<th width="130px" nowrap="nowrap">Cron</th>
					<th width="130px" nowrap="nowrap">Last Run Date</th>
					<th width="130px" nowrap="nowrap">Scheduled</th>
					<th width="130px" nowrap="nowrap">Running</th>
					<th width="130px" nowrap="nowrap">Last Import ID Done</th>
				</tr>
				<tr>
					<td>
						Import
					</td>
					<td>
						<?
						if ($import_last_run_date != "0000-00-00 00:00:00")
							echo format_date($import_last_run_date, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($import_last_run_date);
						else
							echo "0000-00-00 00:00:00";
						?>
					</td>
					<td>
						<a href="<?=DEFAULT_URL?>/sitemgr/import/support.php?cron=import&scheduled=<?=$import_scheduled?>"><img src="<?=DEFAULT_URL?>/images/<?=$import_scheduled == 'Y' ? 'icon_check.gif' : 'icon_uncheck.gif'?>" border="0" alt="<?=($import_scheduled == 'Y' ? "Scheduled" : "Not Scheduled")?>" title="<?=($import_scheduled == 'Y' ? "Scheduled" : "Not Scheduled")?>" /></a>
					</td>
					<td>
						<a href="<?=DEFAULT_URL?>/sitemgr/import/support.php?cron=import&running=<?=$import_running?>"><img src="<?=DEFAULT_URL?>/images/<?=$import_running == 'Y' ? 'icon_check.gif' : 'icon_uncheck.gif'?>" border="0" alt="<?=($import_running == 'Y' ? "Running" : "Not Running")?>" title="<?=($import_running == 'Y' ? "Running" : "Not Running")?>" /></a>
					</td>
					<td>
						<a href="<?=DEFAULT_URL?>/sitemgr/import/importlog.php?log_id=<?=$import_last_importlog?>"><?=$import_last_importlog;?></a>
					</td>
				</tr>
				<tr>
					<td>
						Prepare Import
					</td>
					<td>
						<?
						if ($prepareImport_last_run_date != "0000-00-00 00:00:00")
							echo format_date($prepareImport_last_run_date, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($prepareImport_last_run_date);
						else
							echo "0000-00-00 00:00:00";
						?>
					</td>
					<td>
						Automatic
					</td>
					<td>
						<a href="<?=DEFAULT_URL?>/sitemgr/import/support.php?cron=prepare&running=<?=$prepareImport_running?>"><img src="<?=DEFAULT_URL?>/images/<?=$prepareImport_running == 'Y' ? 'icon_check.gif' : 'icon_uncheck.gif'?>" border="0" alt="<?=($prepareImport_running == 'Y' ? "Running" : "Not Running")?>" title="<?=($prepareImport_running == 'Y' ? "Running" : "Not Running")?>" /></a>
					</td>
					<td>
						---
					</td>
				</tr>
				<tr>
					<td>
						Roll Back Import
					</td>
					<td>
						<?
						if ($rollbackImport_last_run_date != "0000-00-00 00:00:00")
							echo format_date($rollbackImport_last_run_date, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($rollbackImport_last_run_date);
						else
							echo "0000-00-00 00:00:00";
						?>
					</td>
					<td>
						Automatic
					</td>
					<td>
						<a href="<?=DEFAULT_URL?>/sitemgr/import/support.php?cron=rollback&running=<?=$rollbackImport_running?>"><img src="<?=DEFAULT_URL?>/images/<?=$rollbackImport_running == 'Y' ? 'icon_check.gif' : 'icon_uncheck.gif'?>" border="0" alt="<?=($rollbackImport_running == 'Y' ? "Running" : "Not Running")?>" title="<?=($rollbackImport_running == 'Y' ? "Running" : "Not Running")?>" /></a>
					</td>
					<td>
						---
					</td>
				</tr>
			</table>
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