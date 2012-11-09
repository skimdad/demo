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
	# * FILE: /blog/searchresults.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
	
	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$user = true;
	$show_results = true;
	
	$langIndex = language_getIndex(EDIR_LANGUAGE);
	
	$str_search = "";
	
	if ($keyword){
		$str_search .= " ".system_showText(LANG_SEARCHRESULTS_KEYWORD)." <strong>".$keyword."</strong>";
	}
	
	if ($where){
		$str_search .= " ".system_showText(LANG_SEARCHRESULTS_WHERE)." <strong>".$where."</strong>";
	}
	
	if ($category_id) {
		$search_category = new BlogCategory($category_id);
	
		if ($search_category->getString("title".$langIndex)) {
			$str_search .= " ".system_showText(LANG_SEARCHRESULTS_INTAG)." <strong title = \"".($search_category->getString("title".$langIndex))."\">".$search_category->getString("title".$langIndex, true, 55)."</strong>";
		}
	}
?>