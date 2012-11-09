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
	# * FILE: /classified/detail.php
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
	if (CLASSIFIED_FEATURE != "on" || CUSTOM_CLASSIFIED_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# MOD-REWRITE
	# ----------------------------------------------------------------------------------------------------
	include(CLASSIFIED_EDIRECTORY_ROOT."/mod_rewrite.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# CLASSIFIED
	# ----------------------------------------------------------------------------------------------------
	if (($_GET["id"]) || ($_POST["id"])) {
		$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];
		$classified = new Classified($id);
		$level = new ClassifiedLevel(EDIR_DEFAULT_LANGUAGE, true);
		unset($classifiedMsg);
		if ((!$classified->getNumber("id")) || ($classified->getNumber("id") <= 0)) {
			$classifiedMsg = system_showText(LANG_MSG_NOTFOUND);
		} elseif ($classified->getString("status") != "A") {
			$classifiedMsg = system_showText(LANG_MSG_NOTAVAILABLE);
		} elseif ($level->getDetail($classified->getNumber("level")) != "y" && $level->getActive($classified->getNumber("level")) == 'y') {
			$classifiedMsg = system_showText(LANG_MSG_NOTAVAILABLE);
		} else {
			report_newRecord("classified", $id, CLASSIFIED_REPORT_DETAIL_VIEW);
			$classified->setNumberViews($id);
		}
	} else {
		header("Location: ".CLASSIFIED_DEFAULT_URL."/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	if (($classified->getNumber("id")) && ($classified->getNumber("id") > 0)) {
		$claCategs = $classified->getCategories();
		if ($claCategs) {
			foreach ($claCategs as $claCateg) {
				$category_id[] = $claCateg->getNumber("id");
			}
		}
	}
	$_POST["category_id"] = $category_id;
	$banner_section = "classified";
	$headertag_title = (($classified->getString("seo_title"))?($classified->getString("seo_title")):($classified->getString("title")));
	$headertag_description = (($classified->getStringLang(EDIR_LANGUAGE, "seo_summarydesc"))?($classified->getStringLang(EDIR_LANGUAGE, "seo_summarydesc")):($classified->getStringLang(EDIR_LANGUAGE, "summarydesc")));
	$headertag_keywords = (($classified->getStringLang(EDIR_LANGUAGE, "seo_keywords"))?($classified->getStringLang(EDIR_LANGUAGE, "seo_keywords")):(str_replace(" || ", ", ", $classified->getStringLang(EDIR_LANGUAGE, "keywords"))));
	include(system_getFrontendPath("header.php", "layout"));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# BODY
	# ----------------------------------------------------------------------------------------------------
	include(THEMEFILE_DIR."/".EDIR_THEME."/body/classified_detail.php");
	
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$banner_section = "classified";
	include(system_getFrontendPath("footer.php", "layout"));

?>
