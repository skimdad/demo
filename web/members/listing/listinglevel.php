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
	# * FILE: /members/listing/listinglevel.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();

	extract($_GET);
	extract($_POST);

	$url_redirect = "".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/members";
	$members = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$listing = new Listing($id);
		if (sess_getAccountIdFromSession() != $listing->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		}
		$listing->extract();
	}

	extract($_POST);
	extract($_GET);

	$levelObj = new ListingLevel();
	if ($level) {
		$levelArray[$levelObj->getLevel($level)] = $level;
	} else {
		$levelArray[$levelObj->getLevel($levelObj->getDefaultLevel())] = $levelObj->getDefaultLevel();
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if (($id) && ($listing)) {
			if ($_POST["level"] && ($_POST["level"] != $listing->getNumber("level"))) {
				$status = new ItemStatus();
				$listing->setString("status", $status->getDefaultStatus());
				$listing->setDate("renewal_date", "00/00/0000");
			}
			$listing->setString("level", $_POST["level"]);
			$listing->setNumber("listingtemplate_id", $_POST["listingtemplate_id"]);
			$listing->Save();
			header("Location: ".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		} else {
			
			/*
			 * Check if exists package
			 */
			$packageObj = new Package();
			$array_package_offers = $packageObj->getPackagesByDomainID(SELECTED_DOMAIN_ID, "listing", $_POST["level"]);
			if ((is_array($array_package_offers)) and (count($array_package_offers)>0) and $array_package_offers[0]) {
				header("Location: ".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER."/order_package.php?level=".$_POST["level"]."&listingtemplate_id=".$_POST["listingtemplate_id"]);
			}else{
				header("Location: ".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER."/listing.php?level=".$_POST["level"]."&listingtemplate_id=".$_POST["listingtemplate_id"]);
			}
			exit;
		}
	}

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

				<h2><?=system_showText(LANG_LISTING_LEVEL);?> <? if (($listing) && ($listing->getString("title"))) echo "- ".$listing->getString("title"); ?></h2>

				<form name="listinglevel" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?=$id?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />
					<input type="hidden" name="letter" value="<?=$letter?>" />
					<? include(INCLUDES_DIR."/forms/form_listinglevel.php"); ?>
				</form>

				<form action="<?=DEFAULT_URL?>/members/<?=LISTING_FEATURE_FOLDER;?>/index.php" method="post">

					<input type="hidden" name="screen" value="<?=$screen?>" />
					<input type="hidden" name="letter" value="<?=$letter?>" />
					
					<div class="baseButtons">

						<p class="standardButton">
							<button type="button" onclick="document.listinglevel.submit();"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
						</p>
						<p class="standardButton">
							<button type="submit"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
						</p>
					
					</div>

				</form>

			</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>