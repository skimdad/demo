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
	# * FILE: /members/article/settings.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on" || CUSTOM_ARTICLE_FEATURE != "on") { exit; }

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

	$url_redirect = "".DEFAULT_URL."/members/".ARTICLE_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/members";
	$members = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$article = new Article($id);
		if (sess_getAccountIdFromSession() != $article->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/members/".ARTICLE_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		} else {
			if ($article->getString("status") == "S") {
				$article->setString("status", "A");
			} elseif ($article->getString("status") == "A") {
				$article->setString("status", "S");
			}
			$article->save();
			header("Location: ".DEFAULT_URL."/members/".ARTICLE_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	header("Location: ".DEFAULT_URL."/members/".ARTICLE_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
	exit;

?>
