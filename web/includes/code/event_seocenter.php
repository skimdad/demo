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
	# * FILE: /includes/code/event_seocenter.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	$language_numbers = explode(",", EDIR_LANGUAGENUMBERS);

	if ($id) {
		$event = new Event($id);
		if (!($event->getNumber("id")) || ($event->getNumber("id") <= 0)) {
			header("Location: ".DEFAULT_URL."/members/".EVENT_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/members/".EVENT_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		$_POST["friendly_url"] = str_replace(".htm", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = str_replace(".html", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = trim($_POST["friendly_url"]);
        
        foreach ($language_numbers as $i) {
			$labelsuffix = $i;
            if ($_POST["seo_description".$labelsuffix]) {
                $_POST["seo_description".$labelsuffix] = str_replace(array("\r\n", "\n"), " ", $_POST["seo_description".$labelsuffix]);
                $_POST["seo_description".$labelsuffix] = str_replace("\"", "", $_POST["seo_description".$labelsuffix]);
                $_POST["seo_keywords".$labelsuffix] = str_replace("\"", "", $_POST["seo_keywords".$labelsuffix]);
            }
        }

		if (validate_form("eventseocenter", $_POST, $message)) {
			foreach ($_POST as $key=>$value) {
				if ((string_strpos($key, "seo") !== false) || (string_strpos($key, "friendly_url") !== false)) {
					$event->setString($key, $value);
				}
			}
			$event->Save();
			//$message = system_showText(LANG_MSG_SEOCENTER_ITEMUPDATED);
            $message = 3;
			header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : ""));
			exit;
		}

		$_POST = format_magicQuotes($_POST);
		$_GET  = format_magicQuotes($_GET);
		extract($_POST);
		extract($_GET);

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$event->extract();
	extract($_POST);
	extract($_GET);

?>
