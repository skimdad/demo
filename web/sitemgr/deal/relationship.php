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
	# * FILE: /sitemgr/deal/relationship.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	$promoLevelListing = new ListingLevel();
	$levels_all = $promoLevelListing->getLevelValues();
	foreach ($levels_all as $level_each) {
		if ( $promoLevelListing->getHasPromotion($level_each) == 'y' ) $hasPromotion = true;
	}
	if ( PROMOTION_FEATURE != 'on' || CUSTOM_PROMOTION_FEATURE != 'on' ) exit;
	elseif ( !$hasPromotion ) exit;
	
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/sitemgr/".PROMOTION_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	extract($_GET);
	extract($_POST);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$promotion = new Promotion($id);
        $promotion->cleanup();
        
		header("Location: ".DEFAULT_URL."/sitemgr/".PROMOTION_FEATURE_FOLDER."/view.php?id=".$promotion->getNumber("id")."&screen=".$screen."&letter=".$letter.(($url_search_params) ? "&$url_search_params" : ""));
		exit;
	} else {
		header("Location: ".DEFAULT_URL."/sitemgr/".PROMOTION_FEATURE_FOLDER."/".(($search_page) ? "search.php" : "index.php")."?screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

?>
