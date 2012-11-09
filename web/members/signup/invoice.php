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
	# * FILE: /members/signup/invoice.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if (INVOICEPAYMENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	$url_redirect = "".DEFAULT_URL."/members/signup";
	$url_base = "".DEFAULT_URL."/members";
	$members = 1;
	$is_listing = false;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$itemCount = 0;

	$listingsToPay = db_getFromDB("listing", "account_id", $acctId, "", "title", "array", false, true);
	foreach ($listingsToPay as $listingToPay) {
		$listing_id[] = $listingToPay["id"];
		$itemCount++;
		$is_listing = true;
	}

	if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
		$eventsToPay = db_getFromDB("event", "account_id", $acctId, "", "title", "array", false, true);
		foreach ($eventsToPay as $eventToPay) {
			$event_id[] = $eventToPay["id"];
			$itemCount++;
		}
	}

	if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") {
		$bannersToPay = db_getFromDB("banner", "account_id", $acctId, "", "caption".EDIR_DEFAULT_LANGUAGENUMBER, "array", false, true);
		foreach ($bannersToPay as $bannerToPay) {
			$banner_id[] = $bannerToPay["id"];
			$itemCount++;
		}
	}

	if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
		$classifiedsToPay = db_getFromDB("classified", "account_id", $acctId, "", "title", "array", false, true);
		foreach ($classifiedsToPay as $classifiedToPay) {
			$classified_id[] = $classifiedToPay["id"];
			$itemCount++;
		}
	}

	if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
		$articlesToPay = db_getFromDB("article", "account_id", $acctId, "", "title", "array", false, true);
		foreach ($articlesToPay as $articleToPay) {
			$article_id[] = $articleToPay["id"];
			$itemCount++;
		}
	}

	setting_get("payment_tax_status", $payment_tax_status);
	setting_get("payment_tax_value", $payment_tax_value);
	customtext_get("payment_tax_label", $payment_tax_label, EDIR_LANGUAGE);

	$second_step = 1;
	$payment_method = "invoice";

	if ($itemCount == 1 || $ispackage == "true") include(INCLUDES_DIR."/code/billing.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

?>

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<ul class="standardStep invoiceStep">
			<li class="standardStepAD"><?=system_showText(LANG_LABEL_EASY_AND_FAST);?> <span><?=system_showText(LANG_THREESTEPS)?> &raquo;</span></li>
			<li class="stepDone"><span>1</span>&nbsp;<?=system_showText(LANG_LABEL_ORDER)?></li>
			<li class="stepActived"><span>2</span>&nbsp;<?=system_showText(LANG_LABEL_CHECKOUT)?></li>
			<li><span>3</span>&nbsp;<?=system_showText(LANG_LABEL_CONFIGURATION)?></li>
		</ul>
        
	<div class="extendedContent spaSpaceContent">

		<h2><?=system_showText(LANG_LABEL_PAY_BY_INVOICE)?></h2>

		<? if ($paymentSystemError) { ?>

			<p class="errorMessage">
				<?=$payment_message?><br />
				<a href="<?=DEFAULT_URL?>/members/billing/index.php"><?=system_showText(LANG_MSG_GO_TO_MEMBERS_CHECKOUT);?></a>.
			</p>

		<? } elseif ($payment_message) { ?>

			<p class="errorMessage">
				<?=system_showText(LANG_MSG_PROBLEMS_WERE_FOUND)?>:<br />
				<?=$payment_message?><br />
				<a href="<?=DEFAULT_URL?>/members/billing/index.php"><?=system_showText(LANG_MSG_GO_TO_MEMBERS_CHECKOUT);?></a>.
			</p>

		<? } elseif ((!$bill_info["listings"]) && (!$bill_info["events"]) && (!$bill_info["banners"]) && (!$bill_info["classifieds"]) && (!$bill_info["articles"])) { ?>

			<?
			if ($itemCount > 1) echo "<p class=\"informationMessage\">Already registered users should use <a href=\"".DEFAULT_URL."/members/billing/index.php\">members check out area</a>.</p>";
			else echo "<p class=\"informationMessage\">".system_showText(LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT)."</p>";
			?>

		<? } else { ?>

			<?
			/**************************************************************************************************/
			/*                                                                                                */
			/* E-mail notify                                                                                  */
			/*                                                                                                */
			/**************************************************************************************************/
		
			if ($bill_info["listings"]) {
				$listing = new Listing($_POST);
			} elseif ($bill_info["events"]) {
				$event = new Event($_POST);
			} elseif ($bill_info["banners"]) {
				$banner = new Banner($_POST);
			} elseif ($bill_info["classifieds"]) {
				$classified = new Classified($_POST);
			} elseif ($bill_info["articles"]) {
				$article = new Article($_POST);
			}
			
			setting_get("sitemgr_email",$sitemgr_email);
			$contact = new Contact($acctId);
			//$body = "Dear ".$contact->getString("first_name")." ".$contact->getString("last_name").",\n".system_showText(LANG_MSG_YOU_CAN_SEE_INVOICE)." ".DEFAULT_URL."/members/billing/invoice.php?id=".$bill_info["invoice_number"];
			//system_mail($contact->getString("email"), "[".EDIRECTORY_TITLE."] Invoice Notification", $body, EDIRECTORY_TITLE." <$sitemgr_email>", 'text/plain', '', '', $error);
			
			// sending e-mail to user //////////////////////////////////////////////////////////////////////////
			if ($emailNotificationObj = system_checkEmail(SYSTEM_INVOICE_NOTIFICATION, $contact->getString("lang"))) {
				$subject = $emailNotificationObj->getString("subject");
				$body = $emailNotificationObj->getString("body");		
				$aux = explode("ACCOUNT_NAME",$body);
				$body = $aux[0].$contact->getString("first_name")." ".$contact->getString("last_name").$aux[1];
				$aux2 = explode("DEFAULT_URL",$body);
				$body = $aux2[0].DEFAULT_URL."/members/billing/invoice.php?id=".$bill_info["invoice_number"]."\n".$aux2[1];
				
				if ($bill_info["listings"]) {
					$body = system_replaceEmailVariables($body, $listing->getNumber('id'), 'listing');
					$subject = system_replaceEmailVariables($subject, $listing->getNumber('id'), 'listing');	
				} elseif ($bill_info["events"]) {
					$body = system_replaceEmailVariables($body, $event->getNumber('id'), 'event');
					$subject = system_replaceEmailVariables($subject, $event->getNumber('id'), 'event');	
				} elseif ($bill_info["banners"]) {
					$body = system_replaceEmailVariables($body, $banner->getNumber('id'), 'banner');
					$subject = system_replaceEmailVariables($subject, $banner->getNumber('id'), 'banner');	
				} elseif ($bill_info["classifieds"]) {
					$body = system_replaceEmailVariables($body, $classified->getNumber('id'), 'classified');
					$subject = system_replaceEmailVariables($subject, $classified->getNumber('id'), 'classified');	
				} elseif ($bill_info["articles"]) {
					$body = system_replaceEmailVariables($body, $article->getNumber('id'), 'article');
					$subject = system_replaceEmailVariables($subject, $article->getNumber('id'), 'article');	
				}
				
				$body = html_entity_decode($body);
				$subject = html_entity_decode($subject);
				system_mail($contact->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
			}
			
			
			////////////////////////////////////////////////////////////////////////////////////////////////////
			?>

			<?
			$invoiceObj = new Invoice($bill_info["invoice_number"]);
			$invoiceObj->setString("status", "P");
			$invoiceObj->Save();
			?>

			<?
				if ($bill_info["listings"]) foreach ($bill_info["listings"] as $id => $info);
				if ($bill_info["events"]) foreach ($bill_info["events"] as $id => $info);
				if ($bill_info["banners"]) foreach ($bill_info["banners"] as $id => $info);
				if ($bill_info["classifieds"]) foreach ($bill_info["classifieds"] as $id => $info);
				if ($bill_info["articles"]) foreach ($bill_info["articles"] as $id => $info);
			?>

			<table class="standard-tableTOPBLUE">
				<tr>

					<th style="text-align:center"><?=system_showText(LANG_LABEL_INVOICENUMBER);?></th>

					<th>
						<? if ($ispackage == "true" && $auxitem_name) echo system_showText(LANG_LABEL_ITEMS);
						else {
							if ($bill_info["listings"]) {
								echo system_showText(LANG_LISTING_FEATURE_NAME);
							} elseif ($bill_info["events"]) {
								echo system_showText(LANG_EVENT_FEATURE_NAME);
							} elseif ($bill_info["banners"]) {
								echo system_showText(LANG_BANNER_FEATURE_NAME);
							} elseif ($bill_info["classifieds"]) {
								echo system_showText(LANG_CLASSIFIED_FEATURE_NAME);
							} elseif ($bill_info["articles"]) {
								echo system_showText(LANG_ARTICLE_FEATURE_NAME);
							}
						}
						?>
					</th>

					<th><?=system_showText(LANG_LABEL_LEVEL);?></th>

					<? if (($bill_info["listings"]) && $info["extra_category_amount"]>0) { ?>
						<th><?=system_showText(LANG_LABEL_EXTRA_CATEGORY);?></th>
					<? } ?>

					<?
					if (PAYMENT_FEATURE == "on" && $info["discount_id"]) {
						if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) {
							?><th><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th><?
						}
					}
					?>

					<? if ($bill_info["banners"]) { ?>
						<th><?=system_showText(LANG_LABEL_EXPIRATION);?></th>
					<? } ?>

					<? if ($payment_tax_status == "on" || ($ispackage == "true" && $auxitem_name)) { ?>
						<th><?=(($ispackage == "true" && $auxitem_name) ? system_showText(LANG_LABEL_PRICE_PLURAL) : system_showText(LANG_SUBTOTAL));?></th>
					<? } ?>

					<? if ($payment_tax_status == "on" && $ispackage != "true") { ?>
						<th><?=$payment_tax_label."(".$payment_tax_value."%)";?></th>
					<? } ?>

					<?if ($ispackage != "true") {?>
					<th><?=system_showText(LANG_LABEL_TOTAL);?></th>
					<? } ?>

				</tr>

				<tr>

					<td width="65" style="text-align:center; font-weight:bold;"><?=$bill_info["invoice_number"]?></td>

					<td style="font-weight:bold">
						<?
						if ($bill_info["banners"]) {
							echo $info["caption"];
						} else {
							echo $info["title"];
						}
						?>
						<?=($info["listingtemplate"]?"<span class=\"itemNote\">(".$info["listingtemplate"].")</span>":"");?>
					</td>

					<td><?=string_ucwords($info["level"])?></td>

					<? if (($bill_info["listings"]) && $info["extra_category_amount"] > 0) { ?>
						<td style="text-align:center;"><?=$info["extra_category_amount"];?></td>
					<? } ?>

					<?
					if (PAYMENT_FEATURE == "on" && $info["discount_id"]) {
						if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) {
							?><td style="text-align:center;"><?=($info["discount_id"]) ? $info["discount_id"] : system_showText(LANG_NA);?></td><?
						}
					}
					?>

					<? if ($bill_info["banners"]) { ?>
						<td>
							<?
							if ($info["expiration_setting"] == BANNER_EXPIRATION_RENEWAL_DATE) echo system_showText(LANG_LABEL_BY_PERIOD);
							elseif ($info["expiration_setting"] == BANNER_EXPIRATION_IMPRESSION) echo system_showText(LANG_LABEL_BY_IMPRESSIONS);
							?>
						</td>
					<? } ?>

					<? if ($payment_tax_status == "on" || ($ispackage == "true" && $auxitem_name)) { ?>
						<td><?=CURRENCY_SYMBOL." ".($aux_package_total > 0 ? format_money($bill_info["total_bill"]-$aux_package_total) : $bill_info["total_bill"]);?></td>
					<? } ?>

					<? if ($payment_tax_status == "on" && $ispackage != "true" ) { ?>
						<td><?=CURRENCY_SYMBOL." ".payment_calculateTax($bill_info["total_bill"], $payment_tax_value, true, false);?></td>
					<? } ?>

					<? if ($ispackage != "true") {?>
					<td>
						<?
							if ($payment_tax_status == "on") echo CURRENCY_SYMBOL." ".payment_calculateTax($bill_info["total_bill"], $payment_tax_value, true);
							else echo CURRENCY_SYMBOL." ".$bill_info["total_bill"];
						?>
					</td>
					<? } ?>

				</tr>

				<? if ($ispackage == "true" && $auxitem_name) {?>
					<tr>
						<td width="65" style="text-align:center; font-weight:bold;"><?=$bill_info["invoice_number"]?></td>
						<td style="font-weight:bold"><?=($auxpackage_name != $item_name? $auxpackage_name." - ".$item_name." ".$item_levelName: $auxpackage_name)?></td>
						<td><?=$auxlevel_names?></td>
						<? if (($bill_info["listings"]) && $info["extra_category_amount"] > 0) { ?>
						<td style="text-align:center;">&nbsp;</td>
						<? } ?>
						<?
						if (PAYMENT_FEATURE == "on" && $info["discount_id"]) {
							if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) {
								?><td style="text-align:center;">&nbsp;</td><?
							}
						}
						?>
						<? if ($bill_info["banners"]) { ?>
							<td>&nbsp;</td>
						<? } ?>
						<? if ($payment_tax_status == "on" || $ispackage == "true") { ?>
							<td><?=$aux_package_item_price;?></td>
						<? } ?>

						<? if ($payment_tax_status == "on" && $ispackage != "true") { ?>
							<td><?=CURRENCY_SYMBOL." ".payment_calculateTax($bill_info["total_bill"], $payment_tax_value, true, false);?></td>
						<? } ?>

						<? if ($ispackage != "true") {?>
						<td>
							<?
								if ($payment_tax_status == "on") echo CURRENCY_SYMBOL." ".payment_calculateTax($bill_info["total_bill"], $payment_tax_value, true);
								else echo CURRENCY_SYMBOL." ".$bill_info["total_bill"];
							?>
						</td>
						<? } ?>
				</tr>
				<? } ?>

				
			</table>
			<? if ($ispackage == "true" && $auxitem_name) { ?>

				<table class="standard-tableTOPBLUE">
					<? if ($payment_tax_status || $bill_info["tax_amount"] > 0) { ?>
						<tr>
							<th width="340" style="text-align:right"><?=system_showText(LANG_SUBTOTALAMOUNT);?> &nbsp;</th>
							<td>
								<?=CURRENCY_SYMBOL.$bill_info["total_bill"];?>
							</td>
						</tr>
						<tr>
							<th width="340" style="text-align:right"><?=$payment_tax_label."(".$bill_info["tax_amount"]."%)";?> &nbsp;</th>
							<td>
								<?=CURRENCY_SYMBOL.payment_calculateTax($bill_info["total_bill"], $bill_info["tax_amount"], true, false);?>
							</td>
						</tr>
					<? } ?>
					<tr>
						<th width="340" style="text-align:right"><?=system_showText(LANG_LABEL_TOTAL_PRICE);?> &nbsp;</th>
						<td>
							<?=CURRENCY_SYMBOL.format_money($bill_info["amount"]);?>
						</td>
					</tr>
				</table>
			
			<? } ?>
			<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
				<tr>
					<th class="standard-tabletitle" colspan="2"><?=system_showText(LANG_LABEL_MAKE_CHECKS_PAYABLE)?></th>
				</tr>
				<tr>
					<th><?=system_showText(LANG_LABEL_MAKE_CHECKS_PAYABLE)?>:</th>
					<td><strong><?=EDIRECTORY_TITLE?></strong></td>
				</tr>
				<tr>
					<th>&nbsp;</th>
					<td>
						<ul class="basePrintNavbar">
							<li>
								<a href="<?=DEFAULT_URL?>/members/billing/invoice.php?id=<?=$bill_info["invoice_number"]?>" class="iframe fancy_window_invoice"><?=system_showText(LANG_MSG_CLICK_TO_PRINT_INVOICE)?></a>
							</li>
						</ul>
					</td>
				</tr>
				<tr>
					<th><input type="checkbox" name="terms" id="terms" value="1" /></th>
					<td>* <a href="<?=DEFAULT_URL?>/popup/popup.php?pop_type=terms" class="iframe fancy_window_terms"><?=system_showText(LANG_MSG_AGREE_TO_TERMS);?></a> <?=system_showText(LANG_MSG_I_WILL_SEND_PAYMENT);?></td>
				</tr>
			</table>

			<p class="standardButton paymentButton">
				<a href="javascript:next();"><?=system_showText(LANG_LABEL_PLACE_ORDER_CONTINUE)?></a>
			</p>

			<?
			if ($bill_info["listings"]) {
				$thisListingID = array_keys($bill_info["listings"]);
				$next = DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER."/listing.php?id=".$thisListingID[0]."&process=signup";
			} elseif ($bill_info["events"]) {
				$thisEventID = array_keys($bill_info["events"]);
				$next = DEFAULT_URL."/members/".EVENT_FEATURE_FOLDER."/event.php?id=".$thisEventID[0]."&process=signup";
			} elseif ($bill_info["banners"]) {
				$thisBannerID = array_keys($bill_info["banners"]);
				$next = DEFAULT_URL."/members/".BANNER_FEATURE_FOLDER."/edit.php?id=".$thisBannerID[0]."&process=signup";
			} elseif ($bill_info["classifieds"]) {
				$thisClassifiedID = array_keys($bill_info["classifieds"]);
				$next = DEFAULT_URL."/members/".CLASSIFIED_FEATURE_FOLDER."/classified.php?id=".$thisClassifiedID[0]."&process=signup";
			} elseif ($bill_info["articles"]) {
				$thisArticleID = array_keys($bill_info["articles"]);
				$next = DEFAULT_URL."/members/".ARTICLE_FEATURE_FOLDER."/article.php?id=".$thisArticleID[0]."&process=signup";
			}
			?>

			<script language="javascript" type="text/javascript">
				<!--

				function next() {
					if (document.getElementById("terms").checked){
                        document.location="<?=$next?>";
                    } else {
                        fancy_alert('<?=system_showText(LANG_MSG_ALERT_AGREE_WITH_TERMS_OF_USE);?>', 'informationMessage', false, 500, 100, false);
					}
				}

				//-->
			</script>

		<? } ?>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
