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
	# * FILE: /listing/results.php
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
	# MOD-REWRITE
	# ----------------------------------------------------------------------------------------------------
	include(LISTING_EDIRECTORY_ROOT."/mod_rewrite.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");
	include_once(EDIRECTORY_ROOT."/conf/load_wtc.php");	
	

	if ($category_id) {
		$catObj = new ListingCategory($category_id);
		if (!$catObj->getStringLang(EDIR_LANGUAGE, "title")) {
			header("Location: ".LISTING_DEFAULT_URL."/index.php");
			exit;
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$contentObj = new Content("", EDIR_LANGUAGE);
	$sitecontentSection = "Listing Results";
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
	//$countlisting = false;
	include(EDIRECTORY_ROOT."/functions/search_count.php");


	$search_lock = false;
	if (LISTING_SCALABILITY_OPTIMIZATION == "on") {
		if (!$_GET["keyword"] && !$_GET["where"] && !$_GET["category_id"] && !$mod_rewrite_have_location && !$_GET["zip"] && !$_GET["template_id"] && !$_GET["id"]) {
			$_GET["id"] = 0;
			$search_lock = true;
		} else {
				$_SESSION["s_catid"] = $_GET["category_id"];
			if ($_GET["keyword"] && string_strlen($_GET["keyword"]) < (int)FT_MIN_WORD_LEN && !$_GET["where"]) {
				$_GET["id"] = 0;
				$search_lock = true;
			} else if ($_GET["keyword"] && !$_GET["where"]) {
				$aux = explode(" ", $_GET["keyword"]);
				$search_lock = true;
				for ($i = 0; $i < count($aux); $i++) {
					if (string_strlen($aux[$i]) >= (int)FT_MIN_WORD_LEN) {
						$search_lock = false;
					}
				}
				if ($seach_lock) {
					$_GET["id"] = 0;
				}
			}

			if ($_GET["where"] && string_strlen($_GET["where"]) < (int)FT_MIN_WORD_LEN && !$_GET["keyword"]) {
				$_GET["id"] = 0;
				$search_lock = true;
			} else if ($_GET["where"] && !$_GET["keyword"]) {
				$aux = explode(" ", $_GET["where"]);
				$search_lock = true;
				for ($i = 0; $i < count($aux); $i++) {
					if (string_strlen($aux[$i]) >= (int)FT_MIN_WORD_LEN) {
						$search_lock = false;
					}
				}
				if ($search_lock) {
					$_GET["id"] = 0;
				}
			}

			if ($_GET["keyword"] && string_strlen($_GET["keyword"]) < (int)FT_MIN_WORD_LEN && $_GET["where"] && string_strlen($_GET["where"]) < (int)FT_MIN_WORD_LEN) {
				$_GET["id"] = 0;
				$search_lock = true;
			}
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

	unset($bronzeSearchReturn);
	if(!$search_lock){

		if (!($_GET['id']))
			$_GET['except_level'] = '70';

		$searchReturn = search_frontListingSearch($_GET, "listing_results",false,false);
		$aux_items_per_page = ($_COOKIE["listing_results_per_page"] ? $_COOKIE["listing_results_per_page"] : 10);
		$pageObj = new pageBrowsing($searchReturn["from_tables"], (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? $page : $screen), $aux_items_per_page, $searchReturn["order_by"], "Listing_Summary.title", $letter, $searchReturn["where_clause"], $searchReturn["select_columns"], "Listing_Summary", $searchReturn["group_by"]);
		$listings = $pageObj->retrievePage("array",$searchReturn["total_listings"]);
		$paging_url = LISTING_DEFAULT_URL."/results.php";



		//if (!($_GET['id'] || $_GET['keyword'])) {
		if (!$_GET['id'] || true) {
			$get_requests = $_GET;
			unset($get_requests['except_level']);
			//unset($get_requests['keyword']);
			$get_requests['level'] = '70';
			if ($_GET['letterb'])
			$get_requests['letter'] = $_GET['letterb'];

			$bronzeSearchReturn = search_frontListingSearch($get_requests, "listing_results",false,true);
			//$bronzePageObj = new pageBrowsing($bronzeSearchReturn["from_tables"], (MODREWRITE_FEATURE == "on" && $get_requests["url_full"] ? $pageb : $screen), 30, $bronzeSearchReturn["order_by"], "Listing_Summary.title", $letterb, $bronzeSearchReturn["where_clause"], $bronzeSearchReturn["select_columns"], "Listing_Summary", $bronzeSearchReturn["group_by"]);

			$bronzePageObj = new pageBrowsing($bronzeSearchReturn["from_tables"], (MODREWRITE_FEATURE == "on" && $get_requests["url_full"] ? $page : $screen), 30, $bronzeSearchReturn["order_by"], "Listing_Summary.title", $letter, $bronzeSearchReturn["where_clause"], $bronzeSearchReturn["select_columns"], "Listing_Summary", $bronzeSearchReturn["group_by"]);
			$bronze_listings = $bronzePageObj->retrievePage("array",$bronzeSearchReturn["total_listings"]);
		}


		/*
		 * Will be used on:
		 * /frontend/results_info.php
		 * /frontend/results_filter.php
		 * /frontend/results_maps.php
		 * /includes/code/script_loader.php
		 */
		$aux_module_per_page			= "listing";
		$aux_module_items				= $listings; 
		$aux_module_itemRSSSection		= 'listing';
		
		/*
		 * Will be used on
		 * /frontend/browsebycategory.php
		 */
		$aux_CategoryObj				= "ListingCategory";
		$aux_CategoryModuleURL			= LISTING_DEFAULT_URL;
		$aux_CategoryNumColumn			= 3;
		$aux_CategoryActiveField		= 'active_listing';
		
        $levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");
	
		$array_search_params = array();	
		$_GET["advsearch"] = false;			

		if (MODREWRITE_FEATURE == "on" && $_GET["url_full"]){
            if ($browsebycategory){
                $paging_url = LISTING_DEFAULT_URL."/guide";
                if ($_GET["url_full"] ){
                    $aux = str_replace(EDIRECTORY_FOLDER.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/".LISTING_FEATURE_FOLDER."/guide/", "", $_GET["url_full"]);
                }
            } else if ($browsebylocation){
                $paging_url = LISTING_DEFAULT_URL."/location";
                if ($_GET["url_full"]){
                    $aux = str_replace(EDIRECTORY_FOLDER.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/".LISTING_FEATURE_FOLDER."/location/", "", $_GET["url_full"]);
                }
            } else {
                $paging_url = LISTING_DEFAULT_URL."/search";
                if ($_GET["url_full"]){
                    $aux = str_replace(EDIRECTORY_FOLDER.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/".LISTING_FEATURE_FOLDER."/search/", "", $_GET["url_full"]);
                }
            }

			$parts = explode("/", $aux);

			for($i=0; $i < count($parts); $i++ ){
				if ($parts[$i]){
					if ($parts[$i] != "page" && $parts[$i] != "letter" && $parts[$i] != "pageb" && $parts[$i] != "letterb" && $parts[$i] != "orderby"){



						$array_search_params[] = "/".urlencode($parts[$i]);

					} else {

						if ($parts[$i] != "page" && $parts[$i] != "letter" && $parts[$i] != "pageb" && $parts[$i] != "letterb"){
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
			$paging_url = LISTING_DEFAULT_URL."/results.php";

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
		$letters_menu		= system_prepareLetterToPagination($pageObj, $searchReturn, $paging_url, $url_search_params, $letter, "title", false, false, false, LISTING_SCALABILITY_OPTIMIZATION);
		$array_pages_code	= system_preparePagination($paging_url, $url_search_params, $pageObj, $letter, (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? $page  : $screen), $aux_items_per_page, (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? false : true));

		// the following code is modified by Debiprasad
		if (!($_GET['id'])) {
			unset($letters_menu_bronze);
			$letters_menu_bronze = system_prepareLetterToPagination($bronzePageObj, $bronzeSearchReturn, $paging_url, $url_search_params, $letterb, "title", false, false, false, LISTING_SCALABILITY_OPTIMIZATION, 'letterb', '#content-main-bronze');
			$array_pages_code_bronze = system_preparePagination($paging_url, $url_search_params, $bronzePageObj, $letterb, (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? $pageb  : $screen), 30, (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? false : true), 'letterb', 'pageb', '#content-main-bronze');
		}
		$totallistingsfound = $array_pages_code["total"] + $array_pages_code_bronze["total"];
		$user = true;


		setting_get('commenting_edir', $commenting_edir);
		setting_get("review_listing_enabled", $review_enabled);
		$db = db_getDBObject();			
		$sql = "SELECT count(*) as nunberOfReviews FROM Review WHERE item_type = 'listing'";
		//$result = $db->query($sql);
		$result = $db->unbuffered_query($sql);
		$result = mysql_fetch_assoc($result);
		$numberOfReviews = $result['nunberOfReviews'];


/* 		if ($review_enabled && $commenting_edir && $numberOfReviews){
			$orderBy =  array(LANG_PAGING_ORDERBYPAGE_CHARACTERS,LANG_PAGING_ORDERBYPAGE_LASTUPDATE,LANG_PAGING_ORDERBYPAGE_DATECREATED,LANG_PAGING_ORDERBYPAGE_POPULAR,LANG_PAGING_ORDERBYPAGE_RATING);	
		}else{
			$orderBy =  array(LANG_PAGING_ORDERBYPAGE_CHARACTERS,LANG_PAGING_ORDERBYPAGE_LASTUPDATE,LANG_PAGING_ORDERBYPAGE_DATECREATED,LANG_PAGING_ORDERBYPAGE_POPULAR);	
		} */

		if ($review_enabled && $commenting_edir && $numberOfReviews){
			$orderBy =  array(LANG_PAGING_ORDERBYPAGE_REVIEWS,LANG_PAGING_ORDERBYPAGE_DISTANCE,LANG_PAGING_ORDERBYPAGE_AZ);
		} else {
			$orderBy =  array(LANG_PAGING_ORDERBYPAGE_AZ,LANG_PAGING_ORDERBYPAGE_DISTANCE);
		}
        
        if (LISTING_ORDERBY_PRICE){
            array_unshift($orderBy, LANG_PAGING_ORDERBYPAGE_PRICE);
        }
        
		$orderbyDropDown = search_getOrderbyDropDown($_GET, $paging_url, $orderBy, system_showText(LANG_PAGING_ORDERBYPAGE)." ", "this.form.submit();", $parts, false, false);
    }
	


	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------

	$banner_section = "listing";
	$headertag_title = $headertagtitle;
	$headertag_description = $headertagdescription;
	$headertag_keywords = $headertagkeywords;
	if ($browsebycategory || $category_id) {
        if ($category_id) {
            $categoryObjHeaderTag = new ListingCategory($category_id);
            if ($categoryObjHeaderTag->getStringLang(EDIR_LANGUAGE, "seo_description")){
                $headertag_description = $categoryObjHeaderTag->getStringLang(EDIR_LANGUAGE, "seo_description");
            }
            if ($categoryObjHeaderTag->getStringLang(EDIR_LANGUAGE, "seo_keywords")){
                $headertag_keywords = $categoryObjHeaderTag->getStringLang(EDIR_LANGUAGE, "seo_keywords");
            }
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
	if (!$listings && !$letter) $showLetter = false;
	// the following code is added by Debiprasad
	$showLetterBronze = true;
	if (!$bronze_listings && !$letterb) $showLetterBronze = false;
	
	
	# ----------------------------------------------------------------------------------------------------
	# BODY
	# ----------------------------------------------------------------------------------------------------
	include(THEMEFILE_DIR."/".EDIR_THEME."/body/home_results.php");

	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(system_getFrontendPath("footer.php", "layout"));
	
	# ----------------------------------------------------------------------------------------------------
	# CACHE
	# ----------------------------------------------------------------------------------------------------
	cachefull_footer();
?>