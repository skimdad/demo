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
	# * FILE: /classes/class_Promotion.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$promotionObj = new Promotion($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name Promotion
	 * @method Promotion
	 * @method makeFromRow
	 * @method Save
	 * @method Delete
	 * @method updateImage
	 * @method setFullTextSearch
	 * @method setNumberViews
	 * @method deletePerAccount
	 * @method setPromoCode
	 * @method findByFriendlyURL
	 * @method getDealsFromUser
	 * @method getDealInfo
	 * @method setAvgReview
	 * @method alreadyRedeemed
	 * @method getTagLine
	 * @method cleanup
	 * @method autoSetListing
	 * @method getFriendlyURL
	 * @method setListingId
	 * @method unLinkListingID
	 * @access Public
	 */

	class Promotion extends Handle {

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
		var $image_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $thumb_id;
		/**
		 * @var date
		 * @access Private
		 */
		var $updated;
		/**
		 * @var date
		 * @access Private
		 */
		var $entered;
		/**
		 * @var string
		 * @access Private
		 */
		var $name;
		/**
		 * @var string
		 * @access Private
		 */
		var $seo_name;
		/**
		 * @var string
		 * @access Private
		 */
		var $description1;
		/**
		 * @var string
		 * @access Private
		 */
		var $description2;
		/**
		 * @var string
		 * @access Private
		 */
		var $description3;
		/**
		 * @var string
		 * @access Private
		 */
		var $description4;
		/**
		 * @var string
		 * @access Private
		 */
		var $description5;
		/**
		 * @var string
		 * @access Private
		 */
		var $description6;
		/**
		 * @var string
		 * @access Private
		 */
		var $description7;
		/**
		 * @var string
		 * @access Private
		 */
		var $long_description1;
		/**
		 * @var string
		 * @access Private
		 */
		var $long_description2;
		/**
		 * @var string
		 * @access Private
		 */
		var $long_description3;
		/**
		 * @var string
		 * @access Private
		 */
		var $long_description4;
		/**
		 * @var string
		 * @access Private
		 */
		var $long_description5;
		/**
		 * @var string
		 * @access Private
		 */
		var $long_description6;
		/**
		 * @var string
		 * @access Private
		 */
		var $long_description7;
		/**
		 * @var string
		 * @access Private
		 */
		var $seo_description1;
		/**
		 * @var string
		 * @access Private
		 */
		var $seo_description2;
		/**
		 * @var string
		 * @access Private
		 */
		var $seo_description3;
		/**
		 * @var string
		 * @access Private
		 */
		var $seo_description4;
		/**
		 * @var string
		 * @access Private
		 */
		var $seo_description5;
		/**
		 * @var string
		 * @access Private
		 */
		var $seo_description6;
		/**
		 * @var string
		 * @access Private
		 */
		var $seo_description7;
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
		 * @var date
		 * @access Private
		 */
		var $start_date;
		/**
		 * @var date
		 * @access Private
		 */
		var $end_date;
		/**
		 * @var string
		 * @access Private
		 */
		var $conditions1;
		/**
		 * @var string
		 * @access Private
		 */
		var $conditions2;
		/**
		 * @var string
		 * @access Private
		 */
		var $conditions3;
		/**
		 * @var string
		 * @access Private
		 */
		var $conditions4;
		/**
		 * @var string
		 * @access Private
		 */
		var $conditions5;
		/**
		 * @var string
		 * @access Private
		 */
		var $conditions6;
		/**
		 * @var string
		 * @access Private
		 */
		var $conditions7;
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
		 * @var string
		 * @access Private
		 */
		var $visibility_start;
		/**
		 * @var string
		 * @access Private
		 */
		var $visibility_end;
		/**
		 * @var real
		 * @access Private
		 */
		var $realvalue;
		/**
		 * @var real
		 * @access Private
		 */
		var $dealvalue;
		/**
		 * @var string
		 * @access Private
		 */
		var $deal_type;
		/**
		 * @var integer
		 * @access Private
		 */
		var $amount;
		/**
		 * @var string
		 * @access Private
		 */
		var $friendly_url;
		/**
		 * @var int
		 * @access Private
		 */
		var $listing_id;
		/**
		 * @var char
		 * @access Private
		 */
		var $listing_status;
		/**
		 * @var string
		 * @access Private
		 */
		var $listing_level;
		/**
		 * @var string
		 * @access Private
		 */
        var $listing_location_1;
        /**
		 * @var int
		 * @access Private
		 */
        var $listing_location_2;
        /**
		 * @var int
		 * @access Private
		 */
        var $listing_location_3;
        /**
		 * @var int
		 * @access Private
		 */
        var $listing_location_4;
        /**
		 * @var int
		 * @access Private
		 */
        var $listing_location_5;
        /**
		 * @var int
		 * @access Private
		 */
        var $listing_address;
        /**
		 * @var string
		 * @access Private
		 */
        var $listing_address2;
        /**
		 * @var string
		 * @access Private
		 */
        var $listing_zipcode;
        /**
		 * @var string
		 * @access Private
		 */
        var $listing_zip5;
        /**
		 * @var string
		 * @access Private
		 */
        var $listing_latitude;
        /**
		 * @var string
		 * @access Private
		 */
        var $listing_longitude;
		/**
		 * @var string
		 * @access Private
		 */


		/**
		 * <code>
		 *		$promotionObj = new Promotion($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Promotion
		 * @access Public
		 * @param integer $var
		 */
		function Promotion($var='') {
			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT * FROM Promotion WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));

				$this->old_account_id = $row["account_id"];

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

			if ($row["id"]) $this->id = $row["id"];
			else if (!$this->id) $this->id = 0;

			$this->account_id   = ($row["account_id"])	? $row["account_id"]	: 0;

			if ($row["image_id"]) $this->image_id = $row["image_id"];
			else if (!$this->image_id) $this->image_id = 0;
			if ($row["thumb_id"]) $this->thumb_id = $row["thumb_id"];
			else if (!$this->thumb_id) $this->thumb_id = 0;
			if ($row["updated"]) $this->updated = $row["updated"];
			else if (!$this->updated) $this->updated = 0;
			if ($row["entered"]) $this->entered = $row["entered"];
			else if (!$this->entered) $this->entered = 0;

			$this->name         = ($row["name"])		? $row["name"]		: ($this->name		? $this->name		: "");
			$this->seo_name     = ($row["seo_name"])	? $row["seo_name"]	: ($this->seo_name	? $this->seo_name	: "");

			$this->description1 = $row["description1"];
			$this->description2 = $row["description2"];
			$this->description3 = $row["description3"];
			$this->description4 = $row["description4"];
			$this->description5 = $row["description5"];
			$this->description6 = $row["description6"];
			$this->description7 = $row["description7"];

			$this->long_description1 = $row["long_description1"];
			$this->long_description2 = $row["long_description2"];
			$this->long_description3 = $row["long_description3"];
			$this->long_description4 = $row["long_description4"];
			$this->long_description5 = $row["long_description5"];
			$this->long_description6 = $row["long_description6"];
			$this->long_description7 = $row["long_description7"];

			$this->seo_description1	= ($row["seo_description1"])	? $row["seo_description1"]	: ($this->seo_description1	? $this->seo_description1	: "");
			$this->seo_description2	= ($row["seo_description2"])	? $row["seo_description2"]	: ($this->seo_description2	? $this->seo_description2	: "");
			$this->seo_description3	= ($row["seo_description3"])	? $row["seo_description3"]	: ($this->seo_description3	? $this->seo_description3	: "");
			$this->seo_description4	= ($row["seo_description4"])	? $row["seo_description4"]	: ($this->seo_description4	? $this->seo_description4	: "");
			$this->seo_description5	= ($row["seo_description5"])	? $row["seo_description5"]	: ($this->seo_description5	? $this->seo_description5	: "");
			$this->seo_description6	= ($row["seo_description6"])	? $row["seo_description6"]	: ($this->seo_description6	? $this->seo_description6	: "");
			$this->seo_description7	= ($row["seo_description7"])	? $row["seo_description7"]	: ($this->seo_description7	? $this->seo_description7	: "");

			$this->keywords1 = $row["keywords1"];
			$this->keywords2 = $row["keywords2"];
			$this->keywords3 = $row["keywords3"];
			$this->keywords4 = $row["keywords4"];
			$this->keywords5 = $row["keywords5"];
			$this->keywords6 = $row["keywords6"];
			$this->keywords7 = $row["keywords7"];

			$this->seo_keywords1	= ($row["seo_keywords1"])	? $row["seo_keywords1"]	: ($this->seo_keywords1	? $this->seo_keywords1	: "");
			$this->seo_keywords2	= ($row["seo_keywords2"])	? $row["seo_keywords2"]	: ($this->seo_keywords2	? $this->seo_keywords2	: "");
			$this->seo_keywords3	= ($row["seo_keywords3"])	? $row["seo_keywords3"]	: ($this->seo_keywords3	? $this->seo_keywords3	: "");
			$this->seo_keywords4	= ($row["seo_keywords4"])	? $row["seo_keywords4"]	: ($this->seo_keywords4	? $this->seo_keywords4	: "");
			$this->seo_keywords5	= ($row["seo_keywords5"])	? $row["seo_keywords5"]	: ($this->seo_keywords5	? $this->seo_keywords5	: "");
			$this->seo_keywords6	= ($row["seo_keywords6"])	? $row["seo_keywords6"]	: ($this->seo_keywords6	? $this->seo_keywords6	: "");
			$this->seo_keywords7	= ($row["seo_keywords7"])	? $row["seo_keywords7"]	: ($this->seo_keywords7	? $this->seo_keywords7	: "");

			$this->conditions1 = $row["conditions1"];
			$this->conditions2 = $row["conditions2"];
			$this->conditions3 = $row["conditions3"];
			$this->conditions4 = $row["conditions4"];
			$this->conditions5 = $row["conditions5"];
			$this->conditions6 = $row["conditions6"];
			$this->conditions7 = $row["conditions7"];

			$this->number_views		= ($row["number_views"])		? $row["number_views"]		: ($this->number_views			? $this->number_views	: 0);

			$this->setDate("start_date", $row["start_date"]);
			$this->setDate("end_date", $row["end_date"]);

			$this->visibility_start		= ($row["visibility_start"])	? $row["visibility_start"]      : ($this->visibility_start	? $this->visibility_start	: 0);
			$this->visibility_end		= ($row["visibility_end"])      ? $row["visibility_end"]        : ($this->visibility_end	? $this->visibility_end     : 0);
			$this->realvalue            = ($row["realvalue"])           ? $row["realvalue"]             : ($this->realvalue         ? $this->realvalue          : 0);
			$this->dealvalue            = $row["dealvalue"];
			$this->deal_type            = ($row["deal_type"])           ? $row["deal_type"]             : ($this->deal_type         ? $this->deal_type          : "monetary value");
			$this->amount               = ($row["amount"])              ? $row["amount"]                : ($this->amount            ? $this->amount             : 0);
			$this->friendly_url         = ($row["friendly_url"])        ? $row["friendly_url"]          : ($this->friendly_url      ? $this->friendly_url       : "");
			$this->avg_review           = ($row["avg_review"])          ? $row["avg_review"]            : ($this->avg_review        ? $this->avg_review         : 0);

			$this->listing_id           = ($row["listing_id"])          ? $row["listing_id"]            : ($this->listing_id        ? $this->listing_id         : 0);
			$this->listing_status       = ($row["listing_status"])      ? $row["listing_status"]        : ($this->listing_status	? $this->listing_status     : "");
			$this->listing_level        = ($row["listing_level"])       ? $row["listing_level"]         : ($this->listing_level     ? $this->listing_level      : 0);
            $this->listing_location_1   = ($row["listing_location_1"])  ? $row["listing_location_1"]    : ($this->listing_location_1        ? $this->listing_location_1     : 0);
			$this->listing_location_2   = ($row["listing_location_2"])  ? $row["listing_location_2"]    : ($this->listing_location_2        ? $this->listing_location_2     : 0);
			$this->listing_location_3   = ($row["listing_location_3"])  ? $row["listing_location_3"]    : ($this->listing_location_3        ? $this->listing_location_3     : 0);
			$this->listing_location_4   = ($row["listing_location_4"])  ? $row["listing_location_4"]    : ($this->listing_location_4        ? $this->listing_location_4     : 0);
			$this->listing_location_5   = ($row["listing_location_5"])  ? $row["listing_location_5"]    : ($this->listing_location_5        ? $this->listing_location_5     : 0);
            $this->listing_address      = ($row["listing_address"])     ? $row["listing_address"]       : ($this->listing_address           ? $this->listing_address        : "");
			$this->listing_address2     = ($row["listing_address2"])    ? $row["listing_address2"]      : ($this->listing_address2          ? $this->listing_address2       : "");
			$this->listing_zipcode      = ($row["listing_zipcode"])     ? $row["listing_zipcode"]       : ($this->listing_zipcode           ? $this->listing_zipcode        : "");
			$this->listing_zip5         = ($row["listing_zip5"])        ? $row["listing_zip5"]          : ($this->listing_zip5              ? $this->listing_zip5           : "0");
			$this->listing_latitude     = ($row["listing_latitude"])    ? $row["listing_latitude"]      : ($this->listing_latitude          ? $this->listing_latitude       : "");
			$this->listing_longitude    = ($row["listing_longitude"])   ? $row["listing_longitude"]     : ($this->listing_longitude         ? $this->listing_longitude      : "");
			
			$this->data_in_array = $row;
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$promotionObj->Save();
		 * <br /><br />
		 *		//Using this in Promotion() class.
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

			$aux_old_account = str_replace("'", "", $this->old_account_id);
			$aux_account = str_replace("'", "", $this->account_id);

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
                $dbObj = db_getDBObject();
			}
			unset($dbMain);
			if ($this->id) {
				$sql  = "UPDATE Promotion SET"
					. " account_id = $this->account_id,"
					. " image_id = $this->image_id,"
					. " thumb_id = $this->thumb_id,"
					. " updated = NOW(),"
					. " name = $this->name,"
					. " seo_name = $this->seo_name,"
					. " description1 = $this->description1,"
					. " description2 = $this->description2,"
					. " description3 = $this->description3,"
					. " description4 = $this->description4,"
					. " description5 = $this->description5,"
					. " description6 = $this->description6,"
					. " description7 = $this->description7,"
					. " long_description1 = $this->long_description1,"
					. " long_description2 = $this->long_description2,"
					. " long_description3 = $this->long_description3,"
					. " long_description4 = $this->long_description4,"
					. " long_description5 = $this->long_description5,"
					. " long_description6 = $this->long_description6,"
					. " long_description7 = $this->long_description7,"
					. " seo_description1 = $this->seo_description1,"
					. " seo_description2 = $this->seo_description2,"
					. " seo_description3 = $this->seo_description3,"
					. " seo_description4 = $this->seo_description4,"
					. " seo_description5 = $this->seo_description5,"
					. " seo_description3 = $this->seo_description6,"
					. " seo_description7 = $this->seo_description7,"
					. " keywords1 = $this->keywords1,"
					. " keywords2 = $this->keywords2,"
					. " keywords3 = $this->keywords3,"
					. " keywords4 = $this->keywords4,"
					. " keywords5 = $this->keywords5,"
					. " keywords6 = $this->keywords6,"
					. " keywords7 = $this->keywords7,"
					. " seo_keywords1 = $this->seo_keywords1,"
					. " seo_keywords2 = $this->seo_keywords2,"
					. " seo_keywords3 = $this->seo_keywords3,"
					. " seo_keywords4 = $this->seo_keywords4,"
					. " seo_keywords5 = $this->seo_keywords5,"
					. " seo_keywords6 = $this->seo_keywords6,"
					. " seo_keywords7 = $this->seo_keywords7,"
					. " conditions1 = $this->conditions1,"
					. " conditions2 = $this->conditions2,"
					. " conditions3 = $this->conditions3,"
					. " conditions4 = $this->conditions4,"
					. " conditions5 = $this->conditions5,"
					. " conditions5 = $this->conditions6,"
					. " conditions7 = $this->conditions7,"
					. " number_views = $this->number_views,"
					. " start_date = $this->start_date,"
					. " end_date = $this->end_date,"
					. " visibility_start = $this->visibility_start,"
					. " visibility_end = $this->visibility_end,"
					. " realvalue = $this->realvalue,"
					. " dealvalue = $this->dealvalue,"
					. " deal_type = $this->deal_type,"
					. " amount = $this->amount,"
					. " friendly_url = $this->friendly_url,"
					. " avg_review = $this->avg_review,"
					. " listing_id = $this->listing_id,"
					. " listing_status = $this->listing_status,"
					. " listing_level = $this->listing_level,"
                    . " listing_location1 = $this->listing_location_1,"
                    . " listing_location2 = $this->listing_location_2,"
                    . " listing_location3 = $this->listing_location_3,"
                    . " listing_location4 = $this->listing_location_4,"
                    . " listing_location5 = $this->listing_location_5,"
                    . " listing_address = $this->listing_address,"
                    . " listing_address2 = $this->listing_address2,"
                    . " listing_zipcode = $this->listing_zipcode,"
                    . " listing_zip5 = $this->listing_zip5,"
                    . " listing_latitude = $this->listing_latitude,"
                    . " listing_longitude = $this->listing_longitude"
					. " WHERE id = $this->id";
                                
				$dbObj->query($sql);

				if ($aux_old_account != $aux_account && $aux_account != 0) {
					$accDomain = new Account_Domain($aux_account, SELECTED_DOMAIN_ID);
					$accDomain->Save();
					$accDomain->saveOnDomain($aux_account, $this);
				}

			} else {

				$sql = "INSERT INTO Promotion (
							account_id,
							image_id,
							thumb_id,
							updated,
							entered,
							name,
							seo_name,
							description1,
							description2,
							description3,
							description4,
							description5,
							description6,
							description7,
							long_description1,
							long_description2,
							long_description3,
							long_description4,
							long_description5,
							long_description6,
							long_description7,
							seo_description1,
							seo_description2,
							seo_description3,
							seo_description4,
							seo_description5,
							seo_description6,
							seo_description7,
							keywords1,
							keywords2,
							keywords3,
							keywords4,
							keywords5,
							keywords6,
							keywords7,
							seo_keywords1,
							seo_keywords2,
							seo_keywords3,
							seo_keywords4,
							seo_keywords5,
							seo_keywords6,
							seo_keywords7,
							fulltextsearch_keyword,
							fulltextsearch_where,
							conditions1,
							conditions2,
							conditions3,
							conditions4,
							conditions5,
							conditions6,
							conditions7,
							number_views,
							start_date,
							end_date,
							visibility_start,
							visibility_end ,
							realvalue ,
							dealvalue,
							deal_type,
							amount,
							friendly_url,
							avg_review,
							listing_id,
							listing_status,
							listing_level,
                            listing_location1,
                            listing_location2,
                            listing_location3,
                            listing_location4,
                            listing_location5,
                            listing_address,
                            listing_address2,
                            listing_zipcode,
                            listing_zip5,
                            listing_latitude,
                            listing_longitude
                            
						) VALUES (
							$this->account_id,
							$this->image_id,
							$this->thumb_id,
							NOW(),
							NOW(),
							$this->name,
							$this->name,
							$this->description1,
							$this->description2,
							$this->description3,
							$this->description4,
							$this->description5,
							$this->description6,
							$this->description7,
							$this->long_description1,
							$this->long_description2,
							$this->long_description3,
							$this->long_description4,
							$this->long_description5,
							$this->long_description6,
							$this->long_description7,
							$this->description1,
							$this->description2,
							$this->description3,
							$this->description4,
							$this->description5,
							$this->description6,
							$this->description7,
							$this->keywords1,
							$this->keywords2,
							$this->keywords3,
							$this->keywords4,
							$this->keywords5,
							$this->keywords6,
							$this->keywords7,
							".str_replace(" || ", ", ", $this->keywords1).",
							".str_replace(" || ", ", ", $this->keywords2).",
							".str_replace(" || ", ", ", $this->keywords3).",
							".str_replace(" || ", ", ", $this->keywords4).",
							".str_replace(" || ", ", ", $this->keywords5).",
							".str_replace(" || ", ", ", $this->keywords6).",
							".str_replace(" || ", ", ", $this->keywords7).",
							'',
							'',
							$this->conditions1,
							$this->conditions2,
							$this->conditions3,
							$this->conditions4,
							$this->conditions5,
							$this->conditions6,
							$this->conditions7,
							$this->number_views,
							$this->start_date,
							$this->end_date,
							$this->visibility_start,
							$this->visibility_end,
							$this->realvalue,
							$this->dealvalue,
							$this->deal_type,
							$this->amount,
							$this->friendly_url,
							$this->avg_review,
							$this->listing_id,
							$this->listing_status,   
							$this->listing_level,
                            $this->listing_location_1,
                            $this->listing_location_2,
                            $this->listing_location_3,
                            $this->listing_location_4,
                            $this->listing_location_5,
                            $this->listing_address,
                            $this->listing_address2,
                            $this->listing_zipcode,
                            $this->listing_zip5,
                            $this->listing_latitude,
                            $this->listing_longitude   
						)";
                $dbObj->query($sql);
                $this->id = mysql_insert_id($dbObj->link_id);

				if (sess_getAccountIdFromSession()){
					activity_newActivity(SELECTED_DOMAIN_ID, sess_getAccountIdFromSession(), 0, "newitem", "coupon", $this->name);
				}

				if ($aux_account != 0) {
					$accDomain = new Account_Domain($aux_account, SELECTED_DOMAIN_ID);
					$accDomain->Save();
					$accDomain->saveOnDomain($aux_account, $this);
				}
			}

			$this->prepareToUse();
			$this->setFullTextSearch();

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$promotionObj->Delete();
		 * <code>
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

			$sql = "DELETE FROM Promotion WHERE id = $this->id";
			$dbObj->query($sql);

			/*
			 * Need to do it to change table to front
			 */
			// Listing Cascade
			$sql = "UPDATE `Listing` SET `promotion_id` = 0 WHERE `promotion_id` = $this->id";
			$dbObj->query($sql);
			// the following code is added by Debiprasad on 11th Aug. 2012
			$sql = "UPDATE `Listing` SET `promotion_id_two` = 0 WHERE `promotion_id_two` = $this->id";
			$dbObj->query($sql);
			$sql = "UPDATE `Listing` SET `promotion_id_three` = 0 WHERE `promotion_id_three` = $this->id";
			$dbObj->query($sql);
			$sql = "UPDATE `Listing` SET `promotion_id_four` = 0 WHERE `promotion_id_four` = $this->id";
			$dbObj->query($sql);
			$sql = "UPDATE `Listing` SET `promotion_id_five` = 0 WHERE `promotion_id_five` = $this->id";
			$dbObj->query($sql);
			// end by Debiprasad
			// Listing_Summary Cascade
			$sql = "UPDATE `Listing_Summary` SET `promotion_id` = 0, promotion_start_date = '0000-00-00', promotion_end_date = '0000-00-00' WHERE `promotion_id` = $this->id";
			$dbObj->query($sql);
			// the following code is added by Debiprasad on 11th Aug. 2012
			$sql = "UPDATE `Listing_Summary` SET `promotion_id_two` = 0, promotion_start_date_two = '0000-00-00', promotion_end_date_two = '0000-00-00' WHERE `promotion_id_two` = $this->id";
			$dbObj->query($sql);
			$sql = "UPDATE `Listing_Summary` SET `promotion_id_three` = 0, promotion_start_date_three = '0000-00-00', promotion_end_date_three = '0000-00-00' WHERE `promotion_id_three` = $this->id";
			$dbObj->query($sql);
			$sql = "UPDATE `Listing_Summary` SET `promotion_id_four` = 0, promotion_start_date_four = '0000-00-00', promotion_end_date_four = '0000-00-00' WHERE `promotion_id_four` = $this->id";
			$dbObj->query($sql);
			$sql = "UPDATE `Listing_Summary` SET `promotion_id_five` = 0, promotion_start_date_five = '0000-00-00', promotion_end_date_five = '0000-00-00' WHERE `promotion_id_five` = $this->id";
			$dbObj->query($sql);
			// end by Debiprasad

			if ($this->image_id) {
				$image = new Image($this->image_id);
				if ($image) $image->Delete($domain_id);
			}
			if ($this->thumb_id) {
				$image = new Image($this->thumb_id);
				if ($image) $image->Delete($domain_id);
			}
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$promotionObj->updateImage($imageArray);
		 * <br /><br />
		 *		//Using this in Promotion() class.
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
		 *		$promotionObj->setFullTextSearch();
		 * <br /><br />
		 *		//Using this in Promotion() class.
		 *		$this->setFullTextSearch();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name setFullTextSearch
		 * @access Public
		 */
		function setFullTextSearch($secondDB = false) {

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
                $dbObj = db_getDBObject();
			}
			unset($dbMain);

			if ($this->name) {
                $string = str_replace(" || ", " ", $this->name);
                $fulltextsearch_keyword[] = $string;
                $addkeyword = format_addApostWords($string);
                if ($addkeyword != ''){  
                    $fulltextsearch_keyword[] = $addkeyword;

                }
                unset($addkeyword);
			}

			$edir_languages = explode(",", EDIR_LANGUAGENUMBERS);
                        
            /*
             * Get Listing title to add on fulltext search of Deals
             */
            if($this->listing_id){
                $sql_listing = "SELECT fulltextsearch_keyword FROM Listing WHERE id = ".$this->listing_id;
                $row_listing = mysql_fetch_assoc($dbObj->query($sql_listing));
                if ($row_listing["fulltextsearch_keyword"]){
                    $fulltextsearch_keyword[] = $row_listing["fulltextsearch_keyword"];
                }
            }

            foreach($edir_languages as $lang_index){
                if ($this->{"keywords".$lang_index}) {
                    $string=str_replace(" || ", " ", $this->{"keywords".$lang_index});
                    $fulltextsearch_keyword[] = $string;
                    $addkeyword=format_addApostWords($string);
                    if ($addkeyword != '') $fulltextsearch_keyword[] = $addkeyword;
                    unset($addkeyword);
                }

                if ($this->{"description".$lang_index}) {
                    $fulltextsearch_keyword[] = string_substr($this->{"description".$lang_index}, 0, 100);
                }
            }

			if (is_array($fulltextsearch_keyword)) {
				$fulltextsearch_keyword_sql = db_formatString(implode(" ", $fulltextsearch_keyword));
				$sql = "UPDATE Promotion SET fulltextsearch_keyword = $fulltextsearch_keyword_sql WHERE id = $this->id";
				$result = $dbObj->query($sql);
			}
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$promotionObj->setNumberViews($id);
		 * <br /><br />
		 *		//Using this in Promotion() class.
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
			$sql = "UPDATE Promotion SET number_views = ".$this->number_views." + 1 WHERE Promotion.id = ".$id;
			$dbObj->query($sql);

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$promotionObj->deletePerAccount($account_id);
		 * <br /><br />
		 *		//Using this in Promotion() class.
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
				$sql = "SELECT * FROM Promotion WHERE account_id = $account_id";
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
		 *		$promotionObj->setPromoCode($code, $used);
		 * <br /><br />
		 *		//Using this in Promotion() class.
		 *		$this->setPromoCode($code, $used);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name setPromoCode
		 * @access Public
		 * @param boolean $code
		 * @param boolean $used
		 */
		function setPromoCode($code = false, $used = false) {
			if (!$code) return false;

			$sql = "UPDATE Promotion_Redeem SET used = ".(int)$used." WHERE redeem_code = ".db_formatString($code);
			$dbObj = db_getDBObject(DEFAULT_DB, true);
            $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObj);
			$result = $dbDomain->query($sql);
			return true;
		}

        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$promotionObj->findByFriendlyURL($friendly_url);
		 * <br /><br />
		 *		//Using this in Promotion() class.
		 *		$this->findByFriendlyURL($friendly_url);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name findByFriendlyURL
		 * @access Public
		 * @param boolean $friendly_url
		 */
		function findByFriendlyURL($friendly_url = false){
			if (!$friendly_url) return false;

			$friendly_url = str_replace("htm",'',$friendly_url);
			$friendly_url = str_replace("html",'',$friendly_url);
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$sql = "SELECT id FROM Promotion WHERE friendly_url = ".db_formatString($friendly_url);

			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			$result = $dbObj->query($sql);
			$row = mysql_fetch_assoc($result);
			return ((int)$row["id"]);
		}

        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$promotionObj->getDealsFromUser($account_id);
		 * <br /><br />
		 *		//Using this in Promotion() class.
		 *		$this->getDealsFromUser($friendly_url);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getDealsFromUser
		 * @access Public
		 * @param boolean $account_id
		 */
		function getDealsFromUser($account_id = false){
			if (!$account_id) return false;
			$sql = "SELECT * FROM Promotion_Redeem WHERE account_id = $account_id ORDER BY datetime DESC";
			$dbMain = db_getDBObject(DEFAULT_DB, true);
            $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			$result = $dbDomain->query($sql);
			$res = false;
			while ($row = mysql_fetch_assoc($result)){
                $res[] = $row;
            }
			return $res;
		}

        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$promotionObj->getDealInfo($account_id);
		 * <br /><br />
		 *		//Using this in Promotion() class.
		 *		$this->getDealInfo($account_id);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getDealInfo
		 * @access Public
		 * @param boolean $account_id
		 */
		function getDealInfo($account_id = false){

			if (!$this->id) return false;

			$dbMain = db_getDBObject(DEFAULT_DB, true);
            $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            
			$sql = "SELECT account_id FROM Promotion_Redeem WHERE promotion_id = {$this->id}";
			$result = $dbDomain->query($sql);
			$totalSold = (int)mysql_num_rows($result);

			$info["sold"] = $totalSold;
			$info["left"] = $this->amount;
			$info["timeleft"] = explode("-", $this->end_date);

			if ($this->amount == 0){
				$info["doneByAmount"] = true;
            }

			$end_date_arr = explode("-", $this->end_date);
			if (  mktime(24,59,59, $end_date_arr[1], $end_date_arr[2], $end_date_arr[0])   <= mktime(date("H"),date("m"),date("i"),date("m"),date("d"),date("Y"))   ){
				$info["doneByendDate"] = true;
            }

			if ($account_id){
				$sql = "SELECT * FROM Promotion_Redeem WHERE promotion_id = {$this->id} AND account_id = $account_id";
				$result = $dbDomain->query($sql);
				$row = mysql_fetch_assoc($result);
				$info["account"] = $row;
			}

			return $info;
		}

         /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$promotionObj->setAvgReview($avg, $id);
		 * <br /><br />
		 *		//Using this in Promotion() class.
		 *		$this->setAvgReview($avg, $id);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name setAvgReview
		 * @access Public
		 * @param integer $avg
		 * @param integer $id
		 */
		function setAvgReview($avg, $id) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
			$sql = "UPDATE Promotion SET avg_review = ".$avg." WHERE id = ".$id;
			$dbObj->query($sql);

		}

        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$promotionObj->alreadyRedeemed($avg, $id);
		 * <br /><br />
		 *		//Using this in Promotion() class.
		 *		$this->alreadyRedeemed($avg, $id);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name alreadyRedeemed
		 * @access Public
		 * @param integer $promotion_id
		 */
        function alreadyRedeemed($promotion_id = false) {
            if (!$promotion_id) return false;
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            $sql = "SELECT redeem_code FROM Promotion_Redeem WHERE promotion_id = {$promotion_id} AND account_id = ".sess_getAccountIdFromSession();
            $result = $dbDomain->query($sql);
            $row = mysql_fetch_assoc($result);
            return $row["redeem_code"];
        }

        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$promotionObj->getTagLine($link);
		 * <br /><br />
		 *		//Using this in Promotion() class.
		 *		$this->getTagLine($link);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getTagLine
		 * @access Public
		 * @param integer $link
		 */
        function getTagLine($link = false){
            if (!$link){
                 if (MODREWRITE_FEATURE != "on"){
                    $link = DEFAULT_URL."/".PROMOTION_FEATURE_FOLDER."/detail.php?id=".$this->id;
                }else{
                    $link = DEFAULT_URL."/".PROMOTION_FEATURE_FOLDER."/".$this->getString("friendly_url").".html";
                }
            }

            $listing = db_getFromDB("listing", "promotion_id", db_formatNumber($this->id), 1, "", "object", SELECTED_DOMAIN_ID);
            if ($listing){
                $text = " ".system_showText(LANG_FROM)." ".$listing->getString("title")." ".system_showText(DEAL_AT).": ".$link;
            }
            return system_showText(DEAL_LIKEDTHIS).$text;
        }
        
        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$promotionObj->cleanup();
		 * <br /><br />
		 *		//Using this in Promotion() class.
		 *		$this->cleanup();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name cleanup
		 * @access Public
		 */
        function cleanup(){
            if (!$this->id) return false;
            $dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
            
            $this->listing_id = 0;
            $this->setFullTextSearch();
            
			$sql = "UPDATE Listing SET promotion_id = 0 WHERE promotion_id = {$this->id}";
			$dbObj->query($sql);
            
            // the following code is added by Debiprasad on 11th Aug., 2012
			$sql = "UPDATE Listing SET promotion_id_two = 0 WHERE promotion_id_two = {$this->id}";
			$dbObj->query($sql);

			$sql = "UPDATE Listing SET promotion_id_three = 0 WHERE promotion_id_three = {$this->id}";
			$dbObj->query($sql);

			$sql = "UPDATE Listing SET promotion_id_four = 0 WHERE promotion_id_four = {$this->id}";
			$dbObj->query($sql);

			$sql = "UPDATE Listing SET promotion_id_five = 0 WHERE promotion_id_five = {$this->id}";
			$dbObj->query($sql);
			// end of new code

            $sql = "UPDATE Listing_Summary SET promotion_id = 0, promotion_start_date = '0000-00-00', promotion_end_date = '0000-00-00' WHERE promotion_id = {$this->id}";
			$dbObj->query($sql);
            
            // the following code is added by Debiprasad on 11th Aug., 2012
            $sql = "UPDATE Listing_Summary SET promotion_id_two = 0, promotion_start_date_two = '0000-00-00', promotion_end_date_two = '0000-00-00' WHERE promotion_id_two = {$this->id}";
			$dbObj->query($sql);
            
            $sql = "UPDATE Listing_Summary SET promotion_id_three = 0, promotion_start_date_three = '0000-00-00', promotion_end_date_three = '0000-00-00' WHERE promotion_id_three = {$this->id}";
			$dbObj->query($sql);
            
            $sql = "UPDATE Listing_Summary SET promotion_id_four = 0, promotion_start_date_four = '0000-00-00', promotion_end_date_four = '0000-00-00' WHERE promotion_id_four = {$this->id}";
			$dbObj->query($sql);
            
            $sql = "UPDATE Listing_Summary SET promotion_id_five = 0, promotion_start_date_five = '0000-00-00', promotion_end_date_five = '0000-00-00' WHERE promotion_id_five = {$this->id}";
			$dbObj->query($sql);
			// end of new code
            
            $sql = "UPDATE Promotion SET    fulltextsearch_where = '',
                                            listing_id = 0, 
                                            listing_status = '', 
                                            listing_level = 0, 
                                            listing_location1 = 0, 
                                            listing_location2 = 0, 
                                            listing_location3 = 0, 
                                            listing_location4 = 0, 
                                            listing_location5 = 0, 
                                            listing_address = '', 
                                            listing_address2 = '', 
                                            listing_zipcode = '', 
                                            listing_zip5 = '0', 
                                            listing_latitude = '', 
                                            listing_longitude = ''
                   WHERE id = {$this->id}";
            if ($dbObj->query($sql)){
                return true;
            }
        }
		
        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$promotionObj->autoSetListing($acc_id);
		 * <br /><br />
		 *		//Using this in Promotion() class.
		 *		$this->autoSetListing($acc_id);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name autoSetListing
		 * @access Public
		 * @param integer $acc_id
		 */
        function autoSetListing($acc_id){
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $dbObj = db_getDBObject();
            }
            unset($dbMain);

            $listingLevel = new ListingLevel();
            $levels = $listingLevel->getValues();
            $str_levels = "";

            foreach($levels as $level) {
                if ($listingLevel->getHasPromotion($level) == "y"){
                        $str_levels	.= $level.",";
                }
            }

            $str_levels = string_substr($str_levels, 0, -1);

            $sql = "SELECT id FROM Listing WHERE account_id = ".$acc_id." AND level IN ($str_levels)";
            $result = $dbObj->query($sql);

            $sql = "SELECT id FROM Promotion WHERE account_id = ".$acc_id;
            $result2 = $dbObj->query($sql);

            if (mysql_num_rows($result) == 1 && mysql_num_rows($result2) == 1){
                $row = mysql_fetch_assoc($result);
                $listingObj = new Listing($row["id"]);
                $listingObj->setNumber("promotion_id", $this->id);
                $listingObj->save();
            }
        }

        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$promotionObj->getFriendlyURL($mobile);
		 * <br /><br />
		 *		//Using this in Promotion() class.
		 *		$this->getFriendlyURL($mobile);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getFriendlyURL
		 * @access Public
		 * @param boolean $mobile
		 */
        function getFriendlyURL($mobile = false){
            if($mobile){
                $aux_url = DEFAULT_URL."/mobile/".PROMOTION_FEATURE_FOLDER;
            }else{
                $aux_url = PROMOTION_DEFAULT_URL;
            }

            if(MODREWRITE_FEATURE == "on"){
                return $aux_url."/".$this->friendly_url.".html";
            }else{
                return $aux_url."/detail.php?id=".$this->id;
            }
        }

        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$promotionObj->setListingId($listingObj);
		 * <br /><br />
		 *		//Using this in Promotion() class.
		 *		$this->setListingId($listingObj);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name setListingId
		 * @access Public
		 * @param misc $listingObj
		 */
        function setListingId($listingObj){
         
            if(($listingObj->id > 0) && ($this->id > 0)){
                
                $dbMain = db_getDBObject(DEFAULT_DB, true);
                if (defined("SELECTED_DOMAIN_ID")) {
                    $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
                } else {
                    $dbObj = db_getDBObject();
                }
                unset($dbMain);
                
                $sql_listing = "SELECT fulltextsearch_where FROM Listing WHERE id = ".$this->listing_id;
                $row_listing = mysql_fetch_assoc($dbObj->query($sql_listing));
                if ($row_listing["fulltextsearch_where"]){
                    $sql = "UPDATE Promotion SET fulltextsearch_where = ".db_formatString($row_listing["fulltextsearch_where"])." WHERE id = ".$this->id;
                    $dbObj->query($sql);
                }
                
                /**
                 * Get information of listing to save on Deal
                 */
                $this->account_id           = $listingObj->account_id;
                $this->listing_address      = $listingObj->address;
                $this->listing_address2     = $listingObj->address2;
                $this->listing_id           = $listingObj->id;
                $this->listing_latitude     = $listingObj->latitude;
                $this->listing_longitude    = $listingObj->longitude;
                $this->listing_level        = $listingObj->level;
                $this->listing_location_1   = $listingObj->location_1;
                $this->listing_location_2   = $listingObj->location_2;
                $this->listing_location_3   = $listingObj->location_3;
                $this->listing_location_4   = $listingObj->location_4;
                $this->listing_location_5   = $listingObj->location_5;
                $this->listing_status       = $listingObj->status;
                $this->listing_zipcode      = $listingObj->zip_code;
                $this->listing_zip5         = $listingObj->zip5;
                $this->Save();
            }
        }
        
        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$promotionObj->unLinkListingID();
		 * <br /><br />
		 *		//Using this in Promotion() class.
		 *		$this->unLinkListingID();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name unLinkListingID
		 * @access Public
		 */
        function unLinkListingID(){
            $this->listing_address      = "";
            $this->listing_address2     = "";
            $this->listing_id           = 0;
            $this->listing_latitude     = "";
            $this->listing_longitude    = "";
            $this->listing_level        = 0;
            $this->listing_location_1   = 0;
            $this->listing_location_2   = 0;
            $this->listing_location_3   = 0;
            $this->listing_location_4   = 0;
            $this->listing_location_5   = 0;
            $this->listing_status       = "";
            $this->listing_zipcode      = "";
            $this->listing_zip5         = "";

            $this->Save();
        }
    }

?>