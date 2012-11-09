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
	# * FILE: /deal/special_deal.php
	# ----------------------------------------------------------------------------------------------------

	// Preparing markers to Full Cache
	?>
	<!--cachemarkerSpecialDeal-->
	<?

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	unset($searchReturn);
	$searchReturn = search_frontPromotionsearch($options, "random");
	$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT 1";
	$front_featured_promotions = db_getFromDBBySQL("promotion", $sql);
	$promotion = $front_featured_promotions[0];	
	
	if ($promotion){
		$deal_price = string_substr($promotion->getNumber("dealvalue"),0,(string_strpos($promotion->getNumber("dealvalue"),".")));
		$deal_cents = string_substr($promotion->getNumber("dealvalue"),(string_strpos($promotion->getNumber("dealvalue"),".")),3);
		if ($deal_cents == ".00") $deal_cents = "";
		$promotionLink = PROMOTION_DEFAULT_URL.'/'.((MODREWRITE_FEATURE!='on')?"detail.php?id=".$promotion->getNumber("id"):$promotion->getString("friendly_url").".html");

		if ($promotion->getNumber("realvalue")>0){
			$offer = round(100-(($promotion->getNumber("dealvalue")*100)/$promotion->getNumber("realvalue"))).'%';
		}else{
			$offer = system_showText(LANG_NA);
		}

		$imageObj = new Image($promotion->getNumber("image_id"));
		if ($imageObj->imageExists()) {
			$imgTag = $imageObj->getTag(true, IMAGE_FEATURED_PROMOTION_WIDTH, IMAGE_FEATURED_PROMOTION_HEIGHT, $promotion->getString("name"), true);
		} else {
			$imgTag = "<span class=\"no-image\"></span>";
		}

		$listing = db_getFromDB("listing", "promotion_id", db_formatNumber($promotion->getNumber("id")), 1, "");
		if ($listing->getString("title")) {
			$level = new ListingLevel();
			if ($level->getDetail($listing->getNumber("level")) == "y") {
				if (MODREWRITE_FEATURE == "on") {
					$listing_link = "".LISTING_DEFAULT_URL."/".$listing->getString("friendly_url").".html";
				} else {
					$listing_link = "".LISTING_DEFAULT_URL."/detail.php?id=".$listing->getNumber("id")."";
				}
			} else {
				$listing_link = "".LISTING_DEFAULT_URL."/results.php?id=".$listing->getNumber("id");
			}
			$listingName = $listing->getString("title");
		} else {
			$listing = db_getFromDB("listing", "promotion_id_two", db_formatNumber($promotion->getNumber("id")), 1, "");
			if ($listing->getString("title")) {
				$level = new ListingLevel();
				if ($level->getDetail($listing->getNumber("level")) == "y") {
					if (MODREWRITE_FEATURE == "on") {
						$listing_link = "".LISTING_DEFAULT_URL."/".$listing->getString("friendly_url").".html";
					} else {
						$listing_link = "".LISTING_DEFAULT_URL."/detail.php?id=".$listing->getNumber("id")."";
					}
				} else {
					$listing_link = "".LISTING_DEFAULT_URL."/results.php?id=".$listing->getNumber("id");
				}
				$listingName = $listing->getString("title");
			} else {
				$listing = db_getFromDB("listing", "promotion_id_three", db_formatNumber($promotion->getNumber("id")), 1, "");
				if ($listing->getString("title")) {
					$level = new ListingLevel();
					if ($level->getDetail($listing->getNumber("level")) == "y") {
						if (MODREWRITE_FEATURE == "on") {
							$listing_link = "".LISTING_DEFAULT_URL."/".$listing->getString("friendly_url").".html";
						} else {
							$listing_link = "".LISTING_DEFAULT_URL."/detail.php?id=".$listing->getNumber("id")."";
						}
					} else {
						$listing_link = "".LISTING_DEFAULT_URL."/results.php?id=".$listing->getNumber("id");
					}
					$listingName = $listing->getString("title");
				} else {
					$listing = db_getFromDB("listing", "promotion_id_four", db_formatNumber($promotion->getNumber("id")), 1, "");
					if ($listing->getString("title")) {
						$level = new ListingLevel();
						if ($level->getDetail($listing->getNumber("level")) == "y") {
							if (MODREWRITE_FEATURE == "on") {
								$listing_link = "".LISTING_DEFAULT_URL."/".$listing->getString("friendly_url").".html";
							} else {
								$listing_link = "".LISTING_DEFAULT_URL."/detail.php?id=".$listing->getNumber("id")."";
							}
						} else {
							$listing_link = "".LISTING_DEFAULT_URL."/results.php?id=".$listing->getNumber("id");
						}
						$listingName = $listing->getString("title");
					} else {
						$listing = db_getFromDB("listing", "promotion_id_five", db_formatNumber($promotion->getNumber("id")), 1, "");
						if ($listing->getString("title")) {
							$level = new ListingLevel();
							if ($level->getDetail($listing->getNumber("level")) == "y") {
								if (MODREWRITE_FEATURE == "on") {
									$listing_link = "".LISTING_DEFAULT_URL."/".$listing->getString("friendly_url").".html";
								} else {
									$listing_link = "".LISTING_DEFAULT_URL."/detail.php?id=".$listing->getNumber("id")."";
								}
							} else {
								$listing_link = "".LISTING_DEFAULT_URL."/results.php?id=".$listing->getNumber("id");
							}
							$listingName = $listing->getString("title");
						}
					}
				}
			}
		}

		$_GET["except_ids"] = $promotion->getNumber("id");
		?>

        <? if (THEME_FEATURED_DEAL_BIG) { ?>
            <div class="special-deal">
                <div class="special-deal-border">
                    <div class="left">
                        <div class="deal-tag">
                            <span class="price"><?=CURRENCY_SYMBOL.$deal_price.($deal_cents ? "<span class=\"cents\">".$deal_cents."</span>" : "");?></span>
                            <span class="discount"><?=$offer;?> OFF</span>
                        </div>
                        <a href="<?=$promotionLink;?>"><?=$imgTag;?></a>
                    </div>	
                    <div class="right">
                        <h2><a href="<?=$promotionLink;?>"><?=$promotion->getString("name");?></a></h2>
                        <p class="info"><?=LANG_BY;?> <a href="<?=$listing_link;?>"><?=$listingName;?></a></p>
                        <p><?=$promotion->getStringLang(EDIR_LANGUAGE, "description");?></p>
                        <p class="button-featured">
                            <a href="<?=$promotionLink;?>">
                                <?=system_showText(LANG_LABEl_VIEW_DEAL);?>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        <? } else { ?>
            <div class="special-deal">
                <div class="left">
                    <div class="deal-tag">
                        <span class="price"><?=CURRENCY_SYMBOL.$deal_price.($deal_cents ? "<span class=\"cents\">".$deal_cents."</span>" : "");?></span>
                        <span class="discount"><?=$offer;?> OFF</span>
                    </div>
                    <a href="<?=$promotionLink;?>"><?=$imgTag;?></a>
                </div>	
                <div class="right">
                    <h2><a href="<?=$promotionLink;?>"><?=$promotion->getString("name");?></a></h2>
                    <p class="info"><?=LANG_BY;?> <a href="<?=$listing_link;?>"><?=$listingName;?></a></p>
                    <p><?=$promotion->getStringLang(EDIR_LANGUAGE, "description");?></p>
                </div>
            </div>
        <? } ?>

		<?
		unset($promotion, $listing, $level);
	}
	// Preparing markers to Full Cache
	?>
	<!--cachemarkerSpecialDeal-->