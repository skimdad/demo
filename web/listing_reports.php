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
	# * FILE: /listing_reports.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$listingObj = new Listing($_GET["id"]);
	$url = $listingObj->getString('url');
	if ($_GET["report"] == "website") {
		$report_type = LISTING_REPORT_CLICK_THRU;
		if ((string_strpos($url, "http://") === false) && (string_strpos($url, "https://") === false)) $url = "http://".$url;
	}
	report_newRecord("listing", $_GET["id"], $report_type);
	$url = html_entity_decode($url);
	header ("Location: $url");
	exit;

?>