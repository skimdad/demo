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
	# * FILE: /classes/class_PostItem.php
	# ----------------------------------------------------------------------------------------------------

	class PostItem extends Handle {

		var $id;
		var $blogcat_id;
		var $post_id;
		

		function PostItem($var="") {
			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}

				unset($dbMain);
				$sql = "SELECT * FROM Post_Item WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row="") {

			$this->id				= ($row["id"])					? $row["id"]				: ($this->id					? $this->id				: 0);
			$this->blogcat_id		= ($row["blogcat_id"])			? $row["blogcat_id"]		: 0;
			$this->post_id			= ($row["post_id"])				? $row["post_id"]			: ($this->post_id				? $this->post_id		: 0);

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

				$sql = "UPDATE Post_Item SET"
					. " blogcat_id       = $this->blogcat_id,"
					. " post_id          = $this->post_id"
					. " WHERE id         = $this->id";

				$dbObj->query($sql);

			} else {

				$sql = "INSERT INTO Post_Item"
					. " (blogcat_id,"
					. " post_id)"
					. " VALUES"
					. " ($this->blogcat_id,"
					. " $this->post_id)";
				$dbObj->query($sql);

				$this->id = mysql_insert_id($dbObj->link_id);

			}

			$this->prepareToUse();


		}

		function Delete() {

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);

			$sql = "DELETE FROM Post_Item WHERE post_id= $this->post_id";

			$dbObj->query($sql);
		}

		function getCategories($id) {

			if ($id) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$dbObj = db_getDBObject();
				}

				unset($dbMain);
				$sql = "SELECT blogcat_id FROM Post_Item WHERE post_id = $id";
				$r = $dbObj->query($sql);
				while ($row = mysql_fetch_array($r)) {
					if ($row["blogcat_id"]) $categories[] = new BlogCategory($row["blogcat_id"]);
				}
				return $categories;
			}
			
		}
		
		function setWPCategories($category_ids, $post_id){
			
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			$sql = "SELECT id FROM BlogCategory WHERE legacy_id in (".implode(",",$category_ids).")";
			$result = $dbObj->query($sql);
			if(mysql_num_rows($result)){
				
				/**
				 * Delete old categories
				 */
				$this->setNumber("post_id", $post_id);
				$this->Delete();
				
				/**
				 * Add categories
				 */
				while($row = mysql_fetch_assoc($result)){
					
					unset($postItemObj);
					$postItemObj = new PostItem();
					
					$postItemObj->setNumber("blogcat_id", $row["id"]);
					$postItemObj->setNumber("post_id", $post_id);
					$postItemObj->Save();
					
				}
			}
		}
	}

?>
