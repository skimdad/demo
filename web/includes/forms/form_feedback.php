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
	# * FILE: /includes/forms/form_feedback.php
	# ----------------------------------------------------------------------------------------------------

?>
		<input type="hidden" name="to" value="<?=SITMGR_FEEDBACK_EMAIL?>" />
		<table border="0" cellpadding="0" cellspacing="0" class="standardForm">

			<tr>
				<th colspan="2"><?=system_showText(LANG_SITEMGR_LABEL_TO)?>: marketing@eDirectory.com</th>
			</tr>					
			
			<tr>
				<th colspan="2"><?=system_showText(LANG_SITEMGR_LABEL_SUBJECT)?></th>
			</tr>
			<tr>
				<td colspan="2"><input type="text" name="subject" value="<?=htmlspecialchars_decode($subject)?>" /></td>
			</tr>
			<tr>
				<th colspan="2"><?=system_showText(LANG_SITEMGR_LABEL_MESSAGE)?></th>
			</tr>
			<tr>
				<td colspan="2"><textarea name="body" rows="4" cols="0"><?=$body?></textarea></td>
			</tr>
			<tr>
				<td>
					<p><img src="<?=DEFAULT_URL?>/includes/code/captcha.php" border="0" alt="<?=system_showText(LANG_SITEMGR_CAPTCHA_ALT)?>" title="<?=system_showText(LANG_SITEMGR_CAPTCHA_TITLE)?>" /></p>
					<p><input type="text" name="captchatext" value="" class="formCode" /></p>
				</td>
				<td class="complementaryInfo captchaHelp"><?=system_showText(LANG_SITEMGR_CAPTCHA_HELP)?></td>
			</tr>
			<tr>
				<td colspan="2" class="formButton">
					<button class="input-button-form" type="submit" value="Send"><?=system_showText(LANG_SITEMGR_SEND)?></button>
				</td>
			</tr>
		</table>