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
	# * FILE: /includes/code/faq.php
	# ----------------------------------------------------------------------------------------------------

	##########################################################################################################################
	# RESULTS
	##########################################################################################################################
	$where = "";
	$where .= " (question LIKE ".db_formatString("%".$keyword."%")." OR answer LIKE ".db_formatString("%".$keyword."%").") ";
	if ((string_strpos($_SERVER["PHP_SELF"], "members"))) {
			$paging_url = DEFAULT_URL."/members/faq.php";
			$where .= " AND member='y' ";
			$faq_front = false;
	} else {
		if ((string_strpos($_SERVER["PHP_SELF"], "sitemgr"))){
				$paging_url = DEFAULT_URL."/sitemgr/faq/faq.php";
				$where .= " AND sitemgr='y' ";
				$faq_front = false;
		} else {
				$paging_url = DEFAULT_URL."/faq.php";
				$where .= " AND frontend='y' ";
				$faq_front = true;
		}
	}

	#############################################################################################################################
	#Page Browsing
	#############################################################################################################################
	$pageObj = new pageBrowsing("FAQ", $screen, 50, false, false, false, $where, "*", false, false, true);
	$faqs = $pageObj->retrievePage("array");
	$array_search_params = array();
	foreach ($_GET as $name => $value) {
		if ($name != "screen" && $name != "letter"){
			$array_search_params[] = $name."=".$value;
		}
	}
	$url_search_params = implode("&amp;", $array_search_params);
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_PAGING_GOTOPAGE)." ", "this.form.submit();");

?>
