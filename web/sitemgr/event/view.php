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
	# * FILE: /sitemgr/event/view.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/sitemgr/".EVENT_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$event = new Event($id);
		if ((!$event->getNumber("id")) || ($event->getNumber("id") <= 0)) {
			header("Location: ".DEFAULT_URL."/sitemgr/".EVENT_FEATURE_FOLDER."/index.php?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;
		}
		if ($event->getNumber("account_id")) $account = new Account($event->getNumber("account_id"));
	} else {
		header("Location: ".DEFAULT_URL."/sitemgr/".EVENT_FEATURE_FOLDER."/index.php?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

	$level = new EventLevel();
	$eventImages = $level->getImages($event->getNumber("level"));
    
    $mapObj = new GoogleSettings(GOOGLE_MAPS_STATUS);

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
		<h1><?=system_showText(LANG_SITEMGR_EVENT_SING)?> - <?=string_ucwords(system_showText(LANG_SITEMGR_DETAIL))?></h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
		<?if (CUSTOM_EVENT_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>
		<? include(INCLUDES_DIR."/tables/table_event_submenu.php"); ?>

		<br />
		<div id="header-view" title="<?=$event->getString("title")?>">
			<?=string_ucwords(system_showText(LANG_SITEMGR_MANAGE))?> <?=system_showText(LANG_SITEMGR_EVENT_SING)?> - <?=$event->getString("title", true, 35);?>
		</div>
		<ul class="list-view columnListView">
		  <li>
				<a href="<?=DEFAULT_URL?>/sitemgr/<?=EVENT_FEATURE_FOLDER;?>/event.php?id=<?=$event->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view">
					<?=string_ucwords(system_showText(LANG_SITEMGR_EDIT))?> <?=LANG_SITEMGR_INFORMATION;?>
				</a>
			</li>
            <li>
                <a href="<?=DEFAULT_URL?>/sitemgr/<?=EVENT_FEATURE_FOLDER;?>/settings.php?id=<?=$event->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view">
                   <?=string_ucwords(system_showText(LANG_SITEMGR_LABEL_CHANGE_EVENT_STATUS))?>
                </a>
            </li>
            <li>
                <a href="<?=DEFAULT_URL?>/sitemgr/<?=EVENT_FEATURE_FOLDER;?>/eventlevel.php?id=<?=$event->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view"><?=string_ucwords(system_showText(LANG_SITEMGR_EDIT))?> <?=string_ucwords(system_showText(LANG_SITEMGR_LEVEL))?></a>
                <span class="label-field-account"> ( <b> <?=($level->getName($event->getString('level')) ? $level->getName($event->getString('level')) : $level->getName($level->getDefaultLevel()))?> </b> ) </span>
            </li>	
			<li>
				<a href="<?=DEFAULT_URL?>/sitemgr/<?=EVENT_FEATURE_FOLDER;?>/delete.php?id=<?=$event->getNumber("id")?>" class="link-view">
					<?=string_ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=LANG_SITEMGR_EVENT_SING;?>
				</a>
			</li>
            <li>
                <? if (!$account) { ?>
                    <em><?=system_showText(LANG_SITEMGR_NOOWNER)?></em>
                <? } else { ?>
                    <a href="<?=DEFAULT_URL?>/sitemgr/account/view.php?id=<?=$event->getNumber("account_id")?>" class="link-view"> <?=string_ucwords(system_showText(LANG_SITEMGR_LABEL_ACCOUNT))?></a>:
                    <span class="label-field-account" title="<?=$account->getString("username");?>"> ( <b><?=system_showTruncatedText(system_showAccountUserName($account->getString("username")), 50);?></b> ) </span>
                <? } ?>
            </li>
			<? if ((GOOGLE_MAPS_ENABLED == "on") && ($mapObj->getString("value") == "on") && (($event->getString("address")) || ($event->getNumber("location_3")) || ($event->getNumber("location_4")  || ($event->getString("latitude") && $event->getString("longitude"))))) { ?>
			    <li>
				    <a href="<?=DEFAULT_URL?>/sitemgr/<?=EVENT_FEATURE_FOLDER;?>/maptuning.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view">
					    <?=string_ucwords(system_showText(LANG_SITEMGR_MAPTUNING))?>
				    </a>
			    </li>
			<? } ?>
		</ul>
        
        <ul class="list-view columnListView secondaryListView">
            <li><span class="traffic"><a href="<?=DEFAULT_URL?>/sitemgr/<?=EVENT_FEATURE_FOLDER;?>/report.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>"> <?=string_ucwords(system_showText(LANG_SITEMGR_TRAFFICREPORTS))?></a></span></li>
            <li><strong><?=system_showText(LANG_SITEMGR_LASTUPDATED)?>:</strong> <span class="label-field-account"><?=format_date($event->getNumber("updated"),DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($event->getNumber("updated"))?></span></li>
            <li><strong><?=system_showText(LANG_SITEMGR_DATECREATED)?>:</strong> <span class="label-field-account"><?=format_date($event->getNumber("entered"),DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($event->getNumber("entered"))?></span></li>
        </ul>
        
        <br class="clear" />

		<div id="header-view"><?=LANG_SITEMGR_EVENT_SING;?> <?=string_ucwords(system_showText(LANG_SITEMGR_PREVIEW))?></div>
		<center>
			<a href="<?=DEFAULT_URL?>/sitemgr/<?=EVENT_FEATURE_FOLDER;?>/preview.php?id=<?=$event->getNumber("id")?>" class="standardLINK iframe fancy_window_preview"><?=system_showText(LANG_SITEMGR_CLICKHERETOPREVIEW)?> <?=system_showText(LANG_SITEMGR_EVENT)?></a>
		</center>
		<? } ?>
	</div>
</div>
<div id="bottom-content">
	&nbsp;
</div>
</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>