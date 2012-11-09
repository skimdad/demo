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
	# * FILE: blog/includes/code/blog.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	$language_numbers = explode(",", EDIR_LANGUAGENUMBERS);

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		##################################################
		### KEYWORDS
		##################################################
		foreach ($language_numbers as $i) {
			$labelsuffix = $i;
			unset($arr_keywords);
			unset($each_keyword);
			unset($aux_kw);
			unset($new_arr_keywords);
			unset($aux_keywords);
			$arr_keywords = explode("\n", ${"keywords".$labelsuffix});
			foreach ($arr_keywords as $each_keyword) {
				$aux_kw = trim($each_keyword);
				if (string_strlen($aux_kw) > 0) {
					$new_arr_keywords[] = $aux_kw;
				}
			}
			if ($new_arr_keywords) $aux_keywords = implode(" || ", $new_arr_keywords);
			$_POST["keywords".$labelsuffix] = $aux_keywords;
			$_POST["array_keywords".$labelsuffix] = $new_arr_keywords;
		}
		##################################################

		$_POST["title"] = trim($_POST["title"]);
		$_POST["title"] = preg_replace('/\s\s+/', ' ', $_POST["title"]);
		$_POST["friendly_url"] = str_replace(".htm", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = str_replace(".html", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = trim($_POST["friendly_url"]);
		$sqlFriendlyURL = "";
		$sqlFriendlyURL .= " SELECT friendly_url FROM Post WHERE friendly_url = ".db_formatString($_POST["friendly_url"])." ";
		if ($id) $sqlFriendlyURL .= " AND id != $id ";
		$sqlFriendlyURL .= " LIMIT 1 ";
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObjFriendlyURL = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		$resultFriendlyURL = $dbObjFriendlyURL->query($sqlFriendlyURL);
		if (mysql_num_rows($resultFriendlyURL) > 0) {
			if ($id) $_POST["friendly_url"] = $_POST["friendly_url"].FRIENDLYURL_SEPARATOR.$id;
			else $_POST["friendly_url"] = $_POST["friendly_url"].FRIENDLYURL_SEPARATOR.uniqid();
		}
        if (!$id && !$_POST["friendly_url"]) {
            $_POST["friendly_url"] = uniqid();
        }

		if (validate_formBlog("blog", $_POST, $message_blog)) {

			// removing linebreaks from seo_description
			if ( !$id ) {

                foreach ($language_numbers as $i) {
					$labelsuffix = $i;
                    ($_POST["seo_abstract".$labelsuffix] = str_replace("\n", " ", $_POST["seo_abstract".$labelsuffix]));
                }
            } 

			$post = new Post($id);

			if (!$post->getString("id") || $post->getString("id") == 0){

				system_addItemGallery($gallery_hash, "", $gallery, $image_id, $thumb_id, true);
				$message = 0;
				$post->makeFromRow($_POST);
				$post->setDate("publication_date", $publication_date);

			} else {
				
				system_addItemGallery($gallery_hash, "", $gallery, $image_id, $thumb_id, true);
				$message = 1;
				$_POST["status"] = $post->getString("status");
				$post->makeFromRow($_POST);
				$post->setDate("publication_date", $publication_date);
			}

			if ($image_id) {
				$post->setNumber("image_id",$image_id);
				if ($thumb_id)
					$post->setNumber("thumb_id",$thumb_id);
			}

			if ($remove_image) {
				$post->setNumber("image_id", 0);
				$post->setNumber("thumb_id", 0);
			}

			if (!$_POST["publication_date"]) {
				$_POST["publication_date"] = date(DEFAULT_DATE_FORMAT);
				$post->setDate("publication_date", $_POST["publication_date"]);
			}

			unset($levelObjTmp);
			unset($levelsTmp);

			$post->Save();

			// setting categories

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			$postItemObj = new PostItem();
			$postItemObj->setNumber("post_id", $post->getNumber("id"));
			$postItemObj->Delete();

			$array_categories = explode(",", $return_categories);

			for ($i = 0; $i < count($array_categories); $i++) {
				unset($postItemObj);
				$postItemObj = new PostItem();
				$postItemObj->setNumber("blogcat_id", $array_categories[$i]);
				$postItemObj->setNumber("post_id", $post->getNumber("id"));
				$postItemObj->Save();
			}

			$post->setFullTextSearch();

			$sql = "UPDATE BlogCategory SET active_post = 0";
			$dbObj->query($sql);

			$sql = "SELECT id FROM Post WHERE status = 'A'";
			$result = $dbObj->query($sql);
			$ids_up = "";
			while ($row = mysql_fetch_assoc($result)) {
				$ids_up .= $row["id"].",";
			}
			$ids_up = string_substr($ids_up,0,-1);

			$sql = "SELECT blogcat_id AS Cat_ID, COUNT(blogcat_id) AS total FROM Post_Item WHERE post_id in (".$ids_up.") GROUP BY blogcat_id";
			$result = $dbObj->query($sql);
			while ($row = mysql_fetch_assoc($result)) {
				$info[] = $row;
			}

			for ($i = 0; $i < count($info); $i++) {
				$sql = "UPDATE BlogCategory SET active_post = ".$info[$i]["total"]." WHERE id = ".$info[$i]["Cat_ID"];
				$dbObj->query($sql);
			}

			header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?process=".$process."&newest=".$newest."&message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : ""));
			exit;
		}

		// removing slashes added if required
		$_POST = format_magicQuotes($_POST);
		$_GET  = format_magicQuotes($_GET);

		extract($_POST);
		extract($_GET);

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];
	$gallery_hash = $_POST["gallery_hash"] ? $_POST["gallery_hash"] : "blog".($id ? "_$id" : "")."_".uniqid(rand(), true);

	if ($id) {

		$post = new Post($id);

		if ((sess_getAccountIdFromSession() != $post->getNumber("account_id")) && (!string_strpos($url_base, "/sitemgr"))) {
			
			header("Location: $url_redirect/index.php?message=".$message."&screen=$screen&letter=$letter");
			exit;
		}

		$post->extract();

		if (!$message_blog){
			$sess_id = $gallery_hash;
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			$sql = "DELETE FROM Gallery_Temp WHERE sess_id = '$sess_id'";
			$dbObj->query($sql);
		}
		
	} else {

		$post = new Post($id);
		$post->makeFromRow($_POST);

		if ($acctId) $account_id = $acctId; else $account_id = $account_id;

		if (!$message_blog){
			$sess_id = $gallery_hash;
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			$sql = "DELETE FROM Gallery_Temp WHERE sess_id = '$sess_id'";
			$dbObj->query($sql);
		}

	}

	extract($_POST);
	extract($_GET);

	// if no publication date, prefill the field within the current date
	if (!$publication_date) {
		$today = date('Y-m-d');
		$publication_date = format_date ($today);
	}

	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$categories = "";
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if ($return_categories) {
			$return_categories_array = explode(",", $return_categories);
			foreach ($return_categories_array as $each_category) {
				$categories[] = new BlogCategory($each_category);
			}
		}
	} else {
		if (!$categories) {
			if ($post) {
				$postItemObj = new PostItem();
				$categories = $postItemObj->getCategories($id);
			}
		}
	}
	if ($categories) {
		for ($i=0; $i<count($categories); $i++) {
			if ($categories[$i]->getString("title".$langIndex)) $arr_category[$i]["name"] = $categories[$i]->getString("title".$langIndex);
			elseif($categories[$i]->getString("title")) $arr_category[$i]["name"] = $categories[$i]->getString("title");
            else $arr_category[$i]["name"] = $categories[$i]->getString("title".EDIR_DEFAULT_LANGUAGENUMBER);
			$arr_category[$i]["value"] = $categories[$i]->getNumber("id");
			$arr_return_categories[] = $categories[$i]->getNumber("id");
		}
		if ($arr_return_categories) $return_categories = implode(",", $arr_return_categories);
		array_multisort($arr_category);
		$feedDropDown = "<select name='feed' id='feed' multiple size='5' style=\"width:500px\">";
		if ($arr_category) foreach ($arr_category as $each_category) {
			$feedDropDown .= "<option value='".$each_category["value"]."'>".$each_category["name"]."</option>";
			$feedAjaxCategory[] = $each_category["value"];
		}
		$feedDropDown .= "</select>";
	} else {
		if ($return_categories) {
			$return_categories_array = explode(",", $return_categories);
			if ($return_categories_array) {
				foreach ($return_categories_array as $each_category) {
					$categories[] = new BlogCategory($each_category);
				}
			}
		}
		$feedDropDown = "<select name='feed' id='feed' multiple size='5' style=\"width:500px\">";
		if ($categories) {
			foreach ($categories as $category) {
				if ($category->getString("title".$langIndex)) $name = $category->getString("title".$langIndex);
				else $name = $category->getString("title");
				$feedDropDown .= "<option value='".$category->getNumber("id")."'>$name</option>";
				$feedAjaxCategory[] = $category->getNumber("id");
			}
		}
		$feedDropDown .= "</select>";
	}

	##################################################
	### KEYWORDS
	##################################################
	foreach ($language_numbers as $i) {
		$labelsuffix = $i;
		unset($arr_keywords);
		if ($_POST["keywords".$labelsuffix]) {
			$arr_keywords = explode(" || ", $_POST["keywords".$labelsuffix]);
			${"keywords".$labelsuffix} = implode("\n", $arr_keywords);
		} elseif ($post->getString("keywords".$labelsuffix)) {
			$arr_keywords = explode(" || ", $post->getString("keywords".$labelsuffix));
			${"keywords".$labelsuffix} = implode("\n", $arr_keywords);
		}
	}
	##################################################

	$hasImage = false;
	$sess_id = $gallery_hash;
	$dbMain = db_getDBObject(DEFAULT_DB, true);
	$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
	$sql = "SELECT image_id FROM Gallery_Temp WHERE sess_id = '$sess_id'";
	$result = $dbObj->query($sql);

	if ($row = mysql_fetch_assoc($result)) {
		$hasImage = true;
	}
?>