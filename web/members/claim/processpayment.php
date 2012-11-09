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
	# * FILE: /members/claim/processpayment.php
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
	if (PAYMENT_FEATURE != "on") { exit; }
	if (CREDITCARDPAYMENT_FEATURE != "on") { exit; }

	$db = db_getDBObject(DEFAULT_DB, true);
	$dbObjClaim = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
	$sqlClaim = "SELECT id FROM Claim WHERE account_id = '".$acctId."' AND status = 'progress' AND step = 'd' ORDER BY date_time DESC LIMIT 1";
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

	$claimlistingid = $claimObject->getNumber("listing_id");

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

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$process = "claim";
	include(INCLUDES_DIR."/code/billing_".$payment_method.".php");

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
        <li><span>2</span>&nbsp;<?=system_showText(LANG_LISTING_UPDATE);?></li>
        <li class="stepActived"><span>3</span>&nbsp;<?=system_showText(LANG_LABEL_CHECKOUT)?></li>
    </ul>
        
	<div class="content content-full">
        <h2><?=system_showText(LANG_MSG_CLAIM_THIS_LISTING)?></h2>

        <div>
            <?
            if (!empty($listing_ids[0])) {
                foreach ($listing_ids as $each_listing_id) {
                    $listingObject = new Listing($each_listing_id);
                    echo "<h1 class=\"standardTitle\">".string_ucwords(LANG_LISTING_FEATURE_NAME).": <span>".$listingObject->getString("title")."</span></h1>";
                }
            }
            ?>
    
            <h2><?=system_showText(LANG_LABEL_PAYMENTSTATUS);?></h2>
    
            <?
            if ($payment_success == "y") {
                $contentObj = new Content("", EDIR_LANGUAGE);
                $content = $contentObj->retrieveContentByType("Transaction");
                if ($content) {
                    echo "<div class=\"dynamicContent\">".$content."</div>";
                }
            }
            ?>
    
            <?
            if ($payment_message) { 
                echo $payment_message;
            }
            ?>
    
            <?
            if ($payment_success == "y") {
    
                $claimObject->setString("step", "e");
                $claimObject->save();
                $next = DEFAULT_URL."/members/claim/claimfinish.php?claimlistingid=".$claimlistingid;
                ?>
    
                <p class="informationMessage">
                    <?=system_showText(LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU)?><br />
                    <?=system_showText(LANG_MSG_IF_IT_DOES_NOT_WORK)?> <a href="<?=$next?>"><?=system_showText(LANG_LABEL_CLICK_HERE)?></a>.
                </p>
                <script language="javascript" type="text/javascript">
                    window.setTimeout("window.location='<?=$next?>'", 10000);
                </script>
    
                <?
                $contentObj = new Content("", EDIR_LANGUAGE);
                $content = $contentObj->retrieveContentByType("Transaction Bottom");
                if ($content) {
                    echo "<div class=\"dynamicContent\">".$content."</div>";
                }
                ?>
    
            <? } ?>
    
        </div>
    </div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
