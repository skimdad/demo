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
	# * FILE: /sitemgr/banner/delete.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BANNER_FEATURE != "on") { exit; }

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

	$url_redirect = "".DEFAULT_URL."/sitemgr/".BANNER_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	include(EDIRECTORY_ROOT."/includes/code/banner.php");

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
			<h1 class="highlight"><?=string_ucwords(system_showText(LANG_SITEMGR_BANNER))?> <?=string_ucwords(system_showText(LANG_SITEMGR_INFORMATION))?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<div class="header-form">
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
				<?=string_ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=string_ucwords(system_showText(LANG_SITEMGR_BANNER))?> - <?=$banner->getString("caption")?>
			</div>
			<?if (CUSTOM_BANNER_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>
			<div class="baseForm">

			<form name="banner" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				<input type="hidden" name="id" value="<?=$id?>" />
				<input type="hidden" name="operation" value="delete" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />

				<p class="informationMessage"><?=system_showText(LANG_SITEMGR_BANNER_DELETEQUESTION)?></p>

				<button type="submit" name="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_CONFIRM)?></button>
				<button type="button" value="Cancel" class="input-button-form" onclick="document.getElementById('formbannerdeletecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button></li>

			</form>
			<form  id="formbannerdeletecancel"action="<?=DEFAULT_URL?>/sitemgr/<?=BANNER_FEATURE_FOLDER;?>/<?=(($search_page) ? "search.php" : "index.php")?>" method="post" style="margin: 0; padding: 0;">

				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />

			</form>
			
			</div>
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
