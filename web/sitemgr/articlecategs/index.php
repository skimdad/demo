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
	# * FILE: /sitemgr/articlecategs/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on") {
		header("Location: ".DEFAULT_URL."/sitemgr/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	//permission_hasSMPerm();
	if (!permission_hasSMPermSection(SITEMGR_PERMISSION_ARTICLES)){
			header("Location: ".DEFAULT_URL."/sitemgr/");
			exit;
	}

	$url_redirect = "".DEFAULT_URL."/sitemgr/articlecategs";
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;
	$table_category = "ArticleCategory";
	$message_no_record = LANG_SITEMGR_ARTICLE_CATEGORY_NORECORD;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	//increases frequently actions
	if (!isset($message)) system_setFreqActions('articlecateg_manage','ARTICLE_FEATURE');


	# ----------------------------------------------------------------------------------------------------
	# PAGE BROWSING
	# ----------------------------------------------------------------------------------------------------
	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$arrLangs = explode(",", EDIR_LANGUAGENUMBERS);
	$endExpr = ")";

	if (count($arrLangs) > 1) {
		$fields = "id, IF (`title".$langIndex."` != '', `title".$langIndex."`, ";
		$letterfield = " IF (`title".$langIndex."` != '', `title".$langIndex."`, ";
		foreach ($arrLangs as $lang) {
			if ($langIndex != $lang) {
				$fields .= "IF (`title".$lang."` != '', `title".$lang."`, ";
				$letterfield .= "IF (`title".$lang."` != '', `title".$lang."`, ";
				$endExpr .= ")";
			}
		}

		$fields .= "''".$endExpr." AS `title`";
		$letterfield .= "''".$endExpr." ";
	} else {
		$fields = "id, `title".$langIndex."` AS `title`";
		$letterfield = "`title".$langIndex."`";
	}
	$pageObj  = new pageBrowsing("ArticleCategory", $screen, RESULTS_PER_PAGE, "title, id", $letterfield, $letter, "category_id = ".db_formatNumber($category_id), $fields);
	$categories = $pageObj->retrievePage("array");

	$paging_url = DEFAULT_URL."/sitemgr/articlecategs/index.php?category_id=".$category_id;

	// Letters Menu
	$letters = $pageObj->getString("letters");
	foreach($letters as $each_letter){
		if ($each_letter == "#") {
			$letters_menu .= "<a href=\"$paging_url&letter=no\" ".(($letter == "no") ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
				//$letters_menu .= "<a href=\"$paging_url\" ".((!$letter) ? "class=\"firstLetter\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		} else {
			$letters_menu .= "<a href=\"$paging_url&letter=".$each_letter."\" ".(($each_letter == $letter) ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		}
	}
	
	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=string_ucwords(system_showText(LANG_SITEMGR_ARTICLE_PLURAL))?> - <?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORIES))?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
			<?if (CUSTOM_ARTICLE_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>
			<? include(INCLUDES_DIR."/tables/table_category_submenu.php"); ?>

			<br />

			<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_category.php"); ?>
			<? } ?>
		</div>

	</div>

	<div id="bottom-content">&nbsp;</div>

</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
