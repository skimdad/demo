#!/usr/bin/php -q
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
	# * FILE: /cron/report_rollup.php
	# ----------------------------------------------------------------------------------------------------

	////////////////////////////////////////////////////////////////////////////////////////////////////
	// Reports:
	// - Article
	// - Banner
	// - Classified
	// - Event
	// - Listing
	// - Blog
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	ini_set("html_errors", FALSE);
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$path = "";
	$full_name = "";
	$file_name = "";
	$full_name = $_SERVER["SCRIPT_FILENAME"];
	if (strlen($full_name) > 0) {
		$osslash = ((strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') ? '\\' : '/');
		$file_pos = strpos($full_name, $osslash."cron".$osslash);
		if ($file_pos !== false) {
			$file_name = substr($full_name, $file_pos);
		}
		$path = substr($full_name, 0, (strlen($file_name)*(-1)));
	}
	if (strlen($path) == 0) $path = "..";
	define("EDIRECTORY_ROOT", $path);
	define("BIN_PATH", EDIRECTORY_ROOT."/bin");
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$_inCron = true;
	include_once(EDIRECTORY_ROOT."/conf/config.inc.php");


	////////////////////////////////////////////////////////////////////////////////////////////////////
	function getmicrotime() {
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}
	$time_start = getmicrotime();
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$host = _DIRECTORYDB_HOST;
	$db   = _DIRECTORYDB_NAME;
	$user = _DIRECTORYDB_USER;
	$pass = _DIRECTORYDB_PASS;
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$link = mysql_connect($host, $user, $pass);
	mysql_query("SET NAMES 'utf8'", $link);
	mysql_query('SET character_set_connection=utf8', $link);
	mysql_query('SET character_set_client=utf8', $link);
	mysql_query('SET character_set_results=utf8', $link);
	mysql_select_db($db);
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$sqlDomain = "	SELECT
						D.`id`, D.`database_host`, D.`database_port`, D.`database_username`, D.`database_password`, D.`database_name`, D.`url`
					FROM `Domain` AS D
					LEFT JOIN `Control_Cron` AS CC ON (CC.`domain_id` = D.`id`)
					WHERE CC.`running` = 'N'
					AND CC.`type` = 'report_rollup'
					AND D.`status` = 'A'
					AND ADDDATE(CC.`last_run_date`, INTERVAL 1 DAY) <= NOW()
					ORDER BY
						IF (CC.`last_run_date` IS NULL, 0, 1),
						CC.`last_run_date`,
						D.`id`
					LIMIT 1";

	$resDomain = mysql_query($sqlDomain, $link);

	if (mysql_num_rows($resDomain) > 0) {
		$rowDomain = mysql_fetch_assoc($resDomain);
		define("SELECTED_DOMAIN_ID", $rowDomain["id"]);

		$sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'Y', `last_run_date` = NOW() WHERE `domain_id` = ".SELECTED_DOMAIN_ID." AND `type` = 'report_rollup'";
		mysql_query($sqlUpdate, $link);

	////////////////////////////////////////////////////////////////////////////////////////////////////
		$domainHost = $rowDomain["database_host"].($rowDomain["database_port"]? ":".$rowDomain["database_port"]: "");
		$domainUser = $rowDomain["database_username"];
		$domainPass = $rowDomain["database_password"];
		$domainDBName = $rowDomain["database_name"];
		$domainURL = $rowDomain["url"];

		$linkDomain = mysql_connect($domainHost, $domainUser, $domainPass, true);
		mysql_query("SET NAMES 'utf8'", $linkDomain);
		mysql_query('SET character_set_connection=utf8', $linkDomain);
		mysql_query('SET character_set_client=utf8', $linkDomain);
		mysql_query('SET character_set_results=utf8', $linkDomain);
		mysql_select_db($domainDBName);
	////////////////////////////////////////////////////////////////////////////////////////////////////
	} else {
		exit;
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	$_inCron = false;
	include_once(EDIRECTORY_ROOT."/conf/loadconfig.inc.php");
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	setting_get("last_report_rollup", $last_report_rollup);
	if (!$last_report_rollup) {
		if (!setting_set("last_report_rollup", "0000-00-00")) {
			setting_new("last_report_rollup", "0000-00-00");
			setting_get("last_report_rollup", $last_report_rollup);
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	// Daily rollup
	////////////////////////////////////////////////////////////////////////////////////////////////////
	if (($last_report_rollup == "0000-00-00") || ($last_report_rollup < date("Y-m-d"))) {

		# ----------------------------------------------------------------------------------------------------
		# ARTICLE
		# ----------------------------------------------------------------------------------------------------
		if ($last_report_rollup != "0000-00-00") {
			$from_date = $last_report_rollup;
		} else {
			$sql = "SELECT min(date) FROM Report_Article";
			$result = mysql_query($sql, $linkDomain);
			if (mysql_num_rows($result) > 0) {
				$row = mysql_fetch_array($result);
				$from_date = string_substr($row[0], 0, strpos($row[0], " "));
			} else {
				$from_date = date("Y-m-d");
			}
		}
		if (!$from_date) $from_date = date("Y-m-d");
		$to_date = date("Y-m-d");
		while ($from_date < $to_date) {
			$sql = "SELECT article_id FROM Report_Article WHERE DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."' ORDER BY article_id";
			$result = mysql_query($sql, $linkDomain);
			if (mysql_num_rows($result) > 0) {
				while ($row = mysql_fetch_array($result)) {

					$sqlAux = "SELECT report_amount FROM Report_Article WHERE article_id = '".$row[0]."' AND report_type = '".ARTICLE_REPORT_SUMMARY_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $linkDomain);
					$rowAux = mysql_fetch_array($resultAux);
					$summary_view = (int)$rowAux["report_amount"];

					$sqlAux = "SELECT report_amount FROM Report_Article WHERE article_id = '".$row[0]."' AND report_type = '".ARTICLE_REPORT_DETAIL_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $linkDomain);
					$rowAux = mysql_fetch_array($resultAux);
					$detail_view = (int)$rowAux["report_amount"];

					$sql = "INSERT INTO Report_Article_Daily (article_id, day, summary_view, detail_view) VALUES ('".$row[0]."', '".$from_date."', ".$summary_view.", ".$detail_view.")";
					mysql_query($sql, $linkDomain);

				}
			}
			$from_date = explode("-", $from_date);
			$from_date = date("Y-m-d", mktime(0, 0, 0, (int)$from_date[1], (int)$from_date[2]+1, (int)$from_date[0]));
		}

		# ----------------------------------------------------------------------------------------------------
		# BLOG
		# ----------------------------------------------------------------------------------------------------
		if ($last_report_rollup != "0000-00-00") {
			$from_date = $last_report_rollup;
		} else {
			$sql = "SELECT min(date) FROM Report_Post";
			$result = mysql_query($sql, $linkDomain);
			if (mysql_num_rows($result) > 0) {
				$row = mysql_fetch_array($result);
				$from_date = string_substr($row[0], 0, strpos($row[0], " "));
			} else {
				$from_date = date("Y-m-d");
			}
		}
		if (!$from_date) $from_date = date("Y-m-d");
		$to_date = date("Y-m-d");
		while ($from_date < $to_date) {
			$sql = "SELECT post_id FROM Report_Post WHERE DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."' ORDER BY post_id";
			$result = mysql_query($sql, $linkDomain);
			if (mysql_num_rows($result) > 0) {
				while ($row = mysql_fetch_array($result)) {

					$sqlAux = "SELECT report_amount FROM Report_Post WHERE post_id = '".$row[0]."' AND report_type = '".POST_REPORT_SUMMARY_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $linkDomain);
					$rowAux = mysql_fetch_array($resultAux);
					$summary_view = (int)$rowAux["report_amount"];

					$sqlAux = "SELECT report_amount FROM Report_Post WHERE post_id = '".$row[0]."' AND report_type = '".POST_REPORT_DETAIL_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $linkDomain);
					$rowAux = mysql_fetch_array($resultAux);
					$detail_view = (int)$rowAux["report_amount"];

					$sql = "INSERT INTO Report_Post_Daily (post_id, day, summary_view, detail_view) VALUES ('".$row[0]."', '".$from_date."', ".$summary_view.", ".$detail_view.")";
					mysql_query($sql, $linkDomain);

				}
			}
			$from_date = explode("-", $from_date);
			$from_date = date("Y-m-d", mktime(0, 0, 0, (int)$from_date[1], (int)$from_date[2]+1, (int)$from_date[0]));
		}

		# ----------------------------------------------------------------------------------------------------
		# BANNER
		# ----------------------------------------------------------------------------------------------------
		if ($last_report_rollup != "0000-00-00") {
			$from_date = $last_report_rollup;
		} else {
			$sql = "SELECT min(date) FROM Report_Banner";
			$result = mysql_query($sql, $linkDomain);
			if (mysql_num_rows($result) > 0) {
				$row = mysql_fetch_array($result);
				$from_date = string_substr($row[0], 0, strpos($row[0], " "));
			} else {
				$from_date = date("Y-m-d");
			}
		}
		if (!$from_date) $from_date = date("Y-m-d");
		$to_date = date("Y-m-d");
		while ($from_date < $to_date) {
			$sql = "SELECT banner_id FROM Report_Banner WHERE DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."' ORDER BY banner_id";
			$result = mysql_query($sql, $linkDomain);
			if (mysql_num_rows($result) > 0) {
				while ($row = mysql_fetch_array($result)) {

					$sqlAux = "SELECT report_amount FROM Report_Banner WHERE banner_id = '".$row[0]."' AND report_type = '".BANNER_REPORT_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $linkDomain);
					$rowAux = mysql_fetch_array($resultAux);
					$view = (int)$rowAux["report_amount"];

					$sqlAux = "SELECT report_amount FROM Report_Banner WHERE banner_id = '".$row[0]."' AND report_type = '".BANNER_REPORT_CLICK_THRU."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $linkDomain);
					$rowAux = mysql_fetch_array($resultAux);
					$click_thru = (int)$rowAux["report_amount"];

					$sql = "INSERT INTO Report_Banner_Daily (banner_id, day, view, click_thru) VALUES ('".$row[0]."', '".$from_date."', ".$view.", ".$click_thru.")";
					mysql_query($sql, $linkDomain);

				}
			}
			$from_date = explode("-", $from_date);
			$from_date = date("Y-m-d", mktime(0, 0, 0, (int)$from_date[1], (int)$from_date[2]+1, (int)$from_date[0]));
		}

		# ----------------------------------------------------------------------------------------------------
		# CLASSIFIED
		# ----------------------------------------------------------------------------------------------------
		if ($last_report_rollup != "0000-00-00") {
			$from_date = $last_report_rollup;
		} else {
			$sql = "SELECT min(date) FROM Report_Classified";
			$result = mysql_query($sql, $linkDomain);
			if (mysql_num_rows($result) > 0) {
				$row = mysql_fetch_array($result);
				$from_date = string_substr($row[0], 0, strpos($row[0], " "));
			} else {
				$from_date = date("Y-m-d");
			}
		}
		if (!$from_date) $from_date = date("Y-m-d");
		$to_date = date("Y-m-d");
		while ($from_date < $to_date) {
			$sql = "SELECT classified_id FROM Report_Classified WHERE DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."' ORDER BY classified_id";
			$result = mysql_query($sql, $linkDomain);
			if (mysql_num_rows($result) > 0) {
				while ($row = mysql_fetch_array($result)) {

					$sqlAux = "SELECT report_amount FROM Report_Classified WHERE classified_id = '".$row[0]."' AND report_type = '".CLASSIFIED_REPORT_SUMMARY_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $linkDomain);
					$rowAux = mysql_fetch_array($resultAux);
					$summary_view = (int)$rowAux["report_amount"];

					$sqlAux = "SELECT report_amount FROM Report_Classified WHERE classified_id = '".$row[0]."' AND report_type = '".CLASSIFIED_REPORT_DETAIL_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $linkDomain);
					$rowAux = mysql_fetch_array($resultAux);
					$detail_view = (int)$rowAux["report_amount"];

					$sql = "INSERT INTO Report_Classified_Daily (classified_id, day, summary_view, detail_view) VALUES ('".$row[0]."', '".$from_date."', ".$summary_view.", ".$detail_view.")";
					mysql_query($sql, $linkDomain);

				}
			}
			$from_date = explode("-", $from_date);
			$from_date = date("Y-m-d", mktime(0, 0, 0, (int)$from_date[1], (int)$from_date[2]+1, (int)$from_date[0]));
		}

		# ----------------------------------------------------------------------------------------------------
		# EVENT
		# ----------------------------------------------------------------------------------------------------
		if ($last_report_rollup != "0000-00-00") {
			$from_date = $last_report_rollup;
		} else {
			$sql = "SELECT min(date) FROM Report_Event";
			$result = mysql_query($sql, $linkDomain);
			if (mysql_num_rows($result) > 0) {
				$row = mysql_fetch_array($result);
				$from_date = string_substr($row[0], 0, strpos($row[0], " "));
			} else {
				$from_date = date("Y-m-d");
			}
		}
		if (!$from_date) $from_date = date("Y-m-d");
		$to_date = date("Y-m-d");
		while ($from_date < $to_date) {
			$sql = "SELECT event_id FROM Report_Event WHERE DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."' ORDER BY event_id";
			$result = mysql_query($sql, $linkDomain);
			if (mysql_num_rows($result) > 0) {
				while ($row = mysql_fetch_array($result)) {

					$sqlAux = "SELECT report_amount FROM Report_Event WHERE event_id = '".$row[0]."' AND report_type = '".EVENT_REPORT_SUMMARY_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $linkDomain);
					$rowAux = mysql_fetch_array($resultAux);
					$summary_view = (int)$rowAux["report_amount"];

					$sqlAux = "SELECT report_amount FROM Report_Event WHERE event_id = '".$row[0]."' AND report_type = '".EVENT_REPORT_DETAIL_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $linkDomain);
					$rowAux = mysql_fetch_array($resultAux);
					$detail_view = (int)$rowAux["report_amount"];

					$sql = "INSERT INTO Report_Event_Daily (event_id, day, summary_view, detail_view) VALUES ('".$row[0]."', '".$from_date."', ".$summary_view.", ".$detail_view.")";
					mysql_query($sql, $linkDomain);

				}
			}
			$from_date = explode("-", $from_date);
			$from_date = date("Y-m-d", mktime(0, 0, 0, (int)$from_date[1], (int)$from_date[2]+1, (int)$from_date[0]));
		}

		# ----------------------------------------------------------------------------------------------------
		# LISTING
		# ----------------------------------------------------------------------------------------------------
		if ($last_report_rollup != "0000-00-00") {
			$from_date = $last_report_rollup;
		} else {
			$sql = "SELECT min(date) FROM Report_Listing";
			$result = mysql_query($sql, $linkDomain);
			if (mysql_num_rows($result) > 0) {
				$row = mysql_fetch_array($result);
				$from_date = string_substr($row[0], 0, strpos($row[0], " "));
			} else {
				$from_date = date("Y-m-d");
			}
		}
		if (!$from_date) $from_date = date("Y-m-d");
		$to_date = date("Y-m-d");
		while ($from_date < $to_date) {
			$sql = "SELECT listing_id FROM Report_Listing WHERE DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."' ORDER BY listing_id";
			$result = mysql_query($sql, $linkDomain);
			if (mysql_num_rows($result) > 0) {
				while ($row = mysql_fetch_array($result)) {

					$sqlAux = "SELECT report_amount FROM Report_Listing WHERE listing_id = '".$row[0]."' AND report_type = '".LISTING_REPORT_SUMMARY_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $linkDomain);
					$rowAux = mysql_fetch_array($resultAux);
					$summary_view = (int)$rowAux["report_amount"];

					$sqlAux = "SELECT report_amount FROM Report_Listing WHERE listing_id = '".$row[0]."' AND report_type = '".LISTING_REPORT_DETAIL_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $linkDomain);
					$rowAux = mysql_fetch_array($resultAux);
					$detail_view = (int)$rowAux["report_amount"];

					$sqlAux = "SELECT report_amount FROM Report_Listing WHERE listing_id = '".$row[0]."' AND report_type = '".LISTING_REPORT_CLICK_THRU."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $linkDomain);
					$rowAux = mysql_fetch_array($resultAux);
					$click_thru = (int)$rowAux["report_amount"];

					$sqlAux = "SELECT report_amount FROM Report_Listing WHERE listing_id = '".$row[0]."' AND report_type = '".LISTING_REPORT_EMAIL_SENT."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $linkDomain);
					$rowAux = mysql_fetch_array($resultAux);
					$email_sent = (int)$rowAux["report_amount"];

					$sqlAux = "SELECT report_amount FROM Report_Listing WHERE listing_id = '".$row[0]."' AND report_type = '".LISTING_REPORT_PHONE_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $linkDomain);
					$rowAux = mysql_fetch_array($resultAux);
					$phone_view = (int)$rowAux["report_amount"];

					$sqlAux = "SELECT report_amount FROM Report_Listing WHERE listing_id = '".$row[0]."' AND report_type = '".LISTING_REPORT_FAX_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $linkDomain);
					$rowAux = mysql_fetch_array($resultAux);
					$fax_view = (int)$rowAux["report_amount"];
					
					$sqlAux = "SELECT report_amount FROM Report_Listing WHERE listing_id = '".$row[0]."' AND report_type = '".LISTING_REPORT_SMS."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $linkDomain);
					$rowAux = mysql_fetch_array($resultAux);
					$send_phone = (int)$rowAux["report_amount"];
					
					$sqlAux = "SELECT report_amount FROM Report_Listing WHERE listing_id = '".$row[0]."' AND report_type = '".LISTING_REPORT_CLICKTOCALL."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $linkDomain);
					$rowAux = mysql_fetch_array($resultAux);
					$click_call = (int)$rowAux["report_amount"];

					$sql = "INSERT INTO Report_Listing_Daily (listing_id, day, summary_view, detail_view, click_thru, email_sent, phone_view, fax_view, send_phone, click_call) VALUES ('".$row[0]."', '".$from_date."', ".$summary_view.", ".$detail_view.", ".$click_thru.", ".$email_sent.", ".$phone_view.", ".$fax_view.", ".$send_phone.", ".$click_call.")";
					mysql_query($sql, $linkDomain);

				}
			}
			$from_date = explode("-", $from_date);
			$from_date = date("Y-m-d", mktime(0, 0, 0, (int)$from_date[1], (int)$from_date[2]+1, (int)$from_date[0]));
		}

	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	// Removing reports from deleted items
	////////////////////////////////////////////////////////////////////////////////////////////////////
	if (($last_report_rollup == "0000-00-00") || ($last_report_rollup < date("Y-m-d"))) {

		# ----------------------------------------------------------------------------------------------------
		# ARTICLE
		# ----------------------------------------------------------------------------------------------------
		$sql = "SELECT COUNT(id) as TOTAL FROM Article ORDER BY id";
		$result = mysql_query($sql, $linkDomain);
		$row = mysql_fetch_assoc($result);

		if ($row["TOTAL"] > 0) {
			$sql = "DELETE FROM Report_Article WHERE article_id NOT IN (SELECT id FROM Article)";
			mysql_query($sql, $linkDomain);
			$sql = "DELETE FROM Report_Article_Daily WHERE article_id NOT IN (SELECT id FROM Article)";
			mysql_query($sql, $linkDomain);
		} else {
			$sql = "DELETE FROM Report_Article";
			mysql_query($sql, $linkDomain);
			$sql = "DELETE FROM Report_Article_Daily";
			mysql_query($sql, $linkDomain);
		}

		# ----------------------------------------------------------------------------------------------------
		# BLOG
		# ----------------------------------------------------------------------------------------------------
		$sql = "SELECT COUNT(id) as TOTAL FROM Post ORDER BY id";
		$result = mysql_query($sql, $linkDomain);
		$row = mysql_fetch_assoc($result);

		if ($row["TOTAL"] > 0) {
			$sql = "DELETE FROM Report_Post WHERE post_id NOT IN (SELECT id FROM Post)";
			mysql_query($sql, $linkDomain);
			$sql = "DELETE FROM Report_Post_Daily WHERE post_id NOT IN (SELECT id FROM Post)";
			mysql_query($sql, $linkDomain);
		} else {
			$sql = "DELETE FROM Report_Post";
			mysql_query($sql, $linkDomain);
			$sql = "DELETE FROM Report_Post_Daily";
			mysql_query($sql, $linkDomain);
		}

		# ----------------------------------------------------------------------------------------------------
		# BANNER
		# ----------------------------------------------------------------------------------------------------
		$sql = "SELECT COUNT(id) as TOTAL FROM Banner ORDER BY id";
		$result = mysql_query($sql, $linkDomain);
		$row = mysql_fetch_assoc($result);

		if ($row["TOTAL"] > 0) {
			$sql = "DELETE FROM Report_Banner WHERE banner_id NOT IN (SELECT id FROM Banner)";
			mysql_query($sql, $linkDomain);
			$sql = "DELETE FROM Report_Banner_Daily WHERE banner_id NOT IN (SELECT id FROM Banner)";
			mysql_query($sql, $linkDomain);
		} else {
			$sql = "DELETE FROM Report_Banner";
			mysql_query($sql, $linkDomain);
			$sql = "DELETE FROM Report_Banner_Daily";
			mysql_query($sql, $linkDomain);
		}

		# ----------------------------------------------------------------------------------------------------
		# CLASSIFIED
		# ----------------------------------------------------------------------------------------------------
		$sql = "SELECT COUNT(id) as TOTAL FROM Classified ORDER BY id";
		$result = mysql_query($sql, $linkDomain);
		$row = mysql_fetch_assoc($result);

		if ($row["TOTAL"] > 0) {
			$sql = "DELETE FROM Report_Classified WHERE classified_id NOT IN (SELECT id FROM Classified)";
			mysql_query($sql, $linkDomain);
			$sql = "DELETE FROM Report_Classified_Daily WHERE classified_id NOT IN (SELECT id FROM Classified)";
			mysql_query($sql, $linkDomain);
		} else {
			$sql = "DELETE FROM Report_Classified";
			mysql_query($sql, $linkDomain);
			$sql = "DELETE FROM Report_Classified_Daily";
			mysql_query($sql, $linkDomain);
		}

		# ----------------------------------------------------------------------------------------------------
		# EVENT
		# ----------------------------------------------------------------------------------------------------
		$sql = "SELECT COUNT(id) as TOTAL FROM Event ORDER BY id";
		$result = mysql_query($sql, $linkDomain);
		$row = mysql_fetch_assoc($result);

		if ($row["TOTAL"] > 0) {
			$sql = "DELETE FROM Report_Event WHERE event_id NOT IN (SELECT id FROM Event)";
			mysql_query($sql, $linkDomain);
			$sql = "DELETE FROM Report_Event_Daily WHERE event_id NOT IN (SELECT id FROM Event)";
			mysql_query($sql, $linkDomain);
		} else {
			$sql = "DELETE FROM Report_Event";
			mysql_query($sql, $linkDomain);
			$sql = "DELETE FROM Report_Event_Daily";
			mysql_query($sql, $linkDomain);
		}

		# ----------------------------------------------------------------------------------------------------
		# LISTING
		# ----------------------------------------------------------------------------------------------------
		$sql = "SELECT COUNT(id) as TOTAL FROM Listing ORDER BY id";
		$result = mysql_query($sql, $linkDomain);
		$row = mysql_fetch_assoc($result);
		
		if ($row["TOTAL"] > 0) {
			$sql = "DELETE FROM Report_Listing WHERE listing_id NOT IN (SELECT id FROM Listing)";
			mysql_query($sql, $linkDomain);
			$sql = "DELETE FROM Report_Listing_Daily WHERE listing_id NOT IN (SELECT id FROM Listing)";
			mysql_query($sql, $linkDomain);
		} else {
			$sql = "DELETE FROM Report_Listing";
			mysql_query($sql, $linkDomain);
			$sql = "DELETE FROM Report_Listing_Daily";
			mysql_query($sql, $linkDomain);
		}

	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	// Removing old reports
	////////////////////////////////////////////////////////////////////////////////////////////////////
	if (($last_report_rollup == "0000-00-00") || ($last_report_rollup < date("Y-m-d"))) {

		# ----------------------------------------------------------------------------------------------------
		# ARTICLE
		# ----------------------------------------------------------------------------------------------------
		$sql = "DELETE FROM Report_Article WHERE DATE_FORMAT(date, '%Y-%m-%d') <= DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 1 DAY), '%Y-%m-%d')";
		mysql_query($sql, $linkDomain);

		# ----------------------------------------------------------------------------------------------------
		# BLOG
		# ----------------------------------------------------------------------------------------------------
		$sql = "DELETE FROM Report_Post WHERE DATE_FORMAT(date, '%Y-%m-%d') <= DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 1 DAY), '%Y-%m-%d')";
		mysql_query($sql, $linkDomain);

		# ----------------------------------------------------------------------------------------------------
		# BANNER
		# ----------------------------------------------------------------------------------------------------
		$sql = "DELETE FROM Report_Banner WHERE DATE_FORMAT(date, '%Y-%m-%d') <= DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 1 DAY), '%Y-%m-%d')";
		mysql_query($sql, $linkDomain);

		# ----------------------------------------------------------------------------------------------------
		# CLASSIFIED
		# ----------------------------------------------------------------------------------------------------
		$sql = "DELETE FROM Report_Classified WHERE DATE_FORMAT(date, '%Y-%m-%d') <= DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 1 DAY), '%Y-%m-%d')";
		mysql_query($sql, $linkDomain);

		# ----------------------------------------------------------------------------------------------------
		# EVENT
		# ----------------------------------------------------------------------------------------------------
		$sql = "DELETE FROM Report_Event WHERE DATE_FORMAT(date, '%Y-%m-%d') <= DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 1 DAY), '%Y-%m-%d')";
		mysql_query($sql, $linkDomain);

		# ----------------------------------------------------------------------------------------------------
		# LISTING
		# ----------------------------------------------------------------------------------------------------
		$sql = "DELETE FROM Report_Listing WHERE DATE_FORMAT(date, '%Y-%m-%d') <= DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 1 DAY), '%Y-%m-%d')";
		mysql_query($sql, $linkDomain);

	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    // Move completed months to Report_[module]_Monthly
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    if (($last_report_rollup == "0000-00-00") || ($last_report_rollup < date("Y-m-d"))) {
        # ----------------------------------------------------------------------------------------------------
        # ARTICLE
        # ----------------------------------------------------------------------------------------------------
        $sql = "SELECT article_id , CONCAT(YEAR(day), '-' , MONTH(day), '-', '1') AS period , SUM(summary_view) AS summary , SUM(detail_view) AS detail FROM Report_Article_Daily WHERE ((MONTH(day) < MONTH(NOW()) AND YEAR(day) = YEAR(NOW())) OR (YEAR(day) < YEAR(NOW()))) GROUP BY article_id , period  ORDER BY day DESC";
        $results = mysql_query($sql, $linkDomain);
        while($row = mysql_fetch_array($results)) {
            $sqlInsert = "INSERT INTO Report_Article_Monthly VALUES (".$row['article_id'].",'".$row['period']."',".$row['summary'].",".$row['detail'].");";
            mysql_query($sqlInsert, $linkDomain);
        }
        $sqlDelete = "DELETE FROM Report_Article_Daily WHERE ((MONTH(day) < MONTH(NOW()) AND YEAR(day) = YEAR(NOW())) OR (YEAR(day) < YEAR(NOW())));";
        mysql_query($sqlDelete, $linkDomain);

		# ----------------------------------------------------------------------------------------------------
        # BLOG
        # ----------------------------------------------------------------------------------------------------
        $sql = "SELECT post_id , CONCAT(YEAR(day), '-' , MONTH(day), '-', '1') AS period , SUM(summary_view) AS summary , SUM(detail_view) AS detail FROM Report_Post_Daily WHERE ((MONTH(day) < MONTH(NOW()) AND YEAR(day) = YEAR(NOW())) OR (YEAR(day) < YEAR(NOW()))) GROUP BY post_id , period  ORDER BY day DESC";
        $results = mysql_query($sql, $linkDomain);
        while($row = mysql_fetch_array($results)) {
            $sqlInsert = "INSERT INTO Report_Post_Monthly VALUES (".$row['post_id'].",'".$row['period']."',".$row['summary'].",".$row['detail'].");";
            mysql_query($sqlInsert, $linkDomain);
        }
        $sqlDelete = "DELETE FROM Report_Post_Daily WHERE ((MONTH(day) < MONTH(NOW()) AND YEAR(day) = YEAR(NOW())) OR (YEAR(day) < YEAR(NOW())));";
        mysql_query($sqlDelete, $linkDomain);

        # ----------------------------------------------------------------------------------------------------
        # BANNER
        # ----------------------------------------------------------------------------------------------------
        $sql = "SELECT banner_id , CONCAT(YEAR(day), '-' , MONTH(day), '-', '1') AS period , SUM(view) AS view, SUM(click_thru) AS click FROM Report_Banner_Daily WHERE ((MONTH(day) < MONTH(NOW()) AND YEAR(day) = YEAR(NOW())) OR (YEAR(day) < YEAR(NOW()))) GROUP BY banner_id, period  ORDER BY day DESC";
        $results = mysql_query($sql, $linkDomain);
        while($row = mysql_fetch_array($results)) {
            $sqlInsert = "INSERT INTO Report_Banner_Monthly VALUES (".$row['banner_id'].",'".$row['period']."',".$row['view'].",".$row['click'].");";
            mysql_query($sqlInsert, $linkDomain);
        }
        $sqlDelete = "DELETE FROM Report_Banner_Daily WHERE ((MONTH(day) < MONTH(NOW()) AND YEAR(day) = YEAR(NOW())) OR (YEAR(day) < YEAR(NOW())));";
        mysql_query($sqlDelete, $linkDomain);

        # ----------------------------------------------------------------------------------------------------
        # CLASSIFIED
        # ----------------------------------------------------------------------------------------------------
        $sql = "SELECT classified_id , CONCAT(YEAR(day), '-' , MONTH(day), '-', '1') AS period , SUM(summary_view) AS summary , SUM(detail_view) AS detail FROM Report_Classified_Daily WHERE ((MONTH(day) < MONTH(NOW()) AND YEAR(day) = YEAR(NOW())) OR (YEAR(day) < YEAR(NOW()))) GROUP BY classified_id , period  ORDER BY day DESC";
        $results = mysql_query($sql, $linkDomain);
        while($row = mysql_fetch_array($results)) {
            $sqlInsert = "INSERT INTO Report_Classified_Monthly VALUES (".$row['classified_id'].",'".$row['period']."',".$row['summary'].",".$row['detail'].");";
            mysql_query($sqlInsert, $linkDomain);
        }
        $sqlDelete = "DELETE FROM Report_Classified_Daily WHERE ((MONTH(day) < MONTH(NOW()) AND YEAR(day) = YEAR(NOW())) OR (YEAR(day) < YEAR(NOW())));";
        mysql_query($sqlDelete, $linkDomain);
        
        # ----------------------------------------------------------------------------------------------------
        # EVENT
        # ----------------------------------------------------------------------------------------------------
        $sql = "SELECT event_id , CONCAT(YEAR(day), '-' , MONTH(day), '-', '1') AS period , SUM(summary_view) AS summary , SUM(detail_view) AS detail FROM Report_Event_Daily WHERE ((MONTH(day) < MONTH(NOW()) AND YEAR(day) = YEAR(NOW())) OR (YEAR(day) < YEAR(NOW()))) GROUP BY event_id , period  ORDER BY day DESC";
        $results = mysql_query($sql, $linkDomain);
        while($row = mysql_fetch_array($results)) {
            $sqlInsert = "INSERT INTO Report_Event_Monthly VALUES (".$row['event_id'].",'".$row['period']."',".$row['summary'].",".$row['detail'].");";
            mysql_query($sqlInsert, $linkDomain);
        }
        $sqlDelete = "DELETE FROM Report_Event_Daily WHERE ((MONTH(day) < MONTH(NOW()) AND YEAR(day) = YEAR(NOW())) OR (YEAR(day) < YEAR(NOW())));";
        mysql_query($sqlDelete, $linkDomain);
        
        # ----------------------------------------------------------------------------------------------------
        # LISTING
        # ----------------------------------------------------------------------------------------------------
        $sql = "SELECT listing_id , CONCAT(YEAR(day), '-' , MONTH(day), '-', '1') AS period , SUM(summary_view) AS summary , SUM(detail_view) AS detail , SUM(click_thru) AS click , SUM(email_sent) AS email , SUM(phone_view) AS phone , SUM(fax_view) AS fax, SUM(send_phone) AS send_phone, SUM(click_call) AS click_call FROM Report_Listing_Daily WHERE ((MONTH(day) < MONTH(NOW()) AND YEAR(day) = YEAR(NOW())) OR (YEAR(day) < YEAR(NOW()))) GROUP BY listing_id , period  ORDER BY day DESC";
        $results = mysql_query($sql, $linkDomain);
        while($row = mysql_fetch_array($results)) {
            $sqlInsert = "INSERT INTO Report_Listing_Monthly VALUES (".$row['listing_id'].",'".$row['period']."',".$row['summary'].",".$row['detail'].",".$row['click'].",".$row['email'].",".$row['phone'].",".$row['fax'].",".$row['send_phone'].",".$row['click_call'].");";
            mysql_query($sqlInsert, $linkDomain);
        }
        $sqlDelete = "DELETE FROM Report_Listing_Daily WHERE ((MONTH(day) < MONTH(NOW()) AND YEAR(day) = YEAR(NOW())) OR (YEAR(day) < YEAR(NOW())));";
        mysql_query($sqlDelete, $linkDomain);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    
	////////////////////////////////////////////////////////////////////////////////////////////////////
	setting_set("last_report_rollup", date("Y-m-d"));
	////////////////////////////////////////////////////////////////////////////////////////////////////

	$sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'N' WHERE `domain_id` = ".SELECTED_DOMAIN_ID." AND `type` = 'report_rollup'";
	mysql_query($sqlUpdate, $link);

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$time_end = getmicrotime();
	$time = $time_end - $time_start;
	print "Report Rollup on Domain ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")." - ".round($time, 2)." seconds.\n";
	if (!setting_set("last_datetime_reportrollup", date("Y-m-d H:i:s"))) {
		if (!setting_new("last_datetime_reportrollup", date("Y-m-d H:i:s"))) {
			print "last_datetime_reportrollup error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////
