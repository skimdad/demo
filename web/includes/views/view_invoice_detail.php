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
	# * FILE: /includes/views/view_invoice_detail.php
	# ----------------------------------------------------------------------------------------------------

?>

<br />

<h2 class="standardSubTitle"><?=system_showText(LANG_INVOICEINFO);?></h2>

	<ul class="general-item">
		<? if(string_strpos($url_base, "/sitemgr")) { ?>
		<li>
		<strong><?=system_showText(LANG_LABEL_ACCOUNT);?>:</strong>
			<? if ($invoice["account_id"]) echo "<a href=\"".$url_base."/account/view.php?id=".$invoice["account_id"]."\">"; ?>
				<?=system_showTruncatedText(system_showAccountUserName($invoice["username"]), 35);?>
			<? if ($invoice["account_id"]) echo "</a>"; ?>
			
		</li>
		<? } ?>

		<?
		$str_time = format_getTimeString($invoice["date"]);
		$invoice_issuingdate = explode(" ",$invoice["date"]);
		$invoice_paymentdate = explode(" ",$invoice["payment_date"]);
		$str_timePaymentDate = format_getTimeString($invoice["payment_date"]);
		?>

		<li><strong><?=system_showText(LANG_LABEL_ID);?>:</strong> <?=$invoice["id"]?><? if (string_strpos($url_base, "/members")) { ?>&nbsp;<a href="<?=DEFAULT_URL?>/members/billing/invoice.php?id=<?=$id?>" class="link-table iframe fancy_window_invoice"><img src="<?=DEFAULT_URL?>/images/icon_print.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_PRINT_INVOICE)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_PRINT_INVOICE)?>" /></a><? } ?></li>
		<li><strong><?=system_showText(LANG_LABEL_STATUS);?>:</strong> <?=$invoice["status"]?></li>
		<li><strong><?=system_showText(LANG_ISSUINGDATE);?>:</strong> <?=$invoice_issuingdate[0]." - ".$str_time?></li>
		<li><strong><?=system_showText(LANG_PAYMENTDATE);?>:</strong> <?=(($invoice["payment_date"]) ? $invoice_paymentdate[0]." - ".$str_timePaymentDate : system_showText(LANG_NONE))?></li>
		<li><strong><?=system_showText(LANG_EXPIREDATE);?>:</strong> <?=$invoice["expire_date"]?></li><li>
		<strong><?=system_showText(LANG_LABEL_IP);?>:</strong> <?=$invoice["ip"]?></li>
		<li><strong><?=system_showText(LANG_LABEL_SUBTOTAL);?>:</strong> <?=$invoice["subtotal"]?> (<?=$invoice["currency"]?>)</li>
		<li><strong><?=system_showText(LANG_LABEL_TAX);?>:</strong> <?=$invoice["tax"]?> (<?=$invoice["currency"]?>)</li>
		<li><strong><?=system_showText(LANG_LABEL_AMOUNT);?>:</strong> <?=$invoice["amount"]?> (<?=$invoice["currency"]?>)</li>
	</ul>

<? if($invoice_listing){ ?>
	<h2 class="standardSubTitle"><?=system_showText(LANG_LISTING_FEATURE_NAME_PLURAL);?></h2>
	<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
		<tr>
			<th><?=system_showText(LANG_LABEL_TITLE);?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_EXTRA_CATEGORY);?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_LEVEL);?></th>
			<? if (PAYMENT_FEATURE == "on") { ?>
				<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
					<th style="width:120px;"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
				<? } ?>
			<? } ?>
			<th style="width:70px;"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_ITEMPRICE);?></th>
		</tr>
		<? foreach($invoice_listing as $each_invoice_listing) { ?>
			<tr>
				<td>
					<?
					$invoiceListingObj = new Listing($each_invoice_listing["listing_id"]);
					if ($invoiceListingObj->getNumber("id") > 0) {
					?>
					<a href="<?=$url_base?>/<?=LISTING_FEATURE_FOLDER;?>/view.php?id=<?=$each_invoice_listing["listing_id"]?>" class="link-table"><?=system_showTruncatedText($each_invoice_listing["listing_title"], 35);?></a>
					<?
					} else {
					?>
					<?=$each_invoice_listing["listing_title"]?>
					<?
					}
					?>
					<?=($each_invoice_listing["listingtemplate"]?"<span class=\"itemNote\">(".$each_invoice_listing["listingtemplate"].")</span>":"");?>
				</td>
				<td><?=$each_invoice_listing["extra_categories"]?></td>
				<td><?=string_ucwords($each_invoice_listing["level_label"]);?></td>
				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<td><?=$each_invoice_listing["discount_id"]?></td>
					<? } ?>
				<? } ?>
				<td><?=$each_invoice_listing["renewal_date"]?></td>
				<td>
					<?=$each_invoice_listing["amount"]." (".$invoice["currency"].")";?>
				</td>
			</tr>
		<? }?>
	</table>
