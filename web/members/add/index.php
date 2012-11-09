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
	# * FILE: /members/add/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSessionFront();

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	if (SOCIALNETWORK_FEATURE == "off") $is_sponsor = "y";
	else $is_sponsor = "n";

	if (sess_isAccountLogged()) {
		$accObj = new Account(sess_getAccountIdFromSession());
		if ($accObj->getString("is_sponsor") == "y" || $is_sponsor == "y") {
			header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		} else {
			header("Location: ".SOCIALNETWORK_URL."/");
		}
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		$request_method_seckey = "post";
		include(EDIRECTORY_ROOT."/includes/code/seckey.php");

		$validate_account = validate_addAccount($_POST, $message_account);
		$validate_contact = validate_form("contact", $_POST, $message_contact);

		if ($boolean_seckey && $validate_account && $validate_contact) {
			$_POST['publish_contact'] = ($_POST['publish_contact']?'y':'n');
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
			setcookie("username_members", $_POST['username'], time()+60*60*24*30, "".EDIRECTORY_FOLDER."/members");

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

			if ($is_sponsor == "y") {
				$email_notification = SYSTEM_SPONSOR_ACCOUNT_CREATE;
			} else {
				$email_notification = SYSTEM_NEW_PROFILE;
			}

			// sending e-mail to user //////////////////////////////////////////////////////////////////////////
			if ($emailNotificationObj = system_checkEmail($email_notification, $contact->getString("lang"))) {
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

			if ($is_sponsor == "y") {
				header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
			} else {
				header("Location: ".SOCIALNETWORK_URL."/");
			}
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
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

?>

	<div class="sidebar">
		<h2><?=system_showText(LANG_LABEL_MEMBER_OPTIONS)?></h2>
		<ul class="memberMenu">
			<li><a href="<?=NON_SECURE_URL?>/index.php"><?=system_showText(LANG_LABEL_BACK_TO_SEARCH)?></a></li>
			<li><a href="<?=DEFAULT_URL?>/members/index.php"><?=system_showText(LANG_LABEL_GO_TO_LOGIN)?></a></li>
		</ul>
	</div>

	<div class="content">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<h2><?=system_showText(LANG_LABEL_ACCOUNT_AND_CONTACT_INFO)?></h2>

		<? if ((string_strlen(trim($message_member))>0) ||(string_strlen(trim($message_account))>0) ||(string_strlen(trim($message_contact))>0) ) { ?>
			<p class="errorMessage">
			<? if (string_strlen(trim($message_member))>0) { ?>
				<?=$message_member?>
			<? } ?>
			<? if ((string_strlen(trim($message_member))>0) && (string_strlen(trim($message_account))>0 || string_strlen(trim($message_contact))>0)) { ?>
				<br />
			<? } ?>
			<? if (string_strlen(trim($message_account))>0) { ?>
				<?=$message_account?>
			<? } ?>
			<? if ((string_strlen(trim($message_account))>0) && (string_strlen(trim($message_contact))>0)) { ?>
				<br />
			<? } ?>
			<? if (string_strlen(trim($message_contact))>0) { ?>
				<?=$message_contact?>
			<? } ?>
			</p>
		<? } ?>

		<form name="addaccount" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">

			<input type="hidden" name="ieBugFix" value="1" />
			
			<? $memberssection = true;?>

			<? include(INCLUDES_DIR."/forms/form_account.php"); ?>
			<? include(INCLUDES_DIR."/forms/form_contact.php"); ?>

			<? include(EDIRECTORY_ROOT."/includes/code/seckey.php"); ?>
			
			<input type="hidden" name="ieBugFix" value="1" />

			<div class="baseButtons">
				<p class="standardButton">
					<button type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
				</p>
				<p class="standardButton">
					<button type="button" value="Cancel" onclick="redirect('<?=DEFAULT_URL."/".MEMBERS_ALIAS."/";?>');"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
				</p>
			</div>
		</form>
	</div>

	<script type="text/javascript">
		function redirect(url) {
			window.location = url;
		}
	</script>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>