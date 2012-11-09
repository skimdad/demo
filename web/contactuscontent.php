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
	# * FILE: /contactuscontent.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

?>

	<?
	if ($_POST) {
		$senderror = false;
		if (md5($_POST["captchatext"]) != $_SESSION["captchakey"]) {
			$captchaerror = true;
		}
		$emailerror = false;
		if (!validate_email($_POST["email"])) {
			$emailerror = true;
		}
		$nameerror = false;
		if (!$_POST["name"]) {
			$nameerror = true;
		}
		$titleerror = false;
		if (!$_POST["title"]) {
			$titleerror = true;
		}
		$messageerror = false;
		if (!$_POST["messageBody"]) {
			$messageerror = true;
		}
		if (!$captchaerror && !$emailerror && !$nameerror && !$titleerror && !$messageerror) {
			$_POST["email"] = stripslashes($_POST["email"]);
			$_POST["name"] = stripslashes($_POST["name"]);
			$_POST["title"] = stripslashes($_POST["title"]);
			$_POST["messageBody"] = stripslashes($_POST["messageBody"]);
			$from_email = $_POST["email"];
			$from_name = $_POST["name"];
			$subject = $_POST["title"];
			$messageBody = LANG_MESSAGE_SENT_BY.$from_email."<br /><br />";
			$messageBody .= $_POST["messageBody"];
			$messageBody = str_replace("\r\n", "\n", $messageBody);
			$messageBody = str_replace("\n", "\r\n", $messageBody);
			$messageBody .= "<br /><br />----------------------------<br /><br />";
			$messageBody .= LANG_THIS_IS_A_AUTOMATIC_MESSAGE;
			setting_get("sitemgr_email", $sitemgr_email);
			$sitemgr_emails = explode(",", $sitemgr_email);
			setting_get("sitemgr_contactus_email", $sitemgr_contactus_email);
			$sitemgr_contactus_emails = explode(",", $sitemgr_contactus_email);
			$errors = array();
			$error  = false;
			if ($sitemgr_contactus_emails[0]) {
				foreach ($sitemgr_contactus_emails as $sitemgr_contactus_email) {
					system_mail($sitemgr_contactus_email, "[Message sent through ".EDIRECTORY_TITLE." - Contact Us] ".stripslashes(htmlspecialchars_decode($subject)), stripslashes($messageBody), "$from_name <$from_email>", "text/html", "", "", $error);
					if ($error) $errors[] = $error;
				}
			} elseif ($sitemgr_emails[0]) {
				foreach ($sitemgr_emails as $sitemgr_email) {
					system_mail($sitemgr_email, "[Message sent through ".EDIRECTORY_TITLE." - Contact Us] ".stripslashes(htmlspecialchars_decode($subject)), stripslashes($messageBody), "$from_name <$from_email>", "text/html", "", "", $error);
					if ($error) $errors[] = $error;
				}
			}
			if (!count($errors)) {
				$message_style = "successMessage";
				$contactus_message = system_showText(LANG_CONTACTMSGSUCCESS);
				unset($_POST["email"]);
				unset($_POST["name"]);
				unset($_POST["title"]);
				unset($_POST["messageBody"]);
			} else {
				$senderror = true;
				$existerror = true;
				$contactus_message = implode("<br />", $errors);
			}
		}
		if ($nameerror) {
			$existerror = true;
			$contactus_message .= system_showText(LANG_MSG_CONTACT_TYPE_NAME)."<br />";
		}
		if ($emailerror) {
			$existerror = true;
			$contactus_message .= system_showText(LANG_MSG_CONTACT_ENTER_VALID_EMAIL)."<br />";
		}
		if ($titleerror) {
			$existerror = true;
			$contactus_message .= system_showText(LANG_MSG_CONTACT_TYPE_SUBJECT)."<br />";
		}
		if ($messageerror) {
			$existerror = true;
			$contactus_message .= system_showText(LANG_MSG_CONTACT_TYPE_MESSAGE)."<br />";
		}
		if ($captchaerror) {
			$existerror = true;
			$contactus_message .= system_showText(LANG_MSG_CONTACT_TYPE_CODE)."<br />";
		}
		
		if ($existerror) {
			$message_style = "errorMessage";
			if (!$senderror) {
				$contactus_message .= system_showText(LANG_MSG_CONTACT_CORRECTIT_TRYAGAIN);
			}
		}
	}
	?>
        
	<div class="contact-form contact-us-form realestate-form">
	
		<? if ($contactus_message) { ?>
			<p class="<?=$message_style?>"><?=$contactus_message?></p>
		<? } ?>
        
		<form name="contactusForm" id="contactusForm" action="<?=DEFAULT_URL?>/contactus.php" method="post" class="form">
		
			<h2><?=system_showText(LANG_LABEL_FORMCONTACTUS);?></h2>
			
            <div class="real-left">
                <div>
                    <label for="name">* <?=system_showText(LANG_LABEL_NAME)?></label>
                    <input id="name" name="name" value="<?=$_POST["name"];?>" type="text" class="text" />
                </div>
                
                <div>
                    <label for="email">* <?=system_showText(LANG_LABEL_EMAIL)?></label>
                    <input id="email" name="email" value="<?=$_POST["email"];?>" type="text" class="text" />
                </div>
                
                <div>
                    <label for="title">* <?=system_showText(LANG_LABEL_SUBJECT)?></label>
                    <input id="title" name="title" value="<?=$_POST["title"];?>" type="text" class="text" />
                </div>
			</div>                	
			
			<?
			$_POST["messageBody"] = str_replace("<br />", "", $_POST["messageBody"]);
			?>
			
            <div class="real-right">
                <label for="message">* <?=system_showText(LANG_LABEL_MESSAGE)?></label>
                <textarea id="message" name="messageBody" rows="10" cols="30" class="textarea"><?=$_POST["messageBody"];?></textarea>
            </div>
            
            <div class="real-right real-info">    
                <p><?=system_showText(LANG_CAPTCHA_HELP)?></p>
                <div class="captcha real-right">
                    <div>
                        <img src="<?=DEFAULT_URL?>/includes/code/captcha.php" border="0" alt="<?=system_showText(LANG_CAPTCHA_ALT)?>" title="<?=system_showText(LANG_CAPTCHA_TITLE)?>" />
                        <input type="text" value="" name="captchatext" class="text" />
                    </div>
                </div>
                <div class="button button-contact real-right">
                    <h2><a href="javascript: document.contactusForm.submit();"><?=LANG_BUTTON_SEND?></a></h2>			
                </div>
			</div>
			
		</form>
	</div>