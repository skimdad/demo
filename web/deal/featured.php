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
	# * FILE: /deal/featured.php
	# ----------------------------------------------------------------------------------------------------

	// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedDeal2-->
	<?

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# SETTINGS
	# ----------------------------------------------------------------------------------------------------
    
    if (THEME_FEATURED_DEAL_BIG){
        $priceClass = "price-tag";
        $contentClass = "deal-feat-big";
        $imageOpenDiv = "<div class=\"deal-image\">";
        $imageCloseDiv = "</div>";
    } else {
        $priceClass = "left";
        $contentClass = "right";
        $imageOpenDiv = "";
        $imageCloseDiv = ""; 
    }

	$numberOfPromotions = 24;
	$lastItemStyle = 0;
	$specialItem = 24;
	


	unset($searchReturn);
	$searchReturn = search_frontPromotionSearch($_GET, "random", true);
            
	$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT ".($numberOfPromotions)."";
    $promotions = db_getFromDBBySQL("promotion", $sql); 

	$rotateEach = 2;
	$impressionNumber = 0;
	
	if ($promotions) { ?>

		<h2>
			<span><?=system_showText(LANG_FEATURED_PROMOTION);?></span>
			<?
			if (PROMOTION_SCALABILITY_OPTIMIZATION != "on"){
				$seeAllText = system_showText(LANG_LABEL_VIEW_ALL_PROMOTIONS);
				$seeAllTextLink = (MODREWRITE_FEATURE == "on" ? PROMOTION_DEFAULT_URL."/search/empty/where/empty" : PROMOTION_DEFAULT_URL."/results.php"); ?>
			
				
			<? } ?>
		</h2>
		
		<div class="featured featured-deal">
			<?

			$first_front_featured_promotions = true;
			$level = new ListingLevel();
			$countSpecialItem = 0;
			foreach ($promotions as $promotion) {
				
				$lastItemStyle++;

				/*
				 * Deal Price
				 */
				$deal_price = string_substr($promotion->dealvalue,0,(string_strpos($promotion->dealvalue,".")));
				$deal_cents = string_substr($promotion->dealvalue,(string_strpos($promotion->dealvalue,".")),3);
				if ($deal_cents == ".00") $deal_cents = "";
				$promotionLink = PROMOTION_DEFAULT_URL.'/'.((MODREWRITE_FEATURE!='on')?"detail.php?id=".$promotion->id:$promotion->getString('friendly_url').".html");
				if($countSpecialItem<$specialItem){
					
					 if($countSpecialItem==0){
						echo "<div class=\"left_deal\" style = \"width: 690px;\">";
					} 
					
					/* if(($lastItemStyle%2) && ($lastItemStyle!=1)){
						echo "<br class=\"clear\" />";
					} */
					
					/*
					 * Get the discount
					 */
					if ($promotion->realvalue>0){
						$offer = round(100-(($promotion->dealvalue*100)/$promotion->realvalue)).'%';
					}else{
						$offer = system_showText(LANG_NA);
					} 
					
					echo "<div class=\"featured-item featured-item-special\" style = \"clear: none; width:167px; height:220px;margin-right:1px;\">";
					
						echo "<div class=\"$priceClass\" style=\"padding-left:12px;\">";
							echo "<div class=\"deal-tag\">".CURRENCY_SYMBOL.$deal_price.($deal_cents ? "<span class=\"cents\">".$deal_cents."</span>" : "")."</div>";
							echo "<div class=\"deal-discount\">".$offer." OFF</div>";
						echo "</div>";
						
						echo "<div class=\"$contentClass\">";
							$imageObj = new Image($promotion->getNumber("thumb_id"));
							if ($imageObj->imageExists()) {
								echo $imageOpenDiv."<a href=\"".$promotionLink."\" class=\"image\">";
								echo $imageObj->getTag(true, IMAGE_FRONT_PROMOTION_WIDTH, IMAGE_FRONT_PROMOTION_HEIGHT, $promotion->getString("name"), true);
								echo "</a>".$imageCloseDiv;
							} else {
								echo $imageOpenDiv."<a href=\"".$promotionLink."\" class=\"image\">";
								echo "<span class=\"no-image\"></span>";
								echo "</a>".$imageCloseDiv;
							}
							echo "<h3><a href=\"".$promotionLink."\" title=\"".$promotion->getString("name")."\">".$promotion->getString("name", true, false)."</a></h3>";
			
							$listing = db_getFromDB("listing", "promotion_id", db_formatNumber($promotion->getNumber("id")), 1, "", "array");
							if ($listing["title"]) {
								if ($level->getDetail($listing["level"]) == "y") {
									if (MODREWRITE_FEATURE == "on") {
										$listing_link = "".LISTING_DEFAULT_URL."/".$listing["friendly_url"].".html";
									} else {
										$listing_link = "".LISTING_DEFAULT_URL."/detail.php?id=".$listing["id"]."";
									}
								} else {
									$listing_link = "".LISTING_DEFAULT_URL."/results.php?id=".$listing["id"];
								}
								$listingName = $listing["title"];
								echo "<p>".system_showText(LANG_BY)." <a href=\"".$listing_link."\" title=\"".string_htmlentities($listing["title"])."\">".$listingName."</a></p>";
							}
						echo "</div>";
						
					echo "</div>";
					
					if($countSpecialItem==($specialItem-1) || (count($promotions) == $countSpecialItem +1)){
						echo "</div>";
					}
					
					$countSpecialItem++;
					
				}else{

					$promtionPage = "/deal.php?id=".$promotion->getNumber("id");
					
					if($lastItemStyle==$numberOfPromotions){
						$itemStyle = "last";
					}elseif($lastItemStyle==($specialItem+1)){
						$itemStyle = "first";
					}else{
						$itemStyle = "";
					}
					
					echo "<div class=\"featured-item ".$itemStyle."\">";
					
					echo "<div class=\"deal-tag\">".CURRENCY_SYMBOL.$deal_price.($deal_cents ? "<span class=\"cents\">".$deal_cents."</span>" : "")."</div>";
					
					echo "<h3><a href=\"".$promotionLink."\" title=\"".$promotion->getString("name")."\">".$promotion->getString("name", true, false)."</a></h3>";
	
					$listing = db_getFromDB("listing", "promotion_id", db_formatNumber($promotion->getNumber("id")), 1, "", "array");

					if ($listing["title"]) {
						if ($level->getDetail($listing["level"]) == "y") {
							if (MODREWRITE_FEATURE == "on") {
								$listing_link = "".LISTING_DEFAULT_URL."/".$listing["friendly_url"].".html";
							} else {
								$listing_link = "".LISTING_DEFAULT_URL."/detail.php?id=".$listing["id"]."";
							}
						} else {
							$listing_link = "".LISTING_DEFAULT_URL."/results.php?id=".$listing["id"];
						}
						$listingName = $listing["title"];
						echo "<p>".system_showText(LANG_BY)." <a href=\"".$listing_link."\" title=\"".string_htmlentities($listing["title"])."\">".$listingName."</a></p>";
					}
	
					echo "</div>";

				}

			}
			
			echo "</div>";
			?> <h2><a class="view-more" href="<?=$seeAllTextLink?>"><?="VIEW ALL DEALS. . .";?></a></h2> <?
		} 
		// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedDeal2-->