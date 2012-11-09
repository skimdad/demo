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
	# * FILE: /settheme.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");
	$_GET = format_magicQuotes($_GET);
	$_POST = format_magicQuotes($_POST);
	$_COOKIE = format_magicQuotes($_COOKIE);
    
	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    
	$expire = 60*60*24*30*12;
    if ($_COOKIE["edir_theme"]) {
		setcookie("edir_theme", $_COOKIE["edir_theme"], time() + $expire, EDIRECTORY_FOLDER);
	}
	if ($_COOKIE["edir_scheme"]) {
		setcookie("edir_scheme", $_COOKIE["edir_scheme"], time() + $expire, EDIRECTORY_FOLDER);
	}
	if ($_GET["theme"]) {
		setcookie("edir_scheme", $_GET["theme"], time() + $expire, EDIRECTORY_FOLDER);
		setcookie("edir_theme", $_GET["theme"], time() + $expire, EDIRECTORY_FOLDER);
	} else {
		setcookie("edir_theme", "", time() - $expire, EDIRECTORY_FOLDER);
	}
	if ($_COOKIE["showMap"]) {
		setcookie("showMap", "0", time() + $expire, "/");
	}

	$destiny = $_GET["destiny"] ? $_GET["destiny"] : $_POST["destiny"];
	$destiny = urldecode($destiny);
	if ($destiny) {
		$destiny = system_denyInjections($destiny);
		if (string_strpos($destiny, "://") !== false) {
			if (string_strpos($destiny, $_SERVER["HTTP_HOST"]) === false) {
				$destiny = "";
			}
		}
	}
	if ($_SERVER["QUERY_STRING"]) {
		if (string_strpos($_SERVER["QUERY_STRING"], "query=") !== false) {
			$query = string_substr($_SERVER["QUERY_STRING"], string_strpos($_SERVER["QUERY_STRING"], "query=")+6);
		} else {
			$query = $_GET["query"] ? $_GET["query"] : $_POST["query"];
			$query = urldecode($query);
		}
	} else {
		$query = $_GET["query"] ? $_GET["query"] : $_POST["query"];
		$query = urldecode($query);
	}
	if ($query) {
		$query = system_denyInjections($query);
	}

	if (string_strpos($_GET["query"], "url_full=") !== false){
		$url = str_replace("url_full=", "", $_GET["query"]);
	} else if ($destiny) {
		$url = $destiny;
		if ($query) $url .= "?".$query;
	} else {
		$url = DEFAULT_URL;
	}
	
	if (CACHE_FULL_FEATURE == "on"){
		cachefull_forceExpiration();
	}

	header("Location: ".$url);
	exit;

?>
