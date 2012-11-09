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
	# * FILE: /blog/includes/forms/form_comment.php
	# ----------------------------------------------------------------------------------------------------

	$actionForm = "";
	if (EDIR_LANG_URL) {
		$actionForm = str_replace(EDIR_LANGUAGEABBREVIATION."/", "", $_SERVER["REQUEST_URI"]);
	} else {
		$actionForm = $_SERVER["REQUEST_URI"];
	}

?>

<script type="text/javascript">

	function scrollMessage(id) {
		$('#error').css('display', '');
	}
	
</script>

<div class="contact-form">

	<h2><?=system_showText(LANG_MSG_LEAVEYOURCOMMENT)?></h2>

	<form class="form" name="commentForm" id="commentForm" method="post" action="<?=system_getFormAction($actionForm)?>">
	
		<? if ($success_approve_message) { ?>
			<p id="messageSucess" class="successMessage"><?=$success_approve_message;?></p>
			<script type="text/javascript">
				$('html, body').animate({
					scrollTop: $('#messageSucess').offset().top
				}, 500);
			</script>
		<? } ?>
	
		<? if (!empty($_SESSION[SESS_ACCOUNT_ID])) {
			
		$id= sess_getAccountIdFromSession();
		$account = new Account($id);
		$contact = new Contact($id);
		$profile = new Profile($id);
		$firstname = $contact->getString("first_name");
		$lastname = $contact->getString("last_name");
		if (SOCIALNETWORK_FEATURE == "on" && $account->getString("has_profile") == "y") {
			$comment_name = $profile->getString("nickname");
		} else {
			$comment_name = $firstname." ".$lastname;
		}
		$comment_email = $contact->getString("email");
		if ($error_comment) { ?>
			<script type="text/javascript">
				$('#messageSucess').css('display', 'none');
			</script>
		<? } ?>
	
		<p id="error" class="errorMessage" style="<?=(($message_comment) ? ("") : ("display: none;"))?>">
		
			<?=$error_comment; ?>
		</p>
	
		<? if ($error_comment) { ?>
			<script type="text/javascript">
				$('#error').css('display', '');
				$('#error').html('<?=$error_comment?>');
				$('html, body').animate({
					scrollTop: $('#error').offset().top
				}, 500);
			</script>
		<?
			unset($success_message);
		}?>
	
		<input type="hidden" id="reply_id" name="reply_id" value="0"/>
		
		<a name="info"></a>
		
		<div>
			<label for="comment_name">* <?=system_showText(LANG_LABEL_NAME)?></label>
			<input class="text" type="text" name="comment_name" id="comment_name" value="<?=$comment_name?>" readonly="readonly" maxlength="50" tabindex="1" />
		</div>
		
		<div>
			<label for="comment_email">* <?=system_showText(LANG_LABEL_YOUREMAIL)?></label>
			<input class="text" type="text" name="comment_email" id="comment_email" value="<?=$comment_email?>" maxlength="100" tabindex="2" />
		</div>
		
		<div>
			<label for="comment_website"><?=system_showText(LANG_LABEL_WEBSITE)?></label>
			<input class="text" type="text" name="comment_website" id="comment_website" value="<?=$comment_website?>" maxlength="100" tabindex="3" />
		</div>
	
		<div>
			<label for="comment">* <?=system_showText(LANG_LABEL_COMMENT)?></label>
			<?
			$comment = str_replace("<br />", "", $comment);
			?>
			<textarea class="textarea" id="comment" name="comment" rows="6" cols="0" tabindex="4"><?=$comment?></textarea>
		</div>					
		
		<p><?=system_showText(LANG_CAPTCHA_HELP)?></p>
			
		<div class="captcha">
			<div>
				<img src="<?=DEFAULT_URL?>/includes/code/captcha.php" border="0" alt="<?=system_showText(LANG_CAPTCHA_ALT)?>" title="<?=system_showText(LANG_CAPTCHA_TITLE)?>" />
				<input class="text" type="text" name="captchatext" value="" />
			</div>
		</div>
	
		<div class="button button-contact">
			<h2><a href="<?=$user ? "javascript: document.commentForm.submit();" : "javascript: void(0);"?>" <?=$user ? "": "style=\"cursor:default\""?>><?=LANG_BUTTON_SEND?></a></h2>			
		</div>
			
		<? } else {
			echo "<p class=\"informationMessage\"><a href=\"".DEFAULT_URL."/popup/popup.php?pop_type=profile_login&amp;destiny=$destiny\" class=\"fancy_window_login\">".LANG_MSG_NEED_LOGIN."</a></p>";
		} ?>
	</form>

<? if ($message_comment) { $message_comment = false; }?>

</div>