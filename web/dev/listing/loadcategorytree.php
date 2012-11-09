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
	# * FILE: /loadcategorytree.php
	# ----------------------------------------------------------------------------------------------------
	define("SELECTED_DOMAIN_ID", $_GET["domain_id"]);
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
	$_GET["domain_id"] = system_denyInjections($_GET["domain_id"]);

	$langIndex = language_getIndex(EDIR_LANGUAGE);
	//If PHP 5 use XML to get the categories			

	$catObj = new ListingCategory();
	
	/*
	 * For sitemgr get correct categories
	 */
	if($_GET["domain_id"]){
		$catObj->setNumber("force_second_db",1);
		$catObj->setNumber("domain_id",$_GET["domain_id"]);
	}

	$dbObj_main = db_getDBObject(DEFAULT_DB, true);
	$dbObj = db_getDBObjectByDomainID($_GET["domain_id"], $dbObj_main);

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
				$categories = $catObj->getAllCategoriesHierarchyXML(EDIR_LANGUAGE, NULL, $_GET["category_id"], implode(",", $arraycategories), $_GET["domain_id"]);
			} else {
				$categories = $catObj->getAllCategoriesHierarchyXML(EDIR_LANGUAGE, NULL, $_GET["category_id"], 0, $_GET["domain_id"]);
			}
		} else {
			$categories = $catObj->getAllCategoriesHierarchyXML(EDIR_LANGUAGE, NULL, $_GET["category_id"], 0, $_GET["domain_id"]);
		}
	}

	if ($categories) {
			
		$arrayCategoriesIds = explode(",",$_GET["ajax_categories"]);

		$xml_categories = simplexml_load_string($categories);
		if(count($xml_categories->info) > 0) {
			for($i=0;$i<count($xml_categories->info);$i++){
				unset($categories);
				foreach($xml_categories->info[$i]->children() as $key => $value){
					$categories[$key] = $value;
				}
				if($categories){
					if(in_array($categories["id"], $arrayCategoriesIds)){
						$style = "style=\"display:none;\"";
					}
					else {
						$style = "";
					}

					if ($_GET["action"] == "main") {
						$return .= "<li class=\"categoryBullet\">".$categories["title".$langIndex]." <a id='categoryAdd".$categories["id"]."' $style href=\"javascript:void(0);\" onclick=\"JS_addCategory('".str_replace('"', '\"', str_replace("'", "\'", $categories["title".$langIndex]))."', ".$categories["id"].");\" class=\"categoryAdd\">".system_showText(LANG_ADD)."</a></li>";
					}
					else {
						if (($categories["children"] > 0) && (($categories["level"] + 1) < LISTING_CATEGORY_LEVEL_AMOUNT)) {
							$return .= "<li><a href=\"javascript:void(0);\" onclick=\"loadCategoryTree('all', '".$_GET["prefix"]."', '".$_GET["category"]."', ".$categories["id"].", 0, '".EDIRECTORY_FOLDER."/".(EDIR_LANG_URL ? EDIR_LANGUAGEABBREVIATION."/" : "").LISTING_FEATURE_FOLDER."'".($_GET["domain_id"] ? ",".$_GET["domain_id"]:"").");\" class=\"switchOpen\" id=\"".$_GET["prefix"]."opencategorytree_id_".$categories["id"]."\">+</a><a href=\"javascript:void(0);\" onclick=\"loadCategoryTree('all', '".$_GET["prefix"]."', '".$_GET["category"]."', ".$categories["id"].", 0, '".EDIRECTORY_FOLDER."/".(EDIR_LANG_URL ? EDIR_LANGUAGEABBREVIATION."/" : "").LISTING_FEATURE_FOLDER."'".($_GET["domain_id"] ? ",".$_GET["domain_id"]:"").");\" class=\"categoryTitle\" id=\"".$_GET["prefix"]."opencategorytree_title_id_".$categories["id"]."\">".$categories["title".$langIndex]."</a><a href=\"javascript:void(0);\" onclick=\"closeCategoryTree('".$_GET["prefix"]."', '".$_GET["category"]."', ".$categories["id"].", '".DEFAULT_URL."');\" class=\"switchClose\" id=\"".$_GET["prefix"]."closecategorytree_id_".$categories["id"]."\" style=\"display: none;\">-</a><a href=\"javascript:void(0);\" onclick=\"closeCategoryTree('".$_GET["prefix"]."', '".$_GET["category"]."', ".$categories["id"].", '".DEFAULT_URL."');\" class=\"categoryTitle\" id=\"".$_GET["prefix"]."closecategorytree_title_id_".$categories["id"]."\" style=\"display: none;\">".$categories["title".$langIndex]."</a>\n<ul id=\"".$_GET["prefix"]."categorytree_id_".$categories["id"]."\" style=\"display: none;\"></ul>\n</li>\n";
						}
						else {
							$return .= "<li class=\"categoryBullet\">".$categories["title".$langIndex]." <a id='categoryAdd".$categories["id"]."' href=\"javascript:void(0);\" $style onclick=\"JS_addCategory('".str_replace('"', '\"', str_replace("'", "\'", $categories["title".$langIndex]))."', ".$categories["id"].");\" class=\"categoryAdd\">".system_showText(LANG_ADD)."</a></li>";
						}
					}
				}
			}
		}
	} else {
		if (string_strpos($_SERVER["HTTP_REFERER"], 'blog.php'))
			$return = "<li class=\"informationMessage\">".system_showText(LANG_TAG_NOTFOUND)."</li>";
		else
			$return = "<li class=\"informationMessage\">".system_showText(LANG_CATEGORY_NOTFOUND)."</li>";
	}

	echo $return;
?>