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
	# * FILE: /sitemapcontent.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

?>

	<? $langIndex = language_getIndex(EDIR_LANGUAGE); ?>

	<h2><?=system_showText(LANG_MENU_SITEMAP);?></h2> 

	<div class="sitemap">

		<h3><a href="<?=DEFAULT_URL?>/index.php" class="sitemapSection"><?=system_showText(LANG_MENU_HOME);?></a></h3>		
	
		<h3><a href="<?=LISTING_DEFAULT_URL?>/" class="sitemapSection"><?=system_showText(LANG_MENU_LISTING);?></a></h3>
		<?
		unset($categories);
		if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
			$sql = "SELECT id, title$langIndex, friendly_url$langIndex FROM ListingCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title$langIndex <> '' AND friendly_url$langIndex <> '' AND enabled = 'y' ORDER BY active_listing DESC LIMIT 20";
		} else {
			$sql = "SELECT id, title$langIndex, friendly_url$langIndex FROM ListingCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title$langIndex <> '' AND friendly_url$langIndex <> '' AND enabled = 'y' ORDER BY title$langIndex LIMIT ".MAX_SHOW_ALL_CATEGORIES;
		}
		$categories = db_getFromDBBySQL("listingcategory", $sql);
		if ($categories) {
			echo "<ul>";
			foreach ($categories as $category) {
				unset($catLink);
				if (MODREWRITE_FEATURE == "on") {
					$catLink = LISTING_DEFAULT_URL."/guide/".$category->getString("friendly_url".$langIndex);
				} else {
					$catLink = LISTING_DEFAULT_URL."/results.php?category_id=".$category->getNumber("id");
				}
				echo "<li><a href=\"".$catLink."\">".$category->getString("title".$langIndex)."</a></li>";
			}
			if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
				echo "<li class=\"view-more\"><a href=\"".LISTING_DEFAULT_URL."/allcategories.php\">".system_showText(LANG_LISTING_VIEWALLCATEGORIES)." &raquo;</a></li>";
			}
			echo "</ul>";
		}
		unset($categories);
		?>
	
		<? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
	
		<h3><a href="<?=EVENT_DEFAULT_URL?>/" class="sitemapSection"><?=system_showText(LANG_MENU_EVENT);?></a></h3>
		<?
		unset($categories);
		if (EVENTCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
			$sql = "SELECT id, title$langIndex, friendly_url$langIndex FROM EventCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title$langIndex <> '' AND friendly_url$langIndex <> '' AND enabled = 'y' ORDER BY active_event DESC LIMIT 20";
		} else {
			$sql = "SELECT id, title$langIndex, friendly_url$langIndex FROM EventCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title$langIndex <> '' AND friendly_url$langIndex <> '' AND enabled = 'y' ORDER BY title$langIndex LIMIT ".MAX_SHOW_ALL_CATEGORIES;
		}
		$categories = db_getFromDBBySQL("eventcategory", $sql);
		if ($categories) {
			echo "<ul>";
			foreach ($categories as $category) {
				unset($catLink);
				if (MODREWRITE_FEATURE == "on") {
					$catLink = EVENT_DEFAULT_URL."/guide/".$category->getString("friendly_url".$langIndex);
				} else {
					$catLink = EVENT_DEFAULT_URL."/results.php?category_id=".$category->getNumber("id");
				}
				echo "<li><a href=\"".$catLink."\">".$category->getString("title".$langIndex)."</a></li>";
			}
			if (EVENTCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
				echo "<li class=\"view-more\"><a href=\"".EVENT_DEFAULT_URL."/allcategories.php\">".system_showText(LANG_EVENT_VIEWALLCATEGORIES)." &raquo;</a></li>";
			}
			echo "</ul>";
		}
		unset($categories);
		?>
	
		<? } ?>
	
		<? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
	
		<h3><a href="<?=CLASSIFIED_DEFAULT_URL?>/" class="sitemapSection"><?=system_showText(LANG_MENU_CLASSIFIED);?></a></h3>
		<?
		unset($categories);
		if (CLASSIFIEDCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
			$sql = "SELECT id, title$langIndex, friendly_url$langIndex FROM ClassifiedCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title$langIndex <> '' AND friendly_url$langIndex <> '' AND enabled = 'y' ORDER BY active_classified DESC LIMIT 20";
		} else {
			$sql = "SELECT id, title$langIndex, friendly_url$langIndex FROM ClassifiedCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title$langIndex <> '' AND friendly_url$langIndex <> '' AND enabled = 'y' ORDER BY title$langIndex LIMIT ".MAX_SHOW_ALL_CATEGORIES;
		}
		$categories = db_getFromDBBySQL("classifiedcategory", $sql);
		if ($categories) {
			echo "<ul>";
			foreach ($categories as $category) {
				if (MODREWRITE_FEATURE == "on") {
					$catLink = CLASSIFIED_DEFAULT_URL."/guide/".$category->getString("friendly_url".$langIndex);
				} else {
					$catLink = CLASSIFIED_DEFAULT_URL."/results.php?category_id=".$category->getNumber("id");
				}
				echo "<li><a href=\"".$catLink."\">".$category->getString("title".$langIndex)."</a></li>";
			}
			if (CLASSIFIEDCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
				echo "<li class=\"view-more\"><a href=\"".CLASSIFIED_DEFAULT_URL."/allcategories.php\">".system_showText(LANG_CLASSIFIED_VIEWALLCATEGORIES)." &raquo;</a></li>";
			}
			echo "</ul>";
		}
		unset($categories);
		?>
	
		<? } ?>
	
		<? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
	
		<h3><a href="<?=ARTICLE_DEFAULT_URL?>/" class="sitemapSection"><?=system_showText(LANG_MENU_ARTICLE);?></a></h3>
		<?
		unset($categories);
		if (ARTICLECATEGORY_SCALABILITY_OPTIMIZATION == "on") {
			$sql = "SELECT id, title$langIndex, friendly_url$langIndex FROM ArticleCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title$langIndex <> '' AND friendly_url$langIndex <> '' AND enabled = 'y' ORDER BY active_article DESC LIMIT 20";
		} else {
			$sql = "SELECT id, title$langIndex, friendly_url$langIndex FROM ArticleCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title$langIndex <> '' AND friendly_url$langIndex <> '' AND enabled = 'y' ORDER BY title$langIndex LIMIT ".MAX_SHOW_ALL_CATEGORIES;
		}
		$categories = db_getFromDBBySQL("articlecategory", $sql);
		if ($categories) {
			echo "<ul>";
			foreach ($categories as $category) {
				if (MODREWRITE_FEATURE == "on") {
					$catLink = ARTICLE_DEFAULT_URL."/guide/".$category->getString("friendly_url".$langIndex);
				} else {
					$catLink = ARTICLE_DEFAULT_URL."/results.php?category_id=".$category->getNumber("id");
				}
				echo "<li><a href=\"".$catLink."\">".$category->getString("title".$langIndex)."</a></li>";
			}
			if (ARTICLECATEGORY_SCALABILITY_OPTIMIZATION == "on") {
				echo "<li class=\"view-more\"><a href=\"".ARTICLE_DEFAULT_URL."/allcategories.php\">".system_showText(LANG_ARTICLE_VIEWALLCATEGORIES)." &raquo;</a></li>";
			}
			echo "</ul>";
		}
		unset($categories);
		?>
	
	
		<? } ?>
	
		<? if ((PROMOTION_FEATURE == "on") && (CUSTOM_PROMOTION_FEATURE == "on") && ($hasPromotion)) { ?>
			
		<h3><a href="<?=PROMOTION_DEFAULT_URL?>/" class="sitemapSection"><?=system_showText(LANG_MENU_PROMOTION);?></a></h3>
		<?
		unset($categories);
		if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
			$sql = "SELECT id, title$langIndex, friendly_url$langIndex FROM ListingCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title$langIndex <> '' AND friendly_url$langIndex <> '' AND enabled = 'y' ORDER BY active_listing DESC LIMIT 20";
		} else {
			$sql = "SELECT id, title$langIndex, friendly_url$langIndex FROM ListingCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title$langIndex <> '' AND friendly_url$langIndex <> '' AND enabled = 'y' ORDER BY title$langIndex LIMIT ".MAX_SHOW_ALL_CATEGORIES;
		}
		$categories = db_getFromDBBySQL("listingcategory", $sql);
		if ($categories) {
			echo "<ul>";
			foreach ($categories as $category) {
				if (MODREWRITE_FEATURE == "on") {
					$catLink = PROMOTION_DEFAULT_URL."/guide/".$category->getString("friendly_url".$langIndex);
				} else {
					$catLink = PROMOTION_DEFAULT_URL."/results.php?category_id=".$category->getNumber("id");
				}
				echo "<li><a href=\"".$catLink."\">".$category->getString("title".$langIndex)."</a></li>";
			}
			if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
				echo "<li class=\"view-more\"><a href=\"".PROMOTION_DEFAULT_URL."/allcategories.php\">".system_showText(LANG_PROMOTION_VIEWALLCATEGORIES)." &raquo;</a></li>";
			}
			echo "</ul>";
		}
		unset($categories);
		?>
	
		<? } ?>
	
		<? if (BLOG_FEATURE == "on" && CUSTOM_BLOG_FEATURE == "on") { ?>
	
		<h3><a href="<?=BLOG_DEFAULT_URL?>/" class="sitemapSection"><?=system_showText(LANG_MENU_BLOG);?></a></h3>
		<?
		unset($categories);
		$sql = "SELECT id, title$langIndex, friendly_url$langIndex FROM BlogCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title$langIndex <> '' AND friendly_url$langIndex <> '' ORDER BY title$langIndex LIMIT ".MAX_SHOW_ALL_CATEGORIES;
		$categories = db_getFromDBBySQL("blogcategory", $sql);
		if ($categories) {
			echo "<ul>";
			foreach ($categories as $category) {
				if (MODREWRITE_FEATURE == "on") {
					$catLink = BLOG_DEFAULT_URL."/guide/".$category->getString("friendly_url".$langIndex);
				} else {
					$catLink = BLOG_DEFAULT_URL."/results.php?category_id=".$category->getNumber("id");
				}
				echo "<li><a href=\"".$catLink."\">".$category->getString("title".$langIndex)."</a></li>";
			}
			echo "</ul>";
		}
		unset($categories);
		?>
	
		<? } ?>
	
		<h3><a href="<?=DEFAULT_URL?>/advertise.php" class="sitemapSection"><?=system_showText(LANG_MENU_ADVERTISE);?></a></h3>
	
		<h3><a href="<?=DEFAULT_URL?>/faq.php" class="sitemapSection"><?=system_showText(LANG_MENU_FAQ);?></a></h3>
	
		<h3><a href="<?=DEFAULT_URL?>/contactus.php" class="sitemapSection"><?=system_showText(LANG_MENU_CONTACT);?></a></h3>

	</div>