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
	# * FILE: /members/listing/report.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_base = "".DEFAULT_URL."/members";

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

    # ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$listing = new Listing($id);
		if (sess_getAccountIdFromSession() != $listing->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
		exit;
	}

    $listingLevel = new ListingLevel();
    $levelName = string_ucwords($listingLevel->getName($listing->getNumber('level')));
    
    $status = new ItemStatus();
    $statusName = $status->getStatus($listing->getString('status'));

    # ----------------------------------------------------------------------------------------------------
    # REPORT DATA
    # ----------------------------------------------------------------------------------------------------
    $reports = retrieveListingReport($id);

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

				<h2><?=system_showText(LANG_LISTING_TRAFFIC_REPORT)?> - <?=$listing->getString("title")?></h2>

					<? if ($reports) { ?>
						<? include(INCLUDES_DIR."/tables/table_listing_reports.php"); ?>
					<? } else { ?>
						<p class="informationMessage"><?=system_showText(LANG_NO_REPORTS)?></p>
					<? } ?>

			</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>