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
	# * FILE: /sitemgr/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (!permission_hasSMPermSection(SITEMGR_PERMISSION_SEOCENTER)) {
		header("Location: ".DEFAULT_URL."/sitemgr/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# INCREASES FREQUENTLY ACTIONS
	# ----------------------------------------------------------------------------------------------------
	system_setFreqActions('seocenter_manage','seocenter');

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
		<h1><?=system_showText(LANG_SITEMGR_WELCOMETOTHE)?> <?=system_showText(LANG_SITEMGR_CONTENT_SEOCENTER)?></h1>
	</div>

	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<p class="informationMessage"><?=system_showText(LANG_SITEMGR_SEOCENTER_ABOUT)?></p>

			<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_SETTINGS)) { ?>
					<tr>
						<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY)?></th>
					</tr>
					<tr>
						<th><?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_METATAG))?>:</th>
						<td><a href="<?=DEFAULT_URL;?>/sitemgr/prefs/searchverify.php"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_SEARCHVERIFYCTION);?></a></td>
					</tr>
				<? } ?>
				<? if (SITEMAP_FEATURE == "on" && MODREWRITE_FEATURE == "on") { ?>
				<tr>
					<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_LABEL_SITEMAP)?></th>
				</tr>
				
				<tr>
					<?
						$domainObj = new Domain(SELECTED_DOMAIN_ID);
						$sitemapUrl = "http://".$domainObj->getString("url").EDIRECTORY_FOLDER;
					?>
					<th><?=system_showText(LANG_SITEMGR_SEOCENTER_LABEL_SITEMAPLINK)?>:</th>
					<td><a href="<?=$sitemapUrl;?>/custom/domain_<?=SELECTED_DOMAIN_ID?>/sitemap/index.xml" target="_blank"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_SITEMAPXML);?></a><span>(<?=system_showText(LANG_SITEMGR_SEOCENTER_RUNSNIGHTLY)?>)</span></td>
				</tr>
				<? } ?>
				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_SITECONTENT)) { ?>
					<tr>
						<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_SEOCENTER_HOMEPAGEOPTIMIZATION)?></th>
					</tr>
					<tr>
						<th><?=system_showText(LANG_SITEMGR_SEOCENTER_LABEL_SITECONTENT)?>:</th>
						<td><a href="<?=DEFAULT_URL;?>/sitemgr/content/index.php"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_SITECONTENTSECTION)?></a><span><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_SITECONTENTSECTION_SPAN)?></span></td>
					</tr>
				<? } ?>

				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_CATEGORIES)) { ?>
					<tr>
						<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_SEOCENTER_CATEGORYINFORMATION)?></th>
					</tr>
					<tr>
						<th><?=system_showText(LANG_SITEMGR_SEOCENTER_CATEGORIES)?>:</th>
						<td><a href="<?=DEFAULT_URL;?>/sitemgr/listingcategs/index.php"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_CATEGORIESSECTION)?></a><span><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_CATEGORIESSECTION_SPAN)?></span></td>
					</tr>
				<? } ?>
				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LOCATIONS)) { ?>
					<tr>
						<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_SEOCENTER_LOCATIONINFORMATION)?></th>
					</tr>
					<tr>
						<th><?=system_showText(LANG_SITEMGR_SEOCENTER_LABEL_LOCATIONS)?>:</th>
						<td><a href="<?=DEFAULT_URL;?>/sitemgr/locations/location_1/index.php"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_LOCATIONSSECTION)?></a><span><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_LOCATIONSSECTION_SPAN)?></span></td>
					</tr>
				<? } ?>
				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS) || permission_hasSMPermSection(SITEMGR_PERMISSION_EVENTS) || permission_hasSMPermSection(SITEMGR_PERMISSION_ARTICLES) || permission_hasSMPermSection(SITEMGR_PERMISSION_CLASSIFIEDS)) { ?>
				<tr>
					<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_SEOCENTER_ITEMOPTIMIZATION)?></th>
				</tr>
				<? } ?>
				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) { ?>
					<tr>
						<th><?=string_ucwords(system_showText(LANG_SITEMGR_LISTING_PLURAL))?>:</th>
						<td><a href="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_LISTINGSSECTION)?></a></td>
					</tr>

					<? if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && $hasPromotion){ ?>
						<tr>
							<th><?=string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_PROMOTION))?>:</th>
							<td><a href="<?=DEFAULT_URL?>/sitemgr/<?=PROMOTION_FEATURE_FOLDER?>/"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_PROMOTIONSSECTION)?></a></td>
						</tr>
                    <? } ?>
                <? } ?>

				<? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on" && permission_hasSMPermSection(SITEMGR_PERMISSION_EVENTS)) { ?>
					<tr>
						<th><?=string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_EVENT))?>:</th>
						<td><a href="<?=DEFAULT_URL?>/sitemgr/<?=EVENT_FEATURE_FOLDER;?>/"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_EVENTSSECTION)?></a></td>
					</tr>
				<? } ?>
				<? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on" && permission_hasSMPermSection(SITEMGR_PERMISSION_CLASSIFIEDS)) { ?>
					<tr>
						<th><?=string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_CLASSIFIED))?>:</th>
						<td><a href="<?=DEFAULT_URL?>/sitemgr/<?=CLASSIFIED_FEATURE_FOLDER;?>/"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_CLASSIFIEDSSECTION)?></a></td>
					</tr>
				<? } ?>
				<? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on" && permission_hasSMPermSection(SITEMGR_PERMISSION_ARTICLES)) { ?>
					<tr>
						<th><?=string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_ARTICLE))?>:</th>
						<td><a href="<?=DEFAULT_URL?>/sitemgr/<?=ARTICLE_FEATURE_FOLDER;?>/"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_ARTICLESSECTION)?></a></td>
					</tr>
				<? } ?>
				<? if (BLOG_FEATURE == "on" && permission_hasSMPermSection(SITEMGR_PERMISSION_BLOG)) { ?>
					<tr>
						<th><?=string_ucwords(system_showText(LANG_SITEMGR_BLOG))?>:</th>
						<td><a href="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_BLOGSECTION)?></a></td>
					</tr>
				<? } ?>
			</table>

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
