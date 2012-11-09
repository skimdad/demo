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
	# * FILE: /includes/tables/table_custominvoice.php
	# ----------------------------------------------------------------------------------------------------

?>

<? if(is_numeric($message) && isset($msg_custominvoice[$message])) { ?>
	<p class="<?=(!$error ? 'successMessage' : 'errorMessage')?>"><?=$msg_custominvoice[$message]?></p>
<? } ?>

<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_INVOICETITLE)?></th>
		<th><?=system_showText(LANG_SITEMGR_DATE)?></th>
		<th><?=string_ucwords(system_showText(LANG_SITEMGR_ACCOUNT))?></th>
		<th><?=system_showText(LANG_SITEMGR_STATUS)?></th>
		<th><?=system_showText(LANG_LABEL_SUBTOTAL);?></th>
		<th><?=system_showText(LANG_LABEL_TAX);?></th>
		<th><?=system_showText(LANG_SITEMGR_LABEL_AMOUNT)?></th>
		<th style="width: 12%;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
	</tr>

	<? foreach ($custominvoices as $customInvoice) { ?>

		<?
		$id = $customInvoice->getNumber("id");
		if ($customInvoice->getPrice() > 0) $hascharge = true;
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		// ---------------- //
		$sql = "SELECT payment_log_id FROM Payment_CustomInvoice_Log WHERE custom_invoice_id = $id ORDER BY date DESC LIMIT 1";
		$r = $db->query($sql);
		$aux_transaction_data = mysql_fetch_assoc($r);
		if($aux_transaction_data) {
			$sql = "SELECT id,transaction_datetime FROM Payment_Log WHERE id = {$aux_transaction_data["payment_log_id"]}";
			$r = $db->query($sql);
			$transaction_data = mysql_fetch_assoc($r);
		} else {
			unset($transaction_data);
		}
		// ---------------- //
		$sql = "SELECT IC.invoice_id,IC.custom_invoice_id,I.id,I.status,I.payment_date FROM Invoice I,Invoice_CustomInvoice IC WHERE IC.custom_invoice_id = $id AND I.status = 'R' AND I.id = IC.invoice_id ORDER BY I.payment_date DESC LIMIT 1";
		$r = $db->query($sql);
		$invoice_data = mysql_fetch_assoc($r);
		// ---------------- //
		list($t_month,$t_day,$t_year)     = explode("/",format_date($transaction_data["transaction_datetime"],DEFAULT_DATE_FORMAT,"datetime"));
		list($i_month,$i_day,$i_year)     = explode("/",format_date($invoice_data["payment_date"],DEFAULT_DATE_FORMAT,"datetime"));
		list($t_hour,$t_minute,$t_second) = explode(":",format_date($transaction_data["transaction_datetime"],"H:i:s","datetime"));
		list($i_hour,$i_minute,$i_second) = explode(":",format_date($invoice_data["payment_date"],"H:i:s","datetime"));
		$t_ts_date = mktime((int)$t_hour,(int)$t_minute,(int)$t_second,(int)$t_month,(int)$t_day,(int)$t_year);
		$i_ts_date = mktime((int)$i_hour,(int)$i_minute,(int)$i_second,(int)$i_month,(int)$i_day,(int)$i_year);

		if (PAYMENT_FEATURE == "on") {
			if (((MANUALPAYMENT_FEATURE == "on") || (CREDITCARDPAYMENT_FEATURE == "on")) && (INVOICEPAYMENT_FEATURE == "on")) {
				if($t_ts_date < $i_ts_date){
					if($invoice_data["id"]) $history_lnk = DEFAULT_URL."/sitemgr/invoices/view.php?id=".$invoice_data["id"];
					else unset($history_lnk);
				} else {
					if($transaction_data["id"]) $history_lnk = DEFAULT_URL."/sitemgr/transactions/view.php?id=".$transaction_data["id"];
					else unset($history_lnk);
				}
			} elseif ((MANUALPAYMENT_FEATURE == "on") || (CREDITCARDPAYMENT_FEATURE == "on")) {
				if($transaction_data["id"]) $history_lnk = DEFAULT_URL."/sitemgr/transactions/view.php?id=".$transaction_data["id"];
				else unset($history_lnk);
			} elseif (INVOICEPAYMENT_FEATURE == "on") {
				if($invoice_data["id"]) $history_lnk = DEFAULT_URL."/sitemgr/invoices/view.php?id=".$invoice_data["id"];
				else unset($history_lnk);
			} else {
				unset($history_lnk);
			}
		} else {
			unset($history_lnk);
		}
		?>

		<tr>

			<td>
				<span title="<?=$customInvoice->getString("title")?>" style="cursor:default">
					<?=$customInvoice->getString("title", true, 38);?>
				</span>
			</td>

			<td>
				<span title="<?=format_date($customInvoice->getString("date"))?>" style="cursor:default">
					<?=format_date($customInvoice->getString("date"))?>
				</span>
			</td>

			<td>
				<? $account = db_getFromDB("account", "id", db_formatNumber($customInvoice->getNumber("account_id"))); ?>				
				<a title="<?=$account->getString("username")?>" href="<?=$url_base?>/account/view.php?id=<?=$customInvoice->getNumber("account_id")?>" class="link-table">
					<?=system_showTruncatedText(system_showAccountUserName($account->getString("username")), 40);?>
				</a>				
			</td>

			<td>
				<?
				if ($customInvoice->getString("paid") == "y")
					echo "<span title=\"".system_showText(LANG_SITEMGR_CUSTOMINVOICE_PAID)."\" class=\"status-active\" style=\"cursor:default\">".system_showText(LANG_SITEMGR_CUSTOMINVOICE_PAID)."</span>";
				else
					if ($customInvoice->getString("sent") == "y")
						echo "<span title=\"".system_showText(LANG_SITEMGR_CUSTOMINVOICE_SENT)."\" class=\"status-deactive\" style=\"cursor:default\">".system_showText(LANG_SITEMGR_CUSTOMINVOICE_SENT)."</span>";
					else 
						echo "<span title=\"".system_showText(LANG_SITEMGR_CUSTOMINVOICE_NOTSENT)."\" class=\"status-pending\" style=\"cursor:default\">".system_showText(LANG_SITEMGR_CUSTOMINVOICE_NOTSENT)."</span>";
					?>
			</td>
			
			<td>
				<span title="<?=format_money($customInvoice->getNumber("subtotal"))?>" style="cursor:default">
						<?=format_money($customInvoice->getNumber("subtotal"))?>
				</span>
			</td>

			<td>
				<span title="<?=payment_calculateTax($customInvoice->getNumber("subtotal"), $customInvoice->getNumber("tax"), true, false);?>" style="cursor:default">
						<?=payment_calculateTax($customInvoice->getNumber("subtotal"), $customInvoice->getNumber("tax"), true, false);?>
				</span>
			</td>

			<td>
				<span title="<?=format_money($customInvoice->getPrice())?>" style="cursor:default">
						<?=format_money($customInvoice->getPrice())?>
				</span>
			</td>

			<td>

				<a href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" title="<?=system_showText(LANG_SITEMGR_CLICKTOVIEWTHIS)?> <?=system_showText(LANG_SITEMGR_CUSTOMINVOICE)?>" alt="<?=system_showText(LANG_SITEMGR_CLICKTOVIEWTHIS)?> <?=system_showText(LANG_SITEMGR_CUSTOMINVOICE)?>" />
				</a>

				<? if ($customInvoice->getString("paid") != "y") { ?>
					<a href="<?=$url_redirect?>/custominvoice.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" title="<?=system_showText(LANG_SITEMGR_CLICKTOEDITTHIS)?> <?=system_showText(LANG_SITEMGR_CUSTOMINVOICE)?>" alt="<?=system_showText(LANG_SITEMGR_CLICKTOEDITTHIS)?> <?=system_showText(LANG_SITEMGR_CUSTOMINVOICE)?>" />
					</a>
				<? } else { ?>
					<img src="<?=DEFAULT_URL?>/images/bt_edit_off.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CLICKTOEDITTHIS)?> <?=system_showText(LANG_SITEMGR_CUSTOMINVOICE)?>" title="<?=system_showText(LANG_SITEMGR_CLICKTOEDITTHIS)?> <?=system_showText(LANG_SITEMGR_CUSTOMINVOICE)?>" />
				<? } ?>

				<? if($history_lnk && string_strpos($url_base, "/sitemgr")) { ?>
					<a href="<?=$history_lnk?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/icon_coin.gif" border="0" title="<?=system_showText(LANG_SITEMGR_HISTORYFORTHIS)?> <?=system_showText(LANG_SITEMGR_CUSTOMINVOICE)?>" alt="<?=system_showText(LANG_SITEMGR_HISTORYFORTHIS)?> <?=system_showText(LANG_SITEMGR_CUSTOMINVOICE)?>" />
					</a>
				<? } else { ?>
					<img src="<?=DEFAULT_URL?>/images/icon_coin_off.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_HISTORYNOTAVAILABLEFORTHIS)?> <?=system_showText(LANG_SITEMGR_CUSTOMINVOICE)?>" title="<?=system_showText(LANG_SITEMGR_HISTORYNOTAVAILABLEFORTHIS)?> <?=system_showText(LANG_SITEMGR_CUSTOMINVOICE)?>" />
				<? } ?>

				<? if ($customInvoice->getString("paid") != "y") { ?>
					<a href="<?=$url_redirect?>/send.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_send.gif" border="0" title="<?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_CLICKHERETOSEND)?>" alt="<?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_CLICKHERETOSEND)?>" />
					</a>
				<? } else { ?>
					<img src="<?=DEFAULT_URL?>/images/bt_send_off.gif" border="0" title="<?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_CLICKHERETOSEND)?>" alt="<?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_CLICKHERETOSEND)?>" />
				<? } ?>

			</td>

		</tr>

	<? } ?>

</table>
<? if ((!isset($legend))||($legend)) { ?>
	<ul class="standard-iconDESCRIPTION">
		<li class="view-icon"><?=system_showText(LANG_SITEMGR_VIEW)?></li>
		<li class="edit-icon"><?=system_showText(LANG_SITEMGR_EDIT)?></li>
		<li class="transaction-icon"><?=system_showText(LANG_SITEMGR_PAYMENTRECEIVED)?></li>
		<li class="send-icon"><?=system_showText(LANG_SITEMGR_SEND)?></li>
	</ul>
<? } ?>
