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
	# * FILE: /sitemgr/custominvoices/custominvoice.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { header("Location:".DEFAULT_URL."/sitemgr");exit; }
	if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on")) { header("Location:".DEFAULT_URL."/sitemgr");exit; }
	if (CUSTOM_INVOICE_FEATURE != "on") { header("Location:".DEFAULT_URL."/sitemgr");exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);	

	//increases frequently actions
	if (!isset($acct_search_field_name)) system_setFreqActions('custominvoice_add','CUSTOM_INVOICE_FEATURE');

	$url_redirect = "".DEFAULT_URL."/sitemgr/custominvoices";
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(INCLUDES_DIR."/code/custominvoice.php");

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$url_redirect = "".DEFAULT_URL."/sitemgr/custominvoices";
	$url_base     = "".DEFAULT_URL."/sitemgr";

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

<div id="main-right">

    <div id="top-content">
        <div id="header-content">
            <h1><?=system_showText(LANG_SITEMGR_ADD)?> <?=string_ucwords(system_showText(LANG_SITEMGR_CUSTOMINVOICE))?></h1>
        </div>
    </div>

    <div id="content-content">

        <? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
        <? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
        <? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

        <? include(INCLUDES_DIR."/tables/table_custominvoice_submenu.php"); ?>
        
        <div class="baseForm">

            <form name="custominvoice" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">
                <input type="hidden" name="id" value="<?=$id?>" />
                <? include(INCLUDES_DIR."/forms/form_custominvoice.php"); ?>
                <button type="button" name="submit_button" value="<?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_CONTINUETOSEND)?>" class="input-button-form btExpanded" onclick="document.custominvoice.submit();"><?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_CONTINUETOSEND)?></button>
                <button type="button" value="Cancel" class="input-button-form" onclick="document.getElementById('formcustominvoicecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
            </form>
            <form id="formcustominvoicecancel" action="<?=DEFAULT_URL?>/sitemgr/custominvoices/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">
                <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
                <input type="hidden" name="letter" value="<?=$letter?>" />
                <input type="hidden" name="screen" value="<?=$screen?>" />
            </form>
            
        </div>
        
    </div>
    
    <div id="bottom-content">&nbsp;</div>

</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>