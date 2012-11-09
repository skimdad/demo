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
	# * FILE: /socialnetwork/add.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------

	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# MAINTENANCE MODE
	# ----------------------------------------------------------------------------------------------------
	verify_maintenanceMode();

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSessionFront();

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");

	if (SOCIALNETWORK_FEATURE == "off") { exit; }

	if (sess_isAccountLogged()) {
		header("Location: ".SOCIALNETWORK_URL."/");
		exit;
	}

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		$validate_account = validate_addAccount($_POST, $message_account);
		$validate_contact = validate_form("contact", $_POST, $message_contact);
		
		if ($message_account && $message_contact){
			$message_account .= "<br />";
		}

		if ($validate_account && $validate_contact) {
            $_POST['publish_contact'] = ($_POST['publish_contact']?'y':'n');
            $_POST['use_lang'] = ($_POST['use_lang']?'y':'n');
			$account = new Account($_POST);
			$account->Save();
			$contact = new Contact($_POST);
			$contact->setNumber("account_id", $account->getNumber("id"));
			$contact->Save();


			$profileObj = new Profile(sess_getAccountIdFromSession());
			$profileObj->setNumber("account_id", $account->getNumber("id"));
			if (!$profileObj->getString("nickname")) {
				$profileObj->setString("nickname", $_POST["first_name"]." ".$_POST["last_name"]);
			}
			$profileObj->Save();

			$accDomain = new Account_Domain($account->getNumber("id"), SELECTED_DOMAIN_ID);
			$accDomain->Save();
			$accDomain->saveOnDomain($account->getNumber("id"), $account, $contact, $profileObj);

			sess_registerAccountInSession($_POST["username"]);
			setcookie("username_members", $_POST['username'], time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

			/*****************************************************
			*
			* E-mail notify
			*
			******************************************************/
			setting_get("sitemgr_send_email",$sitemgr_send_email);
			setting_get("sitemgr_email",$sitemgr_email);
			$sitemgr_emails = explode(",",$sitemgr_email);
			setting_get("sitemgr_account_email",$sitemgr_account_email);
			$sitemgr_account_emails = explode(",",$sitemgr_account_email);

			// sending e-mail to user //////////////////////////////////////////////////////////////////////////
			if ($emailNotificationObj = system_checkEmail(SYSTEM_NEW_PROFILE, $contact->getString("lang"))) {
				$subject = $emailNotificationObj->getString("subject");
				$body = $emailNotificationObj->getString("body");
				$login_info = trim(system_findTranslationFor("LANG_LABEL_USERNAME", $emailNotificationObj->getString("lang"))).": ".$_POST["username"];
				$login_info .= ($emailNotificationObj->getString("content_type") == "text/html"? "<br />": "\n");
				$login_info .= trim(system_findTranslationFor("LANG_LABEL_PASSWORD", $emailNotificationObj->getString("lang"))).": ".$_POST["password"];
				$body = str_replace("ACCOUNT_LOGIN_INFORMATION",$login_info,$body);
				$body = system_replaceEmailVariables($body, $account->getNumber("id"), 'account');
				$subject = system_replaceEmailVariables($subject, $account->getNumber("id"), 'account');
				$body = html_entity_decode($body);
				$subject = html_entity_decode($subject);
				system_mail($contact->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
			}
			////////////////////////////////////////////////////////////////////////////////////////////////////

			// site manager warning message /////////////////////////////////////
			$sitemgr_msg = "
				<html>
					<head>
						<style>
							.email_style_settings{
								font-size:12px;
								font-family:Verdana, Arial, Sans-Serif;
								color:#000;
							}
						</style>
					</head>
					<body>
						<div class=\"email_style_settings\">
							Site Manager,<br /><br />
							A new account was created in ".EDIRECTORY_TITLE.".<br />
							Please review the account information below:<br /><br />";
							$sitemgr_msg .= "<b>Username: </b>".$account->getString("username")."<br />";
							$sitemgr_msg .= "<b>First Name: </b>".$contact->getString("first_name")."<br />";
							$sitemgr_msg .= "<b>Last Name: </b>".$contact->getString("last_name")."<br />";
							$sitemgr_msg .= "<b>Company: </b>".$contact->getString("company")."<br />";
							$sitemgr_msg .= "<b>Address: </b>".$contact->getString("address")." ".$contact->getString("address2")."<br />";
							$sitemgr_msg .= "<b>City: </b>".$contact->getString("city")."<br />";
							$sitemgr_msg .= "<b>State: </b>".$contact->getString("state")."<br />";
							$sitemgr_msg .= "<b>".string_ucwords(ZIPCODE_LABEL).": </b>".$contact->getString("zip")."<br />";
							$sitemgr_msg .= "<b>Phone: </b>".$contact->getString("phone")."<br />";
							$sitemgr_msg .= "<b>Fax: </b>".$contact->getString("fax")."<br />";
							$sitemgr_msg .= "<b>Email: </b>".$contact->getString("email")."<br />";
							$sitemgr_msg .= "<b>URL: </b>".$contact->getString("url")."<br />";
							$sitemgr_msg .= "<b>I agree with the terms of use: </b>".(($account->getString("agree_tou") ==1) ? "Yes" : "No")."<br />";
							$sitemgr_msg .="<br /><a href=\"".DEFAULT_URL."/sitemgr/account/view.php?id=".$account->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/sitemgr/account/view.php?id=".$account->getNumber("id")."</a><br /><br />
						</div>
					</body>
				</html>";

			if ($sitemgr_send_email == "on") {
				if ($sitemgr_emails[0]) {
					foreach ($sitemgr_emails as $sitemgr_email) {
						system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] Account Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
					}
				}
			}
			if ($sitemgr_account_emails[0]) {
				foreach ($sitemgr_account_emails as $sitemgr_account_email) {
					system_mail($sitemgr_account_email, "[".EDIRECTORY_TITLE."] Account Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_account_email>", "text/html", '', '', $error);
				}
			}
			////////////////////////////////////////////////////////////////////

			$redirectURL = system_getAccountRedirect(SOCIALNETWORK_URL."/");
			header("Location: ".$redirectURL);
			exit;

		} else {
			// removing slashes added if required
			$_POST = format_magicQuotes($_POST);
			$_GET  = format_magicQuotes($_GET);
			extract($_POST);
			extract($_GET);
		}

	}

	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$contentObj = new Content("", EDIR_LANGUAGE);
	$sitecontentSection = "Add Profile Page";
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
	include(THEMEFILE_DIR."/".EDIR_THEME."/body/profile_add.php");
	
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(system_getFrontendPath("footer.php", "layout"));

?>