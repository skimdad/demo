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
    # * FILE: /includes/views/view_listing_detail.php
    # ----------------------------------------------------------------------------------------------------

    //Get fields according to level
    unset($array_fields);
    $array_fields = system_getFormFields("Listing", $listing->getNumber("level"));

    $listingtemplate_icon_navbar = "";
	include(EDIRECTORY_ROOT."/includes/views/icon_listing.php");
	$listingtemplate_icon_navbar = $icon_navbar;
	$icon_navbar = "";

    $listingtemplate_claim = "";
    if (CLAIM_FEATURE == "on" && !$tPreview) {
        if (!$listing->getNumber("account_id")) {
            if ($listing->getString("claim_disable") == "n") {
                customtext_get("claim_textlink", $claim_textlink, EDIR_LANGUAGE);
                if ($claim_textlink) $claim_textlink_string = $claim_textlink;
                $listingtemplate_claim = "<p class=\"claim\"><a href=\"".$claim_link."\" ".$claim_style.">".$claim_textlink_string."</a></p>";
            }
        }
    }

    $listingtemplate_video_snippet_width  = "";
    $listingtemplate_video_snippet_height = "";
    $listingtemplate_video_snippet = "";
    if ($listing->getString("video_snippet") && (is_array($array_fields) && in_array("video", $array_fields))) {
        $listingtemplate_video_snippet = system_getVideoSnippetCode($listing->getString("video_snippet", false), (DETAIL_FORCE_VIDEORESIZE ? IMAGE_LISTING_FULL_WIDTH : IMAGE_LISTING_FULL_WIDTH+6), (DETAIL_FORCE_VIDEORESIZE ? IMAGE_LISTING_FULL_HEIGHT : IMAGE_LISTING_FULL_HEIGHT+56 ));
    }

    $listingtemplate_image_width = "";
    $listingtemplate_image_heigth = "";
    $listingtemplate_image = "";
    $listingtemplate_image_width = IMAGE_LISTING_FULL_WIDTH + 20;
    $listingtemplate_image_heigth = IMAGE_LISTING_FULL_HEIGHT;
    
    if (is_array($array_fields) && in_array("main_image", $array_fields)){
        $imageObj = new Image($listing->getNumber("image_id"));
        if ($imageObj->imageExists()) {
            $langIndex = language_getIndex(EDIR_LANGUAGE);
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            $sql = "SELECT image_caption$langIndex,thumb_caption$langIndex FROM Gallery_Image WHERE image_id=".$listing->getNumber("image_id");
            $r = $db->query($sql);
            while ($row_aux = mysql_fetch_array($r)) {
                $imagecaption = $row_aux["image_caption$langIndex"];
                $thumbcaption = $row_aux["thumb_caption$langIndex"];
            }
            $listingtemplate_image = "<div class=\"no-link\" ".(RESIZE_IMAGES_UPGRADE == "off" ? "style=\"text-align:center\"" : "").">";
            $listingtemplate_image .= $imageObj->getTag(true, IMAGE_LISTING_FULL_WIDTH, IMAGE_LISTING_FULL_HEIGHT, ($thumbcaption ? $thumbcaption : $listing->getString("title", true)), true);
            $listingtemplate_image .= "</div>";
            $aux_thumbcaption = "";
            if (USE_GALLERY_PLUGIN){
                $aux_thumbcaption = "<strong style=\"display:block\">$thumbcaption</strong>";
            }
            if ($imagecaption) $listingtemplate_image .= "<p class=\"image-caption\">$aux_thumbcaption".$imagecaption."</p>";
        } else {
            $onlyMain = true;
            $listingtemplate_image = "<span class=\"no-image no-link\"></span>";
        }
    }

	$mapObj = new GoogleSettings(GOOGLE_MAPS_STATUS);
	$listingtemplate_google_maps = "";
	if (GOOGLE_MAPS_ENABLED == "on" && $mapObj->getString("value") == "on") {
		$google_image_id = $listing->getNumber("image_id");
		$google_title = addslashes($listing->getString('title'));
		$google_phone = $listing->getString('phone');
		if ($tPreview) {
			$google_address = "";
			$google_address2 = "";
			$google_location1 = "";
			$google_location3 = "";
			$google_location4 = "";
			$google_zip = "";
			$google_maptuning = "";
			$google_mapzoom = "";
			$google_location_showaddress = "";
		} else {
			$google_address = $listing->getString('address');
			$google_address2 = $listing->getString('address2');
			$google_location1 = $listing->getLocationString("1", true);
			$google_location3 = $listing->getLocationString("3", true);
			$google_location4 = $listing->getLocationString("4", true);
			$google_zip = $listing->getLocationString("z", true);
            if ($listing->getString('latitude') && $listing->getString('longitude')){
                $google_maptuning = $listing->getString('latitude').",".$listing->getString('longitude');
            }
			$google_mapzoom = $listing->getString('map_zoom');
			$google_location_showaddress = $listing->getLocationString("A, 4, 3, 1", true);
		}
		$show_html = true;
		include(INCLUDES_DIR."/views/view_google_maps.php");
		$listingtemplate_google_maps = $google_maps;
		$google_maps = "";
	}

    $listingtemplate_title = "";
    $listingtemplate_title = $listing->getString("title", true);
	
	if ($tPreview || !$user) {
		$listingtemplate_facebook_buttons = "<div style=\"float: left; width: 140px;\">";
		$listingtemplate_facebook_buttons .= "<img src=\"".DEFAULT_URL."/images/content/bt-facebook-like-sample.png\" alt=\"\" title=\"\" style=\"float: left; margin-right: 15px;\" />";
		$listingtemplate_facebook_buttons .= "<img src=\"".DEFAULT_URL."/images/content/bt-facebook-send-sample.png\" alt=\"\" title=\"\" />";
		$listingtemplate_facebook_buttons .= "</div>";
	} else {
		$listingtemplate_facebook_buttons = "
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
		$listingtemplate_googleplus_button = "<div>";
		$listingtemplate_googleplus_button .= "<img src=\"".DEFAULT_URL."/images/content/bt-google-plus-sample.png\" alt=\"\" title=\"\" />";
		$listingtemplate_googleplus_button .= "</div>";
 	}else{
	 	$aux_googleplus_button = system_prepareGooglePlus("button", DEFAULT_URL.$_SERVER["REQUEST_URI"]);
		if($aux_googleplus_button){
			
			if (GOOGLEPLUS_ON_IE8 == "on"){
				$listingtemplate_googleplus_button = $aux_googleplus_button;
			} else {
				$listingtemplate_googleplus_button = "
						<script language='javascript' type='text/javascript'>
							//<![CDATA[
							document.write('".$aux_googleplus_button."');
							//]]>
						</script>
						";
			}

		}else{
			$listingtemplate_googleplus_button = ""; 
		}
 	}
	
	$listingtemplate_twilioSMS = "";
	$listingtemplate_twilioClickToCall = "";
	
	if (TWILIO_APP_ENABLED == "on"){
		if (TWILIO_APP_ENABLED_SMS == "on"){
			$levelsWithSendPhone = system_retrieveLevelsWithInfoEnabled("has_sms");
			if ($levelsWithSendPhone) {
				if (in_array($listing->getNumber('level'), $levelsWithSendPhone)) {
					 /*
					 * Prepare link to Twilio SMS
					 */
					if ($user){
						$listingtemplate_twilioSMS = twilio_PrepareLink("Listing",$listing->getNumber("id"));
						$twilioSMS_style = "class=\"iframe fancy_window_twilio\"";
					} else {
						$listingtemplate_twilioSMS = "javascript: void(0);";
						$twilioSMS_style = "style=\"cursor: default;\"";
					}
				}
			}
		}
		
		if (TWILIO_APP_ENABLED_CALL == "on"){
			$levelsWithClickToCall = system_retrieveLevelsWithInfoEnabled("has_call");		
			if ($levelsWithClickToCall) {
				if (in_array($listing->getNumber('level'), $levelsWithClickToCall) && $listing->getString("clicktocall_number")) {
					 /*
					 * Prepare link to Twilio Click to Call
					 */
					if ($user){
						$listingtemplate_twilioClickToCall = twilio_PrepareLink("Listing", $listing->getNumber("id"), true);
						$twilioClickToCall_style = "class=\"iframe fancy_window_twilio\"";
					} else {
						$listingtemplate_twilioClickToCall = "javascript: void(0);";
						$twilioClickToCall_style = "style=\"cursor: default;\"";
					}
				}
			}
		}
	}
	
	$listingtemplate_designations = "";
    if ((is_array($array_fields) && in_array("badges", $array_fields))){
        include(INCLUDES_DIR."/tables/table_choice.php");
        $listingtemplate_designations = $designations;
        $designations = "";
    }

    $listingtemplate_address = "";
    if ($listing->getString("address")) {
        $listingtemplate_address = nl2br($listing->getString("address", true));
    }

    $listingtemplate_address2 = "";
    if ($listing->getString("address2")) {
        $listingtemplate_address2 = nl2br($listing->getString("address2", true));
    }

	$locationsToshow = system_retrieveLocationsToShow();
	$listingtemplate_location = "";
	if ($tPreview){
		$locationsToShow = explode (",", EDIR_LOCATIONS);
		$locationsToShow = array_reverse ($locationsToShow);
		foreach ($locationsToShow as $locationToShow) {
			$listingtemplate_location .= system_showText(constant("LANG_LABEL_".constant("LOCATION".$locationToShow."_SYSTEM"))).", ";
		}
		$listingtemplate_location = string_substr("$listingtemplate_location", 0, -2).', '.$listing->getString("zip_code");
	} else {
		$locationsParam = $locationsToshow." z";
		$listingtemplate_location = $listing->getLocationString($locationsParam, true);
	}

    $listingtemplate_description = "";
    if ($listing->getStringLang(EDIR_LANGUAGE, "description") && (is_array($array_fields) && in_array("summary_description", $array_fields))) {
        $listingtemplate_description = nl2br($listing->getStringLang(EDIR_LANGUAGE, "description", true));
    }

    $listingtemplate_phone = "";
    if ($listing->getString("phone")) {
        if ($user) {
            $listingtemplate_phone .= "<span id=\"phoneLink".$listing->getNumber("id")."\" class=\"show-inline\"><a href=\"javascript:showPhone('".$listing->getNumber("id")."','".DEFAULT_URL."');\">".system_showText(LANG_LISTING_VIEWPHONE)."</a></span>";
            $listingtemplate_phone .= "<span id=\"phoneNumber".$listing->getNumber("id")."\" class=\"hide\">".$listing->getString("phone", true)."</span>";
        } else {
            $listingtemplate_phone  = $listing->getString("phone", true);
        }
    }

    $listingtemplate_fax = "";
    if ($listing->getString("fax") && (is_array($array_fields) && in_array("fax", $array_fields))) {
        if ($user) {
            $listingtemplate_fax .= "<span id=\"faxLink".$listing->getNumber("id")."\" class=\"show-inline\"><a href=\"javascript:showFax('".$listing->getNumber("id")."', '".DEFAULT_URL."');\">".system_showText(LANG_LISTING_VIEWFAX)."</a></span>";
            $listingtemplate_fax .= "<span id=\"faxNumber".$listing->getNumber("id")."\" class=\"hide\">".$listing->getString("fax", true)."</span>";
        } else {
            $listingtemplate_fax  = $listing->getString("fax", true);
        }
    }

	$listingtemplate_url = "";
	if ($listing->getString("url") && (is_array($array_fields) && in_array("url", $array_fields))) {
		$display_url = $listing->getString("url");
		if ($listing->getString("display_url")) {
			$display_url = $listing->getString("display_url");
		}
		$display_url = wordwrap($display_url, 60, "<br />", true);
		if ($user) {
			$listingtemplate_url = "<a href=\"".DEFAULT_URL."/listing_reports.php?report=website&amp;id=".$listing->getNumber("id")."\" target=\"_blank\">".$display_url."</a>";
		} else {
			$listingtemplate_url = "<a href=\"javascript:void(0);\" style=\"cursor:default\">".$display_url."</a>";
		}
	}

    $listingtemplate_email = "";
    if ($listing->getString("email") && (is_array($array_fields) && in_array("email", $array_fields))) {
        if ($user){
			$listingtemplate_email = "<a href=\"".DEFAULT_URL."/popup/popup.php?pop_type=listing_emailform&amp;id=".$listing->getNumber("id")."&amp;receiver=owner\" class=\"iframe fancy_window_tofriend\">".system_showText(LANG_SEND_AN_EMAIL)."</a>";
			$listingtemplate_email_inquiry = "<a href=\"".DEFAULT_URL."/popup/popup.php?pop_type=listing_emailform&amp;id=".$listing->getNumber("id")."&amp;receiver=owner\" class=\"iframe fancy_window_tofriend\">".system_showText(LANG_LISTING_INQUIRY)."</a>";
        } else {
            $listingtemplate_email = "<a href=\"javascript:void(0);\" style=\"cursor:default\">".system_showText(LANG_SEND_AN_EMAIL)."</a>";
            $listingtemplate_email_inquiry = "<a href=\"javascript:void(0);\" style=\"cursor:default\">".system_showText(LANG_LISTING_INQUIRY)."</a>";
        }
    }

    $listingtemplate_attachment_file = "";
    if ($listing->getString("attachment_file") && (is_array($array_fields) && in_array("attachment_file", $array_fields))) {
        if (file_exists(EXTRAFILE_DIR."/".$listing->getString("attachment_file"))) {
            $listingtemplate_attachment_file .= "<p>";
				if ($user) {
					$listingtemplate_attachment_file .= "<a href=\"".EXTRAFILE_URL."/".$listing->getString("attachment_file")."\" target=\"_blank\">";
				} else {
					$listingtemplate_attachment_file .= "<a href=\"javascript:void(0);\" style=\"cursor:default;\">";
				}
				if ($listing->getString("attachment_caption")) {
					$listingtemplate_attachment_file .= $listing->getString("attachment_caption");
				} else {
					$listingtemplate_attachment_file .= system_showText(LANG_LISTING_ATTACHMENT);
				}
                $listingtemplate_attachment_file .= "</a>";
            $listingtemplate_attachment_file .= "</p>";
        }
    }

    $listingtemplate_category_tree = "";
	
	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$lang = EDIR_LANGUAGE;
	if ($tPreview) {
		$listingtemplate_category_tree = "<ul class=\"list list-category\">";
		$listingtemplate_category_tree .= "<li class=\"level-1\">";
		$listingtemplate_category_tree .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">";
		$listingtemplate_category_tree .= system_showText(LANG_LABEL_ADVERTISE_CATEGORY1)." ";
		$listingtemplate_category_tree .= "<span>(230)</span>";
		$listingtemplate_category_tree .= "</a>";
		$listingtemplate_category_tree .= "</li>";
		$listingtemplate_category_tree .= "<li class=\"level-2\">";
		$listingtemplate_category_tree .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">";
		$listingtemplate_category_tree .= system_showText(LANG_LABEL_ADVERTISE_CATEGORY1_2)." ";
		$listingtemplate_category_tree .= "<span>(200)</span>";
		$listingtemplate_category_tree .= "</a>";
		$listingtemplate_category_tree .= "</li>";
		$listingtemplate_category_tree .= "<li class=\"level-1\">";
		$listingtemplate_category_tree .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">";
		$listingtemplate_category_tree .= system_showText(LANG_LABEL_ADVERTISE_CATEGORY2)." ";
		$listingtemplate_category_tree .= "<span>(300)</span>";
		$listingtemplate_category_tree .= "</a>";
		$listingtemplate_category_tree .= "</li>";
		$listingtemplate_category_tree .= "<li class=\"level-2\">";
		$listingtemplate_category_tree .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">";
		$listingtemplate_category_tree .= system_showText(LANG_LABEL_ADVERTISE_CATEGORY2_2)." ";
		$listingtemplate_category_tree .= "<span>(230)</span>";
		$listingtemplate_category_tree .= "</a>";
		$listingtemplate_category_tree .= "</li>";
		$listingtemplate_category_tree .= "</ul>";
	} else {
		$categories = $listing->getCategories(false, false, $listing->getNumber("id"),true);
		if ($categories) {
			$array_categories_obj = array();
			for($i=0;$i<count($categories);$i++){
				unset($categoryObj);
				$categoryObj = new ListingCategory($categories[$i]["id"]);
				$arr_full_path[] = $categoryObj->getFullPath();
				$array_categories_obj[] = $categoryObj;	
			}

			if ($arr_full_path){
				$listingtemplate_category_tree = system_generateCategoryTree($array_categories_obj, $arr_full_path, "listing", $user, EDIR_LANGUAGE);
			}	
		}
	}

    $listingtemplate_long_description = "";
    if ($listing->getStringLang(EDIR_LANGUAGE, "long_description") && (is_array($array_fields) && in_array("long_description", $array_fields))) {
        $listingtemplate_long_description = nl2br($listing->getStringLang(EDIR_LANGUAGE, "long_description", true));
    }

    $listingtemplate_hours_work = "";
    if ($listing->getString("hours_work") && (is_array($array_fields) && in_array("hours_of_work", $array_fields))) {
        $listingtemplate_hours_work = nl2br($listing->getString("hours_work", true));
    }

    $listingtemplate_locations = "";
    if ($listing->getString("locations") && (is_array($array_fields) && in_array("locations", $array_fields))) {
        $listingtemplate_locations = nl2br($listing->getString("locations", true));
    }

    $listingtemplate_gallery = "";
    if (USE_GALLERY_PLUGIN) {
        $listingtemplate_gallery = system_showFrontGalleryPlugin($listing->getGalleries(), $listing->getNumber("level"), $user, GALLERY_DETAIL_IMAGES, "listing", EDIR_LANGUAGE, $tPreview, $onlyMain);
    } else {
        $listingtemplate_gallery = system_showFrontGallery($listing->getGalleries(), $listing->getNumber("level"), $user, GALLERY_DETAIL_IMAGES, "listing", EDIR_LANGUAGE, $tPreview);
    }

    $listingtemplate_review = "";
    $listingtemplate_summary_review = "";
	setting_get('commenting_edir', $commenting_edir);
    setting_get("review_listing_enabled", $review_enabled);
    if ($review_enabled == "on" && $commenting_edir) {
        $levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");
        if ($levelsWithReview) {
            if (in_array($listing->getNumber('level'), $levelsWithReview)) {
				$levelReview = true;
                $item_type = 'listing';
                if($listing->getNumber("id") > 0 || $tPreview){
                    $item_id   = $listing->getNumber('id');
                    include(INCLUDES_DIR."/views/view_review.php");
                    $listingtemplate_summary_review .= $item_review;
                    $item_review = "";
                    if ($reviewsArr) {
						
						$lastItemStyle = 0;
						$numberOfReviews = count($reviewsArr) > 3? 3: count($reviewsArr);
						$reviewMaxSize = 150;
						
                        foreach ($reviewsArr as $each_rate) {
                            if ($each_rate->getString("review")) {
                                $each_rate->extract();
                                include(INCLUDES_DIR."/views/view_review_detail.php");
                                $listingtemplate_review .= $item_reviewcomment;
                                $item_reviewcomment = "";
                            }
                        }
                    }
                }
            } else {
				$levelReview = false;
			}
        }
    }

	$listingtemplate_checkin = "";
    $listingtemplate_summary_checkin = "";

	$item_type = 'listing';
	if($listing->getNumber("id") > 0 || $tPreview){
		$item_id   = $listing->getNumber('id');
		include(INCLUDES_DIR."/views/view_checkin.php");
		$listingtemplate_summary_checkin .= $item_checkin;
		$item_checkin = "";
		if ($checkinsArr) {
			
			$lastItemStyle = 0;
			$numberOfCheckins = 3;

			foreach ($checkinsArr as $each_rate) {
				if ($each_rate->getString("quick_tip")) {
					$each_rate->extract();
					include(INCLUDES_DIR."/views/view_checkin_detail.php");
					$listingtemplate_checkin .= $item_checkincomment;
					$item_checkincomment = "";
				}
			}
		}
	}

    $listingviewtype = "detail";
	
    /*
    * DEAL ITEM
    */
	if ($levelObj->getHasPromotion($listing->getNumber("level")) == "y") {
		if ($tPreview) {
			if (PROMOTION_FEATURE == 'on' && CUSTOM_PROMOTION_FEATURE == 'on') {
				$hasDeal = true;
				$promotionInfo['price'] = "90";
				$promotionInfo['name'] = system_showText(LANG_LABEL_ADVERTISE_DEAL_TITLE);

				$offer = '10% '.system_showText(LANG_DEAL_OFF)."! ".CURRENCY_SYMBOL."90";
				$summary_offer = '10% '.system_showText(LANG_DEAL_OFF);

				$promotionInfo['offer'] = $offer;
				$promotionInfo['summary_offer'] = $summary_offer;

				$promotionInfo['url'] = 'javascript:void(0);';
				$promotionInfo['style'] = "style=\"cursor:default\"";

				$promotionInfo['image'] = "<a href=\"".$promotionInfo['url']."\" class=\"image\"><span class=\"no-image\" style=\"cursor: default;\"></span></a>";
			}
		} else {
			if($promotionObj) {
				unset($promotionObj);
				if ($promotion)
					unset($promotion);
			}
			$hasDeal = false;

			if ($listing->promotion_id  && (PROMOTION_FEATURE == 'on' && CUSTOM_PROMOTION_FEATURE == 'on')){

				$promotionObj = new Promotion($listing->promotion_id);

				if ((validate_date_deal($promotionObj->getDate("start_date"), $promotionObj->getDate("end_date"))) && (validate_period_deal($promotionObj->getNumber("visibility_start"),$promotionObj->getNumber("visibility_end")))){
					$hasDeal = true;

					$promotionInfo['price'] = string_substr($promotionObj->getNumber("dealvalue"),0,(string_strpos($promotionObj->getNumber("dealvalue"),".")));
					$promotionInfo['cents'] = string_substr($promotionObj->getNumber("dealvalue"),(string_strpos($promotionObj->getNumber("dealvalue"),".")),3);
					if ($promotionInfo['cents'] == ".00") $promotionInfo['cents'] = "";
					$promotionInfo['name'] = $promotionObj->getString('name');
					if ($promotionObj->realvalue>0 && $promotionObj->dealvalue>0){
						$offer = round(100-(($promotionObj->dealvalue*100)/$promotionObj->realvalue)).'% '.system_showText(LANG_DEAL_OFF)."! ".CURRENCY_SYMBOL.format_money($promotionObj->dealvalue,2);
						$summary_offer = round(100-(($promotionObj->dealvalue*100)/$promotionObj->realvalue)).'% '.system_showText(LANG_DEAL_OFF);
					}else{
						$offer = system_showText(LANG_NA);
					}
					$promotionInfo['offer'] = $offer;
					$promotionInfo['summary_offer'] = $summary_offer;
					$promotionInfo['description'] = nl2br($promotionObj->getStringLang(EDIR_LANGUAGE,'description',true));
					$promotionInfo['url'] = PROMOTION_DEFAULT_URL.'/'.((MODREWRITE_FEATURE!='on')?"detail.php?id=".$promotionObj->id:$promotionObj->getString('friendly_url').".html");
					if (!$user){
						$promotionInfo['url'] = 'javascript:void(0);';
						$promotionInfo['style'] = "style=\"cursor:default\"";
					}
					$imageObj = new Image($promotionObj->getNumber("thumb_id"));

					if ($imageObj->imageExists()){
						$promotionInfo['image'] = "<a href=\"".$promotionInfo['url']."\" class=\"image\">";$imageObj->getTag(true, IMAGE_PROMOTION_THUMB_BIG_WIDTH, IMAGE_PROMOTION_THUMB_BIG_HEIGHT,  $promotionInfo['name'], true);
						$promotionInfo['image'] .= $imageObj->getTag(true, IMAGE_PROMOTION_THUMB_BIG_WIDTH, IMAGE_PROMOTION_THUMB_BIG_HEIGHT,  $promotionInfo['name'], true);
						$promotionInfo['image'] .= "</a>";
					}else {
						if (!$user) {
							$promotionInfo['image'] = "<a href=\"".$promotionInfo['url']."\" class=\"image\"><span class=\"no-image\" style=\"cursor: default;\"></span></a>";
						} else {
							$promotionInfo['image'] = "<a href=\"".$promotionInfo['url']."\" class=\"image\"><span class=\"no-image\"></span></a>";
						}
					}
				}
			} // end
			if ($listing->promotion_id_two  && (PROMOTION_FEATURE == 'on' && CUSTOM_PROMOTION_FEATURE == 'on')){

				$promotionObj = new Promotion($listing->promotion_id_two);

				if ((validate_date_deal($promotionObj->getDate("start_date"), $promotionObj->getDate("end_date"))) && (validate_period_deal($promotionObj->getNumber("visibility_start"),$promotionObj->getNumber("visibility_end")))){
					$hasDeal = true;

					$promotionInfoTwo['price'] = string_substr($promotionObj->getNumber("dealvalue"),0,(string_strpos($promotionObj->getNumber("dealvalue"),".")));
					$promotionInfoTwo['cents'] = string_substr($promotionObj->getNumber("dealvalue"),(string_strpos($promotionObj->getNumber("dealvalue"),".")),3);
					if ($promotionInfoTwo['cents'] == ".00") $promotionInfoTwo['cents'] = "";
					$promotionInfoTwo['name'] = $promotionObj->getString('name');
					if ($promotionObj->realvalue>0 && $promotionObj->dealvalue>0){
						$offer = round(100-(($promotionObj->dealvalue*100)/$promotionObj->realvalue)).'% '.system_showText(LANG_DEAL_OFF)."! ".CURRENCY_SYMBOL.format_money($promotionObj->dealvalue,2);
						$summary_offer = round(100-(($promotionObj->dealvalue*100)/$promotionObj->realvalue)).'% '.system_showText(LANG_DEAL_OFF);
					}else{
						$offer = system_showText(LANG_NA);
					}
					$promotionInfoTwo['offer'] = $offer;
					$promotionInfoTwo['summary_offer'] = $summary_offer;
					$promotionInfoTwo['description'] = nl2br($promotionObj->getStringLang(EDIR_LANGUAGE,'description',true));
					$promotionInfoTwo['url'] = PROMOTION_DEFAULT_URL.'/'.((MODREWRITE_FEATURE!='on')?"detail.php?id=".$promotionObj->id:$promotionObj->getString('friendly_url').".html");
					if (!$user){
						$promotionInfoTwo['url'] = 'javascript:void(0);';
						$promotionInfoTwo['style'] = "style=\"cursor:default\"";
					}
					$imageObj = new Image($promotionObj->getNumber("thumb_id"));

					if ($imageObj->imageExists()){
						$promotionInfoTwo['image'] = "<a href=\"".$promotionInfoTwo['url']."\" class=\"image\">";$imageObj->getTag(true, IMAGE_PROMOTION_THUMB_BIG_WIDTH, IMAGE_PROMOTION_THUMB_BIG_HEIGHT,  $promotionInfoTwo['name'], true);
						$promotionInfoTwo['image'] .= $imageObj->getTag(true, IMAGE_PROMOTION_THUMB_BIG_WIDTH, IMAGE_PROMOTION_THUMB_BIG_HEIGHT,  $promotionInfoTwo['name'], true);
						$promotionInfoTwo['image'] .= "</a>";
					}else {
						if (!$user) {
							$promotionInfoTwo['image'] = "<a href=\"".$promotionInfoTwo['url']."\" class=\"image\"><span class=\"no-image\" style=\"cursor: default;\"></span></a>";
						} else {
							$promotionInfoTwo['image'] = "<a href=\"".$promotionInfoTwo['url']."\" class=\"image\"><span class=\"no-image\"></span></a>";
						}
					}
				}
			} // end
			if ($listing->promotion_id_three  && (PROMOTION_FEATURE == 'on' && CUSTOM_PROMOTION_FEATURE == 'on')){

				$promotionObj = new Promotion($listing->promotion_id_three);

				if ((validate_date_deal($promotionObj->getDate("start_date"), $promotionObj->getDate("end_date"))) && (validate_period_deal($promotionObj->getNumber("visibility_start"),$promotionObj->getNumber("visibility_end")))){
					$hasDeal = true;

					$promotionInfoThree['price'] = string_substr($promotionObj->getNumber("dealvalue"),0,(string_strpos($promotionObj->getNumber("dealvalue"),".")));
					$promotionInfoThree['cents'] = string_substr($promotionObj->getNumber("dealvalue"),(string_strpos($promotionObj->getNumber("dealvalue"),".")),3);
					if ($promotionInfoThree['cents'] == ".00") $promotionInfoThree['cents'] = "";
					$promotionInfoThree['name'] = $promotionObj->getString('name');
					if ($promotionObj->realvalue>0 && $promotionObj->dealvalue>0){
						$offer = round(100-(($promotionObj->dealvalue*100)/$promotionObj->realvalue)).'% '.system_showText(LANG_DEAL_OFF)."! ".CURRENCY_SYMBOL.format_money($promotionObj->dealvalue,2);
						$summary_offer = round(100-(($promotionObj->dealvalue*100)/$promotionObj->realvalue)).'% '.system_showText(LANG_DEAL_OFF);
					}else{
						$offer = system_showText(LANG_NA);
					}
					$promotionInfoThree['offer'] = $offer;
					$promotionInfoThree['summary_offer'] = $summary_offer;
					$promotionInfoThree['description'] = nl2br($promotionObj->getStringLang(EDIR_LANGUAGE,'description',true));
					$promotionInfoThree['url'] = PROMOTION_DEFAULT_URL.'/'.((MODREWRITE_FEATURE!='on')?"detail.php?id=".$promotionObj->id:$promotionObj->getString('friendly_url').".html");
					if (!$user){
						$promotionInfoThree['url'] = 'javascript:void(0);';
						$promotionInfoThree['style'] = "style=\"cursor:default\"";
					}
					$imageObj = new Image($promotionObj->getNumber("thumb_id"));

					if ($imageObj->imageExists()){
						$promotionInfoThree['image'] = "<a href=\"".$promotionInfoThree['url']."\" class=\"image\">";$imageObj->getTag(true, IMAGE_PROMOTION_THUMB_BIG_WIDTH, IMAGE_PROMOTION_THUMB_BIG_HEIGHT,  $promotionInfoThree['name'], true);
						$promotionInfoThree['image'] .= $imageObj->getTag(true, IMAGE_PROMOTION_THUMB_BIG_WIDTH, IMAGE_PROMOTION_THUMB_BIG_HEIGHT,  $promotionInfoThree['name'], true);
						$promotionInfoThree['image'] .= "</a>";
					}else {
						if (!$user) {
							$promotionInfoThree['image'] = "<a href=\"".$promotionInfoThree['url']."\" class=\"image\"><span class=\"no-image\" style=\"cursor: default;\"></span></a>";
						} else {
							$promotionInfoThree['image'] = "<a href=\"".$promotionInfoThree['url']."\" class=\"image\"><span class=\"no-image\"></span></a>";
						}
					}
				}
			} // end
			if ($listing->promotion_id_four  && (PROMOTION_FEATURE == 'on' && CUSTOM_PROMOTION_FEATURE == 'on')){

				$promotionObj = new Promotion($listing->promotion_id_four);

				if ((validate_date_deal($promotionObj->getDate("start_date"), $promotionObj->getDate("end_date"))) && (validate_period_deal($promotionObj->getNumber("visibility_start"),$promotionObj->getNumber("visibility_end")))){
					$hasDeal = true;

					$promotionInfoFour['price'] = string_substr($promotionObj->getNumber("dealvalue"),0,(string_strpos($promotionObj->getNumber("dealvalue"),".")));
					$promotionInfoFour['cents'] = string_substr($promotionObj->getNumber("dealvalue"),(string_strpos($promotionObj->getNumber("dealvalue"),".")),3);
					if ($promotionInfoFour['cents'] == ".00") $promotionInfoFour['cents'] = "";
					$promotionInfoFour['name'] = $promotionObj->getString('name');
					if ($promotionObj->realvalue>0 && $promotionObj->dealvalue>0){
						$offer = round(100-(($promotionObj->dealvalue*100)/$promotionObj->realvalue)).'% '.system_showText(LANG_DEAL_OFF)."! ".CURRENCY_SYMBOL.format_money($promotionObj->dealvalue,2);
						$summary_offer = round(100-(($promotionObj->dealvalue*100)/$promotionObj->realvalue)).'% '.system_showText(LANG_DEAL_OFF);
					}else{
						$offer = system_showText(LANG_NA);
					}
					$promotionInfoFour['offer'] = $offer;
					$promotionInfoFour['summary_offer'] = $summary_offer;
					$promotionInfoFour['description'] = nl2br($promotionObj->getStringLang(EDIR_LANGUAGE,'description',true));
					$promotionInfoFour['url'] = PROMOTION_DEFAULT_URL.'/'.((MODREWRITE_FEATURE!='on')?"detail.php?id=".$promotionObj->id:$promotionObj->getString('friendly_url').".html");
					if (!$user){
						$promotionInfoFour['url'] = 'javascript:void(0);';
						$promotionInfoFour['style'] = "style=\"cursor:default\"";
					}
					$imageObj = new Image($promotionObj->getNumber("thumb_id"));

					if ($imageObj->imageExists()){
						$promotionInfoFour['image'] = "<a href=\"".$promotionInfoFour['url']."\" class=\"image\">";$imageObj->getTag(true, IMAGE_PROMOTION_THUMB_BIG_WIDTH, IMAGE_PROMOTION_THUMB_BIG_HEIGHT,  $promotionInfoFour['name'], true);
						$promotionInfoFour['image'] .= $imageObj->getTag(true, IMAGE_PROMOTION_THUMB_BIG_WIDTH, IMAGE_PROMOTION_THUMB_BIG_HEIGHT,  $promotionInfoFour['name'], true);
						$promotionInfoFour['image'] .= "</a>";
					}else {
						if (!$user) {
							$promotionInfoFour['image'] = "<a href=\"".$promotionInfoFour['url']."\" class=\"image\"><span class=\"no-image\" style=\"cursor: default;\"></span></a>";
						} else {
							$promotionInfoFour['image'] = "<a href=\"".$promotionInfoFour['url']."\" class=\"image\"><span class=\"no-image\"></span></a>";
						}
					}
				}
			} // end
			if ($listing->promotion_id_five  && (PROMOTION_FEATURE == 'on' && CUSTOM_PROMOTION_FEATURE == 'on')){

				$promotionObj = new Promotion($listing->promotion_id_five);

				if ((validate_date_deal($promotionObj->getDate("start_date"), $promotionObj->getDate("end_date"))) && (validate_period_deal($promotionObj->getNumber("visibility_start"),$promotionObj->getNumber("visibility_end")))){
					$hasDeal = true;

					$promotionInfoFive['price'] = string_substr($promotionObj->getNumber("dealvalue"),0,(string_strpos($promotionObj->getNumber("dealvalue"),".")));
					$promotionInfoFive['cents'] = string_substr($promotionObj->getNumber("dealvalue"),(string_strpos($promotionObj->getNumber("dealvalue"),".")),3);
					if ($promotionInfoFive['cents'] == ".00") $promotionInfoFive['cents'] = "";
					$promotionInfoFive['name'] = $promotionObj->getString('name');
					if ($promotionObj->realvalue>0 && $promotionObj->dealvalue>0){
						$offer = round(100-(($promotionObj->dealvalue*100)/$promotionObj->realvalue)).'% '.system_showText(LANG_DEAL_OFF)."! ".CURRENCY_SYMBOL.format_money($promotionObj->dealvalue,2);
						$summary_offer = round(100-(($promotionObj->dealvalue*100)/$promotionObj->realvalue)).'% '.system_showText(LANG_DEAL_OFF);
					}else{
						$offer = system_showText(LANG_NA);
					}
					$promotionInfoFive['offer'] = $offer;
					$promotionInfoFive['summary_offer'] = $summary_offer;
					$promotionInfoFive['description'] = nl2br($promotionObj->getStringLang(EDIR_LANGUAGE,'description',true));
					$promotionInfoFive['url'] = PROMOTION_DEFAULT_URL.'/'.((MODREWRITE_FEATURE!='on')?"detail.php?id=".$promotionObj->id:$promotionObj->getString('friendly_url').".html");
					if (!$user){
						$promotionInfoFive['url'] = 'javascript:void(0);';
						$promotionInfoFive['style'] = "style=\"cursor:default\"";
					}
					$imageObj = new Image($promotionObj->getNumber("thumb_id"));

					if ($imageObj->imageExists()){
						$promotionInfoFive['image'] = "<a href=\"".$promotionInfoFive['url']."\" class=\"image\">";$imageObj->getTag(true, IMAGE_PROMOTION_THUMB_BIG_WIDTH, IMAGE_PROMOTION_THUMB_BIG_HEIGHT,  $promotionInfoFive['name'], true);
						$promotionInfoFive['image'] .= $imageObj->getTag(true, IMAGE_PROMOTION_THUMB_BIG_WIDTH, IMAGE_PROMOTION_THUMB_BIG_HEIGHT,  $promotionInfoFive['name'], true);
						$promotionInfoFive['image'] .= "</a>";
					}else {
						if (!$user) {
							$promotionInfoFive['image'] = "<a href=\"".$promotionInfoFive['url']."\" class=\"image\"><span class=\"no-image\" style=\"cursor: default;\"></span></a>";
						} else {
							$promotionInfoFive['image'] = "<a href=\"".$promotionInfoFive['url']."\" class=\"image\"><span class=\"no-image\"></span></a>";
						}
					}
				}
			} // end
		}
	}
    
    if (USING_THEME_TEMPLATE && THEME_TEMPLATE_ID && $listing->getNumber("listingtemplate_id") == THEME_TEMPLATE_ID){
        $templateFieldsInfo = "";
        $fieldBedroom = "";
        $fieldBathroom = "";
        $fieldSquareFeet = "";
        $fieldBuilt = "";
        $fieldAcre = "";
        
        if ($tPreview){
            $templateFieldsInfo .= "<p>2 ".system_showText(LANG_LABEL_TEMPLATE_BEDROOM)."</p>";
            $templateFieldsInfo .= "<p>1 ".system_showText(LANG_LABEL_TEMPLATE_BATHROOM)."</p>";
            $templateFieldsInfo .= "<p>".system_showText(LANG_LABEL_TEMPLATE_TYPEBUILTIN)." 2012</p>";
        } else {
            $auxListingTemplate = new ListingTemplate(THEME_TEMPLATE_ID);
            $fieldBedroom = $auxListingTemplate->getFieldByLabel("LANG_LABEL_TEMPLATE_BEDROOM");
            $fieldBathroom = $auxListingTemplate->getFieldByLabel("LANG_LABEL_TEMPLATE_BATHROOM");
            $fieldSquareFeet = $auxListingTemplate->getFieldByLabel("LANG_LABEL_TEMPLATE_SQUARE");
            $fieldBuilt = $auxListingTemplate->getFieldByLabel("LANG_LABEL_TEMPLATE_TYPEBUILTIN");
            $fieldAcre = $auxListingTemplate->getFieldByLabel("LANG_LABEL_TEMPLATE_ACRES");
            if ($fieldBedroom && $listing->getString($fieldBedroom)){
                $templateFieldsInfo .= "<p>".$listing->getString($fieldBedroom)." ".system_showText(LANG_LABEL_TEMPLATE_BEDROOM)."</p>";
            }
            if ($fieldBathroom && $listing->getString($fieldBathroom)){
                $templateFieldsInfo .= "<p>".$listing->getString($fieldBathroom)." ".system_showText(LANG_LABEL_TEMPLATE_BATHROOM)."</p>";
            }
            if ($fieldSquareFeet && $listing->getString($fieldSquareFeet)){
                $templateFieldsInfo .= "<p>".$listing->getString($fieldSquareFeet)." ".system_showText(LANG_LABEL_TEMPLATE_SQUARE)."</p>";
            }
            if ($fieldBuilt && $listing->getString($fieldBuilt)){
                $templateFieldsInfo .= "<p>".system_showText(LANG_LABEL_TEMPLATE_TYPEBUILTIN)." ".$listing->getString($fieldBuilt)."</p>";
            }
            if ($fieldAcre && $listing->getString($fieldAcre)){
                $templateFieldsInfo .= "<p>".$listing->getString($fieldAcre)." ".system_showText(LANG_LABEL_TEMPLATE_ACRES)."</p>";
            }
        }
        
    }
	
    include(INCLUDES_DIR."/views/view_listing.php");
    
	if ($listing->getString("email") && (is_array($array_fields) && in_array("email", $array_fields)) && LISTING_DETAIL_CONTACT == "on") { ?>

    <div class="contact-form">
		<a name="info"></a>
        <h2 id="contact-formScroll"><?=system_showText(LANG_LISTING_CONTACTTITLE)?></h2>

        <form id="contactForm" name="contactForm" class="form" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"]."?id=".$_GET["id"]."#info")?>">

            <? foreach ($_GET as $key => $value) print "<input type=\"hidden\" name=\"$key\" value=\"$value\" />"; ?>
            <input type="hidden" name="id" value="<?=$_GET["id"]?>" />
            <input type="hidden" name="id" value="<?=$_GET["id"]?>" />
            <input type="hidden" name="to" value="<?=string_htmlentities($listing->getString("email"))?>" />
			
            <? if ($error) { ?>
			
            <p class="<?=$message_style?>"><?=$error?></p>
            <? } ?>
			
			<div>
	            <label for="name">* <?=system_showText(LANG_LABEL_NAME);?></label>
    	        <input class="text" type="text" name="name" id="name" value="<?=$name?>" />
			</div>
			<div>
            	<label for="from">* <?=system_showText(LANG_LABEL_YOUREMAIL)?></label>
	            <input class="text" type="text" name="from" id="from" value="<?=$from?>" />
			</div>

			<div>
	            <label for="subject"><?=system_showText(LANG_LABEL_SUBJECT)?></label>
    	        <input class="text" type="text" name="subject" id="subject" value="<?=html_entity_decode($subject)?>" />
			</div>
			
			<div>
	            <label for="body">* <?=system_showText(LANG_LABEL_ADDITIONALMSG)?></label>
            	<?
				$body = str_replace("<br />", "", $body);
				?>
				<textarea class="textarea" name="body" rows="5" id="body" cols=""><?=html_entity_decode($body)?></textarea>
			</div>
			
			<p><?=system_showText(LANG_CAPTCHA_HELP)?></p>
			
			<div class="captcha">
				<div>
					<img src="<?=DEFAULT_URL?>/includes/code/captcha.php" border="0" alt="<?=system_showText(LANG_CAPTCHA_ALT)?>" title="<?=system_showText(LANG_CAPTCHA_TITLE)?>" />
					<input class="text" type="text" name="captchatext" value="" />
	            </div>
			</div>
		
			
			<div class="button button-contact">
				<h2><a href="<?=$user ? "javascript: document.contactForm.submit();" : "javascript: void(0);"?>" <?=$user ? "": "style=\"cursor:default\""?>><?=LANG_BUTTON_SEND?> <?=LANG_LABEL_MESSAGE?></a></h2>			
			</div>
			
        </form>
        
    </div>

<? } ?>