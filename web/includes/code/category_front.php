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
	# * FILE: /includes/code/category_front.php
	# ----------------------------------------------------------------------------------------------------

	$langIndex = language_getIndex(EDIR_LANGUAGE);

	# ----------------------------------------------------------------------------------------------------
	# LISTING CATEGORIES
	# ----------------------------------------------------------------------------------------------------

	unset($catObj);
	$catObj = new ListingCategory();
	unset($categories_listing);

	$listing_featuredcategory = "";
	if (FEATURED_CATEGORY == "on")
		setting_get("listing_featuredcategory", $listing_featuredcategory);

	if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
		$sql = "SELECT id, title$langIndex, friendly_url$langIndex, active_listing FROM ListingCategory WHERE category_id = '0' ".($listing_featuredcategory ?"AND featured = 'y'":"")." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title$langIndex <> '' AND friendly_url$langIndex <> '' AND enabled = 'y' ORDER BY title$langIndex, active_listing DESC LIMIT 20";
		$categories_listing = system_generateXML("categories", $sql, SELECTED_DOMAIN_ID);
	} else {
		$categories_listing = $catObj->retrieveAllCategoriesXML(EDIR_LANGUAGE, $listing_featuredcategory);
	}
	
	# ----------------------------------------------------------------------------------------------------
	# EVENT CATEGORIES
	# ----------------------------------------------------------------------------------------------------
	
	if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
		unset($catObj);
		$catObj = new EventCategory();
		unset($categories_event);

		$event_featuredcategory = "";
		if (FEATURED_CATEGORY == "on")
			setting_get("event_featuredcategory", $event_featuredcategory);

		if (EVENTCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
			$dbCatObj = db_getDBObJect();
			$sql = "SELECT id, title$langIndex, friendly_url$langIndex, active_event FROM EventCategory WHERE category_id = '0' ".($event_featuredcategory?"AND featured = 'y'":"")." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title$langIndex <> '' AND friendly_url$langIndex <> '' AND enabled = 'y' ORDER BY title$langIndex, active_event DESC LIMIT 20";
			$result = $dbCatObj->query($sql);
			$categories_event = false;
			while ($row = mysql_fetch_assoc($result)) $categories_event[] = $row;
			unset($dbCatObj);
		} else {
			$categories_event = $catObj->retrieveAllCategories(EDIR_LANGUAGE, $event_featuredcategory);
		}
	}
	
	# ----------------------------------------------------------------------------------------------------
	# CLASSIFIED CATEGORIES
	# ----------------------------------------------------------------------------------------------------
	
	if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
		unset($catObj);
		$catObj = new ClassifiedCategory();
		unset($categories_classified);

		$classified_featuredcategory = "";
		if (FEATURED_CATEGORY == "on")
			setting_get("classified_featuredcategory", $classified_featuredcategory);

		if (CLASSIFIEDCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
			$dbCatObj = db_getDBObJect();
			$sql = "SELECT id, title$langIndex, friendly_url$langIndex, active_classified FROM ClassifiedCategory WHERE category_id = '0' ".($classified_featuredcategory?"AND featured = 'y'":"")." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title$langIndex <> '' AND friendly_url$langIndex <> '' AND enabled = 'y' ORDER BY title$langIndex, active_classified DESC LIMIT 20";
			$result = $dbCatObj->query($sql);
			$categories_classified = false;
			while ($row = mysql_fetch_assoc($result)) $categories_classified[] = $row;
			unset($dbCatObj);
		} else {
			$categories_classified = $catObj->retrieveAllCategories(EDIR_LANGUAGE, $classified_featuredcategory);
		}
	}
	
	# ----------------------------------------------------------------------------------------------------
	# ARTICLE CATEGORIES
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
		unset($catObj);
		$catObj = new ArticleCategory();
		unset($categories_article);

		$article_featuredcategory = "";
		if (FEATURED_CATEGORY == "on")
			setting_get("article_featuredcategory", $article_featuredcategory);

		if (ARTICLECATEGORY_SCALABILITY_OPTIMIZATION == "on") {
			$dbCatObj = db_getDBObJect();
			$sql = "SELECT id, title$langIndex, friendly_url$langIndex, active_article FROM ArticleCategory WHERE category_id = '0' ".($article_featuredcategory?"AND featured = 'y'":"")." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title$langIndex <> '' AND friendly_url$langIndex <> '' AND enabled = 'y' ORDER BY title$langIndex, active_article DESC LIMIT 20";
			$result = $dbCatObj->query($sql);
			$categories_article = false;
			while ($row = mysql_fetch_assoc($result)) $categories_article[] = $row;
			unset($dbCatObj);
		} else {
			$categories_article = $catObj->retrieveAllCategories(EDIR_LANGUAGE, $article_featuredcategory);
		}
	}
	
	# ----------------------------------------------------------------------------------------------------
	# DEAL CATEGORIES
	# ----------------------------------------------------------------------------------------------------
	
	if (CUSTOM_HAS_PROMOTION == "on" && PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on"){
		unset($catObj);
		$catObj = new ListingCategory();
		unset($categories_deal);

		$listing_featuredcategory = "";
		if (FEATURED_CATEGORY == "on")
			setting_get("listing_featuredcategory", $listing_featuredcategory);

		if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
			$sql = "SELECT id, title$langIndex, friendly_url$langIndex, active_listing FROM ListingCategory WHERE category_id = '0' ".($listing_featuredcategory ?"AND featured = 'y'":"")." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title$langIndex <> '' AND friendly_url$langIndex <> '' AND enabled = 'y' ORDER BY title$langIndex, active_listing DESC LIMIT 20";
			$categories_deal = system_generateXML("categories", $sql, SELECTED_DOMAIN_ID);
		} else {
			$categories_deal = $catObj->retrieveAllCategoriesXML(EDIR_LANGUAGE, $listing_featuredcategory);
		}
	}
	
	$showCategoriesAccordion = false;
	
	if (is_string($categories_listing) || $categories_event || $categories_classified || $categories_article || is_string($categories_deal)){
		$showCategoriesAccordion = true;
	}

?>
