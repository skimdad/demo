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
	# * FILE: /includes/code/profile_login.php
	# ----------------------------------------------------------------------------------------------------

	$ItemPath = "";
	if (string_strpos($_SERVER["HTTP_REFERER"], str_replace(NON_SECURE_URL, "", LISTING_DEFAULT_URL)) !== false) {
		$ItemPath = str_replace(NON_SECURE_URL, "", LISTING_DEFAULT_URL)."/";
	} elseif (string_strpos($_SERVER["HTTP_REFERER"], str_replace(NON_SECURE_URL, "", PROMOTION_DEFAULT_URL)) !== false) {
		$ItemPath = str_replace(NON_SECURE_URL, "", PROMOTION_DEFAULT_URL)."/";
	} elseif (string_strpos($_SERVER["HTTP_REFERER"], str_replace(NON_SECURE_URL, "", EVENT_DEFAULT_URL)) !== false) {
		$ItemPath = str_replace(NON_SECURE_URL, "", EVENT_DEFAULT_URL)."/";
	} elseif (string_strpos($_SERVER["HTTP_REFERER"], str_replace(NON_SECURE_URL, "", CLASSIFIED_DEFAULT_URL)) !== false) {
		$ItemPath = str_replace(NON_SECURE_URL, "", CLASSIFIED_DEFAULT_URL)."/";
	} elseif (string_strpos($_SERVER["HTTP_REFERER"], str_replace(NON_SECURE_URL, "", ARTICLE_DEFAULT_URL)) !== false) {
		$ItemPath = str_replace(NON_SECURE_URL, "", ARTICLE_DEFAULT_URL)."/";
	} elseif (string_strpos($_SERVER["HTTP_REFERER"], str_replace(NON_SECURE_URL, "", BLOG_DEFAULT_URL)) !== false) {
		$ItemPath = str_replace(NON_SECURE_URL, "", BLOG_DEFAULT_URL)."/";
	} elseif (string_strpos($_SERVER["HTTP_REFERER"], "/results.php") !== false || string_strpos($_SERVER["HTTP_REFERER"], "/search") !== false) {
		$ItemPath = "/";
	}
	
	setting_get("foreignaccount_openid", $foreignaccount_openid);
	setting_get("foreignaccount_google", $foreignaccount_google);

    $nofacebook = $_GET['nofacebook'] ? true : false;

    //FACEBOOK FORM LOGIN
    $divIdFB = "popLFacebook";
    $randomId = system_generatePassword();
    
    if ($_GET["destiny"] && $ItemPath) {
        $destiny = "destiny=".$_GET["destiny"];
    } else if ($_GET["destiny"] && !$ItemPath) {
        $destiny = "destiny=".$_GET["destiny"];
    }
    if ($ItemPath) {
        $url = "/members/login.php?userperm=true";
        if ($destiny) {
            $url .= "&".$destiny;
        };
    } else {
        $url = "/members/login.php";
        if ($destiny) {
            $url .= "?".$destiny;
            if ($_GET["act"] == "see_profile"){
                $url .= "&userperm=true"; 
            }
        }
    }

    $_x_request_uri = str_replace(EDIRECTORY_FOLDER."/popup/popup.php?pop_type=profile_login&destiny=", "", $_SERVER["REQUEST_URI"]);
    $_x_request_uri = string_substr($_x_request_uri, 0, string_strpos($_x_request_uri, "&act"));
    $_SESSION["USER_PERM"] = ($ItemPath || $_GET["act"] == "see_profile") ? true: false;
    $_SESSION["REQUEST_URI"] = $_x_request_uri;
    $_SESSION["HTTP_REFER"] = $_SERVER["HTTP_REFERER"];
    $_SESSION["ITEM_ACTION"] = $_GET["act"];
    $_SESSION["ITEM_TYPE"] = $_GET["type"];
    $_SESSION["ITEM_ID"] = $_GET[$_GET["act"]."_item"];
?>