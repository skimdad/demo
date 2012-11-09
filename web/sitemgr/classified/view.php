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
	# * FILE: /sitemgr/classified/view.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/sitemgr/".CLASSIFIED_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$errorPage = DEFAULT_URL."/sitemgr/".CLASSIFIED_FEATURE_FOLDER."/index.php?message=".$message."&screen=$screen&letter=$letter";
	if ($id) {
		$classified = new Classified($id);
		if ((!$classified->getNumber("id")) || ($classified->getNumber("id") <= 0)) {
			header("Location: ".$errorPage);
			exit;
		}
	} else {
		header("Location: ".$errorPage);
		exit;
	}

	if ($classified->getNumber("account_id")) $account = new Account($classified->getNumber("account_id"));

	$level = new ClassifiedLevel();
	$classifiedImages = $level->getImages($classified->getNumber("level"));
    
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
			<h1><?=system_showText(LANG_SITEMGR_CLASSIFIED_SING)?> - <?=string_ucwords(system_showText(LANG_SITEMGR_DETAIL))?></h1>
		</div>
	</div>
	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
			<?if (CUSTOM_CLASSIFIED_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>
			<? if($classified->getString("id") == 0){ ?>
				<p class="errorMessage"> <?=system_showText(LANG_SITEMGR_CLASSIFIED_MIGHTBEDELETED)?></p>
			<? } else { ?>

				<? include(INCLUDES_DIR."/tables/table_classified_submenu.php"); ?>

				<br />
				<div id="header-view" title="<?=$classified->getString("title")?>"><?=system_showText(LANG_SITEMGR_MANAGE)?> <?=system_showText(LANG_SITEMGR_CLASSIFIED_SING)?> - <?=$classified->getString("title", true, 35);?></div>
				
                <ul class="list-view columnListView">

					<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=CLASSIFIED_FEATURE_FOLDER;?>/classified.php?id=<?=$classified->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>" class="link-view"><?=system_showText(LANG_SITEMGR_EDIT)?> <?=ucfirst(system_showText(LANG_SITEMGR_INFORMATION))?></a></li>
					<li>
                        <a href="<?=DEFAULT_URL?>/sitemgr/<?=CLASSIFIED_FEATURE_FOLDER;?>/settings.php?id=<?=$classified->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>" class="link-view"> <?=string_ucwords(system_showText(LANG_SITEMGR_LABEL_CHANGE_CLASSIFIED_STATUS))?></a>
                    </li>
                    <li><a href="<?=DEFAULT_URL?>/sitemgr/<?=CLASSIFIED_FEATURE_FOLDER;?>/classifiedlevel.php?id=<?=$classified->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>" class="link-view"><?=system_showText(LANG_SITEMGR_EDIT)?> <?=system_showText(LANG_SITEMGR_LEVEL)?></a>
                    <span class="label-field-account"> ( <b> <?=($level->getName($classified->getString('level')) ? $level->getName($classified->getString('level')) : $level->getName($level->getDefaultLevel()))?> </b> ) </span>
					<li>
						<a href="<?=DEFAULT_URL?>/sitemgr/<?=CLASSIFIED_FEATURE_FOLDER;?>/delete.php?id=<?=$classified->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>" class="link-view"><?=system_showText(LANG_SITEMGR_DELETE)?> <?=system_showText(LANG_SITEMGR_CLASSIFIED_SING)?></a>
					</li>
                    <li>
                        <? if (!$account) { ?>
                            <em><?=system_showText(LANG_SITEMGR_NOOWNER)?></em>
                        <? } else { ?>
                            <a href="<?=DEFAULT_URL?>/sitemgr/account/view.php?id=<?=$classified->getNumber("account_id")?>" class="link-view"><?=system_showText(LANG_SITEMGR_LABEL_ACCOUNT)?></a>:
							<span class="label-field-account" title="<?=$account->getString("username");?>"> ( <b><?=system_showTruncatedText(system_showAccountUserName($account->getString("username")), 50);?></b> ) </span>
                        <? } ?>
                    </li>                    
					<? if ((GOOGLE_MAPS_ENABLED == "on") && ($mapObj->getString("value") == "on") && (($classified->getString("address")) || ($classified->getNumber("location_3")) || ($classified->getNumber("location_4")  || ($classified->getString("latitude") && $classified->getString("longitude"))))) { ?>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=CLASSIFIED_FEATURE_FOLDER;?>/maptuning.php?id=<?=$classified->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view"><?=string_ucwords(system_showText(LANG_SITEMGR_MAPTUNING))?></a></li>
					<? } ?>

				</ul>
				
				<ul class="list-view columnListView secondaryListView">
					<li><span class="traffic"><a href="<?=DEFAULT_URL?>/sitemgr/<?=CLASSIFIED_FEATURE_FOLDER;?>/report.php?id=<?=$classified->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>"> <?=string_ucwords(system_showText(LANG_SITEMGR_TRAFFICREPORTS))?></a></span></li>
					<li><strong><?=system_showText(LANG_SITEMGR_LASTUPDATED)?>:</strong> <span class="label-field-account"><?=format_date($classified->getNumber("updated"),DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($classified->getNumber("updated"))?></span></li>
                    <li><strong><?=system_showText(LANG_SITEMGR_DATECREATED)?>:</strong> <span class="label-field-account"><?=format_date($classified->getNumber("entered"),DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($classified->getNumber("entered"))?></span></li>
				</ul>
				
				<br class="clear" />

				<div id="header-view"><?=system_showText(LANG_SITEMGR_CLASSIFIED_SING)?> <?=string_ucwords(system_showText(LANG_SITEMGR_PREVIEW))?></div>
				<center>
					<a href="<?=DEFAULT_URL?>/sitemgr/<?=CLASSIFIED_FEATURE_FOLDER;?>/preview.php?id=<?=$classified->getNumber("id")?>" class="standardLINK iframe fancy_window_preview"><?=system_showText(LANG_SITEMGR_CLICKHERETOPREVIEW)?> <?=system_showText(LANG_SITEMGR_CLASSIFIED_SING)?></a>
				</center>

			<? }
			} ?>

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
