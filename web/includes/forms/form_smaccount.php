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
	# * FILE: /includes/forms/form_smaccount.php
	# ----------------------------------------------------------------------------------------------------

?>

<p class="informationMessage">* <?=system_showText(LANG_LABEL_REQUIRED_FIELD)?></p>

<?  
if ($message_smpassword) { ?>
	<p class="errorMessage"><?=$message_smpassword?></p>
<? } ?>

<? if ($message_smaccount) { ?>
	<? if ($success) { ?>
		<p class="successMessage"><?=$message_smaccount?></p>
	<?} else {?>
		<p class="errorMessage"><?=$message_smaccount?></p>
	<? } ?>
<? } ?>

<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/checkpasswordstrength.js"></script>
<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/checkusername.js"></script>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_SMACCOUNT_ACCOUNTINFORMATION)?></th>
	</tr>

	<tr>
		<th<? if (!$id) { ?> class="alignTop alignWithField"<? } ?>>* <?=system_showText(LANG_SITEMGR_LABEL_USERNAME)?>:</th>
		<td>
			<? if ($id) { ?>
				<?=$username?>
				<input type="hidden" name="username" value="<?=$username?>" />
			<? } else { ?>
				<input type="text" name="username" value="<?=$username?>" maxlength="<?=USERNAME_MAX_LEN?>" class="input-form-account" onblur="checkUsername(this.value, '<?=DEFAULT_URL;?>', 'sitemgr');populateField(this.value,'email');"/>
				<span><?=system_showText(LANG_USERNAME_MSG1)." ".USERNAME_MIN_LEN." ".system_showText(LANG_USERNAME_MSG2)." ".USERNAME_MAX_LEN." ".system_showText(LANG_USERNAME_MSG3)?></span>
				<div id="checkUsername">&nbsp;</div>
			<? } ?>
		</td>
	</tr>

	<tr>
		<? if (string_strpos($_SERVER["PHP_SELF"],"/sitemgr/manageaccount.php")!==false) { ?>
			<th class="alignTop alignWithField"><?=system_showText(LANG_SITEMGR_LABEL_CURRENTPASSWORD)?>:</th>
			<td>
				<input type="password" name="current_password" class="input-form-account" />
				<span><?=system_showText(LANG_SITEMGR_MSG_TYPEYOURPASSWORDIFYOUWANTTOCHANGE)?></span>
			</td>
		<? } ?>
	</tr>

	<tr>
		<th class="alignTop alignWithField">* <?=system_showText(LANG_SITEMGR_LABEL_PASSWORD)?>:</th>
		<td>
			<input type="password" name="password" maxlength="<?=PASSWORD_MAX_LEN?>" class="input-form-account" onkeyup="checkPasswordStrength(this.value, '<?=EDIRECTORY_FOLDER;?>')" />
			<div class="checkPasswordStrength">
				<span><?=system_showText(LANG_LABEL_PASSWORDSTRENGTH);?>:</span>
				<div id="checkPasswordStrength" class="strengthNoPassword">&nbsp;</div>
			</div>
			<span><?=system_showText(LANG_SITEMGR_MSG_PASSWORD_MUST_BE_BETWEEN)?> <?=PASSWORD_MIN_LEN?> <?=system_showText(LANG_SITEMGR_AND)?> <?=PASSWORD_MAX_LEN?> <?=system_showText(LANG_SITEMGR_MSG_CHARACTERS_WITH_NO_SPACES)?></span>
		</td>
	</tr>

	<tr>
		<th>* <?=system_showText(LANG_SITEMGR_LABEL_RETYPEPASSWORD)?>:</th>
		<td><input type="password" name="retype_password" class="input-form-account" /></td>
	</tr>

</table>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_SMACCOUNT_ACCOUNTCONTACTINFORMATION)?></th>
	</tr>

	<tr>
		<th>* <?=system_showText(LANG_SITEMGR_LABEL_NAME)?>:</th>
		<td>
			<input type="text" name="name" value="<?=$name?>" class="input-form-account" />
		</td>
	</tr>

	<tr>
		<th>* <?=system_showText(LANG_SITEMGR_LABEL_PHONE)?>:</th>
		<td>
			<input type="text" name="phone" value="<?=$phone?>" class="input-form-account" />
		</td>
	</tr>

	<tr>
		<th>* <?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>:</th>
		<td>
			<input type="text" id="email" name="email" value="<?=$email?>" class="input-form-account" />
		</td>
	</tr>

	<? if (string_strpos($_SERVER["PHP_SELF"], "/sitemgr/manageaccount.php") === false) { ?>
		<tr>
			<th style="vertical-align: top;"><?=system_showText(LANG_SITEMGR_LABEL_IPRESTRICTION)?>:<br /><span><?=system_showText(LANG_SITEMGR_LABEL_SPAN_OPTIONAL)?></span></th>
			<td>
				<textarea name="iprestriction" rows="5"><?=$iprestriction?></textarea>
				<span><?=system_showText(LANG_SITEMGR_SMACCOUNT_TIP1)?><br /><?=system_showText(LANG_SITEMGR_SMACCOUNT_TIP3)?><br /><?=system_showText(LANG_SITEMGR_SMACCOUNT_TIP4)?></span>
			</td>
		</tr>
	<? } ?>
	<? if ($_SESSION[SESS_SM_ID] != $id || !$_SESSION[SESS_SM_ID]) { ?>
	<tr>
		<th>
			<?=system_showText(LANG_SITEMGR_ENABLE_ACCOUNT)?>:
		</th>
		<td>
			<input type="checkbox" name="active" class="inputCheck" <?=($active=='y'?'checked':($_POST['active']?'checked':''))?> />
		</td>
	</tr>
	<? } else {?>
		<input type="hidden" name="active" value="<?=$active?>" />
	<? } ?>

</table>

	<?
	unset($account_permission);
	if ($_POST["permission"]) {
		$account_permission = $_POST["permission"];
	} elseif ($permission) {
		$account_permission = $permission;
	}
	echo permission_getSMTable($account_permission);
	?>
