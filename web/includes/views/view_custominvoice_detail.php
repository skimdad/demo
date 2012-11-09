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
	# * FILE: /includes/views/view_custominvoice_detail.php
	# ----------------------------------------------------------------------------------------------------

?>

<br />

<table border="0" cellpadding="2" cellspacing="2" style="width: 525px;" class="standard-tableTOPBLUE">
	<tr>
		<th colspan="2">
			<h1 style="background: none; margin: 5px; padding: 5px;"><?=string_ucwords(system_showText(LANG_SITEMGR_CUSTOMINVOICE))?></h1>
		</th>
	</tr>
	<tr>
		<td width="50%" title="<?=$account->getString("username")?>">
			<p><b><?=system_showText(LANG_SITEMGR_LABEL_ACCOUNT)?>:</b></p><p><?=system_showTruncatedText(system_showAccountUserName($account->getString("username")), 35);?></p>
		</td>
		<td width="50%" title="<?=$customInvoice->getString("title")?>">
			<p><b><?=system_showText(LANG_SITEMGR_TITLE)?>:</b></p><p></p><?=$customInvoice->getString("title", true, 35);?></p>
		</td>
	</tr>
	<tr>
		<td width="50%">
			<p><b><?=system_showText(LANG_SITEMGR_NUMBER)?>:</b></p><p><?=$customInvoice->getString("id")?></p>
		</td>
		<td width="50%">
			<p><b><?=system_showText(LANG_SITEMGR_STATUS)?>:</b></p><p><?=($customInvoice->getString("paid") == "y" ? system_showText(LANG_SITEMGR_CUSTOMINVOICE_PAID) : ($customInvoice->getString("sent") == "y" ? system_showText(LANG_SITEMGR_CUSTOMINVOICE_SENT) : system_showText(LANG_SITEMGR_CUSTOMINVOICE_NOTSENT)))?></p>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="padding-top: 10px;">
			<table border="0" cellspacing="0" cellpadding="0" class="standard-tableTOPBLUE" style="width: 525px;">
				<tr>
					<th style="width: 350px;"><?=system_showText(LANG_SITEMGR_LABEL_ITEM)?></th>
					<th><?=system_showText(LANG_SITEMGR_LABEL_AMOUNT)?></th>
				</tr>
				<?
				$total_custom_invoice_price = 0;
				$custom_invoice_items = $customInvoice->getItems();
				if ($custom_invoice_items) {
					foreach ($custom_invoice_items as $each_custom_invoice_item) {
						?>
						<tr>
							<td><?=$each_custom_invoice_item["description"]?></td>
							<td>
								<?
								if ($each_custom_invoice_item["price"] > 0) {
									echo CURRENCY_SYMBOL." ".format_money($each_custom_invoice_item["price"]);
									$total_custom_invoice_price += $each_custom_invoice_item["price"];
								} else {
									echo system_showText(LANG_SITEMGR_FREE);
								}
								?>
							</td>
						</tr>
						<?
					}
				}
				?>

				<?
				$tax = $customInvoice->getNumber("tax");
				setting_get("payment_tax_status", $taxStatus);
				$subtotal = $total_custom_invoice_price;

				if ($taxStatus == "on" && $customInvoice->getString("paid") == "y")
					$tax = payment_calculateTax($total_custom_invoice_price,$tax,true,false);
				else 
					$tax = 0;
				if ($taxStatus == "on" && $customInvoice->getString("paid") == "y")
					$total_custom_invoice_price = $total_custom_invoice_price + $tax;
				
				if ($taxStatus == "on") {
				?>

				<tr>
					<td class="tdCustomInvoice"><strong><?=string_ucwords(system_showText(LANG_LABEL_SUBTOTAL))?></strong></td>
					<td><?=CURRENCY_SYMBOL." ".format_money($subtotal);?></td>
				</tr>

				<tr>
					<td class="tdCustomInvoice"><strong><?=string_ucwords(system_showText(LANG_LABEL_TAX))?></strong></td>
					<td><?=CURRENCY_SYMBOL." ".format_money($tax);  ?><? if ($customInvoice->getString("paid") != "y")  echo "*" ;?></td>
				</tr>
				<? } ?>
				<tr>
					<td class="tdCustomInvoice"><strong><?=string_ucwords(system_showText(LANG_SITEMGR_PAYMENT_OVERVIEW_TOTALPAYMENTS1))?></strong></td>
					<td><?=CURRENCY_SYMBOL." ".format_money($total_custom_invoice_price);?></td>
				</tr>
				
			</table>
		</td>
	</tr>
</table>