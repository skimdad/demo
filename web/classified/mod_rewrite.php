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
	# * FILE: /classified/mod_rewrite.php
	# ----------------------------------------------------------------------------------------------------

	$failure = false;
	$dbObj = db_getDBObject();

	$langIndex = language_getIndex(EDIR_LANGUAGE);

	$browsebylocation = false;
	$browsebycategory = false;
	$browsebyitem = false;

	if ($_GET["url_full"])
		$_GET["url_full"] = urldecode(str_replace(EDIRECTORY_FOLDER.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/".CLASSIFIED_FEATURE_FOLDER."/results.php?url_full=","",$_SERVER["REQUEST_URI"]));

	if ($_GET["url_full"] &&  (string_strpos($_GET["url_full"], "search") !== false || string_strpos($_GET["url_full"], "guide") !== false || string_strpos($_GET["url_full"], "location") !== false)) {
		
		$url = string_replace_once(EDIRECTORY_FOLDER.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/".CLASSIFIED_FEATURE_FOLDER."/", "", $_GET["url_full"]);
		$parts = explode("/", $url);

		if (string_strpos($_GET["url_full"],"guide") !== false ){
			$browsebycategory = true;
			
			for ($i=1; $i<count($parts); $i++){
					$_GET["category".$i] = $parts[$i];
			}
		} else if (string_strpos($_GET["url_full"],"location") !== false){
			$browsebylocation = true;
			
			for ($i=1; $i<count($parts); $i++){
					$_GET["friendLoc".$i] = $parts[$i];
			}
		} else {

			if (!$parts[1] && !$parts[3]) {
				header("Location: ".CLASSIFIED_DEFAULT_URL."/search/empty/where/empty");
				exit;
			}

			if ($parts[1] != "empty"){
				$_GET["keyword"] = $parts[1];
				$_GET["keyword"] = str_replace("|2F","/", $_GET["keyword"]);
				$_GET["keyword"] = str_replace("|3F","\\", $_GET["keyword"]);
			} else {
				$_GET["keyword"] = "";
			}

			if ($parts[3] != "empty"){
				$_GET["where"] = $parts[3];
				$_GET["where"] = str_replace("|2F","/", $_GET["where"]);
				$_GET["where"] = str_replace("|3F","\\", $_GET["where"]);
			} else {
				$_GET["where"] = "";
			}

			for ($i==2; $i < count($parts); $i++){
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
	if ($browsebycategory){
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
			}
		}
	} else if ($browsebylocation){
		for ($i=1; $i < count($parts); $i++){
			$aux = $_GET["friendLoc".$i];
			if ($aux == "page"){
				$_GET["friendLoc".$i] = "";
				$_GET["page"] = $_GET["friendLoc".($i+1)];
				$_GET["friendLoc".($i+1)] = "";
				$i++;
			} else if ($aux == "letter"){
				$_GET["friendLoc".$i] = "";
				$_GET["letter"] = $_GET["friendLoc".($i+1)];
				$_GET["friendLoc".($i+1)] = "";
				$i++;
			} else if ($aux == "orderby"){
				$_GET["friendLoc".$i] = "";
				$_GET["orderby"] = $_GET["friendLoc".($i+1)];
				$_GET["friendLoc".($i+1)] = "";
				$i++;
			}
		}

	}

	##################################################
	# LOCATION
	##################################################
	if ($_GET["friendLoc1"]) {
		unset($sqlLoc);

		$edir_loc = explode(",", EDIR_LOCATIONS);

		// Writing SQL Select Command Into Array
		foreach($edir_loc as $k=>$loc) {
			if ($_GET["friendLoc".($k+1)]) {
				$browsebylocation = true;

				// Writing Location Fields
				$sqlLoc["fields"][] = "L$loc.id l_$loc";

				if (($k + 1) == 1) {
					// Writing FROM Clause
					$sqlLoc["from"] = "Location_$loc L$loc";
				} else {
					// Writing INNER JOIN Clause
					$loc_id = $edir_loc[$k - 1];
					$sqlLoc["join"][] = "Location_$loc L$loc ON (L$loc.location_$loc_id = L$loc_id.id)";
				}

				// Writing WHERE Clause
				$friendlyUrlLoc = $_GET["friendLoc".($k+1)];
				$sqlLoc["where"][] = "L$loc.friendly_url = '$friendlyUrlLoc'";
			}
		}

		// Writing SQL Command in Text Format
		$sql_fields = implode(", ", $sqlLoc["fields"]);
		$sql_from = $sqlLoc["from"];
		if ($sqlLoc["join"]) {
			$sql_join = implode(" INNER JOIN ", $sqlLoc["join"]);
		}
		$sql_where = implode(" AND ", $sqlLoc["where"]);
		$sql = "SELECT $sql_fields
				FROM $sql_from";
		if ($sql_join) {
			$sql .= " INNER JOIN $sql_join";
		}
		$sql.= " WHERE $sql_where";
		/*
		 * Force connection with main DB
		 */
		$dbObj_main = db_getDBObject(DEFAULT_DB,true);
		$result = $dbObj_main->query($sql);

		if (mysql_num_rows($result) > 0) {
			$row = mysql_fetch_assoc($result);
			foreach($edir_loc as $k=>$loc) {
				if ($_GET["friendLoc".($k + 1)]) {
					$_GET["location_".$loc] = $row["l_$loc"];
					if (!$_GET["location_".$loc]) $failure = true;
					else $mod_rewrite_have_location = true;
				}
			}
		}
	} else {
		$mod_rewrite_have_location = false;
		for ($i = 1; $i <= 5; $i++) {
			if ($_GET["location_".$i]) {
				$mod_rewrite_have_location = true;
				break;
			}
		}
	}
	##################################################

	##################################################
	# CATEGORY
	##################################################
	if ($_GET["category1"]) {
		$sql = "SELECT * FROM ClassifiedCategory WHERE category_id = ".db_formatNumber("0")." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND friendly_url".$langIndex." = ".db_formatString($_GET["category1"])." AND enabled = 'y' LIMIT 1";
		$result = $dbObj->query($sql);
		$aux = mysql_fetch_assoc($result);
		$_GET["category_id"] = $aux["id"];
		if (!$_GET["category_id"]) $failure = true;
	}

	if ($_GET["category2"] && $_GET["category_id"] && !$failure) {
		$sql = "SELECT * FROM ClassifiedCategory WHERE category_id = ".db_formatNumber($_GET["category_id"])." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND friendly_url".$langIndex." = ".db_formatString($_GET["category2"])." AND enabled = 'y' LIMIT 1";
		$result = $dbObj->query($sql);
		$aux = mysql_fetch_assoc($result);
		$_GET["category_id"] = $aux["id"];
		if (!$_GET["category_id"]) $failure = true;
	} elseif ($_GET["category2"]) {
		$failure = true;
	}

    if ($_GET["category3"] && $_GET["category_id"] && !$failure) {
        $sql = "SELECT * FROM ClassifiedCategory WHERE category_id = ".db_formatNumber($_GET["category_id"])." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND friendly_url".$langIndex." = ".db_formatString($_GET["category3"])." AND enabled = 'y' LIMIT 1";
        $result = $dbObj->query($sql);
        $aux = mysql_fetch_assoc($result);
        $_GET["category_id"] = $aux["id"];
        if (!$_GET["category_id"]) $failure = true;
    } elseif ($_GET["category3"]) {
        $failure = true;
    }

    if ($_GET["category4"] && $_GET["category_id"] && !$failure) {
        $sql = "SELECT * FROM ClassifiedCategory WHERE category_id = ".db_formatNumber($_GET["category_id"])." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND friendly_url".$langIndex." = ".db_formatString($_GET["category4"])." AND enabled = 'y' LIMIT 1";
        $result = $dbObj->query($sql);
        $aux = mysql_fetch_assoc($result);
        $_GET["category_id"] = $aux["id"];
        if (!$_GET["category_id"]) $failure = true;
    } elseif ($_GET["category4"]) {
        $failure = true;
    }

    if ($_GET["category5"] && $_GET["category_id"] && !$failure) {
        $sql = "SELECT * FROM ClassifiedCategory WHERE category_id = ".db_formatNumber($_GET["category_id"])." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND friendly_url".$langIndex." = ".db_formatString($_GET["category5"])." AND enabled = 'y' LIMIT 1";
        $result = $dbObj->query($sql);
        $aux = mysql_fetch_assoc($result);
        $_GET["category_id"] = $aux["id"];
        if (!$_GET["category_id"]) $failure = true;
    } elseif ($_GET["category5"]) {
        $failure = true;
    }
	##################################################

	##################################################
	# CLASSIFIED
	##################################################
	if ($_GET["classified"]) {
		$browsebyitem = true;
		$sql = "SELECT Classified.id as id FROM Classified WHERE Classified.friendly_url = ".db_formatString($_GET["classified"])." LIMIT 1";
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
		header("Location: ".CLASSIFIED_DEFAULT_URL."/index.php");
		exit;
	} else {
		unset($failure);
		unset($dbObj);
		unset($sql);
		unset($result);
		unset($aux);
		unset($_GET["friendLoc1"]);
		unset($_GET["friendLoc2"]);
		unset($_GET["friendLoc3"]);
		unset($_GET["friendLoc4"]);
		unset($_GET["friendLoc5"]);
		unset($_GET["category1"]);
        unset($_GET["category2"]);
        unset($_GET["category3"]);
        unset($_GET["category4"]);
		unset($_GET["category5"]);
		unset($_GET["classified"]);
		
		/*
		 * Removing wrong spaces on url
		 */
		if(string_strpos($_GET["keyword"],",")){
			unset($aux_keywords,$array_keywords);
			$aux_keywords = explode(",",$_GET["keyword"]);
			for($i=0;$i<count($aux_keywords);$i++){
				$array_keywords[] = trim($aux_keywords[$i]);
			}
			$_GET["keyword"] = implode("",$array_keywords);
			
		}
		
		if(string_strpos($_GET["where"],",")){
			unset($aux_where,$array_where);
			$aux_where = explode(",",$_GET["where"]);
			for($i=0;$i<count($aux_where);$i++){
				$array_where[] = trim($aux_where[$i]);
			}
			$_GET["where"] = implode(", ",$array_where);
			
		}
	}
	##################################################

?>
