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
	# * FILE: /sitemgr/listing/maptuning.php
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
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;
	
	$message_map = system_showText(LANG_SITEMGR_MAPTUNING_ADDRESSNOTFOUND)."\\n".system_showText(LANG_SITEMGR_MAPTUNING_PLEASEEDITYOURITEM);

	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$listing = new Listing($id);
		if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
			header("Location: ".DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER."/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;
		}
		if ((!$listing->getString("address")) && (!$listing->getString("zip_code")) && (!$listing->getNumber("location_3")) && (!$listing->getNumber("location_4"))) {
			header("Location: ".DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER."/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;
		}
		$itemObj = $listing;
        $itemTable = "Listing";
	} else {
		header("Location: ".DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER."/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/maptuning.php");

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
			<h1><?=string_ucwords(system_showText(LANG_SITEMGR_MAPTUNING))?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_listing_submenu.php"); ?>

			<?
			if ($googlemaps_code) {
				echo $googlemaps_code;
			}
			?>

			<br />

			<div id="header-view">
				<?=LANG_SITEMGR_LISTING_SING;?> <?=string_ucwords(system_showText(LANG_SITEMGR_MAPTUNING))?> - <?=$listing->getString("title")?>
			</div>
			
            <div class="tip-base">
                <h1><?=system_showText(LANG_SITEMGR_MAPTUNING_TIPTITLE)?></h1><br />
                <p style="text-align: justify;"><strong><?=system_showText(LANG_SITEMGR_MAPTUNING_TIP1)?></strong></p><br />
                <span class="warning" style="text-align: justify;"><?=system_showText(LANG_SITEMGR_MAPTUNING_TIP2)?></span>
                <span class="warning" style="text-align: justify;"><?=system_showText(LANG_SITEMGR_MAPTUNING_TIP3)?></span>
                <span class="warning" style="text-align: justify;"><?=system_showText(LANG_SITEMGR_MAPTUNING_TIP4)?></span>
            </div>
	
			<div class="baseForm">

			<form name="maptuning_form" id="maptuning_form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

				<input type="hidden" name="sitemgr" id="sitemgr" value="<?=$sitemgr?>" />
				<input type="hidden" name="id" id="id" value="<?=$id?>" />
				<input type="hidden" name="latitude_longitude" id="myLatitudeLongitude" value="<?=$latitude_longitude?>" />
				<input type="hidden" name="map_zoom" id="map_zoom" value="<?=$map_zoom?>">
                <input type="hidden" name="maptuning_done" id="maptuning_done" value="n" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				
				<div id="map" class="googleBase" style="border: 1px solid #000;">&nbsp;</div>
				<br />

				<? if ($googlemaps_message) { ?>
					<div id="map_error"><?=$googlemaps_message?></div>
				<? } ?>

				<button type="submit" name="submit_button" class="input-button-form mapTunningButton" onclick="document.getElementById('map_zoom').value=map.getZoom();" value="Submit"><?=system_showText(LANG_SITEMGR_MAPTUNING_SAVE)?></button>
				<button type="button" name="cancel" value="Cancel" class="input-button-form mapTunningButton" onclick="document.getElementById('formlistingmaptuningcancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

			</form>
			<form id="formlistingmaptuningcancel" action="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/<?=(($search_page) ? "search.php" : "index.php");?>" method="get">

				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />

			</form>
			
			</div>

		</div>
	</div>

	<div id="bottom-content">

	</div>

</div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>