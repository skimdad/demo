<?php

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
	# * FILE: /includes/code/twitter.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($_POST["twitter_account"]) {
		$_POST["twitter_account"] = trim($_POST["twitter_account"]);
		$_POST["twitter_account"] = preg_replace('/\s\s+/', ' ', $_POST["twitter_account"]);
	}
	extract($_GET);
	extract($_POST);
	
	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
		
		$message_style = "successMessage";
		
		if (($foreignaccount_twitter_apikey && $foreignaccount_twitter_apisecret) || (!$foreignaccount_twitter_apikey && !$foreignaccount_twitter_apisecret)) {
			if (!setting_set("foreignaccount_twitter_apikey", $foreignaccount_twitter_apikey))
				if (!setting_new("foreignaccount_twitter_apikey", $foreignaccount_twitter_apikey))
					$error = true;

			if (!setting_set("foreignaccount_twitter_apisecret", $foreignaccount_twitter_apisecret))
				if (!setting_new("foreignaccount_twitter_apisecret", $foreignaccount_twitter_apisecret))
					$error = true;
		} else {
			$error = false;

			if ($foreignaccount_twitter_apikey && $foreignaccount_twitter_apisecret) {

				if (!setting_set("foreignaccount_twitter_apikey", $foreignaccount_twitter_apikey))
					if (!setting_new("foreignaccount_twitter_apikey", $foreignaccount_twitter_apikey))
						$error = true;

				if (!setting_set("foreignaccount_twitter_apisecret", $foreignaccount_twitter_apisecret))
					if (!setting_new("foreignaccount_twitter_apisecret", $foreignaccount_twitter_apisecret))
						$error = true;
			} else if (!$foreignaccount_twitter_apikey || !$foreignaccount_twitter_apisecret) {
				$error = true;
			}
		}

		if (($foreignaccount_twitter_mobile_apikey && $foreignaccount_twitter_mobile_apisecret) || (!$foreignaccount_twitter_mobile_apikey && !$foreignaccount_twitter_mobile_apisecret)) {
			if (!setting_set("foreignaccount_twitter_mobile_apikey", $foreignaccount_twitter_mobile_apikey))
				if (!setting_new("foreignaccount_twitter_mobile_apikey", $foreignaccount_twitter_mobile_apikey))
					$error = true;

			if (!setting_set("foreignaccount_twitter_mobile_apisecret", $foreignaccount_twitter_mobile_apisecret))
				if (!setting_new("foreignaccount_twitter_mobile_apisecret", $foreignaccount_twitter_mobile_apisecret))
					$error = true;
		} else {
			$error = false;

			if ($foreignaccount_twitter_mobile_apikey && $foreignaccount_twitter_mobile_apisecret) {

				if (!setting_set("foreignaccount_twitter_mobile_apikey", $foreignaccount_twitter_mobile_apikey))
					if (!setting_new("foreignaccount_twitter_mobile_apikey", $foreignaccount_twitter_mobile_apikey))
						$error = true;

				if (!setting_set("foreignaccount_twitter_mobile_apisecret", $foreignaccount_twitter_mobile_apisecret))
					if (!setting_new("foreignaccount_twitter_mobile_apisecret", $foreignaccount_twitter_mobile_apisecret))
						$error = true;
			} else if (!$foreignaccount_twitter_mobile_apikey || !$foreignaccount_twitter_mobile_apisecret) {
				$error = true;
			}
		}
		
		if(!setting_set("twitter_account", $twitter_account)) {
			if(!setting_new("twitter_account", $twitter_account)) {
				$error = true;
			}
		}

		if (!$error) {
			$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_TWITTER_SETTINGSSUCCESSCHANGED);
		} else {
            $actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_EMPTYKEYS);
			$message_style = "errorMessage";
		}
		if ($actions) {
			$message_twitterAPI .= implode("<br />", $actions);
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
    setting_get("foreignaccount_twitter_apikey", $foreignaccount_twitter_apikey);
    setting_get("foreignaccount_twitter_apisecret", $foreignaccount_twitter_apisecret);
    setting_get("foreignaccount_twitter_mobile_apikey", $foreignaccount_twitter_mobile_apikey);
    setting_get("foreignaccount_twitter_mobile_apisecret", $foreignaccount_twitter_mobile_apisecret);
    setting_get("twitter_account", $twitter_account);
?>