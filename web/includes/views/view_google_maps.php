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
	# * FILE: /includes/views/view_google_maps.php
	# ----------------------------------------------------------------------------------------------------

	$google_maps = "";

	# ----------------------------------------------------------------------------------------------------
	# * VALIDATION
	# ----------------------------------------------------------------------------------------------------

	$googleSettingObj = new GoogleSettings(GOOGLE_MAPS_STATUS, $_SERVER["HTTP_HOST"]);
	if ($googleSettingObj->getString("value") == "on") {
        
        $googleSettingObj = new GoogleSettings(GOOGLE_MAPS_SETTING, $_SERVER["HTTP_HOST"]);
        
        /* key for demodirectory.com */
		if (DEMO_LIVE_MODE) {
			$googleMapsKey = GOOGLE_MAPS_APP_DEMO;
		} else {
            $googleMapsKey = ($googleSettingObj->getString("value"));
        }

        $img_html = "";
        $imageObj = new Image($google_image_id);
        if ($imageObj->imageExists()) {
            $img_tag = $imageObj->getTag(true, GOOGLE_MAPS_IMAGE_WIDTH, GOOGLE_MAPS_IMAGE_HEIGHT, $google_title);
            $img_html .= "";
            $img_html .= $img_tag;
            $img_html .= "";

            $img_html = str_replace('"', "'", $img_html);
        }

        $google_address = str_replace('"', '', str_replace("'", "", $google_address));
        $google_address2 = str_replace('"', '', str_replace("'", "", $google_address2));
        $google_phone = str_replace('"', '', str_replace("'", "", $google_phone));
        $google_zip = str_replace('"', '', str_replace("'", "", $google_zip));
        $google_location = str_replace('"', '', str_replace("'", "", $google_location));

        $html = "";
        if ($show_html) {
            $html .= "<div class='map-info-view'>";
            $html .= "";
            if ($img_html) {
                $html .= $img_html;
            }
            $html .= "";
            $html .= "<h1>";
            $html .= $google_title;
            $html .= "</h1>";
            $html .= "<p>";
            $html .= $google_phone;
            $html .= "<br />";
            $html .= "";
            $html .= $google_address.(($google_address2) ? "<br />".$google_address2 : "");
            $html .= "<br />";
            $html .= "";
            $html .= $google_city;
            ($google_state && $google_city) ? $html .= ", " : '';
            $html .= $google_state;
            ($google_zip && $google_state) ? $html .= ", " : '';
            $html .= $google_zip;
            $html .= "</p>";
            $html .= "";
            $html .= "</div>";
            $html .= "<br class='clear' />";
        }

        $googleMap = new GoogleMap();
        $googleMap->setGoogleMapKey($googleMapsKey);
        $googleMap->setNumbered(false);
        $googleMap->setDivName("map");
        $googleMap->setCssClass("googleBase");
        $googleMap->addAddress($google_address, $google_address2, $google_location1, $google_location3, $google_location4, $google_zip, $google_maptuning, $google_mapzoom, $html, $aux);
        $googleMap->isMobileApp_MOBI =  $isMobileApp_MOBI;
		
        $google_maps = $googleMap->getMapCodev3();

    }

?>
