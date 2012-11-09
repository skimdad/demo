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
	# * FILE: /sitemgr/discountcode/index.php
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

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	extract($_GET);
	extract($_POST);

	//increases frequently actions
	if (!isset($message)) system_setFreqActions('discountcode_manage','PAYMENTSYSTEM_FEATURE');

	$url_base = "".DEFAULT_URL."/sitemgr";

	// Page Browsing ////////////////////////////////////////
	$pageObj = new pageBrowsing("Discount_Code",$screen,RESULTS_PER_PAGE,"id","id",$letter);

	$discount_codes = $pageObj->retrievePage();

	$paging_url = DEFAULT_URL."/sitemgr/discountcode/index.php";

	// Letters Menu
	$letters = $pageObj->getString("letters");

	foreach($letters as $each_letter)
		if ($each_letter == "#") {
			$letters_menu .= "<a href=\"$paging_url?letter=no\" ".(($letter == "no") ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
			//$letters_menu .= "<a href=\"$paging_url\" ".((!$letter) ? "class=\"firstLetter\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		} else {
			$letters_menu .= "<a href=\"$paging_url?letter=".$each_letter."\" ".(($each_letter == $letter) ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		}
		
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
		<h1><?=string_ucwords(LANG_LABEL_DISCOUNTCODE)?></h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<? include(INCLUDES_DIR."/tables/table_discount_submenu.php"); ?>

		<div class="informationMessage"><?=system_showText(LANG_SITEMGR_PROMOTIONALCODE_TIP1)?></div>
        
        <? include(INCLUDES_DIR."/tables/table_paging.php"); ?>

        <? if ($discount_codes) { ?>
			<? include(INCLUDES_DIR."/tables/table_discountcode.php"); ?>
		<? } else { ?>
			<p class="informationMessage">
				<?=system_showText(LANG_SITEMGR_PROMOTIONALCODE_NORECORD)?>
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