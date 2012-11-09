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
	# * FILE: /sitemgr/locations/location_2/location_2.php
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
	
	$url_base = "".DEFAULT_URL."/sitemgr";

	# ----------------------------------------------------------------------------------------------------
	# LOCATION RELATIONSHIP
	# ----------------------------------------------------------------------------------------------------
	$_locations = explode(",", EDIR_LOCATIONS);
	$_location_level = 2;
	if (!in_array($_location_level, $_locations)) {
		header("Location: ".DEFAULT_URL."/sitemgr/");
		exit;
	}
	
	system_retrieveLocationRelationship ($_locations, $_location_level, $_location_father_level, $_location_child_level);
		
	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);	

	define("LOCATION_AREA","LOCATION2");
	define("LOCATION_TITLE", string_ucwords(system_showText(constant("LANG_SITEMGR_LABEL_".LOCATION2_SYSTEM))));
	include_once(EDIRECTORY_ROOT."/includes/code/location.php");
	$_location_node_params = system_buildLocationNodeParams($_GET);
	if ($success) {
		$message = 2;
		header("Location: ".$url_base."/locations/location_2/index.php?".($_location_node_params?$_location_node_params."&":"")."operation=".$operation."&loc_name=".$location_name);
	}

	//increase frequent actions
	if ($_POST['operation']!='insert') system_setFreqActions('location'.$_location_level.'_add','location');

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
                <h1>
                    <? system_buildLocationBreadCrumb ($_locations, $_GET, $_location_level); ?>
                </h1>
            </div>
        </div>
        <div id="content-content">
            <div class="default-margin">

                <? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
                <? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
                <? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

                <? include(INCLUDES_DIR."/tables/table_location_submenu.php");?>
                <br />	

                <? include_once(EDIRECTORY_ROOT."/includes/forms/form_location.php");?>
                <form id="formlocationcancel" action="<?=DEFAULT_URL?>/sitemgr/locations/location_2/index.php" method="get">
                    <?=system_getFormInputHiddenParams((($_POST)?($_POST):($_GET)), "operation,id");?>
                </form>

                <br />
            </div>
        </div>
        <div id="bottom-content">
            &nbsp;
        </div>
    </div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>