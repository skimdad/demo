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
	# * FILE: /classes/class_pageBrowsing.php
	# ----------------------------------------------------------------------------------------------------

	class pageBrowsing extends Handle {

		var $table;
		var $join;
		var $screen;
		var $next_screen;
		var $back_screen;
		var $start;
		var $limit;
		var $letter_field;
		var $letter;
		var $where;
		var $having;
		var $order;
		var $record_amount;
		var $pages;

		var $force_main;
		var $main_database;
		var $selected_domain_id;

		function pageBrowsing($table = "Listing", $screen = 1, $limit = false, $order = false, $letter_field = false, $letter = false, $where = false, $return_columns = "*", $return_object = false, $group_by = false, $force_main = false, $selected_domain_id = false, $having = false) {

			$this->force_main = $force_main;
			$this->main_database = db_getDBObject(DEFAULT_DB, true);
			$this->selected_domain_id = defined("SELECTED_DOMAIN_ID")? SELECTED_DOMAIN_ID: $selected_domain_id;
			
			if (!is_numeric($screen) || ($screen <= 0)) $screen = 1;
			if (!$screen) $screen = 1;

			if ($this->force_main) {
				$db_mysqlversion = db_getDBObject(DEFAULT_DB, true);
			} else if ($this->selected_domain_id) {
				$db_mysqlversion = db_getDBObjectByDomainID($this->selected_domain_id, $this->main_database);
			} else {
				$db_mysqlversion = db_getDBObject();
			}
			$mysqlversion = mysql_get_server_info($db_mysqlversion->link_id);
			$mysqlversion = string_substr($mysqlversion, 0, string_strpos($mysqlversion, "."));

			/* Implementation for Mysql 3.23 ********************************/
			if ($mysqlversion <= 3) {

				if ($this->force_main) {
					$db = db_getDBObject(DEFAULT_DB, true);
				} else if ($this->selected_domain_id) {
					$db = db_getDBObjectByDomainID($this->selected_domain_id, $this->main_database);
				} else {
					$db = db_getDBObject();
				}

				$sql = "SELECT $return_columns FROM $table";

				if ($letter && $where) {
					if ($letter == "no") {
						$sql .= " WHERE $letter_field REGEXP '^[^a-zA-Z].*$' AND $where";
					} else {
						if ($table == "Account") {
							$sql .= " WHERE (($letter_field LIKE ".db_formatString($letter."%")." AND $letter_field NOT LIKE ".db_formatString("%::%").") OR $letter_field LIKE ".db_formatString("%::".$letter."%").") AND $where";
						} else {
							$sql .= " WHERE $letter_field LIKE ".db_formatString($letter."%")." AND $where";
						}
					}
				} elseif ($letter) {
					if ($letter == "no") {
						$sql .= " WHERE $letter_field REGEXP '^[^a-zA-Z].*$'";
					} else {
						if ($table == "Account") {
							$sql .= " WHERE (($letter_field LIKE ".db_formatString($letter."%")." AND $letter_field NOT LIKE ".db_formatString("%::%").") OR $letter_field LIKE ".db_formatString("%::".$letter."%").")";
						} else {
							$sql .= " WHERE $letter_field LIKE ".db_formatString($letter."%")."";
						}
					}
				} elseif($where) {
					$sql .= " WHERE $where";
				}

				if ($group_by) $sql .= " GROUP BY $group_by";

				$record_amount = mysql_num_rows($db->query($sql));

			}
			/******************************************************************/

			$this->letters = explode(",", system_showText(LANG_LETTERS));

			$aux = explode("|", $table);

			$this->table			= $aux[0];
			$this->join				= $aux[1];
			$this->screen			= $screen;
			$this->limit			= $limit;
			$this->start			= ($screen-1) * $limit;
			$this->order			= $order;
			$this->group_by			= $group_by;
			$this->letter_field		= $letter_field;
			$this->letter			= $letter;
			$this->where			= $where;
			$this->having			= $having;
			$this->return_columns	= $return_columns;
			$this->return_object	= $return_object;

			/* Implementation for Mysql 3.23 ********************************/
			if ($mysqlversion <= 3) {
				$this->record_amount	= $record_amount;
				$this->pages			= ceil($record_amount/$limit);
				$this->next_screen		= ($screen >= ceil($record_amount/$limit)) ? ceil($record_amount/$limit) : ($screen+1);
				$this->back_screen		= ($screen <= 1) ? 1 : ($screen-1);
				$this->page_jump		= (ceil($record_amount/$limit) > 1000) ? 100 : 1;
			}
			/******************************************************************/

		}

		function retrievePage($return_type = "object", $aux_total_items = false) {
			if ($this->force_main) {
				$db = db_getDBObject(DEFAULT_DB, true);
			} else if ($this->selected_domain_id) {
				$db = db_getDBObjectByDomainID($this->selected_domain_id, $this->main_database);
			} else {
				$db = db_getDBObject();
			}
			
			$mysqlversion = mysql_get_server_info($db->link_id);
			$mysqlversion = string_substr($mysqlversion, 0, string_strpos($mysqlversion, "."));


			if ($this->table == "profile_review") {

				if (!$_GET["id"]) {
					$id = sess_getAccountIdFromSession();
				} else {
					$id = $_GET["id"];
				}
				setting_get("commenting_edir", $commenting_edir);
				setting_get("review_listing_enabled", $review_enabled);
				setting_get("review_article_enabled", $review_article_enabled);
				setting_get("review_promotion_enabled", $review_promotion_enabled);

				if ($review_enabled == "on" && $commenting_edir) {
					$locations = explode(",", EDIR_LOCATIONS);
					$sql = " SELECT
						Listing_Summary.title,
						Listing_Summary.level,
						Listing_Summary.friendly_url,
						Review.id AS rID,
						item_id AS id,
						member_id,
						added,
						reviewer_name,
						reviewer_location,
						review_title,
						review, rating,
						item_type";
					$sql .= " FROM Review";
					$sql .= " LEFT JOIN Listing_Summary ON (Review.item_id = Listing_Summary.id)";
					$sql .= " WHERE item_type = 'listing' AND member_id = ".$id." AND approved = 1 AND Listing_Summary.status = 'A'";
					$sql .= " ORDER BY item_type DESC, id, added DESC";

					//$r = $db->query($sql);
					$r = $db->unbuffered_query($sql);

					unset($ids);
					if ($return_type == "array") {
                                            while ($row = mysql_fetch_assoc($r)) {
                                                $resultAux[] = $row;
                                            }
					}
				}

				if ($review_article_enabled == "on" && $commenting_edir && ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
					$sql = " SELECT
						Article.title,
						Article.level,
						Article.friendly_url,
						Review.id AS rID,
						item_id AS id,
						member_id,
						added,
						reviewer_name,
						reviewer_location,
						review_title,
						review, rating,
						item_type";
					$sql .= " FROM Review";
					$sql .= " LEFT JOIN Article ON (Review.item_id = Article.id)";
					$sql .= " WHERE item_type = 'article' AND member_id = ".$id." AND approved = 1 AND Article.status = 'A'";

					$sql .= " ORDER BY item_type DESC, id, added DESC";

					//$r = $db->query($sql);
					$r = $db->unbuffered_query($sql);

					unset($ids);
					if ($return_type == "array") {
                                            while ($row = mysql_fetch_assoc($r)) {
                                                $resultAux[] = $row;
                                            }
					}
				}

				if ($review_promotion_enabled == "on" && $commenting_edir && PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on") {
					$sql = " SELECT
						Promotion.name,
						Promotion.friendly_url,
						Review.id AS rID,
						item_id AS id,
						member_id,
						added,
						reviewer_name,
						reviewer_location,
						review_title,
						review, rating,
						item_type";
					$sql .= " FROM Review";
					$sql .= " LEFT JOIN Promotion ON (Review.item_id = Promotion.id)";
					$sql .= " WHERE item_type = 'promotion' AND member_id = ".$id." AND approved = 1";

					$sql .= " ORDER BY item_type DESC, id, added DESC";

					//if ($this->limit) $sql .= " LIMIT $this->start,$this->limit";

					//$r = $db->query($sql);
					$r = $db->unbuffered_query($sql);

					unset($ids);
					if ($return_type == "array") {
                                            while ($row = mysql_fetch_assoc($r)) {
                                                $resultAux[] = $row;
                                            }
					}
				}

				$start =  $this->start;
				$end = $start + $this->limit;
				if ($end > count($resultAux)) $end = count($resultAux);

				for ($i = $start; $i < $end; $i++) {
					$result[] = $resultAux[$i];
				}

				if ($review_enabled == "on" && $commenting_edir) {
					$sql1 = " SELECT COUNT(0) as row_amount FROM Review";
					$sql1 .= " LEFT JOIN Listing_Summary ON (Review.item_id = Listing_Summary.id)";
					$sql1 .= " WHERE item_type = 'listing' AND member_id = ".$id." AND approved = 1 AND Listing_Summary.status = 'A'";
					$r1 = $db->query($sql1);
					$row1 = mysql_fetch_assoc($r1);
				}

				if ($review_article_enabled == "on") {
					$sql2 = " SELECT COUNT(0) as row_amount FROM Review";
					$sql2 .= " LEFT JOIN Article ON (Review.item_id = Article.id)";
					$sql2 .= " WHERE item_type = 'article' AND member_id = ".$id." AND approved = 1 AND Article.status = 'A'";
					$r2 = $db->query($sql2);
					$row2 = mysql_fetch_assoc($r2);
				}

				if ($review_promotion_enabled == "on") {
					$sql3 = " SELECT COUNT(0) as row_amount FROM Review";
					$sql3 .= " LEFT JOIN Promotion ON (Review.item_id = Promotion.id)";
					$sql3 .= " WHERE item_type = 'promotion' AND member_id = ".$id." AND approved = 1";
					$r3 = $db->query($sql3);
					$row3 = mysql_fetch_assoc($r3);
				}

				$this->record_amount	= $row1["row_amount"] + $row2["row_amount"] + $row3["row_amount"];
				$this->pages			= ceil($this->record_amount/$this->limit);
				$this->next_screen		= ($this->screen >= ceil($this->record_amount/$this->limit)) ? ceil($this->record_amount/$this->limit) : ($this->screen+1);
				$this->back_screen		= ($this->screen <= 1) ? 1 : ($this->screen-1);
				$this->page_jump		= $this->calculatePageJump();

				return $result;

			} else if ($this->table=="QuickList"){

				$langIndex = language_getIndex(EDIR_LANGUAGE);

				if ($this->letter) {
					if ($this->letter == "no") {
						$this->where .= (!$this->where) ? " $this->letter_field REGEXP '^[^a-zA-Z].*$'" : " AND $this->letter_field REGEXP '^[^a-zA-Z].*$'";
					} else {
						if (!$this->where) {
							$this->where .= " $this->letter_field LIKE ".db_formatString($this->letter."%")."";
						} else {
							$this->where .= " AND $this->letter_field LIKE ".db_formatString($this->letter."%")."";
						}
					}
				}

				/* Implementation for Mysql 3.23 ********************************/
				if ($mysqlversion <= 3) {
					$sql = "SELECT $this->return_columns FROM $this->table";
				}
				/******************************************************************/

				/* Implementation for Mysql 4.1.x ********************************/
				if ($mysqlversion > 3) {

					$sql .= "SELECT ";
					if ($this->where["listing"]){
						$sql .= "id,title as title,'name' as name,friendly_url as friendly_url,thumb_id,level as level,account_id,address as address,address2 as address2,listingtemplate_id as listingtemplate_id,claim_disable as claim_disable,video_snippet as video_snippet,phone as phone,zip_code as zip_code,'map_zoom' as map_zoom, description$langIndex as description, fax as fax,display_url as display_url,url as url,email as email,attachment_file as attachment_file,attachment_caption as attachment_caption,long_description$langIndex as long_description,hours_work as hours_work,locations as locations,description$langIndex as description,'publication_date' as publication_date,'author' as author,'author_url' as author_url, 'abstract$langIndex' as abstract,'summarydesc$langIndex' as summarydesc, phone as phone, email as email,'classified_price' as classified_price,url as url,'aListing' as module FROM Listing WHERE id IN (".$this->where['listing'].")";
						if (($this->where["promotion"]) || ($this->where["event"]) || ($this->where["classified"]) || ($this->where["article"]))
							$sql .=" UNION ";
					}
					if ($this->where["event"]){
						if ($this->where["listing"])
							$sql .="select id,title as title,'name' as name,friendly_url as friendly_url,thumb_id,level as level,account_id,address as address,'address2' as address2,'listingtemplate_id' as listingtemplate_id,'claim_disable' as claim_disable,'video_snippet' as video_snippet,phone as phone,'zip_code' as zip_code,'map_zoom' as map_zoom, description$langIndex as description, 'fax' as fax,'display_url' as display_url,'url' as url,'email' as email,'attachment_file' as attachment_file,'attachment_caption' as attachment_caption,'long_description$langIndex' as long_description,'hours_work' as hours_work,'locations' as locations,'description$langIndex' as description,'publication_date' as publication_date,'author' as author,'author_url' as author_url, 'abstract$langIndex' as abstract,'summarydesc$langIndex' as summarydesc, phone as phone, 'email' as email,'classified_price' as classified_price,'url' as url,'bEvent' as module from Event WHERE id IN (".$this->where['event'].")";
						else
							$sql .="id,title as title, 'name' as name,friendly_url as friendly_url,thumb_id,level as level,account_id,address as address,'address2' as address2,'listingtemplate_id' as listingtemplate_id,'claim_disable' as claim_disable,'video_snippet' as video_snippet,phone as phone,'zip_code' as zip_code,'map_zoom' as map_zoom, description$langIndex as description, 'fax' as fax,'display_url' as display_url,'url' as url,'email' as email,'attachment_file' as attachment_file,'attachment_caption' as attachment_caption,'long_description$langIndex' as long_description,'hours_work' as hours_work,'locations' as locations,'description$langIndex' as description,'publication_date' as publication_date,'author' as author,'author_url' as author_url, 'abstract$langIndex' as abstract,'summarydesc$langIndex' as summarydesc, phone as phone, 'email' as email,'classified_price' as classified_price,'url' as url,'bEvent' as module from Event WHERE id IN (".$this->where['event'].")";
						if (($this->where["classified"]) || ($this->where["article"]) || ($this->where["promotion"]))
							$sql .=" UNION ";
					}
					if ($this->where["classified"]){
						if (($this->where["event"]) || ($this->where["listing"]))
							$sql .="select id,title as title,'name' as name,friendly_url as friendly_url,thumb_id,level as level,account_id,address as addressA,address2 as address2A,'listingtemplate_id','claim_disable' as claim_disable,'video_snippet' as video_snippet,phone as phone,'zip_code' as zip_code,'map_zoom' as map_zoom, 'description$langIndex' as description, 'fax' as faxr,'display_url' as display_url,url as url,email as email,'attachment_file' as attachment_file,'attachment_caption' as attachment_caption,'long_description$langIndex' as long_description,'hours_work' as hours_work,'locations' as locations,'description$langIndex' as description,'publication_date' as publication_date,'author' as author,'author_url' as author_url, 'abstract$langIndex' as abstract,summarydesc$langIndex as summarydesc, phone as phone, email as email,classified_price as classified_price,url as url,'cClassified' as module from Classified WHERE id IN (".$this->where['classified'].")";
						else
							$sql .="id,title as title, 'name' as name,friendly_url as friendly_url,thumb_id,level as level,account_id,address as addressA,address2 as address2A,'listingtemplate_id','claim_disable' as claim_disable,'video_snippet' as video_snippet,phone as phone,'zip_code' as zip_code,'map_zoom' as map_zoom, 'description$langIndex' as description, 'fax' as faxr,'display_url' as display_url,url as url,email as email,'attachment_file' as attachment_file,'attachment_caption' as attachment_caption,'long_description$langIndex' as long_description,'hours_work' as hours_work,'locations' as locations,'description$langIndex' as description,'publication_date' as publication_date,'author' as author,'author_url' as author_url, 'abstract$langIndex' as abstract,summarydesc$langIndex as summarydesc, phone as phone, email as email,classified_price as classified_price,url as url,'cClassified' as module from Classified WHERE id IN (".$this->where['classified'].")";
						if (($this->where["article"]) || ($this->where["promotion"]))
							$sql .=" UNION ";
					}
					if ($this->where["article"]){
						if (($this->where["event"]) || ($this->where["listing"]) || ($this->where["classified"]))
							$sql .="select id,title as title, 'name' as name,friendly_url as friendly_url,thumb_id,level as level,account_id,'address' as addressA,'address2' as address2,'listingtemplate_id','claim_disable' as claim_disable,'video_snippet' as video_snippet,'phone' as phone,'zip_code' as zip_code,'map_zoom' as map_zoom, 'description$langIndex' as description, 'fax' as fax,'display_url' as display_url,'url' as url,'email' as email,'attachment_file' as attachment_file,'attachment_caption' as attachment_caption,'long_description$langIndex' as long_description,'hours_work' as hours_wok,'locations' as locations,'description$langIndex' as description,publication_date as publication_date,author as author,author_url as author_url, abstract$langIndex as abstract,'summarydesc$langIndex' as summarydesc, 'phone' as phone, 'email' as email,'classified_price' as classified_price,'url' as url,'dArticle' as module from Article WHERE id IN (".$this->where['article'].")";
						else
							$sql .="id,title as title,'name' as name,friendly_url as friendly_url,thumb_id,level as level,account_id,'address' as addressA,'address2' as address2,'listingtemplate_id','claim_disable' as claim_disable,'video_snippet' as video_snippet,'phone' as phone,'zip_code' as zip_code,'map_zoom' as map_zoom, 'description$langIndex' as description, 'fax' as fax,'display_url' as display_url,'url' as url,'email' as email,'attachment_file' as attachment_file,'attachment_caption' as attachment_caption,'long_description$langIndex' as long_description,'hours_work' as hours_wok,'locations' as locations,'description$langIndex' as description,publication_date as publication_date,author as author,author_url as author_url, abstract$langIndex as abstract,'summarydesc$langIndex' as summarydesc, 'phone' as phone, 'email' as email,'classified_price' as classified_price,'url' as url,'dArticle' as module from Article WHERE id IN (".$this->where['article'].")";
						if (($this->where["promotion"]))
							$sql .=" UNION ";

					}
					if ($this->where["promotion"]){
						if (($this->where["event"]) || ($this->where["listing"]) || ($this->where["classified"]) || ($this->where["article"]))
							$sql .= "select id,'title' as title,name as name,'friendly_url' as friendly_url,thumb_id,'level' as level,account_id,'address' as address,'address2' as address2,'listingtemplate_id' as listingtemplate_id,'claim_disable' as claim_disable,'video_snippet' as video_snippet,'phone' as phone,'zip_code' as zip_code,'map_zoom' as map_zoom, description$langIndex as description, 'fax' as fax,'display_url' as display_url,'url' as url,'email' as email,'attachment_file' as attachment_file,'attachment_caption' as attachment_caption,'long_description$langIndex' as long_description,'hours_work' as hours_work,'locations' as locations,description$langIndex as description,'publication_date' as publication_date,'author' as author,'author_url' as author_url, 'abstract$langIndex' as abstract,'summarydesc$langIndex' as summarydesc, 'phone' as phone, 'email' as email,'classified_price' as classified_price,'url' as url,'ePromotion' as module FROM Promotion WHERE id IN (".$this->where['promotion'].")";
						else
							$sql .= "id,'title' as title, name as name,'friendly_url' as friendly_url,thumb_id,'level' as level,account_id,'address' as address,'address2' as address2,'listingtemplate_id' as listingtemplate_id,'claim_disable' as claim_disable,'video_snippet' as video_snippet,'phone' as phone,'zip_code' as zip_code,'map_zoom' as map_zoom, description$langIndex as description, 'fax' as fax,'display_url' as display_url,'url' as url,'email' as email,'attachment_file' as attachment_file,'attachment_caption' as attachment_caption,'long_description$langIndex' as long_description,'hours_work' as hours_work,'locations' as locations,description$langIndex as description,'publication_date' as publication_date,'author' as author,'author_url' as author_url, 'abstract$langIndex' as abstract,'summarydesc$langIndex' as summarydesc, 'phone' as phone, 'email' as email,'classified_price' as classified_price,'url' as url,'ePromotion' as module FROM Promotion WHERE id IN (".$this->where['promotion'].")";
					}

				}
				/******************************************************************/

				if ($this->group_by) $sql .= " GROUP BY $this->group_by";

                if ($this->having) $sql .= " HAVING $this->having";
                                
				if ($this->order) $sql .= " ORDER BY module,level DESC,title";

				if ($this->limit) $sql .= " LIMIT $this->start,$this->limit";
				       
                /*
                * Using COUNT(0) to optimize DB
                */
				$countItems = 0;
				if ($this->where["article"]){
					$sql2 = "SELECT COUNT(0) as row_amount FROM Article WHERE id IN (".$this->where["article"].")";
					$r2 = $db->unbuffered_query($sql2);
					$row = mysql_fetch_assoc($r2);
					$countItems += $row["row_amount"];
				}

				if ($this->where["classified"]){
					$sql2 = "SELECT COUNT(0) as row_amount FROM Classified WHERE id IN (".$this->where["classified"].")";
					$r2 = $db->unbuffered_query($sql2);
					$row = mysql_fetch_assoc($r2);
					$countItems += $row["row_amount"];
				}

				if ($this->where["event"]){
					$sql2 = "SELECT COUNT(0) as row_amount FROM Event WHERE id IN (".$this->where["event"].")";
					$r2 = $db->unbuffered_query($sql2);
					$row = mysql_fetch_assoc($r2);
					$countItems += $row["row_amount"];
				}

				if ($this->where["listing"]){

					$sql2 = "SELECT COUNT(distinct(id)) as row_amount FROM Listing_Summary WHERE id IN (".$this->where["listing"].")";
					$r2 = $db->unbuffered_query($sql2);
					$row = mysql_fetch_assoc($r2);
					$countItems += $row["row_amount"];
				}

				if ($this->where["promotion"]){
					$sql2 = "SELECT COUNT(0) as row_amount FROM Promotion WHERE id IN (".$this->where["promotion"].")";
					$r2 = $db->unbuffered_query($sql2);
					$row = mysql_fetch_assoc($r2);
					$countItems += $row["row_amount"];
				}
				/*************************************/       

                if($return_type == "array"){
                    $r = $db->unbuffered_query($sql);    
                }else{
                    $r = $db->query($sql);    
                }
                
				$this->record_amount	= $countItems;
				$this->pages			= ceil($this->record_amount/$this->limit);
				$this->next_screen		= ($this->screen >= ceil($this->record_amount/$this->limit)) ? ceil($this->record_amount/$this->limit) : ($this->screen+1);
				$this->back_screen		= ($this->screen <= 1) ? 1 : ($this->screen-1);
				$this->page_jump		= $this->calculatePageJump();

				if ($return_type == "object") {

					while ($row = mysql_fetch_assoc($r)) {
						$row["module"] = string_substr($row["module"],1);
						$result[] = new $row["module"]($row["id"]);
					}
				} elseif ($return_type == "array") {
					while ($row = mysql_fetch_assoc($r)) $result[] = $row;
				}

				return $result;
				
			} else if ($this->table=="PackageModules") {

                /*
                * Check if alread have total
                */
				if($aux_total_items){
					$total_items = $aux_total_items;
				}else{
                    /*
                     * Check if Promotion to make distinct
                     */

                    $sql2 = "SELECT COUNT(DISTINCT P.`id`) as row_amount FROM $this->table AS P LEFT JOIN Domain AS D ON (P.`domain_id` = D.`id` OR P.`domain_id` = 0) ";

                    if ($this->join) $sql2 .= $this->join;

                    if ($this->where) $sql2 .= " WHERE $this->where";

                    $r2 = $db->query($sql2);
                    $row = mysql_fetch_assoc($r2);

                    $total_items = $row["row_amount"];

				}

				$this->record_amount	= $total_items;
				$this->pages			= ceil($this->record_amount/$this->limit);
				$this->next_screen		= ($this->screen >= ceil($this->record_amount/$this->limit)) ? ceil($this->record_amount/$this->limit) : ($this->screen+1);
				$this->back_screen		= ($this->screen <= 1) ? 1 : ($this->screen-1);
				$this->page_jump		= $this->calculatePageJump();

                            
				$sql = "SELECT DISTINCT P.`id`, P.`package_id`, P.`domain_id`, P.`parent_domain_id`, P.`module`, P.`module_name`, P.`module_id`, P.`date` FROM $this->table AS P LEFT JOIN Domain AS D ON (P.`domain_id` = D.`id` OR P.`domain_id` = 0)";

				if ($this->join) $sql .= $this->join;

				if ($this->where) $sql .= " WHERE $this->where";

				if ($this->group_by) $sql .= " GROUP BY $this->group_by";

                if ($this->having) $sql .= " HAVING $this->having";
                                
				if ($this->order) $sql .= " ORDER BY $this->order";

				if ($this->limit) $sql .= " LIMIT $this->start,$this->limit";

                if ($return_type == "array"){
                    $r = $db->unbuffered_query($sql);
                }else{
                    $r = $db->query($sql);
                }
				
				if ($return_type == "object") {

                    while ($row = mysql_fetch_assoc($r)) {

                        $class = (string_strpos($this->getString("table"),"_")!==false) ? str_replace("_", "", $this->getString("table")) : $this->getString("table");
                        $class = ($this->return_object) ? $this->return_object : $class;

                        $result[] = new $class($row["id"]);

                    }
				} elseif ($return_type == "array") {
                    while ($row = mysql_fetch_assoc($r)){
                        $result[] = $row;
                    }
				}

				return $result;

			} else {

				if ($this->letter) {
					if ($this->letter == "no") {
						$this->where .= (!$this->where) ? " $this->letter_field REGEXP '^[^a-zA-Z].*$'" : " AND $this->letter_field REGEXP '^[^a-zA-Z].*$'";
					} else {
						if ($this->table == "Account") {
							if (!$this->where) {
								$this->where .= " (($this->letter_field LIKE ".db_formatString($this->letter."%")." AND $this->letter_field NOT LIKE ".db_formatString("%::%").") OR $this->letter_field LIKE ".db_formatString("%::".$this->letter."%").")";
							} else {
								$this->where .= " AND (($this->letter_field LIKE ".db_formatString($this->letter."%")." AND $this->letter_field NOT LIKE ".db_formatString("%::%").") OR $this->letter_field LIKE ".db_formatString("%::".$this->letter."%").")";
							}
						} else {
							if (!$this->where) {
								$this->where .= " $this->letter_field LIKE ".db_formatString($this->letter."%")."";
							} else {

								if (!strcmp($this->letter_field,"title_1")) {
									$this->where .= " AND ($this->letter_field LIKE ".db_formatString($this->letter."%")." OR title_2 LIKE ".db_formatString($this->letter."%")." OR title_3 LIKE ".db_formatString($this->letter."%")." OR title_4 LIKE ".db_formatString($this->letter."%")." OR title_5 LIKE ".db_formatString($this->letter."%").")";
								}else
									$this->where .= " AND $this->letter_field LIKE ".db_formatString($this->letter."%")."";
							}
						}
					}
				}
                                
                /*
                * Check if alread have total
                */
				if($aux_total_items && (string_strpos($this->where, "fulltextsearch_keyword") === false) && (string_strpos($this->where, "fulltextsearch_where") === false) && (string_strpos($this->where, "location_") === false) && (string_strpos($this->where, "zip5") === false)) {
                    $total_items = $aux_total_items;
				}else{
                    /*
                     * Check if Promotion to make distinct
                     */
                    $aux_force_distinct = false;
                    if(string_strpos($this->return_columns,"Promotion.*") > 0){
                        $sql2 = "SELECT COUNT(distinct(Promotion.id)) as row_amount FROM $this->table";
                    }elseif(trim($this->table) == "Listing_Summary"){
                        $sql2 = "SELECT COUNT(".$this->table.".id) as row_amount FROM $this->table";
                    }else{
                        $sql2 = "SELECT COUNT(0) as row_amount FROM $this->table";
                    }

                    //$sql2 = "SELECT COUNT(0) as row_amount FROM $this->table";

                    if ($this->join) $sql2 .= $this->join;

                    if ($this->where) $sql2 .= " WHERE $this->where";

                    $r2 = $db->unbuffered_query($sql2);
                    $row = mysql_fetch_assoc($r2);

                    $total_items = $row["row_amount"];
				}
				$this->record_amount	= $total_items;
                if ($this->limit){
                    $this->pages			= ceil($this->record_amount/$this->limit);
                    $this->next_screen		= ($this->screen >= ceil($this->record_amount/$this->limit)) ? ceil($this->record_amount/$this->limit) : ($this->screen+1);
                    $this->back_screen		= ($this->screen <= 1) ? 1 : ($this->screen-1);
                    $this->page_jump		= $this->calculatePageJump();
                }
                          
				$sql = "SELECT $this->return_columns FROM $this->table";

				if ($this->join) $sql .= $this->join;

				if ($this->where) $sql .= " WHERE $this->where";
                                
				if ($this->group_by) $sql .= " GROUP BY $this->group_by";

                if ($this->having) $sql .= " HAVING $this->having";
                                
				if ($this->order) $sql .= " ORDER BY $this->order";

				if ($this->limit) $sql .= " LIMIT $this->start,$this->limit";
                

                if ($return_type == "object"){
                    $r = $db->query($sql);
                }else{
                    $r = $db->unbuffered_query($sql);
                }

                if ($return_type == "object") {

                    while ($row = mysql_fetch_assoc($r)) {

                        $class = (string_strpos($this->getString("table"),"_")!==false) ? str_replace("_", "", $this->getString("table")) : $this->getString("table");
                        $class = ($this->return_object) ? $this->return_object : $class;

                        $result[] = new $class($row["id"]);

                    }
				} elseif ($return_type == "array") {
                    while ($row = mysql_fetch_assoc($r)){
                        $result[] = $row;
                    }
				}

				return $result;
			}

		}
		
		function calculatePageJump() {
			$amount = $this->record_amount;
			$exponent = 0;
			while ($amount > 1000){
				$amount /= 10;
				$exponent++;
			}
			return pow(10, $exponent);
		}

		
		/**
		*	Function to retrieve pages
		* 	@desc Function to retrieve pages
		*	@author Rodrigo Apetito	- Arca Solutions
		* 	@param numeric ID of package_credit_item
		* 	@filesource /classes/class_pageBrowsing.php
		* 	@since July, 06, 2009
		*	@return array with pages
		*/
		function getPagination($page_num, $limit, $aux_page_url = false, $force_total = false, $hashid = false){

			$pagesObj = new Pagination();
			
			if ($hashid)
				$pagesObj->hashid = $hashid;

			$total_rows = $this->record_amount;
			$array_pages["pages"] = $pagesObj->calculate_pages($total_rows, $limit, $page_num);
			$array_pages["total"] = $this->record_amount;

			if(ceil($this->record_amount / $limit) > 1){
				$array_pages["show_pages"] = true;
			}else{
				$array_pages["show_pages"] = false;
			}

			$aux_pagination_code = $pagesObj->getCodeOfPagination($array_pages, $aux_page_url, false, $force_total);

			return $aux_pagination_code;

		}
		
		function getPagesDropDown ($getData, $pagingUrl, $screen = 1, $defaultText = "Go to page: ", $defaultOnChange = "this.form.submit();", $id = "", $array_params = false) {

			$url_base = $_SERVER["PHP_SELF"];

			$use_friendly_url = true;

			$method = "get";

			if (string_strpos($url_base, "sitemgr") !== false || string_strpos($url_base, "members") !== false || $_GET["advsearch"] || !$_GET["url_full"]){
				$use_friendly_url = false;
			}

			if (MODREWRITE_FEATURE == "on" && $use_friendly_url){
				for($i=0; $i < count($array_params); $i++ ){
					if ($array_params[$i]){
						if ($array_params[$i] != "screen" && $array_params[$i] != "letter" && $array_params[$i] != "orderby"){
							$array_search_params[] = "/".urlencode($array_params[$i]);
						} else {
							if ($array_params[$i] != "screen"){
								$array_search_params[] = "/".$array_params[$i]."/".$array_params[$i+1];
								$i++;
							} else {
								$i++;
							}
						}
					}
				}
				if (is_array($array_search_params)){
					$url_search_params = implode("/", $array_search_params);
					$url_search_params = str_replace("//", "/", $url_search_params);
				} else {
					$url_search_params = "";
				}

				$id = ($id ? $id : "dropDownSearch");
				$method = "post";
				$defaultOnChange = "changePageScreen(\"".$pagingUrl."\", \"".$id."\",this.value, \"".$url_search_params."\")";
			}
			if (string_strpos($pagingUrl, "/".SOCIALNETWORK_FEATURE_NAME) !== false || string_strpos($pagingUrl, "members/account") !== false) {
				$profile = true;

				$defaultOnChange = "changePageProfile(\"".$pagingUrl."\", this.value, \"".MODREWRITE_FEATURE."\")";
			}

			if (!is_numeric($screen) || ($screen <= 0)) $screen = 1;
			if (!$screen) $screen = 1;

			if (!$profile) {
				if ($id) $id = "id=\"".$id."\"";

				$pagesDropDown = "<form name=\"pages\" ".$id." method=\"".$method."\" action=\"$pagingUrl\" style=\"margin: 0;\">";
				foreach ($getData as $name => $value) {
					if ((is_string($name) || is_numeric($name)) && (is_string($value) || is_numeric($value))) {
						if (($name != "screen") && ($name != "acct_search_company") && ($name != "acct_search_username") && ($name != "url_full")) {
							$pagesDropDown .= "<input type=\"hidden\" name=\"".$name."\" value=\"".$value."\" />\n";
						}
					}
				}
			}
			
			$pagesDropDown .= $defaultText . "<select name=\"screen\" onchange=\"".$defaultOnChange."\">\n";
			$increment = ($this->page_jump <= 0) ? 1 : $this->page_jump;
			$increment2 = $this->page_jump;
			$i = 1;
			while ($i <= $this->pages) {
				if ($screen == $i) {
					$pagesDropDown .= "<option value=\"$i\" selected=\"selected\">".$i."</option>\n";
				} elseif (($screen != 1) && ($i > $screen) && (($i-$this->page_jump) < $screen)) {
					$pagesDropDown .= "<option value=\"$screen\" selected=\"selected\">".$screen."</option>\n";
					$pagesDropDown .= "<option value=\"$i\">".$i."</option>\n";
				} else {
					$pagesDropDown .= "<option value=\"$i\">".$i."</option>\n";
				}
				if ($i == 1) {
					if ($increment > 1) $i += $increment-1;
					else $i += $increment;
				} else {
					if (($i < $this->pages) && (($i+$increment2) > $this->pages)) {
						$i += ($this->pages)-$i;
					} else {
						$i += $increment2;
					}
				}
			}
			$pagesDropDown .= "</select>\n";
			if (!$profile) $pagesDropDown .= "</form>\n";
			return $pagesDropDown;

		}

		function getPagesButtons ($getData, $feature, $screen = 1, $search_limit, $total_records, $defaultOnChange = "this.form.submit();") {

			if (!is_numeric($screen) || $screen <= 0) $screen = 1;
			if (!$screen) $screen = 1;
						
			$url="keywords=".$getData["keywords"]."&search_limit=".$search_limit;			

			if ($feature == "listing") {
				
				$dir_viewAll_redirect = "listing";
				$field_viewAll = "title";			
			} elseif ($feature == "banner") {
				
				$dir_viewAll_redirect = "banner";
				$field_viewAll = "caption";
			} elseif ($feature == "event") {
				
				$dir_viewAll_redirect = "event";
				$field_viewAll = "title";
			} elseif ($feature == "classified") {
				
				$dir_viewAll_redirect = "classified";
				$field_viewAll = "title";
			} elseif ($feature == "article") {
				
				$dir_viewAll_redirect = "article";
				$field_viewAll = "title";
			} elseif ($feature == "gallery") {
				
				$dir_viewAll_redirect = "gallery";
				$field_viewAll = "title";
			} elseif ($feature == "promotion") {

				$dir_viewAll_redirect = "promotion";
				$field_viewAll = "name";
			} elseif ($feature == "blog") {

				$dir_viewAll_redirect = "blog";
				$field_viewAll = "title";
			} elseif ($feature == "account") {
				
				$dir_viewAll_redirect = "account";
				$field_viewAll = "username";
			} elseif ($feature == "smaccount") {
				
				$dir_viewAll_redirect = "smaccount";
				$field_viewAll = "username";
			} elseif ($feature == "transaction") {
				
				$dir_viewAll_redirect = "transactions";
				$field_viewAll = "id";
			} elseif ($feature == "invoice") {
				
				$dir_viewAll_redirect = "invoices";
				$field_viewAll = "id";
			} elseif ($feature == "custominvoice") {
				
				$dir_viewAll_redirect = "custominvoices";
				$field_viewAll = "title";
			}

			$msg = system_showText(LANG_WAITLOADING);

            $viewAllUrl = "".DEFAULT_URL;
            if ($feature == "blog")
                $viewAllUrl .= "/".BLOG_FEATURE_FOLDER;
			$viewAllUrl .= "/sitemgr/".$dir_viewAll_redirect."/search.php?search_".$field_viewAll."=".($getData["keywords"]==string_ucwords(system_showText(LANG_SITEMGR_LABEL_KEYWORDS))?"":$getData["keywords"])."&screen=1&search_submit=Search";

			$return = "<table class=\"pagingContent pagingContentPagination\"><tr>";			
			
			if ($screen > 1) {
				$return .= '<td><a class="pagingContentPaginationPrev" href="javascript:void(0)" onclick="pageResults(\''.$url.'\', \''.$feature.'\', \''.$msg.'\', \'prev\' )"><span>Previous</span></a></td>';
			}

			$pagesDropDown = "<form name=\"pages\" method=\"get\" action=\"$pagingUrl\" style=\"margin: 0;\">";
			$pagesDropDown .= $defaultText . "<select name=\"screen\" onchange=\"pageResults('".$url."', '".$feature."', '".$msg."', this.value)\">";
			$increment = ($this->page_jump <= 0) ? 1 : $this->page_jump;
			$increment2 = $this->page_jump;
			$i = 1;
			while ($i <= $this->pages) {
				if ($screen == $i) {
					$pagesDropDown .= "<option value=\"$i\" selected=\"selected\">".$i."</option>\n";
				} elseif (($screen != 1) && ($i > $screen) && (($i-$this->page_jump) < $screen)) {
					$pagesDropDown .= "<option value=\"$screen\" selected=\"selected\">".$screen."</option>\n";
					$pagesDropDown .= "<option value=\"$i\">".$i."</option>\n";
				} else {
					$pagesDropDown .= "<option value=\"$i\">".$i."</option>\n";
				}
				if ($i == 1) {
					if ($increment > 1) $i += $increment-1;
					else $i += $increment;
				} else {
					if (($i < $this->pages) && (($i+$increment2) > $this->pages)) {
						$i += ($this->pages)-$i;
					} else {
						$i += $increment2;
					}
				}
			}
			$pagesDropDown .= "</select>";
			$pagesDropDown .= "</form>";			
			

			if ($total_records > 10) $return .= '<td><a class="pagingContentPaginationSeeAll" href="'.$viewAllUrl.'">'.system_showText(LANG_SITEMGR_SEEALL).'</a></td>';


			if ($total_records > 10) $return .= '<td><div><span>' .system_showText(LANG_SITEMGR_PAGING_GOTOPAGE).'</span> '.$pagesDropDown.'</div></td>';
			
			if (($screen * $search_limit) < $total_records)
				$return .=  '<td><a class="pagingContentPaginationNext" href="javascript:void(0)" onclick="pageResults(\''.$url.'\', \''.$feature.'\', \''.$msg.'\', \'next\')"><span>Next</span></a></td>';

			$return .='</tr></table>';

			return $return;
		}

		function getPagesButtonsDeal ($feature, $screen = 1, $search_limit, $total_records, $defaultOnChange = "this.form.submit();", $promotion_id) {

			if (!is_numeric($screen) || $screen <= 0) $screen = 1;
			if (!$screen) $screen = 1;

			$url="search_limit=".$search_limit;

			$msg = system_showText(LANG_WAITLOADING);

            $viewAllUrl = "".DEFAULT_URL;

			$viewAllUrl .= '/sitemgr/'.PROMOTION_FEATURE_FOLDER.'/view.php?screen=1&search_submit=Search';

			$return = '<table class="pagingContent pagingContentPagination"><tr>';

			if ($screen > 1) {
				$return .= '<td><a class="pagingContentPaginationPrev" href="javascript:void(0)" onclick="pageResults(\''.$url.'\', \''.$feature.'\', \''.$msg.'\', \'prev\' ,'.$promotion_id.')"></a></td>';
			}

			$pagesDropDown = "<form name=\"pages\" method=\"get\" action=\"$pagingUrl\" style=\"margin: 0;\">";
			$pagesDropDown .= $defaultText . "<select name=\"screen\" onchange=\"pageResults('".$url."', '".$feature."', '".$msg."', this.value, ".$promotion_id.")\">";
			$increment = ($this->page_jump <= 0) ? 1 : $this->page_jump;
			$increment2 = $this->page_jump;
			$i = 1;
			while ($i <= $this->pages) {
				if ($screen == $i) {
					$pagesDropDown .= "<option value=\"$i\" selected=\"selected\">".$i."</option>\n";
				} elseif (($screen != 1) && ($i > $screen) && (($i-$this->page_jump) < $screen)) {
					$pagesDropDown .= "<option value=\"$screen\" selected=\"selected\">".$screen."</option>\n";
					$pagesDropDown .= "<option value=\"$i\">".$i."</option>\n";
				} else {
					$pagesDropDown .= "<option value=\"$i\">".$i."</option>\n";
				}
				if ($i == 1) {
					if ($increment > 1) $i += $increment-1;
					else $i += $increment;
				} else {
					if (($i < $this->pages) && (($i+$increment2) > $this->pages)) {
						$i += ($this->pages)-$i;
					} else {
						$i += $increment2;
					}
				}
			}
			$pagesDropDown .= "</select>";
			$pagesDropDown .= "</form>";


			//if ($total_records > RESULTS_PER_PAGE) $return .= '<td><a class="pagingContentPaginationSeeAll" href="'.$viewAllUrl.'">'.system_showText(LANG_SITEMGR_SEEALL).'</a></td>';


			if ($total_records > RESULTS_PER_PAGE) $return .= '<td><div><span>' .system_showText(LANG_PAGING_GOTOPAGE).':</span> '.$pagesDropDown.'</div></td>';

			if (($screen * $search_limit) < $total_records)
				$return .=  '<td><a class="pagingContentPaginationNext" href="javascript:void(0)" onclick="pageResults(\''.$url.'\', \''.$feature.'\', \''.$msg.'\', \'next\', '.$promotion_id.')"></a></td>';

			$return .='</tr></table>';

			return $return;
		}

  }

?>
