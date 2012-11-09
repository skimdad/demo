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
	# * FILE: /frontend/featured_listing.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedListing-->
	<?
	$numberOfCols = 8;
	$lastItemStyle = 0; 
	$level = implode(",", system_getLevelDetail("ListingLevel"));
	if ($level) {
		unset($searchReturn);
		$searchReturn = search_frontListingSearch($_GET, "random");		
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." (Listing_Summary.level IN (".$level.")) ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ORDER BY ".($searchReturn["order_by"] ? $searchReturn["order_by"] : " `Listing_FeaturedTemp`.`random_number` ")." LIMIT ".$numberOfCols."";
		$front_featured_listings = db_getFromDBBySQL("listing", $sql, "array", true);
	}

	if ($front_featured_listings) {
		$seeAllText = system_showText(LANG_LABEL_VIEW_ALL_LISTINGS);
		?>
		
		<h2>
			<span><?=system_showText(LANG_FEATURED_LISTING);?></span>

		</h2>
		
		<div class="featured featured-listing">
			<?

			$languageIndex = language_getIndex(EDIR_LANGUAGE);
			$ids_report_lote = "";
			
			foreach ($front_featured_listings as $listing) {

				$lastItemStyle++;

				$ids_report_lote .= $listing["id"].",";

				if (MODREWRITE_FEATURE == "on") {
					$detailLink = "".LISTING_DEFAULT_URL."/".$listing["friendly_url"].".html";
				} else {
					$detailLink = "".LISTING_DEFAULT_URL."/detail.php?id=".$listing["id"]."";
				}
				
				echo "<div class=\"featured-item ".(($lastItemStyle == $numberOfCols) ? ("pd-0") : (""))."\">";

				$imageObj = new Image($listing["thumb_id"]);
				if ($imageObj->imageExists()) {
					echo "<a href=\"".$detailLink."\" class=\"image\">";
					echo $imageObj->getTag(true, IMAGE_FRONT_LISTING_WIDTH, IMAGE_FRONT_LISTING_HEIGHT, $listing["title"], true);
					echo "</a>";
				} else {
					echo "<a href=\"".$detailLink."\" class=\"image\">";
					echo "<span class=\"no-image\"></span>";
					echo "</a>";
				}

				echo "<h3><a href=\"".$detailLink."\">".$listing["title"]."</a></h3>";
				
                $listing_moreInfo = "";
                /* if(LISTING_SCALABILITY_OPTIMIZATION == "on"){
                    $listing_moreInfo = "<a href=\"javascript: void(0);\" onclick=\"showCategory(".htmlspecialchars($listing["id"]).", 'listing', ".(true).", ".$listing["account_id"].", ".(true).");\" \>".system_showText(LANG_VIEWCATEGORY)."</a>";
                    echo "<p id=\"showCategory_listing".$listing["id"]."\">$listing_moreInfo</p>";
                    
                } else {
                    $name = socialnetwork_writeLink($listing["account_id"], "profile", "general_see_profile");
                    $by_name = "";
                    if ($name) {
                        $by_name = " ".system_showText(LANG_BY)." ".$name." ";
                    }
                    echo "<p>".system_itemRelatedCategories($listing["id"], "listing", true).$by_name."</p>";
                } */

				echo "<p>".system_showTruncatedText($listing["description".$languageIndex], 75)."</p>";
				
				echo "</div>";
				
			}
			$ids_report_lote = string_substr($ids_report_lote, 0, -1);$rvw_str = $ids_report_lote;
			report_newRecord("listing", $ids_report_lote, LISTING_REPORT_SUMMARY_VIEW, true);

			?>
		</div>
		<h2><a class="view-more" href="<?=LISTING_DEFAULT_URL."/search/empty/where/empty"?>"><?=$seeAllText;?></a></h2>
		<?
	}

	// Preparing markers to full cache
?>
	<!--cachemarkerFeaturedListing-->