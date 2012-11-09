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
	# * FILE: /includes/tables/table_discountcode.php
	# ----------------------------------------------------------------------------------------------------

?>

<? if(is_numeric($message) && isset($msg_discountcode[$message])) { ?>
    <p class="successMessage"><?=$msg_discountcode[$message]?></p>
<? } ?>

<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_CODE)?></th>
		<th><?=system_showText(LANG_SITEMGR_LABEL_REPEAT)?></th>
		<th><?=system_showText(LANG_SITEMGR_LABEL_EXPIRATION)?></th>
		<th><?=system_showText(LANG_SITEMGR_LABEL_AMOUNT)?></th>
		<th><?=system_showText(LANG_SITEMGR_STATUS)?></th>
		<th width="35"><?=system_showText(LANG_LABEL_OPTIONS)?></td>
	</tr>
	<?
	foreach($discount_codes as $each_discount_code) {
		$id = $each_discount_code->getNumber("id");
		?>
		<? $discountCodeStatusObj = new DiscountCodeStatus();?>

		<tr class="tr-table">
			<td class="td-table">
			<a href="<?=$url_base?>/discountcode/discountcode.php?x_id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?>" class="link-table">
			<b><?=$each_discount_code->getString("id")?></b>
			</a>
			</td>
			<td class="td-table">
			<?=system_showText(@constant('LANG_SITEMGR_'.string_strtoupper($each_discount_code->getString("recurring"))));?>
			</td>
			<td class="td-table">
			<?=format_date($each_discount_code->getString("expire_date"));?>
			</td>
			<td class="td-table">
			<?=(($each_discount_code->getString("type")=="monetary value") ? CURRENCY_SYMBOL : "")?><?=trim(string_ucwords($each_discount_code->getString("amount")));?><?=(($each_discount_code->getString("type")=="percentage") ? "%" : "")?>
			</td>
			<td class="td-table">
			<? $discountCodeStatusObj = new DiscountCodeStatus();?>
			<a href="<?=$url_base?>/discountcode/settings.php?x_id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?>" class="link-table">
			<?=$discountCodeStatusObj->getStatusWithStyle($each_discount_code->getString("status"))?>
			</a>
			</td>
			<td class="td-table">
				<a href="<?=$url_base?>/discountcode/discountcode.php?x_id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CLICKTOEDITTHIS)?> <?=string_ucwords(LANG_LABEL_DISCOUNTCODE);?>" title="<?=system_showText(LANG_SITEMGR_CLICKTOEDITTHIS)?> <?=string_ucwords(LANG_LABEL_DISCOUNTCODE);?>" />
				</a>
				<a href="<?=$url_base?>/discountcode/delete.php?x_id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?>" class="link-table" >
					<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CLICKTOEDITTHIS)?> <?=string_ucwords(LANG_LABEL_DISCOUNTCODE);?>" title="<?=system_showText(LANG_SITEMGR_CLICKTOEDITTHIS)?> <?=string_ucwords(LANG_LABEL_DISCOUNTCODE);?>" />
				</a>
			</td>
		</tr>
	<?
	}
	?>
</table>

<ul class="standard-iconDESCRIPTION">
	<li class="edit-icon"><?=system_showText(LANG_SITEMGR_EDIT)?></li>
	<li class="delete-icon"><?=system_showText(LANG_SITEMGR_DELETE)?></li>
</ul>