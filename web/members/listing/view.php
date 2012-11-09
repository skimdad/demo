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
	# * FILE: /members/listing/view.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$listing = new Listing($id);
		if (sess_getAccountIdFromSession() != $listing->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
		exit;
	}

	$level = new ListingLevel();
	$listingImages = $level->getImages($listing->getNumber("level"));
	$listingPromotion = $level->getHasPromotion($listing->getNumber("level"));
	$listingClickToCall = $level->getHasCall($listing->getNumber("level"));
    $listingReview = $level->getHasReview($listing->getNumber("level"));
    
    setting_get('commenting_edir', $commenting_edir);
    setting_get("review_listing_enabled", $review_enabled);
    
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

				<h2><?=system_showText(LANG_LISTING_DETAIL);?></h2>

				<ul class="list-view">
					<li class="list-back"><a href="<?=DEFAULT_URL?>/members/<?=LISTING_FEATURE_FOLDER;?>/<?=($search_page) ? "search.php" : "index.php"?>?screen=<?=$screen?>&letter=<?=$letter?>"><?=system_showText(LANG_LABEL_BACK);?></a></li>
				</ul>

				<? if($listing->getString("id") == 0){ ?>

					<p class="errorMessage"><?=system_showText(LANG_NO_LISTING_FOUND);?></p>

				<? } else { ?>

					<h2 class="standardSubTitle" title="<?=$listing->getString("title")?>"><?=system_showText(LANG_MANAGE_LISTING);?> - <?=$listing->getString("title", true, 60)?></h2>

					<? $promotion_label = ($listing->getNumber("promotion_id") == 0) ? system_showText(LANG_LABEL_ADD) : system_showText(LANG_LABEL_EDIT); ?>

					<ul class="list-view">
						<li><a href="<?=DEFAULT_URL?>/members/<?=LISTING_FEATURE_FOLDER;?>/listing.php?id=<?=$listing->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>"> <?=system_showText(LANG_LABEL_EDIT);?> <?=system_showText(LANG_LABEL_INFORMATION);?></a> </li>
						<li><a href="<?=DEFAULT_URL?>/members/<?=LISTING_FEATURE_FOLDER;?>/listinglevel.php?id=<?=$listing->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>"> <?=system_showText(LANG_LABEL_EDIT);?> <?=system_showText(LANG_LABEL_LEVEL);?></a>
                        <span class="label-field-account"> ( <b> <?=($level->getName($listing->getString('level')) ? $level->getName($listing->getString('level')) : $level->getName($level->getDefaultLevel()))?> </b> ) </span> </li>
                        <? if (($listingPromotion == "y") && (PROMOTION_FEATURE == 'on') && (CUSTOM_PROMOTION_FEATURE == "on")) { ?>
                            <li><a href="<?=DEFAULT_URL?>/members/<?=LISTING_FEATURE_FOLDER;?>/deal.php?id=<?=$listing->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>"> <?=system_showText(LANG_PROMOTION_FEATURE_NAME);?> </a> </li>
                        <? } ?>
						<? if ((GOOGLE_MAPS_ENABLED == "on") && ($mapObj->getString("value") == "on") && (($listing->getString("address")) || ($listing->getNumber("location_3")) || ($listing->getNumber("location_4")  || ($listing->getString("latitude") && $listing->getString("longitude"))))) { ?>
                            <li><a href="<?=DEFAULT_URL?>/members/<?=LISTING_FEATURE_FOLDER;?>/maptuning.php?id=<?=$listing->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>"><?=system_showText(LANG_LABEL_MAP_TUNING);?></a></li>
                        <? } ?>
                        <li><a href="<?=DEFAULT_URL?>/members/<?=LISTING_FEATURE_FOLDER;?>/report.php?id=<?=$listing->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>"> <?=string_ucwords(system_showText(LANG_TRAFFIC_REPORTS))?></a></li>
                        <? if ($review_enabled == "on" && $commenting_edir && $listingReview == "y") { ?>
                        <li><a href="<?=DEFAULT_URL?>/members/review/index.php?item_type=listing&item_id=<?=$listing->getNumber("id")?>&filter_id=1&item_screen=<?=$item_screen?>&item_letter=<?=$item_letter?>"> <?=string_ucwords(system_showText(LANG_REVIEW_PLURAL))?></a></li>
						<? } ?>
                        <? if (TWILIO_APP_ENABLED == "on" && TWILIO_APP_ENABLED_CALL == "on" && $listingClickToCall == "y") { ?>
                        <li>
                            <a href="<?=DEFAULT_URL?>/members/<?=LISTING_FEATURE_FOLDER;?>/clicktocall.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view">
								<?=string_ucwords(system_showText(LANG_LABEL_CLICKTOCALL))?>
							</a>
                        </li>
					<? } ?>
					</ul>

					<h2 class="standardSubTitle"><?=system_showText(LANG_LISTING_PREVIEW);?></h2>

					<center>
						<a href="<?=DEFAULT_URL?>/members/<?=LISTING_FEATURE_FOLDER;?>/preview.php?id=<?=$listing->getNumber("id")?>" class="standardLINK iframe fancy_window_preview"><?=system_showText(LANG_MSG_CLICK_TO_PREVIEW_THIS_LISTING);?></a>
					</center>

				<? } ?>

			</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>