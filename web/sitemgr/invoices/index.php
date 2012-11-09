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
	# * FILE: /sitemgr/invoices/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { header("Location:".DEFAULT_URL."/sitemgr");exit; }
	if (INVOICEPAYMENT_FEATURE != "on") { header("Location:".DEFAULT_URL."/sitemgr");exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	//increases frequently actions
	system_setFreqActions('invoice_history','INVOICEPAYMENT_FEATURE');

	$url_redirect = "".DEFAULT_URL."/sitemgr/invoices";
	$url_base = "".DEFAULT_URL."/sitemgr";

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	include(INCLUDES_DIR."/code/invoice.php");

	// Page Browsing /////////////////////////////////////////
	$invoiceStatusObj = new InvoiceStatus();
	
	if($invoiceStatusObj->getDefault())   $sql_where[] = " status != '".$invoiceStatusObj->getDefault()."' ";
	if ($sql_where)                       $where .= " ".implode(" AND ", $sql_where)." ";

	$pageObj  = new pageBrowsing("Invoice",$screen,RESULTS_PER_PAGE,"date DESC","","", $where);
	$invoices = $pageObj->retrievePage("array");

	$paging_url = DEFAULT_URL."/sitemgr/invoices/index.php";

	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------
	
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
		<h1><?=system_showText(LANG_SITEMGR_INVOICE_INVOICEHISTORY)?></h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<? include(INCLUDES_DIR."/tables/table_invoice_submenu.php"); ?>

		<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
			
		<? 	if ($invoices) { ?>
			<? include(INCLUDES_DIR."/tables/table_invoice.php"); ?>
		<? } else { ?>
			<p class="informationMessage">
				<?=system_showText(LANG_SITEMGR_INVOICE_NORECORD)?>
			</p>
		<? } ?>
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