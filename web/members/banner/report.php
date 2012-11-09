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
	# * FILE: /members/banner/report.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BANNER_FEATURE != "on" || CUSTOM_BANNER_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_base = "".DEFAULT_URL."/members";
	$url_redirect = $url_base."/".BANNER_FEATURE_FOLDER;
	$members = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$banner = new Banner($id);
		if (sess_getAccountIdFromSession() != $banner->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/members/".BANNER_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/members/".BANNER_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
		exit;
	}

    # ----------------------------------------------------------------------------------------------------
    # OBJECTS
    # ----------------------------------------------------------------------------------------------------

    $bannerLevel = new BannerLevel();
    $levelName = string_ucwords($bannerLevel->getName($banner->getNumber('level')));
    
    $status = new ItemStatus();
    $statusName = $status->getStatus($banner->getString('status'));

    # ----------------------------------------------------------------------------------------------------
    # REPORT DATA
    # ----------------------------------------------------------------------------------------------------
    $reports = retrieveBannerReport($id);

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

?>

	<div class="content">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<h2><?=system_showText(LANG_BANNER_TRAFFIC_REPORT)?> - <?=$banner->getString("caption")?></h2>

		<? if ($_GET["message"]) { ?>
		<p class="informationMessage"><?=urldecode($_GET["message"])?></p>
		<? } ?>

		<? if ($reports) { ?>
				<? include(INCLUDES_DIR."/tables/table_banner_reports.php"); ?>
		<? } else { ?>
			<p class="informationMessage">
				<?=system_showText(LANG_NO_REPORTS)?>
			</p>
		<? } ?>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
