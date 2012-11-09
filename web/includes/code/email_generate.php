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
	# * FILE: /includes/code/email_generate.php
	# ----------------------------------------------------------------------------------------------------

	/*
	 * Current support is 16.777.216 emails
	 * (64K rows * 256 cols)
	**/

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($_POST["eg"] == "all") {
			$sql = "SELECT DISTINCT(email) FROM Listing WHERE email != '' ORDER BY email";
			$listings = db_getFromDBBySQL("listing", $sql, "array", false, SELECTED_DOMAIN_ID);
		}

		if ($_POST["eg"] == "location") {
			if ($_POST["location"]) {
				list($fld_name, $fld_value) = explode(":", $_POST["location"]);
				$sql = "SELECT DISTINCT(email) FROM Listing WHERE email != '' AND $fld_name = '$fld_value'";
				$listings = db_getFromDBBySQL("listing", $sql, "array", false, SELECTED_DOMAIN_ID);
			}
		}

		if ($_POST["eg"] == "category") {
			if ($_POST["category_id"]) {
				$sql = "SELECT listing_id FROM Listing_Category WHERE category_id = {$_POST["category_id"]}";
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				$r = $db->query($sql);
				while ($row = mysql_fetch_object($r)) {
					$listing_ids .= $row->listing_id.",";
				}
				$listing_ids = string_substr($listing_ids, 0, string_strlen($listing_ids)-1);
				if ($listing_ids) {
					$sql = "SELECT DISTINCT(email) FROM Listing Where id IN ($listing_ids) AND email != '' ORDER BY email";
					$dbMain = db_getDBObject(DEFAULT_DB, true);
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
					$r = $db->query($sql);
					while ($row = mysql_fetch_assoc($r)) {
						$listings[] = $row;
					}
				}
			}
		}

		if ($listings) {
			$listings_total = count($listings);
			$limit_rows = 65536;
			$limit_cols = 256;
			if ($listings_total<$limit_rows) {
				$limit_rows = $listings_total;
			} else {
				$limit_total = $limit_rows * $limit_cols;
				$listings_total = count($listings) < $limit_total ? count($listings) : $limit_total;
			}
			$cols = ceil($listings_total/$limit_rows);
			$emails = "";
			for ($i=0; $i < $limit_rows; $i++) {
				for ($j=0; $j < $cols; $j++) {
					$emails .= $listings[$i]["email"].";";
					$i = $i + $j;
				}
				$emails .= "\r\n";
			}
			header("Expires: Mon, 1 Apr 1974 05:00:00 GMT\r\n");
			header("Last-modified: ".gmdate("D,d M Y H:i:s")." GMT\r\n");
			header("Cache-control: private\r\n");
			header("Content-type: application/csv\r\n");
			header("Content-disposition: attachment; filename=\"emails.csv\"\r\n");
			header("Pragma: public\r\n");
			echo $emails;
			exit;
		} else {
			$error = system_showText(LANG_SITEMGR_EXPORT_PAYMENT_NOEMAILSWEREFOUND);
		}

	}

?>
