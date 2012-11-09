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
	# * FILE: /includes/code/event.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	$language_numbers = explode(",", EDIR_LANGUAGENUMBERS);

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		##################################################
		### KEYWORDS
		##################################################
		foreach ($language_numbers as $i) {
			$labelsuffix = $i;
			unset($arr_keywords);
			unset($each_keyword);
			unset($aux_kw);
			unset($new_arr_keywords);
			unset($aux_keywords);
			$arr_keywords = explode("\n", ${"keywords".$labelsuffix});
			foreach ($arr_keywords as $each_keyword) {
				$aux_kw = trim($each_keyword);
				if (string_strlen($aux_kw) > 0) {
					$new_arr_keywords[] = $aux_kw;
				}
			}
			if ($new_arr_keywords) $aux_keywords = implode(" || ", $new_arr_keywords);
			$_POST["keywords".$labelsuffix] = $aux_keywords;
			$_POST["array_keywords".$labelsuffix] = $new_arr_keywords;
		}
		##################################################

		$_POST["title"] = trim($_POST["title"]);

		foreach ($language_numbers as $i) {
			$labelsuffix = $i;
			// strip \r chars provided by Windows, in order to keep character count standard
            if ($_POST["description".$labelsuffix]) {
                $_POST["description".$labelsuffix] = str_replace("\r", "", $_POST["description".$labelsuffix]);
            }
		}

		$_POST["email"] = trim($_POST["email"]);
		$_POST["url"] = trim($_POST["url"]);
		$_POST["title"] = preg_replace('/\s\s+/', ' ', $_POST["title"]);
		$_POST["friendly_url"] = str_replace(".htm", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = str_replace(".html", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = trim($_POST["friendly_url"]);
		$sqlFriendlyURL = "";
		$sqlFriendlyURL .= " SELECT friendly_url FROM Event WHERE friendly_url = ".db_formatString($_POST["friendly_url"])." ";
		if ($id) $sqlFriendlyURL .= " AND id != $id ";
		$sqlFriendlyURL .= " LIMIT 1 ";
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObjFriendlyURL = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		$resultFriendlyURL = $dbObjFriendlyURL->query($sqlFriendlyURL);
		if (mysql_num_rows($resultFriendlyURL) > 0) {
			if ($id) $_POST["friendly_url"] = $_POST["friendly_url"].FRIENDLYURL_SEPARATOR.$id;
			else $_POST["friendly_url"] = $_POST["friendly_url"].FRIENDLYURL_SEPARATOR.uniqid();
		} 
        if (!$id && !$_POST["friendly_url"]) {
            $_POST["friendly_url"] = uniqid(); 
        }
       
		$str_dayofweek = "";
		for ($i=0; $i<7; $i++){
			if ($_POST["dayofweek_$i"]){
				$str_dayofweek .= ($i+1).",";
			}
		}
		if ($str_dayofweek){
			$str_dayofweek = string_substr($str_dayofweek,0,-1);
			$_POST["dayofweek"] = $str_dayofweek;
		}

		$str_numberofweek = "";
		for ($i=0; $i<5; $i++){
			if ($_POST["numberofweek_$i"]){
				$str_numberofweek .= ($i+1).",";
			}
		}
		if ($str_numberofweek){
			$str_numberofweek = string_substr($str_numberofweek,0,-1);
			$_POST["week"] = $str_numberofweek;
		}

		if ($_POST["period"] == "weekly"){
			$_POST["week"] = "";
		} elseif ($_POST["period"] == "monthly") {
			$_POST["month"] = "";
		}

		if ($_POST["recurring"]){
			if ($_POST["eventPeriod"] == "ever"){
				$_POST["repeat_event"] = "Y";
			} else if ($_POST["eventPeriod"] == "until"){
				$_POST["repeat_event"] = "N";
			}
		}

		if ((validate_form("event", $_POST, $message_event,$_POST["categories"])) && is_valid_discount_code($_POST["discount_id"], "event", $_POST["id"], $message_event, $discount_error_num)) {
				
			// adding new locations if posted
			if ($_POST["new_location2_field"] != "" || $_POST["new_location3_field"] != "" || $_POST["new_location4_field"] != "" || $_POST["new_location5_field"] != "") {

				$locationsToSave = array();

				$_locations = explode(",", EDIR_LOCATIONS);
				$_defaultLocations = explode (",", EDIR_DEFAULT_LOCATIONS);
				$_nonDefaultLocations = array_diff_assoc($_locations, $_defaultLocations);

				foreach ($_defaultLocations as $defLoc)
					$locationsToSave[$defLoc] = $_POST["location_".$defLoc];

				$stop_insert_location = false;

				foreach ($_nonDefaultLocations as $nonDefLoc) {
					if (trim($_POST["location_".$nonDefLoc])!="")
						$locationsToSave[$nonDefLoc] = $_POST["location_".$nonDefLoc];
					else {
						if (!$stop_insert_location) {
							if (!$_POST['new_location'.$nonDefLoc.'_field']) {
								$stop_insert_location = true;
							} else {
								$objNewLocationLabel = "Location".$nonDefLoc;
								$objNewLocation = new $objNewLocationLabel;

								foreach ($locationsToSave as $level => $value)
									$objNewLocation->setString("location_".$level, $value);

								$objNewLocation->setString("name", $_POST['new_location'.$nonDefLoc.'_field']);
								$objNewLocation->setString("friendly_url", $_POST['new_location'.$nonDefLoc.'_friendly']);
								$objNewLocation->setString("default", "n");
								$objNewLocation->setString("featured", "n");

								$newLocationFlag = $objNewLocation->retrievedIfRepeated($_locations);
								if ($newLocationFlag) $objNewLocation->setNumber("id", $newLocationFlag);
								else $objNewLocation->Save();
								$_POST["location_".$nonDefLoc] = $objNewLocation->getNumber("id");
								$locationsToSave[$nonDefLoc]=$_POST["location_".$nonDefLoc];
							}
						}
					}
				}
			}	
            
			//updating event level to default level if current level is not active
            if (!$levelObj) {
                $levelObj = new EventLevel(EDIR_DEFAULT_LANGUAGE, true);
                $event = new Event($id);
                if ($levelObj->getActive($event->getNumber("level")) == 'n') {
                    $_POST["level"] = $levelObj->getDefaultLevel();    
                }
            }

	        // fixing url field if needed.
			if (trim($_POST["url"]) != "") {
				if (string_strpos($_POST["url"], "://") !== false) {
					$aux_url = explode("://", $_POST["url"]);
					$aux_url = $aux_url[1];
					$_POST["url"] = $aux_url;
				}
				$_POST["url"] = $_POST["url_protocol"] . $_POST["url"];
			}
          
            // setting seo_description and seo_keyword when member signup for an item
            if ( $members && $process == 'signup' ) {
                foreach ($language_numbers as $i) {
					$labelsuffix = $i;
                    (!isset($_POST["seo_description".$labelsuffix])) ? ($_POST["seo_description".$labelsuffix] = str_replace("\n", " ", $_POST["description".$labelsuffix])) : '';
                    (!isset($_POST["seo_keywords".$labelsuffix])) ? ($_POST["seo_keywords".$labelsuffix] = str_replace(" ||", ",", $_POST["keywords".$labelsuffix])) : '';
                    
                }
            }
            
            // removing linebreaks from seo_description
            if ( !$id ) {
               foreach ($language_numbers as $i) {
					$labelsuffix = $i;
                    ($_POST["seo_description".$labelsuffix] = str_replace("\n", " ", $_POST["seo_description".$labelsuffix]));
                }
            }

			$status = new ItemStatus();
			$event = new Event($id);
			$new_event = false;
			$update_event = false;

			/* security bug */
			if (string_strpos($url_base, "/members") !== false) {
				if ($event->getNumber("id")) {
					if ($event->getNumber("account_id") != sess_getAccountIdFromSession()) {
						header("Location: ".$url_base."/".EVENT_FEATURE_FOLDER."/".(($search_page) ? "search.php" : "index.php"));
						exit;
					}
				}
			}

			if ($start_time_hour && !$start_time_min){
				$start_time_min = "00";
			}
			if ($start_time_hour && $start_time_min && $start_time_am_pm) {
				$_POST["has_start_time"] = "y";
				$startTimeStr = "";
				if (($start_time_am_pm == "pm") && ($start_time_hour < 12)) $startTimeStr = 12 + $start_time_hour;
				elseif (($start_time_am_pm == "am") && ($start_time_hour == "12")) $startTimeStr = "00";
				else $startTimeStr = $start_time_hour;
				$startTimeStr .= ":".$start_time_min.":00";
				$_POST["start_time"] = $startTimeStr;
			} elseif ($start_time_hour && $start_time_min && !$start_time_am_pm) {
				$_POST["has_start_time"] = "y";
				$startTimeStr = "";
				$startTimeStr = $start_time_hour;
				$startTimeStr .= ":".$start_time_min.":00";
				$_POST["start_time"] = $startTimeStr;
			} else {
				$_POST["has_start_time"] = "n";
				$_POST["start_time"] = "00:00:00";
			}

			if ($end_time_hour && !$end_time_min){
				$end_time_min = "00";
			}
			if ($end_time_hour && $end_time_min && $end_time_am_pm) {
				$_POST["has_end_time"] = "y";
				$endTimeStr = "";
				if (($end_time_am_pm == "pm") && ($end_time_hour < 12)) $endTimeStr = 12 + $end_time_hour;
				elseif (($end_time_am_pm == "am") && ($end_time_hour == "12")) $endTimeStr = "00";
				else $endTimeStr = $end_time_hour;
				$endTimeStr .= ":".$end_time_min.":00";
				$_POST["end_time"] = $endTimeStr;
			} elseif ($end_time_hour && $end_time_min && !$end_time_am_pm) {
				$_POST["has_end_time"] = "y";
				$endTimeStr = "";
				$endTimeStr = $end_time_hour;
				$endTimeStr .= ":".$end_time_min.":00";
				$_POST["end_time"] = $endTimeStr;    
			} else {
				$_POST["has_end_time"] = "n";
				$_POST["end_time"] = "00:00:00";
			}

			if (!$event->getString("id") || $event->getString("id") == 0){
				$new_event = true;
				$aux_package_id = $_POST["package_id"];
				$_POST["package_id"] = 0;
				
				system_addItemGallery($gallery_hash, $_POST["title"], $galleryIDC, $image_id, $thumb_id);

				$message = 0;

				$event->makeFromRow($_POST);
				$event->setString("status", $status->getDefaultStatus());
				$emailNotification = true;					
				$event->setDate("renewal_date", "00/00/0000");
				$newest = "1";

				if (string_strpos($url_base, "/sitemgr") && $_POST["account_id"]) {
					system_renameGalleryImages($image_id, $thumb_id, $_POST["account_id"], $galleryIDC);
				}

				$_POST["package_id"] = $aux_package_id;

			} else {
				$update_event = true;

				$galleryIDC = $gallery_id;
				system_addItemGallery($gallery_hash, $_POST["title"], $gallery_id, $image_id, $thumb_id);
				$message = 1;
				$emailNotification = false;
				if ($event->getString("status") != $status->getDefaultStatus()) $emailNotification = true;

				//security issue
				unset($_POST["status"]);
				unset($_POST["renewal_date"]);

				if (!$event->hasRenewalDate()) {
					$_POST["renewal_date"] = "0000-00-00";
				}

				if (string_strpos($url_base, "/sitemgr")) {

					$_POST["status"] = $event->getString("status");

					if ($event->getNumber("account_id") != $_POST["account_id"] || $_POST["account_id"]) {
						$image_idT = $event->getNumber("image_id");
						$thumb_idT = $event->getNumber("thumb_id");

						system_renameGalleryImages($image_idT, $thumb_idT, $_POST["account_id"], $galleryIDC);
					}

				}else {
					$last_status = $event->getString("status");
				}

				if ($event->getNumber("level") != $_POST["level"]) $event->setDate("renewal_date", "00/00/0000");

				$event->makeFromRow($_POST);
			}

			if ($image_id) {
				$event->setNumber("image_id",$image_id);
				$event->setNumber("thumb_id",$thumb_id);
			}

			$levelObjTmp = new EventLevel(EDIR_DEFAULT_LANGUAGE, true);
			$levelsTmp = $levelObjTmp->getLevelValues();
			if (!in_array($event->getNumber("level"), $levelsTmp)) {
				$event->setNumber("level", $levelObjTmp->getDefaultLevel());
			}
			unset($levelObjTmp);
			unset($levelsTmp);				

			$event->Save();

			if ($_POST["from_advertise"]) {
				$accObj = new Account(sess_getAccountIdFromSession());
				$accObj->changeMemberStatus(true);

				$accDomain = new Account_Domain($accObj->getNumber("id"), SELECTED_DOMAIN_ID);
				$accDomain->Save();
				$accDomain->saveOnDomain($accObj->getNumber("id"), $accObj);
			}

			//setting gallery
			$event->setGalleries($galleryIDC);

			if (ZIPCODE_PROXIMITY == "on") {
				zipproximity_updateDB("Event", $event->getNumber("id"));
			}
            
            system_updateMaptuningDate("Event", $event->getNumber("id"), $maptuning_done);

			/**
			*
			* E-mail notify
			*
			******************************************************/
			$domain = new Domain(SELECTED_DOMAIN_ID);
			if ($event->getNumber("account_id") > 0) {
				if($message == 0) {
					$contactObj = new Contact($event->getNumber("account_id"));
					if($emailNotificationObj = system_checkEmail(SYSTEM_NEW_EVENT, $contactObj->getString("lang"))) {
						setting_get("sitemgr_send_email", $sitemgr_send_email);
						setting_get("sitemgr_email", $sitemgr_email);
						$sitemgr_emails = explode(",", $sitemgr_email);
						if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
						$subject = $emailNotificationObj->getString("subject");
						$body    = $emailNotificationObj->getString("body");
						$body = system_replaceEmailVariables($body,$event->getNumber('id'),'event');
						$subject = system_replaceEmailVariables($subject,$event->getNumber('id'),'event');
						$body    = str_replace("DEFAULT_URL", DEFAULT_URL, $body);
						$body	 = str_replace($_SERVER["HTTP_HOST"], $domain->getstring("url"), $body);
						$body = html_entity_decode($body);
						$subject = html_entity_decode($subject);
						$error = false;
						system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
					}
				}
			}
			if ($emailNotification) {
				if(!string_strpos($url_base, "/sitemgr")){
					$domain_url = DEFAULT_URL;
					$domain_url = str_replace($_SERVER["HTTP_HOST"],$domain->getstring("url"),$domain_url);
					setting_get("sitemgr_send_email",$sitemgr_send_email);
					setting_get("sitemgr_email",$sitemgr_email);
					$sitemgr_emails = explode(",",$sitemgr_email);
					setting_get("sitemgr_event_email",$sitemgr_event_email);
					$sitemgr_event_emails = explode(",",$sitemgr_event_email);
					$account = new Account($acctId);
					$contact = new Contact($acctId);
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
									The ".EVENT_FEATURE_NAME." \"".$event->getString("title")."\" was ". ((!$id) ? "created" : "changed") ." by the ".EVENT_FEATURE_NAME." administrator \"".system_showAccountUserName($account->getString("username"))."\" and needs to be revised by you.<br /><br />
									<a href=\"".$domain_url."/sitemgr/".EVENT_FEATURE_FOLDER."/".((!$id) ? "view" : "settings").".php?id=".$event->getNumber("id")."\" target=\"_blank\">".$domain_url."/sitemgr/".EVENT_FEATURE_FOLDER."/".((!$id) ? "view" : "settings").".php?id=".$event->getNumber("id")."</a><br /><br />
								</div>
							</body>
						</html>";
					setting_get("new_event_email", $new_event_email);
					setting_get("update_event_email", $update_event_email);
					$sentUp = 0;
					$sentNew = 0;
					if (string_strpos($sitemgr_msg,"created")) $sentNew = 1;
					if (string_strpos($sitemgr_msg,"changed")) $sentUp = 1;

					// sending e-mail to site manager
					$error = false;
					if ($update_event_email && $sentUp==1){ // sending e-mail to site manager if e-mails for updated itens is on
					if ($sitemgr_send_email == "on") {
						if ($sitemgr_emails[0]) {
							foreach ($sitemgr_emails as $sitemgr_email) {
								system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] ".string_ucwords(EVENT_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
							}
						}
					}
					if ($sitemgr_event_emails[0]) {
						foreach ($sitemgr_event_emails as $sitemgr_event_email) {
							system_mail($sitemgr_event_email, "[".EDIRECTORY_TITLE."] ".string_ucwords(EVENT_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_event_email>", "text/html", '', '', $error);
						}
					}
					}
					if ($new_event_email && $sentNew==1){ // sending e-mail to site manager if e-mails for new itens is on
					if ($sitemgr_send_email == "on") {
						if ($sitemgr_emails[0]) {
							foreach ($sitemgr_emails as $sitemgr_email) {
								system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] ".string_ucwords(EVENT_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
							}
						}
					}
					if ($sitemgr_event_emails[0]) {
						foreach ($sitemgr_event_emails as $sitemgr_event_email) {
							system_mail($sitemgr_event_email, "[".EDIRECTORY_TITLE."] ".string_ucwords(EVENT_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_event_email>", "text/html", '', '', $error);
						}
					}
					}
				}
			}
			/******************************************************/

			// setting categories
			$return_categories_array = explode(",", $return_categories);
			$event->setCategories($return_categories_array);

			/*
			 * Check if is bought package
			 */
			if($_POST["using_package"] == "y"){
				/*
				 * Check if exists package
				 */
				$packageObj = new Package();
				$array_package_offers = $packageObj->getPackagesByDomainID(SELECTED_DOMAIN_ID, "event", $event->level);
				$hasPackage = false;
				if ((is_array($array_package_offers)) and (count($array_package_offers)>0) and $array_package_offers[0]) {

					unset($array_info_package);
					$array_info_package["item_type"]		= "event";
					$array_info_package["item_id"]			= $event->getNumber("id");
					$array_info_package["item_name"]		= $event->getString("title");
					$array_info_package["item_friendly_ur"]	= $event->getString("friendly_url");
					$array_info_package["package_id"][0]	= $package_id;
					package_buying_package($array_info_package, false, true);

				}
			}

			if ($new_event){
				setting_get("event_approve_free", $event_approve_free);

				if (!$event_approve_free && !$event->needToCheckOut()){
					$event->setString("status", "A");
					$event->save();
				} 				
			}

			if (string_strpos($url_base, "/members") && $update_event) {
				setting_get("event_approve_updated", $event_approve_updated);
				if ($last_status == "A" && !$event->needToCheckOut() && !$event_approve_updated && $process != "signup"){
					$event->setString("status", "A");
					$event->save();
				}else if ($process == "signup"){
					$event->setString("status", $last_status);
					$event->save();
				}
			}

			header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?process=".$process."&newest=".$newest."&message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : ""));
			exit;
		}

		// removing slashes added if required
		$_POST = format_magicQuotes($_POST);
		$_GET  = format_magicQuotes($_GET);

		extract($_POST);
		extract($_GET);		

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];
	$gallery_hash = $_POST["gallery_hash"] ? $_POST["gallery_hash"] : "event".($id ? "_$id" : "")."_".uniqid(rand(), true);

	// Location General Defines
	$_non_default_locations = "";
	$_default_locations_info = "";
	if (EDIR_DEFAULT_LOCATIONS) {

		system_retrieveLocationsInfo ($_non_default_locations, $_default_locations_info);

		$last_default_location	  =	$_default_locations_info[count($_default_locations_info)-1]['type'];
		$last_default_location_id = $_default_locations_info[count($_default_locations_info)-1]['id'];

		if ($_non_default_locations) {
			$objLocationLabel = "Location".$_non_default_locations[0];
			${"Location".$_non_default_locations[0]} = new $objLocationLabel;
			${"Location".$_non_default_locations[0]}->SetString("location_".$last_default_location, $last_default_location_id);
			${"locations".$_non_default_locations[0]} = ${"Location".$_non_default_locations[0]}->retrieveLocationByLocation($last_default_location);
		}

	} else {
		$_non_default_locations = explode(",", EDIR_LOCATIONS);
		$objLocationLabel = "Location".$_non_default_locations[0];
		${"Location".$_non_default_locations[0]} = new $objLocationLabel;
		${"locations".$_non_default_locations[0]}  = ${"Location".$_non_default_locations[0]}->retrieveAllLocation();
	}
	// End Locaition General Defines

	if ($id) {
		
		if (string_strpos($url_base, "/members")) {
			$by_key = array("id", "account_id");
			$by_value = array(db_formatNumber($id), sess_getAccountIdFromSession());
			$event = db_getFromDB("event", $by_key, $by_value, 1, "", "object", SELECTED_DOMAIN_ID);
		} else {
			$event = db_getFromDB("event", "id", db_formatNumber($id), 1, "", "object", SELECTED_DOMAIN_ID);
		}

		if ((sess_getAccountIdFromSession() != $event->getNumber("account_id")) && (!string_strpos($url_base, "/sitemgr"))) {
			header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "" )."");
			exit;
		}

		if ($_SERVER['REQUEST_METHOD'] != "POST"){
			$event->extract();
        }

		if ($recurring == "Y"){
            if ($dayofweek and $month and $week) {
                $period = "yearly";
                $precision = "weekday";
            } elseif ($day) {
				if ($month) {
					$period = "yearly";
                    $precision = "day";

				} else {
					$period = "monthly";
					$precision = "day";
				}
			} elseif ($dayofweek) {
				if ($week) {
					$period = "monthly";
					$precision = "weekday";
				} else {
					$period = "weekly";
				}
			} else {
				$period = "daily";
			}
		}

		// Location defines begin for edit event
		$stop_search_locations = false;
		//if there is at least one non default location
		if ($_non_default_locations) {
			foreach($_non_default_locations as $_location_level) {
				system_retrieveLocationRelationship ($_non_default_locations, $_location_level, $_location_father_level, $_location_child_level);
				if (${'location_'.$_location_level} && $_location_child_level) {
					if (!$stop_search_locations) {
						$objLocationLabel = "Location".$_location_child_level;
						${"Location".$_location_child_level} = new $objLocationLabel;
						${"Location".$_location_child_level}->SetString("location_".$_location_level, ${"location_".$_location_level});
						${"locations".$_location_child_level} = ${"Location".$_location_child_level}->retrieveLocationByLocation($_location_level);
					} else 	${"locations".$_location_child_level} = "";
				} else $stop_search_locations = true;
			}
			unset ($_location_father_level);
			unset ($_location_child_level);
			unset ($_location_level);
		}
		// End Locations

		$galleries = db_getFromDBBySQL("gallery", "SELECT gallery_id FROM Gallery_Item WHERE item_id = ".$id." AND item_type = 'event ' ORDER BY id", "array", false, SELECTED_DOMAIN_ID);
		$gallery_id = $galleries[0]["gallery_id"];

		if (!$gallery_id){
			$gallery = new Gallery($id);
			$aux = array("account_id"=>0,"title"=>$title,"entered"=>"NOW()","updated"=>"now()");
			$gallery->makeFromRow($aux);
			$gallery->save();
			$event->setGalleries($gallery->getNumber("id"));
			$gallery_id = $gallery->getNumber("id");
			$sql = "INSERT INTO Gallery_Image (gallery_id,image_id,thumb_id,image_default) VALUES ($gallery_id,".$image_id.",".$thumb_id.",'y')";

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			$dbObj->query($sql);
		}

	} else {
		
		$event = new Event($id);
		$event->makeFromRow($_POST);

		if ($acctId) $account_id = $acctId; else $account_id = $account_id;

		// Location defines begin for add event		
		$stop_search_locations = false;		
		//if there is at least one non default location
		if ($_non_default_locations) {
			foreach($_non_default_locations as $_location_level) {
				if ($_POST["location_".$_location_level])
					${"location_".$_location_level} = $_POST["location_".$_location_level];
				else
					$stop_search_locations = true;
				system_retrieveLocationRelationship ($_non_default_locations, $_location_level, $_location_father_level, $_location_child_level);
				if (${'location_'.$_location_level} && $_location_child_level) {
					if (!$stop_search_locations) {
						$objLocationLabel = "Location".$_location_child_level;
						${"Location".$_location_child_level} = new $objLocationLabel;
						${"Location".$_location_child_level}->SetString("location_".$_location_level, ${"location_".$_location_level});
						${"locations".$_location_child_level} = ${"Location".$_location_child_level}->retrieveLocationByLocation($_location_level);
					} else 	${"locations".$_location_child_level} = "";
				} else $stop_search_locations = true;
			}
			unset ($_location_father_level);
			unset ($_location_child_level);
			unset ($_location_level);
		}		
		// End Locations
	}

	extract($_POST);
	extract($_GET);
    
    // Level
	$levelObj = new EventLevel(EDIR_DEFAULT_LANGUAGE, true);
	if ($level) {
		$levelArray[$levelObj->getLevel($level)] = $level;
	} else {
		$levelArray[$levelObj->getLevel($levelObj->getDefaultLevel())] = $levelObj->getDefaultLevel();
		$level = $levelObj->getDefaultLevel();
	}
    
    //Get fields according to level
    unset($array_fields);
    $array_fields = system_getFormFields("Event", $level);
    
    //Gallery and main image
    $levelMaxImages = $levelObj->getImages($level);
    $onlyMainImage = false;
    $hasMainImage = false;
    if (is_array($array_fields) && in_array("main_image", $array_fields) && $levelMaxImages == 0){ //level with only one main image, no gallery
       $onlyMainImage = true;
    }
    
    if (is_array($array_fields) && in_array("main_image", $array_fields)) {
        $hasMainImage = true;
    }
    
    $hasImage = false;
    if ($onlyMainImage) {
        $sess_id = $gallery_hash;
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        $sql = "SELECT image_id FROM Gallery_Temp WHERE sess_id = '$sess_id'";
        $result = $dbObj->query($sql);

        if ($row = mysql_fetch_assoc($result)) {
            $hasImage = true;
        } 

    } else {
        $hasImage = true;
    }

    //Categories
	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$categories = "";
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if ($return_categories) {
			$return_categories_array = explode(",", $return_categories);
			foreach ($return_categories_array as $each_category) {
				$categories[] = new EventCategory($each_category);
			}
		}
	} else {
		if (!$categories) if ($event) $categories = $event->getCategories();
	}
	if ($categories) {
		for ($i=0; $i<count($categories); $i++) {
			if ($categories[$i]->getString("title".$langIndex)) $arr_category[$i]["name"] = $categories[$i]->getString("title".$langIndex);
			elseif($categories[$i]->getString("title")) $arr_category[$i]["name"] = $categories[$i]->getString("title");
            else $arr_category[$i]["name"] = $categories[$i]->getString("title".EDIR_DEFAULT_LANGUAGENUMBER);
			$arr_category[$i]["value"] = $categories[$i]->getNumber("id");
			$arr_return_categories[] = $categories[$i]->getNumber("id");
		}
		if ($arr_return_categories) $return_categories = implode(",", $arr_return_categories);
		array_multisort($arr_category);
		$feedDropDown = "<select name='feed' id='feed' multiple size='5' style=\"width:500px\">";
		if ($arr_category) foreach ($arr_category as $each_category) {
			$feedDropDown .= "<option value='".$each_category["value"]."'>".$each_category["name"]."</option>";
			$feedAjaxCategory[] = $each_category["value"];
		}
		$feedDropDown .= "</select>";
	} else {
		if ($return_categories) {
			$return_categories_array = explode(",", $return_categories);
			if ($return_categories_array) {
				foreach ($return_categories_array as $each_category) {
					$categories[] = new EventCategory($each_category);
				}
			}
		}
		$feedDropDown = "<select name='feed' id='feed' multiple size='5' style=\"width:500px\">";
		if ($categories) {
			foreach ($categories as $category) {
				if ($category->getString("title".$langIndex)) $name = $category->getString("title".$langIndex);
				else $name = $category->getString("title");
				$feedDropDown .= "<option value='".$category->getNumber("id")."'>$name</option>";
				$feedAjaxCategory[] = $category->getNumber("id");
			}
		}
		$feedDropDown .= "</select>";
	}
    
    //Start/End Time
	if ($has_start_time == "y") {
		$startTimeStr = explode(":", $start_time);
        if (CLOCK_TYPE == '24') {
            $start_time_hour = $startTimeStr[0];    
        } elseif (CLOCK_TYPE == '12') {    
		    if ($startTimeStr[0] > "12") {
			    $start_time_hour = $startTimeStr[0] - 12;
			    $start_time_am_pm = "pm";
		    } elseif ($startTimeStr[0] == "12") {
			    $start_time_hour = 12;
			    $start_time_am_pm = "pm";
		    } elseif ($startTimeStr[0] == "00") {
			    $start_time_hour = 12;
			    $start_time_am_pm = "am";
		    } else {
			    $start_time_hour = $startTimeStr[0];
			    $start_time_am_pm = "am";
		    }
        }
		if ($start_time_hour < 10) $start_time_hour = "0".$start_time_hour;
		$start_time_min = $startTimeStr[1];
	}

	if ($has_end_time == "y") {
		$endTimeStr = explode(":", $end_time);
        if (CLOCK_TYPE == '24') {
            $end_time_hour = $endTimeStr[0];    
        } elseif (CLOCK_TYPE == '12') {
		    if ($endTimeStr[0] > "12") {
			    $end_time_hour = $endTimeStr[0] - 12;
			    $end_time_am_pm = "pm";
		    } elseif ($endTimeStr[0] == "12") {
			    $end_time_hour = 12;
			    $end_time_am_pm = "pm";
		    } elseif ($endTimeStr[0] == "00") {
			    $end_time_hour = 12;
			    $end_time_am_pm = "am";
		    } else {
			    $end_time_hour = $endTimeStr[0];
			    $end_time_am_pm = "am";
		    }
        }
		if ($end_time_hour < 10) $end_time_hour = "0".$end_time_hour;
		$end_time_min = $endTimeStr[1];
	}

    $sthArray24h = Array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "00");
    $ethArray24h = Array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "00");
	$sthArray = Array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
	$stmArray = Array("00", "05", "10", "15", "20", "25", "30", "35", "40", "45", "50", "55");
	$ethArray = Array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
	$etmArray = Array("00", "05", "10", "15", "20", "25", "30", "35", "40", "45", "50", "55");
    
    if (CLOCK_TYPE == '24') {
        
        $start_time_hour_DD = html_selectBox("start_time_hour", $sthArray24h, $sthArray24h, $start_time_hour, "", "style='width: 50px;'", "--");
        $start_time_min_DD = html_selectBox("start_time_min", $stmArray, $stmArray, $start_time_min, "", "style='width: 50px;'", "--");
        $end_time_hour_DD = html_selectBox("end_time_hour", $ethArray24h, $ethArray24h, $end_time_hour, "", "style='width: 50px;'", "--");
        $end_time_min_DD = html_selectBox("end_time_min", $etmArray, $etmArray, $end_time_min, "", "style='width: 50px;'", "--");
        
    } elseif (CLOCK_TYPE == '12') {
        
	    $start_time_hour_DD = html_selectBox("start_time_hour", $sthArray, $sthArray, $start_time_hour, "", "style='width: 50px;'", "--");
	    $start_time_min_DD = html_selectBox("start_time_min", $stmArray, $stmArray, $start_time_min, "", "style='width: 50px;'", "--");
	    $end_time_hour_DD = html_selectBox("end_time_hour", $ethArray, $ethArray, $end_time_hour, "", "style='width: 50px;'", "--");
	    $end_time_min_DD = html_selectBox("end_time_min", $etmArray, $etmArray, $end_time_min, "", "style='width: 50px;'", "--");
        
    }

    //Keywords
	foreach ($language_numbers as $i) {
		$labelsuffix = $i;
		unset($arr_keywords);
		if ($_POST["keywords".$labelsuffix]) {
			$arr_keywords = explode(" || ", $_POST["keywords".$labelsuffix]);
			${"keywords".$labelsuffix} = implode("\n", $arr_keywords);
		} elseif ($event->getString("keywords".$labelsuffix)) {
			$arr_keywords = explode(" || ", $event->getString("keywords".$labelsuffix));
			${"keywords".$labelsuffix} = implode("\n", $arr_keywords);
		}
	}
    
    //Map Control
    $loadMap = false;
    $mapObj = new GoogleSettings(GOOGLE_MAPS_STATUS, $_SERVER["HTTP_HOST"]);
    if (GOOGLE_MAPS_ENABLED == "on" && $mapObj->getString("value") == "on"){
      $loadMap = true; 
      $formLoadMap = "document.form_event";
      
      $hasValidCoord = false;
      
      if ($latitude && $longitude && is_numeric($latitude) && is_numeric($longitude)){
          $hasValidCoord = true;
      }
      
      if (!$id || $hasValidCoord){
          $_COOKIE['showMapForm'] = 0;
      }
    }
    
?>