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
	# * FILE: /sitemapurl.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	if ((MODREWRITE_FEATURE != "on") || (SITEMAP_FEATURE != "on")) { exit; }
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$_GET = format_magicQuotes($_GET);
	$_POST = format_magicQuotes($_POST);
	$file = $_GET["file"] ? $_GET["file"] : $_POST["file"];
	$file = urldecode($file);
	if ($file) {
		$file = system_denyInjections($file);
		if (string_strpos($file, "://") !== false) {
			if (string_strpos($file, $_SERVER["HTTP_HOST"]) === false) {
				$file = "";
			}
		}
	}
	if ($file) {
		if (file_exists(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/sitemap/".$file)) {
			$handle = fopen(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/sitemap/".$file, "r");
			if ($handle) {
				while (!feof($handle)) {
					$buffer = fgets($handle);
					echo $buffer;
				}
				fclose($handle);
			}
		}
	}

?>
