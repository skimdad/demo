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
	# * FILE: /members/banner/view.php
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

	$operation = "view";

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

				<h2><?=system_showText(LANG_VIEW_BANNER);?></h2>

				<ul class="list-view">
					<li class="list-back"><a href="javascript:history.back(-1);"><?=system_showText(LANG_LABEL_BACK);?></a></li>
				</ul>

				<h2 class="standardSubTitle"><?=system_showText(LANG_MANAGE_BANNER);?> - <?=$banner->getString("caption")?></h2>

				<ul class="list-view">
					<? $bannerObj = new Banner($id); ?>
					<li><a href="<?=DEFAULT_URL?>/members/<?=BANNER_FEATURE_FOLDER;?>/edit.php?id=<?=$bannerObj->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>"> <?=system_showText(LANG_LABEL_EDIT);?> <?=system_showText(LANG_LABEL_INFORMATION);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/members/<?=BANNER_FEATURE_FOLDER;?>/delete.php?id=<?=$bannerObj->getNumber("id")?>" class="link-view"><?=system_showText(LANG_BANNER_DELETE);?></a></li>
                    <li><a href="<?=DEFAULT_URL?>/members/<?=BANNER_FEATURE_FOLDER;?>/report.php?id=<?=$bannerObj->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>"> <?=string_ucwords(system_showText(LANG_TRAFFIC_REPORTS))?></a></span></li>
				</ul>

				<h2 class="standardSubTitle" style="margin-bottom: 10px;"><?=system_showText(LANG_BANNER_PREVIEW);?></h2>
				<?
				$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
				$array_edir_languages = explode(",", EDIR_LANGUAGES);
				for ($i=0; $i<count($array_edir_languages); $i++) {
					$labelsuffix = "";
					if ($i) $labelsuffix = $i;
					?>
					<center>
						<a href="<?=DEFAULT_URL?>/members/<?=BANNER_FEATURE_FOLDER;?>/preview.php?id=<?=$bannerObj->getNumber("id")?>&lang=<?=$array_edir_languages[$i]?>" class="standardLINK iframe fancy_window_preview_small"><?=system_showText(LANG_MSG_CLICK_TO_PREVIEW_THIS_BANNER);?><?=((count(explode(",", EDIR_LANGUAGES))>1)?(" (".$array_edir_languagenames[$i].")"):(""));?></a>
					</center>
					<?
				}
				?>

			</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>