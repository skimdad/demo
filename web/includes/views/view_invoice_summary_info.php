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
	# * FILE: /includes/views/view_invoice_summary_info.php
	# ----------------------------------------------------------------------------------------------------

	$id = $invoice["id"];
	$_GET['id'] = $id;
	include(INCLUDES_DIR."/code/invoice.php");

?>

<? if($invoice_listing){ ?>
	<table border="0" cellpadding="2" cellspacing="2" class="standard-innerTable">
		<tr>
			<th class="tableTitle" colspan="3"><p><?=system_showText(LANG_LISTING_FEATURE_NAME_PLURAL);?></p></th>
		</tr>
		<? foreach($invoice_listing as $each_invoice_listing) { ?>
			<tr>
				<th>
					<fieldset title="<?=$each_invoice_listing["listing_title"]?>">
						<?
						$invoiceListingObj = new Listing($each_invoice_listing["listing_id"]);
						if ($invoiceListingObj->getNumber("id") > 0) {
						?>
						<a href="<?=$url_base?>/<?=LISTING_FEATURE_FOLDER;?>/view.php?id=<?=$each_invoice_listing["listing_id"]?>" class="link-table">
							<?= system_showTruncatedText($each_invoice_listing["listing_title"], 60);?>
						</a><?
						} else {
						?>
						<?=system_showTruncatedText($each_invoice_listing["listing_title"], 60);?>
						<?
						}
						?>
					</fieldset>
				</th>
				<td class="infoLevel"><?=string_ucwords($each_invoice_listing["level_label"]);?></td>
				<td class="infoAmount">
				<?=$each_invoice_listing["amount"]." (".$invoice["currency"].")";?>
				</td>
			</tr>
		<? }?>
	</table>
	<br />
<? } ?>

<? if($invoice_event){ ?>
	<table border="0" cellpadding="2" cellspacing="2" class="standard-innerTable">
		<tr>
			<th class="tableTitle" colspan="3"><p><?=system_showText(LANG_EVENT_FEATURE_NAME_PLURAL);?></p></th>
		</tr>
		<? foreach($invoice_event as $each_invoice_event) { ?>
			<tr>
				<th>
					<fieldset title="<?=$each_invoice_event["event_title"]?>">
						<?
						$invoiceEventObj = new Event($each_invoice_event["event_id"]);
						if ($invoiceEventObj->getNumber("id") > 0) {
							?><a href="<?=$url_base?>/<?=EVENT_FEATURE_FOLDER;?>/view.php?id=<?=$each_invoice_event["event_id"]?>" class="link-table">
								<?=system_showTruncatedText($each_invoice_event["event_title"], 60);?>
							</a><?
						} else {
							?><?=system_showTruncatedText($each_invoice_event["event_title"], 60);?><?
						}
						?>
					</fieldset>
				</th>
				<td class="infoLevel"><?=string_ucwords($each_invoice_event["level_label"]);?></td>
				<td class="infoAmount">
					<?=$each_invoice_event["amount"]." (".$invoice["currency"].")";?>
				</td>
			</tr>
		<? }?>
	</table>
	<br />
<? } ?>

<? if($invoice_banner){ ?>
	<table border="0" cellpadding="2" cellspacing="2" class="standard-innerTable">
		<tr>
			<th class="tableTitle" colspan="3"><p><?=system_showText(LANG_BANNER_FEATURE_NAME_PLURAL);?></p></th>
		</tr>
		<? foreach($invoice_banner as $each_invoice_banner) { ?>
			<tr>
				<th>
					<?
					$invoiceBannerObj = new Banner($each_invoice_banner["banner_id"]);
					if ($invoiceBannerObj->getNumber("id") > 0) {
						?><a href="<?=$url_base?>/<?=BANNER_FEATURE_FOLDER;?>/view.php?id=<?=$each_invoice_banner["banner_id"]?>" class="link-table" title="<?=$each_invoice_banner["banner_caption"]?>"><?=$each_invoice_banner["banner_caption"]?></a><?
					} else {
						?><?=$each_invoice_banner["banner_caption"]?><?
					}
					?>
				</th>
				<td class="infoLevel"><?=string_ucwords($each_invoice_banner["level_label"]);?></td>
				<td class="infoAmount">
					<?=$each_invoice_banner["amount"]." (".$invoice["currency"].")";?>
				</td>
			</tr>
		<? }?>
	</table>
	<br />
<? } ?>

