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
	# * FILE: /classes/class_ListingSummary.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$listingObj = new ListingSummary($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name ListingSummary
	 * @method ListingSummary
	 * @method makeFromRow
	 * @method Add
	 * @method Update
	 * @method Delete
	 * @method PopulateTable
	 * @method PopulateTableCategory
	 * @method PopulateTableLocation
	 * @access Public
	 */
	class ListingSummary extends Handle {
		/**
		 * @var integer
		 * @access Private
		 */
		var $id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $legacy_id;
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
		 * @var varchar
		 * @access Private
		 */
		var $location_1_title;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $location_1_abbreviation;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $location_1_friendly_url;
		/**
		 * @var integer
		 * @access Private
		 */
		var $location_2;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $location_2_title;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $location_2_abbreviation;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $location_2_friendly_url;
		/**
		 * @var integer
		 * @access Private
		 */
		var $location_3;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $location_3_title;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $location_3_abbreviation;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $location_3_friendly_url;
		/**
		 * @var integer
		 * @access Private
		 */
		var $location_4;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $location_4_title;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $location_4_abbreviation;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $location_4_friendly_url;
		/**
		 * @var integer
		 * @access Private
		 */
		var $location_5;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $location_5_title;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $location_5_abbreviation;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $location_5_friendly_url;

		/**
		 * @var varchar
		 * @access Private
		 */
		var $title;
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
		 * @var char
		 * @access Private
		 */
		var $show_email;
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
		 * @var double
		 * @access Private
		 */
		var $latitude;
		/**
		 * @var double
		 * @access Private
		 */
		var $longitude;
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
		 * @var date
		 * @access Private
		 */
		var $renewal_date;
		/**
		 * @var integer
		 * @access Private
		 */
		var $level;
		/**
		 * @var integer
		 * @access Private
		 */
		var $random_number;
		/**
		 * @var char
		 * @access Private
		 */
		var $claim_disable;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $locations;
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
		
		var $fulltextsearch_keyword;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $fulltextsearch_where;
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
		 * @var date
		 * @access Private
		 */
		var $promotion_start_date;
		/**
		 * @var date
		 * @access Private
		 */
		var $promotion_end_date;
		/**
		 * @var integer
		 * @access Private
		 */
		var $promotion_start_date_two;
		/**
		 * @var date
		 * @access Private
		 */
		var $promotion_end_date_two;
		/**
		 * @var integer
		 * @access Private
		 */
		var $promotion_start_date_three;
		/**
		 * @var date
		 * @access Private
		 */
		var $promotion_end_date_three;
		/**
		 * @var integer
		 * @access Private
		 */
		var $promotion_start_date_four;
		/**
		 * @var date
		 * @access Private
		 */
		var $promotion_end_date_four;
		/**
		 * @var integer
		 * @access Private
		 */
		var $promotion_start_date_five;
		/**
		 * @var date
		 * @access Private
		 */
		var $promotion_end_date_five;
		/**
		 * @var integer
		 * @access Private
		 */
		var $thumb_id;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $thumb_type;
		/**
		 * @var integer
		 * @access Private
		 */
		var $thumb_width;
		/**
		 * @var integer
		 * @access Private
		 */
		var $thumb_height;
		/**
		 * @var integer
		 * @access Private
		 */
		var $listingtemplate_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $template_layout_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $template_cat_id;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $template_title;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $template_friendly_url;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $template_status;
		/**
		 * @var integer
		 * @access Private
		 */
		var $image_id;
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
		var $domain_id;
		/**
		 * @var char
		 * @access Private
		 */
		var $backlink;
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
		 * <code>
		 *		$listingObj = new ListingSummary($id);
		 *		//OR
		 *		$listingObj = new ListingSummary($row);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name ListingSummary
		 * @access Public
		 * @param mixed $var
		 */
		function ListingSummary($var='') {

			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
//				$dbMain->close();
				unset($dbMain);
				$sql = "SELECT * FROM Listing_Summary WHERE id = $var";
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
			$this->id								= ($row["id"])						? $row["id"]							: 0;
			$this->legacy_id						= ($row["legacy_id"])				? $row["legacy_id"]						: 0;
			$this->account_id						= ($row["account_id"])				? $row["account_id"]					: 0;

			$this->location_1						= ($row["location_1"])				? $row["location_1"]					: 0;
			$this->location_1_title					= ($row["location_1_title"])		? $row["location_1_title"]				: "";
			$this->location_1_abbreviation			= ($row["location_1_abbreviation"])	? $row["location_1_abbreviation"]		: "";
			$this->location_1_friendly_url			= ($row["location_1_friendly_url"])	? $row["location_1_friendly_url"]		: "";
			
			$this->location_2						= ($row["location_2"])				? $row["location_2"]					: 0;
			$this->location_2_title					= ($row["location_2_title"])		? $row["location_2_title"]				: "";
			$this->location_2_abbreviation			= ($row["location_2_abbreviation"])	? $row["location_2_abbreviation"]		: "";
			$this->location_2_friendly_url			= ($row["location_2_friendly_url"])	? $row["location_2_friendly_url"]		: "";
			
			$this->location_3						= ($row["location_3"])				? $row["location_3"]					: 0;
			$this->location_3_title					= ($row["location_3_title"])		? $row["location_3_title"]				: "";
			$this->location_3_abbreviation			= ($row["location_3_abbreviation"])	? $row["location_3_abbreviation"]		: "";
			$this->location_3_friendly_url			= ($row["location_3_friendly_url"])	? $row["location_3_friendly_url"]		: "";
			
			$this->location_4						= ($row["location_4"])				? $row["location_4"]					: 0;
			$this->location_4_title					= ($row["location_4_title"])		? $row["location_4_title"]				: "";
			$this->location_4_abbreviation			= ($row["location_4_abbreviation"])	? $row["location_4_abbreviation"]		: "";
			$this->location_4_friendly_url			= ($row["location_4_friendly_url"])	? $row["location_4_friendly_url"]		: "";
			
			$this->location_5						= ($row["location_5"])				? $row["location_5"]					: 0;
			$this->location_5_title					= ($row["location_5_title"])		? $row["location_5_title"]				: "";
			$this->location_5_abbreviation			= ($row["location_5_abbreviation"])	? $row["location_5_abbreviation"]		: "";
			$this->location_5_friendly_url			= ($row["location_5_friendly_url"])	? $row["location_5_friendly_url"]		: "";

			$this->title							= ($row["title"])					? $row["title"]							: "";
			$this->friendly_url						= ($row["friendly_url"])			? $row["friendly_url"]					: "";
			$this->email							= ($row["email"])					? $row["email"]							: "";
			$this->url								= ($row["url"])						? $row["url"]							: "";
			$this->display_url						= ($row["display_url"])				? $row["display_url"]					: "";
			$this->address							= ($row["address"])					? $row["address"]						: "";
			$this->address2							= ($row["address2"])				? $row["address2"]						: "";
			$this->zip_code							= ($row["zip_code"])				? $row["zip_code"]						: "";
			$this->phone							= ($row["phone"])					? $row["phone"]							: "";
			$this->fax								= ($row["fax"])						? $row["fax"]							: "";

			$this->description1						= ($row["description1"])			? $row["description1"]					: "";
			$this->description2						= ($row["description2"])			? $row["description2"]						: "";
			$this->description3						= ($row["description3"])			? $row["description3"]						: "";
			$this->description4						= ($row["description4"])			? $row["description4"]						: "";
			$this->description5						= ($row["description5"])			? $row["description5"]						: "";
			$this->description6						= ($row["description6"])			? $row["description6"]						: "";
			$this->description7						= ($row["description7"])			? $row["description7"]						: "";

			$this->show_email						= ($row["show_email"])				? $row["show_email"]						: "";
			$this->zip5								= ($row["zip5"])					? $row["zip5"]								: "";
			$this->latitude							= ($row["latitude"])				? $row["latitude"]							: "";
			$this->longitude						= ($row["longitude"])				? $row["longitude"]							: "";

			$this->attachment_file					= ($row["attachment_file"])			? $row["attachment_file"]					: "";
			$this->attachment_caption				= ($row["attachment_caption"])		? $row["attachment_caption"]				: "";
			$this->status							= ($row["status"])					? $row["status"]							: "";
			$this->setDate("renewal_date", $row["renewal_date"]);
			$this->level							= ($row["level"])					? $row["level"]								: "";
			$this->random_number					= ($row["random_number"])			? $row["random_number"]						: 0;
			$this->claim_disable					= ($row["claim_disable"])			? $row["claim_disable"]						: "n";
			$this->locations						= ($row["locations"])				? $row["locations"]							: "";

			$this->keywords1						= ($row["keywords1"])				? $row["keywords1"]								: "";
			$this->keywords2						= ($row["keywords2"])				? $row["keywords2"]								: "";
			$this->keywords3						= ($row["keywords3"])				? $row["keywords3"]								: "";
			$this->keywords4						= ($row["keywords4"])				? $row["keywords4"]								: "";
			$this->keywords5						= ($row["keywords5"])				? $row["keywords5"]								: "";
			$this->keywords6						= ($row["keywords6"])				? $row["keywords6"]								: "";
			$this->keywords7						= ($row["keywords7"])				? $row["keywords7"]								: "";

			$this->seo_keywords1					= ($row["seo_keywords1"])			? $row["seo_keywords1"]							: ($this->seo_keywords1		? $this->seo_keywords1		: "");
			$this->seo_keywords2					= ($row["seo_keywords2"])			? $row["seo_keywords2"]							: ($this->seo_keywords2		? $this->seo_keywords2		: "");
			$this->seo_keywords3					= ($row["seo_keywords3"])			? $row["seo_keywords3"]							: ($this->seo_keywords3		? $this->seo_keywords3		: "");
			$this->seo_keywords4					= ($row["seo_keywords4"])			? $row["seo_keywords4"]							: ($this->seo_keywords4		? $this->seo_keywords4		: "");
			$this->seo_keywords5					= ($row["seo_keywords5"])			? $row["seo_keywords5"]							: ($this->seo_keywords5		? $this->seo_keywords5		: "");
			$this->seo_keywords6					= ($row["seo_keywords6"])			? $row["seo_keywords6"]							: ($this->seo_keywords6		? $this->seo_keywords6		: "");
			$this->seo_keywords7					= ($row["seo_keywords7"])			? $row["seo_keywords7"]							: ($this->seo_keywords7		? $this->seo_keywords7		: "");
			
			$this->fulltextsearch_keyword			= ($row["fulltextsearch_keyword"])	? $row["fulltextsearch_keyword"]				: "";
			$this->fulltextsearch_where				= ($row["fulltextsearch_where"])	? $row["fulltextsearch_where"]					: "";
			$this->custom_checkbox0					= ($row["custom_checkbox0"])		? $row["custom_checkbox0"]		: "";
			$this->custom_checkbox1					= ($row["custom_checkbox1"])		? $row["custom_checkbox1"]		: "";
			$this->custom_checkbox2					= ($row["custom_checkbox2"])		? $row["custom_checkbox2"]		: "";
			$this->custom_checkbox3					= ($row["custom_checkbox3"])		? $row["custom_checkbox3"]		: "";
			$this->custom_checkbox4					= ($row["custom_checkbox4"])		? $row["custom_checkbox4"]		: "";
			$this->custom_checkbox5					= ($row["custom_checkbox5"])		? $row["custom_checkbox5"]		: "";
			$this->custom_checkbox6					= ($row["custom_checkbox6"])		? $row["custom_checkbox6"]		: "";
			$this->custom_checkbox7					= ($row["custom_checkbox7"])		? $row["custom_checkbox7"]		: "";
			$this->custom_checkbox8					= ($row["custom_checkbox8"])		? $row["custom_checkbox8"]		: "";
			$this->custom_checkbox9					= ($row["custom_checkbox9"])		? $row["custom_checkbox9"]		: "";
			$this->custom_dropdown0					= ($row["custom_dropdown0"])		? $row["custom_dropdown0"]		: "";
			$this->custom_dropdown1					= ($row["custom_dropdown1"])		? $row["custom_dropdown1"]		: "";
			$this->custom_dropdown2					= ($row["custom_dropdown2"])		? $row["custom_dropdown2"]		: "";
			$this->custom_dropdown3					= ($row["custom_dropdown3"])		? $row["custom_dropdown3"]		: "";
			$this->custom_dropdown4					= ($row["custom_dropdown4"])		? $row["custom_dropdown4"]		: "";
			$this->custom_dropdown5					= ($row["custom_dropdown5"])		? $row["custom_dropdown5"]		: "";
			$this->custom_dropdown6					= ($row["custom_dropdown6"])		? $row["custom_dropdown6"]		: "";
			$this->custom_dropdown7					= ($row["custom_dropdown7"])		? $row["custom_dropdown7"]		: "";
			$this->custom_dropdown8					= ($row["custom_dropdown8"])		? $row["custom_dropdown8"]		: "";
			$this->custom_dropdown9					= ($row["custom_dropdown9"])		? $row["custom_dropdown9"]		: "";

			$this->custom_text0						= ($row["custom_text0"])			? $row["custom_text0"]			: "";
			$this->custom_text1						= ($row["custom_text1"])			? $row["custom_text1"]			: "";
			$this->custom_text2						= ($row["custom_text2"])			? $row["custom_text2"]			: "";
			$this->custom_text3						= ($row["custom_text3"])			? $row["custom_text3"]			: "";
			$this->custom_text4						= ($row["custom_text4"])			? $row["custom_text4"]			: "";
			$this->custom_text5						= ($row["custom_text5"])			? $row["custom_text5"]			: "";
			$this->custom_text6						= ($row["custom_text6"])			? $row["custom_text6"]			: "";
			$this->custom_text7						= ($row["custom_text7"])			? $row["custom_text7"]			: "";
			$this->custom_text8						= ($row["custom_text8"])			? $row["custom_text8"]			: "";
			$this->custom_text9						= ($row["custom_text9"])			? $row["custom_text9"]			: "";
			$this->custom_short_desc0				= ($row["custom_short_desc0"])		? $row["custom_short_desc0"]	: "";
			$this->custom_short_desc1				= ($row["custom_short_desc1"])		? $row["custom_short_desc1"]	: "";
			$this->custom_short_desc2				= ($row["custom_short_desc2"])		? $row["custom_short_desc2"]	: "";
			$this->custom_short_desc3				= ($row["custom_short_desc3"])		? $row["custom_short_desc3"]	: "";
			$this->custom_short_desc4				= ($row["custom_short_desc4"])		? $row["custom_short_desc4"]	: "";
			$this->custom_short_desc5				= ($row["custom_short_desc5"])		? $row["custom_short_desc5"]	: "";
			$this->custom_short_desc6				= ($row["custom_short_desc6"])		? $row["custom_short_desc6"]	: "";
			$this->custom_short_desc7				= ($row["custom_short_desc7"])		? $row["custom_short_desc7"]	: "";
			$this->custom_short_desc8				= ($row["custom_short_desc8"])		? $row["custom_short_desc8"]	: "";
			$this->custom_short_desc9				= ($row["custom_short_desc9"])		? $row["custom_short_desc9"]	: "";
			$this->custom_long_desc0				= ($row["custom_long_desc0"])		? $row["custom_long_desc0"]		: "";
			$this->custom_long_desc1				= ($row["custom_long_desc1"])		? $row["custom_long_desc1"]		: "";
			$this->custom_long_desc2				= ($row["custom_long_desc2"])		? $row["custom_long_desc2"]		: "";
			$this->custom_long_desc3				= ($row["custom_long_desc3"])		? $row["custom_long_desc3"]		: "";
			$this->custom_long_desc4				= ($row["custom_long_desc4"])		? $row["custom_long_desc4"]		: "";
			$this->custom_long_desc5				= ($row["custom_long_desc5"])		? $row["custom_long_desc5"]		: "";
			$this->custom_long_desc6				= ($row["custom_long_desc6"])		? $row["custom_long_desc6"]		: "";
			$this->custom_long_desc7				= ($row["custom_long_desc7"])		? $row["custom_long_desc7"]		: "";
			$this->custom_long_desc8				= ($row["custom_long_desc8"])		? $row["custom_long_desc8"]		: "";
			$this->custom_long_desc9				= ($row["custom_long_desc9"])		? $row["custom_long_desc9"]		: "";
			$this->number_views						= ($row["number_views"])			? $row["number_views"]			: 0;
			$this->avg_review						= ($row["avg_review"])				? $row["avg_review"]			: 0;
			$this->setDate("promotion_start_date", $row["promotion_start_date"]);
			$this->setDate("promotion_end_date", $row["promotion_end_date"]);
			$this->setDate("promotion_start_date_two", $row["promotion_start_date_two"]);
			$this->setDate("promotion_end_date_two", $row["promotion_end_date_two"]);
			$this->setDate("promotion_start_date_three", $row["promotion_start_date_three"]);
			$this->setDate("promotion_end_date_three", $row["promotion_end_date_three"]);
			$this->setDate("promotion_start_date_four", $row["promotion_start_date_four"]);
			$this->setDate("promotion_end_date_four", $row["promotion_end_date_four"]);
			$this->setDate("promotion_start_date_five", $row["promotion_start_date_five"]);
			$this->setDate("promotion_end_date_five", $row["promotion_end_date_five"]);

			$this->thumb_id							= ($row["thumb_id"])						? $row["thumb_id"]							: 0;
			$this->image_id							= ($row["image_id"])						? $row["image_id"]							: 0;
			$this->thumb_type						= ($row["thumb_type"])						? $row["thumb_type"]						: 0;
			$this->thumb_width						= ($row["thumb_width"])						? $row["thumb_width"]						: 0;
			$this->thumb_height						= ($row["thumb_height"])					? $row["thumb_height"]						: 0;
			$this->listingtemplate_id				= ($row["listingtemplate_id"])				? $row["listingtemplate_id"]				: 0;
			$this->template_layout_id				= ($row["template_layout_id"])				? $row["template_layout_id"]				: 0;
			$this->template_cat_id					= ($row["template_cat_id"])					? $row["template_cat_id"]					: 0;
			$this->template_title					= ($row["template_title"])					? $row["template_title"]					: "";
			$this->template_friendly_url			= ($row["template_friendly_url"])			? $row["template_friendly_url"]				: "";
			$this->template_status					= ($row["template_status"])					? $row["template_status"]					: "";
			$this->template_price					= ($row["template_price"])					? $row["template_price"]					: "0.00";
			
			$this->entered							= ($row["entered"])							? $row["entered"]							: ($this->entered				? $this->entered					: "");
			$this->updated							= ($row["updated"])							? $row["updated"]							: ($this->updated				? $this->updated					: "");
			$this->promotion_id						= ($row["promotion_id"])					? $row["promotion_id"]						: 0;
			$this->promotion_id_two					= ($row["promotion_id_two"])				? $row["promotion_id_two"]					: 0;
			$this->promotion_id_three				= ($row["promotion_id_three"])				? $row["promotion_id_three"]				: 0;
			$this->promotion_id_four				= ($row["promotion_id_four"])				? $row["promotion_id_four"]					: 0;
			$this->promotion_id_five				= ($row["promotion_id_five"])				? $row["promotion_id_five"]					: 0;
			$this->extra_promotion					= ($row["extra_promotion"])					? $row["extra_promotion"]					: 0;
			$this->backlink							= ($row["backlink"])						? $row["backlink"]							: ($this->backlink				? $this->backlink					: "n");
			$this->clicktocall_number				= ($row["clicktocall_number"])				? $row["clicktocall_number"]				: ($this->clicktocall_number	? $this->clicktocall_number			: "");
			$this->clicktocall_extension			= ($row["clicktocall_extension"])			? $row["clicktocall_extension"]				: ($this->clicktocall_extension	? $this->clicktocall_extension		: 0);
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$listingObj->Update();
		 * <br /><br />
		 *		//Using this in ListingSummary() class.
		 *		$this->Update();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Update
		 * @access Public
		 */
		function Update(){

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			
			if ($this->domain_id){
				$dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
			} else	if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
			$this->prepareToSave();

			$sql = "UPDATE Listing_Summary SET "
					. " account_id = $this->account_id,"
					. " location_1 = $this->location_1,"
					. " location_1_title = $this->location_1_title,"
					. " location_1_abbreviation = $this->location_1_abbreviation,"
					. " location_1_friendly_url = $this->location_1_friendly_url,"
					. " location_2 = $this->location_2,"
					. " location_2_title = $this->location_2_title,"
					. " location_2_abbreviation = $this->location_2_abbreviation,"
					. " location_2_friendly_url = $this->location_2_friendly_url,"
					. " location_3 = $this->location_3,"
					. " location_3_title = $this->location_3_title,"
					. " location_3_abbreviation = $this->location_3_abbreviation,"
					. " location_3_friendly_url = $this->location_3_friendly_url,"
					. " location_4 = $this->location_4,"
					. " location_4_title = $this->location_4_title,"
					. " location_4_abbreviation = $this->location_4_abbreviation,"
					. " location_4_friendly_url = $this->location_4_friendly_url,"
					. " location_5 = $this->location_5,"
					. " location_5_title = $this->location_5_title,"
					. " location_5_abbreviation = $this->location_5_abbreviation,"
					. " location_5_friendly_url = $this->location_5_friendly_url,"
					. " title = $this->title,"
					. " friendly_url = $this->friendly_url,"
					. " email = $this->email,"
					. " show_email = $this->show_email,"
					. " url = $this->url,"
					. " display_url = $this->display_url,"
					. " address = $this->address,"
					. " address2 = $this->address2,"
					. " zip_code = $this->zip_code,"
					. " zip5 = $this->zip5,"
					. " latitude = $this->latitude,"
					. " longitude = $this->longitude,"
					. " phone = $this->phone,"
					. " fax = $this->fax,"
					. " description1 = $this->description1,"
					. " description2 = $this->description2,"
					. " description3 = $this->description3,"
					. " description4 = $this->description4,"
					. " description5 = $this->description5,"
					. " description6 = $this->description6,"
					. " description7 = $this->description7,"
					. " attachment_file = $this->attachment_file,"
					. " attachment_caption = $this->attachment_caption,"
					. " status = $this->status,"
					. " renewal_date = $this->renewal_date,"
					. " level = $this->level,"
					. " random_number = $this->random_number,"
					. " claim_disable = $this->claim_disable,"
					. " locations = $this->locations,"
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
					. " fulltextsearch_keyword = $this->fulltextsearch_keyword,"
					. " fulltextsearch_where = $this->fulltextsearch_where,"
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
					. " number_views		= $this->number_views,"
					. " avg_review			= $this->avg_review,"
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
					. " promotion_start_date = $this->promotion_start_date,"
					. " promotion_end_date = $this->promotion_end_date,"
					. " promotion_start_date_two = $this->promotion_start_date_two,"
					. " promotion_end_date_two = $this->promotion_end_date_two,"
					. " promotion_start_date_three = $this->promotion_start_date_three,"
					. " promotion_end_date_three = $this->promotion_end_date_three,"
					. " promotion_start_date_four = $this->promotion_start_date_four,"
					. " promotion_end_date_four = $this->promotion_end_date_four,"
					. " promotion_start_date_five = $this->promotion_start_date_five,"
					. " promotion_end_date_five = $this->promotion_end_date_five,"
					. " thumb_id = $this->thumb_id,"
					. " thumb_type = $this->thumb_type,"
					. " thumb_width= $this->thumb_width,"
					. " thumb_height = $this->thumb_height,"
					. " listingtemplate_id = $this->listingtemplate_id,"
					. " template_layout_id = $this->template_layout_id,"
					. " template_cat_id = $this->template_cat_id,"
					. " template_title = $this->template_title,"
					. " template_friendly_url = $this->template_friendly_url,"
					. " template_status = $this->template_status,"
					. " template_price = $this->template_price,"
					. " image_id = $this->image_id,"
					. " updated = $this->updated,"
					. " entered = $this->entered,"
					. " promotion_id = $this->promotion_id,"
					. " promotion_id_two = $this->promotion_id_two,"
					. " promotion_id_three = $this->promotion_id_three,"
					. " promotion_id_four = $this->promotion_id_four,"
					. " promotion_id_five = $this->promotion_id_five,"
					. " extra_promotion = $this->extra_promotion,"
					. " backlink = $this->backlink,"
					. " clicktocall_number = $this->clicktocall_number,"
					. " clicktocall_extension = $this->clicktocall_extension"
					. " WHERE id = ".$this->id;


			$dbObj->query($sql);
			
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$listingObj->Add();
		 * <br /><br />
		 *		//Using this in ListingSummary() class.
		 *		$this->Add();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Add
		 * @access Public
		 */
		function Add(){
			
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($this->domain_id){
				$dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
			} else	if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
			$this->prepareToSave();


			$sql = "INSERT Listing_Summary ("
					. " id,"
					. " legacy_id,"
					. " account_id,"
					. " location_1,"
					. " location_1_title,"
					. " location_1_abbreviation,"
					. " location_1_friendly_url,"
					. " location_2,"
					. " location_2_title,"
					. " location_2_abbreviation,"
					. " location_2_friendly_url,"
					. " location_3,"
					. " location_3_title,"
					. " location_3_abbreviation,"
					. " location_3_friendly_url,"
					. " location_4,"
					. " location_4_title,"
					. " location_4_abbreviation,"
					. " location_4_friendly_url,"
					. " location_5,"
					. " location_5_title,"
					. " location_5_abbreviation,"
					. " location_5_friendly_url,"
					. " title,"
					. " friendly_url,"
					. " email,"
					. " show_email,"
					. " url,"
					. " display_url,"
					. " address,"
					. " address2,"
					. " zip_code,"
					. " zip5,"
					. " latitude,"
					. " longitude,"
					. " phone,"
					. " fax,"
					. " description1,"
					. " description2,"
					. " description3,"
					. " description4,"
					. " description5,"
					. " description6,"
					. " description7,"
					. " attachment_file,"
					. " attachment_caption,"
					. " status,"
					. " renewal_date,"
					. " level,"
					. " random_number,"
					. " claim_disable,"
					. " locations,"
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
					. " promotion_start_date,"
					. " promotion_end_date,"
					. " promotion_start_date_two,"
					. " promotion_end_date_two,"
					. " promotion_start_date_three,"
					. " promotion_end_date_three,"
					. " promotion_start_date_four,"
					. " promotion_end_date_four,"
					. " promotion_start_date_five,"
					. " promotion_end_date_five,"
					. " thumb_id,"
					. " thumb_type,"
					. " thumb_width,"
					. " thumb_height,"
					. " listingtemplate_id,"
					. " template_layout_id,"
					. " template_cat_id,"
					. " template_title,"
					. " template_friendly_url,"
					. " template_status,"
					. " template_price,"
					. " image_id,"
					. " updated,"
					. " entered,"
					. " promotion_id,"
					. " promotion_id_two,"
					. " promotion_id_three,"
					. " promotion_id_four,"
					. " promotion_id_five,"
					. " extra_promotion,"
					. " backlink,"
					. " clicktocall_number,"
					. " clicktocall_extension)"
					. " VALUES"
					. " ($this->id,"
					. " $this->legacy_id,"
					. " $this->account_id,"
					. " $this->location_1,"
					. " $this->location_1_title,"
					. " $this->location_1_abbreviation,"
					. " $this->location_1_friendly_url,"
					. " $this->location_2,"
					. " $this->location_2_title,"
					. " $this->location_2_abbreviation,"
					. " $this->location_2_friendly_url,"
					. " $this->location_3,"
					. " $this->location_3_title,"
					. " $this->location_3_abbreviation,"
					. " $this->location_3_friendly_url,"
					. " $this->location_4,"
					. " $this->location_4_title,"
					. " $this->location_4_abbreviation,"
					. " $this->location_4_friendly_url,"
					. " $this->location_5,"
					. " $this->location_5_title,"
					. " $this->location_5_abbreviation,"
					. " $this->location_5_friendly_url,"
					. " $this->title,"
					. " $this->friendly_url,"
					. " $this->email,"
					. " $this->show_email,"
					. " $this->url,"
					. " $this->display_url,"
					. " $this->address,"
					. " $this->address2,"
					. " $this->zip_code,"
					. " $this->zip5,"
					. " $this->latitude,"
					. " $this->longitude,"
					. " $this->phone,"
					. " $this->fax,"
					. " $this->description1,"
					. " $this->description2,"
					. " $this->description3,"
					. " $this->description4,"
					. " $this->description5,"
					. " $this->description6,"
					. " $this->description7,"
					. " $this->attachment_file,"
					. " $this->attachment_caption,"
					. " $this->status,"
					. " $this->renewal_date,"
					. " $this->level,"
					. " $this->random_number,"
					. " $this->claim_disable,"
					. " $this->locations,"
					. " $this->keywords1,"
					. " $this->keywords2,"
					. " $this->keywords3,"
					. " $this->keywords4,"
					. " $this->keywords5,"
					. " $this->keywords6,"
					. " $this->keywords7,"
					. " $this->seo_keywords1,"
					. " $this->seo_keywords2,"
					. " $this->seo_keywords3,"
					. " $this->seo_keywords4,"
					. " $this->seo_keywords5,"
					. " $this->seo_keywords6,"
					. " $this->seo_keywords7,"
					. " $this->fulltextsearch_keyword,"
					. " $this->fulltextsearch_where,"
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
					. " $this->promotion_start_date,"
					. " $this->promotion_end_date,"
					. " $this->promotion_start_date_two,"
					. " $this->promotion_end_date_two,"
					. " $this->promotion_start_date_three,"
					. " $this->promotion_end_date_three,"
					. " $this->promotion_start_date_four,"
					. " $this->promotion_end_date_four,"
					. " $this->promotion_start_date_five,"
					. " $this->promotion_end_date_five,"
					. " $this->thumb_id,"
					. " $this->thumb_type,"
					. " $this->thumb_width,"
					. " $this->thumb_height,"
					. " $this->listingtemplate_id,"
					. " $this->template_layout_id,"
					. " $this->template_cat_id,"
					. " $this->template_title,"
					. " $this->template_friendly_url,"
					. " $this->template_status,"
					. " $this->template_price,"
					. " $this->image_id,"
					. " $this->updated,"
					. " $this->entered,"
					. " $this->promotion_id,"
					. " $this->promotion_id_two,"
					. " $this->promotion_id_three,"
					. " $this->promotion_id_four,"
					. " $this->promotion_id_five,"
					. " $this->extra_promotion,"
					. " $this->backlink,"
					. " $this->clicktocall_number,"
					. " $this->clicktocall_extension )";

			$dbObj->query($sql);


		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$listingObj->Delete($id);
		 * <br /><br />
		 *		//Using this in ListingSummary() class.
		 *		$this->Delete($id);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Delete
		 * @access Public
		 * @param integer $id
		 * @param integer $domain_id
		 */
		function Delete($id, $domain_id = false){
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($domain_id) {
				$db = db_getDBObjectByDomainID($domain_id, $dbMain);
			} else {
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
			}
			$sql = "DELETE from Listing_Summary where id = ".$id;
			$db->query($sql);
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$listingObj->PopulateTableLocation(...);
		 * <br /><br />
		 *		//Using this in ListingSummary() class.
		 *		$this->PopulateTableLocation(...);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name PopulateTableLocation
		 * @access Public
		 * @param integer $listing_id
		 * @param integer $locLevel
		 * @param varchar $field
		 */
		function PopulateTableLocation($listing_id = false, $locLevel = 0, $field){

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$db = db_getDBObject();
			}

			unset($dbMain);

			$sql = "UPDATE Listing_Summary SET "
					. " location_".$locLevel." = 0,"
					. " location_".$locLevel."_title = '',"
					. " location_".$locLevel."_abbreviation = '',"
					. " location_".$locLevel."_friendly_url = '',"
					. " fulltextsearch_where = '".$field."'"
					. " WHERE id = ".$listing_id;

			$db->query($sql);
		}
		
		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$listingObj->PopulateTableCategory(...);
		 * <br /><br />
		 *		//Using this in ListingSummary() class.
		 *		$this->PopulateTableCategory(...);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name PopulateTableCategory
		 * @access Public
		 * @param integer $listing_id
		 * @param varchar $field
		 */
		function PopulateTableCategory($listing_id = false, $field){

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$db = db_getDBObject();
			}

			unset($dbMain);

			$sql = "UPDATE Listing_Summary SET "
					. " fulltextsearch_keyword = '".$field."'"
					. " WHERE id = ".$listing_id;

			$db->query($sql);
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$listingObj->PopulateTable(...);
		 * <br /><br />
		 *		//Using this in ListingSummary() class.
		 *		$this->PopulateTable(...);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name PopulateTable
		 * @access Public
		 * @param integer $listing_id
		 * @param varchar $method
		 */
		function PopulateTable($listing_id = false, $method){

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (is_numeric($this->domain_id)){
				$db = db_getDBObjectByDomainID($this->domain_id, $dbMain);
			} else if (defined("SELECTED_DOMAIN_ID")) {
				$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$db = db_getDBObject();
			}
//			$dbMain->close();
			unset($dbMain);
			
			$sql = "select
						Listing.id,
						Listing.account_id,";

			$sql .=	"	Listing.location_1,
						Listing.location_2,
						Listing.location_3,
						Listing.location_4,
						Listing.location_5,
						Listing.image_id as image_id,
						Listing.thumb_id as thumb_id,
						Listing.title,
						Listing.friendly_url,
						Listing.email,
						Listing.show_email,
						Listing.url,
						Listing.display_url,
						Listing.address,
						Listing.address2,
						Listing.zip_code,
						Listing.zip5,
						Listing.latitude,
						Listing.longitude,
						Listing.phone,
						Listing.fax,
						Listing.description1,
						Listing.description2,
						Listing.description3,
						Listing.description4,
						Listing.description5,
						Listing.description6,
						Listing.description7,
						Listing.attachment_file,
						Listing.attachment_caption,
						Listing.status,
						Listing.renewal_date,
						Listing.level,
						Listing.random_number,
						Listing.reminder,
						Listing.fulltextsearch_keyword,
						Listing.fulltextsearch_where,
						Listing.locations,
						Listing.keywords1,
						Listing.keywords2,
						Listing.keywords3,
						Listing.keywords4,
						Listing.keywords5,
						Listing.keywords6,
						Listing.keywords7,
						Listing.seo_keywords1,
						Listing.seo_keywords2,
						Listing.seo_keywords3,
						Listing.seo_keywords4,
						Listing.seo_keywords5,
						Listing.seo_keywords6,
						Listing.seo_keywords7,
						Listing.claim_disable,
						Listing.listingtemplate_id,
						Listing.custom_checkbox0,
						Listing.custom_checkbox1,
						Listing.custom_checkbox2,
						Listing.custom_checkbox3,
						Listing.custom_checkbox4,
						Listing.custom_checkbox5,
						Listing.custom_checkbox6,
						Listing.custom_checkbox7,
						Listing.custom_checkbox8,
						Listing.custom_checkbox9,
						Listing.custom_dropdown0,
						Listing.custom_dropdown1,
						Listing.custom_dropdown2,
						Listing.custom_dropdown3,
						Listing.custom_dropdown4,
						Listing.custom_dropdown5,
						Listing.custom_dropdown6,
						Listing.custom_dropdown7,
						Listing.custom_dropdown8,
						Listing.custom_dropdown9,
						Listing.custom_text0,
						Listing.custom_text1,
						Listing.custom_text2,
						Listing.custom_text3,
						Listing.custom_text4,
						Listing.custom_text5,
						Listing.custom_text6,
						Listing.custom_text7,
						Listing.custom_text8,
						Listing.custom_text9,
						Listing.custom_short_desc0,
						Listing.custom_short_desc1,
						Listing.custom_short_desc2,
						Listing.custom_short_desc3,
						Listing.custom_short_desc4,
						Listing.custom_short_desc5,
						Listing.custom_short_desc6,
						Listing.custom_short_desc7,
						Listing.custom_short_desc8,
						Listing.custom_short_desc9,
						Listing.custom_long_desc0,
						Listing.custom_long_desc1,
						Listing.custom_long_desc2,
						Listing.custom_long_desc3,
						Listing.custom_long_desc4,
						Listing.custom_long_desc5,
						Listing.custom_long_desc6,
						Listing.custom_long_desc7,
						Listing.custom_long_desc8,
						Listing.custom_long_desc9,
						Listing.number_views,
						Listing.avg_review,
						Listing.updated,
						Listing.entered,
						Listing.promotion_id,
						Listing.promotion_id_two,
						Listing.promotion_id_three,
						Listing.promotion_id_four,
						Listing.promotion_id_five,
						Listing.extra_promotion,
						Listing.backlink,
						Listing.clicktocall_number,
						Listing.clicktocall_extension,
						Promotion.start_date AS promotion_start_date,
						Promotion.end_date AS promotion_end_date,
						PromotionTwo.start_date AS promotion_start_date_two,
						PromotionTwo.end_date AS promotion_end_date_two,
						PromotionThree.start_date AS promotion_start_date_three,
						PromotionThree.end_date AS promotion_end_date_three,
						PromotionFour.start_date AS promotion_start_date_four,
						PromotionFour.end_date AS promotion_end_date_four,
						PromotionFive.start_date AS promotion_start_date_five,
						PromotionFive.end_date AS promotion_end_date_five,
						Thumb.type AS thumb_type,
						Thumb.width AS thumb_width,
						Thumb.height AS thumb_height,
						ListingTemplate.layout_id AS template_layout_id,
						ListingTemplate.cat_id AS template_cat_id,
						ListingTemplate.title AS template_title,
						ListingTemplate.friendly_url AS template_friendly_url,
						ListingTemplate.status AS template_status,
						ListingTemplate.price AS template_price
					FROM Listing
						LEFT OUTER JOIN Promotion ON (Listing.promotion_id = Promotion.id)
						LEFT OUTER JOIN Promotion AS PromotionTwo ON (Listing.promotion_id_two = PromotionTwo.id)
						LEFT OUTER JOIN Promotion AS PromotionThree ON (Listing.promotion_id_three = PromotionThree.id)
						LEFT OUTER JOIN Promotion AS PromotionFour ON (Listing.promotion_id_four = PromotionFour.id)
						LEFT OUTER JOIN Promotion AS PromotionFive ON (Listing.promotion_id_five = PromotionFive.id)
						LEFT OUTER JOIN Image AS Thumb ON (Listing.thumb_id = Thumb.id)
						LEFT OUTER JOIN ListingTemplate ON (Listing.listingtemplate_id = ListingTemplate.id)";

			if($listing_id){
				$sql .= " where Listing.id = ".str_replace("'","",$listing_id);
			}

			$result = $db->query($sql);
			if(mysql_num_rows($result) > 0){

				while($row = mysql_fetch_assoc($result)){
					
					/*
					 * Get location information
					 */
					unset($locationObj);
					if($row["location_1"] > 0){
						$locationObj = new Location1($row["location_1"]);
						$row["location_1"] 				= $locationObj->id;
						$row["location_1_title"]		= $locationObj->name;
						$row["location_1_abbreviation"]	= $locationObj->abbreviation;
						$row["location_1_friendly_url"]	= $locationObj->friendly_url;
					}else{
						$row["location_1"] 				= 0;
						$row["location_1_title"]		= "";
						$row["location_1_abbreviation"]	= "";
						$row["location_1_friendly_url"]	= "";
					}
					
					unset($locationObj);
					if($row["location_2"] > 0){
						$locationObj = new Location2($row["location_2"]);
						$row["location_2"] 				= $locationObj->id;
						$row["location_2_title"]		= $locationObj->name;
						$row["location_2_abbreviation"]	= $locationObj->abbreviation;
						$row["location_2_friendly_url"]	= $locationObj->friendly_url;
					}else{
						$row["location_2"] 				= 0;
						$row["location_2_title"]		= "";
						$row["location_2_abbreviation"]	= "";
						$row["location_2_friendly_url"]	= "";
					}
					
					unset($locationObj);
					if($row["location_3"] > 0){
						$locationObj = new Location3($row["location_3"]);
						$row["location_3"] 				= $locationObj->id;
						$row["location_3_title"]		= $locationObj->name;
						$row["location_3_abbreviation"]	= $locationObj->abbreviation;
						$row["location_3_friendly_url"]	= $locationObj->friendly_url;
					}else{
						$row["location_3"] 				= 0;
						$row["location_3_title"]		= "";
						$row["location_3_abbreviation"]	= "";
						$row["location_3_friendly_url"]	= "";
					}
					
					
					unset($locationObj);
					if($row["location_4"] > 0){
						$locationObj = new Location4($row["location_4"]);
						$row["location_4"] 				= $locationObj->id;
						$row["location_4_title"]		= $locationObj->name;
						$row["location_4_abbreviation"]	= $locationObj->abbreviation;
						$row["location_4_friendly_url"]	= $locationObj->friendly_url;
					}else{
						$row["location_4"] 				= 0;
						$row["location_4_title"]		= "";
						$row["location_4_abbreviation"]	= "";
						$row["location_4_friendly_url"]	= "";
					}
					
					unset($locationObj);
					if($row["location_5"] > 0){
						$locationObj = new Location5($row["location_5"]);
						$row["location_5"] 				= $locationObj->id;
						$row["location_5_title"]		= $locationObj->name;
						$row["location_5_abbreviation"]	= $locationObj->abbreviation;
						$row["location_5_friendly_url"]	= $locationObj->friendly_url;
					}else{
						$row["location_5"] 				= 0;
						$row["location_5_title"]		= "";
						$row["location_5_abbreviation"]	= "";
						$row["location_5_friendly_url"]	= "";
					}
					
					$this->makeFromRow($row);
					if($method == "update"){
						$this->Update();
					}elseif($method == "insert"){
						$this->Add();
					}
				}
			}
		}		
	}
?>