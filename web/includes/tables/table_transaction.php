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
	# * FILE: /includes/tables/table_transaction.php
	# ----------------------------------------------------------------------------------------------------

?>

<script>
<!--
	function JS_openDetail(id) {
		document.getElementById('info_'+id).style.display = '';
		document.getElementById('img_'+id).innerHTML = '<img style="cursor: pointer; cursor: hand;" src="<?=DEFAULT_URL?>/images/content/img_close.gif" onclick="JS_closeDetail('+id+');" />'
	}
	function JS_closeDetail(id) {
		document.getElementById('info_'+id).style.display = 'none';
		document.getElementById('img_'+id).innerHTML = '<img style="cursor: pointer; cursor: hand;" src="<?=DEFAULT_URL?>/images/content/img_open.gif" onclick="JS_openDetail('+id+');" />'
	}
-->
</script>

<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

	<tr>
		<th>&nbsp;</th>
		<th><?=system_showText(LANG_LABEL_ID);?></th>
		<th><?=system_showText(LANG_LABEL_STATUS);?></th>
		<th><?=system_showText(LANG_LABEL_DATE);?></th>
		<th><?=system_showText(LANG_LABEL_SUBTOTAL);?></th>
		<th><?=system_showText(LANG_LABEL_TAX);?></th>
		<th><?=system_showText(LANG_LABEL_AMOUNT);?></th>
		<? if (string_strpos($url_base, "/sitemgr")) { ?>
			<th><?=system_showText(LANG_LABEL_ACCOUNT);?></th>
		<? } ?>
		<th><?=system_showText(LANG_LABEL_SYSTEM);?></th>
		<th><?=system_showText(LANG_LABEL_OPTIONS)?></th>
	</tr>
	<? 
	foreach ($transactions as $transaction) {

		$str_time = format_getTimeString($transaction["transaction_datetime"]);
		?>
		<tr>
			<? ?> <td><div id="img_<?=$transaction["id"]; ?>"><img style="cursor: pointer; cursor: hand;" src="<?=DEFAULT_URL?>/images/content/img_open.gif" onclick="JS_openDetail('<?=$transaction["id"];?>');" /></div></td> <? ?>
			<td><p title="<?=$transaction["transaction_id"]?>" style="cursor:default"><?=system_showTruncatedText($transaction["transaction_id"], 30)?></p></td>
			<td><span title="<?=@constant(string_strtoupper(("LANG_LABEL_".$transaction["transaction_status"])))?>" style="cursor:default"><?=@constant(string_strtoupper(("LANG_LABEL_".$transaction["transaction_status"])))?></span></td>
			<td><span title="<?=format_date($transaction["transaction_datetime"], DEFAULT_DATE_FORMAT, "datetime")." - ".$str_time?>" style="cursor:default"><?=format_date($transaction["transaction_datetime"], DEFAULT_DATE_FORMAT, "datetime")." - ".$str_time?></span></td>

			<td>
				<?
				if ($transaction["transaction_subtotal"] > 0) $subtotal_field = $transaction["transaction_subtotal"]." (".$transaction["transaction_currency"].")";
				else $subtotal_field = "0.00 (".$transaction["transaction_currency"].")";
				?>
				<span title="<?=$subtotal_field?>" style="cursor:default"><?=$subtotal_field?></span>
			</td>

			<td>
				<?
				if ($transaction["transaction_tax"] > 0) $tax_field = payment_calculateTax($subtotal_field, $transaction["transaction_tax"], true, false)." (".$transaction["transaction_currency"].")";
				else $tax_field = "0.00 (".$transaction["transaction_currency"].")";
				?>
				<span title="<?=$tax_field?>" style="cursor:default"><?=$tax_field?></span>
			</td>

			<td>
				<?
				if ($transaction["transaction_amount"] > 0) $amount_field = $transaction["transaction_amount"]." (".$transaction["transaction_currency"].")";
				else $amount_field = "0.00 (".$transaction["transaction_currency"].")";
				?>
				<span title="<?=$amount_field?>" style="cursor:default"><?=$amount_field?></span>
			</td>

			<? if (string_strpos($url_base, "/sitemgr")) { ?>
				<td>
					<? if ($transaction["account_id"] > 0) {  ?>
						<a title="<?=system_showAccountUserName($transaction["username"])?>" href="<?=$url_base?>/account/view.php?id=<?=$transaction["account_id"]?>" class="link-table">
							<?=system_showTruncatedText(system_showAccountUserName($transaction["username"]), 40);?>
						</a>
					<? } else { ?>
						<span title="<?=system_showAccountUserName($transaction["username"])?>" style="cursor:default">
							<?=system_showTruncatedText(system_showAccountUserName($transaction["username"]), 40);?>
						</span>
					<? } ?>
				</td>
			<? } ?>
			<td>
				<?
				if (($transaction["system_type"] != "simplepay") && ($transaction["system_type"] != "paypal") && ($transaction["system_type"] != "manual") && ($transaction["system_type"] != "pagseguro")) {
					$type_field = system_showText(LANG_CREDITCARD);
				} else {
					$type_field = $transaction["system_type"];
				}
				?>
				<span title="<?=$type_field?>" style="cursor:default"><?=$type_field?></span>
			</td>
			<td>
				<a href="<?=$url_redirect?>/view.php?id=<?=$transaction["id"]?>" class="link-table"><img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_TRANSACTION);?>" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_TRANSACTION);?>" /></a>
			</td>
		</tr>
		<tr id="info_<?=$transaction["id"];?>" style="display:none;">
			<td colspan="10">
			<?php include (INCLUDES_DIR."/views/view_transaction_summary_info.php"); ?>
			</td>
		</tr>
	<? } ?>

</table>
<? if ((!isset($legend))||($legend)) { ?>
	<ul class="standard-iconDESCRIPTION">
		<li class="view-icon"><?=system_showText(LANG_LABEL_VIEW);?></li>
	</ul>
<? } ?>
