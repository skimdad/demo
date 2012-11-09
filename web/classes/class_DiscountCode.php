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
	# * FILE: /classes/class_DiscountCode.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$discountCodeObj = new DiscountCode($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name DiscountCode
	 * @method DiscountCode
	 * @method makeFromRow
	 * @method Save
	 * @method Delete
	 * @access Public
	 */
	class DiscountCode extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $id;
		/**
		 * @var real
		 * @access Private
		 */
		var $amount;
		/**
		 * @var string
		 * @access Private
		 */
		var $type;
		/**
		 * @var char
		 * @access Private
		 */
		var $status;
		/**
		 * @var date
		 * @access Private
		 */
		var $expire_date;
		/**
		 * @var string
		 * @access Private
		 */
		var $recurring;
		/**
		 * @var string
		 * @access Private
		 */
		var $listing;
		/**
		 * @var string
		 * @access Private
		 */
		var $event;
		/**
		 * @var string
		 * @access Private
		 */
		var $banner;
		/**
		 * @var string
		 * @access Private
		 */
		var $classified;
		/**
		 * @var string
		 * @access Private
		 */
		var $article;

		/**
		 * <code>
		 *		$discountCodeObj = new DiscountCode($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name DiscountCode
		 * @access Public
		 * @param integer $var
		 */
		function DiscountCode($var="") {
			if (!is_array($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
//				$dbMain->close();
				unset($dbMain);
				$sql = "SELECT * FROM Discount_Code WHERE id = ".db_formatString($var)."";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
//				$db->close();
				unset($db);
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
		function makeFromRow($row="") {

			$this->x_id					= ($row["x_id"])					? $row["x_id"]					: 0;
			$this->id					= ($row["id"])						? $row["id"]					: ($this->id				? $this->id				: "");
			$this->amount				= ($row["amount"])					? $row["amount"]				: ($this->amount			? $this->amount			: 0);
			$this->type					= ($row["type"])					? $row["type"]					: ($this->type				? $this->type			: "monetary value");
			$this->status				= ($row["status"])					? $row["status"]				: ($this->status			? $this->status			: "A");
			$this->expire_date			= ($row["expire_date"])				? $row["expire_date"]			: ($this->expire_date		? $this->expire_date	: 0);
			$this->recurring			= ($row["recurring"])				? $row["recurring"]				: ($this->recurring			? $this->recurring		: "no");
			$this->listing				= ($row["listing"])					? $row["listing"]				: "";
			$this->event				= ($row["event"])					? $row["event"]					: "";
			$this->banner				= ($row["banner"])					? $row["banner"]				: "";
			$this->classified			= ($row["classified"])				? $row["classified"]			: "";
			$this->article				= ($row["article"])					? $row["article"]				: "";

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$discountCodeObj->Save();
		 * <br /><br />
		 *		//Using this in DiscountCode() class.
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

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
//			$dbMain->close();
			unset($dbMain);

			if ($this->x_id) {
				$sql  = "UPDATE Discount_Code SET"
					. " id = $this->id,"
					. " amount = $this->amount,"
					. " type = $this->type,"
					. " status = $this->status,"
					. " expire_date = $this->expire_date,"
					. " listing = $this->listing,"
					. " event = $this->event,"
					. " banner = $this->banner,"
					. " classified = $this->classified,"
					. " article = $this->article,"
					. " recurring = $this->recurring"
					. " WHERE id = $this->x_id";
				$dbObj->query($sql);
			} else {
				$sql = "INSERT INTO Discount_Code"
					. " (id, amount, type, status, expire_date, listing, event, banner, classified, article, recurring)"
					. " VALUES"
					. " ($this->id, $this->amount, $this->type, $this->status, $this->expire_date, $this->listing, $this->event, $this->banner, $this->classified, $this->article, $this->recurring)";
				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);
			}

			$this->prepareToUse();
//			$dbObj->close();
			unset($dbObj);
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$discountCodeObj->Delete();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Delete
		 * @access Public
		 */
		function Delete() {

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
//			$dbMain->close();
			unset($dbMain);
			$sql = "DELETE FROM Discount_Code WHERE id = '$this->id'";
			$dbObj->query($sql);
//			$dbObj->close();
			unset($dbObj);

		}

	}
?>