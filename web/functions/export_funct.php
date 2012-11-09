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
	# * FILE: /functions/export_funct.php
	# ----------------------------------------------------------------------------------------------------

	function export_formatToCSV($field) {
		$field = str_replace("\n\r", "", $field);
		$field = str_replace("\r\n", "", $field);
		$field = str_replace("\n", "", $field);
		$field = str_replace("\r", "", $field);
		$field = str_replace("'", "\'", $field);
		$field = str_replace('"', '\"', $field);
		if (string_strpos($field, ",")) {
			$field = "\"".$field."\"";
		}
		
		if (!$field || $field == "0000-00-00" || $field == "0000-00-00 00:00:00" || (is_numeric($field) && round($field) == 0)) $field = "" ;
		
		return $field;
	}

	function export_progress($filename, $message) {
		if (!$handle = fopen($filename, "w")) {
			setting_get("sitemgr_email", $sitemgr_email);
			$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory] - Export Process", "Error: file open (".$filename.").", $sitemgr_email);
			$eDirMailerObj->send();
			exit;
		}
		if (fwrite($handle, $message) === false) {
			setting_get("sitemgr_email", $sitemgr_email);
			$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory] - Export Process", "Error: file write (".$filename.").", $sitemgr_email);
			$eDirMailerObj->send();
			exit;
		}
		if (!fclose($handle)) {
			setting_get("sitemgr_email", $sitemgr_email);
			$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory] - Export Process", "Error: file close (".$filename.").", $sitemgr_email);
			$eDirMailerObj->send();
			exit;
		}
	}

	
	function export_ExportToCSV($export_type = "listing", $file, $removecontrol, $id = false){
		if (!is_numeric($id) && !$id && $id <= 0) {
			echo "Invalid ID";
			exit;
		}
		
		if ($export_type == "listing"){
			$item_scalability = LISTING_SCALABILITY_OPTIMIZATION;
			$tableCron = "Control_Export_Listing";
			$tableModule = "Listing";
			$field1 = "total_listing_exported";
			$field2 = "last_listing_id";
			$levelType = "ListingLevel";
		} elseif($export_type == "event"){
			$item_scalability = EVENT_SCALABILITY_OPTIMIZATION;
			$tableCron = "Control_Export_Event";
			$tableModule = "Event";
			$field1 = "total_event_exported";
			$field2 = "last_event_id";
			$levelType = "EventLevel";
		} else {
			$item_scalability = LISTING_SCALABILITY_OPTIMIZATION;
			$tableCron = "Control_Export_Listing";
			$tableModule = "Listing";
			$field1 = "total_listing_exported";
			$field2 = "last_listing_id";
			$levelType = "ListingLevel";
		}

		$dbObj = db_getDBObject(DEFAULT_DB, true);
		$dbObjSecond = db_getDBObjectByDomainID(defined("SELECTED_DOMAIN_ID")?	SELECTED_DOMAIN_ID : $id, $dbObj);
		if($item_scalability != "on" && !$file){
			echo "Need file name!";
			exit;
		}
		
		if($item_scalability == "on"){
			/*
			 * Check if needs run export
			 */
			$sql_check_export = "SELECT scheduled, filename FROM $tableCron WHERE domain_id = ".$id." AND scheduled = 'Y' AND type = 'csv'";
			$result_check_export = $dbObj->query($sql_check_export);
			if(mysql_num_rows($result_check_export)){
				
				
				$aux_array_file = mysql_fetch_assoc($result_check_export);
				$file = $aux_array_file["filename"];
				/*
				 * Check if is running cron
				 */
				$sql_check_running_cron = "SELECT running_cron FROM $tableCron WHERE domain_id = ".$id." AND type = 'csv'";
				$result_check = $dbObj->query($sql_check_running_cron);
				if(mysql_num_rows($result_check)){
					$row_check =  mysql_fetch_assoc($result_check);
					if($row_check["running_cron"] == "Y"){
						echo "Cron is running \n";
						exit;
					}else{
						$sql_update_check = "UPDATE $tableCron SET running_cron = 'Y' WHERE domain_id = ".$id." AND type = 'csv'";
						$dbObj->query($sql_update_check);
					}
				}else{
					echo "Invalid ID";
					exit;
				}
			}else{
				echo "Export doesnt scheduled";
				exit;
			}
			
		}
		
		
		if (!$file) {
			setting_get("sitemgr_email", $sitemgr_email);
			$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory] - Export Process", "Error: not get file.", $sitemgr_email);
			$eDirMailerObj->send();
			echo "Haven't file!";
			exit;
		}

		$filename = IMPORT_FOLDER."/export_".str_replace(".csv", "", $file).".progress";
	
		if ($removecontrol) {
	
			if (!unlink($filename)) {
				setting_get("sitemgr_email", $sitemgr_email);
				$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory] - Export Process", "Error: file unlink (".$filename.").", $sitemgr_email);
				$eDirMailerObj->send();
				exit;
			}
	
		} else {
	
			/*
			 * Check if need do a new file
			 */
			$sql_count = "SELECT COUNT(id) AS total FROM $tableModule";
			$result_count = $dbObjSecond->query($sql_count);
			
			if ($result_count) {
				if ($row_count = mysql_fetch_assoc($result_count)) {
					$item_amount = $row_count["total"];
				} else {
					export_progress($filename, system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 20006<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT));
					exit;
				}
			} else {
				export_progress($filename, system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 20005<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT));
				exit;
			}
			
			if($item_scalability == "on"){
			
				/*
				 * Get setting to do export
				 */
				$sql_settings = "SELECT id,
										last_run_date, 
								   		$field1, 
							   			$field2, 
							   			block,
							   			datediff(last_run_date, now()) as date_diff,
							   			finished,
							   			filename
									FROM $tableCron
									WHERE domain_id = ".$id." AND type = 'csv'";
				$result_settings = $dbObj->query($sql_settings);
				if(mysql_num_rows($result_settings)){
					$aux_add_header = true;
					$row_settings = mysql_fetch_assoc($result_settings);
					if($row_settings["finished"] == "Y"){
						$aux_add_header = true;
					}else{
						$aux_add_header = false;
					}
				}
			}else{
				$aux_add_header = true;
			}
		
			/*
			 * Writing header
			 */
			if($aux_add_header){
				
				export_progress($filename, "0");
		
				if ($export_type == "listing" || !$export_type){
					$handle = fopen(EDIRECTORY_ROOT."/sitemgr/import/edirectory_sample.csv", "r");
				} else {
					$handle = fopen(EDIRECTORY_ROOT."/sitemgr/import/edirectory_sample_event.csv", "r");
				}
				$sample_header = fgets($handle);
				fclose($handle);
		
				if ($export_type == "listing" || !$export_type){
					$export_header = "Account Username,Account Password,Account Contact First Name,Account Contact Last Name,Account Contact Company,Account Contact Address,Account Contact Address2,Account Contact Country,Account Contact State,Account Contact City,Account Contact Postal Code,Account Contact Phone,Account Contact Fax,Account Contact Email,Account Contact URL,Legacy ID,Listing ID,Listing Title,Listing Email,Listing URL,Listing Address,Listing Address2,Listing Country,Listing Country Abbreviation,Listing Region,Listing Region Abbreviation,Listing State,Listing State Abbreviation,Listing City,Listing City Abbreviation,Listing Neighborhood,Listing Neighborhood Abbreviation,Listing Postal Code,Listing Latitude,Listing Longitude,Listing Phone,Listing Fax,Listing Short Description,Listing Long Description,Listing Keywords,Updated Date,Listing Renewal Date,Listing Status,Listing Level,Listing Category 1,Listing Category 2,Listing Category 3,Listing Category 4,Listing Category 5,Listing Template\n";
				} elseif ($export_type == "event") {
					$export_header = "Account Username,Account Password,Account Contact First Name,Account Contact Last Name,Account Contact Company,Account Contact Address,Account Contact Address2,Account Contact Country,Account Contact State,Account Contact City,Account Contact Postal Code,Account Contact Phone,Account Contact Fax,Account Contact Email,Account Contact URL,Legacy ID,Event ID,Event Title,Event Email,Event URL,Event Address,Event Location Name,Event Contact Name,Event Start Date,Event End Date,Event Start Time,Start Time Mode,Event End Time,End Time Mode,Event Country,Event Country Abbreviation,Event Region,Event Region Abbreviation,Event State,Event State Abbreviation,Event City,Event City Abbreviation,Event Neighborhood,Event Neighborhood Abbreviation,Event Postal Code,Event Latitude,Event Longitude,Event Phone,Event Short Description,Event Long Description,Event Keywords,Updated Date,Event Renewal Date,Event Status,Event Level,Event Category 1,Event Category 2,Event Category 3,Event Category 4,Event Category 5\n";
				} 
				$sample_header_array = explode(",", $sample_header);
				$export_header_array = explode(",", $export_header);
				if (count($sample_header_array) != count($export_header_array)) {
					export_progress($filename, system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 20000<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT));
					exit;
				}
				for ($i = 0; $i < count($sample_header_array); $i++) {
					$sample_header_array[$i] = str_replace("\n\r", "", $sample_header_array[$i]);
					$sample_header_array[$i] = str_replace("\r\n", "", $sample_header_array[$i]);
					$sample_header_array[$i] = str_replace("\n", "", $sample_header_array[$i]);
					$sample_header_array[$i] = str_replace("\r", "", $sample_header_array[$i]);
					$export_header_array[$i] = str_replace("\n\r", "", $export_header_array[$i]);
					$export_header_array[$i] = str_replace("\r\n", "", $export_header_array[$i]);
					$export_header_array[$i] = str_replace("\n", "", $export_header_array[$i]);
					$export_header_array[$i] = str_replace("\r", "", $export_header_array[$i]);
					if ($sample_header_array[$i] != $export_header_array[$i]) {
						export_progress($filename, system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 20001<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT));
						exit;
					}
				}
		
				if($item_scalability == "on"){
					/*
					 * Save filename on table to continue on the next cicle of cron
					 */
					$sql_filename = "UPDATE $tableCron SET
											filename = '".$file."',
											$field1 = 0,
											last_run_date = NOW(),
											$field2 = 0,
											finished = 'N'
									  WHERE domain_id = ".$id." AND type = 'csv'";

					/*
					 * Aux to start new process
					 */
					$aux_total_item = 0;


					$dbObj->query($sql_filename);
				}

				if (!$handle = fopen(IMPORT_FOLDER."/".$file, "a")) {
					export_progress($filename, system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 20002<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT));
					exit;
				}
		
				if (fwrite($handle, $export_header) === false) {
					export_progress($filename, system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 20004<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT));
					exit;
				}
			}else{
				/*
				 * Aux to start new process
				 */
				$aux_total_item = $row_settings["$field1"];
				
				if (!$handle = fopen(IMPORT_FOLDER."/".$row_settings["filename"], "a")) {
					export_progress($filename, system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 20002<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT));
					exit;
				}
			}
			
			if($item_scalability == "on"){
				$i = $aux_total_item;
			}else{
				$i = 1;
			}
			$statusObj = new ItemStatus();
			$levelObj = new $levelType(EDIR_DEFAULT_LANGUAGE, false, $id);
	
			if ($export_type == "listing" || !$export_type){
				/*
				 * Get listings to export
				 */
					 $sql = "SELECT Listing_Summary.id as item_id,
								Listing_Summary.legacy_id as item_legacy_id,
								Listing_Summary.account_id as item_account_id,
								Listing_Summary.title as item_title,
								Listing_Summary.email as item_email,
								Listing_Summary.url as item_url,
								Listing_Summary.address as item_address,
								Listing_Summary.address2 as item_address2,
								Listing_Summary.location_1_title as item_location_1_title,
								Listing_Summary.location_1_abbreviation as item_location_1_abbreviation,
								Listing_Summary.location_2_title as item_location_2_title,
								Listing_Summary.location_2_abbreviation as item_location_2_abbreviation,
								Listing_Summary.location_3_title as item_location_3_title,
								Listing_Summary.location_3_abbreviation as item_location_3_abbreviation,
								Listing_Summary.location_4_title as item_location_4_title,
								Listing_Summary.location_4_abbreviation as item_location_4_abbreviation,
								Listing_Summary.location_5_title as item_location_5_title,
								Listing_Summary.location_5_abbreviation as item_location_5_abbreviation,
								Listing_Summary.zip_code as item_zip_code,
								Listing_Summary.latitude as item_latitude,
								Listing_Summary.longitude as item_longitude,
								Listing_Summary.phone as item_phone,
								Listing_Summary.fax as item_fax,
								Listing_Summary.description".EDIR_DEFAULT_LANGUAGENUMBER." as item_short_description,
								Listing_Summary.status as item_status,
								Listing_Summary.level as item_level,
								Listing_Summary.listingtemplate_id as item_template_id,
								Listing_Summary.template_title as item_template_title,
								Listing_Summary.updated as item_updated_date
							FROM Listing_Summary Listing_Summary";

				if($item_scalability == "on"){
					$sql .= " WHERE Listing_Summary.id > ".$row_settings["$field2"];
					$sql .= " ORDER BY Listing_Summary.id limit ".$row_settings["block"];
				}
			} elseif ($export_type == "event"){
				/*
				 * Get events to export
				 */
					 $sql = "SELECT Event.id as item_id,
								Event.legacy_id as item_legacy_id,
								Event.account_id as item_account_id,
								Event.title as item_title,
								Event.email as item_email,
								Event.url as item_url,
								Event.address as item_address,
								Event.location as item_location,
								Event.contact_name as item_contact_name,
								Event.start_date as item_start_date,
								Event.has_start_time as item_has_start_time,
								Event.start_time as item_start_time,
								Event.end_date as item_end_date,
								Event.has_end_time as item_has_end_time,
								Event.end_time as item_end_time,
								Event.location_1 as item_location_1,
								Event.location_2 as item_location_2,
								Event.location_3 as item_location_3,
								Event.location_4 as item_location_4,
								Event.location_5 as item_location_5,
								Event.zip_code as item_zip_code,
								Event.latitude as item_latitude,
								Event.longitude as item_longitude,
								Event.phone as item_phone,
								Event.description".EDIR_DEFAULT_LANGUAGENUMBER." as item_short_description,
								Event.long_description".EDIR_DEFAULT_LANGUAGENUMBER." as item_long_description,
								Event.keywords".EDIR_DEFAULT_LANGUAGENUMBER." as item_keywords,
								Event.renewal_date as item_renewal_date,
								Event.status as item_status,
								Event.level as item_level,
								Event.updated as item_updated_date
							FROM Event Event";

				if($item_scalability == "on"){
					$sql .= " WHERE Event.id > ".$row_settings["$field2"];
					$sql .= " ORDER BY Event.id limit ".$row_settings["block"];
				}
				
			}

	        $result = $dbObjSecond->query($sql);
			if ($result) {
	
				while (($row = mysql_fetch_assoc($result)) && ($i <= $item_amount)) {
					
					$account_username = "";
					$account_password = "";
					$account_contact_first_name = "";
					$account_contact_last_name = "";
					$account_contact_company = "";
					$account_contact_address = "";
					$account_contact_address2 = "";
					$account_contact_country = "";
					$account_contact_state = "";
					$account_contact_city = "";
					$account_contact_postal_code = "";
					$account_contact_phone = "";
					$account_contact_fax = "";
					$account_contact_email = "";
					$account_contact_url = "";
					$legacy_id = "";
					$item_id = "";
	                $item_title = "";
					$item_email = "";
					$item_url = "";
					$item_address = "";
					$item_address2 = ""; //for listings only
					$item_location = ""; //for events only
					$item_contact_name = ""; //for events only
					$item_start_date = ""; //for events only
					$item_end_date = ""; //for events only
					$item_start_time = ""; //for events only
					$item_end_time = ""; //for events only
					$item_location1 = "";
					$item_location1_abbreviation = "";
					$item_location2 = "";
					$item_location2_abbreviation = "";
					$item_location3 = "";
					$item_location3_abbreviation = "";
					$item_location4 = "";
					$item_location4_abbreviation = "";
					$item_location5 = "";
					$item_location5_abbreviation = "";
					$item_postal_code = "";
					$item_latitude = "";
					$item_longitude = "";
					$item_phone = "";
					$item_fax = ""; //for listings only
					$item_short_description = "";
					$item_long_description = "";
					$item_keywords = "";
					$item_updated_date = "";
					$item_renewal_date = "";
					$item_status = "";
					$item_level = "";
					$item_category_1 = "";
					$item_category_2 = "";
					$item_category_3 = "";
					$item_category_4 = "";
					$item_category_5 = "";
	                $item_template = ""; //for listings only
	
	                $item_id = $row['item_id'];
					
					if ($export_type == "listing") {
						/*
						 *  These fields above don't exists on the table Listing_Summary
						 */
						$sql2 = "
							SELECT long_description".EDIR_DEFAULT_LANGUAGENUMBER.",
									keywords".EDIR_DEFAULT_LANGUAGENUMBER.",
									renewal_date
								FROM Listing
								WHERE id = ".$item_id;
						$result2 = $dbObjSecond->query($sql2);

						if ($result2) {
							$row2 = mysql_fetch_assoc($result2);
							$item_long_description = export_formatToCSV($row2['long_description'.EDIR_DEFAULT_LANGUAGENUMBER]);
							$item_keywords = export_formatToCSV($row2['keywords'.EDIR_DEFAULT_LANGUAGENUMBER]);
							$item_renewal_date_aux = format_date($row2['renewal_date'], system_findTranslationFor("DEFAULT_DATE_FORMAT", EDIR_DEFAULT_LANGUAGE));
							$item_renewal_date = export_formatToCSV($item_renewal_date_aux);
						}
					} elseif ($export_type == "event"){
						
						//event long description and keywords
						$item_long_description = export_formatToCSV($row['item_long_description']);
						$item_keywords = export_formatToCSV($row['item_keywords']);
						
						//event renewal date
						$item_renewal_date_aux = format_date($row['item_renewal_date'], system_findTranslationFor("DEFAULT_DATE_FORMAT", EDIR_DEFAULT_LANGUAGE));
						$item_renewal_date = export_formatToCSV($item_renewal_date_aux);
						
						//event start date
						$item_start_date_aux = format_date($row['item_start_date'], system_findTranslationFor("DEFAULT_DATE_FORMAT", EDIR_DEFAULT_LANGUAGE));
						$item_start_date = export_formatToCSV($item_start_date_aux);
						
						//event end date
						$item_end_date_aux = format_date($row['item_end_date'], system_findTranslationFor("DEFAULT_DATE_FORMAT", EDIR_DEFAULT_LANGUAGE));
						$item_end_date = export_formatToCSV($item_end_date_aux);
						
						//event categories
						$sql = "SELECT cat_1_id, parcat_1_level1_id, parcat_1_level2_id, parcat_1_level3_id, parcat_1_level4_id, cat_2_id, parcat_2_level1_id, parcat_2_level2_id, parcat_2_level3_id, parcat_2_level4_id, cat_3_id, parcat_3_level1_id, parcat_3_level2_id, parcat_3_level3_id, parcat_3_level4_id, cat_4_id, parcat_4_level1_id, parcat_4_level2_id, parcat_4_level3_id, parcat_4_level4_id, cat_5_id, parcat_5_level1_id, parcat_5_level2_id, parcat_5_level3_id, parcat_5_level4_id FROM Event WHERE id = ".$item_id."";
						$resultCategory = $dbObjSecond->query($sql);
						if ($resultCategory) {
							$rowCategory = mysql_fetch_assoc($resultCategory);
							for ($event_category_count=1; $event_category_count<=5; $event_category_count++) {
								unset($event_category_aux);
								$event_category_aux = "";
								if ($rowCategory["parcat_".$event_category_count."_level4_id"] > 0) {
									$sql = "SELECT title".EDIR_DEFAULT_LANGUAGENUMBER." as title FROM EventCategory WHERE id = ".$rowCategory["parcat_".$event_category_count."_level4_id"]."";
									$resultCategoryTitle = $dbObjSecond->query($sql);
									if ($resultCategoryTitle) {
										if ($rowCategoryTitle = mysql_fetch_assoc($resultCategoryTitle)) {
											$event_category_aux .= $rowCategoryTitle["title"]."->";
										}
									}
								}
								if ($rowCategory["parcat_".$event_category_count."_level3_id"] > 0) {
									$sql = "SELECT title".EDIR_DEFAULT_LANGUAGENUMBER." as title FROM EventCategory WHERE id = ".$rowCategory["parcat_".$event_category_count."_level3_id"]."";
									$resultCategoryTitle = $dbObjSecond->query($sql);
									if ($resultCategoryTitle) {
										if ($rowCategoryTitle = mysql_fetch_assoc($resultCategoryTitle)) {
											$event_category_aux .= $rowCategoryTitle["title"]."->";
										}
									}
								}
								if ($rowCategory["parcat_".$event_category_count."_level2_id"] > 0) {
									$sql = "SELECT title".EDIR_DEFAULT_LANGUAGENUMBER." as title FROM EventCategory WHERE id = ".$rowCategory["parcat_".$event_category_count."_level2_id"]."";
									$resultCategoryTitle = $dbObjSecond->query($sql);
									if ($resultCategoryTitle) {
										if ($rowCategoryTitle = mysql_fetch_assoc($resultCategoryTitle)) {
											$event_category_aux .= $rowCategoryTitle["title"]."->";
										}
									}
								}
								if ($rowCategory["parcat_".$event_category_count."_level1_id"] > 0) {
									$sql = "SELECT title".EDIR_DEFAULT_LANGUAGENUMBER." as title FROM EventCategory WHERE id = ".$rowCategory["parcat_".$event_category_count."_level1_id"]."";
									$resultCategoryTitle = $dbObjSecond->query($sql);
									if ($resultCategoryTitle) {
										if ($rowCategoryTitle = mysql_fetch_assoc($resultCategoryTitle)) {
											$event_category_aux .= $rowCategoryTitle["title"]."->";
										}
									}
								}
								if ($rowCategory["cat_".$event_category_count."_id"] > 0) {
									$sql = "SELECT title".EDIR_DEFAULT_LANGUAGENUMBER." as title FROM EventCategory WHERE id = ".$rowCategory["cat_".$event_category_count."_id"]."";
									$resultCategoryTitle = $dbObjSecond->query($sql);
									if ($resultCategoryTitle) {
										if ($rowCategoryTitle = mysql_fetch_assoc($resultCategoryTitle)) {
											$event_category_aux .= $rowCategoryTitle["title"];
										}
									}
								}
								${"item_category_".$event_category_count} = export_formatToCSV($event_category_aux);
							}
						}
						
						//event start/end time
						if ($row['item_has_start_time'] == "y") {
							$startTimeStr = explode(":", $row['item_start_time']);
							if (CLOCK_TYPE == '24') {
								$start_time_hour = $startTimeStr[0];
								$start_time_mode = "24";
							} elseif (CLOCK_TYPE == '12') {
								if ($startTimeStr[0] > "12") {
									$start_time_hour = $startTimeStr[0] - 12;
									$start_time_mode = "PM";
								} elseif ($startTimeStr[0] == "12") {
									$start_time_hour = 12;
									$start_time_mode = "PM";
								} elseif ($startTimeStr[0] == "00") {
									$start_time_hour = 12;
									$start_time_mode = "AM";
								} else {
									$start_time_hour = $startTimeStr[0];
									$start_time_mode = "AM";
								}
							}
							if ($start_time_hour < 10) $start_time_hour = "0".$start_time_hour;
							$start_time_min = $startTimeStr[1];
							$item_start_time = export_formatToCSV($start_time_hour.":".$start_time_min);
							$item_start_time_mode = export_formatToCSV($start_time_mode);
						}

						if ($row['item_has_end_time'] == "y") {
							$endTimeStr = explode(":", $row['item_end_time']);
							if (CLOCK_TYPE == '24') {
								$end_time_hour = $endTimeStr[0];
								$end_time_mode = "24";
							} elseif (CLOCK_TYPE == '12') {
								if ($endTimeStr[0] > "12") {
									$end_time_hour = $endTimeStr[0] - 12;
									$end_time_mode = "PM";
								} elseif ($endTimeStr[0] == "12") {
									$end_time_hour = 12;
									$end_time_mode = "PM";
								} elseif ($endTimeStr[0] == "00") {
									$end_time_hour = 12;
									$end_time_mode = "AM";
								} else {
									$end_time_hour = $endTimeStr[0];
									$end_time_mode = "AM";
								}
							}
							if ($end_time_hour < 10) $end_time_hour = "0".$end_time_hour;
							$end_time_min = $endTimeStr[1];
							$item_end_time = export_formatToCSV($end_time_hour.":".$end_time_min);
							$item_end_time_mode = export_formatToCSV($end_time_mode);
						}
						
						//event locations
						$locations = explode (",", EDIR_LOCATIONS);
						
						foreach ($locations as $location_level){
							if ($row["item_location_$location_level"]) {
								$sql = "SELECT name, abbreviation  FROM Location_$location_level WHERE id = ".$row["item_location_$location_level"]."";
								$resultLoc = $dbObj->query($sql);
								if ($resultLoc) {
									if ($rowLoc = mysql_fetch_assoc($resultLoc)) {
										${"item_location".$location_level} = export_formatToCSV($rowLoc["name"]);
										${"item_location".$location_level."_abbreviation"} = export_formatToCSV($rowLoc["abbreviation"]);
									}
								}
							}
						}
					}
	                /****************************************************************/
					$updated_date_aux = format_date($row["item_updated_date"], system_findTranslationFor("DEFAULT_DATE_FORMAT", EDIR_DEFAULT_LANGUAGE));

	                $row["item_legacy_id"] ? $legacy_id = export_formatToCSV($row["item_legacy_id"]) : $legacy_id = export_formatToCSV("");
	                $item_id_export					= export_formatToCSV($item_id);
	                $item_updated_date				= export_formatToCSV($updated_date_aux);
	                $item_title						= export_formatToCSV($row["item_title"]);
					$item_email						= export_formatToCSV($row["item_email"]);
					$item_url						= export_formatToCSV($row["item_url"]);
					$item_address					= export_formatToCSV($row["item_address"]);
					$item_address2					= export_formatToCSV($row["item_address2"]);
					$item_location					= export_formatToCSV($row["item_location"]);
					$item_contact_name				= export_formatToCSV($row["item_contact_name"]);
	                $item_postal_code				= export_formatToCSV($row["item_zip_code"]);
	                $item_latitude                  = export_formatToCSV($row["item_latitude"]);
	                $item_longitude                 = export_formatToCSV($row["item_longitude"]);
					$item_phone						= export_formatToCSV($row["item_phone"]);
					$item_fax						= export_formatToCSV($row["item_fax"]);
					$item_short_description			= export_formatToCSV($row["item_short_description"]);
	                $item_template					= export_formatToCSV($row["item_template_title"]);
	        		$item_status					= export_formatToCSV(string_strtolower($statusObj->getStatus($row["item_status"])));
					$item_level 					= export_formatToCSV(string_strtolower($levelObj->getLevel($row["item_level"])));
					if ($export_type == "listing") {
						$item_location1 				= export_formatToCSV($row["item_location_1_title"]);
						$item_location1_abbreviation	= export_formatToCSV($row["item_location_1_abbreviation"]);
						$item_location2 				= export_formatToCSV($row["item_location_2_title"]);
						$item_location2_abbreviation	= export_formatToCSV($row["item_location_2_abbreviation"]);
						$item_location3					= export_formatToCSV($row["item_location_3_title"]);
						$item_location3_abbreviation	= export_formatToCSV($row["item_location_3_abbreviation"]);
						$item_location4 				= export_formatToCSV($row["item_location_4_title"]);
						$item_location4_abbreviation	= export_formatToCSV($row["item_location_4_abbreviation"]);
						$item_location5 				= export_formatToCSV($row["item_location_5_title"]);
						$item_location5_abbreviation	= export_formatToCSV($row["item_location_5_abbreviation"]);
					}

					if ($row["item_account_id"]){
						$account = new Account($row["item_account_id"]);
						$row["account_username"] = $account->getString("username");
						$row["account_password"] = $account->getString("password");

						$contact = new Contact($row["item_account_id"]);
						$row["contact_first_name"] = $contact->getString("first_name");
						$row["contact_last_name"] = $contact->getString("last_name");
						$row["contact_company"] = $contact->getString("company");
						$row["contact_address"] = $contact->getString("address");
						$row["contact_address2"] = $contact->getString("address2");
						$row["contact_country"] = $contact->getString("country");
						$row["contact_state"] = $contact->getString("state");
						$row["contact_city"] = $contact->getString("city");
						$row["contact_zip"] = $contact->getString("zip");
						$row["contact_phone"] = $contact->getString("phone");
						$row["contact_fax"] = $contact->getString("fax");
						$row["contact_email"] = $contact->getString("email");
						$row["contact_url"] = $contact->getString("url");
					} else {
						$row["account_username"] = "";
						$row["account_password"] = "";
						$row["contact_first_name"] = "";
						$row["contact_last_name"] = "";
						$row["contact_company"] = "";
						$row["contact_address"] = "";
						$row["contact_address2"] = "";
						$row["contact_country"] = "";
						$row["contact_state"] = "";
						$row["contact_city"] = "";
						$row["contact_zip"] = "";
						$row["contact_phone"] = "";
						$row["contact_fax"] = "";
						$row["contact_email"] = "";
						$row["contact_url"] = "";
					}

					$account_username = export_formatToCSV($row["account_username"]);
					$account_password = export_formatToCSV($row["account_password"]);

	                $account_contact_first_name 	= export_formatToCSV($row["contact_first_name"]);
	                $account_contact_last_name 		= export_formatToCSV($row["contact_last_name"]);
	                $account_contact_company 		= export_formatToCSV($row["contact_company"]);
	                $account_contact_address 		= export_formatToCSV($row["contact_address"]);
	                $account_contact_address2 		= export_formatToCSV($row["contact_address2"]);
	                $account_contact_country 		= export_formatToCSV($row["contact_country"]);
	                $account_contact_state 			= export_formatToCSV($row["contact_state"]);
	                $account_contact_city 			= export_formatToCSV($row["contact_city"]);
	                $account_contact_postal_code 	= export_formatToCSV($row["contact_zip"]);
	                $account_contact_phone 			= export_formatToCSV($row["contact_phone"]);
	                $account_contact_fax 			= export_formatToCSV($row["contact_fax"]);
	                $account_contact_email 			= export_formatToCSV($row["contact_email"]);
	                $account_contact_url 			= export_formatToCSV($row["contact_url"]);
	
	                /*====================================================================================================*/
	
					if ($export_type == "listing") {
						/*
						* Get categories to export
						*/
						$sql_categories = "SELECT category_id FROM Listing_Category WHERE listing_id = ".$item_id;
						$result_categories = $dbObjSecond->query($sql_categories);

						if(mysql_num_rows($result_categories)){
							$listing_category_count=1;
							while($row_categories = mysql_fetch_assoc($result_categories)){
								unset($aux_array_category, $string_category, $categoryObj);
								$categoryObj = new ListingCategory($row_categories["category_id"]);
								$sql_category = "SELECT title".EDIR_DEFAULT_LANGUAGENUMBER."
													FROM ListingCategory
													WHERE root_id = ".$categoryObj->getNumber('root_id')." AND
														ListingCategory.left <= ".$categoryObj->getNumber("left")." AND
														ListingCategory.right >= ".$categoryObj->getNumber("right")."
													ORDER BY ListingCategory.left";
								$result_category = $dbObjSecond->query($sql_category);
								if(mysql_num_rows($result_category)){
									while($row_category = mysql_fetch_assoc($result_category)){
										$aux_array_category[] = $row_category["title".EDIR_DEFAULT_LANGUAGENUMBER];
									}
									$string_category = implode(" -> ",$aux_array_category);
								}
								${"item_category_".$listing_category_count} = export_formatToCSV($string_category);
								$listing_category_count++;

							}
						}
						
						$this_item_line = "".$account_username.",".$account_password.",".$account_contact_first_name.",".$account_contact_last_name.",".$account_contact_company.",".$account_contact_address.",".$account_contact_address2.",".$account_contact_country.",".$account_contact_state.",".$account_contact_city.",".$account_contact_postal_code.",".$account_contact_phone.",".$account_contact_fax.",".$account_contact_email.",".$account_contact_url.",".$legacy_id.",".$item_id_export.",".$item_title.",".$item_email.",".$item_url.",".$item_address.",".$item_address2.",".$item_location1.",".$item_location1_abbreviation.",".$item_location2.",".$item_location2_abbreviation.",".$item_location3.",".$item_location3_abbreviation.",".$item_location4.",".$item_location4_abbreviation.",".$item_location5.",".$item_location5_abbreviation.",".$item_postal_code.",".$item_latitude.",".$item_longitude.",".$item_phone.",".$item_fax.",".$item_short_description.",".$item_long_description.",".$item_keywords.",".$item_updated_date.",".$item_renewal_date.",".$item_status.",".$item_level.",".$item_category_1.",".$item_category_2.",".$item_category_3.",".$item_category_4.",".$item_category_5.",".$item_template."\n";
				
					} elseif ($export_type == "event"){
						$this_item_line = "".$account_username.",".$account_password.",".$account_contact_first_name.",".$account_contact_last_name.",".$account_contact_company.",".$account_contact_address.",".$account_contact_address2.",".$account_contact_country.",".$account_contact_state.",".$account_contact_city.",".$account_contact_postal_code.",".$account_contact_phone.",".$account_contact_fax.",".$account_contact_email.",".$account_contact_url.",".$legacy_id.",".$item_id_export.",".$item_title.",".$item_email.",".$item_url.",".$item_address.",".$item_location.",".$item_contact_name.",".$item_start_date.",".$item_end_date.",".$item_start_time.",".$item_start_time_mode.",".$item_end_time.",".$item_end_time_mode.",".$item_location1.",".$item_location1_abbreviation.",".$item_location2.",".$item_location2_abbreviation.",".$item_location3.",".$item_location3_abbreviation.",".$item_location4.",".$item_location4_abbreviation.",".$item_location5.",".$item_location5_abbreviation.",".$item_postal_code.",".$item_latitude.",".$item_longitude.",".$item_phone.",".$item_short_description.",".$item_long_description.",".$item_keywords.",".$item_updated_date.",".$item_renewal_date.",".$item_status.",".$item_level.",".$item_category_1.",".$item_category_2.",".$item_category_3.",".$item_category_4.",".$item_category_5."\n";
					}
	
					if ($item_title) {
						if (fwrite($handle, $this_item_line) === false) {
							export_progress($filename, system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 20008<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT));
							exit;
						}
					}
	
					export_progress($filename, floor($i/$item_amount*100));
	
					$i++;
					
					/*
					 * Save item_id to next cicle of cron
					 */
					if($item_scalability == "on"){
						unset($sql_settings_update);
						$sql_settings_update = "UPDATE $tableCron SET
														$field1 = ".$item_id.", 
														$field2 = $field2+1
													WHERE domain_id = ".$id." AND type = 'csv'";
						$dbObj->query($sql_settings_update);
					}
					
	
				}
				
				/*
				 * Change finished field if exported all itens
				 */
				if($item_scalability == "on"){
					if($i >= $item_amount){
						$sql_finished = "UPDATE $tableCron SET finished = 'Y', scheduled = 'N' WHERE domain_id =".$id." AND type = 'csv'";
						$dbObj->query($sql_finished);
						export_progress($filename, 100);
					}
				
					/*
					 * Save that this cicle finished
					 */
					$sql_cicle = "UPDATE $tableCron SET running_cron = 'N' WHERE domain_id = ".$id." AND type = 'csv'";
					$dbObj->query($sql_cicle);
					
				}else{
					if ($i < $item_amount || $item_amount == 0) {
						export_progress($filename, 100);
					}
				}
	
			} else {
				export_progress($filename, system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 20007<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT));
				exit;
			}
	
			if($handle){
				if (!fclose($handle)) {
					export_progress($filename, system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 20003<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT));
					exit;
				}
			}	
		}
		
	}
?>
