#!/usr/bin/php -q
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
	# * FILE: /cron/export_events.php
	# ----------------------------------------------------------------------------------------------------

	////////////////////////////////////////////////////////////////////////////////////////////////////
	ini_set("html_errors", FALSE);
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$path = "";
	$full_name = "";
	$file_name = "";
	$full_name = $_SERVER["SCRIPT_FILENAME"];
	if (strlen($full_name) > 0) {
		$osslash = ((strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') ? '\\' : '/');
		$file_pos = strpos($full_name, $osslash."cron".$osslash);
		if ($file_pos !== false) {
			$file_name = substr($full_name, $file_pos);
		}
		$path = substr($full_name, 0, (strlen($file_name)*(-1)));
	}
	if (strlen($path) == 0) $path = "..";
	define("EDIRECTORY_ROOT", $path);
	define("BIN_PATH", EDIRECTORY_ROOT."/bin");
	////////////////////////////////////////////////////////////////////////////////////////////////////
	
	////////////////////////////////////////////////////////////////////////////////////////////////////
	$_inCron = true; 
	include_once(EDIRECTORY_ROOT."/conf/config.inc.php");


	////////////////////////////////////////////////////////////////////////////////////////////////////
	$host = _DIRECTORYDB_HOST;
	$db   = _DIRECTORYDB_NAME;
	$user = _DIRECTORYDB_USER;
	$pass = _DIRECTORYDB_PASS;
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$link = mysql_connect($host, $user, $pass);
	mysql_query("SET NAMES 'utf8'", $link);
	mysql_query('SET character_set_connection=utf8', $link);
	mysql_query('SET character_set_client=utf8', $link);
	mysql_query('SET character_set_results=utf8', $link);
	mysql_select_db($db);
	////////////////////////////////////////////////////////////////////////////////////////////////////

	$sql_check_export = "SELECT
							D.`database_host`, D.`database_port`, D.`database_username`, D.`database_password`, D.`database_name`, CEL.`id`, CEL.`type`, CEL.`filename`, CEL.`domain_id`, CEL.`block`, CEL.`total_event_exported`
						FROM `Domain` AS D
						LEFT JOIN `Control_Export_Event` AS CEL ON (CEL.`domain_id` = D.`id`)
						WHERE CEL.`scheduled` = 'Y'
						AND D.`status` = 'A'
						ORDER BY
							IF (CEL.`last_run_date` IS NULL, 0, 1),
							CEL.`last_run_date`,
							D.`id`
						LIMIT 1";

	$result_check_export = mysql_query($sql_check_export, $link);
	if (mysql_num_rows($result_check_export)){
		$row = mysql_fetch_array($result_check_export);
		$type = $row["type"];
		$filename = $row["filename"];
		$domain_id = $row["domain_id"];
		
		$db_host = $row["database_host"].($row["database_port"]? $row["database_port"]: "");
		$db_username = $row["database_username"];
		$db_password = $row["database_password"];
		$db_name = $row["database_name"];
		
		$linkDomain = mysql_connect($db_host, $db_username, $db_password);
		mysql_query("SET NAMES 'utf8'", $linkDomain);
		mysql_query('SET character_set_connection=utf8', $linkDomain);
		mysql_query('SET character_set_client=utf8', $linkDomain);
		mysql_query('SET character_set_results=utf8', $linkDomain);
		mysql_select_db($db_name);
		
		$limit = $row["block"];
		$start = $row["total_event_exported"];
		$end = $limit;

		$exportFilePath = EDIRECTORY_ROOT."/custom/domain_$domain_id/export_files";
		
		$files = glob($exportFilePath."/export_*.progress");
		if ($files[0] && is_array($files)) {
			foreach ($files as $file) {
				if (strrpos($file, "export_".str_replace(".zip", ".progress", $filename)) === false) {
					@unlink($file);
				}
			}
		}
		
		define("SELECTED_DOMAIN_ID", $domain_id);
	} else {
		exit;
	}

	$_inCron = false;
	include_once(EDIRECTORY_ROOT."/conf/loadconfig.inc.php");
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	function getmicrotime() {
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}
	$time_start = getmicrotime();
	////////////////////////////////////////////////////////////////////////////////////////////////////

	if ($type == "csv") { //working only for csv (import format) export
		export_ExportToCSV("event", false, false, $domain_id);
	}

	$time_end = getmicrotime();
	$time = $time_end - $time_start;
	print "Export Events on Domain ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")." - ".round($time, 2)." seconds.\n";
?>