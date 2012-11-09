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
	# * FILE: /frontend/socialnetwork/favoritescontent.php
	# ----------------------------------------------------------------------------------------------------
	 
	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	if (!$_GET["id"]) {
		$id = sess_getAccountIdFromSession();
	} else { 
		$id = $_GET["id"];
	}
	
	$hasItens = false;

	if ($id) {
		$quicklistObj = new Quicklist();
		$idsA = $quicklistObj->getQuicklist("article", $id);
		$idsC = $quicklistObj->getQuicklist("classified", $id);
		$idsE = $quicklistObj->getQuicklist("event", $id);
		$ids = $quicklistObj->getQuicklist("listing", $id);
	} 

	if ($ids) {
		$ids = str_replace("\\", "", $ids);
		$ids = str_replace("=", "", $ids);
		$ids = str_replace("%27", "", str_replace("'", "", $ids));
		$ids = str_replace("%22", "", str_replace("\"", "", $ids));
		$ids = str_replace(")", "", str_replace("(", "", $ids));
		$ids = preg_replace("([^0-9,])", "", $ids);
		$ids = system_denyInjections($ids);
		if ($ids) {
			$hasItens = true;
			$sql = "SELECT * FROM Listing WHERE id IN (".$ids.") ORDER BY level, title";
			$listings = db_getFromDBBySQL("listing", $sql);
		} else {
			$hasItens = false;
		}
	}

	if ($idsC && CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
		$idsC = str_replace("\\", "", $idsC);
		$idsC = str_replace("=", "", $idsC);
		$idsC = str_replace("%27", "", str_replace("'", "", $idsC));
		$idsC = str_replace("%22", "", str_replace("\"", "", $idsC));
		$idsC = str_replace(")", "", str_replace("(", "", $idsC));
		$idsC = preg_replace("([^0-9,])", "", $idsC);
		$idsC = system_denyInjections($idsC);
		if ($idsC) {
			$hasItens = true;
			$sql = "SELECT * FROM Classified WHERE id IN (".$idsC.") ORDER BY level, title";
			$classifieds = db_getFromDBBySQL("classified", $sql);
		} else {
			$hasItens = false;
		}
	} else {
       $idsC = ""; 
    }
	
	if ($idsE && EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
		$idsE = str_replace("\\", "", $idsE);
		$idsE = str_replace("=", "", $idsE);
		$idsE = str_replace("%27", "", str_replace("'", "", $idsE));
		$idsE = str_replace("%22", "", str_replace("\"", "", $idsE));
		$idsE = str_replace(")", "", str_replace("(", "", $idsE));
		$idsE = preg_replace("([^0-9,])", "", $idsE);
		$idsE = system_denyInjections($idsE);
		if ($idsE) {
			$hasItens = true;
			$sql = "SELECT * FROM Event WHERE id IN (".$idsE.") ORDER BY level, title";
			$events = db_getFromDBBySQL("event", $sql);
		} else {
			$hasItens = false;
		}
	} else {
       $idsE = ""; 
    }
	
	if ($idsA && ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
		$idsA = str_replace("\\", "", $idsA);
		$idsA = str_replace("=", "", $idsA);
		$idsA = str_replace("%27", "", str_replace("'", "", $idsA));
		$idsA = str_replace("%22", "", str_replace("\"", "", $idsA));
		$idsA = str_replace(")", "", str_replace("(", "", $idsA));
		$idsA = preg_replace("([^0-9,])", "", $idsA);
		$idsA = system_denyInjections($idsA);
		if ($idsA) {
			$hasItens = true;
			$sql = "SELECT * FROM Article WHERE id IN (".$idsA.") ORDER BY level";
			$articles = db_getFromDBBySQL("article", $sql);
		} else {
			$hasItens = false;
		}
	} else {
       $idsA = ""; 
    }

	if ($hasItens) {
		$where = array("listing"=>$ids,"event"=>$idsE,"classified"=>$idsC,"article"=>$idsA);

		$user = true;

		$aux_items_per_page = ($_COOKIE["profilefavorites_per_page"] ? $_COOKIE["profilefavorites_per_page"] : 10);
		$showLetter = false;

		$pageObj  = new pageBrowsing("QuickList", $screen, $aux_items_per_page, "level", "title", false, $where, "*");
		$items = $pageObj->retrievePage();
		$aux_module_items = $items; 

		if ($members != "profile") {
			$paging_url = DEFAULT_URL."/members/account/account.php";
		} else {
			if ($pag_content == "reviews") {
				if (MODREWRITE_FEATURE == "on") {
					$paging_url = SOCIALNETWORK_URL."/".$info["friendly_url"]."/";
				} else {
					$paging_url = SOCIALNETWORK_URL."/index.php?id=".$id;
				}
			} else if ($pag_content == "favorites") {
				if (MODREWRITE_FEATURE == "on") {
					$paging_url = SOCIALNETWORK_URL."/".$info["friendly_url"]."/favorites";
				} else {
					$paging_url = SOCIALNETWORK_URL."/index.php?id=".$id."&c=favorites";
				}
			}
		}

		$array_pages_code = system_preparePagination($paging_url, "", $pageObj, "", $screen, $aux_items_per_page, (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? false : true));
	} else {
		$items = false;
	}
	?>
		
	<div class="itemSearchResults">

		<?
		if ($items) {
			
			include(system_getFrontendPath("results_filter.php"));
			include(system_getFrontendPath("results_pagination.php"));

			$levelListing = new ListingLevel(EDIR_DEFAULT_LANGUAGE, true);
			$levelClassified = new ClassifiedLevel(EDIR_DEFAULT_LANGUAGE, true);
			$levelEvent = new EventLevel(EDIR_DEFAULT_LANGUAGE, true);
			$levelArticle = new ArticleLevel(EDIR_DEFAULT_LANGUAGE, true);

			$locationManager = new LocationManager();

			$msgListing = 0;
			$msgEvent = 0;
			$msgArticle = 0;
			$msgClassified = 0;
            $count = 10;

			foreach ($items as $item) {

				$auxListing = new Listing();
				$auxClassified = new Classified();
				$auxEvent = new Event();
				$auxArticle = new Article();

				if ($item instanceof $auxListing)
					$type = "listing"; 
				elseif ($item instanceof $auxClassified)
					$type = "classified";
				elseif ($item instanceof $auxEvent)
					$type = "event";
				elseif ($item instanceof $auxArticle)
					$type = "article";

				if ($type == "listing"){
                    
                    /**
                     * This variable is used on view_listing_summary.php
                     */
                    if (TWILIO_APP_ENABLED == "on"){
                        if (TWILIO_APP_ENABLED_SMS == "on"){
                            $levelsWithSendPhone = system_retrieveLevelsWithInfoEnabled("has_sms");
                        }else{
                            $levelsWithSendPhone = false;
                        }
                        if (TWILIO_APP_ENABLED_CALL == "on"){
                            $levelsWithClicktoCall = system_retrieveLevelsWithInfoEnabled("has_call");
                        }else{
                            $levelsWithClicktoCall = false;
                        }
                    }else{
                        $levelsWithSendPhone = false;
                        $levelsWithClicktoCall = false;
                    }

					unset($listing);
					$listing = $item;
					$level = $levelListing;
					$listing->setLocationManager($locationManager);
					report_newRecord("listing", $listing->getString("id"), LISTING_REPORT_SUMMARY_VIEW);

					if ($msgListing == 0){ ?>
						<br />
						<h2 class="standardSubTitle"><?=system_showText(system_highlightWords(LANG_FAVORITE_LISTING));?></h2><?
						$msgListing = 1;
					}
					setting_get('commenting_edir', $commenting_edir);
					setting_get("review_listing_enabled", $review_enabled);
					$levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");
					include(INCLUDES_DIR."/views/view_listing_summary.php");

				}elseif ($type == "classified"){

					$classified = $item;
					$level = $levelClassified;
					$classified->setLocationManager($locationManager);
					report_newRecord("classified", $classified->getString("id"), CLASSIFIED_REPORT_SUMMARY_VIEW);

					if ($msgClassified == 0){ ?>
						<h2 class="standardSubTitle"><?=system_showText(system_highlightWords(LANG_FAVORITE_CLASSIFIED));?></h2><?
						$msgClassified = 1;
					}
					include(INCLUDES_DIR."/views/view_classified_summary.php");

				}elseif ($type == "event"){

					$event = $item;
					$level = $levelEvent;
					$event->setLocationManager($locationManager);
					report_newRecord("event", $event->getString("id"), EVENT_REPORT_SUMMARY_VIEW);

					if ($msgEvent == 0){ ?>
						<h2 class="standardSubTitle"><?=system_showText(system_highlightWords(LANG_FAVORITE_EVENT));?></h2><?
						$msgEvent = 1;
					}
					include(INCLUDES_DIR."/views/view_event_summary.php");

				}elseif($type == "article"){

					$article = $item;
					$level = $levelArticle;
					report_newRecord("article", $article->getString("id"), ARTICLE_REPORT_SUMMARY_VIEW);
					if ($msgArticle == 0){ ?>
						<h2 class="standardSubTitle"><?=system_showText(system_highlightWords(LANG_FAVORITE_ARTICLE));?></h2><?
						$msgArticle = 1;
					}
					include(INCLUDES_DIR."/views/view_article_summary.php");
				}
                
                if ($count%2 && ($count != 10) && ITEM_RESULTS_CLEAR){
                    echo "<br class=\"clear\" />";
                }
				$count--;
			}

			echo "<div class=\"summaryBottom\"></div>";

		
			include(system_getFrontendPath("results_pagination.php"));
				
		} else {
			echo "<p class=\"informationMessage\">".system_showText(LANG_LABEL_NOQUICKLIST)."</p>";
		}
		?>

	</div>