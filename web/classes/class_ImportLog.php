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
	# * FILE: /classes/class_importLog.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$importLogObj = new ImportLog($var);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name ImportLog
	 * @method ImportLog
	 * @method makeFromRow
	 * @method Save
	 * @method Delete
	 * @method getImports
	 * @method getTimeString
	 * @method setHistory
	 * @access Public
	 */
	class ImportLog extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $domain_id;
		/**
		 * @var date
		 * @access Private
		 */
		var $date;
		/**
		 * @var time
		 * @access Private
		 */
		var $time;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $filename;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $linesadded;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $totallines;
		/**
		 * @var integer
		 * @access Private
		 */
		var $itens_added;
		/**
		 * @var integer
		 * @access Private
		 */
		var $accounts_added;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $phisicalname;
		/**
		 * @var char
		 * @access Private
		 */
		var $status;
		/**
		 * @var char
		 * @access Private
		 */
		var $action;
		/**
		 * @var char
		 * @access Private
		 */
		var $progress;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $history;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $update_itens;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $delimiter;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $mysqlerror;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $type;

		/**
		 * <code>
		 *		$importLogObj = new ImportLog($var);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name ImportLog
		 * @access Public
		 * @param array $var
		 */
		function ImportLog($var='', $domain_id = false) {
			$this->domain_id = $domain_id;
			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if ($domain_id){
					$db = db_getDBObjectByDomainID($this->domain_id, $dbMain);
				}else if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT * FROM ImportLog WHERE status<>'D' AND id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			}
			else {
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

			if ($row['id']) $this->id = $row['id'];
			else if (!$this->id) $this->id = 0;

			if ($row['date']) $this->date = $row['date'];
			else if (!$this->date) $this->date = 0;

			if ($row['time']) $this->time = $row['time'];
			else if (!$this->time) $this->time = "";

			if ($row['filename']) $this->filename = $row['filename'];
			else if (!$this->filename) $this->filename = "";

			if ($row['phisicalname']) $this->phisicalname = $row['phisicalname'];
			else if (!$this->phisicalname) $this->phisicalname = "";

			if ($row['linesadded']) $this->linesadded = $row['linesadded'];
			else if (!$this->linesadded) $this->linesadded = "0";

			if ($row['totallines']) $this->totallines = $row['totallines'];
			else if (!$this->totallines) $this->totallines = "0";

			if ($row['itens_added']) $this->itens_added = $row['itens_added'];
			else if (!$this->itens_added) $this->itens_added = "0";
			
			if ($row['accounts_added']) $this->accounts_added = $row['accounts_added'];
			else if (!$this->accounts_added) $this->accounts_added = "0";

			if ($row['status']) $this->status = $row['status'];
			else if (!$this->status) $this->status = "P";

			if ($row['action']) $this->action = $row['action'];
			else if (!$this->action) $this->action = "RI";

			if ($row['progress']) $this->progress = $row['progress'];
			else if (!$this->progress) $this->progress = "0%";

			if ($row['history']) $this->history = $row['history'];
			else if (!$this->history) $this->history = "";

			if ($row['update_itens']) $this->update_itens = $row['update_itens'];
			else if (!$this->update_itens) $this->update_itens = "";
			
			$row["delimiter"] ?	$this->delimiter = $row["delimiter"] : $this->delimiter ? $this->delimiter = $this->delimiter : $this->delimiter = "";

			if ($row['mysqlerror']) $this->mysqlerror = $row['mysqlerror'];
			else if (!$this->mysqlerror) $this->mysqlerror = "";
			
			if ($row['type']) $this->type = $row['type'];
			else if (!$this->type) $this->type = "listing";

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$importLogObj->Save();
		 * <br /><br />
		 *		//Using this in ImportLog() class.
		 *		$this->Save();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Save
		 * @access Public
		 */
		function Save() {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($this->domain_id){
				$dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
			}else if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);

			$this->prepareToSave();
			if ($this->id) {
				$sql  = "UPDATE ImportLog SET"
					. " date			= $this->date,"
					. " time			= $this->time,"
					. " filename		= $this->filename,"
					. " linesadded		= $this->linesadded,"
					. " totallines		= $this->totallines,"
					. " itens_added		= $this->itens_added,"
					. " accounts_added	= $this->accounts_added,"
					. " phisicalname	= $this->phisicalname,"
					. " status			= $this->status,"
					. " action			= $this->action,"
					. " progress		= $this->progress,"
					. " update_itens	= $this->update_itens,"
					. " delimiter		= $this->delimiter,"
					. " mysqlerror		= $this->mysqlerror,"
					. " type			= $this->type"
					. " WHERE id		= $this->id";
				$dbObj->query($sql);
			} else {
				$sql = "INSERT INTO ImportLog"
					. " (date, time, filename, linesadded, totallines, itens_added, accounts_added, phisicalname, status, action, progress, history, update_itens, delimiter, mysqlerror, type)"
					. " VALUES"
					. " ($this->date, $this->time, $this->filename, $this->linesadded, $this->totallines, $this->itens_added, $this->accounts_added, $this->phisicalname, $this->status, $this->action, $this->progress, '', $this->update_itens, $this->delimiter , '', $this->type)";
				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);
			}
			$this->prepareToUse();
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$importLogObj->Delete();
		 * <br /><br />
		 *		//Using this in ImportLog() class.
		 *		$this->Delete();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Delete
		 * @access Public
		 */
		function Delete() {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($this->domain_id){
				$dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
			}else if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
			$sql = "UPDATE ImportLog SET status = 'D' WHERE id = $this->id";
			$dbObj->query($sql);
			@unlink(IMPORT_FOLDER."/".$this->phisicalname);
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$importLogObj->getImports();
		 * <br /><br />
		 *		//Using this in ImportLog() class.
		 *		$this->getImports();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getImports
		 * @access Public
		 * @return array $logarray
		 */
		function getImports($type = "listing") {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($this->domain_id){
				$dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
			}else if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
			$sql = "SELECT id FROM ImportLog WHERE status <> 'D' AND type = '$type' ORDER BY id DESC";
			$result = $dbObj->query($sql);
			if ($result) {
				while ($row = mysql_fetch_assoc($result)) {
					$id = $row['id'];
					$logarray[] = new ImportLog($id);
				}
				return $logarray;
			} else return NULL;
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$importLogObj->setHistory($history);
		 * <br /><br />
		 *		//Using this in ImportLog() class.
		 *		$this->setHistory($history);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name setHistory
		 * @access Public
		 * @param string $history
		 */
		function setHistory($history) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($this->domain_id){
				$dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
			}else if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);

			$history = $history."||";
			$aux_str = addslashes($history);
			$sql = "UPDATE ImportLog SET history = CONCAT(history, '".$aux_str."') WHERE id = '".$this->id."'";
			$dbObj->query($sql);
		}

	}

?>