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
	# * FILE: /sitemgr/package/search.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/sitemgr/package";
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	$_GET = format_magicQuotes($_GET);
	extract($_GET);
	$_POST = format_magicQuotes($_POST);
	extract($_POST);

	//increases frequently actions
	if (!isset($acct_search_field_name)) system_setFreqActions('package_search','package_search');

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	##################################################################################################################################
	# STATUS
	##################################################################################################################################
	// Status Drop Down
	$statusObj = new ItemStatus();
	unset($arrayValue);
	unset($arrayName);
	$arrayValue = $statusObj->getValues();
	$arrayName = $statusObj->getNames();
	unset($arrayValueDD);
	unset($arrayNameDD);
	for ($i=0; $i<count($arrayValue); $i++) {
		if ($arrayValue[$i] != "E" && $arrayValue[$i] != "P") {
			$arrayValueDD[] = string_ucwords($arrayValue[$i]);
			$arrayNameDD[] = string_ucwords($arrayName[$i]);
		}
	}
	$statusDropDown = html_selectBox("search_status", $arrayNameDD, $arrayValueDD,"", "", "", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");

	if ($search_title) $sql_where[] = " title LIKE '%$search_title%' ";
	if ($search_status) $sql_where[] = " status = '$search_status' ";

	if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";
	
	# ----------------------------------------------------------------------------------------------------
	# PAGE BROWSING
	# ----------------------------------------------------------------------------------------------------
	
	$_GET["search_page"] = "1";
	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	$paging_url = DEFAULT_URL."/sitemgr/package/search.php";

	if (!$error_message && !$error_msg) {
		if ($_POST["screen"]) {
			$screen = $_POST["screen"];
		} 
	}

	$pageObj = new pageBrowsing("Package", $screen, RESULTS_PER_PAGE, "title", "title", $letter, $where, "*", false, false, true);
	$packages = $pageObj->retrievePage("object");


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
			<h1><?=string_ucwords(system_showText(LANG_SITEMGR_MENU_SEARCH))?> <?=system_showText(LANG_SITEMGR_PACKAGE_PLURAL)?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

				<? include(INCLUDES_DIR."/tables/table_package_submenu.php"); ?>

				<br />

				<? if ($search_submit && !$back) { ?>

					<a class="backToSearch" href="<?=$url_redirect."/search.php?".$_SERVER["QUERY_STRING"]?>&back=search"><?=system_showText(LANG_SITEMGR_MENU_BACKTOSEARCH);?></a>
					<div class="header-form" id="search_package" >
						<?=string_ucwords(system_showText(LANG_SITEMGR_RESULTS))?>
					</div>
					<? if ($packages) { ?>
						<? include(INCLUDES_DIR."/tables/table_package.php"); ?>
					<? } else { ?>
                        <? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
						<p class="errorMessage"><?=system_showText(LANG_SITEMGR_NORESULTS)?></p>
					<? } ?>

				<? } elseif ($back == "search" || string_strpos($_SERVER["PHP_SELF"], "package")) { ?>

					<div class="header-form" id="search_package" >
						<?=string_ucwords(system_showText(LANG_SITEMGR_MENU_SEARCH))?>
					</div>
					<form name="package" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="get" id="search_package_form">

						<? include(INCLUDES_DIR."/forms/form_searchpackage.php"); ?>

						<table style="margin: 0 auto 0 auto;">
							<tr>
								<td>
									<button type="submit" name="search_submit" value="Search" class="input-button-form"><?=system_showText(LANG_SITEMGR_SEARCH)?></button>
								</td>
								<td>
									<button type="button" value="Clear" onclick="searchResetSitemgr(this.form);" class="input-button-form"><?=system_showText(LANG_SITEMGR_CLEAR)?></button>
								</td>
							</tr>
						</table>

					</form>
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