<? } ?>

<? if($invoice_event){ ?>
	<h2 class="standardSubTitle"><?=system_showText(LANG_EVENT_FEATURE_NAME_PLURAL);?></h2>
	<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
		<tr>
			<th><?=system_showText(LANG_LABEL_TITLE);?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_LEVEL);?></th>
			<? if (PAYMENT_FEATURE == "on") { ?>
				<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
					<th style="width:120px;"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
				<? } ?>
			<? } ?>
			<th style="width:70px;"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_ITEMPRICE);?></th>
		</tr>
		<? foreach($invoice_event as $each_invoice_event) { ?>
			<tr>
				<td>
					<?
					$invoiceEventObj = new Event($each_invoice_event["event_id"]);
					if ($invoiceEventObj->getNumber("id") > 0) {
						?><a href="<?=$url_base?>/<?=EVENT_FEATURE_FOLDER;?>/view.php?id=<?=$each_invoice_event["event_id"]?>" class="link-table"><?=system_showTruncatedText($each_invoice_event["event_title"], 35);?></a><?
					} else {
						?><?=system_showTruncatedText($each_invoice_event["event_title"], 35);?><?
					}
					?>
				</td>
				<td><?=string_ucwords($each_invoice_event["level_label"]);?></td>
				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<td><?=$each_invoice_event["discount_id"]?></td>
					<? } ?>
				<? } ?>
				<td><?=$each_invoice_event["renewal_date"]?></td>
				<td>
					<?=$each_invoice_event["amount"]." (".$invoice["currency"].")";?>
				</td>
			</tr>
		<? }?>
	</table>
<? } ?>

<? if($invoice_banner){ ?>
	<h2 class="standardSubTitle"><?=system_showText(LANG_BANNER_FEATURE_NAME_PLURAL);?></h2>
	<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
		<tr>
			<th><?=system_showText(LANG_LABEL_CAPTION)?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_IMPRESSIONS)?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_LEVEL);?></th>
			<? if (PAYMENT_FEATURE == "on") { ?>
				<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
					<th style="width:120px;"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
				<? } ?>
			<? } ?>
			<th style="width:70px;"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_ITEMPRICE);?></th>
		</tr>
		<? foreach($invoice_banner as $each_invoice_banner) { ?>
			<tr>
				<td>
					<?
					$invoiceBannerObj = new Banner($each_invoice_banner["banner_id"]);
					if ($invoiceBannerObj->getNumber("id") > 0) {
						?><a href="<?=$url_base?>/<?=BANNER_FEATURE_FOLDER;?>/view.php?id=<?=$each_invoice_banner["banner_id"]?>" class="link-table"><?=$each_invoice_banner["banner_caption"]?></a><?
					} else {
						?><?=$each_invoice_banner["banner_caption"]?><?
					}
					?>
				</td>
				<td><?=$each_invoice_banner["impressions"]?></td>
				<td><?=string_ucwords($each_invoice_banner["level_label"]);?></td>
				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<td><?=$each_invoice_banner["discount_id"]?></td>
					<? } ?>
				<? } ?>
				<td><?=$each_invoice_banner["renewal_date"]?></td>
				<td>
					<?=$each_invoice_banner["amount"]." (".$invoice["currency"].")";?>
				</td>
			</tr>
		<? }?>
	</table>
