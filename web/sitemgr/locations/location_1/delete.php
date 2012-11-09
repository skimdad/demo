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
	# * FILE: /sitemgr/locations/location_1/delete.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/sitemgr/locations/location_1/index.php";
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# LOCATION RELATIONSHIP
	# ----------------------------------------------------------------------------------------------------
	$_locations = explode(",", EDIR_LOCATIONS);
	$_location_level = 1;
	if (!in_array($_location_level, $_locations)) {
		header("Location: ".DEFAULT_URL."/sitemgr/");
		exit;
	}
	$_location_node_params = system_buildLocationNodeParams($_GET);
	system_retrieveLocationRelationship ($_locations, $_location_level, $_location_father_level, $_location_child_level);

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	define("LOCATION_AREA","LOCATION1");
	define("LOCATION_TITLE", string_ucwords(system_showText(constant("LANG_SITEMGR_LABEL_".LOCATION1_SYSTEM))));

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$location = new Location1($id);
	}	else {
		header("Location: ".DEFAULT_URL."/sitemgr/locations/location_1/index.php?message=".$message."&screen=$screen&letter=$letter");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$operation='delete';
		include_once(EDIRECTORY_ROOT."/includes/code/location.php");
		header("Location: ".$url_base."/locations/location_1/index.php?operation=".$operation."&loc_name=".$location_name);
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
            <div id="header-content"><h1><?=string_ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=system_showText(LOCATION_TITLE);?></h1></div>
        </div>
        <div id="content-content">
            <div class="default-margin">

                <? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
                <? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
                <? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

                <div class="baseForm">

                    <form name="location" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

                    <input type="hidden" name="id" value="<?=$id?>" />
                    <div class="header-form"><?=string_ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=system_showText(LOCATION_TITLE);?> - <?=$location->getString("name")?></div>
                    <p class="informationMessage"><?=system_showText(LANG_SITEMGR_LOCATION_DELETEQUESTION)?> <?=system_showText(constant("LANG_SITEMGR_LABEL_".LOCATION1_SYSTEM));?> <?=$location->getString("name")?> ?</p>

                    <button type="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                    <button type="button" value="Cancel" class="input-button-form" onclick="document.getElementById('formlocation1deletecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
                </form>
                <form id="formlocation1deletecancel" action="<?=DEFAULT_URL?>/sitemgr/locations/location_1/index.php?operation=cancel" method="post">
                    <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
                </form>

                </div>

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
