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
	# * FILE: /event/detail.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSessionFront();
	
	# ----------------------------------------------------------------------------------------------------
	# MAINTENANCE MODE
	# ----------------------------------------------------------------------------------------------------
	verify_maintenanceMode();
	
	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on" || CUSTOM_EVENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# MOD-REWRITE
	# ----------------------------------------------------------------------------------------------------
	include(EVENT_EDIRECTORY_ROOT."/mod_rewrite.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# EVENT
	# ----------------------------------------------------------------------------------------------------
	if (($_GET["id"]) || ($_POST["id"])) {
		$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];
		$event = new Event($id);
		$level = new EventLevel(EDIR_DEFAULT_LANGUAGE, true);
		unset($eventMsg);
		if ((!$event->getNumber("id")) || ($event->getNumber("id") <= 0)) {
			$eventMsg = system_showText(LANG_MSG_NOTFOUND);
		} elseif ($event->getString("status") != "A") {
			$eventMsg = system_showText(LANG_MSG_NOTAVAILABLE);
		} elseif ($level->getDetail($event->getNumber("level")) != "y" && $level->getActive($event->getNumber("level")) == 'y') {
			$eventMsg = system_showText(LANG_MSG_NOTAVAILABLE);
		} else {
			report_newRecord("event", $id, EVENT_REPORT_DETAIL_VIEW);
			$event->setNumberViews($id);
		}
	} else {
		header("Location: ".EVENT_DEFAULT_URL."/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	if (($event->getNumber("id")) && ($event->getNumber("id") > 0)) {
		$evCategs = $event->getCategories();
		if ($evCategs) {
			foreach ($evCategs as $evCateg) {
				$category_id[] = $evCateg->getNumber("id");
			}
		}
	}
	$_POST["category_id"] = $category_id;
	$banner_section = "event";
	$headertag_title = (($event->getString("seo_title"))?($event->getString("seo_title")):($event->getString("title")));
	$headertag_description = (($event->getStringLang(EDIR_LANGUAGE, "seo_description"))?($event->getStringLang(EDIR_LANGUAGE, "seo_description")):($event->getStringLang(EDIR_LANGUAGE, "description")));
	$headertag_keywords = (($event->getStringLang(EDIR_LANGUAGE, "seo_keywords"))?($event->getStringLang(EDIR_LANGUAGE, "seo_keywords")):(str_replace(" || ", ", ", $event->getStringLang(EDIR_LANGUAGE, "keywords"))));
	include(system_getFrontendPath("header.php", "layout"));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# BODY
	# ----------------------------------------------------------------------------------------------------
	include(THEMEFILE_DIR."/".EDIR_THEME."/body/event_detail.php");
	
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$banner_section = "event";
	include(system_getFrontendPath("footer.php", "layout"));

?>
