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
	# * FILE: /blog/mod_rewrite.php
	# ----------------------------------------------------------------------------------------------------

	$failure = false;
	$dbObj = db_getDBObject();

	$langIndex = language_getIndex(EDIR_LANGUAGE);

	$browsebycategory = false;
	$browsebyitem = false;
	$browsebydate = false;
	
	if ($_GET["url_full"])
		$_GET["url_full"] = urldecode(str_replace(EDIRECTORY_FOLDER.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/".BLOG_FEATURE_FOLDER."/results.php?url_full=","",$_SERVER["REQUEST_URI"]));

	if ($_GET["url_full"] && (string_strpos($_GET["url_full"], "search") !== false || string_strpos($_GET["url_full"], "guide") !== false || string_strpos($_GET["url_full"], "archives") !== false)) {

		$url = string_replace_once(EDIRECTORY_FOLDER.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/".BLOG_FEATURE_FOLDER."/", "", $_GET["url_full"]);
		$parts = explode("/", $url);

		if (string_strpos($_GET["url_full"],"guide") !== false && $parts[1]!="guide"){
			$browsebycategory = true;

			for ($i=1; $i < count($parts); $i++){
				$_GET["category".$i] = $parts[$i];
			}

		} else if (string_strpos($_GET["url_full"],"archives") !== false  && $parts[1]!="archives"){
			$browsebydate = true;

			for ($i=1; $i < count($parts); $i++){
				$_GET["category".$i] = $parts[$i];
			}

		} else {
			if (!$parts[1]) {
				header("Location: ".BLOG_DEFAULT_URL."/search/empty");
				exit;
			}

			if ($parts[1] != "empty"){
				$_GET["keyword"] = $parts[1];
				$_GET["keyword"] = str_replace("|2F","/", $_GET["keyword"]);
				$_GET["keyword"] = str_replace("|3F","\\", $_GET["keyword"]);
			} else {
				$_GET["keyword"] = "";
			}

			for ($i==2; $i<count($parts); $i++){
				switch($parts[$i]) {
					case 'page': $_GET["page"] = $parts[$i+1];
									break;
					case 'letter': $_GET["letter"] = $parts[$i+1];
									break;
					case 'orderby': $_GET["orderby"] = $parts[$i+1];
									break;
				}
			}
		}
	}
	if ($browsebycategory || $browsebydate){
		for ($i=1; $i < count($parts); $i++){
			$aux = $_GET["category".$i];
			if ($aux == "page"){
				$_GET["category".$i] = "";
				$_GET["page"] = $_GET["category".($i+1)];
				$_GET["category".($i+1)] = "";
				$i++;
			} else if ($aux == "letter"){
				$_GET["category".$i] = "";
				$_GET["letter"] = $_GET["category".($i+1)];
				$_GET["category".($i+1)] = "";
				$i++;
			} else if ($aux == "orderby"){
				$_GET["category".$i] = "";
				$_GET["orderby"] = $_GET["category".($i+1)];
				$_GET["category".($i+1)] = "";
				$i++;
			} else if ($aux == "year"){
				$_GET["category".$i] = "";
				$_GET["archive_year"] = $_GET["category".($i+1)];
				$_GET["category".($i+1)] = "";
				$i++;
			} else if ($aux == "month"){
				$_GET["category".$i] = "";
				$_GET["archive_month"] = $_GET["category".($i+1)];
				$_GET["category".($i+1)] = "";
				$i++;
			}

		}
	}

	##################################################
	# CATEGORY
	##################################################
	if ($_GET["category1"]) {
		$sql = "SELECT * FROM BlogCategory WHERE category_id = ".db_formatNumber("0")." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND friendly_url".$langIndex." = ".db_formatString($_GET["category1"])." LIMIT 1";
		$result = $dbObj->query($sql);
		$aux = mysql_fetch_assoc($result);
		$_GET["category_id"] = $aux["id"];
		if (!$_GET["category_id"]) $failure = true;
	}
    
    if ($_GET["category2"] && $_GET["category_id"] && !$failure) {
        $sql = "SELECT * FROM BlogCategory WHERE category_id = ".db_formatNumber($_GET["category_id"])." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND friendly_url".$langIndex." = ".db_formatString($_GET["category2"])." LIMIT 1";
        $result = $dbObj->query($sql);
        $aux = mysql_fetch_assoc($result);
        $_GET["category_id"] = $aux["id"];
        if (!$_GET["category_id"]) $failure = true;
    } elseif ($_GET["category2"]) {
        $failure = true;
    }

    if ($_GET["category3"] && $_GET["category_id"] && !$failure) {
        $sql = "SELECT * FROM BlogCategory WHERE category_id = ".db_formatNumber($_GET["category_id"])." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND friendly_url".$langIndex." = ".db_formatString($_GET["category3"])." LIMIT 1";
        $result = $dbObj->query($sql);
        $aux = mysql_fetch_assoc($result);
        $_GET["category_id"] = $aux["id"];
        if (!$_GET["category_id"]) $failure = true;
    } elseif ($_GET["category3"]) {
        $failure = true;
    }

    if ($_GET["category4"] && $_GET["category_id"] && !$failure) {
        $browsebycategory = true;
        $sql = "SELECT * FROM BlogCategory WHERE category_id = ".db_formatNumber($_GET["category_id"])." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND friendly_url".$langIndex." = ".db_formatString($_GET["category4"])." LIMIT 1";
        $result = $dbObj->query($sql);
        $aux = mysql_fetch_assoc($result);
        $_GET["category_id"] = $aux["id"];
        if (!$_GET["category_id"]) $failure = true;
    } elseif ($_GET["category4"]) {
        $failure = true;
    }

    if ($_GET["category5"] && $_GET["category_id"] && !$failure) {
        $sql = "SELECT * FROM BlogCategory WHERE category_id = ".db_formatNumber($_GET["category_id"])." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND friendly_url".$langIndex." = ".db_formatString($_GET["category5"])." LIMIT 1";
        $result = $dbObj->query($sql);
        $aux = mysql_fetch_assoc($result);
        $_GET["category_id"] = $aux["id"];
        if (!$_GET["category_id"]) $failure = true;
    } elseif ($_GET["category5"]) {
        $failure = true;
    }

	##################################################

	##################################################
	# BLOG
	##################################################
	if ($_GET["blog"]) {
		$browsebyitem = true;
		$sql = "SELECT Post.id as id FROM Post WHERE Post.friendly_url = ".db_formatString($_GET["blog"])." LIMIT 1";
		$result = $dbObj->query($sql);
		$aux = mysql_fetch_assoc($result);
		$_GET["id"] = $aux["id"];
		if (!$_GET["id"]) $failure = true;
	}
	##################################################


	##################################################
	# UNSETTING MODREWRITE TERMS
	##################################################
	if ($failure) {
		header("Location: ".BLOG_DEFAULT_URL."/index.php");
		exit;
	} else {
		unset($failure);
		unset($dbObj);
		unset($sql);
		unset($result);
		unset($aux);
		unset($_GET["category1"]);
        unset($_GET["category2"]);
        unset($_GET["category3"]);
        unset($_GET["category4"]);
		unset($_GET["category5"]);
		unset($_GET["blog"]);
	}
	##################################################

?>
