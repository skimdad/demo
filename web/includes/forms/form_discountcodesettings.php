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
	# * FILE: /includes/forms/form_discountcodesettings.php
	# ----------------------------------------------------------------------------------------------------

?>

<div class="header-form">
	<?=system_showText(LANG_SITEMGR_MODIFY)?> <?=string_ucwords(LANG_LABEL_DISCOUNTCODE);?> <?=system_showText(LANG_SITEMGR_MENU_SETTINGS)?> - <?=$id?>
</div>

<? if ($message_discountcodesettings) { ?>
	<div id="warning" class="errorMessage">
		<?=$message_discountcodesettings?>
	</div>
<? } ?>

<table cellpadding="2" cellspacing="0" class="table-form table-form-margin">
	<tr class="tr-form">
		<td align="right" class="td-title-form">
			<div class="label-form">
				<?=string_ucwords(system_showText(LANG_SITEMGR_EXPIRATIONDATE))?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="expire_date" id="expire_date" value="<?=$expire_date?>" class="input-form-settings" maxlength="10" />
		</td>
		<td align="left" class="td-form">
			<span class="label-field-form">(<?=format_printDateStandard()?>)</span>
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-title-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_STATUS)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<?=$discountCodeStatusDropDown?>
		</td>
	</tr>
</table>