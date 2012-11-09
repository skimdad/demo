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
	# * FILE: /sitemgr/deal/search.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	$promoLevelListing = new ListingLevel();
	$levels_all = $promoLevelListing->getLevelValues();
	foreach ($levels_all as $level_each) {
		if ( $promoLevelListing->getHasPromotion($level_each) == 'y' ) $hasPromotion = true;
	}
	if ( PROMOTION_FEATURE != 'on' ) {
		header("Location: ".DEFAULT_URL."/sitemgr/");
		exit;
	}
	elseif ( !$hasPromotion ){
		header("Location: ".DEFAULT_URL."/sitemgr/");
		exit;
	}
	
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/sitemgr/".PROMOTION_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	$_GET = format_magicQuotes($_GET);
	extract($_GET);
	$_POST = format_magicQuotes($_POST);
	extract($_POST);

	//increases frequently actions
	if (!isset($acct_search_field_name)) system_setFreqActions('promotion_search','PROMOTION_FEATURE');

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------

	include(INCLUDES_DIR."/code/bulkupdate.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------

	// Page Browsing ////////////////////////////////////////

	if ($account_search_bulk == "0") {
		$sql_where[] = " account_id = 0 ";
	} else if ($search_no_owner==1 && !$account_search_bulk){
		$sql_where[] = " account_id = 0 ";
	}elseif ($search_account_id  && !$change_account_id){
		$sql_where[] = " account_id = $search_account_id ";
	}elseif($change_account_id){
		$sql_where[] = " account_id = ".$change_account_id;
	}
	
    if ($search_name) {
        $search_name = str_replace("\\", "", $search_name);
        $search_for_keyword_fields_promotion[] = "Promotion.fulltextsearch_keyword";        
        $sql_where[] = "( (".search_getSQLFullTextSearch($search_name, $search_for_keyword_fields_promotion, "keyword_score", $order_by_keyword_score, $search_for["match"], $order_by_keyword_score2, "keyword_score2").") )";
    }

	if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";

	$_GET["search_page"] = "1";
	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	$paging_url = DEFAULT_URL."/sitemgr/".PROMOTION_FEATURE_FOLDER."/search.php";

	if (!$error_message && !$error_msg) {
		if ($_POST["screen"]) {
			if ($bulkSubmit) {
				unset($arrayURL);
				if ($change_no_owner) {
					$arrayURL[] = "search_no_owner=1";
				} elseif ($change_account_id) {
					$arrayURL[] = "search_account_id=$change_account_id";
				}
				$arrayURL[] = "screen=1";
				$arrayURL[] = "letter=".$letter;
				$arrayURL[] = "search_submit=Search";
				$arrayURL[] = "msg=".$msg;
				$strURL = implode("&", $arrayURL);

				header("Location: ".$paging_url."?$strURL");
				exit;
			} else {
				$screen = $_POST["screen"];
			}
		} else if ($bulkSubmit) {
			unset($arrayURL);
			if ($change_no_owner) {
				$arrayURL[] = "search_no_owner=1";
			} elseif ($change_account_id) {
				$arrayURL[] = "search_account_id=$change_account_id";
			}
			$arrayURL[] = "screen=1";
			$arrayURL[] = "letter=".$letter;
			$arrayURL[] = "search_submit=Search";
			$arrayURL[] = "msg=".$msg;
			$strURL = implode("&", $arrayURL);

			header("Location: ".$paging_url."?$strURL");
			exit;
		}
	}

	$pageObj = new pageBrowsing("Promotion", $screen, RESULTS_PER_PAGE, "name", "name", $letter, $where, "Promotion.*", "Promotion");
	$promotions = $pageObj->retrievePage();


	// Letters Menu
	$letters = $pageObj->getString("letters");
	foreach ($letters as $each_letter) {
		if ($each_letter == "#") {
			$letters_menu .= "<a href=\"$paging_url?letter=no".(($url_search_params) ? "&$url_search_params" : "")."\" ".(($letter == "no") ? "class=\"firstLetter\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		} else {
			$letters_menu .= "<a href=\"$paging_url?letter=".$each_letter.(($url_search_params) ? "&$url_search_params" : "")."\" ".(($each_letter == $letter) ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
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

	$_GET = format_magicQuotes($_GET);
	extract($_GET);
	$_POST = format_magicQuotes($_POST);
	extract($_POST);

?>

<div id="main-right">
<div id="top-content">
	<div id="header-content">
		<h1><?=string_ucwords(system_showText(LANG_SITEMGR_MENU_SEARCH))?> <?=string_ucwords(system_showText(LANG_SITEMGR_PROMOTION_PLURAL))?></h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
		<?if (CUSTOM_PROMOTION_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>
		<? include(INCLUDES_DIR."/tables/table_promotion_submenu.php"); ?>

		<br />

		<? if ($search_submit && !$back) { ?>

			<a class="backToSearch" href="<?=$url_redirect."/search.php?".$_SERVER["QUERY_STRING"]?>&back=search"><?=system_showText(LANG_SITEMGR_MENU_BACKTOSEARCH);?></a>
			<div class="header-form" id="search_promotion">
				<?=string_ucwords(system_showText(LANG_SITEMGR_RESULTS))?>
			</div>
			
			<? if ($promotions) { ?>
				<? include(INCLUDES_DIR."/tables/table_promotion.php"); ?>
			<? } else { ?>
				<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
				<p class="errorMessage"><?=system_showText(LANG_SITEMGR_NORESULTS)?></p>
			<? } ?>


		<? } elseif ($back == "search" || string_strpos($_SERVER["PHP_SELF"], PROMOTION_FEATURE_FOLDER)) { ?>

			<div class="header-form" id="search_promotion">
				<?=string_ucwords(system_showText(LANG_SITEMGR_MENU_SEARCH))?>
			</div>
			<form name="promotion" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="get" id="search_promotion_form">
				<? include(INCLUDES_DIR."/forms/form_searchpromotion.php"); ?>
					<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="search_submit" value="Search" class="input-button-form"><?=string_ucwords(system_showText(LANG_SITEMGR_SEARCH))?></button>
						</td>
						<td>
							<button type="button" onclick="emptySearchAccount(); searchResetSitemgr(this.form);" class="input-button-form"><?=string_ucwords(system_showText(LANG_SITEMGR_CLEAR))?></button>
						</td>
					</tr>
				</table>
			</form>
		<? }
		} ?>

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