<? if($invoice_classified){ ?>
	<table border="0" cellpadding="2" cellspacing="2" class="standard-innerTable">
		<tr>
			<th class="tableTitle" colspan="3"><p><?=system_showText(LANG_CLASSIFIED_FEATURE_NAME_PLURAL);?></p></th>
		</tr>
		<? foreach($invoice_classified as $each_invoice_classified) { ?>
			<tr>
				<th>
					<?
					$invoiceClassifiedObj = new Classified($each_invoice_classified["classified_id"]);
					if ($invoiceClassifiedObj->getNumber("id") > 0) {
						?><a href="<?=$url_base?>/<?=CLASSIFIED_FEATURE_FOLDER;?>/view.php?id=<?=$each_invoice_classified["classified_id"]?>" class="link-table" title="<?=$each_invoice_classified["classified_title"]?>"><?=system_showTruncatedText($each_invoice_classified["classified_title"], 60);?></a><?
					} else {
						?><?=system_showTruncatedText($each_invoice_classified["classified_title"], 60);?><?
					}
					?>
				</th>
				<td class="infoLevel"><?=string_ucwords($each_invoice_classified["level_label"]);?></td>
				<td class="infoAmount">
					<?=$each_invoice_classified["amount"]." (".$invoice["currency"].")";?>
				</td>
			</tr>
		<? }?>
	</table>
	<br />
<? } ?>

<? if($invoice_article){ ?>
	<table border="0" cellpadding="2" cellspacing="2" class="standard-innerTable">
		<tr>
			<th class="tableTitle" colspan="3"><p><?=system_showText(LANG_ARTICLE_FEATURE_NAME_PLURAL);?></p></th>
		</tr>
		<? foreach($invoice_article as $each_invoice_article) { ?>
			<tr>
				<th>
					<?
					$invoiceArticleObj = new Article($each_invoice_article["article_id"]);
					if ($invoiceArticleObj->getNumber("id") > 0) {
					?>
					<a href="<?=$url_base?>/<?=ARTICLE_FEATURE_FOLDER;?>/view.php?id=<?=$each_invoice_article["article_id"]?>" class="link-table" title="<?=$each_invoice_article["article_title"]?>"><?=system_showTruncatedText($each_invoice_article["article_title"], 60);?></a><?
					} else {
					?>
					<?=system_showTruncatedText($each_invoice_article["article_title"], 60);?>
					<?
					}
					?>
				</th>
				<td  class="infoLevel">&nbsp;</td>
				<td  class="infoAmount">
					<?=$each_invoice_article["amount"]." (".$invoice["currency"].")";?>
				</td>
			</tr>
		<? }?>
	</table>
	<br />
<? } ?>

<? if($invoice_custominvoice){ ?>
	<table border="0" cellpadding="2" cellspacing="2" class="standard-innerTable">
		<tr>
			<th class="tableTitle" colspan="3"><p><?=system_showText(LANG_CUSTOM_INVOICES);?></p></th>
		</tr>
		<? foreach($invoice_custominvoice as $each_invoice_custominvoice) { ?>
			<tr>
				<th>
					<?
					$invoiceCustomInvoiceObj = new CustomInvoice($each_invoice_custominvoice["custom_invoice_id"]);
					if ($invoiceCustomInvoiceObj->getNumber("id") > 0) {
						if (string_strpos($url_base, "/sitemgr") !== false) {
							?><a href="<?=$url_base?>/custominvoices/view.php?id=<?=$each_invoice_custominvoice["custom_invoice_id"]?>" class="link-table" title="<?=$each_invoice_custominvoice["title"]?>"><?=system_showTruncatedText($each_invoice_custominvoice["title"], 60);?></a><?
						} else {
							?><?=system_showTruncatedText($each_invoice_custominvoice["title"], 60);?><?
						}
					} else {
						?><?=system_showTruncatedText($each_invoice_custominvoice["title"], 60);?><?
					}
					?>
				</th>
				<td  class="infoLevel"><?=format_date($each_invoice_custominvoice["date"])?></td>
				<td  class="infoAmount">
					<?=$each_invoice_custominvoice["subtotal"]." (".$invoice["currency"].")";?>
				</td>
			</tr>
		<? }?>
	</table>
	<br />
<? } ?>

<? if($invoice_package){ ?>
<table border="0" cellpadding="2" cellspacing="2" class="standard-innerTable">
	<tr>
		<th class="tableTitle" colspan="3"><p><?=system_showText(LANG_PACKAGE_SING);?></p></th>
	</tr>
	<? foreach($invoice_package as $each_invoice_package) { ?>
		<tr>
			<th>
				<?
				$invoicePackageObj = new Package($each_invoice_package["package_id"]);
				if ($invoicePackageObj->getNumber("id") > 0) {
					if (string_strpos($url_base, "/sitemgr") !== false) {
						?><a href="<?=$url_base?>/package/view.php?id=<?=$each_invoice_package["package_id"]?>" class="link-table" title="<?=$each_invoice_package["package_title"]?>"><?=system_showTruncatedText($each_invoice_package["package_title"], 60);?></a><?
					} else {
						?><?=system_showTruncatedText($each_invoice_package["package_title"], 60);?><?
					}
				} else {
					?><?=system_showTruncatedText($each_invoice_package["package_title"], 60);?><?
				}
				?>
			</th>
			<td  class="infoAmount">
				<?=$each_invoice_package["subtotal"]." (".$invoice["currency"].")";?>
			</td>
		</tr>
	<? }?>
</table>
<br />
<? } ?>