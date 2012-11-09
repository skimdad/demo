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
	# * FILE: /conf/twilio.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# TWILIO API
	# ----------------------------------------------------------------------------------------------------
	/*
	 * GETTING THE TWILIO INFORMATION FROM DATABASE
	 */
	setting_get("twilio_enabled_call", $twilio_enabled_call);
	setting_get("twilio_enabled_sms", $twilio_enabled_sms);
	setting_get("twilio_account_sid", $twilio_account_sid);
	setting_get("twilio_auth_token", $twilio_auth_token);
	setting_get("twilio_number", $twilio_number);

	if (($twilio_enabled_sms || $twilio_enabled_call) && $twilio_account_sid && $twilio_auth_token && $twilio_number) {
		define("TWILIO_APP_ENABLED", "on");
		if ($twilio_enabled_sms){
			define("TWILIO_APP_ENABLED_SMS", "on");
		} else {
			define("TWILIO_APP_ENABLED_SMS", "off");
		}
		if ($twilio_enabled_call){
			define("TWILIO_APP_ENABLED_CALL", "on");
		} else {
			define("TWILIO_APP_ENABLED_CALL", "off");
		}
	} else {
		define("TWILIO_APP_ENABLED",        "off");
		define("TWILIO_APP_ENABLED_SMS",    "off");
		define("TWILIO_APP_ENABLED_CALL",   "off");
	}

	/*
	 * JUST FOR "demodirectory.com"
	 */
	if (DEMO_LIVE_MODE) {
		if (string_strpos($_SERVER["HTTP_HOST"], "demodirectory.com") !== false) {
			define("TWILIO_APP_DEMO",   "true");
			define("TWILIO_API_SID",    "AC399c366225f42a21d7cbb7817be656ea");
			define("TWILIO_API_AUTH",   "36cba28823835dea6089666e5f7ff4bd");
			define("TWILIO_API_NUMBER", "(703)996-3518");
		} else {
			define("TWILIO_APP_DEMO", "false");
		}
	} else {
		define("TWILIO_APP_DEMO", "false");
	}

	/*
	 * FOR DEV AND LIVE
	 */
	if (TWILIO_APP_DEMO != "true") {
		define("TWILIO_API_SID",    $twilio_account_sid);
		define("TWILIO_API_AUTH",   $twilio_auth_token);
		define("TWILIO_API_NUMBER", $twilio_number);
	}
	
	unset(
		$twilio_enabled_sms, 
		$twilio_enabled_call, 
		$twilio_account_sid, 
		$twilio_auth_token,
		$twilio_number
	);

?>