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
	# * FILE: /mobile/searchstatistics.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (MOBILE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	echo "<p class=\"searchResults\">";
	echo "".(($item_total_amount==1) ? (system_showText(LANG_PAGING_FOUND)) : (system_showText(LANG_PAGING_FOUND_PLURAL)))." <span class=\"bold\">".$item_total_amount."</span> ".(($item_total_amount==1) ? (system_showText(LANG_PAGING_RECORD)) : (system_showText(LANG_PAGING_RECORD_PLURAL)))."";
	if ($item_total_amount > MAX_ITEM_PER_PAGE) {
		echo " | ".system_showText(LANG_PAGING_SHOWINGPAGE)." <span class=\"bold\">".$page."</span> ".system_showText(LANG_PAGING_PAGEOF)." <span class=\"bold\">".ceil($item_total_amount/MAX_ITEM_PER_PAGE)."</span> ".LANG_PAGING_PAGE_PLURAL."";
	}
	echo "</p>";

?>
