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
	# * FILE: /members/classified/settings.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on" || CUSTOM_CLASSIFIED_FEATURE != "on") { exit; }

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

	$url_redirect = "".DEFAULT_URL."/members/".CLASSIFIED_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/members";
	$members = 1;
	
	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$classified = new Classified($id);
		if (sess_getAccountIdFromSession() != $classified->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/members/".CLASSIFIED_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		} else {
			if ($classified->getString("status") == "S") {
				$classified->setString("status", "A");
			} elseif ($classified->getString("status") == "A") {
				$classified->setString("status", "S");
			}
			$classified->save();
			header("Location: ".DEFAULT_URL."/members/".CLASSIFIED_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	header("Location: ".DEFAULT_URL."/members/".CLASSIFIED_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
	exit;

?>
