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
    # * FILE: /includes/views/view_event_detail.php
    # ----------------------------------------------------------------------------------------------------

    //Get fields according to level
    unset($array_fields);
    $array_fields = system_getFormFields("Event", $event->getNumber("level"));

	$event_icon_navbar = "";
	include(EDIRECTORY_ROOT."/includes/views/icon_event.php");
	$event_icon_navbar = $icon_navbar;
	$icon_navbar = "";

	$str_date = $event->getDateString();
	if ($event->getString("recurring")=="Y"){
		$str_recurring = $event->getDateStringRecurring();
	}
    
    $str_time = "";
    if (is_array($array_fields) && (in_array("start_time", $array_fields) || in_array("end_time", $array_fields))){
        $str_time = $event->getTimeString();
    }
    
    $str_end = "";
	$str_end = $event->getDateStringEnd();
	
    if ($event->getString("latitude") && $event->getString("longitude")){
        $location_map = urlencode($event->getString("latitude").",".$event->getString("longitude"));
    } else {
        $location_map = urlencode($event->getLocationString("A, 4, 3, 1, z", true)); /* 1=country, 3=state, 4=city */	
    }

	if ($user) {
		$map_link = "http://maps.google.com/maps?q=".$location_map;		
	} else {
		$map_link = "#";
	}
	
	$event_title = $event->getString("title");
	
	$event_category_tree = "";
	if ($tPreview) {
		$event_category_tree = "<ul class=\"list list-category\">";
		$event_category_tree .= "<li class=\"level-1\">";
		$event_category_tree .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">";
		$event_category_tree .= system_showText(LANG_LABEL_ADVERTISE_CATEGORY1)." ";
		$event_category_tree .= "<span>(230)</span>";
		$event_category_tree .= "</a>";
		$event_category_tree .= "</li>";
		$event_category_tree .= "<li class=\"level-2\">";
		$event_category_tree .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">";
		$event_category_tree .= system_showText(LANG_LABEL_ADVERTISE_CATEGORY1_2)." ";
		$event_category_tree .= "<span>(200)</span>";
		$event_category_tree .= "</a>";
		$event_category_tree .= "</li>";
		$event_category_tree .= "<li class=\"level-1\">";
		$event_category_tree .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">";
		$event_category_tree .= system_showText(LANG_LABEL_ADVERTISE_CATEGORY2)." ";
		$event_category_tree .= "<span>(300)</span>";
		$event_category_tree .= "</a>";
		$event_category_tree .= "</li>";
		$event_category_tree .= "<li class=\"level-2\">";
		$event_category_tree .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">";
		$event_category_tree .= system_showText(LANG_LABEL_ADVERTISE_CATEGORY2_2)." ";
		$event_category_tree .= "<span>(230)</span>";
		$event_category_tree .= "</a>";
		$event_category_tree .= "</li>";
		$event_category_tree .= "</ul>";
	} else {
		$categories = $event->getCategories();
		if ($categories) {
			foreach ($categories as $categoryObj) {
				if (string_strpos($categoryObj->getString("lang"), EDIR_LANGUAGE) !== false) {
					$arr_full_path[] = $categoryObj->getFullPath();
				}
			}
			if ($arr_full_path) $event_category_tree = system_generateCategoryTree($categories, $arr_full_path, "event", $user, EDIR_LANGUAGE);
		}
	}
	
	if ($tPreview || !$user) {
		$event_facebook_buttons = "<div style=\"float: left; width: 140px;\">";
		$event_facebook_buttons .= "<img src=\"".DEFAULT_URL."/images/content/bt-facebook-like-sample.png\" alt=\"\" title=\"\" style=\"float: left; margin-right: 15px;\" />";
		$event_facebook_buttons .= "<img src=\"".DEFAULT_URL."/images/content/bt-facebook-send-sample.png\" alt=\"\" title=\"\" />";
		$event_facebook_buttons .= "</div>";
	} else {
		$event_facebook_buttons = "
            <div id=\"fb-root\"></div>
			<script language=\"javascript\"  type=\"text/javascript\">
			  (function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = \"http://connect.facebook.net/".EDIR_LANGUAGEFACEBOOK."/all.js#xfbml=1\";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			</script>
			<script language='javascript' type='text/javascript'>
			//<![CDATA[
			document.write('".$likeObj."');
			//]]>
			</script>

		";
	}
	
	/*
	 * Google+ Button
	 */
 	if ($tPreview || !$user) {
		$event_googleplus_button = "<div>";
		$event_googleplus_button .= "<img src=\"".DEFAULT_URL."/images/content/bt-google-plus-sample.png\" alt=\"\" title=\"\" />";
		$event_googleplus_button .= "</div>";
 	}else{
	 	$aux_googleplus_button = system_prepareGooglePlus("button", DEFAULT_URL.$_SERVER["REQUEST_URI"]);
		if($aux_googleplus_button){
			
			if (GOOGLEPLUS_ON_IE8 == "on"){
				$event_googleplus_button = $aux_googleplus_button;
			} else {
				$event_googleplus_button = "
						<script language='javascript' type='text/javascript'>
							//<![CDATA[
							document.write('".$aux_googleplus_button."');
							//]]>
						</script>
						";
			}

		}else{
			$event_googleplus_button = ""; 
		}
 	}
	
	if ($tPreview){
		$locationsToShow = explode (",", EDIR_LOCATIONS);
		$locationsToShow = array_reverse ($locationsToShow);
		$locationsParam = "";
		foreach ($locationsToShow as $locationToShow) {
			$locationsParam .= system_showText(constant("LANG_LABEL_".constant("LOCATION".$locationToShow."_SYSTEM"))).", ";
		}
		$event_location = system_showText(LANG_LABEL_LOCATION_NAME);
		
		$location = string_substr("$locationsParam", 0, -2).', '.$event->getString("zip_code");
	} else {
		$event_location = $event->getString("location", true);

		$locationsToshow = system_retrieveLocationsToShow();
		$locationsParam = $locationsToshow." z";
		$location = $event->getLocationString($locationsParam, true);
	}
    
	$event_address = $event->getString("address", true);
	$event_address2 = $event->getString("address2", true);
	
    $event_contactName = "";
    if (is_array($array_fields) && (in_array("contact_name", $array_fields))){
        $event_contactName = $event->getString("contact_name");
    }
    $event_phone = "";
	$event_phone = $event->getString("phone");
	
	// the following code is added by Debiprasad Sahoo (Indibits) on 5th August 2012
	$phone_display_code = '';
	if ($event_phone) {
		$phone_display_code .= "<span id=\"phoneLink".$event->getNumber("id")."\" class=\"show-inline\"><a href=\"javascript:showPhone('".$event->getNumber("id")."','".DEFAULT_URL."');\">".system_showText(LANG_LISTING_VIEWPHONE)."</a></span>";
		$phone_display_code .= "<span id=\"phoneNumber".$event->getNumber("id")."\" class=\"hide\" title=\"".htmlspecialchars($event_phone)."\">".$event_phone."</span>";
	}

	
    $event_fax = "";
	$event_fax = $event->getString("fax");
    $event_email = "";
    $contact_email = "";
    if (is_array($array_fields) && (in_array("email", $array_fields))){
        $event_email = $event->getString("email");
        
        if ($user) {
            $contact_email = DEFAULT_URL."/popup/popup.php?pop_type=event_emailform&amp;id=".$event->getNumber("id")."&amp;receiver=owner";
        } else { 
            $contact_email = "javascript:void(0);"; $contact_email_style = "cursor:default";  
        }
    }
    
    $event_url = "";
    if (is_array($array_fields) && (in_array("url", $array_fields))){
        if (is_array($array_fields) && (in_array("url", $array_fields))){
            $event_url = $event->getString("url");
        }

        if ($event->getString("display_url")) {
            $dispurl = $event->getString("display_url");
        } else {
            $urlsize = 40;
            $dispurl = $event->getString("url", true, $urlsize);
        }
    }
    
	$event_description = "";
    if (is_array($array_fields) && (in_array("long_description", $array_fields))){
        $event_description = $event->getStringLang(EDIR_LANGUAGE, "long_description", true);
    }
	
	$imageTag = "";
    if (is_array($array_fields) && in_array("main_image", $array_fields)){
        $imageObj = new Image($event->getNumber("image_id"));
        if ($imageObj->imageExists()) {
            $langIndex = language_getIndex(EDIR_LANGUAGE);
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            $sql = "SELECT image_caption$langIndex,thumb_caption$langIndex FROM Gallery_Image WHERE image_id=".$event->getNumber("image_id");
            $r = $dbObj->query($sql);
            while ($row_aux = mysql_fetch_array($r)) {
                $imagecaption = $row_aux["image_caption$langIndex"];
                $thumbcaption = $row_aux["thumb_caption$langIndex"];
            }
            $imageTag .= "<div class=\"no-link\" ".(RESIZE_IMAGES_UPGRADE == "off" ? "style=\"text-align:center\"" : "").">";
            $imageTag .= $imageObj->getTag(true, IMAGE_EVENT_FULL_WIDTH, IMAGE_EVENT_FULL_HEIGHT, ($thumbcaption ? $thumbcaption : $event->getString("title", true)), true);
            $imageTag .= "</div>";
            $aux_thumbcaption = "";
            if (USE_GALLERY_PLUGIN){
                $aux_thumbcaption = "<strong style=\"display:block\">$thumbcaption</strong>";
            }
            if ($imagecaption) $imageTag .= "<p class=\"image-caption\">$aux_thumbcaption".$imagecaption."</p>";
        } else {
            $onlyMain = true;
            $imageTag .= "<span class=\"no-image no-link\"></span>";
        }
    }
    
	$eventGallery = "";
    
    if (USE_GALLERY_PLUGIN){
        $eventGallery = system_showFrontGalleryPlugin($event->getGalleries(), $event->getNumber("level"), $user, GALLERY_DETAIL_IMAGES, "event", EDIR_LANGUAGE, $tPreview, $onlyMain);
    } else {
        $eventGallery = system_showFrontGallery($event->getGalleries(), $event->getNumber("level"), $user, GALLERY_DETAIL_IMAGES, "event", EDIR_LANGUAGE, $tPreview);
    }
	
	$mapObj = new GoogleSettings(GOOGLE_MAPS_STATUS);
	$event_googlemaps = "";
	if (GOOGLE_MAPS_ENABLED == "on" && $mapObj->getString("value") == "on") {
		$google_image_id = $event->getNumber("image_id");
		$google_title = addslashes($event->getString('title'));
		$google_phone = $event->getString('phone');
		$google_address = $event->getString('address');
		$google_address2 = $event->getString('address2');
		$google_zipcode = $event->getString('zip_code');
		if ($event->getString('latitude') && $event->getString('longitude')){
            $google_maptuning = $event->getString('latitude').",".$event->getString('longitude');
        }
		$google_mapzoom = $event->getString('map_zoom');
		$google_location1 = $event->getLocationString("1", true);
		$google_location2 = $event->getLocationString("3", true);
		$google_location3 = $event->getLocationString("4", true);
		$google_zip = $event->getLocationString("z", true);
		$google_location_showaddress = $event->getLocationString("A, 4, 3, 1", true);
		$show_html = true;
		include(INCLUDES_DIR."/views/view_google_maps.php");
		$event_googlemaps = $google_maps;
		$google_maps = "";
	}
	
	$detailFileName = INCLUDES_DIR."/views/view_event_detail_code.php";
    $themeDetailFileName = INCLUDES_DIR."/views/view_event_detail_code_".EDIR_THEME.".php";
    
	if (file_exists($themeDetailFileName)){
        include($themeDetailFileName);
    } else {
        include($detailFileName);
    }
	
?>