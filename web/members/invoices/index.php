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
	# * FILE: /members/invoices/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if (INVOICEPAYMENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------	
	extract($_GET);
	extract($_POST);
	
	$url_base = "".DEFAULT_URL."/members";
	
	include(INCLUDES_DIR."/code/invoice.php");
	
	// Page Browsing /////////////////////////////////////////
	$invoiceStatusObj = new InvoiceStatus();
	
	if($acctId)                           $sql_where[] = " account_id = $acctId ";
	if($invoiceStatusObj->getDefault())   $sql_where[] = " status != '".$invoiceStatusObj->getDefault()."' ";
	if ($sql_where)                       $where .= " ".implode(" AND ", $sql_where)." ";
	
	$pageObj  = new pageBrowsing("Invoice",$screen,RESULTS_PER_PAGE,"date DESC","","", $where);
	$invoices = $pageObj->retrievePage("array");
	
	$paging_url = DEFAULT_URL."/members/invoices/index.php";
	
	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_PAGING_GOTOPAGE).": ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

?>

			<div class="content">

				<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
				<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
				<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

				<h2><?=system_showText(LANG_MANAGE_INVOICES)?></h2>

				<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>

				<? 	if ($invoices) { ?>
					<? include(INCLUDES_DIR."/tables/table_invoice.php"); ?>
				<? } else { ?>
					<p class="informationMessage"><?=system_showText(LANG_MSG_NO_INVOICES_IN_THE_SYSTEM)?></p>
				<? } ?>

			</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