<? } ?>

<? if($invoice_classified){ ?>
	<h2 class="standardSubTitle"><?=system_showText(LANG_CLASSIFIED_FEATURE_NAME_PLURAL);?></h2>
	<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
		<tr>
			<th><?=system_showText(LANG_LABEL_TITLE);?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_LEVEL);?></th>
			<? if (PAYMENT_FEATURE == "on") { ?>
				<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
					<th style="width:120px;"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
				<? } ?>
			<? } ?>
			<th style="width:70px;"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_ITEMPRICE);?></th>
		</tr>
		<? foreach($invoice_classified as $each_invoice_classified) { ?>
			<tr>
				<td>
					<?
					$invoiceClassifiedObj = new Classified($each_invoice_classified["classified_id"]);
					if ($invoiceClassifiedObj->getNumber("id") > 0) {
						?><a href="<?=$url_base?>/<?=CLASSIFIED_FEATURE_FOLDER;?>/view.php?id=<?=$each_invoice_classified["classified_id"]?>" class="link-table"><?=system_showTruncatedText($each_invoice_classified["classified_title"], 35);?></a><?
					} else {
						?><?=system_showTruncatedText($each_invoice_classified["classified_title"], 35);?><?
					}
					?>
				</td>
				<td><?=string_ucwords($each_invoice_classified["level_label"]);?></td>
				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<td><?=$each_invoice_classified["discount_id"]?></td>
					<? } ?>
				<? } ?>
				<td><?=$each_invoice_classified["renewal_date"]?></td>
				<td>
					<?=$each_invoice_classified["amount"]." (".$invoice["currency"].")";?>
				</td>
			</tr>
		<? }?>
	</table>
<? } ?>

<? if($invoice_article){ ?>
	<h2 class="standardSubTitle"><?=system_showText(LANG_ARTICLE_FEATURE_NAME_PLURAL);?></h2>
	<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
		<tr>
			<th><?=system_showText(LANG_LABEL_TITLE);?></th>
			<? if (PAYMENT_FEATURE == "on") { ?>
				<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
					<th style="width:120px;"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
				<? } ?>
			<? } ?>
			<th style="width:70px;"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_ITEMPRICE);?></th>
		</tr>
		<? foreach($invoice_article as $each_invoice_article) { ?>
			<tr>
				<td>
					<?
					$invoiceArticleObj = new Article($each_invoice_article["article_id"]);
					if ($invoiceArticleObj->getNumber("id") > 0) {
						?><a href="<?=$url_base?>/<?=ARTICLE_FEATURE_FOLDER;?>/view.php?id=<?=$each_invoice_article["article_id"]?>" class="link-table"><?=system_showTruncatedText($each_invoice_article["article_title"], 35);?></a><?
					} else {
						?><?=system_showTruncatedText($each_invoice_article["article_title"], 35);?><?
					}
					?>
				</td>
				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<td><?=$each_invoice_article["discount_id"]?></td>
					<? } ?>
				<? } ?>
				<td><?=$each_invoice_article["renewal_date"]?></td>
				<td>
					<?=$each_invoice_article["amount"]." (".$invoice["currency"].")";?>
				</td>
			</tr>
		<? }?>
	</table>
<? } ?>

