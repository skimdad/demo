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
	# * FILE: /sitemgr/content/member.php
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
	extract($_POST);
	extract($_GET);

	//increases frequently actions
	if (!isset($message)) system_setFreqActions('content_member','content');
    
    $where_clause = "section = 'member'";
    
    # ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	
	$promoLevelListing = new ListingLevel();
	$levels_all = $promoLevelListing->getLevelValues();
	foreach ($levels_all as $level_each) {
		if ( $promoLevelListing->getHasPromotion($level_each) == 'y' ) $hasPromotion = true;
	}
	if ( PROMOTION_FEATURE != 'on' || CUSTOM_PROMOTION_FEATURE != "on" ) $where_clause .= " AND `type` NOT LIKE '%deal%' ";
	elseif ( !$hasPromotion ) $where_clause .= " AND `type` NOT LIKE '%deal%' ";
    
    if ( ARTICLE_FEATURE != 'on' || CUSTOM_ARTICLE_FEATURE != "on" ) $where_clause .= " AND `type` NOT LIKE '%article%' ";
    if ( CLASSIFIED_FEATURE != 'on' || CUSTOM_CLASSIFIED_FEATURE != "on" ) $where_clause .= " AND `type` NOT LIKE '%classified%' ";
    if ( EVENT_FEATURE != 'on' || CUSTOM_EVENT_FEATURE != "on" ) $where_clause .= " AND `type` NOT LIKE '%event%' ";

	# ----------------------------------------------------------------------------------------------------
	# PAGE BROWSING
	# ----------------------------------------------------------------------------------------------------
	$pageObj  = new pageBrowsing("Content", $screen, 25, "id", "id", $letter, $where_clause);
	$contents = $pageObj->retrievePage();

	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$paging_url = DEFAULT_URL."/sitemgr/content/member.php";
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
			<h1><?=string_ucwords(system_showText(LANG_SITEMGR_CONTENT_MANAGECONTENT))?> - <?=string_ucwords(system_showText(LANG_SITEMGR_MEMBERS))?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_content_submenu.php"); ?>
			<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
			<? include(INCLUDES_DIR."/tables/table_content.php"); ?>

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
