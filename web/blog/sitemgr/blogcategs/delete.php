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
	# * FILE: /sitemgr/blogcategs/delete.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BLOG_FEATURE != "on") { exit; }

	
	/*
     * Session variable to force connection with second DB
     */
    $_SESSION["FORCE_SECOND"] = false;
    
	
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	if (!permission_hasSMPermSection(SITEMGR_PERMISSION_BLOG)){
		header("Location: ".DEFAULT_URL."/sitemgr/");
		exit;
	}

	$url_redirect = "".BLOG_DEFAULT_URL."/sitemgr/blogcategs";
	$url_base = "".BLOG_DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	extract($_GET);
	extract($_POST);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$langIndex = language_getIndex(EDIR_LANGUAGE);
		$arrLangs = explode(",", EDIR_LANGUAGENUMBERS);
		$endExpr = ")";

		if (count($arrLangs) > 1) {
			$fields = "id, IF (`title".$langIndex."` != '', `title".$langIndex."`, ";
			foreach ($arrLangs as $lang) {
				if ($langIndex != $lang) {
					$fields .= "IF (`title".$lang."` != '', `title".$lang."`, ";
					$endExpr .= ")";
				}
			}

			$fields .= "''".$endExpr." AS `title`";
		} else {
			$fields = "`id`, `title".$langIndex."` AS `title`";
		}

		$category = db_getFromDB_Blog("blogcategory", "id", $id, 1, "", "object", SELECTED_DOMAIN_ID, $fields);
	} else {
		$message = 0;
		header("Location: ".BLOG_DEFAULT_URL."/sitemgr/blogcategs/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&category_id=".$category_id."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$category = new BlogCategory($_POST['id']);
		$category->delete();
		$message = 1;
		header("Location: ".BLOG_DEFAULT_URL."/sitemgr/blogcategs/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&category_id=".$category_id."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

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
			<h1><?=system_showText(LANG_SITEMGR_DELETETAG)?></h1>
		</div>
	</div>
	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
			<?if (CUSTOM_BLOG_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>
			
				<div class="baseForm">

				<form name="blog" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

					<input type="hidden" name="id" value="<?=$id?>" />
					<input type="hidden" id="category_id" name="category_id" value="<?=$category_id?>" />

					<div class="header-form"><?=system_showText(LANG_SITEMGR_DELETETAG)?> - <?=$category->getString("title")?></div>
					<p class="informationMessage"><?=system_showText(LANG_SITEMGR_TAG_DELETEQUESTION)?></p>
					<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
					<input type="hidden" name="letter" value="<?=$letter?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />
					<button type="submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

				</form>
				<form action="<?=BLOG_DEFAULT_URL?>/sitemgr/blogcategs/<?=(($search_page) ? "search.php" : "index.php");?>" method="get">

					<input type="hidden" id="category_id" name="category_id" value="<?=$category_id?>" />
					<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
					<input type="hidden" name="letter" value="<?=$letter?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />
					<button type="submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

				</form>

				</div>
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
