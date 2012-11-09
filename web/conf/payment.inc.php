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
	# * FILE: /conf/payment.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# FLAGS - on/off
	# ----------------------------------------------------------------------------------------------------
	$payment_simplepayStatus = "off";
	$payment_paypalStatus = "off";
	$payment_paypalapiStatus = "off";
	$payment_payflowStatus = "off";
	$payment_twocheckoutStatus = "off";
	$payment_psigateStatus = "off";
	$payment_worldpayStatus = "off";
	$payment_itransactStatus = "off";
	$payment_linkpointStatus = "off";
	$payment_authorizeStatus = "off";
	$payment_pagseguroStatus = "off";
	
	$payment_simplepayRecurring = "off";
	$payment_paypalRecurring = "off";
	$payment_linkpointRecurring = "off";
	$payment_authorizeRecurring = "off";

	$period_renewalListing = "1Y";
	$period_renewalEvent = "1M";
	$period_renewalBanner = "1M";
	$period_renewalClassified = "30D";
	$period_renewalArticle = "1Y";
	
	$payment_currency = "USD";
	$currency_symbol = "$";
	
	$invoice_payment = "on";
	$manual_payment = "on";

	//loading the definitions file

	include(EDIRECTORY_ROOT."/custom/domain/domain.inc.php");
	if (strpos($_SERVER["PHP_SELF"], "/members") !== false) $_domain_id = $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])];
	else $_domain_id = SELECTED_DOMAIN_ID;

	$definitions_file = EDIRECTORY_ROOT.'/custom/domain_'.$_domain_id.'/payment/payment.inc.php';
	if (file_exists($definitions_file)) {
		include_once($definitions_file);
	}
	unset($_domain_id, $domainInfo);

	# ****************************************************************************************************
	# EDIRECTORY PAYMENT GATEWAY
	# ****************************************************************************************************
	define("INVOICEPAYMENT_FEATURE",    $invoice_payment);
	define("MANUALPAYMENT_FEATURE",     $manual_payment);
	
	unset($invoice_payment);
	unset($manual_payment);
	# ****************************************************************************************************
	# NORMAL PAYMENT GATEWAY
	# ****************************************************************************************************
	define("SIMPLEPAYPAYMENT_FEATURE",      $payment_simplepayStatus);
	define("PAYPALPAYMENT_FEATURE",         $payment_paypalStatus);
	define("PAYPALAPIPAYMENT_FEATURE",      $payment_paypalapiStatus);
	define("PAYFLOWPAYMENT_FEATURE",        $payment_payflowStatus);
	define("TWOCHECKOUTPAYMENT_FEATURE",    $payment_twocheckoutStatus);
	define("PSIGATEPAYMENT_FEATURE",        $payment_psigateStatus);
	define("WORLDPAYPAYMENT_FEATURE",       $payment_worldpayStatus);
	define("ITRANSACTPAYMENT_FEATURE",      $payment_itransactStatus);
	define("LINKPOINTPAYMENT_FEATURE",      $payment_linkpointStatus);
	define("AUTHORIZEPAYMENT_FEATURE",      $payment_authorizeStatus);
	define("PAGSEGUROPAYMENT_FEATURE",      $payment_pagseguroStatus);

	unset($payment_simplepayStatus);
	unset($payment_paypalStatus);
	unset($payment_paypalapiStatus);
	unset($payment_payflowStatus);
	unset($payment_twocheckoutStatus);
	unset($payment_psigateStatus);
	unset($payment_worldpayStatus);
	unset($payment_itransactStatus);
	unset($payment_linkpointStatus);
	unset($payment_authorizeStatus);
	unset($payment_pagseguroStatus);
	
	# ****************************************************************************************************
	# RECURRING PAYMENT GATEWAY
	# ****************************************************************************************************
	
	define("SIMPLEPAYRECURRING_FEATURE",    $payment_simplepayRecurring);
	define("PAYPALRECURRING_FEATURE",       $payment_paypalRecurring);
	define("LINKPOINTRECURRING_FEATURE",    $payment_linkpointRecurring);
	define("AUTHORIZERECURRING_FEATURE",    $payment_authorizeRecurring);
	
	unset($payment_simplepayRecurring);
	unset($payment_paypalRecurring);
	unset($payment_linkpointRecurring);
	unset($payment_authorizeRecurring);

	# ****************************************************************************************************
	# IMPORTANT: This is the default currency for all payment systems. To change it to another currency,
	# you just need to change this define, and it will affect all system. You can also use a different
	# currency for each type of payment by just setting the currency constant for each payment system.
	# ****************************************************************************************************
	# ----------------------------------------------------------------------------------------------------
	# CURRENCY
	# ----------------------------------------------------------------------------------------------------
	define("PAYMENT_CURRENCY",  $payment_currency);
	define("CURRENCY_SYMBOL",   $currency_symbol);

	unset($payment_currency);
	unset($currency_symbol);

	# ****************************************************************************************************
	# Renewal Period = Renewal Cycle + Renewal Unit
	# Renewal Cycle = number of renewal unit
	# Renewal Unit = Y (year) or M (month) or D (day)
	# ****************************************************************************************************
	# ----------------------------------------------------------------------------------------------------
	# ITEM RENEWAL PERIOD
	# ----------------------------------------------------------------------------------------------------
	define("LISTING_RENEWAL_PERIOD",    $period_renewalListing);
	define("EVENT_RENEWAL_PERIOD",      $period_renewalEvent);
	define("BANNER_RENEWAL_PERIOD",     $period_renewalBanner);
	define("CLASSIFIED_RENEWAL_PERIOD", $period_renewalClassified);
	define("ARTICLE_RENEWAL_PERIOD",    $period_renewalArticle);

	unset($period_renewalListing);
	unset($period_renewalEvent);
	unset($period_renewalBanner);
	unset($period_renewalClassified);
	unset($period_renewalArticle);

	# ----------------------------------------------------------------------------------------------------
	# AUTOMATIC FEATURES
	# ----------------------------------------------------------------------------------------------------
	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)
	if ((PAYMENTSYSTEM_FEATURE == "off") || ((PAYMENTSYSTEM_FEATURE == "on") && (INVOICEPAYMENT_FEATURE == "off") && (MANUALPAYMENT_FEATURE == "off") && (SIMPLEPAYPAYMENT_FEATURE == "off") && (PAYPALPAYMENT_FEATURE == "off") && (PAYPALAPIPAYMENT_FEATURE == "off") && (PAYFLOWPAYMENT_FEATURE == "off") && (TWOCHECKOUTPAYMENT_FEATURE == "off") && (PSIGATEPAYMENT_FEATURE == "off") && (WORLDPAYPAYMENT_FEATURE == "off") && (ITRANSACTPAYMENT_FEATURE == "off") && (LINKPOINTPAYMENT_FEATURE == "off") && (AUTHORIZEPAYMENT_FEATURE == "off") && (PAGSEGUROPAYMENT_FEATURE == "off"))) {
		define("PAYMENT_FEATURE", "off");
	} else {
		define("PAYMENT_FEATURE", "on");
	}
	if ((SIMPLEPAYPAYMENT_FEATURE == "on") || (PAYPALPAYMENT_FEATURE == "on") || (PAYPALAPIPAYMENT_FEATURE == "on") || (PAYFLOWPAYMENT_FEATURE == "on") || (TWOCHECKOUTPAYMENT_FEATURE == "on") || (PSIGATEPAYMENT_FEATURE == "on") || (WORLDPAYPAYMENT_FEATURE == "on") || (ITRANSACTPAYMENT_FEATURE == "on") || (LINKPOINTPAYMENT_FEATURE == "on") || (AUTHORIZEPAYMENT_FEATURE == "on") || (PAGSEGUROPAYMENT_FEATURE == "on")) {
		define("CREDITCARDPAYMENT_FEATURE", "on");
	} else {
		define("CREDITCARDPAYMENT_FEATURE", "off");
	}
	if (DEMO_DEV_MODE || DEMO_LIVE_MODE) {
		define("REALTRANSACTION", "off");
	} else {
		define("REALTRANSACTION", "on");
	}
	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)

	# ----------------------------------------------------------------------------------------------------
	# INVOICE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	if (INVOICEPAYMENT_FEATURE == "on") {
		define("INVOICEPAYMENT_CURRENCY", PAYMENT_CURRENCY);
	}

	# ----------------------------------------------------------------------------------------------------
	# MANUAL CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	if (MANUALPAYMENT_FEATURE == "on") {
		define("MANUAL_STATUS",     "Completed");
		define("MANUAL_CURRENCY",   PAYMENT_CURRENCY);
	}
?>