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
	# * FILE: /deal/detail.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	session_start();

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

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
	# REVIEWS
	# ----------------------------------------------------------------------------------------------------
	if ($id)  $sql_where[] = " item_type = 'promotion' AND item_id = ".db_formatNumber($id)." ";
	if (true) $sql_where[] = " review IS NOT NULL AND review != '' ";
	if (true) $sql_where[] = " approved = '1' ";
	if ($sql_where) $sqlwhere .= " ".implode(" AND ", $sql_where)." ";
	$pageObj  = new pageBrowsing("Review", $screen, 3, "added DESC", "", "", $sqlwhere);
	$reviewsArr = $pageObj->retrievePage("object");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------

	$banner_section = "listing";
	$promotion = new Promotion($id);
	$listingObj = new Listing();
	$listings = $listingObj->retrieveListingsbyPromotion_id($id);

	$hasDealDetail = false;
	if ((validate_date_deal($promotion->getDate("start_date"), $promotion->getDate("end_date"))) && (validate_period_deal($promotion->getNumber("visibility_start"),$promotion->getNumber("visibility_end")))){
		$hasDealDetail = true;
	}

	if (!$listings) {
		header("Location: ".PROMOTION_DEFAULT_URL."/index.php");
		exit;
	}

	if (!$hasDealDetail) {
		header("Location: ".PROMOTION_DEFAULT_URL."/index.php");
		exit;
	}
	
	$promoLevelListing = new ListingLevel();
	if ( $promoLevelListing->getHasPromotion($listings[0]->getNumber("level")) == 'y' ) $hasPromotion = true;

    if ( PROMOTION_FEATURE != 'on' || CUSTOM_PROMOTION_FEATURE != 'on') exit;
    elseif ( !$hasPromotion ) exit;

	$langindex = language_getIndex(EDIR_LANGUAGE);
	$headertag_title = $promotion->getString('name');
	$headertag_description = $promotion->getString('description'.$langindex);
	$headertag_keywords = $promotion->getString('keywords');
	include(system_getFrontendPath("header.php", "layout"));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# BODY
	# ----------------------------------------------------------------------------------------------------
	include(THEMEFILE_DIR."/".EDIR_THEME."/body/promotion_detail.php");
	
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$banner_section = "listing";
	include(system_getFrontendPath("footer.php", "layout"));

?>