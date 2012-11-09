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
	# * FILE: /members/claim/getlisting.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	$resetDomainSession = true;
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	$accountObject = new Account($acctId);
	$contactObject = new Contact($acctId);
	$url_redirect = "".DEFAULT_URL."/members/claim";
	$url_base = "".DEFAULT_URL."/members";
	$members = 1;

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLAIM_FEATURE != "on") { exit; }
	if (!$claimlistingid) {
		header("Location: ".DEFAULT_URL."/members/");
		exit;
	}
	$listingObject = new Listing($claimlistingid);
	if (!$listingObject->getNumber("id") || ($listingObject->getNumber("id") <= 0)) {
		header("Location: ".DEFAULT_URL."/members/");
		exit;
	}
	if ($listingObject->getNumber("account_id")) {
		header("Location: ".DEFAULT_URL."/members/");
		exit;
	}
	if ($listingObject->getString("claim_disable") != "n") {
		header("Location: ".DEFAULT_URL."/members/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$status = new ItemStatus();

	$listingObject->setNumber("account_id", $acctId);
    if ($listingObject->getNumber("promotion_id") > 0){
      $listingObject->removePromotionID();  
    }
	$listingObject->setNumber("promotion_id", 0);
	$listingObject->setDate("renewal_date", "00/00/0000");
	$listingObject->setString("status", $status->getDefaultStatus());

	$listingObject->save();

	$db = db_getDBObject(DEFAULT_DB, true);
	$dbObjClaim = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
	$sqlClaim = "UPDATE Claim SET status = 'incomplete' WHERE account_id = '".$accountObject->getNumber("id")."' AND listing_id = '".$listingObject->getNumber("id")."' AND status = 'progress'";
	$dbObjClaim->query($sqlClaim);

	$claimObject = new Claim();

	$claimObject->setNumber("account_id", $accountObject->getNumber("id"));
	$claimObject->setString("username", $accountObject->getString("username"));
	$claimObject->setNumber("listing_id", $listingObject->getNumber("id"));
	$claimObject->setString("listing_title", $listingObject->getString("title", false));
	$claimObject->setString("step", "a");
	$claimObject->setString("status", "progress");

	$claimObject->setString("old_location_1", $listingObject->getNumber("location_1"));
	$claimObject->setString("new_location_1", $listingObject->getNumber("location_1"));
	$claimObject->setString("old_location_2", $listingObject->getNumber("location_2"));
	$claimObject->setString("new_location_2", $listingObject->getNumber("location_2"));
	$claimObject->setString("old_location_3", $listingObject->getNumber("location_3"));
	$claimObject->setString("new_location_3", $listingObject->getNumber("location_3"));
	$claimObject->setString("old_location_4", $listingObject->getNumber("location_4"));
	$claimObject->setString("new_location_4", $listingObject->getNumber("location_4"));
	$claimObject->setString("old_location_5", $listingObject->getNumber("location_5"));
	$claimObject->setString("new_location_5", $listingObject->getNumber("location_5"));
	$claimObject->setString("old_title", $listingObject->getString("title", false));
	$claimObject->setString("new_title", $listingObject->getString("title", false));
	$claimObject->setString("old_friendly_url", $listingObject->getString("friendly_url", false));
	$claimObject->setString("new_friendly_url", $listingObject->getString("friendly_url", false));
	$claimObject->setString("old_email", $listingObject->getString("email", false));
	$claimObject->setString("new_email", $listingObject->getString("email", false));
	$claimObject->setString("old_url", $listingObject->getString("url", false));
	$claimObject->setString("new_url", $listingObject->getString("url", false));
	$claimObject->setString("old_phone", $listingObject->getString("phone", false));
	$claimObject->setString("new_phone", $listingObject->getString("phone", false));
	$claimObject->setString("old_fax", $listingObject->getString("fax", false));
	$claimObject->setString("new_fax", $listingObject->getString("fax", false));
	$claimObject->setString("old_address", $listingObject->getString("address", false));
	$claimObject->setString("new_address", $listingObject->getString("address", false));
	$claimObject->setString("old_address2", $listingObject->getString("address2", false));
	$claimObject->setString("new_address2", $listingObject->getString("address2", false));
	$claimObject->setString("old_zip_code", $listingObject->getString("zip_code", false));
	$claimObject->setString("new_zip_code", $listingObject->getString("zip_code", false));
	$claimObject->setString("old_level", $listingObject->getNumber("level"));
	$claimObject->setString("new_level", $listingObject->getNumber("level"));
	$claimObject->setString("old_listingtemplate_id", $listingObject->getNumber("listingtemplate_id"));
	$claimObject->setString("new_listingtemplate_id", $listingObject->getNumber("listingtemplate_id"));

	$claimObject->save();

	/**************************************************************************************************/
	/*                                                                                                */
	/* E-mail notify                                                                                  */
	/*                                                                                                */
	/**************************************************************************************************/
	setting_get("sitemgr_send_email",$sitemgr_send_email);
	setting_get("sitemgr_email",$sitemgr_email);
	$sitemgr_emails = explode(",",$sitemgr_email);
	setting_get("sitemgr_claim_email",$sitemgr_claim_email);
	$sitemgr_claim_emails = explode(",",$sitemgr_claim_email);

	// site manager warning message ////////////////////////////////////////////////////////////////////
	$sitemgr_msg = "
		<html>
			<head>
				<style>
					.email_style_settings{
						font-size:12px;
						font-family:Verdana, Arial, Sans-Serif;
						color:#000;
					}
				</style>
			</head>
			<body>
				<div class=\"email_style_settings\">
					Site Manager,<br /><br />
					A new ".LISTING_FEATURE_NAME." has recently been claimed on ".EDIRECTORY_TITLE."!<br /><br />
					To approve the listing, follow the claim link below:<br />
					<b>Claim ID: </b>".$claimObject->getNumber("id")."<br />
					<a href=\"".DEFAULT_URL."/sitemgr/claim/view.php?id=".$claimObject->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/sitemgr/claim/view.php?id=".$claimObject->getNumber("id")."</a><br /><br />
					To preview the listing, follow the listing link below:<br />
					<b>".string_ucwords(LISTING_FEATURE_NAME).": </b>".$listingObject->getString("title")."<br />
					<a href=\"".DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER."/view.php?id=".$listingObject->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER."/view.php?id=".$listingObject->getNumber("id")."</a><br /><br />
					To see the user's account information follow the account link below:<br />
					<b>Account: </b>".system_showAccountUserName($accountObject->getString("username"))."<br />
					<a href=\"".DEFAULT_URL."/sitemgr/account/view.php?id=".$accountObject->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/sitemgr/account/view.php?id=".$accountObject->getNumber("id")."</a><br /><br />
					Account Details for the listing owner:<br />";
					$sitemgr_msg .= "<b>Username: </b>".$accountObject->getString("username")."<br />";
					$sitemgr_msg .= "<b>First name: </b>".$contactObject->getString("first_name")."<br />";
					$sitemgr_msg .= "<b>Last name: </b>".$contactObject->getString("last_name")."<br />";
					$sitemgr_msg .= "<b>Company: </b>".$contactObject->getString("company")."<br />";
					$sitemgr_msg .= "<b>Address: </b>".$contactObject->getString("address")." ".$contactObject->getString("address2")."<br />";
					$sitemgr_msg .= "<b>City: </b>".$contactObject->getString("city")."<br />";
					$sitemgr_msg .= "<b>State: </b>".$contactObject->getString("state")."<br />";
					$sitemgr_msg .= "<b>Zipcode: </b>".$contactObject->getString("zip")."<br />";
					$sitemgr_msg .= "<b>Country: </b>".$contactObject->getString("country")."<br />";
					$sitemgr_msg .= "<b>Phone: </b>".$contactObject->getString("phone")."<br />";
					$sitemgr_msg .= "<b>E-mail: </b>".$contactObject->getString("email")."<br />";
					$sitemgr_msg .= "<br /><br />Thank you.
				</div>
			</body>
		</html>";
	if ($sitemgr_send_email == "on") {
		if ($sitemgr_emails[0]) {
			foreach ($sitemgr_emails as $sitemgr_email) {
				system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] ".string_ucwords(LISTING_FEATURE_NAME)." Claim Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
			}
		}
	}
	if ($sitemgr_claim_emails[0]) {
		foreach ($sitemgr_claim_emails as $sitemgr_claim_email) {
			system_mail($sitemgr_claim_email, "[".EDIRECTORY_TITLE."] ".string_ucwords(LISTING_FEATURE_NAME)." Claim Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_claim_email>", "text/html",  '', '', $error);
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	header("Location: ".DEFAULT_URL."/members/claim/listinglevel.php?claimlistingid=".$claimlistingid);
	exit;

?>