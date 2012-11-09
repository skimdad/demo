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
	# * FILE: /sitemgr/loaddisabledcategorytree.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	$_GET["prefix"] = system_denyInjections($_GET["prefix"]);
	$_GET["category"] = system_denyInjections($_GET["category"]);

	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$arrLangs = explode(",", EDIR_LANGUAGENUMBERS);
	$endExpr = ")";

	if (count($arrLangs) > 1) {
		$fields = "id, enabled, IF (`title".$langIndex."` != '', `title".$langIndex."`, ";
		$orderby = "IF (`title".$langIndex."` != '', `title".$langIndex."`, ";
		foreach ($arrLangs as $lang) {
			if ($langIndex != $lang) {
				$fields .= "IF (`title".$lang."` != '', `title".$lang."`, ";
				$orderby .= "IF (`title".$lang."` != '', `title".$lang."`, ";
				$endExpr .= ")";
			}
		}
		$fields .= "''".$endExpr." AS `title`";
		$orderby .= "''".$endExpr."";
	} else {
		$fields = "`id`, `enabled`, `title".$langIndex."` AS `title`";
		$orderby = "`title".$langIndex."`";
	}

	$return = "";

	if (string_strpos(string_strtolower($_GET["category"]), "category") !== false) {
		if ($_GET["action"] == "template") {
			$listingtemplate = new ListingTemplate($_GET["template_id"]);
			if ($listingtemplate) {
				$templatecategories = $listingtemplate->getCategories();
			}
			if ($templatecategories) {
				foreach ($templatecategories as $templatecategory) {
					$arraycategories[] = $templatecategory->getNumber("id");
				}
				$categories = db_getFromDBBySQL($_GET["category"], "SELECT $fields FROM ".$_GET["category"]." WHERE category_id = ".db_formatNumber($_GET["category_id"])." AND id IN (".(implode(",", $arraycategories)).")"." ORDER BY ".$orderby, "object", false, $_GET["domain_id"]);
			} else {
				$categories = db_getFromDBBySQL($_GET["category"], "SELECT $fields FROM ".$_GET["category"]." WHERE category_id = ".db_formatNumber($_GET["category_id"])." ORDER BY ".$orderby, "object", false, $_GET["domain_id"]);
			}
		} else {
			$categories = db_getFromDBBySQL($_GET["category"], "SELECT $fields FROM ".$_GET["category"]." WHERE category_id = ".db_formatNumber($_GET["category_id"])." ORDER BY ".$orderby, "object", false, $_GET["domain_id"]);
		}
	}

	if ($categories) {
		$count = 0;
		$ret = 0;
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID($_GET["domain_id"], $dbMain);
		$arrayCategoriesIds = explode(",",$_GET["ajax_categories"]);

		function search_disabled_sub($dbObj, $catId, $ret){
			$sql = "SELECT id, enabled FROM ".$_GET["category"]." WHERE category_id =".$catId;
			$result = $dbObj->query($sql);
			while ($row = mysql_fetch_array($result)) {
				if ($row["enabled"] != "n") {
					$ret = search_disabled_sub($dbObj, $row["id"], $ret);	
				} else {
					$ret = 1;
				}
			}
			return $ret;			
		}
		
		foreach ($categories as $category) {
			$ret = 0;
			if(in_array($category->getNumber("id"), $arrayCategoriesIds)){
				$style = "style=\"display:none;\"";
			}else{
				$style = "";
			}
			$catId = $category->getNumber("id");
			$pre = string_substr($_GET["prefix"], 0, -1);

			$langs = $category->getString("enabled");
			$link = DEFAULT_URL."/sitemgr/".$pre."categs/category.php?id=".$catId;
			$path_count = count($category->getFullPath());
			$sql = "SELECT id FROM ".$_GET["category"]." WHERE category_id =".$catId." AND enabled = 'n'";
			$result = $dbObj->query($sql);

			if (($path_count <= CATEGORY_LEVEL_AMOUNT) && (mysql_num_rows($result) == 0)) {
				$ret = search_disabled_sub($dbObj, $catId, $ret);
				if ($ret != 0) {
					$sql = "SELECT id FROM ".$_GET["category"]." WHERE category_id =".$catId;
					$result = $dbObj->query($sql);
				}
			}
			if (($path_count < CATEGORY_LEVEL_AMOUNT) && (mysql_num_rows($result) > 0)) {
				$count++;
				if ($langs == 'n'){
					$return .= "<li>\n<a href=\"javascript:void(0);\" onclick=\"loadCategoryTree('all', '".$_GET["prefix"]."', '".$_GET["category"]."', ".$category->getNumber("id").", 0, '".EDIRECTORY_FOLDER.(EDIR_LANG_URL ? "/".EDIR_LANGUAGEABBREVIATION : "")."',".$_GET["domain_id"].");\" class=\"switchOpen\" id=\"".$_GET["prefix"]."opencategorytree_id_".$category->getNumber("id")."\">+</a><a href=".$link." class=\"categoryTitle\" id=\"".$_GET["prefix"]."opencategorytree_title_id_".$category->getNumber("id")."\">".$category->getString("title")."</a><a href=\"javascript:void(0);\" onclick=\"closeCategoryTree('".$_GET["prefix"]."', '".$_GET["category"]."', ".$category->getNumber("id").", '".DEFAULT_URL."');\" class=\"switchClose\" id=\"".$_GET["prefix"]."closecategorytree_id_".$category->getNumber("id")."\" style=\"display: none;\">-</a><a href=".$link." class=\"categoryTitle\" id=\"".$_GET["prefix"]."closecategorytree_title_id_".$category->getNumber("id")."\" style=\"display: none;\">".$category->getString("title")."</a>\n<ul id=\"".$_GET["prefix"]."categorytree_id_".$category->getNumber("id")."\" style=\"display: none;\"></ul>\n</li>\n";
				} else {
					$return .= "<li>\n<a href=\"javascript:void(0);\" onclick=\"loadCategoryTree('all', '".$_GET["prefix"]."', '".$_GET["category"]."', ".$category->getNumber("id").", 0, '".EDIRECTORY_FOLDER.(EDIR_LANG_URL ? "/".EDIR_LANGUAGEABBREVIATION : "")."',".$_GET["domain_id"].");\" class=\"switchOpen\" id=\"".$_GET["prefix"]."opencategorytree_id_".$category->getNumber("id")."\">+</a><a class=\"categoryTitle\" style=\"text-decoration:none\" id=\"".$_GET["prefix"]."opencategorytree_title_id_".$category->getNumber("id")."\">".$category->getString("title")."</a><a href=\"javascript:void(0);\" onclick=\"closeCategoryTree('".$_GET["prefix"]."', '".$_GET["category"]."', ".$category->getNumber("id").", '".DEFAULT_URL."');\" class=\"switchClose\" id=\"".$_GET["prefix"]."closecategorytree_id_".$category->getNumber("id")."\" style=\"display: none;\">-</a><a class=\"categoryTitle\" id=\"".$_GET["prefix"]."closecategorytree_title_id_".$category->getNumber("id")."\" style=\"display: none; text-decoration:none\">".$category->getString("title")."</a>\n<ul id=\"".$_GET["prefix"]."categorytree_id_".$category->getNumber("id")."\" style=\"display: none;\"></ul>\n</li>\n";
				}
			} else if(($path_count <= CATEGORY_LEVEL_AMOUNT) && (mysql_num_rows($result) == 0)){
			
				if ($langs == 'n'){
					$count++;
					$return .= "<li class=\"categoryBullet\">\n<a href=".$link." class=\"categoryTitle\">".$category->getString("title")."</a>\n</li>\n";
				}
			}
			
		}
                                                                    
		if ($count == 0) {
			$return = "<li class=\"informationMessage\">".system_showText(LANG_DISABLED_CATEGORY_NOTFOUND)."</li>";
		}

	} else {
		$return = "<li class=\"informationMessage\">".system_showText(LANG_DISABLED_CATEGORY_NOTFOUND)."</li>";
	}

	echo $return;

?>