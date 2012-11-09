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
	# * FILE: /frontend/general.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	
	$generalPageItemPath = "";
	if (string_strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", LISTING_DEFAULT_URL)) !== false) {
		$generalPageItemPath = str_replace(NON_SECURE_URL, "", LISTING_DEFAULT_URL)."/";
	} elseif (string_strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", PROMOTION_DEFAULT_URL)) !== false) {
		$generalPageItemPath = str_replace(NON_SECURE_URL, "", PROMOTION_DEFAULT_URL)."/";
	} elseif (string_strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", EVENT_DEFAULT_URL)) !== false) {
		$generalPageItemPath = str_replace(NON_SECURE_URL, "", EVENT_DEFAULT_URL)."/";
	} elseif (string_strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", CLASSIFIED_DEFAULT_URL)) !== false) {
		$generalPageItemPath = str_replace(NON_SECURE_URL, "", CLASSIFIED_DEFAULT_URL)."/";
	} elseif (string_strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", ARTICLE_DEFAULT_URL)) !== false) {
		$generalPageItemPath = str_replace(NON_SECURE_URL, "", ARTICLE_DEFAULT_URL)."/";
	} elseif (string_strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", BLOG_DEFAULT_URL)) !== false) {
		$generalPageItemPath = str_replace(NON_SECURE_URL, "", BLOG_DEFAULT_URL)."/";
	}	

	$page = $_SERVER["PHP_SELF"];
	$page = string_substr($page, string_strrpos($page, "/")+1);
	$page = string_substr($page, 0, string_strrpos($page, "."));

	include(EDIRECTORY_ROOT."/".$generalPageItemPath.$page."content.php");

