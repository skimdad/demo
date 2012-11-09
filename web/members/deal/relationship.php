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
	# * FILE: /members/deal/relationship.php
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
            if ( $promoLevelListing->getHasPromotion($level_each) == 'y' ){
                $hasPromotion = true;
            }
	}
	if ( PROMOTION_FEATURE != 'on' || CUSTOM_PROMOTION_FEATURE != "on" || !$hasPromotion){
        exit;
    }
	
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	
	if (!system_enableDealForUser(sess_getAccountIdFromSession())){
            exit; 	
	}

	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
        $promotion = new Promotion($id);
        if (sess_getAccountIdFromSession() != $promotion->getNumber("account_id")) {
            header("Location: ".DEFAULT_URL."/members/".PROMOTION_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
            exit;
        }

        $promotion->cleanup();

        header("Location: ".DEFAULT_URL."/members/".PROMOTION_FEATURE_FOLDER."/view.php?id=".$promotion->getNumber("id")."&screen=$screen&letter=$letter");
        exit;
	} else {
        header("Location: ".DEFAULT_URL."/members/".PROMOTION_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
        exit;
	}

?>
