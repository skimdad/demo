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
	# * FILE: /blog/sitemgr/blog/view.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BLOG_FEATURE != "on") { exit; }

	
	/*
     * Session variable to force connection with second DB
     */
    $_SESSION["FORCE_SECOND"] = false;
    
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".BLOG_DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER;
	$url_base = "".BLOG_DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));
	
	setting_get("wp_enabled", $wp_enabled);
	
	if (BLOG_WITH_WORDPRESS == "on"){
		$wp_enabled = "";
	}

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$errorPage = BLOG_DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER."/index.php?message=".$message."&screen=$screen&letter=$letter";
	if ($id) {
		$post = new Post($id);
		if ((!$post->getNumber("id")) || ($post->getNumber("id") <= 0)) {
			header("Location: ".$errorPage);
			exit;
		}
	} else {
		header("Location: ".$errorPage);
		exit;
	}

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
			<h1><?=system_showText(LANG_SITEMGR_BLOG_SING)?> - <?=system_showText(LANG_SITEMGR_POST_DETAIL)?></h1>
		</div>
	</div>
	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
			<?if (CUSTOM_BLOG_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>
			<? if($post->getString("id") == 0){ ?>
				<p class="errorMessage"><?=system_showText(LANG_SITEMGR_POST_MIGHTBEDELETED)?></p>
			<? } else { ?>

				<? include(BLOG_INCLUDES_DIR."/tables/table_blog_submenu.php"); ?>

				<br />
				<div id="header-view" title="<?=$post->getString("title")?>"><?=system_showText(LANG_SITEMGR_MANAGE)?> <?=system_showText(LANG_SITEMGR_POST_BLOG_SING)?> - <?=$post->getString("title", true, 90)?></div>

				<ul class="list-view columnListView">
					<? if (!$wp_enabled){ ?>
					<li>
						<a href="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/blog.php?id=<?=$post->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>" class="link-view"><?=system_showText(LANG_SITEMGR_EDIT)?> <?=ucfirst(system_showText(LANG_SITEMGR_INFORMATION))?></a>
					</li>
					<? } ?>
					<li>
						<a href="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/settings.php?id=<?=$post->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>" class="link-view"> <?=string_ucwords(system_showText(LANG_SITEMGR_LABEL_CHANGE_POST_STATUS))?></a>
					</li>
					<li>
						<a href="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/delete.php?id=<?=$post->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>" class="link-view"><?=system_showText(LANG_SITEMGR_DELETE)?> <?=system_showText(LANG_SITEMGR_POST_BLOG_SING)?></a>
					</li>
					<li><strong><?=system_showText(LANG_SITEMGR_LASTUPDATED)?>:</strong> <span class="label-field-account"><?=format_date($post->getNumber("updated"),DEFAULT_DATE_FORMAT, "datetime")." - ".$post->getTimeStringUpdated()?></span></li>
                    <li><strong><?=system_showText(LANG_SITEMGR_DATECREATED)?>:</strong> <span class="label-field-account"><?=format_date($post->getNumber("entered"),DEFAULT_DATE_FORMAT, "datetime")." - ".$post->getTimeString()?></span></li>
				</ul>
				
				<ul class="list-view columnListView secondaryListView">
					
				</ul>
				
				<br class="clear" />

				<div id="header-view"><?=system_showText(LANG_SITEMGR_POST_BLOG_SING)?> <?=system_showText(LANG_SITEMGR_PREVIEW)?></div>
				<center>
					<a href="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/preview.php?id=<?=$post->getNumber("id")?>" class="standardLINK iframe fancy_window_preview_small"><?=system_showText(LANG_SITEMGR_CLICKHERETOPREVIEW)?> <?=system_showText(LANG_SITEMGR_POST_BLOG_SING)?></a>
				</center>

			<? }
			}?>

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
