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
	# * FILE: /sitemgr/locations/location_updateFeatured.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$id = $_GET['id'];
	$featured = $_GET['featured'];
	$row_id = $_GET['row_id'];
	$level = $_GET['level'];
	
	$featured = ($featured == "y" ? "n" : "y");

	$locationFeatObj = new LocationFeatured(SELECTED_DOMAIN_ID, $level, $id);

	if ($featured == "y") {
		$locationFeatObj->setFeatured(SELECTED_DOMAIN_ID, $level, $id);
	} else {
		$locationFeatObj->deleteFeatured(SELECTED_DOMAIN_ID, $level, $id);
	}

	?>
	<a href="javascript:void(0);" onclick="javascript:updateFeatured(<?=$id?>,'<?=$featured?>',<?=$level?>,<?=$row_id?>)">
		<img src="<?=DEFAULT_URL?>/images/<?=$featured == 'y' ? 'icon_check.gif' : 'icon_uncheck.gif'?>" border="0" alt="<?=($featured == 'y' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" title="<?=($featured == 'y' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" />
	</a>

