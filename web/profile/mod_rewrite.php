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
	# * FILE: /socialnetwork/mod_rewrite.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------

	$id = sess_getAccountIdFromSession();
	
	extract($_GET);
	$dbObj = db_getDBObject(DEFAULT_DB, true);

	if ($_GET["url_full"]) {
		$url = str_replace(EDIRECTORY_FOLDER."/profile/", "", $_GET["url_full"]);
		$parts = explode("/", $url);

		/* FOR INDEX PAGE
		 * parts[0] = Friendly URL
		 * parts[1] = "page"
		 * parts[2] = Page Number
		 *
		 * FOR FAVORITES PAGE
		 * parts[0] = Friendly URL
		 * parts[1] = "favorites"
		 * parts[2] = "page"
		 * parts[3] = Page Number
		 *
		 * FOR DEALS
		 * parts[0] = Friendly URL
		 * parts[1] = "deals"
		 * parts[2] = "page"
		 * parts[3] = Page Number
		 */

		$friendlyUrl = str_replace(".html", "", $parts[0]);
		$friendlyUrl = str_replace(".htm", "", $friendlyUrl);

		if ($parts[1] == "page") {
			$pag_content = "reviews";
			if ($parts[1] && ($parts[2] && is_numeric($parts[2]))) {
				$screen = $parts[2];
			} else {
				$screen = 1;
			}
		} else if ($parts[1] == "favorites") {
			$pag_content = "favorites";
			if ($parts[2] && ($parts[3] && is_numeric($parts[3]))) {
				$screen = $parts[3];
			} else {
				$screen = 1;
			}
		} else if ($parts[1] == "deals") {
			$pag_content = "deals";
			if ($parts[2] && ($parts[3] && is_numeric($parts[3]))) {
				$screen = $parts[3];
			} else {
				$screen = 1;
			}
		} else {
			$slash = string_substr($_GET["url_full"], -1);
			if ($slash != "/") {
				Header( "HTTP/1.1 301 Moved Permanently" );
				Header( "Location: ".SOCIALNETWORK_URL."/".$friendlyUrl."/");
				exit;
			}
			$pag_content = "reviews";
			$screen = 1;
		}
	} else {
		if (!$_GET["c"]) {
			$pag_content = "reviews";
		} else if ($_GET["c"] == "favorites") {
			$pag_content = "favorites";
		} else if ($_GET["c"] == "deals") {
			$pag_content = "deals";
		}
	}

	if (($review_enabled != "on" && $review_article_enabled != "on" && $review_promotion_enabled != "on") || !$commenting_edir) {
		$pag_content = "favorites";
	}

	if ((!is_numeric($id) || $id == 0) && (!$friendlyUrl)) {
		header("Location: ".DEFAULT_URL);
		exit;
	}

	if (!$friendlyUrl && sess_getAccountIdFromSession() && $id == sess_getAccountIdFromSession()) {
		$sql = " SELECT id FROM Account
				 WHERE id = $id
				 AND has_profile = 'y'";
		$result = $dbObj->query($sql);
		$row = mysql_fetch_assoc($result);
		if (!$row) {
			header("Location: ".DEFAULT_URL."/members/");
			exit;
		}
	}

	if ($id && !$friendlyUrl) { 
		$dbObj = db_getDBObject(DEFAULT_DB, true);
		$sql = "SELECT * FROM Account WHERE id = ".$id."
				AND has_profile = 'y'";
		$result = $dbObj->query($sql);
		$row = mysql_fetch_assoc($result);
		if (!$row) {
			header("Location: ".DEFAULT_URL."/errorpage.php");
			exit;
		}
	} else if ($friendlyUrl) {
		$dbObj = db_getDBObject(DEFAULT_DB, true);
		$sql = " SELECT A.* FROM Account A
				 LEFT JOIN Profile P ON (A.id = P.account_id)
				 WHERE P.friendly_url = '".$friendlyUrl."'
				 AND A.has_profile = 'y'";
		$result = $dbObj->query($sql);
		$row = mysql_fetch_assoc($result);
		if (!$row) {
			header("Location: ".DEFAULT_URL."/errorpage.php");
			exit;
		} else {
			$_GET["id"] = $row["id"];
			extract($_GET);
		}
	}
?>