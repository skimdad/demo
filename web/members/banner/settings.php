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
	# * FILE: /members/banner/settings.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BANNER_FEATURE != "on" || CUSTOM_BANNER_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_base = "".DEFAULT_URL."/members";
	$url_redirect = $url_base."/".BANNER_FEATURE_FOLDER;
	$members = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$bannerObj = new Banner($id);
		if (sess_getAccountIdFromSession() != $bannerObj->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/members/".BANNER_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		} else {
			if ($bannerObj->getString("status") == "S") {
				$bannerObj->setString("status", "A");
			} elseif ($bannerObj->getString("status") == "A") {
				$bannerObj->setString("status", "S");
			}
			$bannerObj->save();
			header("Location: ".DEFAULT_URL."/members/".BANNER_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	header("Location: ".DEFAULT_URL."/members/".BANNER_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
	exit;

?>
