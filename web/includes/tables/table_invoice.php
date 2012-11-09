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
	# * FILE: /includes/tables/table_invoice.php
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
		<? ?> <th>&nbsp;</th> <? ?>
		<th><?=system_showText(LANG_LABEL_ID);?></th>
		<th><?=system_showText(LANG_LABEL_STATUS);?></th>
		<th><?=system_showText(LANG_LABEL_DATE);?></th>
		<th><?=system_showText(LANG_LABEL_SUBTOTAL);?></th>
		<th><?=system_showText(LANG_LABEL_TAX);?></th>
		<th><?=system_showText(LANG_LABEL_AMOUNT);?></th>
		<? if (string_strpos($url_base, "/sitemgr")) { ?>
			<th><?=system_showText(LANG_LABEL_ACCOUNT);?></th>
		<? } ?>
		<? if (string_strpos($url_base, "/sitemgr")) { ?>
			<th style="width: 3%;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
		<? } else { ?>
			<th style="width: 8%;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
		<? } ?>
	</tr>
	<?

		foreach($invoices as $invoice) { 
		$invoiceStatusObj = new InvoiceStatus();

		$str_time    = format_getTimeString($invoice["date"]);
		$account_id  = $invoice["account_id"];
		$username    = $invoice["username"];
		$id          = $invoice["id"];
		$ip          = $invoice["ip"];
		$date        = format_date($invoice["date"],DEFAULT_DATE_FORMAT, "datetime")." - ".$str_time;
		$status      = $invoiceStatusObj->getStatusWithStyle($invoice["status"]);
		$amount      = $invoice["amount"];
		$subtotal    = $invoice["subtotal_amount"];
		$tax		 = $invoice["tax_amount"];
		$expire_date = format_date($invoice["date"],DEFAULT_DATE_FORMAT, "date");
		$valTax		 = payment_calculateTax($subtotal,$tax,true,false);
	
	?>
	
	<tr>
		<? ?><td><div id="img_<?=$invoice["id"]; ?>"><img style="cursor: pointer; cursor: hand;" src="<?=DEFAULT_URL?>/images/content/img_open.gif" onclick="JS_openDetail('<?=$invoice["id"];?>');" /></div></td> <? ?>
		<td>
			<span title="<?=$id?>" style="cursor:default"><?=$id?></span>
		</td>
		<td>
		<? if($invoice["status"] == "P" && string_strpos($url_base, "/sitemgr")) { ?>
			<a title="<?=$invoiceStatusObj->getStatus($invoice["status"]);?>" href="<?=$url_redirect?>/settings.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table"><?=$status?></a>
		<? } else { ?>			
			<a title="<?=$invoiceStatusObj->getStatus($invoice["status"]);?>" class="link-table"><?=$status?></a>
		<? } ?>
		</td>
		<td>
			<span title="<?=$date?>" style="cursor:default"><?=$date?></span>
		</td>
		
		<td>
			<span title="<?=$subtotal?> (<?=$invoice["currency"]?>)" style="cursor:default"><?=$subtotal?> (<?=$invoice["currency"]?>)</span>
		</td>
		
		<td>
			<span title="<?=$valTax?> (<?=$invoice["currency"]?>)" style="cursor:default"><?=$valTax?> (<?=$invoice["currency"]?>)</span>
		</td>

		<td>
			<span title="<?=$amount?> (<?=$invoice["currency"]?>)" style="cursor:default"><?=$amount?> (<?=$invoice["currency"]?>)</span>
		</td>

		<? if (string_strpos($url_base, "/sitemgr")) { ?>
			<td>
				<? if ($account_id > 0) {  ?>
					<a title="<?=system_showAccountUserName($username)?>" href="<?=$url_base?>/account/view.php?id=<?=$account_id?>" class="link-table">
						<?=system_showTruncatedText(system_showAccountUserName($username), 60);?>
					</a>
				<? } else { ?>
					<span title="<?=system_showAccountUserName($username)?>" style="cursor:default">
						<?=system_showTruncatedText(system_showAccountUserName($username), 60);?>
					</span>
				<? } ?>
			</td>
		<? } ?>

		<td>
			<? if (string_strpos($url_base, "/members")) { ?>
			<a href="<?=DEFAULT_URL?>/members/invoices/view.php?id=<?=$id?>&letter=<?=$letter?>&screen=<?=$screen?>" class="link-table">
			<?} else{?>
			<a href="<?=DEFAULT_URL?>/sitemgr/invoices/view.php?id=<?=$id?>&letter=<?=$letter?>&screen=<?=$screen?>" class="link-table">
			<?}?>
				<img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_INVOICE_DETAIL);?>" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_INVOICE_DETAIL);?>" />
			</a>
			<? if (string_strpos($url_base, "/members")) { ?>
			<a href="<?=DEFAULT_URL?>/members/billing/invoice.php?id=<?=$id?>" class="link-table iframe fancy_window_invoice">
				<img src="<?=DEFAULT_URL?>/images/icon_print.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_PRINT_INVOICE);?>" title="<?=system_showText(LANG_MSG_CLICK_TO_PRINT_INVOICE);?>" />
			</a>
			<? } ?>
		</td>
	</tr>
	<tr id="info_<?=$invoice["id"];?>" style="display:none;">
		<td colspan="9">
		<?php include(INCLUDES_DIR."/views/view_invoice_summary_info.php"); ?>
		</td>
	</tr>
	<? } ?>
</table>

<? if ((!isset($legend))||($legend)) { ?>
	<ul class="standard-iconDESCRIPTION">
		<li class="view-icon"><?=system_showText(LANG_LABEL_VIEW);?></li>
		<? if (string_strpos($url_base, "/members")) { ?>
		<li class="print-icon"><?=system_showText(LANG_LABEL_PRINT);?></li>
		<? } ?>
	</ul>
<? } ?>
