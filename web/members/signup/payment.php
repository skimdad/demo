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
	# * FILE: /members/signup/payment.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on")) { exit; }

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
		
		$langIndex = language_getIndex(EDIR_LANGUAGE);
		$arrLangs = explode(",", EDIR_LANGUAGENUMBERS);
		$endExpr = ")";

		if (count($arrLangs) > 1) {
			$fields .= "*, IF (`caption".$langIndex."` != '', `caption".$langIndex."`, ";
			foreach ($arrLangs as $lang) {
				if ($langIndex != $lang) {
					$fields .= "IF (`caption".$lang."` != '', `caption".$lang."`, ";
					$endExpr .= ")";
				}
			}

			$fields .= "''".$endExpr." AS `caption`";
		} else {
			$fields = "*, `caption".$langIndex."` AS `caption`";
		}
		
		$bannersToPay = db_getFromDB("banner", "account_id", $acctId, "", "caption", "array", false, true, $fields);
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

	if ($itemCount == 1 || $ispackage == "true") include(INCLUDES_DIR."/code/billing.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");
    
?>

	<div class="extendedContent">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
		
		<ul class="standardStep">
			<li class="standardStepAD"><?=system_showText(LANG_LABEL_EASY_AND_FAST);?> <span><?=system_showText(LANG_THREESTEPS)?> &raquo;</span></li>
			<li class="stepDone"><span>1</span>&nbsp;<?=system_showText(LANG_LABEL_ORDER)?></li>
			<li class="stepActived"><span>2</span>&nbsp;<?=system_showText(LANG_LABEL_CHECKOUT)?></li>
			<li><span>3</span>&nbsp;<?=system_showText(LANG_LABEL_CONFIGURATION)?></li>
		</ul>

	</div>

	<div class="extendedContent">

		<h2><?=system_showText(LANG_MENU_MAKEPAYMENT);?></h2>
		

		<? if ($paymentSystemError) { ?>

			<p class="errorMessage">
				<?=$payment_message?><br />
				<a href="<?=DEFAULT_URL?>/members/billing/index.php"><?=system_showText(LANG_MSG_GO_TO_MEMBERS_CHECKOUT);?></a>.
			</p>

		<? } elseif ($payment_message) {?>

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

			<table class="standard-tableTOPBLUE">

				<tr>

					<th>
						<?  $showName = true;
							if ($ispackage == "true" && $auxitem_name) {
                                echo system_showText(LANG_LABEL_ITEMS);
                                $showName = false;
							}

							if ($bill_info["listings"]) {
								foreach ($bill_info["listings"] as $id => $info);
								if ($showName) echo system_showText(LANG_LISTING_FEATURE_NAME);
							} elseif ($bill_info["events"]) {
								foreach ($bill_info["events"] as $id => $info);
								if ($showName) echo system_showText(LANG_EVENT_FEATURE_NAME);
							} elseif ($bill_info["banners"]) {
								foreach ($bill_info["banners"] as $id => $info);
								if ($showName) echo system_showText(LANG_BANNER_FEATURE_NAME);
							} elseif ($bill_info["classifieds"]) {
								foreach ($bill_info["classifieds"] as $id => $info);
								if ($showName) echo system_showText(LANG_CLASSIFIED_FEATURE_NAME);
							} elseif ($bill_info["articles"]) {
								foreach ($bill_info["articles"] as $id => $info);
								if ($showName) echo system_showText(LANG_ARTICLE_FEATURE_NAME);
							}

						?>
					</th>

					<th><?=system_showText(LANG_LABEL_LEVEL);?></th>

					<? if (($bill_info["listings"]) && $info["extra_category_amount"]>0) { ?>
						<th><?=system_showText(LANG_LABEL_EXTRA_CATEGORY);?></th>
					<? } ?>

					<?
					if ((PAYMENT_FEATURE == "on") && $info["discount_id"]) {
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
					<? if ($ispackage != "true") { ?>
					<th><?=system_showText(LANG_LABEL_TOTAL);?></th>
					<? } ?>

				</tr>

				<tr>
					<td>
						<strong>
							<?
							if ($bill_info["banners"]) {
								echo $info["caption"];
							} else {
								echo $info["title"];
							}
							?>
							<?=($info["listingtemplate"]?"<span class=\"itemNote\">(".$info["listingtemplate"].")</span>":"");?>
						</strong>
					</td>

					<td><?=string_ucwords($info["level"])?></td>

					<? if (($bill_info["listings"]) && $info["extra_category_amount"] > 0) { ?>
						<td><?=$info["extra_category_amount"];?></td>
					<? } ?>

					<?
					if ((PAYMENT_FEATURE == "on") && $info["discount_id"]) {
						if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) {
							?><td><?=($info["discount_id"]) ? $info["discount_id"] : system_showText(LANG_NA);?></td><?
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
						<td style="font-weight:bold"><?=($auxpackage_name != $item_name? $auxpackage_name." - ".$item_name." ".$item_levelName: $auxpackage_name)?><br /><?=$auxdomains_names?></td>
						<td><br /><?=$auxlevel_names?></td>
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
							<td><br /><?=$aux_package_item_price;?></td>
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

			<?
			$payment_process = "signup";
			if (file_exists(INCLUDES_DIR."/forms/form_billing_".$payment_method.".php")) {
				include(INCLUDES_DIR."/forms/form_billing_".$payment_method.".php");
			}
			?>

		<? } ?>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
