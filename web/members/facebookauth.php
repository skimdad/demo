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
	# * FILE: /members/facebookauth.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	Facebook::getFBInstance($facebook);

	if ($_GET["action"] == "check_session") {
		if ($_GET["fb_session"] == "ok") {
			if ($_GET["session"]) {
				$fbSess = (object)json_decode($_GET["session"]);
				if (isset($fbSess)) {
					$facebook->setAccessToken($fbSess->access_token);
					unset($fbSess);
					
					if ($_GET["type"] == "change_account") {
						$destinyUrl = $_GET["destiny"];
						$_GET["destiny"] = $facebook->getLogoutUrl(
							array (
								"next" => $destinyUrl
							)
						);
					}
				}
			}
		}

		if ($_GET["type"] == "redeem_deal") {
			$_SESSION["ITEM_ACTION"] = "redeem" ;
			$_SESSION["ITEM_TYPE"] = "deal";
			$_SESSION["ITEM_ID"] = $_GET["item_id"];
			$_SESSION["fb_deal_redirect"] = $_GET["tb_link"];
			
			if ($_GET["fb_session"] != "ok" || !isset($_SESSION["fb_".FACEBOOK_APP_ID."_access_token"])) {
				$destinyUrl = $_GET["destiny"];
				$_GET["destiny"] = $facebook->getLoginUrl(
					array (
						"redirect_uri"		=> FACEBOOK_REDIRECT_URI."?destiny=".$destinyUrl,
						"scope"				=> FACEBOOK_PERMISSION_SCOPE
					)
				);
			} else {
				if ($_GET["session"]) {
					$fbSess = (object)json_decode($_GET["session"]);
					if (isset($fbSess)) {
						$facebook->setAccessToken($fbSess->access_token);
						unset($fbSess);
					}
				}
			}
		}
		
		if ($_GET["type"] == "fb_comments") {
			if ($_GET["fb_session"] != "ok" || !isset($_SESSION["fb_".FACEBOOK_APP_ID."_access_token"])) {
				$destinyUrl = $_GET["destiny"];
				$_GET["destiny"] = $facebook->getLoginUrl(
					array (
						"redirect_uri"		=> FACEBOOK_REDIRECT_URI."?type=fb_comments&destiny=".$destinyUrl,
						"scope"				=> FACEBOOK_PERMISSION_SCOPE
					)
				);
			} else {
				if ($_GET["session"]) {
					$fbSess = (object)json_decode($_GET["session"]);
					if (isset($fbSess)) {
						$facebook->setAccessToken($fbSess->access_token);
						unset($fbSess);
					}
				}
			}
		}
	}

	$user = $facebook->getUser();

	if ($user && $_GET["type"] != "change_account") {
		try {
			if ($_GET["attach_account"] == "true") {
				$sql = "SELECT account_id FROM Profile WHERE facebook_uid = ".$user." AND account_id <> ".$_GET["edir_account"];
				$db = db_getDBObject(DEFAULT_DB, true);
				$result = $db->query($sql);
				$enableAttach = true;

				if ($_GET["is_sponsor"] == "y"){
					$denyUrl = EDIRECTORY_FOLDER."/".MEMBERS_ALIAS."/account/account.php?id=".$_GET["edir_account"]."&error=disableAttach";
				} else {
					$denyUrl = EDIRECTORY_FOLDER."/".SOCIALNETWORK_FEATURE_NAME."/edit.php?error=disableAttach";
				}
				
				if (mysql_num_rows($result) > 0){
					$_GET["destiny"] = $denyUrl;
					$enableAttach = false;
				} else {
					$extraInfo["account_id"]			= $_GET["edir_account"];
					$extraInfo["facebook_action"]		= $_COOKIE["fb_attachOption"] ? $_COOKIE["fb_attachOption"] : "facebook_import";
				}
			}

			if (($_GET["attach_account"] == "true" && $enableAttach) || $_GET["attach_account"] != "true") {
				$facebook->getUserInfo($userInfo, $extraInfo);
				
				if (string_strpos(($_GET["destiny"]), "prefs/comments.php") !== false){
					$_GET["destiny"] .= "?user_id=".$userInfo["uid"]; 
				} else {
					if ($_GET["type"] != "fb_comments"){
						if (system_registerForeignAccount($userInfo, "facebook", $_GET["attach_account"])) {
                            setcookie("uid", sess_getAccountIdFromSession(), time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
							setcookie("userform", "facebook", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
							if ($_GET["claim"] == "yes" || $_GET["advertise"] == "yes" || SOCIALNETWORK_FEATURE == "off") {
								$accObj = new Account(sess_getAccountIdFromSession());
								if ($accObj->getString("is_sponsor") == 'n') {
									$accObj->changeMemberStatus(true);
								}

								if ($_GET["advertise"] == "yes") {
									$destinyUrl = $_GET["destiny"];
									$itemID		= $_GET["item_id"];
									$item		= $_GET["advertise_item"];

									$level			= $_SESSION["fb_{$item}_level_{$itemID}"];
									$expiration		= $_SESSION["fb_{$item}_expiration_setting_{$itemID}"];
									$impressions	= $_SESSION["fb_{$item}_unpaid_impressions_{$itemID}"];
									$template		= $_SESSION["fb_{$item}_template_id_{$itemID}"];

									unset(
										$_SESSION["fb_{$item}_level"],
										$_SESSION["fb_{$item}_expiration_setting"],
										$_SESSION["fb_{$item}_unpaid_impressions"],
										$_SESSION["fb_{$item}_template_id"]
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
							} else {
								if ($_GET["attach_account"] != "true" && !$_SESSION["ITEM_ACTION"]){
									$_GET["destiny"] = system_getAccountRedirect($_GET["destiny"]);
							}
						}
					}
				}
			}
			}
		} catch (FacebookApiException $e) {
			error_log($e);
			$user = null;
		}
	}

        
	header("Location: ".$_GET["destiny"]);
	exit;