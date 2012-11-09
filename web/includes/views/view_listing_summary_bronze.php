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
	# * FILE: /includes/views/view_listing_summary.php
	# ----------------------------------------------------------------------------------------------------

	if(is_object($bronze_listing)){
		$is_object = true;
		$bronze_listingAux = $bronze_listing;
		$bronze_listing = $bronze_listing->data_in_array;
	}
	
    //Get fields according to level
    unset($array_fields);
    $array_fields = system_getFormFields("Listing", $bronze_listing['level']);
    
	if (MODREWRITE_FEATURE == "on") {
		$detailLink = "".LISTING_DEFAULT_URL."/".htmlspecialchars($bronze_listing["friendly_url"]).".html";
	} else {
		$detailLink = "".LISTING_DEFAULT_URL."/detail.php?id=".htmlspecialchars($bronze_listing["id"]);
	}

    $bronze_listing_template_friendly_url = htmlspecialchars($bronze_listing["friendly_url"]);
    
    $bronze_listing_url = LISTING_DEFAULT_URL . '/results.php?id=' . $bronze_listing['id'];

    $claim_link = ((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on" && FORCE_CLAIM_SSL == "on") ? SECURE_URL : NON_SECURE_URL).((MODREWRITE_FEATURE == "on") ? "/".LISTING_FEATURE_FOLDER."/claim/".$bronze_listing["friendly_url"] : "/claim.php?claimlistingid=".$bronze_listing["id"]);

	$bronze_listing_template_claim = "";
	if (CLAIM_FEATURE == "on") {
		if (!htmlspecialchars($bronze_listing["account_id"])) {
			if (htmlspecialchars($bronze_listing["claim_disable"]) == "n") {
				customtext_get("claim_textlink", $claim_textlink, EDIR_LANGUAGE);
				if ($claim_textlink) $claim_textlink_string = $claim_textlink;
				$bronze_listing_template_claim = "<a href=\"".$claim_link."\" ".$claim_style.">".$claim_textlink_string."</a>";
			}
		}
	}

	$bronze_listing_template_title = "";
	if (($user) && ($levelObj->getDetail(htmlspecialchars($bronze_listing["level"])) == "y") || $levelObj->getActive(htmlspecialchars($bronze_listing["level"])) == 'n') {
		$bronze_listing_template_title = "<a href=\"".$detailLink."\">".htmlspecialchars($bronze_listing["title"])."</a>";
	} else {
		$bronze_listing_template_title = htmlspecialchars($bronze_listing["title"]);
	}
	if (zipproximity_getDistanceLabel($zip, "listing", htmlspecialchars($bronze_listing["id"]), $distance_label, true, $bronze_listing)) {
		$bronze_listing_template_title .= " (".$distance_label.")";
	}
    $auxOriginalTitle = htmlspecialchars($bronze_listing["title"]);
    
    $bronze_listing_template_title2 = "";
	
	$bronze_listing_template_complementaryinfo = "";
	if ($tPreview) {
		$bronze_listing_template_complementaryinfo .= system_showText(LANG_IN)." "; 
		$bronze_listing_template_complementaryinfo .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">".system_showText(LANG_LABEL_ADVERTISE_CATEGORY1)."</a>";
		$bronze_listing_template_complementaryinfo .= ", ";
		$bronze_listing_template_complementaryinfo .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">".system_showText(LANG_LABEL_ADVERTISE_CATEGORY2)."</a>"; 
		$bronze_listing_template_complementaryinfo .= " ".LANG_BY." "; 
		if (SOCIALNETWORK_FEATURE == "on") {
			$bronze_listing_template_complementaryinfo .= "<a href=\"javascript:void(0);\" title=\"".system_showText(LANG_LABEL_ADVERTISE_LISTING_OWNER)."\" style=\"cursor: default;\">".system_showText(LANG_LABEL_ADVERTISE_LISTING_OWNER)."</a>";
		} else {
			$bronze_listing_template_complementaryinfo .= "<strong>".system_showText(LANG_LABEL_ADVERTISE_LISTING_OWNER)."</strong>";
		}
	} else {
		if(LISTING_SCALABILITY_OPTIMIZATION == "on"){
			$bronze_listing_template_complementaryinfo = "<a href=\"javascript: void(0);\" ".($user ? "onclick=\"showCategory(".htmlspecialchars($bronze_listing["id"]).", 'listing', ".($user ? true : false).", ".$bronze_listing["account_id"].")\"" : "style=\"cursor: default;\"").">".system_showText(LANG_VIEWCATEGORY)."</a>";
		} else {
			$bronze_listing_template_complementaryinfo = system_itemRelatedCategories(htmlspecialchars($bronze_listing["id"]), "listing", $user);
			if (socialnetwork_writeLink(htmlspecialchars($bronze_listing["account_id"]), "profile", "general_see_profile",false , false, "", false, $user)) {
				$bronze_listing_template_complementaryinfo .= " ".LANG_BY." ".socialnetwork_writeLink(htmlspecialchars($bronze_listing["account_id"]), "profile", "general_see_profile",false , false, "", false, $user);
			}
		}
	}
	
	$bronze_listing_template_designations = "";
    if (is_array($array_fields) && in_array("badges", $array_fields)){
        include(INCLUDES_DIR."/tables/table_choice.php");
        $bronze_listing_template_designations = $designations;
        $designations = "";
    }

	$bronze_listing_template_address = "";
	if (htmlspecialchars($bronze_listing["address"])) {
		$bronze_listing_template_address = nl2br(htmlspecialchars($bronze_listing["address"]));
        $bronze_listing_template_title2 .= ", ".$bronze_listing_template_address;
	}

	$bronze_listing_template_address2 = "";
	if (htmlspecialchars($bronze_listing["address2"])) {
		$bronze_listing_template_address2 = nl2br(htmlspecialchars($bronze_listing["address2"]));
	}

	$locationsToshow = system_retrieveLocationsToShow();
	$bronze_listing_template_location = "";
	if ($tPreview){
		$locationsToShow = explode (",", EDIR_LOCATIONS);
		$locationsToShow = array_reverse ($locationsToShow);
		foreach ($locationsToShow as $locationToShow) {
			$bronze_listing_template_location .= system_showText(constant("LANG_LABEL_".constant("LOCATION".$locationToShow."_SYSTEM"))).", ";
		}
		$bronze_listing_template_location = string_substr("$bronze_listing_template_location", 0, -2).', '.$bronze_listing["zip_code"];
	} else {
		
		$locationsParam = $locationsToshow.", z";
		
		if ($is_object){
			$bronze_listing_template_location = $bronze_listingAux->getLocationString($locationsParam, true);
            unset($array_location_string2);
            $array_location_string2 = array();
            if ($bronze_listingAux->getNumber("location_4")){
                $auxLocation4 = new Location4($bronze_listingAux->getNumber("location_4"));
                $array_location_string2[] = $auxLocation4->getString("name");
                $auxLocation3 = new Location3($bronze_listingAux->getNumber("location_3"));
                $array_location_string2[] = $auxLocation3->getString("abbreviation");
            }
            $bronze_listing_template_title2 .= ($bronze_listing_template_title2 ? ", " : "").implode(", ",$array_location_string2);
            unset($bronze_listingAux);
		} else {
			unset($locationsParam_array);
			$locationsParam_array = explode(",",$locationsParam);
			unset($array_location_string);
			unset($array_location_string2);
			$array_location_string = array();
			$array_location_string2 = array();
			for($r=0;$r<count($locationsParam_array);$r++){
				unset($aux_field_name);
				$field_id = trim($locationsParam_array["$r"]);
				if($field_id == "z"){
					$aux_field_name = "zip_code";
				}else{
					$aux_field_name = "location_".$field_id."_title";
				}
				if(strlen($bronze_listing[$aux_field_name]) > 0){
					$array_location_string[] = $bronze_listing[$aux_field_name];
				}
                if ($aux_field_name == "location_4_title"){
                    if ($bronze_listing[$aux_field_name]){
                        $array_location_string2[] = $bronze_listing[$aux_field_name]; 
                    }
                    if ($bronze_listing["location_3_abbreviation"]){
                        $array_location_string2[] = $bronze_listing["location_3_abbreviation"]; 
                    }
                }
			}
			$bronze_listing_template_location = implode(", ",$array_location_string);
            if (is_array($array_location_string2) && $array_location_string2[0]){
                $bronze_listing_template_title2 .= ", ".implode(", ",$array_location_string2);
            }
		}
	}
    
    if (USING_THEME_TEMPLATE && THEME_TEMPLATE_ID > 0 && TEMPLATE_SUMMARY_FIELDS && $bronze_listing["listingtemplate_id"] == THEME_TEMPLATE_ID){
        $themeSummaryFields = unserialize(TEMPLATE_SUMMARY_FIELDS);
        if ($bronze_listing[$themeSummaryFields["price_field"]]){
            $bronze_listing_template_title2 .= " | ".CURRENCY_SYMBOL.$bronze_listing[$themeSummaryFields["price_field"]];
        }
        $array_comp_info = array();
        if ($bronze_listing[$themeSummaryFields["bedroom_field"]]){
            $array_comp_info[] = $bronze_listing[$themeSummaryFields["bedroom_field"]]." ".system_showText(LANG_LABEL_TEMPLATE_BEDROOM);
        }
        if ($bronze_listing[$themeSummaryFields["bathroom_field"]]){
            $array_comp_info[] = $bronze_listing[$themeSummaryFields["bathroom_field"]]." ".system_showText(LANG_LABEL_TEMPLATE_BATHROOM);
        }
        if ($bronze_listing[$themeSummaryFields["squarefeet_field"]]){
            $array_comp_info[] = $bronze_listing[$themeSummaryFields["squarefeet_field"]]." ".system_showText(LANG_LABEL_TEMPLATE_SQUARE);
        }
        $bronze_listing_template_complementaryinfo2 = "";
        $bronze_listing_template_complementaryinfo2 = implode(" | ", $array_comp_info);
    }
    
    $bronze_listing_template_title2 = htmlspecialchars($bronze_listing_template_title2);
    
	unset($labelsuffix);
	
	$labelsuffix = language_getIndex(EDIR_LANGUAGE);

	$bronze_listing_template_description = "";

	if (htmlspecialchars($bronze_listing["description".$labelsuffix]) && (is_array($array_fields) && in_array("summary_description", $array_fields))) {
		$bronze_listing_template_description = nl2br(htmlspecialchars($bronze_listing["description".$labelsuffix]));
	}

	$bronze_listing_template_phone = "";
	if (htmlspecialchars($bronze_listing["phone"])) {
		if ($user) {
			$bronze_listing_template_phone .= "<span id=\"phoneLink".htmlspecialchars($bronze_listing["id"])."\" class=\"show-inline\"><a href=\"javascript:showPhone('".htmlspecialchars($bronze_listing["id"])."','".DEFAULT_URL."');\">".system_showText(LANG_LISTING_VIEWPHONE)."</a></span>";
			$bronze_listing_template_phone .= "<span id=\"phoneNumber".htmlspecialchars($bronze_listing["id"])."\" class=\"hide\" title=\"".htmlspecialchars($bronze_listing["phone"])."\">".system_showTruncatedText($bronze_listing["phone"], 30)."</span>";
		} else {
			$bronze_listing_template_phone = system_showTruncatedText($bronze_listing["phone"], 30);
		}
	}

	$bronze_listing_template_email = "";
	if (htmlspecialchars($bronze_listing["email"]) && (is_array($array_fields) && in_array("email", $array_fields))) {
        $display_email = wordwrap(htmlspecialchars($bronze_listing["email"]), 30, "<br />", true);
        if ($user){
			$bronze_listing_template_email = "<a href=\"".DEFAULT_URL."/popup/popup.php?pop_type=listing_emailform&amp;id=".htmlspecialchars($bronze_listing["id"])."&amp;receiver=owner\" class=\"iframe fancy_window_tofriend\">".system_showText(LANG_SEND_AN_EMAIL)."</a>";
		} else {
			$bronze_listing_template_email = "<a href=\"javascript:void(0);\" style=\"cursor:default\">".system_showText(LANG_SEND_AN_EMAIL)."</a>";
		}
	}

	$bronze_listing_template_locations = "";
	if (htmlspecialchars($bronze_listing["locations"]) && (is_array($array_fields) && in_array("locations", $array_fields))) {
		$bronze_listing_template_locations = nl2br(htmlspecialchars($bronze_listing["locations"]));
	}	
	
	$bronze_listing_template_twilioSMS = "";
	$bronze_listing_template_twilioCall = "";
	
	if ($levelsWithSendPhone) { // this variable is created on /listing/results_listing.php
		if (in_array($bronze_listing["level"], $levelsWithSendPhone)) {
			 /*
			 * Prepare link to Twilio SMS
			 */
			if ($user){
				$bronze_listing_template_twilioSMS = twilio_PrepareLink("Listing", $bronze_listing["id"]);
				$twilioSMS_style = "class=\"iframe fancy_window_twilio\"";
			} else {
				$bronze_listing_template_twilioSMS = "javascript: void(0);";
				$twilioSMS_style = "style=\"cursor: default;\"";
			}
		}
	}
		
	if ($levelsWithClicktoCall) {  // this variable is created on /listing/results_listing.php

		if (in_array($bronze_listing["level"], $levelsWithClicktoCall) && $bronze_listing["clicktocall_number"]) {
			 /*
			 * Prepare link to Twilio Click to Call
			 */
			if ($user){
				$bronze_listing_template_twilioCall = twilio_PrepareLink("Listing", $bronze_listing["id"], true);
				$twilioCall_style = "class=\"iframe fancy_window_twilio\"";
			} else {
				$bronze_listing_template_twilioCall = "javascript: void(0);";
				$twilioCall_style = "style=\"cursor: default;\"";
			}
		}
	}
	
	$bronze_listing_viewtype = "summary";

	include(INCLUDES_DIR."/views/view_listing_bronze.php");
?>
