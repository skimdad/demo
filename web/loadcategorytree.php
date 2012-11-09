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
	include("./conf/loadconfig.inc.php");

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

	$return = "";
    
    if (string_strpos($_SERVER["HTTP_REFERER"], 'blog.php')){
        $is_blog = true;
    } else {
        $is_blog = false;
    }

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
                $sql_categories = "SELECT id, title".$langIndex." FROM ".$_GET["category"]." WHERE category_id = ".db_formatNumber($_GET["category_id"])." AND id IN (".(implode(",", $arraycategories)).")AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title".$langIndex." <> ''".(!$is_blog ? " AND enabled = 'y'" : "")." ORDER BY title".$langIndex;
                $categories = db_getFromDBBySQL($_GET["category"], $sql_cetegories,'',true, $_GET["domain_id"]);
            } else {
                $sql_categories = "SELECT id, title".$langIndex." FROM ".$_GET["category"]." WHERE category_id = ".db_formatNumber($_GET["category_id"])." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title".$langIndex." <> ''".(!$is_blog ? " AND enabled = 'y'" : "")." ORDER BY title".$langIndex;
                $categories = db_getFromDBBySQL($_GET["category"], $sql_categories,'',true, $_GET["domain_id"]);
            }
        } else {
            $sql_categories = "SELECT id, title".$langIndex." FROM ".$_GET["category"]." WHERE category_id = ".db_formatNumber($_GET["category_id"])." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title".$langIndex." <> ''".(!$is_blog ? " AND enabled = 'y'" : "")." ORDER BY title".$langIndex;
            $categories = db_getFromDBBySQL($_GET["category"], $sql_categories,'',true, $_GET["domain_id"]);
        }
    }

    if ($categories) {

        $arrayCategoriesIds = explode(",",$_GET["ajax_categories"]);

        $dbObj_main = db_getDBObject(DEFAULT_DB, true);
        $dbObj = db_getDBObjectByDomainID($_GET["domain_id"], $dbObj_main);
        foreach ($categories as $category) {

            if(in_array($category->getNumber("id"), $arrayCategoriesIds)){
                $style = "style=\"display:none;\"";
            }else{
                $style = "";
            }

            if ($_GET["action"] == "main") {
                $return .= "<li class=\"categoryBullet\">".$category->getString("title".$langIndex)." <a id='categoryAdd".$category->getNumber("id")."' $style href=\"javascript:void(0);\" onclick=\"JS_addCategory('".str_replace('"', '\"', str_replace("'", "\'", $category->getString("title".$langIndex)))."', ".$category->getNumber("id").");\" class=\"categoryAdd\">".system_showText(LANG_ADD)."</a></li>";
            } else {
                $path_count = count($category->getFullPath());
                $sql = "SELECT id FROM ".$_GET["category"]." WHERE category_id =".$category->getNumber("id")." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title".$langIndex." <> ''".(!$is_blog ? " AND enabled = 'y'" : "");
                $result = $dbObj->query($sql);
                if (($path_count < CATEGORY_LEVEL_AMOUNT) && (mysql_num_rows($result) > 0)) {
                    $return .= "<li><a href=\"javascript:void(0);\" onclick=\"loadCategoryTree('all', '".$_GET["prefix"]."', '".$_GET["category"]."', ".$category->getNumber("id").", 0, '".EDIRECTORY_FOLDER.(EDIR_LANG_URL ? "/".EDIR_LANGUAGEABBREVIATION : "")."',".$_GET["domain_id"].");\" class=\"switchOpen\" id=\"".$_GET["prefix"]."opencategorytree_id_".$category->getNumber("id")."\">+</a><a href=\"javascript:void(0);\" onclick=\"loadCategoryTree('all', '".$_GET["prefix"]."', '".$_GET["category"]."', ".$category->getNumber("id").", 0, '".EDIRECTORY_FOLDER.(EDIR_LANG_URL ? "/".EDIR_LANGUAGEABBREVIATION : "")."',".$_GET["domain_id"].");\" class=\"categoryTitle\" id=\"".$_GET["prefix"]."opencategorytree_title_id_".$category->getNumber("id")."\">".$category->getString("title".$langIndex)."</a><a href=\"javascript:void(0);\" onclick=\"closeCategoryTree('".$_GET["prefix"]."', '".$_GET["category"]."', ".$category->getNumber("id").", '".DEFAULT_URL."');\" class=\"switchClose\" id=\"".$_GET["prefix"]."closecategorytree_id_".$category->getNumber("id")."\" style=\"display: none;\">-</a><a href=\"javascript:void(0);\" onclick=\"closeCategoryTree('".$_GET["prefix"]."', '".$_GET["category"]."', ".$category->getNumber("id").", '".DEFAULT_URL."');\" class=\"categoryTitle\" id=\"".$_GET["prefix"]."closecategorytree_title_id_".$category->getNumber("id")."\" style=\"display: none;\">".$category->getString("title".$langIndex)."</a>\n<ul id=\"".$_GET["prefix"]."categorytree_id_".$category->getNumber("id")."\" style=\"display: none;\"></ul>\n</li>\n";
                } else {
                    $return .= "<li class=\"categoryBullet\">".$category->getString("title".$langIndex)." <a id='categoryAdd".$category->getNumber("id")."' href=\"javascript:void(0);\" $style onclick=\"JS_addCategory('".str_replace('"', '\"', str_replace("'", "\'", $category->getString("title".$langIndex)))."', ".$category->getNumber("id").");\" class=\"categoryAdd\">".system_showText(LANG_ADD)."</a></li>";
                }
            }
        }
    } else {
        $return = "<li class=\"informationMessage\">".system_showText(LANG_CATEGORY_NOTFOUND)."</li>";
    }
	
	echo $return;

?>