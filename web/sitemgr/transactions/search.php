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
	# * FILE: /sitemgr/transactions/search.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { header("Location:".DEFAULT_URL."/sitemgr");exit; }
	if ((CREDITCARDPAYMENT_FEATURE != "on") && (MANUALPAYMENT_FEATURE != "on")) { header("Location:".DEFAULT_URL."/sitemgr");exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/sitemgr/transactions";
	$url_base = "".DEFAULT_URL."/sitemgr";

	extract($_GET);
	extract($_POST);

	//increases frequently actions
	if (!isset($acct_search_field_name)) system_setFreqActions('transaction_search','PAYMENT_FEATURE');

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------

	
	// Page Browsing ////////////////////////////////////////
	
	if ($search_id)           $sql_where[] = " transaction_id = ".db_formatString($search_id)." ";

	if ($search_account_id)   $sql_where[] = " account_id = $search_account_id ";

	// Payment System ////////////
	if (isset($search_system) && string_strlen(trim($search_system)) > 2) {
		$sql_where[] = " system_type  LIKE ".db_formatString($search_system);
	}

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
			$sql_where[] = " transaction_amount  >= ".doubleval($search_amount_range1);
		} else {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_STARTAMOUNT);
			$sql_where[] = " false ";
		}
	}

	if (isset($search_amount_range2) && $search_amount_range2 != "") {
		$search_amount_range2 = doubleval($search_amount_range2);
		if (is_double($search_amount_range2)) {
			$sql_where[] = " transaction_amount  <= ".doubleval($search_amount_range2);
		} else {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_ENDAMOUNT);
			$sql_where[]   = " false ";
		}
	}

	// Date Range ////////////
	if ((isset($search_date_range1) && $search_date_range1 != "") && (isset($search_date_range2) && $search_date_range2 != "")) {
		if (validate_date($search_date_range1) && validate_date($search_date_range2)) {
			if (!validate_date_interval($search_date_range1, $search_date_range2) && ($search_date_range1 != $search_date_range2)) {
				$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_DATERANGE);
				$sql_where[]   = " false ";
			}
		} else {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_DATERANGE);
			$sql_where[]   = " false ";
		}
	}

	if (isset($search_date_range1) && $search_date_range1 != "") {
		if (validate_date($search_date_range1)) {
			$sql_where[] = " DATE_FORMAT(transaction_datetime, '%Y-%m-%d') >= ".db_formatDate($search_date_range1);
		} else {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_STARTDATE);
			$sql_where[] = " false ";
		}
	}

	if (isset($search_date_range2) && $search_date_range2 != "") {
		if (validate_date($search_date_range2)) {
			$sql_where[] = " DATE_FORMAT(transaction_datetime, '%Y-%m-%d') <= ".db_formatDate($search_date_range2);
		} else {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_ENDDATE);
			$sql_where[] = " false ";
		}
	}

	if ((isset($search_date_range1) && $search_date_range1 != "") || (isset($search_date_range2) && $search_date_range2 != "")) {
		$sql_where[] = " DATE_FORMAT(transaction_datetime, '%Y-%m-%d') != '0000-00-00' ";
	}

	if ($search_discount_code) {

	    $arrayDiscount_id = array();
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

	    //Payment_Article_Log
	    $query = "SELECT payment_log_id FROM Payment_Article_Log WHERE discount_id = ".db_formatString($search_discount_code).";";
	    $result = $db->query($query);
	    while($row = mysql_fetch_assoc($result)) {
		    array_push($arrayDiscount_id, $row['payment_log_id']);
	    }

	    //Payment_Banner_Log
	    $query = "SELECT payment_log_id FROM Payment_Banner_Log WHERE discount_id = ".db_formatString($search_discount_code).";";
	    $result = $db->query($query);
	    while($row = mysql_fetch_assoc($result)) {
		    array_push($arrayDiscount_id, $row['payment_log_id']);
	    }

	    //Payment_Classified_Log
	    $query = "SELECT payment_log_id FROM Payment_Classified_Log WHERE discount_id = ".db_formatString($search_discount_code).";";
	    $result = $db->query($query);
	    while($row = mysql_fetch_assoc($result)) {
		    array_push($arrayDiscount_id, $row['payment_log_id']);
	    }

	    //Payment_Event_Log
	    $query = "SELECT payment_log_id FROM Payment_Event_Log WHERE discount_id = ".db_formatString($search_discount_code).";";
	    $result = $db->query($query);
	    while($row = mysql_fetch_assoc($result)) {
		    array_push($arrayDiscount_id, $row['payment_log_id']);
	    }

	    //Payment_Listing_Log
	    $query = "SELECT payment_log_id FROM Payment_Listing_Log WHERE discount_id = ".db_formatString($search_discount_code).";";
	    $result = $db->query($query);
	    while($row = mysql_fetch_assoc($result)) {
		    array_push($arrayDiscount_id, $row['payment_log_id']);
	    }

	    if ($arrayDiscount_id)
		$sql_where[] = " id IN(".implode(", ", $arrayDiscount_id).") ";
	    else $sql_where[] = " id = ".db_formatString($search_discount_code);

	}
	
	/**
	* System Drop Down
	****************************************************************************/
	$dbMain = db_getDBObject(DEFAULT_DB, true);
	$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
	$query_rsSystems = "SELECT DISTINCT system_type FROM Payment_Log ORDER BY system_type";
	$rsSystems = $db->query($query_rsSystems);
	$arraySystems = array();
	while($row = mysql_fetch_assoc($rsSystems)) {
		array_push($arraySystems, $row['system_type']);
	}
	$systemsDropDown = html_selectBox("search_system", $arraySystems, $arraySystems, $search_system, "", "class=\"input-dd-form-searchtransaction\"", "-- ".system_showText(LANG_LABEL_SELECT_SELECTASYSTEM)." --");
	/***************************************************************************/

	if ($sql_where)  $where .= " ".implode(" AND ", $sql_where)." ";

	$pageObj  = new pageBrowsing("Payment_Log", $screen, RESULTS_PER_PAGE, "transaction_datetime DESC", "", "", $where);

	$transactions = $pageObj->retrievePage("array");

	$_GET["search_page"] = "1";
	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	$paging_url = DEFAULT_URL."/sitemgr/transactions/search.php";

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
		<h1><?=system_showText(LANG_SITEMGR_TRANSACTION_SEARCHTRANSACTION)?></h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<? include(INCLUDES_DIR."/tables/table_transaction_submenu.php"); ?>

		<br />

		<div class="header-form">
			<?=system_showText(LANG_SITEMGR_SEARCH)?>
		</div>

		<form name="transactions" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="get">
			<? if ($error_message) echo "<p class=\"errorMessage\">".$error_message."</p>"; ?>
			<? include(INCLUDES_DIR."/forms/form_searchtransaction.php"); ?>
				<table style="margin: 0 auto 0 auto;">
				<tr>
					<td>
						<button type="submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SEARCH)?></button>
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
		<? if ($transactions) { ?>
			<? include(INCLUDES_DIR."/tables/table_transaction.php"); ?>
		<? } else { ?>
			<p class="errorMessage">
				<?=system_showText(LANG_SITEMGR_NORESULTS)?>
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
    });
</script>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>