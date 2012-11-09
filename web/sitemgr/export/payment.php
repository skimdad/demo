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
	# * FILE: /sitemgr/export/payment.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");
    if ( PAYMENTSYSTEM_FEATURE != 'on' ) header("Location:".DEFAULT_URL."/sitemgr");
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# INCREASES FREQUENTLY ACTIONS
	# ----------------------------------------------------------------------------------------------------
	system_setFreqActions('export_paymentrecords','PAYMENTSYSTEM_FEATURE');

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	$type_invoice = "";
	$type_online = "checked";
	if($_GET["type"]) {
		if($_GET["type"]=="invoice") {
			$type_invoice = "checked";
			$type_online = "";
		} elseif($_GET["type"]=="online") {
			$type_online = "checked";
			$type_invoice = "";
		}
	}

	include(INCLUDES_DIR."/code/export_payment.php");
    
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
		<h1><?=string_ucwords(LANG_SITEMGR_NAVBAR_DATA_MANAGEMENT);?></h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<? include (INCLUDES_DIR."/tables/table_data_submenu.php"); ?>
		
		<div id="header-export"><?=system_showText(LANG_SITEMGR_MENU_EXPORTPAYMENTRECORDS)?></div>

		<? if ($error) { ?>
		<div class="errorMessage"><?=$error?></div>
		<? } ?>
		<form name="export_payment" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
			<? include(INCLUDES_DIR."/forms/form_export_payment.php"); ?>
				<table style="margin: 0 auto 0 auto;">
				<tr>
					<td>
						<button type="submit" name="btn_export_payment" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
					</td>
				</tr>
			</table>
		</form>
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

		$('#date_start').datepicker({
			dateFormat: '<?=$date_format?>',
			changeMonth: true,
			changeYear: true
		});

		$('#date_end').datepicker({
			dateFormat: '<?=$date_format?>',
			changeMonth: true,
			changeYear: true
		});
    });
</script>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>