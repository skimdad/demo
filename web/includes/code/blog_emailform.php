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
	# * FILE: /includes/code/blog_emailform.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BLOG_FEATURE != "on" || CUSTOM_BLOG_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$id = $_POST["id"] ? $_POST["id"] : $_GET["id"];
	$id = system_denyInjections($id);
	$receiver = $_POST["receiver"] ? $_POST["receiver"] : $_GET["receiver"];
	$receiver = system_denyInjections($receiver);

    $item_error = FALSE;
    if (!$id || !$receiver) {
        $error = system_showText(LANG_MSG_TOFRIEND3)." <a href=".DEFAULT_URL.">" .DEFAULT_URL." </a>".system_showText(LANG_MSG_TOFRIEND4)."<br />";
        $item_error = TRUE;
    }   
    if ($id) {
        $check_id = db_getFromDB_Blog('post', 'id', $id);
        if (!$check_id->id)  {
            $error = system_showText(LANG_MSG_TOFRIEND3)." <a href=".DEFAULT_URL.">" .DEFAULT_URL." </a>".system_showText(LANG_MSG_TOFRIEND4)."<br />";
            $item_error = TRUE;
        }
    }
    if ($receiver) {
        if ($receiver != 'friend' && $receiver != 'owner') {
            $error = system_showText(LANG_MSG_TOFRIEND3)." <a href=".DEFAULT_URL.">" .DEFAULT_URL." </a>".system_showText(LANG_MSG_TOFRIEND4)."<br />";
            $item_error = TRUE;
        }
    }

	$obj = new Post($id);
	$local_url = "/detail.php?id=".$id;

	if ($receiver == "owner") {
		$to = $obj->getString("email");
		$saudation = system_showText(LANG_CONTACT)." ".$obj->getString('title');
		if (empty($subject)) $subject = system_showText(LANG_BLOG_CONTACTSUBJECT_ISNULL_1)." ".$obj->getString('title')." ".system_showText(LANG_BLOG_CONTACTSUBJECT_ISNULL_2)." ".EDIRECTORY_TITLE;
	} else {
		$saudation = system_showText(LANG_BLOG_TOFRIEND_SAUDATION);
		$emailNotificationObj = system_checkEmail(SYSTEM_EMAIL_TOFRIEND, EDIR_LANGUAGE);
		if (empty($subject)) {
			$subject = system_replaceEmailVariables_Blog($emailNotificationObj->subject, $obj->getNumber("id"), "post");
			$subject = htmlspecialchars($subject);
		}
		$disabled = "";
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$to = str_replace('\'', '', $to);
        $to = trim($to);
		$from = trim($from);

		$to = system_denyInjections($to);
		$from = system_denyInjections($from);
		$subject = system_denyInjections($subject);
		$body = system_denyInjections($body, true);

		$error = "";
		if (!validate_email($to))   $error .= system_showText(LANG_MSG_TOFRIEND1).".<br />";
		if (!validate_email($from)) $error .= system_showText(LANG_MSG_TOFRIEND2).".<br />";  
		 
		if (md5($_POST["captchatext"]) != $_SESSION["captchakey"]) {
			$error .= system_showText(LANG_MSG_CONTACT_TYPE_CODE)."<br />";
		}

		$subject = stripslashes($subject);
		$body 	 = stripslashes($body);

		if (empty($error)) {

			if (empty($subject)) $subject = system_showText(LANG_BLOG_CONTACTSUBJECT_ISNULL_1)." ".$obj->getString("title")." ".system_showText(LANG_BLOG_CONTACTSUBJECT_ISNULL_2)." ".EDIRECTORY_TITLE;

			$subject = stripslashes($subject);
			
			$subject = "[".system_showText(LANG_CONTACTPRESUBJECT)." ".EDIRECTORY_TITLE."] ".$subject;

			$message = "";
			
			$message .= LANG_MESSAGE_SENT_BY.": ".$from.$linebreak.$linebreak;

			$url = BLOG_DEFAULT_URL.$local_url;

			if ($receiver == "friend") {

				$message = "";

				if ($emailNotificationObj->content_type == "text/plain") $linebreak = "\r\n";
				else $linebreak = "<br />";
				
				if ($emailNotificationObj = system_checkEmail(SYSTEM_EMAIL_TOFRIEND, EDIR_LANGUAGE)) {
					$message .= $linebreak.LANG_MESSAGE_SENT_BY.$from.$linebreak.$linebreak.$linebreak;
					$message .= system_replaceEmailVariables_Blog($emailNotificationObj->body, $obj->getNumber("id"), "post");
				}
				
				$message .= $linebreak.$linebreak;
				$message .= system_showText(LANG_BLOG_TOFRIEND_MAIL).$linebreak;
				$message .= system_showText(LANG_LABEL_NAME).": ".htmlspecialchars_decode($obj->getString("title")).$linebreak;
				$message .= $linebreak;
				$message .= "----------------------------".$linebreak.$linebreak;
				
			}

			$body = str_replace("<br />", "", $body);

			$message .= stripslashes(html_entity_decode($body));
			$message .= $linebreak;
			
			if ($body) {
				$message .= "----------------------------".$linebreak.$linebreak;
			}
			
			$message .= LANG_THIS_IS_A_AUTOMATIC_MESSAGE;

			$subject = html_entity_decode($subject);

			$error = false;
			$return = system_mail($to, $subject, $message, $from, $emailNotificationObj->content_type, '', '', $error);

			$return_email_message = "";
			if ($return) {
				$return_email_message .= "<p class=\"successMessage\">".system_showText(LANG_CONTACTMSGSUCCESS)."</p>";
				unset($from, $subject, $body);
			} else $return_email_message .= "<p class=\"errorMessage\">".system_showText(LANG_CONTACTMSGFAILED).($error ? '<br />'.$error : '')."</p>";

			//$return_email_message .= "<p class=\"standardButton closeButton\"><a href=\"javascript:void(0);\" onclick=\"parent.$.fancybox.close();\">".system_showText(LANG_CLOSEWINDOW)."</a></p>";
		}
	}
?>