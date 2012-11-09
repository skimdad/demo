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
	# * FILE: /sitemgr/classifiedcategs/featured.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on") {
		header("Location: ".DEFAULT_URL."/sitemgr/");
		exit;
	}
	
	if (FEATURED_CATEGORY == "on") {
		setting_get("featuredcategory", $featuredcategory);
		if ($featuredcategory == "on") {
			setting_get("classified_featuredcategory", $classified_featuredcategory);
			if (!$classified_featuredcategory) {
				exit;
			}
		} else exit;
	} else {
		exit;
	}
    # ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	//permission_hasSMPerm();
	if (!permission_hasSMPermSection(SITEMGR_PERMISSION_CLASSIFIEDS)){
			header("Location: ".DEFAULT_URL."/sitemgr/");
			exit;
	}

	$url_redirect = "".DEFAULT_URL."/sitemgr/classifiedcategs/featured.php";
    $url_base = "".DEFAULT_URL."/sitemgr";
    $sitemgr = 1;
    $featuredClassifiedCategory = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));
	
    extract($_GET);
    extract($_POST);

	if (!isset($pop_categories)) system_setFreqActions('classified_featuredcateg','CLASSIFIED_FEATURE');

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['save'] == 1) {
		if ($featured_status == 'n' && count($featureds)) {
			$info_message = LANG_SITEMGR_FEATUREDCATEGORIES_INFO;
		}
		if ($non_feat_categories!="")
			system_changeFeaturedAtribute ("ClassifiedCategory", "$non_feat_categories", "n" );
		if ($feat_categories!="")
			system_changeFeaturedAtribute ("ClassifiedCategory", "$feat_categories", "y" );
        $message = ucfirst(LANG_SITEMGR_FEATUREDCLASSIFIEDSCATEGORIES_WERESUCCESSUPDATED);
    }

    # ----------------------------------------------------------------------------------------------------
	# PAGE BROWSING
	# ----------------------------------------------------------------------------------------------------
	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$arrLangs = explode(",", EDIR_LANGUAGENUMBERS);
	$endExpr = ")";

	if (count($arrLangs) > 1) {
		$fields = "id, featured, lang, enabled, IF (`title".$langIndex."` != '', `title".$langIndex."`, ";
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
		$fields = "id, featured, lang, enabled, `title".$langIndex."` AS `title`";
		$letterfield = "`title".$langIndex."`";
	}
	$pageObj   = new pageBrowsing("ClassifiedCategory", $screen, RESULTS_PER_PAGE, "title", $letterfield, $letter, "category_id = ".db_formatNumber($category_id), $fields);
    $categories = $pageObj->retrievePage("array");

    $paging_url = DEFAULT_URL."/sitemgr/classifiedcategs/featured.php";

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
		<h1><?=string_ucwords(system_showText(LANG_SITEMGR_CLASSIFIED_PLURAL))?> - <?=string_ucwords(system_showText(LANG_SITEMGR_FEATUREDCATEGORY_PLURAL))?> </h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
		<?if (CUSTOM_CLASSIFIED_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>
		<? include(INCLUDES_DIR."/tables/table_category_submenu.php");?>
		<br />
        <? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
		<? if (!$category_id) { ?>
			<div class="tip-base">
				<p style="text-align: justify;">
					<a href="<?=DEFAULT_URL;?>/sitemgr/faq/faq.php?keyword=<?=urlencode("featured");?>" target="_blank"><?=system_showText(LANG_SITEMGR_FEATUREDCATEGORIES_TIP)?></a>
				</p>
			</div>
		<? } ?>
		<?
		if ($info_message) {
			echo "<p class=\"informationMessage\">".$info_message."</p>";
		}
        if ($message) {
         echo "<p class=\"successMessage\">".$message."</p>";
        } 
        ?>
		<? include_once(EDIRECTORY_ROOT."/includes/forms/form_category_featured.php");?>
		<br />
		<? } ?>
	</div>
</div>
<div id="bottom-content">
	&nbsp;
</div>
</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>