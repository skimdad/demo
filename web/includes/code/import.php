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
	# * FILE: /includes/code/import.php
	# ----------------------------------------------------------------------------------------------------

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		extract($_POST);
		if ($type == "ajax") {
			include("../../conf/loadconfig.inc.php");
		}
		$dbObj = db_getDBObject(DEFAULT_DB, true);
		$db = db_getDBObjectByDomainID($domain_id? $domain_id: SELECTED_DOMAIN_ID, $dbObj);
		if ($type == "upload" || $type == "select") {
			if ($type == "upload") {
				if ($_FILES && $_FILES["importFile"]["name"]) {
					if ($_FILES["importFile"]["size"] <= (1100000*MAX_MB_FILE_SIZE_ALLOWED)) {
						$uploadObj = new UploadFiles();
						foreach ($_FILES as $key => $file) {
							$upload_name = $file["name"];
							$name_check = explode(".", $upload_name);
							if (string_strtolower($name_check[count($name_check)-1]) == "csv") {
								$file_name = system_generateFileName().".csv";
								$supported_extensions = array("csv"=>"all");
								$uploadObj->set("name", $file_name);
								$uploadObj->set("type", $file["type"]);
								$uploadObj->set("tmp_name", $file["tmp_name"]);
								$uploadObj->set("error", $file["error"]);
								$uploadObj->set("size", $file["size"]);
								$uploadObj->set("max_file_size", (1100000*MAX_MB_FILE_SIZE_ALLOWED));
								$uploadObj->set("randon_name", false);
								$uploadObj->set("replace", true);
								$uploadObj->set("file_perm", 0777);
								$uploadObj->set("dst_dir", IMPORT_FOLDER);
								$uploadObj->set("supported_extensions", $supported_extensions);
								$result = $uploadObj->moveFileToDestination();
								if (!$result) {
									$errors = $uploadObj->get("msg");
									$messageErrorUpload = $uploadObj->error_type." ".$errors[$uploadObj->get("error_type")];
									$file = false;
								}
							} else {
								$file = false;
								$messageErrorUpload = system_showText(LANG_SITEMGR_MSGERROR_FILEEXTENSIONNOTALLOWED);
							}
						}
					} else {
						$file = false;
						$messageErrorUpload = system_showText(LANG_SITEMGR_MSGERROR_MAXFILESIZEALLOWEDIS)." ".MAX_MB_FILE_SIZE_ALLOWED."MB";
					}
				} else {
					$file = false;
					$messageErrorUpload = system_showText(LANG_SITEMGR_MSGERROR_FILENOTENTERED);
				}
				
				if (!import_checkEmptyFile(IMPORT_FOLDER."/".$file_name, $auxError)) {
					$file = false;
					@unlink(IMPORT_FOLDER."/".$file_name);
                    if ($auxError){
                        $messageErrorUpload = $auxError;
                    } else {
                        $messageErrorUpload = system_showText(LANG_SITEMGR_MSGERROR_EMPTYFILE);
                    }
					
				}
				
			} else {
				if (!$file_name) {
					$messageErrorUpload = system_showText(LANG_SITEMGR_MSGERROR_FILENOTENTERED);
				} else if (!preg_match("/.csv$/", $file_name)) {
					$messageErrorUpload = system_showText(LANG_SITEMGR_MSGERROR_FILEEXTENSIONNOTALLOWED);
				} else if (!file_exists(IMPORT_FOLDER."/".$file_name)) {
					$messageErrorUpload = system_showText(LANG_SITEMGR_MSGERROR_FILENOTEXISTS);
				} else if (!import_checkEmptyFile(IMPORT_FOLDER."/".$file_name, $auxError)) {
					if ($auxError){
                        $messageErrorUpload = $auxError;
                    } else {
                        $messageErrorUpload = system_showText(LANG_SITEMGR_MSGERROR_EMPTYFILE);
                    }
				}
			}

			if (!$messageErrorUpload && $ftp_type != "schedule_cron") {
				$fileName = IMPORT_FOLDER."/".$file_name;
				$urlFileName = IMPORT_URL."/preview_".str_replace(".csv", ".php", $file_name);
				$previewFName = IMPORT_FOLDER."/preview_".str_replace(".csv", ".php", $file_name);
				$csvDelimiter = import_detectDelimiter($fileName);

				$needToConvert = false;

				if (function_exists("mb_detect_encoding") && function_exists("mb_convert_encoding")) {
					$charsetContent = import_isUFT8(file_get_contents($fileName));
					$handle = fopen($fileName, "r");
					while ($fileLine = fgetcsv($handle, 16384, $csvDelimiter)) {
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

					if ($needToConvert) {
						$auxFName = IMPORT_FOLDER."/aux_".$file_name;

						copy($fileName, $auxFName);

						$readHandle = fopen($auxFName, "r");
						@unlink($fileName);
						$writeHandle = fopen($fileName, "w+");
						$writePHandle = fopen($previewFName, "w+");
						$numberLine = 0;

						$csvLine = "<?".PHP_EOL;
						$csvLine .= "	header(\"Content-Type: text/csv; charset=UTF-8\", TRUE);".PHP_EOL.PHP_EOL;
						fwrite($writePHandle, $csvLine, strlen($csvLine));

						while ($rowAux = fgetcsv($readHandle, 16384, $csvDelimiter)) {
							unset($csvLine);
							foreach ($rowAux as $key => $fileCol) {
								if (!import_isUFT8($fileCol) && !$charsetContent) {
									$csvLine .= import_formatToCSV(mb_convert_encoding($fileCol, "UTF-8"), $csvDelimiter).($key == count($rowAux) - 1? "\n": $csvDelimiter);
								} else {
									$csvLine .= import_formatToCSV($fileCol, $csvDelimiter).($key == count($rowAux) - 1? "\n": $csvDelimiter);
								}
							}
							fwrite($writeHandle, $csvLine, strlen($csvLine));
							if ($numberLine <= 10) {
								$csvLine = str_replace("\n", "",$csvLine);
								$csvLine = str_replace("\"", "\\\"",$csvLine);
								$csvLine = "	echo \"".$csvLine."\\n\";".PHP_EOL;
								fwrite($writePHandle, $csvLine, strlen($csvLine));
							}
							$numberLine++;
						}

						$csvLine = "?>".PHP_EOL;
						fwrite($writePHandle, $csvLine, strlen($csvLine));

						fclose($writeHandle);
						fclose($writePHandle);
						fclose($readHandle);
						unlink($auxFName);
					}
				}

				if (!$needToConvert) {
					$readHandle = fopen($fileName, "r");
					$writePHandle = fopen($previewFName, "w+");
					$numberLine = 0;

					$csvLine = "<?".PHP_EOL;
					$csvLine .= "	header(\"Content-Type: text/csv; charset=UTF-8\", TRUE);".PHP_EOL.PHP_EOL;
					fwrite($writePHandle, $csvLine, strlen($csvLine));

					while ($rowAux = fgetcsv($readHandle, 16384, $csvDelimiter)) {
						unset($csvLine);
						foreach ($rowAux as $key => $fileCol) {
							if (!import_isUFT8($fileCol) && !$charsetContent && $needToConvert == true) {
								$csvLine .= import_formatToCSV(mb_convert_encoding($fileCol, "UTF-8"), $csvDelimiter).($key == count($rowAux) - 1? "\n": $csvDelimiter);
							} else {
								$csvLine .= import_formatToCSV($fileCol, $csvDelimiter).($key == count($rowAux) - 1? "\n": $csvDelimiter);
							}
						}
						if ($numberLine <= 10) {
							$csvLine = str_replace("\n", "",$csvLine);
							$csvLine = str_replace("\"", "\\\"",$csvLine);
							$csvLine = "	echo \"".$csvLine."\\n\";".PHP_EOL;
							fwrite($writePHandle, $csvLine, strlen($csvLine));
						} else {
							break;
						}
						$numberLine++;
					}

					$csvLine = "?>".PHP_EOL;
					fwrite($writePHandle, $csvLine, strlen($csvLine));

					fclose($writePHandle);
					fclose($readHandle);
				}
			}

			if ($messageErrorUpload) {
				$urlFileName = "";
			}
		} else if ($type == "options") {
			if (!$file_name) {
				$messageErrorUpload = system_showText(LANG_SITEMGR_MSGERROR_FILENOTENTERED);
			} else if (!preg_match("/.csv$/", $file_name)) {
				$messageErrorUpload = system_showText(LANG_SITEMGR_MSGERROR_FILEEXTENSIONNOTALLOWED);
			} else if (!file_exists(IMPORT_FOLDER."/".$file_name)) {
				$messageErrorUpload = system_showText(LANG_SITEMGR_MSGERROR_FILENOTEXISTS);
			}

			if ($csvOption == "custom") {
				$delimiter = $customOption;
			} else if ($csvOption == "automatic") {
				$delimiter = ",";
			} else if ($csvOption == "tab") {
				$delimiter = "\t";
			} else {
				$delimiter = $csvOption;
			}

			if (!$messageErrorUpload) {
				if ($upload_name) {
					$historyMsg = "LANG_SITEMGR_IMPORT_SUCCESSUPLOADED";
					$uploadname = $upload_name;
				} else {
					$uploadname = $file_name;
					$historyMsg = "LANG_SITEMGR_IMPORT_FILEUPLOADEDBYFTP";
				}
				setting_get("import_update_listings", $import_update_listings);
				if ($ftp_type == "schedule_cron") $importAction = "NC";
				else $importAction = "RI";

				$importlogObj = new ImportLog();
				$importlogObj->setString("date", date("Y-m-d"));
				$importlogObj->setString("time", date("H:i:s"));
				$importlogObj->setString("filename", $uploadname);
				$importlogObj->setString("linesadded", "0");
				$importlogObj->setString("phisicalname", $file_name);
				$importlogObj->setString("status", "P");
				$importlogObj->setString("action", $importAction);
				$importlogObj->setString("progress", "0%");
				$importlogObj->setString("totallines", "0");
				$importlogObj->setString("history", "");
				$importlogObj->setString("delimiter", $delimiter == "\t"? "tab": $delimiter);
				$importlogObj->setString("update_itens", ($import_update_listings == "1"? "y" : "n"));
				$importlogObj->Save();
				$importID = $importlogObj->getNumber("id");
				$importlogObj->setHistory($historyMsg);

				if ($ftp_type != "schedule_cron") {
					$file = IMPORT_FOLDER."/".$importlogObj->getString("phisicalname");
					$handle = fopen(EDIRECTORY_ROOT."/sitemgr/import/edirectory_sample.csv", "r");
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
					if (!$import_stop) {
						$handle = fopen($file, "r");
						$csvDelimiter = import_detectDelimiter($file);
						$file_header = fgetcsv($handle, 16384);
						$totallines = 0;
						$file_line_number = 2;
						while ($line = fgetcsv($handle, 16384, $csvDelimiter)) {
							$columns_error = false;

							if (count($line) > count($sample_header)) {
								$columns_error = true;
							} else {
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

									if ($i == 17){ //validate listing title
										if (!$line[$i]) {
											$importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDTITLELINE[".$file_line_number."].");
											$import_stop = 1;
										}
									}

									if ($i == 22 || $i == 24 || $i == 26 || $i == 28 || $i == 30){ //validate locations

										$location_coluns = "";
										if (EDIR_DEFAULT_LOCATIONS) {
											$_default_locations			= explode(",", EDIR_DEFAULT_LOCATIONS);
											$_default_locationsnames	= explode(",", EDIR_DEFAULT_LOCATIONNAMES);
											$_edir_locations			= explode(",", EDIR_LOCATIONS);

											foreach ($_edir_locations as $key => $value) {
												if (array_search($value, $_default_locations) !== false) {
													$default_locations[$value] = $_default_locationsnames[array_search($value, $_default_locations)];
												}
											}

											if ($i == 22) $j = 1;
											else if ($i == 24) $j = 2;
											else if ($i == 26) $j = 3;
											else if ($i == 28) $j = 4;
											else if ($i == 30) $j = 5;

											$j_value = $default_locations[$j];

											if (in_array($j_value, $default_locations)) {
												$location_coluns .= "listing_location".$j.", ";
												${"default_location_".$j} = $default_locations[$j];

												if (string_strtolower(trim($line[$i])) != string_strtolower(trim(${"default_location_".$j}))) {
													$importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDLOCATIONLINE[".$file_line_number."].");
													$import_stop = 1;
												}
											}
										}
									}
                                    
                                    if ($i == 33){ //validate latitude
                                        if ($line[$i]){
                                            if (!is_numeric($line[$i]) || $line[$i] < -90 || $line[$i] > 90){
                                                $importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDLATITUDELINE[".$file_line_number."].");
                                                $import_stop = 1;
                                            }
                                        }
                                    }
                                    
                                    if ($i == 34){ //validate longitude
                                        if ($line[$i]){
                                            if (!is_numeric($line[$i]) || $line[$i] < -180 || $line[$i] > 180){
                                                $importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDLONGITUDELINE[".$file_line_number."].");
                                                $import_stop = 1;
                                            }
                                        }
                                    }

									if ($i == 39){ //validate keywords
										$keywords = explode(" || ",$line[$i]);
										if (count($keywords) > MAX_KEYWORDS){
											$importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDKEYWORDS[".$file_line_number."].");
											$import_stop = 1;
										}
										for ($j = 0; $j<count($keywords); $j++){
											if (string_strlen($keywords[$j]) > 50){
												$importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDKEYWORDS2[".$file_line_number."].");
												$import_stop = 1;
											}
										}
									}

									if ($i == 40) { //validate updated date
										if ($line[$i]) {
											if (!validate_date($line[$i], true)) {
												$importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDUPDATEDATE[".$file_line_number."].");
												$import_stop = 1;
											}
										}
									} else if ($i == 41) { //validate renewal date
										if ($line[$i]) {
											if (!validate_date($line[$i], true)) {
												$importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDRENEWALDATE[".$file_line_number."].");
												$import_stop = 1;
											}
										}
									}
								}
							}
							if ($columns_error) {
								$lines_error[] = $file_line_number;
							}
							$file_line_number++;
							$totallines++;
						}
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
						$importlogObj->setString("progress", "100%");
						$importlogObj->save();
					} else {
						$importlogObj->setNumber("totallines", $totallines);
						$importlogObj->save();
						$importlogObj->setHistory("LANG_MSG_IMPORT_TOTALLINESREADY[".(int)$importlogObj->getNumber("totallines")."].");

						import_generateSQLLot($importID, $db);
					}
				}

				if ($upload_name) $aType = 1; //upload
				else if ($file_name) $aType = 2; //from ftp
				header("Location: ".DEFAULT_URL."/sitemgr/import/importlog.php?log_id=".$importID."&type=".$aType);
				exit;
			}
		} else if ($type == "approve") {
			$importlogObj = new ImportLog($import_id);
			$importlogObj->setString("action", "RI");
			$importlogObj->Save();
		} else if ($type == "ajax") {
			if ($option == "verify_lines") {
				$ftp_type = 1;
				$path = EDIRECTORY_ROOT."/custom/domain_".$domain_id."/import_files";
				$file_path = $path."/".$file_name;
				if (file_exists($file_path)){
					$handle = fopen($file_path, "r");
					$numberlines = 0;
					while ($line = fgetcsv($handle, 16384)) {
						$numberlines++;
						if ($numberlines > MAX_IMPORT_LINES+1) {
							$ftp_type = 3;
						}
					}
					if (filesize($file_path) > (1100000*MAX_MB_FILE_SIZE_ALLOWED) && $numberlines <= MAX_IMPORT_LINES+1) {
						$ftp_type = 2;
					}
				}
				echo $ftp_type;
			} else if ($option == "import_temporary") {
				$path = EDIRECTORY_ROOT."/custom/domain_".$domain_id."/import_files";
				$file_name_csv = $path."/".$file_name.".csv";
				$file_name = $path."/".$file_name.".txt";
				$file = fopen($file_name, "r");
				while (($line = fgets($file)) !== false) {
					$db->query($line);
				}

				$importlog = new ImportLog($log_id, $domain_id);
				if ($importlog->getNumber("id") != 0) {
					$importlog->setString("mysqlerror", $db->mysql_error);
					if (!$db->mysql_error) {
						@unlink($file_name_csv);
						@unlink($file_name);

						/*
						* Import Schedule
						*/
						$sqlCron = "UPDATE `Control_Import_Listing` SET `scheduled` = 'Y' WHERE `domain_id` = ".$domain_id;
						$dbObj->Query($sqlCron);
					} else {
						$importlog->setString("status", "E");
						$importlog->setString("action", "D");
						$importlog->setHistory("LANG_MSG_IMPORT_ERRORONIMPORTTOTEMPABLE");
						echo "ERROR";
					}
					$importlog->Save();
				} else {
					echo "ERROR";
				}
			} else if ($option == "verify_temporary") {
				$sql = "SELECT COUNT(id) as total FROM ImportTemporary WHERE import_log_id = ".$log_id;
				$result = $db->query($sql);
				$row = mysql_fetch_assoc($result);

				$sqlL = "SELECT `id`, `date`, `time`, `filename`, `linesadded`, `phisicalname`, `status`, `action`, `progress`, `totallines`, `history`, `update_itens`, `delimiter`, `mysqlerror` FROM `ImportLog` WHERE `id` = ".$log_id." AND type = 'listing'";
				$resultL = $db->query($sqlL);
				$rowL = mysql_fetch_assoc($resultL);

				if ($rowL["mysqlerror"]) $error = 1;
				else $error = 0;

				$perc = 0;
				$perc = round((100*$row["total"])/$total_lines);
				$import_logAux = new ImportLog($rowL, $domain_id);
				if ($error) $import_logAux->setHistory("LANG_MSG_IMPORT_ERRORONIMPORTTOTEMPABLE");
				else if ($perc >= 100) $import_logAux->setHistory("LANG_MSG_IMPORT_CSVIMPORTEDTOTEMPORARYTABLE");
				$import_logAux->Save();

				echo $perc."||".$error;
			} else if ($option == "verify_import") {

				$arrayImport = import_getRunningImports($domain_id);

				if (is_array($arrayImport)){

					if ($arrayImport["status"] == "R"){
						$progressNumber = str_replace("%", "", $arrayImport["progress"]);
						echo $arrayImport["id"]."||".$progressNumber."||".$arrayImport["linesadded"];
					} else {
						echo "waiting cron"."||".$arrayImport["pending_imports"]."||".$arrayImport["last_importlog"]."||".$arrayImport["last_importlog_status"]."||NR";
					}
				} else {
					$sql = "SELECT `last_importlog` FROM Control_Import_Listing WHERE domain_id = ".$domain_id;
					$result = $dbObj->Query($sql);
					$row = mysql_fetch_assoc($result);

					$sql = "SELECT status, `action` FROM ImportLog WHERE id =".$row["last_importlog"]." AND type = 'listing'";
					$result = $db->Query($sql);
					$rowLog = mysql_fetch_assoc($result);

					echo "no pending process||".$row["last_importlog"]."||100||".$arrayImport."||".$rowLog["status"]."||".$rowLog["action"];
				}
			} else if ($option == "reload_fileList") {
				$fileInfo = import_reloadFileList($domain_id);
				import_renderFileList($fileInfo, true);
			}
		}
	} else if ($_GET["id"]) {
		$importlog = new ImportLog($_GET["id"]);
		$urlFileName = IMPORT_URL."/preview_".str_replace(".csv", ".php", $importlog->getString("phisicalname"));
		$file_Name = IMPORT_FOLDER."/preview_".str_replace(".csv", ".php", $importlog->getString("phisicalname"));
		$import_action = $importlog->getString("action");
		if (!file_exists($file_Name)) {
			$urlFileName = "";
			$messageErrorUpload = system_showText(LANG_SITEMGR_MSGERROR_FILENOTEXISTS);
		}
	}
	if (string_strpos($_SERVER["PHP_SELF"], "/import.php") !== false) {
		$fileInfo = import_reloadFileList();
	}
?>