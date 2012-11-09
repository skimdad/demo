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
	# * FILE: /sitemgr/autocomplete_discountcode.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	
	# ----------------------------------------------------------------------------------------------------
	# INPUT VERIFICATION
	# ----------------------------------------------------------------------------------------------------

	$limit = $_GET['limit'] ? db_formatNumber($_GET['limit']) : AUTOCOMPLETE_MAXITENS;
	$input    = string_strtolower(trim(utf8_decode($_GET['q'])));
	$whereStr = db_formatString($input.'%');
	
	# ----------------------------------------------------------------------------------------------------
	# AUTO COMPLETE
	# ----------------------------------------------------------------------------------------------------
	if($input){
	    $dbObj = db_getDBObject();
	    $db = db_getDBObject();
	    $query = "SELECT id FROM Discount_Code WHERE id LIKE ".$whereStr." LIMIT ".$limit;
	    $result = $db->query($query);
	    $aResults = array();
	    while ($row = mysql_fetch_assoc($result)) {
			array_push($aResults, $row['id']);
	    }
		echo implode("\n", $aResults);
	}    
        