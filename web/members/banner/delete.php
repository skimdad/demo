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
	# * FILE: /members/banner/delete.php
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
	# CODE
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$banner = new Banner($id);
		if (sess_getAccountIdFromSession() != $banner->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/members/".BANNER_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		}
	}
	else {
		header("Location: ".DEFAULT_URL."/members/".BANNER_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
		exit;
	}

	include(EDIRECTORY_ROOT."/includes/code/banner.php");

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

		<h2><?=system_showText(LANG_BANNER_DELETE)?></h2>

		<?
			$langIndex = language_getIndex(EDIR_LANGUAGE);
			$arrLangs = explode(",", EDIR_LANGUAGENUMBERS);
			$endExpr = ")";

			if (count($arrLangs) > 1) {
				$fields = "id, type, status, account_id, expiration_setting, renewal_date, impressions, ";
				$fields .= "IF (`caption".$langIndex."` != '', `caption".$langIndex."`, ";
				foreach ($arrLangs as $lang) {
					if ($langIndex != $lang) {
						$fields .= "IF (`caption".$lang."` != '', `caption".$lang."`, ";
						$endExpr .= ")";
					}
				}

				$fields .= "''".$endExpr." AS `caption`";
			} else {
				$fields = "`id`, `type`, `status`, `account_id`, `expiration_setting`, `renewal_date`, `impressions`, `caption".$langIndex."` AS `caption`";
			}
			$banner = db_getFromDB("banner", "id", $id, 1, "", "object", SELECTED_DOMAIN_ID, false, $fields);
		?>
		<p><?=system_showText(LANG_BANNER_DELETE_INFORMATION)?> - <strong><?=$banner->getString("caption")?></strong></p>

		<p class="informationMessage"><?=system_showText(LANG_BANNER_DELETE_CONFIRM)?></p>
		
		<div class="baseButtons">

		<form title="banner" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

			<input type="hidden" name="id" value="<?=$id?>" />
			<input type="hidden" name="operation" value="delete" />
			<input type="hidden" name="letter" value="<?=$letter?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />

				<p class="standardButton">
					<button type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
				</p>

		</form>
		<form action="<?=DEFAULT_URL?>/members/<?=BANNER_FEATURE_FOLDER;?>/index.php" method="post">
			<input type="hidden" name="letter" value="<?=$letter?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />

				<p class="standardButton">
					<button type="submit" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
				</p>

		</form>
		
		</div>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>