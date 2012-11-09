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
	# * FILE: /listing/backlink_return.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	extract($_GET);
    
    if ($friendly_url){
        $listingObj = db_getFromDB("listing", "friendly_url", db_formatString($friendly_url));
        $id = $listingObj->getNumber("id");

        if ($listingObj->getString("backlink") == "y" && $listingObj->getString("backlink_url")){
            $redirecLink = LISTING_DEFAULT_URL."/results.php?id=".$id;
            header("Location: ".$redirecLink);
            exit;
        } else {
            header("Location: ".LISTING_DEFAULT_URL);
            exit;
        }
    } else {
        header("Location: ".LISTING_DEFAULT_URL);
		exit;
    }
?>