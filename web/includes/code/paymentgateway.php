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
	# * FILE: /includes/code/paymentgateway.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$dbMain = db_getDBObject(DEFAULT_DB, true);
	$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		$arrayError = "";

		if ($select_listingD) $select_listing=$select_listingD;
		elseif ($select_listingM) $select_listing=$select_listingM;
		elseif ($select_listingY) $select_listing=$select_listingY;

		if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
            if ($select_eventD) $select_event=$select_eventD;
            elseif ($select_eventM) $select_event=$select_eventM;
            elseif ($select_eventY) $select_event=$select_eventY;
		}

		if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") {
            if ($select_bannerD) $select_banner=$select_bannerD;
            elseif ($select_bannerM) $select_banner=$select_bannerM;
            elseif ($select_bannerY) $select_banner=$select_bannerY;
		}

		if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
            if ($select_classifiedD) $select_classified=$select_classifiedD;
            elseif ($select_classifiedM) $select_classified=$select_classifiedM;
            elseif ($select_classifiedY) $select_classified=$select_classifiedY;
		}

		if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
            if ($select_articleD) $select_article=$select_articleD;
            elseif ($select_articleM) $select_article=$select_articleM;
            elseif ($select_articleY) $select_article=$select_articleY;
		}

		$payment_currency = string_strtoupper($payment_currency);
		if (!$currency_symbol) $arrayError .= "1,";
		if (!$payment_currency) $arrayError .= "18,";
		else {
			if (string_strlen($payment_currency) != 3) $arrayError .= "19,";
			if (preg_match("/[0-9]/", $payment_currency)) $arrayError .= "20,";
			else {
				if (preg_match("/[a-zA-Z]*/", $payment_currency, $pmMatch)) {
					if (string_strlen($pmMatch[0]) != string_strlen($payment_currency)) {
						 $arrayError .= "20,";
					}
				}
			}
            if ($payment_pagseguroStatus && $payment_currency != "BRL"){
                $arrayError .= "21,";
            }
		}

		if ((!$select_listing) || (!$listingPeriod)) $arrayError .= "2,";
		if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
			if ((!$select_event) || (!$eventPeriod)) $arrayError .= "3,";
		}
		if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") {
			if ((!$select_banner) || (!$bannerPeriod)) $arrayError .= "4,";
		}
		if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
			if ((!$select_classified) ||(!$classifiedPeriod)) $arrayError .= "5,";
		}
		if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
			if ((!$select_article) || (!$articlePeriod)) $arrayError .= "6,";
		}

		if ($payment_simplepayStatus && $simplepay_recurringCheckbox) {
			if ($recurringcycle_simplepay == "") {
				$arrayError = $arrayError."7,";
			} elseif ($recurringcycle_simplepay < 0) {
				$arrayError = $arrayError."8,";
			} elseif (preg_match('/[^0-9\@\.\_\-]/i', $recurringcycle_simplepay)) {
				$arrayError = $arrayError."9,";
			} elseif ($recurringtimes_simplepay < 0) {
				$arrayError = $arrayError."10,";
			} elseif (preg_match('/[^0-9\@\.\_\-]/i', $recurringtimes_simplepay)) {
				$arrayError = $arrayError."11,";
			}
		}

		if ($payment_paypal && $paypal_recurringCheckbox) {
			if ($recurringcycle_paypal == "") {
				$arrayError = $arrayError."12,";
			} elseif ($recurringcycle_paypal < 0) {
				$arrayError = $arrayError."13,";
			} elseif (preg_match('/[^0-9\@\.\_\-]/i', $recurringcycle_paypal)) {
				$arrayError = $arrayError."14,";
			} elseif ($recurringtimes_simplepay < 0) {
				$arrayError = $arrayError."15,";
			} elseif (preg_match('/[^0-9\@\.\_\-]/i', $recurringtimes_paypal)) {
				$arrayError = $arrayError."16,";
			} 
		}
		
		if ($simplepay_recurringCheckbox || $paypal_recurringCheckbox || $linkpoint_recurringCheckbox || $authorize_recurringCheckbox) {
			$arrayItens = "";
			
			if ($select_listing.$listingPeriod=='30D')
				$arrayItens .='1M,';
				
			elseif ($select_listing.$listingPeriod=='12M')
				$arrayItens .='1Y,';
			else
				$arrayItens = $select_listing.$listingPeriod.",";
			
			if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
				if ($select_event.$eventPeriod=='30D') 
					$arrayItens .='1M,';
				
				elseif ($select_event.$eventPeriod=='12M') 
					$arrayItens .='1Y,';
				else 
					$arrayItens .= $select_event.$eventPeriod.",";

				}
	
			if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on"){
				if ($select_banner.$bannerPeriod=='30D')
					$arrayItens .='1M,';
					
				elseif ($select_banner.$bannerPeriod=='12M')
					$arrayItens .='1Y,';
				else
					$arrayItens .= $select_banner.$bannerPeriod.",";
			}
			
			if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
				if ($select_classified.$classifiedPeriod=='30D')
					$arrayItens .='1M,';
					
				elseif ($select_classified.$classifiedPeriod=='12M')
					$arrayItens .='1Y,';
				else
					$arrayItens .= $select_classified.$classifiedPeriod.",";
			}
			
			if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on"){
				if ($select_article.$articlePeriod=='30D')
					$arrayItens .='1M,';

				elseif ($select_article.$articlePeriod=='12M')
					$arrayItens .='1Y,';
				else
					$arrayItens .= $select_article.$articlePeriod.",";
			}
			if ($simplepay_recurringCheckbox) {
				if ($recurringunit_simplepay  == "month") {
					$aux = $recurringcycle_simplepay."M";
					if ($aux=='12M'){
						$arrayItens .= '1Y,';
					}else{
						$arrayItens .= $recurringcycle_simplepay."M,";
					}
				} else {
					$arrayItens .= $recurringcycle_simplepay."Y,";
				}
			}
			if ($paypal_recurringCheckbox) {
				$aux = $recurringcycle_paypal.$recurringunit_paypal;
				if ($aux=='12M')
					$arrayItens .= '1Y,';
				else
					$arrayItens .= $recurringcycle_paypal.$recurringunit_paypal.",";
			}
			if ($linkpoint_recurringCheckbox) {
				$arrayItens .= $recurringtype_linkpoint.",";
			}
			if ($authorize_recurringCheckbox) {
				if ($recurringlength_authorize == "1") {
					$arrayItens .= $recurringlength_authorize."M,";
				} else {
					$arrayItens .= "1Y,";
				}
			}
			$arrayItens = string_substr($arrayItens, 0, -1);
			$arrayItens = explode(",", $arrayItens);

			if (!payment_verifyItensRenewal($arrayItens)) {
				$arrayError .= "17,";
			}
		}

		if (!$arrayError) {
			
			// EDIRECTORY PAYMENT
			if (!$invoice_payment) {
				$invoice_payment = off; 
			}
			$sql = "UPDATE Setting_Payment SET value='".$invoice_payment."' WHERE name='INVOICEPAYMENT_FEATURE' LIMIT 1";
			$result = $dbObj->query($sql);
			
			if (!$manual_payment) {
				$manual_payment = off;
			}
			
			$sql = "UPDATE Setting_Payment SET value='".$manual_payment."' WHERE name='MANUALPAYMENT_FEATURE' LIMIT 1";
			$result = $dbObj->query($sql);
			
			//SIMPLEPAY
			$error_simplepay   = false;
			if (!$payment_simplepayStatus) {
				$payment_simplepayStatus = off;
				$simplepay_recurringCheckbox = off;
				$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'SIMPLEPAY_%'";
				$result = $dbObj->query($sql);
				while ($row = mysql_fetch_assoc($result)) {
					if ($row["name"] == "SIMPLEPAY_ACCESSKEY") $simplepay_accesskey = crypt_decrypt($row["value"]);
					if ($row["name"] == "SIMPLEPAY_SECRETKEY") $simplepay_secretkey = crypt_decrypt($row["value"]);
				}
			} else {
				if (!$simplepay_recurringCheckbox) {
					$simplepay_recurringCheckbox = off;
					$sql_recurringcycle = "UPDATE Setting_Payment SET value=' ' WHERE name='SIMPLEPAY_RECURRINGCYCLE' LIMIT 1";
					$sql_recurringtimes = "UPDATE Setting_Payment SET value=' ' WHERE name='SIMPLEPAY_RECURRINGTIMES' LIMIT 1";
					$sql_recurringunit = "UPDATE Setting_Payment SET value=' ' WHERE name='SIMPLEPAY_RECURRINGUNIT' LIMIT 1";
					$sql_accesskey = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($simplepay_accesskey))."' WHERE name='SIMPLEPAY_ACCESSKEY' LIMIT 1";
					$sql_secretkey = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($simplepay_secretkey))."' WHERE name='SIMPLEPAY_SECRETKEY' LIMIT 1";
					if (!$dbObj->query($sql_recurringcycle) || !$dbObj->query($sql_recurringtimes) || !$dbObj->query($sql_recurringunit)) 
						$error_simplepay = true;
					if (!$dbObj->query($sql_accesskey) || !$dbObj->query($sql_secretkey)) {
						$error_simplepay = true;
					}

				} else {
					$sql_accesskey = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($simplepay_accesskey))."' WHERE name='SIMPLEPAY_ACCESSKEY' LIMIT 1";
					$sql_secretkey = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($simplepay_secretkey))."' WHERE name='SIMPLEPAY_SECRETKEY' LIMIT 1";
					if (!$dbObj->query($sql_accesskey) || !$dbObj->query($sql_secretkey)) {
						$error_simplepay = true;
					}
					$sql_recurringcycle = "UPDATE Setting_Payment SET value='".trim($recurringcycle_simplepay)."' WHERE name='SIMPLEPAY_RECURRINGCYCLE' LIMIT 1";
					if (!$dbObj->query($sql_recurringcycle)) $error_simplepay = true;
					$sql_recurringtimes = "UPDATE Setting_Payment SET value='".trim($recurringtimes_simplepay)."' WHERE name='SIMPLEPAY_RECURRINGTIMES' LIMIT 1";
					if (!$dbObj->query($sql_recurringtimes)) $error_simplepay = true;
					$sql_recurringunit = "UPDATE Setting_Payment SET value='".trim($recurringunit_simplepay)."' WHERE name='SIMPLEPAY_RECURRINGUNIT' LIMIT 1";
					if (!$dbObj->query($sql_recurringunit)) $error_simplepay = true;
					
				}
				if ($error_simplepay == true) $arrayError = $arrayError."error_simplepay,";

			}
			$sql = "UPDATE Setting_Payment SET value='".$payment_simplepayStatus."' WHERE name='SIMPLEPAY_STATUS'";
			$dbObj->query($sql);
			$sql = "UPDATE Setting_Payment SET value='".$simplepay_recurringCheckbox."' WHERE name='SIMPLEPAY_RECURRING'";
			$dbObj->query($sql);

			//PAYPAL
			$error_paypal   = false;
			if (!$payment_paypalStatus) {
				$payment_paypalStatus = off;
				$paypal_recurringCheckbox = off;
				$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'PAYPAL_%'";
				$result = $dbObj->query($sql);
				while ($row = mysql_fetch_assoc($result)) {
					if ($row["name"] == "PAYPAL_ACCOUNT") $paypal_account = crypt_decrypt($row["value"]);
				}
			} else {
				if (!$paypal_recurringCheckbox) {
					$paypal_recurringCheckbox = off;
					$sql_recurringcycle = "UPDATE Setting_Payment SET value=' ' WHERE name='PAYPAL_RECURRINGCYCLE' LIMIT 1";
					$sql_recurringtimes = "UPDATE Setting_Payment SET value=' ' WHERE name='PAYPAL_RECURRINGTIMES' LIMIT 1";
					$sql_recurringunit = "UPDATE Setting_Payment SET value=' ' WHERE name='PAYPAL_RECURRINGUNIT' LIMIT 1";
					$sql_account = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($paypal_account))."' WHERE name='PAYPAL_ACCOUNT' LIMIT 1";
					if (!$dbObj->query($sql_recurringcycle) || !$dbObj->query($sql_recurringtimes) || !$dbObj->query($sql_recurringunit) || !$dbObj->query($sql_account)) {
						$error_paypal   = true;
					}
				} else {
					$sql_account = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($paypal_account))."' WHERE name='PAYPAL_ACCOUNT' LIMIT 1";
					if (!$dbObj->query($sql_account))	$error_paypal   = true;
					$sql_recurringcycle = "UPDATE Setting_Payment SET value='".trim($recurringcycle_paypal)."' WHERE name='PAYPAL_RECURRINGCYCLE' LIMIT 1";
					if (!$dbObj->query($sql_recurringcycle)) $error_paypal = true;
					$sql_recurringtimes = "UPDATE Setting_Payment SET value='".trim($recurringtimes_paypal)."' WHERE name='PAYPAL_RECURRINGTIMES' LIMIT 1";
					if (!$dbObj->query($sql_recurringtimes)) $error_paypal = true;
					$sql_recurringunit = "UPDATE Setting_Payment SET value='".trim($recurringunit_paypal)."' WHERE name='PAYPAL_RECURRINGUNIT' LIMIT 1";
					if (!$dbObj->query($sql_recurringunit))	$error_paypal   = true;
					if ($error_paypal == true) $arrayError = $arrayError."error_paypal,";
				}
			}
			$sql = "UPDATE Setting_Payment SET value='".$payment_paypalStatus."' WHERE name='PAYPAL_STATUS'";
			$dbObj->query($sql);
			$sql = "UPDATE Setting_Payment SET value='".$paypal_recurringCheckbox."' WHERE name='PAYPAL_RECURRING'";
			$dbObj->query($sql);

			//PAYPALAPI
			$error_paypalapi   = false;
			if (!$payment_paypalapiStatus) {
				$payment_paypalapiStatus = off;
				$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'PAYPALAPI_%'";
				$result = $dbObj->query($sql);
				while ($row = mysql_fetch_assoc($result)) {
					if ($row["name"] == "PAYPALAPI_USERNAME")  $paypalapi_username  = crypt_decrypt($row["value"]);
					if ($row["name"] == "PAYPALAPI_PASSWORD")  $paypalapi_password  = crypt_decrypt($row["value"]);
					if ($row["name"] == "PAYPALAPI_SIGNATURE") $paypalapi_signature = crypt_decrypt($row["value"]);
				}
			} else {
				$sql_username = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($paypalapi_username))."' WHERE name='PAYPALAPI_USERNAME' LIMIT 1";
				$sql_password = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($paypalapi_password))."' WHERE name='PAYPALAPI_PASSWORD' LIMIT 1";
				$sql_signature = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($paypalapi_signature))."' WHERE name='PAYPALAPI_SIGNATURE' LIMIT 1";
				if (!$dbObj->query($sql_username) || !$dbObj->query($sql_password) || !$dbObj->query($sql_signature)) {
					$error_paypalapi = true;
				}
				if ($error_paypalapi == true) $arrayError = $arrayError."error_paypalapi,";
			}
			$sql = "UPDATE Setting_Payment SET value='".$payment_paypalapiStatus."' WHERE name='PAYPALAPI_STATUS'";
			$dbObj->query($sql);

			//PAYFLOW
			$error_payflow   = false;
			if (!$payment_payflowStatus) {
				$payment_payflowStatus = off;
				$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'PAYFLOW_%'";
				$result = $dbObj->query($sql);
				while ($row = mysql_fetch_assoc($result)) {
					if ($row["name"] == "PAYFLOW_LOGIN") 	$payflow_login   = crypt_decrypt($row["value"]);
					if ($row["name"] == "PAYFLOW_PARTNER")  $payflow_partner = crypt_decrypt($row["value"]);
				}
			} else {
				$sql_login = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($payflow_login))."' WHERE name='PAYFLOW_LOGIN' LIMIT 1";
				$sql_partner = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($payflow_partner))."' WHERE name='PAYFLOW_PARTNER' LIMIT 1";
				if (!$dbObj->query($sql_login) || !$dbObj->query($sql_partner)) {
					$error_payflow = true;
				}
				if ($error_payflow == true) $arrayError = $arrayError."error_payflow,";
			}
			$sql = "UPDATE Setting_Payment SET value='".$payment_payflowStatus."' WHERE name='PAYFLOW_STATUS'";
			$dbObj->query($sql);
			
			//TWOCHECKOUT
			$error_twocheckout   = false;
			if (!$payment_twocheckoutStatus) {
				$payment_twocheckoutStatus = off;
				$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'TWOCHECKOUT_%'";
				$result = $dbObj->query($sql);
				while ($row = mysql_fetch_assoc($result)) {
					if ($row["name"] == "TWOCHECKOUT_LOGIN")  $twocheckout_login = crypt_decrypt($row["value"]);
				}
			} else {
				$sql = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($twocheckout_login))."' WHERE name='TWOCHECKOUT_LOGIN' LIMIT 1";

				if (!$dbObj->query($sql)) {
					$error_twocheckout = true;
				} 
				if ($error_twocheckout == true) $arrayError = $arrayError."error_twocheckout,";

			}
			$sql = "UPDATE Setting_Payment SET value='".$payment_twocheckoutStatus."' WHERE name='TWOCHECKOUT_STATUS'";
			$dbObj->query($sql);

			//PSIGATE
			$error_psigate   = false;
			if (!$payment_psigateStatus) {
				$payment_psigateStatus = off;
				$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'PSIGATE_%'";
				$result = $dbObj->query($sql);
				while ($row = mysql_fetch_assoc($result)) {
					if ($row["name"] == "PSIGATE_STOREID")     $psigate_storeid    = crypt_decrypt($row["value"]);
					if ($row["name"] == "PSIGATE_PASSPHRASE")  $psigate_passphrase = crypt_decrypt($row["value"]);
				}
			} else {
				$sql_storeid = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($psigate_storeid))."' WHERE name='PSIGATE_STOREID' LIMIT 1";
				$sql_passphrase = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($psigate_passphrase))."' WHERE name='PSIGATE_PASSPHRASE' LIMIT 1";

				if (!$dbObj->query($sql_storeid) || !$dbObj->query($sql_passphrase)) {
					$error_psigate   = true;
				}
				if ($error_psigate == true) $arrayError = $arrayError."error_psigate,";
			}
			$sql = "UPDATE Setting_Payment SET value='".$payment_psigateStatus."' WHERE name='PSIGATE_STATUS'";
			$dbObj->query($sql);

			//WORLDPAY
			$error_worldpay = false;
			if (!$payment_worldpayStatus) {
				$payment_worldpayStatus = off;
				$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'WORLDPAY_%'";
				$result = $dbObj->query($sql);
				while ($row = mysql_fetch_assoc($result)) {
					if ($row["name"] == "WORLDPAY_INSTID")     $worldpay_instid    = crypt_decrypt($row["value"]);
				}
			} else {
				$sql = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($worldpay_instid))."' WHERE name='WORLDPAY_INSTID' LIMIT 1";
				if (!$dbObj->query($sql)) $error_worldpay   = true;
				if ($error_worldpay == true) $arrayError = $arrayError."error_worldpay,";
			}
			$sql = "UPDATE Setting_Payment SET value='".$payment_worldpayStatus."' WHERE name='WORLDPAY_STATUS'";
			$dbObj->query($sql);

			//ITRANSACT
			$error_itransact   = false;
			if (!$payment_itransactStatus) {
				$payment_itransactStatus = off;
				$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'ITRANSACT_%'";
				$result = $dbObj->query($sql);
				while ($row = mysql_fetch_assoc($result)) {
					if ($row["name"] == "ITRANSACT_VENDORID")  $itransact_vendorid = crypt_decrypt($row["value"]);
				}
			} else {
				$sql = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($itransact_vendorid))."' WHERE name='ITRANSACT_VENDORID' LIMIT 1";

				if (!$dbObj->query($sql)) $error_itransact   = true;
				if ($error_itransact == true) $arrayError = $arrayError."error_itransact,";
			}
			$sql = "UPDATE Setting_Payment SET value='".$payment_itransactStatus."' WHERE name='ITRANSACT_STATUS'";
			$dbObj->query($sql);

			//LINKPOINT
			$error_linkpoint   = false;
			if (!$payment_linkpointStatus) {
				$payment_linkpointStatus = off;
				$linkpoint_recurringCheckbox = off;
				$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'LINKPOINT_%'";
				$result = $dbObj->query($sql);
				while ($row = mysql_fetch_assoc($result)) {
					if ($row["name"] == "LINKPOINT_CONFIGFILE")  $linkpoint_configfile  = crypt_decrypt($row["value"]);
					if ($row["name"] == "LINKPOINT_KEYFILE")     $linkpoint_keyfile     = crypt_decrypt($row["value"]);
				}
			} else {
				if (!$linkpoint_recurringCheckbox) {
					$linkpoint_recurringCheckbox = off;
					$sql_recurringtype = "UPDATE Setting_Payment SET value=' ' WHERE name='LINKPOINT_RECURRINGTYPE' LIMIT 1";
					$sql_login = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($linkpoint_configfile))."' WHERE name='LINKPOINT_CONFIGFILE' LIMIT 1";
					$sql_txnkey = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($linkpoint_keyfile))."' WHERE name='LINKPOINT_KEYFILE' LIMIT 1";
		
					if (!$dbObj->query($sql_recurringtype) || !$dbObj->query($sql_login) || !$dbObj->query($sql_txnkey))	$error_linkpoint = true;
				} else {
					
					$sql_recurringlength = "UPDATE Setting_Payment SET value='".$recurringtype_linkpoint."' WHERE name='LINKPOINT_RECURRINGTYPE' LIMIT 1";
					$sql_login = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($linkpoint_configfile))."' WHERE name='LINKPOINT_CONFIGFILE' LIMIT 1";
					$sql_txnkey = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($linkpoint_keyfile))."' WHERE name='LINKPOINT_KEYFILE' LIMIT 1";
					if (!$dbObj->query($sql_recurringlength) || !$dbObj->query($sql_login) || !$dbObj->query($sql_txnkey)) {
						$error_linkpoint   = true;
					}
					if ($error_linkpoint == true) $arrayError = $arrayError."error_linkpoint,";
				}
			}
			$sql = "UPDATE Setting_Payment SET value='".$payment_linkpointStatus."' WHERE name='LINKPOINT_STATUS'";
			$dbObj->query($sql);
			$sql = "UPDATE Setting_Payment SET value='".$linkpoint_recurringCheckbox."' WHERE name='LINKPOINT_RECURRING'";
			$dbObj->query($sql);

			//AUTHORIZE
			$error_authorize   = false;
			if (!$payment_authorizeStatus) {
				$payment_authorizeStatus = off;
				$authorize_recurringCheckbox = off;
				$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'AUTHORIZE_%'";
				$result = $dbObj->query($sql);
				while ($row = mysql_fetch_assoc($result)) {
					if ($row["name"] == "AUTHORIZE_LOGIN")  $authorize_login  = crypt_decrypt($row["value"]);
					if ($row["name"] == "AUTHORIZE_TXNKEY") $authorize_txnkey = crypt_decrypt($row["value"]);
				}
			} else {
				if (!$authorize_recurringCheckbox) {
					$authorize_recurringCheckbox = off;
					$sql_recurringtype = "UPDATE Setting_Payment SET value=' ' WHERE name='AUTHORIZE_RECURRINGLENGTH' LIMIT 1";
					$sql_login = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($authorize_login))."' WHERE name='AUTHORIZE_LOGIN' LIMIT 1";
					$sql_txnkey = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($authorize_txnkey))."' WHERE name='AUTHORIZE_TXNKEY' LIMIT 1";
					if (!$dbObj->query($sql_recurringtype) || !$dbObj->query($sql_login) || !$dbObj->query($sql_txnkey)) $error_authorize = true;

				} else {
					$sql_login = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($authorize_login))."' WHERE name='AUTHORIZE_LOGIN' LIMIT 1";
					$sql_txnkey = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($authorize_txnkey))."' WHERE name='AUTHORIZE_TXNKEY' LIMIT 1";
					$sql_recurringlength = "UPDATE Setting_Payment SET value='".$recurringlength_authorize."' WHERE name='AUTHORIZE_RECURRINGLENGTH' LIMIT 1";
					if (!$dbObj->query($sql_recurringlength) || !$dbObj->query($sql_login) || !$dbObj->query($sql_txnkey)) $error_authorize = true;
					if ($error_authorize == true) $arrayError = $arrayError."error_authorize,";
				}
			}
			$sql = "UPDATE Setting_Payment SET value='".$payment_authorizeStatus."' WHERE name='AUTHORIZE_STATUS'";
			$dbObj->query($sql);
			$sql = "UPDATE Setting_Payment SET value='".$authorize_recurringCheckbox."' WHERE name='AUTHORIZE_RECURRING'";
			$dbObj->query($sql);
            
            //PAGSEGURO
			$error_pagseguro   = false;
			if (!$payment_pagseguroStatus) {
				$payment_pagseguroStatus = off;
				$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'PAGSEGURO_%'";
				$result = $dbObj->query($sql);
				while ($row = mysql_fetch_assoc($result)) {
					if ($row["name"] == "PAGSEGURO_EMAIL") $pagseguro_email  = crypt_decrypt($row["value"]);
					if ($row["name"] == "PAGSEGURO_TOKEN") $pagseguro_token = crypt_decrypt($row["value"]);
				}
			} else {
                $sql_email = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($pagseguro_email))."' WHERE name='PAGSEGURO_EMAIL' LIMIT 1";
                $sql_token = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($pagseguro_token))."' WHERE name='PAGSEGURO_TOKEN' LIMIT 1";
                if (!$dbObj->query($sql_email) || !$dbObj->query($sql_token)) $error_pagseguro = true;
                if ($error_pagseguro == true) $arrayError = $arrayError."error_pagseguro,";
			}
			$sql = "UPDATE Setting_Payment SET value='".$payment_pagseguroStatus."' WHERE name='PAGSEGURO_STATUS'";
			$dbObj->query($sql);
		}

		if ($arrayError) {
			$arrayError = string_substr($arrayError, 0, -1);
			$modules = array("currency", "item", "payment", "paypal", "simplepay", "creditcard", "pagseguro");
			$aux_module = explode("_", $settingSection);
			$module = array_search($aux_module[0], $modules);
			if ($module) $paramRedirect = "&module=$module";
			else $paramRedirect = "";
			header("Location: ".DEFAULT_URL."/sitemgr/prefs/paymentgateway.php?arrayError=".$arrayError.$paramRedirect);
		} else {
			$sql = "UPDATE Setting_Payment SET value='".$currency_symbol."' WHERE name='CURRENCY_SYMBOL'";
			$dbObj->query($sql);
			$sql = "UPDATE Setting_Payment SET value='".$payment_currency."' WHERE name='PAYMENT_CURRENCY'";
			$dbObj->query($sql);
			$sql = "UPDATE Setting_Payment SET value='".$select_listing.$listingPeriod."' WHERE name='LISTING_RENEWAL_PERIOD'";
			$dbObj->query($sql);
			$sql = "UPDATE Setting_Payment SET value='".$select_event.$eventPeriod."' WHERE name='EVENT_RENEWAL_PERIOD'";
			$dbObj->query($sql);
			$sql = "UPDATE Setting_Payment SET value='".$select_banner.$bannerPeriod."' WHERE name='BANNER_RENEWAL_PERIOD'";
			$dbObj->query($sql);
			$sql = "UPDATE Setting_Payment SET value='".$select_classified.$classifiedPeriod."' WHERE name='CLASSIFIED_RENEWAL_PERIOD'";
			$dbObj->query($sql);
			$sql = "UPDATE Setting_Payment SET value='".$select_article.$articlePeriod."' WHERE name='ARTICLE_RENEWAL_PERIOD'";
			$dbObj->query($sql);

			$array_PaymentSetting = array('payment_simplepayStatus'=>$payment_simplepayStatus,
									  'payment_paypalStatus'=>$payment_paypalStatus,
									  'payment_paypalapiStatus'=>$payment_paypalapiStatus,
									  'payment_payflowStatus'=>$payment_payflowStatus,
									  'payment_twocheckoutStatus'=>$payment_twocheckoutStatus,
									  'payment_psigateStatus'=>$payment_psigateStatus,
									  'payment_worldpayStatus'=>$payment_worldpayStatus,
									  'payment_itransactStatus'=>$payment_itransactStatus,
									  'payment_linkpointStatus'=>$payment_linkpointStatus,
									  'payment_authorizeStatus'=>$payment_authorizeStatus,
									  'payment_pagseguroStatus'=>$payment_pagseguroStatus,
									  'payment_simplepayRecurring'=>$simplepay_recurringCheckbox,
									  'payment_paypalRecurring'=>$paypal_recurringCheckbox,
									  'payment_linkpointRecurring'=>$linkpoint_recurringCheckbox,
									  'payment_authorizeRecurring'=>$authorize_recurringCheckbox,
									  'renewal_periodListing'=>$select_listing.$listingPeriod,
									  'renewal_periodEvent'=>$select_event.$eventPeriod,
									  'renewal_periodBanner'=>$select_banner.$bannerPeriod,
									  'renewal_periodClassified'=>$select_classified.$classifiedPeriod,
									  'renewal_periodArticle'=>$select_article.$articlePeriod,
									  'payment_currency'=>$payment_currency,
									  'currency_symbol'=>$currency_symbol,
									  'invoice_payment'=>$invoice_payment,
									  'manual_payment'=>$manual_payment);
			
			payment_writeSettingPaymentFile($array_PaymentSetting);
			$arrayError = string_substr($arrayError, 0, -1);
			$modules = array("currency", "item", "payment", "paypal", "simplepay", "creditcard", "pagseguro");
			$aux_module = explode("_", $settingSection);
			$module = array_search($aux_module[0], $modules);
			if ($module) $paramRedirect = "&module=$module";
			else $paramRedirect = "";
			header("Location: ".DEFAULT_URL."/sitemgr/prefs/paymentgateway.php?success_payment=true$paramRedirect");
		}
		exit;
	} else {
		$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'CURRENCY_SYMBOL'";
		$result = $dbObj->query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			$currency_symbol = $row["value"];
		}
		$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'PAYMENT_CURRENCY'";
		$result = $dbObj->query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			$payment_currency = $row["value"];
		}
		$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'INVOICEPAYMENT_FEATURE'";
		$result = $dbObj->query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			$invoice_payment  = $row["value"];
		}
		$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'MANUALPAYMENT_FEATURE'";
		$result = $dbObj->query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			$manual_payment  = $row["value"];
		}
		$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'SIMPLEPAY_%'";
		$result = $dbObj->query($sql);
		
		while ($row = mysql_fetch_assoc($result)) {
			if ($row["name"] == "SIMPLEPAY_ACCESSKEY")  $simplepay_accesskey  = crypt_decrypt($row["value"]);
			if ($row["name"] == "SIMPLEPAY_SECRETKEY")  $simplepay_secretkey  = crypt_decrypt($row["value"]);
			if ($row["name"] == "SIMPLEPAY_STATUS")  $payment_simplepayStatus  = $row["value"];
			if ($row["name"] == "SIMPLEPAY_RECURRING")  $simplepay_recurringCheckbox  = $row["value"];
			if ($row["name"] == "SIMPLEPAY_RECURRINGCYCLE")  $simplepay_recurringcycle  = $row["value"];
			if ($row["name"] == "SIMPLEPAY_RECURRINGTIMES")  $simplepay_recurringtimes  = $row["value"];
			if ($row["name"] == "SIMPLEPAY_RECURRINGUNIT")  $simplepay_recurringunit  = $row["value"];
		}
		
		$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'PAYPAL_%'";
		$result = $dbObj->query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			if ($row["name"] == "PAYPAL_ACCOUNT")  $paypal_account  = crypt_decrypt($row["value"]);
			if ($row["name"] == "PAYPAL_STATUS")  $payment_paypalStatus  = $row["value"];
			if ($row["name"] == "PAYPAL_RECURRING")  $paypal_recurringCheckbox  = $row["value"];
			if ($row["name"] == "PAYPAL_RECURRINGCYCLE")  $paypal_recurringcycle  = $row["value"];
			if ($row["name"] == "PAYPAL_RECURRINGTIMES")  $paypal_recurringtimes  = $row["value"];
			if ($row["name"] == "PAYPAL_RECURRINGUNIT")  $paypal_recurringunit  = $row["value"];
		}
		
		$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'PAYPALAPI_%'";
		$result = $dbObj->query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			if ($row["name"] == "PAYPALAPI_STATUS")  $payment_paypalapiStatus   = $row["value"];
			if ($row["name"] == "PAYPALAPI_USERNAME")  $paypalapi_username  = crypt_decrypt($row["value"]);
			if ($row["name"] == "PAYPALAPI_PASSWORD")  $paypalapi_password  = crypt_decrypt($row["value"]);
			if ($row["name"] == "PAYPALAPI_SIGNATURE")  $paypalapi_signature  = crypt_decrypt($row["value"]);
		}
		
		$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'PAYFLOW_%'";
		$result = $dbObj->query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			if ($row["name"] == "PAYFLOW_STATUS")  $payment_payflowStatus  = $row["value"];
			if ($row["name"] == "PAYFLOW_LOGIN")  $payflow_login  = crypt_decrypt($row["value"]);
			if ($row["name"] == "PAYFLOW_PARTNER")  $payflow_partner = crypt_decrypt($row["value"]);
		}

		$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'TWOCHECKOUT_%'";
		$result = $dbObj->query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			if ($row["name"] == "TWOCHECKOUT_STATUS")  $payment_twocheckoutStatus  = $row["value"];
			if ($row["name"] == "TWOCHECKOUT_LOGIN")  $twocheckout_login  = crypt_decrypt($row["value"]);
		}

		$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'PSIGATE_%'";
		$result = $dbObj->query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			if ($row["name"] == "PSIGATE_STATUS")  $payment_psigateStatus  = $row["value"];
			if ($row["name"] == "PSIGATE_STOREID")  $psigate_storeid  = crypt_decrypt($row["value"]);
			if ($row["name"] == "PSIGATE_PASSPHRASE")  $psigate_passphrase = crypt_decrypt($row["value"]);
		}

		$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'WORLDPAY_%'";
		$result = $dbObj->query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			if ($row["name"] == "WORLDPAY_STATUS")  $payment_worldpayStatus  = $row["value"];
			if ($row["name"] == "WORLDPAY_INSTID")  $worldpay_instid  = crypt_decrypt($row["value"]);
		}

		$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'ITRANSACT_%'";
		$result = $dbObj->query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			if ($row["name"] == "ITRANSACT_STATUS")  $payment_itransactStatus  = $row["value"];
			if ($row["name"] == "ITRANSACT_VENDORID")  $itransact_vendorid  = crypt_decrypt($row["value"]);
		}		
		
		$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'LINKPOINT_%'";
		$result = $dbObj->query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			if ($row["name"] == "LINKPOINT_CONFIGFILE")  $linkpoint_configfile  = crypt_decrypt($row["value"]);
			if ($row["name"] == "LINKPOINT_KEYFILE")  $linkpoint_keyfile  = crypt_decrypt($row["value"]);
			if ($row["name"] == "LINKPOINT_STATUS")  $payment_linkpointStatus  = $row["value"];
			if ($row["name"] == "LINKPOINT_RECURRING")  $linkpoint_recurringCheckbox  = $row["value"];
			if ($row["name"] == "LINKPOINT_RECURRINGTYPE")  $linkpoint_recurringtype  = $row["value"];
		}
		
		$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'AUTHORIZE_%'";
		$result = $dbObj->query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			if ($row["name"] == "AUTHORIZE_LOGIN")  $authorize_login  = crypt_decrypt($row["value"]);
			if ($row["name"] == "AUTHORIZE_TXNKEY")  $authorize_txnkey  = crypt_decrypt($row["value"]);
			if ($row["name"] == "AUTHORIZE_STATUS")  $payment_authorizeStatus  = $row["value"];
			if ($row["name"] == "AUTHORIZE_RECURRING")  $authorize_recurringCheckbox  = $row["value"];
			if ($row["name"] == "AUTHORIZE_RECURRINGLENGTH")  $authorize_recurringlength  = $row["value"];
		}
        
        $sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'PAGSEGURO_%'";
		$result = $dbObj->query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			if ($row["name"] == "PAGSEGURO_EMAIL")  $pagseguro_email  = crypt_decrypt($row["value"]);
			if ($row["name"] == "PAGSEGURO_TOKEN")  $pagseguro_token  = crypt_decrypt($row["value"]);
			if ($row["name"] == "PAGSEGURO_STATUS") $payment_pagseguroStatus  = $row["value"];
		}
		
		$sql = "SELECT * FROM Setting_Payment WHERE name LIKE '%_RENEWAL_PERIOD'";
		$result = $dbObj->query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			if ($row["name"] == "LISTING_RENEWAL_PERIOD") {
				$value_listing = $row["value"];
				if (string_strlen($value_listing) > 2) {
					if ($value_listing[2]=="D")
						$listingPD = $value_listing[0].$value_listing[1];
					elseif ($value_listing[2]=="M")
						$listingPM = $value_listing[0].$value_listing[1];
					elseif ($value_listing[2]=="Y")
						$listingPY = $value_listing[0].$value_listing[1];
					$select_listing = $value_listing[2];
				} else {
					if ($value_listing[1]=="D")
						$listingPD = $value_listing[0];
					elseif ($value_listing[1]=="M")
						$listingPM = $value_listing[0];
					elseif ($value_listing[1]=="Y")
						$listingPY = $value_listing[0];
					$select_listing = $value_listing[1];
				}
				
			}
			if ($row["name"] == "EVENT_RENEWAL_PERIOD") {
				$value_event = $row["value"];
				if (string_strlen($value_event) > 2) {
					if ($value_event[2]=="D")
						$eventPD = $value_event[0].$value_event[1];
					elseif ($value_event[2]=="M")
						$eventPM = $value_event[0].$value_event[1];
					elseif ($value_event[2]=="Y")
						$eventPY = $value_event[0].$value_event[1];
					$select_event = $value_event[2];
				} else {
					if ($value_event[1]=="D")
						$eventPD = $value_event[0];
					elseif ($value_event[1]=="M")
						$eventPM = $value_event[0];
					elseif ($value_event[1]=="Y")
						$eventPY = $value_event[0];
					$select_event = $value_event[1];
				}
				
			}
			if ($row["name"] == "BANNER_RENEWAL_PERIOD") {
				$value_banner = $row["value"];
				if (string_strlen($value_banner) > 2) {
					if ($value_banner[2]=="D")
						$bannerPD = $value_banner[0].$value_banner[1];
					elseif ($value_banner[2]=="M")
						$bannerPM = $value_banner[0].$value_banner[1];
					elseif ($value_banner[2]=="Y")
						$bannerPY = $value_banner[0].$value_banner[1];
					$select_banner = $value_banner[2];
				} else {
					if ($value_banner[1]=="D")
						$bannerPD = $value_banner[0];
					elseif ($value_banner[1]=="M")
						$bannerPM = $value_banner[0];
					elseif ($value_banner[1]=="Y")
						$bannerPY = $value_banner[0];
					$select_banner = $value_banner[1];
				}
			}
			if ($row["name"] == "CLASSIFIED_RENEWAL_PERIOD") {
				$value_classified = $row["value"];
				if (string_strlen($value_classified) > 2) {
					if ($value_classified[2]=="D")
						$classifiedPD = $value_classified[0].$value_classified[1];
					elseif ($value_classified[2]=="M")
						$classifiedPM = $value_classified[0].$value_classified[1];
					elseif ($value_classified[2]=="Y")
						$classifiedPY = $value_classified[0].$value_classified[1];
					$select_classified = $value_classified[2];
				} else {
					if ($value_classified[1]=="D")
						$classifiedPD = $value_classified[0];
					elseif ($value_classified[1]=="M")
						$classifiedPM = $value_classified[0];
					elseif ($value_classified[1]=="Y")
						$classifiedPY = $value_classified[0];
					$select_classified = $value_classified[1];
				}
			}
			if ($row["name"] == "ARTICLE_RENEWAL_PERIOD") {
				$value_article = $row["value"];
				if (string_strlen($value_article) > 2) {
					if ($value_article[2]=="D")
						$articlePD = $value_article[0].$value_article[1];
					elseif ($value_article[2]=="M")
						$articlePM = $value_article[0].$value_article[1];
					elseif ($value_article[2]=="Y")
						$articlePY = $value_article[0].$value_article[1];
					$select_article = $value_article[2];
				} else {
					if ($value_article[1]=="D")
						$articlePD = $value_article[0];
					elseif ($value_article[1]=="M")
						$articlePM = $value_article[0];
					elseif ($value_article[1]=="Y")
						$articlePY = $value_article[0];
					$select_article = $value_article[1];
				}
			}
		}
	}
?>