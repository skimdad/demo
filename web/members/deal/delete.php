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
	# * FILE: /members/deal/delete.php
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
	if ( PROMOTION_FEATURE != 'on' || CUSTOM_PROMOTION_FEATURE != "on") exit;
	elseif ( !$hasPromotion ) exit;
	
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	
	if (!system_enableDealForUser(sess_getAccountIdFromSession())){
		exit; 	
	}

	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$promotion = new Promotion($id);
		if (sess_getAccountIdFromSession() != $promotion->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/members/".PROMOTION_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		}
	}
	else {
		header("Location: ".DEFAULT_URL."/members/".PROMOTION_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$promotion = new Promotion($_POST['id']);
		$promotion->delete();
		$message = 4;
		header("Location: ".DEFAULT_URL."/members/".PROMOTION_FEATURE_FOLDER."/index.php?message=$message&screen=$screen&letter=$letter");
		exit;
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

				<h2><?=system_showText(LANG_PROMOTION_DELETE);?></h2>

				<form title="promotion" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				<input type="hidden" name="id" value="<?=$id?>" />
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />

					<p> <?=system_showText(LANG_PROMOTION_DELETE_INFORMATION);?> - <strong><?=$promotion->getString("name")?></strong></p>

					<p class="informationMessage"><?=system_showText(LANG_PROMOTION_DELETE_CONFIRM)?></p>
					
					<div class="baseButtons floatButtons">

						<p class="standardButton">
							<button type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
						</p>
						
					</div>

				</form>
				<form action="<?=DEFAULT_URL?>/members/<?=PROMOTION_FEATURE_FOLDER;?>/index.php" method="get">
					<input type="hidden" name="letter" value="<?=$letter?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />
					
					<div class="baseButtons floatButtons noPadding">

						<p class="standardButton">
							<button type="submit" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
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
