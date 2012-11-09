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
	# * FILE: /members/signup/packages.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");
	
	include(EDIRECTORY_ROOT."/includes/code/order_package.php");

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
	$url_redirect = "".DEFAULT_URL."/members/signup";
	$url_base = "".DEFAULT_URL."/members";
	$members = 1;

	setting_get("payment_tax_status", $payment_tax_status);
	setting_get("payment_tax_value", $payment_tax_value);
	customtext_get("payment_tax_label", $payment_tax_label, EDIR_LANGUAGE);

	if ($item_type && $item_level){
		/*
		 * Check if exists package
		 */
		$packageObj = new Package();
		$array_package_offers = $packageObj->getPackagesByDomainID(SELECTED_DOMAIN_ID, $item_type, $item_level);
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");
?>

	<div class="packagesExtendedContent noBackground">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
		
		<ul class="standardStep">
			<li class="standardStepAD"><?=system_showText(LANG_LABEL_EASY_AND_FAST);?> <span><?=system_showText(LANG_THREESTEPS)?> &raquo;</span></li>
			<li class="stepActived"><span>1</span>&nbsp;<?=system_showText(LANG_LABEL_ORDER)?></li>
			<li><span>2</span>&nbsp;<?=system_showText(LANG_LABEL_CHECKOUT)?></li>
			<li><span>3</span>&nbsp;<?=system_showText(LANG_LABEL_CONFIGURATION)?></li>	
		</ul>

	</div>
    
    <span class="clear"></span>
    
    <div class="package">

        <form name="package" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
    
			<? include(EDIRECTORY_ROOT."/includes/forms/form_orderpackage.php")?>
            
        </form>
        
	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
