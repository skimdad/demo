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
	# * FILE: /classes/class_BlogCategory.php
	# ----------------------------------------------------------------------------------------------------

	class BlogCategory extends Handle {

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
		var $active_post;
		var $level;
		var $legacy_id;

		function BlogCategory($var='') {
			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}

				unset($dbMain);
				$sql = "SELECT * FROM BlogCategory WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row='') {

			$this->id				= ($row["id"])					? $row["id"]				: ($this->id             ? $this->id				: 0);
			$this->lang				= ($row["lang"])				? $row["lang"]				: "";
			$this->title			= ($row["title"])				? $row["title"]				: ($this->title			 ? $this->title			: "");
			$this->title1			= ($row["title1"])				? $row["title1"]			: ($this->title1         ? $this->title1			: "");
			$this->title2			= ($row["title2"])				? $row["title2"]			: ($this->title2         ? $this->title2			: "");
			$this->title3			= ($row["title3"])				? $row["title3"]			: ($this->title3         ? $this->title3			: "");
			$this->title4			= ($row["title4"])				? $row["title4"]			: ($this->title4         ? $this->title4			: "");
			$this->title5			= ($row["title5"])				? $row["title5"]			: ($this->title5         ? $this->title5			: "");
			$this->title6			= ($row["title6"])				? $row["title6"]			: ($this->title6         ? $this->title6			: "");
			$this->title7			= ($row["title7"])				? $row["title7"]			: ($this->title7         ? $this->title7			: "");
			$this->page_title1		= ($row["page_title1"])			? $row["page_title1"]		: ($this->page_title1    ? $this->page_title1		: "");
			$this->page_title2		= ($row["page_title2"])			? $row["page_title2"]		: ($this->page_title2    ? $this->page_title2		: "");
			$this->page_title3		= ($row["page_title3"])			? $row["page_title3"]		: ($this->page_title3    ? $this->page_title3		: "");
			$this->page_title4		= ($row["page_title4"])			? $row["page_title4"]		: ($this->page_title4    ? $this->page_title4		: "");
			$this->page_title5		= ($row["page_title5"])			? $row["page_title5"]		: ($this->page_title5    ? $this->page_title5		: "");
			$this->page_title6		= ($row["page_title6"])			? $row["page_title6"]		: ($this->page_title6    ? $this->page_title6		: "");
			$this->page_title7		= ($row["page_title7"])			? $row["page_title7"]		: ($this->page_title7    ? $this->page_title7		: "");
			$this->friendly_url1	= ($row["friendly_url1"])		? $row["friendly_url1"]		: ($this->friendly_url1  ? $this->friendly_url1		: "");
			$this->friendly_url2	= ($row["friendly_url2"])		? $row["friendly_url2"]		: ($this->friendly_url2  ? $this->friendly_url2		: "");
			$this->friendly_url3	= ($row["friendly_url3"])		? $row["friendly_url3"]		: ($this->friendly_url3  ? $this->friendly_url3		: "");
			$this->friendly_url4	= ($row["friendly_url4"])		? $row["friendly_url4"]		: ($this->friendly_url4  ? $this->friendly_url4		: "");
			$this->friendly_url5	= ($row["friendly_url5"])		? $row["friendly_url5"]		: ($this->friendly_url5  ? $this->friendly_url5		: "");
			$this->friendly_url6	= ($row["friendly_url6"])		? $row["friendly_url6"]		: ($this->friendly_url6  ? $this->friendly_url6		: "");
			$this->friendly_url7	= ($row["friendly_url7"])		? $row["friendly_url7"]		: ($this->friendly_url7  ? $this->friendly_url7		: "");
			$this->category_id		= ($row["category_id"])			? $row["category_id"]		: ($this->category_id    ? $this->category_id		: 0);
			$this->featured			= ($row["featured"])			? $row["featured"]			: ($this->featured        ? $this->featured			: "y");
			$this->seo_description1	= ($row["seo_description1"])	? $row["seo_description1"]	: "";
			$this->seo_description2	= ($row["seo_description2"])	? $row["seo_description2"]	: "";
			$this->seo_description3	= ($row["seo_description3"])	? $row["seo_description3"]	: "";
			$this->seo_description4	= ($row["seo_description4"])	? $row["seo_description4"]	: "";
			$this->seo_description5	= ($row["seo_description5"])	? $row["seo_description5"]	: "";
			$this->seo_description6	= ($row["seo_description6"])	? $row["seo_description6"]	: "";
			$this->seo_description7	= ($row["seo_description7"])	? $row["seo_description7"]	: "";
			$this->keywords1		= ($row["keywords1"])			? $row["keywords1"]			: ($this->keywords1      ? $this->keywords1			: "");
			$this->keywords2		= ($row["keywords2"])			? $row["keywords2"]			: ($this->keywords2      ? $this->keywords2			: "");
			$this->keywords3		= ($row["keywords3"])			? $row["keywords3"]			: ($this->keywords3      ? $this->keywords3			: "");
			$this->keywords4		= ($row["keywords4"])			? $row["keywords4"]			: ($this->keywords4      ? $this->keywords4			: "");
			$this->keywords5		= ($row["keywords5"])			? $row["keywords5"]			: ($this->keywords5      ? $this->keywords5			: "");
			$this->keywords6		= ($row["keywords6"])			? $row["keywords6"]			: ($this->keywords6      ? $this->keywords6			: "");
			$this->keywords7		= ($row["keywords7"])			? $row["keywords7"]			: ($this->keywords7      ? $this->keywords7			: "");
			$this->seo_keywords1	= ($row["seo_keywords1"])		? $row["seo_keywords1"]		: "";
			$this->seo_keywords2	= ($row["seo_keywords2"])		? $row["seo_keywords2"]		: "";
			$this->seo_keywords3	= ($row["seo_keywords3"])		? $row["seo_keywords3"]		: "";
			$this->seo_keywords4	= ($row["seo_keywords4"])		? $row["seo_keywords4"]		: "";
			$this->seo_keywords5	= ($row["seo_keywords5"])		? $row["seo_keywords5"]		: "";
			$this->seo_keywords6	= ($row["seo_keywords6"])		? $row["seo_keywords6"]		: "";
			$this->seo_keywords7	= ($row["seo_keywords7"])		? $row["seo_keywords7"]		: "";
			$this->content1			= ($row["content1"])			? $row["content1"]			: "";
			$this->content2			= ($row["content2"])			? $row["content2"]			: "";
			$this->content3			= ($row["content3"])			? $row["content3"]			: "";
			$this->content4			= ($row["content4"])			? $row["content4"]			: "";
			$this->content5			= ($row["content5"])			? $row["content5"]			: "";
			$this->content6			= ($row["content6"])			? $row["content6"]			: "";
			$this->content7			= ($row["content7"])			? $row["content7"]			: "";
			$this->active_post		= ($row["active_post"])			? $row["active_post"]		: ($this->active_post	? $this->active_post		: 0);
			$this->level			= ($row["level"])				? $row["level"]				: 0;
			$this->level			= ($row["level"])				? $row["level"]				: 0;
			$this->legacy_id		= ($row["legacy_id"])			? $row["legacy_id"]			: ($this->legacy_id      ? $this->legacy_id			: "");

		}

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

			$this->friendly_url = string_strtolower($this->friendly_url);

			if ($this->id) {

				$sql = "UPDATE BlogCategory SET"
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
					. " active_post = $this->active_post,"
					. " level = $this->level,"
					. " legacy_id = $this->legacy_id"
					. " WHERE id = $this->id";

				$dbObj->query($sql);

			} else {

				$sql = "INSERT INTO BlogCategory"
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
					. " active_post,"
					. " level,"
					. " legacy_id)"
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
					. " $this->active_post,"
					. " $this->level,"
					. " $this->legacy_id)";

				$dbObj->query($sql);
				
				$this->id = mysql_insert_id($dbObj->link_id);
				
				/*
				 * Legacy ID to Wordpress
				 */
				if($empty_legacy_id){
					unset($sql_legacy_id);
					$sql_legacy_id = "UPDATE BlogCategory SET legacy_id = 'ed_".$this->id."' WHERE id = ".$this->id;
					$dbObj->query($sql_legacy_id);
					
				}

			}

			$this->prepareToUse();

		}

		function Delete() {

			if ($this->id != 0) {

				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$dbObj = db_getDBObject();
				}

				unset($dbMain);

				$sql = "SELECT * FROM BlogCategory WHERE category_id = $this->id";
				$r = $dbObj->query($sql);
				while ($row = mysql_fetch_array($r)) {
					$sql = "SELECT * FROM BlogCategory WHERE category_id = $row[id]";
					$r2 = $dbObj->query($sql);
					while ($row2 = mysql_fetch_array($r2)) {
						$sql = "SELECT * FROM BlogCategory WHERE category_id = $row2[id]";
						$r3 = $dbObj->query($sql);
						while ($row3 = mysql_fetch_array($r3)) {
							$sql = "SELECT * FROM BlogCategory WHERE category_id = $row3[id]";
							$r4 = $dbObj->query($sql);
							while ($row4 = mysql_fetch_array($r4)) {
								$sql = "DELETE FROM BlogCategory WHERE id = $row4[id]";
								$dbObj->query($sql);
							}
							$sql = "DELETE FROM BlogCategory WHERE id = $row3[id]";
							$dbObj->query($sql);
						}
						$sql = "DELETE FROM BlogCategory WHERE id = $row2[id]";
						$dbObj->query($sql);
					}
					$sql = "DELETE FROM BlogCategory WHERE id = $row[id]";
					$dbObj->query($sql);
				}

				$sql = "DELETE FROM BlogCategory WHERE id = $this->id LIMIT 1";
				$dbObj->query($sql);

				$sql = "SELECT * FROM Post_Item WHERE blogcat_id = $this->id";
				$r = $dbObj->query($sql);
				while ($r = mysql_fetch_array($r)) {
					$sql = "DELETE FROM Post_Item WHERE id = $r[id]";
					$dbObj->query($sql);
				}

				$this->updateFullTextItems();

			}

		}

		function retrieveAllCategories($lang=false, $featured=''){
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			
			if ($lang) $langIndex = language_getIndex($lang);
			else $langIndex = EDIR_DEFAULT_LANGUAGENUMBER;

			unset($dbMain);
			$sql = "SELECT * FROM BlogCategory WHERE category_id = '0'";
			if ($featured == "on") $sql .= " AND featured = 'y'";
			if ($lang) $sql .= " AND lang LIKE ".db_formatString("%".$lang."%")."";
			$sql .= " ORDER BY title".$langIndex;
			$result = $dbObj->query($sql);
			while($row = mysql_fetch_assoc($result)) $data[] = $row;
			if($data) return $data; else return false;
		}

		function retrieveAllSubCatById($id='', $lang='', $featured=''){
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			
			if ($lang) $langIndex = language_getIndex($lang);
			else $langIndex = EDIR_DEFAULT_LANGUAGENUMBER;

			unset($dbMain);
			$sql = "SELECT * FROM BlogCategory WHERE category_id = $id";
			if ($featured == "on") $sql .= " AND featured = 'y'";
			if ($lang) $sql .= " AND lang LIKE ".db_formatString("%".$lang."%")."";
			$sql .= " ORDER BY title".$langIndex;
			$result = $dbObj->query($sql);
			while($row = mysql_fetch_assoc($result)) $data[] = $row;
			if($data) return $data; else return false;
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
				$sql = "SELECT category_id FROM BlogCategory WHERE id = $category_id";
				$result = $dbObj->query($sql);
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
							active_post,
							featured,
							friendly_url$langIndex, IF (`title".$langIndex."` != '', `title".$langIndex."`, ";
				foreach ($arrLangs as $lang) {
					if ($langIndex != $lang) {
						$fields .= "IF (`title".$lang."` != '', `title".$lang."`, ";
						$endExpr .= ")";
					}
				}

				$fields .= "''".$endExpr." AS $fieldAux";
			} else {
				$fields = "`id`, `category_id`, `lang`, `active_post`, `featured`, `friendly_url".$langIndex."`, `title".$langIndex."` AS $fieldAux";
			}

			$category_id = $this->id;
			$i=0;
			while ($category_id != 0) {
				$sql = "SELECT $fields FROM BlogCategory WHERE id = $category_id";
				$result = $dbObj->query($sql);
				$row = mysql_fetch_assoc($result);
				$path[$i]["id"] = $row["id"];
				$path[$i]["dad"] = $row["category_id"];
				$path[$i]["lang"] = $row["lang"];
				$path[$i]["title"] = $row["title"];
				$path[$i]["title$langIndex"] = $row["title$langIndex"];
				$path[$i]["friendly_url$langIndex"] = $row["friendly_url$langIndex"];
				$path[$i]["active_post"] = $row["active_post"];
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
		
		function updateFullTextItems() {
		
			if ($this->id) {
				
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$dbObj = db_getDBObject();
				}

				unset($dbMain);
				
				$category_id = $this->id;
				$whereCategory = "(blogcat_id = ".$category_id.")";
				$sql   		   = "SELECT post_id FROM Post_Item WHERE $whereCategory";
				$result        = $dbObj->query($sql);
				
				while ($row = mysql_fetch_array($result)) {
					 if ($row['post_id']) {
					 	$postObj = new Post($row['post_id']);
					 	$postObj->setFullTextSearch();
					 	unset($postObj);
					 }
				}
				return true;
			}
			return false;
			
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
			$sql    = "UPDATE BlogCategory SET featured='y'  WHERE id=$this->id";
			return $dbObj->query($sql);
		}
		
		/*
		 * Function to save Wordpress Categories on eDirectory
		 */
		function SaveWPToEdir($wp_content){
			
			if(!is_array($wp_content)){
				$wp_content = unserialize($wp_content);
			}

			if(is_array($wp_content)){
				
				$langIndex = language_getIndex(EDIR_DEFAULT_LANGUAGE);
				
				/*
				 * Get category ID using legacy ID
				 */
				$db = db_getDBObject();
				$sql = "SELECT id FROM BlogCategory WHERE legacy_id = '"."wp_".$wp_content["fields"]["term_id"]."'";

				$result = $db->query($sql);
				if(mysql_num_rows($result)){
					$row = mysql_fetch_assoc($result);
					$this->makeFromRow($row);
				}
				
				if ($wp_content["fields"]["parent"]){
					
					$sql = "SELECT id, category_id, level FROM BlogCategory WHERE legacy_id = '"."wp_".$wp_content["fields"]["parent"]."'";
					$resultParent = $db->query($sql);
					if(mysql_num_rows($resultParent)){
						$rowParent = mysql_fetch_assoc($resultParent);
						$auxParent = $rowParent["category_id"];
						$lastParent = $rowParent["id"];
						$level = $rowParent["level"];
						if ($level >= 5){
							$level = 5;
							$lastParent = $auxParent;
						} else {
							
							$count = 2;
							while ($auxParent != 0){
								unset($rowParentAux);

								$sql = "SELECT category_id FROM BlogCategory WHERE id = ".$auxParent;
								$resultParentAux = $db->query($sql);
								if(mysql_num_rows($resultParentAux)){
									$rowParentAux = mysql_fetch_assoc($resultParentAux);
								}
								$auxParent = $rowParentAux["category_id"];
								$count++;

							}
							$level = $count;
						}

					}
					
				} else {
					$level = 1;
				}
				
				$fields[0]["name"]		= "title".$langIndex;
				$fields[0]["content"]	= $wp_content["fields"]["name"];
				
				$fields[1]["name"]		= "legacy_id";
				$fields[1]["content"]	= "wp_".$wp_content["fields"]["term_id"];
				
				$fields[2]["name"]		= "category_id";
				$fields[2]["content"]	= $lastParent;
				
				$fields[3]["name"]		= "friendly_url".$langIndex;
				$fields[3]["content"]	= $wp_content["fields"]["slug"];
				
				$fields[4]["name"]		= "lang";
				$fields[4]["content"]	= EDIR_DEFAULT_LANGUAGE;
				
				$fields[5]["name"]		= "page_title".$langIndex;
				$fields[5]["content"]	= $wp_content["fields"]["name"];
				
				$fields[6]["name"]		= "level";
				$fields[6]["content"]	= $level;
				
				/*
				 * Check if needs create friendly_url
				 */
				if(!$fields[3]["content"]){
					$blogcategory_friendly_url = preg_replace("/[^".FRIENDLYURL_VALIDCHARS."]/", FRIENDLYURL_SEPARATOR, $wp_content["fields"]["slug"]);
					$blogcategory_friendly_url = string_strtolower(preg_replace("/[\\".FRIENDLYURL_SEPARATOR."]{2,}/", FRIENDLYURL_SEPARATOR, $blogcategory_friendly_url));
					$fields[3]["content"]	= $blog_friendly_url;
				}
				
				for($i=0;$i<count($fields);$i++){
					$this->$fields[$i]["name"] = $fields[$i]["content"];
				}

				$this->Save();
				//Updating items fulltext fields
				if (BLOGCATEGORY_SCALABILITY_OPTIMIZATION != 'on' && BLOG_SCALABILITY_OPTIMIZATION != 'on') {
					$this->updateFullTextItems();
				}
				
			}
		}
		
		function deleteWPCategory($wp_fields) {

			if($wp_fields["fields"]["id"]){
				
				$dbObj = db_getDBObject();
				
				$sql = "SELECT id FROM BlogCategory WHERE legacy_id = 'wp_".$wp_fields["fields"]["id"]."'";
				$result = $dbObj->query($sql);
				
				if(mysql_num_rows($result)){
					while($row = mysql_fetch_assoc($result)){
						$this->id = $row["id"];
						$this->Delete();
					}
				}
			}
		}
}
?>
