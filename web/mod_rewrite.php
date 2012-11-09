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
	# * FILE: /mod_rewrite.php
	# ----------------------------------------------------------------------------------------------------

    $failure = false;
	if ($_GET["url_full"])
		$_GET["url_full"] = urldecode(str_replace(EDIRECTORY_FOLDER.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/results.php?url_full=","",$_SERVER["REQUEST_URI"]));

		if ($_GET["url_full"] && (string_strpos($_GET["url_full"], "search") !== false)) {
		$url = string_replace_once(EDIRECTORY_FOLDER.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/search", "", $_GET["url_full"]);
		$parts = explode("/", $url);

		if (!$parts[1] && !$parts[3]) {
			header("Location: ".PROMOTION_DEFAULT_URL."/search/empty/where/empty");
			exit;
		}

		if ($parts[1] != "empty"){
			$_GET["keyword"] = $parts[1];
			$_GET["keyword"] = str_replace("|2F","/", $_GET["keyword"]);
			$_GET["keyword"] = str_replace("|3F","\\", $_GET["keyword"]);
		} else {
			$_GET["keyword"] = "";
		}

		if ($parts[3] != "empty"){
			$_GET["where"] = $parts[3];
			$_GET["where"] = str_replace("|2F","/", $_GET["where"]);
			$_GET["where"] = str_replace("|3F","\\", $_GET["where"]);
		} else {
			$_GET["where"] = "";
		}

		for ($i==1; $i<count($parts); $i++){
			switch($parts[$i]) {
				case 'page': $_GET["page"] = $parts[$i+1];
								break;
				case 'letter': $_GET["letter"] = $parts[$i+1];
								break;
				case 'orderby': $_GET["orderby"] = $parts[$i+1];
								break;
			}
		}
	}
?>