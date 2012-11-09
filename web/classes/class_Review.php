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
	# * FILE: /classes/class_review.php
	# ----------------------------------------------------------------------------------------------------

	class Review extends Handle {

		var $id;
		var $item_type;
		var $item_id;
		var $member_id;
		var $added;
		var $ip;
		var $rating;
		var $review_title;
		var $review;
		var $reviewer_name;
		var $reviewer_email;
		var $reviewer_location;
		var $approved;
		var $response;
		var $responseapproved;

		function Review($var="") {
			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
//				$dbMain->close();
				unset($dbMain);
				$sql = "SELECT * FROM Review WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row="") {

			$this->id                    = ($row["id"])                     ? $row["id"]                    : ($this->id                    ? $this->id                     : 0);
			$this->item_type             = ($row["item_type"])              ? $row["item_type"]             : ($this->item_type             ? $this->item_type              : "");
			$this->item_id               = ($row["item_id"])                ? $row["item_id"]               : ($this->item_id               ? $this->item_id                : 0);
			$this->member_id             = ($row["member_id"])              ? $row["member_id"]             : ($this->member_id             ? $this->member_id              : 0);
			$this->added                 = ($row["added"])                  ? $row["added"]                 : ($this->added                 ? $this->added                  : "");
			$this->ip                    = ($row["ip"])                     ? $row["ip"]                    : ($this->ip                    ? $this->ip                     : "");
			$this->rating                = ($row["rating"])                 ? $row["rating"]                : ($this->rating                ? $this->rating                 : "");
			$this->review_title          = ($row["review_title"])           ? $row["review_title"]          : "";
			$this->review                = ($row["review"])                 ? $row["review"]                : "";
			$this->reviewer_name         = ($row["reviewer_name"])          ? $row["reviewer_name"]         : "";
			$this->reviewer_email        = ($row["reviewer_email"])         ? $row["reviewer_email"]        : "";
			$this->reviewer_location     = ($row["reviewer_location"])      ? $row["reviewer_location"]     : "";
			$this->approved              = ($row["approved"])               ? $row["approved"]              : 0;
			$this->response              = ($row["response"])               ? $row["response"]              : "";
			$this->responseapproved      = ($row["responseapproved"])       ? $row["responseapproved"]      : 0;

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

				$sql = "SELECT approved FROM Review WHERE id = $this->id";
				$result = $dbObj->query($sql);
				if ($row = mysql_fetch_assoc($result)) $last_status = $row["approved"];
				$this_status = $this->approved;

				$sql = "UPDATE Review SET"
					. " item_type         = $this->item_type,"
					. " item_id           = $this->item_id,"
					. " member_id         = $this->member_id,"
					. " added             = $this->added,"
					. " ip                = $this->ip,"
					. " rating            = $this->rating,"
					. " review_title      = $this->review_title,"
					. " review            = $this->review,"
					. " reviewer_name     = $this->reviewer_name,"
					. " reviewer_email    = $this->reviewer_email,"
					. " reviewer_location = $this->reviewer_location,"
					. " approved          = $this->approved,"
					. " response          = $this->response,"
					. " responseapproved  = $this->responseapproved"
					. " WHERE id          = $this->id";

					$dbObj->query($sql);

					if ($this->item_type == "'article'"){
						$article = new Article(str_replace("'","",$this->item_id));
						$item_title = $article->getString("title");
						$item = "review_article";
					} else if($this->item_type == "'promotion'"){
						$promotion = new Promotion(str_replace("'","",$this->item_id));
						$item_title = $promotion->getString("name");
						$item = "review_promotion";
					}else {
						$listing = new Listing(str_replace("'","",$this->item_id));
						$item_title = $listing->getString("title");
						$item = "review_listing";
					}

					if ($last_status != 0 && $this_status == 0){
						activity_newToApproved(SELECTED_DOMAIN_ID, $this->id, $item, $item_title, $this->review_title, $this->item_id, $this->rating);
					} else if ($last_status == 0 && $this_status != 0) {
						activity_deleteRecord(SELECTED_DOMAIN_ID, $this->id, $item);
					} else if ($last_status == $this_status){
						activity_updateRecord(SELECTED_DOMAIN_ID, $this->id, $this->review_title, "content", $item, $this->rating);
					}

			} else {

				$sql = "INSERT INTO Review"
					. " (item_type,"
					. " item_id,"
					. " member_id,"
					. " added,"
					. " ip,"
					. " rating,"
					. " review_title,"
					. " review,"
					. " reviewer_name,"
					. " reviewer_email,"
					. " reviewer_location,"
					. " approved,"
					. " response,"
					. " responseapproved"
					. " )"
					. " VALUES"
					. " ("
					. " $this->item_type,"
					. " $this->item_id,"
					. " $this->member_id,"
					. " NOW(),"
					. " $this->ip,"
					. " $this->rating,"
					. " $this->review_title,"
					. " $this->review,"
					. " $this->reviewer_name,"
					. " $this->reviewer_email,"
					. " $this->reviewer_location,"
					. " $this->approved,"
					. " $this->response,"
					. " $this->responseapproved"
					. " )";

				$dbObj->query($sql);

				$this->id = mysql_insert_id($dbObj->link_id);

				if ($this->item_type == "'article'"){
					$article = new Article(str_replace("'","",$this->item_id));
					$item_title = $article->getString("title");
					$item = "review_article";
				} else if ($this->item_type == "'promotion'"){
					$promotion = new Promotion(str_replace("'","",$this->item_id));
					$item_title = $promotion->getString("name");
					$item = "review_promotion";
				}else{
					$listing = new Listing(str_replace("'","",$this->item_id));
					$item_title = $listing->getString("title");
					$item = "review_listing";
				}

				if ($this->approved == 0){
					activity_newToApproved(SELECTED_DOMAIN_ID, $this->id, $item, $item_title, $this->review_title, $this->item_id, $this->rating);
				}

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
			$sql = "DELETE FROM Review WHERE id = $this->id";
			$dbObj->query($sql);

			if ($this->item_type == "article"){
				$item = "review_article";
			} else if ($this->item_type == "listing") {
				$item = "review_listing";
			} else {
				$item = "review_promotion";
			}
			activity_deleteRecord(SELECTED_DOMAIN_ID, $this->id, $item);
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
				$sql = "SELECT * FROM Review WHERE member_id = $account_id";
				$result = $dbObj->query($sql);
				while ($row = mysql_fetch_array($result)) {
					$this->makeFromRow($row);
					$this->Delete($domain_id);
				}
			}
		}

        function getReviewsByItem($item_type,$item_id){
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
//			$dbMain->close();
			unset($dbMain);
			$sql = "SELECT * FROM Review WHERE item_type = ".db_formatString($item_type)." AND item_id = ".db_formatNumber($item_id)." AND approved = '1' ";
			$result = $dbObj->query($sql);
			return $result;
		}
        
		function getRateAvgByItem($item_type, $item_id) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
//			$dbMain->close();
			unset($dbMain);
			$sql = "SELECT AVG(rating) as rate FROM Review WHERE item_type = ".db_formatString($item_type)." AND item_id = ".db_formatNumber($item_id)." AND approved = '1' ";
			$result = $dbObj->query($sql);
			if ($result) while ($row = mysql_fetch_assoc($result)) $rate = $row["rate"];
			return (isset($rate) && $rate != 0) ? round($rate, 2) : system_showText(LANG_NA);
		}

		function getDeniedIpsByItem($item_type, $item_id) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
//			$dbMain->close();
			unset($dbMain);
			$sql = "SELECT ip FROM Review WHERE (added >= DATE_SUB(NOW(), INTERVAL '5' MINUTE)) AND item_type = ".db_formatString($item_type)." AND item_id = ".db_formatNumber($item_id)."";
			$result = $dbObj->query($sql);
			if ($result) while ($row = mysql_fetch_assoc($result)) $ips[] = $row["ip"];
			return $ips;
		}

	}

?>
