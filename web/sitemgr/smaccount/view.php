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
	# * FILE: /sitemgr/smaccount/view.php
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

	extract($_GET);
	extract($_POST);

	$url_redirect = "".DEFAULT_URL."/sitemgr/smaccount";
	$url_base = "".DEFAULT_URL."/sitemgr";

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$account = new SMAccount($id);
	} else {
		header("Location: ".DEFAULT_URL."/sitemgr/smaccount/".(($search_page) ? "search.php" : "index.php")."?screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
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
		<h1><?=system_showText(LANG_SITEMGR_SMACCOUNT_ACCOUNTDETAIL)?></h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

	<? if($account->getString("id") == 0){ ?>

		<p class="errorMessage"><?=system_showText(LANG_SITEMGR_SMACCOUNT_ITMIGHTBEDELETED)?></p>

	<? } else { ?>

		<? include(INCLUDES_DIR."/tables/table_smaccount_submenu.php"); ?>

		<br />

		<div id="header-view"><?=system_showText(LANG_SITEMGR_SMACCOUNT_MANAGEACCOUNTINFORMATION)?></div>

		<div>
			<ul class="list-view">
				<li>
					<a href="<?=DEFAULT_URL?>/sitemgr/smaccount/smaccount.php?id=<?=$account->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view">
						<?=system_showText(LANG_SITEMGR_SMACCOUNT_EDITACCOUNTINFORMATION)?>
					</a>
				</li>
				<? if ($account->getNumber("id") != $_SESSION[SESS_SM_ID]) { ?>
				<li>
					<a href="<?=DEFAULT_URL?>/sitemgr/smaccount/delete.php?id=<?=$account->getNumber("id")?>" class="link-view">
						<?=system_showText(LANG_SITEMGR_DELETE_SMACCOUNT)?>
					</a>
				</li>
				<? } ?>
			</ul>
		</div>

		<? include(INCLUDES_DIR."/views/view_smaccount.php"); ?>

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
