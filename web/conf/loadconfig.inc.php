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
	# * FILE: /conf/loadconfig.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DEMONSTRATION MODE
	# ----------------------------------------------------------------------------------------------------
	
	if (strpos($_SERVER["HTTP_HOST"], "demodirectory") === false) {
		define("DEMO_MODE", 0);
	} else {
		define("DEMO_MODE", 1);
	}
	if (strpos($_SERVER["HTTP_HOST"], "demodirectory.com") === false) {
		define("DEMO_LIVE_MODE", 0);
	} else {
		define("DEMO_LIVE_MODE", 1);
	}
	if ((strpos($_SERVER["HTTP_HOST"], "arcasolutions.com") === false) && (strpos($_SERVER["HTTP_HOST"], "intranet") === false)) {
		define("DEMO_DEV_MODE", 0);
	} else {
		define("DEMO_DEV_MODE", 1);
	}

	# ----------------------------------------------------------------------------------------------------
	# DEFINE EDIRECTORY FOLDER
	# ----------------------------------------------------------------------------------------------------
	if (!defined("EDIRECTORY_FOLDER")) define("EDIRECTORY_FOLDER", "");

	# ----------------------------------------------------------------------------------------------------
	# TMP FOLDER PATH DEFINITION
	# ----------------------------------------------------------------------------------------------------
	define("TMP_FOLDER", $_SERVER["DOCUMENT_ROOT"].EDIRECTORY_FOLDER."/custom/tmp");

	# ----------------------------------------------------------------------------------------------------
	# DEFINE EDIRECTORY ROOT
	# ----------------------------------------------------------------------------------------------------
	if (!defined("EDIRECTORY_ROOT")) define("EDIRECTORY_ROOT", $_SERVER["DOCUMENT_ROOT"].EDIRECTORY_FOLDER);

	# ----------------------------------------------------------------------------------------------------
	# PHPINI
	# ----------------------------------------------------------------------------------------------------
	include("phpini.inc.php");
    
     # ----------------------------------------------------------------------------------------------------
	# MULTI LANGUAGE - USE THIS CODE IF THE MULTI LANGUAGE FEATURE IS NOT WORKING PROPERLY USING HTACCESS
	# ----------------------------------------------------------------------------------------------------
    
    define("MULTILANGUAGE_BYCODE", "off");
    
    if (MULTILANGUAGE_BYCODE == "on"){
        unset($aux_default_url);
        unset($aux_array_langs);

        $aux_array_langs["en_us"] = "en";
        $aux_array_langs["pt_br"] = "pt";
        $aux_array_langs["it_it"] = "it";
        $aux_array_langs["fr_fr"] = "fr";
        $aux_array_langs["es_es"] = "es";
        $aux_array_langs["ge_ge"] = "ge";
        $aux_array_langs["tr_tr"] = "tr";

        if ((!$_SERVER["HTTPS"]) || ($_SERVER["HTTPS"] == "off")) {
            $aux_default_url = "http://".$_SERVER["HTTP_HOST"].EDIRECTORY_FOLDER;
        } else {
            $aux_default_url = "https://".$_SERVER["HTTP_HOST"].EDIRECTORY_FOLDER;
        }

        foreach($aux_array_langs as $abbr => $lang){
            if(strpos($aux_default_url.$_SERVER["REQUEST_URI"], $aux_default_url."/$lang/") !== false){
                define(REDIRECT_EDIR_LANGUAGE, $abbr);
                break;
            }
        }
        unset($aux_default_url);
        unset($aux_array_langs); 
    }

	# ----------------------------------------------------------------------------------------------------
	# DOMAIN CONSTANT
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/custom/domain/domain.inc.php");

	if (!$_inCron){
		if ($_SERVER["HTTP_HOST"]){
			session_start();
		}

		if(function_exists('mb_strtoupper')){
			$host = mb_strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));
			$host_cookie = str_replace(".", "_", $host);
		}else{
			$host = strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));
			$host_cookie = str_replace(".", "_", $host);
		}

		if ($_SERVER["HTTP_HOST"] && !$domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])]) {
			echo "Domain unavailable! Please contact the administrator.";
			exit;
		} else {
			if (strpos($_SERVER["PHP_SELF"],"sitemgr") || strpos($_SERVER["PHP_SELF"], "blog/sitemgr")){
				if (!in_array($_SESSION[$host."_DOMAIN_ID_SITEMGR"], $domainInfo) || $resetDomainSession) {
					if (!in_array($_COOKIE[$host_cookie."_DOMAIN_ID_SITEMGR"], $domainInfo) || $resetDomainSession) {
						$_SESSION[$host."_DOMAIN_ID_SITEMGR"] = $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])];
						setcookie($host."_DOMAIN_ID_SITEMGR", $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])], time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
					} else {
						$_SESSION[$host."_DOMAIN_ID_SITEMGR"] = $_COOKIE[$host_cookie."_DOMAIN_ID_SITEMGR"];
					}
					define("SELECTED_DOMAIN_ID", $_SESSION[$host."_DOMAIN_ID_SITEMGR"]);
				}
			} else if (strpos ($_SERVER["PHP_SELF"],"members")){
				if (!in_array($_SESSION[$host."_DOMAIN_ID_MEMBERS"], $domainInfo) || $resetDomainSession) {
					if (!in_array($_COOKIE[$host_cookie."_DOMAIN_ID_MEMBERS"], $domainInfo) || $resetDomainSession) {
						$_SESSION[$host."_DOMAIN_ID_MEMBERS"] = $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])];
						setcookie($host."_DOMAIN_ID_MEMBERS", $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])], time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
					} else {
						$_SESSION[$host."_DOMAIN_ID_MEMBERS"] = $_COOKIE[$host_cookie."_DOMAIN_ID_MEMBERS"];
					}
					define("SELECTED_DOMAIN_ID", $_SESSION[$host."_DOMAIN_ID_MEMBERS"]);
					define("URL_DOMAIN_ID", $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])]);
					
				}
			}
		}

		if ($_SERVER["HTTP_HOST"]) {
			if (strpos($_SERVER["PHP_SELF"], "sitemgr")){
				if (!$_SESSION[$host."_DOMAIN_ID_SITEMGR"] || $resetDomainSession) {
					if (!$_COOKIE[$host_cookie."_DOMAIN_ID_SITEMGR"] || $resetDomainSession) {
						$_SESSION[$host."_DOMAIN_ID_SITEMGR"] = $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])];
						setcookie($host."_DOMAIN_ID_SITEMGR", $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])], time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
					} else {
						$_SESSION[$host."_DOMAIN_ID_SITEMGR"] = $_COOKIE[$host_cookie."_DOMAIN_ID_SITEMGR"];
					}
				}
				define("SELECTED_DOMAIN_ID", $_SESSION[$host."_DOMAIN_ID_SITEMGR"]);
			} else if (strpos($_SERVER["PHP_SELF"],"members")){
				if (!$_SESSION[$host."_DOMAIN_ID_MEMBERS"] || $resetDomainSession) {
					if (!$_COOKIE[$host_cookie."_DOMAIN_ID_MEMBERS"] || $resetDomainSession) {
						$_SESSION[$host."_DOMAIN_ID_MEMBERS"] = $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])];
						setcookie($host."_DOMAIN_ID_MEMBERS", $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])], time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
					} else {
						$_SESSION[$host."_DOMAIN_ID_MEMBERS"] = $_COOKIE[$host_cookie."_DOMAIN_ID_MEMBERS"];
					}
				}
				define("SELECTED_DOMAIN_ID", $_SESSION[$host."_DOMAIN_ID_MEMBERS"]);
				define("URL_DOMAIN_ID", $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])]);
				
			} else {
				if (!$_SESSION[$host."_DOMAIN_ID"] || $_SESSION[$host."_DOMAIN_ID"] != $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])]) {
					$_SESSION[$host."_DOMAIN_ID"] = $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])];
				}
				define("SELECTED_DOMAIN_ID", $_SESSION[$host."_DOMAIN_ID"]);
			}

		}
		if (strpos($_SERVER["PHP_SELF"], "sitemgr")) {
			setcookie($host."_DOMAIN_ID_TINYMCE_SITEMGR", SELECTED_DOMAIN_ID, time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
			setcookie("SECTION_SITEMGR", "true", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
			setcookie("SECTION_MEMBERS", "", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
		} else if (strpos($_SERVER["PHP_SELF"], "members")) {
			setcookie($host."_DOMAIN_ID_TINYMCE_MEMBERS", SELECTED_DOMAIN_ID, time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
			setcookie("SECTION_MEMBERS", "true", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
			setcookie("SECTION_SITEMGR", "", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
		}
		unset($domainInfo);
	}

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE GENERAL CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("config.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# PREPARE CONSTANT WITH DOMAIN INFORMATION
	# ----------------------------------------------------------------------------------------------------
	db_ArrayDomainInfo();

	# ----------------------------------------------------------------------------------------------------
	# PREPARE CONSTANT WITH LANGUAGE INFORMATION
	# ----------------------------------------------------------------------------------------------------
	language_constants();

	# ----------------------------------------------------------------------------------------------------
	# PREPARE CONSTANT WITH LEVELS INFORMATION
	# ----------------------------------------------------------------------------------------------------
    if (!$upgradeScript){
        system_ListingLevel_Constant();
    }
	# ----------------------------------------------------------------------------------------------------
	# PREPARE CONSTANT WITH SETTING INFORMATION
	# ----------------------------------------------------------------------------------------------------
	setting_constants();
    
    # ----------------------------------------------------------------------------------------------------
	# PREPARE CONSTANT WITH THEME TEMPLATE ID
	# ----------------------------------------------------------------------------------------------------
    if (!$upgradeScript){
        system_getThemeTemplate();
    }

	# ----------------------------------------------------------------------------------------------------
	# AUTOMATIC FEATURE
	# MOBILE FEATURE
	# ----------------------------------------------------------------------------------------------------
	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)
	
	
	//HACK: TO prevent redirect from mobi folder
	if(!$isMobileApp_MOBI)
	{
		if ((strpos($_SERVER["PHP_SELF"], "/members") === false) && (strpos($_SERVER["PHP_SELF"], "/sitemgr") === false)) {

		$autoMobileDetect = mobile_enableAutoDetect();
		if ($autoMobileDetect == "y") {

			$isiapp = "n";
			if (strpos($_SERVER["PHP_SELF"], "iapp") !== false) $isiapp = "y";
			$isMacMobile = mobile_isMacMobile();
			if (($isiapp == "y") && ($isMacMobile != "y")) {
				header("Location: ".DEFAULT_URL."");
				exit;
			}

			if ($isiapp != "y") {
				$isMobile = mobile_isMobile();
				if ((MOBILE_FEATURE == "on") && ($isMobile == "y") && !defined("EDIRECTORY_MOBILE")) {
					
                    if (strpos($_SERVER["PHP_SELF"], LISTING_FEATURE_FOLDER."/detail.php") !== false){
                        include(EDIRECTORY_ROOT."/conf/mobile.inc.php");
                        if(MODREWRITE_FEATURE == "on"){
                            $detailLink = MOBILE_DEFAULT_URL.$_SERVER["REDIRECT_URL"];
                        } else {
                            $detailLink = "".MOBILE_DEFAULT_URL."/listingdetail.php?id=".htmlspecialchars(str_replace("listing=", "", $_SERVER["REDIRECT_QUERY_STRING"]));
                        }                
                        header("Location: ".$detailLink);
                        exit;
                    } else {
                        include(EDIRECTORY_ROOT."/conf/mobile.inc.php");
                        header("Location: ".DEFAULT_URL."/".EDIRECTORY_MOBILE_LABEL."");
                        exit;
                    }
                    
				} elseif (defined("EDIRECTORY_MOBILE") && (EDIRECTORY_MOBILE == "on") && ((MOBILE_FEATURE != "on") || ($isMobile != "y"))) {
					
					if(string_strpos($_SERVER["SCRIPT_FILENAME"], EDIRECTORY_MOBILE_LABEL."/listingdetail.php") !== false){
						unset($aux_new_url);

						if(MODREWRITE_FEATURE == "on"){
							$aux_new_url = str_replace("id=","",$_SERVER["QUERY_STRING"]).".html";
						}else{
							$aux_new_url = "detail.php?id=".$_GET["id"];
						}
						
						header("Location: ".LISTING_DEFAULT_URL."/".$aux_new_url."");
					}else{
						header("Location: ".DEFAULT_URL."");
					}

					exit;
				}
			}
		}
	}
    } 
	
?>
