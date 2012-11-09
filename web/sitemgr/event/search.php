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
	# * FILE: /sitemgr/event/search.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on") {
		header("Location: ".DEFAULT_URL."/sitemgr/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/sitemgr/".EVENT_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	$_GET = format_magicQuotes($_GET);
	extract($_GET);
	$_POST = format_magicQuotes($_POST);
	extract($_POST);

	//increases frequently actions
	if (!isset($acct_search_field_name)) system_setFreqActions('event_search','EVENT_FEATURE');

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------

	include(INCLUDES_DIR."/code/bulkupdate.php");

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$arrLangs = explode(",", EDIR_LANGUAGENUMBERS);
	$endExpr = ")";

	if (count($arrLangs) > 1) {
		$fields = "id, IF (`title".$langIndex."` != '', `title".$langIndex."`, ";
		$orderby = " IF (`title".$langIndex."` != '', `title".$langIndex."`, ";
		foreach ($arrLangs as $lang) {
			if ($langIndex != $lang) {
				$fields .= "IF (`title".$lang."` != '', `title".$lang."`, ";
				$orderby .= "IF (`title".$lang."` != '', `title".$lang."`, ";
				$endExpr .= ")";
			}
		}
		$fields .= "''".$endExpr." AS `title`";
		$orderby .= "''".$endExpr." ";
	} else {
		$fields = "`id`, `title".$langIndex."` AS `title`";
		$orderby = "`title".$langIndex."`";
	}


	##################################################################################################################################
	# CATEGORY
	##################################################################################################################################
	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$categories = db_getFromDB("eventcategory", "category_id", 0, "all", $orderby, "object", SELECTED_DOMAIN_ID, false, $fields);
	$nameArray  = array();
	$valueArray = array();
	if ($categories) {
		foreach ($categories as $category) {
			if (EVENTCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
				$valueArray[] = "";
				$nameArray[]  = "--------------------------------------------------";
			}
			$valueArray[] = $category->getNumber("id");
			if ($category->getString("title".$langIndex)) $nameArray[] = $category->getString("title".$langIndex);
			else $nameArray[] = $category->getString("title");
			if (EVENTCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
				$subcategories = db_getFromDB("eventcategory", "category_id", $category->getNumber("id"), "all", $orderby, "object", SELECTED_DOMAIN_ID, false, $fields);
				if ($subcategories) {
					foreach ($subcategories as $subcategory) {
						$valueArray[] = $subcategory->getNumber("id");
						if ($subcategory->getString("title".$langIndex)) $nameArray[] = " &raquo; ".$subcategory->getString("title".$langIndex);
						else $nameArray[] = " &raquo; ".$subcategory->getString("title");
					}
				}
			}
		}
	}
	if (EVENTCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
		$valueArray[] = "";
		$nameArray[]  = "--------------------------------------------------";
	}
	$categoryDropDown = html_selectBox("search_category_id", $nameArray, $valueArray, $search_category_id, "", "class='input-dd-form-searchevent'", "-- ".system_showText(LANG_LABEL_SELECT_ALLCATEGORIES)." --");

	##################################################################################################################################
	# STATUS
	##################################################################################################################################
	$statusObj = new ItemStatus();
	$statusDropDown = html_selectBox("search_status", $statusObj->getNames(), $statusObj->getValues(), $search_status, "", "class='input-dd-form-searchevent'", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");

	##################################################################################################################################
	# LOCATION
	##################################################################################################################################
	$_non_default_locations = "";
	$_default_locations_info = "";
	if (EDIR_DEFAULT_LOCATIONS) {

		system_retrieveLocationsInfo ($_non_default_locations, $_default_locations_info);

		$last_default_location	  =	$_default_locations_info[count($_default_locations_info)-1]['type'];
		$last_default_location_id = $_default_locations_info[count($_default_locations_info)-1]['id'];

		if ($_non_default_locations) {
			$objLocationLabel = "Location".$_non_default_locations[0];
			${"Location".$_non_default_locations[0]} = new $objLocationLabel;
			${"Location".$_non_default_locations[0]}->SetString("location_".$last_default_location, $last_default_location_id);
			${"locations".$_non_default_locations[0]} = ${"Location".$_non_default_locations[0]}->retrieveLocationByLocation($last_default_location);
		}

	} else {
		$_non_default_locations = explode(",", EDIR_LOCATIONS);
		$objLocationLabel = "Location".$_non_default_locations[0];
		${"Location".$_non_default_locations[0]} = new $objLocationLabel;
		${"locations".$_non_default_locations[0]}  = ${"Location".$_non_default_locations[0]}->retrieveAllLocation();
	}
	
	$stop_search_locations = false;
	//if there is at least one non default location
	if ($_non_default_locations) {
		foreach($_non_default_locations as $_location_level) {
			if ($_POST["location_".$_location_level])
				${"location_".$_location_level} = $_POST["location_".$_location_level];
			else
				$stop_search_locations = true;
			system_retrieveLocationRelationship ($_non_default_locations, $_location_level, $_location_father_level, $_location_child_level);
			if (${'location_'.$_location_level} && $_location_child_level) {
				if (!$stop_search_locations) {
					$objLocationLabel = "Location".$_location_child_level;
					${"Location".$_location_child_level} = new $objLocationLabel;
					${"Location".$_location_child_level}->SetString("location_".$_location_level, ${"location_".$_location_level});
					${"locations".$_location_child_level} = ${"Location".$_location_child_level}->retrieveLocationByLocation($_location_level);
				} else 	${"locations".$_location_child_level} = "";
			} else $stop_search_locations = true;
		}
		unset ($_location_father_level);
		unset ($_location_child_level);
		unset ($_location_level);
	}

	##################################################################################################################################

	/************************************************
	* @desc Category auxiliar code
	*************************************************/
	if($search_category_id) {
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		$sql = "SELECT id FROM Event WHERE cat_1_id = '$search_category_id' OR parcat_1_level1_id = '$search_category_id' OR cat_2_id = '$search_category_id' OR parcat_2_level1_id = '$search_category_id' OR cat_3_id = '$search_category_id' OR parcat_3_level1_id = '$search_category_id' OR cat_4_id = '$search_category_id' OR parcat_4_level1_id = '$search_category_id' OR cat_5_id = '$search_category_id' OR parcat_5_level1_id = '$search_category_id'";
		$rs = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $event_ids_from_category[] = $row["id"];
		$category_event_ids = ($event_ids_from_category) ? implode(",",$event_ids_from_category) : "'0'";
	}

	/************************************************
	* @desc DiscountCode auxiliar code
	************************************************/
	if($search_discount) {

		//Invoice
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		$sql  = "";
		$sql .= " SELECT ";
		$sql .= " event_id ";
		$sql .= " FROM ";
		$sql .= " Invoice_Event ";
		$sql .= " WHERE ";
		$sql .= " discount_id LIKE ".db_formatString($search_discount);
		$rs   = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $event_ids_from_discount[] = $row["event_id"];

		//Payment
		$sql = "";
		$sql .= " SELECT ";
		$sql .= " event_id ";
		$sql .= " FROM ";
		$sql .= " Payment_Event_Log ";
		$sql .= " WHERE ";
		$sql .= " discount_id LIKE ".db_formatString($search_discount);
		$rs   = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $event_ids_from_discount[] = $row["event_id"];

		//Event
		$sql  = "";
		$sql .= " SELECT ";
		$sql .= " id ";
		$sql .= " FROM ";
		$sql .= " Event ";
		$sql .= " WHERE ";
		$sql .= " discount_id LIKE ".db_formatString($search_discount);
		$rs   = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $event_ids_from_discount[] = $row["id"];

		/************************************************
		* @desc Removing the ids of events that are not in the category, if the category filter is active
		************************************************/
		if ($search_category_id && count($event_ids_from_discount) > 0) {
			if (count($event_ids_from_category) > 0) {
				$tmparray = array();
				for ($i=0;$i<count($event_ids_from_discount);$i++) {
					if (in_array($event_ids_from_discount[$i], $event_ids_from_category)) {
						$tmparray[] = $event_ids_from_discount[$i];
					}
				}
				$event_ids_from_discount = $tmparray;
				unset($tmparray);
			} else {
				$event_ids_from_discount = "";
			}
		}

		$discount_event_ids = ($event_ids_from_discount) ? implode(",", $event_ids_from_discount) : "'0'";

	}
	// -------------------------------------------

	/************************************************
	* @desc Category and DiscountCode auxiliar code
	************************************************/
	if ($discount_event_ids) {
		$search_event_ids = $discount_event_ids;
	} else if ($category_event_ids) {
		$search_event_ids = $category_event_ids;
	}

	if ($search_title) {
        $search_title = str_replace("\\", "", $search_title);
        $search_for_keyword_fields[] = "Event.fulltextsearch_keyword";
        $sql_where[] = search_getSQLFullTextSearch($search_title, $search_for_keyword_fields, "keyword_score", $order_by_keyword_score, $search_for["match"], $order_by_keyword_score2, "keyword_score2");
    }
	
	if ($account_search_bulk == "0") {
		$sql_where[] = " account_id = 0 ";
	} else if ($search_no_owner==1 && !$change_account_id){
		$sql_where[] = " account_id = 0 ";
	}elseif ($search_account_id){
		$sql_where[] = " account_id = $search_account_id ";
	}elseif($change_account_id){
		$sql_where[] = " account_id = ".$change_account_id;
	}
	if ($level) {
		$sql_where[] = " level = '$level' ";
	} else if ($search_level) $sql_where[] = " level = '$search_level' ";
	if ($search_status) $sql_where[] = " status = '$search_status' ";
	if ($search_event_ids) $sql_where[] = " id IN ($search_event_ids) "; // search_event_ids	

	$_locations = explode(",", EDIR_LOCATIONS);
	foreach($_locations as $_location_level)
		if (is_numeric(${"location_".$_location_level})) $sql_where[] = " location_".$_location_level." = '${"location_".$_location_level}' ";
	unset ($_locations);

	if ($search_zipcode) $sql_where[] = " zip_code LIKE '$search_zipcode' ";

	// Date Range
	if ((isset($search_date_period1) && $search_date_period1 != "") && (isset($search_date_period2) && $search_date_period2 != "")) {

		if (!validate_date($search_date_period1) || !validate_date($search_date_period2)) {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_DATERANGE);
			$sql_where[]   = " false ";
		} elseif (!validate_date_interval($search_date_period1, $search_date_period2) && ($search_date_period1 != $search_date_period2)) {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_DATERANGE);
			$sql_where[]   = " false ";
		}

		$where_period  = "((start_date <= ".db_formatDate($search_date_period2)." AND (end_date >= ".db_formatDate($search_date_period1)." OR until_date >= ".db_formatDate($search_date_period1)." OR repeat_event = 'Y')) AND (";
		$where_period .= "(start_date <= ".db_formatDate($search_date_period1)." AND (end_date >= ".db_formatDate($search_date_period2)." OR until_date >= ".db_formatDate($search_date_period2)." OR repeat_event = 'Y')) ";
		$where_period .= "OR (start_date >= ".db_formatDate($search_date_period1)." AND (end_date >= ".db_formatDate($search_date_period2)." OR until_date >= ".db_formatDate($search_date_period2)." OR repeat_event = 'Y')) ";
		$where_period .= "OR (start_date >= ".db_formatDate($search_date_period1)." AND (end_date <= ".db_formatDate($search_date_period2)." OR until_date >= ".db_formatDate($search_date_period2)." OR repeat_event = 'Y')) ";
		$where_period .= "OR (start_date <= ".db_formatDate($search_date_period1)." AND (end_date >= ".db_formatDate($search_date_period2)." OR until_date >= ".db_formatDate($search_date_period2)." OR repeat_event = 'Y')) ";
		$where_period .= "OR (start_date <= ".db_formatDate($search_date_period1)." AND (end_date <= ".db_formatDate($search_date_period2)." OR end_date >= ".db_formatDate($search_date_period2)." OR repeat_event = 'Y')) ";
		$where_period .= "))";

		$sql_where[] = $where_period;

	} else if ((isset($search_date_period1) && $search_date_period1 != "") || (isset($search_date_period2) && $search_date_period2 != "")) {

		if (isset($search_date_period1) && $search_date_period1 != "") {
			if (validate_date($search_date_period1)) {
				$sql_where[] = " start_date >= ".db_formatDate($search_date_period1);
			} else {
				$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_STARTDATE);
				$sql_where[] = " false ";
			}
		} else if (isset($search_date_period2) && $search_date_period2 != "") {
			if (validate_date($search_date_period2)) {
				$sql_where[] = " (end_date <= ".db_formatDate($search_date_period2)." AND end_date!='0000-00-00') OR ((until_date <= ".db_formatDate($search_date_period2)." AND recurring = 'Y' AND repeat_event = 'N') OR (repeat_event = 'Y' AND start_date <=".db_formatDate($search_date_period2)."))";
			} else {
				$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_ENDDATE);
				$sql_where[] = " false ";
			}
		}

	}

	// Expiration Date
	if (isset($search_expiration_date) && $search_expiration_date != "") {
		if (validate_date_future($search_expiration_date)) {
			if ($search_opt_expiration_date == 1) {
				$sql_where[] = " renewal_date = ".db_formatDate($search_expiration_date);
			} else if ($search_opt_expiration_date == 2) {
				$sql_where[] = " (renewal_date >= NOW() AND TO_DAYS(renewal_date) <= TO_DAYS(".db_formatDate($search_expiration_date)."))";
			}
		} else {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_RENEWALDATE_INFUTURE);
			$sql_where[] = " false ";
		}
	}

	if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";

	
	# ----------------------------------------------------------------------------------------------------
	# PAGE BROWSING
	# ----------------------------------------------------------------------------------------------------
	$_GET["search_page"] = "1";
	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	$paging_url = DEFAULT_URL."/sitemgr/".EVENT_FEATURE_FOLDER."/search.php";

	if (!$error_message && !$error_msg) {
		if ($_POST["screen"]) {
			if ($bulkSubmit) {
				unset($arrayURL);
				if ($change_no_owner) {
					$arrayURL[] = "search_no_owner=1";
				} elseif ($change_account_id) {
					$arrayURL[] = "search_account_id=$change_account_id";
				}
				if ($level) $arrayURL[] = "search_level=$level";
				if ($status) $arrayURL[] = "search_status=$status";
				if ($change_renewaldate) $arrayURL[] = "search_status=$search_expiration_date";
				if ($add_category_id) $arrayURL[] = "search_category_id=$add_category_id";
				$arrayURL[] = "screen=1";
				$arrayURL[] = "letter=".$letter;
				$arrayURL[] = "search_submit=Search";
				$arrayURL[] = "msg=".$msg;
				$strURL = implode("&", $arrayURL);

				header("Location: ".$paging_url."?$strURL");
				exit;
			} else {
				$screen = $_POST["screen"];
			}
		} else if ($bulkSubmit) {
			unset($arrayURL);
			if ($change_no_owner) {
				$arrayURL[] = "search_no_owner=1";
			} elseif ($change_account_id) {
				$arrayURL[] = "search_account_id=$change_account_id";
			}
			if ($level) $arrayURL[] = "search_level=$level";
			if ($status) $arrayURL[] = "search_status=$status";
			if ($change_renewaldate) $arrayURL[] = "search_status=$search_expiration_date";
			if ($add_category_id) $arrayURL[] = "search_category_id=$add_category_id";
			$arrayURL[] = "screen=1";
			$arrayURL[] = "letter=".$letter;
			$arrayURL[] = "search_submit=Search";
			$arrayURL[] = "msg=".$msg;
			$strURL = implode("&", $arrayURL);

			header("Location: ".$paging_url."?$strURL");
			exit;
		}
	}
	
	$pageObj = new pageBrowsing("Event", $screen, RESULTS_PER_PAGE, "level DESC, title,  renewal_date","title", $letter, $where);
	$events = $pageObj->retrievePage("object");


	// Letters Menu
	$letters = $pageObj->getString("letters");
	foreach ($letters as $each_letter) {
		if ($each_letter == "#") {
			$letters_menu .= "<a href=\"$paging_url?letter=no".(($url_search_params) ? "&$url_search_params" : "")."\" ".(($letter == "no") ? "class=\"firstLetter\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		} else {
			$letters_menu .= "<a href=\"$paging_url?letter=".$each_letter.(($url_search_params) ? "&$url_search_params" : "")."\" ".(($each_letter == $letter) ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		}
	}

	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");


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
			<h1><?=string_ucwords(system_showText(LANG_SITEMGR_MENU_SEARCH))?> <?=system_showText(LANG_SITEMGR_NAVBAR_EVENT)?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
			<?if (CUSTOM_EVENT_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>
			<? include(INCLUDES_DIR."/tables/table_event_submenu.php"); ?>

			<br />
			
			<? if ($search_submit && !$back) { ?>

				<a class="backToSearch" href="<?=$url_redirect."/search.php?".$_SERVER["QUERY_STRING"]?>&back=search"><?=system_showText(LANG_SITEMGR_MENU_BACKTOSEARCH);?></a>
				<div class="header-form">
					<?=string_ucwords(system_showText(LANG_SITEMGR_RESULTS))?>
				</div>
				<? if ($events) { ?>
					<? include(INCLUDES_DIR."/tables/table_event.php"); ?>
				<? } else { ?>
					<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
					<p class="errorMessage"><?=system_showText(LANG_SITEMGR_NORESULTS)?></p>
				<? } ?>
					
			<? } elseif ($back == "search" || string_strpos($_SERVER["PHP_SELF"], EVENT_FEATURE_FOLDER)) { ?>

				<div class="header-form" id="search_event" >
					<?=string_ucwords(system_showText(LANG_SITEMGR_MENU_SEARCH))?>
				</div>
				<form name="searchEvent" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="get" id="search_event_form">

					<? if ($error_message) echo "<p class=\"errorMessage\">".$error_message."</p>"; ?>

					<? include(INCLUDES_DIR."/forms/form_searchevent.php"); ?>

					<table style="margin: 0 auto 0 auto;">
						<tr>
							<td>
								<button type="submit" name="search_submit" value="Search" class="input-button-form"><?=system_showText(LANG_SITEMGR_SEARCH)?></button>
							</td>
							<td>
								<button type="button" onclick="emptySearchAccount(); searchResetSitemgr(this.form);" class="input-button-form"><?=system_showText(LANG_SITEMGR_CLEAR)?></button>
							</td>
						</tr>
					</table>

				</form>
			<? }
			} ?>

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

		$('#search_date_period1').datepicker({
			dateFormat: '<?=$date_format?>',
			changeMonth: true,
			changeYear: true
		});
		$('#search_date_period2').datepicker({
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