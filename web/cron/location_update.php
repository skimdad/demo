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
	# * FILE: /cron/location_update.php
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
	include_once(EDIRECTORY_ROOT."/conf/constants.inc.php");
	include_once(EDIRECTORY_ROOT."/conf/location.inc.php");

	include_once(EDIRECTORY_ROOT."/classes/class_ConnectionPool.php");
	include_once(EDIRECTORY_ROOT."/classes/class_Mysql.php");
	include_once(EDIRECTORY_ROOT."/classes/class_Handle.php");
	include_once(EDIRECTORY_ROOT."/classes/class_Setting.php");

	include_once(EDIRECTORY_ROOT."/functions/string_funct.php");
	include_once(EDIRECTORY_ROOT."/functions/setting_funct.php");
	include_once(EDIRECTORY_ROOT."/functions/db_funct.php");

	$edir_all_locations = explode(",", EDIR_ALL_LOCATIONS);

	////////////////////////////////////////////////////////////////////////////////////////////////////
	function getmicrotime() {
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}
	$time_start = getmicrotime();
	////////////////////////////////////////////////////////////////////////////////////////////////////


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
	mysql_select_db($db, $link);
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$sqlDomain = "	SELECT
						D.`id`, D.`database_host`, D.`database_port`, D.`database_username`, D.`database_password`, D.`database_name`, D.`url`
					FROM `Domain` AS D
					LEFT JOIN `Control_Cron` AS CC ON (CC.`domain_id` = D.`id`)
					WHERE CC.`running` = 'N'
					AND CC.`type` = 'location_update'
					AND D.`status` = 'A'
					AND ADDDATE(CC.`last_run_date`, INTERVAL 5 MINUTE) <= NOW()
					ORDER BY
						IF (CC.`last_run_date` IS NULL, 0, 1),
						CC.`last_run_date`,
						D.`id`
					LIMIT 1";

	$resDomain = mysql_query($sqlDomain, $link);

	if (mysql_num_rows($resDomain) > 0) {
		$rowDomain = mysql_fetch_assoc($resDomain);
		define("SELECTED_DOMAIN_ID", $rowDomain["id"]);

		$sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'Y', `last_run_date` = NOW() WHERE `domain_id` = ".SELECTED_DOMAIN_ID." AND `type` = 'location_update'";
		mysql_query($sqlUpdate, $link);

	////////////////////////////////////////////////////////////////////////////////////////////////////
		$domainHost = $rowDomain["database_host"].($rowDomain["database_port"]? ":".$rowDomain["database_port"]: "");
		$domainUser = $rowDomain["database_username"];
		$domainPass = $rowDomain["database_password"];
		$domainDBName = $rowDomain["database_name"];
		$domainURL = $rowDomain["url"];

		$linkDomain = mysql_connect($domainHost, $domainUser, $domainPass, true);
		mysql_query("SET NAMES 'utf8'", $linkDomain);
		mysql_query('SET character_set_connection=utf8', $linkDomain);
		mysql_query('SET character_set_client=utf8', $linkDomain);
		mysql_query('SET character_set_results=utf8', $linkDomain);
		mysql_select_db($domainDBName, $linkDomain);


		$sqlChange = "SELECT a.id, a.location_id, a.location_level, a.parent_old_id,
			                 a.parent_new_id, a.parent_level,
							 ifnull(a1.name,         ifnull(a2.name,         ifnull(a3.name,         ifnull(a4.name, a5.name)))) location_title,
							 ifnull(a1.abbreviation, ifnull(a2.abbreviation, ifnull(a3.abbreviation, ifnull(a4.abbreviation, a5.abbreviation)))) location_abbreviation,
							 ifnull(a1.friendly_url, ifnull(a2.friendly_url, ifnull(a3.friendly_url, ifnull(a4.friendly_url, a5.friendly_url)))) location_friendly_url
						FROM LocationChangeLOG a
						 LEFT JOIN Location_1 a1 on (a.location_id = a1.id AND a.location_level = 1)
						 LEFT JOIN Location_2 a2 on (a.location_id = a2.id AND a.location_level = 2)
						 LEFT JOIN Location_3 a3 on (a.location_id = a3.id AND a.location_level = 3)
						 LEFT JOIN Location_4 a4 on (a.location_id = a4.id AND a.location_level = 4)
						 LEFT JOIN Location_5 a5 on (a.location_id = a5.id AND a.location_level = 5)
					   WHERE a.modules_updated like 'n' and domain_id = ".SELECTED_DOMAIN_ID;

		$resChange = mysql_query($sqlChange, $link);

		$module_tables = array('Classified', 'Event', 'Listing', 'Listing_Summary');

		$array_task_finished = array();
		while ($rowChange = mysql_fetch_assoc($resChange)) {

			extract($rowChange);
			$location_title = db_formatString($location_title);
			$location_abbreviation = db_formatString($location_abbreviation);
			$location_friendly_url = db_formatString($location_friendly_url);

			foreach ($module_tables as $table) {

				// updating text elements from Listing_Summary -----------------
				if ($table == 'Listing_Summary') {
					$sqlUpdateLS = "update {$table}
										   set location_{$location_level}_title = {$location_title},
										       location_{$location_level}_abbreviation = {$location_abbreviation},
										       location_{$location_level}_friendly_url = {$location_friendly_url}
										 where location_{$location_level} = {$location_id} ";
					$parent_level ? $sqlUpdateLS .= "and location_{$parent_level} = {$parent_old_id}" : $sqlUpdateLS .= "";

					mysql_query($sqlUpdateLS, $linkDomain);

					if ($parent_level && $parent_new_id){
						$sqlUpdateLS = "SELECT name,abbreviation,friendly_url FROM Location_".$parent_level." WHERE id = ".$parent_new_id;

						$rowChange = mysql_fetch_assoc(mysql_query($sqlUpdateLS, $link));
						$sqlUpdateLS = "update {$table}
										   set location_{$parent_level}_title = '{$rowChange["name"]}',
										       location_{$parent_level}_abbreviation = '{$rowChange["abbreviation"]}',
										       location_{$parent_level}_friendly_url = '{$rowChange["friendly_url"]}'
										 where location_{$location_level} = {$location_id} and location_{$parent_level} = {$parent_old_id}";

						mysql_query($sqlUpdateLS, $linkDomain);
					}
				}
				// -------------------------------------------------------------

				// updating fulltextsearch_where fields (pt. 1/2) --------------
				$sqlList = "select id from {$table}
									 where location_{$location_level} = {$location_id} ";
				$parent_level ? $sqlList .= "and location_{$parent_level} = {$parent_old_id}" : $sqlList .= "";

				$resList = mysql_query($sqlList, $linkDomain);
				while ($rowList = mysql_fetch_assoc($resList)) {

					//todo: handle unique indexes insert errors
					$sql = "insert ignore into LocationFulltextwhereList (item_table, item_id, domain_id) values ('{$table}', {$rowList['id']}, ".SELECTED_DOMAIN_ID.")";
					mysql_query($sql, $link);
				}
				// -------------------------------------------------------------

				// updating location ids ---------------------------------------
				if ($parent_level){
					$sqlUpdateModule = "update {$table} set location_{$parent_level} = {$parent_new_id}
										 where location_{$location_level} = {$location_id} and location_{$parent_level} = {$parent_old_id}";
					mysql_query($sqlUpdateModule, $linkDomain);
				}
				// -------------------------------------------------------------

			}

			$array_task_finished[] = $id;
		}


		// updating fulltextsearch_where fields (pt. 2/2) ----------------------
		foreach ($module_tables as $table) {

			//todo: consider limit for performance / scalability purposes
			$sqlRebuild = "select item_table, item_id, domain_id from LocationFulltextwhereList where item_table like '{$table}' and domain_id = ".SELECTED_DOMAIN_ID;
			$resRebuild = mysql_query($sqlRebuild, $link);

			if (mysql_num_rows($resRebuild) > 0) {

				while ($rowBuild = mysql_fetch_assoc($resRebuild)) {
					$item_id = $rowBuild['item_id'];

					$sql = "select address, zip_code, location_1, location_2, location_3, location_4, location_5 from {$table} where id = {$item_id}";
					$res = mysql_query($sql, $linkDomain);
					$row = mysql_fetch_assoc($res);

					$fulltextsearch_where = array();
					if ($row['address']) $fulltextsearch_where[] = $row['address'];
					if ($row['zip_code']) $fulltextsearch_where[] = $row['zip_code'];

					foreach($edir_all_locations as $level) {
						if ($row['location_'.$level]) {
							$location_id = $row['location_'.$level];

							$sqlLoc = "select name, abbreviation from Location_{$level} where id = {$location_id}";
							$resLoc = mysql_query($sqlLoc, $link);
							$rowLoc = mysql_fetch_assoc($resLoc);

							if ($rowLoc['name']) $fulltextsearch_where[] = $rowLoc['name'];
							if ($rowLoc['abbreviation']) $fulltextsearch_where[] = $rowLoc['abbreviation'];
						}
					}

					$fulltextsearch_where = db_formatString(implode(' ', $fulltextsearch_where));
					$sql = "update {$table} set fulltextsearch_where = {$fulltextsearch_where} where id = {$item_id}";
					$res = mysql_query($sql, $linkDomain);

					$sql = "delete from LocationFulltextwhereList where item_table like '{$table}' and item_id = {$item_id} and domain_id = ".SELECTED_DOMAIN_ID;
					mysql_query($sql, $link);

				}
			}
		}
		// ---------------------------------------------------------------------

		// updating LocationChangeLOG status
		if ((is_array($array_task_finished)) and (count($array_task_finished) > 0)) {
			foreach ($array_task_finished as $task_id) {
				$sqlFinishTask = "update LocationChangeLOG set modules_updated = 'y' where id = {$task_id} and domain_id = ".SELECTED_DOMAIN_ID;
				mysql_query($sqlFinishTask, $link);
			}
		}


	////////////////////////////////////////////////////////////////////////////////////////////////////
	} else {
		exit;
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////



	$sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'N', last_run_date = NOW() WHERE `domain_id` = ".SELECTED_DOMAIN_ID." AND `type` = 'location_update'";
	mysql_query($sqlUpdate, $link);

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$time_end = getmicrotime();
	$time = $time_end - $time_start;
	print "Location update on Domain ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")." - ".round($time, 2)." seconds.\n";
	if (!setting_set("last_datetime_location_update", date("Y-m-d H:i:s"))) {
		if (!setting_new("last_datetime_location_update", date("Y-m-d H:i:s"))) {
			print "last_datetime_location_update error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////
?>