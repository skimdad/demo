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
	# * FILE: /sitemgr/article/view.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/sitemgr/".ARTICLE_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$errorPage = DEFAULT_URL."/sitemgr/".ARTICLE_FEATURE_FOLDER."/index.php?message=".$message."&screen=$screen&letter=$letter";
	if ($id) {
		$article = new Article($id);
		if ((!$article->getNumber("id")) || ($article->getNumber("id") <= 0)) {
			header("Location: ".$errorPage);
			exit;
		}
	} else {
		header("Location: ".$errorPage);
		exit;
	}

	if ($article->getNumber("account_id")) $account = new Account($article->getNumber("account_id"));

	$level = new ArticleLevel();
	$articleImages = $level->getImages($article->getNumber("level"));

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
			<h1><?=system_showText(LANG_SITEMGR_ARTICLE_SING)?> - <?=system_showText(LANG_SITEMGR_DETAIL)?></h1>
		</div>
	</div>
	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
			<?if (CUSTOM_ARTICLE_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>
				<? if($article->getString("id") == 0){ ?>
					<p class="errorMessage"><?=system_showText(LANG_SITEMGR_ARTICLE_MIGHTBEDELETED)?></p>
				<? } else { ?>

					<? include(INCLUDES_DIR."/tables/table_article_submenu.php"); ?>

					<br />
					<div id="header-view" title="<?=$article->getString("title")?>"><?=system_showText(LANG_SITEMGR_MANAGE)?> <?=system_showText(LANG_SITEMGR_ARTICLE_SING)?> - <?=$article->getString("title", true, 35);?></div>

					<ul class="list-view columnListView">

						<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=ARTICLE_FEATURE_FOLDER;?>/article.php?id=<?=$article->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>" class="link-view"><?=system_showText(LANG_SITEMGR_EDIT)?> <?=ucfirst(system_showText(LANG_SITEMGR_INFORMATION))?></a></li>
						<li>
							<a href="<?=DEFAULT_URL?>/sitemgr/<?=ARTICLE_FEATURE_FOLDER;?>/settings.php?id=<?=$article->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>" class="link-view"><?=string_ucwords(system_showText(LANG_SITEMGR_LABEL_CHANGE_ARTICLE_STATUS))?></a>
						</li>
						<li>
							<a href="<?=DEFAULT_URL?>/sitemgr/<?=ARTICLE_FEATURE_FOLDER;?>/delete.php?id=<?=$article->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>" class="link-view"><?=system_showText(LANG_SITEMGR_DELETE)?> <?=system_showText(LANG_SITEMGR_ARTICLE_SING)?></a>
						</li>
						<li>
							<? if (!$account) { ?>
								<em><?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER)?></em>
							<? } else { ?>
								<a href="<?=DEFAULT_URL?>/sitemgr/account/view.php?id=<?=$article->getNumber("account_id")?>" class="link-view"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_ACCOUNT)?></a>:
								<span class="label-field-account" title="<?=$account->getString("username");?>"> ( <b><?=system_showTruncatedText(system_showAccountUserName($account->getString("username")), 50);?></b> ) </span>
							<? } ?>
						</li>
					</ul>

					<ul class="list-view columnListView secondaryListView">
						<li><span class="traffic"><a href="<?=DEFAULT_URL?>/sitemgr/<?=ARTICLE_FEATURE_FOLDER;?>/report.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>"> <?=string_ucwords(system_showText(LANG_SITEMGR_TRAFFICREPORTS))?></a></span></li>
                        <li><span class="ratings"><a href="<?=DEFAULT_URL?>/sitemgr/review/index.php?item_type=article&item_id=<?=$id?>&filter_id=1&item_screen=<?=$item_screen?>&item_letter=<?=$item_letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>"><?=string_ucwords(system_showText(LANG_SITEMGR_VIEW))?> <?=string_ucwords(system_showText(LANG_SITEMGR_REVIEWS))?></a></span></li>
                        <li><strong><?=system_showText(LANG_SITEMGR_LASTUPDATED)?>:</strong> <span class="label-field-account"><?=format_date($article->getNumber("updated"),DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($article->getNumber("updated"))?></span></li>
						<li><strong><?=system_showText(LANG_SITEMGR_DATECREATED)?>:</strong> <span class="label-field-account"><?=format_date($article->getNumber("entered"),DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($article->getNumber("entered"))?></span></li>
					</ul>

					<br class="clear" />

					<div id="header-view"><?=system_showText(LANG_SITEMGR_ARTICLE_SING)?> <?=system_showText(LANG_SITEMGR_PREVIEW)?></div>
					<center>
						<a href="<?=DEFAULT_URL?>/sitemgr/<?=ARTICLE_FEATURE_FOLDER;?>/preview.php?id=<?=$article->getNumber("id")?>" class="standardLINK iframe fancy_window_preview"><?=system_showText(LANG_SITEMGR_CLICKHERETOPREVIEW)?> <?=system_showText(LANG_SITEMGR_ARTICLE_SING)?></a>
					</center>

				<? } ?>
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
