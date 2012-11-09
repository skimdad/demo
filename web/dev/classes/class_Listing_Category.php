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
	# * FILE: /classes/class_Listing_Category.php
	# ----------------------------------------------------------------------------------------------------

	class Listing_Category extends Handle {

		var $id;
		var $listing_id;
		var $category_id;
		var $status;
		var $category_root_id;
		var $category_node_left;
		var $category_node_right;
		
		/*
		 * Dont save this field
		 */
		var $total_listings;
		
		function Listing_Category($var='') {
			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT * FROM Listing_Category WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row='') {
			if ($row['id']) $this->id = $row['id'];
			else if (!$this->id) $this->id = 0;
			if ($row['listing_id']) $this->listing_id = $row['listing_id'];
			else if (!$this->listing_id) $this->listing_id = 0;
			if ($row['category_id']) $this->category_id = $row['category_id'];
			else if (!$this->category_id) $this->category_id = 0;
			if ($row['status']) $this->status = $row['status'];
			else if (!$this->status) $this->status = "";
			if ($row['category_root_id']) $this->category_root_id = $row['category_root_id'];
			else if (!$this->category_root_id) $this->category_root_id = 0;
			if ($row['category_node_left']) $this->category_node_left = $row['category_node_left'];
			else if (!$this->category_node_left) $this->category_node_left = 0;
			if ($row['category_node_right']) $this->category_node_right = $row['category_node_right'];
			else if (!$this->category_node_right) $this->category_node_right = 0;
		}

		function Save() {
			$insert_password = $this->password;
			$this->prepareToSave();
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
			if ($this->id) { 
				$sql  = "UPDATE Listing_Category SET"
					. " listing_id = $this->listing_id,"
					. " category_id = $this->category_id,"
					. " status = $this->status,"
					. " category_root_id = $this->category_root_id,"
					. " category_node_left = $this->category_node_left,"
					. " category_node_right = $this->category_node_right,"
					. " WHERE id = $this->id";
				$dbObj->query($sql);
			} else {
				$sql = "INSERT INTO Listing_Category"
					. " (listing_id, category_id, status, category_root_id, category_node_left, category_node_right)"
					. " VALUES"
					. " ($this->listing_id, $this->category_id, $this->status, $this->category_root_id, $this->category_node_left, $this->category_node_right)";
				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);
			}
			$this->prepareToUse();
		}

		function Delete() {
			/**
			* Deleting this object
			**/
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);;
			$sql = "DELETE FROM Listing_Category WHERE id = $this->id";
			$dbObj->query($sql);
		}

		function getListings($category_id){

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
			$sql = "SELECT DISTINCT listing_id FROM Listing_Category use index (category_status) WHERE category_id IN (".$category_id.") AND status = 'A'";

			$result = $dbObj->query($sql);
			$lines = mysql_num_rows($result);
			
			/*
			 * Total of listings
			 */
			$this->total_listings = $lines;
			unset($string_listings);
			if($lines > 0){
				$string_listings = "";
				while($row = mysql_fetch_assoc($result)){
					$lines--;
					$string_listings .= $row["listing_id"].($lines > 0 ? "," : "");
				}
			}
			
			if($string_listings){
				return $string_listings;
			}else{
				return 0;
			}
		}
		
		// the following code is modified by Debiprasad on 26 July 2012
		// filter to display paging for listings separated from Bronze		
		function getListingsByCategoryHierarchy($root_id, $left, $right, $letter = false, $filter = false){

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);

			// the following code is modified by Debiprasad on 26 July 2012
			// filter to display paging for listings separated from Bronze
			if ($filter)
				$sql = "SELECT Listing_Category.listing_id
							FROM Listing_Category Listing_Category
							LEFT OUTER JOIN Listing_Summary Listing_Summary
							ON Listing_Summary.id = Listing_Category.listing_id
							WHERE Listing_Category.category_root_id = ".$root_id." AND
								  Listing_Category.category_node_left >= ".$left." AND
								  Listing_Category.category_node_right <= ".$right." AND
			  					  Listing_Category.status = 'A' AND 
			  					  " . $filter;
		  	else
				$sql = "SELECT Listing_Category.listing_id
							FROM Listing_Category Listing_Category
							WHERE Listing_Category.category_root_id = ".$root_id." AND
								  Listing_Category.category_node_left >= ".$left." AND
								  Listing_Category.category_node_right <= ".$right." AND
			  					  Listing_Category.status = 'A'";
		  					  
		  					  
			
			$result = $dbObj->query($sql);
			$lines = mysql_num_rows($result);

			/*
			 * Total of listings
			 */
			$aux_count_listings = 0;
			$aux_listing_id = 0;

			unset($string_listings);
			if($lines > 0){
				$string_listings = "";
				while($row = mysql_fetch_assoc($result)){
					$lines--;
					if($row["listing_id"] != $aux_listing_id){
						$string_listings .= $row["listing_id"].($lines > 0 ? "," : "");
						$aux_count_listings++;
						$aux_listing_id = $row["listing_id"];
					}
				}
				$this->total_listings = $aux_count_listings;
			}

			if (string_substr($string_listings, -1) == ",") {
				$string_listings = string_substr($string_listings, 0, -1);
			}

			if ($letter){
				$sql = "SELECT id FROM Listing_Summary WHERE id IN ($string_listings) AND title LIKE ".db_formatString($letter."%");
				// the following code is modified by Debiprasad on 26 July 2012
				// filter to display paging for listings separated from Bronze
				if ($filter)
					$sql .= ' AND ' . $filter;
				$result = $dbObj->query($sql);
				$count = mysql_num_rows($result);
				$this->total_listings = $count;
			}
            
			if($string_listings){
				return $string_listings;
			}else{
				return 0;
			}

		}

	}

?>
