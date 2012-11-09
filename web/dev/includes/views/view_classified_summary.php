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
	# * FILE: /includes/views/view_classified_summary.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DEFINES
	# ----------------------------------------------------------------------------------------------------
    //
    //Get fields according to level
    unset($array_fields);
    $array_fields = system_getFormFields("Classified", $classified->getNumber("level"));

	$classified_icon_navbar = "";
	include(EDIRECTORY_ROOT."/includes/views/icon_classified.php");
	$classified_icon_navbar = $icon_navbar;
	$icon_navbar = "";

	if (MODREWRITE_FEATURE == "on") {
		$detailLink = "".CLASSIFIED_DEFAULT_URL."/".$classified->getString("friendly_url").".html";
	} else {
		$detailLink = "".CLASSIFIED_DEFAULT_URL."/detail.php?id=".$classified->getString("id");
	}

	$friendly_url = $classified->getString('friendly_url');
	
	if ((string_strpos($_SERVER["PHP_SELF"], "results.php") !== false) !== false && GOOGLE_MAPS_ENABLED == "on" && $mapObj->getString("value") == "on") { 
		if ($classified->getString("latitude") && $classified->getString("longitude")) {
			$show_map = true;
		}else{
			$show_map = false;
		}
	}
	
	if (($user) && ($level->getDetail($classified->getNumber("level")) == "y")) { 
		$show_detailLink = true;
	}else{
		$show_detailLink = false;
	}
	
	unset($distance_label);
	if (zipproximity_getDistanceLabel($zip, "classified", $classified->getNumber("id"), $distance_label)) {
		$distance_label = " (".$distance_label.")";
	}
	
	unset($title);
	if($show_detailLink){
		$title = "<a href=\"".$detailLink."\">";
		$title .= $classified->getString("title").$distance_label;
		$title .= "</a>";
	}else{
		$title = $classified->getString("title").$distance_label;
	}
	
	if ($tPreview) {
		$complementary_info = system_showText(LANG_IN)." "; 
		$complementary_info .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">".system_showText(LANG_LABEL_ADVERTISE_CATEGORY)."</a>";
		$complementary_info .= " ".LANG_BY." "; 
		if (SOCIALNETWORK_FEATURE == "on") {
			$complementary_info .= "<a href=\"javascript:void(0);\" title=\"".system_showText(LANG_LABEL_ADVERTISE_CLASSIFIED_OWNER)."\" style=\"cursor: default;\">".system_showText(LANG_LABEL_ADVERTISE_CLASSIFIED_OWNER)."</a>";
		} else {
			$complementary_info .= "<strong>".system_showText(LANG_LABEL_ADVERTISE_CLASSIFIED_OWNER)."</strong>";
		}
	} else {
		if(CLASSIFIED_SCALABILITY_OPTIMIZATION == "on"){
			$complementary_info = "<a href=\"javascript: void(0);\" ".($user ? "onclick=\"showCategory(".htmlspecialchars($classified->getNumber("id")).", 'classified', ".($user ? true : false).", ".$classified->getNumber("account_id").")\"" : "style=\"cursor: default;\"").">".system_showText(LANG_VIEWCATEGORY)."</a>";
		} else {
			$complementary_info = system_itemRelatedCategories($classified->getNumber("id"), "classified", $user);
			$complementary_info .= " ".($classified->getNumber("account_id") ? LANG_BY." ".socialnetwork_writeLink($classified->getNumber("account_id"), "profile", "general_see_profile", false, false, false, "", $user) : "");
		}	
	}
    
    if ($tPreview){
		$locationsToShow = explode (",", EDIR_LOCATIONS);
		$locationsToShow = array_reverse ($locationsToShow);
		$locationsParam = "";
		foreach ($locationsToShow as $locationToShow) {
			$locationsParam .= system_showText(constant("LANG_LABEL_".constant("LOCATION".$locationToShow."_SYSTEM"))).", ";
		}
		$location = string_substr("$locationsParam", 0, -2).', '.$classified->getString("zip_code");
	} else {
		$locationsToshow = system_retrieveLocationsToShow();
		$locationsParam = $locationsToshow." z";
		$location = $classified->getLocationString($locationsParam, true);
	}
	
	$address1 = $classified->getString("address");
	$address2 = $classified->getString("address2");
	
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
            if($classified->getNumber("thumb_id")){
                $imageObj = new Image($classified->getNumber("thumb_id"));
                if ($imageObj->imageExists()) {
                    if ($show_detailLink){
                        $imageTag  = "<a href=\"".$detailLink."\">";
                        $imageTag .= $imageObj->getTag(true, IMAGE_CLASSIFIED_THUMB_WIDTH, IMAGE_CLASSIFIED_THUMB_HEIGHT, $classified->getString("title"), true);
                        $imageTag .= "</a>";
                    } else {
                        $imageTag .= "<div class=\"no-link\">";
                        $imageTag .= $imageObj->getTag(true, IMAGE_CLASSIFIED_THUMB_WIDTH, IMAGE_CLASSIFIED_THUMB_HEIGHT, $classified->getString("title"), true);
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
		
	unset($summaryDescription);
	$summaryDescription = $classified->getStringLang(EDIR_LANGUAGE, "summarydesc", true);
	
	unset($phone);
	$phone = $classified->getString("phone");
	// the following code is added by Debiprasad Sahoo (Indibits) on 5th August 2012
	$phone_display_code = '';
	if ($phone) {
		$phone_display_code .= "<span id=\"phoneLink".$classified->getNumber("id")."\" class=\"show-inline\"><a href=\"javascript:showPhone('".$classified->getNumber("id")."','".DEFAULT_URL."');\">".system_showText(LANG_LISTING_VIEWPHONE)."</a></span>";
		$phone_display_code .= "<span id=\"phoneNumber".$classified->getNumber("id")."\" class=\"hide\" title=\"".htmlspecialchars($phone)."\">".$phone."</span>";
	}
	
	$contact_email_style = "";
	if ($classified->getString("email")) {
		if ($user){ 
			$contact_email = DEFAULT_URL."/popup/popup.php?pop_type=classified_emailform&amp;id=".$classified->getNumber("id")."&amp;receiver=owner";
		} else { 
			$contact_email = "javascript:void(0);"; 
			$contact_email_style = "cursor:default";  
		}
	}
	
	unset($display_url);
	if ($classified->getString("url", true, 30) && (is_array($array_fields) && in_array("url", $array_fields))){
		$display_urlStr = $classified->getString("url", true, 30);
		if ($user){
			$display_url = $classified->getString("url", true, 30);
			$target = "target=\"_blank\"";
			$style = "";
		} else {
			$display_url = "javascript:void(0);";
			$target = "";
			$style = "style=\"cursor:default\"";
		}
	}
	
	unset($price);
	if ($classified->getString("classified_price") != "NULL"){
		$price = CURRENCY_SYMBOL." ".($classified->getString("classified_price"));
	}
	
	unset($description);
	$description = $classified->getStringLang(EDIR_LANGUAGE, "description", true);
    
    $summaryFileName = INCLUDES_DIR."/views/view_classified_summary_code.php";
    $themeSummaryFileName = INCLUDES_DIR."/views/view_classified_summary_code_".EDIR_THEME.".php";

    if (file_exists($themeSummaryFileName)){
        include($themeSummaryFileName);
    } else {
        include($summaryFileName);
    }
?>