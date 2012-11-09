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
	# * FILE: /sitemgr/custominvoices/search.php
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
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);	

	//increases frequently actions
	if (!isset($acct_search_field_name)) system_setFreqActions('custominvoice_search','CUSTOM_INVOICE_FEATURE');

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	$error = false;

	// Page Browsing ////////////////////////////////////////

	if ($search_account_id) $sql_where[] = " account_id = $search_account_id ";
	if ($search_status) {
		if ($search_status == "paid")
			$sql_where[] = " paid = 'y' ";
		elseif ($search_status == "sent") {
			$sql_where[] = " sent = 'y' ";
			$sql_where[] = " paid != 'y' ";
		}
		elseif($search_status == "pending") {
			$sql_where[] = " paid != 'y' ";
			$sql_where[] = " sent != 'y' ";
		}
	}

	if ($do_search) {

		if (!$search_date_from && $search_date_to) {
			if (validate_date($search_date_to)) {
				$sql_where[] = " (date <= (".db_formatDate($search_date_to)."))";
			} else {
				$error = true;
				$message_searchcustominvoice = "&#149; ".system_showText(LANG_SITEMGR_MSGERROR_INVALID_ENDDATE);
			}
		}

		if ($search_date_from && !$search_date_to) {
			if (validate_date($search_date_from)) {
				$sql_where[] = " (date >= (".db_formatDate($search_date_from)."))";
			} else {
				$error = true;
				$message_searchcustominvoice = "&#149; ".system_showText(LANG_SITEMGR_MSGERROR_INVALID_STARTDATE);
			}
		}

		if ($search_date_from && $search_date_to) {
			if (validate_date($search_date_from) && validate_date($search_date_to)) {
				//formating dates
				$search_from = db_formatDate($search_date_from);
				$search_to = db_formatDate($search_date_to);
				$sql_where[] = " SUBSTRING(date,1,10) BETWEEN $search_from AND $search_to ";
			} else {
				$error = true;
				$message_searchcustominvoice = "&#149; ".system_showText(LANG_SITEMGR_MSGERROR_INVALID_DATERANGE);
			}
		}

	}

	if ($search_title) $sql_where[] = " title LIKE '%".addslashes($search_title)."%' ";

	if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";

	$_GET["search_page"] = "1";
	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	$pageObj  = new pageBrowsing("CustomInvoice", $screen, RESULTS_PER_PAGE, "date DESC", "", "", $where);

	if (!$error) {
		$custominvoices = $pageObj->retrievePage("object");		
	} else {
		$pageObj->setString("record_amount", 0);
		unset($custominvoices);
	}
	$paging_url = DEFAULT_URL."/sitemgr/custominvoices/search.php";

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

	$_GET = format_magicQuotes($_GET);
	extract($_GET);
	$_POST = format_magicQuotes($_POST);
	extract($_POST);

?>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_SEARCH)?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_custominvoice_submenu.php"); ?>

			<br />

			<?
				if ($message_searchcustominvoice) {
					echo "<p class=\"errorMessage\">$message_searchcustominvoice</p>";
				}
			?>

			<form name="custominvoice" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="get">

				<input type="hidden" name="do_search" value="1" />

				<? include(INCLUDES_DIR."/forms/form_searchcustominvoice.php"); ?>

				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_MENU_SEARCH)?></button>
						</td>
						<td>
							<button type="button" onclick="emptySearchAccount(); searchResetSitemgr(this.form);" class="input-button-form"><?=system_showText(LANG_SITEMGR_CLEAR)?></button>
						</td>
					</tr>
				</table>

			</form>

			<div class="header-form">
				<?=system_showText(LANG_SITEMGR_RESULTS)?>
			</div>

			<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>

			<? if ($custominvoices) { ?>

				<? include(INCLUDES_DIR."/tables/table_custominvoice.php"); ?>

			<? } else { ?>

					<p class="errorMessage"><?=system_showText(LANG_SITEMGR_NORESULTS)?></p>

			<? } ?>

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

		$('#search_date_from').datepicker({
			dateFormat: '<?=$date_format?>',
			changeMonth: true,
			changeYear: true
		});
		$('#search_date_to').datepicker({
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