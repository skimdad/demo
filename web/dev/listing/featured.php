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
	# * FILE: /listing/featured.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedListing2-->
	<?

	$numberOfListings = FEATURED_LISTING_MAXITEMS;
	$lastItemStyle = 0;
	$specialItem = FEATURED_LISTING_MAXITEMS_SPECIAL;

	$level = implode(",", system_getLevelDetail("ListingLevel"));

	if ($level) {
		unset($searchReturn);
		$searchReturn = search_frontListingSearch($_GET, "random");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." (Listing_Summary.level IN (".$level.")) ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ORDER BY ".($searchReturn["order_by"] ? $searchReturn["order_by"] : " `Listing_FeaturedTemp`.`random_number` ")." LIMIT ".$numberOfListings."";
		
		$random_listings = db_getFromDBBySQL("listing", $sql);
	}

	if ($random_listings) {
		$top_featured_listing = "";
		$featured_listing = "";
		
    ?>

		<h2>
			<span><?=system_showText(LANG_FEATURED_LISTING);?></span>

			<?
			if (LISTING_SCALABILITY_OPTIMIZATION != "on"){
				$seeAllText = system_showText(LANG_LABEL_VIEW_ALL_LISTINGS);
				$seeAllTextLink = (MODREWRITE_FEATURE == "on" ? LISTING_DEFAULT_URL."/search/empty/where/empty" : LISTING_DEFAULT_URL."/results.php"); ?>
			
				<a class="view-more" href="<?=$seeAllTextLink?>"><?=$seeAllText;?></a>
			<? } ?>
		</h2>
		
		<div class="featured featured-listing">

		<?
		$user = true;
		$count = 0;
		$countSpecialItem = 0;
		$ids_report_lote = "";
		foreach ($random_listings as $listing) {
			
			$ids_report_lote .= $listing->getString("id").",";

			if (MODREWRITE_FEATURE == "on") {
				$detailLink = "".LISTING_DEFAULT_URL."/".$listing->getString("friendly_url").".html";
			} else {
				$detailLink = "".LISTING_DEFAULT_URL."/detail.php?id=".$listing->getNumber("id")."";
			}

			$lastItemStyle++;
		
			if($countSpecialItem<$specialItem){
				
				if($countSpecialItem==0){
					echo "<div class=\"left\">";
				}
				
				if(($lastItemStyle%2) && ($lastItemStyle!=1) && !ITEM_RESULTS_CLEAR){
					echo "<br class=\"clear\" />";
				}
			
				echo "<div class=\"featured-item featured-item-special\">";
				
				echo "<div class=\"image\">";

				$imageObj = new Image($listing->getNumber("thumb_id"));
				if ($imageObj->imageExists()) {
					echo "<a href=\"".$detailLink."\" class=\"image\">";
					echo $imageObj->getTag(true, IMAGE_FEATURED_LISTING_WIDTH, IMAGE_FEATURED_LISTING_HEIGHT, $listing->getString("title"), true);
					echo "</a>";
				} else {
					echo "<a href=\"".$detailLink."\" class=\"image\">";
					echo "<span class=\"no-image\"></span>";
					echo "</a>";
				}

				echo "</div>";

				echo "<h3><a href=\"".$detailLink."\">".$listing->getString("title")."</a></h3>";
                
                if(LISTING_SCALABILITY_OPTIMIZATION == "on"){
                    $listing_moreInfo = "<a href=\"javascript: void(0);\" onclick=\"showCategory(".htmlspecialchars($listing->getNumber("id")).", 'listing', ".(true).", ".$listing->getNumber("account_id").", ".(true).");\" \>".system_showText(LANG_VIEWCATEGORY)."</a>";
                    echo "<p id=\"showCategory_listing".$listing->getNumber("id")."\">$listing_moreInfo</p>";

                } else {
                    echo "<p>";
                    echo system_itemRelatedCategories($listing->getNumber("id"), "listing", true);
                    $name = socialnetwork_writeLink($listing->getNumber("account_id"), "profile", "general_see_profile");
                    if ($name) {
                        echo " ".system_showText(LANG_BY)." ".$name." ";
                    }
                    echo "</p>";
                    
                }
                
				echo "</div>";
                
                if(!(($lastItemStyle-3)%3) && ITEM_RESULTS_CLEAR){
					echo "<br class=\"clear\" />";
				}
		
				if($countSpecialItem == ($specialItem-1) || (count($random_listings) == $countSpecialItem +1)){
					echo "</div>";
				}
				
				$countSpecialItem++;

			} else {

				if($lastItemStyle==$numberOfListings){
					$itemStyle = "last";
				}elseif($lastItemStyle==($specialItem+1)){
					$itemStyle = "first";
				}else{
					$itemStyle = "";
				}
			
				echo "<div class=\"featured-item ".$itemStyle."\">";

				echo "<h3><a href=\"".$detailLink."\">".$listing->getString("title", true, 30)."</a></h3>";
                
                if(LISTING_SCALABILITY_OPTIMIZATION == "on"){
                    $listing_moreInfo = "<a href=\"javascript: void(0);\" onclick=\"showCategory(".htmlspecialchars($listing->getNumber("id")).", 'listing', ".(true).", ".$listing->getNumber("account_id").", ".(true).");\" \>".system_showText(LANG_VIEWCATEGORY)."</a>";
                    echo "<p id=\"showCategory_listing".$listing->getNumber("id")."\">$listing_moreInfo</p>";
                } else {
                    echo "<p>";
                    echo system_itemRelatedCategories($listing->getNumber("id"), "listing", true);
                    $name = socialnetwork_writeLink($listing->getNumber("account_id"), "profile", "general_see_profile");
                    if ($name) {
                        echo " ".system_showText(LANG_BY)." ".$name." ";
                    }
                    echo "</p>";
                }

				echo "</div>";

			}

		}
		$ids_report_lote = string_substr($ids_report_lote, 0, -1);
		report_newRecord("listing", $ids_report_lote, LISTING_REPORT_SUMMARY_VIEW, true);
		
		echo "</div>";
	}

// Preparing markers to full cache
?>
	<!--cachemarkerFeaturedListing2-->