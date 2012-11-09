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
	# * FILE: /members/claim/listing.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
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
	if ($listingObject->getNumber("account_id") != $acctId) {
		header("Location: ".DEFAULT_URL."/members/");
		exit;
	}

	$db = db_getDBObject(DEFAULT_DB, true);
	$dbObjClaim = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
	$sqlClaim = "SELECT id FROM Claim WHERE account_id = '".$acctId."' AND listing_id = '".$claimlistingid."' AND status = 'progress' AND step = 'b' ORDER BY date_time DESC LIMIT 1";
	$resultClaim = $dbObjClaim->query($sqlClaim);
	if ($rowClaim = mysql_fetch_assoc($resultClaim)) $claimID = $rowClaim["id"];
	if (!$claimID) {
		header("Location: ".DEFAULT_URL."/members/");
		exit;
	}
	$claimObject = new Claim($claimID);
	if (!$claimObject->getNumber("id") || ($claimObject->getNumber("id") <= 0)) {
		header("Location: ".DEFAULT_URL."/members/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$_POST["id"] = $claimlistingid;
	include(EDIRECTORY_ROOT."/includes/code/listing.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

?>

	<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
    <? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
    <? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
    
    <ul class="standardStep">
        <li class="standardStepAD"><?=system_showText(LANG_LABEL_EASY_AND_FAST);?> <span>3 <?=system_showText(LANG_LABEL_STEPS);?> &raquo;</span></li>
        <li><span>1</span>&nbsp;<?=system_showText(LANG_LABEL_ACCOUNT_SIGNUP);?></li>
        <li class="stepActived"><span>2</span>&nbsp;<?=system_showText(LANG_LISTING_UPDATE);?></li>
        <li><span>3</span>&nbsp;<?=system_showText(LANG_LABEL_CHECKOUT)?></li>
    </ul>
	
    <div class="content content-full">
		<h2><?=system_showText(LANG_MSG_CLAIM_THIS_LISTING)?></h2>

        <div>
            <h2><?=system_showText(LANG_LISTING_INFORMATION)?></h2>
    
            <form name="listing" id="listing" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">
    
                <input type="hidden" name="ieBugFix" value="1" />
    
                <input type="hidden" name="process" id="process" value="claim" />
                <input type="hidden" name="id" id="id" value="<?=$id?>" />
                <input type="hidden" name="claimlistingid" id="claimlistingid" value="<?=$claimlistingid?>" />
                <input type="hidden" name="claim_id" id="claim_id" value="<?=$claimID?>" />
                <input type="hidden" name="listingtemplate_id" id="listingtemplate_id" value="<?=$listingtemplate_id?>" />
                <input type="hidden" name="account_id" id="account_id" value="<?=$acctId?>" />
                <input type="hidden" name="level" id="level" value="<?=$level?>" />
    
                <? include(INCLUDES_DIR."/forms/form_listing.php"); ?>
    
                <input type="hidden" name="ieBugFix2" value="1" />
    
                <p class="standardButton claimButton">
                    <button type="button" onclick="JS_submit()"><?=system_showText(LANG_BUTTON_NEXT)?></button>
                </p>
    
            </form>
    
        </div>
   	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
