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
	# * FILE: /article/results.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");
	
	# ----------------------------------------------------------------------------------------------------
	# CACHE
	# ----------------------------------------------------------------------------------------------------
	cachefull_header();

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSessionFront();

	# ----------------------------------------------------------------------------------------------------
	# MAINTENANCE MODE
	# ----------------------------------------------------------------------------------------------------
	verify_maintenanceMode();
	
	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on" || CUSTOM_ARTICLE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# MOD-REWRITE
	# ----------------------------------------------------------------------------------------------------
	include(ARTICLE_EDIRECTORY_ROOT."/mod_rewrite.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	if ($category_id) {
		$catObj = new ArticleCategory($category_id);
		if (!$catObj->getStringLang(EDIR_LANGUAGE, "title")) {
			header("Location: ".ARTICLE_DEFAULT_URL."/index.php");
			exit;
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$contentObj = new Content("", EDIR_LANGUAGE);
	$sitecontentSection = "Article Results";
	$sitecontentinfo = $contentObj->retrieveContentInfoByType($sitecontentSection);
	if ($sitecontentinfo) {
		$headertagtitle = $sitecontentinfo["title"];
		$headertagdescription = $sitecontentinfo["description"];
		$headertagkeywords = $sitecontentinfo["keywords"];
		$sitecontent = $sitecontentinfo["content"];
	} else {
		$headertagtitle = "";
		$headertagdescription = "";
		$headertagkeywords = "";
		$sitecontent = "";
	}

	# ----------------------------------------------------------------------------------------------------
	# RESULTS
	# ----------------------------------------------------------------------------------------------------

	$search_lock = false;
	if (ARTICLE_SCALABILITY_OPTIMIZATION == "on") {
		if (!$_GET["keyword"] && !$_GET["category_id"] && !$_GET["id"]) {
			$_GET["id"] = 0;
			$search_lock = true;
		}
	}

	unset($searchReturn);
	$searchReturn = search_frontArticleSearch($_GET, "article");
	$aux_items_per_page = ($_COOKIE["article_results_per_page"] ? $_COOKIE["article_results_per_page"] : 10);
	$pageObj = new pageBrowsing($searchReturn["from_tables"], (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? $page : $screen), $aux_items_per_page, $searchReturn["order_by"], "Article.title", $letter, $searchReturn["where_clause"], $searchReturn["select_columns"], "Article", $searchReturn["group_by"]);
	if (!$search_lock) {
		$articles = $pageObj->retrievePage();
	} else {
		$articles = false;
	}

	/*
	 * Will be used on:
	 * /frontend/results_info.php
	 * /frontend/results_filter.php
	 * /frontend/results_maps.php
	 * /includes/code/script_loader.php
	 */
	$aux_module_per_page			= "article";
	$aux_module_items				= $articles; 
	$aux_module_itemRSSSection		= 'article';
	
	/*
	 * Will be used on
	 * /frontend/browsebycategory.php
	 */
	$aux_CategoryObj				= "ArticleCategory";
	$aux_CategoryModuleURL			= ARTICLE_DEFAULT_URL;
	$aux_CategoryNumColumn			= 3;
	$aux_CategoryActiveField		= 'active_article';
	
	$array_search_params = array();
	$_GET["advsearch"] = false;

	if (MODREWRITE_FEATURE == "on" && $_GET["url_full"]){
		if ($browsebycategory){
			$paging_url = ARTICLE_DEFAULT_URL."/guide";
			if ($_GET["url_full"]){
				$aux = str_replace(EDIRECTORY_FOLDER.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/".ARTICLE_FEATURE_FOLDER."/guide/", "", $_GET["url_full"]);
			}
		} else {
			$paging_url = ARTICLE_DEFAULT_URL."/search";
			if ($_GET["url_full"]){
				$aux = str_replace(EDIRECTORY_FOLDER.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/".ARTICLE_FEATURE_FOLDER."/search/", "", $_GET["url_full"]);
			}
		}

		$parts = explode("/", $aux);

		for($i=0; $i < count($parts); $i++ ){
			if ($parts[$i]){
				if ($parts[$i] != "page" && $parts[$i] != "letter" && $parts[$i] != "orderby"){
					$array_search_params[] = "/".urlencode($parts[$i]);
				} else {
					if ($parts[$i] != "page" && $parts[$i] != "letter"){
						$array_search_params[] = "/".$parts[$i]."/".$parts[$i+1];
						$i++;
					} else {
						$i++;
					}
				}
			}
		}

		$url_search_params = implode("/", $array_search_params);
		
		if (string_substr($url_search_params, -1) == "/"){
			$url_search_params = string_substr($url_search_params, 0, -1);
		}
		$url_search_params = str_replace("//", "/", $url_search_params);

	} else {
		$paging_url = ARTICLE_DEFAULT_URL."/results.php";

		foreach ($_GET as $name => $value){
			if ($name != "screen" && $name != "letter" && $name != "url_full"){
				if ( $name == "keyword" ) $array_search_params[] = $name."=".urlencode($value);
				else $array_search_params[] = $name."=".$value;
			}
		}
		
		$url_search_params = implode("&amp;", $array_search_params);
	}

	/*
	 * Preparing Pagination
	 */
	unset($letters_menu);
	$letters_menu		= system_prepareLetterToPagination($pageObj, $searchReturn, $paging_url, $url_search_params, $letter, "title", false, false, false, ARTICLE_SCALABILITY_OPTIMIZATION);
	$array_pages_code	= system_preparePagination($paging_url, $url_search_params, $pageObj, $letter, (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? $page  : $screen), $aux_items_per_page, (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? false : true));

	$user = true;

	setting_get('commenting_edir', $commenting_edir);
	setting_get("review_article_enabled", $review_article_enabled);
	$db = db_getDBObject();			
	$sql = "SELECT count(*) as nunberOfReviews FROM Review WHERE item_type = 'article'";
	$result = $db->query($sql);
	$result = mysql_fetch_assoc($result);
	$numberOfReviews = $result['nunberOfReviews'];	
	
	if ($review_article_enabled && $commenting_edir && $numberOfReviews){
		$orderBy =  array(LANG_PAGING_ORDERBYPAGE_CHARACTERS,LANG_PAGING_ORDERBYPAGE_LASTUPDATE,LANG_PAGING_ORDERBYPAGE_DATECREATED,LANG_PAGING_ORDERBYPAGE_POPULAR,LANG_PAGING_ORDERBYPAGE_RATING);	
	} else {
		$orderBy =  array(LANG_PAGING_ORDERBYPAGE_CHARACTERS,LANG_PAGING_ORDERBYPAGE_LASTUPDATE,LANG_PAGING_ORDERBYPAGE_DATECREATED,LANG_PAGING_ORDERBYPAGE_POPULAR);	
	}
	$orderbyDropDown = search_getOrderbyDropDown($_GET, $paging_url, $orderBy, system_showText(LANG_PAGING_ORDERBYPAGE)." ", "this.form.submit();", $parts);
	# --------------------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$banner_section = "article";
	$headertag_title = $headertagtitle;
	$headertag_description = $headertagdescription;
	$headertag_keywords = $headertagkeywords;
	if ($browsebycategory || $category_id) {
		if ($category_id) {
			$categoryObjHeaderTag = new ArticleCategory($category_id);
			if ($categoryObjHeaderTag->getStringLang(EDIR_LANGUAGE, "seo_description")) $headertag_description = $categoryObjHeaderTag->getStringLang(EDIR_LANGUAGE, "seo_description");
			if ($categoryObjHeaderTag->getStringLang(EDIR_LANGUAGE, "seo_keywords")) $headertag_keywords = $categoryObjHeaderTag->getStringLang(EDIR_LANGUAGE, "seo_keywords");
			unset($categoryObjHeaderTag);
		}
	}
	include(system_getFrontendPath("header.php", "layout"));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
	$showLetter = true;
	if (!$articles && !$letter) $showLetter = false;

	# ----------------------------------------------------------------------------------------------------
	# BODY
	# ----------------------------------------------------------------------------------------------------
	include(THEMEFILE_DIR."/".EDIR_THEME."/body/article_results.php");
	
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$banner_section = "article";
	include(system_getFrontendPath("footer.php", "layout"));
	
	# ----------------------------------------------------------------------------------------------------
	# CACHE
	# ----------------------------------------------------------------------------------------------------
	cachefull_footer();
?>