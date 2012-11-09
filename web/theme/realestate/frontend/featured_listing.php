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
	# * FILE: /theme/realestate/frontend/featured_listing.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedListing-->
	<?
	$numberOfCols = 4;
	$lastItemStyle = 0;

	$level = implode(",", system_getLevelDetail("ListingLevel"));
    unset($whereLevel);
    $whereLevel  .= " Listing_Summary.level IN (".$level.")"; 
    
    $auxListingTemplate = new ListingTemplate(THEME_TEMPLATE_ID);
    $fieldPrice = $auxListingTemplate->getFieldByLabel("LANG_LABEL_TEMPLATE_PRICE");

	if ($level) {
		unset($searchReturn);
		$searchReturn = search_frontListingSearch($_GET, "random");
		$sql = "SELECT ".$searchReturn["select_columns"].", listingtemplate_id".($fieldPrice ? ", $fieldPrice" : "").",Listing_Summary.image_id FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." ( ".$whereLevel." ) ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ORDER BY ".($searchReturn["order_by"] ? $searchReturn["order_by"] : " `Listing_FeaturedTemp`.`random_number` ")." LIMIT ".($numberOfCols+1)."";
		$front_featured_listings = db_getFromDBBySQL("listing", $sql, "array", true);
	}

	if ($front_featured_listings) {
        
        $languageIndex = language_getIndex(EDIR_LANGUAGE);
        $seeAllText = system_showText(LANG_LABEL_VIEW_ALL_LISTINGS);
        $ids_report_lote = "";
        $featured_listing_Special = array_shift($front_featured_listings);
        $ids_report_lote .= $featured_listing_Special["id"].",";
        
        //Special Listing
        if (MODREWRITE_FEATURE == "on") {
            $firstListing_detailLink = "".LISTING_DEFAULT_URL."/".$featured_listing_Special["friendly_url"].".html";
        } else {
            $firstListing_detailLink = "".LISTING_DEFAULT_URL."/detail.php?id=".$featured_listing_Special["id"]."";
        }
        
        $firstListing_imgTag = "";
        
        $firstListing_imageObj = new Image($featured_listing_Special["image_id"]);
        if ($firstListing_imageObj->imageExists()) {
            $firstListing_imgTag .= "<a href=\"".$firstListing_detailLink."\" class=\"image\">";
            $firstListing_imgTag .= $firstListing_imageObj->getTag(true, IMAGE_FRONT_LISTING_SPECIAL_WIDTH, IMAGE_FRONT_LISTING_SPECIAL_HEIGHT, $featured_listing_Special["title"], true);
            $firstListing_imgTag .= "</a>";
        } else {
            $firstListing_imgTag .= "<a href=\"".$firstListing_detailLink."\" class=\"image\">";
            $firstListing_imgTag .= "<span class=\"no-image\"></span>";
            $firstListing_imgTag .= "</a>";
        }
        
        ?>
    
        <div class="content-featured-listing <?=(!$hasSlider ? "content-featured-align" : "")?>">
            <div class="featured-listing-special">
                <ul>
                    <li>
                        <div class="listing-item">
                            <div class="left">
                                <?=$firstListing_imgTag?>
                            </div>	
                            <div class="right">
                                <h2><?=system_showText(LANG_ITEM_FEATURED);?></h2>
                                <h2><a href="<?=$firstListing_detailLink?>"><?=system_showTruncatedText($featured_listing_Special["title"], 60)?></a></h2>
                                <p class="desc"><?=system_showTruncatedText($featured_listing_Special["description".$languageIndex], 125)?></p>
                                <p class="button-more"><a href="<?=$firstListing_detailLink?>"><?=system_showText(LANG_MOREINFO);?></a></p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    
        <?
        //Others Listings
		?>
		
		<h2>
			<span><?=system_showText(LANG_FEATURED_LISTING);?></span>
			<a class="view-more" href="<?=LISTING_DEFAULT_URL?>"><?=$seeAllText;?></a>
		</h2>
		
		<div class="featured featured-listing">
			<?
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

				echo "<div class=\"listing-content\"><h3><a href=\"".$detailLink."\">".$listing["title"]."</a></h3>";
				
                $listing_moreInfo = "";
                if(LISTING_SCALABILITY_OPTIMIZATION == "on"){
                    $listing_moreInfo = "<a href=\"javascript: void(0);\" onclick=\"showCategory(".htmlspecialchars($listing["id"]).", 'listing', ".(true).", ".$listing["account_id"].", ".(true).");\" \>".system_showText(LANG_VIEWCATEGORY)."</a>";
                    echo "<p id=\"showCategory_listing".$listing["id"]."\">$listing_moreInfo</p>";
                    
                } else {
                    $name = socialnetwork_writeLink($listing["account_id"], "profile", "general_see_profile");
                    $by_name = "";
                    if ($name) {
                        $by_name = " ".system_showText(LANG_BY)." ".$name." ";
                    }
                    echo "<p>".system_itemRelatedCategories($listing["id"], "listing", true)."</p>";
                }
                
				if ($listing[$fieldPrice] && $listing["listingtemplate_id"] == THEME_TEMPLATE_ID){
                    echo "<p class=\"price\"><span>".CURRENCY_SYMBOL." ".$listing[$fieldPrice]."</span></p>";
                }

				echo "<p class=\"description\">".system_showTruncatedText($listing["description".$languageIndex], 105)."</p>";
				
				echo "</div><span class=\"clear\">&nbsp;</span>";
				
				echo "<p class=\"button-featured\"><a href=\"".$detailLink."\">".system_showText(LANG_READMORE)."</a></p></div>";
				
			}
			$ids_report_lote = string_substr($ids_report_lote, 0, -1);
			report_newRecord("listing", $ids_report_lote, LISTING_REPORT_SUMMARY_VIEW, true);

			?>
		
		</div>

		<?
	}

	// Preparing markers to full cache
?>
	<!--cachemarkerFeaturedListing-->