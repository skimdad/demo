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
	# * FILE: /classes/class_CheckIn.php
	# ----------------------------------------------------------------------------------------------------

	class CheckIn extends Handle {

		var $id;
		var $item_id;
		var $member_id;
		var $added;
		var $ip;
		var $quick_tip;
		var $checkin_name;

		function CheckIn($var="") {
			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
//				$dbMain->close();
				unset($dbMain);
				$sql = "SELECT * FROM CheckIn WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row="") {

			$this->id                    = ($row["id"])                     ? $row["id"]                    : ($this->id                    ? $this->id                     : 0);
			$this->item_id               = ($row["item_id"])                ? $row["item_id"]               : ($this->item_id               ? $this->item_id                : 0);
			$this->member_id             = ($row["member_id"])              ? $row["member_id"]             : ($this->member_id             ? $this->member_id              : 0);
			$this->added                 = ($row["added"])                  ? $row["added"]                 : ($this->added                 ? $this->added                  : "");
			$this->ip                    = ($row["ip"])                     ? $row["ip"]                    : ($this->ip                    ? $this->ip                     : "");
			$this->quick_tip             = ($row["quick_tip"])              ? $row["quick_tip"]             : "";
			$this->checkin_name          = ($row["checkin_name"])           ? $row["checkin_name"]          : "";


		}

		function Save() {

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
//			$dbMain->close();
			unset($dbMain);

			$this->prepareToSave();

			if ($this->id) {

				$sql = "UPDATE CheckIn SET"
					. " item_id           = $this->item_id,"
					. " member_id         = $this->member_id,"
					. " added             = $this->added,"
					. " ip                = $this->ip,"
					. " quick_tip         = $this->quick_tip, "
					. " checkin_name      = $this->checkin_name "
					. " WHERE id          = $this->id";

					$dbObj->query($sql);

			} else {

				$sql = "INSERT INTO CheckIn"
					. " (item_id,"
					. " member_id,"
					. " added,"
					. " ip,"
					. " quick_tip,"
					. " checkin_name"
					. " )"
					. " VALUES"
					. " ("
					. " $this->item_id,"
					. " $this->member_id,"
					. " NOW(),"
					. " $this->ip,"
					. " $this->quick_tip,"
					. " $this->checkin_name"
					. " )";

				$dbObj->query($sql);

				$this->id = mysql_insert_id($dbObj->link_id);

			}

			$this->prepareToUse();

		}

		function Delete($domain_id = false) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($domain_id) {
				$dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
			} else {
				if (defined("SELECTED_DOMAIN_ID")) {
					$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$dbObj = db_getDBObject();
				}
				unset($dbMain);
			}
			$sql = "DELETE FROM CheckIn WHERE id = $this->id";
			$dbObj->query($sql);

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$reviewObj->deletePerAccount($account_id);
		 * <br /><br />
		 *		//Using this in Review() class.
		 *		$this->deletePerAccount($account_id);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name deletePerAccount
		 * @access Public
		 * @param integer $account_id
		 * @param integer $domain_id
		 */
		function deletePerAccount($account_id = 0, $domain_id = false) {
			if (is_numeric($account_id) && $account_id > 0) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if ($domain_id) {
					$dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
				} else {
					if (defined("SELECTED_DOMAIN_ID")) {
						$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
					} else {
						$dbObj = db_getDBObject();
					}
					unset($dbMain);
				}
				$sql = "SELECT * FROM CheckIn WHERE member_id = $account_id";
				$result = $dbObj->query($sql);
				while ($row = mysql_fetch_array($result)) {
					$this->makeFromRow($row);
					$this->Delete($domain_id);
				}
			}
		}

		
		

	}

?>
