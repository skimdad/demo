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
	# * FILE: /includes/code/listing.php
	# ----------------------------------------------------------------------------------------------------

        # ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	$dbMain = db_getDBObject(DEFAULT_DB, true);
	$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

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
		$_POST["email"] = trim($_POST["email"]);
		$_POST["url"] = trim($_POST["url"]);
		$_POST["title"] = preg_replace('/\s\s+/', ' ', $_POST["title"]);
		$_POST["friendly_url"] = str_replace(".htm", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = str_replace(".html", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = trim($_POST["friendly_url"]);
		
		$sqlFriendlyURL = "";
		$sqlFriendlyURL .= " SELECT friendly_url FROM Listing WHERE friendly_url = ".db_formatString($_POST["friendly_url"])." ";
		if ($id) $sqlFriendlyURL .= " AND id != $id ";
		$sqlFriendlyURL .= " LIMIT 1 ";
		$resultFriendlyURL = $dbObj->query($sqlFriendlyURL);
		if (mysql_num_rows($resultFriendlyURL) > 0) { 
			if ($id) $_POST["friendly_url"] = $_POST["friendly_url"].FRIENDLYURL_SEPARATOR.$id;
			else $_POST["friendly_url"] = $_POST["friendly_url"].FRIENDLYURL_SEPARATOR.uniqid();
		} 
        if (!$id && !$_POST["friendly_url"]) {    
            $_POST["friendly_url"] = uniqid();  
        }
        
        $_POST["video_snippet"] = str_replace("\"", "'", $_POST["video_snippet"]);
		
		foreach ($language_numbers as $i) {
			$labelsuffix = $i;
			// strip \r chars provided by Windows, in order to keep character count standard
			if ($_POST["description".$labelsuffix]) {
                $_POST["description".$labelsuffix] = str_replace("\r", "", $_POST["description".$labelsuffix]);
			}
		}

		if($_POST["hours_work"]){
			$_POST["hours_work"] = str_replace("\r", "", $_POST["hours_work"]);
		}
		if($_POST["locations"]){
			$_POST["locations"] = str_replace("\r", "", $_POST["locations"]);
		}

		if ($_FILES['attachment_file']['name']) {
			$array_allowed_types = array('pdf','doc','txt','jpg','gif','png');
			$arr_attachment = explode(".",$_FILES['attachment_file']['name']);
			$attachment_extension = $arr_attachment[count($arr_attachment)-1];
			if (in_array(string_strtolower($attachment_extension),$array_allowed_types)) {
				$allow_attachment_file = "true";
			} else {
				$allow_attachment_file = "false";
			}
		}

		if ((validate_form("listing", $_POST, $message_listing,$_POST["categories"])) && is_valid_discount_code($_POST["discount_id"], "listing", $_POST["id"], $message_listing, $discount_error_num) && ($allow_attachment_file != "false")) {

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

			//updating listing level to default level if current level is not active
            if (!$levelObj) {
                $levelObj = new ListingLevel(EDIR_DEFAULT_LANGUAGE, true);
                $listing = new Listing($id);
                if ($levelObj->getActive($listing->getNumber("level")) == 'n') {
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

			// Clean Attachment
			if (($remove_attachment) || (file_exists($_FILES['attachment_file']['tmp_name']))) {
				if ($id) {
					$listing = new Listing($id);
					if ($id_attachment_file = $listing->getString("attachment_file")) {
						if (file_exists(EXTRAFILE_DIR."/".$id_attachment_file)) {
							@unlink(EXTRAFILE_DIR."/".$id_attachment_file);
						}
						$listing->setString("attachment_file", "");
						$_POST["attachment_file"] = "";
						$listing->save();
					}
					unset($listing);
				}
			}

			$status = new ItemStatus();
			$listing = new Listing($id);
			$new_listing = false;
			$update_listing = false;

			if (!$listing->getString("id") || $listing->getString("id") == 0){
				$new_listing = true;
				$aux_package_id = $_POST["package_id"];
				$_POST["package_id"] = 0;

				system_addItemGallery($gallery_hash, $_POST["title"], $galleryIDC, $image_id, $thumb_id);

				$message = 0;                
				$emailNotification = true;

				$newest = "1";

				$listingLevelObj = new ListingLevel(EDIR_DEFAULT_LANGUAGE, true);
				if ($listingLevelObj->getHasPromotion($_POST["level"]) == "y") $extramessage_promotion = "1";
				
				// the following code is added by Debiprasad Sahoo (Indibits) on 18th Aug., 2012
				for ($promo = 2; $promo <= 5; $promo++) {
					if ($_POST['extra_promotion'][$promo] != '1')
						break;
				}
				$_POST['extra_promotion'] = $promo - 1;

				$listing->makeFromRow($_POST);
				$listing->setString("status", $status->getDefaultStatus());													
				$listing->setDate("renewal_date", "00/00/0000"); 
				if (string_strpos($url_base, "/sitemgr") && $_POST["account_id"]) {
					system_renameGalleryImages($image_id, $thumb_id, $_POST["account_id"], $galleryIDC);
				}

				$_POST["package_id"] = $aux_package_id;

			} else {
				$update_listing = true;

				$galleryIDC = $gallery_id;
				system_addItemGallery($gallery_hash, $_POST["title"], $gallery_id, $image_id, $thumb_id);
				$message = 1;
				$emailNotification = false; 
				if ($listing->getString("status") != $status->getDefaultStatus()){ $emailNotification = true; }  

				//security issue
				unset($_POST["status"]);
				unset($_POST["renewal_date"]);

				if (!$listing->hasRenewalDate()) {
					$_POST["renewal_date"] = "0000-00-00";
				}

				if (string_strpos($url_base, "/sitemgr")) {

					$_POST["status"] = $listing->getString("status");

					if ($listing->getNumber("account_id") != $_POST["account_id"] || $_POST["account_id"]) {
                        if ($listing->getNumber("account_id") != $_POST["account_id"]){
                            if ($listing->getNumber("promotion_id") > 0){
                                // remove relationship if sitemgr change account
                                $listing->removePromotionID(); 
                            }
						}
                        
						$image_idT = $listing->getNumber("image_id");
						$thumb_idT = $listing->getNumber("thumb_id");

						system_renameGalleryImages($image_idT, $thumb_idT, $_POST["account_id"], $galleryIDC);
					}

				} else {
					$last_status = $listing->getString("status");
				}

				// the following code is added by Debiprasad Sahoo (Indibits) on 18th Aug., 2012
				for ($promo = 2; $promo <= 5; $promo++) {
					if ($_POST['extra_promotion'][$promo] != '1')
						break;
				}				
				$_POST['extra_promotion'] = $promo - 1;
				
				$listing->makeFromRow($_POST);
			}

			if ($image_id) {
				$listing->setNumber("image_id",$image_id);
				$listing->setNumber("thumb_id",$thumb_id);
			}

			if ($id) {
				if(!$members) {
					$lcObj = new ListingChoice();
					$lcObj->setNumber("listing_id", $id);
					$lcObj->Delete();
				} else {
					$choices = db_getFromDB("editor_choice", "available", 1, "all", "id", "object", SELECTED_DOMAIN_ID);
					if($choices) {
						foreach($choices as $choice) {
							$lcObj = new ListingChoice($choice->getNumber("id"), $id);
							$lcObj->DeleteAvailable();
						}
					}
				}
			}

			$levelObjTmp = new ListingLevel(EDIR_DEFAULT_LANGUAGE, true);
			$levelsTmp = $levelObjTmp->getLevelValues();
			if (!in_array($listing->getNumber("level"), $levelsTmp)) {
				$listing->setNumber("level", $levelObjTmp->getDefaultLevel());
			}
			unset($levelObjTmp);
			unset($levelsTmp);

			$listing->Save();

			if ($_POST["from_advertise"]) {
				$accObj = new Account(sess_getAccountIdFromSession());
				$accObj->changeMemberStatus(true);

				$accDomain = new Account_Domain($accObj->getNumber("id"), SELECTED_DOMAIN_ID);
				$accDomain->Save();
				$accDomain->saveOnDomain($accObj->getNumber("id"), $accObj);
			}

			//setting gallery
			$listing->setGalleries($galleryIDC);

			// ATTACHMENT FILE UPLOAD
			if ((file_exists($_FILES['attachment_file']['tmp_name']))) {
				$file_name = "attach_".$listing->getNumber("id").".".$attachment_extension;
				$listing->setString("attachment_file",$file_name);
				$file_path = EXTRAFILE_DIR."/".$file_name;
				if (filesize($_FILES['attachment_file']['tmp_name'])) {
					copy($_FILES['attachment_file']['tmp_name'],$file_path);
				} else {
					$listing->setString("attachment_file","");
					$msg_post_listing = 2;
				}
				$listing->Save();
			}

			if ($_POST['choice']) {
				foreach ($_POST['choice'] as $value) {
					$listingChoiceObj = new ListingChoice($value, $id);
					$listingChoiceObj->setNumber("editor_choice_id", $value);
					$listingChoiceObj->setNumber("listing_id", $listing->getNumber("id"));
					$listingChoiceObj->Save();
					unset($listingChoiceObj);
				}
			}

			if (ZIPCODE_PROXIMITY == "on") {
				zipproximity_updateDB("Listing", $listing->getNumber("id"));
				zipproximity_updateDB("Listing_Summary", $listing->getNumber("id"));
			}
            
            system_updateMaptuningDate("Listing", $listing->getNumber("id"), $maptuning_done);

			/**
			*
			* E-mail notify
			*
			******************************************************/
			$domain = new Domain(SELECTED_DOMAIN_ID);
			if ($listing->getNumber("account_id") > 0) {
				if($message == 0) {
					$contactObj = new Contact($listing->getNumber("account_id"));
					if($emailNotificationObj = system_checkEmail(SYSTEM_NEW_LISTING, $contactObj->getString("lang"))) {
						setting_get("sitemgr_send_email", $sitemgr_send_email);
						setting_get("sitemgr_email", $sitemgr_email);
						$sitemgr_emails = explode(",", $sitemgr_email);
						if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
						$subject = $emailNotificationObj->getString("subject");
						$body = $emailNotificationObj->getString("body");
						$body = system_replaceEmailVariables($body,$listing->getNumber('id'),'listing');
						$body	 = str_replace($_SERVER["HTTP_HOST"], $domain->getstring("url"), $body);
						$subject = system_replaceEmailVariables($subject,$listing->getNumber('id'),'listing');
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
					setting_get("sitemgr_listing_email",$sitemgr_listing_email);
					$sitemgr_listing_emails = explode(",",$sitemgr_listing_email);
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
									Site Manager,<br /><br />";
					setting_get("new_listing_email", $new_listing_email);
					setting_get("update_listing_email", $update_listing_email);
					$sentUp = 0;
					$sentNew = 0;
					$link_sitemgrmsg = "";
					if ($_POST["id"]) {
						$sitemgr_msg .= "The ".LISTING_FEATURE_FOLDER." \"".$listing->getString("title")."\" was changed by the administrator \"".system_showAccountUserName($account->getString("username"))."\" and needs to be revised by you.<br /><br />";
						$link_sitemgrmsg = "<a href=\"".$domain_url."/sitemgr/".LISTING_FEATURE_FOLDER."/settings.php?id=".$listing->getNumber("id")."\" target=\"_blank\">".$domain_url."/sitemgr/".LISTING_FEATURE_FOLDER."/settings.php?id=".$listing->getNumber("id")."</a><br /><br />";
						$sentUp = 1;

					} else {
						$sitemgr_msg .= "The ".LISTING_FEATURE_FOLDER." \"".$listing->getString("title")."\" was created by the administrator \"".system_showAccountUserName($account->getString("username"))."\" and needs to be revised by you.<br /><br />";
						$link_sitemgrmsg = "<a href=\"".$domain_url."/sitemgr/".LISTING_FEATURE_FOLDER."/view.php?id=".$listing->getNumber("id")."\" target=\"_blank\">".$domain_url."/sitemgr/".LISTING_FEATURE_FOLDER."/view.php?id=".$listing->getNumber("id")."</a><br /><br />";
						$sentNew = 1;
					}
					$sitemgr_msg .= $link_sitemgrmsg;
					$sitemgr_msg .= "
								</div>
							</body>
						</html>";
					// sending e-mail to site manager
					$error = false;

					if ($update_listing_email && $sentUp == 1){ // sending e-mail to site manager if e-mails for updated itens is on

						if ($sitemgr_send_email == "on") {
							if ($sitemgr_emails[0]) {
								foreach ($sitemgr_emails as $sitemgr_email) {
									system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] ".string_ucwords(LISTING_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <".$sitemgr_email.">", "text/html", '', '', $error);
									$sent=1;
								}
							}
						}
						if ($sitemgr_listing_emails[0]) {
							foreach ($sitemgr_listing_emails as $sitemgr_listing_email) {
								system_mail($sitemgr_listing_email, "[".EDIRECTORY_TITLE."] ".string_ucwords(LISTING_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <".$sitemgr_listing_email.">", "text/html", '', '', $error);
								$sent=1;
							}
						}
					}

					if ($new_listing_email && $sentNew == 1){ // sending e-mail to site manager if e-mails for new itens is on

						if ($sitemgr_send_email == "on") {
							if ($sitemgr_emails[0]) {
								foreach ($sitemgr_emails as $sitemgr_email) {
									system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] ".string_ucwords(LISTING_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <".$sitemgr_email.">", "text/html", '', '', $error);
									$sent=1;
								}
							}
						}
						if ($sitemgr_listing_emails[0]) {
							foreach ($sitemgr_listing_emails as $sitemgr_listing_email) {
								system_mail($sitemgr_listing_email, "[".EDIRECTORY_TITLE."] ".string_ucwords(LISTING_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <".$sitemgr_listing_email.">", "text/html", '', '', $error);
								$sent=1;
							}
						}
					}
				}
			}
			/******************************************************/

			// setting categories
			$return_categories_array = explode(",", $return_categories);
			$listing->setCategories($return_categories_array); // MUST BE ALWAYS AFTER $LISTINGOBJECT->SAVE();

			/*
			 * Check if is bought package
			 */
			if($_POST["using_package"] == "y"){
				/*
				 * Check if exists package
				 */
				$packageObj = new Package();
				$array_package_offers = $packageObj->getPackagesByDomainID(SELECTED_DOMAIN_ID, "listing", $listing->level);
				$hasPackage = false;
				if ((is_array($array_package_offers)) and (count($array_package_offers)>0) and $array_package_offers[0]) {

					unset($array_info_package);
					$array_info_package["item_type"]		= "listing";
					$array_info_package["item_id"]			= $listing->getNumber("id");
					$array_info_package["item_name"]		= $listing->getString("title");
					$array_info_package["item_friendly_ur"]	= $listing->getString("friendly_url");
					$array_info_package["package_id"][0]	= $package_id;
					package_buying_package($array_info_package, false, true);

				}
			}

			if ($new_listing){
				setting_get("listing_approve_free", $listing_approve_free);

				if (!$listing_approve_free && !$listing->needToCheckOut()){
					$listing->setString("status", "A");
					$listing->save();
				} 				
			}

			if (string_strpos($url_base, "/members") && $update_listing) {
				setting_get("listing_approve_updated", $listing_approve_updated);
				if ($last_status == "A" && !$listing->needToCheckOut() && !$listing_approve_updated && $process != "signup"){
					$listing->setString("status", "A");
					$listing->save();
				} else if ($process == "signup"){
					$listing->setString("status", $last_status);
					$listing->save();
				}
			}

			if ($process == "claim") {

				$claimObject = new Claim($claim_id);

				$claimObject->setString("step", "c");

				$claimObject->setString("listing_title", $listing->getString("title", false));
				$claimObject->setString("new_location_1", $listing->getNumber("location_1"));
				$claimObject->setString("new_location_2", $listing->getNumber("location_2"));
				$claimObject->setString("new_location_3", $listing->getNumber("location_3"));
				$claimObject->setString("new_location_4", $listing->getNumber("location_4"));
				$claimObject->setString("new_location_5", $listing->getNumber("location_5"));
				$claimObject->setString("new_title", $listing->getString("title", false));
				$claimObject->setString("new_friendly_url", $listing->getString("friendly_url", false));
				$claimObject->setString("new_email", $listing->getString("email", false));
				$claimObject->setString("new_url", $listing->getString("url", false));
				$claimObject->setString("new_phone", $listing->getString("phone", false));
				$claimObject->setString("new_fax", $listing->getString("fax", false));
				$claimObject->setString("new_address", $listing->getString("address", false));
				$claimObject->setString("new_address2", $listing->getString("address2", false));
				$claimObject->setString("new_zip_code", $listing->getString("zip_code", false));
				$claimObject->setString("new_level", $listing->getNumber("level"));
				$claimObject->setString("new_listingtemplate_id", $listing->getNumber("listingtemplate_id"));

				$claimObject->save();

				if ($listing->needToCheckOut()) {
					header("Location: $url_redirect/billing.php?claimlistingid=".$id);
				} else {
					$claimObject->setString("step", "e");
					$claimObject->save();
					header("Location: ".DEFAULT_URL."/members/claim/claimfinish.php?claimlistingid=".$claimlistingid);
				}

			} else { 

				header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?process=".$process."&newest=".$newest."&message=".$message."&extramessage_promotion=".$extramessage_promotion."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : ""));

			}

			exit;

		} else if ($allow_attachment_file == "false") $message_listing .= "<br />".system_showText(LANG_MSG_ATTACHED_FILE_DENIED)."<br />";

		
		// DON'T REMOVE THIS CODE - PROBLEM INTO FORMAT_MAGICQUOTES
		$auxPostChoice = $_POST["choice"];
		$auxGetChoice = $_GET["choice"];
		// DON'T REMOVE THIS CODE - PROBLEM INTO FORMAT_MAGICQUOTES

		// removing slashes added if required
		$_POST = format_magicQuotes($_POST);
		$_GET  = format_magicQuotes($_GET);

		// DON'T REMOVE THIS CODE - PROBLEM INTO FORMAT_MAGICQUOTES
		$_POST["choice"] = $auxPostChoice;
		$_GET["choice"] = $auxGetChoice;
		// DON'T REMOVE THIS CODE - PROBLEM INTO FORMAT_MAGICQUOTES

		extract($_POST);
		extract($_GET);

	}
    
	$video_snippet = str_replace("\"", "'", $video_snippet);

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];
	$gallery_hash = $_POST["gallery_hash"] ? $_POST["gallery_hash"] : "listing".($id ? "_$id" : "")."_".uniqid(rand(), true);

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
	// End Location General Defines

	if ($id) {

		if (string_strpos($url_base, "/members")) {
			$by_key = array("id", "account_id");
			$by_value = array(db_formatNumber($id), sess_getAccountIdFromSession());
			$listing = db_getFromDB("listing", $by_key, $by_value, 1, "", "object", SELECTED_DOMAIN_ID);
		} else {
			$listing = db_getFromDB("listing", "id", db_formatNumber($id), 1, "", "object", SELECTED_DOMAIN_ID);
		}

		if ((sess_getAccountIdFromSession() != $listing->getNumber("account_id")) && (!string_strpos($url_base, "/sitemgr"))) {
			header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "" )."");
			exit;
		}

		if ($_SERVER['REQUEST_METHOD'] != "POST"){
			$listing->extract();
        }

		// Location defines begin for edit listing
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

		$galleries = db_getFromDBBySQL("gallery", "SELECT gallery_id FROM Gallery_Item WHERE item_id = ".$id." AND item_type = 'listing ' ORDER BY id", "array", false, SELECTED_DOMAIN_ID);
		$gallery_id = $galleries[0]["gallery_id"];

		if (!$gallery_id && $image_id && $thumb_id){
			$gallery = new Gallery($id);
			$aux = array("account_id"=>0,"title"=>$title,"entered"=>"NOW()","updated"=>"now()");
			$gallery->makeFromRow($aux);
			$gallery->save();
			$listing->setGalleries($gallery->getNumber("id"));
			$gallery_id = $gallery->getNumber("id");
			$sql = "INSERT INTO Gallery_Image (gallery_id,image_id,thumb_id,image_default) VALUES ($gallery_id,".$image_id.",".$thumb_id.",'y')";
			$dbObj->query($sql);
		}

		if (!is_array($listing->getGalleries())) {
			$gallery = new Gallery();
			$aux = array("account_id"=>0,"title"=>$listing->getString("title"),"entered"=>"NOW()","updated"=>"now()");
			$gallery->makeFromRow($aux);
			$gallery->save();
			$listing->setGalleries($gallery->getNumber("id"));
		}

	} else {

		$listing = new Listing($id);
		$listing->makeFromRow($_POST);

		if ($acctId) $account_id = $acctId; else $account_id = $account_id;

		// Location defines begin for add listing
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
	$levelObj = new ListingLevel(EDIR_DEFAULT_LANGUAGE, true);
	if ($level) {
		$levelArray[$levelObj->getLevel($level)] = $level;
	} else {
		$levelArray[$levelObj->getLevel($levelObj->getDefaultLevel())] = $levelObj->getDefaultLevel();
		$level = $levelObj->getDefaultLevel();
	}
    
    //Get fields according to level
    unset($array_fields);
    $array_fields = system_getFormFields("Listing", $level);
    
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
				$categories[] = new ListingCategory($each_category);
			}
		}
	} else {
		if (!$categories) if ($listing) $categories = $listing->getCategories(false, false, $listing->getNumber("id"), true, true);
	}
	if ($categories) {
		for ($i=0; $i<count($categories); $i++) {
			if ($categories[$i]->getString("title".$langIndex)) $arr_category[$i]["name"] = $categories[$i]->getString("title".$langIndex);
			else $arr_category[$i]["name"] = $categories[$i]->getString("title");
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
					$categories[] = new ListingCategory($each_category);
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

	//Keywords
	foreach ($language_numbers as $i) {
		$labelsuffix = $i;
		unset($arr_keywords);
		if ($_POST["keywords".$labelsuffix]) {
			$arr_keywords = explode(" || ", $_POST["keywords".$labelsuffix]);
			${"keywords".$labelsuffix} = implode("\n", $arr_keywords);
		} elseif ($listing->getString("keywords".$labelsuffix)) {
			$arr_keywords = explode(" || ", $listing->getString("keywords".$labelsuffix));
			${"keywords".$labelsuffix} = implode("\n", $arr_keywords);
		}
	}
	##################################################

	//EDITOR CHOICE DEFINITION
	if(!$members) {
		$editorChoices = db_getFromDB("editor_choice", "", "", "all", "id", "object", SELECTED_DOMAIN_ID);
	} else {
		$editorChoices = db_getFromDB("editor_choice", "available", 1, "all", "id", "object", SELECTED_DOMAIN_ID);
	}

	$video_snippet = str_replace("\"", "'", $video_snippet);

    //Listing Type Fields
	$templateObj = new ListingTemplate($listingtemplate_id);
    
    $template_title_field = false;
	$template_address_field = false;
	$template_address2_field = false;
	if ($templateObj && $templateObj->getString("status")=="enabled") {
		$template_title_field = $templateObj->getListingTemplateFields("title");
		$template_address_field = $templateObj->getListingTemplateFields("address");
		$template_address2_field = $templateObj->getListingTemplateFields("address2");
	}
    
    $listingLevelObj = new ListingLevel();
    
    //Map Control
    $loadMap = false;
    $mapObj = new GoogleSettings(GOOGLE_MAPS_STATUS, $_SERVER["HTTP_HOST"]);
    if (GOOGLE_MAPS_ENABLED == "on" && $mapObj->getString("value") == "on"){
      $loadMap = true; 
      $formLoadMap = "document.listing";
      if (!$maptuning_done){
          $maptuning_done = "n";
      }
      
      $hasValidCoord = false;
      
      if ($latitude && $longitude && is_numeric($latitude) && is_numeric($longitude)){
          $hasValidCoord = true;
      }
      
      if (!$id || $hasValidCoord){
          $_COOKIE['showMapForm'] = 0;
      }
    }
?>