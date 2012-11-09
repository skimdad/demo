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
	# * FILE: /members/classified/view.php
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
	$errorPage = "".DEFAULT_URL."/members/".CLASSIFIED_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter";
	if ($id) {
		$classified = new Classified($id);
		if ((!$classified->getNumber("id")) || ($classified->getNumber("id") <= 0)) {
			header("Location: ".$errorPage);
			exit;
		}
		if (sess_getAccountIdFromSession() != $classified->getNumber("account_id")) {
			header("Location: ".$errorPage);
			exit;
		}
	} else {
		header("Location: ".$errorPage);
		exit;
	}

	$account = new Account($classified->getNumber("account_id"));

	$level = new ClassifiedLevel();
	$classifiedImages = $level->getImages($classified->getNumber("level"));
    
    $mapObj = new GoogleSettings(GOOGLE_MAPS_STATUS);

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

		<h2><?=system_showText(LANG_CLASSIFIED_DETAIL);?></h2>

		<ul class="list-view">
			<li class="list-back"><a href="javascript:history.back(-1);"><?=system_showText(LANG_LABEL_BACK);?></a></li>
		</ul>

		<? if($classified->getString("id") == 0){ ?>
			<p class="errorMessage"><?=system_showText(LANG_NO_CLASSIFIED_FOUND);?></p>
		<? } else { ?>

			<h2 class="standardSubTitle" title="<?=$classified->getString("title")?>"><?=system_showText(LANG_MANAGE_CLASSIFIED);?> - <?=$classified->getString("title", true, 60);?></h2>

			<ul class="list-view">
				<li><a href="<?=DEFAULT_URL?>/members/<?=CLASSIFIED_FEATURE_FOLDER;?>/classified.php?id=<?=$classified->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>"><?=system_showText(LANG_LABEL_EDIT);?> <?=system_showText(LANG_LABEL_INFORMATION);?></a></li>
				<li><a href="<?=DEFAULT_URL?>/members/<?=CLASSIFIED_FEATURE_FOLDER;?>/classifiedlevel.php?id=<?=$classified->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>"><?=system_showText(LANG_LABEL_EDIT);?> <?=system_showText(LANG_LABEL_LEVEL);?></a>
                <span class="label-field-account"> ( <b> <?=($level->getName($classified->getString('level')) ? $level->getName($classified->getString('level')) : $level->getName($level->getDefaultLevel()))?> </b> ) </span> </li>
				<li><a href="<?=DEFAULT_URL?>/members/<?=CLASSIFIED_FEATURE_FOLDER;?>/delete.php?id=<?=$classified->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>" class="link-view"><?=system_showText(LANG_CLASSIFIED_DELETE);?></a></li>
				<? if ((GOOGLE_MAPS_ENABLED == "on") && ($mapObj->getString("value") == "on") && (($classified->getString("address")) || ($classified->getNumber("location_3")) || ($classified->getNumber("location_4")  || ($classified->getString("latitude") && $classified->getString("longitude"))))) { ?>
					<li><a href="<?=DEFAULT_URL?>/members/<?=CLASSIFIED_FEATURE_FOLDER;?>/maptuning.php?id=<?=$classified->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>"><?=system_showText(LANG_LABEL_MAP_TUNING);?></a></li>
				<? } ?>
                <li><a href="<?=DEFAULT_URL?>/members/<?=CLASSIFIED_FEATURE_FOLDER;?>/report.php?id=<?=$classified->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>"> <?=string_ucwords(system_showText(LANG_TRAFFIC_REPORTS))?></a></li>

			</ul>

			<h2 class="standardSubTitle"><?=system_showText(LANG_CLASSIFIED_PREVIEW);?></h2>
			<center>
				<a href="<?=DEFAULT_URL?>/members/<?=CLASSIFIED_FEATURE_FOLDER;?>/preview.php?id=<?=$classified->getNumber("id")?>" class="standardLINK iframe fancy_window_preview"><?=system_showText(LANG_MSG_CLICK_TO_PREVIEW_THIS_CLASSIFIED);?></a>
			</center>

		<? } ?>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
