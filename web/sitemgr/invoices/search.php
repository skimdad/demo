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
	# * FILE: /sitemgr/invoices/search.php
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
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	//increases frequently actions
	if (!isset($acct_search_field_name)) system_setFreqActions('invoice_search','INVOICEPAYMENT_FEATURE');

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$url_redirect = "".DEFAULT_URL."/sitemgr/invoices";
	$url_base     = "".DEFAULT_URL."/sitemgr";

	##################################################################################################################################
	# STATUS
	##################################################################################################################################	
	$invoiceStatusObj = new InvoiceStatus();
	$statusDropDown = html_selectBox("search_status", $invoiceStatusObj->getNames(), $invoiceStatusObj->getValues(), $search_status, "", "class='input-dd-form-searchinvoice'", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");

	// Page Browsing ////////////////////////////////////////

	if ($search_id)                       $sql_where[] = " id = ".db_formatString($search_id)." ";
	if ($search_account_id)               $sql_where[] = " account_id = $search_account_id ";
	if ($search_status)                   $sql_where[] = " status = '$search_status' ";

	// Ammount Range ////////////

	if (isset($search_amount_range1) && $search_amount_range1 != "" &&
		isset($search_amount_range2) && $search_amount_range2 != "") {
		if (doubleval($search_amount_range2) < doubleval($search_amount_range1)) {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_AMOUNTRANGE);
		}
	}

	if (isset($search_amount_range1) && $search_amount_range1 != "") {
		$search_amount_range1 = doubleval($search_amount_range1);
		if (is_double($search_amount_range1)) {
			$sql_where[] = " amount  >= ".doubleval($search_amount_range1);
		} else {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_STARTAMOUNT);
			$sql_where[] = " false ";
		}
	}

	if (isset($search_amount_range2) && $search_amount_range2 != "") {
		$search_amount_range2 = doubleval($search_amount_range2);
		if (is_double($search_amount_range2)) {
			$sql_where[] = " amount  <= ".doubleval($search_amount_range2);
		} else {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_ENDAMOUNT);
			$sql_where[]   = " false ";
		}
	}

	// Date Range ////////////

	if (isset($search_date_range1) && $search_date_range1 != "") {
		if (validate_date($search_date_range1)) {
			$sql_where[] = " DATE_FORMAT(payment_date, '%Y-%m-%d') >= ".db_formatDate($search_date_range1);
		} else {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_STARTDATE);
			$sql_where[] = " false ";
		}
	}

	if (isset($search_date_range2) && $search_date_range2 != "") {
		if (validate_date($search_date_range2)) {
			$sql_where[] = " DATE_FORMAT(payment_date, '%Y-%m-%d') <= ".db_formatDate($search_date_range2);
		} else {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_ENDDATE);
			$sql_where[] = " false ";
		}
	}

	if ((isset($search_date_range1) && $search_date_range1 != "") && (isset($search_date_range2) && $search_date_range2 != "")) {
		if (validate_date($search_date_range1) && validate_date($search_date_range2)) {
			if (!validate_date_interval($search_date_range1, $search_date_range2) && ($search_date_range1 != $search_date_range2)) {
				$error_message = "&#149; ".system_showText(LANG_SITEMGR_MSGERROR_INVALID_DATERANGE);
				$sql_where[]   = " false ";
			}
		} else {
			$error_message = "&#149; ".system_showText(LANG_SITEMGR_MSGERROR_INVALID_DATERANGE);
			$sql_where[]   = " false ";
		}
	}

	if ((isset($search_date_range1) && $search_date_range1 != "") || (isset($search_date_range2) && $search_date_range2 != "")) {
		$sql_where[] = " DATE_FORMAT(payment_date, '%Y-%m-%d') != '0000-00-00' ";
	}

	// Expiration Date
	if (isset($search_expiration_date) && $search_expiration_date != "") {
		if (validate_date_future($search_expiration_date)) {
			if ($search_opt_expiration_date == 1) {
				$sql_where[] = " DATE(expire_date) = ".db_formatDate($search_expiration_date);
			} else if ($search_opt_expiration_date == 2) {
				$sql_where[] = " (DATE(expire_date) >= NOW() AND TO_DAYS(DATE(expire_date)) <= TO_DAYS(".db_formatDate($search_expiration_date)."))";
			}
		} else {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_RENEWALDATE_INFUTURE);
			$sql_where[] = " false ";
		}
	}

	if ($search_discount_code) {

	    $arrayDiscount_id = array();
	    $dbMain = db_getDBObject(DEFAULT_DB, true);
		$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

	    //Invoice_Article
	    $query = "SELECT invoice_id FROM Invoice_Article WHERE discount_id = ".db_formatString($search_discount_code).";";
	    $result = $db->query($query);
	    while($row = mysql_fetch_assoc($result)) {
		    array_push($arrayDiscount_id, $row['invoice_id']);
	    }

	    //Invoice_Banner
	    $query = "SELECT invoice_id FROM Invoice_Banner WHERE discount_id = ".db_formatString($search_discount_code).";";
	    $result = $db->query($query);
	    while($row = mysql_fetch_assoc($result)) {
		    array_push($arrayDiscount_id, $row['invoice_id']);
	    }

	    //Invoice_Classified
	    $query = "SELECT invoice_id FROM Invoice_Classified WHERE discount_id = ".db_formatString($search_discount_code).";";
	    $result = $db->query($query);
	    while($row = mysql_fetch_assoc($result)) {
		    array_push($arrayDiscount_id, $row['invoice_id']);
	    }

	    //Invoice_Event
	    $query = "SELECT invoice_id FROM Invoice_Event WHERE discount_id = ".db_formatString($search_discount_code).";";
	    $result = $db->query($query);
	    while($row = mysql_fetch_assoc($result)) {
		    array_push($arrayDiscount_id, $row['invoice_id']);
	    }

	    //Invoice_Listing
	    $query = "SELECT invoice_id FROM Invoice_Listing WHERE discount_id = ".db_formatString($search_discount_code).";";
	    $result = $db->query($query);
	    while($row = mysql_fetch_assoc($result)) {
		    array_push($arrayDiscount_id, $row['invoice_id']);
	    }

	    if ($arrayDiscount_id)
		$sql_where[] = " id IN(".implode(", ", $arrayDiscount_id).") ";
	    else $sql_where[] = " id = ".db_formatString($search_discount_code);

	}

	if ($invoiceStatusObj->getDefault()) $sql_where[] = " status != '".$invoiceStatusObj->getDefault()."' ";
	if ($sql_where)                      $where .= " ".implode(" AND ", $sql_where)." ";

	$_GET["search_page"] = "1";
	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	$pageObj  = new pageBrowsing("Invoice",$screen,RESULTS_PER_PAGE,"date DESC","","",$where);

	$invoices = $pageObj->retrievePage("array");

	$letters = $pageObj->getString("letters");

	$paging_url = DEFAULT_URL."/sitemgr/invoices/search.php";

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
		<h1><?=string_ucwords(system_showText(LANG_SITEMGR_MENU_SEARCH))?> <?=string_ucwords(system_showText(LANG_SITEMGR_INVOICE_PLURAL))?></h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<? include(INCLUDES_DIR."/tables/table_invoice_submenu.php"); ?>

		<br />

		<div class="header-form">
			<?=string_ucwords(system_showText(LANG_SITEMGR_MENU_SEARCH))?>
		</div>

		<form name="invoice_search" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="get">
			<? if ($error_message) echo "<p class=\"errorMessage\">".$error_message."</p>"; ?>
			<? include(INCLUDES_DIR."/forms/form_searchinvoice.php"); ?>
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
			<?=string_ucwords(system_showText(LANG_SITEMGR_RESULTS))?>
		</div>
		<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
		<? if ($invoices) { ?>
			<? include(INCLUDES_DIR."/tables/table_invoice.php"); ?>
		<? } else { ?>
			<p class="errorMessage">
				<?=string_ucwords(system_showText(LANG_SITEMGR_NORESULTS))?>
			</p>
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

		$('#search_date_range1').datepicker({
			dateFormat: '<?=$date_format?>',
			changeMonth: true,
			changeYear: true
		});
		$('#search_date_range2').datepicker({
			dateFormat: '<?=$date_format?>',
			changeMonth: true,
			changeYear: true
		});
		$('#search_expiration_date').datepicker({
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