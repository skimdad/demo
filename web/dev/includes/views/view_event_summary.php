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
	# * FILE: /includes/views/view_event_summary.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DEFINES
	# ----------------------------------------------------------------------------------------------------

    //Get fields according to level
    unset($array_fields);
    $array_fields = system_getFormFields("Event", $event->getNumber("level"));

	$event_icon_navbar = "";
	include(EDIRECTORY_ROOT."/includes/views/icon_event.php");
	$event_icon_navbar = $icon_navbar;
	$icon_navbar = "";

	if (MODREWRITE_FEATURE == "on") {
		$detailLink = "".EVENT_DEFAULT_URL."/".$event->getString("friendly_url").".html";
	} else {
		$detailLink = "".EVENT_DEFAULT_URL."/detail.php?id=".$event->getString("id");
	}
	$str_date = "";
	$str_date = $event->getDateString();
	$str_recurring = "";
	if ($event->getString("recurring")=="Y"){
		$str_recurring = $event->getDateStringRecurring();
	}
	
    $str_end = "";
    $str_end = $event->getDateStringEnd();
    
    $str_time = "";
    if (is_array($array_fields) && (in_array("start_time", $array_fields) || in_array("end_time", $array_fields))){
        $str_time = $event->getTimeString();
    }
    
	$friendly_url = $event->getString('friendly_url');
	
	if ((string_strpos($_SERVER["PHP_SELF"], "results.php") !== false) !== false && GOOGLE_MAPS_ENABLED == "on" && $mapObj->getString("value") == "on") { 
		if ($event->getString("latitude") && $event->getString("longitude")) {
			$show_map = true;
		}else{
			$show_map = false;
		}
	}
	
	if (($user) && ($level->getDetail($event->getNumber("level")) == "y")) { 
		$show_detailLink = true;
	}else{
		$show_detailLink = false;
	}
	
	$distance_label = "";
	if (zipproximity_getDistanceLabel($zip, "event", $event->getNumber("id"), $distance_label)) {
		$distance_label = " (".$distance_label.")";
	}
	
	unset($title);
	if($show_detailLink){
		$title	= "<a href=\"".$detailLink."\">";
		$title .= $event->getString("title").$distance_label;
		$title .= "</a>";
	}else{
		$title = $event->getString("title").$distance_label;
	}
	if ($tPreview) {
		$complementary_info = system_showText(LANG_IN)." "; 
		$complementary_info .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">".system_showText(LANG_LABEL_ADVERTISE_CATEGORY)."</a>";
		$complementary_info .= " ".LANG_BY." "; 
		if (SOCIALNETWORK_FEATURE == "on") {
			$complementary_info .= "<a href=\"javascript:void(0);\" title=\"".system_showText(LANG_LABEL_ADVERTISE_EVENT_OWNER)."\" style=\"cursor: default;\">".system_showText(LANG_LABEL_ADVERTISE_EVENT_OWNER)."</a>";
		} else {
			$complementary_info .= "<strong>".system_showText(LANG_LABEL_ADVERTISE_EVENT_OWNER)."</strong>";
		}
	} else {
		if(EVENT_SCALABILITY_OPTIMIZATION == "on"){
			$complementary_info = "<a href=\"javascript: void(0);\" ".($user ? "onclick=\"showCategory(".htmlspecialchars($event->getNumber("id")).", 'event', ".($user ? true : false).", ".$event->getNumber("account_id").")\"" : "style=\"cursor: default;\"").">".system_showText(LANG_VIEWCATEGORY)."</a>";
		} else {
			$complementary_info = system_itemRelatedCategories($event->getNumber("id"), "event", $user);
			$complementary_info .= " ".($event->getNumber("account_id") ? LANG_BY." ".socialnetwork_writeLink($event->getNumber("account_id"), "profile", "general_see_profile", false, false, false, "", $user) : "");
		}	
	}
	
	$when = ($event->getString("recurring") != "Y" ? $str_date : $str_recurring);
	
	if ($tPreview){
        $event_location = system_showText(LANG_LABEL_LOCATION_NAME);
		$locationsToShow = explode (",", EDIR_LOCATIONS);
		$locationsToShow = array_reverse ($locationsToShow);
		$locationsParam = "";
		foreach ($locationsToShow as $locationToShow) {
			$locationsParam .= system_showText(constant("LANG_LABEL_".constant("LOCATION".$locationToShow."_SYSTEM"))).", ";
		}
		$location = string_substr("$locationsParam", 0, -2).', '.$event->getString("zip_code");
	} else {
        $event_location = $event->getString("location", true);
		$locationsToshow = system_retrieveLocationsToShow();
		$locationsParam = $locationsToshow." z";
		$location = $event->getLocationString($locationsParam, true);
	}
	
	$address1 = $event->getString("address");
	$address2 = $event->getString("address2");
	
	$phone = $event->getString("phone");
	// the following code is added by Debiprasad Sahoo (Indibits) on 5th August 2012
	$phone_display_code = '';
	if ($phone) {
		$phone_display_code .= "<span id=\"phoneLink".$event->getNumber("id")."\" class=\"show-inline\"><a href=\"javascript:showPhone('".$event->getNumber("id")."','".DEFAULT_URL."');\">".system_showText(LANG_LISTING_VIEWPHONE)."</a></span>";
		$phone_display_code .= "<span id=\"phoneNumber".$event->getNumber("id")."\" class=\"hide\" title=\"".htmlspecialchars($phone)."\">".$phone."</span>";
	}
	
	if($location){
		$location = "<span>".$location."</span>";
	}
	if($address1){
		$address1 = "<span>".$address1."</span>";
	}
	if($address2){
		$address2 = "<span>".$address2."</span>";
	}

	unset($imageTag);
    
    if (is_array($array_fields) && in_array("main_image", $array_fields)){
        if ($tPreview) {
            $imageTag = "<span class=\"no-image\" style=\"cursor: default;\"></span>";
        } else {
            if($event->getNumber("thumb_id")){
                $imageObj = new Image($event->getNumber("thumb_id"));
                if ($imageObj->imageExists()) {
                    if ($show_detailLink){
                        $imageTag  = "<a href=\"".$detailLink."\">";
                        $imageTag .= $imageObj->getTag(true, IMAGE_EVENT_THUMB_WIDTH, IMAGE_EVENT_THUMB_HEIGHT, $event->getString("title"), true);
                        $imageTag .= "</a>";
                    } else {
                        $imageTag .= "<div class=\"no-link\">";
                        $imageTag .= $imageObj->getTag(true, IMAGE_EVENT_THUMB_WIDTH, IMAGE_EVENT_THUMB_HEIGHT, $event->getString("title"), true);
                        $imageTag .= "</div>";
                    }
                }else{
                    if ($show_detailLink){
                        $imageTag =  "<a href=\"".$detailLink."\" class=\"image\">";
                        $imageTag .=  "<span class=\"no-image\"></span>";
                        $imageTag .=  "</a>";
                    } else {
                        $imageTag = "<span class=\"no-image no-link\"></span>";
                    }
                }
            } else {
                if ($show_detailLink){
                    $imageTag =  "<a href=\"".$detailLink."\" class=\"image\">";
                    $imageTag .=  "<span class=\"no-image\"></span>";
                    $imageTag .=  "</a>";
                } else {
                    $imageTag = "<span class=\"no-image no-link\"></span>";
                }

            }
        }
    }
    
    $description = "";
	if (is_array($array_fields) && in_array("summary_description", $array_fields)){
		$description = $event->getStringLang(EDIR_LANGUAGE, "description", true);
	}
    
    $summaryFileName = INCLUDES_DIR."/views/view_event_summary_code.php";
    $themeSummaryFileName = INCLUDES_DIR."/views/view_event_summary_code_".EDIR_THEME.".php";

    if (file_exists($themeSummaryFileName)){
        include($themeSummaryFileName);
    } else {
        include($summaryFileName);
    }
	
?>
