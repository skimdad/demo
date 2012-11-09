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
	# * FILE: includes/code/statisticreport.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # unset
    # ----------------------------------------------------------------------------------------------------
    unset($module);
    unset($keyword);
    unset($category_id);
    unset($location_1);
	unset($location_2);
	unset($location_3);
	unset($location_4);
	unset($location_5);
    unset($where);

    # ----------------------------------------------------------------------------------------------------
    # statistic
    # ----------------------------------------------------------------------------------------------------
    $module         = ($banner_section)         ? string_substr($banner_section, 0, 1)    : "h";
    $keyword        = ($_GET["keyword"])        ? trim($_GET["keyword"])		   : "";
    $category_id    = ($_GET["category_id"])    ? $_GET["category_id"]			   : "";
    $location_1     = ($_GET["location_1"])     ? $_GET["location_1"]			   : "";
    $location_2     = ($_GET["location_2"])     ? $_GET["location_2"]			   : "";
    $location_3     = ($_GET["location_3"])     ? $_GET["location_3"]			   : "";
    $location_4     = ($_GET["location_4"])     ? $_GET["location_4"]			   : "";
    $location_5     = ($_GET["location_5"])     ? $_GET["location_5"]			   : "";
    $where          = ($_GET["where"])          ? trim(string_ucwords($_GET["where"]))    : "";
    # ----------------------------------------------------------------------------------------------------
    # validate
    # ----------------------------------------------------------------------------------------------------
    $save = false;
    if(!$save) $save = (string_strlen($keyword)      > 0);
    if(!$save) $save = (string_strlen($category_id)  > 0);
    if(!$save) $save = (string_strlen($location_1)   > 0);
    if(!$save) $save = (string_strlen($location_2)   > 0);
    if(!$save) $save = (string_strlen($location_3)   > 0);
    if(!$save) $save = (string_strlen($location_4)   > 0);
    if(!$save) $save = (string_strlen($location_5)   > 0);
    if(!$save) $save = (string_strlen($where)        > 0);

    # ----------------------------------------------------------------------------------------------------
    # insert
    # ----------------------------------------------------------------------------------------------------
	$sql = "";
    if($save) {
        $sql = "INSERT INTO Report_Statistic VALUES (NOW(), ".db_formatString($module).", ".db_formatString($keyword).", ".db_formatNumber($category_id).", ".db_formatNumber($location_1).", ".db_formatNumber($location_2).", ".db_formatNumber($location_3).", ".db_formatNumber($location_4).", ".db_formatNumber($location_5).", ".db_formatString($where).")";
		$db = db_getDBObject();
		$db->query($sql);
//		$db->close();
		unset($db);
    }
?>