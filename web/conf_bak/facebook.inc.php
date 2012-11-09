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
	# * FILE: /conf/facebook.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# FACEBOOK API
	# ----------------------------------------------------------------------------------------------------
	/*
	 * GETTING THE FACEBOOK INFORMATION FROM DATABASE
	 */
	setting_get("foreignaccount_facebook",				$foreignaccount_facebook);
	setting_get("foreignaccount_facebook_apiid",		$foreignaccount_facebook_apiid);
	setting_get("foreignaccount_facebook_apisecret",	$foreignaccount_facebook_apisecret);
    setting_get("commenting_fb_user_id",                $fb_user_id);

	if ($foreignaccount_facebook && $foreignaccount_facebook_apiid && $foreignaccount_facebook_apisecret) {
		define("FACEBOOK_APP_ENABLED",  $foreignaccount_facebook);
	} else {
		define("FACEBOOK_APP_ENABLED",  "off");
	}

	/*
	 * JUST FOR "demodirectory.com"
	 */
	if (DEMO_LIVE_MODE) {
		if (string_strpos($_SERVER["HTTP_HOST"], "demodirectory.com") !== false) {
			define("FACEBOOK_APP_DEMO",     "true");
			define("FACEBOOK_API_ID",       "132709406766649");
			define("FACEBOOK_USER_ID",      "100001341193740");
			define("FACEBOOK_API_SECRET",   "26111bd5bdb643007a390d57c48bb553");
		} else {
			define("FACEBOOK_APP_DEMO",     "false");
		}
	} else {
		define("FACEBOOK_APP_DEMO",         "false");
	}

	/*
	 * FOR DEV AND LIVE
	 */
	if (FACEBOOK_APP_DEMO != "true") {
		define("FACEBOOK_API_ID",       $foreignaccount_facebook_apiid);
		define("FACEBOOK_USER_ID",      $fb_user_id);
		define("FACEBOOK_API_SECRET",   $foreignaccount_facebook_apisecret);
	}

	Facebook::getFBInstance($facebook);

	/*
	 * GETTING LOGIN AND LOGOUT INFORMATION
	 */
	define("FACEBOOK_REDIRECT_URI",     DEFAULT_URL."/".MEMBERS_ALIAS."/facebookauth.php");
	define("FACEBOOK_PERMISSION_SCOPE", "email,user_birthday,status_update,publish_stream");

	unset(
		$foreignaccount_facebook, 
		$foreignaccount_facebook_apiid, 
		$foreignaccount_facebook_apisecret
	);
?>