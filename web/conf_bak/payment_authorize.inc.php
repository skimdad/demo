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
	# * FILE: /conf/payment_authorize.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUTHORIZE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	if (AUTHORIZEPAYMENT_FEATURE == "on") {
		$dbObjPayment = db_getDBObject();
		if (REALTRANSACTION == "on") {
			$authorize_login = "";
			$authorize_txnkey = "";
			$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'AUTHORIZE_%'";
			$result = $dbObjPayment->query($sql);
			while ($row = mysql_fetch_assoc($result)) {
				if ($row["name"] == "AUTHORIZE_LOGIN") $authorize_login = crypt_decrypt($row["value"]);
				if ($row["name"] == "AUTHORIZE_TXNKEY") $authorize_txnkey = crypt_decrypt($row["value"]);
			}
			define("AUTHORIZE_LOGIN",   $authorize_login);
			define("AUTHORIZE_TXNKEY",  $authorize_txnkey);
			if (AUTHORIZERECURRING_FEATURE == "on") {
				define("AUTHORIZE_POST_URL",    "https://api.authorize.net/xml/v1/request.api");
			} else {
				define("AUTHORIZE_POST_URL",    "https://secure.authorize.net/gateway/transact.dll");
			}
		} else {
			define("AUTHORIZE_LOGIN",   "cnpdev3208");
			define("AUTHORIZE_TXNKEY",  "1bWa98VGylvkkJFM");
			if (AUTHORIZERECURRING_FEATURE == "on") {
				define("AUTHORIZE_POST_URL",    "https://apitest.authorize.net/xml/v1/request.api");
			} else {
				define("AUTHORIZE_POST_URL",    "https://test.authorize.net/gateway/transact.dll");
			}
		}
		define("AUTHORIZE_CURRENCY", PAYMENT_CURRENCY);
		if (AUTHORIZERECURRING_FEATURE == "on") {
			$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'AUTHORIZE_RECURRING%'";
			$result = $dbObjPayment->query($sql);
			while ($row = mysql_fetch_assoc($result)) {
				if ($row["name"] == "AUTHORIZE_RECURRINGLENGTH")  $authorize_recurringlength  = $row["value"];
				if ($row["name"] == "AUTHORIZE_RECURRINGUNIT")  $authorize_recurringunit  = $row["value"];
			}
			// these lines below must match to all *_RENEWAL_PERIOD constants
			// AUTHORIZE_RECURRINGLENGTH = "1" for monthly OR "12" for annual
			// AUTHORIZE_RECURRINGUNIT = "months"
			// all *_RENEWAL_PERIOD must be AUTHORIZE_RECURRINGLENGTH plus "M"
			define("AUTHORIZE_RECURRINGLENGTH", $authorize_recurringlength);
			define("AUTHORIZE_RECURRINGUNIT",   $authorize_recurringunit);
		}
		unset($dbObjPayment);
	}

?>