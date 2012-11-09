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
	# * FILE: /blog/functions/blog_funct.php
	# ----------------------------------------------------------------------------------------------------

	function blog_generateBrowseByTag($cat_id, $blog_featuredcategory, $tagObj){
		unset($subCategs);
		$langIndex = language_getIndex(EDIR_LANGUAGE);
		$subCategs  = $tagObj->retrieveAllSubCatById($cat_id, EDIR_LANGUAGE, $blog_featuredcategory);

		if ($subCategs){

			for ($j=0; $j<count($subCategs); $j++) {

				if (MODREWRITE_FEATURE == "on") {
					$href = "".constant("BLOG_DEFAULT_URL")."/guide";
				} else {
					$href = "".constant("BLOG_DEFAULT_URL")."/results.php?category_id=";
				}

				if (MODREWRITE_FEATURE == "on" && $subCategs[$j]["category_id"]) {

					$auxParent = $subCategs[$j]["category_id"];

					$arrayParent = array();
					while ($auxParent != 0){
						$auxCat = new BlogCategory($auxParent);
						$arrayParent[] = $auxCat->getString("friendly_url".$langIndex);
						$auxParent = $auxCat->getNumber("category_id");
						unset($auxCat);
						$count++;
					}
					$auxhref = "";
					$subCategsAux = array_reverse($arrayParent);

					$auxhref = implode("/", $subCategsAux);

				}

				if (MODREWRITE_FEATURE == "on") {
					$href .= "/".($auxhref ? $auxhref."/" : "").$subCategs[$j]["friendly_url".$langIndex];
				} else {
					$href .= $subCategs[$j]["id"];
				}

				echo "<li class=\"level-".$subCategs[$j]["level"]."\"><a href=\"".$href."\" title = \"".string_htmlentities(ucfirst($subCategs[$j]["title".$langIndex]))."\">";

				echo (string_strlen($subCategs[$j]["title".$langIndex]) > 25 ? (string_htmlentities(string_substr($subCategs[$j]["title".$langIndex], 0, 22)."...")) : string_htmlentities($subCategs[$j]["title".$langIndex]));

				echo "</a>";

				if (SHOW_CATEGORY_COUNT == "on"){
					echo " <span>(".$subCategs[$j]["active_post"].")</span>";
				}

				echo "</li>";
				
				blog_generateBrowseByTag($subCategs[$j]["id"], $blog_featuredcategory, $tagObj);

			}
		}
	}

	function blog_getCategoriesPosts($id){
		
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		
		$category_father = 0;
		
		$ids = "";
		
		$sql = "SELECT id FROM BlogCategory WHERE category_id = $id";
		$resultParent = $db->query($sql);
		if(mysql_num_rows($resultParent)){
			$rowParent = mysql_fetch_assoc($resultParent);
			$auxParent = $rowParent["id"];
			while (mysql_num_rows($resultParent)){
				
				$sql = "SELECT post_id FROM Post_Item WHERE blogcat_id=".$auxParent;
				$r = $db->query($sql);
				while ($row = mysql_fetch_assoc($r)) {
					$ids .= $row["post_id"].",";
				}

				$sql = "SELECT id FROM BlogCategory WHERE category_id = $auxParent";
				$resultParent = $db->query($sql);
				if(mysql_num_rows($resultParent)){
					$rowParent = mysql_fetch_assoc($resultParent);
					$auxParent = $rowParent["category_id"];
				}
			}
		}

		return $ids;
		
	}

	function blog_generateTag($categories, $user=false) {


		unset($categoryInfo);
		$langIndex = language_getIndex(EDIR_LANGUAGE);

		for ($i = 0; $i < count($categories); $i++) {
			if (string_strpos($categories[$i]->getString("lang"), EDIR_LANGUAGE) !== false) {

				if (MODREWRITE_FEATURE == "on") {
					$href = "".constant("BLOG_DEFAULT_URL")."/guide";
				} else {
					$href = "".constant("BLOG_DEFAULT_URL")."/results.php?category_id=";
				}
				
				if (MODREWRITE_FEATURE == "on" && $categories[$i]->getNumber("category_id")) {
					
					$auxParent = $categories[$i]->getNumber("category_id");
					
					$arrayParent = array();
					while ($auxParent != 0){
						$auxCat = new BlogCategory($auxParent);
						$arrayParent[] = $auxCat->getString("friendly_url".$langIndex);
						$auxParent = $auxCat->getNumber("category_id");
						unset($auxCat);
						$count++;
					}
					$auxhref = "";
					$subCategsAux = array_reverse($arrayParent);

					$auxhref = implode("/", $subCategsAux);
					
				}

				if (MODREWRITE_FEATURE == "on") {
					$href .= "/".($auxhref ? $auxhref."/" : "").$categories[$i]->getString("friendly_url".$langIndex);
				} else {
					$href .= $categories[$i]->getNumber("id");
				}
				$style = "";
				if (!$user) {
					$href = "javascript:void(0);";
					$style = "style=\"cursor:default\"";
				}
				$categoryInfo .= "<a href=\"".$href."\" $style>".$categories[$i]->getString("title$langIndex")."</a>, ";

			}
		}

		$categoryInfo = string_substr($categoryInfo, 0, -2);


		return $categoryInfo;

	}

	function search_frontBlogSearch($search_for, $section) {

		$searchReturn["select_columns"] = false;
		$searchReturn["from_tables"] = false;
		$searchReturn["where_clause"] = false;
		$searchReturn["group_by"] = false;
		$searchReturn["order_by"] = false;

		$orderByConf =  array("characters",
							"lastupdate",
							"datecreated",
							"popular",
							"rating");

		if(in_array($_GET['orderby'], $orderByConf)) {
			$user_order_by = $_GET['orderby'];
		}

		if (($section == "blog") || ($section == "random") || ($section == "mobile")) {
			$searchReturn["select_columns"] = "Post.*";
		} elseif ($section == "count") {
			$searchReturn["select_columns"] = "COUNT(DISTINCT(Post.id))";
		} elseif ($section == "rss") {
			$searchReturn["select_columns"] = "Post.id";
		}

		$searchReturn["from_tables"] = "Post";

		if (isset($search_for["id"]) && is_numeric($search_for["id"])) {
			$where_clause[] = "Post.id = ".$search_for["id"]."";
		}

		$where_clause[] = "Post.status = 'A'";

		if ($search_for["category_id"]) {
			$sql = "SELECT post_id FROM Post_Item WHERE blogcat_id=".$search_for["category_id"];
			$db = db_getDBObject();
			$r = $db->query($sql);
			$ids ="";
			while ($row = mysql_fetch_assoc($r)) {
				$ids .= $row["post_id"].",";
			}

			$ids = string_substr($ids,0,-1);
			if ($ids)
				$where_clause[] = "Post.id in (".$ids.")";
			else
				$where_clause[] = "Post.id in (0)";
		}

		if ($search_for["archive_year"]){
			$where_clause[]="YEAR(entered) = ".$search_for["archive_year"];
		}

		if ($search_for["archive_month"]){
			$where_clause[]="MONTH(entered) = ".$search_for["archive_month"];
		}

		if (($search_for["keyword"]) && ($section != "mobile")) {
			$search_for["keyword"] = str_replace("\\", "", $search_for["keyword"]);
			$search_for_keyword_fields[] = "Post.fulltextsearch_keyword";
			$where_clause[] = search_getSQLFullTextSearch($search_for["keyword"], $search_for_keyword_fields, "keyword_score", $order_by_keyword_score, $search_for["match"], $order_by_keyword_score2, "keyword_score2");
		}

		if ($where_clause && (count($where_clause) > 0)) {
			$searchReturn["where_clause"] = implode(" AND ", $where_clause);
		}

		if ($user_order_by == "characters") {
			$searchReturn["order_by"] = "Post.title";
		} elseif ($user_order_by == "lastupdate") {
			$searchReturn["order_by"] = "Post.updated DESC, Post.title";
		} elseif ($user_order_by == "datecreated") {
			$searchReturn["order_by"] = "Post.publication_date DESC, Post.updated DESC, Post.entered DESC, Post.title, Post.id";
		} elseif ($user_order_by == "popular") {
			$searchReturn["order_by"] = "Post.number_views DESC, Post.title, Post.id";
		} elseif ($user_order_by == "rating") {
			$searchReturn["order_by"] = "Post.avg_review DESC, Post.title, Post.id";
		} elseif (($section == "blog") || ($section == "mobile") || ($section == "rss")) {
			$searchReturn["order_by"] = ($order_by_keyword_score2 ? "keyword_score DESC, " : "")."Post.publication_date DESC, Post.updated DESC, Post.entered DESC, Post.title, Post.id";
		} elseif ($section == "count") {
			$searchReturn["order_by"] = "Post.id";
		}

		if ($search_for["keyword"] && $order_by_keyword_score && ($section != "count") && ($section != "random")) {
            if ($order_by_keyword_score2){
                $searchReturn["select_columns"] .= ", ".$order_by_keyword_score.", ".$order_by_keyword_score2;
            } else {
                $searchReturn["select_columns"] .= ", ".$order_by_keyword_score;
            }
		}

		if (($search_for["keyword"] && $order_by_keyword_score) && ($section != "count") && ($section != "random") && ($user_order_by != LANG_PAGING_ORDERBYPAGE_CHARACTERS) && ($user_order_by != LANG_PAGING_ORDERBYPAGE_LASTUPDATE) && ($user_order_by != LANG_PAGING_ORDERBYPAGE_DATECREATED) && ($user_order_by != LANG_PAGING_ORDERBYPAGE_POPULAR) && ($user_order_by != LANG_PAGING_ORDERBYPAGE_RATING)) {
			if ($order_by_keyword_score) {
                if ($order_by_keyword_score2){
                    $searchReturn["order_by"] .= ", keyword_score2 DESC";
                } else {
                    $searchReturn["order_by"] .= ", keyword_score DESC";
                }
			}
		}
		return $searchReturn;

	}

	function report_newRecordPost($item_name, $item_id, $report_type) {

        $robotsObj = new RobotsFilter();
        if ($robotsObj->getAccess($_SERVER["REMOTE_ADDR"])) {
		    $dbObj = db_getDBObject();
		    $sql = "UPDATE Report_".string_ucwords($item_name)." SET report_amount = report_amount + 1 WHERE ".$item_name."_id = ".db_formatNumber($item_id)." AND report_type = ".db_formatNumber($report_type)." AND DATE_FORMAT(date, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d')";
			$dbObj->query($sql);
		    if (!mysql_affected_rows()) {
			    $sql = "INSERT INTO Report_".string_ucwords($item_name)." (".$item_name."_id, report_type, report_amount, date) VALUES (".db_formatNumber($item_id).", ".db_formatNumber($report_type).", 1, NOW())";
				$dbObj->query($sql);
		    }
        } else return false;
	}


	function blog_getContentbyCharacters($content, $nCharacters, $detail, &$more = false) {

		$total = string_strlen(strip_tags($content));

		if ($total > $nCharacters) {
			$newContent = string_substr(strip_tags($content), 0,$nCharacters)." ...";
			$more = true;
		} else {
			$newContent = strip_tags($content);
		}

		return $newContent;
	}

	function blog_getMonth($month) {

		$arrayMonth = explode(",", LANG_DATE_MONTHS);
		return $arrayMonth[$month-1];

	}

	function blog_retrivePostArchiveFeatured() {

		$dbObj = db_getDBObJect();
		$sql	= "SELECT YEAR( entered ) AS Blog_Year, MONTH( entered ) AS Blog_Month, COUNT( entered ) AS total";
		$sql	.= " FROM Post";
		$sql	.= " WHERE status='A' AND publication_date <= NOW( )";
		$sql	.= " GROUP BY MONTH( entered ), YEAR( entered )";
		$sql	.= " ORDER BY Blog_Year ASC , Blog_Month";
		$result = $dbObj->query($sql);
		unset($info);
		while ($row = mysql_fetch_assoc($result)) {
			$info[] = $row;

		}
		$str = "";
		
		if (count($info) > 0){
		
			$str .= "<ul class=\"list list-blog\">";

			for ($i = 0; $i < count($info); $i++) {
				if ($i != 0) {
					if ($info[$i]["Blog_Year"] != $info[$i-1]["Blog_Year"]) {

						/* Year Current */
						if (MODREWRITE_FEATURE == "on"){
							$str .= "<li class=\"year\"><a href=\"".BLOG_DEFAULT_URL."/archives/year/".$info[$i]["Blog_Year"]."\" title=\"".$info[$i]["Blog_Year"]."\">";
						} else {
							$str .= "<li class=\"year\"><a href=\"".BLOG_DEFAULT_URL."/results.php?archive_year=".$info[$i]["Blog_Year"]."\" title=\"".$info[$i]["Blog_Year"]."\">";
						}

						$str .= $info[$i]["Blog_Year"];
						$str .= "</a></li>";

						/* First Month */

						if (MODREWRITE_FEATURE == "on"){
							$str .= "<li><a href=\"".BLOG_DEFAULT_URL."/archives/year/".$info[$i]["Blog_Year"]."/month/".$info[$i]["Blog_Month"]."\" title=\"".ucfirst(blog_getMonth($info[$i]["Blog_Month"]))."\">";
						} else {
							$str .= "<li><a href=\"".BLOG_DEFAULT_URL."/results.php?archive_year=".$info[$i]["Blog_Year"]."&archive_month=".$info[$i]["Blog_Month"]."\" title=\"".ucfirst(blog_getMonth($info[$i]["Blog_Month"]))."\">";
						}

						$str .= ucfirst(blog_getMonth($info[$i]["Blog_Month"]));
						$str .= "</a><span> (".$info[$i]["total"].")</span></li>";

					} else {

						/* Months */

						if (MODREWRITE_FEATURE == "on"){
							$str .= "<li><a href=\"".BLOG_DEFAULT_URL."/archives/year/".$info[$i]["Blog_Year"]."/month/".$info[$i]["Blog_Month"]."\" title=\"".ucfirst(blog_getMonth($info[$i]["Blog_Month"]))."\">";
						} else {
							$str .= "<li><a href=\"".BLOG_DEFAULT_URL."/results.php?archive_year=".$info[$i]["Blog_Year"]."&archive_month=".$info[$i]["Blog_Month"]."\" title=\"".ucfirst(blog_getMonth($info[$i]["Blog_Month"]))."\">";
						}
						$str .= ucfirst(blog_getMonth($info[$i]["Blog_Month"]));
						$str .= "</a><span> (".$info[$i]["total"].")</span></li>";

					}

				} else {

					/* Year Old */

					if (MODREWRITE_FEATURE == "on"){
						$str .= "<li class=\"year\"><a href=\"".BLOG_DEFAULT_URL."/archives/year/".$info[$i]["Blog_Year"]."\" title=\"".$info[$i]["Blog_Year"]."\">";
					} else {
						$str .= "<li class=\"year\"><a href=\"".BLOG_DEFAULT_URL."/results.php?archive_year=".$info[$i]["Blog_Year"]."\" title=\"".$info[$i]["Blog_Year"]."\">";
					}

					$str .= $info[$i]["Blog_Year"];
					$str .= "</a></li>";

					/* Months Old */

					if (MODREWRITE_FEATURE == "on"){
						$str .= "<li><a href=\"".BLOG_DEFAULT_URL."/archives/year/".$info[$i]["Blog_Year"]."/month/".$info[$i]["Blog_Month"]."\" title=\"".ucfirst(blog_getMonth($info[$i]["Blog_Month"]))."\">";
					} else {
						$str .= "<li><a href=\"".BLOG_DEFAULT_URL."/results.php?archive_year=".$info[$i]["Blog_Year"]."&archive_month=".$info[$i]["Blog_Month"]."\" title=\"".ucfirst(blog_getMonth($info[$i]["Blog_Month"]))."\">";	
					}
					$str .= ucfirst(blog_getMonth($info[$i]["Blog_Month"]));
					$str .= "</a><span> (".$info[$i]["total"].")</span></li>";
				}
			}

			$str .= "</ul>";
		
		}
		
		return $str;
		
	}

	function blog_getReply($id) {

		$dbObjMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObjMain);
		$sql = "SELECT * FROM Comments WHERE reply_id=$id";

		$result = $dbObj->query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			$info[] = $row;
		}

		if (count($info)>0)
			return 1;
		else
			return 0;

	}

	function validate_formBlog($form, $array, &$error) {

		extract($array);
		$dbObjMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObjMain);

		if ($form == "blog") {

			if (!$title) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_TITLE_IS_REQUIRED);
			if (!${"content".EDIR_DEFAULT_LANGUAGENUMBER}) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_CONTENT_IS_REQUIRED);

			if ($friendly_url) {
				$sql = "SELECT friendly_url FROM Post WHERE friendly_url = ".db_formatString($friendly_url)."";
				if($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if(mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_FRIENDLY_URL_IN_USE);
				if(!preg_match(FRIENDLYURL_REGULAREXPRESSION, $friendly_url)) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_INVALID_CHARS);
			}

			$return_categories_array = explode(",", $return_categories);
			$return_categories_array = array_unique($return_categories_array);

			$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
			$language_numbers = explode(",", EDIR_LANGUAGENUMBERS);
			foreach ($language_numbers as $k=>$i) {
				$labelsuffix = $i;
				if (${"array_keywords".$labelsuffix}) {
					if (count(${"array_keywords".$labelsuffix}) > MAX_KEYWORDS) {
						$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1)." ".MAX_KEYWORDS." ".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2)." (".$array_edir_languagenames[$i].")";
					}
					$kwlarge = false;
					foreach (${"array_keywords".$labelsuffix} as $kw) {
						if (string_strlen($kw) > 50) {
							$kwlarge = true;
						}
					}
					if ($kwlarge) {
						$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PLEASE_INCLUDE_KEYWORDS)." (".$array_edir_languagenames[$k].")";
					}
				}
			}

		} else if ($form == "postsettings") {

			if (!$status) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_STATUSISREQUIRED)."";		
			
		} else if ($form == "blogcategory") {

			$array_edir_languages = explode(",", EDIR_LANGUAGES);
			$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
			$language_numbers = explode(",", EDIR_LANGUAGENUMBERS);
			foreach ($array_edir_languages as $key => $value) {
				if ($value == EDIR_DEFAULT_LANGUAGE) {
					$edir_default_languagename = $array_edir_languagenames[$key];
					break;
				}
			}

			if (!${"title".EDIR_DEFAULT_LANGUAGENUMBER}) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEISREQUIRED1)." (".$edir_default_languagename.") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEISREQUIRED2)."";
			if (!${"page_title".EDIR_DEFAULT_LANGUAGENUMBER}) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_PAGETITLEISREQUIRED1)." (".$edir_default_languagename.") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_PAGETITLEISREQUIRED2)."";
			if (!${"friendly_url".EDIR_DEFAULT_LANGUAGENUMBER}) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYTITLEISREQUIRED1)." (".$edir_default_languagename.") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYTITLEISREQUIRED2)."";

			if (${"title".EDIR_DEFAULT_LANGUAGENUMBER}) {
				$sql = "SELECT title".EDIR_DEFAULT_LANGUAGENUMBER." FROM BlogCategory WHERE title".EDIR_DEFAULT_LANGUAGENUMBER." = ".db_formatString(trim(${"title".EDIR_DEFAULT_LANGUAGENUMBER}))."";
				$sql .= ($category_id) ? " AND category_id = $category_id " : " AND category_id = 0 ";
				if ($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_TITLEALREADYINUSE);
			}

			if (${"page_title".EDIR_DEFAULT_LANGUAGENUMBER}) {
				$sql = "SELECT page_title".EDIR_DEFAULT_LANGUAGENUMBER." FROM BlogCategory WHERE page_title".EDIR_DEFAULT_LANGUAGENUMBER." = ".db_formatString(trim(${"page_title".EDIR_DEFAULT_LANGUAGENUMBER}))."";
				$sql .= ($category_id) ? " AND category_id = $category_id " : " AND category_id = 0 ";
				if ($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_PAGETITLEALREADYINUSE);
			}

			if (${"friendly_url".EDIR_DEFAULT_LANGUAGENUMBER}) {
				$sql = "SELECT friendly_url".EDIR_DEFAULT_LANGUAGENUMBER." FROM BlogCategory WHERE friendly_url".EDIR_DEFAULT_LANGUAGENUMBER." = ".db_formatString(trim(${"friendly_url".EDIR_DEFAULT_LANGUAGENUMBER}))."";
				$sql .= ($category_id) ? " AND category_id = $category_id " : " AND category_id = 0 ";
				if ($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_FRIENDLYURLPAGENAMEALREADYINUSE);
				if (!preg_match(FRIENDLYURL_REGULAREXPRESSION, trim(${"friendly_url".EDIR_DEFAULT_LANGUAGENUMBER}))) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_FRIENDLYURLCONTAININVALIDCHARS);
			}

			if ($lang) $array_lang = explode(",", $lang);
			$k = 0;
			foreach ($language_numbers as $i) {
				if ($array_lang) {
					if (in_array($array_edir_languages[$k], $array_lang)) {

						if (!${"title".$i}) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEISREQUIRED1)." (".$array_edir_languagenames[$k].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEISREQUIRED2)."";
						if (!${"page_title".$i}) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_PAGETITLEISREQUIRED1)." (".$array_edir_languagenames[$k].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_PAGETITLEISREQUIRED2)."";
						if (!${"friendly_url".$i}) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYTITLEISREQUIRED1)." (".$array_edir_languagenames[$k].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYTITLEISREQUIRED2)."";

						if (${"title".$i}) {
							$sql = "SELECT title".$i." FROM BlogCategory WHERE title".$i." = ".db_formatString(trim(${"title".$i}))."";
							$sql .= ($category_id) ? " AND category_id = $category_id " : " AND category_id = 0 ";
							if ($id) $sql .= " AND id != $id ";
							$sql .= " LIMIT 1";
							$rs = $dbObj->query($sql);
							if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEALREADYINUSE1)." (".$array_edir_languagenames[$k].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEALREADYINUSE2)."";
						}

						if (${"page_title".$i}) {
							$sql = "SELECT page_title".$i." FROM BlogCategory WHERE page_title".$i." = ".db_formatString(trim(${"page_title".$i}))."";
							$sql .= ($category_id) ? " AND category_id = $category_id " : " AND category_id = 0 ";
							if ($id) $sql .= " AND id != $id ";
							$sql .= " LIMIT 1";
							$rs = $dbObj->query($sql);
							if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_PAGETITLEALREADYINUSE1)." (".$array_edir_languagenames[$k].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_PAGETITLEALREADYINUSE2)."";
						}

						if (${"friendly_url".$i}) {
							$sql = "SELECT friendly_url".$i." FROM BlogCategory WHERE friendly_url".$i." = ".db_formatString(trim(${"friendly_url".$i}))."";
							$sql .= ($category_id) ? " AND category_id = $category_id " : " AND category_id = 0 ";
							if ($id) $sql .= " AND id != $id ";
							$sql .= " LIMIT 1";
							$rs = $dbObj->query($sql);
							if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYURLPAGENAMEALREADYINUSE1)." (".$array_edir_languagenames[$k].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYURLPAGENAMEALREADYINUSE2)."";
							if (!preg_match(FRIENDLYURL_REGULAREXPRESSION, trim(${"friendly_url".$i}))) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYURLCONTAININVALIDCHARS1)." (".$array_edir_languagenames[$k].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYURLCONTAININVALIDCHARS2)."";
						}
					}
				}
				$k++;
			}

		}

		$error = "";

		if ($email) {
			if (!validate_email($email)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_VALID_EMAIL_ADDRESS);
			}
		}

		if ($emails) {
			if (!validate_emails($emails)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_VALID_EMAIL_ADDRESS);
			}
		}

		if ($url) {
			if (!validate_url($url)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_VALID_URL);
			}
		}

		if ($description) {
			if (string_strlen($description) > 255) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PROVIDE_DESCRIPTION_WITH_255_CHARS);
		}

		if ($conditions) {
			if (string_strlen($conditions) > 255) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PROVIDE_CONDITIONS_WITH_255_CHARS);
		}

		if ($renewal_date) {
			if (!validate_date($renewal_date)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_VALID_RENEWAL_DATE);
			} elseif (!validate_pastDate($renewal_date)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_RENEWAL_DATE_IN_FUTURE);
			}
		}

		if ($expiration_date) {
			if (!validate_date($expiration_date)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_VALID_EXPIRATION_DATE);
			} elseif (!validate_pastDate($expiration_date)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_EXPIRATION_DATE_IN_FUTURE);
			}
		}

		if ($errors) {
			$error .= implode("<br />", $errors);
			return false;
		}

		return true;

	}

	function db_getFromDB_Blog($table, $by_key="", $by_value="", $number=1, $orderby="", $return="object", $domain_id = false, $fields = "*") {

		switch ($table) {
			case 'blogcategory'			: $obj = "BlogCategory";
			break;
			case 'post'					: $obj = "Post";
			break;
		}

		if ($domain_id){
			$dbMain = db_getDBObject(DEFAULT_DB,true);
			$db = db_getDBObjectByDomainID($domain_id,$dbMain);
		} else{
			/*
			 * Force connection with main DB
			 */
			$db = db_checkTableMainDomain($table);
		}
		$sql = "SELECT $fields FROM $obj ";
		if (string_strlen($by_key) && string_strlen($by_value)) {
			if ((count($by_key) == count($by_value)) && (count($by_key) > 1)) {
				for($i=0; $i<count($by_key); $i++) {
					$where[] .= "$by_key[$i] = $by_value[$i]";
				}
			} else {
				$where[] = "$by_key = $by_value";
			}
		}

		if ($where) $sWhere = implode(" AND ", $where);

		if ($sWhere) $sql .= "WHERE $sWhere ";

		if ($orderby) $sql .= "ORDER BY $orderby ";

		if (is_numeric($number)) $sql .= "LIMIT $number ";

		$r = $db->query($sql);

		if ($number == 1) {
			$row = mysql_fetch_array($r);
			if ($return == "array") $res = $row;
			else if ($return == "object") {
				if ($obj == "Gallery") $res = new $obj($row["id"]);
				else {
					$obj = str_replace("_", "", $obj);
					$res = new $obj($row);
				}
			}
		} else {
			$res = Array();
			while ($row = mysql_fetch_array($r)) {
				if ($return == "array") $res[] = $row;
				else if ($return == "object") {
					if ($obj == "Gallery") $res[] = new $obj($row["id"]);
					else {
						$obj = str_replace("_", "", str_replace("MM_", "", $obj));
						$res[] = new $obj($row);
					}
				}
			}
		}

		return $res;

	}

	function db_getFromDBBySQL_Blog($table, $sql, $return = "object", $forceDB = false, $domain_id = 0) {

		switch ($table) {
			case 'post'					: $obj = "Post";				break;
			default						: $obj = $table;				break;
		}

		$dbObjAux = db_getDBObject(DEFAULT_DB,true);

		if ($domain_id){
			$dbMain = db_getDBObject(DEFAULT_DB,true);
			$db = db_getDBObjectByDomainID($domain_id,$dbMain);
		} else{
			/*
			 * Force connection with main DB
			 */
			$db = db_checkTableMainDomain($table);
		}
		$r = $db->query($sql);

		$res = Array();

		if ($r) while ($row = mysql_fetch_array($r)) {
			if ($return == "array") $res[] = $row;
			else {
				if ($obj == "Gallery") $res[] = new $obj($row["id"]);
				else $res[] = new $obj($row);
			}
		}

		return $res;

	}

	function system_replaceEmailVariables_Blog($body, $id, $item="post") {

		switch ($item) {
			case 'post': $obj = new Post($id);
		}

		if (!isset($acc)) $acc = new Account($obj->getNumber('account_id'));
		$acc_cont = new Contact($acc->getNumber('id'));

		setting_get("sitemgr_email", $sitemgr_email);
		$sitemgr_emails = explode(",", $sitemgr_email);

		if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];

		$body = str_replace("ACCOUNT_NAME",$acc_cont->getString('first_name').' '.$acc_cont->getString('last_name'),$body);
		$body = str_replace("ACCOUNT_USERNAME",$acc->getString('username'),$body);
		$body = str_replace("ACCOUNT_PASSWORD",$acc->getString('username'),$body);

		switch ($item) {
			case 'post':
				if (MODREWRITE_FEATURE == "on") { $detailLink = "".BLOG_DEFAULT_URL."/".$obj->getString("friendly_url").".html"; } else { $detailLink = "".BLOG_DEFAULT_URL."/detail.php?id=".$obj->getNumber("id"); }
				$body = str_replace(array("ITEM_TITLE", "BLOG_TITLE"), $obj->getString('title'), $body);
			break;
		}

		if (isset($detailLink)) $body = str_replace("ITEM_URL", $detailLink, $body);

		$body = str_replace("ITEM_TYPE", $item, $body);

		$body = str_replace("EDIRECTORY_TITLE",EDIRECTORY_TITLE,$body);
		$body = str_replace("SITEMGR_EMAIL",$sitemgr_email,$body);
		$body = str_replace("DEFAULT_URL",DEFAULT_URL,$body);

		return $body;

	}

	function blog_retrieveIdRelatedPosts($array, $post_id) {

		if ($array) {
			$strIN = "";
			for ($i = 0; $i < count($array); $i++) {
				$strIN .= $array[$i].",";
			}
			$strIN = string_substr($strIN, 0, -1);

			$db = db_getDBObject();

			$sql = "SELECT post_id, COUNT( Post_Item.blogcat_id ) AS total"
				  ." FROM  Post_Item,Post"
				  ." WHERE Post_Item.post_id = Post.id AND Post.status = 'A' AND blogcat_id IN ( $strIN ) AND post_id <> $post_id"
				  ." GROUP BY post_id"
				  ." ORDER BY total DESC"
				  ." LIMIT 5";

			$result = $db->query($sql);

			while ($row = mysql_fetch_array($result)) {
				$ids[] = $row["post_id"];
			}

			return $ids;
		}
	}

	function blog_retrieveInfoRelatedPost($ids) {


		if ($ids) {
			$strIN = "";
			for ($i = 0; $i < count($ids); $i++) {
				$strIN .= $ids[$i].",";
			}
			$strIN = string_substr($strIN, 0, -1);

			$db = db_getDBObject();

			$sql = "SELECT id, title, entered, friendly_url, thumb_id"
				 ." FROM Post"
				 ." WHERE id IN ( $strIN )";

			$result = $db->query($sql);

			while ($row = mysql_fetch_assoc($result)) {
				$info[] = $row;

			}

			return $info;
		}


	}

	# ----------------------------------------------------------------------------------------------------
	# POST REPORTS
	# ----------------------------------------------------------------------------------------------------
    function retrievePostReport($idIn = 0) {
        $db = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
        $data = array();

        /* empty */
        $period = date('Y') . '-' . date('n');
        $data[$period]['summary'] = 0;
        $data[$period]['detail']  = 0;

        /* today */
        $sql = "SELECT CONCAT(YEAR(date) , '-', MONTH(date)) AS period, `report_type` , SUM(`report_amount`) AS amount FROM `Report_Post` WHERE `post_id` = " . db_formatNumber($idIn) . " GROUP BY period, `report_type`";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            if($row['report_type'] == 1) $data[$row['period']]['summary'] += $row['amount'];
            if($row['report_type'] == 2) $data[$row['period']]['detail']  += $row['amount'];
        }

        /* daily */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(summary_view) AS summary, SUM(detail_view) AS detail FROM Report_Post_Daily WHERE post_id = " . db_formatNumber($idIn) . " GROUP BY period";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['summary'] += $row['summary'];
            $data[$row['period']]['detail']  += $row['detail'];
        }

        /* monthly */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(summary_view) AS summary, SUM(detail_view) AS detail FROM Report_Post_Monthly WHERE post_id = " . db_formatNumber($idIn) . " GROUP BY period ORDER BY day DESC";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['summary'] = $row['summary'];
            $data[$row['period']]['detail']  = $row['detail'];
        }
        return $data;
    }

	function blog_retrieveNewMembers() {

		$dbObj = db_getDBObJect(DEFAULT_DB,true);
		$sql = "SELECT Contact.account_id, Profile.image_id, Contact.first_name, Contact.last_name, Profile.friendly_url, Account.entered"
			  ." FROM  Contact, Profile, Account"
			  ." WHERE Profile.account_id = Contact.account_id AND Profile.account_id = Account.id AND Account.has_profile='y'"
			  ." ORDER BY Contact.entered DESC "
			  ." LIMIT 5";

		$result = $dbObj->query($sql);
		while ($row = mysql_fetch_array($result)) {
			$newMembers["account_id"][] = $row["account_id"];
			$newMembers["image_id"][] = $row["image_id"];
			$newMembers["first_name"][] = $row["first_name"];
			$newMembers["last_name"][] = $row["last_name"];
			$newMembers["friendly_url"][] = $row["friendly_url"];
			$newMembers["entered"][] = $row["entered"];
		}
		return $newMembers;

	}

?>
