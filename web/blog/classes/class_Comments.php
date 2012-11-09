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
	# * FILE: /blog/classes/class_Comments.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$commentObj = new Comments($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name Comments
	 * @method Comments
	 * @method makeFromRow
	 * @method Save
	 * @method Delete
	 * @method getTimeString
	 * @access Public
	 */
	class Comments extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $post_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $reply_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $member_id;
		/**
		 * @var string
		 * @access Private
		 */
		var $member_name;
		/**
		 * @var date
		 * @access Private
		 */
		var $added;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $description;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $website;
		/**
		 * @var integer
		 * @access Private
		 */
		var $approved;
		/**
		 * @var integer
		 * @access Private
		 */
		var $legacy_id;

		/**
		 * <code>
		 *		$commentsObj = new Comments($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Comments
		 * @access Public
		 * @param mixed $var
		 */
		function Comments($var="") {
			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
//				$dbMain->close();
				unset($dbMain);
				$sql = "SELECT * FROM Comments WHERE id = $var";
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
		function makeFromRow($row="") {

			$this->id                    = ($row["id"])                     ? $row["id"]                    : ($this->id                    ? $this->id                     : 0);
			$this->post_id               = ($row["post_id"])                ? $row["post_id"]               : ($this->post_id               ? $this->post_id                : 0);
			$this->reply_id			     = ($row["reply_id"])               ? $row["reply_id"]              : ($this->reply_id              ? $this->reply_id               : 0);
			$this->member_id			 = ($row["member_id"])              ? $row["member_id"]             : ($this->member_id             ? $this->member_id              : 0);
			$this->member_name			 = ($row["member_name"])            ? $row["member_name"]           : ($this->member_name           ? $this->member_name            : "");
			$this->added                 = ($row["added"])                  ? $row["added"]                 : ($this->added                 ? $this->added                  : "");
			$this->description           = ($row["description"])            ? $row["description"]           : "";
			$this->website				 = ($row["website"])				? $row["website"]				: "";
			$this->approved              = ($row["approved"])               ? $row["approved"]              : 0;
			$this->legacy_id             = ($row["legacy_id"])              ? $row["legacy_id"]             : 0;
			
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$commentsObj->Save();
		 * <br /><br />
		 *		//Using this in Comments() class.
		 *		$this->Save();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Save
		 * @access Public
		 */
		function Save() {
			
			$empty_legacy_id = false;
			
			if (!$this->legacy_id){
				$empty_legacy_id = true;
			}
			
			$this->prepareToSave();

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			
			unset($dbMain);

			if ($this->id) {

				$sql = "SELECT approved FROM Comments WHERE id = $this->id";
				$result = $dbObj->query($sql);
				if ($row = mysql_fetch_assoc($result)) $last_status = $row["approved"];
				$this_status = $this->approved;

				$sql = "UPDATE Comments SET"
					. " post_id     = $this->post_id,"
					. " reply_id    = $this->reply_id,"
					. " member_id   = $this->member_id,"
					. " member_name = $this->member_name,"
					. " added       = $this->added,"
					. " description = $this->description,"
					. " website     = $this->website,"
					. " approved	= $this->approved,"
					. " legacy_id	= $this->legacy_id"
					. " WHERE id    = $this->id";

					$dbObj->query($sql);

					$post = new Post(str_replace("'","",$this->post_id));
					$item_title = $post->getString("title");

					if ($last_status != 0 && $this_status == 0){
						activity_newToApproved(SELECTED_DOMAIN_ID, $this->id, "blog_comment", $item_title, $this->description, $this->post_id, 0, $this->reply_id);
					} else if ($last_status == 0 && $this_status != 0) {
						activity_deleteRecord(SELECTED_DOMAIN_ID, $this->id, "blog_comment");
					} else if ($last_status == $this_status){
						activity_updateRecord(SELECTED_DOMAIN_ID, $this->id, $this->description, "item", "blog_comment");
					}

			} else {

				$sql = "INSERT INTO Comments"
					. " (post_id,"
					. " reply_id,"
					. " member_id,"
					. " member_name,"
					. " added,"
					. " description,"
					. " website,"
					. " approved,"
					. " legacy_id)"
					. " VALUES"
					. " ("
					. " $this->post_id,"
					. " $this->reply_id,"
					. " $this->member_id,"
					. " $this->member_name,"
					. " NOW(),"
					. " $this->description,"
					. " $this->website,"
					. " $this->approved,"
					. " $this->legacy_id"
					. " )";

				$dbObj->query($sql);

				$this->id = mysql_insert_id($dbObj->link_id);
				
				/*
				 * Legacy ID to Wordpress
				 */
				if($empty_legacy_id){
					unset($sql_legacy_id);
					$sql_legacy_id = "UPDATE Comments SET legacy_id = 'ed_".$this->id."' WHERE id = ".$this->id;
					$dbObj->query($sql_legacy_id);
					
				}

				$post = new Post(str_replace("'","",$this->post_id));
				$item_title = $post->getString("title");

				if ($this->approved == 0){
					activity_newToApproved(SELECTED_DOMAIN_ID, $this->id, "blog_comment", $item_title, $this->description, $this->post_id, 0, $this->reply_id);
				}
			}
			$this->prepareToUse();
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$commentsObj->Delete();
		 * <br /><br />
		 *		//Using this in Comments() class.
		 *		$this->Delete();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Delete
		 * @access Public
		 * @param integer $domain_id
		 */
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

			$sql = "DELETE FROM Comments WHERE reply_id = $this->id";
			$dbObj->query($sql);

			$sql = "DELETE FROM Comments WHERE id = $this->id";
			$dbObj->query($sql);

			activity_deleteRecord(SELECTED_DOMAIN_ID, $this->id, "blog_comment");
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$commentsObj->deletePerAccount($account_id);
		 * <br /><br />
		 *		//Using this in Comments() class.
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
				$sql = "SELECT * FROM Comments WHERE member_id = $account_id";
				$result = $dbObj->query($sql);
				while ($row = mysql_fetch_array($result)) {
					$this->makeFromRow($row);
					$this->Delete($domain_id);
				}
			}
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$commentsObj->getTimeString($when);
		 * <br /><br />
		 *		//Using this in Comments() class.
		 *		$this->getTimeString($when);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getTimeString
		 * @access Public
		 * @param varchar $when
		 * @return varchar $str_time
		 */
		function getTimeString($when="added") {
			$str_time = "";
			$startTimeStr = explode(":", $this->getString($when));
			$startTimeStr[0] = string_substr($startTimeStr[0],-2);
			if (CLOCK_TYPE == '24') {
				$start_time_hour = $startTimeStr[0];
			} elseif (CLOCK_TYPE == '12') {
				if ($startTimeStr[0] > "12") {
					$start_time_hour = $startTimeStr[0] - 12;
					$start_time_am_pm = "pm";
				} elseif ($startTimeStr[0] == "12") {
					$start_time_hour = 12;
					$start_time_am_pm = "pm";
				} elseif ($startTimeStr[0] == "00") {
					$start_time_hour = 12;
					$start_time_am_pm = "am";
				} else {
					$start_time_hour = $startTimeStr[0];
					$start_time_am_pm = "am";
				}
			}
			if ($start_time_hour < 10) $start_time_hour = "0".($start_time_hour+0);
			$start_time_min = $startTimeStr[1];
			$str_time .= $start_time_hour.":".$start_time_min." ".$start_time_am_pm;

			return $str_time;
		}
		
		/*
		 * Function to save Wordpress Comments on eDirectory
		 */
		function SaveWPToEdir($wp_content){

			if(!is_array($wp_content)){
				$wp_content = unserialize($wp_content);
			}
			
			
			if(is_array($wp_content)){
				
				$langIndex = language_getIndex(EDIR_DEFAULT_LANGUAGE);
				
				/*
				 * Get Comment ID using legacy ID
				 */
				$db = db_getDBObject();
				$sql = "SELECT * FROM Comments WHERE legacy_id = '"."wp_".$wp_content["fields"]["comment_ID"]."'";
				$result = $db->query($sql);
				if(mysql_num_rows($result)){
					$row = mysql_fetch_assoc($result);
					$this->makeFromRow($row);
				}
				
				/*
				 * Get Post ID using comment_post_ID
				 */
				$db = db_getDBObject();
				$sql = "SELECT id FROM Post WHERE legacy_id = '"."wp_".$wp_content["fields"]["comment_post_ID"]."'";
				$result = $db->query($sql);
				if(mysql_num_rows($result)){
					$rowPost = mysql_fetch_assoc($result);
				}
				
				/*
				 * Get Comment ID using comment_parent
				 */
				$db = db_getDBObject();
				
				
				$sql = "SELECT id, reply_id FROM Comments WHERE legacy_id = '"."wp_".$wp_content["fields"]["comment_parent"]."'";
				$result = $db->query($sql);
				if(mysql_num_rows($result)){
					$rowComment = mysql_fetch_assoc($result);
				}
				
				$current_id = $rowComment["id"] ? $rowComment["id"] : 0;
				$reply_id = $rowComment["reply_id"] ? $rowComment["reply_id"] : 0;
				
				if ($reply_id != 0){
					
					while ($reply_id != 0){
						$sql = "SELECT id, reply_id FROM Comments WHERE id = ".db_formatNumber($reply_id);
						$result = $db->query($sql);
						if(mysql_num_rows($result)){
							$rowCommentAux = mysql_fetch_assoc($result);
							$reply_id = $rowCommentAux["reply_id"];
							$current_id = $rowCommentAux["id"];
						} else {
							$reply_id = 0;
						}
					}
				}

				$fields[0]["name"]		= "legacy_id";
				$fields[0]["content"]	= "wp_".$wp_content["fields"]["comment_ID"];
				
				$fields[1]["name"]		= "member_id";
				$fields[1]["content"]	= 0;
				
				$fields[2]["name"]		= "description";
				$fields[2]["content"]	= $wp_content["fields"]["comment_content"];
				
				$fields[3]["name"]		= "added";
				$fields[3]["content"]	= $wp_content["fields"]["comment_date"];
				
				$fields[4]["name"]		= "website";
				$fields[4]["content"]	= $wp_content["fields"]["comment_author_url"] ;
				
				$fields[5]["name"]		= "member_name";
				$fields[5]["content"]	= $wp_content["fields"]["comment_author"] ;
				
				$fields[6]["name"]		= "approved";
				$fields[6]["content"]	= (!is_numeric($wp_content["fields"]["comment_approved"]) ? 0 : $wp_content["fields"]["comment_approved"]);

				$fields[7]["name"]		= "post_id";
				$fields[7]["content"]	= $rowPost["id"];
				
				$fields[8]["name"]		= "reply_id";
				$fields[8]["content"]	= $current_id;
				
				for($i=0;$i<count($fields);$i++){
					$this->$fields[$i]["name"] = $fields[$i]["content"];
				}
				
				$this->Save();
				
			}
		}
		
		function deleteWPComment($wp_fields){
			
			if($wp_fields["fields"]["id"]){
				
				$dbObj = db_getDBObject();
				$sql = "SELECT id FROM Comments WHERE legacy_id = 'wp_".$wp_fields["fields"]["id"]."'";
				$result = $dbObj->query($sql);
				
				if(mysql_num_rows($result)){
					while($row = mysql_fetch_assoc($result)){
						$this->id = $row["id"];
						$this->Delete();
					}
				}
			
			}
		}
		
		function TrashedWPComment($wp_fields){
			
			if($wp_fields["fields"]["id"]){
				
				$dbObj = db_getDBObject();
				$sql = "UPDATE Comment SET approved = 0 WHERE legacy_id = 'wp_".$wp_fields["fields"]["id"]."'";
				$result = $dbObj->query($sql);
				
			}
		}
		
		function UntrashedWPComment($wp_fields){
			
			if($wp_fields["fields"]["id"]){
				
				$dbObj = db_getDBObject();
				$sql = "UPDATE Comment SET approved = 1 WHERE legacy_id = 'wp_".$wp_fields["fields"]["id"]."'";
				$result = $dbObj->query($sql);
				
			}
		}
	}
?>