<?php
$payment_simplepayStatus = "on";
$payment_paypalStatus = "on";
$payment_paypalapiStatus = "off";
$payment_payflowStatus = "off";
$payment_twocheckoutStatus = "off";
$payment_psigateStatus = "off";
$payment_worldpayStatus = "off";
$payment_itransactStatus = "off";
$payment_linkpointStatus = "off";
$payment_authorizeStatus = "on";
$payment_pagseguroStatus = "off";

$payment_simplepayRecurring = "off";
$payment_paypalRecurring = "off";
$payment_linkpointRecurring = "off";
$payment_authorizeRecurring = "on";

$period_renewalListing = "1M";
$period_renewalEvent = "1M";
$period_renewalBanner = "1M";
$period_renewalClassified = "1M";
$period_renewalArticle = "1M";

# ****************************************************************************************************
# CUSTOMIZATIONS
# NOTE: The $payment_currency in this file is only for the domain 1
# Any changes will require an update in the table "Setting_Payment"
# to set the property "PAYMENT_CURRENCY" with the value bellow on the domain 1 database.
# ****************************************************************************************************
$payment_currency = "USD";

$currency_symbol = "$";
$invoice_payment = "on";
$manual_payment = "on";
