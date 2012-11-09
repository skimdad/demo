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
	# * FILE: /cron/count_article_category.php
	# ----------------------------------------------------------------------------------------------------

	##################################################
	# THIS SCRIPT IS ONLY NECESSARY TO COUNT ARTICLES BY CATEGORY
	# WHEN ARTICLES ARE INSERTED/UPDATED OUT OF EDIRECTORY PROCCESS.
	# IF IT HAPPENED, RUN THIS SCRIPT ONLY ONE TIME. THE CODE ALREADY
	# HANDLES THE NUMBER OF ACTIVE ARTICLES BY CATEGORY. TO RUN THIS
	# SCRIPT, REMOVE THE EXIT COMMAND BELOW.
	##################################################
	/*
	 * 1 DAY
	 * 1 MONTH
	 * 1 YEAR
	 */
	define("COUNT_PERIOD", "1 DAY");

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
	if (COUNT_PERIOD != "") {
		$sql_period = " AND ADDDATE(CC.`last_run_date`, INTERVAL ".COUNT_PERIOD.") <= NOW() ";
	} else {
		$sql_period = "";
	}
	$sqlDomain = "	SELECT
						D.`id`, D.`database_host`, D.`database_port`, D.`database_username`, D.`database_password`, D.`database_name`, D.`url`
					FROM `Domain` AS D
					LEFT JOIN `Control_Cron` AS CC ON (CC.`domain_id` = D.`id`)
					WHERE CC.`running` = 'N'
					AND CC.`type` = 'count_article_category'
					AND D.`status` = 'A'
					$sql_period
					ORDER BY
						IF (CC.`last_run_date` IS NULL, 0, 1),
						CC.`last_run_date`,
						D.`id`
					LIMIT 1";

	$resDomain = mysql_query($sqlDomain, $link);

	if (mysql_num_rows($resDomain) > 0) {
		$rowDomain = mysql_fetch_assoc($resDomain);
		define("SELECTED_DOMAIN_ID", $rowDomain["id"]);

		$sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'Y', `last_run_date` = NOW() WHERE `domain_id` = ".SELECTED_DOMAIN_ID." AND `type` = 'count_article_category'";
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
	system_countActiveItemByCategory("article");
	////////////////////////////////////////////////////////////////////////////////////////////////////

	$sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'N' WHERE `domain_id` = ".SELECTED_DOMAIN_ID." AND `type` = 'count_article_category'";
	mysql_query($sqlUpdate, $link);

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$time_end = getmicrotime();
	$time = $time_end - $time_start;
	print "Count ".string_ucwords(ARTICLE_FEATURE_NAME)." Category Update on Domain ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")." - ".round($time, 2)." seconds.\n";
	////////////////////////////////////////////////////////////////////////////////////////////////////
