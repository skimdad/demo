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
	# * FILE: /members/googleauth.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");
	
	
	try {
		
		$domain_url = str_replace("http://", "", NON_LANG_URL);
		$domain_url = str_replace("https://", "", $domain_url);

		$openid = new LightOpenID($domain_url);
		if(!$openid->mode) {
			if(isset($_GET['login'])) { //go to google account login page
				$openid->identity = 'https://www.google.com/accounts/o8/id';
				$openid->required = array('namePerson/last', 'namePerson/first', 'contact/email');
				header('Location: ' . $openid->authUrl());
				exit;
			}
		} elseif($openid->mode == 'cancel') { //the user canceled the authentication
			header("Location: ".DEFAULT_URL."/members/login.php?googleerror=cancel");
			exit;
		} else { //user successfully authenticated
			if ($openid->validate()){ //user logged in
				
				unset($gogoleInfo);
				$gogoleInfo = $openid->getAttributes();
				unset($userInfo);
				$userInfo["first_name"] = $gogoleInfo["namePerson/first"];
				$userInfo["last_name"] = $gogoleInfo["namePerson/last"];
				$userInfo["email"] = $gogoleInfo["contact/email"];
				
				if ($_GET["advertise"] == "yes" || string_strpos($_GET["destiny"], "/claim") !== false) {
					if (string_strpos($_GET["destiny"], "/".LISTING_FEATURE_FOLDER) !== false) {
						$email_notification = SYSTEM_LISTING_SIGNUP;
					} else if (string_strpos($_GET["destiny"], "/".ARTICLE_FEATURE_FOLDER) !== false) {
						$email_notification = SYSTEM_ARTICLE_SIGNUP;
					} else if (string_strpos($_GET["destiny"], "/".EVENT_FEATURE_FOLDER) !== false) {
						$email_notification = SYSTEM_EVENT_SIGNUP;
					} else if (string_strpos($_GET["destiny"], "/".CLASSIFIED_FEATURE_FOLDER) !== false) {
						$email_notification = SYSTEM_CLASSIFIED_SIGNUP;
					} else if (string_strpos($_GET["destiny"], "/".BANNER_FEATURE_FOLDER) !== false) {
						$email_notification = SYSTEM_BANNER_SIGNUP;
					} else if (string_strpos($_GET["destiny"], "/claim") !== false) {
						$email_notification = SYSTEM_CLAIM_SIGNUP;
					} else {
						$email_notification = SYSTEM_NEW_PROFILE;
					}
				} else {
					$email_notification = SYSTEM_NEW_PROFILE;
				}

				if (system_registerForeignAccount($userInfo, "google", false, $email_notification)) {
					setcookie("userform", "google", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
                    setcookie("uid", sess_getAccountIdFromSession(), time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
					if ($_GET["claim"] == "yes" || $_GET["advertise"] == "yes" || SOCIALNETWORK_FEATURE == "off") {
						$accObj = new Account(sess_getAccountIdFromSession());
						if ($accObj->getString("is_sponsor") == 'n') {
							$accObj->changeMemberStatus(true);
						}

						if ($_GET["advertise"] == "yes") {
							$destinyUrl = $_GET["destiny"];
							$itemID		= $_GET["item_id"];
							$item		= $_GET["advertise_item"];

							$level			= $_SESSION["go_{$item}_level_{$itemID}"];
							$expiration		= $_SESSION["go_{$item}_expiration_setting_{$itemID}"];
							$impressions	= $_SESSION["go_{$item}_unpaid_impressions_{$itemID}"];
							$template		= $_SESSION["go_{$item}_template_id_{$itemID}"];

							unset(
								$_SESSION["go_{$item}_level"],
								$_SESSION["go_{$item}_expiration_setting"],
								$_SESSION["go_{$item}_unpaid_impressions"],
								$_SESSION["go_{$item}_template_id"]
							);

							if ($item == "banner") {
								$destinyUrl .= "?type=".$level;
								$destinyUrl .= "&expiration_setting=".$expiration;
							} else if ($item == "listing") {
								$destinyUrl .= "?level=".$level;
								if ($template) {
									$destinyUrl .= "&listingtemplate_id=".$template;
								}
							} else {
								$destinyUrl .= "?level=".$level;
							}
							$destinyUrl = system_getAccountRedirect($destinyUrl);
							$_GET["destiny"] = $destinyUrl;
						}
					}
				} else { //system error
					header("Location: ".DEFAULT_URL."/members/login.php?googleerror=error");
					exit;
				}
			} else { //user not logged in
				header("Location: ".DEFAULT_URL."/members/login.php?googleerror=notlogged");
				exit;
			}
		}
		
	} catch(ErrorException $e) {
		header("Location: ".DEFAULT_URL."/members/login.php?googleerror=error");
		exit;
	}
	$redirectUrl = system_getAccountRedirect($_GET["destiny"]);
	header("Location: ".$redirectUrl);
	exit;

?>