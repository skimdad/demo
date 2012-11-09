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
	# * FILE: /functions/payment_funct.php
	# ----------------------------------------------------------------------------------------------------

	function payment_getRenewalPeriod($item) {
		return constant(string_strtoupper($item)."_RENEWAL_PERIOD");
	}

	function payment_getRenewalCycle($item) {
		return string_substr(constant(string_strtoupper($item)."_RENEWAL_PERIOD"), 0, string_strlen(constant(string_strtoupper($item)."_RENEWAL_PERIOD"))-1);
	}

	function payment_getRenewalUnit($item) {
		return string_substr(constant(string_strtoupper($item)."_RENEWAL_PERIOD"), string_strlen(constant(string_strtoupper($item)."_RENEWAL_PERIOD"))-1);
	}

	function payment_getRenewalUnitName($item) {
		$unit = payment_getRenewalUnit($item);
		if ($unit == "Y") $unitname = system_showText(LANG_YEAR);
		elseif ($unit == "M") $unitname = system_showText(LANG_MONTH);
		elseif ($unit == "D") $unitname = system_showText(LANG_DAY);
		return $unitname;
	}

	function payment_getRenewalUnitNamePlural($item) {
		$unit = payment_getRenewalUnit($item);
		if ($unit == "Y") $unitname = system_showText(LANG_YEAR_PLURAL);
		elseif ($unit == "M") $unitname = system_showText(LANG_MONTH_PLURAL);
		elseif ($unit == "D") $unitname = system_showText(LANG_DAY_PLURAL);
		return $unitname;
	}
	
	function payment_writeSettingPaymentFile($array_PaymentSetting) {
			
		$filePath = EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/payment/payment.inc.php';
		
		if (!$file = fopen($filePath, 'w+')) {
			return false;
		}
		
		$buffer = "<?php".PHP_EOL;
		
		$buffer .= "\$payment_simplepayStatus = \"".$array_PaymentSetting['payment_simplepayStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_paypalStatus = \"".$array_PaymentSetting['payment_paypalStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_paypalapiStatus = \"".$array_PaymentSetting['payment_paypalapiStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_payflowStatus = \"".$array_PaymentSetting['payment_payflowStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_twocheckoutStatus = \"".$array_PaymentSetting['payment_twocheckoutStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_psigateStatus = \"".$array_PaymentSetting['payment_psigateStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_worldpayStatus = \"".$array_PaymentSetting['payment_worldpayStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_itransactStatus = \"".$array_PaymentSetting['payment_itransactStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_linkpointStatus = \"".$array_PaymentSetting['payment_linkpointStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_authorizeStatus = \"".$array_PaymentSetting['payment_authorizeStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_pagseguroStatus = \"".$array_PaymentSetting['payment_pagseguroStatus']."\";".PHP_EOL.PHP_EOL;
		$buffer .= "\$payment_simplepayRecurring = \"".$array_PaymentSetting['payment_simplepayRecurring']."\";".PHP_EOL;
		$buffer .= "\$payment_paypalRecurring = \"".$array_PaymentSetting['payment_paypalRecurring']."\";".PHP_EOL;
		$buffer .= "\$payment_linkpointRecurring = \"".$array_PaymentSetting['payment_linkpointRecurring']."\";".PHP_EOL;
		$buffer .= "\$payment_authorizeRecurring = \"".$array_PaymentSetting['payment_authorizeRecurring']."\";".PHP_EOL.PHP_EOL;
		$buffer .= "\$period_renewalListing = \"".$array_PaymentSetting['renewal_periodListing']."\";".PHP_EOL;
		$buffer .= "\$period_renewalEvent = \"".$array_PaymentSetting['renewal_periodEvent']."\";".PHP_EOL;
		$buffer .= "\$period_renewalBanner = \"".$array_PaymentSetting['renewal_periodBanner']."\";".PHP_EOL;
		$buffer .= "\$period_renewalClassified = \"".$array_PaymentSetting['renewal_periodClassified']."\";".PHP_EOL;
		$buffer .= "\$period_renewalArticle = \"".$array_PaymentSetting['renewal_periodArticle']."\";".PHP_EOL.PHP_EOL;
		$buffer .= "# ****************************************************************************************************".PHP_EOL;
		$buffer .= "# CUSTOMIZATIONS".PHP_EOL;
		$buffer .= "# NOTE: The \$payment_currency in this file is only for the domain ".SELECTED_DOMAIN_ID."".PHP_EOL;
		$buffer .= "# Any changes will require an update in the table \"Setting_Payment\"".PHP_EOL;
		$buffer .= "# to set the property \"PAYMENT_CURRENCY\" with the value bellow on the domain ".SELECTED_DOMAIN_ID." database.".PHP_EOL;
		$buffer .= "# ****************************************************************************************************".PHP_EOL;
		$buffer .= "\$payment_currency = \"".$array_PaymentSetting['payment_currency']."\";".PHP_EOL.PHP_EOL;
		$buffer .= "\$currency_symbol = \"".$array_PaymentSetting['currency_symbol']."\";".PHP_EOL;
		$buffer .= "\$invoice_payment = \"".$array_PaymentSetting['invoice_payment']."\";".PHP_EOL;
		$buffer .= "\$manual_payment = \"".$array_PaymentSetting['manual_payment']."\";".PHP_EOL;
		
		$return_payment = fwrite($file, $buffer, strlen($buffer));
		
		fclose($file);
		
		return $return_payment;
	
	}
	
	function payment_verifyItensRenewal($itens) {
		$aux = $itens[0];
		$aux2 = true;
		$i = 1;
		while ($i < count($itens)) {
			if ($itens[$i] != $aux) {
				$aux2 = false;
			};
			$i++;
		}
		return $aux2;
	}

	function payment_calculateTax ($price, $tax, $formatValue = true, $amount = true) {
		if ($amount) {
			$value = ($price * (1 + $tax / 100));
			if ($formatValue) return format_money($value);
			else return $value;
		} else {
			$value = (($price * (1 + $tax / 100)) - $price);
			if ($formatValue) return format_money($value);
			else return $value;
		}
	}

	function payment_taxToPercentage ($tax_value, $total_value) {
		$value = (($tax_value * 100) / $total_value);
		return $value;
	}
	
?>