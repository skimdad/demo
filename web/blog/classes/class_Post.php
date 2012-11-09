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
	# * FILE: /classes/class_Post.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$postObj = new Post($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name Post
	 * @method Post
	 * @method makeFromRow
	 * @method Save
	 * @method Delete
	 * @method updateImage
	 * @method setFullTextSearch
	 * @method setNumberViews
	 * @method getCategories
	 * @method getFullPath
	 * @method getTimeString
	 * @method getTimeStringUpdated
	 * @method SaveWPToEdir
	 * @method deleteWPPost
	 * @method TrashedWPPost
	 * @method UntrashedWPPost
	 * @method getFriendlyURL
	 * @access Public
	 */
	class Post extends Handle {

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
		 * @var varchar
		 * @access Private
		 */
		var $friendly_url;
		/**
		 * @var date
		 * @access Private
		 */
		var $publication_date;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $image_caption1;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $image_caption2;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $image_caption3;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $image_caption4;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $image_caption5;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $image_caption6;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $image_caption7;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $thumb_caption1;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $thumb_caption2;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $thumb_caption3;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $thumb_caption4;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $thumb_caption5;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $thumb_caption6;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $thumb_caption7;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $content1;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $content2;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $content3;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $content4;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $content5;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $content6;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $content7;
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
		 * @var char
		 * @access Private
		 */
		var $status;
		/**
		 * @var integer
		 * @access Private
		 */
		var $number_views;
		/**
		 * @var integer
		 * @access Private
		 */
		var $legacy_id;
		
		/**
		 * <code>
		 *		$postObj = new Post($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Post
		 * @access Public
		 * @param mixed $var
		 */
		function Post($var="") {
			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}

				unset($dbMain);
				$sql = "SELECT * FROM Post WHERE id = $var";
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
		function makeFromRow($row="") {

			$status = new ItemStatus();

			$this->id				= ($row["id"])					? $row["id"]				: ($this->id					? $this->id				: 0);
			$this->image_id			= ($row["image_id"])			? $row["image_id"]			: ($this->image_id				? $this->image_id		: 0);
			$this->thumb_id			= ($row["thumb_id"])			? $row["thumb_id"]			: ($this->thumb_id				? $this->thumb_id		: 0);
			$this->updated			= ($row["updated"])				? $row["updated"]			: ($this->updated				? $this->updated		: "");
			$this->entered			= ($row["entered"])				? $row["entered"]			: ($this->entered				? $this->entered		: "");
			$this->title			= ($row["title"])				? $row["title"]				: ($this->title					? $this->title			: "");
			$this->seo_title		= ($row["seo_title"])			? $row["seo_title"]			: ($this->seo_title				? $this->seo_title		: "");
			$this->friendly_url		= ($row["friendly_url"])		? $row["friendly_url"]		: "";
			$this->publication_date	= ($row["publication_date"])	? $row["publication_date"]	: 0;
			$this->image_caption1	= ($row["image_caption1"])		? $row["image_caption1"]	: ($this->image_caption1		? $this->image_caption1		: "");
			$this->image_caption2	= ($row["image_caption2"])		? $row["image_caption2"]	: ($this->image_caption2		? $this->image_caption2		: "");
			$this->image_caption3	= ($row["image_caption3"])		? $row["image_caption3"]	: ($this->image_caption3		? $this->image_caption3		: "");
			$this->image_caption4	= ($row["image_caption4"])		? $row["image_caption4"]	: ($this->image_caption4		? $this->image_caption4		: "");
			$this->image_caption5	= ($row["image_caption5"])		? $row["image_caption5"]	: ($this->image_caption5		? $this->image_caption5		: "");
			$this->image_caption6	= ($row["image_caption6"])		? $row["image_caption6"]	: ($this->image_caption6		? $this->image_caption6		: "");
			$this->image_caption7	= ($row["image_caption7"])		? $row["image_caption7"]	: ($this->image_caption7		? $this->image_caption7		: "");
			$this->thumb_caption1	= ($row["thumb_caption1"])		? $row["thumb_caption1"]	: ($this->thumb_caption1		? $this->thumb_caption1		: "");
			$this->thumb_caption2	= ($row["thumb_caption2"])		? $row["thumb_caption2"]	: ($this->thumb_caption2		? $this->thumb_caption2		: "");
			$this->thumb_caption3	= ($row["thumb_caption3"])		? $row["thumb_caption3"]	: ($this->thumb_caption3		? $this->thumb_caption3		: "");
			$this->thumb_caption4	= ($row["thumb_caption4"])		? $row["thumb_caption4"]	: ($this->thumb_caption4		? $this->thumb_caption4		: "");
			$this->thumb_caption5	= ($row["thumb_caption5"])		? $row["thumb_caption5"]	: ($this->thumb_caption5		? $this->thumb_caption5		: "");
			$this->thumb_caption6	= ($row["thumb_caption6"])		? $row["thumb_caption6"]	: ($this->thumb_caption6		? $this->thumb_caption6		: "");
			$this->thumb_caption7	= ($row["thumb_caption7"])		? $row["thumb_caption7"]	: ($this->thumb_caption7		? $this->thumb_caption7		: "");
			$this->content1			= ($row["content1"])			? $row["content1"]			: "";
			$this->content2			= ($row["content2"])			? $row["content2"]			: "";
			$this->content3			= ($row["content3"])			? $row["content3"]			: "";
			$this->content4			= ($row["content4"])			? $row["content4"]			: "";
			$this->content5			= ($row["content5"])			? $row["content5"]			: "";
			$this->content6			= ($row["content6"])			? $row["content6"]			: "";
			$this->content7			= ($row["content7"])			? $row["content7"]			: "";
			$this->keywords1		= ($row["keywords1"])			? $row["keywords1"]			: "";
			$this->keywords2		= ($row["keywords2"])			? $row["keywords2"]			: "";
			$this->keywords3		= ($row["keywords3"])			? $row["keywords3"]			: "";
			$this->keywords4		= ($row["keywords4"])			? $row["keywords4"]			: "";
			$this->keywords5		= ($row["keywords5"])			? $row["keywords5"]			: "";
			$this->keywords6		= ($row["keywords6"])			? $row["keywords6"]			: "";
			$this->keywords7		= ($row["keywords7"])			? $row["keywords7"]			: "";
			$this->seo_keywords1	= ($row["seo_keywords1"])		? $row["seo_keywords1"]		: ($this->seo_keywords1			? $this->seo_keywords1		: "");
			$this->seo_keywords2	= ($row["seo_keywords2"])		? $row["seo_keywords2"]		: ($this->seo_keywords2			? $this->seo_keywords2		: "");
			$this->seo_keywords3	= ($row["seo_keywords3"])		? $row["seo_keywords3"]		: ($this->seo_keywords3			? $this->seo_keywords3		: "");
			$this->seo_keywords4	= ($row["seo_keywords4"])		? $row["seo_keywords4"]		: ($this->seo_keywords4			? $this->seo_keywords4		: "");
			$this->seo_keywords5	= ($row["seo_keywords5"])		? $row["seo_keywords5"]		: ($this->seo_keywords5			? $this->seo_keywords5		: "");
			$this->seo_keywords6	= ($row["seo_keywords6"])		? $row["seo_keywords6"]		: ($this->seo_keywords6			? $this->seo_keywords6		: "");
			$this->seo_keywords7	= ($row["seo_keywords7"])		? $row["seo_keywords7"]		: ($this->seo_keywords7			? $this->seo_keywords7		: "");
			$this->status			= ($row["status"])				? $row["status"]			: "A";
			$this->number_views		= ($row["number_views"])		? $row["number_views"]		: ($this->number_views			? $this->number_views		: 0);
			$this->legacy_id		= ($row["legacy_id"])			? $row["legacy_id"]			: ($this->legacy_id				? $this->legacy_id			: "");
		
		}		

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$postObj->Save();
		 * <br /><br />
		 *		//Using this in Post() class.
		 *		$this->Save();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Save
		 * @access Public
		 */
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

				$sql = "UPDATE Post SET"
					. " image_id         = $this->image_id,"
					. " thumb_id         = $this->thumb_id,"
					. " updated          = NOW(),"
					. " title            = $this->title,"
					. " seo_title        = $this->seo_title,"
					. " friendly_url     = $this->friendly_url,"
					. " publication_date = $this->publication_date,"
					. " image_caption1	 = $this->image_caption1,"
					. " image_caption2   = $this->image_caption2,"
					. " image_caption3   = $this->image_caption3,"
					. " image_caption4   = $this->image_caption4,"
					. " image_caption5   = $this->image_caption5,"
					. " image_caption6   = $this->image_caption6,"
					. " image_caption7   = $this->image_caption7,"
					. " thumb_caption1   = $this->thumb_caption1,"
					. " thumb_caption2   = $this->thumb_caption2,"
					. " thumb_caption3   = $this->thumb_caption3,"
					. " thumb_caption4   = $this->thumb_caption4,"
					. " thumb_caption5   = $this->thumb_caption5,"
					. " thumb_caption6   = $this->thumb_caption6,"
					. " thumb_caption7   = $this->thumb_caption7,"
					. " content1         = $this->content1,"
					. " content2         = $this->content2,"
					. " content3         = $this->content3,"
					. " content4         = $this->content4,"
					. " content5         = $this->content5,"
					. " content6         = $this->content6,"
					. " content7         = $this->content7,"
					. " keywords1        = $this->keywords1,"
					. " keywords2        = $this->keywords2,"
					. " keywords3        = $this->keywords3,"
					. " keywords4        = $this->keywords4,"
					. " keywords5        = $this->keywords5,"
					. " keywords6        = $this->keywords6,"
					. " keywords7        = $this->keywords7,"
					. " seo_keywords1    = $this->seo_keywords1,"
					. " seo_keywords2    = $this->seo_keywords2,"
					. " seo_keywords3    = $this->seo_keywords3,"
					. " seo_keywords4    = $this->seo_keywords4,"
					. " seo_keywords5    = $this->seo_keywords5,"
					. " seo_keywords6    = $this->seo_keywords6,"
					. " seo_keywords7    = $this->seo_keywords7,"
					. " status           = $this->status,"
					. " number_views     = $this->number_views,"
					. " legacy_id		 = $this->legacy_id"
					. " WHERE id         = $this->id";

				$dbObj->query($sql);

			} else {

				$sql = "INSERT INTO Post"
					. " (image_id,"
					. " thumb_id,"
					. " updated,"
					. " entered,"
					. " title,"
					. " seo_title,"
					. " friendly_url,"
					. " publication_date,"
					. " image_caption1,"
					. " image_caption2,"
					. " image_caption3,"
					. " image_caption4,"
					. " image_caption5,"
					. " image_caption6,"
					. " image_caption7,"
					. " thumb_caption1,"
					. " thumb_caption2,"
					. " thumb_caption3,"
					. " thumb_caption4,"
					. " thumb_caption5,"
					. " thumb_caption6,"
					. " thumb_caption7,"
					. " content1,"
					. " content2,"
					. " content3,"
					. " content4,"
					. " content5,"
					. " content6,"
					. " content7,"
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
					. " status,"
					. " number_views,"
					. " legacy_id)"
					. " VALUES"
					. " ($this->image_id,"
					. " $this->thumb_id,"
					. " NOW(),"
					. " NOW(),"
					. " $this->title,"
					. " $this->title,"
					. " $this->friendly_url,"
					. " $this->publication_date,"
					. " $this->image_caption1,"
					. " $this->image_caption2,"
					. " $this->image_caption3,"
					. " $this->image_caption4,"
					. " $this->image_caption5,"
					. " $this->image_caption6,"
					. " $this->image_caption7,"
					. " $this->thumb_caption1,"
					. " $this->thumb_caption2,"
					. " $this->thumb_caption3,"
					. " $this->thumb_caption4,"
					. " $this->thumb_caption5,"
					. " $this->thumb_caption6,"
					. " $this->thumb_caption7,"
					. " $this->content1,"
					. " $this->content2,"
					. " $this->content3,"
					. " $this->content4,"
					. " $this->content5,"
					. " $this->content6,"
					. " $this->content7,"
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
					. " $this->status,"
					. " $this->number_views,"
					. " $this->legacy_id)";

				$dbObj->query($sql);

				$this->id = mysql_insert_id($dbObj->link_id);
				
				/*
				 * Legacy ID to Wordpress
				 */
				if($empty_legacy_id){
					unset($sql_legacy_id);
					$sql_legacy_id = "UPDATE Post SET legacy_id = 'ed_".$this->id."' WHERE id = ".$this->id;
					
					$dbObj->query($sql_legacy_id);
					
				}
			}

			$this->prepareToUse();
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$postObj->Delete();
		 * <br /><br />
		 *		//Using this in Post() class.
		 *		$this->Delete();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Delete
		 * @access Public
		 */
		function Delete() {

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
			
			### COMMENTS
			$sql = "SELECT id FROM Comments WHERE post_id= $this->id";
			$result = $dbObj->query($sql);
			while ($row = mysql_fetch_assoc($result)) {
				$commentObj = new Comments($row["id"]);
				$commentObj->Delete();
			}

			$sql = "SELECT blogcat_id from Post_Item WHERE post_id= $this->id";
			$result = $dbObj->query($sql);
			$categories='';
			while ($row = mysql_fetch_assoc($result)) {;
				$categories .= $row['blogcat_id'];
				$categories .=",";
			}

			$categories = string_substr($categories,0,-1);

            if ($categories){
                $active_post = 1;
                $sql = "UPDATE BlogCategory SET active_post = (active_post - ".$active_post.") WHERE id in (".$categories.")";
                $dbObj->query($sql);
            }

			
			$sql = "DELETE FROM Post_Item WHERE post_id = $this->id";
			$dbObj->query($sql);


			### IMAGE
			if ($this->image_id) {
				$image = new Image($this->image_id);
				if ($image) $image->Delete();
			}
			if ($this->thumb_id) {
				$image = new Image($this->thumb_id);
				if ($image) $image->Delete();
			}

			### POST
			$sql = "DELETE FROM Post WHERE id = $this->id";
			$dbObj->query($sql);

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$postObj->updateImage($imageArray);
		 * <br /><br />
		 *		//Using this in Post() class.
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
		 *		$postObj->setFullTextSearch();
		 * <br /><br />
		 *		//Using this in Post() class.
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

            }

			$categories = $this->getCategories($this->id);
			if ($categories) {
				foreach ($categories as $category) {
					unset($parents);
					$category_id = $category->getNumber("id");
					while ($category_id != 0) {
						$sql = "SELECT * FROM BlogCategory WHERE id = $category_id";
						$result = $dbObj->query($sql);
						if (mysql_num_rows($result) > 0) {
							$category_info = mysql_fetch_assoc($result);
							$langs = explode(",", $category_info["lang"]);
                            if (is_array($langs) && $langs[0]){
                                $langObj = new Lang();
                                foreach($langs as $lang){
                                    if ($lang){
                                        $lang_id = $langObj->returnLangId($lang); 

                                        if ($category_info["title".$lang_id]) {
                                            $fulltextsearch_keyword[] = $category_info["title".$lang_id];
                                        }

                                        if ($category_info["keywords".$lang_id]) {
                                            $fulltextsearch_keyword[] = $category_info["keywords".$lang_id];
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
				$sql = "UPDATE Post SET fulltextsearch_keyword = $fulltextsearch_keyword_sql WHERE id = $this->id";
				$result = $dbObj->query($sql);
			}
			if (is_array($fulltextsearch_where)) {
				$fulltextsearch_where_sql = db_formatString(implode(" ", $fulltextsearch_where));
				$sql = "UPDATE Post SET fulltextsearch_where = $fulltextsearch_where_sql WHERE id = $this->id";
				$result = $dbObj->query($sql);
			}

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$postObj->setNumberViews($id);
		 * <br /><br />
		 *		//Using this in Post() class.
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
			$sql = "UPDATE Post SET number_views = ".$this->number_views." + 1 WHERE Post.id = ".$id;
			$dbObj->query($sql);

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$postObj->getCategories($id);
		 * <br /><br />
		 *		//Using this in Post() class.
		 *		$this->getCategories($id);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getCategories
		 * @access Public
		 * @param integer $id
		 * @return array $categories
		 */
		function getCategories($id) {
			$langIndex = language_getIndex(EDIR_LANGUAGE);
			if ($id) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$dbObj = db_getDBObject();
				}

				unset($dbMain);
				$sql = "SELECT blogcat_id FROM Post_Item,BlogCategory WHERE Post_Item.post_id = $id AND Post_Item.blogcat_id = BlogCategory.id ORDER BY BlogCategory.title$langIndex";
				$r = $dbObj->query($sql);
				while ($row = mysql_fetch_array($r)) {
					if ($row["blogcat_id"]) $categories[] = new BlogCategory($row["blogcat_id"]);
				}
				return $categories;
			}
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$postObj->getFullPath();
		 * <br /><br />
		 *		//Using this in Post() class.
		 *		$this->getFullPath();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getFullPath
		 * @access Public
		 * @return array $path
		 */
		function getFullPath() {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
			$category_id = $this->id;
			$i=0;
			while ($category_id != 0) {
				$sql = "SELECT * FROM BlogCategory WHERE id = $category_id";
				$result = $dbObj->query($sql);
				$row = mysql_fetch_assoc($result);
				$path[$i]["id"] = $row["id"];
				$path[$i]["dad"] = $row["category_id"];
				$path[$i]["lang"] = $row["lang"];
				$path[$i]["title1"] = $row["title1"];
				$path[$i]["title2"] = $row["title2"];
				$path[$i]["title3"] = $row["title3"];
				$path[$i]["title4"] = $row["title4"];
				$path[$i]["title5"] = $row["title5"];
				$path[$i]["title6"] = $row["title6"];
				$path[$i]["title7"] = $row["title7"];
				$path[$i]["friendly_url1"] = $row["friendly_url1"];
				$path[$i]["friendly_url2"] = $row["friendly_url2"];
				$path[$i]["friendly_url3"] = $row["friendly_url3"];
				$path[$i]["friendly_url4"] = $row["friendly_url4"];
				$path[$i]["friendly_url6"] = $row["friendly_url5"];
				$path[$i]["friendly_url5"] = $row["friendly_url6"];
				$path[$i]["friendly_url7"] = $row["friendly_url7"];
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

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$postObj->getTimeString();
		 * <br /><br />
		 *		//Using this in Post() class.
		 *		$this->getTimeString();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getTimeString
		 * @access Public
		 * @return varchar $str_time
		 */
		function getTimeString() {
			$str_time = "";

			$startTimeStr = explode(":", $this->getString("entered"));
			$startTimeStr[0] = string_substr($startTimeStr[0],-2);
			if (CLOCK_TYPE == '24') {
				$start_time_hour = $startTimeStr[0];
			} elseif (CLOCK_TYPE == '12') {
				if ($startTimeStr[0] > "12") {
					$start_time_hour = $startTimeStr[0] - 12;
					$start_time_am_pm = "pm";
				} elseif ($startTimeStr[0] == "12") {
					$start_time_hour = 12;
					$start_time_am_pm = "pm";
				} elseif ($startTimeStr[0] == "00") {
					$start_time_hour = 12;
					$start_time_am_pm = "am";
				} else {
					$start_time_hour = $startTimeStr[0];
					$start_time_am_pm = "am";
				}
			}
			if ($start_time_hour < 10) $start_time_hour = "0".($start_time_hour+0);
			$start_time_min = $startTimeStr[1];
			$str_time .= $start_time_hour.":".$start_time_min." ".$start_time_am_pm;

			return $str_time;
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$postObj->getTimeStringUpdated();
		 * <br /><br />
		 *		//Using this in Post() class.
		 *		$this->getTimeStringUpdated();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getTimeStringUpdated
		 * @access Public
		 * @return varchar $str_time
		 */
		function getTimeStringUpdated() {
			$str_time = "";

			$startTimeStr = explode(":", $this->getString("updated"));
			$startTimeStr[0] = string_substr($startTimeStr[0],-2);
			if (CLOCK_TYPE == '24') {
				$start_time_hour = $startTimeStr[0];
			} elseif (CLOCK_TYPE == '12') {
				if ($startTimeStr[0] > "12") {
					$start_time_hour = $startTimeStr[0] - 12;
					$start_time_am_pm = "pm";
				} elseif ($startTimeStr[0] == "12") {
					$start_time_hour = 12;
					$start_time_am_pm = "pm";
				} elseif ($startTimeStr[0] == "00") {
					$start_time_hour = 12;
					$start_time_am_pm = "am";
				} else {
					$start_time_hour = $startTimeStr[0];
					$start_time_am_pm = "am";
				}
			}
			if ($start_time_hour < 10) $start_time_hour = "0".($start_time_hour+0);
			$start_time_min = $startTimeStr[1];
			$str_time .= $start_time_hour.":".$start_time_min." ".$start_time_am_pm;

			return $str_time;
		}
		
		
		/*
		 * Function to save Wordpress Posts on eDirectory
		 */
		function SaveWPToEdir($wp_content){
			
			if(!is_array($wp_content)){
				$wp_content = unserialize($wp_content);
			}
			
			if(is_array($wp_content)){
				
				$langIndex = language_getIndex(EDIR_DEFAULT_LANGUAGE);
				
				/*
				 * Get Post ID using legacy ID
				 */
				$db = db_getDBObject();
				$sql = "SELECT * FROM Post WHERE legacy_id = '"."wp_".$wp_content["fields"]["ID"]."'";
				$result = $db->query($sql);
				if(mysql_num_rows($result)){
					$row = mysql_fetch_assoc($result);
					$this->makeFromRow($row);
				}
				
				$fields[0]["name"]		= "content".$langIndex;
				$fields[0]["content"]	= $wp_content["fields"]["post_content"];
				
				$fields[1]["name"]		= "title";
				$fields[1]["content"]	= $wp_content["fields"]["post_title"];
				
				$fields[2]["name"]		= "legacy_id";
				$fields[2]["content"]	= "wp_".$wp_content["fields"]["ID"];
				
				$fields[3]["name"]		= "publication_date";
				$fields[3]["content"]	= $wp_content["fields"]["post_date"];
				
				$blog_friendly_url = preg_replace("/[^".FRIENDLYURL_VALIDCHARS."]/", FRIENDLYURL_SEPARATOR, $wp_content["fields"]["post_title"]);
				$blog_friendly_url = string_strtolower(preg_replace("/[\\".FRIENDLYURL_SEPARATOR."]{2,}/", FRIENDLYURL_SEPARATOR, $blog_friendly_url));
				$fields[4]["name"]		= "friendly_url";
				$fields[4]["content"]	= $blog_friendly_url;
				
				$fields[5]["name"]		= "status";
				$fields[5]["content"]	= ($wp_content["fields"]["post_status"] == "publish" ? "A" : "S");
				
				for($i=0;$i<count($fields);$i++){
					$this->$fields[$i]["name"] = $fields[$i]["content"];
				}
				
				$this->Save();
				$this->setFullTextSearch();
				/*
				 * Save tags to post
				 */
				if(count($wp_content["fields"]["categories"])){
					
					unset($category_ids);
					for($i=0;$i<count($wp_content["fields"]["categories"]); $i++){
						$category_ids[] = "'wp_".$wp_content["fields"]["categories"][$i]."'";
					}
					
					unset($postItemObj);
					$postItemObj = new PostItem();
					$postItemObj->setWPCategories($category_ids, $this->id);
					
				}
				
				system_countActiveItemByCategory("post");
				
			}
		}
		
		function deleteWPPost($wp_fields){
			
			if($wp_fields["fields"]["id"]){
				
				$dbObj = db_getDBObject();
				$sql = "SELECT id FROM Post WHERE legacy_id = 'wp_".$wp_fields["fields"]["id"]."'";
				$result = $dbObj->query($sql);
				
				if(mysql_num_rows($result)){
					while($row = mysql_fetch_assoc($result)){
						$this->id = $row["id"];
						$this->Delete();
					}
				}
			}
		}
		
		function TrashedWPPost($wp_fields){
			
			if($wp_fields["fields"]["id"]){
				
				$dbObj = db_getDBObject();
				$sql = "UPDATE Post SET status = 'P' WHERE legacy_id = 'wp_".$wp_fields["fields"]["id"]."'";
				$result = $dbObj->query($sql);
				
				system_countActiveItemByCategory("post");
			}
		}
		
		function UntrashedWPPost($wp_fields){
			
			if($wp_fields["fields"]["id"]){
				
				$dbObj = db_getDBObject();
				$sql = "UPDATE Post SET status = 'A' WHERE legacy_id = 'wp_".$wp_fields["fields"]["id"]."'";
				$result = $dbObj->query($sql);
				
				system_countActiveItemByCategory("post");
			}
		}
		
		function getFriendlyURL($mobile = false){
        	if($mobile){
        		$aux_url = DEFAULT_URL."/mobile/".BLOG_FEATURE_FOLDER;
        	}else{
        		$aux_url = BLOG_DEFAULT_URL;
        	}
        
        
        	if(MODREWRITE_FEATURE == "on"){
	        	return $aux_url."/".$this->friendly_url.".html";
        	}else{
        		return $aux_url."/detail.php?id=".$this->id;
        	}
		}
	}

?>
