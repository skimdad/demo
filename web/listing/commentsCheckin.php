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
	# * FILE: /listing/commentsCheckin.php
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
	include(LISTING_EDIRECTORY_ROOT."/mod_rewrite.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$item_type = "listing";
	$item_id   = $_GET['item_id'];
	if (!$item_id && $_GET['id']) $item_id = $_GET['id'];

	include(INCLUDES_DIR."/code/checkin.php");
	$listingObj = $itemObj;

	if ( $listingObj->getString('status') != 'A' ) exit;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------  
	// Page Browsing /////////////////////////////////////////
	if ($item_id) $sql_where[] = " item_id = $item_id ";
	if (true)        $sql_where[] = " quick_tip IS NOT NULL AND quick_tip != '' ";
	if ($sql_where)  $sqlwhere .= " ".implode(" AND ", $sql_where)." ";
	
	$aux_items_per_page = ($_COOKIE["checkin_results_per_page"] ? $_COOKIE["checkin_results_per_page"] : 10);

	$pageObj  = new pageBrowsing("CheckIn", (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? $page : $screen), $aux_items_per_page, "added DESC", "", "", $sqlwhere);
	$checkinsArr = $pageObj->retrievePage("object");

	$paging_url = LISTING_DEFAULT_URL."/commentsCheckin.php";

	$aux_module_per_page			= "checkin";
	$aux_module_items				= $checkinsArr; 

	$array_search_params = array();
	if (MODREWRITE_FEATURE == "on" && $_GET["url_full"]){
		$paging_url = LISTING_DEFAULT_URL."/checkins";
		if ($_GET["url_full"]){
			$aux = str_replace(EDIRECTORY_FOLDER.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/".LISTING_FEATURE_FOLDER."/checkins/", "", $_GET["url_full"]);
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
		$paging_url = LISTING_DEFAULT_URL."/commentsCheckin.php";
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
	$headertag_title = system_showText(LANG_CHECKINSOF)." ".(($listingObj->getString("seo_title"))?($listingObj->getString("seo_title")):($listingObj->getString("title")));
	$headertag_description = (($listingObj->getStringLang(EDIR_LANGUAGE, "seo_description"))?($listingObj->getStringLang(EDIR_LANGUAGE, "seo_description")):($listingObj->getStringLang(EDIR_LANGUAGE, "description")));
	$headertag_keywords = (($listingObj->getStringLang(EDIR_LANGUAGE, "seo_keywords"))?($listingObj->getStringLang(EDIR_LANGUAGE, "seo_keywords")):(str_replace(" || ", ", ", $listingObj->getStringLang(EDIR_LANGUAGE, "keywords"))));
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
