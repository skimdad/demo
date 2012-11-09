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
	# * FILE: /members/listing/settings.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();

	extract($_GET);
	extract($_POST);
	
	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$listing = new Listing($id);
		if (sess_getAccountIdFromSession() != $listing->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		} else {
			if ($listing->getString("status") == "S") {
				$listing->setString("status", "A");
			} elseif ($listing->getString("status") == "A") {
				$listing->setString("status", "S");
			}
			$listing->save();
			header("Location: ".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		}
	}
	
	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	header("Location: ".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
	exit;

?>
