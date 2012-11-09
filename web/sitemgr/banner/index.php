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
	# * FILE: /sitemgr/banner/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BANNER_FEATURE != "on") {
		header("Location: ".DEFAULT_URL."/sitemgr/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	//increases frequently actions
	if (!isset($message)) system_setFreqActions('banner_manage','BANNER_FEATURE');

	$url_redirect = "".DEFAULT_URL."/sitemgr/".BANNER_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# PAGE BROWSING
	# ----------------------------------------------------------------------------------------------------
	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$arrLangs = explode(",", EDIR_LANGUAGENUMBERS);
	$endExpr = ")";

	if (count($arrLangs) > 1) {
		$fields = "id, type, status, account_id, expiration_setting, renewal_date, impressions, ";
		$fields .= "IF (`caption".$langIndex."` != '', `caption".$langIndex."`, ";
		$letterField = "IF (`caption".$langIndex."` != '', `caption".$langIndex."`, ";
		foreach ($arrLangs as $lang) {
			if ($langIndex != $lang) {
				$fields .= "IF (`caption".$lang."` != '', `caption".$lang."`, ";
				$letterField .= "IF (`caption".$lang."` != '', `caption".$lang."`, ";
				$endExpr .= ")";
			}
		}

		$fields .= "''".$endExpr." AS `caption`";
		$letterField .= "''".$endExpr."";
	} else {
		$fields = "id, type, status, account_id, expiration_setting, renewal_date, impressions, `caption".$langIndex."` AS `caption`";
		$letterField = "`caption".$langIndex."`";
	}
    
    $bannerLevelObj = new BannerLevel(EDIR_DEFAULT_LANGUAGE, true);
    $levelsTheme = $bannerLevelObj->getValues();
    $whereLevelThemes = " type IN (".implode(", ", $levelsTheme).")";

	$pageObj  = new pageBrowsing("Banner", $screen, RESULTS_PER_PAGE, (($_GET["newest"])?("id DESC"):((BANNER_SCALABILITY_OPTIMIZATION == "on")?(""):("updated DESC, caption"))), $letterField, $letter, $whereLevelThemes, $fields);
	$banners = $pageObj->retrievePage("array");

	$paging_url = DEFAULT_URL."/sitemgr/".BANNER_FEATURE_FOLDER."/index.php";

	// Letters Menu
	$letters = $pageObj->getString("letters");
	foreach ($letters as $each_letter) {
		if ($each_letter == "#") {
			$letters_menu .= "<a href=\"$paging_url?letter=no\" ".(($letter == "no") ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
			//$letters_menu .= "<a href=\"$paging_url\" ".((!$letter) ? "class=\"firstLetter\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		} else {
			$letters_menu .= "<a href=\"$paging_url?letter=".$each_letter."\" ".(($each_letter == $letter) ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		}
	}

	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------

	include(INCLUDES_DIR."/code/bulkupdate.php");
	
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
		<h1 class="highlight"><?=string_ucwords(system_showText(LANG_SITEMGR_BANNER_PLURAL))?><? if (DEMO_MODE) { ?> <span>(Optional Module)</span> <? } ?></h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
		<?if (CUSTOM_BANNER_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>
		<? include(INCLUDES_DIR."/tables/table_banner_submenu.php"); ?>

		<? if ($banners) { ?>
			<? include(INCLUDES_DIR."/tables/table_banner.php"); ?>
		<? } else { ?>
			<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
			<p class="informationMessage">
				<?=system_showText(LANG_SITEMGR_BANNER_NORECORD)?>
			</p>
		<? }
		} ?>
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