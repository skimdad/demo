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
	# * FILE: /includes/views/view_classified_detail.php
	# ----------------------------------------------------------------------------------------------------

    //Get fields according to level
    unset($array_fields);
    $array_fields = system_getFormFields("Classified", $classified->getNumber("level"));

	$classified_icon_navbar = "";
	include(EDIRECTORY_ROOT."/includes/views/icon_classified.php");
	$classified_icon_navbar = $icon_navbar;
	$icon_navbar = "";
	
	$classified_title = $classified->getString("title");
	
	$classified_category_tree = "";
	if ($tPreview) {
		$classified_category_tree = "<ul class=\"list list-category\">";
		$classified_category_tree .= "<li class=\"level-1\">";
		$classified_category_tree .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">";
		$classified_category_tree .= system_showText(LANG_LABEL_ADVERTISE_CATEGORY1)." ";
		$classified_category_tree .= "<span>(230)</span>";
		$classified_category_tree .= "</a>";
		$classified_category_tree .= "</li>";
		$classified_category_tree .= "<li class=\"level-2\">";
		$classified_category_tree .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">";
		$classified_category_tree .= system_showText(LANG_LABEL_ADVERTISE_CATEGORY1_2)." ";
		$classified_category_tree .= "<span>(200)</span>";
		$classified_category_tree .= "</a>";
		$classified_category_tree .= "</li>";
		$classified_category_tree .= "<li class=\"level-1\">";
		$classified_category_tree .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">";
		$classified_category_tree .= system_showText(LANG_LABEL_ADVERTISE_CATEGORY2)." ";
		$classified_category_tree .= "<span>(300)</span>";
		$classified_category_tree .= "</a>";
		$classified_category_tree .= "</li>";
		$classified_category_tree .= "<li class=\"level-2\">";
		$classified_category_tree .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">";
		$classified_category_tree .= system_showText(LANG_LABEL_ADVERTISE_CATEGORY2_2)." ";
		$classified_category_tree .= "<span>(230)</span>";
		$classified_category_tree .= "</a>";
		$classified_category_tree .= "</li>";
		$classified_category_tree .= "</ul>";
	} else {
		$categories = $classified->getCategories();
		if ($categories) {
			foreach ($categories as $categoryObj) {
				if (string_strpos($categoryObj->getString("lang"), EDIR_LANGUAGE) !== false) {
					$arr_full_path[] = $categoryObj->getFullPath();
				}
			}
			if ($arr_full_path) $classified_category_tree = system_generateCategoryTree($categories, $arr_full_path, "classified", $user, EDIR_LANGUAGE);
		}
	}
	
	if ($tPreview || !$user) {
		$classified_facebook_buttons = "<div style=\"float: left; width: 140px;\">";
		$classified_facebook_buttons .= "<img src=\"".DEFAULT_URL."/images/content/bt-facebook-like-sample.png\" alt=\"\" title=\"\" style=\"float: left; margin-right: 15px;\" />";
		$classified_facebook_buttons .= "<img src=\"".DEFAULT_URL."/images/content/bt-facebook-send-sample.png\" alt=\"\" title=\"\" />";
		$classified_facebook_buttons .= "</div>";
	} else {
		$classified_facebook_buttons = "
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
		$classified_googleplus_button = "<div>";
		$classified_googleplus_button .= "<img src=\"".DEFAULT_URL."/images/content/bt-google-plus-sample.png\" alt=\"\" title=\"\" />";
		$classified_googleplus_button .= "</div>";
 	}else{
	 	$aux_googleplus_button = system_prepareGooglePlus("button", DEFAULT_URL.$_SERVER["REQUEST_URI"]);
		if($aux_googleplus_button){
			
			if (GOOGLEPLUS_ON_IE8 == "on"){
				$classified_googleplus_button = $aux_googleplus_button;
			} else {
				$classified_googleplus_button = "
						<script language='javascript' type='text/javascript'>
							//<![CDATA[
							document.write('".$aux_googleplus_button."');
							//]]>
						</script>
						";
			}

		}else{
			$classified_googleplus_button = ""; 
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
	
	$classified_address = $classified->getString("address");
	$classified_address2 = $classified->getString("address2");
	
	$classified_summary = $classified->getStringLang(EDIR_LANGUAGE, "summarydesc", true);
	
	$classified_price = $classified->getString("classified_price");
	
    $classified_contactName = "";
    if (is_array($array_fields) && (in_array("contact_name", $array_fields))){
        $classified_contactName = $classified->getString("contactname");
    }
	
	$classified_phone = $classified->getString("phone");

	// the following code is added by Debiprasad Sahoo (Indibits) on 5th August 2012
	$phone_display_code = '';
	if ($classified_phone) {
		$phone_display_code .= "<span id=\"phoneLink".$classified->getNumber("id")."\" class=\"show-inline\"><a href=\"javascript:showPhone('".$classified->getNumber("id")."','".DEFAULT_URL."');\">".system_showText(LANG_LISTING_VIEWPHONE)."</a></span>";
		$phone_display_code .= "<span id=\"phoneNumber".$classified->getNumber("id")."\" class=\"hide\" title=\"".htmlspecialchars($classified_phone)."\">".$classified_phone."</span>";
	}
	
    $classified_fax = "";
    if (is_array($array_fields) && (in_array("fax", $array_fields))){
        $classified_fax = $classified->getString("fax");
    }
	
	$classified_email = $classified->getString("email");
	
    $classified_url = "";
    if (is_array($array_fields) && (in_array("url", $array_fields))){
        $classified_url = $classified->getString("url");
    }
	
	if ($user) {
		$contact_email = DEFAULT_URL."/popup/popup.php?pop_type=classified_emailform&amp;id=".$classified->getNumber("id")."&amp;receiver=owner";
	} else { 
		$contact_email = "javascript:void(0);"; $contact_email_style = "cursor:default";  
	}
    
	$classified_description = "";
    if (is_array($array_fields) && (in_array("long_description", $array_fields))){
        $classified_description = $classified->getStringLang(EDIR_LANGUAGE, "detaildesc", true);
    }
	
	$imageTag = "";
	
	$imageObj = new Image($classified->getNumber("image_id"));
    if (is_array($array_fields) && in_array("main_image", $array_fields)){
        if ($imageObj->imageExists()) {

            $langIndex = language_getIndex(EDIR_LANGUAGE);
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            $sql = "SELECT image_caption$langIndex,thumb_caption$langIndex FROM Gallery_Image WHERE image_id=".$classified->getNumber("image_id");
            $r = $dbObj->query($sql);
            while ($row_aux = mysql_fetch_array($r)) {
                $imagecaption=$row_aux["image_caption$langIndex"];
                $thumbcaption=$row_aux["thumb_caption$langIndex"];
            }

            $imageTag .= "<div class=\"no-link\" ".(RESIZE_IMAGES_UPGRADE == "off" ? "style=\"text-align:center\"" : "").">";
            $imageTag .= $imageObj->getTag(true, IMAGE_CLASSIFIED_FULL_WIDTH, IMAGE_CLASSIFIED_FULL_HEIGHT, ($thumbcaption ? $thumbcaption : $classified->getString("title", true)), true);
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

	$classifiedGallery = "";
    if (USE_GALLERY_PLUGIN) {
        $classifiedGallery = system_showFrontGalleryPlugin($classified->getGalleries(), $classified->getNumber("level"), $user, GALLERY_DETAIL_IMAGES, "classified", EDIR_LANGUAGE, $tPreview, $onlyMain);
    } else {
        $classifiedGallery = system_showFrontGallery($classified->getGalleries(), $classified->getNumber("level"), $user, GALLERY_DETAIL_IMAGES, "classified", EDIR_LANGUAGE, $tPreview);
    }
    
    // the following code modified by Debiprasad Sahoo (Indibits) on 19 July 2012
    $classified_video_snippet_width  = "";
    $classified_video_snippet_height = "";
    $classified_video_snippet = "";
    if ($classified->getString("video_snippet") && (is_array($array_fields) && in_array("video", $array_fields))) {
        $classified_video_snippet = system_getVideoSnippetCode($classified->getString("video_snippet", false), (DETAIL_FORCE_VIDEORESIZE ? IMAGE_LISTING_FULL_WIDTH : IMAGE_LISTING_FULL_WIDTH+6), (DETAIL_FORCE_VIDEORESIZE ? IMAGE_LISTING_FULL_HEIGHT : IMAGE_LISTING_FULL_HEIGHT+56 ));
    }
    // end by Debiprasad

	
	$mapObj = new GoogleSettings(GOOGLE_MAPS_STATUS);
	if (GOOGLE_MAPS_ENABLED == "on" && $mapObj->getString("value") == "on") {
		$google_image_id = $classified->getNumber("thumb_id");
		$google_title = addslashes($classified->getString('title'));
		$google_phone = $classified->getString('phone');
		$google_address = $classified->getString('address');
		$google_address2 = $classified->getString('address2');
		$google_zipcode = $classified->getString('zip_code');
        if ($classified->getString('latitude') && $classified->getString('longitude')){
            $google_maptuning = $classified->getString('latitude').",".$classified->getString('longitude');
        }
		$google_mapzoom = $classified->getString('map_zoom');
		$google_location1 = $classified->getLocationString("1", true);
		$google_location3 = $classified->getLocationString("3", true);
		$google_location4 = $classified->getLocationString("4", true);
		$google_zip = $classified->getLocationString("z", true);
		$google_location_showaddress = $classified->getLocationString("A, 4, 3, 1", true);
		$show_html = true;
		include(INCLUDES_DIR."/views/view_google_maps.php");
		$classified_googlemaps = $google_maps;
		$google_maps = "";
	}
    
    $detailFileName = INCLUDES_DIR."/views/view_classified_detail_code.php";
    $themeDetailFileName = INCLUDES_DIR."/views/view_classified_detail_code_".EDIR_THEME.".php";
    
	if (file_exists($themeDetailFileName)){
        include($themeDetailFileName);
    } else {
        include($detailFileName);
    }

?>