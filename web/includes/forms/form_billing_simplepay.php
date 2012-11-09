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
	# * FILE: /includes/forms/form_billing_simplepay.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_simplepay.inc.php");

	define("ASPRPATH", EDIRECTORY_ROOT.'/members/billing/aspr');

	setting_get("payment_tax_status", $payment_tax_status);
	setting_get("payment_tax_value", $payment_tax_value);

	require_once ASPRPATH.'/Crypt/HMAC.php';
	require_once ASPRPATH.'/HTTP/Request.php';

	function getSignature($stringToSign, $secretKey) {
		$hmac = new Crypt_HMAC($secretKey,"sha1");
		$binary_hmac = pack("H40", $hmac->hash(trim($stringToSign)));
		return base64_encode($binary_hmac);
	}

	if (SIMPLEPAYPAYMENT_FEATURE == "on") {

		if (!SIMPLEPAY_ACCESSKEY || !SIMPLEPAY_SECRETKEY) {
			echo "<p class=\"errorMessage\">".system_showText(LANG_SIMPLEPAY_NO_AVAILABLE)." <a href=\"".DEFAULT_URL."/members/help.php\" class=\"billing-contact\">".system_showText(LANG_LABEL_ADMINISTRATOR)."</a>.</p>";
		} elseif ((SIMPLEPAYRECURRING_FEATURE == "on") && (!SIMPLEPAY_RECURRINGCYCLE || !SIMPLEPAY_RECURRINGUNIT)) {
			echo "<p class=\"errorMessage\">".system_showText(LANG_SIMPLEPAY_NO_AVAILABLE)." <a href=\"".DEFAULT_URL."/members/help.php\" class=\"billing-contact\">".system_showText(LANG_LABEL_ADMINISTRATOR)."</a>.</p>";
		} else {

			$block_bannerbyimpression = false;
			$block_custominvoice = false;

			if ($bill_info["listings"]) foreach ($bill_info["listings"] as $id => $info) {

				$listing_ids[] = $id;
				$listing_amounts[] = $info["total_fee"];

			}

			if ($bill_info["events"]) foreach ($bill_info["events"] as $id => $info) {

				$event_ids[] = $id;
				$event_amounts[] = $info["total_fee"];

			}

			if ($bill_info["banners"]) foreach ($bill_info["banners"] as $id => $info) {

				if ($info["expiration_setting"] == BANNER_EXPIRATION_IMPRESSION) {
					$block_bannerbyimpression = true;
				}

				$banner_ids[] = $id;
				$banner_amounts[] = $info["total_fee"];

			}

			if ($bill_info["classifieds"]) foreach ($bill_info["classifieds"] as $id => $info) {

				$classified_ids[] = $id;
				$classified_amounts[] = $info["total_fee"];

			}

			if ($bill_info["articles"]) foreach ($bill_info["articles"] as $id => $info) {

				$article_ids[] = $id;
				$article_amounts[] = $info["total_fee"];

			}

			if ($bill_info["custominvoices"]) foreach($bill_info["custominvoices"] as $id => $info) {

				$block_custominvoice = true;

				$custominvoice_ids[] = $id;
				$custominvoice_amounts[] = $info["amount"];

			}

			$stoppayment = false;

			if ((SIMPLEPAYRECURRING_FEATURE == "on") && (($block_bannerbyimpression) || ($block_custominvoice))) {
				echo "<p class=\"errorMessage\">";
					if (($block_bannerbyimpression) && ($block_custominvoice)) echo system_showText(LANG_MSG_BANNER_CUSTOM_INVOICE_PAID_ONCE);
					elseif ($block_bannerbyimpression) echo system_showText(LANG_MSG_BANNER_PAID_ONCE);
					elseif ($block_custominvoice) echo system_showText(LANG_MSG_CUSTOM_INVOICE_PAID_ONCE);
					echo "&nbsp;".system_showText(LANG_MSG_PLEASE_DO_NOT_USE_RECURRING_PAYMENT_SYSTEM);
					echo "<br /><a href=\"".DEFAULT_URL."/members/billing/\">".system_showText(LANG_MSG_TRY_AGAIN)."</a>";
				echo "</p>";
				$stoppayment = true;
			}

			if (!$stoppayment) {

				if ($listing_ids)					$form_extra_params["listing_ids"]				= implode("::",$listing_ids);
				if ($listing_ids)					$form_extra_params["listing_ids"]				= implode("::",$listing_ids);
				if ($listing_amounts)				$form_extra_params["listing_amounts"]			= implode("::",$listing_amounts);
				if ($event_ids)						$form_extra_params["event_ids"]					= implode("::",$event_ids);
				if ($event_amounts)					$form_extra_params["event_amounts"]				= implode("::",$event_amounts);
				if ($banner_ids)					$form_extra_params["banner_ids"]				= implode("::",$banner_ids);
				if ($banner_amounts)				$form_extra_params["banner_amounts"]			= implode("::",$banner_amounts);
				if ($classified_ids)				$form_extra_params["classified_ids"]			= implode("::",$classified_ids);
				if ($classified_amounts)			$form_extra_params["classified_amounts"]		= implode("::",$classified_amounts);
				if ($article_ids)					$form_extra_params["article_ids"]				= implode("::",$article_ids);
				if ($article_amounts)				$form_extra_params["article_amounts"]			= implode("::",$article_amounts);
				if ($custominvoice_ids)				$form_extra_params["custominvoice_ids"]			= implode("::",$custominvoice_ids);
				if ($custominvoice_amounts)			$form_extra_params["custominvoice_amounts"]		= implode("::",$custominvoice_amounts);
				$form_extra_params["account_id"]	= sess_getAccountIdFromSession();
				$form_extra_params["domain_id"]		= SELECTED_DOMAIN_ID;
				$form_extra_params["package_id"]	= $package_id;
				

				$simplepay_subtotal = str_replace(",", ".", $bill_info["total_bill"]);

				$form_params['description'] = EDIRECTORY_TITLE." Billing";

				if ($payment_tax_status == "on") {
					$_SESSION["simplepay_tax_value"] = $payment_tax_value;
					$_SESSION["simplepay_subtotal"] = $simplepay_subtotal;
					$form_params['amount'] = payment_calculateTax($simplepay_subtotal, $payment_tax_value);
				} else {
					$_SESSION["simplepay_tax_value"] = 0;
					$_SESSION["simplepay_subtotal"] = $simplepay_subtotal;
					$form_params['amount'] = $simplepay_subtotal;
				}

				$_SESSION["domain_id"] = SELECTED_DOMAIN_ID;

				if (SIMPLEPAYRECURRING_FEATURE == "on") {

					$form_params['recurringFrequency'] = SIMPLEPAY_RECURRINGCYCLE." ".SIMPLEPAY_RECURRINGUNIT;
					if (SIMPLEPAY_RECURRINGTIMES) {
						$form_params['subscriptionPeriod'] = (SIMPLEPAY_RECURRINGCYCLE*SIMPLEPAY_RECURRINGTIMES)." ".SIMPLEPAY_RECURRINGUNIT;
					}
				}

				$form_params['referenceId']				= uniqid("edir");
				$form_params['immediateReturn']			= 1;
				$form_params['processImmediate']		= 1;
				$form_params['cobrandingStyle']			= "logo";
		
				$form_params['returnUrl']				= DEFAULT_URL."/members/".$payment_process."/processpayment.php?payment_method=".$payment_method."";
				$form_params['abandonUrl']				= DEFAULT_URL."/members/".$payment_process."/processpayment.php?payment_method=".$payment_method."";
				$form_params['ipnUrl']					= DEFAULT_URL."/members/billing/simplepayreturn.php";

				$params = array(
					"request_method" => "POST", 
					"gateway_url" => SIMPLEPAY_URL, 
					"access_key" => SIMPLEPAY_ACCESSKEY, 
					"secret_key" => SIMPLEPAY_SECRETKEY,
					"signature_version" => "2",
					"signature_method" => "HmacSHA1"
				);

				$spObj = new SimplePay($params);
				
				$spObj->setFormParams($form_params, $form_extra_params);
				
				?>

				<script language="javascript" type="text/javascript">
					<!--
					function submitOrder() {
						document.getElementById("simplepaybutton").disabled = true;
						document.simplepayform.submit();
					}
					//-->
				</script>

				<form name="simplepayform" target="_self" action="<?=DEFAULT_URL;?>/members/billing/simplepayprocess.php" method="post">

					<div style="display: none;">
						<?
						echo $spObj->getFormInputs();
						?>
					</div>

					<? if ($payment_process == "signup") { ?>
						<table width="100%" border="0" cellpadding="2" cellspacing="2">
							<tr>
								<td><p class="standardButton paymentButton"><a href="javascript:void(0);" id="simplepaybutton" onclick="submitOrder();"><?=system_highlightWords(system_showText(LANG_LABEL_PLACE_ORDER_CONTINUE))?></a></p></td>
							</tr>
						</table>
					<? } else { ?>
						<p class="standardButton paymentButton">
							<button type="button" id="simplepaybutton" onclick="submitOrder();"><?=system_showText(LANG_BUTTON_PAY_BY_SIMPLEPAY);?></button>
						</p>
					<? } ?>

				</form>

				<?

			}

		}

	}
?>
