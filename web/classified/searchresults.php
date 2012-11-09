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
	# * FILE: /classified/results.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	if (sess_validateSessionItens("classified", "see_results")) {
		
		$show_results = true;
		
		$mapObj = new GoogleSettings(GOOGLE_MAPS_STATUS);
		$levelObj = new ClassifiedLevel(EDIR_DEFAULT_LANGUAGE, true);
		
		$user = true;
		$langIndex = language_getIndex(EDIR_LANGUAGE);
		$str_search = "";
		
		$user = true;
		$langIndex = language_getIndex(EDIR_LANGUAGE);
		$str_search = "";
		if ($keyword) $str_search .= " ".system_showText(LANG_SEARCHRESULTS_KEYWORD)." ".$keyword."";
		if ($where) $str_search .= " ".system_showText(LANG_SEARCHRESULTS_WHERE)." ".$where."";
		if ($category_id) {
			$search_category = new ClassifiedCategory($category_id);
			if ($search_category->getString("title".$langIndex)) {
				$str_search .= " ".system_showText(LANG_SEARCHRESULTS_INCATEGORY)." <strong title = \"".($search_category->getString("title".$langIndex))."\">".$search_category->getString("title".$langIndex, true, 60)."";
			}
		}
		if ($zip) {
			$str_search .= " ".system_showText(LANG_SEARCHRESULTS_ZIP)." ".ZIPCODE_LABEL." ".$zip.(($dist)?(" (".$dist." ".ZIPCODE_UNIT_LABEL_PLURAL.")"):(""))."";
		}
	} else {
		$hideResults = true;
	}
?>