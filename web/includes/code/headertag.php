<?php

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
	# * FILE: /includes/code/headertag.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	unset($headertag_templateObj);
	unset($headertag_categoryObj);
	unset($extra_headertag_title);
	unset($extra_headertag_title_keyword);
	unset($extra_headertag_title_where);
	unset($extra_headertag_title_template);
	unset($extra_headertag_title_category);
	unset($extra_headertag_title_location);
	unset($extra_headertag_title_zip);
	unset($extra_headertag_title_screen);
	unset($extra_headertag_title_page);

	if (string_strpos($_SERVER["PHP_SELF"], "results.php") !== false) {

		$keyword = ($_GET["keyword"]) ? $_GET["keyword"] : $_POST["keyword"];
		if ($keyword) {
			$extra_headertag_title_keyword = string_strtoupper($keyword);
		}

		$where = ($_GET["where"]) ? $_GET["where"] : $_POST["where"];
		if ($where) {
			$extra_headertag_title_where = string_strtoupper($where);
		}

		$template_id = ($_GET["template_id"]) ? $_GET["template_id"] : $_POST["template_id"];
		if ($template_id) {
			$headertag_templateObj = new ListingTemplate($template_id);
			if ($headertag_templateObj && $headertag_templateObj->getString("title")) {
				$extra_headertag_title_template = $headertag_templateObj->getString("title");
			}
		}

		$category_id = ($_GET["category_id"]) ? $_GET["category_id"] : $_POST["category_id"];
		if ($category_id) {
			if (string_strpos($_SERVER["PHP_SELF"], ARTICLE_FEATURE_FOLDER) !== false) {
				$headertag_categoryObj = new ArticleCategory($category_id);
			} elseif (string_strpos($_SERVER["PHP_SELF"], CLASSIFIED_FEATURE_FOLDER) !== false) {
				$headertag_categoryObj = new ClassifiedCategory($category_id);
			} elseif (string_strpos($_SERVER["PHP_SELF"], EVENT_FEATURE_FOLDER) !== false) {
				$headertag_categoryObj = new EventCategory($category_id);
			} elseif (string_strpos($_SERVER["PHP_SELF"], LISTING_FEATURE_FOLDER) !== false) {
				$headertag_categoryObj = new ListingCategory($category_id);
			} elseif (string_strpos($_SERVER["PHP_SELF"], PROMOTION_FEATURE_FOLDER) !== false) {
				$headertag_categoryObj = new ListingCategory($category_id);
			} elseif (string_strpos($_SERVER["PHP_SELF"], BLOG_FEATURE_FOLDER) !== false) {
				$headertag_categoryObj = new BlogCategory($category_id);
			}
			if ($headertag_categoryObj && $headertag_categoryObj->getStringLang(EDIR_LANGUAGE, "page_title")) {
				$extra_headertag_title_category = $headertag_categoryObj->getStringLang(EDIR_LANGUAGE, "page_title");
			}
		}

		$locationsTag = array();
		$db_main = db_getDBObject(DEFAULT_DB,true);

		$location_1 = ($_GET["location_1"]) ? $_GET["location_1"] : $_POST["location_1"];
		$location_2 = ($_GET["location_2"]) ? $_GET["location_2"] : $_POST["location_2"];
		$location_3 = ($_GET["location_3"]) ? $_GET["location_3"] : $_POST["location_3"];
		$location_4 = ($_GET["location_4"]) ? $_GET["location_4"] : $_POST["location_4"];
		$location_5 = ($_GET["location_5"]) ? $_GET["location_5"] : $_POST["location_5"];
		
		if ($location_1) {
			$sql = "SELECT name FROM Location_1 WHERE id = ".$location_1;
			$row = mysql_fetch_assoc($db_main->query($sql));
			if ($row['name']) $locationsTag[] = $row['name'];
		}
		if ($location_2) {
			$sql = "SELECT name FROM Location_2 WHERE id = ".$location_2;
			$row = mysql_fetch_assoc($db_main->query($sql));
			if ($row['name']) $locationsTag[] = $row['name'];
		}
		if ($location_3) {
			$sql = "SELECT name FROM Location_3 WHERE id = ".$location_3;
			$row = mysql_fetch_assoc($db_main->query($sql));
			if ($row['name']) $locationsTag[] = $row['name'];
		}
		if ($location_4) {
			$sql = "SELECT name FROM Location_4 WHERE id = ".$location_4;
			$row = mysql_fetch_assoc($db_main->query($sql));
			if ($row['name']) $locationsTag[] = $row['name'];
		}
		if ($location_5) {
			$sql = "SELECT name FROM Location_5 WHERE id = ".$location_5;
			$row = mysql_fetch_assoc($db_main->query($sql));
			if ($row['name']) $locationsTag[] = $row['name'];
		}
		
		if ($locationsTag)
			$extra_headertag_title_location = implode (', ', $locationsTag);		

		$zip = ($_GET["zip"]) ? $_GET["zip"] : $_POST["zip"];
		if ($zip) {
			$extra_headertag_title_zip .= ZIPCODE_LABEL." ".$zip.(($dist)?(" (".$dist." ".ZIPCODE_UNIT_LABEL_PLURAL.")"):(""));
		}

		$screen = ($_GET["screen"]) ? $_GET["screen"] : $_POST["screen"];
		if ($screen) {
			$extra_headertag_title_screen = $screen;
		}

		$page = ($_GET["page"]) ? $_GET["page"] : $_POST["page"];
		if ($page) {
			$extra_headertag_title_page = $page;
		}

		$extra_headertag_title = "";
		if ($extra_headertag_title_keyword) {
			$extra_headertag_title .= " ".system_showText(LANG_SEARCHRESULTS_KEYWORD)." ".$extra_headertag_title_keyword;
		}
		if ($extra_headertag_title_where) {
			$extra_headertag_title .= " ".system_showText(LANG_SEARCHRESULTS_WHERE)." ".$extra_headertag_title_where;
		}
		if ($extra_headertag_title_template) {
			$extra_headertag_title .= " ".system_showText(LANG_SEARCHRESULTS_TEMPLATE)." ".$extra_headertag_title_template;
		}
		if ($extra_headertag_title_category) {
			$extra_headertag_title .= " ".system_showText(LANG_SEARCHRESULTS_CATEGORY)." ".$extra_headertag_title_category;
		}
		if ($extra_headertag_title_location) {
			$extra_headertag_title .= " ".system_showText(LANG_SEARCHRESULTS_LOCATION)." ".$extra_headertag_title_location;
		}
		if ($extra_headertag_title_zip) {
			$extra_headertag_title .= " ".system_showText(LANG_SEARCHRESULTS_ZIP)." ".$extra_headertag_title_zip;
		}
		if ($extra_headertag_title_screen) {
			$extra_headertag_title .= " - ".system_showText(LANG_SEARCHRESULTS_PAGE)." ".$extra_headertag_title_screen;
		}
		if ($extra_headertag_title_page) {
			$extra_headertag_title .= " - ".system_showText(LANG_SEARCHRESULTS_PAGE)." ".$extra_headertag_title_page;
		}
		if ($extra_headertag_title) {
			$extra_headertag_title = system_showText(LANG_SEARCHRESULTS)." ".$extra_headertag_title." | ";
		} else {
			$extra_headertag_title = system_showText(LANG_SEARCHRESULTS)." | ";
		}

	}

	unset($aux_get_header_tag);
	$aux_get_header_tag = array();
	if (!$headertag_title) {
		$aux_get_header_tag[] = "name = 'header_title'";
	}

	if (!$headertag_author) {
		$aux_get_header_tag[] = "name = 'header_author'";
	}

	if (!$headertag_description) {
		$aux_get_header_tag[] = "name = 'header_description'";
	}

	if (!$headertag_keywords) {
		$aux_get_header_tag[] = "name = 'header_keywords'";
	}

	$return_headertag = customtext_getByArray($aux_get_header_tag, EDIR_LANGUAGE);
	if(is_array($return_headertag)){
		
		extract($return_headertag);
		
		if(array_key_exists ("header_title", $return_headertag)){
			$headertag_title = (($header_title) ? ($header_title) : (EDIRECTORY_TITLE));
		}
		
		if(array_key_exists ("header_author", $return_headertag)){
			$headertag_author = (($header_author) ? ($header_author) : ("Arca Solutions"));
		}
		
		if(array_key_exists ("header_description", $return_headertag)){
			$headertag_description = (($header_description) ? ($header_description) : (EDIRECTORY_TITLE));
//wtc
$headertag_description = $headertag_description;

//end wtc
		}
		
		if(array_key_exists ("header_keywords", $return_headertag)){
			$headertag_keywords	= (($header_keywords) ? ($header_keywords) : EDIRECTORY_TITLE);
		}
		
	}
	
	if ($extra_headertag_title) {
		$headertag_title = $extra_headertag_title.$headertag_title ;
	}
	
	
	unset($headertag_templateObj);
	unset($headertag_categoryObj);
	unset($locationsTag);
	unset($extra_headertag_title);
	unset($extra_headertag_title_keyword);
	unset($extra_headertag_title_where);
	unset($extra_headertag_title_template);
	unset($extra_headertag_title_category);
	unset($extra_headertag_title_location);
	unset($extra_headertag_title_zip);
	unset($extra_headertag_title_screen);
	unset($extra_headertag_title_page);

?>
