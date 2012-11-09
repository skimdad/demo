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
	# * FILE: /includes/forms/form_twilio.php
	# ----------------------------------------------------------------------------------------------------

?>

<p><?=system_showText(LANG_SITEMGR_TWILIO_MSG1);?> <a href="http://www.twilio.com/pricing/" target="_blank"><?=system_showText(LANG_SITEMGR_TWILIO_MSG2)?></a></p>
<p><?=system_showText(LANG_SITEMGR_TWILIO_MSG3);?></pa>

<? if ($message_twilio) { ?>
	<div id="warning" class="<?=$message_style?>">
		<?=$message_twilio?>
	</div>
<? } ?>

<br />

<table cellpadding="2" cellspacing="0" border="0" class="table-form" width="100%"> 
    <tr class="tr-form">
    	<th colspan="2">
			<div class="header-form"><?=system_showText(LANG_SITEMGR_TWILIO_CONFIGURATION)?></div>
		</th>
    </tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<input type="checkbox" name="twilio_enabled_call" id="twilio_enabled_call" value="on" <?=$twilio_checked_call?>  class="inputCheck" />
		</td>
		<td>
			<div class="label-form" align="left"><label for="twilio_enabled_call"><?=system_showText(LANG_SITEMGR_TWILIO_ENABLE_CLICKCALL);?></label></div>
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<input type="checkbox" name="twilio_enabled_sms" id="twilio_enabled_sms" value="on" <?=$twilio_checked_sms?>  class="inputCheck" />
		</td>
		<td>
			<div class="label-form" align="left"><label for="twilio_enabled_sms"><?=system_showText(LANG_SITEMGR_TWILIO_ENABLE_SENDPHONE);?></label></div>
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<?=system_showText(LANG_SITEMGR_TWILIO_SID)?>:
		</td>
		<td>
			<input type="text" name="twilio_account_sid" value="<?=$twilio_account_sid?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> />
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<?=system_showText(LANG_SITEMGR_TWILIO_AUTHTOKEN)?>:
		</td>
		<td>
			<input type="text" name="twilio_auth_token" value="<?=$twilio_auth_token?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> />
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<?=system_showText(LANG_SITEMGR_TWILIO_NUMBER)?>:
		</td>
		<td>
			<input type="text" name="twilio_number" value="<?=$twilio_number?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> />
			<span>
				<a href="<?=DEFAULT_URL?>/sitemgr/faq/faq.php?keyword=twilio" target="_blank">
					<?=system_showText(LANG_SITEMGR_TWILIO_TIP);?>
				</a>
			</span>
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<?=system_showText(LANG_SITEMGR_TWILIO_CLICK_TO_CALL_MESSAGE)?>:
		</td>
		<td>
			<textarea id="twilio_clicktocall_message" name="twilio_clicktocall_message" rows="5" cols="1" class="input-textarea-form-listing"><?=$twilio_clicktocall_message?></textarea>
			<div id="textAreaCallback_1"></div>	
			<br />
			<span><?=system_showText(LANG_SITEMGR_TWILIO_MESSAGE_TIP)?></span>
			<span><?=system_showText(LANG_SITEMGR_TWILIO_MESSAGE_TIP2)?></span>
		</td>
	</tr>
        
</table>

<script>
	$(document).ready(function(){
		var options = {
					'maxCharacterSize': 160,
					'originalStyle': 'originalTextareaInfo',
					'warningStyle' : 'warningTextareaInfo',
					'warningNumber': 40,
					'displayFormat' : '<span><input readonly="readonly" type="text" id="textAreaMessage_RemLen" name="textAreaMessage_RemLen" size="3" maxlength="3" value="#left" class="textcounter" disabled="disabled" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>' 
		};
		$('#twilio_clicktocall_message').textareaCount(options);
	});
</script>