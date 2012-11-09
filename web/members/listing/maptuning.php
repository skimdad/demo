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
	# * FILE: /members/listing/maptuning.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	$mapObj = new GoogleSettings(GOOGLE_MAPS_STATUS, $_SERVER["HTTP_HOST"]);
    if (GOOGLE_MAPS_ENABLED != "on" || $mapObj->getString("value") != "on") { exit; }

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

	$url_redirect = "".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/members";
	$members = 1;
	
	$message_map = system_showText(LANG_MAPTUNING_ADDRESSNOTFOUND)."\\n".system_showText(LANG_MAPTUNING_PLEASEEDITYOURITEM);

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$listing = new Listing($id);
		if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
			header("Location: ".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		}
		if (sess_getAccountIdFromSession() != $listing->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		}
		if ((!$listing->getString("address")) && (!$listing->getString("zip_code")) && (!$listing->getNumber("location_3")) && (!$listing->getNumber("location_4"))) {
			header("Location: ".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		}
		$itemObj = $listing;
        $itemTable = "Listing";
	} else {
		header("Location: ".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/maptuning.php");

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

		<?
		if ($googlemaps_code) {
			echo $googlemaps_code;
		}
		?>
		
		<h2><?=system_showText(LANG_LABEL_MAP_TUNING)?></h2>

		<ul class="list-view">
			<li class="list-back"><a href="<?=DEFAULT_URL?>/members/<?=LISTING_FEATURE_FOLDER;?>/<?=($search_page) ? "search.php" : "index.php"?>?screen=<?=$screen?>&letter=<?=$letter?>"><?=system_showText(LANG_LABEL_BACK);?></a></li>
		</ul>

		<h2 class="standardSubTitle"><?=system_showText(LANG_LISTING_MAP_TUNING)?> - <?=$listing->getString("title")?></h2>

		<form name="maptuning_form" id="maptuning_form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

			<input type="hidden" name="id" id="id" value="<?=$id?>" />
			<input type="hidden" name="latitude_longitude" id="myLatitudeLongitude" value="<?=$latitude_longitude?>" />
			<input type="hidden" name="map_zoom" id="map_zoom" value="<?=$map_zoom?>">
            <input type="hidden" name="maptuning_done" id="maptuning_done" value="n" />
			<input type="hidden" name="screen" id="screen" value="<?=$screen?>" />
			<input type="hidden" name="letter" id="letter" value="<?=$letter?>" />
			
			<div class="tip-base">
				<h1><?=system_showText(LANG_MSG_TIPSFORMAPTUNING)?></h1><br />
				<p style="text-align: justify;"><?=system_showText(LANG_MSG_YOUCANADJUSTPOSITION)?> <strong><?=system_showText(LANG_MSG_WITH_MORE_ACCURACY)?></strong></p><br />
				<span class="warning" style="text-align: justify;">* <?=system_showText(LANG_MSG_USE_CONTROLS_TO_ADJUST)?> </span>
				<span class="warning" style="text-align: justify;">* <?=system_showText(LANG_MSG_USE_ARROWS_TO_NAVIGATE)?> </span>
				<span class="warning" style="text-align: justify;">* <?=system_showText(LANG_MSG_DRAG_AND_DROP_MARKER)?> </span>
			</div>

			<br />
			<div id="map" class="googleBase" style="border: 1px solid #000;">&nbsp;</div>
			<br />

			<? if ($googlemaps_message) { ?>
				<div id="map_error"><?=$googlemaps_message?></div>
			<? } ?>
            <div class="baseButtons">
                <p class="standardButton">
                    <button onclick="document.getElementById('map_zoom').value=map.getZoom();" type="submit"><?=system_showText(LANG_BUTTON_SUBMIT);?></button>
                </p>
                <p class="standardButton">
                    <button type="button" value="Cancel" onclick="document.getElementById('formlistingmaptuningcancel').submit();"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
                </p>
            </div>

		</form>
		<form id="formlistingmaptuningcancel" action="<?=DEFAULT_URL?>/members/<?=LISTING_FEATURE_FOLDER;?>/index.php" method="post">

			<input type="hidden" name="screen" value="<?=$screen?>" />
			<input type="hidden" name="letter" value="<?=$letter?>" />

		</form>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>