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
	# * FILE: /sitemgr/custominvoices/view.php
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

	$url_redirect = "".DEFAULT_URL."/sitemgr/custominvoices";
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$customInvoice = new CustomInvoice($id);
		$account = new Account($customInvoice->getNumber("account_id"));
		$contactObj = db_getFromDB("contact", "account_id", $account->getNumber("id"));
	} else {
		header("Location: ".DEFAULT_URL."/sitemgr/custominvoices");
		exit;
	}

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
		<h1><?=string_ucwords(system_showText(LANG_SITEMGR_CUSTOMINVOICE))?> <?=system_showText(LANG_SITEMGR_PREVIEW)?></h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<? include(INCLUDES_DIR."/tables/table_custominvoice_submenu.php"); ?>

		<? if ($message) { ?>
			<p class="successMessage"><?=$msg_custominvoice[$message]?></p>
		<? } ?>

		<br />

		<p style="font-size: 13px; font-family: Verdana; color: #003365; font-weight: bold;" title="<?=$customInvoice->getString("title")?>"><?=$customInvoice->getString("title", true, 35);?></p>
		<? setting_get("payment_tax_status", $taxStatus); ?>

		<? if ($customInvoice->getString("paid") != "y") { ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="submit_button" value="<?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_CLICKHERETOSEND)?>" class="input-button-form" style="width: 350px;" onclick="javascript:document.location.href='<?=DEFAULT_URL."/sitemgr/custominvoices/send.php?id=".$id?>';"><?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_CLICKHERETOSEND)?></button>
						</td>
					</tr>
					<? if ($taxStatus) {?>
					<tr>
						<p class="informationMessage">* <?=system_showText(LANG_SITEMGR_LABEL_TAX_AFTER_PAID)?></p>
					</tr>
					<? } ?>
				</table>
		<? } ?>

		<? include_once(EDIRECTORY_ROOT."/includes/views/view_custominvoice_detail.php");?>

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