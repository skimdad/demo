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
    # * FILE: /includes/views/icon_listing.php
    # ----------------------------------------------------------------------------------------------------

	if (is_array($listing)) {
		$aux = $listing;
	} else if (is_object($listing)) {
		$aux = $listing->data_in_array;
	}
	
    $icon_navbar = "";
    $icon_listing_level = $aux["level"];

	$location_map = false;
	if ($aux["latitude"] && $aux["longitude"]) {
        $location_map = $aux["latitude"].",".$aux["longitude"];
	}
	if ($location_map) $location_map = urlencode("$location_map");

    $type = "Listing";
	if ($user) {
        $friend_link = DEFAULT_URL."/popup/popup.php?pop_type=listing_emailform&amp;id=".$aux["id"]."&amp;receiver=friend";
        if (sess_getAccountIdFromSession() && !$members) {
			$include_favorites_link = "javascript: void(0);";
			$include_favorites_click = "onclick=\"itemInQuicklist('add', '".sess_getAccountIdFromSession()."', '".$aux["id"]."', 'listing');\"";
		} else {
			$include_favorites_link =  DEFAULT_URL."/popup/popup.php?pop_type=profile_login&amp;destiny=".$_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"];
			$includes_favorites_class = "fancy_window_login";
		}
		if (sess_getAccountIdFromSession() || $members) {
			$remove_favorites_link = "javascript: void(0);";
			$remove_favorites_click = "onclick=\"itemInQuicklist('remove', '".sess_getAccountIdFromSession()."', '".$aux["id"]."', 'listing');\"";
		}
		
		$map_link = "onclick='javascript:window.open(\"http://maps.google.com/maps?q=".$location_map."\",\"popup\",\"\")'";
        $aux_friend_link = $friend_link;
		$friend_link = sess_validateSessionItens("listing", "send_email_to_friend", false, $friend_link);
        
        $fancyiFrame = true;
        if ($aux_friend_link != $friend_link){
            $fancyiFrame = false;
        }

        $claim_link = ((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on" && FORCE_CLAIM_SSL == "on") ? SECURE_URL : NON_SECURE_URL).((MODREWRITE_FEATURE == "on") ? "/".LISTING_FEATURE_FOLDER."/claim/".$aux["friendly_url"] : "/claim.php?claimlistingid=".$aux["id"]);

        // SOCIAL BOOKMARKING
        if (SOCIAL_BOOKMARKING == "on") {
			if(is_object($levelObj)){
				$listingLevelObj = $levelObj;
			}else{
				$listingLevelObj = new ListingLevel();
			}
            
            if ($listingLevelObj->getDetail($icon_listing_level) == "y") {
                if (MODREWRITE_FEATURE == "on") {
					if ($_SERVER['PHP_SELF'] == EDIRECTORY_FOLDER."/".LISTING_FEATURE_FOLDER."/comments.php") {
						$sbmLink = LISTING_DEFAULT_URL."/reviews/".$aux["friendly_url"];
						$sbmLinkShare = LISTING_DEFAULT_URL."/reviews/share/".$aux["friendly_url"].".html";
					} else {
						$sbmLink = LISTING_DEFAULT_URL."/".$aux["friendly_url"].".html";
						$sbmLinkShare = LISTING_DEFAULT_URL."/share/".$aux["friendly_url"].".html";
					}
                } else {
					if ($_SERVER['PHP_SELF'] == EDIRECTORY_FOLDER."/".LISTING_FEATURE_FOLDER."/comments.php") {
						$sbmLink = LISTING_DEFAULT_URL."/comments.php?item_id=".$aux["id"];
						$sbmLinkShare = LISTING_DEFAULT_URL."/facebook_share.php?cid=".$aux["id"];
					} else {
						$sbmLink = LISTING_DEFAULT_URL."/detail.php?id=".$aux["id"];
						$sbmLinkShare = LISTING_DEFAULT_URL."/facebook_share.php?did=".$aux["id"];
					}
                 }
            } else {
				if ($_SERVER['PHP_SELF'] == EDIRECTORY_FOLDER."/".LISTING_FEATURE_FOLDER."/comments.php") {
					 if (MODREWRITE_FEATURE == "on") {
						$sbmLink = LISTING_DEFAULT_URL."/reviews/".$aux["friendly_url"];
						$sbmLinkShare = LISTING_DEFAULT_URL."/reviews/share/".$aux["friendly_url"].".html";
					 } else {
						$sbmLink = LISTING_DEFAULT_URL."/comments.php?item_id=".$aux["id"];
						$sbmLinkShare = LISTING_DEFAULT_URL."/facebook_share.php?cid=".$aux["id"];
					 }
				} else {
					$sbmLink = LISTING_DEFAULT_URL."/results.php?id=".$aux["id"];
					$sbmLinkShare = LISTING_DEFAULT_URL."/facebook_share.php?rid=".$aux["id"];
				}
            }

			$facebook    = "href=\"http://www.facebook.com/sharer.php?u=".$sbmLinkShare."&amp;t=".urlencode(htmlspecialchars($aux["title"]))."\" target=\"_blank\"";
            $twitter     = "href=\"http://twitter.com/?status=".$sbmLink."\" target=\"_blank\"";
			
			$friend_style = "";
			$include_favorites_style = "";
			$print_style = "";
			$map_style = "";
			$claim_style = "";
			$socialbookmarking_style = "";

            unset($listingLevelObj);
        }

    } else {

        $friend_link = "javascript:void(0);";
        $include_favorites_link = "javascript:void(0);";
        $print_link = "javascript:void(0);";
        $map_link = "";
        $claim_link = "javascript:void(0);";

		$friend_style = "style=\"cursor:default\"";
        $include_favorites_style = "style=\"cursor:default\"";
        $print_style = "style=\"cursor:default\"";
        $map_style = "style=\"cursor:default\"";
        $promotion_style = "style=\"cursor:default\"";
        $claim_style = "style=\"cursor:default\"";
		$socialbookmarking_style = "style=\"cursor:default\"";

        // SOCIAL BOOKMARKING
        if (SOCIAL_BOOKMARKING == "on") {

            $facebook    = "href=\"javascript:void(0);\" style=\"cursor:default\"";
            $twitter     = "href=\"javascript:void(0);\" style=\"cursor:default\"";
		}
    }

	// SOCIAL BOOKMARKING IMAGES
    if (SOCIAL_BOOKMARKING == "on") {
        $facebook_imgE    	= "<img src=\"".DEFAULT_URL."/theme/".EDIR_THEME."/images/iconography/icon-share-facebook.png\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Facebook\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Facebook\"/>";
        $twitter_imgE     	= "<img src=\"".DEFAULT_URL."/theme/".EDIR_THEME."/images/iconography/icon-share-twitter.png\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Twitter\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Twitter\"/>";
		
		$comments_page		= ($_SERVER['PHP_SELF'] == EDIRECTORY_FOLDER."/".LISTING_FEATURE_FOLDER."/comments.php") ? 1 : 0;
		$share_icon			= "<li><a ".($aux["id"] ? "id=\"link_social_".htmlspecialchars($aux["id"]).$type."\"" : "")." href=\"javascript:void(0);\" onclick=\"enableSocialBookMarking('".$aux["id"]."', '".$type."', '".DEFAULT_URL."', ".$comments_page.");\" $socialbookmarking_style>".system_showText(string_strtolower(LANG_LABEL_SHARE))."</a></li>";
	}

    $links = "";
	$cFancyBox = "";
	if($user){
		$cFancyBox = ($fancyiFrame ? "iframe fancy_window_tofriend" : "fancy_window_login");
	}
	
    $links .= "<li><a href=\"".$friend_link."\" class=\"".$cFancyBox."\" ".$friend_style.">".system_showText(LANG_ICONEMAILTOFRIEND)."</a></li>";
	if ($members) {
		if (($id == sess_getAccountIdFromSession()) || ($members != "profile")) {
			$links .= "<li>|</li><li><a id=\"favoritesRemove_".$aux["id"]."\" href=\"".$remove_favorites_link."\" ".$remove_favorites_click." ".$remove_favorites_style.">".system_showText(LANG_ICONQUICKLIST_REMOVE)."</a></li>";
		}
	}else {
		$links .= "<li>|</li><li><a ".($aux["id"] ? " id=\"favorites_".$aux["id"]."\"" : "")." href=\"".$include_favorites_link."\" class=\"".$includes_favorites_class."\" ".$include_favorites_click." ".$include_favorites_style.">".system_showText(LANG_ICONQUICKLIST_ADD)."</a></li>";
	}
    
    if(is_object($levelObj)){
        $listingLevelObj = $levelObj;
    }else{
        $listingLevelObj = new ListingLevel();
    }
    
    if (($listingLevelObj->getDetail($icon_listing_level) == "y") && ((string_strpos($_SERVER["PHP_SELF"], "detail.php") !== false) || ($typePreview == "detail"))) {
		
		$aux_validate_print = sess_validateSessionItens("listing", "print");
		
		if ($user){
			if ($aux_validate_print){
				$print_link = DEFAULT_URL."/popup/popup.php?pop_type=profile_login&amp;destiny=".$_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"];
				$print_class = "class=\"fancy_window_login\"";		
			} else {
				$print_link = "javascript:window.print();";
			}
		}
		
		$links .= "<li>|</li><li><a href=\"".$print_link."\" $print_class $print_style>".system_showText(LANG_ICONPRINT)."</a></li>";	
    }

	if ($tPreview) {
		if ($listingLevelObj->getDetail($icon_listing_level) == "y") {
			$links .= "<li>|</li><li><a href=\"javascript:void(0);\" ".$map_link." ".$map_style.">".system_showText(LANG_ICONMAP)."</a></li>";
		}
	} else {
		if ($listingLevelObj->getDetail($icon_listing_level) == "y") {
			if ((htmlspecialchars($aux["latitude"])) && (htmlspecialchars($aux["longitude"]))) {
				$links .= "<li>|</li><li><a href=\"javascript:void(0);\" ".$map_link." ".$map_style.">".system_showText(LANG_ICONMAP)."</a></li>";
			}
		}
	}
	
	if (SOCIAL_BOOKMARKING == "on"){
		$twitterL = "<li class=\"icon\"><a ".$twitter." >".$twitter_imgE."</a></li>";
		$facebookL = "<li class=\"icon\"><a ".$facebook." >".$facebook_imgE."</a></li>";
	}
	
	if (string_strpos($_SERVER["PHP_SELF"], "detail.php") !== false) {
		$params = array (
			"href" => $sbmLinkShare,
			"send" => "true",
			"layout" => "button_count",
			//"width" => "200",
			"show_faces" => "false",
			"font" => ""
		);
		$likeObj = Facebook::getButtonCode("like", $params);
	}
	unset($sbmLink);

	$extraL = "<ul class=\"share-social\">";
	$extraL .= $twitterL;
	$extraL .= $facebookL;
	$extraL .= $share_icon;
	$extraL .= "</ul>";

    $icon_navbar .= $extraL."<ul class=\"share-actions\">".$links."</ul>";

?>