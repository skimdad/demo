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
	# * FILE: /classified/results.php
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
	if (CLASSIFIED_FEATURE != "on" || CUSTOM_CLASSIFIED_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# MOD-REWRITE
	# ----------------------------------------------------------------------------------------------------
	include(CLASSIFIED_EDIRECTORY_ROOT."/mod_rewrite.php");
	
	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	if ($category_id) {
		$catObj = new ClassifiedCategory($category_id);
		if (!$catObj->getStringLang(EDIR_LANGUAGE, "title")) {
			header("Location: ".CLASSIFIED_DEFAULT_URL."/index.php");
			exit;
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$contentObj = new Content("", EDIR_LANGUAGE);
	$sitecontentSection = "Classified Results";
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
	if (CLASSIFIED_SCALABILITY_OPTIMIZATION == "on") {
		if (!$_GET["keyword"] && !$_GET["where"] && !$_GET["category_id"] && !$mod_rewrite_have_location && !$_GET["zip"] && !$_GET["id"]) {
			$_GET["id"] = 0;
			$search_lock = true;
		}
	}

	// replacing useless spaces in search by "where"
	if ($_GET["where"]) {
		while (string_strpos($_GET["where"], "  ") !== false) {
			str_replace("  ", " ", $_GET["where"]);
		}
		if ((string_strpos($_GET["where"], ",") !== false) && (string_strpos($_GET["where"], ", ") === false)) {
			str_replace(",", ", ", $_GET["where"]);
		}
	}

	unset($searchReturn);
	$searchReturn = search_frontClassifiedSearch($_GET, "classified");
	$aux_items_per_page = ($_COOKIE["classified_results_per_page"] ? $_COOKIE["classified_results_per_page"] : 10);
	$pageObj = new pageBrowsing($searchReturn["from_tables"], (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? $page : $screen), $aux_items_per_page, $searchReturn["order_by"], "Classified.title", $letter, $searchReturn["where_clause"], $searchReturn["select_columns"], "Classified", $searchReturn["group_by"]);
	if (!$search_lock) {
		$classifieds = $pageObj->retrievePage();
	} else {
		$classifieds = false;
	}

	/*
	 * Will be used on:
	 * /frontend/results_info.php
	 * /frontend/results_filter.php
	 * /frontend/results_maps.php
	 * /includes/code/script_loader.php
	 */
	$aux_module_per_page			= "classified";
	$aux_module_items				= $classifieds; 
	$aux_module_itemRSSSection		= 'classified';
	
	/*
	 * Will be used on
	 * /frontend/browsebycategory.php
	 */
	$aux_CategoryObj				= "ClassifiedCategory";
	$aux_CategoryModuleURL			= CLASSIFIED_DEFAULT_URL;
	$aux_CategoryNumColumn			= 3;
	$aux_CategoryActiveField		= 'active_classified';
	
	$array_search_params = array();
	$_GET["advsearch"] = false;

	if (MODREWRITE_FEATURE == "on" && $_GET["url_full"]){
		if ($browsebycategory){
			$paging_url = CLASSIFIED_DEFAULT_URL."/guide";
			if ($_GET["url_full"]){
				$aux = str_replace(EDIRECTORY_FOLDER.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/".CLASSIFIED_FEATURE_FOLDER."/guide/", "", $_GET["url_full"]);
			}
		} else if ($browsebylocation){
			$paging_url = CLASSIFIED_DEFAULT_URL."/location";
			if ($_GET["url_full"]){
				$aux = str_replace(EDIRECTORY_FOLDER.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/".CLASSIFIED_FEATURE_FOLDER."/location/", "", $_GET["url_full"]);
			}
		} else {
			$paging_url = CLASSIFIED_DEFAULT_URL."/search";
			if ($_GET["url_full"]){
				$aux = str_replace(EDIRECTORY_FOLDER.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/".CLASSIFIED_FEATURE_FOLDER."/search/", "", $_GET["url_full"]);
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
		$paging_url = CLASSIFIED_DEFAULT_URL."/results.php";

		foreach ($_GET as $name => $value){
			if ($name != "screen" && $name != "letter" && $name != "url_full"){
				if ( $name == "keyword" || $name == "where" ) $array_search_params[] = $name."=".urlencode($value);
				else $array_search_params[] = $name."=".$value;
			}
		}
		
		$url_search_params = implode("&amp;", $array_search_params);
	}

	/*
	 * Preparing Pagination
	 */
	unset($letters_menu);
	$letters_menu		= system_prepareLetterToPagination($pageObj, $searchReturn, $paging_url, $url_search_params, $letter, "title", false, false, false, CLASSIFIED_SCALABILITY_OPTIMIZATION);
	$array_pages_code	= system_preparePagination($paging_url, $url_search_params, $pageObj, $letter, (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? $page  : $screen), $aux_items_per_page, (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? false : true));
	
	$user = true;

	# ORDER BY DROP DOWN ----------------------------------------------------------------------------------------------
	$orderBy = array(LANG_PAGING_ORDERBYPAGE_CHARACTERS,
					 LANG_PAGING_ORDERBYPAGE_LASTUPDATE,
					 LANG_PAGING_ORDERBYPAGE_DATECREATED,
					 LANG_PAGING_ORDERBYPAGE_POPULAR);

	$orderbyDropDown = search_getOrderbyDropDown($_GET, $paging_url, $orderBy, system_showText(LANG_PAGING_ORDERBYPAGE)." ", "this.form.submit();", $parts);
	# --------------------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$banner_section = "classified";
	$headertag_title = $headertagtitle;
	$headertag_description = $headertagdescription;
	$headertag_keywords = $headertagkeywords;
	if ($browsebycategory || $category_id) {
		if ($category_id) {
			$categoryObjHeaderTag = new ClassifiedCategory($category_id);
			if ($categoryObjHeaderTag->getStringLang(EDIR_LANGUAGE, "seo_description")) $headertag_description = $categoryObjHeaderTag->getStringLang(EDIR_LANGUAGE, "seo_description");
			if ($categoryObjHeaderTag->getStringLang(EDIR_LANGUAGE, "seo_keywords")) $headertag_keywords = $categoryObjHeaderTag->getStringLang(EDIR_LANGUAGE, "seo_keywords");
			unset($categoryObjHeaderTag);
		}
	} elseif ($browsebylocation) {
		include(INCLUDES_DIR."/code/headertaglocation.php");
	}
	include(system_getFrontendPath("header.php", "layout"));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
	$showLetter = true;
	if (!$classifieds && !$letter) $showLetter = false;

	# ----------------------------------------------------------------------------------------------------
	# BODY
	# ----------------------------------------------------------------------------------------------------
	include(THEMEFILE_DIR."/".EDIR_THEME."/body/classified_results.php");
	
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$banner_section = "classified";
	include(system_getFrontendPath("footer.php", "layout"));
	
	# ----------------------------------------------------------------------------------------------------
	# CACHE
	# ----------------------------------------------------------------------------------------------------
	cachefull_footer();
?>