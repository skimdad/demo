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
	# * FILE: /includes/forms/form_adminemail.php
	# ----------------------------------------------------------------------------------------------------

?>

<? if ($message_confemail) { ?>
	<div id="warning" class="<?=$message_style?>">
		<?=$message_confemail?>
	</div>
<? }

 if (string_strpos($_SERVER["PHP_SELF"],"domain")===false){
	 $styleButtonClick = "onclick=\"switchAuth(this.value);";
 }
	$styleButtonClick .=" disableButton();\"";
?>

<input type="hidden" name="emailconf_method" value="smtp" />

<table id="form-smtp" cellpadding="2" cellspacing="0" border="0" class="standard-table noMargin">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_SMTPSERVERINFORMATION)?></th>
	</tr>
	<tr>
		<th style="width:140px;"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_LABEL_SERVER)?>:</th>
		<td>
			<input style="width:250px;" type="text" name="emailconf_host" id="host" <? if ($emailconf_host) echo "value=\"$emailconf_host\""; ?> <?=$styleButtonChange?> />&nbsp;<?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_LABEL_PORT)?>:&nbsp;
			<input style="width:55px;" type="text" name="emailconf_port" id="port" <? if ($emailconf_port) echo "value=\"$emailconf_port\""; ?> <?=$styleButtonChange?> />
			<input type="hidden" name="emailconf_protocol" id="protocol" <? if ($emailconf_protocol) echo "value=\"$emailconf_protocol\""; ?> />
		</td>
	</tr>
	<tr>
		<th style="width:140px;"><input class="standard-table-putradio" type="radio" name="emailconf_auth" id="auth1" value="normal" <?=$styleButtonClick?> /></th>
		<td>
		<label for="auth1"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_SERVERREQUIRESAUTHENTICATION1)?></label>
		</td>
	</tr>
	<tr>
		<th style="width:140px;"><input class="standard-table-putradio" type="radio" name="emailconf_auth" id="auth2" value="secure" <?=$styleButtonClick?> /></th>
		<td>
		<label for="auth2"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_SERVERREQUIRESAUTHENTICATION2)?></label></td>
	</tr>
	<tr>
		<th style="width:140px;"><input class="standard-table-putradio" type="radio" name="emailconf_auth" id="auth3" value="noauth" <?=$styleButtonClick?> /></th>
		<td>
		<label for="auth3"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_SERVERREQUIRESAUTHENTICATION3)?></label>
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_EMAILADDRESS)?>:</th>
		<td>
			<input style="width:250px;" type="text" name="emailconf_email" id="email" <? if ($emailconf_email) echo "value=\"$emailconf_email\""; ?> onkeyup="emailChange(this.value)" onkeypress="emailChange(this.value)" onblur="emailBlur(this.form)" <?=$styleButtonChange?> />&nbsp;<span id="email_status" style="display:inline"></span>
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_USERNAME)?>:</th>
		<td>
			<input style="width:250px;" type="text" name="emailconf_username" id="username" <? if ($emailconf_username) echo "value=\"$emailconf_username\""; ?>  <?=$styleButtonChange?> />
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_PASSWORD)?>:</th>
		<td>
			<input style="width:250px;" type="password" name="emailconf_password" id="password"  <?=$styleButtonChange?> />
		</td>
	</tr>
	<tr>
		<th></th>
		<td>
		<div id="response"></div>
		</td>
	</tr>
	<? if (!$step){?>
	<tr>
		<th></th>
		<td><button type="submit" name="bt_submit" id="bt_submit" value="Submit" class="input-button-form<? if ($emailconf_method == 'smtp') { ?> input-button-form-disabled<? } ?>" <? if ($emailconf_method == 'smtp') { ?>disabled="disabled"<? } ?> style="width:200px;"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_SAVECONFIGURATION)?></button></td>
	</tr>
	<? }?>
</table>
