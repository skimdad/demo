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
	# * FILE: /frontend/results.php
	# ----------------------------------------------------------------------------------------------------

?>

	<?

	$message_related_search = "<h2>".system_showText(LANG_LABEL_RELATEDSEARCH)."</h2>";
	$message_browse_section = "<h2>".system_showText(LANG_LABEL_BROWSESECTION)."</h2>";

	$this_items = 0;

	if ($keyword || $where) {

		$langIndex = language_getIndex(EDIR_LANGUAGE);
		$orderbyfield = "`title".$langIndex."`";

		$dbObj = db_getDBObject();

		####################################################################################################
		### LISTING
		####################################################################################################
		unset($searchReturn);
		$searchReturn = search_frontListingSearch($_GET, "count");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
		$result = $dbObj->query($sql);
		$row = mysql_fetch_array($result);
		$listingsRelatedSearch = $row[0];

		if ($listingsRelatedSearch > 0) {
			if ($this_items == 0) {
				if ($keyword || $where) echo $message_related_search;
				else echo $message_browse_section;
			}
			$this_items += $listingsRelatedSearch;
			?>
			<ul class="list list-category">

				<li class="level-1 level-title">
					<a href="<?=LISTING_DEFAULT_URL?>/results.php?keyword=<?=$keyword?>&amp;where=<?=$where?>"><?=system_showText(LANG_MENU_LISTING);?></a> <span>(<?=$listingsRelatedSearch?>)</span>
				</li>
				
				<?

				if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
					$categories = db_getFromDBBySQL("listingcategory", "SELECT * FROM ListingCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND enabled = 'y' ORDER BY $orderbyfield");
					if ($categories) {
						
						foreach ($categories as $category) {

							$this_category_id = $category->getNumber("id");

							unset($searchReturn);
							$_GET["category_id"] = $this_category_id;
							$searchReturn = search_frontListingSearch($_GET, "count");
							$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
							unset($_GET["category_id"]);

							$result = $dbObj->query($sql);
							$row = mysql_fetch_array($result);
							$thislistings = $row[0];
                            
							if ($thislistings > 0) {
								?>
								<li class="level-2">
									<span class="level-1 level-title">&nbsp;</span><a href="<?=LISTING_DEFAULT_URL?>/results.php?keyword=<?=$keyword?>&amp;where=<?=$where?>&amp;category_id=<?=$this_category_id?>"><?=$category->getString("title".$langIndex)?></a> <span>(<?=$thislistings?>)</span>
								</li>
								<?
							}
                            
						}
					}
				} 
				?>

			</ul>

			<?
		}
		####################################################################################################

		####################################################################################################
		### EVENT
		####################################################################################################
		if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {

			unset($searchReturn);
			$searchReturn = search_frontEventSearch($_GET, "count");
			$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
			$result = $dbObj->query($sql);
			$row = mysql_fetch_array($result);
			$eventsRelatedSearch = $row[0];

			if ($eventsRelatedSearch > 0) {
				if ($this_items == 0) {
					if ($keyword || $where) echo $message_related_search;
				else echo $message_browse_section;
				}
				$this_items += $eventsRelatedSearch;
				?>
				<ul class="list list-category">

					<li class="level-1 level-title">
						<a href="<?=EVENT_DEFAULT_URL?>/results.php?keyword=<?=$keyword?>&amp;where=<?=$where?>"><?=system_showText(LANG_MENU_EVENT);?></a> <span>(<?=$eventsRelatedSearch?>)</span>
					</li>

					<?
					if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
						$categories = db_getFromDBBySQL("eventcategory", "SELECT * FROM EventCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND enabled = 'y' ORDER BY $orderbyfield");
						if ($categories) {
							
							foreach ($categories as $category) {

								$this_category_id = $category->getNumber("id");

								unset($searchReturn);
								$_GET["category_id"] = $this_category_id;
								$searchReturn = search_frontEventSearch($_GET, "count");
								$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
								unset($_GET["category_id"]);

								$result = $dbObj->query($sql);
								$row = mysql_fetch_array($result);
								$thisevents = $row[0];

								if ($thisevents > 0) {
									?>
									<li class="level-2">
										<a href="<?=EVENT_DEFAULT_URL?>/results.php?keyword=<?=$keyword?>&amp;where=<?=$where?>&amp;category_id=<?=$this_category_id?>"><?=$category->getString("title".$langIndex)?></a> <span>(<?=$thisevents?>)</span>
									</li>
									<?
								}

							}

						}
					}
					?>

					

				</ul>

				<?
			}

		}
		####################################################################################################

		####################################################################################################
		### CLASSIFIED
		####################################################################################################
		if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {

			unset($searchReturn);
			$searchReturn = search_frontClassifiedSearch($_GET, "count");
			$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
			$result = $dbObj->query($sql);
			$row = mysql_fetch_array($result);
			$classifiedsRelatedSearch = $row[0];

			if ($classifiedsRelatedSearch > 0) {
				if ($this_items == 0) {
					if ($keyword || $where) echo $message_related_search;
				else echo $message_browse_section;
				}
				$this_items += $classifiedsRelatedSearch;
				?>
				<ul class="list list-category">

					<li class="level-1 level-title">
						<a href="<?=CLASSIFIED_DEFAULT_URL?>/results.php?keyword=<?=$keyword?>&amp;where=<?=$where?>"><?=system_showText(LANG_MENU_CLASSIFIED);?></a> <span>(<?=$classifiedsRelatedSearch?>)</span>
					</li>

					<?
					if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
						$categories = db_getFromDBBySQL("classifiedcategory", "SELECT * FROM ClassifiedCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND enabled = 'y' ORDER BY $orderbyfield");
						if ($categories) {
							
							foreach ($categories as $category) {

								$this_category_id = $category->getNumber("id");

								unset($searchReturn);
								$_GET["category_id"] = $this_category_id;
								$searchReturn = search_frontClassifiedSearch($_GET, "count");
								$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
								unset($_GET["category_id"]);

								$result = $dbObj->query($sql);
								$row = mysql_fetch_array($result);
								$thisclassifieds = $row[0];

								if ($thisclassifieds > 0) {
									?>
									<li class="level-2">
										<a href="<?=CLASSIFIED_DEFAULT_URL?>/results.php?keyword=<?=$keyword?>&amp;where=<?=$where?>&amp;category_id=<?=$this_category_id?>"><?=$category->getString("title".$langIndex)?></a> <span>(<?=$thisclassifieds?>)</span>
									</li>
									<?
								}

							}
						}
					}
					?>
				</ul>

				<?
			}

		}
		####################################################################################################

		####################################################################################################
		### ARTICLE
		####################################################################################################
		if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {

			unset($searchReturn);
			$searchReturn = search_frontArticleSearch($_GET, "count");
			$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
			$result = $dbObj->query($sql);
			$row = mysql_fetch_array($result);
			$articlesRelatedSearch = $row[0];

			if ($articlesRelatedSearch > 0) {
				if ($this_items == 0) {
					if ($keyword || $where) echo $message_related_search;
				else echo $message_browse_section;
				}
				$this_items += $articlesRelatedSearch;
				?>
				<ul class="list list-category">

					<li class="level-1 level-title">
						<a href="<?=ARTICLE_DEFAULT_URL?>/results.php?keyword=<?=$keyword?>&amp;where=<?=$where?>"><?=system_showText(LANG_MENU_ARTICLE);?></a> <span class="complementaryInfo">(<?=$articlesRelatedSearch?>)</span>
					</li>
					<?
					if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
						$categories = db_getFromDBBySQL("articlecategory", "SELECT * FROM ArticleCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND enabled = 'y' ORDER BY $orderbyfield");
						if ($categories) {
							
							foreach ($categories as $category) {

								$this_category_id = $category->getNumber("id");

								unset($searchReturn);
								$_GET["category_id"] = $this_category_id;
								$searchReturn = search_frontArticleSearch($_GET, "count");
								$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
								unset($_GET["category_id"]);

								$result = $dbObj->query($sql);
								$row = mysql_fetch_array($result);
								$thisarticles = $row[0];

								if ($thisarticles > 0) {
									?>
									<li class="level-2">
										<a href="<?=ARTICLE_DEFAULT_URL?>/results.php?keyword=<?=$keyword?>&amp;where=<?=$where?>&amp;category_id=<?=$this_category_id?>"><?=$category->getString("title".$langIndex)?></a> <span>(<?=$thisarticles?>)</span>
									</li>
									<?
								}

							}
						}
					}
					?>
				</ul>

				<?
			}

		}
		####################################################################################################

		####################################################################################################
		### PROMOTION
		####################################################################################################
		if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on") {
			if ($hasPromotion){
				unset($searchReturn);
				$searchReturn = search_frontPromotionSearch($_GET, "count");
				$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
				$result = $dbObj->query($sql);
				$row = mysql_fetch_array($result);
				$promotionsRelatedSearch = $row[0];

				if ($promotionsRelatedSearch > 0) {
					if ($this_items == 0) {
						if ($keyword || $where) echo $message_related_search;
						else echo $message_browse_section;
					}
					$this_items += $promotionsRelatedSearch;
					?>
					<ul class="list list-category">

						<li class="level-1 level-title">
							<a href="<?=PROMOTION_DEFAULT_URL?>/results.php?keyword=<?=$keyword?>&amp;where=<?=$where?>"><?=system_showText(LANG_MENU_PROMOTION);?></a> <span>(<?=$promotionsRelatedSearch?>)</span>
						</li>

						<?
						if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
							$categories = db_getFromDBBySQL("listingcategory", "SELECT * FROM ListingCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND enabled = 'y' ORDER BY $orderbyfield");
							if ($categories) {
								
								foreach ($categories as $category) {

									$this_category_id = $category->getNumber("id");

									unset($searchReturn);
									$_GET["category_id"] = $this_category_id;
									$searchReturn = search_frontPromotionSearch($_GET, "count");

									$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
									unset($_GET["category_id"]);

									$result = $dbObj->query($sql);
									$row = mysql_fetch_array($result);
									$thispromotions = $row[0];

									if ($thispromotions > 0) {
										?>
										
										<li class="level-2">
											<a href="<?=PROMOTION_DEFAULT_URL?>/results.php?keyword=<?=$keyword?>&amp;where=<?=$where?>&amp;category_id=<?=$this_category_id?>"><?=$category->getString("title".$langIndex)?></a> <span>(<?=$thispromotions?>)</span>
										</li>
										
										<?
									}

								}
							}
						}
						?>
					</ul>

					<?
				}
			}
		}
		####################################################################################################

	}

	if (!$this_items) {

		echo $message_browse_section;

		echo "<ul class=\"list list-category\">";
			echo "<li class=\"level-1\"><a href=\"".LISTING_DEFAULT_URL."/\">".system_showText(LANG_MENU_LISTING)."</a></li>";
			if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { echo "<li class=\"level-1\"><a href=\"".EVENT_DEFAULT_URL."/\">".system_showText(LANG_MENU_EVENT)."</a></li>"; }
			if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { echo "<li class=\"level-1\"><a href=\"".CLASSIFIED_DEFAULT_URL."/\">".system_showText(LANG_MENU_CLASSIFIED)."</a></li>"; }
			if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { echo "<li class=\"level-1\"><a href=\"".ARTICLE_DEFAULT_URL."/\">".system_showText(LANG_MENU_ARTICLE)."</a></li>"; }
			if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && $hasPromotion) {echo "<li class=\"level-1\"><a href=\"".PROMOTION_DEFAULT_URL."/\">".system_showText(LANG_MENU_PROMOTION)."</a></li>"; }
		echo "</ul>";

	}

	?>
