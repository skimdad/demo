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
	# * FILE: /sitemgr/discountcode/settings.php
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

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	if ($_SERVER['REQUEST_METHOD'] == "GET") {
		if ($_GET["x_id"]) {
			$discountCodeObj = new DiscountCode($_GET["x_id"]);
			$discountCodeObj->setString("x_id", $_GET["x_id"]); // Existent discount id, this variable must be forced into the object because it is extracted to compose the form.
			$discountCodeObj->extract();
//			$expire_date = format_date($expire_date);
		} else {
			$message = 2;
			header("Location: ".DEFAULT_URL."/sitemgr/discountcode/index.php?screen=$screen&letter=$letter&message=".$message);
			exit;
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if (validate_form("discountcodesettings", $_POST, $message_discountcodesettings)) {
			$discountCodeObj = new DiscountCode($_POST["x_id"]);
			$discountCodeObj->setString("x_id", $_POST['x_id']); // Existent discount id, this variable must be forced into the object so it can make an update operation.
			$discountCodeObj->setString("status", $_POST['status']);
			$discountCodeObj->setDate("expire_date", $_POST['expire_date']);
			$discountCodeObj->Save();
			$message = 3;
			header("Location: ".DEFAULT_URL."/sitemgr/discountcode/index.php?screen=$screen&letter=$letter&message=".$message);
			exit;
		} else { // validation failure the object is instanciated to be extracted
			$discountCodeObj = new DiscountCode($_POST["x_id"]);
			$discountCodeObj->setString("x_id", $_POST['x_id']); // Existent discount id, this variable must be forced into the object so it can make an update operation.
			$discountCodeObj->extract();
//			$expire_date = format_date($expire_date);
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	// Discount Code Status Drop Down
	$discountCodeStatusObj = new DiscountCodeStatus();
	unset($arrayValue);
	unset($arrayName);
	$arrayValue = $discountCodeStatusObj->getValues();
	$arrayName = $discountCodeStatusObj->getNames();
	unset($arrayValueDD);
	unset($arrayNameDD);
	for ($i=0; $i<count($arrayValue); $i++) {
		if ($arrayValue[$i] != "E") {
			$arrayValueDD[] = $arrayValue[$i];
			$arrayNameDD[] = $arrayName[$i];
		}
	}
	$discountCodeStatusDropDown = html_selectBox("status", $arrayNameDD, $arrayValueDD, $status, "", "class='input-dd-form-settings'", "-- ".system_showText(LANG_SITEMGR_SELECTASTATUS)." --");

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
				<h1><?=string_ucwords(LANG_LABEL_DISCOUNTCODE)?> <?=system_showText(LANG_SITEMGR_MENU_SETTINGS)?></h1>
			</div>
		</div>
		<div id="content-content">
			<div class="default-margin">

				<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
				<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
				<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

				<? include(INCLUDES_DIR."/tables/table_discount_submenu.php"); ?>
				<br />

				<div class="baseForm">
					<form name="discount_setting" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
						<input type="hidden" name="x_id" value="<?=$id?>" />
						<? include(INCLUDES_DIR."/forms/form_discountcodesettings.php"); ?>
						<input type="hidden" name="letter" value="<?=$letter?>" />
						<input type="hidden" name="screen" value="<?=$screen?>" />
						<button type="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
						<button type="button" name="back" value="Back" class="input-button-form" onclick="document.getElementById('formdiscountcodesettingscancel').submit();"><?=system_showText(LANG_SITEMGR_BACK)?></button>
					</form>
					<form id="formdiscountcodesettingscancel" action="<?=DEFAULT_URL?>/sitemgr/discountcode/index.php" method="post">
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

	<script type="text/javascript">
		$(document).ready(function() {
			//DATE PICKER
			<?
			if ( DEFAULT_DATE_FORMAT == "m/d/Y" ) $date_format = "mm/dd/yy";
			elseif ( DEFAULT_DATE_FORMAT == "d/m/Y" ) $date_format = "dd/mm/yy";
			?>

			$('#expire_date').datepicker({
				dateFormat: '<?=$date_format?>',
				changeMonth: true,
				changeYear: true,
                yearRange: '<?=date("Y")?>:<?=date("Y")+10?>'
			});
		});
	</script>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>