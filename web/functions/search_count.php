<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /functions/search_count.php
	# ----------------------------------------------------------------------------------------------------

// replacing useless spaces in search by "where"
if ($_GET["where"]) {
	while (string_strpos($_GET["where"], "  ") !== false) {
		str_replace("  ", " ", $_GET["where"]);
	}
	if ((string_strpos($_GET["where"], ",") !== false) && (string_strpos($_GET["where"], ", ") === false)) {
		str_replace(",", ", ", $_GET["where"]);
	}
}

	
if (!isset($countlisting)) { 
	# ----------------------------------------------------------------------------------------------------
	# RESULTS
	# ----------------------------------------------------------------------------------------------------
	//$_GET = parse_str($_SESSION['s_qurl']);	
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
		if (!($_GET['id'])) {
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
	}
} //End if ($countlisting === false) {	


///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

if (!isset($countdeal)) {
	//$_GET = parse_str($_SESSION['s_qurl']);
	$search_lock = false;
	if (PROMOTION_SCALABILITY_OPTIMIZATION == "on") {
		if (!$_GET["keyword"] && !$_GET["where"] && !$_GET["category_id"] && !$mod_rewrite_have_location && !$_GET["zip"] && !$_GET["id"]) {
			$_GET["id"] = 0;
			$search_lock = true;
		}
	}


	unset($searchReturn);
    $_GET['status']='A';
	$searchReturn = search_frontPromotionSearch($_GET, "promotion_results");    
    $aux_items_per_page = ($_COOKIE["promotion_results_per_page"] ? $_COOKIE["promotion_results_per_page"] : 20);
    $pageObj = new pageBrowsing($searchReturn["from_tables"], (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? $page : $screen), $aux_items_per_page, $searchReturn["order_by"], "Promotion.name", $letter, $searchReturn["where_clause"], $searchReturn["select_columns"], "Promotion", $searchReturn["group_by"], false, false, $searchReturn["having_clause"]);
	if (!$search_lock) {
        $promotions = $pageObj->retrievePage();
	} else {
        $promotions = false;
	}

	$aux_module_per_page			= "promotion";
	$aux_module_items				= $promotions; 
	$aux_module_itemRSSSection		= 'deal';

	$aux_CategoryObj				= "ListingCategory";
	$aux_CategoryModuleURL			= PROMOTION_DEFAULT_URL;
	$aux_CategoryNumColumn			= 3;
	$aux_CategoryActiveField		= false;
	

	$paging_url = PROMOTION_DEFAULT_URL."/results.php";

	$array_search_params = array();
	$_GET["advsearch"] = false;

	if (MODREWRITE_FEATURE == "on" && $_GET["url_full"]){
		if ($browsebycategory){
			$paging_url = PROMOTION_DEFAULT_URL."/guide";
			if ($_GET["url_full"]){
				$aux = str_replace(EDIRECTORY_FOLDER.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/".PROMOTION_FEATURE_FOLDER."/guide/", "", $_GET["url_full"]);
			}
		} else if ($browsebylocation){
			$paging_url = PROMOTION_DEFAULT_URL."/location";
			if ($_GET["url_full"]){
				$aux = str_replace(EDIRECTORY_FOLDER.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/".PROMOTION_FEATURE_FOLDER."/location/", "", $_GET["url_full"]);
			}
		} else {
			$paging_url = PROMOTION_DEFAULT_URL."/search";
			if ($_GET["url_full"]){
				$aux = str_replace(EDIRECTORY_FOLDER.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/".PROMOTION_FEATURE_FOLDER."/search/", "", $_GET["url_full"]);
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
		if (string_substr($url_search_params, -1) == "/")
			$url_search_params = string_substr($url_search_params, 0, -1);
		$url_search_params = str_replace("//", "/", $url_search_params);

	}else {
		$paging_url = PROMOTION_DEFAULT_URL."/results.php";

		foreach ($_GET as $name => $value){
			if ($name != "page" && $name != "letter" && $name != "url_full"){
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
	$letters_menu		= system_prepareLetterToPagination($pageObj, $searchReturn, $paging_url, $url_search_params, $letter, "name", false, true, false, PROMOTION_SCALABILITY_OPTIMIZATION);
	$array_pages_code	= system_preparePagination($paging_url, $url_search_params, $pageObj, $letter, (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? $page  : $screen), $aux_items_per_page, (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? false : true));
	$totaldealsfound = $array_pages_code["total"];
	$user = true;
	
	setting_get('commenting_edir', $commenting_edir);
	setting_get("review_promotion_enabled", $review_enabled);
	$db = db_getDBObject();			
	$sql = "SELECT count(*) as nunberOfReviews FROM Review WHERE item_type = 'promotion'";
	$result = $db->query($sql);
	$result = mysql_fetch_assoc($result);
	$numberOfReviews = $result['nunberOfReviews'];
	
	/* if ($review_enabled && $commenting_edir && $numberOfReviews){
		$orderBy =  array(LANG_PAGING_ORDERBYPAGE_CHARACTERS,LANG_PAGING_ORDERBYPAGE_LASTUPDATE,LANG_PAGING_ORDERBYPAGE_DATECREATED,LANG_PAGING_ORDERBYPAGE_POPULAR,LANG_PAGING_ORDERBYPAGE_RATING);
	} else {
		$orderBy =  array(LANG_PAGING_ORDERBYPAGE_CHARACTERS,LANG_PAGING_ORDERBYPAGE_LASTUPDATE,LANG_PAGING_ORDERBYPAGE_DATECREATED,LANG_PAGING_ORDERBYPAGE_POPULAR);	
	} */
	if ($review_enabled && $commenting_edir && $numberOfReviews){
		$orderBy =  array(LANG_PAGING_ORDERBYPAGE_AZ,LANG_PAGING_ORDERBYPAGE_DISTANCE,LANG_PAGING_ORDERBYPAGE_REVIEWS);
	} else {
		$orderBy =  array(LANG_PAGING_ORDERBYPAGE_AZ,LANG_PAGING_ORDERBYPAGE_DISTANCE);
	}
	$orderbyDropDown = search_getOrderbyDropDown($_GET, $paging_url, $orderBy, system_showText(LANG_PAGING_ORDERBYPAGE)." ", "this.form.submit();", $parts, true);
} //End if ($countdeal === false) {	


///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

if (!isset($countclassified)) {

	//$tmpGET = $_GET; $_GET = parse_str($_SESSION['s_qurl']);
	$search_lock = false;
	if (CLASSIFIED_SCALABILITY_OPTIMIZATION == "on") {
		if (!$_GET["keyword"] && !$_GET["where"] && !$_GET["category_id"] && !$mod_rewrite_have_location && !$_GET["zip"] && !$_GET["id"]) {
			$_GET["id"] = 0;
			$search_lock = true;
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

	$aux_module_per_page			= "classified";
	$aux_module_items				= $classifieds; 
	$aux_module_itemRSSSection		= 'classified';

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
				if ( $name == "keyword" || $name == "where" ) 
					$array_search_params[] = $name."=".urlencode($value);
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
	$totalclassifiedsfound = $array_pages_code["total"];	
	$user = true;
	//$_GET = $tmpGET;
} //End if ($countclassified === false) {	


///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

if (!isset($countevent)) {

	$search_lock = false;
	if (EVENT_SCALABILITY_OPTIMIZATION == "on") {
		if (!$_GET["keyword"] && !$_GET["where"] && !$_GET["category_id"] && !$mod_rewrite_have_location && !$_GET["zip"] && !$_GET["id"] && !$_GET["this_date"] && !$_GET["month"]) {
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
	$searchReturn = search_frontEventSearch($_GET, "event");
	$aux_items_per_page = ($_COOKIE["event_results_per_page"] ? $_COOKIE["event_results_per_page"] : 10);
	$pageObj = new pageBrowsing($searchReturn["from_tables"], (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? $page : $screen), $aux_items_per_page, $searchReturn["order_by"], "Event.title", $letter, $searchReturn["where_clause"], $searchReturn["select_columns"], "Event", $searchReturn["group_by"]);
	if (!$search_lock) {
		$events = $pageObj->retrievePage();
	} else {
		$events = false;
	}

	$paging_url = EVENT_DEFAULT_URL."/results.php";

	$aux_module_per_page			= "event";
	$aux_module_items				= $events; 
	$aux_module_itemRSSSection		= 'event';
	
	$aux_CategoryObj				= "EventCategory";
	$aux_CategoryModuleURL			= EVENT_DEFAULT_URL;
	$aux_CategoryNumColumn			= 3;
	$aux_CategoryActiveField		= 'active_event';
	
	$array_search_params = array();
	$_GET["advsearch"] = false;

	if (MODREWRITE_FEATURE == "on" && $_GET["url_full"]){
		if ($browsebycategory){
			$paging_url = EVENT_DEFAULT_URL."/guide";
			if ($_GET["url_full"]){
				$aux = str_replace(EDIRECTORY_FOLDER.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/".EVENT_FEATURE_FOLDER."/guide/", "", $_GET["url_full"]);
			}
		} else if ($browsebylocation){
			$paging_url = EVENT_DEFAULT_URL."/location";
			if ($_GET["url_full"]){
				$aux = str_replace(EDIRECTORY_FOLDER.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/".EVENT_FEATURE_FOLDER."/location/", "", $_GET["url_full"]);
			}
		} else {
			$paging_url = EVENT_DEFAULT_URL."/search";
			if ($_GET["url_full"]){
				$aux = str_replace(EDIRECTORY_FOLDER.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/".EVENT_FEATURE_FOLDER."/search/", "", $_GET["url_full"]);
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
		$paging_url = EVENT_DEFAULT_URL."/results.php";

		foreach ($_GET as $name => $value){
			if ($name != "screen" && $name != "letter" && $name != "url_full"){
				if ( $name == "keyword" || $name == "where" ) $array_search_params[] = $name."=".urlencode($value);
				else $array_search_params[] = $name."=".$value;
			}
		}
		
		$url_search_params = implode("&amp;", $array_search_params);
	}

	unset($letters_menu);
	$letters_menu		= system_prepareLetterToPagination($pageObj, $searchReturn, $paging_url, $url_search_params, $letter, "title", false, false, false, EVENT_SCALABILITY_OPTIMIZATION);
	$array_pages_code	= system_preparePagination($paging_url, $url_search_params, $pageObj, $letter, (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? $page  : $screen), $aux_items_per_page, (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? false : true));
	$totaleventsfound = $array_pages_code["total"];		
	$user = true;
} //End if ($countevent === false) {	


///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

if (!isset($countarticle) && true) {
	$tmpzip = $_GET["zip"]; $_GET["zip"] = "";	
	$tmpdist = $_GET["dist"]; $_GET["dist"] = "";
	
	$search_lock = false;
	if (ARTICLE_SCALABILITY_OPTIMIZATION == "on") {
		if (!$_GET["keyword"] && !$_GET["category_id"] && !$_GET["id"]) {
			$_GET["id"] = 0;
			$search_lock = false;
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

	$aux_module_per_page			= "article";
	$aux_module_items				= $articles; 
	$aux_module_itemRSSSection		= 'article';
	
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
	$totalarticlesfound = $array_pages_code["total"];		
	$user = true;
	$_GET["zip"] = $tmpzip;	
	$_GET["dist"] = $tmpdist;	
} //End if ($countarticle === false) {	
?>