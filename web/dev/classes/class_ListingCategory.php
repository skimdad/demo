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
	# * FILE: /classes/class_ListingCategory.php
	# ----------------------------------------------------------------------------------------------------

	class ListingCategory extends Handle {

		var $id;
		var $lang;
		var $title;
		var $title1;
		var $title2;
		var $title3;
		var $title4;
		var $title5;
		var $title6;
		var $title7;
		var $page_title1;
		var $page_title2;
		var $page_title3;
		var $page_title4;
		var $page_title5;
		var $page_title6;
		var $page_title7;
		var $friendly_url1;
		var $friendly_url2;
		var $friendly_url3;
		var $friendly_url4;
		var $friendly_url5;
		var $friendly_url6;
		var $friendly_url7;
		var $category_id;
		var $featured;
		var $seo_description1;
		var $seo_description2;
		var $seo_description3;
		var $seo_description4;
		var $seo_description5;
		var $seo_description6;
		var $seo_description7;
		var $keywords1;
		var $keywords2;
		var $keywords3;
		var $keywords4;
		var $keywords5;
		var $keywords6;
		var $keywords7;
		var $seo_keywords1;
		var $seo_keywords2;
		var $seo_keywords3;
		var $seo_keywords4;
		var $seo_keywords5;
		var $seo_keywords6;
		var $seo_keywords7;
		var $content1;
		var $content2;
		var $content3;
		var $content4;
		var $content5;
		var $content6;
		var $content7;
		var $active_listing;
		var $left;
		var $right;
		var $root_id;
		var $full_friendly_url1;
		var $full_friendly_url2;
		var $full_friendly_url3;
		var $full_friendly_url4;
		var $full_friendly_url5;
		var $full_friendly_url6;
		var $full_friendly_url7;
        var $enabled;
		/*
		 * Dont save this field
		 */
		var $force_second_db;

		
		function ListingCategory($var='') {
            if (is_numeric($var) && ($var)) {
                $dbMain = db_getDBObject(DEFAULT_DB, true);
                if (defined("SELECTED_DOMAIN_ID")) {
                    $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
                } else {
                    $db = db_getDBObject();
                }
                unset($dbMain);
                $sql = "SELECT * FROM ListingCategory WHERE id = $var";
                $row = mysql_fetch_array($db->unbuffered_query($sql));
                $this->makeFromRow($row);
            } else {
                $this->makeFromRow($var);
            }
		}

		function makeFromRow($row='') {

			$this->id					= ($row["id"])					? $row["id"]					: ($this->id				? $this->id             : 0);
			$this->lang					= ($row["lang"])				? $row["lang"]					: "";
			$this->title				= ($row["title"])				? $row["title"]					: "";
			$this->title1				= ($row["title1"])				? $row["title1"]				: "";
			$this->title2				= ($row["title2"])				? $row["title2"]				: "";
			$this->title3				= ($row["title3"])				? $row["title3"]				: "";
			$this->title4				= ($row["title4"])				? $row["title4"]				: "";
			$this->title5				= ($row["title5"])				? $row["title5"]				: "";
			$this->title6				= ($row["title6"])				? $row["title6"]				: "";
			$this->title7				= ($row["title7"])				? $row["title7"]				: "";
			$this->page_title1			= ($row["page_title1"])			? $row["page_title1"]			: "";
			$this->page_title2			= ($row["page_title2"])			? $row["page_title2"]			: "";
			$this->page_title3			= ($row["page_title3"])			? $row["page_title3"]			: "";
			$this->page_title4			= ($row["page_title4"])			? $row["page_title4"]			: "";
			$this->page_title5			= ($row["page_title5"])			? $row["page_title5"]			: "";
			$this->page_title6			= ($row["page_title6"])			? $row["page_title6"]			: "";
			$this->page_title7			= ($row["page_title7"])			? $row["page_title7"]			: "";
			$this->friendly_url1		= ($row["friendly_url1"])		? $row["friendly_url1"]			: "";
			$this->friendly_url2		= ($row["friendly_url2"])		? $row["friendly_url2"]			: "";
			$this->friendly_url3		= ($row["friendly_url3"])		? $row["friendly_url3"]			: "";
			$this->friendly_url4		= ($row["friendly_url4"])		? $row["friendly_url4"]			: "";
			$this->friendly_url5		= ($row["friendly_url5"])		? $row["friendly_url5"]			: "";
			$this->friendly_url6		= ($row["friendly_url6"])		? $row["friendly_url6"]			: "";
			$this->friendly_url7		= ($row["friendly_url7"])		? $row["friendly_url7"]			: "";
			$this->category_id			= ($row["category_id"])			? $row["category_id"]			: ($this->category_id		? $this->category_id    : 0);
			$this->featured				= ($row["featured"])			? $row["featured"]				: ($this->featured			? $this->featured       : "n");
			$this->seo_description1		= ($row["seo_description1"])	? $row["seo_description1"]		: "";
			$this->seo_description2		= ($row["seo_description2"])	? $row["seo_description2"]		: "";
			$this->seo_description3		= ($row["seo_description3"])	? $row["seo_description3"]		: "";
			$this->seo_description4		= ($row["seo_description4"])	? $row["seo_description4"]		: "";
			$this->seo_description5		= ($row["seo_description5"])	? $row["seo_description5"]		: "";
			$this->seo_description6		= ($row["seo_description6"])	? $row["seo_description6"]		: "";
			$this->seo_description7		= ($row["seo_description7"])	? $row["seo_description7"]		: "";
			$this->keywords1			= ($row["keywords1"])			? $row["keywords1"]				: ($this->keywords1			? $this->keywords1      : "");
			$this->keywords2			= ($row["keywords2"])			? $row["keywords2"]				: ($this->keywords2			? $this->keywords2      : "");
			$this->keywords3			= ($row["keywords3"])			? $row["keywords3"]				: ($this->keywords3			? $this->keywords3      : "");
			$this->keywords4			= ($row["keywords4"])			? $row["keywords4"]				: ($this->keywords4			? $this->keywords4      : "");
			$this->keywords5			= ($row["keywords5"])			? $row["keywords5"]				: ($this->keywords5			? $this->keywords5      : "");
			$this->keywords6			= ($row["keywords6"])			? $row["keywords6"]				: ($this->keywords6			? $this->keywords6      : "");
			$this->keywords7			= ($row["keywords7"])			? $row["keywords7"]				: ($this->keywords7			? $this->keywords7      : "");
			$this->seo_keywords1		= ($row["seo_keywords1"])		? $row["seo_keywords1"]			: "";
			$this->seo_keywords2		= ($row["seo_keywords2"])		? $row["seo_keywords2"]			: "";
			$this->seo_keywords3		= ($row["seo_keywords3"])		? $row["seo_keywords3"]			: "";
			$this->seo_keywords4		= ($row["seo_keywords4"])		? $row["seo_keywords4"]			: "";
			$this->seo_keywords5		= ($row["seo_keywords5"])		? $row["seo_keywords5"]			: "";
			$this->seo_keywords6		= ($row["seo_keywords6"])		? $row["seo_keywords6"]			: "";
			$this->seo_keywords7		= ($row["seo_keywords7"])		? $row["seo_keywords7"]			: "";
			$this->content1				= ($row["content1"])			? $row["content1"]				: "";
			$this->content2				= ($row["content2"])			? $row["content2"]				: "";
			$this->content3				= ($row["content3"])			? $row["content3"]				: "";
			$this->content4				= ($row["content4"])			? $row["content4"]				: "";
			$this->content5				= ($row["content5"])			? $row["content5"]				: "";
			$this->content6				= ($row["content6"])			? $row["content6"]				: "";
			$this->content7				= ($row["content7"])			? $row["content7"]				: "";
			$this->active_listing		= ($row["active_listing"])		? $row["active_listing"]		: ($this->active_listing	? $this->active_listing : 0);
			$this->left					= ($row["left"])				? $row["left"]					: ($this->left				? $this->left			: 1);
			$this->right				= ($row["right"])				? $row["right"]					: ($this->right				? $this->right			: 2);
			$this->root_id				= ($row["root_id"])				? $row["root_id"]				: ($this->root_id			? $this->root_id		: 0);
			$this->full_friendly_url1	= ($row["full_friendly_url1"])  ? $row["full_friendly_url1"]	: "";
			$this->full_friendly_url2	= ($row["full_friendly_url2"])  ? $row["full_friendly_url2"]	: "";
			$this->full_friendly_url3	= ($row["full_friendly_url3"])  ? $row["full_friendly_url3"]	: "";
			$this->full_friendly_url4	= ($row["full_friendly_url4"])  ? $row["full_friendly_url4"]	: "";
			$this->full_friendly_url5	= ($row["full_friendly_url5"])  ? $row["full_friendly_url5"]	: "";
			$this->full_friendly_url6	= ($row["full_friendly_url6"])  ? $row["full_friendly_url6"]	: "";
			$this->full_friendly_url7	= ($row["full_friendly_url7"])  ? $row["full_friendly_url7"]	: "";
            $this->enabled				= ($row["enabled"])             ? $row["enabled"]				: ($this->enabled			? $this->enabled       : "n");

		}

		function Save($update_friendlyurl = true) {

			$this->prepareToSave();

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);

			$this->friendly_url = string_strtolower($this->friendly_url);
			
			if ($this->id) {

                $sql = "UPDATE ListingCategory SET"
                    . " lang = $this->lang,"
                    . " title1 = $this->title1,"
                    . " title2 = $this->title2,"
                    . " title3 = $this->title3,"
                    . " title4 = $this->title4,"
                    . " title5 = $this->title5,"
                    . " title6 = $this->title6,"
                    . " title7 = $this->title7,"
                    . " page_title1 = $this->page_title1,"
                    . " page_title2 = $this->page_title2,"
                    . " page_title3 = $this->page_title3,"
                    . " page_title4 = $this->page_title4,"
                    . " page_title5 = $this->page_title5,"
                    . " page_title6 = $this->page_title6,"
                    . " page_title7 = $this->page_title7,"
                    . " friendly_url1 = $this->friendly_url1,"
                    . " friendly_url2 = $this->friendly_url2,"
                    . " friendly_url3 = $this->friendly_url3,"
                    . " friendly_url4 = $this->friendly_url4,"
                    . " friendly_url5 = $this->friendly_url5,"
                    . " friendly_url6 = $this->friendly_url6,"
                    . " friendly_url7 = $this->friendly_url7,"
                    . " category_id = $this->category_id,"
                    . " featured = $this->featured,"
                    . " seo_description1 = $this->seo_description1,"
                    . " seo_description2 = $this->seo_description2,"
                    . " seo_description3 = $this->seo_description3,"
                    . " seo_description4 = $this->seo_description4,"
                    . " seo_description5 = $this->seo_description5,"
                    . " seo_description6 = $this->seo_description6,"
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
					. " content1 = $this->content1,"
					. " content2 = $this->content2,"
					. " content3 = $this->content3,"
					. " content4 = $this->content4,"
					. " content5 = $this->content5,"
					. " content6 = $this->content6,"
					. " content7 = $this->content7,"
                    . " active_listing = $this->active_listing,"
                    . " root_id = $this->root_id,"
                    . " enabled = $this->enabled"
                    . " WHERE id = $this->id";

                $dbObj->query($sql);

            } else {

				$sql = "INSERT INTO ListingCategory"
					. " (lang,"
                    . " title1,"
                    . " title2,"
                    . " title3,"
                    . " title4,"
                    . " title5,"
                    . " title6,"
                    . " title7,"
                    . " page_title1,"
                    . " page_title2,"
                    . " page_title3,"
                    . " page_title4,"
                    . " page_title5,"
                    . " page_title6,"
                    . " page_title7,"
                    . " friendly_url1,"
                    . " friendly_url2,"
                    . " friendly_url3,"
                    . " friendly_url4,"
                    . " friendly_url5,"
                    . " friendly_url6,"
                    . " friendly_url7,"
                    . " category_id,"
                    . " featured,"
                    . " seo_description1,"
                    . " seo_description2,"
                    . " seo_description3,"
                    . " seo_description4,"
                    . " seo_description5,"
                    . " seo_description6,"
                    . " seo_description7,"
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
					. " content1,"
					. " content2,"
					. " content3,"
					. " content4,"
					. " content5,"
					. " content6,"
					. " content7,"
					. " enabled,"
                    . " active_listing)"
                    . " VALUES"
					. " ($this->lang,"
                    . " $this->title1,"
                    . " $this->title2,"
                    . " $this->title3,"
                    . " $this->title4,"
                    . " $this->title5,"
                    . " $this->title6,"
                    . " $this->title7,"
                    . " $this->page_title1,"
                    . " $this->page_title2,"
                    . " $this->page_title3,"
                    . " $this->page_title4,"
                    . " $this->page_title5,"
                    . " $this->page_title6,"
                    . " $this->page_title7,"
                    . " $this->friendly_url1,"
                    . " $this->friendly_url2,"
                    . " $this->friendly_url3,"
                    . " $this->friendly_url4,"
                    . " $this->friendly_url5,"
                    . " $this->friendly_url6,"
                    . " $this->friendly_url7,"
                    . " $this->category_id,"
                    . " $this->featured,"
                    . " $this->seo_description1,"
                    . " $this->seo_description2,"
                    . " $this->seo_description3,"
                    . " $this->seo_description4,"
                    . " $this->seo_description5,"
                    . " $this->seo_description6,"
                    . " $this->seo_description7,"
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
					. " $this->content1,"
					. " $this->content2,"
					. " $this->content3,"
					. " $this->content4,"
					. " $this->content5,"
					. " $this->content6,"
					. " $this->content7,"
					. " $this->enabled,"
                    . " $this->active_listing)";


                $dbObj->query($sql);

				$this->id = mysql_insert_id($dbObj->link_id);

           }			

            $this->root_id = $this->findRootCategoryId($this->id);
			$this->rebuildCategoryTree($this->root_id, 1);
			$this->prepareToUse();

			//$this->updateActiveListingsCountByCategory($this->id);

			/*
			 * Update full path to categories
			 */
			if ($update_friendlyurl){
				$this->updateFullFriendlyURL();
			}
		}

		/**
		*
		* @see http://articles.sitepoint.com/article/hierarchical-data-database/3
		* @param integer $category_id
		* @param integer $node_left
		* @return integer
		*/
		function rebuildCategoryTree($category_id, $node_left) {

			if (($category_id > 0) or ($this->id > 0)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$dbObj = db_getDBObject();
				}

				// initializing variables
				$category_id = ($category_id>0)?$category_id:$this->id;
				$node_left = ($node_left>0)?$node_left:1;
				$root_category_id = $this->findRootCategoryId($category_id);

				// saving / adjusting root id
				$sql = 'UPDATE ListingCategory SET root_id = '.$root_category_id.' WHERE id='.$category_id;
				$dbObj->query($sql);

				// the right value of this node is the left value + 1
				$node_right = $node_left+1;

				// get all children of this node
				$sql = 'SELECT id FROM ListingCategory WHERE category_id= '.$category_id;
				$result = $dbObj->query($sql);
				//.' and root_category_id='.$root_category_id
				while ($row = mysql_fetch_assoc($result)) {
					// recursive execution of this function for each
					// child of this node
					// $node_right is the current right value, which is
					// incremented by the rebuild_tree function
					$node_right = $this->rebuildCategoryTree($row['id'], $node_right);
				}

				// we've got the left value, and now that we've processed
				// the children of this node we also know the right value
				$sql = 'UPDATE ListingCategory SET `left` = '.$node_left.', `right` = '.$node_right.', root_id = '.$root_category_id.' WHERE  id = '.$category_id;
				$dbObj->query($sql);
				$sql = 'UPDATE Listing_Category SET `category_node_left` = '.$node_left.', `category_node_right` = '.$node_right.', `category_root_id` = '.$root_category_id.' WHERE `category_id` = '.$category_id;
				$dbObj->query($sql);

				// return the right value of this node + 1
				return $node_right+1;
			}
		}

		function findRootCategoryId($category_id) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);

			/*
			 * Remove "'" if need
			 */
			$category_id = str_replace("'","",$category_id);

			while($category_id != 0) {
				$sql = "SELECT category_id, id FROM ListingCategory WHERE id = $category_id";
				$result = $dbObj->query($sql);
				$row = mysql_fetch_assoc($result);
				$category_id = $row["category_id"];
				$root_category_id = $row["id"];
			}
			return $root_category_id;
		}


		/*
		 * Function to get the entire hierarchy of categories
		 */
		function getHierarchy($id, $get_parents=false, $get_children=false){
			unset($dbObj, $string_hierarchy);
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);

			$sql = "SELECT listingcategory.id,
						   listingcategory.root_id,
						   listingcategory.left,
						   listingcategory.right,
						   listingcategory.category_id
						FROM ListingCategory listingcategory
						WHERE listingcategory.id = ".$id;
			
			$result = $dbObj->query($sql);

			if(mysql_num_rows($result) > 0){
				$aux_array = mysql_fetch_assoc($result);

				//To keep the old rules
				if (!$get_parents && !$get_children) {
					if ($aux_array["category_id"] == 0) {
						$get_parents = false;
						$get_children = true;
					}
					else {
						$get_parents = true;
						$get_children = false;
					}
				}
				
				if ($get_children) {
					// Get children
					$sql_aux = "SELECT listingcategory.id
										  FROM ListingCategory listingcategory
										  WHERE listingcategory.root_id = ".$aux_array["root_id"]." AND
												listingcategory.left    > ".$aux_array["left"]." AND
												listingcategory.right   < ".$aux_array["right"];
				}
				else if ($get_parents) {
					// Get Parents
					$sql_aux = "SELECT listingcategory.id
										  FROM ListingCategory listingcategory
										  WHERE listingcategory.root_id = ".$aux_array["root_id"]." AND
												listingcategory.left    < ".$aux_array["left"]." AND
												listingcategory.right   > ".$aux_array["right"];
				}

                //$result_hierarchy = $dbObj->query($sql_aux);
				$result_hierarchy = $dbObj->unbuffered_query($sql_aux);
                //if(mysql_num_rows($result_hierarchy) > 0){
                if($result_hierarchy){
                    unset($array_hierarchy);
                    while($row = mysql_fetch_assoc($result_hierarchy)){
                        $array_hierarchy[] = $row["id"];
                    }
                    if (is_array($array_hierarchy)){
                        $string_hierarchy = implode(',',$array_hierarchy);
                    }
				}
				if(string_strlen($string_hierarchy) > 0){
					$string_hierarchy .= ','.$id;
				}else{
					$string_hierarchy = $id;
				}
				return $string_hierarchy;
			}else{
				return false;
			}
		}

		
		/*
		 * Function to get the highest level of a category
		 */
		function getHighestLevel($id) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
			
			$ids_children = $this->getHierarchy($id, false, true);
			$max_sublevel = 1;		
			
			if ($ids_children) {
				$sql = "SELECT 
						COUNT(DISTINCT category_id) as max_sublevel
						FROM
						ListingCategory
						WHERE
						id IN ($ids_children) AND
						id != ".$id."
						";
				$result_sublevels = $dbObj->query($sql);
				
				$row = mysql_fetch_array($result_sublevels);
				$max_sublevel += $row["max_sublevel"];
			}
			return $max_sublevel;			
		}
		
		
		function Delete() {

			if ($this->id != 0) {

				foreach($this->getFullPath() as $cat_path){
					$cat_id[] = $cat_path["id"];
				}

				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$dbObj = db_getDBObject();
				};
				unset($dbMain);

				$category_ids = $this->getHierarchy($this->id, $get_parents=false, $get_children=true);

				if($category_ids){
					$sql = "SELECT listing_id FROM Listing_Category WHERE category_id IN ($category_ids)";
					$listings_ids = array();
					$result = $dbObj->query($sql);
					while($row = mysql_fetch_assoc($result)){
						$listings_ids[] = $row["listing_id"];				
					}
					
					$sql_delete = "DELETE FROM Listing_Category WHERE category_id IN ($category_ids)";
					$dbObj->query($sql_delete);
					
					$sql_delete = "DELETE FROM ListingCategory WHERE id IN ($category_ids)";
					$dbObj->query($sql_delete);
				}				
				$sql = "UPDATE Banner SET category_id = 0 WHERE category_id = $this->id AND section = 'listing'";
				$dbObj->query($sql);
				
				$this->updateFullTextItems($listings_ids);
				system_countActiveListingByCategory("", $cat_id);
				
			}
		}

		function retrieveAllCategories($lang=false, $featured=''){
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
			
			if ($lang) $langIndex = language_getIndex($lang);
			else $langIndex = EDIR_DEFAULT_LANGUAGENUMBER;

			$sql = "SELECT * FROM ListingCategory WHERE category_id = '0'";
			if ($featured == "on"){
                            $sql .= " AND featured = 'y'";
			}
			if ($lang){
                            $sql .= " AND lang LIKE ".db_formatString("%".$lang."%")."";
			}
			$sql .= "  AND enabled = 'y' ORDER BY title".$langIndex;
			$result = $dbObj->unbuffered_query($sql);
			//while($row = mysql_fetch_assoc($result)){
			while($row = mysql_fetch_assoc($result)){
                $data[] = $row;
			}
            if($data){
                return $data;
            }else{
                return false;
            }
		}


		function retrieveAllCategoriesXML($lang=false, $featured="", $category_id=0){
			$sql = "SELECT * FROM ListingCategory WHERE category_id = '".$category_id."'";
			
			if ($featured == "on"){
				$sql .= " AND featured = 'y'";
			}
			if ($lang){
				$sql .= " AND lang LIKE ".db_formatString("%".$lang."%")."";

			}
			if ($lang) $langIndex = language_getIndex($lang);
			else $langIndex = EDIR_DEFAULT_LANGUAGENUMBER;
			
			$sql .= "  AND enabled = 'y' ORDER BY title".$langIndex." limit ".MAX_SHOW_ALL_CATEGORIES;

			return system_generateXML("categories", $sql, SELECTED_DOMAIN_ID);
		}
		
		
		function getAllCategoriesHierarchyXML($lang=false, $featured="", $category_id=0, $id=0, $domain_id = false) {

			if ($lang) $langIndex = language_getIndex($lang);
			else $langIndex = EDIR_DEFAULT_LANGUAGENUMBER;

			$sql = "SELECT 
						ListingCategory_1.id,
						ListingCategory_1.title$langIndex,
						ListingCategory_1.page_title$langIndex,
						ListingCategory_1.friendly_url$langIndex,
						ListingCategory_1.category_id,
						ListingCategory_1.root_id,
						ListingCategory_1.left,
						ListingCategory_1.active_listing,
						ListingCategory_1.enabled,
						(	SELECT COUNT(ListingCategory_2.id)
							FROM
								ListingCategory ListingCategory_2
							WHERE ListingCategory_2.left < ListingCategory_1.left
							AND ListingCategory_2.right > ListingCategory_1.right
							AND ListingCategory_2.root_id = ListingCategory_1.root_id
						) level,
						(	SELECT
								COUNT(DISTINCT category_id) as max_sublevel
							FROM
								ListingCategory
							WHERE category_id IN (ListingCategory_1.id)
							AND id != ListingCategory_1.id
							AND lang LIKE ".db_formatString("%".$lang."%")."
							AND title$langIndex <> ''
                            AND enabled = 'y'
						) children
						FROM
							ListingCategory ListingCategory_1
						WHERE ListingCategory_1.root_id > 0
					";
					
			$sql .= " AND ListingCategory_1.category_id = ".$category_id;
			
			if ($id) {
				$sql .= " AND ListingCategory_1.id IN (".$id.")";
			}
			if ($featured == "on") {
				$sql .= " AND ListingCategory_1.featured = 'y'";
			}
			if ($lang) {
				$sql .= " AND ListingCategory_1.lang LIKE ".db_formatString("%".$lang."%")."";
			}

			$sql .= " AND ListingCategory_1.title$langIndex <> '' AND ListingCategory_1.enabled = 'y'";
			
			$sql .= " ORDER BY ListingCategory_1.title".$langIndex." LIMIT ".MAX_SHOW_ALL_CATEGORIES;

			return system_generateXML("categories", $sql, SELECTED_DOMAIN_ID);
		}		

		
		function retrieveAllSubCatById($id='', $lang='', $featured=''){
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
			
			if ($lang) $langIndex = language_getIndex($lang);
			else $langIndex = EDIR_DEFAULT_LANGUAGENUMBER;

			$sql = "SELECT * FROM ListingCategory WHERE category_id = $id";
			if ($featured == "on") $sql .= " AND featured = 'y'";
			if ($lang) $sql .= " AND lang LIKE ".db_formatString("%".$lang."%")."";
			$sql .= "  AND enabled = 'y' ORDER BY title".$langIndex;
			//$result = $dbObj->query($sql);
			$result = $dbObj->unbuffered_query($sql);
			while($row = mysql_fetch_assoc($result)){
                $data[] = $row;
            }
			if($data){
                return $data; 
            }else{
                return false;
            }
		}

		function getLevel() {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);

			$cat_level = 0;
			$category_id = $this->getString("id");
			while($category_id != 0) {
				$sql = "SELECT category_id FROM ListingCategory WHERE id = $category_id";
				$result = $dbObj->unbuffered_query($sql);
				$row = mysql_fetch_assoc($result);
				$category_id = $row["category_id"];
				$cat_level++;
			}
			return $cat_level;
		}

		function getFullPath($sitemgr = false) {

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);

			$langIndex = language_getIndex(EDIR_LANGUAGE);
			$arrLangs = explode(",", EDIR_LANGUAGENUMBERS);
			$endExpr = ")";

			if ((string_strpos($_SERVER["PHP_SELF"], "sitemgr") || $sitemgr) && (!string_strpos($_SERVER["PHP_SELF"], "preview"))){
				$fieldAux = "`title`";
			} else {
				$fieldAux = "`title$langIndex`";
			}

			if (count($arrLangs) > 1) {
				$fields = "	id,
							category_id,
							lang,
							active_listing,
							featured,
							enabled,
							friendly_url$langIndex, IF (`title".$langIndex."` != '', `title".$langIndex."`, ";
				foreach ($arrLangs as $lang) {
					if ($langIndex != $lang) {
						$fields .= "IF (`title".$lang."` != '', `title".$lang."`, ";
						$endExpr .= ")";
					}
				}

				$fields .= "''".$endExpr." AS $fieldAux";
			} else {
				$fields = "`id`, `category_id`, `lang`, `active_listing`, `featured`, `enabled`, `friendly_url".$langIndex."`, `title".$langIndex."` AS $fieldAux";
			}

			$category_id = $this->id;
			$i=0;
			while ($category_id != 0) {
				$sql = "SELECT $fields FROM ListingCategory WHERE id = $category_id";
				//$result = $dbObj->query($sql);
				$result = $dbObj->unbuffered_query($sql);
				$row = mysql_fetch_assoc($result);
				$path[$i]["id"] = $row["id"];
				$path[$i]["dad"] = $row["category_id"];
				$path[$i]["lang"] = $row["lang"];
				$path[$i]["title"] = $row["title"];
				$path[$i]["title$langIndex"] = $row["title$langIndex"];
				$path[$i]["friendly_url$langIndex"] = $row["friendly_url$langIndex"];
				$path[$i]["active_listing"] = $row["active_listing"];
				$path[$i]["featured"] = $row["featured"];
				$path[$i]["enabled"] = $row["enabled"];
				$i++;
				$category_id = $row["category_id"];
			}
			if ($path) {
				$path = array_reverse($path);
				for($i=0; $i < count($path); $i++) $path[$i]["level"] = $i+1;
				return($path);
			} else {
				return false;
			}
		}
		
		function updateFullTextItems($listings_ids=false) {
		
			if (!$listings_ids) {
				
				if ($this->id) {		
					$category_ids = $this->getHierarchy($this->id, $get_parents=true, $get_children=false);
					$category_ids .= (string_strlen($category_ids) ? "," :"");
					$category_ids .= $this->getHierarchy($this->id, $get_parents=false, $get_children=true);

					if($category_ids){
						$dbMain = db_getDBObject(DEFAULT_DB, true);
						if (defined("SELECTED_DOMAIN_ID")) {
							$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
						} else {
							$dbObj = db_getDBObject();
						}
						unset($dbMain);

						$sql = "SELECT listing_id FROM Listing_Category WHERE category_id IN ($category_ids)";
						$result = $dbObj->query($sql);
						
						while ($row = mysql_fetch_array($result)) {
							 if ($row['listing_id']) {
								$listingObj = new Listing($row['listing_id']);
								$listingObj->setFullTextSearch();
								unset($listingObj);
							 }
						}
					}
					return true;
				}
				return false;				
			}
			else {
				foreach ($listings_ids as $listing_id) {
					 if ($listing_id) {
						$listingObj = new Listing($listing_id);
						$listingObj->setFullTextSearch();
						unset($listingObj);
					 }
				}
				return true;
			}
		}
		
		function setFeatured() {
			if (!$this->id) return false;
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);

			$sql    = "UPDATE ListingCategory SET featured='y' WHERE id = $this->id";
			return $dbObj->query($sql);
		}


		/*
		 * Function to prepare url of each category
		 */
		function updateFullFriendlyURL(){

		 	$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$db = db_getDBObject();
			}
			unset($dbMain);

		 	 /*
		 	  * Get correct info of category
		 	  */
		 	 $sql = "SELECT ListingCategory.root_id,
		 	 				ListingCategory.left, 
		 	 				ListingCategory.right 
		 	 		FROM ListingCategory WHERE id = ".$this->root_id;
		 	 $result = $db->query($sql);
		 	 if(mysql_num_rows($result) > 0){
			 	 /*
			 	  * Get all children
			 	  */
		 	 	 $row_father = mysql_fetch_assoc($result);
			 	 $sql_children = "SELECT *
				 	 				 FROM ListingCategory
				 	 				WHERE ListingCategory.root_id=".$row_father["root_id"]." AND
				 	 					  ListingCategory.left >=".$row_father["left"]." AND
				 	 					  ListingCategory.right <=".$row_father["right"];
				 $result_children = $db->query($sql_children);
			 	 if(mysql_num_rows($result_children) > 0){
			 	 	while($row_children = mysql_fetch_assoc($result_children)){
			 	 		$cat_aux = new ListingCategory($row_children);
				 	 	$sql = "SELECT friendly_url1,
										friendly_url2,
										friendly_url3,
										friendly_url4,
										friendly_url5,
										friendly_url6,
										friendly_url7
									FROM ListingCategory
									WHERE root_id = ".$cat_aux->root_id." AND
										  ListingCategory.left <= ".$cat_aux->left." AND
										  ListingCategory.right >= ".$cat_aux->right."
								ORDER BY root_id,
										 ListingCategory.left,
										 ListingCategory.right";

						$result = $db->query($sql);
						$lines = mysql_num_rows($result);
						if(mysql_num_rows($result) > 0){
							$aux_friendly_url1 = "";
							$aux_friendly_url2 = "";
							$aux_friendly_url3 = "";
							$aux_friendly_url4 = "";
							$aux_friendly_url5 = "";
							$aux_friendly_url6 = "";
							$aux_friendly_url7 = "";
							while($row = mysql_fetch_assoc($result)){
								$lines--;
								if($row["friendly_url1"]){
									$aux_friendly_url1  .= $row["friendly_url1"].($lines > 0 ? "/":"");
								}
								if($row["friendly_url2"]){
									$aux_friendly_url2  .= $row["friendly_url2"].($lines > 0 ? "/":"");
								}
								if($row["friendly_url3"]){
									$aux_friendly_url3  .= $row["friendly_url3"].($lines > 0 ? "/":"");
								}
								if($row["friendly_url4"]){
									$aux_friendly_url4  .= $row["friendly_url4"].($lines > 0 ? "/":"");
								}
								if($row["friendly_url5"]){
									$aux_friendly_url5  .= $row["friendly_url5"].($lines > 0 ? "/":"");
								}
								if($row["friendly_url6"]){
									$aux_friendly_url6  .= $row["friendly_url6"].($lines > 0 ? "/":"");
								}
								if($row["friendly_url7"]){
									$aux_friendly_url7  .= $row["friendly_url7"].($lines > 0 ? "/":"");
								}

							}
		
							/*
							 * Save full friendly_url
							 */
							$sql_update = "UPDATE ListingCategory SET
								full_friendly_url1 = '".$aux_friendly_url1."',
								full_friendly_url2 = '".$aux_friendly_url2."',
								full_friendly_url3 = '".$aux_friendly_url3."',
								full_friendly_url4 = '".$aux_friendly_url4."',
								full_friendly_url5 = '".$aux_friendly_url5."',
								full_friendly_url6 = '".$aux_friendly_url6."',
								full_friendly_url7 = '".$aux_friendly_url7."'
								WHERE id = ".$cat_aux->id;

							$db->query($sql_update);
						}
					}	
			 	} 	
		 	}
		}

		function countActiveListingByCategory ($category_id = "", $domain_id = false) {
			$category_id = ($category_id != "")? $category_id: $this->id;
			$active_listings = 0;

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
            
			// counting listings of this category
			$sql_counter = "SELECT count(distinct a.id) counter
			                 FROM Listing a
			                    INNER JOIN Listing_Category b on (a.id = b.listing_id)
			                    INNER JOIN ListingCategory c on (b.category_id = c.id)
			                 WHERE (a.status = 'A') 
			                   AND c.`left` >= (select cl.`left` from ListingCategory cl where cl.id = $category_id)
			                   AND c.`right` <= (select cr.`right` from ListingCategory cr where cr.id = $category_id)
			                   AND c.root_id = (select root.root_id from ListingCategory root where root.id = $category_id)";
			$r_counter = $dbObj->unbuffered_query($sql_counter);
			$row_counter = mysql_fetch_assoc($r_counter);
			$active_listings = $row_counter["counter"];

			// counting listings of all subcategories (not only the immediatelly below this)
			$sql_sub = "SELECT id FROM ListingCategory WHERE category_id = $category_id";
			$r_sub = $dbObj->query($sql_sub);
			while ($row_sub = mysql_fetch_assoc($r_sub)) {
				$this->countActiveListingByCategory($row_sub["id"]);
			}

			$sql_update = "UPDATE ListingCategory SET active_listing = ".$active_listings." WHERE id = ".$category_id;
			$dbObj->query($sql_update);
			if ($this->id == $category_id) {
				$this->active_listing = $active_listings;
			}

			return $active_listings;
		}
	}

?>
