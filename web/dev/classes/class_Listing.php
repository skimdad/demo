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
	# * FILE: /classes/class_listing.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$listingObj = new Listing($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name Listing
	 * @method Listing
	 * @method makeFromRow
	 * @method Save
	 * @method Delete
	 * @method updateImage
	 * @method getCategories
	 * @method setCategories
	 * @method updateCategoryStatusByID
	 * @method retrieveListingsbyPromotion_id
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
	 * @method setNumberViews
	 * @method setAvgReview
	 * @method hasDetail
	 * @method deletePerAccount
	 * @method SaveToFeaturedTemp
	 * @method removePromotionID
	 * @method getFriendlyURL
	 * @method getListingByFriendlyURL
	 * @access Public
	 */
	class Listing extends Handle {

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
		 * @var integer
		 * @access Private
		 */
		var $promotion_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $promotion_id_two;
		/**
		 * @var integer
		 * @access Private
		 */
		var $promotion_id_three;
		/**
		 * @var integer
		 * @access Private
		 */
		var $promotion_id_four;
		/**
		 * @var integer
		 * @access Private
		 */
		var $promotion_id_five;
		/**
		 * @var integer
		 * @access Private
		 */
		var $extra_promotion;
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
		var $renewal_date;
		/**
		 * @var integer
		 * @access Private
		 */
		var $discount_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $reminder;
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
		 * @var varchar
		 * @access Private
		 */
		var $title;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $seo_title;
		/**
		 * @var char
		 * @access Private
		 */
		var $claim_disable;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $friendly_url;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $email;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $url;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $display_url;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $address;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $address2;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $zip_code;
        /**
		 * @var varchar
		 * @access Private
		 */
		var $zip5;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $phone;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $fax;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $description1;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $description2;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $description3;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $description4;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $description5;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $description6;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $description7;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $seo_description1;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $seo_description2;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $seo_description3;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $seo_description4;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $seo_description5;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $seo_description6;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $seo_description7;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $long_description1;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $long_description2;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $long_description3;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $long_description4;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $long_description5;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $long_description6;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $long_description7;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $video_snippet;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $keywords1;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $keywords2;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $keywords3;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $keywords4;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $keywords5;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $keywords6;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $keywords7;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $seo_keywords1;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $seo_keywords2;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $seo_keywords3;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $seo_keywords4;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $seo_keywords5;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $seo_keywords6;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $seo_keywords7;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $attachment_file;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $attachment_caption;
		/**
		 * @var char
		 * @access Private
		 */
		var $status;
		/**
		 * @var integer
		 * @access Private
		 */
		var $level;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $locations;
		/**
		 * @var varchar
		 * @access Private
		 */
		/**
		 * @var varchar
		 * @access Private
		 */
		var $hours_work;
		/**
		 * @var integer
		 * @access Private
		 */
		var $listingtemplate_id;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_text0;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_text1;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_text2;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_text3;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_text4;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_text5;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_text6;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_text7;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_text8;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_text9;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_short_desc0;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_short_desc1;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_short_desc2;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_short_desc3;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_short_desc4;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_short_desc5;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_short_desc6;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_short_desc7;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_short_desc8;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_short_desc9;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_long_desc0;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_long_desc1;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_long_desc2;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_long_desc3;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_long_desc4;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_long_desc5;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_long_desc6;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_long_desc7;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_long_desc8;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_long_desc9;
		/**
		 * @var integer
		 * @access Private
		 */
		var $number_views;
		/**
		 * @var integer
		 * @access Private
		 */
		var $avg_review;
		/**
		 * @var char
		 * @access Private
		 */
		var $custom_checkbox0;
		/**
		 * @var char
		 * @access Private
		 */
		var $custom_checkbox1;
		/**
		 * @var char
		 * @access Private
		 */
		var $custom_checkbox2;
		/**
		 * @var char
		 * @access Private
		 */
		var $custom_checkbox3;
		/**
		 * @var char
		 * @access Private
		 */
		var $custom_checkbox4;
		/**
		 * @var char
		 * @access Private
		 */
		var $custom_checkbox5;
		/**
		 * @var char
		 * @access Private
		 */
		var $custom_checkbox6;
		/**
		 * @var char
		 * @access Private
		 */
		var $custom_checkbox7;
		/**
		 * @var char
		 * @access Private
		 */
		var $custom_checkbox8;
		/**
		 * @var char
		 * @access Private
		 */
		var $custom_checkbox9;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_dropdown0;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_dropdown1;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_dropdown2;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_dropdown3;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_dropdown4;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_dropdown5;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_dropdown6;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_dropdown7;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_dropdown8;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom_dropdown9;
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
		 * @var mixed
		 * @access Private
		 */
		var $locationManager;

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
		 * @var char
		 * @access Private
		 */
		var $backlink;
        /**
		 * @var string
		 * @access Private
		 */
		var $backlink_url;
		/**
		 * @var integer
		 * @access Private
		 */
		var $clicktocall_number;
		/**
		 * @var integer
		 * @access Private
		 */
		var $clicktocall_extension;
		/**
		 * @var date
		 * @access Private
		 */
		var $clicktocall_date;
		
		/**
		 * <code>
		 *		$listingObj = new Listing($id);
		 *		//OR
		 *		$listingObj = new Listing($row);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Listing
		 * @access Public
		 * @param mixed $var
		 */
		function Listing($var='', $domain_id = false) {

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
				$sql = "SELECT * FROM Listing WHERE id = $var";

				$row = mysql_fetch_array($db->query($sql));

				unset($db);

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
			$level = new ListingLevel();

			$this->id					= ($row["id"])					? $row["id"]					: ($this->id				? $this->id					: 0);
			$this->account_id			= ($row["account_id"])			? $row["account_id"]			: 0;
			$this->image_id				= ($row["image_id"])			? $row["image_id"]				: ($this->image_id			? $this->image_id			: 0);
			$this->thumb_id				= ($row["thumb_id"])			? $row["thumb_id"]				: ($this->thumb_id			? $this->thumb_id			: 0);
			$this->promotion_id			= ($row["promotion_id"])		? $row["promotion_id"]			: ($this->promotion_id		? $this->promotion_id		: 0);
			$this->promotion_id_two		= ($row["promotion_id_two"])	? $row["promotion_id_two"]		: ($this->promotion_id_two	? $this->promotion_id_two	: 0);
			$this->promotion_id_three	= ($row["promotion_id_three"])	? $row["promotion_id_three"]	: ($this->promotion_id_three ? $this->promotion_id_three : 0);
			$this->promotion_id_four	= ($row["promotion_id_four"])	? $row["promotion_id_four"]		: ($this->promotion_id_four	? $this->promotion_id_four	: 0);
			$this->promotion_id_five	= ($row["promotion_id_five"])	? $row["promotion_id_five"]		: ($this->promotion_id_five	? $this->promotion_id_five	: 0);
			$this->extra_promotion		= ($row["extra_promotion"])		? $row["extra_promotion"]		: ($this->extra_promotion	? $this->extra_promotion	: 0);
			$this->location_1			= ($row["location_1"])			? $row["location_1"]			: 0;
			$this->location_2			= ($row["location_2"])			? $row["location_2"]			: 0;
			$this->location_3			= ($row["location_3"])			? $row["location_3"]			: 0;
			$this->location_4			= ($row["location_4"])			? $row["location_4"]			: 0;
			$this->location_5			= ($row["location_5"])			? $row["location_5"]			: 0;
			$this->renewal_date			= ($row["renewal_date"])		? $row["renewal_date"]			: ($this->renewal_date		? $this->renewal_date		: 0);
			$this->discount_id			= ($row["discount_id"])			? $row["discount_id"]			: "";
			$this->reminder				= ($row["reminder"])			? $row["reminder"]				: ($this->reminder			? $this->reminder			: 0);
			$this->entered				= ($row["entered"])				? $row["entered"]				: ($this->entered			? $this->entered			: "");
			$this->updated				= ($row["updated"])				? $row["updated"]				: ($this->updated			? $this->updated			: "");
			$this->title				= ($row["title"])				? $row["title"]					: ($this->title				? $this->title				: "");
			$this->seo_title			= ($row["seo_title"])			? $row["seo_title"]				: ($this->seo_title			? $this->seo_title			: "");
			$this->claim_disable		= ($row["claim_disable"])		? $row["claim_disable"]			: "n";
			$this->friendly_url			= ($row["friendly_url"])		? $row["friendly_url"]			: "";
			$this->email				= ($row["email"])				? $row["email"]					: "";
			$this->url					= ($row["url"])					? $row["url"]					: "";
			$this->display_url			= ($row["display_url"])			? $row["display_url"]			: "";
			$this->address				= ($row["address"])				? $row["address"]				: "";
			$this->address2				= ($row["address2"])			? $row["address2"]				: "";
			$this->zip_code				= ($row["zip_code"])			? $row["zip_code"]				: "";
			$this->zip5                 = ($row["zip5"])                ? $row["zip5"]                  : "";
			$this->phone				= ($row["phone"])				? $row["phone"]					: "";
			$this->fax					= ($row["fax"])					? $row["fax"]					: "";
			
			$this->description1			= ($row["description1"])		? $row["description1"]			: "";
			$this->description2			= ($row["description2"])		? $row["description2"]			: "";
			$this->description3			= ($row["description3"])		? $row["description3"]			: "";
			$this->description4			= ($row["description4"])		? $row["description4"]			: "";
			$this->description5			= ($row["description5"])		? $row["description5"]			: "";
			$this->description6			= ($row["description6"])		? $row["description6"]			: "";
			$this->description7			= ($row["description7"])		? $row["description7"]			: "";

			$this->seo_description1		= ($row["seo_description1"])	? $row["seo_description1"]		: ($this->seo_description1	? $this->seo_description1	: "");
			$this->seo_description2		= ($row["seo_description2"])	? $row["seo_description2"]		: ($this->seo_description2	? $this->seo_description2	: "");
			$this->seo_description3		= ($row["seo_description3"])	? $row["seo_description3"]		: ($this->seo_description3	? $this->seo_description3	: "");
			$this->seo_description4		= ($row["seo_description4"])	? $row["seo_description4"]		: ($this->seo_description4	? $this->seo_description4	: "");
			$this->seo_description5		= ($row["seo_description5"])	? $row["seo_description5"]		: ($this->seo_description5	? $this->seo_description5	: "");
			$this->seo_description6		= ($row["seo_description6"])	? $row["seo_description6"]		: ($this->seo_description6	? $this->seo_description6	: "");
			$this->seo_description7		= ($row["seo_description7"])	? $row["seo_description7"]		: ($this->seo_description7	? $this->seo_description7	: "");

			$this->long_description1	= ($row["long_description1"])	? $row["long_description1"]		: "";
			$this->long_description2	= ($row["long_description2"])	? $row["long_description2"]		: "";
			$this->long_description3	= ($row["long_description3"])	? $row["long_description3"]		: "";
			$this->long_description4	= ($row["long_description4"])	? $row["long_description4"]		: "";
			$this->long_description5	= ($row["long_description5"])	? $row["long_description5"]		: "";
			$this->long_description6	= ($row["long_description6"])	? $row["long_description6"]		: "";
			$this->long_description7	= ($row["long_description7"])	? $row["long_description7"]		: "";

			$this->video_snippet		= ($row["video_snippet"])		? $row["video_snippet"]			: "";

			$this->keywords1			= ($row["keywords1"])			? $row["keywords1"]				: "";
			$this->keywords2			= ($row["keywords2"])			? $row["keywords2"]				: "";
			$this->keywords3			= ($row["keywords3"])			? $row["keywords3"]				: "";
			$this->keywords4			= ($row["keywords4"])			? $row["keywords4"]				: "";
			$this->keywords5			= ($row["keywords5"])			? $row["keywords5"]				: "";
			$this->keywords6			= ($row["keywords6"])			? $row["keywords6"]				: "";
			$this->keywords7			= ($row["keywords7"])			? $row["keywords7"]				: "";

			$this->seo_keywords1		= ($row["seo_keywords1"])		? $row["seo_keywords1"]			: ($this->seo_keywords1		? $this->seo_keywords1		: "");
			$this->seo_keywords2		= ($row["seo_keywords2"])		? $row["seo_keywords2"]			: ($this->seo_keywords2		? $this->seo_keywords2		: "");
			$this->seo_keywords3		= ($row["seo_keywords3"])		? $row["seo_keywords3"]			: ($this->seo_keywords3		? $this->seo_keywords3		: "");
			$this->seo_keywords4		= ($row["seo_keywords4"])		? $row["seo_keywords4"]			: ($this->seo_keywords4		? $this->seo_keywords4		: "");
			$this->seo_keywords5		= ($row["seo_keywords5"])		? $row["seo_keywords5"]			: ($this->seo_keywords5		? $this->seo_keywords5		: "");
			$this->seo_keywords6		= ($row["seo_keywords6"])		? $row["seo_keywords6"]			: ($this->seo_keywords6		? $this->seo_keywords6		: "");
			$this->seo_keywords7		= ($row["seo_keywords7"])		? $row["seo_keywords7"]			: ($this->seo_keywords7		? $this->seo_keywords7		: "");

			$this->attachment_file		= ($row["attachment_file"])		? $row["attachment_file"]		: ($this->attachment_file	? $this->attachment_file	: "");
			$this->attachment_caption	= ($row["attachment_caption"])	? $row["attachment_caption"]	: "";
			$this->status				= ($row["status"])				? $row["status"]				: $status->getDefaultStatus();
			$this->level				= ($row["level"])				? $row["level"]					: ($this->level				? $this->level				: $level->getDefaultLevel());
			$this->hours_work			= ($row["hours_work"])			? $row["hours_work"]			: "";
			$this->locations			= ($row["locations"])			? $row["locations"]				: "";

			$this->latitude             = ($row["latitude"])			? $row["latitude"]				: ($this->latitude		? $this->latitude		: "");
			$this->longitude			= ($row["longitude"])			? $row["longitude"]				: ($this->longitude		? $this->longitude		: "");
			$this->map_zoom             = ($row["map_zoom"])            ? $row["map_zoom"]              : 0;
			$this->listingtemplate_id	= ($row["listingtemplate_id"])	? $row["listingtemplate_id"]	: 0;

			$this->custom_text0			= ($row["custom_text0"])		? $row["custom_text0"]			: "";
			$this->custom_text1			= ($row["custom_text1"])		? $row["custom_text1"]			: "";
			$this->custom_text2			= ($row["custom_text2"])		? $row["custom_text2"]			: "";
			$this->custom_text3			= ($row["custom_text3"])		? $row["custom_text3"]			: "";
			$this->custom_text4			= ($row["custom_text4"])		? $row["custom_text4"]			: "";
			$this->custom_text5			= ($row["custom_text5"])		? $row["custom_text5"]			: "";
			$this->custom_text6			= ($row["custom_text6"])		? $row["custom_text6"]			: "";
			$this->custom_text7			= ($row["custom_text7"])		? $row["custom_text7"]			: "";
			$this->custom_text8			= ($row["custom_text8"])		? $row["custom_text8"]			: "";
			$this->custom_text9			= ($row["custom_text9"])		? $row["custom_text9"]			: "";
			$this->custom_short_desc0	= ($row["custom_short_desc0"])	? $row["custom_short_desc0"]	: "";
			$this->custom_short_desc1	= ($row["custom_short_desc1"])	? $row["custom_short_desc1"]	: "";
			$this->custom_short_desc2	= ($row["custom_short_desc2"])	? $row["custom_short_desc2"]	: "";
			$this->custom_short_desc3	= ($row["custom_short_desc3"])	? $row["custom_short_desc3"]	: "";
			$this->custom_short_desc4	= ($row["custom_short_desc4"])	? $row["custom_short_desc4"]	: "";
			$this->custom_short_desc5	= ($row["custom_short_desc5"])	? $row["custom_short_desc5"]	: "";
			$this->custom_short_desc6	= ($row["custom_short_desc6"])	? $row["custom_short_desc6"]	: "";
			$this->custom_short_desc7	= ($row["custom_short_desc7"])	? $row["custom_short_desc7"]	: "";
			$this->custom_short_desc8	= ($row["custom_short_desc8"])	? $row["custom_short_desc8"]	: "";
			$this->custom_short_desc9	= ($row["custom_short_desc9"])	? $row["custom_short_desc9"]	: "";
			$this->custom_long_desc0	= ($row["custom_long_desc0"])	? $row["custom_long_desc0"]		: "";
			$this->custom_long_desc1	= ($row["custom_long_desc1"])	? $row["custom_long_desc1"]		: "";
			$this->custom_long_desc2	= ($row["custom_long_desc2"])	? $row["custom_long_desc2"]		: "";
			$this->custom_long_desc3	= ($row["custom_long_desc3"])	? $row["custom_long_desc3"]		: "";
			$this->custom_long_desc4	= ($row["custom_long_desc4"])	? $row["custom_long_desc4"]		: "";
			$this->custom_long_desc5	= ($row["custom_long_desc5"])	? $row["custom_long_desc5"]		: "";
			$this->custom_long_desc6	= ($row["custom_long_desc6"])	? $row["custom_long_desc6"]		: "";
			$this->custom_long_desc7	= ($row["custom_long_desc7"])	? $row["custom_long_desc7"]		: "";
			$this->custom_long_desc8	= ($row["custom_long_desc8"])	? $row["custom_long_desc8"]		: "";
			$this->custom_long_desc9	= ($row["custom_long_desc9"])	? $row["custom_long_desc9"]		: "";
			$this->number_views			= ($row["number_views"])		? $row["number_views"]			: ($this->number_views		? $this->number_views	: 0);
			$this->avg_review			= ($row["avg_review"])			? $row["avg_review"]			: ($this->avg_review		? $this->avg_review		: 0);
			$this->custom_checkbox0		= ($row["custom_checkbox0"])	? $row["custom_checkbox0"]		: "n";
			$this->custom_checkbox1		= ($row["custom_checkbox1"])	? $row["custom_checkbox1"]		: "n";
			$this->custom_checkbox2		= ($row["custom_checkbox2"])	? $row["custom_checkbox2"]		: "n";
			$this->custom_checkbox3		= ($row["custom_checkbox3"])	? $row["custom_checkbox3"]		: "n";
			$this->custom_checkbox4		= ($row["custom_checkbox4"])	? $row["custom_checkbox4"]		: "n";
			$this->custom_checkbox5		= ($row["custom_checkbox5"])	? $row["custom_checkbox5"]		: "n";
			$this->custom_checkbox6		= ($row["custom_checkbox6"])	? $row["custom_checkbox6"]		: "n";
			$this->custom_checkbox7		= ($row["custom_checkbox7"])	? $row["custom_checkbox7"]		: "n";
			$this->custom_checkbox8		= ($row["custom_checkbox8"])	? $row["custom_checkbox8"]		: "n";
			$this->custom_checkbox9		= ($row["custom_checkbox9"])	? $row["custom_checkbox9"]		: "n";
			$this->custom_dropdown0		= ($row["custom_dropdown0"])	? $row["custom_dropdown0"]		: "";
			$this->custom_dropdown1		= ($row["custom_dropdown1"])	? $row["custom_dropdown1"]		: "";
			$this->custom_dropdown2		= ($row["custom_dropdown2"])	? $row["custom_dropdown2"]		: "";
			$this->custom_dropdown3		= ($row["custom_dropdown3"])	? $row["custom_dropdown3"]		: "";
			$this->custom_dropdown4		= ($row["custom_dropdown4"])	? $row["custom_dropdown4"]		: "";
			$this->custom_dropdown5		= ($row["custom_dropdown5"])	? $row["custom_dropdown5"]		: "";
			$this->custom_dropdown6		= ($row["custom_dropdown6"])	? $row["custom_dropdown6"]		: "";
			$this->custom_dropdown7		= ($row["custom_dropdown7"])	? $row["custom_dropdown7"]		: "";
			$this->custom_dropdown8		= ($row["custom_dropdown8"])	? $row["custom_dropdown8"]		: "";
			$this->custom_dropdown9		= ($row["custom_dropdown9"])	? $row["custom_dropdown9"]		: "";
			$this->package_id			= ($row["package_id"])			? $row["package_id"]			: ($this->package_id			? $this->package_id				: 0);
			$this->package_price		= ($row["package_price"])		? $row["package_price"]			: ($this->package_price			? $this->package_price			: 0);
			$this->backlink				= ($row["backlink"])			? $row["backlink"]				: ($this->backlink				? $this->backlink				: "n");
            $this->backlink_url				= ($row["backlink_url"])			? $row["backlink_url"]				: ($this->backlink_url				? $this->backlink_url				: "");
            $this->clicktocall_number		= ($row["clicktocall_number"])		? $row["clicktocall_number"]	: ($this->clicktocall_number	? $this->clicktocall_number			: "");
            $this->clicktocall_extension	= ($row["clicktocall_extension"])	? $row["clicktocall_extension"]	: ($this->clicktocall_extension	? $this->clicktocall_extension		: 0);
            $this->clicktocall_date			= ($row["clicktocall_date"])		? $row["clicktocall_date"]		: ($this->clicktocall_date		? $this->clicktocall_date			: "");
			
			$this->data_in_array = $row;

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$listingObj->Save();
		 * <br /><br />
		 *		//Using this in Listing() class.
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

				$sql = "SELECT status FROM Listing WHERE id = $this->id";
				$result = $dbObj->query($sql);
				if ($row = mysql_fetch_assoc($result)) $last_status = $row["status"];
				$this_status = $this->status;
				$this_id = $this->id;

				$sql = "UPDATE Listing SET"
					. " account_id         = $this->account_id,"
					. " image_id           = $this->image_id,"
					. " thumb_id           = $this->thumb_id,"
					. " promotion_id       = $this->promotion_id,"
					. " promotion_id_two   = $this->promotion_id_two,"
					. " promotion_id_three = $this->promotion_id_three,"
					. " promotion_id_four  = $this->promotion_id_four,"
					. " promotion_id_five  = $this->promotion_id_five,"
					. " extra_promotion    = $this->extra_promotion,"
					. " location_1         = $this->location_1,"
					. " location_2         = $this->location_2,"
					. " location_3         = $this->location_3,"
					. " location_4         = $this->location_4,"
					. " location_5         = $this->location_5,"
					. " renewal_date       = $this->renewal_date,"
					. " discount_id        = $this->discount_id,"
					. " reminder           = $this->reminder,"
					. " updated            = NOW(),"
					. " title              = $this->title,"
					. " seo_title          = $this->seo_title,"
					. " claim_disable      = $this->claim_disable,"
					. " friendly_url       = $this->friendly_url,"
					. " email              = $this->email,"
					. " url                = $this->url,"
					. " display_url        = $this->display_url,"
					. " address            = $this->address,"
					. " address2           = $this->address2,"
					. " zip_code           = $this->zip_code,"
					. " phone              = $this->phone,"
					. " fax                = $this->fax,"
					. " description1       = $this->description1,"
					. " description2       = $this->description2,"
					. " description3       = $this->description3,"
					. " description4       = $this->description4,"
					. " description5       = $this->description5,"
					. " description6       = $this->description6,"
					. " description7       = $this->description7,"
					. " seo_description1   = $this->seo_description1,"
					. " seo_description2   = $this->seo_description2,"
					. " seo_description3   = $this->seo_description3,"
					. " seo_description4   = $this->seo_description4,"
					. " seo_description5   = $this->seo_description5,"
					. " seo_description6   = $this->seo_description6,"
					. " seo_description7   = $this->seo_description7,"
					. " long_description1  = $this->long_description1,"
					. " long_description2  = $this->long_description2,"
					. " long_description3  = $this->long_description3,"
					. " long_description4  = $this->long_description4,"
					. " long_description5  = $this->long_description5,"
					. " long_description6  = $this->long_description6,"
					. " long_description7  = $this->long_description7,"
					. " video_snippet      = $this->video_snippet,"
					. " keywords1          = $this->keywords1,"
					. " keywords2          = $this->keywords2,"
					. " keywords3          = $this->keywords3,"
					. " keywords4          = $this->keywords4,"
					. " keywords5          = $this->keywords5,"
					. " keywords6          = $this->keywords6,"
					. " keywords7          = $this->keywords7,"
					. " seo_keywords1      = $this->seo_keywords1,"
					. " seo_keywords2      = $this->seo_keywords2,"
					. " seo_keywords3      = $this->seo_keywords3,"
					. " seo_keywords4      = $this->seo_keywords4,"
					. " seo_keywords5      = $this->seo_keywords5,"
					. " seo_keywords6      = $this->seo_keywords6,"
					. " seo_keywords7      = $this->seo_keywords7,"
					. " attachment_file    = $this->attachment_file,"
					. " attachment_caption = $this->attachment_caption,"
					. " status             = $this->status,"
					. " level              = $this->level,"
					. " hours_work         = $this->hours_work,"
					. " locations          = $this->locations,"
					. " listingtemplate_id = $this->listingtemplate_id,"
					. " custom_text0       = $this->custom_text0,"
					. " custom_text1       = $this->custom_text1,"
					. " custom_text2       = $this->custom_text2,"
					. " custom_text3       = $this->custom_text3,"
					. " custom_text4       = $this->custom_text4,"
					. " custom_text5       = $this->custom_text5,"
					. " custom_text6       = $this->custom_text6,"
					. " custom_text7       = $this->custom_text7,"
					. " custom_text8       = $this->custom_text8,"
					. " custom_text9       = $this->custom_text9,"
					. " custom_short_desc0 = $this->custom_short_desc0,"
					. " custom_short_desc1 = $this->custom_short_desc1,"
					. " custom_short_desc2 = $this->custom_short_desc2,"
					. " custom_short_desc3 = $this->custom_short_desc3,"
					. " custom_short_desc4 = $this->custom_short_desc4,"
					. " custom_short_desc5 = $this->custom_short_desc5,"
					. " custom_short_desc6 = $this->custom_short_desc6,"
					. " custom_short_desc7 = $this->custom_short_desc7,"
					. " custom_short_desc8 = $this->custom_short_desc8,"
					. " custom_short_desc9 = $this->custom_short_desc9,"
					. " custom_long_desc0  = $this->custom_long_desc0,"
					. " custom_long_desc1  = $this->custom_long_desc1,"
					. " custom_long_desc2  = $this->custom_long_desc2,"
					. " custom_long_desc3  = $this->custom_long_desc3,"
					. " custom_long_desc4  = $this->custom_long_desc4,"
					. " custom_long_desc5  = $this->custom_long_desc5,"
					. " custom_long_desc6  = $this->custom_long_desc6,"
					. " custom_long_desc7  = $this->custom_long_desc7,"
					. " custom_long_desc8  = $this->custom_long_desc8,"
					. " custom_long_desc9  = $this->custom_long_desc9,"
					. " number_views	   = $this->number_views,"
					. " avg_review		   = $this->avg_review,"
					. " custom_checkbox0   = $this->custom_checkbox0,"
					. " custom_checkbox1   = $this->custom_checkbox1,"
					. " custom_checkbox2   = $this->custom_checkbox2,"
					. " custom_checkbox3   = $this->custom_checkbox3,"
					. " custom_checkbox4   = $this->custom_checkbox4,"
					. " custom_checkbox5   = $this->custom_checkbox5,"
					. " custom_checkbox6   = $this->custom_checkbox6,"
					. " custom_checkbox7   = $this->custom_checkbox7,"
					. " custom_checkbox8   = $this->custom_checkbox8,"
					. " custom_checkbox9   = $this->custom_checkbox9,"
					. " custom_dropdown0   = $this->custom_dropdown0,"
					. " custom_dropdown1   = $this->custom_dropdown1,"
					. " custom_dropdown2   = $this->custom_dropdown2,"
					. " custom_dropdown3   = $this->custom_dropdown3,"
					. " custom_dropdown4   = $this->custom_dropdown4,"
					. " custom_dropdown5   = $this->custom_dropdown5,"
					. " custom_dropdown6   = $this->custom_dropdown6,"
					. " custom_dropdown7   = $this->custom_dropdown7,"
					. " custom_dropdown8   = $this->custom_dropdown8,"
					. " custom_dropdown9   = $this->custom_dropdown9,"
					. " latitude           = $this->latitude,"
					. " longitude          = $this->longitude,"
					. " map_zoom           = $this->map_zoom,"
					. " package_id		   = $this->package_id,"
					. " package_price	   = $this->package_price,"
					. " backlink		   = $this->backlink,"
					. " backlink_url            = $this->backlink_url,"
					. " clicktocall_number		= $this->clicktocall_number,"
					. " clicktocall_extension	= $this->clicktocall_extension,"
					. " clicktocall_date		= $this->clicktocall_date"
					. " WHERE id           = $this->id";

				$dbObj->query($sql);

				$last_status = str_replace("\"", "", $last_status);
				$last_status = str_replace("'", "", $last_status);
				$this_status = str_replace("\"", "", $this_status);
				$this_status = str_replace("'", "", $this_status);
				$this_id = str_replace("\"", "", $this_id);
				$this_id = str_replace("'", "", $this_id);
				system_countActiveListingByCategory($this_id);

				if ($last_status != "P" && $this_status == "P"){
					activity_newToApproved($aux_log_domain_id, $this->id, "listing", $this->title);
				} else if ($last_status == "P" && $this_status != "P") {
					activity_deleteRecord($aux_log_domain_id, $this->id, "listing");
				} else if ($last_status == $this_status){
					activity_updateRecord($aux_log_domain_id, $this->id, $this->title, "item", "listing");
				}

				/*
				 * Populate Listings to front
				 */
				unset($listingSummaryObj);
				$listingSummaryObj = new ListingSummary();

				$listingSummaryObj->PopulateTable($this->id, "update");
				$this->updateCategoryStatusByID();

				if ($aux_old_account != $aux_account && $aux_account != 0) {
					$accDomain = new Account_Domain($aux_account, SELECTED_DOMAIN_ID);
					$accDomain->Save();
					$accDomain->saveOnDomain($aux_account, $this);
				}
			} else {

				$sql = "INSERT INTO Listing"
					. " (account_id,"
					. " image_id,"
					. " thumb_id,"
					. " promotion_id,"
					. " promotion_id_two,"
					. " promotion_id_three,"
					. " promotion_id_four,"
					. " promotion_id_five,"
					. " extra_promotion,"
					. " location_1,"
					. " location_2,"
					. " location_3,"
					. " location_4,"
					. " location_5,"
					. " renewal_date,"
					. " discount_id,"
					. " reminder,"
					. " fulltextsearch_keyword,"
					. " fulltextsearch_where,"
					. " updated,"
					. " entered,"
					. " title,"
					. " seo_title,"
					. " claim_disable,"
					. " friendly_url,"
					. " email,"
					. " url,"
					. " display_url,"
					. " address,"
					. " address2,"
					. " zip_code,"
					. " phone,"
					. " fax,"
					. " description1,"
					. " description2,"
					. " description3,"
					. " description4,"
					. " description5,"
					. " description6,"
					. " description7,"
					. " seo_description1,"
					. " seo_description2,"
					. " seo_description3,"
					. " seo_description4,"
					. " seo_description5,"
					. " seo_description6,"
					. " seo_description7,"
					. " long_description1,"
					. " long_description2,"
					. " long_description3,"
					. " long_description4,"
					. " long_description5,"
					. " long_description6,"
					. " long_description7,"
					. " video_snippet,"
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
					. " attachment_file,"
					. " attachment_caption,"
					. " status,"
					. " level,"
					. " hours_work,"
					. " locations,"
					. " listingtemplate_id,"
					. " custom_text0,"
					. " custom_text1,"
					. " custom_text2,"
					. " custom_text3,"
					. " custom_text4,"
					. " custom_text5,"
					. " custom_text6,"
					. " custom_text7,"
					. " custom_text8,"
					. " custom_text9,"
					. " custom_short_desc0,"
					. " custom_short_desc1,"
					. " custom_short_desc2,"
					. " custom_short_desc3,"
					. " custom_short_desc4,"
					. " custom_short_desc5,"
					. " custom_short_desc6,"
					. " custom_short_desc7,"
					. " custom_short_desc8,"
					. " custom_short_desc9,"
					. " custom_long_desc0,"
					. " custom_long_desc1,"
					. " custom_long_desc2,"
					. " custom_long_desc3,"
					. " custom_long_desc4,"
					. " custom_long_desc5,"
					. " custom_long_desc6,"
					. " custom_long_desc7,"
					. " custom_long_desc8,"
					. " custom_long_desc9,"
					. " number_views,"
					. " avg_review,"
					. " custom_checkbox0,"
					. " custom_checkbox1,"
					. " custom_checkbox2,"
					. " custom_checkbox3,"
					. " custom_checkbox4,"
					. " custom_checkbox5,"
					. " custom_checkbox6,"
					. " custom_checkbox7,"
					. " custom_checkbox8,"
					. " custom_checkbox9,"
					. " custom_dropdown0,"
					. " custom_dropdown1,"
					. " custom_dropdown2,"
					. " custom_dropdown3,"
					. " custom_dropdown4,"
					. " custom_dropdown5,"
					. " custom_dropdown6,"
					. " custom_dropdown7,"
					. " custom_dropdown8,"
					. " custom_dropdown9,"
					. " latitude,"
					. " longitude,"
					. " map_zoom,"
					. " package_id,"
					. " package_price,"
					. " backlink,"
					. " backlink_url,"
					. " clicktocall_number,"
					. " clicktocall_extension,"
					. " clicktocall_date)"
					. " VALUES"
					. " ($this->account_id,"
					. " $this->image_id,"
					. " $this->thumb_id,"
					. " $this->promotion_id,"
					. " $this->promotion_id_two,"
					. " $this->promotion_id_three,"
					. " $this->promotion_id_four,"
					. " $this->promotion_id_five,"
					. " $this->extra_promotion,"
					. " $this->location_1,"
					. " $this->location_2,"
					. " $this->location_3,"
					. " $this->location_4,"
					. " $this->location_5,"
					. " $this->renewal_date,"
					. " $this->discount_id,"
					. " $this->reminder,"
					. " '',"
					. " '',"
					. " NOW(),"
					. " NOW(),"
					. " $this->title,"
					. " $this->title,"
					. " $this->claim_disable,"
					. " $this->friendly_url,"
					. " $this->email,"
					. " $this->url,"
					. " $this->display_url,"
					. " $this->address,"
					. " $this->address2,"
					. " $this->zip_code,"
					. " $this->phone,"
					. " $this->fax,"
					. " $this->description1,"
					. " $this->description2,"
					. " $this->description3,"
					. " $this->description4,"
					. " $this->description5,"
					. " $this->description6,"
					. " $this->description7,"
					. " $this->description1,"
					. " $this->description2,"
					. " $this->description3,"
					. " $this->description4,"
					. " $this->description5,"
					. " $this->description6,"
					. " $this->description7,"
					. " $this->long_description1,"
					. " $this->long_description2,"
					. " $this->long_description3,"
					. " $this->long_description4,"
					. " $this->long_description5,"
					. " $this->long_description6,"
					. " $this->long_description7,"
					. " $this->video_snippet,"
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
					. " $this->attachment_file,"
					. " $this->attachment_caption,"
					. " $this->status,"
					. " $this->level,"
					. " $this->hours_work,"
					. " $this->locations,"
					. " $this->listingtemplate_id,"
					. " $this->custom_text0,"
					. " $this->custom_text1,"
					. " $this->custom_text2,"
					. " $this->custom_text3,"
					. " $this->custom_text4,"
					. " $this->custom_text5,"
					. " $this->custom_text6,"
					. " $this->custom_text7,"
					. " $this->custom_text8,"
					. " $this->custom_text9,"
					. " $this->custom_short_desc0,"
					. " $this->custom_short_desc1,"
					. " $this->custom_short_desc2,"
					. " $this->custom_short_desc3,"
					. " $this->custom_short_desc4,"
					. " $this->custom_short_desc5,"
					. " $this->custom_short_desc6,"
					. " $this->custom_short_desc7,"
					. " $this->custom_short_desc8,"
					. " $this->custom_short_desc9,"
					. " $this->custom_long_desc0,"
					. " $this->custom_long_desc1,"
					. " $this->custom_long_desc2,"
					. " $this->custom_long_desc3,"
					. " $this->custom_long_desc4,"
					. " $this->custom_long_desc5,"
					. " $this->custom_long_desc6,"
					. " $this->custom_long_desc7,"
					. " $this->custom_long_desc8,"
					. " $this->custom_long_desc9,"
					. " $this->number_views,"
					. " $this->avg_review,"
					. " $this->custom_checkbox0,"
					. " $this->custom_checkbox1,"
					. " $this->custom_checkbox2,"
					. " $this->custom_checkbox3,"
					. " $this->custom_checkbox4,"
					. " $this->custom_checkbox5,"
					. " $this->custom_checkbox6,"
					. " $this->custom_checkbox7,"
					. " $this->custom_checkbox8,"
					. " $this->custom_checkbox9,"
					. " $this->custom_dropdown0,"
					. " $this->custom_dropdown1,"
					. " $this->custom_dropdown2,"
					. " $this->custom_dropdown3,"
					. " $this->custom_dropdown4,"
					. " $this->custom_dropdown5,"
					. " $this->custom_dropdown6,"
					. " $this->custom_dropdown7,"
					. " $this->custom_dropdown8,"
					. " $this->custom_dropdown9,"
					. " $this->latitude,"
					. " $this->longitude,"
					. " $this->map_zoom,"
					. " $this->package_id,"
					. " $this->package_price,"
					. " $this->backlink,"
					. " $this->backlink_url,"
					. " $this->clicktocall_number,"
					. " $this->clicktocall_extension,"
					. " $this->clicktocall_date)";

				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);

				if (sess_getAccountIdFromSession() || string_strpos($_SERVER["PHP_SELF"],"order_") !== false){
					activity_newActivity($aux_log_domain_id, $this->account_id, 0, "newitem", "listing", $this->title);
				}

				if ($this->status == "'P'"){
					activity_newToApproved($aux_log_domain_id, $this->id, "listing", $this->title);
				}

				domain_updateDashboard("number_listings","inc", 0, $aux_log_domain_id);

				/*
				 * Populate Listings to front
				 */
				unset($listingSummaryObj);
				$listingSummaryObj = new ListingSummary();
				/*
				 * Used to package
				 */
				$this->prepareToUse(); //prevent some fields to be saved with empty quotes
				if(is_numeric($this->domain_id)){
					$listingSummaryObj->setNumber("domain_id",$this->domain_id);
				}else{
					$listingSummaryObj->domain_id = SELECTED_DOMAIN_ID;
				}


				$listingSummaryObj->PopulateTable($this->id, "insert");

				//Reload the Listing object variables

				$sql = "SELECT * FROM Listing WHERE id = $this->id";
				$row = mysql_fetch_array($dbObj->query($sql));
				$this->makeFromRow($row);
				$this->prepareToSave();

				$this_status = $this->status;
				$this_id = $this->id;
				$this_status = str_replace("\"", "", $this_status);
				$this_status = str_replace("'", "", $this_status);
				$this_id = str_replace("\"", "", $this_id);
				$this_id = str_replace("'", "", $this_id);
				system_countActiveListingByCategory($this_id);

				/*
				 * Save to featured temp
				 */
				$this->SaveToFeaturedTemp();

				if ($aux_account != 0) {
					domain_SaveAccountInfoDomain($aux_account, $this);
				}

			}

            $this->prepareToUse();

            /**
             * Save listing_id on Promotion table
             */
            if($this->promotion_id != "0"){
                unset($promotionObj);
                $promotionObj = new Promotion($this->promotion_id);
                $promotionObj->setListingId($this);
            }
                        
            if($this->promotion_id_two != "0"){
                unset($promotionObj);
                $promotionObj = new Promotion($this->promotion_id_two);
                $promotionObj->setListingId($this);
            }

            if($this->promotion_id_three != "0"){
                unset($promotionObj);
                $promotionObj = new Promotion($this->promotion_id_three);
                $promotionObj->setListingId($this);
            }

            if($this->promotion_id_four != "0"){
                unset($promotionObj);
                $promotionObj = new Promotion($this->promotion_id_four);
                $promotionObj->setListingId($this);
            }

            if($this->promotion_id_five != "0"){
                unset($promotionObj);
                $promotionObj = new Promotion($this->promotion_id_five);
                $promotionObj->setListingId($this);
            }

			$this->setFullTextSearch();
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$listingObj->Delete();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Delete
		 * @access Public
		 */
		function Delete($domain_id = false, $update_count = true) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($domain_id) {
				$dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
				$domain_extra_file_dir = EDIRECTORY_ROOT."/custom/domain_$domain_id/extra_files/";
			} else {
				if (defined("SELECTED_DOMAIN_ID")) {
					$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$dbObj = db_getDBObject();
				}
				$domain_extra_file_dir = EXTRAFILE_DIR;
				unset($dbMain);
			}

			### LISTING CATEGORY STATUS
			if ($this->status != "P") {
				$sql = "UPDATE Listing SET status = 'P' WHERE id = $this->id";
				$dbObj->query($sql);
			}

			if (SHOW_CATEGORY_COUNT == "on" && $update_count) system_countActiveListingByCategory($this_id, false, $domain_id);

			### REVIEWS
			$sql = "SELECT id FROM Review WHERE item_type='listing' AND item_id= $this->id";
			$result = $dbObj->query($sql);
			while ($row = mysql_fetch_assoc($result)) {
				$reviewObj = new Review($row["id"]);
				$reviewObj->Delete($domain_id);
			}

			### LISTING_CATEOGRY
			$sql = "DELETE FROM Listing_Category WHERE listing_id = $this->id";
			$dbObj->query($sql);

			### CHOICES
			$sql = "DELETE FROM Listing_Choice WHERE listing_id = $this->id";
			$dbObj->query($sql);

			### GALERY
			$sql = "DELETE FROM Gallery_Item WHERE item_type = 'listing' AND item_id = $this->id";
			$dbObj->query($sql);

			### IMAGE
			if ($this->image_id) {
				$image = new Image($this->image_id);
				if ($image) $image->Delete($domain_id);
			}
			if ($this->thumb_id) {
				$image = new Image($this->thumb_id);
				if ($image) $image->Delete($domain_id);
			}

			### ATTACHMENT
			if ($this->attachment_file) {
				if (file_exists($domain_extra_file_dir.$this->attachment_file)) {
					@unlink($domain_extra_file_dir.$this->attachment_file);
				}
			}

			### INVOICE
			$sql = "UPDATE Invoice_Listing SET listing_id = '0' WHERE listing_id = $this->id";
			$dbObj->query($sql);

			### PAYMENT
			$sql = "UPDATE Payment_Listing_Log SET listing_id = '0' WHERE listing_id = $this->id";
			$dbObj->query($sql);

			### CLAIM
			$sql = "UPDATE Claim SET status = 'incomplete' WHERE listing_id = $this->id AND status = 'progress'";
			$dbObj->query($sql);
			$sql = "UPDATE Claim SET listing_id = '0' WHERE listing_id = $this->id";
			$dbObj->query($sql);

			### CheckIn
			$sql = "DELETE FROM CheckIn WHERE item_id = $this->id";
			$dbObj->query($sql);
            
            ### Promotion
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
                   WHERE listing_id = $this->id";
            $dbObj->query($sql);

			/*
			 * Populate Listings to front
			 */
			unset($listingSummaryObj);
			$listingSummaryObj = new ListingSummary();
			$listingSummaryObj->Delete($this->id);

			### LISTING
			$sql = "DELETE FROM Listing WHERE id = $this->id";
			$dbObj->query($sql);

			if ($domain_id){
				$domain_idDash = $domain_id;
			} else {
				$domain_idDash = SELECTED_DOMAIN_ID;
			}

			domain_updateDashboard("number_listings", "dec", 0, $domain_idDash);

			activity_deleteRecord($domain_idDash, $this->id, "listing");

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$listingObj->updateImage($imageArray);
		 * <br /><br />
		 *		//Using this in Listing() class.
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
		 *		$listingObj->getCategories(...);
		 * <br /><br />
		 *		//Using this in Listing() class.
		 *		$this->getCategories(...);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getCategories
		 * @access Public
		 * @param boolean $have_data
		 * @param array $data
		 * @param integer $id
		 * @param boolean $getAll
		 * @param boolean $object
		 * @param boolean $bulk
		 * @return array $categories
		 */
		function getCategories($have_data = false, $data = false, $id = false, $getAll = false, $object=false, $bulk=false) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);

			if ($have_data) {
				if ($data["cat_1_id"]) $ids[] = $data["cat_1_id"];
				if ($data["cat_2_id"]) $ids[] = $data["cat_2_id"];
				if ($data["cat_3_id"]) $ids[] = $data["cat_3_id"];
				if ($data["cat_4_id"]) $ids[] = $data["cat_4_id"];
				if ($data["cat_5_id"]) $ids[] = $data["cat_5_id"];

				if (is_array($ids)) {
					$ids = array_unique($ids);
					$sql = "SELECT * FROM ListingCategory WHERE id IN (".implode(",", $ids).")";
					$r = $dbObj->query($sql);
					while ($row = mysql_fetch_array($r)) {
						$categories[] = new ListingCategory($row);
					}
				}

			} else {
				if(!$id){
					$id = $this->id ;
				}
				if($id){

					$sql_main = "SELECT category.root_id,
										listing_category.category_id
										FROM Listing_Category listing_category
										INNER JOIN ListingCategory category ON category.id = listing_category.category_id
										WHERE listing_category.listing_id = ".$id." AND root_id > 0";

					$result_main = $dbObj->unbuffered_query($sql_main);
					//if(mysql_num_rows($result_main) > 0){
					if($result_main){

						$aux_array_categories = array();
						while($row = mysql_fetch_assoc($result_main)){
							if (!$object && !$bulk) {
								$aux_array_categories[] = $row["root_id"];
							}
							if ($getAll) {
								$aux_array_categories[] = $row["category_id"];
							}
						}

						if(count($aux_array_categories) > 0){
							$sql = "SELECT	id,
											title1,
											title2,
											title3,
											title4,
											title5,
											title6,
											title7,
											lang,
											page_title1,
											page_title2,
											page_title3,
											page_title4,
											page_title5,
											page_title6,
											page_title7,
											friendly_url1,
											friendly_url2,
											friendly_url3,
											friendly_url4,
											friendly_url5,
											friendly_url6,
											friendly_url7,
											enabled,
											category_id
										FROM ListingCategory
										WHERE id IN (".implode(",",$aux_array_categories).")";
                                                        
                            if(!$object){
                                $result = $dbObj->unbuffered_query($sql);
                            }else{
                                $result = $dbObj->query($sql);
                            }
							
							//if(mysql_num_rows($result) > 0){
							if($result){
								$categories = array();
								while($row = mysql_fetch_assoc($result)){
									if ($object){
                                        $langIndex = language_getIndex(EDIR_LANGUAGE);
                                        if (!$row["title".$langIndex]){
                                            if ($row["title".EDIR_DEFAULT_LANGUAGENUMBER]){
                                                $row["title"] = $row["title".EDIR_DEFAULT_LANGUAGENUMBER];
                                            } else {
                                                $auxLangs = explode(",", EDIR_LANGUAGENUMBERS);
                                                foreach($auxLangs as $lang) { 
                                                    if ($row["title".$lang]){
                                                        $row["title"] = $row["title".$lang];
                                                        break;
                                                    }
                                                }
                                            }
                                        }
										$categories[] = new ListingCategory($row);
                                    } else {
										$categories[] = $row;
                                    }
								}
							}
						}
					}
				}
			}

			if(count($categories) > 0){
				return $categories;
			}else{
				return false;
			}
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$listingObj->setCategories($categories);
		 * <br /><br />
		 *		//Using this in Listing() class.
		 *		$this->setCategories($categories);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name setCategories
		 * @access Public
		 * @param array $array
		 */
		function setCategories($array) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);

			if ($this->id) {
				system_countActiveListingByCategory($this->id);

				$sql = "DELETE FROM Listing_Category WHERE listing_id = ".$this->id;
				$dbObj->query($sql);

				if ($array) {
					foreach ($array as $category) {
						if ($category) {

							$lCatObj = new ListingCategory($category);
							unset($root_id, $left, $right);
							$root_id = $lCatObj->getNumber("root_id");
							$left = $lCatObj->getNumber("left");
							$right = $lCatObj->getNumber("right");

							unset($l_catObj);
							$l_catObj = new Listing_Category();
							$l_catObj->setNumber("listing_id", $this->id);
							$l_catObj->setNumber("category_id", $category);
							$l_catObj->setString("status", $this->status);
							$l_catObj->setNumber("category_root_id", $root_id);
							$l_catObj->setNumber("category_node_left", $left);
							$l_catObj->setNumber("category_node_right", $right);
							$l_catObj->Save();
						}
					}
				}

				$this->setFullTextSearch();
				system_countActiveListingByCategory($this->id);
			}
		}

		function updateCategoryStatusByID(){
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);

			$sql_update = "UPDATE Listing_Category SET status = $this->status WHERE listing_id = $this->id";
			$dbObj->query($sql_update);
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$listingObj->retrieveListingsbyPromotion_id($promotion_id);
		 * <br /><br />
		 *		//Using this in Listing() class.
		 *		$this->retrieveListingsbyPromotion_id($promotion_id);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name retrieveListingsbyPromotion_id
		 * @access Public
		 * @param integer $promotion_id
		 * @return array $listings
		 */
		function retrieveListingsbyPromotion_id($promotion_id) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
			$sql = "SELECT * FROM Listing WHERE promotion_id = $promotion_id 
											 OR promotion_id_two = $promotion_id 
											 OR promotion_id_three = $promotion_id 
											 OR promotion_id_four = $promotion_id 
											 OR promotion_id_five = $promotion_id";
			$r = $dbObj->query($sql);
			while ($row = mysql_fetch_assoc($r)) {
				$listings[] = new Listing($row["id"]);
			}
			return $listings;
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$listingObj->getPrice();
		 * <br /><br />
		 *		//Using this in Listing() class.
		 *		$this->getPrice();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getPrice
		 * @access Public
		 * @return double $price
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

			/*
			 * Check if have price by package
			 */
			$levelObj = new ListingLevel();
			if($this->package_id){
				$price = $this->package_price;
			}else{
				$price = $price + $levelObj->getPrice($this->level);
			}

			$sql = "SELECT COUNT(id) AS total FROM Listing_Category WHERE listing_id = ".$this->id;
			$result = $dbObj->query($sql);
			if(mysql_num_rows($result) > 0){
				$row = mysql_fetch_assoc($result);
				$category_amount = $row["total"];
			}

			if($this->categories && !$this->id){
				$category_amount = $this->categories;
			}

			if (($category_amount > 0) && (($category_amount - $levelObj->getFreeCategory($this->level)) > 0)) {
				$extra_category_amount = $category_amount - $levelObj->getFreeCategory($this->level);
			} else {
				$extra_category_amount = 0;
			}

			if ($extra_category_amount > 0) $price = $price + ($levelObj->getCategoryPrice($this->level) * $extra_category_amount);

			if (LISTINGTEMPLATE_FEATURE == "on") {
				if ($this->listingtemplate_id) {
					$listingTemplateObj = new ListingTemplate($this->listingtemplate_id);
					if ($listingTemplateObj->getString("status") == "enabled") {
						$price = $price + $listingTemplateObj->getString("price");
					} else {
						$sql = "UPDATE Listing SET listingtemplate_id = 0 WHERE id = ".$this->id;
						$result = $dbObj->query($sql);

						/*
						 * Populate Listings to front
						 */
						$sql = "UPDATE Listing_Summary SET
									listingtemplate_id = 0,
									template_layout_id = 0,
									template_cat_id = 0,
									template_title = '',
									template_friendly_url = '',
									template_status = '',
									template_price = 0
								WHERE id = $this->id";
						$result = $dbObj->query($sql);
					}
				}
			}

			if ($this->discount_id) {

				$discountCodeObj = new DiscountCode($this->discount_id);

				if (is_valid_discount_code($this->discount_id, "listing", $this->id, $discount_message, $discount_error)) {

					if ($discountCodeObj->getString("id") && $discountCodeObj->expire_date >= date('Y-m-d')) {

						if ($discountCodeObj->getString("type") == "percentage") {
							$price = $price * (1 - $discountCodeObj->getString("amount")/100);
						} elseif ($discountCodeObj->getString("type") == "monetary value") {
							$price = $price - $discountCodeObj->getString("amount");
						}

					} elseif (($discountCodeObj->type == 'percentage' && $discountCodeObj->amount == '100.00') || ($discountCodeObj->type == 'monetary value' && $discountCodeObj->amount > $price)) {

						$this->status = 'E';
						$this->renewal_date = $discountCodeObj->expire_date;
						$sql = "UPDATE Listing SET status = 'E', renewal_date = '".$discountCodeObj->expire_date."', discount_id = '' WHERE id = ".$this->id;
						$result = $dbObj->query($sql);
                        
                        $sql = "UPDATE Promotion SET listing_status = 'E' WHERE listing_id = ".$this->id;
						$result = $dbObj->query($sql);

						/*
						 * Populate Listings to front
						 */
						$sql = "UPDATE Listing_Summary SET
									status = 'E',
									renewal_date = '".$discountCodeObj->expire_date."'
								WHERE id = $this->id";
						$result = $dbObj->query($sql);
					}

				} else {

					if ( ($discountCodeObj->type == 'percentage' && $discountCodeObj->amount == '100.00') || ($discountCodeObj->type == 'monetary value' && $discountCodeObj->amount > $price) ) {
						$this->status = 'E';
						$this->renewal_date = $discountCodeObj->expire_date;
						$sql = "UPDATE Listing SET status = 'E', renewal_date = '".$discountCodeObj->expire_date."', discount_id = '' WHERE id = ".$this->id;

						/*
						 * Populate Listings to front
						 */
						$sql2 = "UPDATE Listing_Summary SET
									status = 'E',
									renewal_date = '".$discountCodeObj->expire_date."'
								WHERE id = $this->id";
						$result = $dbObj->query($sql2);
                        
                        $sql3 = "UPDATE Promotion SET listing_status = 'E' WHERE listing_id = ".$this->id;
						$result = $dbObj->query($sql3);
                        
					} else {
						$sql = "UPDATE Listing SET discount_id = '' WHERE id = ".$this->id;
					}
					$result = $dbObj->query($sql);
				}

			}
			
			// get extra deals price (by Debiprasad on 17th Aug., 2012
			if ($this->extra_promotion) {
				// get extra deals price
				$sql = "SELECT * FROM PromotionPricing ORDER BY extra_promotion";
                $result = $dbObj->query($sql);
                $extra_promotion_price = array();

                while ($row = mysql_fetch_assoc($result)) {
                	$extra_promotion_price[$row['extra_promotion']] = $row['price'];
                }
                
                for ($deal = 2; $deal <= $this->extra_promotion; $deal++) {
                	$price = $price + $extra_promotion_price[$deal];
                }
			}

			if ($price <= 0) $price = 0;

			return $price;

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$listingObj->hasRenewalDate();
		 * <br /><br />
		 *		//Using this in Listing() class.
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
		 *		$listingObj->needToCheckOut();
		 * <br /><br />
		 *		//Using this in Listing() class.
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
		 *		$listingObj->getNextRenewalDate($times);
		 * <br /><br />
		 *		//Using this in Listing() class.
		 *		$this->getNextRenewalDate($times);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getNextRenewalDate
		 * @access Public
		 * @param integer $times
		 * @return date $nextrenewaldate
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

				$renewalcycle = payment_getRenewalCycle("listing");
				$renewalunit = payment_getRenewalUnit("listing");

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
		 *		//Using this in forms or other pages.
		 *		$listingObj->setLocationManager($locationManager);
		 * <br /><br />
		 *		//Using this in Listing() class.
		 *		$this->setLocationManager($locationManager);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name setLocationManager
		 * @access Public
		 * @param mixed &$locationManager
		 */
		function setLocationManager(&$locationManager){
			$this->locationManager =& $locationManager;
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$listingObj->getLocationManager();
		 * <br /><br />
		 *		//Using this in Listing() class.
		 *		$this->getLocationManager();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getLocationManager
		 * @access Public
		 * @return mixed &$this->locationManager
		 */
		function &getLocationManager(){
			return $this->locationManager; /* NEVER auto-instantiate this*/
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$listingObj->getLocationString(...);
		 * <br /><br />
		 *		//Using this in Listing() class.
		 *		$this->getLocationString(...);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getLocationString
		 * @access Public
		 * @param varchar $format
		 * @param boolean $forceManagerCreation
		 * @return string locationString
		 */
		function getLocationString($format, $forceManagerCreation = false){
			if($forceManagerCreation && !$this->locationManager) $this->locationManager = new LocationManager();
			return db_getLocationString($this, $format);
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$listingObj->setFullTextSearch();
		 * <br /><br />
		 *		//Using this in Listing() class.
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
				$fulltextsearch_keyword[] = $this->title;
                $addkeyword=format_addApostWords($this->title);
                if ($addkeyword) $fulltextsearch_keyword[] =$addkeyword;
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
                
                if ($this->{"description".$lang_index}) {
                    $fulltextsearch_keyword[] = string_substr($this->{"description".$lang_index}, 0, 100);
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

			$categories = $this->getCategories(false, false, $this->id, true, true);
			if ($categories) {
				foreach ($categories as $category) {
					unset($parents);
					$category_id = $category->getNumber("id");
					while ($category_id != 0) {
						$sql = "SELECT * FROM ListingCategory WHERE id = $category_id";
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
				$sql = "UPDATE Listing SET fulltextsearch_keyword = $fulltextsearch_keyword_sql WHERE id = $this->id";
				$result = $dbObj->query($sql);

				$sql = "UPDATE Listing_Summary SET fulltextsearch_keyword = $fulltextsearch_keyword_sql WHERE id = $this->id";
				$result = $dbObj->query($sql);

			}
			if (is_array($fulltextsearch_where)) {
				$fulltextsearch_where_sql = db_formatString(implode(" ", $fulltextsearch_where));
				$sql = "UPDATE Listing SET fulltextsearch_where = $fulltextsearch_where_sql WHERE id = $this->id";
				$result = $dbObj->query($sql);

				$sql = "UPDATE Listing_Summary SET fulltextsearch_where = $fulltextsearch_where_sql WHERE id = $this->id";
				$result = $dbObj->query($sql);
                
                $sql = "UPDATE Promotion SET fulltextsearch_where = $fulltextsearch_where_sql WHERE listing_id = $this->id";
				$result = $dbObj->query($sql);
			}

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$listingObj->getGalleries();
		 * <br /><br />
		 *		//Using this in Listing() class.
		 *		$this->getGalleries();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getGalleries
		 * @access Public
		 * @return array $galleries
		 */
		function getGalleries() {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
			$sql = "SELECT * FROM Gallery_Item WHERE item_type='listing' AND item_id = $this->id ORDER BY gallery_id";
			$r = $dbObj->query($sql);
			if ($this->id > 0) while ($row = mysql_fetch_array($r)) $galleries[] = $row["gallery_id"];
			return $galleries;
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$listingObj->setGalleries($gallery);
		 * <br /><br />
		 *		//Using this in Listing() class.
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
			$sql = "DELETE FROM Gallery_Item WHERE item_type='listing' AND item_id = $this->id";
			$dbObj->query($sql);

			if ($gallery) {
				$sql = "INSERT INTO Gallery_Item (item_id, gallery_id, item_type) VALUES ($this->id, $gallery, 'listing')";
				$rs3 = $dbObj->query($sql);
			}
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$listingObj->setMapTuning(...);
		 * <br /><br />
		 *		//Using this in Listing() class.
		 *		$this->setMapTuning(...);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name setMapTuning
		 * @access Public
		 * @param varchar $latitude_longitude
		 * @param integer $map_zoom
		 */
		function setMapTuning($latitude_longitude = "", $map_zoom) {
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
			
			$sql = "UPDATE Listing SET latitude = ".db_formatString($latitude).", longitude = ".db_formatString($longitude).", map_zoom = ".db_formatNumber($map_zoom)." WHERE id = ".$this->id."";
			$dbObj->query($sql);
            
            $sql = "UPDATE Promotion SET listing_latitude = ".db_formatString($latitude).", listing_longitude = ".db_formatString($longitude)." WHERE listing_id = ".$this->id."";
			$dbObj->query($sql);
			/*
			 * Populate Listings to front
			 */
			unset($listingSummaryObj);
			$listingSummaryObj = new ListingSummary();
			$listingSummaryObj->PopulateTable($this->id, "update");
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$listingObj->setNumberViews($id);
		 * <br /><br />
		 *		//Using this in Listing() class.
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
			$sql = "UPDATE Listing SET number_views = ".$this->number_views." + 1 WHERE Listing.id = ".$id;
			$dbObj->query($sql);
			/*
			 * Populate Listings to front
			 */
			unset($listingSummaryObj);
			$listingSummaryObj = new ListingSummary();
			$listingSummaryObj->PopulateTable($this->id, "update");

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$listingObj->setAvgReview(...);
		 * <br /><br />
		 *		//Using this in Listing() class.
		 *		$this->setAvgReview(...);
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
			$sql = "UPDATE Listing SET avg_review = ".$avg." WHERE Listing.id = ".$id;
			$dbObj->query($sql);
			/*
			 * Populate Listings to front
			 */
			unset($listingSummaryObj);
			$listingSummaryObj = new ListingSummary();
			$listingSummaryObj->PopulateTable($id, "update");
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$listingObj->hasDetail();
		 * <br /><br />
		 *		//Using this in Listing() class.
		 *		$this->hasDetail();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name hasDetail
		 * @access Public
		 * @return mixed $detail
		 */
		function hasDetail() {
			$listingLevel = new ListingLevel();
			$detail = $listingLevel->getDetail($this->level);
			unset($listingLevel);
			return $detail;
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$listingObj->deletePerAccount($account_id);
		 * <br /><br />
		 *		//Using this in Listing() class.
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
				$sql = "SELECT * FROM Listing WHERE account_id = $account_id";
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
		 *		$listingObj->SaveToFeaturedTemp();
		 * <br /><br />
		 *		//Using this in Listing() class.
		 *		$this->SaveToFeaturedTemp();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name SaveToFeaturedTemp
		 * @access Public
		 */
		function SaveToFeaturedTemp(){
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$db = db_getDBObject();
			}

			unset($dbMain);
			$sql = "INSERT INTO Listing_FeaturedTemp (listing_id,status) VALUES (".$this->id.",'R')";
			$db->query($sql);
		}

		/**
		 * This code is modified by Debiprasad on 11 Aug. 2012
		 * 
		 * @param 
		 */
        function removePromotionID($promotion_id = false, $deal_number = ''){
        	if (!$promotion_id)
        		$promotion_id = $this->promotion_id;
        
            if (!$this->id){
                return false;
            }
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if (defined("SELECTED_DOMAIN_ID")) {
                $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $db = db_getDBObject();
            }
            unset($dbMain);
            /*
             * Clear Promotion table
             */
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
                    WHERE id = ".$promotion_id; // changed by Debiprasad
            $db->query($sql);
            
            /**
             * Clear Listing Table
             */
            $sql_1 = "UPDATE Listing SET promotion_id" . $deal_number . " = 0 WHERE id = $this->id";
            $sql_2 = "UPDATE Listing_Summary SET promotion_id" . $deal_number . " = 0, promotion_start_date" . $deal_number . " = '0000-00-00', promotion_end_date" . $deal_number . " = '0000-00-00' WHERE id = $this->id";
            if($db->query($sql_1) && $db->query($sql_2)){
                return true;
            }
        }
         
        function getFriendlyURL($mobile = false){
        	if($mobile){
        		$aux_url = DEFAULT_URL."/mobile/".LISTING_FEATURE_FOLDER;
        	}else{
        		$aux_url = LISTING_DEFAULT_URL;
        	}
        
        	if(MODREWRITE_FEATURE == "on"){
	        	return $aux_url."/".$this->friendly_url.".html";
        	}else{
        		return $aux_url."/detail.php?id=".$this->id;
        	}
		}
		
		function getListingByFriendlyURL($friendly_url){
			$dbObj = db_getDBObject();
			$sql = "SELECT * FROM Listing WHERE friendly_url = '".$friendly_url."'";
			$result = $dbObj->query($sql);
			if(mysql_num_rows($result)){
				$this->makeFromRow(mysql_fetch_assoc($result));
				return true;
			}else{
				return false;
			}
			
		}
		
	}
?>