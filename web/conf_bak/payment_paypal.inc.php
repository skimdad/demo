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
	# * FILE: /conf/payment_paypal.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# PAYPAL CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	if (PAYPALPAYMENT_FEATURE == "on") {
		$dbObjPayment = db_getDBObject();
		if (REALTRANSACTION == "on") {
			$paypal_account = "";
			$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'PAYPAL_%'";
			$result = $dbObjPayment->query($sql);
			while ($row = mysql_fetch_assoc($result)) {
				if ($row["name"] == "PAYPAL_ACCOUNT") $paypal_account = crypt_decrypt($row["value"]);
			}
			define("PAYPAL_ACCOUNT",    $paypal_account);
			define("PAYPAL_URL",        "www.paypal.com");
		} else {
			define("PAYPAL_ACCOUNT",    "test@demodirectory.com");
			define("PAYPAL_URL",        "www.sandbox.paypal.com");
		}
		define("PAYPAL_URL_FOLDER", "/cgi-bin/webscr");
		define("PAYPAL_LC",         "US");
		define("PAYPAL_CURRENCY",   PAYMENT_CURRENCY);
		if (PAYPALRECURRING_FEATURE == "on") {
			
			$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'PAYPAL_RECURRING%'";
			$result = $dbObjPayment->query($sql);
			while ($row = mysql_fetch_assoc($result)) {
				if ($row["name"] == "PAYPAL_RECURRINGCYCLE")  $paypal_recurringcycle  = $row["value"];
				if ($row["name"] == "PAYPAL_RECURRINGTIMES")  $paypal_recurringtimes  = $row["value"];
				if ($row["name"] == "PAYPAL_RECURRINGUNIT")   $paypal_recurringunit   = $row["value"];
			}
			// these lines below must match to all *_RENEWAL_PERIOD constants
			// all *_RENEWAL_PERIOD must be PAYPAL_RECURRINGCYCLE plus PAYPAL_RECURRINGUNIT
			define("PAYPAL_RECURRINGCYCLE", $paypal_recurringcycle);
			define("PAYPAL_RECURRINGTIMES", $paypal_recurringtimes);
			// 0 (zero) means unlimited
			define("PAYPAL_RECURRINGUNIT",  $paypal_recurringunit);
		}
		unset($dbObjPayment);
	}
?>