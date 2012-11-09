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
	# * FILE: /sitemgr/banner/view.php
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

	if ($id) {
		$banner = new Banner($id);
		if ((!$banner->getNumber("id")) || ($banner->getNumber("id") <= 0)) {
			header("Location: ".DEFAULT_URL."/sitemgr/".BANNER_FEATURE_FOLDER."/index.php?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/sitemgr/".BANNER_FEATURE_FOLDER."/index.php?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

	$operation = "view";
	
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
			<h1 class="highlight"><?=system_showText(LANG_SITEMGR_BANNER_SING)?> - <?=system_showText(LANG_SITEMGR_DETAIL)?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
			<?if (CUSTOM_BANNER_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>
			<? include(INCLUDES_DIR."/tables/table_banner_submenu.php"); ?>

			<?
			$banner = new Banner($id);
			if ($banner->getNumber("account_id")) $account = new Account($banner->getNumber("account_id"));
			?>

			<br />

			<div id="header-view" title="<?=$banner->getString("caption")?>"><?=system_showText(LANG_SITEMGR_MANAGE)?> <?=system_showText(LANG_SITEMGR_BANNER_SING)?> - <?=$banner->getString("caption", true, 35);?></div>

			<ul class="list-view columnListView">
				<li>
					<a href="<?=DEFAULT_URL?>/sitemgr/<?=BANNER_FEATURE_FOLDER;?>/edit.php?id=<?=$banner->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view">
						<?=system_showText(LANG_SITEMGR_EDIT)?> <?=system_showText(LANG_SITEMGR_INFORMATION)?>
					</a>
				</li>
                <li>
                    <a href="<?=DEFAULT_URL?>/sitemgr/<?=BANNER_FEATURE_FOLDER;?>/settings.php?id=<?=$banner->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view">
                        <?=string_ucwords(system_showText(LANG_SITEMGR_LABEL_CHANGE_BANNER_STATUS))?>
                    </a>
                </li>
				<li>
					<a href="<?=DEFAULT_URL?>/sitemgr/<?=BANNER_FEATURE_FOLDER;?>/delete.php?id=<?=$banner->getNumber("id")?>" class="link-view">
						<?=system_showText(LANG_SITEMGR_DELETE)?> <?=system_showText(LANG_SITEMGR_BANNER_SING)?>
					</a>
				</li>
				<li>
					<? if (!$account) { ?>
						<em><?=system_showText(LANG_SITEMGR_NOOWNER)?></em>
					<? } else { ?>
						<a href="<?=DEFAULT_URL?>/sitemgr/account/view.php?id=<?=$banner->getNumber("account_id")?>" class="link-view"><?=system_showText(LANG_SITEMGR_LABEL_ACCOUNT)?></a>:
						<span class="label-field-account" title="<?=$account->getString("username");?>"> ( <b><?=system_showTruncatedText(system_showAccountUserName($account->getString("username")), 50);?></b> ) </span>
					<? } ?>
				</li>
			</ul>
            <ul class="list-view columnListView secondaryListView">
                <li><span class="traffic"><a href="<?=DEFAULT_URL?>/sitemgr/<?=BANNER_FEATURE_FOLDER;?>/report.php?id=<?=$banner->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>"> <?=string_ucwords(system_showText(LANG_SITEMGR_TRAFFICREPORTS))?></a></span></li>
                <li><strong><?=system_showText(LANG_SITEMGR_LASTUPDATED)?>:</strong> <span class="label-field-account"><?=format_date($banner->getNumber("updated"),DEFAULT_DATE_FORMAT)." - ".format_getTimeString($banner->getNumber("updated"))?></span></li>
                <li><strong><?=system_showText(LANG_SITEMGR_DATECREATED)?>:</strong> <span class="label-field-account"><?=format_date($banner->getNumber("entered"),DEFAULT_DATE_FORMAT)." - ".format_getTimeString($banner->getNumber("entered"))?></span></li>
            </ul>
            
            <br class="clear" />

			<div id="header-view" style="margin-bottom: 20px;"><?=system_showText(LANG_SITEMGR_BANNER_SING)?> <?=system_showText(LANG_SITEMGR_PREVIEW)?></div>
			<?
			$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
			$array_edir_languages = explode(",", EDIR_LANGUAGES);
			for ($i=0; $i<count($array_edir_languages); $i++) {
				$labelsuffix = "";
				if ($i) $labelsuffix = $i;
				?>
				<center>
					<a href="<?=DEFAULT_URL?>/sitemgr/<?=BANNER_FEATURE_FOLDER;?>/preview.php?id=<?=$banner->getNumber("id")?>&lang=<?=$array_edir_languages[$i]?>" class="standardLINK iframe fancy_window_preview_small"><?=system_showText(LANG_SITEMGR_CLICKHERETOPREVIEW)?> <?=system_showText(LANG_SITEMGR_BANNER)?><?=((count(explode(",", EDIR_LANGUAGES))>1)?(" (".$array_edir_languagenames[$i].")"):(""));?></a>
				</center>
				<?
			}
			?>
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
