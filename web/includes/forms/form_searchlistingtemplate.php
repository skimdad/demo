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
	# * FILE: /includes/forms/form_searchlistingtemplate.php
	# ----------------------------------------------------------------------------------------------------

?>

<? if ($message_searchlistingtemplate) { ?>
	<div id="warning" class="errorMessage">
		<?=$message_searchlistingtemplate?>
	</div>
<? } ?>
<table cellpadding="2" cellspacing="0" class="table-form">
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_TITLE)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="search_title" value="<?=$search_title?>" class="input-form-searchlisting" />
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_STATUS)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<table style="width: 300px; margin: 0; padding: 0;">
				<tr>
					<td class="td-checkbox"><input type="radio" name="search_status" value="enabled" <? if ($search_status == "enabled") echo "checked"; ?> class="inputCheck" /></td>
					<td><span class="label-field-form"><?=system_showText(LANG_SITEMGR_LABEL_ENABLED)?></span></td>
					<td class="td-checkbox"><input type="radio" name="search_status" value="disabled" <? if ($search_status == "disabled") echo "checked"; ?> class="inputCheck" /></td>
					<td><span class="label-field-form"><?=system_showText(LANG_SITEMGR_LABEL_DISABLED)?></span></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
