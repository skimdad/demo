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
	# * FILE: /sitemgr/discountcode/delete.php
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

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if($_POST["x_id"]){
			$discountCodeObj = new DiscountCode($_POST["x_id"]);
			$discountCodeObj->Delete();
			//$message = string_ucwords(LANG_LABEL_DISCOUNTCODE)." &quot;".$_POST["x_id"]."&quot; ".system_showText(LANG_SITEMGR_WASSUCCESSDELETED);
            $message = 0;
		}

		header("Location: ".DEFAULT_URL."/sitemgr/discountcode/index.php?screen=$screen&letter=$letter&message=".$message);
		exit;

	} elseif ($_SERVER["REQUEST_METHOD"] == "GET"){

		if ($_GET["x_id"]) {
			$discountCodeObj = new DiscountCode($_GET["x_id"]);
		} else {
			//$message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_REQUEST);
            $message = 1;
			header("Location: ".DEFAULT_URL."/sitemgr/discountcode/index.php?screen=$screen&letter=$letter&message=".$message);
			exit;
		}

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
		<h1><?=system_showText(LANG_SITEMGR_DELETE)?> <?=string_ucwords(LANG_LABEL_DISCOUNTCODE)?></h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
		
		<div class="baseForm">

		<form name="discountcode_delete" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">
			<input type="hidden" name="x_id" value="<?=$x_id?>" />
			<div class="header-form">
				<?=system_showText(LANG_SITEMGR_DELETE)?> <?=string_ucwords(LANG_LABEL_DISCOUNTCODE)?> "<?=$discountCodeObj->getString("id")?>"
			</div>
			<p class="informationMessage">
				<?=system_showText(LANG_SITEMGR_PROMOTIONALCODE_DELETEQUESTION)?>
			</p>
			<input type="hidden" name="letter" value="<?=$letter?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />
			<button type="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
			<button type="button" value="Cancel" class="input-button-form" onclick="document.getElementById('formdiscountcodedeletecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
		</form>
		<form id="formdiscountcodedeletecancel" action="<?=DEFAULT_URL?>/sitemgr/discountcode/index.php" method="post">
			<input type="hidden" name="letter" value="<?=$letter?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />
		</form>
		
		</div>
	</div>
</div>
<div id="bottom-content">
	&nbsp;
</div>
</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
