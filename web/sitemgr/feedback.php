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
	# * FILE: /sitemgr/feedback.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();

	require(EDIRECTORY_ROOT."/sitemgr/registration.php");
	require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$to = str_replace('\'', '', $to);
		$to = trim($to);
		$from = trim($from);

		$to      = system_denyInjections($to);
		$subject = system_denyInjections($subject);

		$error = "";
		if (!validate_email($to)) $error .= system_showText(LANG_MSG_TOFRIEND1).".<br />";
		if (!$body){ $error .= system_showText(LANG_MSG_CONTACT_TYPE_MESSAGE)."<br />"; }
		if ( md5($_POST["captchatext"]) != $_SESSION["captchakey"] ) {
			$error .= system_showText(LANG_MSG_CONTACT_TYPE_CODE)."<br />";
		}

		$subject = stripslashes($subject);
		$body = stripslashes($body);

		if (empty($error)) {
			$domain = $_SERVER["HTTP_HOST"];
			if (string_strpos($domain, "www.") !== false) {
				$domain = str_replace("www.", "", $domain);
			}
			$subject = "[Feedback From: ".$domain."] ".$subject;
			$subject = html_entity_decode($subject);
			$linebreak = "\r\n";
			$message = "";		
			$body = str_replace("<br />", "\n", $body);
			$message .= "User: ".$_COOKIE["username_sitemgr"].$linebreak;
			$message .= "Domain: ".$domain.$linebreak.$linebreak;
			$message .= stripslashes($body);
			$message = html_entity_decode($message);
			$error = false;
			$return = system_mail($to, $subject, $message, $from, $emailNotificationObj->content_type, '', '', $error);
			$return_email_message = "";
			if ($return) {
				$return_email_message .= "<p class=\"successMessage\">".system_showText(LANG_CONTACTMSGSUCCESS)."</p>";
				unset($from, $subject, $body);
			} else {
				$return_email_message .= "<p class=\"errorMessage\">".system_showText(LANG_CONTACTMSGFAILED).($error ? '<br />'.$error : '')."</p>";
            }

		}
	}

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
		<link href="<?=DEFAULT_URL?>/sitemgr/layout/general_sitemgr.css" rel="stylesheet" type="text/css"></link>
		<link href="<?=DEFAULT_URL?>/sitemgr/layout/popup.css" rel="stylesheet" type="text/css" media="all" />
		<?=system_getNoImageStyle($cssfile = true);?>
	</head>
	<body class="feedbackWrapper">
		<h2 class="standardTitle"><?=system_showText(LANG_SITEMGR_FEEDBACK_SAUDATION)?></h2>
		<p style="padding: 0 0 5px 9px;"><?=system_showText(LANG_SITEMGR_FEEDBACK_GUIDE)?></p>

		<? if ($error) { ?>
			<p class="errorMessage"><?=$error?></p>
		<? } ?>
		<? if ($return_email_message) { ?>
			<?=$return_email_message?>
		<? } else { ?>
			<form name="feedback" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" class="frmEmail">
				<input type="hidden" name="receiver" value="<?=$receiver?>" />
				<? include(INCLUDES_DIR."/forms/form_feedback.php"); ?>
			</form>
		<? } ?>
	</body>
</html>