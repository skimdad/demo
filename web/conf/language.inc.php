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
	# * FILE: /conf/language.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DEFINITIONS
	# ----------------------------------------------------------------------------------------------------

	
	//set default language
	//any changes in lines below must to be changed in database (table lang)
	$edir_default_language = "en_us";
	$edir_default_languagenumber = "1";

	//set all available languages separated by comma
	//up to 5 languages (edirectory performance)
	//if you want more than 5 languages, contact edirectory customization team
	//any changes in lines below must to be changed in database (table lang)
	$edir_languages = "en_us,pt_br,it_it";
	$edir_languagenames = "English,Português,Italiano";
	$edir_languagenumbers = "1,2,5";

	//up to 5 languages (edirectory performance)
	//if you want more than 5 languages, contact edirectory customization team
	define("MAX_ENABLED_LANGUAGES", 5);

	//loading the definitions file

	$definitions_file = EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/lang/language.inc.php';
	if (file_exists($definitions_file)) {
		include_once($definitions_file);
	}	
	
	//code to setup one specific language from all available languages
	$edir_language = $edir_default_language;
	if (defined("EDIRECTORY_MOBILE") && (EDIRECTORY_MOBILE == "on")) {
		if ($_GET["lang"] && (strpos($edir_languages, $_GET["lang"]) !== false)) {
			$edir_language = $_GET["lang"];
		}
	} else {
		$expire = 60*60*24*30*12;
		if (REDIRECT_EDIR_LANGUAGE) {
			$serverLangParts = explode("_", REDIRECT_EDIR_LANGUAGE);
			if (strpos($edir_languages, REDIRECT_EDIR_LANGUAGE) !== false) {
				$edir_language = REDIRECT_EDIR_LANGUAGE;

				if (REDIRECT_EDIR_LANGUAGE != $_COOKIE["edir_language"]) {
					setcookie("edir_language", REDIRECT_EDIR_LANGUAGE, time() + $expire, EDIRECTORY_FOLDER? EDIRECTORY_FOLDER: "/");
				}
				
				$destiny = string_replace_once(EDIRECTORY_FOLDER."/".$serverLangParts[0], "", $_SERVER["REQUEST_URI"]);
				$langURL = NON_LANG_URL.$destiny.$qs;
				if ($_SERVER["REQUEST_METHOD"] != "POST" && $edir_language == $edir_default_language) {
					header("Location: ".$langURL);
					exit;
				} 
			} else {
				if (MODREWRITE_FEATURE == "on" && SERVER_TYPE != "WIN") {
					$edirLangParts = explode("_", $edir_language);
					$destiny = string_replace_once(EDIRECTORY_FOLDER."/".$serverLangParts[0], "", $_SERVER["REQUEST_URI"]);
					$langURL = NON_LANG_URL."/".$edirLangParts[0].$destiny.$qs;

					setcookie("edir_language", $edir_language, time() + $expire, EDIRECTORY_FOLDER? EDIRECTORY_FOLDER: "/");
					
					if ($_SERVER["REQUEST_METHOD"] != "POST") {
						header("Location: ".$langURL);
						exit;
					}
				}
			}
			
			/*
			 * CR 64267
			 * Remove the MODREWRITE_FEATURE condition if you want to restore the language from the cookie value
			 */
		} else if ($_COOKIE["edir_language"] && (strpos($edir_languages, $_COOKIE["edir_language"]) !== false) && MODREWRITE_FEATURE != "on") {
			$edir_language = $_COOKIE["edir_language"];
			if (MODREWRITE_FEATURE == "on" && SERVER_TYPE != "WIN") {
				$edirLangParts = explode("_", $edir_language);
				if (EDIRECTORY_FOLDER != ""){
					$destiny = str_replace(EDIRECTORY_FOLDER."/", "/", $_SERVER["REQUEST_URI"]);
				} else {
					$destiny = $_SERVER["REQUEST_URI"];
				}
				$langURL = NON_LANG_URL."/".$edirLangParts[0].$destiny.$qs;

				setcookie("edir_language", $edir_language, time() + $expire, EDIRECTORY_FOLDER? EDIRECTORY_FOLDER: "/");

				if ($_SERVER["REQUEST_METHOD"] != "POST" && $edir_language != $edir_default_language) {
					header("Location: ".$langURL);
					exit;
				}
			}
		} else {
			if (MODREWRITE_FEATURE == "on" && SERVER_TYPE != "WIN") {
				$edirLangParts = explode("_", $edir_language);
				if (EDIRECTORY_FOLDER != ""){
					$destiny = str_replace(EDIRECTORY_FOLDER."/", "/", $_SERVER["REQUEST_URI"]);
				} else {
					$destiny = $_SERVER["REQUEST_URI"];
				}
				$langURL = NON_LANG_URL."/".$edirLangParts[0].$destiny.$qs;

				setcookie("edir_language", $edir_language, time() + $expire, EDIRECTORY_FOLDER? EDIRECTORY_FOLDER: "/");
				
				if ($_SERVER["REQUEST_METHOD"] != "POST" && $_SERVER["HTTP_HOST"] && $edir_language != $edir_default_language) {
					header("Location: ".$langURL);
					exit;
				}
			}
		}
	}
	
	# ----------------------------------------------------------------------------------------------------
	# AUTOMATIC FEATURES
	# ----------------------------------------------------------------------------------------------------
	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)
	include(EDIRECTORY_ROOT."/includes/code/language.php");
	unset($edir_default_language);
	unset($edir_default_languagenumber);
	unset($edir_languages);
	unset($edir_languagenames);
	unset($edir_languagenumbers);
	unset($edir_language);
	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)
	
	# ----------------------------------------------------------------------------------------------------
	# JUST FOR FACEBOOK API
	# ----------------------------------------------------------------------------------------------------
	$langPart = explode("_", EDIR_LANGUAGE);
	if ($langPart[0] == "ge") {
		$langPart[0] = "de";
		$langPart[1] = "DE";
	} else {
		$langPart[1] = strtoupper($langPart[1]);
	}
	define("EDIR_LANGUAGEFACEBOOK", implode("_", $langPart));
?>
