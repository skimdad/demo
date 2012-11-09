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
	# * FILE: /socialnetwork/edit.php
	# ----------------------------------------------------------------------------------------------------

	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# MAINTENANCE MODE
	# ----------------------------------------------------------------------------------------------------
	verify_maintenanceMode();

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");

	if (SOCIALNETWORK_FEATURE == "off") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSessionFront();
	$accObjAux = new Account(sess_getAccountIdFromSession());
	if ($accObjAux->getString("is_sponsor") == "y") {
		header("Location: ".DEFAULT_URL."/members/account/account.php?id=".sess_getAccountIdFromSession().(isset($_GET["signoffFacebook"]) ? "&signoffFacebook" : ""));
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/profile.php");

	# ----------------------------------------------------------------------------------------------------
	# Facebook
	# ----------------------------------------------------------------------------------------------------
	if (isset($_GET['signoffFacebook'])){
		$facebookMessage = system_showText(LANG_LABEL_FB_ACT_DISC).'.';

		$accountObj = new Account(sess_getAccountIdFromSession());
		$accountObj->setString("facebook_username", "");
		$accountObj->setString("foreignaccount", "n");
		$accountObj->setString("foreignaccount_done", "n");
		$accountObj->setString("foreignaccount_auth", "");
		$accountObj->Save();

		$profileObj = new Profile(sess_getAccountIdFromSession());
		$profileObj->setString("facebook_uid", "");
		$profileObj->setString("usefacebooklocation", "0");
		$profileObj->Save();
	}
	
	$expire = 60*60*24*30*12;
	setcookie("fb_attachOption", "facebook_import", time() + $expire, EDIRECTORY_FOLDER? EDIRECTORY_FOLDER: "/");

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	// Default CSS class for message box
	$message_style = "errorMessage";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

           
		if ($_POST["hiddenValue"]) {
			$reviewObj = new Review($_POST["hiddenValue"]);
			$reviewObj->Delete();
			header("Location: ".DEFAULT_URL."/members/account/account.php?type=".$_POST["type"]."&id=".sess_getAccountIdFromSession()."&scrren=".$_POST["screen"]."");
			exit;
		}

		$validate_demodirectoryDotCom = true;
		if (DEMO_LIVE_MODE) {
			$validate_demodirectoryDotCom = validate_demodirectoryDotCom($_POST["username"], $message_demoDotCom);
		}

		if ($validate_demodirectoryDotCom) {
			if (SOCIALNETWORK_FEATURE == "off") {
				$_POST["publish_contact"] = 'n';
			} else {
				if ($_POST['publish_contact'] == "on") {
					$_POST["publish_contact"] = 'y';
				} else {
					$_POST["publish_contact"] = 'n';
				}
			}
            $_POST['use_lang'] = ($_POST['use_lang']?'y':'n');

			if ((string_strlen($_POST["password"]))||(string_strlen($_POST["retype_password"]))) {
				$validate_membercurrentpassword = validate_memberCurrentPassword($_POST, sess_getAccountIdFromSession(), $message_member);
			} else {
				$validate_membercurrentpassword = true;
			}

			if ($validate_demodirectoryDotCom) {
				if ((string_strlen($_POST["password"]))||(string_strlen($_POST["retype_password"]))) {
					$validate_membercurrentpassword = validate_memberCurrentPassword($_POST, sess_getAccountIdFromSession(), $message_member);
				} else {
					$validate_membercurrentpassword = true;
				}

				$account = new Account($account_id);
				$validate_account = validate_MEMBERS_account($_POST, $message_account);
				$validate_contact = validate_form("contact", $_POST, $message_contact);
			}

			if ($validate_demodirectoryDotCom && $validate_membercurrentpassword && $validate_account && $validate_contact && !$message_profile) {
				$account = new Account($account_id);
				if ($account->getString("foreignaccount") == "y") {
					$account->setString("foreignaccount_done", "y");
					$account->save();
				}
				if ($_POST["password"]) {
					$account->setString("password", $_POST["password"]);
					$account->updatePassword();
				}
				$account->setString("publish_contact", $_POST["publish_contact"]);
				$account->Save();

				$contact = new Contact($_POST);
				$contact->Save();

				$accDomain = new Account_Domain($account->getNumber("id"), SELECTED_DOMAIN_ID);
				$accDomain->Save();
				$accDomain->saveOnDomain($account->getNumber("id"), $account, $contact);

				$message = system_showText(LANG_MSG_ACCOUNT_SUCCESSFULLY_UPDATED);
				$message_style = "successMessage";
			} else {
				$message = "";
				$message_style = "";
			}
		} else {
			$message = "";
			$message_style = "";
		}

	    // removing slashes added if required
	    $_POST = format_magicQuotes($_POST);
	    $_GET  = format_magicQuotes($_GET);

		extract($_GET);
	    extract($_POST);
	}

    # ----------------------------------------------------------------------------------------------------
	# MODE REWRITE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/profile/mod_rewrite.php");

	unset($info);
	$info = socialnetwork_retrieveInfoProfile($id);

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	// required because of the cookie var
	$username = "";

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	if (sess_getAccountIdFromSession()) {
		$accountObj = new Account(sess_getAccountIdFromSession());
		$accountObj->extract();
		$contactObj = new Contact(sess_getAccountIdFromSession());
		$contactObj->extract();
	} else {
		header("Location: ".DEFAULT_URL."/members/index.php");
		exit;
	}
	
	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$contentObj = new Content("", EDIR_LANGUAGE);
	$sitecontentSection = "Profile Page";
	$sitecontentinfo = $contentObj->retrieveContentInfoByType($sitecontentSection);
	if ($sitecontentinfo) {
		$headertagtitle = $sitecontentinfo["title"];
		$headertagdescription = $sitecontentinfo["description"];
		$headertagkeywords = $sitecontentinfo["keywords"];
		$sitecontent = $sitecontentinfo["content"];
	} else {
		$headertagtitle = "";
		$headertagdescription = "";
		$headertagkeywords = "";
		$sitecontent = "";
	}


	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$headertag_title = $headertagtitle;
	$headertag_description = $headertagdescription;
	$headertag_keywords = $headertagkeywords;
	$hide_search = true;
	include(system_getFrontendPath("header.php", "layout"));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# BODY
	# ----------------------------------------------------------------------------------------------------
	include(THEMEFILE_DIR."/".EDIR_THEME."/body/profile_edit.php");
	
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(system_getFrontendPath("footer.php", "layout"));

?>