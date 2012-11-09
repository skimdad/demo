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
	# * FILE: /classes/class_Slider.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$sliderObj = new Slider($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 9.0.00
	 * @package Classes
	 * @name Slider
	 * @method Slider
	 * @method makeFromRow
	 * @method Save
	 * @method Delete
	 * @access Public
	 */
	class Slider extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $image_id;
		/**
		 * @var string
		 * @access Private
		 */
		var $title;
		/**
		 * @var string
		 * @access Private
		 */
		var $summary1;
		/**
		 * @var string
		 * @access Private
		 */
		var $summary2;
		/**
		 * @var string
		 * @access Private
		 */
		var $summary3;
		/**
		 * @var string
		 * @access Private
		 */
		var $summary4;
		/**
		 * @var string
		 * @access Private
		 */
		var $summary5;
		/**
		 * @var string
		 * @access Private
		 */
		var $summary6;
		/**
		 * @var string
		 * @access Private
		 */
		var $summary7;
		/**
		 * @var string
		 * @access Private
		 */
		var $alternative_text1;
		/**
		 * @var string
		 * @access Private
		 */
		var $alternative_text2;
		/**
		 * @var string
		 * @access Private
		 */
		var $alternative_text3;
		/**
		 * @var string
		 * @access Private
		 */
		var $alternative_text4;
		/**
		 * @var string
		 * @access Private
		 */
		var $alternative_text5;
		/**
		 * @var string
		 * @access Private
		 */
		var $alternative_text6;
		/**
		 * @var string
		 * @access Private
		 */
		var $alternative_text7;
		/**
		 * @var string
		 * @access Private
		 */
		var $title_text1;
		/**
		 * @var string
		 * @access Private
		 */
		var $title_text2;
		/**
		 * @var string
		 * @access Private
		 */
		var $title_text3;
		/**
		 * @var string
		 * @access Private
		 */
		var $title_text4;
		/**
		 * @var string
		 * @access Private
		 */
		var $title_text5;
		/**
		 * @var string
		 * @access Private
		 */
		var $title_text6;
		/**
		 * @var string
		 * @access Private
		 */
		var $title_text7;
		/**
		 * @var string
		 * @access Private
		 */
		var $link1;
		/**
		 * @var string
		 * @access Private
		 */
		var $link2;
		/**
		 * @var string
		 * @access Private
		 */
		var $link3;
		/**
		 * @var string
		 * @access Private
		 */
		var $link4;
		/**
		 * @var string
		 * @access Private
		 */
		var $link5;
		/**
		 * @var string
		 * @access Private
		 */
		var $link6;
		/**
		 * @var string
		 * @access Private
		 */
		var $link7;
        /**
		 * @var real
		 * @access Private
		 */
		var $price;
		/**
		 * @var string
		 * @access Private
		 */
		var $slide_order;
		

		/**
		 * <code>
		 *		$sliderObj = new Slider($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.0.00
		 * @name Slider
		 * @access Public
		 * @param integer $var
		 */
		function Slider($var='', $domain_id = false) {
		
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
				$sql = "SELECT * FROM Slider WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));

				$this->makeFromRow($row);
			}else {
				$this->makeFromRow($var);
			}

		}

		/**
		 * <code>
		 *		$this->makeFromRow($row);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.0.00
		 * @name makeFromRow
		 * @access Public
		 * @param array $row
		 */
		function makeFromRow($row='') {

				$this->id					= ($row["id"])					? $row["id"]				: ($this->id					? $this->id				: 0);
				$this->title				= ($row["title"])				? $row["title"]				: ($this->title					? $this->title			: "");
				$this->image_id				= ($row["image_id"])			? $row["image_id"]			: ($this->image_id				? $this->image_id		: 0);

				$this->summary1				= ($row["summary1"])			? $row["summary1"]		: "";
				$this->summary2				= ($row["summary2"])			? $row["summary2"]		: "";
				$this->summary3				= ($row["summary3"])			? $row["summary3"]		: "";
				$this->summary4				= ($row["summary4"])			? $row["summary4"]		: "";
				$this->summary5				= ($row["summary5"])			? $row["summary5"]		: "";
				$this->summary6				= ($row["summary6"])			? $row["summary6"]		: "";
				$this->summary7				= ($row["summary7"])			? $row["summary7"]		: "";

				$this->alternative_text1	= ($row["alternative_text1"])	? $row["alternative_text1"]	: ($this->alternative_text1	? $this->alternative_text1	: "");
				$this->alternative_text2	= ($row["alternative_text2"])	? $row["alternative_text2"]	: ($this->alternative_text2 ? $this->alternative_text2	: "");
				$this->alternative_text3	= ($row["alternative_text3"])	? $row["alternative_text3"]	: ($this->alternative_text3	? $this->alternative_text3	: "");
				$this->alternative_text4	= ($row["alternative_text4"])	? $row["alternative_text4"]	: ($this->alternative_text4	? $this->alternative_text4	: "");
				$this->alternative_text5	= ($row["alternative_text5"])	? $row["alternative_text5"]	: ($this->alternative_text5	? $this->alternative_text5	: "");
				$this->alternative_text6	= ($row["alternative_text6"])	? $row["alternative_text6"]	: ($this->alternative_text6	? $this->alternative_text6	: "");
				$this->alternative_text7	= ($row["alternative_text7"])	? $row["alternative_text7"]	: ($this->alternative_text7	? $this->alternative_text7	: "");

				$this->title_text1			= ($row["title_text1"])			? $row["title_text1"]	: ($this->title_text1	? $this->title_text1	: "");
				$this->title_text2			= ($row["title_text2"])			? $row["title_text2"]	: ($this->title_text2	? $this->title_text2	: "");
				$this->title_text3			= ($row["title_text3"])			? $row["title_text3"]	: ($this->title_text3	? $this->title_text3	: "");
				$this->title_text4			= ($row["title_text4"])			? $row["title_text4"]	: ($this->title_text4	? $this->title_text4	: "");
				$this->title_text5			= ($row["title_text5"])			? $row["title_text5"]	: ($this->title_text5	? $this->title_text5	: "");
				$this->title_text6			= ($row["title_text6"])			? $row["title_text6"]	: ($this->title_text6	? $this->title_text6	: "");
				$this->title_text7			= ($row["title_text7"])			? $row["title_text7"]	: ($this->title_text7	? $this->title_text7	: "");

				$this->link1				= ($row["link1"])				? $row["link1"]			: ($this->link1			? $this->link1			: "");
				$this->link2				= ($row["link2"])				? $row["link2"]			: ($this->link2			? $this->link2			: "");
				$this->link3				= ($row["link3"])				? $row["link3"]			: ($this->link3			? $this->link3			: "");
				$this->link4				= ($row["link4"])				? $row["link4"]			: ($this->link4			? $this->link4			: "");
				$this->link5				= ($row["link5"])				? $row["link5"]			: ($this->link5			? $this->link5			: "");
				$this->link6				= ($row["link6"])				? $row["link6"]			: ($this->link6			? $this->link6			: "");
				$this->link7				= ($row["link7"])				? $row["link7"]			: ($this->link7			? $this->link7			: "");
				$this->price				= ($row["price"])				? $row["price"]			: ($this->price			? $this->price			: 0.00);
				
				$this->slide_order			= ($row["slide_order"])			? $row["slide_order"]   : ($this->slide_order	? $this->slide_order	: 0);
		}

		
		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$sliderObj->Save();
		 * <br /><br />
		 *		//Using this in Slider() class.
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

			if ($this->id) {

				$this_id = $this->id;

				$sql  = "UPDATE Slider SET"
					. " title               = $this->title,"
					. " image_id            = $this->image_id,"
					. " summary1            = $this->summary1,"
					. " summary2            = $this->summary2,"
					. " summary3            = $this->summary3,"
					. " summary4            = $this->summary4,"
					. " summary5            = $this->summary5,"
					. " summary6            = $this->summary6,"
					. " summary7            = $this->summary7,"
					. " alternative_text1   = $this->alternative_text1,"
					. " alternative_text2   = $this->alternative_text2,"
					. " alternative_text3   = $this->alternative_text3,"
					. " alternative_text4   = $this->alternative_text4,"
					. " alternative_text5   = $this->alternative_text5,"
					. " alternative_text6   = $this->alternative_text6,"
					. " alternative_text7   = $this->alternative_text7,"
					. " title_text1         = $this->title_text1,"
					. " title_text2         = $this->title_text2,"
					. " title_text3         = $this->title_text3,"
					. " title_text4         = $this->title_text4,"
					. " title_text5         = $this->title_text5,"
					. " title_text6         = $this->title_text6,"
					. " title_text7         = $this->title_text7,"
					. " link1               = $this->link1,"
					. " link2               = $this->link2,"
					. " link3               = $this->link3,"
					. " link4               = $this->link4,"
					. " link5               = $this->link5,"
					. " link6               = $this->link6,"
					. " link7               = $this->link7,"
					. " price               = $this->price,"
					. " slide_order         = $this->slide_order"
					. " WHERE id            = $this->id";

				$dbObj->query($sql);

				$this_id = str_replace("\"", "", $this_id);
				$this_id = str_replace("'", "", $this_id);


			} else {

				$sql = "INSERT INTO Slider"
					. " (title,"
					. " image_id,"
					. " summary1,"
					. " summary2,"
					. " summary3,"
					. " summary4,"
					. " summary5,"
					. " summary6,"
					. " summary7,"
					. " alternative_text1,"
					. " alternative_text2,"
					. " alternative_text3,"
					. " alternative_text4,"
					. " alternative_text5,"
					. " alternative_text6,"
					. " alternative_text7,"
					. " title_text1,"
					. " title_text2,"
					. " title_text3,"
					. " title_text4,"
					. " title_text5,"
					. " title_text6,"
					. " title_text7,"
					. " link1,"
					. " link2,"
					. " link3,"
					. " link4,"
					. " link5,"
					. " link6,"
					. " link7,"
					. " price,"
					. " slide_order)"
					. " VALUES"
					. " ($this->title,"
					. " $this->image_id,"
					. " $this->summary1,"
					. " $this->summary2,"
					. " $this->summary3,"
					. " $this->summary4,"
					. " $this->summary5,"
					. " $this->summary6,"
					. " $this->summary7,"
					. " $this->alternative_text1,"
					. " $this->alternative_text2,"
					. " $this->alternative_text3,"
					. " $this->alternative_text4,"
					. " $this->alternative_text5,"
					. " $this->alternative_text6,"
					. " $this->alternative_text7,"
					. " $this->title_text1,"
					. " $this->title_text2,"
					. " $this->title_text3,"
					. " $this->title_text4,"
					. " $this->title_text5,"
					. " $this->title_text6,"
					. " $this->title_text7,"
					. " $this->link1,"
					. " $this->link2,"
					. " $this->link3,"
					. " $this->link4,"
					. " $this->link5,"
					. " $this->link6,"
					. " $this->link7,"
					. " $this->price,"
					. " $this->slide_order)";

				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);

				
			}
			
			$this->prepareToUse();
 
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$sliderObj->Delete();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.0.00
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
			
			### IMAGE
			if ($this->image_id) {
				$image = new Image($this->image_id);
				if ($image){
					$image->Delete($domain_id);
				}
			}
			
			### Slider
			$sql = "DELETE FROM Slider WHERE id = $this->id";
			$dbObj->query($sql);
		}
		
		function getAllSliderItems(){
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
			
			$sql = "SELECT * FROM Slider ORDER BY slide_order";
			$result = $dbObj->query($sql);
			unset($array_slider);
			if(mysql_num_rows($result)){
				$i=1; // needs be 1 to work on form of sitemgr
				
				while($row = mysql_fetch_assoc($result)){
					foreach($this as $key => $value){
						$array_slider[$i][$key] = $row[$key];
					}
					$i++;
				}
				return $array_slider;
			}else{
				return false;
			}
			
		}
		
		function ClearSlider(){
			$this->title				= "";
			$this->image_id				= 0;

			$this->summary1				= "";
			$this->summary2				= "";
			$this->summary3				= "";
			$this->summary4				= "";
			$this->summary5				= "";
			$this->summary6				= "";
			$this->summary7				= "";

			$this->alternative_text1	= "";
			$this->alternative_text2	= "";
			$this->alternative_text3	= "";
			$this->alternative_text4	= "";
			$this->alternative_text5	= "";
			$this->alternative_text6	= "";
			$this->alternative_text7	= "";

			$this->title_text1			= "";
			$this->title_text2			= "";
			$this->title_text3			= "";
			$this->title_text4			= "";
			$this->title_text5			= "";
			$this->title_text6			= "";
			$this->title_text7			= "";

			$this->link1				= "";
			$this->link2				= "";
			$this->link3				= "";
			$this->link4				= "";
			$this->link5				= "";
			$this->link6				= "";
			$this->link7				= "";	
			$this->price				= 0.00;	
			
			$this->Save();
			
		}
	}
?>