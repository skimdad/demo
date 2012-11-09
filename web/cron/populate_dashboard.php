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
	# * FILE: /cron/populate_dashboard.php
	# ----------------------------------------------------------------------------------------------------

	##################################################
	# THIS SCRIPT IS ONLY NECESSARY TO POPULATE THE DASHBOARD AND TO BE APPROVED TABLES
	# WHEN SOME ITEM IS INSERTED/DELETED OUT OF EDIRECTORY PROCCESS.
	# IF IT HAPPENED, RUN THIS SCRIPT ONLY ONE TIME. TO RUN THIS
	# SCRIPT, REMOVE THE EXIT COMMAND BELOW.
	##################################################

	exit;
	##################################################

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
						`id`, `database_host`, `database_port`, `database_username`, `database_password`, `database_name`, `url`
					FROM `Domain` WHERE `status` = 'A'";
					

	$resDomain = mysql_query($sqlDomain, $link);

	while ($rowDomain = mysql_fetch_assoc($resDomain)){

		$sql = "TRUNCATE TABLE  `To_Approved`";
		mysql_query($sql, $link);

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


		$count_contents = 0;

		$sql = "SELECT id FROM Listing";
		$resultCount = mysql_query($sql,$linkDomain);
		$count_listing = mysql_num_rows($resultCount);

		$sql = "SELECT id FROM Event";
		$resultCount = mysql_query($sql,$linkDomain);
		$count_event = mysql_num_rows($resultCount);

		$sql = "SELECT id FROM Classified";
		$resultCount = mysql_query($sql,$linkDomain);
		$count_classified = mysql_num_rows($resultCount);

		$sql = "SELECT id FROM Banner";
		$resultCount = mysql_query($sql,$linkDomain);
		$count_banner = mysql_num_rows($resultCount);

		$sql = "SELECT id FROM Article";
		$resultCount = mysql_query($sql,$linkDomain);
		$count_article = mysql_num_rows($resultCount);

		$count_contents = $count_event + $count_classified + $count_banner + $count_article;

		$sql = "SELECT SUM(transaction_amount) AS total FROM Payment_Log WHERE transaction_status in ('Completed', 'Approved', 'Accepted', 'Success', 'SIMPLEPAYSUCCESS', 'Y')";
		$resultRevenue = mysql_query($sql,$linkDomain);
		if (mysql_num_rows($resultRevenue) > 0) {
			$rowRevenue = mysql_fetch_assoc($resultRevenue);
			$total_payment = $rowRevenue['total'];
		}

		$sql = "SELECT SUM(amount) AS total FROM Invoice WHERE status = 'R'";
		$resultRevenue = mysql_query($sql,$linkDomain);
		if (mysql_num_rows($resultRevenue) > 0) {
			$rowRevenue = mysql_fetch_assoc($resultRevenue);
			$total_invoice = $rowRevenue['total'];
		}
		$total = $total_payment + $total_invoice;

		$sql = "UPDATE Dashboard SET number_listings = $count_listing, number_content = $count_contents, revenue = $total WHERE domain_id = ".$rowDomain["id"];
		mysql_query($sql,$link);

		$sql = "SELECT id, title FROM Listing_Summary WHERE status = 'P'";
		$result2 = mysql_query($sql,$linkDomain);
		while ($row2 = mysql_fetch_assoc($result2)){
			$sql = "INSERT INTO To_Approved (domain_id, item_id, item_type, item_title) VALUES (".$rowDomain["id"].",".$row2["id"].",'listing','".$row2["title"]."')";
			mysql_query($sql,$link);
		}

		$sql = "SELECT id, title FROM Event WHERE status = 'P'";
		$result2 = mysql_query($sql,$linkDomain);
		while ($row2 = mysql_fetch_assoc($result2)){
			$sql = "INSERT INTO To_Approved (domain_id, item_id, item_type, item_title) VALUES (".$rowDomain["id"].",".$row2["id"].",'event','".$row2["title"]."')";
			mysql_query($sql,$link);
		}

		$sql = "SELECT id, title FROM Classified WHERE status = 'P'";
		$result2 = mysql_query($sql,$linkDomain);
		while ($row2 = mysql_fetch_assoc($result2)){
			$sql = "INSERT INTO To_Approved (domain_id, item_id, item_type, item_title) VALUES (".$rowDomain["id"].",".$row2["id"].",'classified','".$row2["title"]."')";
			mysql_query($sql,$link);
		}

		$sql = "SELECT id, title FROM Article WHERE status = 'P'";
		$result2 = mysql_query($sql,$linkDomain);
		while ($row2 = mysql_fetch_assoc($result2)){
			$sql = "INSERT INTO To_Approved (domain_id, item_id, item_type, item_title) VALUES (".$rowDomain["id"].",".$row2["id"].",'article','".$row2["title"]."')";
			mysql_query($sql,$link);
		}

		$sql = "SELECT id_number FROM Lang WHERE lang_default = 'y'";
		$rowLang = mysql_fetch_assoc(mysql_query($sql,$linkDomain));

		$sql = "SELECT id, caption".$rowLang["id_number"]." FROM Banner WHERE status = 'P'";

		$result2 = mysql_query($sql,$linkDomain);
		while ($row2 = mysql_fetch_assoc($result2)){
			$sql = "INSERT INTO To_Approved (domain_id, item_id, item_type, item_title) VALUES (".$rowDomain["id"].",".$row2["id"].",'banner','".$row2["caption".$rowLang["id_number"]]."')";
			mysql_query($sql,$link);
		}

		$sql = "SELECT id, item_id, review_title, rating FROM Review WHERE approved = 0 AND item_type = 'listing'";
		$result2 = mysql_query($sql,$linkDomain);
		while ($row2 = mysql_fetch_assoc($result2)){

			$sql = "SELECT title FROM Listing WHERE id = ".$row2["item_id"];
			$result3 = mysql_query($sql,$linkDomain);
			$row3 = mysql_fetch_assoc($result3);

			$sql = "INSERT INTO To_Approved (domain_id, item_id, item_type, item_title, content, assoc_item, rate) VALUES (".$rowDomain["id"].",".$row2["id"].",'review_listing','".$row3["title"]."','".$row2["review_title"]."',".$row2["item_id"].",".$row2["rating"].")";
			mysql_query($sql,$link);
		}

		$sql = "SELECT id, item_id, review_title, rating FROM Review WHERE approved = 0 AND item_type = 'article'";
		$result2 = mysql_query($sql,$linkDomain);
		while ($row2 = mysql_fetch_assoc($result2)){
			$sql = "SELECT title FROM Article WHERE id = ".$row2["item_id"];
			$result3 = mysql_query($sql,$linkDomain);
			$row3 = mysql_fetch_assoc($result3);

			$sql = "INSERT INTO To_Approved (domain_id, item_id, item_type, item_title, content, assoc_item, rate) VALUES (".$rowDomain["id"].",".$row2["id"].",'review_article','".$row3["title"]."','".$row2["review_title"]."',".$row2["item_id"].",".$row2["rating"].")";
			mysql_query($sql,$link);
		}

		$sql = "SELECT id, post_id, description, reply_id FROM Comments WHERE approved = 0";
		$result2 = mysql_query($sql,$linkDomain);
		while ($row2 = mysql_fetch_assoc($result2)){

			$sql = "SELECT title FROM Post WHERE id = ".$row2["post_id"];
			$result3 = mysql_query($sql,$linkDomain);
			$row3 = mysql_fetch_assoc($result3);

			$sql = "INSERT INTO To_Approved (domain_id, item_id, item_type, item_title, content, assoc_item, rate, reply_id) VALUES (".$rowDomain["id"].",".$row2["id"].",'blog_comment','".$row3["title"]."','".$row2["description"]."',".$row2["post_id"].",0,".$row2["reply_id"].")";
			mysql_query($sql,$link);
		}

	} 
	////////////////////////////////////////////////////////////////////////////////////////////////////


	////////////////////////////////////////////////////////////////////////////////////////////////////
	$time_end = getmicrotime();
	$time = $time_end - $time_start;
	print "Dashboard/To be approved updated - ".date("Y-m-d H:i:s")." - ".round($time, 2)." seconds.\n";
	////////////////////////////////////////////////////////////////////////////////////////////////////