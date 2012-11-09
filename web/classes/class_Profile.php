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
	# * FILE: /classes/class_Profile.php
	# ----------------------------------------------------------------------------------------------------

    /**
	 * <code>
	 *		$profileObj = new Profile($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name Profile
	 * @method Profile
	 * @method makeFromRow
	 * @method Save
	 * @method profileExists
	 * @method findUid
	 * @method Delete
	 * @method fUrl_Exists
	 * @method deal_done
	 * @access Public
	 */

	class Profile extends Handle {

        /**
		 * @var integer
		 * @access Private
		 */
		var $account_id;
        /**
		 * @var integer
		 * @access Private
		 */
		var $image_id;
        /**
		 * @var string
		 * @access Private
		 */
		var $facebook_image;
        /**
		 * @var integer
		 * @access Private
		 */
		var $facebook_image_height;
        /**
		 * @var integer
		 * @access Private
		 */
		var $facebook_image_width;
        /**
		 * @var string
		 * @access Private
		 */
		var $nickname;
        /**
		 * @var string
		 * @access Private
		 */
		var $friendly_url;
        /**
		 * @var date
		 * @access Private
		 */
		var $entered;
        /**
		 * @var date
		 * @access Private
		 */
		var $updated;
        /**
		 * @var date
		 * @access Private
		 */
		var $birth_date;
        /**
		 * @var string
		 * @access Private
		 */
		var $birth_city;
        /**
		 * @var string
		 * @access Private
		 */
		var $personal_message;
        /**
		 * @var string
		 * @access Private
		 */
		var $favorite_books;
        /**
		 * @var string
		 * @access Private
		 */
		var $favorite_movies;
        /**
		 * @var string
		 * @access Private
		 */
		var $favorite_sports;
        /**
		 * @var string
		 * @access Private
		 */
		var $favorite_musics;
        /**
		 * @var string
		 * @access Private
		 */
		var $favorite_foods;
        /**
		 * @var string
		 * @access Private
		 */
		var $twitter_account;
        /**
		 * @var string
		 * @access Private
		 */
		var $facebook_uid;
        /**
		 * @var string
		 * @access Private
		 */
		var $tw_post;
        /**
		 * @var string
		 * @access Private
		 */
		var $tw_oauth_token;
        /**
		 * @var string
		 * @access Private
		 */
		var $tw_oauth_token_secret;
        /**
		 * @var string
		 * @access Private
		 */
		var $tw_screen_name;
        /**
		 * @var string
		 * @access Private
		 */
		var $profile_exists;
        /**
		 * @var string
		 * @access Private
		 */
		var $location;
        /**
		 * @var string
		 * @access Private
		 */
		var $usefacebooklocation;

        /**
		 * <code>
		 *		$profileObj = new Profile($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Profile
		 * @access Public
		 * @param integer $var
		 */
		function Profile($var='') {
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject(DEFAULT_DB,true);
				$sql = "SELECT * FROM Profile WHERE account_id = $var";
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
			$row["account_id"]?				$this->account_id = $row["account_id"]:									$this->account_id = 0;
			$row["image_id"]?				$this->image_id = $row["image_id"]:										$this->image_id = 0;
			$row["facebook_image"]?			$this->facebook_image = $row["facebook_image"]:							$this->facebook_image = "";
			$row["facebook_image_height"]?	$this->facebook_image_height = $row["facebook_image_height"]:			$this->facebook_image_height = 0;
			$row["facebook_image_width"]?	$this->facebook_image_width = $row["facebook_image_width"]:				$this->facebook_image_width = 0;
			$row["nickname"]?				$this->nickname = $row["nickname"]:										$this->nickname = "";
			$row["friendly_url"]?			$this->friendly_url = $row["friendly_url"]:								$this->friendly_url = "";
			$row["entered"]?				$this->entered = $row["entered"]:										$this->entered = 0;
			$row["updated"]?				$this->updated = $row["updated"]:										$this->updated = 0;
			$this->setDate("birth_date",	$row["birth_date"]);
			$row["birth_city"]?				$this->birth_city = $row["birth_city"]:									$this->birth_city = "";
			$row["personal_message"]?		$this->personal_message = $row["personal_message"]:						$this->personal_message = "";
			$row["favorite_books"]?			$this->favorite_books = $row["favorite_books"]:							$this->favorite_books = "";
			$row["favorite_movies"]?		$this->favorite_movies = $row["favorite_movies"]:						$this->favorite_movies = "";
			$row["favorite_sports"]?		$this->favorite_sports = $row["favorite_sports"]:						$this->favorite_sports = "";
			$row["favorite_musics"]?		$this->favorite_musics = $row["favorite_musics"]:						$this->favorite_musics = "";
			$row["favorite_foods"]?			$this->favorite_foods = $row["favorite_foods"]:							$this->favorite_foods = "";
			$row["twitter_account"]?		$this->twitter_account = $row["twitter_account"]:						$this->twitter_account? $this->twitter_account = $this->twitter_account: $this->twitter_account = "";
			if ($row["facebook_uid"]) $this->facebook_uid = $row["facebook_uid"];
			else if (!$this->facebook_uid) $this->facebook_uid = "";
			$row["tw_post"]?				$this->tw_post = 1:														$this->tw_post = 0;
			$row["tw_oauth_token"]?			$this->tw_oauth_token = $row["tw_oauth_token"]:							$this->tw_oauth_token = "";
			$row["tw_oauth_token_secret"]?	$this->tw_oauth_token_secret = $row["tw_oauth_token_secret"]:			$this->tw_oauth_token_secret = "";
			$row["tw_screen_name"]?			$this->tw_screen_name = $row["tw_screen_name"]:							$this->tw_screen_name = "";
			$row["location"]?				$this->location = $row["location"]:										$this->location = "";
			$row["usefacebooklocation"]?	$this->usefacebooklocation = $row["usefacebooklocation"]:				$this->usefacebooklocation = 0;

			$this->profileExists();
		}

        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$profileObj->Save();
		 * <br /><br />
		 *		//Using this in Profile() class.
		 *		$this->Save();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Save
		 * @access Public
		 */
		function Save() {
			$exists = $this->profile_exists;
			
			$this->prepareToSave();
			$dbObj = db_getDBObject(DEFAULT_DB,true);

			if ($exists) {
				$sql  = "UPDATE Profile SET"
					. " image_id = $this->image_id,"
					. " facebook_image = $this->facebook_image,"
					. " facebook_image_height = $this->facebook_image_height,"
					. " facebook_image_width = $this->facebook_image_width,"
					. " nickname = $this->nickname,"
					. " friendly_url = $this->friendly_url,"
					. " updated = NOW(),"
					. " birth_date = $this->birth_date,"
					. " birth_city = $this->birth_city,"
					. " personal_message = $this->personal_message,"
					. " favorite_books = $this->favorite_books,"
					. " favorite_movies = $this->favorite_movies,"
					. " favorite_sports = $this->favorite_sports,"
					. " favorite_musics = $this->favorite_musics,"
					. " favorite_foods = $this->favorite_foods,"
					. " twitter_account = $this->twitter_account,"
					. " facebook_uid = $this->facebook_uid, "
					. " tw_post=$this->tw_post,"
					. " tw_oauth_token=$this->tw_oauth_token,"
					. " tw_oauth_token_secret=$this->tw_oauth_token_secret,"
					. " tw_screen_name=$this->tw_screen_name,"
					. " location=$this->location,"
					. " usefacebooklocation=$this->usefacebooklocation "
                                        
					. " WHERE account_id = $this->account_id";

				$dbObj->query($sql);
			} else {
				$auxAccID = str_replace("'", "", $this->account_id);
				if ($auxAccID > 0) {
					$sql = "INSERT INTO Profile"
						. " (account_id, image_id, facebook_image, facebook_image_height, facebook_image_width, nickname, friendly_url, entered, birth_date, birth_city, personal_message, favorite_books, favorite_movies, favorite_sports, favorite_musics, favorite_foods, twitter_account,facebook_uid,tw_post,tw_oauth_token,tw_oauth_token_secret,tw_screen_name,location,usefacebooklocation)"
						. " VALUES"
						. " ($this->account_id, $this->image_id, $this->facebook_image, $this->facebook_image_height, $this->facebook_image_width , $this->nickname, MD5($this->account_id), NOW(), $this->birth_date, $this->birth_city, $this->personal_message, $this->favorite_books, $this->favorite_movies, $this->favorite_sports, $this->favorite_musics, $this->favorite_foods, $this->twitter_account,$this->facebook_uid,$this->tw_post,$this->tw_oauth_token,$this->tw_oauth_token_secret,$this->tw_screen_name,$this->location,$this->usefacebooklocation)";
					$dbObj->query($sql);

					$sql = "SELECT friendly_url FROM Profile WHERE account_id = $this->account_id";
					$result = $dbObj->Query($sql);
					$row = mysql_fetch_assoc($result);
					$this->friendly_url = $row["friendly_url"];
				}
			}


			$this->prepareToUse();
		}
        
        /**
        * <code>
        *		//Using this in forms or other pages.
        *		$profileObj->profileExists();
        * <br /><br />
        *		//Using this in Profile() class.
        *		$this->profileExists();
        * </code>
        * @copyright Copyright 2005 Arca Solutions, Inc.
        * @author Arca Solutions, Inc.
        * @version 8.0.00
        * @name Save
        * @access Public
        */
		function profileExists() {
			if ($this->account_id > 0) $this->profile_exists = true;
			else $this->profile_exists = false;
		}
        
        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$profileObj->findUid();
		 * <br /><br />
		 *		//Using this in Profile() class.
		 *		$this->findUid();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Save
		 * @access Public
		 */
		function findUid($uid=false){
			if (!$uid) return false;
			$dbObj = db_getDBObject(DEFAULT_DB,true);
			$sql="SELECT * FROM Profile WHERE facebook_uid = '".addslashes($uid)."'";

			$dbObj->query($sql);
			$result = $dbObj->Query($sql);
			$row = mysql_fetch_assoc($result);
			if ($row["account_id"]){
				$this->makeFromRow($row);
				return true;
			} else {
                return false;
            }

		}

        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$profileObj->Delete();
		 * <br /><br />
		 *		//Using this in Profile() class.
		 *		$this->Delete();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Save
		 * @access Public
		 */
		function Delete() {
			$dbObj = db_getDBObject(DEFAULT_DB,true);
			$sql = "DELETE FROM Profile WHERE account_id = $this->account_id";
			$dbObj->query($sql);
		}

        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$profileObj->fUrl_Exists();
		 * <br /><br />
		 *		//Using this in Profile() class.
		 *		$this->fUrl_Exists();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Save
		 * @access Public
		 */
		function fUrl_Exists($fUrl) {
			if ($fUrl) {
				$dbObj = db_getDBObject(DEFAULT_DB,true);
				$sql = " SELECT account_id FROM Profile WHERE friendly_url = '".$fUrl."'";
				$result = $dbObj->query($sql);
				if (mysql_num_rows($result) > 0) {
					$row = mysql_fetch_assoc($result);
					if ($row["account_id"] == sess_getAccountIdFromSession()) {
						return false;
					} else {
						return true;
					}
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$profileObj->deal_done();
		 * <br /><br />
		 *		//Using this in Profile() class.
		 *		$this->deal_done();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Save
		 * @access Public
		 */
		function deal_done($dealtype = "twitter", $promotion_id = false, $network_response = false){

			if (!$promotion_id)  return false;

			if($dealtype == "profile"){
				$twittered = 0;
				$facebooked = 0;
			} else if($dealtype == "twitter"){
				$twittered = 1;
				$facebooked = 0;
			} else {
				$twittered = 0;
				$facebooked = 1;
			}

			$dbObj = db_getDBObject(DEFAULT_DB, true);
            $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObj);

			$sqlRedeem = "SELECT id FROM `Promotion_Redeem` WHERE `account_id` = ".sess_getAccountIdFromSession()." AND `promotion_id` = $promotion_id LIMIT 1";
			$resRedeem = $dbDomain->query($sqlRedeem);

			if (mysql_num_rows($resRedeem) > 0) {
				$rowRedeem = mysql_fetch_assoc($resRedeem);
				$redeem_id = $rowRedeem["id"];

				$arrayUpdate = array();

				if ($dealtype == "twitter") $arrayUpdate[]= "twittered = 1";
				if ($dealtype == "profile") $arrayUpdate[]= "facebooked = 1";

				$sqlSet = implode(",",$arrayUpdate);
				$sqlSet .= ", network_response = CONCAT(network_response, ".db_formatString("[|]".$network_response).")";

				$sql = "UPDATE Promotion_Redeem SET ".$sqlSet." WHERE id = ".$redeem_id;
				$result = $dbDomain->query($sql);
			} else {
				$redeem_code = system_generatePassword();

				$sql = "INSERT INTO Promotion_Redeem ( ";
				$sql .= "account_id, promotion_id, twittered, facebooked, network_response, datetime, redeem_code";
				$sql .= " ) VALUES (";
				$sql .= (int)sess_getAccountIdFromSession().", ";
				$sql .= (int)$promotion_id.", ";
				$sql .= "$twittered, $facebooked, ";
				$sql .= db_formatString($network_response).", ";
				$sql .= "NOW(), ".db_formatString($redeem_code)."";
				$sql .= ")";
				$result = $dbDomain->query($sql);

				$sql = "UPDATE Promotion SET amount = amount - 1 WHERE id = $promotion_id";
				$dbDomain->query($sql);
			}

			return $redeem_code;
		}  
	}
?>