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
	# * FILE: /members/claim/payment.php
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
	if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on")) { exit; }
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
	$sqlClaim = "SELECT id FROM Claim WHERE account_id = '".$acctId."' AND listing_id = '".$claimlistingid."' AND status = 'progress' AND step = 'd' ORDER BY date_time DESC LIMIT 1";
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
	$listing_id[] = $listingObject->getNumber("id");
	$second_step = 1;
	include(INCLUDES_DIR."/code/billing.php");
	if ($bill_info["listings"]) foreach ($bill_info["listings"] as $id => $info);

	setting_get("payment_tax_status", $payment_tax_status);
	setting_get("payment_tax_value", $payment_tax_value);
	customtext_get("payment_tax_label", $payment_tax_label, EDIR_LANGUAGE);

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
            <h2><?=system_showText(LANG_MENU_MAKEPAYMENT)?></h2>
    
            <? if ($paymentSystemError) { ?>
    
                <p class="errorMessage">
                    <?=$payment_message?><br />
                    <a href="<?=DEFAULT_URL?>/members/billing/index.php"><?=system_showText(LANG_MSG_GO_TO_MEMBERS_CHECKOUT);?></a>.
                </p>
    
            <? } elseif ($payment_message) { ?>
    
                <p class="errorMessage">
                    <?=system_showText(LANG_MSG_PROBLEMS_WERE_FOUND)?>:<br />
                    <?=$payment_message?><br />
                    <a href="<?=DEFAULT_URL?>/members/billing/index.php"><?=system_showText(LANG_MSG_GO_TO_MEMBERS_CHECKOUT);?></a>.
                </p>
    
            <? } elseif ((!$bill_info["listings"]) && (!$bill_info["events"]) && (!$bill_info["banners"]) && (!$bill_info["classifieds"]) && (!$bill_info["articles"])) { ?>
    
                <? echo "<p class=\"informationMessage\">".system_showText(LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT)."</p>"; ?>
    
            <? } else { ?>
    
                <table class="standard-tableTOPBLUE">
                    <tr>
                        <th><?=system_showText(LANG_LISTING_FEATURE_NAME);?></th>
                        <th><?=system_showText(LANG_LABEL_LEVEL);?></th>
                        <th><?=system_showText(LANG_LABEL_EXTRA_CATEGORY);?></th>
                        <?
                        if (PAYMENT_FEATURE == "on") {
                            if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) {
                                ?><th><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th><?
                            }
                        }
                        ?>
                        <th><?=system_showText(LANG_LABEL_RENEWAL);?></th>
    
                        <? if ($payment_tax_status == "on") { ?>
                            <th><?=system_showText(LANG_SUBTOTAL);?></th>
                        <? } ?>
    
                        <? if ($payment_tax_status == "on") { ?>
                            <th><?=$payment_tax_label."(".$payment_tax_value."%)";?></th>
                        <? } ?>
                        
                        <th><?=system_showText(LANG_LABEL_TOTAL);?></th>
                    </tr>
                    <tr>
                        <td>
                            <strong title="<?=$info["title"]?>">
                                <?= system_showTruncatedText($info["title"], 60);?>
                                <?=($info["listingtemplate"]?"<span class=\"itemNote\">(".$info["listingtemplate"].")</span>":"");?>
                            </strong>
                        </td>
                        <td><?=string_ucwords($info["level"]);?></td>
                        <td><?=$info["extra_category_amount"];?></td>
                        <?
                        if (PAYMENT_FEATURE == "on") {
                            if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) {
                                ?><td><?=(($info["discount_id"]) ? ($info["discount_id"]) : (system_showText(LANG_NA)));?></td><?
                            }
                        }
                        ?>
                        <td><?=format_date($info["renewal_date"]);?></td>
    
                        <? if ($payment_tax_status == "on") { ?>
                            <td><?=CURRENCY_SYMBOL." ".$bill_info["total_bill"];?></td>
                        <? } ?>
    
                        <? if ($payment_tax_status == "on") { ?>
                            <td><?=CURRENCY_SYMBOL." ".payment_calculateTax($bill_info["total_bill"], $payment_tax_value, true, false);?></td>
                        <? } ?>
    
                        <td>
                            <?
                                if ($payment_tax_status == "on") echo CURRENCY_SYMBOL." ".payment_calculateTax($bill_info["total_bill"], $payment_tax_value, true);
                                else echo CURRENCY_SYMBOL." ".$bill_info["total_bill"];
                            ?>
                        </td>
                    </tr>
                </table>
    
                <br />
    
                <?
                $payment_process = "claim";
                if (file_exists(INCLUDES_DIR."/forms/form_billing_".$payment_method.".php")) {
                    include(INCLUDES_DIR."/forms/form_billing_".$payment_method.".php");
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
