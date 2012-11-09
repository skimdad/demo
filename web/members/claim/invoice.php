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
	# * FILE: /members/claim/invoice.php
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
	if (INVOICEPAYMENT_FEATURE != "on") { exit; }
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
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$claimObject->setString("step", "e");
		$claimObject->save();
		header("Location: ".DEFAULT_URL."/members/claim/claimfinish.php?claimlistingid=".$claimlistingid);
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$listing_id[] = $listingObject->getNumber("id");
	$second_step = 1;
	$payment_method = "invoice";

	setting_get("payment_tax_status", $payment_tax_status);
	setting_get("payment_tax_value", $payment_tax_value);
	customtext_get("payment_tax_label", $payment_tax_label, EDIR_LANGUAGE);

	include(INCLUDES_DIR."/code/billing.php");
	if ($bill_info["listings"]) foreach ($bill_info["listings"] as $id => $info);

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
            <h2><?=system_showText(LANG_LABEL_PAY_BY_INVOICE)?></h2>
    
            <? if ($paymentSystemError) { ?>
    
                <p class="errorMessage">
                    <?=$payment_message?><br />
                    <a href="<?=DEFAULT_URL?>/members/billing/index.php\"><?=system_showText(LANG_MSG_GO_TO_MEMBERS_CHECKOUT);?></a>.
                </p>
    
            <? } elseif ($payment_message) { ?>
    
                <p class="errorMessage">
                    <?=system_showText(LANG_MSG_PROBLEMS_WERE_FOUND)?>:<br />
                    <?=$payment_message?><br />
                    <a href="<?=DEFAULT_URL?>/members/billing/index.php\"><?=system_showText(LANG_MSG_GO_TO_MEMBERS_CHECKOUT);?></a>.
                </p>
    
            <? } elseif ((!$bill_info["listings"]) && (!$bill_info["events"]) && (!$bill_info["banners"]) && (!$bill_info["classifieds"]) && (!$bill_info["articles"])) { ?>
    
                <? echo "<p class=\"informationMessage\">".system_showText(LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT)."</p>"; ?>
    
            <? } else { ?>
    
                
                <?$listing = new Listing($_POST);
                
                
                
                /**************************************************************************************************/
                /*                                                                                                */
                /* E-mail notify                                                                                  */
                /*                                                                                                */
                /**************************************************************************************************/
                setting_get("sitemgr_email",$sitemgr_email);
                $contact = new Contact($acctId);
                //$body = system_showText(LANG_DEAR)." ".$contact->getString("first_name")." ".$contact->getString("last_name").",\n".system_showText(LANG_MSG_YOU_CAN_SEE_INVOICE)." ".DEFAULT_URL."/members/billing/invoice.php?id=".$bill_info["invoice_number"];
                //system_mail($contact->getString("email"), "[".EDIRECTORY_TITLE."] ".system_showText(LANG_INVOICE_NOTIFICATION), $body, EDIRECTORY_TITLE." <$sitemgr_email>", 'text/plain', '', '', $error);
                
                // sending e-mail to user //////////////////////////////////////////////////////////////////////////
                if ($emailNotificationObj = system_checkEmail(SYSTEM_INVOICE_NOTIFICATION, $contact->getString("lang"))) {
                    $subject = $emailNotificationObj->getString("subject");
                    $body = $emailNotificationObj->getString("body");		
                    $aux = explode("ACCOUNT_NAME",$body);
                    $body = $aux[0].$contact->getString("first_name")." ".$contact->getString("last_name").$aux[1];
                    $aux2 = explode("DEFAULT_URL",$body);
                    $body = $aux2[0].DEFAULT_URL."/members/billing/invoice.php?id=".$bill_info["invoice_number"]."\n".$aux2[1];
                    $body = system_replaceEmailVariables($body, $listing->getNumber('id'), 'listing');
                    $subject = system_replaceEmailVariables($subject, $listing->getNumber('id'), 'listing');
                    $body = html_entity_decode($body);
                    $subject = html_entity_decode($subject);
                    system_mail($contact->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
                }
                
                
                ////////////////////////////////////////////////////////////////////////////////////////////////////
                ?>
    
                <?
                $invoiceObj = new Invoice($bill_info["invoice_number"]);
                $invoiceObj->setString("status","P");
                $invoiceObj->Save();
                ?>
    
                <table class="standard-tableTOPBLUE">
                    <tr>
                        <th style="text-align:center"><?=system_showText(LANG_LABEL_INVOICENUMBER);?></th>
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
                        <td width="65" style="text-align:center; font-weight:bold;"><?=$bill_info["invoice_number"];?></td>
                        <td style="font-weight:bold;white-space:normal;"><?=$info["title"];?><?=($info["listingtemplate"]?"<span class=\"itemNote\">(".$info["listingtemplate"].")</span>":"");?></td>
                        <td><?=string_ucwords($info["level"]);?></td>
                        <td style="text-align:center;"><?=$info["extra_category_amount"];?></td>
                        <?
                        if (PAYMENT_FEATURE == "on") {
                            if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) {
                                ?><td style="text-align:center;"><?=(($info["discount_id"]) ? ($info["discount_id"]) : (system_showText(LANG_NA)));?></td><?
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
    
                <table border="0" cellpadding="0" cellspacing="0" class="standard-table">
                    <tr>
                        <th class="standard-tabletitle" colspan="2"><?=system_showText(LANG_LABEL_MAKE_CHECKS_PAYABLE)?></th>
                    </tr>
                    <tr>
                        <th><?=system_showText(LANG_LABEL_MAKE_CHECKS_PAYABLE)?>:</th>
                        <td><strong><?=EDIRECTORY_TITLE?></strong></td>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <td>
                            <ul class="basePrintNavbar">
                                <li>
                                    <a href="<?=DEFAULT_URL?>/members/billing/invoice.php?id=<?=$bill_info["invoice_number"]?>" class="iframe fancy_window_invoice"><?=system_showText(LANG_MSG_CLICK_TO_PRINT_INVOICE)?></a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <th><input type="checkbox" name="terms" id="terms" value="1" /></th>
                        <td>* <a href="<?=DEFAULT_URL?>/popup/popup.php?pop_type=terms" class="iframe fancy_window_terms"><?=system_showText(LANG_MSG_AGREE_TO_TERMS)?></a> <?=system_showText(LANG_MSG_I_WILL_SEND_PAYMENT)?></td>
                    </tr>
                </table>
    
                <form name="paybyinvoice" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" />
    
                    <input type="hidden" name="claimlistingid" value="<?=$claimlistingid?>">
    
                    <p class="standardButton completeButton">
                        <button type="button" id="authorizebutton" onclick="completeTheProcess();"><?=system_showText(LANG_BUTTON_COMPLETE_THE_PROCESS)?></button>
                    </p>
    
                </form>
    
                <script language="javascript" type="text/javascript">
                    <!--
                    function completeTheProcess() {
                        if (document.getElementById("terms").checked){
                            document.paybyinvoice.submit();
                        } else {
                            fancy_alert('<?=system_showText(LANG_MSG_ALERT_AGREE_WITH_TERMS_OF_USE);?>', 'informationMessage', false, 500, 100, false);
                        }
                    }
                    //-->
                </script>
    
            <? } ?>
    
        </div>
    </div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
