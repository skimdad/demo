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
	# * FILE: /includes/code/slider_switch.php
	# ----------------------------------------------------------------------------------------------------

	include("../../conf/loadconfig.inc.php");
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();
	
		$slider_kind = $_GET['kind'];
		setting_get($slider_kind, $slider_feature);
		
		if ($slider_feature == "ON"){
			$sliderStatus = "OFF";
			if(!setting_set($slider_kind, "OFF")) {
				if(!setting_new($slider_kind, "OFF")) {
					$error = true;
				}
			}
			
		} else {
			$sliderStatus = "ON";
			if(!setting_set($slider_kind, "ON")) {
				if(!setting_new($slider_kind, "ON")) {
					$error = true;
				}
			}
			
		}
		header("Location: ".DEFAULT_URL."/sitemgr/content/slidergo.php");
		exit;
?>