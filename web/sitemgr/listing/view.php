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
	# * FILE: /sitemgr/listing/view.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));
    
	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$listing = new Listing($id);
		if ($listing->getNumber("account_id")) $account = new Account($listing->getNumber("account_id"));
	} else {
		header("Location: ".DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER."/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

	$level = new ListingLevel();
	$listingImages = $level->getImages($listing->getNumber("level"));
	$listingPromotion = $level->getHasPromotion($listing->getNumber("level"));
	$listingClickToCall = $level->getHasCall($listing->getNumber("level"));
    
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
			<h1><?=system_showText(LANG_SITEMGR_LISTING_SING)?> - <?=system_showText(LANG_SITEMGR_DETAIL)?></h1>
		</div>
	</div>
	<div id="content-content">
		<div class="default-margin">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<? if($listing->getString("id") == 0){ ?>

			<p class="errorMessage"><?=system_showText(LANG_SITEMGR_LISTING_MIGHTBEDELETED)?></p>

		<? } else { ?>

			<? include(INCLUDES_DIR."/tables/table_listing_submenu.php"); ?>
			<br />
				<div id="header-view" title="<?=$listing->getString("title")?>">
					<?=string_ucwords(system_showText(LANG_SITEMGR_MANAGE))?> <?=system_showText(LANG_SITEMGR_LISTING_SING)?> - <?=$listing->getString("title", true, 35);?>
				</div>
				<ul class="list-view columnListView">
					<li>
						<a href="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/listing.php?id=<?=$listing->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view"><?=string_ucwords(system_showText(LANG_SITEMGR_EDIT))?> <?=string_ucwords(system_showText(LANG_SITEMGR_INFORMATION))?></a>
					</li>
                    <li>
                        <a href="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/settings.php?id=<?=$listing->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view"><?=string_ucwords(system_showText(LANG_SITEMGR_LABEL_CHANGE_LISTING_STATUS))?></a>
                    </li>
					<li>
						<a href="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/listinglevel.php?id=<?=$listing->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view"><?=string_ucwords(system_showText(LANG_SITEMGR_EDIT))?> <?=string_ucwords(system_showText(LANG_SITEMGR_LEVEL))?></a>
                        <span class="label-field-account"> ( <b> <?=($level->getName($listing->getString('level')) ? $level->getName($listing->getString('level')) : $level->getName($level->getDefaultLevel()))?> </b> ) </span>
					</li>
					<li>
                        <a href="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/delete.php?id=<?=$listing->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view"><?=string_ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=system_showText(LANG_SITEMGR_LISTING_SING)?></a>
                    </li>
                    <li>
                        <? if (!$account) { ?>
                            <em><?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER)?></em>
                        <? } else { ?>
                            <a href="<?=DEFAULT_URL?>/sitemgr/account/view.php?id=<?=$listing->getNumber("account_id")?>" class="link-view"> <?=string_ucwords(system_showText(LANG_SITEMGR_LABEL_ACCOUNT))?></a>: <span class="label-field-account" title="<?=$account->getString("username");?>">( <b><?=system_showTruncatedText(system_showAccountUserName($account->getString("username")), 50)?></b> )</span>
                        <? } ?>
                    </li>
                    
                    <? if (($listingPromotion == "y") && (PROMOTION_FEATURE == 'on')) { ?>
                        <li>
                            <a href="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/deal.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>"><?=$promotion_label?> <?=string_ucwords(system_showText(LANG_SITEMGR_PROMOTION))?></a>
                        </li>
                    <? } ?>
                    <? if ((GOOGLE_MAPS_ENABLED == "on") && ($mapObj->getString("value") == "on") && (($listing->getString("address")) || ($listing->getNumber("location_3")) || ($listing->getNumber("location_4")  || ($listing->getString("latitude") && $listing->getString("longitude"))))) { ?>
                        <li>
                            <a href="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/maptuning.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view"><?=string_ucwords(system_showText(LANG_SITEMGR_MAPTUNING))?></a>
                        </li>
                    <? } ?>
					<? if (TWILIO_APP_ENABLED == "on" && TWILIO_APP_ENABLED_CALL == "on" && $listingClickToCall == "y") { ?>
                        <li>
                            <a href="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/clicktocall.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view">
								<?=string_ucwords(system_showText(LANG_LABEL_CLICKTOCALL))?>
							</a>
                        </li>
					<? } ?>	
				</ul>
				
				<ul class="list-view columnListView secondaryListView">
					<li><span class="traffic"><a href="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/report.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>"> <?=string_ucwords(system_showText(LANG_SITEMGR_TRAFFICREPORTS))?></a></span></li>
                    <li><span class="ratings"><a href="<?=DEFAULT_URL?>/sitemgr/review/index.php?item_type=listing&item_id=<?=$id?>&filter_id=1&item_screen=<?=$item_screen?>&item_letter=<?=$item_letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>"> <?=string_ucwords(system_showText(LANG_SITEMGR_REVIEWS))?></a></span></li>
                    <li><strong><?=system_showText(LANG_SITEMGR_LASTUPDATED)?>:</strong> <span class="label-field-account"><?=format_date($listing->getNumber("updated"),DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($listing->getNumber("updated"))?></span></li>
					<li><strong><?=system_showText(LANG_SITEMGR_DATECREATED)?>:</strong> <span class="label-field-account"><?=format_date($listing->getNumber("entered"),DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($listing->getNumber("entered"))?></span></li>
				</ul>
				
				<br class="clear" />

				<div id="header-view"><?=system_showText(LANG_SITEMGR_LISTING_SING)?> <?=string_ucwords(system_showText(LANG_SITEMGR_PREVIEW))?></div>
				<center>
					<a href="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/preview.php?id=<?=$listing->getNumber("id")?>" class="standardLINK iframe fancy_window_preview"><?=system_showText(LANG_SITEMGR_CLICKHERETOPREVIEW)?> <?=system_showText(LANG_SITEMGR_LISTING_SING)?></a>
				</center>

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