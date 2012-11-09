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
	# * FILE: /members/openidauth.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------

	if ($_GET["openid_mode"] == "id_res") {
		$openid = new AuthOpenID($_GET["openid_identity"]);
		try {
			if ($auth = $openid->validateAuth($_GET)) {
				if (isset($_SESSION["ACCOUNT_REDIRECT"])) {
					if (string_strpos($_SESSION["ACCOUNT_REDIRECT"], "/".LISTING_FEATURE_FOLDER) !== false) {
						$email_notification = SYSTEM_LISTING_SIGNUP;
					} else if (string_strpos($_SESSION["ACCOUNT_REDIRECT"], "/".ARTICLE_FEATURE_FOLDER) !== false) {
						$email_notification = SYSTEM_ARTICLE_SIGNUP;
					} else if (string_strpos($_SESSION["ACCOUNT_REDIRECT"], "/".EVENT_FEATURE_FOLDER) !== false) {
						$email_notification = SYSTEM_EVENT_SIGNUP;
					} else if (string_strpos($_SESSION["ACCOUNT_REDIRECT"], "/".CLASSIFIED_FEATURE_FOLDER) !== false) {
						$email_notification = SYSTEM_CLASSIFIED_SIGNUP;
					} else if (string_strpos($_SESSION["ACCOUNT_REDIRECT"], "/".BANNER_FEATURE_FOLDER) !== false) {
						$email_notification = SYSTEM_BANNER_SIGNUP;
					} else if (string_strpos($_SESSION["ACCOUNT_REDIRECT"], "/claim") !== false) {
						$email_notification = SYSTEM_CLAIM_SIGNUP;
					} else {
						$email_notification = SYSTEM_NEW_PROFILE;
					}
				} else {
					$email_notification = SYSTEM_NEW_PROFILE;
				}
				if (system_registerForeignAccount($auth, "openid", false, $email_notification)) {
					$accountObject = db_getFromDB("account", "id", db_formatNumber($_SESSION[SESS_ACCOUNT_ID]));
                    setcookie("uid", $_SESSION[SESS_ACCOUNT_ID], time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
					if (isset($_SESSION["ACCOUNT_REDIRECT"])) {
						$redirect = $_SESSION["ACCOUNT_REDIRECT"];
						unset($_SESSION["ACCOUNT_REDIRECT"]);
					} else {
						$redirect = $accountObject->getForeignAccountRedirect();
					}
					$accountObject->setForeignAccountRedirect("");
					if ($_GET["advertise"] || $_GET["claim"] || SOCIALNETWORK_FEATURE == "off") {
						$accountObject->changeMemberStatus(true);

						$host = string_strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));

						setcookie($host."_DOMAIN_ID_MEMBERS", "", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
						setcookie($host."_DOMAIN_ID", "", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
						unset($_SESSION[$host."_DOMAIN_ID_MEMBERS"], $_SESSION[$host."_DOMAIN_ID"]);
					}
					if (!$_GET["advertise"] && !$_GET["claim"]) {
						if ($_SESSION['USER_PERM'] == true) {
							$_x_http_refer = $_SESSION["HTTP_REFER"];
							unset($_SESSION["HTTP_REFER"], $_SESSION['USER_PERM']);

							if ($_x_http_refer) $redirect = $_x_http_refer;
							else $redirect = $_SERVER["HTTP_REFERER"];
						} else {
							if ($accountObject->getString("is_sponsor") == "y" || SOCIALNETWORK_FEATURE == "off") {
								$redirect = DEFAULT_URL."/members/";
							} else {
								$redirect = SOCIALNETWORK_URL."/";
							}
						}
					}
					if ($_SESSION["REQUEST_URI"] && ($_SESSION["ITEM_ACTION"] == "rate" || $_SESSION["ITEM_ACTION"] == "redeem") && $_SESSION["ITEM_TYPE"] && is_numeric($_SESSION["ITEM_ID"]) && sess_isAccountLogged()) {
						$redirect = str_replace(EDIRECTORY_FOLDER, "", DEFAULT_URL);
						$redirect .= $_SESSION["REQUEST_URI"];

						if (MODREWRITE_FEATURE == "on") {
							if (string_strpos($redirect, "/detail.php")) {
								$iFriendlyUrl = string_substr($redirect, string_strpos($redirect, "=") + 1, string_strlen($redirect));
								$nUrl = string_substr($redirect, 0, string_strpos($redirect, "/detail.php"));
								$redirect = $nUrl."/".$iFriendlyUrl.".html";
							}
						}
						$redirect = str_replace("https", "http", $redirect);
						unset($_SESSION["REQUEST_URI"]);
					}
					if ($redirect) {
						$redirectUrl = system_getAccountRedirect($redirect);
						header("Location: ".$redirectUrl);
					} else {
						$redirectUrl = system_getAccountRedirect(DEFAULT_URL."/members/");
						header("Location: ".$redirectUrl);
					}
					exit;
				} else {
					header("Location: ".DEFAULT_URL."/members/login.php?openiderror=error");
					exit;
				}
			} else {
				header("Location: ".DEFAULT_URL."/members/login.php?openiderror=invalid");
				exit;
			}
		} catch (Exception $ex) {
			header("Location: ".DEFAULT_URL."/members/login.php?openiderror=error");
			exit;
		}
	} elseif ($_GET["openid_mode"] == "cancel") {
		header("Location: ".DEFAULT_URL."/members/login.php?openiderror=cancel");
		exit;
	} else {
		header("Location: ".DEFAULT_URL."/members/login.php?openiderror=error");
		exit;
	}

?>
