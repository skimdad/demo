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
	# * FILE: /members/event/view.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on" || CUSTOM_EVENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();

	extract($_GET);
	extract($_POST);
	
	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$event = new Event($id);
		if (sess_getAccountIdFromSession() != $event->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/members/".EVENT_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		}
	}
	else {
		header("Location: ".DEFAULT_URL."/members/".EVENT_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
		exit;
	}

	$level = new EventLevel();
	$eventImages = $level->getImages($event->getNumber("level"));
    
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

				<h2><?=system_showText(LANG_EVENT_DETAIL);?></h2>

				<ul class="list-view">
					<li class="list-back"><a href="javascript:history.back(-1);"><?=system_showText(LANG_LABEL_BACK);?></a></li>
				</ul>

				<h2 class="standardSubTitle" title="<?=$event->getString("title")?>"><?=system_showText(LANG_MANAGE_EVENT);?> - <?=$event->getString("title", true, 60);?></h2>

				<ul class="list-view">
					<li><a href="<?=DEFAULT_URL?>/members/<?=EVENT_FEATURE_FOLDER;?>/event.php?id=<?=$event->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>"><?=system_showText(LANG_LABEL_EDIT);?> <?=system_showText(LANG_LABEL_INFORMATION);?></a></li>
                    <li><a href="<?=DEFAULT_URL?>/members/<?=EVENT_FEATURE_FOLDER;?>/eventlevel.php?id=<?=$event->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>"> <?=system_showText(LANG_LABEL_EDIT);?> <?=system_showText(LANG_LABEL_LEVEL);?></a>
                    <span class="label-field-account"> ( <b> <?=($level->getName($event->getString('level')) ? $level->getName($event->getString('level')) : $level->getName($level->getDefaultLevel()))?> </b> ) </span> </li>
					<li><a href="<?=DEFAULT_URL?>/members/<?=EVENT_FEATURE_FOLDER;?>/delete.php?id=<?=$event->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>"><?=system_showText(LANG_EVENT_DELETE);?></a></li>
					<? if ((GOOGLE_MAPS_ENABLED == "on") && ($mapObj->getString("value") == "on") && (($event->getString("address")) || ($event->getNumber("location_3")) || ($event->getNumber("location_4"))  || ($event->getString("latitude") && $event->getString("longitude")))) { ?>
						<li><a href="<?=DEFAULT_URL?>/members/<?=EVENT_FEATURE_FOLDER;?>/maptuning.php?id=<?=$event->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>"><?=system_showText(LANG_LABEL_MAP_TUNING);?></a></li>
					<? } ?>
                    <li><a href="<?=DEFAULT_URL?>/members/<?=EVENT_FEATURE_FOLDER;?>/report.php?id=<?=$event->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>"> <?=string_ucwords(system_showText(LANG_TRAFFIC_REPORTS))?></a></span></li>
				</ul>

				<h2 class="standardSubTitle"><?=system_showText(LANG_EVENT_PREVIEW);?></h2>

				<center><a href="<?=DEFAULT_URL?>/members/<?=EVENT_FEATURE_FOLDER;?>/preview.php?id=<?=$event->getNumber("id")?>" class="standardLINK iframe fancy_window_preview"><?=system_showText(LANG_MSG_CLICK_TO_PREVIEW_THIS_EVENT);?></a></center>

			</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
