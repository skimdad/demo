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
	# * FILE: /cron/randomizer.php
	# ----------------------------------------------------------------------------------------------------

	////////////////////////////////////////////////////////////////////////////////////////////////////
	define("BLOCK", 10000);
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
					AND CC.`type` = 'randomizer'
					AND D.`status` = 'A'
					AND ADDDATE(CC.`last_run_date`, INTERVAL 20 MINUTE) <= NOW()
					ORDER BY
						IF (CC.`last_run_date` IS NULL, 0, 1),
						CC.`last_run_date`,
						D.`id`
					LIMIT 1";

	$resDomain = mysql_query($sqlDomain, $link);

	if (mysql_num_rows($resDomain) > 0) {
		$rowDomain = mysql_fetch_assoc($resDomain);
		define("SELECTED_DOMAIN_ID", $rowDomain["id"]);

		$sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'Y', `last_run_date` = NOW() WHERE `domain_id` = ".SELECTED_DOMAIN_ID." AND `type` = 'randomizer'";
		mysql_query($sqlUpdate, $link);

	////////////////////////////////////////////////////////////////////////////////////////////////////
		$domainHost = $rowDomain["database_host"].($rowDomain["database_port"]? ":".$rowDomain["database_port"]: "");
		$domainUser = $rowDomain["database_username"];
		$domainPass = $rowDomain["database_password"];
		$domainDBName = $rowDomain["database_name"];
		$domainURL = $rowDomain["url"];

		$link_domain = mysql_connect($domainHost, $domainUser, $domainPass, true);
		mysql_query("SET NAMES 'utf8'", $link_domain);
		mysql_query('SET character_set_connection=utf8', $link_domain);
		mysql_query('SET character_set_client=utf8', $link_domain);
		mysql_query('SET character_set_results=utf8', $link_domain);
		mysql_select_db($domainDBName);
	////////////////////////////////////////////////////////////////////////////////////////////////////
	} else {
		exit;
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	$_inCron = false;
	include_once(EDIRECTORY_ROOT."/conf/loadconfig.inc.php");
	////////////////////////////////////////////////////////////////////////////////////////////////////

	$last_listing_randomizer = 0;
	if (!setting_get("last_listing_randomizer_domain", $last_listing_randomizer)) {
		if (!setting_set("last_listing_randomizer_domain", "0")) {
			if (!setting_new("last_listing_randomizer_domain", "0")) {
				print "Randomizer - last_listing_randomizer error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
			}
		}
	}
	if (!$last_listing_randomizer) {
		$last_listing_randomizer = 0;
	}

	/*
	 * Randomizer Listings for each domain
	 *
	 ****************************************************************************************************/
	$level = implode(",", system_getLevelDetail("ListingLevel"));
    unset($whereLevel);
    if ($level){
        $whereLevel  = " Listing.level IN (".$level.")"; 
    }
	
	if (LISTING_SCALABILITY_OPTIMIZATION == "on") {
		$sql = "SELECT id, level FROM Listing WHERE `status` = 'A' ".($whereLevel ? "AND $whereLevel" : "")." ORDER BY level, id LIMIT ".$last_listing_randomizer.", ".BLOCK."";
	} else {
		$sql = "SELECT id, level FROM Listing ".($whereLevel ? "WHERE $whereLevel" : "")." ORDER BY id LIMIT ".$last_listing_randomizer.", ".BLOCK."";
	}
	$result = mysql_query($sql, $link_domain);
	$num_rows = mysql_num_rows($result);

	$sql = "UPDATE Listing_FeaturedTemp SET status = 'D' WHERE status = 'R';";
	mysql_query($sql, $link_domain);

	while ($row = mysql_fetch_assoc($result)) {

		$sqlRand = "SELECT RAND()*1000000000000000 AS RN";
		$resRand = mysql_query($sqlRand, $link_domain);
		$rowRand = mysql_fetch_assoc($resRand);

        $sql = "INSERT INTO Listing_FeaturedTemp VALUES (".$row["id"].", ".$row["level"].", ".$rowRand["RN"].", 'I');";
        mysql_query($sql, $link_domain);

		if (LISTING_SCALABILITY_OPTIMIZATION != "on") {
			$sql = "UPDATE `Listing` SET `random_number` = ".$rowRand["RN"]." WHERE id = ".$row["id"];
			mysql_query($sql, $link_domain);

			$sql = "UPDATE `Listing_Summary` SET `random_number` = ".$rowRand["RN"]." WHERE id = ".$row["id"];
			mysql_query($sql, $link_domain);
		}
	}

	$sql = "UPDATE Listing_FeaturedTemp SET status = 'R' WHERE status = 'I';";
	mysql_query($sql, $link_domain);

	$sql = "DELETE FROM Listing_FeaturedTemp WHERE status = 'D';";
	mysql_query($sql, $link_domain);

	if ($num_rows < BLOCK) {
		if (!setting_set("last_listing_randomizer_domain", "0")) {
			print "Randomizer - last_listing_randomizer error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
		}
		$last_listing_randomizer = 0;
	} else {
		if (!setting_set("last_listing_randomizer_domain", ($last_listing_randomizer + BLOCK))) {
			print "Randomizer - last_listing_randomizer error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
		}
		$last_listing_randomizer = $last_listing_randomizer + BLOCK;
	}
	/***********************************************************************************************************************/

	/*
	 * Randomizer to promotions for each domain
	 *
	 ***********************************************************************************************************************/
	$last_promotion_randomizer = 0;
	if (!setting_get("last_promotion_randomizer_domain", $last_promotion_randomizer)) {
		if (!setting_set("last_promotion_randomizer_domain", "0")) {
			if (!setting_new("last_promotion_randomizer_domain", "0")) {
				print "Randomizer - last_promotion_randomizer error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
			}
		}
	}
	if (!$last_promotion_randomizer) {
		$last_promotion_randomizer = 0;
	}
	$sql = "SELECT id FROM Promotion ORDER BY id LIMIT ".$last_promotion_randomizer.", ".BLOCK."";
	$result = mysql_query($sql, $link_domain);
	$num_rows = mysql_num_rows($result);
	while ($row = mysql_fetch_assoc($result)) {
		$sql = "UPDATE Promotion SET random_number = RAND()*1000000000000000 WHERE id = ".$row["id"]."";
		mysql_query($sql, $link_domain);
	}
	if ($num_rows < BLOCK) {
		if (!setting_set("last_promotion_randomizer_domain", "0")) {
			print "Randomizer - last_promotion_randomizer error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
		}
		$last_promotion_randomizer = 0;
	} else {
		if (!setting_set("last_promotion_randomizer_domain", ($last_promotion_randomizer + BLOCK))) {
			print "Randomizer - last_promotion_randomizer error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
		}
		$last_promotion_randomizer = $last_promotion_randomizer + BLOCK;
	}
	/***********************************************************************************************************************/

	/*
	 * Randomizer to Event for each domain
	 *
	 ***********************************************************************************************************************/
	$last_event_randomizer = 0;
	if (!setting_get("last_event_randomizer_domain", $last_event_randomizer)) {
		if (!setting_set("last_event_randomizer_domain", "0")) {
			if (!setting_new("last_event_randomizer_domain", "0")) {
				print "Randomizer - last_event_randomizer error - Domain - ".SELECTED_DOMAIN_ID. " - ".date("Y-m-d H:i:s")."\n";
			}
		}
	}
	if (!$last_event_randomizer) {
		$last_event_randomizer = 0;
	}
	$sql = "SELECT id FROM Event ORDER BY id LIMIT ".$last_event_randomizer.", ".BLOCK."";
	$result = mysql_query($sql, $link_domain);
	$num_rows = mysql_num_rows($result);
	while ($row = mysql_fetch_assoc($result)) {
		$sql = "UPDATE Event SET random_number = RAND()*1000000000000000 WHERE id = ".$row["id"]."";
		mysql_query($sql, $link_domain);
	}
	if ($num_rows < BLOCK) {
		if (!setting_set("last_event_randomizer_domain", "0")) {
			print "Randomizer - last_event_randomizer error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
		}
		$last_event_randomizer = 0;
	} else {
		if (!setting_set("last_event_randomizer_domain", ($last_event_randomizer + BLOCK))) {
			print "Randomizer - last_event_randomizer error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
		}
		$last_event_randomizer = $last_event_randomizer + BLOCK;
	}
	/***********************************************************************************************************************/



	/*
	 * Randomizer to Banner for each domain
	 *
	 ***********************************************************************************************************************/
	$last_banner_randomizer = 0;
	if (!setting_get("last_banner_randomizer_domain", $last_banner_randomizer)) {
		if (!setting_set("last_banner_randomizer_domain", "0")) {
			if (!setting_new("last_banner_randomizer_domain", "0")) {
				print "Randomizer - last_banner_randomizer error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
			}
		}
	}
	if (!$last_banner_randomizer) {
		$last_banner_randomizer = 0;
	}
	$sql = "SELECT id FROM Banner ORDER BY id LIMIT ".$last_banner_randomizer.", ".BLOCK."";
	$result = mysql_query($sql, $link_domain);
	$num_rows = mysql_num_rows($result);
	while ($row = mysql_fetch_assoc($result)) {
		$sql = "UPDATE Banner SET random_number = RAND()*1000000000000000 WHERE id = ".$row["id"]."";
		mysql_query($sql, $link_domain);
	}
	if ($num_rows < BLOCK) {
		if (!setting_set("last_banner_randomizer_domain", "0")) {
			print "Randomizer - last_banner_randomizer error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
		}
		$last_banner_randomizer = 0;
	} else {
		if (!setting_set("last_banner_randomizer_domain", ($last_banner_randomizer + BLOCK))) {
			print "Randomizer - last_banner_randomizer error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
		}
		$last_banner_randomizer = $last_banner_randomizer + BLOCK;
	}
	/***********************************************************************************************************************/


	/*
	 * Randomizer to classified for each domain
	 *
	 ***********************************************************************************************************************/
	$last_classified_randomizer = 0;
	if (!setting_get("last_classified_randomizer_domain", $last_classified_randomizer)) {
		if (!setting_set("last_classified_randomizer_domain", "0")) {
			if (!setting_new("last_classified_randomizer_domain", "0")) {
				print "Randomizer - last_classified_randomizer error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
			}
		}
	}
	if (!$last_classified_randomizer) {
		$last_classified_randomizer = 0;
	}
	$sql = "SELECT id FROM Classified ORDER BY id LIMIT ".$last_classified_randomizer.", ".BLOCK."";
	$result = mysql_query($sql, $link_domain);
	$num_rows = mysql_num_rows($result);
	while ($row = mysql_fetch_assoc($result)) {
		$sql = "UPDATE Classified SET random_number = RAND()*1000000000000000 WHERE id = ".$row["id"]."";
		mysql_query($sql, $link_domain);
	}
	if ($num_rows < BLOCK) {
		if (!setting_set("last_classified_randomizer_domain", "0")) {
			print "Randomizer - last_classified_randomizer error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
		}
		$last_classified_randomizer = 0;
	} else {
		if (!setting_set("last_classified_randomizer_domain", ($last_classified_randomizer + BLOCK))) {
			print "Randomizer - last_classified_randomizer error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
		}
		$last_classified_randomizer = $last_classified_randomizer + BLOCK;
	}
	/***********************************************************************************************************************/



	/*
	 * Randomizer to article for each domain
	 *
	 ***********************************************************************************************************************/
	$last_article_randomizer = 0;
	if (!setting_get("last_article_randomizer_domain", $last_article_randomizer)) {
		if (!setting_set("last_article_randomizer_domain", "0")) {
			if (!setting_new("last_article_randomizer_domain", "0")) {
				print "Randomizer - last_article_randomizer error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
			}
		}
	}
	if (!$last_article_randomizer) {
		$last_article_randomizer = 0;
	}
	$sql = "SELECT id FROM Article ORDER BY id LIMIT ".$last_article_randomizer.", ".BLOCK."";
	$result = mysql_query($sql, $link_domain);
	$num_rows = mysql_num_rows($result);
	while ($row = mysql_fetch_assoc($result)) {
		$sql = "UPDATE Article SET random_number = RAND()*1000000000000000 WHERE id = ".$row["id"]."";
		mysql_query($sql, $link_domain);
	}
	if ($num_rows < BLOCK) {
		if (!setting_set("last_article_randomizer_domain", "0")) {
			print "Randomizer - last_article_randomizer error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
		}
		$last_article_randomizer = 0;
	} else {
		if (!setting_set("last_article_randomizer_domain", ($last_article_randomizer + BLOCK))) {
			print "Randomizer - last_article_randomizer error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
		}
		$last_article_randomizer = $last_article_randomizer + BLOCK;
	}
	/***********************************************************************************************************************/

	$sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'N' WHERE `domain_id` = ".SELECTED_DOMAIN_ID." AND `type` = 'randomizer'";
	mysql_query($sqlUpdate, $link);

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$time_end = getmicrotime();
	$time = $time_end - $time_start;
	print "Randomizer on Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")." - ".round($time, 2)." seconds.\n";
	if (!setting_set("last_datetime_randomizer", date("Y-m-d H:i:s"))) {
		if (!setting_new("last_datetime_randomizer", date("Y-m-d H:i:s"))) {
			print "last_datetime_randomizer error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////
?>
