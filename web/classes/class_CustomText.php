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
	# * FILE: /classes/class_customtext.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$customTextObj = new CustomText($var, $lang);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name CustomText
	 * @method CustomText
	 * @method makeFromRow
	 * @method Save
	 * @method Delete
	 * @access Public
	 */
	class CustomText extends Handle {

		/**
		 * @var varchar
		 * @access Private
		 */
		var $name;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $value;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $lang;

		/**
		 * <code>
		 *		$customTextObj = new CustomText($var, $lang);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name CustomText
		 * @access Public
		 * @param array $var
		 * @param varchar $lang
		 */
		function CustomText($var='', $lang=EDIR_DEFAULT_LANGUAGE) {
			$this->lang = $lang;
			if ($var) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}

				unset($dbMain);

				$sql = "SELECT * FROM CustomText_Lang WHERE name = ".db_formatString($var)." AND lang = ".db_formatString($this->lang);

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
			
			$this->name		= ($row["name"])	? $row["name"]	: ($this->name	? $this->name	: 0);
			$this->value	= ($row["value"])	? $row["value"]	: "";
			
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$customTextObj->Save();
		 * <br /><br />
		 *		//Using this in CustomText() class.
		 *		$this->Save();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Save
		 * @access Public
		 */
		function Save($update = true) {
			
			$langaux = $this->lang;
			
			$this->prepareToSave();
			
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
			
			if ($update) {
				
				$sql    = "SELECT * FROM CustomText_Lang WHERE lang=$this->lang AND name=$this->name";
				$verify = $dbObj->query($sql);

				if (!mysql_numrows($verify)) {

					$sql =	"INSERT INTO CustomText_Lang"
						. " (name, "
						. " lang, "
						. " value)"
						. " VALUES"
						. " ($this->name,"
						. " $this->lang,"
						. " $this->value)";

				} else {

					$sql =	"UPDATE CustomText_Lang SET"
						. " name  = $this->name,"
						. " lang  = $this->lang,"
						. " value = $this->value"
						. " WHERE name = $this->name AND lang = $this->lang";

				}

				$dbObj->query($sql);
				
			} else {
				
				$sql = "INSERT INTO CustomText_Lang"
					. " (name,"
					. " lang,"
					. " value)"
					. " VALUES"
					. " ($this->name,"
					. " $this->lang,"
					. " $this->value)";
				
				$dbObj->query($sql);
				
			}
			
			$this->prepareToUse();
			
		}
	}
?>