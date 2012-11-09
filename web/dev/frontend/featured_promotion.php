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
    # * FILE: /frontend/featured_promotion.php
    # ----------------------------------------------------------------------------------------------------

    // Preparing markers to Full Cache
    ?>
    <!--cachemarkerFeaturedDeal-->


    <?
    # ----------------------------------------------------------------------------------------------------
    # VALIDATE FEATURE
    # ----------------------------------------------------------------------------------------------------
    if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on") {
        if ( CUSTOM_HAS_PROMOTION ) {

            # ----------------------------------------------------------------------------------------------------
            # CODE
            # ----------------------------------------------------------------------------------------------------

            $numberOfCols = 4;
            $lastItemStyle = 0;

            unset($searchReturn);
            $searchReturn = search_frontPromotionsearch($_GET, "random");
            $sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT ".$numberOfCols."";
            $front_featured_promotions = db_getFromDBBySQL("promotion", $sql, "array");

            if ($front_featured_promotions) {
                $seeAllText = system_showText(LANG_LABEL_VIEW_ALL_PROMOTIONS);

                ?>

                <h2>
                    <span><?=system_showText(LANG_FEATURED_PROMOTION);?></span>
                    <a class="view-more" href="<?=PROMOTION_DEFAULT_URL?>"><?=$seeAllText;?></a>
                </h2>

                <div class="featured featured-deal">
                    <?
                    $specialItem = 1;
                    $first_front_featured_promotions = true;
                    $level = new ListingLevel();
                    foreach ($front_featured_promotions as $promotion) {

                        $lastItemStyle++;

                        /*
                        * Deal Price
                        */
                        $deal_price = string_substr($promotion["dealvalue"],0,(string_strpos($promotion["dealvalue"],".")));
                        $deal_cents = string_substr($promotion["dealvalue"],(string_strpos($promotion["dealvalue"],".")),3);
                        if ($deal_cents == ".00"){
                            $deal_cents = "";
                        }
                        $promotionLink = PROMOTION_DEFAULT_URL.'/'.((MODREWRITE_FEATURE!='on')?"detail.php?id=".$promotion["id"] : $promotion["friendly_url"].".html");
                        if($specialItem==1){

                            /*
                            * Get the discount
                            */
                            if ($promotion["realvalue"]>0){
                                $offer = round(100-(($promotion["dealvalue"]*100)/$promotion["realvalue"])).'%';
                            }else{
                                $offer = system_showText(LANG_NA);
                            }

                            echo "<div class=\"featured-item featured-item-special\">";

                            echo "<div class=\"left\">";
                            echo "<div class=\"deal-tag\">".CURRENCY_SYMBOL.$deal_price.($deal_cents ? "<span class=\"cents\">".$deal_cents."</span>" : "")."</div>";
                            echo "<div class=\"deal-discount\">".$offer." OFF</div>";
                            echo "</div>";

                            echo "<div class=\"right\">";
                            $imageObj = new Image($promotion["thumb_id"]);
                            if ($imageObj->imageExists()) {
                                echo "<a href=\"".$promotionLink."\" class=\"image\">";
                                echo $imageObj->getTag(true, IMAGE_FRONT_PROMOTION_WIDTH, IMAGE_FRONT_PROMOTION_HEIGHT, $promotion["name"], true);
                                echo "</a>";
                            } else {
                                echo "<a href=\"".$promotionLink."\" class=\"image\">";
                                echo "<span class=\"no-image\"></span>";
                                echo "</a>";
                            }
                            echo "<h3><a href=\"".$promotionLink."\" title=\"".$promotion["name"]."\">".$promotion["name"]."</a></h3>";

                            $listing = db_getFromDB("listing", "promotion_id", db_formatNumber($promotion["id"]), 1, "", "array");
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
                            } else {
	                            $listing = db_getFromDB("listing", "promotion_id_two", db_formatNumber($promotion["id"]), 1, "", "array");
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
	                            } else {
		                            $listing = db_getFromDB("listing", "promotion_id_three", db_formatNumber($promotion["id"]), 1, "", "array");
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
		                            } else {
			                            $listing = db_getFromDB("listing", "promotion_id_four", db_formatNumber($promotion["id"]), 1, "", "array");
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
			                            } else {
				                            $listing = db_getFromDB("listing", "promotion_id_five", db_formatNumber($promotion["id"]), 1, "", "array");
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
			                            }
		                            }
	                            }     
                            }
                            echo "</div>";

                            echo "</div>";

                            $specialItem++;

                        }else{

                            $promtionPage = "/deal.php?id=".$promotion["id"];

                            if($lastItemStyle==$numberOfCols){
                                $itemStyle = "last";
                            }elseif($lastItemStyle==2){
                                $itemStyle = "first";
                            }else{
                                $itemStyle = "";
                            }

                            echo "<div class=\"featured-item ".$itemStyle."\">";

                            echo "<div class=\"deal-tag\">".CURRENCY_SYMBOL.$deal_price.($deal_cents ? "<span class=\"cents\">".$deal_cents."</span>" : "")."</div>";

                            echo "<h3><a href=\"".$promotionLink."\" title=\"".$promotion["name"]."\">".$promotion["name"]."</a></h3>";

                            $listing = db_getFromDB("listing", "promotion_id", db_formatNumber($promotion["id"]), 1, "", "array");
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
                            } else {
	                            $listing = db_getFromDB("listing", "promotion_id_two", db_formatNumber($promotion["id"]), 1, "", "array");
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
	                            } else {
		                            $listing = db_getFromDB("listing", "promotion_id_three", db_formatNumber($promotion["id"]), 1, "", "array");
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
		                            } else {
			                            $listing = db_getFromDB("listing", "promotion_id_four", db_formatNumber($promotion["id"]), 1, "", "array");
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
			                            } else {
				                            $listing = db_getFromDB("listing", "promotion_id_five", db_formatNumber($promotion["id"]), 1, "", "array");
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
			                            }
		                            }
	                            }
                            }

                            echo "</div>\n\n";

                        }

                    }

                    ?>
                </div>

                <?

            }
        }
    }
    // Preparing markers to full cache
    ?>
    <!--cachemarkerFeaturedDeal-->