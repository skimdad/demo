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
	# * FILE: /rss/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# MOD-REWRITE
	# ----------------------------------------------------------------------------------------------------
	include(PROMOTION_EDIRECTORY_ROOT."/rss/mod_rewrite.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$dbObj = db_getDBObJect();

	unset($searchReturn);
    $searchReturn = search_frontPromotionSearch($_GET, "promotion_results");
    $pageObj = new pageBrowsing($searchReturn["from_tables"], (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? $page : $screen), $aux_items_per_page, $searchReturn["order_by"], "Promotion.name", $letter, $searchReturn["where_clause"], $searchReturn["select_columns"], "Promotion", $searchReturn["group_by"], false, false, $searchReturn["having_clause"]);
	//$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." Listing_Summary.level IN (".$levels_str.") ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT 100";
    $deals_array = $pageObj->retrievePage("array");
    
    
	/*
    if (mysql_num_rows($result) <= 0) {
		unset($searchReturn);
		$searchReturn = search_frontListingSearch($_GET, "listing_results");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT 100";
		$result = $dbObj->query($sql);
	}
	while ($row = mysql_fetch_assoc($result)) {
		$listings[] = new Listing($row["id"]);
	}
    */
    
	if ($deals_array) {
		$rssWriter = new RSSWriter();

		unset($channel_properties);
		if ($id) {
			$channel_properties["title"]			= EDIRECTORY_TITLE." ".string_ucwords(LANG_PROMOTION)." - ".$deals_array[0]["name"];
			$channel_properties["link"]				= DEFAULT_URL;
			$channel_properties["description"]		= EDIRECTORY_TITLE." ".string_ucwords(LANG_PROMOTION)." - ".$deals_array[0]["name"];
		} elseif (($category_id || $location_1 || $location_2 || $location_3 || $location_4 || $location_5 || $template_id || $keyword || $where) && !$zip && !$dist) {
			if ($category_id){
                $rss_category = new ListingCategory($category_id);
            }
			if ($location_1){
                $rss_location1  = new Location1($location_1);
            }
			if ($location_2){
                $rss_location2  = new Location2($location_2);
            }
			if ($location_3){
                $rss_location3  = new Location3($location_3);
            }
			if ($location_4){
                $rss_location4  = new Location4($location_4);
            }
			if ($location_5){
                $rss_location5  = new Location5($location_5);
            }
			if ($location_1 || $location_2 || $location_3 || $location_4 || $location_5) {
				if ($location_1){
                    $rsslocationstr[] = $rss_location1->getString("name");
                }
				if ($location_2){
                    $rsslocationstr[] = $rss_location2->getString("name");
                }
				if ($location_3){ 
                    $rsslocationstr[] = $rss_location3->getString("name");
                }
                
				if ($location_4){
                    $rsslocationstr[] = $rss_location4->getString("name");
                }
				if ($location_5){
                    $rsslocationstr[] = $rss_location5->getString("name");
                }
				$rss_location_str = implode(" / ", $rsslocationstr);
			}
			if ( $where ) {
				$channel_properties["title"]		= EDIRECTORY_TITLE." - ".$where;
				$channel_properties["link"]			= DEFAULT_URL;
				$channel_properties["description"]	= EDIRECTORY_TITLE." - ".$where;
			} elseif ( $keyword ) {
				$channel_properties["title"]		= EDIRECTORY_TITLE." - ".$keyword;
				$channel_properties["link"]			= DEFAULT_URL;
				$channel_properties["description"]	= EDIRECTORY_TITLE." - ".$keyword;
			} elseif ( $template_id ) {
				$rss_template = new ListingTemplate($template_id);
				$channel_properties["title"]		= EDIRECTORY_TITLE." - Type ".$rss_template->getString('title');
				$channel_properties["link"]			= DEFAULT_URL;
				$channel_properties["description"]	= EDIRECTORY_TITLE." - Type ".$rss_template->getString('title');
			} elseif ($category_id && !$location_1 && !$location_2 && !$location_3 && !$location_4 && !$location_5) {
				$channel_properties["title"]		= EDIRECTORY_TITLE." - Guide ".$rss_category->getStringLang(EDIR_LANGUAGE, "title");
				$channel_properties["link"]			= DEFAULT_URL;
				$channel_properties["description"]	= EDIRECTORY_TITLE." - Guide ".$rss_category->getStringLang(EDIR_LANGUAGE, "title");
			} elseif (($location_1 || $location_2 || $location_3 || $location_4 || $location_5) && !$category_id) {
				$channel_properties["title"]		= EDIRECTORY_TITLE." - Location ".$rss_location_str;
				$channel_properties["link"]			= DEFAULT_URL;
				$channel_properties["description"]	= EDIRECTORY_TITLE." - Location ".$rss_location_str;
			} else {
				$channel_properties["title"]		= EDIRECTORY_TITLE." - Guide ".$rss_category->getStringLang(EDIR_LANGUAGE, "title")." - Location ".$rss_location_str;
				$channel_properties["link"]			= DEFAULT_URL;
				$channel_properties["description"]	= EDIRECTORY_TITLE." - Guide ".$rss_category->getStringLang(EDIR_LANGUAGE, "title")." - Location ".$rss_location_str;
			}
		} else {
			$channel_properties["title"]			= EDIRECTORY_TITLE." - RSS Feed";
			$channel_properties["link"]				= DEFAULT_URL;
			$channel_properties["description"]		= EDIRECTORY_TITLE." - RSS Feed";
		}
		$rssWriter->addChannel($channel_properties);

		unset($image_properties);
		$image_properties["link"]		= DEFAULT_URL;
		if (file_exists(EDIRECTORY_ROOT.RSS_LOGO_PATH)) {
			$image_properties["url"]	= DEFAULT_URL.RSS_LOGO_PATH;
		} else {
			$image_properties["url"]	= DEFAULT_URL."/images/content/img_logo.gif";
		}
		$image_properties["title"]		= EDIRECTORY_TITLE;
		$rssWriter->addChannelImage($image_properties);

        
        $lang_index = language_getIndex(EDIR_LANGUAGE);
        
        
        foreach($deals_array as $each_deal){
            unset($itens_properties);
			$itens_properties["title"]			= $each_deal["name"]." - ".LANG_LABEL_END_DATE.": ".format_date($each_deal["end_date"]);
			
            if (MODREWRITE_FEATURE == "on") {
                $itens_properties["link"]	= PROMOTION_DEFAULT_URL."/".$each_deal["friendly_url"].".html";
            } else {
                $itens_properties["link"]	= PROMOTION_DEFAULT_URL."/detail.php?id=".$each_deal["id"];
            }
            
            $itens_properties["description"]    = $each_deal["description".$lang_index];
			$itens_properties["guid"]			= $itens_properties["link"];
			$itens_properties["phone"]			= $each_deal["phone"];
			$itens_properties["email"]			= $each_deal["email"];
			$itens_properties["url"]			= $each_deal["url"];
			$itens_properties["address"]		= $each_deal["address"];
			$itens_properties["pubDate"]		= date(DATE_RSS,strtotime($each_deal["updated"]));
			

			if ($each_deal["thumb_id"]) {
				$imageObj = new Image($each_deal["thumb_id"]);
				$itens_properties["img_src"]	= IMAGE_URL."/".$imageObj->getString("prefix")."photo_".$imageObj->getNumber("id").".".string_strtolower($imageObj->getString("type"));
				$itens_properties["img_width"]	= $imageObj->getNumber("width");
				$itens_properties["img_height"]	= $imageObj->getNumber("height");
			}

			$rssWriter->addItem($itens_properties);

			$rssWriter->buildItem();
        }
        
        
        /*
		foreach ($listings as $each_listing) {

			unset($itens_properties);
			$itens_properties["title"]			= $each_listing->getString("title");
			if ($level->getDetail($each_listing->getNumber("level")) == "y") {
				if (MODREWRITE_FEATURE == "on") {
					$itens_properties["link"]	= LISTING_DEFAULT_URL."/".$each_listing->getString("friendly_url").".html";
				} else {
					$itens_properties["link"]	= LISTING_DEFAULT_URL."/detail.php?id=".$each_listing->getNumber("id");
				}
			} else {
				$itens_properties["link"]		= LISTING_DEFAULT_URL."/results.php?id=".$each_listing->getNumber("id");
			}
			$itens_properties["description"]	= $each_listing->getStringLang(EDIR_LANGUAGE, "description");
			$itens_properties["guid"]			= $itens_properties["link"];
			$itens_properties["phone"]			= $each_listing->getString("phone");
			$itens_properties["email"]			= $each_listing->getString("email");
			$itens_properties["url"]			= $each_listing->getString("url");
			$itens_properties["address"]		= $each_listing->getString("address");
			$itens_properties["pubDate"]		= date(DATE_RSS,strtotime($each_listing->updated));
			

			if ($each_listing->getNumber("thumb_id")) {
				$imageObj = new Image($each_listing->getNumber("thumb_id"));
				$itens_properties["img_src"]	= IMAGE_URL."/".$imageObj->getString("prefix")."photo_".$imageObj->getNumber("id").".".string_strtolower($imageObj->getString("type"));
				$itens_properties["img_width"]	= $imageObj->getNumber("width");
				$itens_properties["img_height"]	= $imageObj->getNumber("height");
			}

			$rssWriter->addItem($itens_properties);

			$rssWriter->buildItem();

		}		
        */
		$rssWriter->buildChannel();

		$rssWriter->outputRSS();

	}

?>
