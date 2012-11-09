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
	# * FILE: /sitemgr/claim/approve.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLAIM_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/sitemgr/claim";
	$url_base     = "".DEFAULT_URL."/sitemgr";

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$errorPage = DEFAULT_URL."/sitemgr/claim/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "");
	if ($id) {
		$claim = new Claim($id);
		if ((!$claim->getNumber("id")) || ($claim->getNumber("id") <= 0)) {
			header("Location: ".$errorPage);
			exit;
		}
		if (!$claim->canApprove()) {
			header("Location: ".$errorPage);
			exit;
		}
	} else {
		header("Location: ".$errorPage);
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$claim->setString("status", "approved");
	$claim->save();

	$listing = new Listing($claim->getNumber("listing_id"));

	$image_id = $listing->getNumber("image_id");
	$thumb_id = $listing->getNumber("thumb_id");
	$galleryArray = $listing->getGalleries();
	system_renameGalleryImages($image_id, $thumb_id, $claim->getNumber("account_id"), $galleryArray[0]);

	$domain = new Domain(SELECTED_DOMAIN_ID);
	setting_get("claim_approveemail", $claim_approveemail);
	if ($claim_approveemail) {
		setting_get("sitemgr_email",$sitemgr_email);
		$contact = new Contact($claim->getNumber("account_id"));
		if ($emailNotificationObj = system_checkEmail(SYSTEM_CLAIM_APPROVED, $contact->getString("lang"))) {
			$domain = new Domain(SELECTED_DOMAIN_ID);
			$subject = $emailNotificationObj->getString("subject");
			$body = $emailNotificationObj->getString("body");
			$body = system_replaceEmailVariables($body, $listing->getNumber('id'), 'listing');
			$body = str_replace($_SERVER["HTTP_HOST"],$domain->getString("url"), $body);
			$subject = system_replaceEmailVariables($subject, $listing->getNumber('id'), 'listing');
			$body    = str_replace("DEFAULT_URL", DEFAULT_URL, $body);
			$body	 = str_replace($_SERVER["HTTP_HOST"], $domain->getstring("url"), $body);
			$body = html_entity_decode($body);
			$subject = html_entity_decode($subject);
			system_mail($contact->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
		}
	}

	$message = 1;
    header("Location: ".DEFAULT_URL."/sitemgr/claim/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : ""));
	exit;

?>
