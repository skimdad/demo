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
	# * FILE: /classes/class_googleSettings.php
	# ----------------------------------------------------------------------------------------------------

	class GoogleSettings extends Handle {

		var $id;
		var $name;
		var $value;

		function GoogleSettings($var='', $domain = false) {
			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if ($domain) {
					$domain = str_replace("www.", "", $domain);
					$db = db_getDBObjectByDomainID(0, $dbMain, $domain);
				} else {
					if (defined("SELECTED_DOMAIN_ID")) {
						$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
					} else {
						$db = db_getDBObject();
					}
					unset($dbMain);
				}
				$sql = "SELECT * FROM Setting_Google WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			}
		}

		function makeFromRow($row='') {

			$this->id		= ($row['id'])		? $row['id']		: 0;
			$this->name		= ($row['name'])	? $row['name']		: 0;
			$this->value	= ($row['value'])	? $row['value']		: "";

		}

		function Save() {

			$this->prepareToSave();

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
			if ($this->id) {
				$sql =	"UPDATE Setting_Google SET"
						. " name  = $this->name, "
						. " value = $this->value"
						. " WHERE id = $this->id";
				$dbObj->query($sql);
			}

			$this->prepareToUse();

		}

		/*--------- chars not allowed => " ' \ /  ----------*/
		function formatValue($value) {

			if ($value) {
				/* replacing bad characters */
				$value = str_replace("\"", "", $value);
				$value = str_replace("'", "", $value);
				$value = str_replace("/", "", $value);
				$value = str_replace("\\\\", "", $value);

				if ($value) return $value;
				else return false;

			} else {
				return false;
			}

		}
                
                function getByItemName($name,$domain = FALSE){
			$dbMain = db_getDBObject(DEFAULT_DB, true);
				if ($domain) {
					$domain = str_replace("www.", "", $domain);
					$db = db_getDBObjectByDomainID(0, $dbMain, $domain);
				} else {
					if (defined("SELECTED_DOMAIN_ID")) {
						$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
					} else {
						$db = db_getDBObject();
					}
					unset($dbMain);
				}
				$sql = "SELECT * FROM Setting_Google WHERE name ='$name'";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
		}

	}

?>
