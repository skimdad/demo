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
    # * FILE: /includes/code/promotion.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # SUBMIT
    # ----------------------------------------------------------------------------------------------------
    $language_numbers = explode(",", EDIR_LANGUAGENUMBERS);
    $edir_languages = explode(",", EDIR_LANGUAGES);

    $dbMain = db_getDBObject(DEFAULT_DB, true);
    $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (!$_POST['visibility']) {
            $_POST['visibility_start'] = 24;
            $_POST['visibility_end'] = 24;
        } else {
            if (CLOCK_TYPE == '12') {
                if ($_POST["start_time_am_pm"] == "am") {
                    $startTimeInfo = $_POST["start_time_hour"] * 60 + $_POST["start_time_min"];
                } else if ($_POST["start_time_am_pm"] == "pm") {
                    $startTimeInfo = ($_POST["start_time_hour"] + 12) * 60 + $_POST["start_time_min"];
                }

                if ($_POST["end_time_am_pm"] == "am") {
                    $endTimeInfo = $_POST["end_time_hour"] * 60 + $_POST["end_time_min"];
                } else if ($_POST["end_time_am_pm"] == "pm") {
                    $endTimeInfo = ($_POST["end_time_hour"] + 12) * 60 + $_POST["end_time_min"];
                }
            } else {
                $startTimeInfo = $_POST["start_time_hour"] * 60 + $_POST["start_time_min"];
                $endTimeInfo = $_POST["end_time_hour"] * 60 + $_POST["end_time_min"];
            }

            $_POST['visibility_start'] = $startTimeInfo;
            $_POST['visibility_end'] = $endTimeInfo;
        }

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
            $arr_keywords = explode("\n", ${"keywords" . $labelsuffix});
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

        $_POST["name"] = trim($_POST["name"]);
        $_POST["name"] = preg_replace('/\s\s+/', ' ', $_POST["name"]);

        foreach ($language_numbers as $i) {
            $labelsuffix = $i;
            // strip \r chars provided by Windows, in order to keep character count standard
            if ($_POST["description" . $labelsuffix]) {
                $_POST["description" . $labelsuffix] = str_replace("\r", "", $_POST["description" . $labelsuffix]);
            }
            if ($_POST["long_description" . $labelsuffix]) {
                $_POST["long_description" . $labelsuffix] = str_replace("\r", "", $_POST["long_description" . $labelsuffix]);
            }
            if ($_POST["conditions" . $labelsuffix]) {
                $_POST["conditions" . $labelsuffix] = str_replace("\r", "", $_POST["conditions" . $labelsuffix]);
            }
        }

        $_POST["realvalue"] = $_POST["real_price_int"] . "." . $_POST["real_price_cent"];
        $_POST["dealvalue"] = $_POST["deal_price_int"] . "." . $_POST["deal_price_cent"];

        if ($_POST["deal_type"] == "monetary value") {
            $_POST["dealvalue"] = $_POST["deal_price_int"] . "." . $_POST["deal_price_cent"];
        } else {
            $_POST["deal_price_int"] = str_replace(".", "", $_POST["deal_price_int"]);
            $_POST["deal_price_int"] = str_replace(",", "", $_POST["deal_price_int"]);
            if ($_POST["deal_price_int"] < 0){
                $_POST["deal_price_int"] = $_POST["deal_price_int"] * (-1);
            }
                
            if (is_numeric($_POST["deal_price_int"])){
                $_POST["dealvalue"] = ($_POST["realvalue"] - ($_POST["deal_price_int"] * $_POST["realvalue"]) / 100);
            }else{
                $_POST["dealvalue"] = $_POST["deal_price_int"];
            }
        }
        if ($_POST["dealvalue"] < 0){
            $_POST["dealvalue"] = $_POST["dealvalue"] * (-1);
        }

        $_POST["friendly_url"] = str_replace(".htm", "", $_POST["friendly_url"]);
        $_POST["friendly_url"] = str_replace(".html", "", $_POST["friendly_url"]);
        $_POST["friendly_url"] = trim($_POST["friendly_url"]);
        
        /**
         * Validating friendly_url
         *****************************/
        $sqlFriendlyURL = "";
        $sqlFriendlyURL .= " SELECT friendly_url FROM Promotion WHERE friendly_url = " . db_formatString($_POST["friendly_url"]) . " ";
        if ($id) {
            $sqlFriendlyURL .= " AND id != $id ";
        }
        $sqlFriendlyURL .= " LIMIT 1 ";
        $resultFriendlyURL = $dbObj->query($sqlFriendlyURL);
        if (mysql_num_rows($resultFriendlyURL) > 0) {
            if ($id) {
                $_POST["friendly_url"] = $_POST["friendly_url"] . FRIENDLYURL_SEPARATOR . $id;
            } else {
                $_POST["friendly_url"] = $_POST["friendly_url"] . FRIENDLYURL_SEPARATOR . uniqid();
            }
        }
        if (!$id && !$_POST["friendly_url"]) {
            $_POST["friendly_url"] = uniqid();
        }
        /*****************************/
        
        if (validate_form("promotion", $_POST, $message_promotion) && ($upload_image != "failed")) {

            $upload_image = "no image";

            //Clean Image
            if ($remove_image) {
                $promotion = new Promotion($id);
                if ($idm = $promotion->getNumber("image_id")) {
                    $image = new Image($idm);
                    if ($image) {
                        $image->Delete();
                    }
                }
                if ($idm = $promotion->getNumber("thumb_id")) {
                    $image = new Image($idm);
                    if ($image) {
                        $image->Delete();
                    }
                }
                unset($promotion);
            }
            
            // removing linebreaks from seo_description
            if (!$id) {

                for ($i = 0; $i < count(explode(",", EDIR_LANGUAGES)); $i++) {
                    $labelsuffix = "";
                    if ($i){
                        $labelsuffix = $i;
                    }
                        
                    ($_POST["seo_description" . $labelsuffix] = str_replace("\n", " ", $_POST["seo_description" . $labelsuffix]));
                }
            }

            // Image Crop
            if ($_POST["image_type"] != "") {

                // TYPES
                //1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order),
                //9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF, 15 = WBMP, 16 = XBM
                $user_id = $_COOKIE["PHPSESSID"];
                $dir = EDIRECTORY_ROOT . "/custom/domain_" . SELECTED_DOMAIN_ID . "/image_files/";
                $files = glob("$dir/_0_" . $user_id . "_*.*");
                switch ($_POST["image_type"]) {
                    case 1:
                        $img_type = 'gif';
                        $img_r = imagecreatefromgif($files[0]);
                        break;
                    case 2:
                        $img_type = 'jpeg';
                        $img_r = imagecreatefromjpeg($files[0]);
                        break;
                    case 3:
                        $img_type = 'png';
                        $img_r = imagecreatefrompng($files[0]);
                        break;
                }

                $dst_r = ImageCreateTrueColor($_POST['w'], $_POST['h']);

                if ($img_r) {
                    if ($img_type == "png" || $img_type == "gif") {
                        imagealphablending($dst_r, false);
                        imagesavealpha($dst_r, true);
                        $transparent = imagecolorallocatealpha($dst_r, 255, 255, 255, 127);
                        imagefill($dst_r, 0, 0, $transparent);
                        imagecolortransparent($dst_r, $transparent);
                    }

                    if ($img_type == "gif") { //use imagecopyresized for gif to keep the transparency. The functions imagecopyresized and imagecopyresampled works in the same way with the exception that the resized image generated through imagecopyresampled is smoothed so that it is still visible.
                        //low quality
                        imagecopyresized($dst_r, $img_r, 0, 0, $_POST["x"], $_POST["y"], $_POST["w"], $_POST["h"], $_POST["w"], $_POST["h"]
                        );
                    } else {
                        //better quality
                        imagecopyresampled($dst_r, $img_r, 0, 0, $_POST["x"], $_POST["y"], $_POST["w"], $_POST["h"], $_POST["w"], $_POST["h"]
                        );
                    }
                }

                $crop_image = $dir . "crop_image.$img_type";
                if ($img_type == 'gif') {
                    imagegif($dst_r, $crop_image);
                } elseif ($img_type == 'jpeg') {
                    imagejpeg($dst_r, $crop_image);
                } elseif ($img_type == 'png') {
                    imagepng($dst_r, $crop_image);
                }

                if (string_strpos($_SERVER["PHP_SELF"], "sitemgr")) {
                    $auxPrefix = "sitemgr_";
                } else {
                    $auxPrefix = $_SESSION[SESS_ACCOUNT_ID] . "_";
                }

				if ($_POST["account_id"]){
					$auxPrefix = $_POST["account_id"]."_";
                }
                //removing image files
                foreach ($files as $file)
                    unlink($file);
                if ((file_exists($_FILES['image']['tmp_name']) || file_exists($crop_image)) && (!$crop_submit)) {
                    $imageArray = image_uploadForItem((($crop_image) ? $crop_image : $_FILES['image']['tmp_name']), $auxPrefix, IMAGE_PROMOTION_FULL_WIDTH, IMAGE_PROMOTION_FULL_HEIGHT, IMAGE_PROMOTION_THUMB_WIDTH, IMAGE_PROMOTION_THUMB_HEIGHT);
                    if ($imageArray["success"]) {
                        $upload_image = "success";
                        $remove_image = false;
                    }else
                        $upload_image = "failed";
                }
            }
            
            // Saving Deal
            if ($upload_image != "failed" && !$crop_submit) {
                
                $promotion = new Promotion($id);

                /* security bug */
                if (string_strpos($url_base, "/members") !== false) {
                    if ($promotion->getNumber("id")) {
                        if ($promotion->getNumber("account_id") != sess_getAccountIdFromSession()) {
                            header("Location: " . $url_base . "/" . PROMOTION_FEATURE_FOLDER . "/" . (($search_page) ? "search.php" : "index.php"));
                            exit;
                        }
                    }
                }

                // Changing account for Deal
                if (string_strpos($url_base, "/sitemgr") && $id && ($promotion->getNumber("account_id") != $_POST["account_id"])) {

                    $promotion->cleanup();
                    
                    $image_idT = $promotion->getNumber("image_id");
                    $thumb_idT = $promotion->getNumber("thumb_id");

                    system_renameGalleryImages($image_idT, $thumb_idT, $_POST["account_id"]);

                }
                
                /**
                 * Get information about listing
                 */
                if($listing_id){
                    
                    unset($listingObj);
                    $listingObj = new Listing($_POST["listing_id"]);
                    $_POST["listing_status"]        = $listingObj->getString("status");
                    $_POST["listing_level"]         = $listingObj->getNumber("level");
                    $_POST["listing_location_1"]    = $listingObj->getNumber("location_1");
                    $_POST["listing_location_2"]    = $listingObj->getNumber("location_2");
                    $_POST["listing_location_3"]    = $listingObj->getNumber("location_3");
                    $_POST["listing_location_4"]    = $listingObj->getNumber("location_4");
                    $_POST["listing_location_5"]    = $listingObj->getNumber("location_5");
                    $_POST["listing_address"]       = $listingObj->getString("address");
                    $_POST["listing_address2"]      = $listingObj->getString("address2");
                    $_POST["listing_zipcode"]       = $listingObj->getString("zip_code");
                    $_POST["listing_zip5"]          = $listingObj->getString("zip5");
                    $_POST["listing_latitude"]      = $listingObj->getString("latitude");
                    $_POST["listing_longitude"]     = $listingObj->getString("longitude");
                    
                } else {
                    $_POST["listing_status"]        = '';
                    $_POST["listing_level"]         = 0;
                    $_POST["listing_location_1"]    = 0;
                    $_POST["listing_location_2"]    = 0;
                    $_POST["listing_location_3"]    = 0;
                    $_POST["listing_location_4"]    = 0;
                    $_POST["listing_location_5"]    = 0;
                    $_POST["listing_address"]       = '';
                    $_POST["listing_address2"]      = '';
                    $_POST["listing_zipcode"]       = '';
                    $_POST["listing_zip5"]          = '0';
                    $_POST["listing_latitude"]      = '';
                    $_POST["listing_longitude"]     = '';
                }

                $promotion->makeFromRow($_POST);

                if ($upload_image == "success") {
                    $promotion->updateImage($imageArray);
                }

                if ($remove_image) {
                    $promotion->setNumber("image_id", 0);
                    $promotion->setNumber("thumb_id", 0);
                }

                $promotion->Save();
                
                if (!$id && $listing_id) {
                    /*
                     * To link the listing with the Deal
                     */
                    $listingObj = new Listing($listing_id);
                    
                    
                    /*if ($listingObj->getNumber("promotion_id") > 0){
                        $listingObj->removePromotionID();
                    }*/
                    
                    if ($listingObj->getNumber("id")) {
                    	// the following code is modified by Debiprasad on 11th Aug. 2012
	                    if ($listingObj->getNumber("promotion_id") == 0){
	                        $listingObj->setNumber("promotion_id", $promotion->getNumber("id"));  
	                    } else if ($listingObj->getNumber("promotion_id_two") == 0){
	                        $listingObj->setNumber("promotion_id_two", $promotion->getNumber("id"));  
	                    } else if ($listingObj->getNumber("promotion_id_three") == 0){
	                        $listingObj->setNumber("promotion_id_three", $promotion->getNumber("id"));  
	                    } else if ($listingObj->getNumber("promotion_id_four") == 0){
	                        $listingObj->setNumber("promotion_id_four", $promotion->getNumber("id"));  
	                    } else if ($listingObj->getNumber("promotion_id_five") == 0){
	                        $listingObj->setNumber("promotion_id_five", $promotion->getNumber("id"));  
	                    }

                        //$listingObj->setNumber("promotion_id", $promotion->getNumber("id"));
                        $listingObj->Save();
                    }
                } else {
                    if ($id) {
                    	// TODO: modify this
                        //$promotion->cleanup();
                        $aux_id = $id;
                    } else {
                        $aux_id = $promotion->getNumber("id");
                    }

                    $listingObj = new Listing($listing_id);

	                if ($listingObj->getNumber("id")) {
	                	// the following code is modified by Debiprasad on 11th Aug. 2012
	                    switch ($aux_id) {
		                    case $listingObj->getNumber("promotion_id"):
		                    	$listingObj->setNumber("promotion_id", $aux_id);
		                    break;
		                    
		                    case $listingObj->getNumber("promotion_id_two"):
		                    	$listingObj->setNumber("promotion_id_two", $aux_id);  
		                    break;
		                    
		                    case $listingObj->getNumber("promotion_id_three"):
		                    	$listingObj->setNumber("promotion_id_three", $aux_id);  
		                    break;
		                    
		                    case $listingObj->getNumber("promotion_id_four"):
		                    	$listingObj->setNumber("promotion_id_four", $aux_id);  
		                    break;
		                    
		                    case $listingObj->getNumber("promotion_id_five"):
		                    	$listingObj->setNumber("promotion_id_five", $aux_id);  
		                    break;
		                    
		                    default:
			                    if ($listingObj->getNumber("promotion_id") == 0){
			                        $listingObj->setNumber("promotion_id", $aux_id);  
			                    } else if ($listingObj->getNumber("promotion_id_two") == 0){
			                        $listingObj->setNumber("promotion_id_two", $aux_id);  
			                    } else if ($listingObj->getNumber("promotion_id_three") == 0){
			                        $listingObj->setNumber("promotion_id_three", $aux_id);  
			                    } else if ($listingObj->getNumber("promotion_id_four") == 0){
			                        $listingObj->setNumber("promotion_id_four", $aux_id);  
			                    } else if ($listingObj->getNumber("promotion_id_five") == 0){
			                        $listingObj->setNumber("promotion_id_five", $aux_id);  
			                    }
	                    }


                        //$listingObj->setNumber("promotion_id", $aux_id);
                        $listingObj->Save();
                    } else if ($id) {
	                    // updated without listing 
	                    $promotion->cleanup();
                    }
                    
                }

                if ($id) {
                    $message = 2;
                } else {
                    $message = 1;
                }

                if (string_strpos($url_base, "/members") !== false) {
                    $promotion->autoSetListing(sess_getAccountIdFromSession());
                }

                header("Location: " . $url_base . "/" . PROMOTION_FEATURE_FOLDER . "/" . (($search_page) ? "search.php" : "index.php") . "?message=" . $message . (($id) ? "" : "&newest=1") . "&screen=$screen&letter=$letter" . (($url_search_params) ? "&$url_search_params" : "") . (($id) ? "" : "&extra_message=1"));
                exit;
            } else if ($upload_image == "failed") {
                $message_promotion .= system_showText(LANG_MSG_INVALID_IMAGE_TYPE);
            }
        }

        // removing slashes added if required
        $_POST = format_magicQuotes($_POST);
        $_GET = format_magicQuotes($_GET);
        extract($_POST);
        extract($_GET);
    }

    # ----------------------------------------------------------------------------------------------------
    # FORMS DEFINES
    # ----------------------------------------------------------------------------------------------------
    if ($id) {

        if (string_strpos($url_base, "/members")) {
            $by_key = array("id", "account_id");
            $by_value = array(db_formatNumber($id), sess_getAccountIdFromSession());
            $promotion = db_getFromDB("promotion", $by_key, $by_value, 1, "", "object", SELECTED_DOMAIN_ID);
        } else {
            $promotion = db_getFromDB("promotion", "id", db_formatNumber($id), 1, "", "object", SELECTED_DOMAIN_ID);
        }

        if ((sess_getAccountIdFromSession() != $promotion->getNumber("account_id")) && (!string_strpos($url_base, "/sitemgr"))) {
            header("Location: " . $url_base . "/" . PROMOTION_FEATURE_FOLDER . "/" . (($search_page) ? "search.php" : "index.php") . "?screen=$screen&letter=$letter" . (($url_search_params) ? "&$url_search_params" : "") . "");
            exit;
        }

        $promotion->extract();

        if ($deal_type == "percentage") {
            $deal_price_int = 100 - ((100 * $dealvalue) / $realvalue);
        }
    } else {

        $promotion = new Promotion();
        $promotion->makeFromRow($_POST);

        foreach ($language_numbers as $k => $i) {
            $labelsuffix = $i;
            unset($promotion_default_conditions);
            customtext_get("promotion_default_conditions", $promotion_default_conditions, $edir_languages[$k]);
            ${"conditions" . $labelsuffix} = $promotion_default_conditions;
        }
    }

    extract($_POST);
    extract($_GET);

    if ($listing_id) {
        $listingObj = new Listing($listing_id);
        if (string_strpos($url_base, "/members")) {
            if ($acctId != $listingObj->getNumber("account_id")) {
                header("Location: " . $url_base . "/" . PROMOTION_FEATURE_FOLDER . "/index.php");
                exit;
            }
        } else {
            $account_id = $listingObj->getNumber("account_id");
        }
        
        /*
         * Get Listing Information
         */
        $aux_listing_title = $listingObj->getString("title");
        $aux_listing_id = $listingObj->getNumber("id");
    }

    /**
     * Listing Dropdown
     */
    unset($arrListingsNames, $arrListingsValues, $sListingNames, $sListingValues, $dealLevels);
    $levelObj = new ListingLevel();
    $levels = $levelObj->getValues();
    foreach ($levels as $level) {
        if ($levelObj->getHasPromotion($level) == "y") {
            $dealLevels[] = $level;
        }
    }

    $dealLevels = implode(",", $dealLevels);
    $levelWhere = "AND `level` IN ($dealLevels)";

    if ($id) {     
        $sqlListing = "SELECT id, title FROM Listing_Summary WHERE promotion_id = ".$id;
        $resListing = $dbObj->query($sqlListing);
        if(mysql_num_rows($resListing)){
            $rowListing     = mysql_fetch_assoc($resListing);
            $aux_listing_title = $rowListing["title"];
            $aux_listing_id = $rowListing["id"];
        }
    } else if(!$account_id && $members){
        $account_id = sess_getAccountIdFromSession();
    }

    $sthArray24h = Array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "00");
    $ethArray24h = Array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "00");
    $sthArray = Array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
    $stmArray = Array("00", "05", "10", "15", "20", "25", "30", "35", "40", "45", "50", "55");
    $ethArray = Array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
    $etmArray = Array("00", "05", "10", "15", "20", "25", "30", "35", "40", "45", "50", "55");

    $aux_start = $visibility_start / 60;
    $aux_end = $visibility_end / 60;

    $start_time_min = round(($aux_start - (int) $aux_start) * 60);

    $end_time_min = round(($aux_end - (int) $aux_end) * 60);

    if (CLOCK_TYPE == '24') {
        $start_time_hour = (int) $aux_start;
        if ($start_time_hour == '24')
            $start_time_hour = '00';
    } elseif (CLOCK_TYPE == '12') {
        if ((int) $aux_start > "12") {
            $start_time_hour = (int) $aux_start - 12;
            $start_time_am_pm = "pm";
        } elseif ((int) $aux_start == "12") {
            $start_time_hour = 12;
            $start_time_am_pm = "am";
        } elseif ((int) $aux_start == "00") {
            $start_time_hour = 12;
            $start_time_am_pm = "pm";
        } else {
            $start_time_hour = (int) $aux_start;
            $start_time_am_pm = "am";
        }
    }
    if ($start_time_hour < 10)
        $start_time_hour = "0" . $start_time_hour;

    if (CLOCK_TYPE == '24') {
        $end_time_hour = (int) $aux_end;
        if ($end_time_hour == '24')
            $end_time_hour = '00';
    } elseif (CLOCK_TYPE == '12') {
        if ((int) $aux_end > "12") {
            $end_time_hour = (int) $aux_end - 12;
            $end_time_am_pm = "pm";
        } elseif ((int) $aux_end == "12") {
            $end_time_hour = 12;
            $end_time_am_pm = "am";
        } elseif ((int) $aux_end == "00") {
            $end_time_hour = 12;
            $end_time_am_pm = "pm";
        } else {
            $end_time_hour = (int) $aux_end;
            $end_time_am_pm = "am";
        }
    }
    if ($end_time_hour < 10)
        $end_time_hour = "0" . $end_time_hour;
    if ($start_time_min == 0)
        $start_time_min = "00";
    if ($end_time_min == 0)
        $end_time_min = "00";
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

    ##################################################
    ### KEYWORDS
    ##################################################
    foreach ($language_numbers as $i) {
        $labelsuffix = $i;
        unset($arr_keywords);
        if ($_POST["keywords" . $labelsuffix]) {
            $arr_keywords = explode(" || ", $_POST["keywords" . $labelsuffix]);
            ${"keywords" . $labelsuffix} = implode("\n", $arr_keywords);
        } elseif ($promotion->getString("keywords" . $labelsuffix)) {
            $arr_keywords = explode(" || ", $promotion->getString("keywords" . $labelsuffix));
            ${"keywords" . $labelsuffix} = implode("\n", $arr_keywords);
        }
    }
    ##################################################
?>