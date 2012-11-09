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
	# * FILE: /members/article/view.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on" || CUSTOM_ARTICLE_FEATURE != "on") { exit; }

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

	$url_redirect = "".DEFAULT_URL."/members/".ARTICLE_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/members";
	$members = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$errorPage = "".DEFAULT_URL."/members/".ARTICLE_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter";
	if ($id) {
		$article = new Article($id);
		if ((!$article->getNumber("id")) || ($article->getNumber("id") <= 0)) {
			header("Location: ".$errorPage);
			exit;
		}
		if (sess_getAccountIdFromSession() != $article->getNumber("account_id")) {
			header("Location: ".$errorPage);
			exit;
		}
	} else {
		header("Location: ".$errorPage);
		exit;
	}

	$account = new Account($article->getNumber("account_id"));

	$level = new ArticleLevel();
	$articleImages = $level->getImages($article->getNumber("level"));
    setting_get('commenting_edir', $commenting_edir);
    setting_get("review_article_enabled", $review_enabled);

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

				<h2><?=system_showText(LANG_ARTICLE_DETAIL);?></h2>

				<ul class="list-view">
					<li class="list-back"><a href="javascript:history.back(-1);"><?=system_showText(LANG_LABEL_BACK);?></a></li>
				</ul>

				<? if($article->getString("id") == 0){ ?>
					<p class="errorMessage"> <?=system_showText(LANG_NO_ARTICLE_FOUND);?></p>
				<? } else { ?>

					<h2 class="standardSubTitle" title="<?=$article->getString("title")?>"><?=system_showText(LANG_MANAGE_ARTICLE);?> - <?=$article->getString("title", true, 60);?></h2>

					<ul class="list-view">
						<li><a href="<?=DEFAULT_URL?>/members/<?=ARTICLE_FEATURE_FOLDER;?>/article.php?id=<?=$article->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>"><?=system_showText(LANG_LABEL_EDIT);?> <?=system_showText(LANG_LABEL_INFORMATION);?></a></li>
						<li><a href="<?=DEFAULT_URL?>/members/<?=ARTICLE_FEATURE_FOLDER;?>/delete.php?id=<?=$article->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>" class="link-view"><?=system_showText(LANG_ARTICLE_DELETE);?></a></li>
                        <li><a href="<?=DEFAULT_URL?>/members/<?=ARTICLE_FEATURE_FOLDER;?>/report.php?id=<?=$article->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>"> <?=string_ucwords(system_showText(LANG_TRAFFIC_REPORTS))?></a></li>
                         <? if ($review_enabled == "on" && $commenting_edir) { ?>
                        <li><a href="<?=DEFAULT_URL?>/members/review/index.php?item_type=article&item_id=<?=$article->getNumber("id")?>&filter_id=1&item_screen=<?=$item_screen?>&item_letter=<?=$item_letter?>"> <?=string_ucwords(system_showText(LANG_REVIEW_PLURAL))?></a></li>
                        <? } ?>
					</ul>

					<h2 class="standardSubTitle"><?=system_showText(LANG_ARTICLE_PREVIEW);?></h2>

					<center>
						<a href="<?=DEFAULT_URL?>/members/<?=ARTICLE_FEATURE_FOLDER;?>/preview.php?id=<?=$article->getNumber("id")?>" class="standardLINK iframe fancy_window_preview"><?=system_showText(LANG_MSG_CLICK_TO_PREVIEW_THIS_ARTICLE);?></a>
					</center>

				<? } ?>
			</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>