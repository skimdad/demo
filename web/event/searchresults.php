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
	# * FILE: /event/searchresults.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	if (sess_validateSessionItens("event", "see_results")) {
		
		$show_results = true;
		
		$mapObj = new GoogleSettings(GOOGLE_MAPS_STATUS);
	
		$user = true;
		$langIndex = language_getIndex(EDIR_LANGUAGE);
		$str_search = "";
		if ($_GET["this_date"]) {
			$ts_time = mktime(0,0,0,(int)string_substr($_GET["this_date"],4,2),(int)string_substr($_GET["this_date"],6,2),(int)string_substr($_GET["this_date"],0,4));
		} else {
			$ts_time = mktime("0,0,0,".date("m,d,Y"));
		}
		if (!$_GET["month"]){
			$str_search = system_showText(LANG_SEARCHRESULTS_DATE)." ".system_showDate(LANG_STRINGDATE_YEARANDMONTHANDDAY, $ts_time)."";
		}else{
			$str_search = system_showText(LANG_SEARCHRESULTS_DATE)." ".system_showDate(LANG_STRINGDATE_YEARANDMONTH, $ts_time)."";
		}
		if (!$_GET["month"] && !$_GET["this_date"]) {
			$str_search = "";
		}
		if ($keyword){
			$str_search .= " ".system_showText(LANG_SEARCHRESULTS_KEYWORD)." ".$keyword."";
		}
		if ($where){
			$str_search .= " ".system_showText(LANG_SEARCHRESULTS_WHERE)." ".$where."";
		}
		if ($category_id) {
			$search_category = new EventCategory($category_id);
			if ($search_category->getString("title".$langIndex)) {
				$str_search .= " ".system_showText(LANG_SEARCHRESULTS_INCATEGORY)." <strong title = \"".($search_category->getString("title".$langIndex))."\">".$search_category->getString("title".$langIndex, true, 55)."";
			}
		}
		if ($zip) {
			$str_search .= " ".system_showText(LANG_SEARCHRESULTS_ZIP)." ".ZIPCODE_LABEL." ".$zip.(($dist)?(" (".$dist." ".ZIPCODE_UNIT_LABEL_PLURAL.")"):(""))."";
		}
	} else {
		$hideResults = true;
	}
?>