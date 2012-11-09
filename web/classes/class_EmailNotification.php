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
	# * FILE: /classes/class_emailNotification.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$emailNotifObj = new EmailNotification($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name EmailNotification
	 * @method EmailNotification
	 * @method makeFromRow
	 * @method Save
	 * @method restoreSubject
	 * @method restoreBody
	 * @method changeStatus
	 * @method getTimeString
	 * @access Public
	 */

	class EmailNotification extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $id;
		/**
		 * @var string
		 * @access Private
		 */
		var $email;
		/**
		 * @var integer
		 * @access Private
		 */
		var $days;
		/**
		 * @var char
		 * @access Private
		 */
		var $deactivate;
		/**
		 * @var date
		 * @access Private
		 */
		var $updated;
		/**
		 * @var string
		 * @access Private
		 */
		var $bcc;
		/**
		 * @var string
		 * @access Private
		 */
		var $about;
		/**
		 * @var string
		 * @access Private
		 */
		var $subject;
		/**
		 * @var string
		 * @access Private
		 */
		var $content_type;
		/**
		 * @var string
		 * @access Private
		 */
		var $body;
		/**
		 * @var string
		 * @access Private
		 */
		var $lang;

		/**
		 * <code>
		 *		$emailNotifObj = new EmailNotification($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name EmailNotification
		 * @access Public
		 * @param integer $var
		 */
		function EmailNotification($var="",$lang=EDIR_DEFAULT_LANGUAGE, $form = false) {
			$this->lang = $lang;
			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT e.email, e.days, e.deactivate, e.bcc, e.about, e.content_type, l.* FROM Email_Notification e, Email_Notification_Lang l WHERE e.id=l.id AND l.id = $var AND l.lang='$this->lang'";
				$result = $db->query($sql);

				if ($lang != EDIR_DEFAULT_LANGUAGE && !$form) {
					$row = mysql_fetch_array($result);
					if (!$row["subject"] && !$row["body"]) {
						$this->lang = EDIR_DEFAULT_LANGUAGE;
						$sql = "SELECT e.email, e.days, e.deactivate, e.bcc, e.about, e.content_type, l.* FROM Email_Notification e, Email_Notification_Lang l WHERE e.id=l.id AND l.id = $var AND l.lang='".EDIR_DEFAULT_LANGUAGE."'";
						unset($result);
						$result = $db->query($sql);
						$row = mysql_fetch_array($result);
					}
				} else {
					$row = mysql_fetch_array($result);
				}
				$row["id"] = ($row["id"]) ? $row["id"] : $var;
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
			$this->id           = ($row["id"])           ? $row["id"]           : ($this->id           ? $this->id           : 0);
			$this->email        = ($row["email"])        ? $row["email"]        : "";
			$this->days         = ($row["days"])         ? $row["days"]         : ($this->days         ? $this->days         : 0);
			$this->deactivate   = ($row["deactivate"])   ? $row["deactivate"]   : ($this->deactivate   ? $this->deactivate   : 0);
			$this->updated      = ($row["updated"])      ? $row["updated"]      : "";
			$this->bcc          = ($row["bcc"])          ? $row["bcc"]          : "";
			$this->about        = ($row["about"])        ? $row["about"]        : ($this->about        ? $this->about        : "");
			$this->subject      = ($row["subject"])      ? $row["subject"]      : "";
			$this->content_type = ($row["content_type"]) ? $row["content_type"] : ($this->content_type ? $this->content_type : "");
			$this->body         = ($row["body"])         ? $row["body"]         : "";
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$emailNotifObj->Save();
		 * <br /><br />
		 *		//Using this in EmailNotification() class.
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
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);

			$langaux = $this->lang;

			$this->prepareToSave();

			if ($this->id) {

				$sql  = "SELECT * FROM Email_Notification_Lang WHERE lang=$this->lang AND id=$this->id";

				$verify = $dbObj->query($sql);

				if (mysql_numrows($verify) < 1) {

					$sql =	"INSERT INTO Email_Notification_Lang"
							. " (id, "
							. " lang, "
							. " subject, "
							. " body) "
							. " VALUES"
							. " ($this->id,"
							. " $this->lang,"
							. " $this->subject,"
							. " $this->body)";

				} else {

					$sql =	"UPDATE Email_Notification_Lang SET"
							. " updated  = NOW(),"
							. " subject  = $this->subject,"
							. " body     = $this->body"
							. " WHERE id = $this->id AND lang = $this->lang";

				}

				$dbObj->query($sql);

                if ($langaux == EDIR_DEFAULT_LANGUAGE){
                    $sql = "UPDATE Email_Notification SET"
					. " email        = $this->email,"
					. " days         = $this->days,"
					. " deactivate   = $this->deactivate,"
					. " bcc          = $this->bcc,"
					. " about        = $this->about,"
					. " content_type = $this->content_type"
					. " WHERE id     = $this->id";

					$dbObj->query($sql);
                }
                
			} else {

				$sql = "INSERT INTO Email_Notification"
					. " ("
					. " email,"
					. " days,"
					. " deactivate,"
					. " bcc,"
					. " about,"
					. " content_type"
					. " )"
					. " VALUES"
					. " ("
					. " $this->email,"
					. " $this->days,"
					. " $this->deactivate,"
					. " $this->bcc,"
					. " $this->about,"
					. " $this->content_type"
					. " )";

				$dbObj->query($sql);

				$this->id = mysql_insert_id($dbObj->link_id);

			}

			$this->prepareToUse();

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$emailNotifObj->restoreSubject();
		 * <br /><br />
		 *		//Using this in EmailNotification() class.
		 *		$this->restoreSubject();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name restoreSubject
		 * @access Public
		 */
		function restoreSubject() {
			
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
			$sql = "SELECT subject FROM Email_Notification_Default WHERE id = ".$this->id;
			$result = $dbObj->query($sql);

			if (mysql_numrows($result) > 0) {
				return mysql_result($result, 0, "subject");
			}

			return "";

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$emailNotifObj->restoreBody();
		 * <br /><br />
		 *		//Using this in EmailNotification() class.
		 *		$this->restoreBody();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name restoreBody
		 * @access Public
		 */
		function restoreBody($type="text") {

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			
			unset($dbMain);
			
			if ($type == "text"){
				$content_type = "text/plain";
			} else {
				$content_type = "text/html";
			}
			
			$sql = "UPDATE Email_Notification SET `content_type` = '$content_type' WHERE id = ".$this->id;
			$result = $dbObj->query($sql);
			
			$sql = "SELECT body_$type FROM Email_Notification_Default WHERE id = ".$this->id;
			$result = $dbObj->query($sql);

			if (mysql_numrows($result) > 0) {
				return mysql_result($result, 0, "body_$type");
			}

			return "";

		}
		
		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$emailNotifObj->changeStatus();
		 * <br /><br />
		 *		//Using this in EmailNotification() class.
		 *		$this->changeStatus();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name changeStatus
		 * @access Public
		 */
		function changeStatus() {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
			if ($this->deactivate == '0') {
                $sql = "UPDATE Email_Notification SET deactivate='1' WHERE id='$this->id'";    
			} elseif ($this->deactivate == '1' ) {
                $sql = "UPDATE Email_Notification SET deactivate='0' WHERE id='$this->id'";    
            } else return true;
            $dbObj->query($sql);               
        }

	}

?>