<? if($invoice_custominvoice){ ?>
	<h2 class="standardSubTitle"><?=system_showText(LANG_CUSTOM_INVOICES);?></h2>
	<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
		<tr>
			<th><?=system_showText(LANG_LABEL_TITLE);?></th>
			<th width="120px"><?=system_showText(LANG_LABEL_ITEMS);?></th>
			<th width="70"><?=system_showText(LANG_LABEL_DATE);?></th>
			<th width="100"><?=system_showText(LANG_LABEL_ITEMPRICE);?></th>
		</tr>
		<? foreach($invoice_custominvoice as $each_invoice_custominvoice) { ?>
			<tr>
				<td>
					<?
					$invoiceCustomInvoiceObj = new CustomInvoice($each_invoice_custominvoice["custom_invoice_id"]);
					if ($invoiceCustomInvoiceObj->getNumber("id") > 0) {
						if (string_strpos($url_base, "/sitemgr") !== false) {
							?><a href="<?=$url_base?>/custominvoices/view.php?id=<?=$each_invoice_custominvoice["custom_invoice_id"]?>" class="link-table"><?=system_showTruncatedText($each_invoice_custominvoice["title"], 35);?></a><?
						} else {
							?><?=system_showTruncatedText($each_invoice_custominvoice["title"], 35);?><?
						}
					} else {
						?><?=system_showTruncatedText($each_invoice_custominvoice["title"], 35);?><?
					}
					?>
				</td>
				<?
				if (string_strpos($url_base, "/sitemgr")) {
					$popup_url = DEFAULT_URL."/sitemgr/custominvoices/view_items.php?";
				} else {
					$popup_url = DEFAULT_URL."/popup/popup.php?pop_type=custominvoice_items&";
				}
				?>
				<td><a href="<?=$popup_url?>id=<?=$each_invoice_custominvoice["custom_invoice_id"]?>&items=<?=urlencode($each_invoice_custominvoice["items"])?>&items_price=<?=urlencode($each_invoice_custominvoice["items_price"])?>&view=payment_log" class="link-table iframe fancy_window_custom" style="text-decoration: underline;"><?=system_showText(LANG_VIEWITEMS)?></a></td>
				<td><?=format_date($each_invoice_custominvoice["date"])?></td>
				<td>
					<?=$each_invoice_custominvoice["subtotal"]." (".$invoice["currency"].")";?>
				</td>
			</tr>
		<? }?>
	</table>
<? } ?>

<? if($invoice_package){ ?>
	<h2 class="standardSubTitle"><?=system_showText(LANG_PACKAGE_PLURAL);?></h2>
	<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
		<tr>
			<th><?=system_showText(LANG_LABEL_TITLE);?></th>
			<th width="120px"><?=system_showText(LANG_LABEL_ITEMS);?></th>
			<th width="100"><?=system_showText(LANG_LABEL_ITEMPRICE);?></th>
		</tr>
		<? foreach($invoice_package as $each_invoice_package) { ?>
			<tr>
				<td>
					<?
					$invoicePackageObj = new Package($each_invoice_package["package_id"]);
					if ($invoicePackageObj->getNumber("id") > 0) {
						if (string_strpos($url_base, "/sitemgr") !== false) {
							?><a href="<?=$url_base?>/package/view.php?id=<?=$each_invoice_package["package_id"]?>" class="link-table"><?=system_showTruncatedText($each_invoice_package["package_title"], 35);?></a><?
						} else {
							?><?=system_showTruncatedText($each_invoice_package["package_title"], 35);?><?
						}
					} else {
						?><?=system_showTruncatedText($each_invoice_package["package_title"], 35);?><?
					}
					?>
				</td>
				<?
				if (string_strpos($url_base, "/sitemgr")) {
					$popup_url = DEFAULT_URL."/sitemgr/package/view_items.php?";
				} else {
                    $popup_url = DEFAULT_URL."/popup/popup.php?pop_type=package_items&";
				}
				?>
				<td><a href="<?=$popup_url?>id=<?=$each_invoice_package["package_id"]?>&items=<?=urlencode($each_invoice_package["items"])?>&items_price=<?=urlencode($each_invoice_package["items_price"])?>&view=payment_log" class="link-table iframe fancy_window_custom" style="text-decoration: underline;"><?=system_showText(LANG_VIEWITEMS)?></a></td>
				<td>
					<?=$each_invoice_package["subtotal"]." (".$invoice["currency"].")";?>
				</td>
			</tr>
		<? }?>
	</table>
<? } ?>
