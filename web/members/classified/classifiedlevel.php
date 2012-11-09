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
	# * FILE: /members/classified/classifiedlevel.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on" || CUSTOM_CLASSIFIED_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_redirect = "".DEFAULT_URL."/members/".CLASSIFIED_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/members";
	$members = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$classified = new Classified($id);
		if (sess_getAccountIdFromSession() != $classified->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/members/".CLASSIFIED_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		}
		$classified->extract();
	}

	$levelObj = new ClassifiedLevel();
	if ($level) {
		$levelArray[$levelObj->getLevel($level)] = $level;
	} else {
		$levelArray[$levelObj->getLevel($levelObj->getDefaultLevel())] = $levelObj->getDefaultLevel();
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if (($id) && ($classified)) {
			if ($_POST["level"] && ($_POST["level"] != $classified->getNumber("level"))) {
				$status = new ItemStatus();
				$classified->setString("status", $status->getDefaultStatus());
				$classified->setDate("renewal_date", "00/00/0000");
			}
			$classified->setString("level", $_POST['level']);
			$classified->Save();
			header("Location: ".DEFAULT_URL."/members/".CLASSIFIED_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		} else {
			/*
			 * Check if exists package
			 */
			$packageObj = new Package();
			$array_package_offers = $packageObj->getPackagesByDomainID(SELECTED_DOMAIN_ID, "classified", $_POST["level"]);
			if ((is_array($array_package_offers)) and (count($array_package_offers)>0) and $array_package_offers[0]) {
				header("Location: ".DEFAULT_URL."/members/".CLASSIFIED_FEATURE_FOLDER."/order_package.php?level=".$_POST["level"]);
			}else{
				header("Location: ".DEFAULT_URL."/members/".CLASSIFIED_FEATURE_FOLDER."/classified.php?level=".$_POST["level"]);
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

		<h2><?=system_showText(LANG_CLASSIFIED_LEVEL)?> <? if (($classified) && ($classified->getString("title"))) echo "- ".$classified->getString("title"); ?></h2>

		<form name="classifiedlevel" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?=$id?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />
			<input type="hidden" name="letter" value="<?=$letter?>" />
			<? include(INCLUDES_DIR."/forms/form_classifiedlevel.php"); ?>
		</form>

		<form action="<?=DEFAULT_URL?>/members/<?=CLASSIFIED_FEATURE_FOLDER;?>/index.php" method="post">

			<input type="hidden" name="screen" value="<?=$screen?>" />
			<input type="hidden" name="letter" value="<?=$letter?>" />
			
			<div class="baseButtons">

				<p class="standardButton">
					<button type="button" onclick="document.classifiedlevel.submit();"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
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
