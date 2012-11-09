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
	# * FILE: /conf/config.inc.php
	# ----------------------------------------------------------------------------------------------------

	@date_default_timezone_set('America/New_York');

	if (!defined("DEFAULT_DB")) {
		# ----------------------------------------------------------------------------------------------------
		# EDIRECTORY ADMINISTRATOR EMAIL
		# ----------------------------------------------------------------------------------------------------
		define("EDIR_ADMIN_EMAIL", "edirectory_debug@arcasolutions.com");
		define("EDIR_SUPPORT_EMAIL", "test.demo.arca@gmail.com");

		# ----------------------------------------------------------------------------------------------------
		# DATABASE CONNECTION PARAMETERS
		# ----------------------------------------------------------------------------------------------------
		define("DEFAULT_DB",         "DIRECTORYDB");
		define("_DIRECTORYDB_HOST",  "localhost");
		define("_DIRECTORYDB_USER",  "root");
		define("_DIRECTORYDB_PASS",  "Arch$2724");
		define("_DIRECTORYDB_NAME",  "dealclou_main");
		define("_DIRECTORYDB_EMAIL", EDIR_ADMIN_EMAIL);
		if (DEMO_DEV_MODE || !$_SERVER["HTTP_HOST"]) {
			define("_DIRECTORYDB_DEBUG", "display");
		} else {
			define("_DIRECTORYDB_DEBUG", "hide");
		}

		define("DB_NAME_PREFIX", "dealclou");

		define("MYSQL_TIMEOUT", 10); // Seconds information to each connection of Connection Pool
	}

	if (!$_inCron || $_inCronCheck) {
		# ----------------------------------------------------------------------------------------------------
		# SEARCH WORD LENGTH
		# ----------------------------------------------------------------------------------------------------
		define("FT_MIN_WORD_LEN", "4");

		# ----------------------------------------------------------------------------------------------------
		# LANG URL
		# ----------------------------------------------------------------------------------------------------
		if (strpos($_SERVER["PHP_SELF"], "errorpage.php") !== false){
			$_SERVER["REDIRECT_edir_language"] = $_SERVER["REDIRECT_REDIRECT_edir_language"];
		}
		
        if (!defined("REDIRECT_EDIR_LANGUAGE")){
            define("REDIRECT_EDIR_LANGUAGE", $_SERVER["REDIRECT_edir_language"]);
        }
		$langPart = explode("_", REDIRECT_EDIR_LANGUAGE);
		$langPURL = "";
		if ($langPart[0]){ 
			$langPURL = "/".$langPart[0];
		}

		# ----------------------------------------------------------------------------------------------------
		# DEFINE DEFAULT URL
		# ----------------------------------------------------------------------------------------------------
		if ((!$_SERVER["HTTPS"]) || ($_SERVER["HTTPS"] == "off")) {
			define("HTTPS_MODE", "off");
			if (!defined("DEFAULT_URL")) define("DEFAULT_URL", "http://".$_SERVER["HTTP_HOST"].EDIRECTORY_FOLDER.$langPURL);
		} else {
			define("HTTPS_MODE", "on");
			if (!defined("DEFAULT_URL")) define("DEFAULT_URL", "https://".$_SERVER["HTTP_HOST"].EDIRECTORY_FOLDER.$langPURL);
		}

		# ----------------------------------------------------------------------------------------------------
		# SECURE URL
		# ----------------------------------------------------------------------------------------------------
		define("SECURE_URL", "https://".$_SERVER["HTTP_HOST"].EDIRECTORY_FOLDER.$langPURL);

		# ----------------------------------------------------------------------------------------------------
		# NON_SECURE_URL
		# ----------------------------------------------------------------------------------------------------
		define("NON_SECURE_URL", "http://".$_SERVER["HTTP_HOST"].EDIRECTORY_FOLDER.$langPURL);

		# ----------------------------------------------------------------------------------------------------
		# NON_LANG_URL
		# ----------------------------------------------------------------------------------------------------
		define("NON_LANG_URL", "http://".$_SERVER["HTTP_HOST"].EDIRECTORY_FOLDER);
		
		# ----------------------------------------------------------------------------------------------------
		# SERVER TYPE
		# ----------------------------------------------------------------------------------------------------
		define("SERVER_TYPE", substr(PHP_OS, 0, 3));

		/*
		 * Create session to force second DB
		 */
		define("FORCE_SECOND", true);

		# ----------------------------------------------------------------------------------------------------
		# INCLUDE GLOBAL INCLUDES
		# ----------------------------------------------------------------------------------------------------
		include(EDIRECTORY_ROOT."/conf/includes.inc.php");
	}
?>
