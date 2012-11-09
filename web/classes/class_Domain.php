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
	# * FILE: /classes/class_Domain.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$domainObj = new Domain($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name Domain
	 * @method Domain
	 * @method makeFromRow
	 * @method Save
	 * @method Delete
	 * @access Public
	 */
	class Domain extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $smaccount_id;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $name;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $database_host;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $database_port;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $database_username;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $database_password;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $database_name;
		/**
		 * @var string
		 * @access Private
		 */
		var $url;
		/**
		 * A - Active
		 * D - Deleted
		 * P - Pending
		 * When a Domain is deleted the domain status is set to "D"
		 * When an error occurs while the domain is created as its status is 'P'
		 * @var char
		 * @access Private
		 */
		var $status;
		/**
		 * @var string
		 * @access Private
		 */
		var $activation_status;
		/**
		 * @var date
		 * @access Private
		 */
		var $created;
		/**
		 * When a Domain is deleted this field is set to Current Date
		 * @var date
		 * @access Private
		 */
		var $deleted_date;
		/**
		 * @var integer
		 * @access Private
		 */
		var $percent;
		/**
		 * @var boolean
		 * @access Private
		 */
		var $error;
		/**
		 * @var string
		 * @access Private
		 */
		var $event_feature;
		/**
		 * @var string
		 * @access Private
		 */
		var $banner_feature;
		/**
		 * @var string
		 * @access Private
		 */
		var $classified_feature;
		/**
		 * @var string
		 * @access Private
		 */
		var $article_feature;
		/**
		 * @var string
		 * @access Private
		 */
		var $subfolder;


		/**
		 * Needed database privileges to create a Domain
		 * @var varchar
		 * @access Private
		 */
		const NEEDED_PRIVILEGES = "Alter,Create,Create view,Delete,Drop,Index,Insert,Select,Update";
		/**
		 * Name of Domain folders
		 * @var varchar
		 * @access Private
		 */
		const CUSTOM_FOLDERS = "conf,content_files,editor_files,extra_files,image_files,import_files,lang,location,navigation,payment,sitemap,socialnetwork,theme,cache_full,cache_partial,cacheExpirationQueries,cacheUpdateToken,cacheVerbose";

		/**
		 * <code>
		 *		$domainObj = new Domain($id);
		 *		//OR
		 *		$domainObj = new Domain($row);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Domain
		 * @access Public
		 * @param mixed $var
		 */
		function Domain($var='') {
			$db = db_getDBObject(DEFAULT_DB, true);
			if (is_numeric($var) && ($var)) {

				/*
				 * Get information of constants of domain
				 */
				unset($row);
				$row = db_getDomainInformation($var);
				if(is_array($row)){
					$this->makeFromRow($row);
				}else{
					$sql = "SELECT * FROM Domain WHERE id = $var";
					$row = mysql_fetch_array($db->query($sql));
					$this->makeFromRow($row);
				}


			} else if (is_string($var) && ($var)) {
				$sql = "SELECT * FROM Domain WHERE url = '$var' LIMIT 1";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		/**
		 * <code>
		 *		$this->makeFromRow($row);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name makeFromRow
		 * @access Public
		 * @param array $row
		 */
		function makeFromRow($row='') {
			$row["id"]					? $this->id					= $row["id"]								: $this->id					= 0;
			$row["smaccount_id"]		? $this->smaccount_id		= $row["smaccount_id"]						: $this->smaccount_id		= 0;
			$row["name"]				? $this->name				= $row["name"]								: $this->name				= "";
			$row["database_host"]		? $this->database_host		= $row["database_host"]						: $this->database_host		= "";
			$row["database_port"]		? $this->database_port		= $row["database_port"]						: $this->database_port		= "";
			$row["database_username"]	? $this->database_username	= $row["database_username"]					: $this->database_username	= "";
			$row["database_password"]	? $this->database_password	= $row["database_password"]					: $this->database_password	= "";
			$row["database_name"]		? $this->database_name		= $row["database_name"]						: $this->database_name		= "";
			$row["url"]					? $this->url				= $row["url"]								: $this->url				= "";
			$row["status"]				? $this->status				= $row["status"]							: $this->status				= "P";
			$row["activation_status"]	? $this->activation_status	= $row["activation_status"]					: $this->activation_status	= "P";
			$this->setDate("created", $row["created"]);
			$this->setDate("deleted_date", $row["deleted_date"]);
			$row["event_feature"]		? $this->event_feature		= $row["event_feature"]						: $this->event_feature		= "";
			$row["banner_feature"]		? $this->banner_feature		= $row["banner_feature"]					: $this->banner_feature		= "";
			$row["classified_feature"]	? $this->classified_feature	= $row["classified_feature"]				: $this->classified_feature	= "";
			$row["article_feature"]		? $this->article_feature	= $row["article_feature"]					: $this->article_feature	= "";
			$row["subfolder"]			? $this->subfolder			= $row["subfolder"]							: $this->subfolder			= "";

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$domainObj->Save();
		 * <br /><br />
		 *		//Using this in Domain() class.
		 *		$this->Save();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Save
		 * @access Public
		 */
		function Save() {
			$this->prepareToSave();

			$dbObj = db_getDBObject(DEFAULT_DB, true);

			if ($this->id) {
				$sql  = "UPDATE Domain SET"
					. " smaccount_id = $this->smaccount_id,"
					. " name = $this->name,"
					. " database_host = $this->database_host,"
					. " database_port = $this->database_port,"
					. " database_username = $this->database_username,"
					. " database_password = $this->database_password,"
					. " database_name = $this->database_name,"
					. " url = $this->url,"
					. " article_feature = $this->article_feature,"
					. " banner_feature = $this->banner_feature,"
					. " classified_feature = $this->classified_feature,"
					. " event_feature = $this->event_feature,"
					. " subfolder = $this->subfolder"
					. " WHERE id = $this->id";

				$dbObj->query($sql);
			} else {
				$sql = "INSERT INTO Domain"
					. " (smaccount_id, name, database_host, database_port, database_username, database_password, database_name, url, status, activation_status, created, article_feature, banner_feature, classified_feature, event_feature,subfolder)"
					. " VALUES"
					. " ($this->smaccount_id, $this->name, $this->database_host, $this->database_port, $this->database_username, $this->database_password, $this->database_name, $this->url, 'P','P',  CURDATE(), $this->article_feature, $this->banner_feature, $this->classified_feature, $this->event_feature,$this->subfolder)";

				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);
			}
			$this->prepareToUse();
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$domainObj->Delete();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Delete
		 * @access Public
		 */
		function Delete() {
			$dbObj = db_getDBObject(DEFAULT_DB, true);

			if ($this->status == "A") {
				/*
				 * Changing the Domain Status to 'D' (Deleted)
				 */
				$sql = "UPDATE Domain SET status = 'D', deleted_date = CURDATE() WHERE id = $this->id";
				$dbObj->Query($sql);

			} else {
				if (is_numeric($this->id) && $this->id) {

					/*
					 * Deleting the domain Custom Folder (custom/domain_[ID]
					 */
					$customFolder = EDIRECTORY_ROOT."/custom/domain_$this->id";
					if (is_dir($customFolder)) {
						$this->deleteFolder($customFolder);
					}

					/*
					 * Dropping the Domain Data Base
					 */
					// Instancing the new Data Base Connection
					$dbHostNEW = $this->database_host.($this->database_port? ":".$this->database_port: "");
					$dbUserNEW = $this->database_username;
					$dbPassNEW = $this->database_password;
					$dbNameNEW = $this->database_name;

					$new_link = mysql_connect($dbHostNEW, $dbUserNEW, $dbPassNEW, true);
					@mysql_selectdb($dbNameNEW, $new_link);
					// Only if Data Base exists then Drop the Data Base
					if (!mysql_error()) {
						$sqlDrop = "DROP DATABASE `".DB_NAME_PREFIX."_domain_$this->id`";
						mysql_query($sqlDrop, $new_link);
					}

					// Control Export Listing
					$sql = "DELETE FROM `Control_Export_Listing` WHERE domain_id = $this->id";
					$dbObj->Query($sql);

					// Control Import Listing
					$sql = "DELETE FROM `Control_Import_Listing` WHERE domain_id = $this->id";
					$dbObj->Query($sql);

					// Control Cron
					$sql = "DELETE FROM `Control_Cron` WHERE `domain_id` = $this->id";
					$dbObj->Query($sql);

					// Recent Activity
					$sql = "DELETE FROM `Recent_Activity` WHERE `domain_id` = $this->id";
					$dbObj->Query($sql);

					// To Be Approved
					$sql = "DELETE FROM `To_Approved` WHERE `domain_id` = $this->id";
					$dbObj->Query($sql);

					// Dashboard
					$sql = "DELETE FROM `Dashboard` WHERE `domain_id` = $this->id";
					$dbObj->Query($sql);

					// Account
					$sql = "DELETE FROM `Account_Domain` WHERE `domain_id` = $this->id";
					$dbObj->Query($sql);

					// Package
					$sql = "DELETE FROM `Package` WHERE `parent_domain` = $this->id";
					$dbObj->Query($sql);

					// PackageItems
					$sql = "DELETE FROM `PackageItems` WHERE `domain_id` = $this->id";
					$dbObj->Query($sql);

					// PackageModules
					$sql = "DELETE FROM `PackageModules` WHERE `parent_domain_id` = $this->id";
					$dbObj->Query($sql);

					// PackageModules
					$sql = "DELETE FROM `PackageModules` WHERE `domain_id` = $this->id";
					$dbObj->Query($sql);

					// Table Domain
					$sql = "DELETE FROM `Domain` WHERE id = $this->id";
					$dbObj->Query($sql);
				}
			}

			/*
			 * Rewrite the Domain Config File
			 */
			$sql = "SELECT `id`, `url` FROM `Domain` WHERE `status` = 'A'";
			$result = $dbObj->Query($sql);
			if (mysql_num_rows($result) > 0) {
				$domainFilePath = EDIRECTORY_ROOT."/custom/domain/domain.inc.php";
				$domainFile = fopen($domainFilePath, "w+");
				unset($buffer);
				$buffer = "<?".PHP_EOL;
				while ($row = mysql_fetch_assoc($result)) {
					$buffer .= "\$domainInfo[\"".$row["url"]."\"] = ".$row["id"].";".PHP_EOL;
				}
				$buffer .= "?>".PHP_EOL;
				fwrite($domainFile, $buffer, strlen($buffer));
				fclose($domainFile);
			}
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$domainObj->ActiveDomain();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name ActiveDomain
		 * @access Public
		 */
		function ActiveDomain () {
			$dbObj = db_getDBObject(DEFAULT_DB, true);

			if ($this->id && $this->status == "P") {
				$this->status = "A";
				/*
				 * Changing the Domain Status to 'A' (Active)
				 */
				$sql = "UPDATE Domain SET status = 'A' WHERE id = $this->id";
				$dbObj->Query($sql);

				$this->changeActivationStatus();
			}

			/*
			 * Create the Domain Config File
			 */
			$sql = "SELECT `id`, `url` FROM `Domain` WHERE `status` = 'A'";
			$result = $dbObj->Query($sql);
			if (mysql_num_rows($result) > 0) {
				$domainFilePath = EDIRECTORY_ROOT."/custom/domain/domain.inc.php";
				$domainFile = fopen($domainFilePath, "w+");
				unset($buffer);
				$buffer = "<?".PHP_EOL;
				while ($row = mysql_fetch_assoc($result)) {
					$buffer .= "\$domainInfo[\"".$row["url"]."\"] = ".$row["id"].";".PHP_EOL;
				}
				$buffer .= "?>".PHP_EOL;
				fwrite($domainFile, $buffer, strlen($buffer));
				fclose($domainFile);
			}
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$domainObj->checkUserProvilegies();
		 * <br /><br />
		 *		//Using this in Domain() class.
		 *		$this->checkUserProvilegies();
		 * </code>
		 * Select the database user privileges (SHOW PRIVILEGES) and compare with the constant NEEDED_PRIVILEGES
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name checkUserProvilegies
		 * @access Public
		 * @return Array $privileges
		 */
		function checkUserProvilegies($link = false) {
			$neededPrivileges = explode(",", Domain::NEEDED_PRIVILEGES);
			$hasPrivileges = Array();

			$dbObj = db_getDBObject(DEFAULT_DB, true);
			$sql = "SHOW PRIVILEGES";

			if ($link){
				$result = mysql_query($sql, $link);
			} else {
				$result = $dbObj->Query($sql);
			}

			unset($privileges);
			if (mysql_num_rows($result) > 0) {
				while ($row = mysql_fetch_assoc($result)) {
					$hasPrivileges[] = $row["Privilege"];
				}
			}

			foreach($neededPrivileges as $neededPrivilege){
				if (in_array($neededPrivilege, $hasPrivileges)) {
						$privileges["granted"][] = $neededPrivilege;
					} else {
						$privileges["denied"][] = $neededPrivilege;
					}
			}
			if ($privileges["denied"]){
				foreach ($privileges["denied"] as $k=>$denied) {
					if (!in_array($denied, $neededPrivileges)) {
						unset($privileges["denied"][$k]);
					}
				}
			}

			return $privileges;
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$domainObj->createDatabaseDomain($temp_id);
		 * </code>
		 * Create the new Domain structure (New Database, Fulders, Files and Records on Main Database)
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name createDatabaseDomain
		 * @access Public
		 * @param integer $temp_id
		 */
		function createDatabaseDomain () {
			/*
			 * Get the sample data to make the new Domain connection
			 */
			$dbObj = db_getDBObject(DEFAULT_DB, true);

			$sql = "SELECT `database_host`, `database_port`, `database_name`, `database_username`, `database_password` FROM `Domain` WHERE `status` = 'A' ORDER BY `id` LIMIT 1";
			$result = $dbObj->query($sql);

			// Only if one or more Domain(s) exist in Main Database
			if (mysql_num_rows($result) > 0) {

				$row = mysql_fetch_assoc($result);

				// Startin the Percentage With 0%
				$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_CREATING_DATABASE), "0");

				// Make a connection with the sample data to get the sample database
				$dbHost = $row["database_host"].($row["database_port"]? ":".$row["database_port"]: "");
				$dbUser = $row["database_username"];
				$dbPass = $row["database_password"];
				$dbName = $row["database_name"];

				$sample_link = mysql_connect($dbHost, $dbUser, $dbPass, true);

				// Only if success
				if ($sample_link) {
					// Set the charset of the new connection
					mysql_query("SET NAMES 'utf8'", $sample_link);
                    mysql_query('SET character_set_connection=utf8', $sample_link);
                    mysql_query('SET character_set_client=utf8', $sample_link);
                    mysql_query('SET character_set_results=utf8', $sample_link);
					// Select the sample database
					mysql_selectdb($dbName, $sample_link);

					// Make a connection with the new data to create the new Database
					$dbHostNEW = $this->database_host.($this->database_port? ":".$this->database_port: "");
					$dbUserNEW = $this->database_username;
					$dbPassNEW = $this->database_password;
					$dbNameNEW = $this->database_name;

					$new_link = mysql_connect($dbHostNEW, $dbUserNEW, $dbPassNEW, true);

					// Only if success
					if ($new_link) {
						// Set the charset of the new connection
						mysql_query("SET NAMES 'utf8'", $new_link);
                        mysql_query('SET character_set_connection=utf8', $new_link);
                        mysql_query('SET character_set_client=utf8', $new_link);
                        mysql_query('SET character_set_results=utf8', $new_link);
						// Create the new database "domain_[ID]"
						$sqlCreateDatabase = "CREATE DATABASE `$this->database_name` CHARSET 'utf8' COLLATE 'utf8_unicode_ci'";
						mysql_query($sqlCreateDatabase, $new_link);
						// Make the instance of the new database connection object
						$new_dbObj = db_getDBObjectByDomainID($this->id, $dbObj);

						// Insert Control Export Listing
						$sqlEL = "INSERT INTO `Control_Export_Listing` (`id`, `domain_id`, `last_run_date`, `total_listing_exported`, `last_listing_id`, `block`, `finished`, `filename`, `type`, `running_cron`, `scheduled`) VALUES
									(1, $this->id, NOW(), 0, 0, 50000, 'Y', '', 'csv', 'N', 'N'),
									(2, $this->id, NOW(), 0, 0, 50000, 'Y', '', 'csv - data', 'N', 'N');";
						$dbObj->Query($sqlEL);
						
						// Insert Control Export Event
						$sqlEL = "INSERT INTO `Control_Export_Event` (`id`, `domain_id`, `last_run_date`, `total_event_exported`, `last_event_id`, `block`, `finished`, `filename`, `type`, `running_cron`, `scheduled`) VALUES
									(1, $this->id, NOW(), 0, 0, 50000, 'Y', '', 'csv', 'N', 'N'),
									(2, $this->id, NOW(), 0, 0, 50000, 'Y', '', 'csv - data', 'N', 'N');";
						$dbObj->Query($sqlEL);

						// Insert Control Import Listing
						$sqlEL = "INSERT INTO `Control_Import_Listing` (`domain_id`, `last_run_date`) VALUES ($this->id, NOW());";
						$dbObj->Query($sqlEL);
						
						// Insert Control Import Event
						$sqlEL = "INSERT INTO `Control_Import_Event` (`domain_id`, `last_run_date`) VALUES ($this->id, NOW());";
						$dbObj->Query($sqlEL);

						// Insert Control Cron
						$sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'count_article_category');";
						$dbObj->Query($sqlCC);
						$sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'count_classified_category');";
						$dbObj->Query($sqlCC);
						$sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'count_event_category');";
						$dbObj->Query($sqlCC);
						$sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'count_listing_category');";
						$dbObj->Query($sqlCC);
						$sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'count_post_tag');";
						$dbObj->Query($sqlCC);
						$sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'daily_maintenance');";
						$dbObj->Query($sqlCC);
						$sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'email_traffic');";
						$dbObj->Query($sqlCC);
						$sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'randomizer');";
						$dbObj->Query($sqlCC);
						$sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'renewal_reminder');";
						$dbObj->Query($sqlCC);
						$sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'report_rollup');";
						$dbObj->Query($sqlCC);
						$sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'sitemap');";
						$dbObj->Query($sqlCC);
						$sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'statisticreport');";
						$dbObj->Query($sqlCC);
						$sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'location_update');";
						$dbObj->Query($sqlCC);
						$sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'prepare_import');";
						$dbObj->Query($sqlCC);
						$sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'prepare_import_events');";
						$dbObj->Query($sqlCC);
						$sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'rollback_import');";
						$dbObj->Query($sqlCC);
						$sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'rollback_import_events');";
						$dbObj->Query($sqlCC);

						// Insert Dashboard
						$sqlEL = "INSERT INTO `Dashboard` (`domain_id`) VALUES ($this->id);";
						$dbObj->Query($sqlEL);

						// Get all tables of the sample database
						$sqlTables = "SHOW TABLES";
						$resultTables = mysql_query($sqlTables, $sample_link);

						// Only if has results
						if (mysql_num_rows($resultTables) > 0) {
							// Select the new database
							mysql_selectdb($dbNameNEW, $new_link);
							// Courses all tables from the sample database
							while ($rowTables = mysql_fetch_array($resultTables)) {
								unset($sqlShowCT);
								// Get the "CREATE TABLE" command from the sample table
								$sqlShowCT = "SHOW CREATE TABLE ".$rowTables[0];
								$resultCT = mysql_query($sqlShowCT, $sample_link);

								// Only if has results
								if (mysql_num_rows($resultCT) > 0) {
									$rowCT = mysql_fetch_array($resultCT);
									// Create the new table from the sample table structure
									$sqlNewTable = $rowCT[1];
									mysql_query($sqlNewTable, $new_link);
								}
							}
						}

						/*
						 * Configuring the New Domain in Main Database and Seccondary Database
						 */

						// All process below need to check if exists some error to continue ($this->CheckError())
						// If exists some error the process stop immediately

						// Set the Percentage to 10%
						// Copy the ArticleLevel data to Domain Database
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_ARTICLE_LEVEL), "10");
							$this->copyLevelToDomain("article", $new_dbObj);
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}

						// Set the Percentage to 15%
						// Copy the BannerLevel data to Domain Database
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_BANNER_LEVEL), "15");
							$this->copyLevelToDomain("banner", $new_dbObj);
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}

						// Set the Percentage to 20%
						// Copy the ClassifiedLevel data to Domain Database
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_CLASSIFIED_LEVEL), "20");
							$this->copyLevelToDomain("classified", $new_dbObj);
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}

						// Set the Percentage to 25%
						// Copy the EventLevel data to Domain Database
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_EVENT_LEVEL), "25");
							$this->copyLevelToDomain("event", $new_dbObj);
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}

						// Set the Percentage to 30%
						// Copy the ListingLevel data to Domain Database
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_LISTING_LEVEL), "30");
							$this->copyLevelToDomain("listing", $new_dbObj);
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}
                        
                        // Set the Percentage to 33%
						// Copy the ListingTemplate and ListingTemplate_Field data to Domain Database
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_LISTING_TEMPLATE), "33");
							$this->copyListingTemplateToDomain($new_dbObj);
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}

						// Set the Percentage to 35%
						// Copy the Site Content data to Domain Database
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_SITE_CONTENT), "35");
							$this->copyContentToDomain($new_dbObj);
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}

						// Set the Percentage to 40%
						// Copy the CustomText data to Domain Database
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_CUSTOM_TEXT), "40");
							$this->copyCustomTextToDomain($new_dbObj);
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}

						// Set the Percentage to 45%
						// Copy the EmailNotification data to Domain Database
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_EMAIL_NOTIFICATION), "45");
							$this->copyEmailNotificationToDomain($new_dbObj);
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}

						// Set the Percentage to 50%
						// Copy the Lang data to Domain Database
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_LANGUAGE), "50");
							$this->copyLangToDomain($new_dbObj);
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}

						// Set the Percentage to 55%
						// Copy the SettingPayment data to Domain Database
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_PAYMENT_SETTINGS), "55");
							$this->copySettingPaymentToDomain($new_dbObj);
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}

						// Set the Percentage to 60%
						// Copy the SettingSearchTag data to Domain Database
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_SEARCHTAG_SETTINGS), "60");
							$this->copySettingSearchTagToDomain($new_dbObj);
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}

						// Set the Percentage to 65%
						// Copy the SettingSocialNetwork data to Domain Database
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_SOCIALN_SETTINGS), "65");
							$this->copySettingSocialNetworkToDomain($new_dbObj);
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}

						// Set the Percentage to 70%
						// Copy the Setting Location data to Domain Database
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_LOCATION_SETTINGS), "70");
							$this->copySettingLocationToDomain($new_dbObj);
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}

						// Set the Percentage to 73%
						// Copy the Setting Google data to Domain Database
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_GOOGLE_SETTINGS), "73");
							$this->copySettingGoogleToDomain($new_dbObj);
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}

						// Set the Percentage to 74%
						// Copy the Setting data to Domain Database
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_GENERAL_SETTINGS), "74");
							$this->copySettingToDomain($new_dbObj);
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}

						// Set the Percentage to 75%
						// Insert Setting data at Domain Database
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_GENERAL_SETTINGS), "75");
							$this->activeModulesInDomain($new_dbObj);
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}
                        

						// Set the Percentage to 78%
						// Create the Domain Custom Folders "custom/domain_[ID]/ * (All folders conteined in CUSTOM_FOLDERS constant)
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_CREATING_CUSTOM_FOLDERS), "78");
							$this->createCustomFolders();
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}

						// Set the Percentage to 80%
						// Copy the Theme Folder to Domain Folder
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_THEME), "80");
							$rootThemeFolder = EDIRECTORY_ROOT."/theme/default";
							$customThemeFolder = EDIRECTORY_ROOT."/custom/domain_$this->id/theme/default";
							$this->copyThemeToDomain ($rootThemeFolder, $customThemeFolder);

							$rootImagesFolder = EDIRECTORY_ROOT."/images";
							$customImagesFolder = EDIRECTORY_ROOT."/custom/domain_$this->id/images";
							$this->copyImagesFolderToDomain ($rootImagesFolder, $customImagesFolder);
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}

						// Set the Percentage to 90%
						// Copy the Location File to Domain Folder
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_LOCATION), "90");
							$this->createCustomLocationFile();
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}

						// Set the Percentage to 92%
						// Copy the Scalability File to Domain Folder
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_SCALABILITY), "92");
							$this->createCustomScalabilityFile();
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}

						// Set the Percentage to 93%
						// Copy the SSL File to Domain Folder
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_SSL), "93");
							$this->createCustomSSLFile();
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}
						// Set the Percentage to 94%
						// Copy the Constant File to Domain Folder
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_CONSTANT), "94");
							$this->createCustomConstantFile();
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}

						// Set the Percentage to 95%
						// Copy the Lang File to Domain Folder
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_LANGUAGEFILE), "95");
							$this->copyCustomFileToDoman("lang", "language.inc.php");
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}

						// Set the Percentage to 97%
						// Copy the Payment File to Domain Folder
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_PAYMENT), "97");
							$this->copyCustomFileToDoman("payment", "payment.inc.php");
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}

						// Set the Percentage to 99%
						// Copy the Social Network File to Domain Folder
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_SOCIALNETWORK), "99");
							$this->copyCustomFileToDoman("socialnetwork", "socialnetwork.inc.php");
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}

						// Set the Percentage to 100%
						// Finishing the Process
						if (!$this->checkError()) {
							$this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_FINISHING), "100");
						} else {
							if (!$this->new_db_closed) {
								$this->new_db_closed = true;
								$new_dbObj->Close();
							}
						}
					} else {
						// Set the error file
						$this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_NEWDB));
					}
				} else {
					// Set the error file
					$this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SPDB));
				}
			} else {
				// Set the error file
				$this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_NODOMAIN));
			}
		}

		function copyLevelToDomain($module, &$new_dbObj) {
			$levelFilePath = EDIRECTORY_ROOT."/sitemgr/domain/default_script/level/".$module."_level.sql";
			if ($levelFile = fopen($levelFilePath, "r")) {
				$levelSQL = fread($levelFile, filesize($levelFilePath));
				fclose($levelFile);
				$new_dbObj->Query($levelSQL);

				if (!mysql_error()) {
                    
                    if ($module == "classified" || $module == "event" || $module == "listing"){
                        $levelFieldFilePath = EDIRECTORY_ROOT."/sitemgr/domain/default_script/level/".$module."_level_field.sql";
                        if ($levelFieldFile = fopen($levelFieldFilePath, "r")) {
                            $levelFieldSQL = fread($levelFieldFile, filesize($levelFieldFilePath));
                            fclose($levelFieldFile);
                            $new_dbObj->Query($levelFieldSQL);

                            if (mysql_error()) {
                                // Set the error file
                                $this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SQLCOMMAND));
                            }
                        } else {
                            // Set the error file
                            $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SPFILE));
                        }
                    }
                    if (!mysql_error()) {
                        $levelLangFilePath = EDIRECTORY_ROOT."/sitemgr/domain/default_script/level/".$module."_level_lang.sql";
                        if ($levelLangFile = fopen($levelLangFilePath, "r")) {
                            $levelLangSQL = fread($levelLangFile, filesize($levelLangFilePath));
                            fclose($levelLangFile);
                            $new_dbObj->Query($levelLangSQL);

                            if (mysql_error()) {
                                // Set the error file
                                $this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SQLCOMMAND));
                            }
                        } else {
                            // Set the error file
                            $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SPFILE));
                        }
                    }
				} else {
					// Set the error file
					$this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SQLCOMMAND));
				}
			} else {
				// Set the error file
				$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SPFILE));
			}
		}

		function copySettingGoogleToDomain (&$new_dbObj) {
			$googleFilePath = EDIRECTORY_ROOT."/sitemgr/domain/default_script/setting/setting_google.sql";
			if ($googleNFile = fopen($googleFilePath, "r")) {
				$googleNSQL = fread($googleNFile, filesize($googleFilePath));
				fclose($googleNFile);
				$new_dbObj->Query($googleNSQL);
				if (mysql_error()) {
					// Set the error database
					$this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SQLCOMMAND));
					return false;
				}
			} else {
				// Set the error file
				$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SPFILE));
				return false;
			}
		}

		function copySettingLocationToDomain (&$new_dbObj) {
			$locationFilePath = EDIRECTORY_ROOT."/sitemgr/domain/default_script/setting/setting_location.sql";
			if ($locationNFile = fopen($locationFilePath, "r")) {
				$locationNSQL = fread($locationNFile, filesize($locationFilePath));
				fclose($locationNFile);
				$new_dbObj->Query($locationNSQL);
				if (mysql_error()) {
					// Set the error database
					$this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SQLCOMMAND));
					return false;
				}
			} else {
				// Set the error file
				$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SPFILE));
				return false;
			}
		}

		function copyContentToDomain(&$new_dbObj) {
			$contentFilePath = EDIRECTORY_ROOT."/sitemgr/domain/default_script/content/content.sql";
			if ($contentFile = fopen($contentFilePath, "r")) {
				$contentSQL = fread($contentFile, filesize($contentFilePath));
				fclose($contentFile);
				$new_dbObj->Query($contentSQL);

				if (!mysql_error()) {
					$contentLangFilePath = EDIRECTORY_ROOT."/sitemgr/domain/default_script/content/content_lang.sql";
					if ($contentLangFile = fopen($contentLangFilePath, "r")) {
						$contentLangSQL = fread($contentLangFile, filesize($contentLangFilePath));
						fclose($contentLangFile);
						$new_dbObj->Query($contentLangSQL);

						if (mysql_error()) {
							$this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SQLCOMMAND));
						}
					} else {
						$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SPFILE));
					}
				} else {
					$this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SQLCOMMAND));
				}
			} else {
				$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SPFILE));
			}
		}

		function copyCustomTextToDomain(&$new_dbObj) {

			$customTLangFilePath = EDIRECTORY_ROOT."/sitemgr/domain/default_script/custom_text/custom_text_lang.sql";
			if ($customTtLangFile = fopen($customTLangFilePath, "r")) {
				$customTLangSQL = fread($customTtLangFile, filesize($customTLangFilePath));
				fclose($customTtLangFile);
				$new_dbObj->Query($customTLangSQL);

				if (mysql_error()) {
					$this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SQLCOMMAND));
				}
			} else {
				$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SPFILE));
			}
		}

		function copyEmailNotificationToDomain (&$new_dbObj) {
			$emailNFilePath = EDIRECTORY_ROOT."/sitemgr/domain/default_script/email_notification/email_notification.sql";
			if ($emailNFile = fopen($emailNFilePath, "r")) {
				$emailNSQL = fread($emailNFile, filesize($emailNFilePath));
				fclose($emailNFile);
				$new_dbObj->Query($emailNSQL);
				if (mysql_error()) {
					$this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SQLCOMMAND));
				}

				$emailNDFilePath = EDIRECTORY_ROOT."/sitemgr/domain/default_script/email_notification/email_notification_default.sql";
				if ($emailNDFile = fopen($emailNDFilePath, "r")) {
					$emailNDSQL = fread($emailNDFile, filesize($emailNDFilePath));
					fclose($emailNDFile);
					$new_dbObj->Query($emailNDSQL);
					if (mysql_error()) {
						$this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SQLCOMMAND));
					}
				} else {
					// Set the error file
					$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SPFILE));
				}
				
				$emailNLFilePath = EDIRECTORY_ROOT."/sitemgr/domain/default_script/email_notification/email_notification_lang.sql";
				if ($emailNLFile = fopen($emailNLFilePath, "r")) {
					$emailNLSQL = fread($emailNLFile, filesize($emailNLFilePath));
					fclose($emailNLFile);
					$new_dbObj->Query($emailNLSQL);
					if (mysql_error()) {
						$this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SQLCOMMAND));
					}
				} else {
					// Set the error file
					$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SPFILE));
				}

			} else {
				// Set the error file
				$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SPFILE));
			}
		}
        
        function copyListingTemplateToDomain (&$new_dbObj) {
			$listingTemplateFilePath = EDIRECTORY_ROOT."/sitemgr/domain/default_script/listingtemplate/listingtemplate.sql";
			if ($listingTemplateFile = fopen($listingTemplateFilePath, "r")) {
				$listingTemplateSQL = fread($listingTemplateFile, filesize($listingTemplateFilePath));
				fclose($listingTemplateFile);
				$new_dbObj->Query($listingTemplateSQL);
				if (mysql_error()) {
					$this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SQLCOMMAND));
				}

				$listingTemplateDFilePath = EDIRECTORY_ROOT."/sitemgr/domain/default_script/listingtemplate/listingtemplate_field.sql";
				if ($listingTemplateDFile = fopen($listingTemplateDFilePath, "r")) {
					$listingTemplateDSQL = fread($listingTemplateDFile, filesize($listingTemplateDFilePath));
					fclose($listingTemplateDFile);
					$new_dbObj->Query($listingTemplateDSQL);
					if (mysql_error()) {
						$this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SQLCOMMAND));
					}
				} else {
					// Set the error file
					$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SPFILE));
				}

			} else {
				// Set the error file
				$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SPFILE));
			}
		}

		function copyLangToDomain(&$new_dbObj) {
			$langFilePath = EDIRECTORY_ROOT."/sitemgr/domain/default_script/lang/lang.sql";
			if ($langFile = fopen($langFilePath, "r")) {
				$langSQL = fread($langFile, filesize($langFilePath));
				fclose($langFile);
				$new_dbObj->Query($langSQL);

				if (mysql_error()) {
					$this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SQLCOMMAND));
				}
			} else {
				$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SPFILE));
			}
		}

		function copySettingPaymentToDomain(&$new_dbObj) {
			$paymentFilePath = EDIRECTORY_ROOT."/sitemgr/domain/default_script/setting/setting_payment.sql";
			if ($paymentFile = fopen($paymentFilePath, "r")) {
				$paymentSQL = fread($paymentFile, filesize($paymentFilePath));
				fclose($paymentFile);
				$new_dbObj->Query($paymentSQL);

				if (mysql_error()) {
					$this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SQLCOMMAND));
				}
			} else {
				$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SPFILE));
			}
		}

		function copySettingSearchTagToDomain(&$new_dbObj) {
			$dbObj = db_getDBObject();
			$settingFields = db_getFields($dbObj, "Setting_Search_Tag");
			$sqlSetting = "SELECT ";
			foreach ($settingFields as $fields) {
				$sqlSetting .= "`".$fields."`,";
			}
			$sqlSetting = string_substr($sqlSetting, 0, -1);
			$sqlSetting .= "FROM `Setting_Search_Tag`";
			$resultSetting = $dbObj->Query($sqlSetting);

			if (!mysql_error()) {
				while ($rowSetting = mysql_fetch_array($resultSetting)) {
					$sqlNewSetting = "INSERT INTO `Setting_Search_Tag` (id, name, value) VALUES (";
					for ($i = 0; $i < count($settingFields); $i++) {
						$sqlNewSetting .= db_formatString($rowSetting["$settingFields[$i]"]).",";
					}
					$sqlNewSetting = string_substr($sqlNewSetting, 0, -1);
					$sqlNewSetting .= ")";
					$new_dbObj->Query($sqlNewSetting);
					if (mysql_error()) {
						$this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SQLCOMMAND));
						break;
					}
				}
				unset($dbObj);
			} else {
				$this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SQLCOMMAND));
			}
		}

		function copySettingSocialNetworkToDomain(&$new_dbObj) {
			$settingFilePath = EDIRECTORY_ROOT."/sitemgr/domain/default_script/setting/setting_social_network.sql";
			if ($settingFile = fopen($settingFilePath, "r")) {
				$settingSQL = fread($settingFile, filesize($settingFilePath));
				fclose($settingFile);
				$new_dbObj->Query($settingSQL);

				if (mysql_error()) {
					$this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SQLCOMMAND));
				}
			} else {
				$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SPFILE));
			}
		}

		function copySettingToDomain(&$new_dbObj) {
			$settingFilePath = EDIRECTORY_ROOT."/sitemgr/domain/default_script/setting/setting.sql";
			if ($settingFile = fopen($settingFilePath, "r")) {
				$settingSQL = fread($settingFile, filesize($settingFilePath));
				fclose($settingFile);
				$new_dbObj->Query($settingSQL);

				if (!mysql_error()) {
					$sqlUpdate = "UPDATE Setting SET value = '$this->url' WHERE name = 'default_url'";
					$new_dbObj->Query($sqlUpdate);
					if (mysql_error()) {
						$this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SQLCOMMAND));
					}
				} else {
					$this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SQLCOMMAND));
				}
			} else {
				$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SPFILE));
			}
		}

		function activeModulesInDomain (&$new_dbObj) {
			$error = false;

			$sql = "INSERT INTO `Setting` (`name`, `value`) VALUES ('custom_listing_feature', 'on')";
			$new_dbObj->Query($sql);
			if (mysql_error()) $error = true;

			$sql = "INSERT INTO `Setting` (`name`, `value`) VALUES ('custom_article_feature', 'on')";
			if (mysql_error()) $error = true;
			else $new_dbObj->Query($sql);

			$sql = "INSERT INTO `Setting` (`name`, `value`) VALUES ('custom_banner_feature', 'on')";
			if (mysql_error()) $error = true;
			else $new_dbObj->Query($sql);

			$sql = "INSERT INTO `Setting` (`name`, `value`) VALUES ('custom_blog_feature', 'on')";
			if (mysql_error()) $error = true;
			else $new_dbObj->Query($sql);

			$sql = "INSERT INTO `Setting` (`name`, `value`) VALUES ('custom_classified_feature', 'on')";
			if (mysql_error()) $error = true;
			else $new_dbObj->Query($sql);

			$sql = "INSERT INTO `Setting` (`name`, `value`) VALUES ('custom_promotion_feature', 'on')";
			if (mysql_error()) $error = true;
			else $new_dbObj->Query($sql);

			$sql = "INSERT INTO `Setting` (`name`, `value`) VALUES ('custom_event_feature', 'on')";
			if (mysql_error()) $error = true;
			else $new_dbObj->Query($sql);

			if ($error) {
				$this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SQLCOMMAND));
			}
		}

		function createCustomFolders () {
			$arrCustomDir = explode(",", Domain::CUSTOM_FOLDERS);
			$baseFolder = EDIRECTORY_ROOT."/custom";
			$domainFolder = $baseFolder."/domain_$this->id";
			mkdir($domainFolder);
			if (is_dir($domainFolder)) {
				foreach ($arrCustomDir as $customDir) {
					mkdir($domainFolder."/".$customDir);
					if (!is_dir($domainFolder."/".$customDir)) {
						if ((int)system_checkPerm($baseFolder) < (int)PERMISSION_CUSTOM_FOLDER) {
							$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
						} else {
							$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_CREATEFOLDER));
						}
						break;
					}
				}
			} else {
				if ((int)system_checkPerm($baseFolder) < (int)PERMISSION_CUSTOM_FOLDER) {
					$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
				} else {
					$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_CREATEFOLDER));
				}
			}
		}

		function copyThemeToDomain ($src, $dst) {
			$themeFilePath = EDIRECTORY_ROOT."/custom/domain_$this->id/theme/theme.inc.php";
			if ($themeFile = fopen($themeFilePath, "w+")) {
				$buffer = "";
				$buffer .= "<?".PHP_EOL;
				$buffer .= "\$edir_theme=\"default\";".PHP_EOL;
				$buffer .= "?>".PHP_EOL;
				fwrite($themeFile, $buffer, strlen($buffer));
				fclose($themeFile);
				$this->_copyThemeToDomain($src, $dst);
			} else {
				if ((int)system_checkPerm($dst) < (int)PERMISSION_CUSTOM_FOLDER) {
					$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
				} else {
					$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_CREATEFOLDER));
				}
			}
		}

		function _copyThemeToDomain ($src, $dst) {
			$baseFolder = EDIRECTORY_ROOT."/custom";
			$dir = opendir($src);
			if (!file_exists($dst) && string_strpos($src, "/.") === false) mkdir($dst);
			if (is_dir) {
				while(false !== ($file = readdir($dir))) {
					if (($file != '.') && ($file != '..')) {
						if (string_strpos($src, "/.") === false) {
							if (is_dir($src.'/'.$file)) {
								$this->_copyThemeToDomain($src.'/'.$file,$dst.'/'.$file);
							} else {
								copy($src.'/'.$file, $dst.'/'.$file);
								if (!file_exists($dst.'/'.$file)) {
									if ((int)system_checkPerm($baseFolder) < (int)PERMISSION_CUSTOM_FOLDER) {
										$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
									} else {
										$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_THEMEFILE));
									}
									break;
								}
							}
						} else {
							continue;
						}
					}
				}
				closedir($dir);
			} else {
				if ((int)system_checkPerm($baseFolder) < (int)PERMISSION_CUSTOM_FOLDER) {
					$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
				} else {
					$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_CREATEFOLDER));
				}
			}
		}

		function copyImagesFolderToDomain ($src, $dst) {
			$baseFolder = EDIRECTORY_ROOT."/custom/domain_$this->id";
			$dir = opendir($src);
			if (!file_exists($dst) && string_strpos($src, "/.") === false) mkdir($dst);
			if (is_dir) {
				while(false !== ($file = readdir($dir))) {
					if (($file != '.') && ($file != '..')) {
						if (string_strpos($src, "/.") === false) {
							if (is_dir($src.'/'.$file)) {
								$this->copyImagesFolderToDomain($src.'/'.$file,$dst.'/'.$file);
							} else {
								copy($src.'/'.$file, $dst.'/'.$file);
								if (!file_exists($dst.'/'.$file)) {
									if ((int)system_checkPerm($baseFolder) < (int)PERMISSION_CUSTOM_FOLDER) {
										$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
									} else {
										$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_THEMEFILE));
									}
									break;
								}
							}
						} else {
							continue;
						}
					}
				}
				closedir($dir);
			} else {
				if ((int)system_checkPerm($baseFolder) < (int)PERMISSION_CUSTOM_FOLDER) {
					$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
				} else {
					$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_CREATEFOLDER));
				}
			}
		}

		function createCustomLocationFile () {
			$fileLocPath = EDIRECTORY_ROOT."/custom/domain_$this->id/location/location.inc.php";
			if ($fileLoc = fopen($fileLocPath, 'w+')) {

				$buffer = "<?php".PHP_EOL;

				$buffer .= "\$edir_default_locations = \"";
				$buffer .= "\";".PHP_EOL;
				$buffer .= "\$edir_default_locationids = \"";
				$buffer .= "\";".PHP_EOL;
				$buffer .= "\$edir_default_locationnames = \"";
				$buffer .= "\";".PHP_EOL;
				$buffer .= "\$edir_default_locationshow = \"";
				$buffer .= "\";".PHP_EOL.PHP_EOL;

				$buffer .= "\$edir_locations = \"1,3,4";
				$buffer .= "\";".PHP_EOL;
				$buffer .= "\$edir_locationnames = \"COUNTRY,STATE,CITY";
				$buffer .= "\";".PHP_EOL;
				$buffer .= "\$edir_locationnames_plural = \"COUNTRIES,STATES,CITIES";
				$buffer .= "\";".PHP_EOL.PHP_EOL;

				$buffer .= "\$edir_all_locations = \"1,2,3,4,5";
				$buffer .= "\";".PHP_EOL;
				$buffer .= "\$edir_all_locationnames = \"COUNTRY,REGION,STATE,CITY,NEIGHBORHOOD";
				$buffer .= "\";".PHP_EOL;
				$buffer .= "\$edir_all_locationnames_plural = \"COUNTRIES,REGIONS,STATES,CITIES,NEIGHBORHOODS";
				$buffer .= "\";".PHP_EOL;
				$buffer .= "?>".PHP_EOL;

				$return_flag = fwrite($fileLoc, $buffer, strlen($buffer));

				fclose($fileLoc);
			} else {
				if ((int)system_checkPerm(EDIRECTORY_ROOT."/custom") < (int)PERMISSION_CUSTOM_FOLDER) {
					$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
				} else {
					$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_CREATEFILE));
				}
			}
		}

		function createCustomScalabilityFile () {
			$fileScalPath = EDIRECTORY_ROOT."/custom/domain_$this->id/conf/scalability.inc.php";
			if ($fileScal = fopen($fileScalPath, "w+")) {
				$buffer = "";
				$buffer .= "<?".PHP_EOL;
				$buffer .= "/*==================================================================*\\".PHP_EOL;
				$buffer .= "######################################################################".PHP_EOL;
				$buffer .= "#                                                                    #".PHP_EOL;
				$buffer .= "# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #".PHP_EOL;
				$buffer .= "#                                                                    #".PHP_EOL;
				$buffer .= "# This file may not be redistributed in whole or part.               #".PHP_EOL;
				$buffer .= "# eDirectory is licensed on a per-domain basis.                      #".PHP_EOL;
				$buffer .= "#                                                                    #".PHP_EOL;
				$buffer .= "# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #".PHP_EOL;
				$buffer .= "#                                                                    #".PHP_EOL;
				$buffer .= "# http://www.edirectory.com | http://www.edirectory.com/license.html #".PHP_EOL;
				$buffer .= "######################################################################".PHP_EOL;
				$buffer .= "\*==================================================================*/".PHP_EOL;

				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "# * FILE: /custom/domain_$this->id/conf/scalability.inc.php".PHP_EOL;
				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;

				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "# FLAGS - on/off".PHP_EOL;
				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;

				$buffer .= "// suggestion: turn on if edirectory has more than 100.000 listings and/or more than 50.000 listings on the highest level".PHP_EOL;
				$buffer .= "define(\"LISTING_SCALABILITY_OPTIMIZATION\", \"off\");".PHP_EOL;

				$buffer .= "// suggestion: turn on if edirectory has more than 50.000 promotions".PHP_EOL;
				$buffer .= "define(\"PROMOTION_SCALABILITY_OPTIMIZATION\", \"off\");".PHP_EOL;
                                
                $buffer .= "// suggestion: turn off if edirectory has more than 50.000 promotions".PHP_EOL;
                $buffer .= "define(\"PROMOTION_SCALABILITY_USE_AUTOCOMPLETE\", \"on\");".PHP_EOL;

				$buffer .= "// suggestion: turn on if edirectory has more than 100.000 events and/or more than 50.000 events on the highest level".PHP_EOL;
				$buffer .= "define(\"EVENT_SCALABILITY_OPTIMIZATION\", \"off\");".PHP_EOL;

				$buffer .= "// suggestion: turn on if edirectory has more than 50.000 banners".PHP_EOL;
				$buffer .= "define(\"BANNER_SCALABILITY_OPTIMIZATION\", \"off\");".PHP_EOL;

				$buffer .= "// suggestion: turn on if edirectory has more than 100.000 classifieds and/or more than 50.000 classifieds on the highest level".PHP_EOL;
				$buffer .= "define(\"CLASSIFIED_SCALABILITY_OPTIMIZATION\", \"off\");".PHP_EOL;

				$buffer .= "// suggestion: turn on if edirectory has more than 100.000 articles and/or more than 50.000 articles on the highest level".PHP_EOL;
				$buffer .= "define(\"ARTICLE_SCALABILITY_OPTIMIZATION\", \"off\");".PHP_EOL;

				$buffer .= "// suggestion: turn on if edirectory has more than 20 main listing categories".PHP_EOL;
				$buffer .= "define(\"LISTINGCATEGORY_SCALABILITY_OPTIMIZATION\", \"off\");".PHP_EOL;

				$buffer .= "// suggestion: turn on if edirectory has more than 20 main event categories".PHP_EOL;
				$buffer .= "define(\"EVENTCATEGORY_SCALABILITY_OPTIMIZATION\", \"off\");".PHP_EOL;

				$buffer .= "// suggestion: turn on if edirectory has more than 20 main classified categories".PHP_EOL;
				$buffer .= "define(\"CLASSIFIEDCATEGORY_SCALABILITY_OPTIMIZATION\", \"off\");".PHP_EOL;

				$buffer .= "// suggestion: turn on if edirectory has more than 20 main article categories".PHP_EOL;
				$buffer .= "define(\"ARTICLECATEGORY_SCALABILITY_OPTIMIZATION\", \"off\");".PHP_EOL;

				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "# AUTOMATIC FEATURES".PHP_EOL;
				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)".PHP_EOL;
				$buffer .= "if ((LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == \"on\") || (EVENTCATEGORY_SCALABILITY_OPTIMIZATION == \"on\") || (CLASSIFIEDCATEGORY_SCALABILITY_OPTIMIZATION == \"on\") || (ARTICLECATEGORY_SCALABILITY_OPTIMIZATION == \"on\")) {".PHP_EOL;
				$buffer .= "	define(\"CATEGORY_SCALABILITY_OPTIMIZATION\", \"on\");".PHP_EOL;
				$buffer .= "} else {".PHP_EOL;
				$buffer .= "	define(\"CATEGORY_SCALABILITY_OPTIMIZATION\", \"off\");".PHP_EOL;
				$buffer .= "}".PHP_EOL;
				$buffer .= "// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)".PHP_EOL;
				$buffer .= "?>".PHP_EOL;

				fwrite($fileScal, $buffer, strlen($buffer));
				fclose($fileScal);
			} else {
				if ((int)system_checkPerm(EDIRECTORY_ROOT."/custom") < (int)PERMISSION_CUSTOM_FOLDER) {
					$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
				} else {
					$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_CREATEFILE));
				}
			}
		}

		function createCustomSSLFile () {
			$fileSSLPath = EDIRECTORY_ROOT."/custom/domain_$this->id/conf/ssl.inc.php";
			if ($fileSSL = fopen($fileSSLPath, "w+")) {
				$buffer = "";
				$buffer .= "<?".PHP_EOL;;
				$buffer .= "/*==================================================================*\\".PHP_EOL;
				$buffer .= "######################################################################".PHP_EOL;
				$buffer .= "#                                                                    #".PHP_EOL;
				$buffer .= "# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #".PHP_EOL;
				$buffer .= "#                                                                    #".PHP_EOL;
				$buffer .= "# This file may not be redistributed in whole or part.               #".PHP_EOL;
				$buffer .= "# eDirectory is licensed on a per-domain basis.                      #".PHP_EOL;
				$buffer .= "#                                                                    #".PHP_EOL;
				$buffer .= "# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #".PHP_EOL;
				$buffer .= "#                                                                    #".PHP_EOL;
				$buffer .= "# http://www.edirectory.com | http://www.edirectory.com/license.html #".PHP_EOL;
				$buffer .= "######################################################################".PHP_EOL;
				$buffer .= "\*==================================================================*/".PHP_EOL;

				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "# * FILE: /custom/domain_$this->id/conf/ssl.inc.php".PHP_EOL;
				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;

				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "# FLAGS - on/off".PHP_EOL;
				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "define(\"SSL_ENABLED\", \"off\");".PHP_EOL;
                $buffer .= "define(\"FORCE_PROFILE_SSL\", \"off\");".PHP_EOL;
				$buffer .= "define(\"FORCE_MEMBERS_SSL\", \"off\");".PHP_EOL;
				$buffer .= "define(\"FORCE_ORDER_SSL\", \"off\");".PHP_EOL;
				$buffer .= "define(\"FORCE_CLAIM_SSL\", \"off\");".PHP_EOL;
				$buffer .= "define(\"FORCE_SITEMGR_SSL\", \"off\");".PHP_EOL;

				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "# SSL".PHP_EOL;
				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "if (SSL_ENABLED == \"on\") {".PHP_EOL;
                $buffer .= "	if (FORCE_PROFILE_SSL == \"on\") {".PHP_EOL;
				$buffer .= "		if ((HTTPS_MODE != \"on\") && (string_strpos(\$_SERVER[\"PHP_SELF\"], \"/profile\") !== false) && (string_strpos(\$_SERVER[\"PHP_SELF\"], \"/profile/login.php\") === false) && (string_strpos(\$_SERVER[\"PHP_SELF\"], \"/profile/logout.php\") === false)) {".PHP_EOL;
				$buffer .= "			header(\"Location: \".\"https://\".\$_SERVER[\"HTTP_HOST\"].\$_SERVER[\"REQUEST_URI\"]);".PHP_EOL;
				$buffer .= "			exit;".PHP_EOL;
				$buffer .= "		}".PHP_EOL;
				$buffer .= "	}".PHP_EOL;
				$buffer .= "	if (FORCE_MEMBERS_SSL == \"on\") {".PHP_EOL;
				$buffer .= "		if ((HTTPS_MODE != \"on\") && (string_strpos(\$_SERVER[\"PHP_SELF\"], \"/members\") !== false) && (string_strpos(\$_SERVER[\"PHP_SELF\"], \"facebookauth.php\") === false) && (string_strpos(\$_SERVER[\"PHP_SELF\"], \"facebookimage.php\") === false)) {".PHP_EOL;
				$buffer .= "			header(\"Location: \".\"https://\".\$_SERVER[\"HTTP_HOST\"].\$_SERVER[\"REQUEST_URI\"]);".PHP_EOL;
				$buffer .= "			exit;".PHP_EOL;
				$buffer .= "		}".PHP_EOL;
				$buffer .= "		if ((HTTPS_MODE != \"on\") && (FORCE_ORDER_SSL == \"on\") && (string_strpos(\$_SERVER[\"PHP_SELF\"], \"order_\") !== false)) {".PHP_EOL;
				$buffer .= "			header(\"Location: \".\"https://\".\$_SERVER[\"HTTP_HOST\"].\$_SERVER[\"REQUEST_URI\"]);".PHP_EOL;
				$buffer .= "			exit;".PHP_EOL;
				$buffer .= "		}".PHP_EOL;
				$buffer .= "		if ((HTTPS_MODE != \"on\") && (FORCE_CLAIM_SSL == \"on\") && (string_strpos(\$_SERVER[\"PHP_SELF\"], \"claim.php\") !== false)) {".PHP_EOL;
				$buffer .= "			header(\"Location: \".\"https://\".\$_SERVER[\"HTTP_HOST\"].\$_SERVER[\"REQUEST_URI\"]);".PHP_EOL;
				$buffer .= "			exit;".PHP_EOL;
				$buffer .= "		}".PHP_EOL;
				$buffer .= "	}".PHP_EOL;
				$buffer .= "	if (FORCE_SITEMGR_SSL == \"on\") {".PHP_EOL;
				$buffer .= "		if ((HTTPS_MODE != \"on\") && (string_strpos(\$_SERVER[\"PHP_SELF\"], \"/sitemgr\") !== false) && (string_strpos(\$_SERVER[\"PHP_SELF\"], \"/registration.php\") === false) && (string_strpos(\$_SERVER[\"PHP_SELF\"], \"&popup=1\") === false)) {".PHP_EOL;
				$buffer .= "			header(\"Location: \".\"https://\".\$_SERVER[\"HTTP_HOST\"].\$_SERVER[\"REQUEST_URI\"]);".PHP_EOL;
				$buffer .= "			exit;".PHP_EOL;
				$buffer .= "		}".PHP_EOL;
				$buffer .= "	}".PHP_EOL;
				$buffer .= "} else {".PHP_EOL;
				$buffer .= "	if (HTTPS_MODE == \"on\") {".PHP_EOL;
				$buffer .= "		header(\"Location: \".\"http://\".\$_SERVER[\"HTTP_HOST\"].\$_SERVER[\"REQUEST_URI\"]);".PHP_EOL;
				$buffer .= "		exit;".PHP_EOL;
				$buffer .= "	}".PHP_EOL;
				$buffer .= "}".PHP_EOL;
				$buffer .= "?>".PHP_EOL;

				fwrite($fileSSL, $buffer, strlen($buffer));
				fclose($fileSSL);
			} else {
				if ((int)system_checkPerm(EDIRECTORY_ROOT."/custom") < (int)PERMISSION_CUSTOM_FOLDER) {
					$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
				} else {
					$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_CREATEFILE));
				}
			}
		}

		function createCustomConstantFile () {
			$fileConstPath = EDIRECTORY_ROOT."/custom/domain_$this->id/conf/constants.inc.php";
			if ($fileConst = fopen($fileConstPath, "w+")) {
				$buffer = "";
				$buffer .= "<?".PHP_EOL;;
				$buffer .= "/*==================================================================*\\".PHP_EOL;
				$buffer .= "######################################################################".PHP_EOL;
				$buffer .= "#                                                                    #".PHP_EOL;
				$buffer .= "# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #".PHP_EOL;
				$buffer .= "#                                                                    #".PHP_EOL;
				$buffer .= "# This file may not be redistributed in whole or part.               #".PHP_EOL;
				$buffer .= "# eDirectory is licensed on a per-domain basis.                      #".PHP_EOL;
				$buffer .= "#                                                                    #".PHP_EOL;
				$buffer .= "# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #".PHP_EOL;
				$buffer .= "#                                                                    #".PHP_EOL;
				$buffer .= "# http://www.edirectory.com | http://www.edirectory.com/license.html #".PHP_EOL;
				$buffer .= "######################################################################".PHP_EOL;
				$buffer .= "\*==================================================================*/".PHP_EOL;

				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "# * FILE: /custom/domain_$this->id/conf/constants.inc.php".PHP_EOL;
				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;

				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "# FLAGS - on/off".PHP_EOL;
				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "# ****************************************************************************************************".PHP_EOL;
				$buffer .= "# MODULES".PHP_EOL;
				$buffer .= "# NOTE: Do not alter this area of the code manually.".PHP_EOL;
				$buffer .= "# Any changes will require eDirectory to be activated again.".PHP_EOL;
				$buffer .= "# P.S.: you can turn off it any time.".PHP_EOL;
				$buffer .= "# ****************************************************************************************************".PHP_EOL;
				$buffer .= "define(\"EVENT_FEATURE\", \"".$this->event_feature."\");".PHP_EOL;
				$buffer .= "define(\"BANNER_FEATURE\", \"".$this->banner_feature."\");".PHP_EOL;
				$buffer .= "define(\"CLASSIFIED_FEATURE\", \"".$this->classified_feature."\");".PHP_EOL;
				$buffer .= "define(\"ARTICLE_FEATURE\", \"".$this->article_feature."\");".PHP_EOL;
				$buffer .= "define(\"PROMOTION_FEATURE\", \"on\");".PHP_EOL;
				$buffer .= "define(\"BLOG_FEATURE\", \"on\");".PHP_EOL;
				$buffer .= "define(\"ZIPCODE_PROXIMITY\", \"on\");".PHP_EOL;

				$buffer .= "# ****************************************************************************************************".PHP_EOL;
				$buffer .= "# FEATURES".PHP_EOL;
				$buffer .= "# NOTE: Do not alter this area of the code manually.".PHP_EOL;
				$buffer .= "# Any changes will require eDirectory to be activated again.".PHP_EOL;
				$buffer .= "# P.S.: you can turn off it any time.".PHP_EOL;
				$buffer .= "# ****************************************************************************************************".PHP_EOL;
				$buffer .= "define(\"MODREWRITE_FEATURE\", \"on\");".PHP_EOL;
				$buffer .= "define(\"CUSTOM_INVOICE_FEATURE\", \"on\");".PHP_EOL;
				$buffer .= "define(\"CLAIM_FEATURE\", \"on\");".PHP_EOL;
				$buffer .= "define(\"LISTINGTEMPLATE_FEATURE\", \"on\");".PHP_EOL;
				$buffer .= "define(\"MOBILE_FEATURE\", \"on\");".PHP_EOL;
				$buffer .= "define(\"MULTILANGUAGE_FEATURE\", \"on\");".PHP_EOL;
				$buffer .= "define(\"MAINTENANCE_FEATURE\", \"on\");".PHP_EOL;

				$buffer .= "# ****************************************************************************************************".PHP_EOL;
				$buffer .= "# EXTRA FEATURES".PHP_EOL;
				$buffer .= "# NOTE: Do not alter this area of the code manually.".PHP_EOL;
				$buffer .= "# Any changes will require eDirectory to be activated again.".PHP_EOL;
				$buffer .= "# P.S.: you can turn off it any time.".PHP_EOL;
				$buffer .= "# ****************************************************************************************************".PHP_EOL;
				$buffer .= "// MODREWRITE_FEATURE must be on".PHP_EOL;
				$buffer .= "define(\"SITEMAP_FEATURE\", \"on\");".PHP_EOL;

				$buffer .= "# ****************************************************************************************************".PHP_EOL;
				$buffer .= "# CUSTOMIZATIONS".PHP_EOL;
				$buffer .= "# NOTE: Do not alter this area of the code manually.".PHP_EOL;
				$buffer .= "# Any changes will require eDirectory to be activated again.".PHP_EOL;
				$buffer .= "# ****************************************************************************************************".PHP_EOL;
				$buffer .= "define(\"BRANDED_PRINT\", \"on\");".PHP_EOL;

				$buffer .= "# ****************************************************************************************************".PHP_EOL;
				$buffer .= "# PAYMENT SYSTEM FEATURE".PHP_EOL;
				$buffer .= "# NOTE: Do not alter this area of the code manually.".PHP_EOL;
				$buffer .= "# Any changes will require eDirectory to be activated again.".PHP_EOL;
				$buffer .= "# P.S.: you can turn off it any time.".PHP_EOL;
				$buffer .= "# ****************************************************************************************************".PHP_EOL;
				$buffer .= "define(\"PAYMENTSYSTEM_FEATURE\", \"on\");".PHP_EOL;

				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "# EDIRECTORY TITLE".PHP_EOL;
				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "define(\"EDIRECTORY_TITLE\", \"".$this->name."\");".PHP_EOL;

				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "# GEO IP CONFIGURATION".PHP_EOL;
				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "define(\"GEOIP_FEATURE\", \"on\");".PHP_EOL;

				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "# SHOW BANNER MODE".PHP_EOL;
				$buffer .= "# NOTE: This flag is only to the front view".PHP_EOL;
				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "define(\"SHOW_INACTIVE_BANNER\", \"off\");".PHP_EOL;
				
				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "# REDIRECT USERS TO THEY LANGUAGE URL".PHP_EOL;
				$buffer .= "# NOTE: This flag is only to the front and sponsor view when the user log in the site".PHP_EOL;
				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "define(\"REDIRECT_USER_BYLANG\", \"on\");".PHP_EOL;
				
				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "# CACHE FULL SETTINGS".PHP_EOL;
				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "define(\"CACHE_FULL_FEATURE\", \"on\"); //be sure that the constant below is also on if you turn this one on".PHP_EOL;
				$buffer .= "define(\"CACHE_FULL_ZLIB_COMPRESSION_IF_AVAILABLE\", \"on\"); //this constant must be on if CACHE_FULL_FEATURE is on".PHP_EOL;
				$buffer .= "define(\"CACHE_FULL_VERBOSE_MODE\", \"off\"); ".PHP_EOL;
				$buffer .= "define(\"CACHE_FULL_LOG_EXPIRATION_QUERIES\", \"off\"); ".PHP_EOL;
				$buffer .= "define(\"CACHE_FULL_INCLUDE_CACHE_COMMENT_AT_PAGE\", \"off\");".PHP_EOL;
				$buffer .= "define(\"CACHE_FULL_FOR_LOGGED_MEMBERS\", \"on\");".PHP_EOL;
				$buffer .= "define(\"CACHE_FULL_REMOVE_FILES_WHEN_DISABLED\", \"on\");".PHP_EOL;
				
				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "# CACHE FULL FEATURE CONTENT SETTINGS".PHP_EOL;
				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "define(\"CACHE_FULL_ALWAYS_FRESH_FEATURED_LISTING\", \"on\");".PHP_EOL;
				$buffer .= "define(\"CACHE_FULL_ALWAYS_FRESH_FEATURED_DEAL\", \"on\");".PHP_EOL;
				$buffer .= "define(\"CACHE_FULL_ALWAYS_FRESH_FEATURED_CLASSIFIED\", \"on\");".PHP_EOL;
				$buffer .= "define(\"CACHE_FULL_ALWAYS_FRESH_FEATURED_EVENT\", \"on\");".PHP_EOL;
				$buffer .= "define(\"CACHE_FULL_ALWAYS_FRESH_FEATURED_ARTICLE\", \"on\");".PHP_EOL;
				
				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "# CACHE PARTIAL SETTINGS".PHP_EOL;
				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "define(\"CACHE_PARTIAL_FEATURE\", \"on\");".PHP_EOL;
                
                $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "# FRONT SEARCH".PHP_EOL;
				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "define(\"SEARCH_FORCE_BOOLEANMODE\", \"on\");".PHP_EOL;
                
                $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "# GALLERY IMAGES".PHP_EOL;
				$buffer .= "#  - Turn on this constant to remove the crop for wide images.".PHP_EOL;
				$buffer .= "#  - Remember to turn off the constant RESIZE_IMAGES_UPGRADE in conf/constants.inc.php.".PHP_EOL;
				$buffer .= "#  - ATTENTION! The thumb preview in the upload window will not be shown when this constant is turned on.".PHP_EOL;
				$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
				$buffer .= "define(\"GALLERY_FREE_RATIO\", \"off\");".PHP_EOL;
                
				$buffer .= "?>".PHP_EOL;

				fwrite($fileConst, $buffer, strlen($buffer));
				fclose($fileConst);
			} else {
				if ((int)system_checkPerm(EDIRECTORY_ROOT."/custom") < (int)PERMISSION_CUSTOM_FOLDER) {
					$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
				} else {
					$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_CREATEFILE));
				}
			}
		}

		function copyCustomFileToDoman ($folder, $file) {
			$srcFile = EDIRECTORY_ROOT."/sitemgr/domain/default_custom_file/$folder/$file";
			$dstFolder = EDIRECTORY_ROOT."/custom/domain_$this->id/$folder/$file";
			copy($srcFile, $dstFolder);
			if (!file_exists($dstFolder)) {
				if ((int)system_checkPerm(EDIRECTORY_ROOT."/custom") < (int)PERMISSION_CUSTOM_FOLDER) {
					$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
				} else {
					$this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_CREATEFILE));
				}
			}
		}

		function incFilePercentage ($message, $per) {

			$this->percent = $per;

			$fileLoadingPath = EDIRECTORY_ROOT."/custom/domain_".$this->id."_loading.txt";
			$fileLogPath = EDIRECTORY_ROOT."/custom/domain_".$this->id."_log.txt";

			if (file_exists($fileLogPath)) {
				$fileLog = fopen($fileLogPath, 'r');
				$logText = fread($fileLog, filesize($fileLogPath));
				fclose($fileLog);
				unset($fileLog);

				$fileLog = fopen($fileLogPath, "w+");
				$bufferLog = "";
				$bufferLog .= $logText."\n\r";
				$bufferLog .= "Process -> $message - $this->percent% - ".date('l jS \of F Y h:i:s A')."\n\r";
				fwrite($fileLog, $bufferLog, string_strlen($bufferLog));
				fclose($fileLog);
			} else {
				$fileLog = fopen($fileLogPath, "w+");
				$bufferLog = "";
				$bufferLog .= "Process -> $message - $this->percent% - ".date('l jS \of F Y h:i:s A')."\n\r";
				fwrite($fileLog, $bufferLog, string_strlen($bufferLog));
				fclose($fileLog);
			}

			$fileLoading = fopen($fileLoadingPath, 'w+');
			$bufferLoading = "";
			$bufferLoading .= "$message|";
			$bufferLoading .= "$this->percent".PHP_EOL;
			fwrite($fileLoading, $bufferLoading, string_strlen($bufferLoading));
			fclose($fileLoading);
		}

		function writeErrorFile ($errorType, $errorMessage) {
			$this->error = true;
			$fileErrorPath = EDIRECTORY_ROOT."/custom/domain_".$this->id."_error.txt";
			unset($returnMessage);
			if ($errorType == "database") {
				$returnMessage .= system_showText(LANG_SITEMGR_DOMAIN_ERROR_DBERROR)." ";
			} else if ($errorType == "file") {
				$returnMessage .= system_showText(LANG_SITEMGR_DOMAIN_ERROR_FOLDERERROR)." ";
			}

			$fileError = fopen($fileErrorPath, "w+");
			$bufferError = "";
			$bufferError = $returnMessage.$errorMessage.PHP_EOL;
			fwrite($fileError, $bufferError, string_strlen($bufferError));
			fclose($fileError);
		}

		function checkError () {
			if (!$this->error) {
				$fileErrorPath = EDIRECTORY_ROOT."/custom/domain_".$this->id."_error.txt";
				if (file_exists($fileErrorPath)) {
					$this->error = true;
					return true;
				} else {
					$this->error = false;
					return false;
				}
			} else {
				$this->error = true;
				return true;
			}
		}

		function deleteFolder($directory, $empty = false) {
			if(string_substr($directory,-1) == "/") {
				$directory = string_substr($directory,0,-1);
			}

			if(!file_exists($directory) || !is_dir($directory)) {
				return false;
			} elseif(!is_readable($directory)) {
				return false;
			} else {
				$directoryHandle = opendir($directory);

				while ($contents = readdir($directoryHandle)) {
					if($contents != '.' && $contents != '..') {
						$path = $directory . "/" . $contents;

						if(is_dir($path)) {
							$this->deleteFolder($path);
						} else {
							unlink($path);
						}
					}
				}

				closedir($directoryHandle);

				if($empty == false) {
					if(!rmdir($directory)) {
						return false;
					}
				}
				return true;
			}
		}

		function getAllDomains($array_fields, $status, $less_this_domain = false){

			$dbObj = db_getDBObject(DEFAULT_DB, true);
			$sql = "SELECT ".(is_array($array_fields) ? implode(",",$array_fields) : $array_fields)." FROM `Domain` WHERE `status` = '".$status."'".($less_this_domain ? " AND `id` != ".$less_this_domain : "")." ORDER BY name";
			$result = $dbObj->query($sql);
			if(mysql_num_rows($result)){
				unset($domains);
				while($row = mysql_fetch_assoc($result)){
					$domains[] = $row;
				}
				if($domains){
					return $domains;
				}else{
					return false;
				}
			}else{
				return false;
			}

		}

		function changeActivationStatus () {
			$auxAStatus = isRegistered($this->url, $this->id);

			if ($auxAStatus && $this->activation_status == "P") {
				$this->activation_status = "A";

				$dbObj = db_getDBObject(DEFAULT_DB, true);
				$this->prepareToSave();
				$sql = "UPDATE `Domain` SET `activation_status` = $this->activation_status WHERE `id` = $this->id";
				$dbObj->Query($sql);
				$this->prepareToUse();
			} else if (!$auxAStatus && $this->activation_status == "A") {
				$this->activation_status = "P";

				$dbObj = db_getDBObject(DEFAULT_DB, true);
				$this->prepareToSave();
				$sql = "UPDATE `Domain` SET `activation_status` = $this->activation_status WHERE `id` = $this->id";
				$dbObj->Query($sql);
				$this->prepareToUse();
			}
		}
		
		
		
	}
?>