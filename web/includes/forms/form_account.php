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
	# * FILE: /includes/forms/form_account.php
	# ----------------------------------------------------------------------------------------------------

	$readonly = "";
	if (DEMO_LIVE_MODE && ($username == "demo@demodirectory.com")) { $readonly = "readonly"; }
	
	if (string_strpos($_SERVER['PHP_SELF'], "/".MEMBERS_ALIAS) === false) { $th_class = " class=\"alignTop alignWithField\""; }
	
?>
<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/checkpasswordstrength.js"></script>
<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/checkusername.js"></script>

<table id="account_info" border="0" cellpadding="2" cellspacing="0" class="standard-table noMargin">

	<? if ((string_strpos($username, "facebook::") === false && string_strpos($username, "openid::") === false && string_strpos($username, "google::") === false) || $sitemgrsection){?>
	
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_ACCOUNT_INFORMATION)?></th>
		</tr>

		<tr>
			<th<?=(($noteditusername) ? "" : $th_class);?>>* <?=system_showText(LANG_LABEL_USERNAME)?>:</th>
			<td>
				<? if ($noteditusername) { ?>
					<input type="hidden" name="username" value="<?=$username?>" />
					<?=system_showAccountUserName($username);?>
				<? } else { ?>
					<input type="text" name="username" <?=($profileAdd ? "id=\"username\"" : "")?> value="<?=$username?>" maxlength="<?=USERNAME_MAX_LEN?>" class="input-form-account" onblur="checkUsername(this.value, '<?=DEFAULT_URL;?>', 'members');populateField(this.value,'email');"/>
					<span><?=system_showText(LANG_USERNAME_MSG1)." ".USERNAME_MIN_LEN." ".system_showText(LANG_USERNAME_MSG2)." ".USERNAME_MAX_LEN." ".system_showText(LANG_USERNAME_MSG3)?></span>
					<div id="checkUsername">&nbsp;</div>
				<? } ?>
			</td>
		</tr>
	
	<? } ?>

	<? if ($foreignaccount != "y") { ?>

		<? if (string_strpos($_SERVER["PHP_SELF"],"/members/account")!==false) { ?>
			<tr>
				<th<?=$th_class;?>><?=system_showText(LANG_LABEL_CURRENT_PASSWORD)?>:</th>
				<td>
					<input type="password" name="current_password" class="input-form-account" <?=$readonly?> />
					<span><?=system_showText(LANG_MSG_TIPE_YOUR_PASSWORD_HERE_IF_YOU_WANT_TO_CHANGE_IT)?></span>
				</td>
			</tr>
		<? } ?>

		<tr>
			<th<?=$th_class;?>>* <?=system_showText(constant("LANG_LABEL_".(string_strpos($_SERVER["PHP_SELF"], "add")?("CREATE_"):"NEW_")."PASSWORD"))?>:</th>
			<td>
				<? if ($noteditpassword) { ?>
					<input type="text" name="password" class="input-form-account" <?=$readonly?> value="<?=($autopw) ? system_generatePassword() : "";?>" />
				<? } else { ?>
					<input type="password" name="password" maxlength="<?=PASSWORD_MAX_LEN?>" class="input-form-account" <?=$readonly?> <?if (PASSWORD_STRENGTH=='on') echo "onkeyup=\"checkPasswordStrength(this.value, '<?=EDIRECTORY_FOLDER;?>')\"";?> />
					<?if (PASSWORD_STRENGTH=='on'){?>
					<div class="checkPasswordStrength">
						<span><?=system_showText(LANG_LABEL_PASSWORDSTRENGTH);?>:</span>
						<div id="checkPasswordStrength" class="strengthNoPassword">&nbsp;</div>
					</div>
					<?}?>
				<? } ?>
				<span><?=system_showText(LANG_MSG_PASSWORD_MUST_BE_BETWEEN)?> <?=PASSWORD_MIN_LEN?> <?=system_showText(LANG_AND)?> <?=PASSWORD_MAX_LEN?> <?=system_showText(LANG_MSG_CHARACTERS_WITH_NO_SPACES)?></span>
			</td>
		</tr>

		<? if ($noteditpassword) { ?>
			<? if ($notification) {?>
				<tr>
					<th><input type="checkbox" name="sendmail" <?=($sendmail=='on' ? "checked" : "")?> /></th>
					<td><?=system_showText(LANG_MSG_PASSWORD_SENT_TO_MEMBER_EMAIL)?></td>
				</tr>
			<? } ?>
		<? } else { ?>
			<tr>
				<th>* <?=system_showText(constant("LANG_LABEL_RETYPE_".(string_strpos($_SERVER["PHP_SELF"], "add")?"":"NEW_")."PASSWORD"))?>:</th>
				<td><input type="password" name="retype_password" class="input-form-account" <?=$readonly?> /></td>
			</tr>
		<? } ?>

		<? if (!$sitemgrsection) { ?>
			<tr>
				<th><img src="<?=DEFAULT_URL?>/images/icon_atention.gif" width="16" height="14" alt="Attention" title="Attention" /></th>
				<td><?=system_showText(LANG_MSG_WRITE_DOWN_YOUR_USERNAME_PASSWORD)?></td>
			</tr>
		<? } ?>

		<? if (!$noteditagree) { ?>
			<tr>
				<th><input type="checkbox" name="agree_tou" value="1" <?=($agree_tou) ? "checked" : ""?> class="standard-table-putradio" /></th>
				<td>* <a href="<?=DEFAULT_URL?>/popup/popup.php?pop_type=terms" class="iframe fancy_window_terms"><?=system_showText(LANG_IGREETERMS)?></a></td>
			</tr>
		<? } ?>

	<? } ?>

</table>