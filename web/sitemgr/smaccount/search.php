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
	# * FILE: /sitemgr/smaccount/search.php
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

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	//increases frequently actions
	if (!isset($search_username)) system_setFreqActions('smaccount_search','smaaccount');

	// Page Browsing ////////////////////////////////////////

	if ($search_username) $sql_where[] = " username like ".db_formatString('%'.$search_username.'%')." ";
	if ($sql_where)       $where .= " ".implode(" AND ", $sql_where)." ";

	$_GET["search_page"] = "1";
	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	$pageObj  = new pageBrowsing("SMAccount", $screen, RESULTS_PER_PAGE, "username", "", "", $where, "*", false, false, true);

	$smaccounts = $pageObj->retrievePage();

	$paging_url = DEFAULT_URL."/sitemgr/smaccount/search.php";

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

	$_GET = format_magicQuotes($_GET);
	extract($_GET);
	$_POST = format_magicQuotes($_POST);
	extract($_POST);

?>

<div id="main-right">
<div id="top-content">
	<div id="header-content">
		<h1><?=system_showText(LANG_SITEMGR_SEARCH)?> <?=system_showText(LANG_SITEMGR_NAVBAR_SITEMGRACCOUNTS)?></h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<? include(INCLUDES_DIR."/tables/table_smaccount_submenu.php"); ?>
		<br />
		<form name="smaccount" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="get">
			<? include(INCLUDES_DIR."/forms/form_searchsmaccount.php"); ?>
				<table style="margin: 0 auto 0 auto;">
				<tr>
					<td>
						<button type="submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SEARCH)?></button>
					</td>
					<td>
						<button type="button" onclick="searchResetSitemgr(this.form);" class="input-button-form"><?=system_showText(LANG_SITEMGR_CLEAR)?></button>
					</td>
				</tr>
			</table>
		</form>
			<div class="header-form">
				<?=system_showText(LANG_SITEMGR_RESULTS)?>
			</div>
			<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
			<? if ($smaccounts) { ?>
				<? include(INCLUDES_DIR."/tables/table_smaccount.php"); ?>
			<? } else { ?>
				<p class="errorMessage">
					<?=system_showText(LANG_SITEMGR_NORESULTS)?>
				</p>
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