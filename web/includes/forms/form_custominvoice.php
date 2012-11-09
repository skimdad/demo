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
	# * FILE: /includes/forms/form_custominvoice.php
	# ----------------------------------------------------------------------------------------------------

?>

<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>

<p class="informationMessage">* <?=system_showText(LANG_SITEMGR_LABEL_REQUIREDFIELD)?></p>

<? if ($error) { ?>
	<p class="errorMessage"><?=$error?></p>
<? } ?>

<table border="0" cellpadding="2" cellspacing="2" class="standard-table">
	<tr>
		<th class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_INFORMATION)?></th>
	</tr>
</table>

<?=$accts?>

<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
	<tr>
		<th style="width:105px;">* <?=system_showText(LANG_SITEMGR_TITLE)?>:</th>
		<td><input type="text" name="title" value="<?=$title?>" maxlength="100" /></td>
	</tr>
</table>

<table border="0" cellpadding="2" cellspacing="2" class="standard-table">
	<tr>
		<th class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_ITEMS)?></th>
	</tr>
</table>

<p style="margin-left: 12px;">
	<strong><?=system_showText(LANG_SITEMGR_LABEL_NOTE)?>: </strong><?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_MSG_DEFAULTPRICE)?>
</p>

<table border="0" cellpadding="2" cellspacing="2" class="standard-table Minit">
	<? if (CUSTOM_INVOICE_ITEMS_NUMBER > 0) { ?>
		<tr>
			<th>&nbsp;</th>
			<th style="text-align: left; width: 370px;"><?=system_showText(LANG_SITEMGR_LABEL_DESCRIPTION)?> <?=system_showText(LANG_SITEMGR_LABEL_MAX255CHARS)?></th>
			<th style="text-align: left; white-space: nowrap;"><?=system_showText(LANG_SITEMGR_LABEL_PRICE)?> (<?=CURRENCY_SYMBOL?>)</th>
		</tr>
		<? for ($i=0; $i < CUSTOM_INVOICE_ITEMS_NUMBER; $i++) { ?>
			<tr>
				<th><?=system_showText(LANG_SITEMGR_LABEL_ITEM)?> <?=$i+1?>:</th>
				<td style="text-align: left; white-space: nowrap; width:40%"><input type="text" name="item_desc[]" value="<?=$item_desc[$i]?>" style="width: 360px; margin-right:0; padding-right: 0; text-align:left;" maxlength="255" /></td>
				<td style="text-align: left; white-space: nowrap; width:40%"><input type="text" name="item_price[]" value="<?=$item_price[$i]?>" style="width: 50px;" /></td>
			</tr>
		<? } ?>
	<? } ?>
</table>
