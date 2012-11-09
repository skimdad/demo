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
	# * FILE: /deal/comments.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

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
	include(PROMOTION_EDIRECTORY_ROOT."/mod_rewrite.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	setting_get('commenting_edir', $commenting_edir);
	setting_get("review_promotion_enabled", $review_enabled);
	if ($review_enabled != "on" || !$commenting_edir) {
		$error_message = system_showText(LANG_REVIEWDISABLE);
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$item_type = "promotion";
	$item_id   = $_GET['item_id'];
	if (!$item_id && $_GET['id']) $item_id = $_GET['id'];

	include(INCLUDES_DIR."/code/review.php");
	$promotionObj = $itemObj;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	// Page Browsing /////////////////////////////////////////
	if ($item_id) 	 $sql_where[] = " item_type = 'promotion' AND item_id = $item_id ";
	if (true)        $sql_where[] = " review IS NOT NULL AND review != '' ";
	if (true)        $sql_where[] = " approved = '1' ";
	if ($sql_where)  $sqlwhere .= " ".implode(" AND ", $sql_where)." ";

	$aux_items_per_page = ($_COOKIE["dealreviews_results_per_page"] ? $_COOKIE["dealreviews_results_per_page"] : 10);

	$pageObj  = new pageBrowsing("Review", (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? $page : $screen), $aux_items_per_page, "added DESC", "", "", $sqlwhere);
	$reviewsArr = $pageObj->retrievePage("object");

	$paging_url = PROMOTION_DEFAULT_URL."/comments.php";

	$aux_module_per_page			= "dealreviews";
	$aux_module_items				= $reviewsArr; 

	$array_search_params = array();
	if (MODREWRITE_FEATURE == "on" && $_GET["url_full"]){
		$paging_url = PROMOTION_DEFAULT_URL."/reviews";
		if ($_GET["url_full"]){
			$aux = str_replace(EDIRECTORY_FOLDER.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/".PROMOTION_FEATURE_FOLDER."/reviews/", "", $_GET["url_full"]);
		}

		$parts = explode("/", $aux);

		for($i=0; $i < count($parts); $i++ ){
			if ($parts[$i]){
				if ($parts[$i] != "page"){
					$array_search_params[] = "/".urlencode($parts[$i]);
				} else {
					if ($parts[$i] != "page"){
						$array_search_params[] = "/".$parts[$i]."/".$parts[$i+1];
						$i++;
					} else {
						$i++;
					}
				}
			}
		}

		$url_search_params = implode("/", $array_search_params);

	} else {
		$paging_url = PROMOTION_DEFAULT_URL."/comments.php";
	foreach ($_GET as $name => $value){
		if ($name != "screen"){
			$array_search_params[] = $name."=".$value;
		}
	}
	$url_search_params = implode("&amp;", $array_search_params);
	}
	$showLetter = false;
	
	$array_pages_code	= system_preparePagination($paging_url, $url_search_params, $pageObj, $letter, (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? $page  : $screen), $aux_items_per_page, (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? false : true));

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$banner_section = "listing";
	$headertag_title = system_showText(LANG_REVIEWSOF)." ".(($promotionObj->getString("seo_name"))?($promotionObj->getString("seo_name")):($promotionObj->getString("name")));
	$headertag_description = (($promotionObj->getStringLang(EDIR_LANGUAGE, "seo_description"))?($promotionObj->getStringLang(EDIR_LANGUAGE, "seo_description")):($promotionObj->getStringLang(EDIR_LANGUAGE, "description")));
	$headertag_keywords = (($promotionObj->getStringLang(EDIR_LANGUAGE, "seo_keywords"))?($promotionObj->getStringLang(EDIR_LANGUAGE, "seo_keywords")):(str_replace(" || ", ", ", $promotionObj->getStringLang(EDIR_LANGUAGE, "keywords"))));
	include(system_getFrontendPath("header.php", "layout"));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# BODY
	# ----------------------------------------------------------------------------------------------------
	include(THEMEFILE_DIR."/".EDIR_THEME."/body/general.php");
	
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$banner_section = "listing";
	include(system_getFrontendPath("footer.php", "layout"));

?>
