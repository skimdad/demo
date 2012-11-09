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
	# * FILE: /coupon/results.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

    $rotateEach = 2;
    $impressionNumber = 0;

?>
	<? if (sess_validateSessionItens("promotion", "see_results")) {
		
		$show_results = true;

		$mapObj = new GoogleSettings(GOOGLE_MAPS_STATUS);

		$user = true;
		$langIndex = language_getIndex(EDIR_LANGUAGE);
		$str_search = "";
/* 		if ($keyword) $str_search .= " ".system_showText(LANG_SEARCHRESULTS_KEYWORD)." ".$keyword."";
		if ($where) $str_search .= " ".system_showText(LANG_SEARCHRESULTS_WHERE)." ".$where.""; */
		if ($keyword) $str_search .= "/ ".$keyword."";
		if ($where) $str_search .= " / ".$where."";
		if ($category_id) {
			$search_category = new ListingCategory($category_id);
			if ($search_category->getString("title".$langIndex)) {
				//$str_search .= " ".system_showText(LANG_SEARCHRESULTS_INCATEGORY)." < title = \"".($search_category->getString("title".$langIndex))."\">".$search_category->getString("title".$langIndex, true, 60)."";
				$str_search .= "/ ".$search_category->getString("title".$langIndex, true, 60)."";
			}
		}
		if ($zip) {
			if($_SESSION['s_city'] && $_SESSION['s_state'])
				$str_search .= " / ".ucwords(strtolower($_SESSION['s_city'].", ".$_SESSION['s_state']))." ".$zip.(($dist)?(" (".$dist." ".ZIPCODE_UNIT_LABEL_PLURAL.")"):(""))."";
			else	
			/* $str_search .= " ".system_showText(LANG_SEARCHRESULTS_ZIP)." ".ZIPCODE_LABEL." ".$zip.(($dist)?(" (".$dist." ".ZIPCODE_UNIT_LABEL_PLURAL.")"):("")).""; */
				$str_search .= " / ".ZIPCODE_LABEL." ".$zip.(($dist)?(" (".$dist." ".ZIPCODE_UNIT_LABEL_PLURAL.")"):(""))."";
		}
	} else {
		$hideResults = true;
	}

?>