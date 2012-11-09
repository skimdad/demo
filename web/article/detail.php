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
	# * FILE: /article/detail.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSessionFront();
	
	# ----------------------------------------------------------------------------------------------------
	# MAINTENANCE MODE
	# ----------------------------------------------------------------------------------------------------
	verify_maintenanceMode();
	
	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on" || CUSTOM_ARTICLE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# MOD-REWRITE
	# ----------------------------------------------------------------------------------------------------
	include(ARTICLE_EDIRECTORY_ROOT."/mod_rewrite.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# ARTICLE
	# ----------------------------------------------------------------------------------------------------
	if (($_GET["id"]) || ($_POST["id"])) {
		$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];
		$article = new Article($id);
		$level = new ArticleLevel(EDIR_DEFAULT_LANGUAGE, true);
		unset($articleMsg);
		if ((!$article->getNumber("id")) || ($article->getNumber("id") <= 0)) {
			$articleMsg = system_showText(LANG_MSG_NOTFOUND);
		} elseif ($article->getString("status") != "A") {
			$articleMsg = system_showText(LANG_MSG_NOTAVAILABLE);
		} elseif ($article->getString("publication_date") > date("Y-m-d")) {
			$articleMsg = system_showText(LANG_MSG_NOTAVAILABLE);
		} elseif ($level->getDetail($article->getNumber("level")) != "y") {
			$articleMsg = system_showText(LANG_MSG_NOTAVAILABLE);
		} else {
			report_newRecord("article", $id, ARTICLE_REPORT_DETAIL_VIEW);
			$article->setNumberViews($id);
		}
	} else {
		header("Location: ".ARTICLE_DEFAULT_URL."/");
		exit;
	}
	
	# ----------------------------------------------------------------------------------------------------
	# REVIEWS
	# ----------------------------------------------------------------------------------------------------
	if ($id)  $sql_where[] = " item_type = 'article' AND item_id = ".db_formatNumber($id)." ";
	if (true) $sql_where[] = " review IS NOT NULL AND review != '' ";
	if (true) $sql_where[] = " approved = '1' ";
	if ($sql_where) $sqlwhere .= " ".implode(" AND ", $sql_where)." ";
	$pageObj  = new pageBrowsing("Review", $screen, 3, "added DESC", "", "", $sqlwhere);
	$reviewsArr = $pageObj->retrievePage("object");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	if (($article->getNumber("id")) && ($article->getNumber("id") > 0)) {
		$artCategs = $article->getCategories();
		if ($artCategs) {
			foreach ($artCategs as $artCateg) {
				$category_id[] = $artCateg->getNumber("id");
			}
		}
	}
	$_POST["category_id"] = $category_id;
	$banner_section = "article";
	$headertag_title = (($article->getString("seo_title"))?($article->getString("seo_title")):($article->getString("title")));
	$headertag_description = (($article->getStringLang(EDIR_LANGUAGE, "seo_abstract"))?($article->getStringLang(EDIR_LANGUAGE, "seo_abstract")):($article->getStringLang(EDIR_LANGUAGE, "abstract")));
	$headertag_keywords = (($article->getStringLang(EDIR_LANGUAGE, "seo_keywords"))?($article->getStringLang(EDIR_LANGUAGE, "seo_keywords")):(str_replace(" || ", ", ", $article->getStringLang(EDIR_LANGUAGE, "keywords"))));
	include(system_getFrontendPath("header.php", "layout"));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# BODY
	# ----------------------------------------------------------------------------------------------------
	include(THEMEFILE_DIR."/".EDIR_THEME."/body/article_detail.php");
	
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$banner_section = "article";
	include(system_getFrontendPath("footer.php", "layout"));

?>
