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
	# * FILE: /classes/class_Classified.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$classifiedObj = new Classified($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name Classified
	 * @method Classified
	 * @method makeFromRow
	 * @method Save
	 * @method Delete
	 * @method updateImage
	 * @method getCategories
	 * @method setCategories
	 * @method getPrice
	 * @method hasRenewalDate
	 * @method needToCheckOut
	 * @method getNextRenewalDate
	 * @method setLocationManager
	 * @method getLocationManager
	 * @method getLocationString
	 * @method setFullTextSearch
	 * @method getGalleries
	 * @method setGalleries
	 * @method setMapTuning
	 * @method hasDetail
	 * @method setNumberViews
	 * @method deletePerAccount
	 * @method getFriendlyURL
	 * @access Public
	 */

	class Classified extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $account_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $location_1;
		/**
		 * @var integer
		 * @access Private
		 */
		var $location_2;
		/**
		 * @var integer
		 * @access Private
		 */
		var $location_3;
		/**
		 * @var integer
		 * @access Private
		 */
		var $location_4;
		/**
		 * @var integer
		 * @access Private
		 */
		var $location_5;
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
		var $renewal_date;
		/**
		 * @var integer
		 * @access Private
		 */
		var $discount_id;
		/**
		 * @var string
		 * @access Private
		 */
		var $title;
		/**
		 * @var string
		 * @access Private
		 */
		var $seo_title;
		/**
		 * @var string
		 * @access Private
		 */
		var $friendly_url;
		/**
		 * @var string
		 * @access Private
		 */
		var $email;
		/**
		 * @var string
		 * @access Private
		 */
		var $url;
		/**
		 * @var string
		 * @access Private
		 */
		var $contactname;
		/**
		 * @var string
		 * @access Private
		 */
		var $address;
		/**
		 * @var string
		 * @access Private
		 */
		var $address2;
		/**
		 * @var string
		 * @access Private
		 */
		var $phone;
		/**
		 * @var string
		 * @access Private
		 */
		var $fax;
		/**
		 * @var string
		 * @access Private
		 */
		var $summarydesc1;
		/**
		 * @var string
		 * @access Private
		 */
		var $summarydesc2;
		/**
		 * @var string
		 * @access Private
		 */
		var $summarydesc3;
		/**
		 * @var string
		 * @access Private
		 */
		var $summarydesc4;
		/**
		 * @var string
		 * @access Private
		 */
		var $summarydesc5;
		/**
		 * @var string
		 * @access Private
		 */
		var $summarydesc6;
		/**
		 * @var string
		 * @access Private
		 */
		var $summarydesc7;
		/**
		 * @var string
		 * @access Private
		 */
		var $seo_summarydesc1;
		/**
		 * @var string
		 * @access Private
		 */
		var $seo_summarydesc2;
		/**
		 * @var string
		 * @access Private
		 */
		var $seo_summarydesc3;
		/**
		 * @var string
		 * @access Private
		 */
		var $seo_summarydesc4;
		/**
		 * @var string
		 * @access Private
		 */
		var $seo_summarydesc5;
		/**
		 * @var string
		 * @access Private
		 */
		var $seo_summarydesc6;
		/**
		 * @var string
		 * @access Private
		 */
		var $seo_summarydesc7;
		/**
		 * @var string
		 * @access Private
		 */
		var $detaildesc1;
		/**
		 * @var string
		 * @access Private
		 */
		var $detaildesc2;
		/**
		 * @var string
		 * @access Private
		 */
		var $detaildesc3;
		/**
		 * @var string
		 * @access Private
		 */
		var $detaildesc4;
		/**
		 * @var string
		 * @access Private
		 */
		var $detaildesc5;
		/**
		 * @var string
		 * @access Private
		 */
		var $detaildesc6;
		/**
		 * @var string
		 * @access Private
		 */
		var $detaildesc7;
		/**
		 * @var string
		 * @access Private
		 */
		var $keywords1;
		/**
		 * @var string
		 * @access Private
		 */
		var $keywords2;
		/**
		 * @var string
		 * @access Private
		 */
		var $keywords3;
		/**
		 * @var string
		 * @access Private
		 */
		var $keywords4;
		/**
		 * @var string
		 * @access Private
		 */
		var $keywords5;
		/**
		 * @var string
		 * @access Private
		 */
		var $keywords6;
		/**
		 * @var string
		 * @access Private
		 */
		var $keywords7;
		/**
		 * @var string
		 * @access Private
		 */
		var $seo_keywords1;
		/**
		 * @var string
		 * @access Private
		 */
		var $seo_keywords2;
		/**
		 * @var string
		 * @access Private
		 */
		var $seo_keywords3;
		/**
		 * @var string
		 * @access Private
		 */
		var $seo_keywords4;
		/**
		 * @var string
		 * @access Private
		 */
		var $seo_keywords5;
		/**
		 * @var string
		 * @access Private
		 */
		var $seo_keywords6;
		/**
		 * @var string
		 * @access Private
		 */
		var $seo_keywords7;
		/**
		 * @var integer
		 * @access Private
		 */
		var $image_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $thumb_id;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $video_snippet;
		/**
		 * @var string
		 * @access Private
		 */
		var $zip_code;
		/**
		 * @var integer
		 * @access Private
		 */
		var $level;
		/**
		 * @var char
		 * @access Private
		 */
		var $status;
        /*
         * @var real
         * @access Private
         */
        var $latitude;
        /*
         * @var real
         * @access Private
         */
        var $longitude;
		/**
		 * @var integer
		 * @access Private
		 */
		var $map_zoom;
		/**
		 * @var array
		 * @access Private
		 */
		var $locationManager;
		/**
		 * @var real
		 * @access Private
		 */
		var $classified_price;
		/**
		 * @var integer
		 * @access Private
		 */
		var $number_views;
		/**
		 * @var array
		 * @access Private
		 */
		var $data_in_array;
		/**
		 * @var integer
		 * @access Private
		 */
		var $domain_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $package_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $package_price;

		/**
		 * <code>
		 *		$classifiedObj = new Classified($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Classified
		 * @access Public
		 * @param integer $var
		 */
		function Classified($var='', $domain_id = false) {
			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if ($domain_id){
					$this->domain_id = $domain_id;
					$db = db_getDBObjectByDomainID($domain_id, $dbMain);
				}else if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT * FROM Classified WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));

				$this->old_account_id = $row["account_id"];

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

			$status = new ItemStatus();
			$level = new ClassifiedLevel();

			$this->id					= ($row["id"])					? $row["id"]					: ($this->id					? $this->id					: 0);
			$this->account_id			= ($row["account_id"])			? $row["account_id"]			: 0;
			$this->location_1			= ($row["location_1"])			? $row["location_1"]			: 0;
			$this->location_2			= ($row["location_2"])			? $row["location_2"]			: 0;
			$this->location_3			= ($row["location_3"])			? $row["location_3"]			: 0;
			$this->location_4			= ($row["location_4"])			? $row["location_4"]			: 0;
			$this->location_5			= ($row["location_5"])			? $row["location_5"]			: 0;
			$this->entered				= ($row["entered"])				? $row["entered"]				: ($this->entered				? $this->entered			: "");
			$this->updated				= ($row["updated"])				? $row["updated"]				: ($this->updated				? $this->updated			: "");
			$this->renewal_date			= ($row["renewal_date"])		? $row["renewal_date"]			: ($this->renewal_date			? $this->renewal_date		: 0);
			$this->discount_id			= ($row["discount_id"])			? $row["discount_id"]			: "";
			$this->title				= ($row["title"])				? $row["title"]					: ($this->title					? $this->title				: "");
			$this->seo_title			= ($row["seo_title"])			? $row["seo_title"]				: ($this->seo_title				? $this->seo_title			: "");
			$this->friendly_url			= ($row["friendly_url"])		? $row["friendly_url"]			: "";
			$this->email				= ($row["email"])				? $row["email"]					: "";
			$this->url					= ($row["url"])					? $row["url"]					: "";
			$this->contactname			= ($row["contactname"])			? $row["contactname"]			: "";
			$this->address				= ($row["address"])				? $row["address"]				: "";
			$this->address2				= ($row["address2"])			? $row["address2"]				: "";
			$this->phone				= ($row["phone"])				? $row["phone"]					: "";
			$this->fax					= ($row["fax"])					? $row["fax"]					: "";
			$this->summarydesc1			= ($row["summarydesc1"])		? $row["summarydesc1"]			: "";
			$this->summarydesc2			= ($row["summarydesc2"])		? $row["summarydesc2"]			: "";
			$this->summarydesc3			= ($row["summarydesc3"])		? $row["summarydesc3"]			: "";
			$this->summarydesc4			= ($row["summarydesc4"])		? $row["summarydesc4"]			: "";
			$this->summarydesc5			= ($row["summarydesc5"])		? $row["summarydesc5"]			: "";
			$this->summarydesc6			= ($row["summarydesc6"])		? $row["summarydesc6"]			: "";
			$this->summarydesc7			= ($row["summarydesc7"])		? $row["summarydesc7"]			: "";
			$this->seo_summarydesc1		= ($row["seo_summarydesc1"])	? $row["seo_summarydesc1"]		: ($this->seo_summarydesc1		? $this->seo_summarydesc1	: "");
			$this->seo_summarydesc2		= ($row["seo_summarydesc2"])	? $row["seo_summarydesc2"]		: ($this->seo_summarydesc2		? $this->seo_summarydesc2	: "");
			$this->seo_summarydesc3		= ($row["seo_summarydesc3"])	? $row["seo_summarydesc3"]		: ($this->seo_summarydesc3		? $this->seo_summarydesc3	: "");
			$this->seo_summarydesc4		= ($row["seo_summarydesc4"])	? $row["seo_summarydesc4"]		: ($this->seo_summarydesc4		? $this->seo_summarydesc4	: "");
			$this->seo_summarydesc5		= ($row["seo_summarydesc5"])	? $row["seo_summarydesc5"]		: ($this->seo_summarydesc5		? $this->seo_summarydesc5	: "");
			$this->seo_summarydesc6		= ($row["seo_summarydesc6"])	? $row["seo_summarydesc6"]		: ($this->seo_summarydesc6		? $this->seo_summarydesc6	: "");
			$this->seo_summarydesc7		= ($row["seo_summarydesc7"])	? $row["seo_summarydesc7"]		: ($this->seo_summarydesc7		? $this->seo_summarydesc7	: "");
			$this->detaildesc1			= ($row["detaildesc1"])			? $row["detaildesc1"]			: "";
			$this->detaildesc2			= ($row["detaildesc2"])			? $row["detaildesc2"]			: "";
			$this->detaildesc3			= ($row["detaildesc3"])			? $row["detaildesc3"]			: "";
			$this->detaildesc4			= ($row["detaildesc4"])			? $row["detaildesc4"]			: "";
			$this->detaildesc5			= ($row["detaildesc5"])			? $row["detaildesc5"]			: "";
			$this->detaildesc6			= ($row["detaildesc6"])			? $row["detaildesc6"]			: "";
			$this->detaildesc7			= ($row["detaildesc7"])			? $row["detaildesc7"]			: "";
			$this->video_snippet		= ($row["video_snippet"])		? $row["video_snippet"]			: "";
			$this->keywords1			= ($row["keywords1"])			? $row["keywords1"]				: "";
			$this->keywords2			= ($row["keywords2"])			? $row["keywords2"]				: "";
			$this->keywords3			= ($row["keywords3"])			? $row["keywords3"]				: "";
			$this->keywords4			= ($row["keywords4"])			? $row["keywords4"]				: "";
			$this->keywords5			= ($row["keywords5"])			? $row["keywords5"]				: "";
			$this->keywords6			= ($row["keywords6"])			? $row["keywords6"]				: "";
			$this->keywords7			= ($row["keywords7"])			? $row["keywords7"]				: "";
			$this->seo_keywords1		= ($row["seo_keywords1"])		? $row["seo_keywords1"]			: ($this->seo_keywords1			? $this->seo_keywords1		: "");
			$this->seo_keywords2		= ($row["seo_keywords2"])		? $row["seo_keywords2"]			: ($this->seo_keywords2			? $this->seo_keywords2		: "");
			$this->seo_keywords3		= ($row["seo_keywords3"])		? $row["seo_keywords3"]			: ($this->seo_keywords3			? $this->seo_keywords3		: "");
			$this->seo_keywords4		= ($row["seo_keywords4"])		? $row["seo_keywords4"]			: ($this->seo_keywords4			? $this->seo_keywords4		: "");
			$this->seo_keywords5		= ($row["seo_keywords5"])		? $row["seo_keywords5"]			: ($this->seo_keywords5			? $this->seo_keywords5		: "");
			$this->seo_keywords6		= ($row["seo_keywords6"])		? $row["seo_keywords6"]			: ($this->seo_keywords6			? $this->seo_keywords6		: "");
			$this->seo_keywords7		= ($row["seo_keywords7"])		? $row["seo_keywords7"]			: ($this->seo_keywords7			? $this->seo_keywords7		: "");
			$this->image_id				= ($row["image_id"])			? $row["image_id"]				: ($this->image_id				? $this->image_id			: 0);
			$this->thumb_id				= ($row["thumb_id"])			? $row["thumb_id"]				: ($this->thumb_id				? $this->thumb_id			: 0);
			$this->zip_code				= ($row["zip_code"])			? $row["zip_code"]				: "";
			$this->level				= ($row["level"])				? $row["level"]					: ($this->level					? $this->level				: $level->getDefaultLevel());
			$this->status				= ($row["status"])				? $row["status"]				: $status->getDefaultStatus();
			$this->latitude             = ($row["latitude"])			? $row["latitude"]				: ($this->latitude              ? $this->latitude           : "");
			$this->longitude			= ($row["longitude"])			? $row["longitude"]				: ($this->longitude             ? $this->longitude          : "");
            $this->map_zoom				= ($row["map_zoom"])            ? $row["map_zoom"]              : 0;
			$this->classified_price     = ($row["classified_price"])    ? $row["classified_price"]      : "NULL";
			$this->number_views			= ($row["number_views"])		? $row["number_views"]			: ($this->number_views			? $this->number_views		: 0);
			$this->data_in_array		= $row;
			$this->package_id			= ($row["package_id"])			? $row["package_id"]			: ($this->package_id            ? $this->package_id			: 0);
			$this->package_price		= ($row["package_price"])		? $row["package_price"]			: ($this->package_price         ? $this->package_price		: 0);

		}

        function getByAccount($count_id = 0)
		{
		    $dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($domain_id){
				$this->domain_id = $domain_id;
				$db = db_getDBObjectByDomainID($domain_id, $dbMain);
			}else if (defined("SELECTED_DOMAIN_ID")) {
				$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$db = db_getDBObject();
			}
			unset($dbMain);
			$sql = "SELECT * FROM Classified WHERE account_id = $count_id";
			return $db->query($sql);
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$classifiedObj->Save();
		 * <br /><br />
		 *		//Using this in Classified() class.
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
				$aux_log_domain_id = $this->domain_id;
			} else	if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				$aux_log_domain_id = SELECTED_DOMAIN_ID;
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);

			$this->prepareToSave();

			$aux_old_account = str_replace("'", "", $this->old_account_id);
			$aux_account = str_replace("'", "", $this->account_id);

			$this->friendly_url = string_strtolower($this->friendly_url);

			if ($this->id) {

				$sql = "SELECT status FROM Classified WHERE id = $this->id";
				$result = $dbObj->query($sql);
				if ($row = mysql_fetch_assoc($result)) $last_status = $row["status"];
				$this_status = $this->status;
				$this_id = $this->id;

				$sql = "UPDATE Classified SET"
					. " account_id         = $this->account_id,"
					. " location_1         = $this->location_1,"
					. " location_2         = $this->location_2,"
					. " location_3         = $this->location_3,"
					. " location_4         = $this->location_4,"
					. " location_5         = $this->location_5,"
					. " updated            = NOW(),"
					. " renewal_date       = $this->renewal_date,"
					. " discount_id        = $this->discount_id,"
					. " title              = $this->title,"
					. " seo_title          = $this->seo_title,"
					. " friendly_url       = $this->friendly_url,"
					. " email              = $this->email,"
					. " url                = $this->url,"
					. " contactname        = $this->contactname,"
					. " address            = $this->address,"
					. " address2           = $this->address2,"
					. " phone              = $this->phone,"
					. " fax                = $this->fax,"
					. " summarydesc1       = $this->summarydesc1,"
					. " summarydesc2       = $this->summarydesc2,"
					. " summarydesc3       = $this->summarydesc3,"
					. " summarydesc4       = $this->summarydesc4,"
					. " summarydesc5       = $this->summarydesc5,"
					. " summarydesc6       = $this->summarydesc6,"
					. " summarydesc7       = $this->summarydesc7,"
					. " seo_summarydesc1   = $this->seo_summarydesc1,"
					. " seo_summarydesc2   = $this->seo_summarydesc2,"
					. " seo_summarydesc3   = $this->seo_summarydesc3,"
					. " seo_summarydesc4   = $this->seo_summarydesc4,"
					. " seo_summarydesc5   = $this->seo_summarydesc5,"
					. " seo_summarydesc6   = $this->seo_summarydesc6,"
					. " seo_summarydesc7   = $this->seo_summarydesc7,"
					. " detaildesc1        = $this->detaildesc1,"
					. " detaildesc2        = $this->detaildesc2,"
					. " detaildesc3        = $this->detaildesc3,"
					. " detaildesc4        = $this->detaildesc4,"
					. " detaildesc5        = $this->detaildesc5,"
					. " detaildesc6        = $this->detaildesc6,"
					. " detaildesc7        = $this->detaildesc7,"
					. " keywords1          = $this->keywords1,"
					. " keywords2          = $this->keywords2,"
					. " keywords3          = $this->keywords3,"
					. " keywords4          = $this->keywords4,"
					. " keywords4          = $this->keywords4,"
					. " keywords4          = $this->keywords4,"
					. " keywords4          = $this->keywords4,"
					. " seo_keywords1      = $this->seo_keywords1,"
					. " seo_keywords2      = $this->seo_keywords2,"
					. " seo_keywords3      = $this->seo_keywords3,"
					. " seo_keywords4      = $this->seo_keywords4,"
					. " seo_keywords5      = $this->seo_keywords5,"
					. " seo_keywords6      = $this->seo_keywords6,"
					. " seo_keywords7      = $this->seo_keywords7,"
					. " image_id           = $this->image_id,"
					. " thumb_id           = $this->thumb_id,"
					. " video_snippet      = $this->video_snippet,"
					. " zip_code           = $this->zip_code,"
					. " level              = $this->level,"
					. " status             = $this->status,"
                    . " latitude           = $this->latitude,"
					. " longitude          = $this->longitude,"
					. " map_zoom           = $this->map_zoom,"
					. " classified_price   = $this->classified_price,"
					. " number_views	   = $this->number_views,"
					. " package_id         = $this->package_id,"
					. " package_price	   = $this->package_price"
					. " WHERE id           = $this->id";
				$dbObj->query($sql);

				$last_status = str_replace("\"", "", $last_status);
				$last_status = str_replace("'", "", $last_status);
				$this_status = str_replace("\"", "", $this_status);
				$this_status = str_replace("'", "", $this_status);
				$this_id = str_replace("\"", "", $this_id);
				$this_id = str_replace("'", "", $this_id);
				if (($this_status == "A") && ($last_status != "A")) system_countActiveItemByCategory("classified", $this_id, "inc");
				elseif (($last_status == "A") && ($this_status != "A")) system_countActiveItemByCategory("classified", $this_id, "dec");

				if ($aux_old_account != $aux_account && $aux_account != 0) {
					domain_SaveAccountInfoDomain($aux_account, $this);
				}

				if ($last_status != "P" && $this_status == "P"){
					activity_newToApproved($aux_log_domain_id, $this->id, "classified", $this->title);
				} else if ($last_status == "P" && $this_status != "P") {
					activity_deleteRecord($aux_log_domain_id, $this->id, "classified");
				} else if ($last_status == $this_status){
					activity_updateRecord($aux_log_domain_id, $this->id, $this->title, "item", "classified");
				}

			} else {

				$sql = "INSERT INTO Classified"
					. " (account_id,"
					. " location_1,"
					. " location_2,"
					. " location_3,"
					. " location_4,"
					. " location_5,"
					. " updated,"
					. " entered,"
					. " renewal_date,"
					. " discount_id,"
					. " title,"
					. " seo_title,"
					. " friendly_url,"
					. " email,"
					. " url,"
					. " contactname,"
					. " address,"
					. " address2,"
					. " phone,"
					. " fax,"
					. " summarydesc1,"
					. " summarydesc2,"
					. " summarydesc3,"
					. " summarydesc4,"
					. " summarydesc5,"
					. " summarydesc6,"
					. " summarydesc7,"
					. " seo_summarydesc1,"
					. " seo_summarydesc2,"
					. " seo_summarydesc3,"
					. " seo_summarydesc4,"
					. " seo_summarydesc5,"
					. " seo_summarydesc6,"
					. " seo_summarydesc7,"
					. " detaildesc1,"
					. " detaildesc2,"
					. " detaildesc3,"
					. " detaildesc4,"
					. " detaildesc5,"
					. " detaildesc6,"
					. " detaildesc7,"
					. " keywords1,"
					. " keywords2,"
					. " keywords3,"
					. " keywords4,"
					. " keywords5,"
					. " keywords6,"
					. " keywords7,"
					. " seo_keywords1,"
					. " seo_keywords2,"
					. " seo_keywords3,"
					. " seo_keywords4,"
					. " seo_keywords5,"
					. " seo_keywords6,"
					. " seo_keywords7,"
					. " fulltextsearch_keyword,"
					. " fulltextsearch_where,"
					. " image_id,"
					. " thumb_id,"
					. " video_snippet,"
					. " zip_code,"
					. " level,"
					. " status,"
					. " latitude,"
					. " longitude,"
					. " map_zoom,"
					. " classified_price,"
					. " number_views,"
					. " package_id,"
					. " package_price)"
					. " VALUES"
					. " ($this->account_id,"
					. " $this->location_1,"
					. " $this->location_2,"
					. " $this->location_3,"
					. " $this->location_4,"
					. " $this->location_5,"
					. " NOW(),"
					. " NOW(),"
					. " $this->renewal_date,"
					. " $this->discount_id,"
					. " $this->title,"
					. " $this->title,"
					. " $this->friendly_url,"
					. " $this->email,"
					. " $this->url,"
					. " $this->contactname,"
					. " $this->address,"
					. " $this->address2,"
					. " $this->phone,"
					. " $this->fax,"
					. " $this->summarydesc1,"
					. " $this->summarydesc2,"
					. " $this->summarydesc3,"
					. " $this->summarydesc4,"
					. " $this->summarydesc5,"
					. " $this->summarydesc6,"
					. " $this->summarydesc7,"
					. " $this->summarydesc1,"
					. " $this->summarydesc2,"
					. " $this->summarydesc3,"
					. " $this->summarydesc4,"
					. " $this->summarydesc5,"
					. " $this->summarydesc6,"
					. " $this->summarydesc7,"
					. " $this->detaildesc1,"
					. " $this->detaildesc2,"
					. " $this->detaildesc3,"
					. " $this->detaildesc4,"
					. " $this->detaildesc5,"
					. " $this->detaildesc6,"
					. " $this->detaildesc7,"
					. " $this->keywords1,"
					. " $this->keywords2,"
					. " $this->keywords3,"
					. " $this->keywords4,"
					. " $this->keywords5,"
					. " $this->keywords6,"
					. " $this->keywords7,"
					. " ".str_replace(" || ", ", ", $this->keywords1).","
					. " ".str_replace(" || ", ", ", $this->keywords2).","
					. " ".str_replace(" || ", ", ", $this->keywords3).","
					. " ".str_replace(" || ", ", ", $this->keywords4).","
					. " ".str_replace(" || ", ", ", $this->keywords5).","
					. " ".str_replace(" || ", ", ", $this->keywords6).","
					. " ".str_replace(" || ", ", ", $this->keywords7).","
					. " '',"
					. " '',"
					. " $this->image_id,"
					. " $this->thumb_id,"
					. " $this->video_snippet,"
					. " $this->zip_code,"
					. " $this->level,"
					. " $this->status,"
					. " $this->latitude,"
					. " $this->longitude,"
					. " $this->map_zoom,"
					. " $this->classified_price,"
					. " $this->number_views,"
					. " $this->package_id,"
					. " $this->package_price)";
				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);

				if (sess_getAccountIdFromSession() || string_strpos($_SERVER["PHP_SELF"],"order_") !== false){
					activity_newActivity($aux_log_domain_id, $this->account_id, 0, "newitem", "classified", $this->title);
				}

				if ($this->status == "'P'"){
					activity_newToApproved($aux_log_domain_id, $this->id, "classified", $this->title);
				}

				domain_updateDashboard("number_content","inc",0,$aux_log_domain_id);

				$this_status = $this->status;
				$this_id = $this->id;
				$this_status = str_replace("\"", "", $this_status);
				$this_status = str_replace("'", "", $this_status);
				$this_id = str_replace("\"", "", $this_id);
				$this_id = str_replace("'", "", $this_id);
				if ($this_status == "A") system_countActiveItemByCategory("classified", $this_id, "inc");

				if ($aux_account != 0) {
					domain_SaveAccountInfoDomain($aux_account, $this);
				}

			}

			$this->prepareToUse();

			$this->setFullTextSearch();

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$classifiedObj->Delete();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Delete
		 * @access Public
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
			
			### CLASSIFIED CATEGORY
			if ($this->status == "A") system_countActiveItemByCategory("classified", $this->id, "dec", false, $domain_id);

			### GALERY
			$sql = "DELETE FROM Gallery_Item WHERE item_type = 'classified' AND item_id = $this->id";
			$dbObj->query($sql);

			### IMAGES
			if ($this->image_id) {
				$image = new Image($this->image_id);
				if ($image) $image->Delete($domain_id);
			}
			if ($this->thumb_id) {
				$image = new Image($this->thumb_id);
				if ($image) $image->Delete($domain_id);
			}

			### INVOICE
			$sql = "UPDATE Invoice_Classified SET classified_id = '0' WHERE classified_id = $this->id";
			$dbObj->query($sql);

			### PAYMENT
			$sql = "UPDATE Payment_Classified_Log SET classified_id = '0' WHERE classified_id = $this->id";
			$dbObj->query($sql);

			### CLASSIFIED
			$sql = "DELETE FROM Classified WHERE id = $this->id";
			$dbObj->query($sql);

			if ($domain_id){
				$domain_idDash = $domain_id;
			} else {
				$domain_idDash = SELECTED_DOMAIN_ID;
			}

			domain_updateDashboard("number_content","dec", 0, $domain_idDash);

			activity_deleteRecord($domain_idDash, $this->id, "classified");

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$classifiedObj->updateImage($imageArray);
		 * <br /><br />
		 *		//Using this in Classified() class.
		 *		$this->updateImage($imageArray);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name updateImage
		 * @access Public
		 * @param array $imageArray
		 */
		function updateImage($imageArray) {
			unset($imageObj);
			if ($this->image_id) {
				$imageobj = new Image($this->image_id);
				if ($imageobj) $imageobj->delete();
			}
			$this->image_id = $imageArray["image_id"];
			unset($imageObj);
			if ($this->thumb_id) {
				$imageObj = new Image($this->thumb_id);
				if ($imageObj) $imageObj->delete();
			}
			$this->thumb_id = $imageArray["thumb_id"];
			unset($imageObj);
		}
		
		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$classifiedObj->getCategories();
		 * <br /><br />
		 *		//Using this in Classified() class.
		 *		$this->getCategories();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getCategories
		 * @access Public
		 * @return array
		 */
		function getCategories() {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
			$sql = "SELECT cat_1_id, cat_2_id, cat_3_id, cat_4_id, cat_5_id FROM Classified WHERE id = $this->id";
			$r = $dbObj->query($sql);
			while ($row = mysql_fetch_array($r)) {
				if ($row["cat_1_id"]) $categories[] = new ClassifiedCategory($row["cat_1_id"]);
				if ($row["cat_2_id"]) $categories[] = new ClassifiedCategory($row["cat_2_id"]);
				if ($row["cat_3_id"]) $categories[] = new ClassifiedCategory($row["cat_3_id"]);
				if ($row["cat_4_id"]) $categories[] = new ClassifiedCategory($row["cat_4_id"]);
				if ($row["cat_5_id"]) $categories[] = new ClassifiedCategory($row["cat_5_id"]);
			}
			return $categories;
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$classifiedObj->setCategories();
		 * <br /><br />
		 *		//Using this in Classified() class.
		 *		$this->setCategories();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name setCategories
		 * @access Public
		 */
		function setCategories($array) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
			
			if ($this->status == "A") system_countActiveItemByCategory("classified", $this->id, "dec");

			$cat_1_id = 0;
			$parcat_1_level1_id = 0;
			$parcat_1_level2_id = 0;
			$parcat_1_level3_id = 0;
			$parcat_1_level4_id = 0;
			$cat_2_id = 0;
			$parcat_2_level1_id = 0;
			$parcat_2_level2_id = 0;
			$parcat_2_level3_id = 0;
			$parcat_2_level4_id = 0;
			$cat_3_id = 0;
			$parcat_3_level1_id = 0;
			$parcat_3_level2_id = 0;
			$parcat_3_level3_id = 0;
			$parcat_3_level4_id = 0;
			$cat_4_id = 0;
			$parcat_4_level1_id = 0;
			$parcat_4_level2_id = 0;
			$parcat_4_level3_id = 0;
			$parcat_4_level4_id = 0;
			$cat_5_id = 0;
			$parcat_5_level1_id = 0;
			$parcat_5_level2_id = 0;
			$parcat_5_level3_id = 0;
			$parcat_5_level4_id = 0;
			if ($array) {
				$count_category_aux = 1;
				foreach ($array as $category) {
					if ($category) {
						unset($parents);
						$cat_id = $category;
						$i = 0;
						while ($cat_id != 0) {
							$sql = "SELECT * FROM ClassifiedCategory WHERE id = $cat_id";
							$rs1 = $dbObj->query($sql);
							if (mysql_num_rows($rs1) > 0) {
								$cat_info = mysql_fetch_assoc($rs1);
								$cat_id = $cat_info["category_id"];
								$parents[$i++] = $cat_id;
							} else {
								$cat_id = 0;
							}
						}
						for ($j=count($parents)-1; $j < 4; $j++) { $parents[$j] = 0; }
						${"cat_".$count_category_aux."_id"} = $category;
						${"parcat_".$count_category_aux."_level1_id"} = $parents[0];
						${"parcat_".$count_category_aux."_level2_id"} = $parents[1];
						${"parcat_".$count_category_aux."_level3_id"} = $parents[2];
						${"parcat_".$count_category_aux."_level4_id"} = $parents[3];
						$count_category_aux++;
					}
				}
			}
			$sql = "UPDATE Classified SET cat_1_id = ".$cat_1_id.", parcat_1_level1_id = ".$parcat_1_level1_id.", parcat_1_level2_id = ".$parcat_1_level2_id.", parcat_1_level3_id = ".$parcat_1_level3_id.", parcat_1_level4_id = ".$parcat_1_level4_id.", cat_2_id = ".$cat_2_id.", parcat_2_level1_id = ".$parcat_2_level1_id.", parcat_2_level2_id = ".$parcat_2_level2_id.", parcat_2_level3_id = ".$parcat_2_level3_id.", parcat_2_level4_id = ".$parcat_2_level4_id.", cat_3_id = ".$cat_3_id.", parcat_3_level1_id = ".$parcat_3_level1_id.", parcat_3_level2_id = ".$parcat_3_level2_id.", parcat_3_level3_id = ".$parcat_3_level3_id.", parcat_3_level4_id = ".$parcat_3_level4_id.", cat_4_id = ".$cat_4_id.", parcat_4_level1_id = ".$parcat_4_level1_id.", parcat_4_level2_id = ".$parcat_4_level2_id.", parcat_4_level3_id = ".$parcat_4_level3_id.", parcat_4_level4_id = ".$parcat_4_level4_id.", cat_5_id = ".$cat_5_id.", parcat_5_level1_id = ".$parcat_5_level1_id.", parcat_5_level2_id = ".$parcat_5_level2_id.", parcat_5_level3_id = ".$parcat_5_level3_id.", parcat_5_level4_id = ".$parcat_5_level4_id." WHERE id = $this->id";
			$dbObj->query($sql);
			$this->setFullTextSearch();

			if ($this->status == "A") system_countActiveItemByCategory("classified", $this->id, "inc");
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$classifiedObj->getCategories();
		 * <br /><br />
		 *		//Using this in Classified() class.
		 *		$this->getCategories();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getCategories
		 * @access Public
		 * @return real
		 */
		function getPrice() {

			$price = 0;

			$dbMain = db_getDBObject(DEFAULT_DB, true);

			if ($this->domain_id){
				$dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
			}else if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);

			$levelObj = new ClassifiedLevel();
			if($this->package_id){
				$price = $this->package_price;
			}else{
				$price = $price + $levelObj->getPrice($this->level);
			}

			if ($this->discount_id) {

				$discountCodeObj = new DiscountCode($this->discount_id);

				if (is_valid_discount_code($this->discount_id, "classified", $this->id, $discount_message, $discount_error)) {

					if ($discountCodeObj->getString("id") && $discountCodeObj->expire_date >= date('Y-m-d')) {

						if ($discountCodeObj->getString("type") == "percentage") {
							$price = $price * (1 - $discountCodeObj->getString("amount")/100);
						} elseif ($discountCodeObj->getString("type") == "monetary value") {
							$price = $price - $discountCodeObj->getString("amount");
						}

					} elseif ( ($discountCodeObj->type == 'percentage' && $discountCodeObj->amount == '100.00') || ($discountCodeObj->type == 'monetary value' && $discountCodeObj->amount > $price) ) {
                        $this->status = 'E';
                        $this->renewal_date = $discountCodeObj->expire_date;

						$sql = "UPDATE Classified SET status = 'E', renewal_date = '".$discountCodeObj->expire_date."', discount_id = '' WHERE id = ".$this->id;
                        $result = $dbObj->query($sql);
                    }

				} else {

					if ( ($discountCodeObj->type == 'percentage' && $discountCodeObj->amount == '100.00') || ($discountCodeObj->type == 'monetary value' && $discountCodeObj->amount > $price) ) {
                        $this->status = 'E';
                        $this->renewal_date = $discountCodeObj->expire_date;
                        $sql = "UPDATE Classified SET status = 'E', renewal_date = '".$discountCodeObj->expire_date."', discount_id = '' WHERE id = ".$this->id;
					} else {
						$sql = "UPDATE Classified SET discount_id = '' WHERE id = ".$this->id;
					}
                    $result = $dbObj->query($sql);

				}

			}

			if ($price <= 0) $price = 0;

			return $price;

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$classifiedObj->hasRenewalDate();
		 * <br /><br />
		 *		//Using this in Classified() class.
		 *		$this->hasRenewalDate();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name hasRenewalDate
		 * @access Public
		 * @return boolean
		 */
		function hasRenewalDate() {
			if (PAYMENT_FEATURE != "on") return false;
			if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on") && (MANUALPAYMENT_FEATURE != "on")) return false;
			if ($this->getPrice() <= 0) return false;
			return true;
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$classifiedObj->needToCheckOut();
		 * <br /><br />
		 *		//Using this in Classified() class.
		 *		$this->needToCheckOut();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name needToCheckOut
		 * @access Public
		 * @return boolean
		 */
		function needToCheckOut() {

			if ($this->hasRenewalDate()) {

				$today = date("Y-m-d");
				$today = explode("-", $today);
				$today_year = $today[0];
				$today_month = $today[1];
				$today_day = $today[2];
				$timestamp_today = mktime(0, 0, 0, $today_month, $today_day, $today_year);

				$this_renewaldate = $this->renewal_date;
				$renewaldate = explode("-", $this_renewaldate);
				$renewaldate_year = $renewaldate[0];
				$renewaldate_month = $renewaldate[1];
				$renewaldate_day = $renewaldate[2];
				$timestamp_renewaldate = mktime(0, 0, 0, $renewaldate_month, $renewaldate_day, $renewaldate_year);

				if (($this->status == "E") || ($this_renewaldate == "0000-00-00") || ($timestamp_today > $timestamp_renewaldate)) {
					return true;
				}

			}

			return false;

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$classifiedObj->getNextRenewalDate($times);
		 * <br /><br />
		 *		//Using this in Classified() class.
		 *		$this->getNextRenewalDate($times);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getNextRenewalDate
		 * @access Public
		 * @param integer $times
		 * @return date
		 */
		function getNextRenewalDate($times = 1) {

			$nextrenewaldate = "0000-00-00";

			if ($this->hasRenewalDate()) {

				if ($this->needToCheckOut()) {

					$today = date("Y-m-d");
					$today = explode("-", $today);
					$start_year = $today[0];
					$start_month = $today[1];
					$start_day = $today[2];

				} else {

					$this_renewaldate = $this->renewal_date;
					$renewaldate = explode("-", $this_renewaldate);
					$start_year = $renewaldate[0];
					$start_month = $renewaldate[1];
					$start_day = $renewaldate[2];

				}

				$renewalcycle = payment_getRenewalCycle("classified");
				$renewalunit = payment_getRenewalUnit("classified");

				if ($renewalunit == "Y") {
					$nextrenewaldate = date("Y-m-d", mktime(0, 0, 0, (int)$start_month, (int)$start_day, (int)$start_year+($renewalcycle*$times)));
				} elseif ($renewalunit == "M") {
					$nextrenewaldate = date("Y-m-d", mktime(0, 0, 0, (int)$start_month+($renewalcycle*$times), (int)$start_day, (int)$start_year));
				} elseif ($renewalunit == "D") {
					$nextrenewaldate = date("Y-m-d", mktime(0, 0, 0, (int)$start_month, (int)$start_day+($renewalcycle*$times), (int)$start_year));
				}

			}

			return $nextrenewaldate;

		}

		/**
		 * <code>
		 *		//Using this in Classified() class.
		 *		$this->setLocationManager(&$locationManager);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name setLocationManager
		 * @access Public
		 * @param string $locationManager
		 */
		function setLocationManager(&$locationManager){
			$this->locationManager =& $locationManager;
		}

		/**
		 * <code>
		 *		//Using this in Classified() class.
		 *		$this->getLocationManager();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getLocationManager
		 * @access Public
		 * @return array
		 */
		function &getLocationManager(){
			return $this->locationManager; /* NEVER auto-instantiate this*/
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$classifiedObj->getLocationString($format,$forceManagerCreation);
		 * <br /><br />
		 *		//Using this in Classified() class.
		 *		$this->getLocationString();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getLocationString
		 * @access Public
		 * @param string $format, boolean $forceManagerCreation
		 * @return array
		 */
		function getLocationString($format, $forceManagerCreation = false){
			if($forceManagerCreation && !$this->locationManager) $this->locationManager = new LocationManager();
			return db_getLocationString($this, $format);
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$classifiedObj->setFullTextSearch();
		 * <br /><br />
		 *		//Using this in Classified() class.
		 *		$this->setFullTextSearch();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name setFullTextSearch
		 * @access Public
		 */
		function setFullTextSearch() {

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);

			if ($this->title) {
				$string=str_replace(" || ", " ", $this->title);
                $fulltextsearch_keyword[] = $string;
                $addkeyword=format_addApostWords($string);
                if ($addkeyword!='')  $fulltextsearch_keyword[] =$addkeyword;
                unset($addkeyword);
			}
            
            $edir_languages = explode(",", EDIR_LANGUAGENUMBERS);
             
             foreach($edir_languages as $lang_index){
                if ($this->{"keywords".$lang_index}) {
                    $string=str_replace(" || ", " ", $this->{"keywords".$lang_index});
                    $fulltextsearch_keyword[] = $string;
                    $addkeyword=format_addApostWords($string);
                    if ($addkeyword!='')  $fulltextsearch_keyword[] =$addkeyword;
                    unset($addkeyword);
                }
                
                if ($this->{"summarydesc".$lang_index}) {
                    $fulltextsearch_keyword[] = string_substr($this->{"summarydesc".$lang_index}, 0, 100);
                }

            }

			if ($this->address) {
				$fulltextsearch_where[] = $this->address;
			}

			if ($this->zip_code) {
				$fulltextsearch_where[] = $this->zip_code;
			}

			$_locations = explode(",", EDIR_LOCATIONS);
			foreach ($_locations as $each_location) {
				unset ($objLocation);
				$objLocationLabel = "Location".$each_location;
				$attributeLocation = 'location_'.$each_location;
				$objLocation = new $objLocationLabel;
				$objLocation->SetString("id", $this->$attributeLocation);
				$locationsInfo = $objLocation->retrieveLocationById();
				if ($locationsInfo["id"]) {
					$fulltextsearch_where[] = $locationsInfo["name"];
					if ($locationsInfo["abbreviation"]) {
						$fulltextsearch_where[] = $locationsInfo["abbreviation"];
					}
				}
			}

			$categories = $this->getCategories();
			if ($categories) {
				foreach ($categories as $category) {
					unset($parents);
					$category_id = $category->getNumber("id");
					while ($category_id != 0) {
						$sql = "SELECT * FROM ClassifiedCategory WHERE id = $category_id";
						$result = $dbObj->query($sql);
						if (mysql_num_rows($result) > 0) {
							$category_info = mysql_fetch_assoc($result);
							$langs = explode(",", $category_info["lang"]);
                            if (is_array($langs) && $langs[0]){
                                $langObj = new Lang();
                                foreach($langs as $lang){
                                    if ($lang){
                                        $lang_id = $langObj->returnLangId($lang); 

                                        if ($category_info["enabled"] == "y") {
                                            if ($category_info["title".$lang_id]) {
                                                $fulltextsearch_keyword[] = $category_info["title".$lang_id];
                                            }

                                            if ($category_info["keywords".$lang_id]) {
                                                $fulltextsearch_keyword[] = $category_info["keywords".$lang_id];
                                            }
                                        }
                                    } 
                                } 
                            }
							$category_id = $category_info["category_id"];
						} else {
							$category_id = 0;
						}
					}
				}
			}

			if (is_array($fulltextsearch_keyword)) {
				$fulltextsearch_keyword_sql = db_formatString(implode(" ", $fulltextsearch_keyword));
				$sql = "UPDATE Classified SET fulltextsearch_keyword = $fulltextsearch_keyword_sql WHERE id = $this->id";
				$result = $dbObj->query($sql);
			}
			if (is_array($fulltextsearch_where)) {
				$fulltextsearch_where_sql = db_formatString(implode(" ", $fulltextsearch_where));
				$sql = "UPDATE Classified SET fulltextsearch_where = $fulltextsearch_where_sql WHERE id = $this->id";
				$result = $dbObj->query($sql);
			}

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$classifiedObj->getGalleries();
		 * <br /><br />
		 *		//Using this in Classified() class.
		 *		$this->getGalleries();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getGalleries
		 * @access Public
		 * @return array
		 */
		function getGalleries() {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
			$sql = "SELECT * FROM Gallery_Item WHERE item_type='classified' AND item_id = $this->id ORDER BY gallery_id";
			$r = $dbObj->query($sql);
			if ($this->id > 0) while ($row = mysql_fetch_array($r)) $galleries[] = $row["gallery_id"];
			return $galleries;
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$classifiedObj->setGalleries($gallery);
		 * <br /><br />
		 *		//Using this in Classified() class.
		 *		$this->setGalleries($gallery);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name setGalleries
		 * @access Public
		 * @param integer $gallery
		 */
		function setGalleries($gallery = false) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
			$sql = "DELETE FROM Gallery_Item WHERE item_type='classified' AND item_id = $this->id";
			$dbObj->query($sql);
				if ($gallery) {
					$sql = "INSERT INTO Gallery_Item (item_id, gallery_id, item_type) VALUES ($this->id, $gallery, 'classified')";
					$rs3 = $dbObj->query($sql);
				}
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$classifiedObj->setMapTuning($latitude_longitude,$map_zoom);
		 * <br /><br />
		 *		//Using this in Classified() class.
		 *		$this->setMapTuning($gallery);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name setMapTuning
		 * @access Public
		 * @param string $latitude_longitude, integer $map_zoom
		 */
		function setMapTuning($latitude_longitude="",$map_zoom) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
            
            $auxCoord = explode(",", $latitude_longitude);
            $latitude = $auxCoord[0];
            $longitude = $auxCoord[1];
            
			$sql = "UPDATE Classified SET latitude = ".db_formatString($latitude).", longitude = ".db_formatString($longitude).", map_zoom = ".db_formatNumber($map_zoom)." WHERE id = ".$this->id."";
			$dbObj->query($sql);
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$classifiedObj->hasDetail();
		 * <br /><br />
		 *		//Using this in Classified() class.
		 *		$this->hasDetail();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name hasDetail
		 * @access Public
		 * @return char
		 */
        function hasDetail() {
            $classifiedLevel = new ClassifiedLevel();
            $detail = $classifiedLevel->getDetail($this->level);
            unset($classifiedLevel);
            return $detail;
        }

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$classifiedObj->setNumberViews($id);
		 * <br /><br />
		 *		//Using this in Classified() class.
		 *		$this->setNumberViews($id);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name setNumberViews
		 * @access Public
		 * @param integer $id
		 */
		function setNumberViews($id) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
			$sql = "UPDATE Classified SET number_views = ".$this->number_views." + 1 WHERE Classified.id = ".$id;
			$dbObj->query($sql);

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$classifiedObj->deletePerAccount($account_id);
		 * <br /><br />
		 *		//Using this in Classified() class.
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
				$sql = "SELECT * FROM Classified WHERE account_id = $account_id";
				$result = $dbObj->query($sql);
				while ($row = mysql_fetch_array($result)) {
					$this->makeFromRow($row);
					$this->Delete($domain_id);
				}
			}
		}
		
		function getFriendlyURL($mobile = false){
        	if($mobile){
        		$aux_url = DEFAULT_URL."/mobile/".CLASSIFIED_FEATURE_FOLDER;
        	}else{
        		$aux_url = CLASSIFIED_DEFAULT_URL;
        	}
        
        	if(MODREWRITE_FEATURE == "on"){
	        	return $aux_url."/".$this->friendly_url.".html";
        	}else{
        		return $aux_url."/detail.php?id=".$this->id;
        	}
		}
	}
?>
