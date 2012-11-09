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
	# * FILE: /includes/views/view_promotion_summary.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DEFINES
	# ----------------------------------------------------------------------------------------------------

	$deal_icon_navbar = "";
	include(EDIRECTORY_ROOT."/includes/views/icon_promotion.php");
	$deal_icon_navbar = $icon_navbar;
	
	$friendly_url = $promotion->getString("friendly_url");
	
	if ((string_strpos($_SERVER["PHP_SELF"], "results.php") !== false) !== false && GOOGLE_MAPS_ENABLED == "on" && $mapObj->getString("value") == "on") { 
        if ($listings[0]){
            if ($listings[0]->getString("latitude") && $listings[0]->getString("longitude")) {
                $show_map = true;
            } else {
                $show_map = false;
            }
        }
	}
    $promotionDistance = "";
    if ($listings[0]){
        if (zipproximity_getDistanceLabel($zip, "listing", htmlspecialchars($listings[0]->getNumber("id")), $distance_label, true, $listings[0]->data_in_array)) {
            $promotionDistance .= " (".$distance_label.")";
        }
    }

	$deal_price = string_substr($promotion->dealvalue,0,(string_strpos($promotion->dealvalue,".")));
	$deal_cents = string_substr($promotion->dealvalue,(string_strpos($promotion->dealvalue,".")),3);
	if ($deal_cents == ".00") $deal_cents = "";

	if ($promotion->realvalue>0)
		$offer = round(100-(($promotion->dealvalue*100)/$promotion->realvalue)).'%';
	else $offer = system_showText(LANG_NA);
	
	$promotionDeals = $promotion->getDealInfo();

	$sold_out = "";
	if ($promotionDeals['doneByAmount']||$promotionDeals['doneByendDate'])
		$sold_out = system_showTruncatedText(system_showText(DEAL_SOLDOUT),10);
	
	
	$contactObj = new Contact($promotion->account_id);
	
	$listing = db_getFromDB("listing", "promotion_id", db_formatNumber($promotion->id), 1, "", "object", SELECTED_DOMAIN_ID);
	if (!$listing->getString("title")) {
		$dealslot = array ('2' => 'two', '3' => 'three', '4' => 'four', '5' => 'five');
		for ($dealcount = 2; $dealcount <= 5; $dealcount++) {
			$listing = db_getFromDB("listing", "promotion_id_" . $dealslot[$dealcount], db_formatNumber($promotion->id), 1, "", "object", SELECTED_DOMAIN_ID);
			if ($listing->getString("title"))
				break;
		}
	}
	
	$listingTitle = "";
	if ($listing->getString("title")){
		$listingTitle = $listing->getString("title");
	}
	
	$listing_link = "";
    $level = new ListingLevel();
	
	if ($user) {
        if ($level->getDetail($listing->getNumber("level")) == "y") {
            if (MODREWRITE_FEATURE == "on"){
                $listing_link = DEFAULT_URL."/".LISTING_FEATURE_FOLDER."/".$listing->getString("friendly_url").".html";
            } else {
                $listing_link = DEFAULT_URL."/".LISTING_FEATURE_FOLDER."/detail.php?id=".$listing->getNumber("id");
            }
        } else {
            $listing_link = "".LISTING_DEFAULT_URL."/results.php?id=".$listing->getNumber("id");
        }
	} else {
		$listing_link = "javascript: void(0);";
	}
	
	$imageObj = new Image($promotion->getNumber("thumb_id"));
	
	$promotionLink = !$user ? "javascript:void(0);" : ((MODREWRITE_FEATURE!='on') ? PROMOTION_DEFAULT_URL."/"."detail.php?id=".$promotion->id : PROMOTION_DEFAULT_URL."/".$promotion->getString('friendly_url').".html");
	$promotionStyle = !$user ? "style=\"cursor:default\"": "";
	
	if ($imageObj->imageExists()){
		
		if ($user){
			$imageTag =  "<a href=\"".$promotionLink."\" class=\"image\">";
			$imageTag .= $imageObj->getTag(true, IMAGE_FRONT_PROMOTION_WIDTH, IMAGE_FRONT_PROMOTION_HEIGHT, $promotion->getString("name"), true);
			$imageTag .= "</a>";
		} else {
			$imageTag .= "<div class=\"no-link\">";
			$imageTag .= $imageObj->getTag(true, IMAGE_FRONT_PROMOTION_WIDTH, IMAGE_FRONT_PROMOTION_HEIGHT, $promotion->getString("name"), true);
			$imageTag .= "</div>";
		}
	} else {
		$imageTag = "<a href=\"".$promotionLink."\" class=\"image\">";
		$imageTag .= "<span class=\"no-image\"".(!$user ? "style=\"cursor:default\"" : "")."></span>";
		$imageTag .= "</a>";
	}
	
	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$promotion_desc = $promotion->getString("description".$langIndex);
	
	$promotion_review = "";
    if ($review_enabled == "on" && $commenting_edir) {
        $item_type = 'promotion';
        $item_id   = htmlspecialchars($promotion->id);
        $itemObj   = $promotion;
        include(INCLUDES_DIR."/views/view_review.php");
        $promotion_review .= $item_review;
        $item_review = "";
    }
    
    $summaryFileName = INCLUDES_DIR."/views/view_promotion_summary_code.php";
    $themeSummaryFileName = INCLUDES_DIR."/views/view_promotion_summary_code_".EDIR_THEME.".php";

    if (file_exists($themeSummaryFileName)){
        include($themeSummaryFileName);
    } else {
        include($summaryFileName);
    }


?>
