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
	# * FILE: /conf/payment_simplepay.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SIMPLEPAY CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	if (SIMPLEPAYPAYMENT_FEATURE == "on") {
		$dbObjPayment = db_getDBObject();
		if (REALTRANSACTION == "on") {
			$simplepay_accesskey = "";
			$simplepay_secretkey = "";
			$dbObjPayment = db_getDBObject();
			$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'SIMPLEPAY_%'";
			$result = $dbObjPayment->query($sql);
			while ($row = mysql_fetch_assoc($result)) {
				if ($row["name"] == "SIMPLEPAY_ACCESSKEY") $simplepay_accesskey = crypt_decrypt($row["value"]);
				if ($row["name"] == "SIMPLEPAY_SECRETKEY") $simplepay_secretkey = crypt_decrypt($row["value"]);
			}
			define("SIMPLEPAY_ACCESSKEY",   $simplepay_accesskey);
			define("SIMPLEPAY_SECRETKEY",   $simplepay_secretkey);
			define("SIMPLEPAY_URL",         "https://authorize.payments.amazon.com/pba/paypipeline");
		} else {
			define("SIMPLEPAY_ACCESSKEY",   "AKIAJ6M2ZXCG25QOU5JQ");
			define("SIMPLEPAY_SECRETKEY",   "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");
			define("SIMPLEPAY_URL",         "https://authorize.payments-sandbox.amazon.com/pba/paypipeline");
		}
		define("SIMPLEPAY_CURRENCY",        PAYMENT_CURRENCY);
		if (SIMPLEPAYRECURRING_FEATURE == "on") {
			$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'SIMPLEPAY_RECURRING%'";
			$result = $dbObjPayment->query($sql);
			while ($row = mysql_fetch_assoc($result)) {
				if ($row["name"] == "SIMPLEPAY_RECURRINGCYCLE")  $simplepay_recurringcycle  = $row["value"];
				if ($row["name"] == "SIMPLEPAY_RECURRINGTIMES")  $simplepay_recurringtimes  = $row["value"];
				if ($row["name"] == "SIMPLEPAY_RECURRINGUNIT")   $simplepay_recurringunit   = $row["value"];
			}
			// these lines below must match to all *_RENEWAL_PERIOD constants
			// SIMPLEPAY_RECURRINGUNIT = "month"/"year"
			// all *_RENEWAL_PERIOD must be SIMPLEPAY_RECURRINGCYCLE plus "M"/"Y"
			define("SIMPLEPAY_RECURRINGCYCLE",  $simplepay_recurringcycle);
			define("SIMPLEPAY_RECURRINGUNIT",   $simplepay_recurringunit);
			// blank means unlimited
			define("SIMPLEPAY_RECURRINGTIMES",  $simplepay_recurringtimes);
		}
		unset($dbObjPayment);
	}

?>