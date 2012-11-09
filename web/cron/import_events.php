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
	# * FILE: /cron/import_events.php
	# ----------------------------------------------------------------------------------------------------

	////////////////////////////////////////////////////////////////////////////////////////////////////
	define("IMPORT_DEBUG", "off");
	define("IMPORT_TIME_DEBUG", "off");
	define("IMPORT_TIME_EMAIL_DEBUG", "off");
	define("IMPORT_MAX_EVENTS_PERTIME", 100000);
	define("IMPORT_MAX_SECONDS_PERTIME", 60*19);
	////////////////////////////////////////////////////////////////////////////////////////////////////

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

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$sqlDomain = "	SELECT
						D.`id`, D.`database_host`, D.`database_port`, D.`database_username`, D.`database_password`, D.`database_name`, CIL.`last_importlog`
					FROM `Domain` AS D
					LEFT JOIN `Control_Import_Event` AS CIL ON (CIL.`domain_id` = D.`id`)
					LEFT JOIN `Control_Cron` AS CC ON (CC.`domain_id` = D.`id`)
					WHERE CIL.`scheduled` = 'Y'
					AND CIL.`running` = 'N'
					AND CC.`running` = 'N'
					AND CC.`type` = 'prepare_import_events'
					AND D.`status` = 'A'
					ORDER BY
						IF (CIL.`last_run_date` IS NULL, 0, 1),
						CIL.`last_run_date`,
						D.`id`
					LIMIT 1";
	$resDomain = mysql_query($sqlDomain, $link);

	$sqlRunning = "	SELECT `domain_id` FROM `Control_Import_Event` WHERE `running` = 'Y' LIMIT 1";
	$resRunning = mysql_query($sqlRunning, $link);

	if (mysql_num_rows($resDomain) > 0 && mysql_num_rows($resRunning) == 0) {
		$rowDomain = mysql_fetch_assoc($resDomain);
		define("SELECTED_DOMAIN_ID", $rowDomain["id"]);

		$sqlUpdate = "UPDATE `Control_Import_Event` SET `scheduled` = 'N', `running` = 'Y', `last_run_date` = NOW() WHERE `domain_id` = ".$rowDomain["id"];
		mysql_query($sqlUpdate, $link);

		$last_import_log = $rowDomain["last_importlog"];

	////////////////////////////////////////////////////////////////////////////////////////////////////
		$domainHost = $rowDomain["database_host"].($rowDomain["database_port"]? ":".$rowDomain["database_port"]: "");
		$domainUser = $rowDomain["database_username"];
		$domainPass = $rowDomain["database_password"];
		$domainDBName = $rowDomain["database_name"];

		$linkDomain = mysql_connect($domainHost, $domainUser, $domainPass, true);
		mysql_query("SET NAMES 'utf8'", $linkDomain);
		mysql_query('SET character_set_connection=utf8', $linkDomain);
		mysql_query('SET character_set_client=utf8', $linkDomain);
		mysql_query('SET character_set_results=utf8', $linkDomain);
		mysql_select_db($domainDBName);
	////////////////////////////////////////////////////////////////////////////////////////////////////
	} else {
		exit;
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	$_inCron = false;
	include_once(EDIRECTORY_ROOT."/conf/loadconfig.inc.php");
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	define("IMPORTFOLDER", str_replace(EDIRECTORY_ROOT, "", IMPORT_FOLDER));
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$import_process_id = uniqid("import_");
	define("IMPORT_PROCESS_ID", string_strtolower($import_process_id));
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	setting_get("import_from_export_event", $import_from_export);
	setting_get("import_sameaccount_event", $import_sameaccount);
	setting_get("import_account_id_event", $import_account_id);
	setting_get("import_enable_event_active", $import_enable_event_active);
	setting_get("import_defaultlevel_event", $import_defaultlevel);
    setting_get("sitemgr_send_email",$sitemgr_send_email);
	setting_get("sitemgr_email", $sitemgr_email);
    setting_get("sitemgr_import_email", $sitemgr_import_email);
	setting_get("edir_default_language", $edir_default_language);
	setting_get("edir_languages", $edir_languages);
	setting_get("default_url", $default_url);
	setting_get("import_featured_categs_event", $import_featured_categs);
	$edirlanguages = explode(",", $edir_languages);
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	if (!$edir_default_language) $edir_default_language = 'en_us';
	require_once(EDIRECTORY_ROOT.'/lang/'.$edir_default_language.'.php');
	require_once(EDIRECTORY_ROOT.'/lang/'.$edir_default_language.'_sitemgr.php');
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$import_stop = false;
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	function getmicrotime() {
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}
	$time_start = getmicrotime();
	import_logDebug("++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++");
	import_logDebug("Start Date/Time: ".date("Y-m-d H:i:s"));
	////////////////////////////////////////////////////////////////////////////////////////////////////

	$no_data_importtemporarytable = false;
	$sql = "SELECT id FROM ImportTemporary_Event WHERE inserted = 'n' AND import_log_id = ".$last_import_log;
	$result = mysql_query($sql, $linkDomain);
	if (!mysql_num_rows($result)) {
		$no_data_importtemporarytable = true;
		import_logDebug("No data in import temporary table - LINE: ".__LINE__);
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////
	if ($no_data_importtemporarytable) {
		$sql = "SELECT id FROM ImportLog WHERE status = 'P' AND action = 'RI' AND type = 'event' ORDER BY id LIMIT 1";
		$result = mysql_query($sql, $linkDomain);
		if (mysql_num_rows($result) > 0) {
			$row = mysql_fetch_assoc($result);
			$importlog_id = $row["id"];
			$sql = "UPDATE ImportLog SET status = 'R' WHERE id = ".$importlog_id;
			mysql_query($sql, $linkDomain);
			import_logDebug("Changing status - running - LINE: ".__LINE__);
		} else {
			$import_stop = true;
			import_logDebug("No pending process - LINE: ".__LINE__);
		}
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$time_total_location = 0;
	$time_total_category = 0;
	$time_total_account = 0;
	$time_total_event = 0;
	////////////////////////////////////////////////////////////////////////////////////////////////////
	if (!$import_stop) {

		$_locations = explode(",", EDIR_LOCATIONS);

		$sql = "SELECT id, phisicalname, update_itens FROM ImportLog WHERE status = 'R' AND action = 'RI' AND type = 'event' ORDER BY id LIMIT 1";
		$result = mysql_query($sql, $linkDomain);
		if (mysql_num_rows($result) > 0) {
			$row = mysql_fetch_assoc($result);
			$importlog_id = $row["id"];
			$phisicalname = $row["phisicalname"];
			$update_itens = $row["update_itens"];
			$phisicalname = EDIRECTORY_ROOT.IMPORTFOLDER."/preview_".$phisicalname;
			$phisicalname = str_replace(".csv", ".php", $phisicalname);
			$aux_import_ids = "";
			$sql = "SELECT * FROM ImportTemporary_Event WHERE import_log_id = '".$importlog_id."' AND inserted != 'y' ORDER BY id";

			$result = mysql_query($sql, $linkDomain);
			$current_event = 0;
			$current_time = getmicrotime() - $time_start;
			$statusObj = new ItemStatus();
			$allStatus = $statusObj->getValueName();
			$defaultStatus = $statusObj->getDefaultStatus();
			$levelObj = new EventLevel();

			####################################################################################################
			### IMPORT HISTORY
			####################################################################################################
			if ($no_data_importtemporarytable){
				if ($import_enable_event_active) {
					import_setHistory("LANG_SITEMGR_IMPORT_ALLIMPORTEDASACTIVE", $linkDomain, db_formatNumber($importlog_id));
				}

				if ($update_itens == "y"){
					import_setHistory("LANG_SITEMGR_IMPORT_ALLIMPORTEDUPDATED", $linkDomain, db_formatNumber($importlog_id));
				}

				if ($import_featured_categs) {
					import_setHistory("LANG_SITEMGR_IMPORT_FEATURED_CATEGS", $linkDomain, db_formatNumber($importlog_id));
				}
			}

			$message_SameAccount = false;

			if ($no_data_importtemporarytable){
				import_setHistory("LANG_SITEMGR_IMPORT_DEFAULTLEVELSETTO[".$levelObj->showLevel($import_defaultlevel)."].", $linkDomain, db_formatNumber($importlog_id));
			}
			####################################################################################################

			$auxT = 0;

			while (($row = mysql_fetch_assoc($result)) && !$import_stop && ($current_event < IMPORT_MAX_EVENTS_PERTIME) && ($current_time < IMPORT_MAX_SECONDS_PERTIME)) {
				$needToUpdate = false;

				$sqlAux = "SELECT linesadded, totallines, status FROM ImportLog WHERE id = ".$importlog_id." AND status = 'R' AND action = 'RI' AND type = 'event'";
				$resultAux = mysql_query($sqlAux, $linkDomain);
				$rowAux = mysql_fetch_assoc($resultAux);

				$lines_added = $rowAux["linesadded"];
				$totallines = $rowAux["totallines"];
				$status = $rowAux["status"];

				if ($update_itens == "y" && $row["event_id"] && $row["legacy_id"] && $row["event_updated_date"]){
					$sqlUpdate = "SELECT id, status FROM Event WHERE id = ".$row["event_id"]." AND updated < '".import_formatDate($row["event_updated_date"])."' AND legacy_id = ".$row["legacy_id"];

					$resultUpdate = mysql_query($sqlUpdate, $linkDomain);
					if(mysql_num_rows($resultUpdate) > 0){
						$needToUpdate = true;
						$rowUpdate = mysql_fetch_assoc($resultUpdate);
						$old_status = $row["status"];
					}
				}

				####################################################################################################
				### LOCATIONS
				####################################################################################################
				$time_start_aux = getmicrotime();

				foreach ($_locations as $_location_level) {

					system_retrieveLocationRelationship ($_locations, $_location_level, $_location_father_level, $_location_child_level);

					${"location_".$_location_level} = 0;

					$flag_continue = false;
					if (!$_location_father_level)
						$flag_continue = true;
					else
						if (${"location_".$_location_father_level}!=0)
							$flag_continue = true;

					if ($flag_continue) {

						//just do something if exits location name. If theres an abbreviation, but no name, do nothing
						if ($row["event_location".$_location_level]) {

							$father_filter = "";
							if ($_location_father_level)
								$father_filter = "AND location_".$_location_father_level." = ".db_formatNumber(${"location_".$_location_father_level});

							$result_location_num_rows = 0;
							$result_abbreviation_num_rows = 0;
							$sqlLocation = "SELECT id FROM Location_".$_location_level." WHERE name = ".db_formatString(trim($row["event_location".$_location_level]))." ".$father_filter;
							$result_location = mysql_query($sqlLocation, $link);
							$result_location_num_rows = mysql_num_rows($result_location);

							//If theres abbreviation, check if it already exits at database. If so, don't add the new location in case it was typed wrong
							if ($row["event_location".$_location_level."_abbreviation"]){
								$sqlLocation = "SELECT id FROM Location_".$_location_level." WHERE abbreviation = ".db_formatString($row["event_location".$_location_level."_abbreviation"])." ".$father_filter;
								$result_location_abbreviation = mysql_query($sqlLocation, $link);
								$result_abbreviation_num_rows = mysql_num_rows($result_location_abbreviation);
							}

							if (($result_location_num_rows<=0) && ($result_abbreviation_num_rows<=0)) { //location not found, insert new one

								${$_location_level."_friendly_url"} = preg_replace("/[^".FRIENDLYURL_VALIDCHARS."]/", FRIENDLYURL_SEPARATOR, $row["event_location".$_location_level]);
								${$_location_level."_friendly_url"} = string_strtolower(preg_replace("/[\\".FRIENDLYURL_SEPARATOR."]{2,}/", FRIENDLYURL_SEPARATOR, ${$_location_level."_friendly_url"}));

								unset($fathers_values);
								$fathers_values = false;
								$select_father_chain = "";
								foreach ($_locations as $each_location) {

									if ($each_location<$_location_level) {
										$fathers_values['levels'][] = "location_".$each_location;
										$fathers_values['ids'][]    = ${"location_".$each_location};
										$query_father_chain .= "location_".${"location_".$each_location}." = ".${"location_".$each_location}." AND ";
									}
								}

								$sqlLocation = "INSERT INTO Location_".$_location_level." (".($fathers_values?implode(',',$fathers_values['levels']).',':'')."`name`, `friendly_url`, `abbreviation`, `seo_description`, `seo_keywords`) VALUES (".($fathers_values?implode(',',$fathers_values['ids']).',':'')."".db_formatString(trim($row["event_location".$_location_level])).", ".db_formatString(${$_location_level."_friendly_url"}).", ".db_formatString($row["event_location".$_location_level."_abbreviation"]).", '', '')";
								mysql_query($sqlLocation, $link);
								${"location_".$_location_level} = mysql_insert_id($link);
								$sqlLocation = "SELECT id FROM Location_".$_location_level." WHERE id != ".${"location_".$_location_level}." AND ".($fathers_values?$select_father_chain:'')." friendly_url = ".db_formatString(${$_location_level."_friendly_url"})."";
								$result_location = mysql_query($sqlLocation, $link);
								if (mysql_num_rows($result_location) > 0) {
									${$_location_level."_friendly_url"} .= FRIENDLYURL_SEPARATOR.${"location_".$_location_level};
									$sqlLocation = "UPDATE Location_".$_location_level." SET friendly_url = ".db_formatString(${$_location_level."_friendly_url"})." WHERE ".($fathers_values?$select_father_chain:'')." id = ".${"location_".$_location_level}."";
									mysql_query($sqlLocation, $link);
								}
							//found location or location abbreviation
							} else {
								if ($row["event_location".$_location_level."_abbreviation"]){
									if ($result_abbreviation_num_rows > 0){
										$row_location_abbreviation = mysql_fetch_assoc($result_location_abbreviation);
										${"location_".$_location_level} = $row_location_abbreviation["id"];
									}else{
										$row_location = mysql_fetch_assoc($result_location);
										${"location_".$_location_level} = $row_location["id"];
										$sqlLocation = "UPDATE Location_".$_location_level." SET abbreviation = ".db_formatString($row["event_location".$_location_level."_abbreviation"])." WHERE id = ".${"location_".$_location_level}."";
										$result_location = mysql_query($sqlLocation, $link);
									}
								} else {
									$row_location = mysql_fetch_assoc($result_location);
									${"location_".$_location_level} = $row_location["id"];
								}
							}
						}
					}
				}
				$time_end_aux = getmicrotime();
				$time_aux = $time_end_aux - $time_start_aux;
				$time_total_location = $time_total_location + $time_aux;
				####################################################################################################

				####################################################################################################
				### CATEGORY
				####################################################################################################
				$time_start_aux = getmicrotime();

				unset($categoryIDArray);
				unset($current_event_categories);
				if ($row["event_category_1"]) {
					$current_event_categories[] = $row["event_category_1"];
				}
				if ($row["event_category_2"]) {
					$current_event_categories[] = $row["event_category_2"];
				}
				if ($row["event_category_3"]) {
					$current_event_categories[] = $row["event_category_3"];
				}
				if ($row["event_category_4"]) {
					$current_event_categories[] = $row["event_category_4"];
				}
				if ($row["event_category_5"]) {
					$current_event_categories[] = $row["event_category_5"];
				}
				$i = 0;

				if ($current_event_categories) {
					foreach ($current_event_categories as $current_event_category) {
						unset($current_category_tree);
						$current_category_tree = explode("->", $current_event_category);
						while (count($current_category_tree) > CATEGORY_LEVEL_AMOUNT) {
							array_pop($current_category_tree);
						}
						for ($count=0; $count<count($current_category_tree); $count++) {
							$current_category_tree[$count] = trim($current_category_tree[$count]);
						}
						$j = 0;
						$last_category_id = 0;
						if ($current_category_tree) {
							foreach ($current_category_tree as $current_category) {
								$sqlCategory = "SELECT * FROM EventCategory WHERE category_id = ".db_formatNumber($last_category_id)." AND title".EDIR_DEFAULT_LANGUAGENUMBER." = ".db_formatString($current_category)."";
								$resultCategory = mysql_query($sqlCategory, $linkDomain);
								if (mysql_num_rows($resultCategory) <= 0) {
									$category_friendly_url = preg_replace("/[^".FRIENDLYURL_VALIDCHARS."]/", FRIENDLYURL_SEPARATOR, $current_category);
									$category_friendly_url = strtolower(preg_replace("/[\\".FRIENDLYURL_SEPARATOR."]{2,}/", FRIENDLYURL_SEPARATOR, $category_friendly_url));
									$sqlCategory = "INSERT INTO EventCategory (lang, title".EDIR_DEFAULT_LANGUAGENUMBER.", page_title".EDIR_DEFAULT_LANGUAGENUMBER.", category_id, featured, friendly_url".EDIR_DEFAULT_LANGUAGENUMBER.", active_event, enabled) VALUES (".db_formatString($edir_default_language).", ".db_formatString($current_category).", ".db_formatString($current_category).", ".db_formatNumber($last_category_id).", ".($import_featured_categs ? db_formatString("y") :  db_formatString("n")).", ".db_formatString($category_friendly_url).", 0, 'y')";
									mysql_query($sqlCategory, $linkDomain);
									$current_category_id = mysql_insert_id($linkDomain);
									$sqlCategory = "SELECT * FROM EventCategory WHERE id != ".$current_category_id." AND category_id = ".db_formatNumber($last_category_id)." AND friendly_url".EDIR_DEFAULT_LANGUAGENUMBER." = ".db_formatString($category_friendly_url)."";
									$resultCategory = mysql_query($sqlCategory, $linkDomain);
									if (mysql_num_rows($resultCategory) > 0) {
										$category_friendly_url .= FRIENDLYURL_SEPARATOR.$current_category_id;
										$sqlCategory = "UPDATE EventCategory SET friendly_url".EDIR_DEFAULT_LANGUAGENUMBER." = ".db_formatString($category_friendly_url)." WHERE id = ".$current_category_id."";
										mysql_query($sqlCategory, $linkDomain);
									}
								} else {
									$rowCategory = mysql_fetch_assoc($resultCategory);
									$current_category_id = $rowCategory["id"];
								}
								$last_category_id = $current_category_id;
								$categoryIDArray[$i][$j] = $current_category_id;
								$j++;
							}
						}
						$i++;
					}
				}
				$time_end_aux = getmicrotime();
				$time_aux = $time_end_aux - $time_start_aux;
				$time_total_category = $time_total_category + $time_aux;
				####################################################################################################

				####################################################################################################
				### ACCOUNT
				####################################################################################################
				$time_start_aux = getmicrotime();

				$account_id = 0;
				if ($import_sameaccount) {
					$accountObj = new Account($import_account_id);
					$sqlSameAccount = "SELECT history FROM ImportLog WHERE id = ".db_formatNumber($importlog_id)." AND type = 'event'";
					$resultSameAccount = mysql_query($sqlSameAccount, $linkDomain);
					$import_sameaccount_message = false;
					if (mysql_num_rows($resultSameAccount) > 0) {
						$rowSameAccount = mysql_fetch_assoc($resultSameAccount);
						if (string_strpos($rowSameAccount["history"], "same account") === false) {
							$import_sameaccount_message = true;
						}
					}
					if ($accountObj->getNumber("id") > 0) {
						$account_id = $accountObj->getNumber("id");
						if ($import_sameaccount_message) {
							if (!$message_SameAccount){
								$message_SameAccount = true;
								if ($no_data_importtemporarytable){
									import_setHistory("LANG_SITEMGR_IMPORT_WILLBEIMPORTEDTOSAMEACCOUNT[".$accountObj->getString("username")."].", $linkDomain, db_formatNumber($importlog_id));
								}
							}
							import_logDebug("All ".EVENT_FEATURE_NAME_PLURAL." will be imported to same account: ".$accountObj->getString("username")." - LINE: ".__LINE__);
						}
					} else {
						if ($import_sameaccount_message) {
							import_setHistory("LANG_SITEMGR_IMPORT_IMPORTTOSAMEACCOUNTINVALIDACCOUNTID", $linkDomain, db_formatNumber($importlog_id));
							import_logDebug("Import to same account: invalid account id - LINE: ".__LINE__);
						}
					}
				} else {
					if ($row["account_username"]) {
						$sqlAccount = "SELECT id FROM Account WHERE username = ".db_formatString($row["account_username"])."";
						$resultAccount = mysql_query($sqlAccount, $link);
						if (mysql_num_rows($resultAccount) <= 0) {
							$sqlAccount = "INSERT INTO Account (updated, entered, agree_tou, lastlogin, username, password, importID_event, domain_importID_event, is_sponsor, has_profile) VALUES ('".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."', 1, 0, ".db_formatString($row["account_username"]).", ".db_formatString((((!$import_from_export) && (string_strtolower(PASSWORD_ENCRYPTION) == "on")) ? md5($row["account_password"]) : $row["account_password"])).", ".db_formatNumber($importlog_id).", ".db_formatNumber(SELECTED_DOMAIN_ID).", 'y', 'n')";
							mysql_query($sqlAccount, $link);
							$account_id = mysql_insert_id($link);
							$sqlContact = "INSERT INTO Contact (account_id, updated, entered, first_name, last_name, company, address, address2, country, state, city, zip, phone, fax, email, url, importID_event) VALUES (".db_formatNumber($account_id).", '".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."', ".db_formatString($row["account_first_name"]).", ".db_formatString($row["account_last_name"]).", ".db_formatString($row["account_company"]).", ".db_formatString($row["account_address"]).", ".db_formatString($row["account_address2"]).", ".db_formatString($row["account_country"]).", ".db_formatString($row["account_state"]).", ".db_formatString($row["account_city"]).", ".db_formatString($row["account_zip"]).", ".db_formatString($row["account_phone"]).", ".db_formatString($row["account_fax"]).", ".db_formatString($row["account_email"]).", ".db_formatString($row["account_url"]).", ".db_formatNumber($importlog_id).")";
							mysql_query($sqlContact, $link);
							$sqlProfile = "INSERT INTO Profile (account_id, nickname, friendly_url) VALUES (".db_formatNumber($account_id).", ".db_formatString($row["account_first_name"]." ".$row["account_last_name"]).", '".md5($account_id)."')";
							mysql_query($sqlProfile, $link);
						} else {
							$rowAccount = mysql_fetch_assoc($resultAccount);
							$account_id = $rowAccount["id"];
						}
						$accDomain = new Account_Domain($account_id, SELECTED_DOMAIN_ID);
						$accDomain->Save();
						$accDomain->saveOnDomain($account_id);
					}
				}
				
				####################################################################################################
				### Start/End Time
				####################################################################################################
				
				if ($row["event_starttime"]){
					
					$auxStartTime = explode(":", $row["event_starttime"]);
					$auxStartTimeMode = strtolower($row["event_starttime_mode"]);
					
					$start_time_hour = $auxStartTime[0];
					$start_time_min = $auxStartTime[1];

					if ($start_time_hour && $start_time_min && ($auxStartTimeMode == "am" || $auxStartTimeMode == "pm")) {
						$row["event_hasstarttime"] = "y";
						$startTimeStr = "";
						if (($auxStartTimeMode == "pm") && ($start_time_hour < 12)) $startTimeStr = 12 + $start_time_hour;
						elseif (($auxStartTimeMode == "am") && ($start_time_hour == "12")) $startTimeStr = "00";
						else $startTimeStr = $start_time_hour;
						$startTimeStr .= ":".$start_time_min.":00";
						$row["event_starttime"] = $startTimeStr;
					} elseif ($start_time_hour && $start_time_min && $auxStartTimeMode == "24") {
						$row["event_hasstarttime"] = "y";
						$startTimeStr = "";
						$startTimeStr = $start_time_hour;
						$startTimeStr .= ":".$start_time_min.":00";
						$row["event_starttime"] = $startTimeStr;
					} else {
						$row["event_hasstarttime"] = "n";
						$row["event_starttime"] = "00:00:00";
					}
				} else {
					$row["event_hasstarttime"] = "n";
					$row["event_starttime"] = "00:00:00";
				}
				
				if ($row["event_endtime"]){
					
					$auxEndTime = explode(":", $row["event_endtime"]);
					$auxEndTimeMode = strtolower($row["event_endtime_mode"]);
					
					$end_time_hour = $auxEndTime[0];
					$end_time_min = $auxEndTime[1];
					
					if ($end_time_hour && $end_time_min && ($auxEndTimeMode == "am" || $auxEndTimeMode == "pm")) {
						$row["event_hasendtime"] = "y";
						$endTimeStr = "";
						if (($auxEndTimeMode == "pm") && ($end_time_hour < 12)) $endTimeStr = 12 + $end_time_hour;
						elseif (($auxEndTimeMode == "am") && ($end_time_hour == "12")) $endTimeStr = "00";
						else $endTimeStr = $end_time_hour;
						$endTimeStr .= ":".$end_time_min.":00";
						$row["event_endtime"] = $endTimeStr;
					} elseif ($end_time_hour && $end_time_min && $auxEndTimeMode == "24") {
						$row["event_hasendtime"] = "y";
						$endTimeStr = "";
						$endTimeStr = $end_time_hour;
						$endTimeStr .= ":".$end_time_min.":00";
						$row["event_endtime"] = $endTimeStr;
					} else {
						$row["event_hasendtime"] = "n";
						$row["event_endtime"] = "00:00:00";
					}
				} else {
					$row["event_hasendtime"] = "n";
					$row["event_endtime"] = "00:00:00";
				}
				
				####################################################################################################
				### EVENT
				####################################################################################################
				$time_start_aux = getmicrotime();

				$event_id = 0;
				if ($row["event_title"]) {
					if ($import_enable_event_active) {
						$event_status = trim(system_findTranslationFor("LANG_LABEL_ACTIVE", EDIR_DEFAULT_LANGUAGE));
					} else {
						$event_status = $row["event_status"];
					}
					$validStatus = "";
					foreach ($allStatus as $eachStatusValue=>$eachStatusName) {
						if ($eachStatusName && $event_status) {
							if (string_strpos(string_strtoupper($eachStatusName), string_strtoupper($event_status)) !== false) {
								$validStatus = $eachStatusValue;
							}
						}
					}
					if ($validStatus) {
						$event_status = $validStatus;
					} else {
						$event_status = $defaultStatus;
					}
					$allLevels = $levelObj->getValueName();
					$validLevel = "";
					foreach ($allLevels as $eachLevelValue=>$eachLevelName) {
						if ($row["event_level"]) {
							if (string_strpos(string_strtoupper($eachLevelName), string_strtoupper($row["event_level"])) !== false) {
								$validLevel = $eachLevelValue;
							}
						}
					}
					if ($validLevel) {
						$event_level = $validLevel;
					} else {
						if ($import_defaultlevel) {
							$event_level = $import_defaultlevel;
						} else {
							$event_level = $levelObj->getDefaultLevel();
						}
					}
					$event_friendly_url = preg_replace("/[^".FRIENDLYURL_VALIDCHARS."]/", FRIENDLYURL_SEPARATOR, $row["event_title"]);
					$event_friendly_url = string_strtolower(preg_replace("/[\\".FRIENDLYURL_SEPARATOR."]{2,}/", FRIENDLYURL_SEPARATOR, $event_friendly_url));
					$event_friendly_url = $event_friendly_url.FRIENDLYURL_SEPARATOR.uniqid();
					
					$cat_1_id = 0;
					$parcat_1_level1_id = 0;
					$parcat_1_level2_id = 0;
					$parcat_1_level3_id = 0;
					$parcat_1_level4_id = 0;
					$cat_2_id = 0;
					$parcat_2_level1_id = 0;
					$parcat_2_level2_id = 0;
					$parcat_2_level3_id = 0;
					$parcat_2_level4_id = 0;
					$cat_3_id = 0;
					$parcat_3_level1_id = 0;
					$parcat_3_level2_id = 0;
					$parcat_3_level3_id = 0;
					$parcat_3_level4_id = 0;
					$cat_4_id = 0;
					$parcat_4_level1_id = 0;
					$parcat_4_level2_id = 0;
					$parcat_4_level3_id = 0;
					$parcat_4_level4_id = 0;
					$cat_5_id = 0;
					$parcat_5_level1_id = 0;
					$parcat_5_level2_id = 0;
					$parcat_5_level3_id = 0;
					$parcat_5_level4_id = 0;
					if ($categoryIDArray) {
						$count_cat_aux = 1;
						foreach ($categoryIDArray as $category_id_tree) {
							${"cat_".$count_cat_aux."_id"} = $category_id_tree[count($category_id_tree)-1];
							${"parcat_".$count_cat_aux."_level1_id"} = $category_id_tree[count($category_id_tree)-2];
							${"parcat_".$count_cat_aux."_level2_id"} = $category_id_tree[count($category_id_tree)-3];
							${"parcat_".$count_cat_aux."_level3_id"} = $category_id_tree[count($category_id_tree)-4];
							${"parcat_".$count_cat_aux."_level4_id"} = $category_id_tree[count($category_id_tree)-5];
							$count_cat_aux++;
						}
					}

					$locations_chain_field = "";
					$locations_chain_value = "";
					$locations_chain_update = "";
					foreach ($_locations as $_location_level) {
						$locations_chain_field .= "location_".$_location_level.", ";
						$locations_chain_value .= db_formatNumber(${"location_".$_location_level}).", ";
						$locations_chain_update .= "location_".$_location_level." = ".db_formatNumber(${"location_".$_location_level}).", ";
					}
					
					if (!$row["event_enddate"]){
						$auxRecurring = "Y";
					} else {
						$auxRecurring = "N";
					}

					if ($needToUpdate){
						$sqlEvent = "UPDATE Event SET ";
						$sqlEvent .= "account_id = ".db_formatNumber($account_id).", ";
						$sqlEvent .= $locations_chain_update;
						$sqlEvent .= "updated = '".date('Y-m-d H:i:s')."', ";
						$sqlEvent .= "renewal_date = '".import_formatDate($row["event_renewal_date"])."', ";
						$sqlEvent .= "title = ".db_formatString($row["event_title"]).", ";
						$sqlEvent .= "seo_title = ".db_formatString($row["event_title"]).", ";
						$sqlEvent .= "friendly_url = ".db_formatString($event_friendly_url).", ";
						$sqlEvent .= "email = ".db_formatString($row["event_email"]).", ";
						$sqlEvent .= "url = ".db_formatString($row["event_url"]).", ";
						$sqlEvent .= "address = ".db_formatString($row["event_address"]).", ";
						$sqlEvent .= "location = ".db_formatString($row["event_locationname"]).", ";
						$sqlEvent .= "contact_name = ".db_formatString($row["event_contactname"]).", ";
						$sqlEvent .= "start_date = ".db_formatDate($row["event_startdate"]).", ";
						$sqlEvent .= "has_start_time = ".db_formatString($row["event_hasstarttime"]).", ";
						$sqlEvent .= "start_time = ".db_formatString($row["event_starttime"]).", ";
						$sqlEvent .= "end_date = ".db_formatDate($row["event_enddate"]).", ";
						$sqlEvent .= "has_end_time = ".db_formatString($row["event_hasendtime"]).", ";
						$sqlEvent .= "end_time = ".db_formatString($row["event_endtime"]).", ";
						$sqlEvent .= "zip_code = ".db_formatString($row["event_zip"]).", ";
						$sqlEvent .= "latitude = ".db_formatString($row["event_latitude"]).", ";
						$sqlEvent .= "longitude = ".db_formatString($row["event_longitude"]).", ";
						$sqlEvent .= "phone = ".db_formatString($row["event_phone"]).", ";
						$sqlEvent .= "description".EDIR_DEFAULT_LANGUAGENUMBER." = ".db_formatString($row["event_description"]).", ";
						$sqlEvent .= "seo_description".EDIR_DEFAULT_LANGUAGENUMBER." = ".db_formatString($row["event_description"]).", ";
						$sqlEvent .= "long_description".EDIR_DEFAULT_LANGUAGENUMBER." = ".db_formatString($row["event_long_description"]).", ";
						$sqlEvent .= "keywords".EDIR_DEFAULT_LANGUAGENUMBER." = ".db_formatString($row["event_keyword"]).", ";
						$sqlEvent .= "seo_keywords".EDIR_DEFAULT_LANGUAGENUMBER." = ".db_formatString(str_replace(" || ", ",", $row["event_keyword"])).", ";
						$sqlEvent .= "status = ".db_formatString($event_status).", ";
						$sqlEvent .= "level = ".db_formatString($event_level).", ";
						$sqlEvent .= "cat_1_id = ".db_formatString($cat_1_id).", ";
						$sqlEvent .= "parcat_1_level1_id = ".db_formatString($parcat_1_level1_id).", ";
						$sqlEvent .= "parcat_1_level2_id = ".db_formatString($parcat_1_level2_id).", ";
						$sqlEvent .= "parcat_1_level3_id = ".db_formatString($parcat_1_level3_id).", ";
						$sqlEvent .= "parcat_1_level4_id = ".db_formatString($parcat_1_level4_id).", ";
						$sqlEvent .= "cat_2_id = ".db_formatString($cat_2_id).", ";
						$sqlEvent .= "parcat_2_level1_id = ".db_formatString($parcat_2_level1_id).", ";
						$sqlEvent .= "parcat_2_level2_id = ".db_formatString($parcat_2_level2_id).", ";
						$sqlEvent .= "parcat_2_level3_id = ".db_formatString($parcat_2_level3_id).", ";
						$sqlEvent .= "parcat_2_level4_id = ".db_formatString($parcat_2_level4_id).", ";
						$sqlEvent .= "cat_3_id = ".db_formatString($cat_3_id).", ";
						$sqlEvent .= "parcat_3_level1_id = ".db_formatString($parcat_3_level1_id).", ";
						$sqlEvent .= "parcat_3_level2_id = ".db_formatString($parcat_3_level2_id).", ";
						$sqlEvent .= "parcat_3_level3_id = ".db_formatString($parcat_3_level3_id).", ";
						$sqlEvent .= "parcat_3_level4_id = ".db_formatString($parcat_3_level4_id).", ";
						$sqlEvent .= "cat_4_id = ".db_formatString($cat_4_id).", ";
						$sqlEvent .= "parcat_4_level1_id = ".db_formatString($parcat_4_level1_id).", ";
						$sqlEvent .= "parcat_4_level2_id = ".db_formatString($parcat_4_level2_id).", ";
						$sqlEvent .= "parcat_4_level3_id = ".db_formatString($parcat_4_level3_id).", ";
						$sqlEvent .= "parcat_4_level4_id = ".db_formatString($parcat_4_level4_id).", ";
						$sqlEvent .= "cat_5_id = ".db_formatString($cat_5_id).", ";
						$sqlEvent .= "parcat_5_level1_id = ".db_formatString($parcat_5_level1_id).", ";
						$sqlEvent .= "parcat_5_level2_id = ".db_formatString($parcat_5_level2_id).", ";
						$sqlEvent .= "parcat_5_level3_id = ".db_formatString($parcat_5_level3_id).", ";
						$sqlEvent .= "parcat_5_level4_id = ".db_formatString($parcat_5_level4_id).", ";
						$sqlEvent .= "importID = ".db_formatNumber($importlog_id)." ";
						$sqlEvent .= "WHERE id = ".$row["event_id"];
					} else {
						$sqlEvent = "INSERT INTO Event (legacy_id,
															account_id,
															".$locations_chain_field."
															updated,
															entered,
															renewal_date,
															title,
															seo_title,
															friendly_url,
															email,
															url,
															address,
															location,
															contact_name,
															start_date,
															has_start_time,
															start_time,
															end_date,
															has_end_time,
															end_time,
															zip_code,
															latitude,
															longitude,
															phone,
															description".EDIR_DEFAULT_LANGUAGENUMBER.",
															seo_description".EDIR_DEFAULT_LANGUAGENUMBER.",
															long_description".EDIR_DEFAULT_LANGUAGENUMBER.",
															keywords".EDIR_DEFAULT_LANGUAGENUMBER.",
															seo_keywords".EDIR_DEFAULT_LANGUAGENUMBER.",
															status,
															level,
															importID,
															cat_1_id, 
															parcat_1_level1_id, 
															parcat_1_level2_id, 
															parcat_1_level3_id, 
															parcat_1_level4_id, 
															cat_2_id, 
															parcat_2_level1_id, 
															parcat_2_level2_id, 
															parcat_2_level3_id, 
															parcat_2_level4_id, 
															cat_3_id, 
															parcat_3_level1_id, 
															parcat_3_level2_id, 
															parcat_3_level3_id, 
															parcat_3_level4_id, 
															cat_4_id, 
															parcat_4_level1_id, 
															parcat_4_level2_id, 
															parcat_4_level3_id, 
															parcat_4_level4_id, 
															cat_5_id, 
															parcat_5_level1_id, 
															parcat_5_level2_id, 
															parcat_5_level3_id, 
															parcat_5_level4_id,
															recurring,
															repeat_event)
															VALUES
															(".db_formatNumber($row["legacy_id"]).",
															".db_formatNumber($account_id).",
																".$locations_chain_value."
																'".date('Y-m-d H:i:s')."',
																'".date('Y-m-d H:i:s')."',
																'".import_formatDate($row["event_renewal_date"])."',
																".db_formatString($row["event_title"]).",
																".db_formatString($row["event_title"]).",
																".db_formatString($event_friendly_url).",
																".db_formatString($row["event_email"]).",
																".db_formatString($row["event_url"]).",
																".db_formatString($row["event_address"]).",
																".db_formatString($row["event_locationname"]).",
																".db_formatString($row["event_contactname"]).",																	
																'".import_formatDate($row["event_startdate"])."',																	
																".db_formatString($row["event_hasstarttime"]).",																	
																".db_formatString($row["event_starttime"]).",																	
																'".import_formatDate($row["event_enddate"])."',																	
																".db_formatString($row["event_hasendtime"]).",																	
																".db_formatString($row["event_endtime"]).",																	
																".db_formatString($row["event_zip"]).",
																".db_formatString($row["event_latitude"]).",
																".db_formatString($row["event_longitude"]).",
																".db_formatString($row["event_phone"]).",
																".db_formatString($row["event_description"]).",
																".db_formatString($row["event_description"]).",
																".db_formatString($row["event_long_description"]).",
																".db_formatString($row["event_keyword"]).",
																".db_formatString(str_replace(" || ", ",", $row["event_keyword"])).",
																".db_formatString($event_status).",
																".db_formatString($event_level).",
																".db_formatNumber($importlog_id).",
																".db_formatNumber($cat_1_id).", 
																".db_formatNumber($parcat_1_level1_id).",
																".db_formatNumber($parcat_1_level2_id).",
																".db_formatNumber($parcat_1_level3_id).",
																".db_formatNumber($parcat_1_level4_id).",
																".db_formatNumber($cat_2_id).",
																".db_formatNumber($parcat_2_level1_id).",
																".db_formatNumber($parcat_2_level2_id).",
																".db_formatNumber($parcat_2_level3_id).",
																".db_formatNumber($parcat_2_level4_id).",
																".db_formatNumber($cat_3_id).",
																".db_formatNumber($parcat_3_level1_id).",
																".db_formatNumber($parcat_3_level2_id).",
																".db_formatNumber($parcat_3_level3_id).",
																".db_formatNumber($parcat_3_level4_id).",
																".db_formatNumber($cat_4_id).",
																".db_formatNumber($parcat_4_level1_id).",
																".db_formatNumber($parcat_4_level2_id).",
																".db_formatNumber($parcat_4_level3_id).",
																".db_formatNumber($parcat_4_level4_id).",
																".db_formatNumber($cat_5_id).",
																".db_formatNumber($parcat_5_level1_id).",
																".db_formatNumber($parcat_5_level2_id).",
																".db_formatNumber($parcat_5_level3_id).",
																".db_formatNumber($parcat_5_level4_id).",
																".db_formatString($auxRecurring).",
																".db_formatString("N").")";
					}

					mysql_query($sqlEvent, $linkDomain);
					$event_id = mysql_insert_id($linkDomain);

					if ($needToUpdate){
						$event_id = $row["event_id"];
					} else {
						$event_id = mysql_insert_id($linkDomain);
					}

					if (!$needToUpdate){
						$sqlGallery = "
								INSERT INTO `Gallery`
									(`account_id`, `title`, `entered`, `updated`)
								VALUES
								(
									".db_formatNumber($account_id).",
									".db_formatString($row["event_title"]).",
									NOW(),
									NOW()
								)";
						mysql_query($sqlGallery, $linkDomain);
						$gallery_id = mysql_insert_id($linkDomain);

						$sqlGalleryI = "
								INSERT INTO `Gallery_Item`
									(`item_type`, `item_id`, `gallery_id`)
								VALUES
								(
									'event',
									".db_formatNumber($event_id).",
									".db_formatString($gallery_id)."
								)";
						mysql_query($sqlGalleryI, $linkDomain);
					}
					/*
					 * Increment the Dashboard Values
					 */
					if (!$needToUpdate){
						domain_updateDashboard("number_content","inc");
					}

					if ($needToUpdate){
						if ($old_status != "P" && $event_status == "P"){
							activity_newToApproved(SELECTED_DOMAIN_ID, $event_id, "event", $row["event_title"]);
						}

					} else {
						if ($event_status == "P"){
							activity_newToApproved(SELECTED_DOMAIN_ID, $event_id, "event", $row["event_title"]);
						}
					}

					unset($fulltextsearch_keyword);
					unset($fulltextsearch_where);
					if ($row["event_title"]) {
						$fulltextsearch_keyword[] = $row["event_title"];
					}
					if ($row["event_keyword"]) {
						$fulltextsearch_keyword[] = str_replace(" || ", " ", $row["event_keyword"]);
					}
					if ($row["event_address"]) {
						$fulltextsearch_where[] = $row["event_address"];
					}
					if ($row["event_zip"]) {
						$fulltextsearch_where[] = $row["event_zip"];
					}

					foreach ($_locations as $_location_level) {
						if ($row["event_location".$_location_level]) {
							$fulltextsearch_where[] = $row["event_location".$_location_level];
						}
						if($row["event_location".$_location_level."_abbreviation"]){
							$fulltextsearch_where[] = $row["event_location".$_location_level."_abbreviation"];
						}
					}

					if ($row["event_category_1"]) {
						$fulltextsearch_keyword[] = str_replace("->", " ", $row["event_category_1"]);
					}
					if ($row["event_category_2"]) {
						$fulltextsearch_keyword[] = str_replace("->", " ", $row["event_category_2"]);
					}
					if ($row["event_category_3"]) {
						$fulltextsearch_keyword[] = str_replace("->", " ", $row["event_category_3"]);
					}
					if ($row["event_category_4"]) {
						$fulltextsearch_keyword[] = str_replace("->", " ", $row["event_category_4"]);
					}
					if ($row["event_category_5"]) {
						$fulltextsearch_keyword[] = str_replace("->", " ", $row["event_category_5"]);
					}
					if ($row["event_description"]) {
						$fulltextsearch_keyword[] = string_substr($row["event_description"], 0, 100);
					}
					if ($fulltextsearch_keyword) {
						$fulltextsearch_keyword_sql = db_formatString(implode(" ", $fulltextsearch_keyword));
						$sqlFullTextSearch = "UPDATE Event SET fulltextsearch_keyword = ".$fulltextsearch_keyword_sql." WHERE id = ".db_formatNumber($event_id)."";
						mysql_query($sqlFullTextSearch, $linkDomain);
					}
					if ($fulltextsearch_where) {
						$fulltextsearch_where_sql = db_formatString(implode(" ", $fulltextsearch_where));
						$sqlFullTextSearch = "UPDATE Event SET fulltextsearch_where = ".$fulltextsearch_where_sql." WHERE id = ".db_formatNumber($event_id)."";
						mysql_query($sqlFullTextSearch, $linkDomain);
					}

					if (ZIPCODE_PROXIMITY == "on") {
						zipproximity_updateDB("Event", $event_id);
					}

				}


				####################################################################################################


				if ($totallines > 0){
					$sql = "UPDATE ImportLog SET linesadded = ".((int)$lines_added+1).", progress = '".(floor(($row["file_line_number"]-1)/($totallines)*100))."%' WHERE id = '".$importlog_id."' AND type = 'event'";
					$result_total_log = mysql_query($sql, $linkDomain);
				}

				$aTS = getmicrotime();

				$aux_import_ids .= ($row["id"].",");
				$current_event++;
				$current_time = getmicrotime() - $time_start;
				$aTE = getmicrotime();
				$auxT += $aTE - $aTS;
                
                $sqlv = "SELECT id FROM ImportLog WHERE id = ".$importlog_id." AND status = 'W' AND type = 'event'";
				if(mysql_num_rows(mysql_query($sqlv, $linkDomain)) > 0){
					$import_stop = true;
				}
			}

			$sql = "UPDATE ImportTemporary_Event SET inserted = 'y' WHERE id in (".(substr($aux_import_ids,-1) == "," ? substr($aux_import_ids,0,-1) : $aux_import_ids).")";
			$result = mysql_query($sql, $linkDomain);

			$sqlEvent_Category = substr($sqlEvent_Category, 0, -1);
			mysql_query($sqlEvent_Category, $linkDomain);
			
			$sql = "SELECT count(`id`) AS `total` FROM `Account` WHERE `importID_event` = ".$importlog_id." AND `domain_importID_event` = ".db_formatNumber(SELECTED_DOMAIN_ID);
			$result = mysql_query($sql, $link);
			$row = mysql_fetch_assoc($result);
			$accounts_added = $row['total'];

			$sql = "SELECT count(`id`) AS `total` FROM `Event` WHERE `importID` = ".$importlog_id;
			$result = mysql_query($sql, $linkDomain);
			$row = mysql_fetch_assoc($result);
			$events_added = $row['total'];
			
			$sql = "UPDATE `ImportLog` SET `itens_added` = '$events_added', `accounts_added` = '$accounts_added' WHERE `id` = $importlog_id AND `type` = 'event'";
			mysql_query($sql, $linkDomain);

			$sql = "SELECT id FROM ImportTemporary_Event WHERE import_log_id = '".$importlog_id."' AND inserted = 'n' ORDER BY id LIMIT 1";
			$result = mysql_query($sql, $linkDomain);
			if (mysql_num_rows($result) <= 0) {
				if ($status == "R") {
                    $sitemgr_emails = explode(",",$sitemgr_email);
					$sitemgr_import_emails = explode(",",$sitemgr_import_email);

					// site manager warning message ////////////////////////////////////////////////////////////////////
					$sitemgr_msg = "
						<html>
							<head>
								<style>
									.email_style_settings{
										font-size:12px;
										font-family:Verdana, Arial, Sans-Serif;
										color:#000;
									}
								</style>
							</head>
							<body>
								<div class=\"email_style_settings\">
									Site Manager,<br /><br />
									Your event import was done.<br /><br />
									You can see details at:<br />";
									$sitemgr_msg .= "<br /><a href=\"http://".$default_url."/sitemgr/import/importlog.php?import_type=event&log_id=".$importlog_id."\" target=\"_blank\">http://".$default_url."/sitemgr/import/importlog.php?import_type=event&log_id=".$importlog_id."</a><br /><br />
								</div>
							</body>
						</html>";
                                    
                    if ($sitemgr_send_email == "on") {
                        if ($sitemgr_emails[0]) {
                            foreach ($sitemgr_emails as $sitemgr_email) {
                                system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] Event Import Notification", $sitemgr_msg, EDIRECTORY_TITLE." <".$sitemgr_email.">", "text/html", '', '', $error);
                            }
                        }
                    }
                                    
					if ($sitemgr_import_emails[0]) {
						foreach ($sitemgr_import_emails as $sitemgr_import_email) {
							system_mail($sitemgr_import_email, "[".EDIRECTORY_TITLE."] Event Import Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_import_email>", "text/html", '', '', $error);
						}
					}

					$sqlUpdate = "UPDATE ImportLog SET status = 'F', action = 'D', progress = '100%' WHERE id = ".$importlog_id." AND type = 'event'";
					mysql_query($sqlUpdate, $linkDomain);
					$sqlDelete = "DELETE FROM ImportTemporary_Event WHERE import_log_id = '".$importlog_id."'";
					mysql_query($sqlDelete, $linkDomain);
					$sqlUpdate = "UPDATE `Control_Import_Event` SET last_importlog = '$importlog_id' WHERE `domain_id` = ".SELECTED_DOMAIN_ID;
					mysql_query($sqlUpdate, $link);

					import_logDebug("Changing status - finished - LINE: ".__LINE__);

					if ($phisicalname) {
						if (!unlink($phisicalname)) {
							$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory Cron] - Import Process", "Error: file delete (".$phisicalname.").", $sitemgr_email);
							$eDirMailerObj->send();
							exit;
						}
						import_logDebug("Leaving preview file - LINE: ".__LINE__);
					}

				} else {
					import_logDebug("Process not running - LINE: ".__LINE__);
				}

				$sqlLog = "SELECT COUNT(id) AS total FROM `ImportLog` WHERE `status` = 'P' AND type = 'event'";
				$resLog = mysql_query($sqlLog, $linkDomain);
				$rowLog = mysql_fetch_assoc($resLog);
				if ($rowLog["total"] > 0) {
					$sqlCron = "UPDATE `Control_Import_Event` SET `scheduled` = 'Y', `running` = 'N' WHERE `domain_id` = ".SELECTED_DOMAIN_ID;
				} else {
					$sqlCron = "UPDATE `Control_Import_Event` SET `scheduled` = 'N', `running` = 'N' WHERE `domain_id` = ".SELECTED_DOMAIN_ID;
				}
				mysql_query($sqlCron, $link);
			} else {
				$needToContinue = true;
			}
		} else {
			$sqlLog = "SELECT COUNT(id) AS total FROM `ImportLog` WHERE `status` = 'P' AND type = 'event'";
			$resLog = mysql_query($sqlLog, $linkDomain);
			$rowLog = mysql_fetch_assoc($resLog);
			if ($rowLog["total"] > 0) {
				$sqlCron = "UPDATE `Control_Import_Event` SET `scheduled` = 'Y', `running` = 'N' WHERE `domain_id` = ".SELECTED_DOMAIN_ID;
			} else {
				$sqlCron = "UPDATE `Control_Import_Event` SET `scheduled` = 'N', `running` = 'N' WHERE `domain_id` = ".SELECTED_DOMAIN_ID;
			}
			mysql_query($sqlCron, $link);

			$import_stop = true;
			import_logDebug("No running process - LINE: ".__LINE__);
		}
	}

	/*
	* Count event per category
	*/
	system_countActiveItemByCategory("event");
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	unset($sql);
	unset($result);
	unset($row);
	$sql = "SELECT id, progress FROM ImportLog WHERE status = 'W' AND type = 'event' ORDER BY id LIMIT 1";
	$result = mysql_query($sql, $linkDomain);
	if (mysql_num_rows($result) > 0) {
		$row = mysql_fetch_assoc($result);
		$sql = "UPDATE ImportLog SET status = 'S' WHERE id = ".$row["id"];
		mysql_query($sql, $linkDomain);
		import_setHistory("LANG_SITEMGR_IMPORT_IMPORTINGPROCESSSTOPPED["." - ".$row["progress"]."].", $linkDomain, db_formatNumber($row["id"]));
		import_logDebug("Import process stopped - ".$row["progress"]." - LINE: ".__LINE__);
		$sql = "DELETE FROM ImportTemporary_Event WHERE import_log_id = '".$row["id"]."'";
		mysql_query($sql, $linkDomain);
	}
	unset($row);
	unset($result);
	unset($sql);

	$sqlLog = "SELECT COUNT(id) AS total FROM `ImportLog` WHERE `status` = 'P' AND type = 'event'";
	$resLog = mysql_query($sqlLog, $linkDomain);
	$rowLog = mysql_fetch_assoc($resLog);
	if ($rowLog["total"] > 0 || ($needToContinue && !$import_stop)) {
		$sqlCron = "UPDATE `Control_Import_Event` SET `scheduled` = 'Y', `running` = 'N', `last_importlog` = $importlog_id WHERE `domain_id` = ".SELECTED_DOMAIN_ID;
	} else {
		$sqlCron = "UPDATE `Control_Import_Event` SET `scheduled` = 'N', `running` = 'N' WHERE `domain_id` = ".SELECTED_DOMAIN_ID;
	}
	mysql_query($sqlCron, $link);

	$sql = "SELECT id FROM ImportLog WHERE status = 'E' AND type = 'event' ORDER BY id";
	$result = mysql_query($sql, $linkDomain);
	if (mysql_num_rows($result) > 0) {
		while ($row = mysql_fetch_array($result)){
			$sql = "DELETE FROM ImportTemporary_Event WHERE import_log_id = '".$row["id"]."'";
			mysql_query($sql, $linkDomain);
		}
	}
	unset($importObj);
	unset($row);
	unset($result);
	unset($sql);
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$time_end = getmicrotime();
	import_logDebug("End Date/Time: ".date("Y-m-d H:i:s"));
	import_logDebug("++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++");
	$time = $time_end - $time_start;
	if (!$import_stop) {
		print "Import Process on Domain ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")." - ".string_ucwords(EVENT_FEATURE_NAME_PLURAL).": ".$current_event." - ".round($time, 2)." seconds.\n";

		$str_debug = "AuxTime: ".round($auxT, 2)."\nLocation creation/update: ".round($time_total_location,2)."\nCategory creation: ".round($time_total_category,2)."\nAccount creation: ".round($time_total_account,2)."\nEvent creation/update: ".round($time_total_event,2)."\n";
		if (IMPORT_TIME_DEBUG == "on"){
			print "++++++++++++++++++\n\n";
			print "Time spent (seconds) in each import operation:\n\n";
			print $str_debug;
		}

		if (IMPORT_TIME_EMAIL_DEBUG == "on"){
			import_logDebug("Import Speed Report\n\nDomain: $default_url\nImport id: $importlog_id\nTime spent (seconds) in each import operation:\n\n$str_debug", true);
		}

		if (!setting_set("last_datetime_import_events", date("Y-m-d H:i:s"))) {
			if (!setting_new("last_datetime_import_events", date("Y-m-d H:i:s"))) {
				print "last_datetime_import_events error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
			}
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////
