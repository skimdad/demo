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
	# * FILE: /cron/prepare_import_events.php
	# ----------------------------------------------------------------------------------------------------

	function import_progress($filename, $message) {
		if (!$handle = fopen($filename, "a")) {
			setting_get("sitemgr_email", $sitemgr_email);
			$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory] - Prepare Import Process", "Error: file open (".$filename.").", $sitemgr_email);
			$eDirMailerObj->send();
			exit;
		}
		if (fwrite($handle, $message) === false) {
			setting_get("sitemgr_email", $sitemgr_email);
			$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory] - Prepare Import Process", "Error: file write (".$filename.").", $sitemgr_email);
			$eDirMailerObj->send();
			exit;
		}
		if (!fclose($handle)) {
			setting_get("sitemgr_email", $sitemgr_email);
			$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory] - Prepare Import Process", "Error: file close (".$filename.").", $sitemgr_email);
			$eDirMailerObj->send();
			exit;
		}
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////
	define("IMPORT_TIME_DEBUG", "off");
	define("IMPORT_TIME_EMAIL_DEBUG", "off");
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

	function getmicrotime() {
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}
	$time_start = getmicrotime();

	$check_convert_time = 0;
	$check_header_time = 0;
	$generate_lot_time = 0;
	$run_lot_time = 0;
	$validate_line_time = 0;
	$number_of_blocks = 0;

	$checkRunningCron = false;
	
	$sqlDomain = "	SELECT
						D.`id`, D.`database_host`, D.`database_port`, D.`database_username`, D.`database_password`, D.`database_name`, D.`url`
					FROM `Domain` AS D
					LEFT JOIN `Control_Cron` AS CC ON (CC.`domain_id` = D.`id`)
					LEFT JOIN `Control_Import_Listing` AS CIL ON (CIL.`domain_id` = D.`id`)
					WHERE CC.`running` = 'Y'
					AND CC.`type` = 'prepare_import_events'
					AND CIL.`running` = 'N'
					AND D.`status` = 'A'
					ORDER BY
						IF (CC.`last_run_date` IS NULL, 0, 1),
						CC.`last_run_date`,
						D.`id`
					LIMIT 1";

	$resDomain = mysql_query($sqlDomain, $link);
	
	if (mysql_num_rows($resDomain) > 0) {
		$checkRunningCron = true;
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////
	$sqlDomain = "	SELECT
						D.`id`, D.`database_host`, D.`database_port`, D.`database_username`, D.`database_password`, D.`database_name`, D.`url`
					FROM `Domain` AS D
					LEFT JOIN `Control_Cron` AS CC ON (CC.`domain_id` = D.`id`)
					LEFT JOIN `Control_Import_Event` AS CIL ON (CIL.`domain_id` = D.`id`)
					WHERE CC.`running` = 'N'
					AND CC.`type` = 'prepare_import_events'
					AND CIL.`running` = 'N'
					AND D.`status` = 'A'
					ORDER BY
						IF (CC.`last_run_date` IS NULL, 0, 1),
						CC.`last_run_date`,
						D.`id`
					LIMIT 1";

	$resDomain = mysql_query($sqlDomain, $link);

	if (mysql_num_rows($resDomain) > 0) {
		$rowDomain = mysql_fetch_assoc($resDomain);
		define("SELECTED_DOMAIN_ID", $rowDomain["id"]);
	////////////////////////////////////////////////////////////////////////////////////////////////////
		$domainHost = $rowDomain["database_host"].($rowDomain["database_port"]? ":".$rowDomain["database_port"]: "");
		$domainUser = $rowDomain["database_username"];
		$domainPass = $rowDomain["database_password"];
		$domainDBName = $rowDomain["database_name"];
		$domainURL = $rowDomain["url"];

		$link_domain = mysql_connect($domainHost, $domainUser, $domainPass, true);
		mysql_query("SET NAMES 'utf8'", $link_domain);
		mysql_query('SET character_set_connection=utf8', $link_domain);
		mysql_query('SET character_set_client=utf8', $link_domain);
		mysql_query('SET character_set_results=utf8', $link_domain);
		mysql_select_db($domainDBName);
	////////////////////////////////////////////////////////////////////////////////////////////////////
	} else {
		$checkRunningCron = true;
	}
	
	if ($checkRunningCron){
		$return = system("ps aux | grep prepare_import_events.php | grep -v grep | wc -l", $retval);
		if (($return <= 1) && (strtoupper(substr(PHP_OS, 0, 3)) != 'WIN')){
			
			$filenameControl = EDIRECTORY_ROOT."/custom/log/prepare_import_control_event.progress";
			$filenameProgress = EDIRECTORY_ROOT."/custom/log/prepare_import_event.progress";
			
			if (file_exists($filenameControl)) {
				if ($handleControl = fopen($filenameControl, "r")) {
					$controlInfo = fgets($handleControl);
					fclose($handleControl);	
					
					$controlInfoAux = explode("|", $controlInfo);
					$domain_id = $controlInfoAux[1];
					$importlog_id = $controlInfoAux[3];
					
					if (is_numeric($domain_id) && is_numeric($importlog_id)){
						$sqlDomain = "SELECT `database_host`, `database_port`, `database_username`, `database_password`, `database_name`, `url` FROM `Domain` WHERE `id` = $domain_id	LIMIT 1";
						$resDomain = mysql_query($sqlDomain, $link);
						if (mysql_num_rows($resDomain) > 0) {
							
							$rowDomain = mysql_fetch_assoc($resDomain);
							////////////////////////////////////////////////////////////////////////////////////////////////////
							$domainHost = $rowDomain["database_host"].($rowDomain["database_port"]? ":".$rowDomain["database_port"]: "");
							$domainUser = $rowDomain["database_username"];
							$domainPass = $rowDomain["database_password"];
							$domainDBName = $rowDomain["database_name"];
							$domainURL = $rowDomain["url"];

							$link_domain = mysql_connect($domainHost, $domainUser, $domainPass, true);
							mysql_query("SET NAMES 'utf8'", $link_domain);
							mysql_query('SET character_set_connection=utf8', $link_domain);
							mysql_query('SET character_set_client=utf8', $link_domain);
							mysql_query('SET character_set_results=utf8', $link_domain);
							mysql_select_db($domainDBName);
							////////////////////////////////////////////////////////////////////////////////////////////////////
							
							$sql = "UPDATE ImportLog SET `action` = 'NC' WHERE id = $importlog_id AND `action` = 'C' AND type = 'event'";
							mysql_query($sql, $link_domain);
							
							$sql = "DELETE FROM ImportTemporary_Event WHERE import_log_id = $importlog_id";
							mysql_query($sql, $link_domain);

							$sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'N', `last_run_date` = NOW() WHERE `type` = 'prepare_import_events'";
							mysql_query($sqlUpdate, $link);
							
							@unlink($filenameControl);
							@unlink($filenameProgress);
						}
					}
				}
			}
		}
		exit;
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	$_inCron = false;
	include_once(EDIRECTORY_ROOT."/conf/loadconfig.inc.php");
	////////////////////////////////////////////////////////////////////////////////////////////////////

	$sqlIL = "SELECT `id`, `date`, `time`, `filename`, `linesadded`, `phisicalname`, `status`, `action`, `progress`, `totallines`, `history`, `update_itens`, `mysqlerror` FROM `ImportLog` WHERE `status` = 'P' AND `action` = 'NC' AND `type` = 'event' AND `mysqlerror` = '' ORDER BY `date` AND `time`";
	$resIL = mysql_query($sqlIL, $link_domain);
	if (mysql_num_rows($resIL) > 0) {
		$sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'Y', `last_run_date` = NOW() WHERE `domain_id` = ".SELECTED_DOMAIN_ID." AND `type` = 'prepare_import_events'";
		mysql_query($sqlUpdate, $link);

		$rowIL = mysql_fetch_assoc($resIL);
		$importID = $rowIL["id"];

		$file = IMPORT_FOLDER."/".$rowIL["phisicalname"];
		$filePreview = IMPORT_FOLDER."/preview_".str_replace(".csv", ".php", $rowIL["phisicalname"]);
		$delimiter = import_detectDelimiter($file);

		$importlogObj = new ImportLog($rowIL);
		$importlogObj->setString("action", "C");
		$importlogObj->setString("type", "event");
		$importlogObj->Save();

		$check_convert_start = getmicrotime();
		if (function_exists("mb_detect_encoding") && function_exists("mb_convert_encoding")) {
			$handle = fopen($file, "r");
			$charsetContent = import_isUFT8(fgets($handle));
			while ($fileLine = fgetcsv($handle, 16384, $delimiter)) {
				foreach ($fileLine as $fileCol) {
					if (!import_isUFT8($fileCol) && !$charsetContent) {
						$needToConvert = true;
						break;
					}
				}
				if ($needToConvert) {
					break;
				}
			}
			fclose($handle);
		} else {
			$needToConvert = false;
		}
		$check_convert_end = getmicrotime();
		$check_convert_time += $check_convert_end - $check_convert_start;

		$check_header_start = getmicrotime();
		$handle = fopen(EDIRECTORY_ROOT."/sitemgr/import/edirectory_sample_event.csv", "r");
		$sample_header = fgets($handle);
		fclose($handle);
		if (file_exists($file)) {
			if (!$handle = fopen($file, "r")) {
				$import_stop = true;
			}
			$imported_header = fgets($handle);
			if (!fclose($handle)) {
				$import_stop = true;
			}
		} else {
			$import_stop = true;
		}
		if (!$import_stop) {
			$sample_header = explode(",", $sample_header);

			$imported_header = str_replace("\"", "", $imported_header);
			$imported_header = explode($delimiter, $imported_header);
			unset($wrong_imported_header);
			unset($wrong_header_fields);
			if (count($sample_header) < count($imported_header)) {
				$import_stop = true;
				$wrong_imported_header = true;
			}
			for ($i = 0; $i < count($sample_header); $i++) {
				$sample_header[$i] = str_replace("\n\r", "", $sample_header[$i]);
				$sample_header[$i] = str_replace("\r\n", "", $sample_header[$i]);
				$sample_header[$i] = str_replace("\n", "", $sample_header[$i]);
				$sample_header[$i] = str_replace("\r", "", $sample_header[$i]);
				$imported_header[$i] = str_replace("\n\r", "", $imported_header[$i]);
				$imported_header[$i] = str_replace("\r\n", "", $imported_header[$i]);
				$imported_header[$i] = str_replace("\n", "", $imported_header[$i]);
				$imported_header[$i] = str_replace("\r", "", $imported_header[$i]);

				if ($sample_header[$i] != $imported_header[$i]) {
					$import_stop = true;
					$wrong_header_fields[] = preg_replace('/[^0-9a-zA-Z ]/i', '', $sample_header[$i]);
				}
			}
		}
		$check_header_end = getmicrotime();
		$check_header_time += $check_header_end - $check_header_start;

		if (!$import_stop) {
			$remove_header_start = getmicrotime();
			$handle = fopen($file, "r");
			$file_header = fgetcsv($handle, 16384, $delimiter);
			$remove_header_end = getmicrotime();
			$remove_header_time += $remove_header_end - $remove_header_start;

			$totallines = 0;
			$file_line_number = 2;
			$lineNumber = 1;
			$sqlBlock = "";
			$sqlLine = "";
			$tempError = false;

			$previewHandle = fopen($filePreview, "w+");

			$csvLine = "<?".PHP_EOL;
			$csvLine .= "	header(\"Content-Type: text/csv; charset=UTF-8\", TRUE);".PHP_EOL.PHP_EOL;
			fwrite($previewHandle, $csvLine, strlen($csvLine));

			$csvLine = implode(",", $file_header)."\n";
			$csvLine = str_replace("\n", "",$csvLine);
			$csvLine = str_replace("\"", "\\\"",$csvLine);
			$csvLine = "	echo \"".$csvLine."\\n\";".PHP_EOL;
			fwrite($previewHandle, $csvLine, strlen($csvLine));

			/*
			 * GENERATE SQL LOT FILE
			 */
			$sqlVar = "SHOW VARIABLES WHERE `Variable_Name` = 'bulk_insert_buffer_size'";
			$resVar = mysql_query($sqlVar, $link_domain);
			$rowVar = mysql_fetch_assoc($resVar);
			
			$sqlVar2 = "SHOW VARIABLES WHERE `Variable_Name` = 'max_allowed_packet'";
			$resVar2 = mysql_query($sqlVar2, $link_domain);
			$rowVar2 = mysql_fetch_assoc($resVar2);

			if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
				$MySQL_insert_buffer = 4200;
			} else {
				if ($rowVar["Value"] > $rowVar2["Value"]) {
					$MySQL_insert_buffer = round($rowVar2["Value"] / 2);
				} else {
					$MySQL_insert_buffer = round($rowVar["Value"] / 2);
				}
			}
			$Block_insert_buffer = 0;
			$Line_insert_buffer = 0;

			if (!$charsetContent && $needToConvert == true) $needToConvert == true;
			else $needToConvert = false;

			$filenameControl = EDIRECTORY_ROOT."/custom/log/prepare_import_control_event.progress";
			$message_control .= "DomainID|".SELECTED_DOMAIN_ID."|ImportLogID|".$importID."";

			import_progress($filenameControl, $message_control);

			while ($line = fgetcsv($handle, 16384, $delimiter)) {
				$generate_lot_start = getmicrotime();
				if (!$tempError && !$import_stop) {
					unset($csvLine);
					if (strlen($sqlBlock) == 0 && strlen($sqlLine) == 0) {
						$sqlLine = "INSERT INTO `ImportTemporary_Event` (`id`, `import_log_id`, `file_line_number`, `account_username`, `account_password`, `account_first_name`, `account_last_name`, `account_company`, `account_address`, `account_address2`, `account_country`, `account_state`, `account_city`, `account_zip`, `account_phone`, `account_fax`, `account_email`, `account_url`, `legacy_id`, `event_id`, `event_title`, `event_email`, `event_url`, `event_address`, `event_locationname`, `event_contactname`, `event_startdate`, `event_enddate`, `event_starttime`, `event_starttime_mode`, `event_endtime`, `event_endtime_mode`, `event_location1`, `event_location1_abbreviation`, `event_location2`, `event_location2_abbreviation`, `event_location3`, `event_location3_abbreviation`, `event_location4`, `event_location4_abbreviation`, `event_location5`, `event_location5_abbreviation`, `event_zip`, `event_latitude`, `event_longitude`, `event_phone`, `event_description`, `event_long_description`, `event_keyword`, `event_updated_date`, `event_renewal_date`, `event_status`, `event_level`, `event_category_1`, `event_category_2`, `event_category_3`, `event_category_4`, `event_category_5`) VALUES ";
					}

					$sqlLine .= "(";
					$sqlLine .= "NULL,";
					$sqlLine .= "$importID,";
					$sqlLine .= "$lineNumber,";

					$filenameProgress = EDIRECTORY_ROOT."/custom/log/prepare_import_event.progress";
						
					$message_progress = "Generating \"Insert\" query - line $lineNumber\n";

					import_progress($filenameProgress, $message_progress);
					/*
					 * This block creates the SqlLine Command and CSV preview line field by field
					 * because the system performance, this method has a better performance than foreach command
					 */
					unset($c);
					$c = 0;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
                    $c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
                    $c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c])).",";
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",").",";
					$c++;
					$sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c]));
					if ($lineNumber <= 10) $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true? mb_convert_encoding($line[$c], "UTF-8"): $line[$c], ",")."\n";

					$sqlLine .= ")";

					if ($lineNumber <= 10) {
						$csvLine = str_replace("\n", "",$csvLine);
						$csvLine = str_replace("\"", "\\\"",$csvLine);
						$csvLine = "	echo \"".$csvLine."\\n\";".PHP_EOL;
						fwrite($previewHandle, $csvLine, strlen($csvLine));
					}

					$Line_insert_buffer = strlen($sqlLine);

					if (($Block_insert_buffer + $Line_insert_buffer) <= $MySQL_insert_buffer) {
						$sqlBlock .= $sqlLine.",";
						$sqlLine = "";
						$Block_insert_buffer = strlen($sqlBlock);
					} else {
						
						$message_progress = "Populating Import Temporary - line $lineNumber\n";

						import_progress($filenameProgress, $message_progress);
						
						$sqlBlock = string_substr($sqlBlock, 0, -1);
						$sqlBlock .= ";\n";
						$run_lot_start = getmicrotime();
						mysql_query($sqlBlock, $link_domain);
						if ($mysql_error = mysql_error($link_domain)) $tempError = true;
						$run_lot_end = getmicrotime();
						$run_lot_time += $run_lot_end - $run_lot_start;
						$number_of_blocks++;
						$auxLine = $sqlLine;
						$sqlLine = "INSERT INTO `ImportTemporary_Event` (`id`, `import_log_id`, `file_line_number`, `account_username`, `account_password`, `account_first_name`, `account_last_name`, `account_company`, `account_address`, `account_address2`, `account_country`, `account_state`, `account_city`, `account_zip`, `account_phone`, `account_fax`, `account_email`, `account_url`, `legacy_id`, `event_id`, `event_title`, `event_email`, `event_url`, `event_address`, `event_locationname`, `event_contactname`, `event_startdate`, `event_enddate`, `event_starttime`, `event_starttime_mode`, `event_endtime`, `event_endtime_mode`, `event_location1`, `event_location1_abbreviation`, `event_location2`, `event_location2_abbreviation`, `event_location3`, `event_location3_abbreviation`, `event_location4`, `event_location4_abbreviation`, `event_location5`, `event_location5_abbreviation`, `event_zip`, `event_latitude`, `event_longitude`, `event_phone`, `event_description`, `event_long_description`, `event_keyword`, `event_updated_date`, `event_renewal_date`, `event_status`, `event_level`, `event_category_1`, `event_category_2`, `event_category_3`, `event_category_4`, `event_category_5`) VALUES ";
						$sqlLine .= $auxLine.",";
						$Line_insert_buffer = strlen($sqlLine);
						$sqlBlock = "";
						$sqlBlock .= $sqlLine;
						$sqlLine = "";
						$Block_insert_buffer = strlen($sqlBlock);
					}
				}
				$generate_lot_end = getmicrotime();
				$generate_lot_time += $generate_lot_end - $generate_lot_start;
				$lineNumber++;
				
				if ($tempError && !$inHistory) {
					$inHistory = true;
					$import_stop = true;
					$importlogObj->setHistory("LANG_MSG_IMPORT_ERRORONIMPORTTOTEMPABLE");
					$importlogObj->setString("mysqlerror", $mysql_error);
					$importlogObj->Save();
				}

				$columns_error = false;

				$message_progress = "Validating CSV fields - line $lineNumber\n";

				import_progress($filenameProgress, $message_progress);

				if (count($line) > count($sample_header)) {
					$columns_error = true;
				} else {
					$validate_line_start = getmicrotime();
					for ($i=0; $i<count($sample_header); $i++) {
						$line[$i] = !$line[$i] ? "" : $line[$i];
						// REMOVING BREAK LINES IN CATEGORIES
						// PAY ATTENTION IN ORDER OF FIELDS
						if ($i >= (count($sample_header)-5)) {
							$line[$i] = str_replace("\r\n", "", $line[$i]);
							$line[$i] = str_replace("\n\r", "", $line[$i]);
							$line[$i] = str_replace("\r", "", $line[$i]);
							$line[$i] = str_replace("\n", "", $line[$i]);
						}

						if ($i == 0 || $i == 1 || $i == 17 || $i == 23 || $i == 24 || $i == 25 || $i == 26 || $i == 27 || $i == 29 || $i == 31 || $i == 33 || $i == 35 || $i == 37 || $i == 40 || $i == 41 || $i == 45 || $i == 46 || $i == 47) {
							if ($i == 0){ //validate username
								if (($errorInvalid = validate_username($line[$i]))) {
									if (!$line[$i]) {
										$username_noowner = true;
									} else {
										$importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDUSERNAMELINE[".$file_line_number."].");
										$import_stop = 1;
									}
								}
							}

							if ($i == 1){ //validate password
								if ((($errorInvalid = validate_password($line[$i])) || (strpos($line[$i], "\"") !== false)) && (!$username_noowner)) {
										$importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDPASSWORDLINE[".$file_line_number."].");
										$import_stop = 1;
								}
							}

							if ($i == 17){ //validate event title
								if (!$line[$i]) {
									$importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDTITLELINE[".$file_line_number."].");
									$import_stop = 1;
								}
							}
							
							if ($i == 23){ //validate start date
								$validStart = true;
								if ($line[$i]) {
									if (!validate_date($line[$i], true)) {
										$validStart = false;
										$importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDSTARTDATE[".$file_line_number."].");
										$import_stop = 1;
									}
								} else {
									$validStart = false;
									$importlogObj->setHistory("LANG_MSG_IMPORT_STARTDATEEMPTY[".$file_line_number."].");
									$import_stop = 1;
								}
							}

							if ($i == 24){ //validate end date
								$validEnd = true;
								if ($line[$i]) {
									if (!validate_date($line[$i], true)) {
										$validEnd = false;
										$importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDENDDATE[".$file_line_number."].");
										$import_stop = 1;
									}
								} else {
									setting_get("import_from_export_event", $import_from_export_event);
									if (!$import_from_export_event){
										$validEnd = false;
										$importlogObj->setHistory("LANG_MSG_IMPORT_ENDDATEEMPTY[".$file_line_number."].");
										$import_stop = 1;
									}	else {
										$recurring = "Y";
									}
								}

								if ($validStart && $validEnd){
									$startDateStr = explode("/", $line[$i-1]);
									$endDateStr = explode("/", $line[$i]);
									$default_date_format = system_findTranslationFor("DEFAULT_DATE_FORMAT", EDIR_DEFAULT_LANGUAGE);
									if ($default_date_format == "m/d/Y") {
										$startDateStr = $startDateStr[2].$startDateStr[0].$startDateStr[1];
										$endDateStr = $endDateStr[2].$endDateStr[0].$endDateStr[1];
									} elseif ($default_date_format == "d/m/Y") {
										$startDateStr = $startDateStr[2].$startDateStr[1].$startDateStr[0];
										$endDateStr = $endDateStr[2].$endDateStr[1].$endDateStr[0];
									}
									if ($startDateStr > $endDateStr && $recurring!='Y') {
										$importlogObj->setHistory("LANG_MSG_IMPORT_END_DATE_GREATER_THAN_START_DATE[".$file_line_number."].");
										$import_stop = 1;
									} elseif ($endDateStr < date("Ymd") && $recurring!='Y') {
										$importlogObj->setHistory("LANG_MSG_IMPORT_END_DATE_CANNOT_IN_PAST[".$file_line_number."].");
										$import_stop = 1;
									}
								}
							}

							if ($i == 25){ //validate start time
								$validStartTime = true;
								if ($line[$i]) {
									if (string_strpos($line[$i], ":") === false){
										$validStartTime = false;
										$importlogObj->setHistory("LANG_MSG_IMPORT_WRONG_START_TIME_FORMAT[".$file_line_number."].");
										$import_stop = 1;
									} else {
										$auxStartTime = explode(":", $line[$i]);
										if (is_numeric($auxStartTime[0]) && is_numeric($auxStartTime[1])){
											$start_time_hour = $auxStartTime[0];
											$start_time_min = $auxStartTime[1];
											$clock_type = system_findTranslationFor("CLOCK_TYPE", EDIR_DEFAULT_LANGUAGE);

											if ($clock_type == "12" && (($start_time_hour < 1 || $start_time_hour > 12) || ($start_time_min < 0 || $start_time_min > 59))){
												$validStartTime = false;
												$importlogObj->setHistory("LANG_MSG_IMPORT_WRONG_START_TIME_NUMBER[".$file_line_number."].");
												$import_stop = 1;
											} else if ($clock_type != "12" && (($start_time_hour < 0 || $start_time_hour > 23) || ($start_time_min < 0 || $start_time_min > 59))){
												$validStartTime = false;
												$importlogObj->setHistory("LANG_MSG_IMPORT_WRONG_START_TIME_NUMBER[".$file_line_number."].");
												$import_stop = 1;
											}

											if ($clock_type == "12" && (string_strtolower($line[$i+1]) != "am" && string_strtolower($line[$i+1]) != "pm")) {
												$validStartTime = false;
												$importlogObj->setHistory("LANG_MSG_IMPORT_WRONG_START_TIME_MODE1[".$file_line_number."].");
												$import_stop = 1;
											} else if ($clock_type != "12" && $line[$i+1] != "24"){
												$validStartTime = false;
												$importlogObj->setHistory("LANG_MSG_IMPORT_WRONG_START_TIME_MODE2[".$file_line_number."].");
												$import_stop = 1;
											}
										} else {
											$validStartTime = false;
											$importlogObj->setHistory("LANG_MSG_IMPORT_WRONG_START_TIME_FORMAT[".$file_line_number."].");
											$import_stop = 1;
										}
									}
								}
							}

							if ($i == 27){ //validate end time
								$validEndTime = true;
								if ($line[$i]) {
									if (string_strpos($line[$i], ":") === false){
										$validEndTime = false;
										$importlogObj->setHistory("LANG_MSG_IMPORT_WRONG_END_TIME_FORMAT[".$file_line_number."].");
										$import_stop = 1;
									} else {
										$auxEndTime = explode(":", $line[$i]);
										if (is_numeric($auxEndTime[0]) && is_numeric($auxEndTime[1])){
											$end_time_hour = $auxEndTime[0];
											$end_time_min = $auxEndTime[1];
											$clock_type = system_findTranslationFor("CLOCK_TYPE", EDIR_DEFAULT_LANGUAGE);

											if ($clock_type == "12" && (($end_time_hour < 1 || $end_time_hour > 12) || ($end_time_min < 0 || $end_time_min > 59) )){
												$validStartTime = false;
												$importlogObj->setHistory("LANG_MSG_IMPORT_WRONG_END_TIME_NUMBER[".$file_line_number."].");
												$import_stop = 1;
											} else if ($clock_type != "12" && (($end_time_hour < 0 || $end_time_hour > 23) || ($end_time_min < 0 || $end_time_min > 59) )){
												$validStartTime = false;
												$importlogObj->setHistory("LANG_MSG_IMPORT_WRONG_END_TIME_NUMBER[".$file_line_number."].");
												$import_stop = 1;
											}

											if ($clock_type == "12" && (string_strtolower($line[$i+1]) != "am" && string_strtolower($line[$i+1]) != "pm")) {
												$validEndTime = false;
												$importlogObj->setHistory("LANG_MSG_IMPORT_WRONG_END_TIME_MODE1[".$file_line_number."].");
												$import_stop = 1;
											} else if ($clock_type != "12" && $line[$i+1] != "24"){
												$validEndTime = false;
												$importlogObj->setHistory("LANG_MSG_IMPORT_WRONG_END_TIME_MODE2[".$file_line_number."].");
												$import_stop = 1;
											}
										} else {
											$validEndTime = false;
											$importlogObj->setHistory("LANG_MSG_IMPORT_WRONG_END_TIME_FORMAT[".$file_line_number."].");
											$import_stop = 1;
										}
									}

									if ($validStart && $validEnd && $validStartTime && $validEndTime){

										if ($startDateStr == $endDateStr){
											$startTimeStr = "";
											$start_time_am_pm = string_strtolower($line[26]);
											$end_time_am_pm = string_strtolower($line[28]);
											if (($start_time_am_pm == "pm") && ($start_time_hour < 12)) {
												$startTimeStr = 12 + $start_time_hour;
											} elseif (($start_time_am_pm == "am") && ($start_time_hour == "12")) {
												if ($end_time_am_pm == "pm") {
													$startTimeStr = "00";
												} elseif ($end_time_am_pm == "am") {
													$startTimeStr = "24";
												}
											} elseif ($start_time_hour == "00") {
												$startTimeStr = "00";
											} else {
												$startTimeStr = $start_time_hour;
											}
											$startTimeStr .= $start_time_min."00";

											$endTimeStr = "";
											if (($end_time_am_pm == "pm") && ($end_time_hour < 12)) {
												$endTimeStr = 12 + $end_time_hour;
											} elseif (($end_time_am_pm == "am") && ($end_time_hour == "12")) {
												if ($start_time_am_pm == "pm") {
													$endTimeStr = "00";
												} elseif ($start_time_am_pm == "am") {
													$endTimeStr = "24";
												}
											} elseif ($end_time_hour == "00"){
												$endTimeStr = "00";
											} else {
												$endTimeStr = $end_time_hour;
											}
											$endTimeStr .= $end_time_min."00";

											if ( ($startTimeStr >= $endTimeStr) ) {
												$importlogObj->setHistory("LANG_MSG_IMPORT_END_TIME_GREATER_THAN_START_TIME[".$file_line_number."].");
												$import_stop = 1;
											}
										}
									}
								}
							}

							if ($i == 29 || $i == 31 || $i == 33 || $i == 35 || $i == 37){ //validate locations

								$location_coluns = "";
								if (EDIR_DEFAULT_LOCATIONS) {
									$_default_locations			= explode(",", EDIR_DEFAULT_LOCATIONS);
									$_default_locationsnames	= explode(",", EDIR_DEFAULT_LOCATIONNAMES);
									$_edir_locations			= explode(",", EDIR_LOCATIONS);

									foreach ($_edir_locations as $key => $value) {
										if (in_array($value, $_default_locations)) {
											if (array_search($value, $_default_locations) != false) {
												$default_locations[$value] = $_default_locationsnames[array_search($value, $_default_locations)];
											}
										}
									}

									if ($i == 29) $j = 1;
									else if ($i == 31) $j = 2;
									else if ($i == 33) $j = 3;
									else if ($i == 35) $j = 4;
									else if ($i == 37) $j = 5;

									$j_value = $default_locations[$j];

									if (in_array($j_value, $default_locations)) {
										$location_coluns .= "event_location".$j.", ";
										${"default_location_".$j} = $default_locations[$j];

										if (string_strtolower(trim($line[$i])) != string_strtolower(trim(${"default_location_".$j}))) {
											$importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDLOCATIONLINE[".$file_line_number."].");
											$import_stop = 1;
										}
									}
								}
							}
                            
                            if ($i == 40){ //validate latitude
                                if ($line[$i]){
                                    if (!is_numeric($line[$i]) || $line[$i] < -90 || $line[$i] > 90){
                                        $importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDLATITUDELINE[".$file_line_number."].");
                                        $import_stop = 1;
                                    }
                                }
                            }

                            if ($i == 41){ //validate longitude
                                if ($line[$i]){
                                    if (!is_numeric($line[$i]) || $line[$i] < -180 || $line[$i] > 180){
                                        $importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDLONGITUDELINE[".$file_line_number."].");
                                        $import_stop = 1;
                                    }
                                }
                            }

							if ($i == 45){ //validate keywords
								$keywords = explode(" || ",$line[$i]);
								if (count($keywords) > MAX_KEYWORDS){
									$importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDKEYWORDS[".$file_line_number."].");
									$import_stop = 1;
								} else {
									for ($j = 0; $j<count($keywords); $j++){
										if (string_strlen($keywords[$j]) > 50){
											$importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDKEYWORDS2[".$file_line_number."].");
											$import_stop = 1;
										}
									}
								}
							}

							if ($i == 46) { //validate updated date
								if ($line[$i]) {
									if (!validate_date($line[$i], true)) {
										$importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDUPDATEDATE[".$file_line_number."].");
										$import_stop = 1;
									}
								}
							} else if ($i == 47) { //validate renewal date
								if ($line[$i]) {
									if (!validate_date($line[$i], true)) {
										$importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDRENEWALDATE[".$file_line_number."].");
										$import_stop = 1;
									}
								}
							}
						}
					}
					$validate_line_end = getmicrotime();
					$validate_line_time += $validate_line_end - $validate_line_start;
				}
				if ($columns_error) {
					$lines_error[] = $file_line_number;
				}
				$file_line_number++;
				$totallines++;
			}

			if (strlen($sqlBlock) != 0) {
				$sqlBlock = string_substr($sqlBlock, 0, -1);
				$sqlBlock .= ";\n";
				$run_lot_start = getmicrotime();
				mysql_query($sqlBlock, $link_domain);
				if ($mysql_error = mysql_error($link_domain)) $tempError = true;
				$run_lot_end = getmicrotime();
				$run_lot_time += $run_lot_end - $run_lot_start;
				$number_of_blocks++;
				$sqlBlock = "";
			}

			if ($tempError && !$inHistory) {
				$inHistory = true;
				$import_stop = true;
				$importlogObj->setHistory("LANG_MSG_IMPORT_ERRORONIMPORTTOTEMPABLE");
				$importlogObj->setString("mysqlerror", $mysql_error);
				$importlogObj->Save();
			}

			$csvLine = "?>".PHP_EOL;
			fwrite($previewHandle, $csvLine, strlen($csvLine));

			fclose($previewHandle);

			if (count($lines_error) > 0) {
				$importlogObj->setHistory("LANG_MSG_IMPORT_NUMBEROFCOLUMNSAREWRONG[".implode(", ", $lines_error)."].");
				$import_stop = 1;
			}
			fclose($handle);
		}

		if ($import_stop) {
			if ($wrong_imported_header) {
				$importlogObj->setHistory("LANG_MSG_IMPORT_WRONG_HEADER");
			}
			if ($wrong_header_fields) {
				$importlogObj->setHistory("LANG_MSG_IMPORT_WRONG_HEADER2[".implode(", ", $wrong_header_fields)."]");
			}
			$importlogObj->setString("status", "E");
			$importlogObj->setString("action", "D");
			$importlogObj->setString("progress", "100%");
			$importlogObj->setString("delimiter", $delimiter == "\t"? "tab": $delimiter);
			$importlogObj->save();

			$sqlT = "DELETE FROM `ImportTemporary_Event` WHERE `import_log_id` = ".$importlogObj->getNumber("id");
			mysql_query($sqlUpdate, $link_domain);

			setting_get("default_url", $default_url);
			setting_get("sitemgr_import_email", $sitemgr_import_email);
			$sitemgr_import_emails = explode(",", $sitemgr_import_email);

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
							Your import correction for file \"".$importlogObj->getString("filename")."\" was done but contain errors.<br /><br />
							You can see details at:<br />";
							$sitemgr_msg .= "<br /><a href=\"http://".$default_url."/sitemgr/import/importlog.php?type=event&log_id=".$importlogObj->getNumber("id")."\" target=\"_blank\">http://".$default_url."/sitemgr/import/importlog.php?type=event&log_id=".$importlog_id."</a><br /><br />
						</div>
					</body>
				</html>";

			if ($sitemgr_import_emails[0]) {
				foreach ($sitemgr_import_emails as $sitemgr_import_email) {
					system_mail($sitemgr_import_email, "[".EDIRECTORY_TITLE."] Import Correction Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_import_email>", "text/html", '', '', $error);
				}
			}
		} else {
			setting_get("import_automatic_start_event", $import_automatic_start);
			if ($import_automatic_start == "1") $importAction = "RI";
			else $importAction = "NA";

			$importlogObj->setNumber("totallines", $totallines);
			$importlogObj->setString("action", $importAction);
			$importlogObj->save();
			$importlogObj->setHistory("LANG_MSG_IMPORT_CSVIMPORTEDTOTEMPORARYTABLE");
			$importlogObj->setHistory("LANG_MSG_IMPORT_TOTALLINESREADY[".(int)$importlogObj->getNumber("totallines")."].");

			setting_get("default_url", $default_url);
			setting_get("sitemgr_import_email", $sitemgr_import_email);
			$sitemgr_import_emails = explode(",", $sitemgr_import_email);

			@unlink($filenameControl);
			@unlink($filenameProgress);

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
							Your import correction for file \"".$importlogObj->getString("filename")."\" was done.<br /><br />
							You can see details ".($importAction == "NA"? "and approve ": "")."at:<br />";
							$sitemgr_msg .= "<br /><a href=\"http://".$default_url."/sitemgr/import/importlog.php?type=event&log_id=".$importlogObj->getNumber("id")."&preview=true\" target=\"_blank\">http://".$default_url."/sitemgr/import/importlog.php?type=event&log_id=".$importlogObj->getNumber("id")."&preview=true</a><br /><br />
						</div>
					</body>
				</html>";

			if ($sitemgr_import_emails[0]) {
				foreach ($sitemgr_import_emails as $sitemgr_import_email) {
					system_mail($sitemgr_import_email, "[".EDIRECTORY_TITLE."] Import Correction Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_import_email>", "text/html", '', '', $error);
				}
			}

			/*
			* Import Schedule
			*/
			$sqlCron = "UPDATE `Control_Import_Event` SET `scheduled` = 'Y' WHERE `domain_id` = ".SELECTED_DOMAIN_ID;
			mysql_query($sqlCron, $link);
		}


		$sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'N', `last_run_date` = NOW() WHERE `domain_id` = ".SELECTED_DOMAIN_ID." AND `type` = 'prepare_import_events'";
		mysql_query($sqlUpdate, $link);
	} else {
		$sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'N', `last_run_date` = NOW() WHERE `domain_id` = ".SELECTED_DOMAIN_ID." AND `type` = 'prepare_import_events'";
		mysql_query($sqlUpdate, $link);
		exit;
	}
	
	////////////////////////////////////////////////////////////////////////////////////////////////////

	$time_end = getmicrotime();
	import_logDebug("End Date/Time: ".date("Y-m-d H:i:s"));
	import_logDebug("++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++");
	$time = $time_end - $time_start;
	if (!$import_stop) {
		print "Import Correction Process on Domain ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")." - ".string_ucwords(EVENT_FEATURE_NAME_PLURAL).": ".$totallines." - ".round($time, 2)." seconds.\n";

		$str_debug = "Check Content Encoding: ".round($check_convert_time,2)."\nCheck Header: ".round($check_header_time,2)."\nGenerate SQL Lot: ".round($generate_lot_time - $run_lot_time,2)."\nRun SQL Lot: ".round($run_lot_time,2)."\nNumber of Blocks: ".$number_of_blocks."\nValidate CSV Line: ".round($validate_line_time,2)."\n";
		if (IMPORT_TIME_DEBUG == "on"){
			print "++++++++++++++++++\n\n";
			print "Time spent (seconds) in each correction operation:\n\n";
			print $str_debug;
		}

		if (!setting_set("last_datetime_prepare_import_events", date("Y-m-d H:i:s"))) {
			if (!setting_new("last_datetime_prepare_import_events", date("Y-m-d H:i:s"))) {
				print "last_datetime_prepare_import_events error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
			}
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////
	
?>