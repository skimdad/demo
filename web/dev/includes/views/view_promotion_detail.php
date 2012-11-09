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
	# * FILE: /includes/views/view_promotion_detail.php
	# ----------------------------------------------------------------------------------------------------
	 
	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$langIndex = language_getIndex(EDIR_LANGUAGE);
	
	$promotionDeals = $promotion->getDealInfo();
	
	$dealsDone = $promotionDeals['doneByAmount'] || $promotionDeals['doneByendDate'] ? true : false;

	if (!$dealsDone) {
		
		$promotionLink = ((MODREWRITE_FEATURE != "on") ? "detail.php?id=".$promotion->getNumber("id") : $promotion->getString("friendly_url").".html");
		
		$linkRedeem = DEFAULT_URL."/popup/popup.php?pop_type=deal_redeem&amp;redeemit=true&amp;nofacebook=true&amp;id=".$promotion->getNumber("id");
		if (sess_getAccountIdFromSession()){
			$account = new Account(sess_getAccountIdFromSession());
			$facebookaccount = false;
			if ($account->getString("facebook_username")){
				$facebookaccount = true;
			}
			unset($account);
		}
	
		if (FACEBOOK_APP_ENABLED == "on") {
			
			setting_get("promotion_force_redeem_by_facebook", $promotion_force_redeem_by_facebook);
			
			$buttomClass = "class=\"button button-facebook\"";
			$buttonText = system_showText(DEAL_REDEEMSHARE);

			if ($user) {
				
				Facebook::getFBInstance($facebook);
				
				$TBLink = DEFAULT_URL."/popup/popup.php?pop_type=deal_redeem&amp;redeemit=true&amp;id=".$promotion->getNumber("id");
				$promotionUrl = PROMOTION_DEFAULT_URL."/".((MODREWRITE_FEATURE != "on") ? "detail.php?id=".$promotion->getNumber("id") : $promotion->getString('friendly_url').".html");
				$urlRedirect = "&action=check_session&type=redeem_deal&item_id=".$promotion->getNumber("id")."&tb_link=".urlencode($TBLink)."&destiny=".urlencode($promotionUrl);
				$redeemLink = $facebook->getLoginStatusUrl(
					array (
						"ok_session"	=> FACEBOOK_REDIRECT_URI."?fb_session=ok".$urlRedirect, 
						"no_session"	=> FACEBOOK_REDIRECT_URI."?fb_session=no_session".$urlRedirect, 
						"no_user"		=> FACEBOOK_REDIRECT_URI."?fb_session=no_user".$urlRedirect
					)
				);

				if ($promotion_force_redeem_by_facebook){
					if (sess_getAccountIdFromSession() && !$facebookaccount) {
                        $linkRedeemClass = "iframe fancy_window_redeem";
						$redeemWFB = $linkRedeem;
						$linkText = system_showText(LANG_LABEL_REDEEM_PRINT);
					} else {
                        $linkRedeemClass = "fancy_window_login";
						$redeemWFB = DEFAULT_URL."/popup/popup.php?pop_type=profile_login&amp;act=redeem&amp;type=deal&amp;redeem_item=".$promotion->getNumber("id")."&amp;destiny=".PROMOTION_FEATURE_FOLDER."/".urlencode($promotionLink)."&amp;nofacebook=true";
						$linkText = system_showText(LANG_DEAL_DONTUSEFACEBOOK);
					}
				}
			} else {
				$redeemLink = "javascript:void(0);";
				$redeemWFB = "javascript:void(0);";
				$linkText = system_showText(LANG_DEAL_DONTUSEFACEBOOK);
			}
		} else {
			$buttomClass = "class=\"button button-redeem\" id=\"buttonConnect_redeemshare\"";
			$buttonText = system_showText(DEAL_REDEEMBYEMAIL);

			if ($user) {
				
				$contactObj = new Contact($promotion->getNumber("account_id"));
				
				if ($contactObj->getString("email")) {
					$redeemLink = "mailto:".$contactObj->getString("email")."?Subject=".system_showText(DEAL_REDEEM).": ".($promotion->getString("name"));
				} else {
					$redeemLink = "";
				}
				unset($contactObj);
				
				if (sess_getAccountIdFromSession()) {
                    $linkRedeemClass = "iframe fancy_window_redeem";
					$redeemWFB = $linkRedeem;
					$linkText = system_showText(LANG_LABEL_REDEEM_PRINT);
				} else {
                    $linkRedeemClass = "fancy_window_login";
					$redeemWFB = DEFAULT_URL."/popup/popup.php?pop_type=profile_login&amp;act=redeem&amp;type=deal&amp;redeem_item=".$promotion->getNumber("id")."&amp;destiny=".PROMOTION_FEATURE_FOLDER."/".urlencode($promotionLink)."&amp;nofacebook=true";
					$linkText = system_showText(DEAL_CONNECT_REDEEM);
				}
			} else {
				$redeemLink = "javascript:void(0);";
				$redeemWFB = "javascript:void(0);";
				$linkText = system_showText(LANG_DEAL_DONTUSEFACEBOOK);
			}
		}
	}
	
	$deal_name = $promotion->getString('name');
	
	$deal_value = CURRENCY_SYMBOL.format_money($promotion->getNumber("dealvalue"), false);
	
	$deal_cents = string_substr($promotion->getNumber("dealvalue"),(string_strpos($promotion->getNumber("dealvalue"),".")),3);
	if ($deal_cents == ".00") $deal_cents = "";
	
	$deal_real_value = CURRENCY_SYMBOL.format_money($promotion->getNumber("realvalue"),2);
	
	$deal_left = $promotionDeals['left'];
	
	$deal_sold = $promotionDeals['sold'];
	
	if ($promotion->getNumber("realvalue") > 0){
		$deal_offer = round(100-(($promotion->getNumber("dealvalue")*100)/$promotion->getNumber("realvalue"))).'%';
	} else {
		$deal_offer = system_showText(LANG_NA);
	}
	
	$deal_conditions = $promotion->getString("conditions".$langIndex);
	
	$deal_description = $promotion->getString("long_description".$langIndex);
	
	$imageObj = new Image($promotion->getNumber("image_id"));
	$imageTag = "";
	
	if ($imageObj->imageExists()){
		$imageTag .= "<div class=\"no-link\" ".(RESIZE_IMAGES_UPGRADE == "off" ? "style=\"text-align:center\"" : "").">";
		$imageTag .=  $imageObj->getTag(true, IMAGE_PROMOTION_FULL_WIDTH, IMAGE_PROMOTION_FULL_HEIGHT, $promotion->getString("name"), true);
		$imageTag .= "</div>";
	} else {
		$imageTag .= "<span class=\"no-image no-link\"></span>";
	}
	
	$listing = db_getFromDB("listing", "promotion_id", db_formatNumber($promotion->getNumber("id")), 1, "", "object", SELECTED_DOMAIN_ID);
	if (!$listing->getString("title")) {
		$dealslot = array ('2' => 'two', '3' => 'three', '4' => 'four', '5' => 'five');
		for ($dealcount = 2; $dealcount <= 5; $dealcount++) {
			$listing = db_getFromDB("listing", "promotion_id_" . $dealslot[$dealcount], db_formatNumber($promotion->id), 1, "", "object", SELECTED_DOMAIN_ID);
			if ($listing->getString("title"))
				break;
		}
	}
	
	$listingtemplate_address = "";
	if ($listing->getString("address")) {
		$listingtemplate_address = nl2br($listing->getString("address", true));
	}

	$listingtemplate_address2 = "";
	if ($listing->getString("address2")) {
		$listingtemplate_address2 = nl2br($listing->getString("address2", true));
	}

	$listingtemplate_phone = "";
	if ($listing->getString("phone")) {
		if ($user) {
			$listingtemplate_phone .= "<span id=\"phoneLink".$listing->getNumber("id")."\" class=\"controlPhoneShow\"><a href=\"javascript:showPhone('".$listing->getNumber("id")."','".DEFAULT_URL."');\">".system_showText(LANG_LISTING_VIEWPHONE)."</a></span>";
			$listingtemplate_phone .= "<span id=\"phoneNumber".$listing->getNumber("id")."\" class=\"controlPhoneHide\">".$listing->getString("phone", true)."</span>";
		} else {
			$listingtemplate_phone  = $listing->getString("phone", true);
		}
	}

	$linkStyle = "style=\"cursor: pointer;\"";
	if ($user) {
		if ($listing->hasDetail() == "y") {
			if (MODREWRITE_FEATURE == "on") {
				$listingDetailLink = "".LISTING_DEFAULT_URL."/".$listing->getString("friendly_url").".html";
			} else {
				$listingDetailLink = "".LISTING_DEFAULT_URL."/detail.php?id=".$listing->getNumber("id")."";
			}
		} else {
			$listingDetailLink = "".LISTING_DEFAULT_URL."/results.php?id=".$listing->getNumber("id")."";
		}
	} else {
		$listingDetailLink = "javascript:void(0);";
		$linkStyle = "style=\"cursor: none;\"";
	}
	
	$promotionStyle = "";
	if (!$user){
		$promotionStyle = "style=\"cursor:default\"";
	}
		
	$listingtemplate_image = "";
	$imageObjListing = new Image($listing->getNumber("image_id"));

	if ($imageObjListing->imageExists()) {
		$listingtemplate_image .= "<a href=\"".$listingDetailLink."\" $promotionStyle>";
		$listingtemplate_image .= $imageObjListing->getTag(true, SIDEBAR_FEATURED_WIDTH, SIDEBAR_FEATURED_HEIGHT, htmlspecialchars($listing->getString("title")), true);
		$listingtemplate_image .= "</a>";
	} else {
		$listingtemplate_image .= "<a class=\"no-image\" href=\"".$listingDetailLink."\" $promotionStyle></a>";
	}
	
	$listingtemplate_complementaryinfo = "";
	$listingtemplate_complementaryinfo = system_itemRelatedCategories(htmlspecialchars($listing->getNumber("id")), "listing", $user);

	if (socialnetwork_writeLink(htmlspecialchars($listing->getNumber("account_id")), "profile", "general_see_profile",false , false, "", false, $user)) {
		$listingtemplate_complementaryinfo .= " ".LANG_BY." ".socialnetwork_writeLink(htmlspecialchars($listing->getNumber("account_id")), "profile", "general_see_profile",false , false, "", false, $user);
	}
	
	$listingtemplate_email = "";
	if (htmlspecialchars($listing->getString("email"))) {
        $display_email = wordwrap(htmlspecialchars($listing->getString("email")), 30, "<br />", true);
        if ($user){
			$listingtemplate_email = "<a href=\"".DEFAULT_URL."/popup/popup.php?pop_type=listing_emailform&amp;id=".htmlspecialchars($listing->getNumber("id"))."&amp;receiver=owner\" class=\"iframe fancy_window_tofriend\">".system_showText(LANG_SEND_AN_EMAIL)."</a>";
		} else {
			$listingtemplate_email = "<a href=\"javascript:void(0);\" style=\"cursor:default\">".system_showText(LANG_SEND_AN_EMAIL)."</a>";
		}
	}
	
	$listingtemplate_url = "";
	if (htmlspecialchars($listing->getString("url"))) {
		$display_url = htmlspecialchars($listing->getString("url"));
		if (htmlspecialchars($listing->getString("display_url"))) {
			$display_url = htmlspecialchars($listing->getString("display_url"));
		}
		$display_url_title = $display_url;
		$display_url = system_showTruncatedText($display_url, 29);
		if ($user) {
			$listingtemplate_url = "<a href=\"".DEFAULT_URL."/listing_reports.php?report=website&amp;id=".htmlspecialchars($listing->getNumber("id"))."\" target=\"_blank\" title=\"$display_url_title\">".system_showTruncatedText($display_url, 10)."</a>";
		} else {
			$listingtemplate_url = "<a href=\"javascript:void(0);\" title=\"$display_url_title\" style=\"cursor:default\">".system_showTruncatedText($display_url, 10)."</a>";
		}
	}

	$locationsToshow = system_retrieveLocationsToShow();
	$listingtemplate_location = "";
	if ($tPreview){
		$locationsToShow = explode (",", EDIR_LOCATIONS);
		$locationsToShow = array_reverse ($locationsToShow);
		foreach ($locationsToShow as $locationToShow) {
				$listingtemplate_location .= system_showText(constant("LANG_LABEL_".constant("LOCATION".$locationToShow."_SYSTEM"))).", ";
		}
		$listingtemplate_location = string_substr("$listingtemplate_location", 0, -2).'<br />';
		$listingtemplate_location .= "00000";
	} else {
		$locationsParam = $locationsToshow." z";
		$listingtemplate_location = $listing->getLocationString($locationsParam, true);
	}

	$listingtemplate_locations = "";
	if ($listing->getString("locations")) {
		$listingtemplate_locations = nl2br($listing->getString("locations", true));
	}

	include(EDIRECTORY_ROOT."/includes/views/icon_promotion.php");
	
	$deal_icon_navbar = $icon_navbar;
	$icon_navbar = "";

	$deal_category_tree = "";
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
			$deal_category_tree = system_generateCategoryTree($array_categories_obj, $arr_full_path, "promotion", $user, EDIR_LANGUAGE);
		}	
	}
	
	$deal_review = "";
    $deal_summary_review = "";
	setting_get('commenting_edir', $commenting_edir);
    setting_get("review_promotion_enabled", $review_enabled);
    if ($review_enabled == "on" && $commenting_edir) {
		$item_type = 'promotion';
		if($promotion->getNumber("id") > 0){
			$item_id   = $promotion->getNumber('id');
			include(INCLUDES_DIR."/views/view_review.php");
			$deal_summary_review .= $item_review;
			$item_review = "";
			if ($reviewsArr) {

				$lastItemStyle = 0;
				$numberOfReviews = 3;
				$reviewMaxSize = 150;

				foreach ($reviewsArr as $each_rate) {
					if ($each_rate->getString("review")) {
						$each_rate->extract();
						include(INCLUDES_DIR."/views/view_review_detail.php");
						$deal_review .= $item_reviewcomment;
						$item_reviewcomment = "";
					}
				}
			}
		}
    }
    
    $detailFileName = INCLUDES_DIR."/views/view_promotion_detail_code.php";
    $themeDetailFileName = INCLUDES_DIR."/views/view_promotion_detail_code_".EDIR_THEME.".php";
    
	if (file_exists($themeDetailFileName)){
        include($themeDetailFileName);
    } else {
        include($detailFileName);
    }

?>