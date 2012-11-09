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
	# * FILE: /sitemgr/banner/search.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BANNER_FEATURE != "on") {
		header("Location: ".DEFAULT_URL."/sitemgr/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	$_GET = format_magicQuotes($_GET);
	extract($_GET);
	$_POST = format_magicQuotes($_POST);
	extract($_POST);

	//increases frequently actions
	if (!isset($acct_search_field_name)) system_setFreqActions('banner_search','BANNER_FEATURE');

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------

	include(INCLUDES_DIR."/code/bulkupdate.php");

	$url_redirect = "".DEFAULT_URL."/sitemgr/".BANNER_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# FORM DEFINES
	# ----------------------------------------------------------------------------------------------------

	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$arrLangs = explode(",", EDIR_LANGUAGENUMBERS);
	$endExpr = ")";

	if (count($arrLangs) > 1) {
		$fields = "id, IF (`title".$langIndex."` != '', `title".$langIndex."`, ";
		$orderby = " IF (`title".$langIndex."` != '', `title".$langIndex."`, ";
		$whereField = "IF (`caption".$langIndex."` != '', `caption".$langIndex."`, ";
		foreach ($arrLangs as $lang) {
			if ($langIndex != $lang) {
				$fields .= "IF (`title".$lang."` != '', `title".$lang."`, ";
				$orderby .= "IF (`title".$lang."` != '', `title".$lang."`, ";
				$whereField .= "IF (`caption".$lang."` != '', `caption".$lang."`, ";
				$endExpr .= ")";
			}
		}
		$fields .= "''".$endExpr." AS `title`";
		$orderby .= "''".$endExpr." ";
		$whereField .= "''".$endExpr."";
	} else {
		$fields = "`id`, `title".$langIndex."` AS `title`";
		$orderby = "`title".$langIndex."`";
		$whereField = "`caption".$langIndex."`";
	}

	/**
	* Banner Type Drop Down
	****************************************************************************/
	$bannerObj  = new Banner();

	$nameArray  = array();
	$valueArray = array();

	$bannerLevelObj = new BannerLevel(EDIR_DEFAULT_LANGUAGE, true);
	unset($levelStatus);
	foreach ($bannerLevelObj->value as $k => $value) {
		$levelStatus[$value] = $bannerLevelObj->active[$k];
	}

	foreach($bannerObj->banner_types as $each_type => $each_value){
		$banner_size = "(".$bannerLevelObj->getWidth($each_value)."px x ".$bannerLevelObj->getHeight($each_value)."px)";
		if ($levelStatus[$each_value] == "n") $banner_size .= " (".LANG_BANNER_DISABLED.")";

		$nameArray[]  = string_ucwords(str_replace("_"," ",$each_type))." ".$banner_size;
		$valueArray[] = $each_value;

	}

	$typeDropDown = html_selectBox("search_type", $nameArray, $valueArray, $search_type, "", "class='input-dd-form-searchbanner'", "-- ".system_showText(LANG_LABEL_SELECT_TYPE)." --");

	unset($bannerObj);

	/**
	* Category Drop Down
	****************************************************************************/
	$nameArray  = array();
	$valueArray = array();
	if ($search_section) {
		if ($search_section == "general") {
			$categoryDropDown = html_selectBox("search_category", $nameArray, $valueArray, $search_category, "id=\"search_category\" disabled", "class='input-dd-form-banner' style='width: 350px;'", system_showText(LANG_LABEL_SELECT_ALLPAGESBUTITEMPAGES));
		} elseif ($search_section == "global") {
            $categoryDropDown = html_selectBox("search_category", $nameArray, $valueArray, $search_category, "id=\"search_category\" disabled", "class='input-dd-form-banner' style='width: 350px;'", system_showText(LANG_LABEL_SELECT_ALLPAGES));
        } else {
			if ($search_section == "listing") $tableCategory = "listingcategory";
			elseif ($search_section == "event") $tableCategory = "eventcategory";
			elseif ($search_section == "classified") $tableCategory = "classifiedcategory";
			elseif ($search_section == "article") $tableCategory = "articlecategory";
			$categories = db_getFromDB($tableCategory, "category_id", 0, "all", $orderby, "object", SELECTED_DOMAIN_ID);
			if ($categories) {
				foreach ($categories as $category) {
					if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
						$valueArray[]  = "";
						$nameArray[]   = "--------------------------------------------------";
					}
					$valueArray[]  = $category->getNumber("id");
					$nameArray[]   = $category->getString("title");
					if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
						$subcategories = db_getFromDB($tableCategory, "category_id", $category->getNumber("id"), "all", $orderby, "object", SELECTED_DOMAIN_ID, false, $fields);
						if ($subcategories) {
							foreach ($subcategories as $subcategory) {
								$valueArray[] = $subcategory->getNumber("id");
								$nameArray[]  = "- ".$subcategory->getString("title");
								$subcategories2 = db_getFromDB($tableCategory, "category_id", $subcategory->getNumber("id"), "all", $orderby, "object", SELECTED_DOMAIN_ID, false, $fields);
								if ($subcategories2) {
									foreach ($subcategories2 as $subcategory2) {
										$valueArray[] = $subcategory2->getNumber("id");
										$nameArray[]  = "&nbsp;- ".$subcategory2->getString("title");
										$subcategories3 = db_getFromDB($tableCategory, "category_id", $subcategory2->getNumber("id"), "all", $orderby, "object", SELECTED_DOMAIN_ID, false, $fields);
										if ($subcategories3) {
											foreach ($subcategories3 as $subcategory3) {
												$valueArray[] = $subcategory3->getNumber("id");
												$nameArray[]  = "&nbsp;&nbsp;- ".$subcategory3->getString("title");
												$subcategories4 = db_getFromDB($tableCategory, "category_id", $subcategory3->getNumber("id"), "all", $orderby, "object", SELECTED_DOMAIN_ID, false, $fields);
												if ($subcategories4) {
													foreach ($subcategories4 as $subcategory4) {
														$valueArray[] = $subcategory4->getNumber("id");
														$nameArray[]  = "&nbsp;&nbsp;&nbsp;- ".$subcategory4->getString("title");
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
		$valueArray[] = "";
		$nameArray[]  = "--------------------------------------------------";
	}
	$categoryDropDown = html_selectBox("search_category", $nameArray, $valueArray, $search_category, "id=\"search_category\"", "class='input-dd-form-banner' style='width:350px;'", system_showText(LANG_SITEMGR_LABEL_NONCATEGORYSEARCH));

	/**
	* Status Drop Down
	****************************************************************************/	
	$statusObj = new ItemStatus();
	$statusDropDown = html_selectBox("search_status", $statusObj->getNames(), $statusObj->getValues(), $search_status, "", "class='input-dd-form-searchbanner'", "-- ".system_showText(LANG_SITEMGR_SELECTASTATUS)." --");

	/************************************************
	* @desc Category auxiliar code
	*************************************************/
	if($search_category_id) {
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		$sql = "SELECT id FROM Banner WHERE category_id = '$search_category_id'";
		$rs = $db->query($sql);
		while($row = mysql_fetch_assoc($rs)) $banner_ids_from_category[] = $row["id"];
		$category_banner_ids = ($banner_ids_from_category) ? implode(",",$banner_ids_from_category) : "'0'";
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
		$sql .= " banner_id ";
		$sql .= " FROM ";
		$sql .= " Invoice_Banner ";
		$sql .= " WHERE ";
		$sql .= " discount_id LIKE ".db_formatString($search_discount);
		$rs   = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $banner_ids_from_discount[] = $row["banner_id"];
		
		//Payment
		$sql = "";
		$sql .= " SELECT ";
		$sql .= " banner_id ";
		$sql .= " FROM ";
		$sql .= " Payment_Banner_Log ";
		$sql .= " WHERE ";
		$sql .= " discount_id LIKE ".db_formatString($search_discount);
		$rs   = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $banner_ids_from_discount[] = $row["banner_id"];
		
		//Banner
		$sql = "";
		$sql .= " SELECT ";
		$sql .= " id ";
		$sql .= " FROM ";
		$sql .= " Banner ";
		$sql .= " WHERE ";
		$sql .= " discount_id LIKE ".db_formatString($search_discount);
		$rs   = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $banner_ids_from_discount[] = $row["id"];
		
		/************************************************
		* @desc Removing the ids of banners that are not in the category, if the category filter is active
		************************************************/
		if ($search_category_id && count($banner_ids_from_discount) > 0) {
			if (count($banner_ids_from_category) > 0) {
				$tmparray = array();
				for ($i=0;$i<count($banner_ids_from_discount);$i++) {
					if (in_array($banner_ids_from_discount[$i], $banner_ids_from_category)) {
						$tmparray[] = $banner_ids_from_discount[$i];
					}
				}
				$banner_ids_from_discount = $tmparray;
				unset($tmparray);
			} else {
				$banner_ids_from_discount = "";
			}
		}
		
		$discount_banner_ids = ($banner_ids_from_discount) ? implode(",", $banner_ids_from_discount) : "'0'";
		
	}
	
	/************************************************
	* @desc Category and DiscountCode auxiliar code
	************************************************/
	
	if ($discount_banner_ids) {
		$search_banner_ids = $discount_banner_ids;
	} else if ($category_banner_ids) {
		$search_banner_ids = $category_banner_ids;
	}

	if ($search_caption) $sql_where[] = " $whereField LIKE ".db_formatString('%'.$search_caption.'%')." ";
//	if ($search_no_owner==1) $sql_where[] = " account_id = 0 ";
//	elseif ($search_account_id) $sql_where[] = " account_id = $search_account_id ";
	if ($account_search_bulk == "0") {
		$sql_where[] = " account_id = 0 ";
	} else if ($search_no_owner==1 && !$account_search_bulk){
		$sql_where[] = " account_id = 0 ";
	}elseif ($search_account_id  && !$change_account_id){
		$sql_where[] = " account_id = $search_account_id ";
	}elseif($change_account_id){
		$sql_where[] = " account_id = ".$change_account_id;
	}
    
    $bannerLevelObj = new BannerLevel(EDIR_DEFAULT_LANGUAGE, true);
    $levelsTheme = $bannerLevelObj->getValues();
    if (is_array($levelsTheme) && $levelsTheme[0]){
        $whereLevelThemes = " type IN (".implode(", ", $levelsTheme).")";
        $sql_where[] = $whereLevelThemes;
    }

	if ($search_section) $sql_where[] = " section = ".db_formatString($search_section);
	if ($search_category)			$sql_where[] = " category_id = ".db_formatNumber($search_category);
	if ($search_banner_ids)			$sql_where[] = " id IN ($search_banner_ids) "; // search_banner_ids
	if ($level) {
		$sql_where[] = " type = '$level' ";
	} else if ($search_type) $sql_where[] = " type = '$search_type' ";
	//if ($search_type) $sql_where[] = " type = '$search_type' ";
	if ($search_status) $sql_where[] = " status = '$search_status' ";

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

	if ($search_category_id) $sql_where[] = " id IN ($category_banner_ids) ";

	if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";
	
	# ----------------------------------------------------------------------------------------------------
	# PAGE BROWSING
	# ----------------------------------------------------------------------------------------------------
	$_GET["search_page"] = "1";
	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	$paging_url = DEFAULT_URL."/sitemgr/".BANNER_FEATURE_FOLDER."/search.php";

	if (!$error_message && !$error_msg) {
		if ($_POST["screen"]) {
			if ($bulkSubmit) {
				unset($arrayURL);
				if ($change_no_owner) {
					$arrayURL[] = "search_no_owner=1";
				} elseif ($change_account_id) {
					$arrayURL[] = "search_account_id=$change_account_id";
				}
				if ($level) $arrayURL[] = "search_type=$level";
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
			if ($level) $arrayURL[] = "search_type=$level";
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
	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$arrLangs = explode(",", EDIR_LANGUAGENUMBERS);
	$endExpr = ")";

	if (count($arrLangs) > 1) {
		$fields = "id, type, status, account_id, expiration_setting, renewal_date, impressions, ";
		$fields .= "IF (`caption".$langIndex."` != '', `caption".$langIndex."`, ";
		$letterField = "IF (`caption".$langIndex."` != '', `caption".$langIndex."`, ";
		foreach ($arrLangs as $lang) {
			if ($langIndex != $lang) {
				$fields .= "IF (`caption".$lang."` != '', `caption".$lang."`, ";
				$letterField .= "IF (`caption".$lang."` != '', `caption".$lang."`, ";
				$endExpr .= ")";
			}
		}

		$fields .= "''".$endExpr." AS `caption`";
		$letterField .= "''".$endExpr."";
	} else {
		$fields = "id, type, status, account_id, expiration_setting, renewal_date, impressions, `caption".$langIndex."` AS `caption`";
		$letterField = "`caption".$langIndex."`";
	}

	$pageObj = new pageBrowsing("Banner", $screen, RESULTS_PER_PAGE, "type, caption", $letterField, $letter, $where, $fields);
	$banners = $pageObj->retrievePage("array");

	
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
<script language="javascript">
<!--
function searchResetBanner(form, domain_id) {
	tot = form.elements.length;
	for (i=0;i<tot;i++) {
		if (form.elements[i].type == 'text') {
			form.elements[i].value = "";
		} else if (form.elements[i].type == 'checkbox' || form.elements[i].type == 'radio') {
			form.elements[i].checked = false;
		} else if (form.elements[i].type == 'select-one') {
			form.elements[i].selectedIndex = 0;
		}
	}
	fillBannerCategorySelect('<?=DEFAULT_URL?>', form.search_category, "", form, domain_id);
	form.search_category.length = 0;
	form.search_category.disabled = false;
	form.search_category.options[0] = new Option(system_showText(LANG_SITEMGR_LABEL_NONCATEGORYSEARCH),"");
	form.search_category.options[1] = new Option("--------------------------------------------------","");
}

-->
</script>
<div id="main-right">
<div id="top-content">
	<div id="header-content">
		<h1><?=string_ucwords(system_showText(LANG_SITEMGR_MENU_SEARCH))?> <?=string_ucwords(system_showText(LANG_SITEMGR_BANNER_PLURAL))?></h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
		<?if (CUSTOM_BANNER_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>
		<? include(INCLUDES_DIR."/tables/table_banner_submenu.php"); ?>

		<br />

		<? if ($search_submit && !$back) { ?>

			<a class="backToSearch" href="<?=$url_redirect."/search.php?".$_SERVER["QUERY_STRING"]?>&back=search"><?=system_showText(LANG_SITEMGR_MENU_BACKTOSEARCH);?></a>
			<div class="header-form" id="search_banner" >
				<?=string_ucwords(system_showText(LANG_SITEMGR_RESULTS))?>
			</div>
			
			<? if ($banners) { ?>
				<? include(INCLUDES_DIR."/tables/table_banner.php"); ?>
			<? } else { ?>
				<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
				<p class="errorMessage"><?=system_showText(LANG_SITEMGR_NORESULTS)?></p>
			<? } ?>


		<? } elseif ($back == "search" || string_strpos($_SERVER["PHP_SELF"], BANNER_FEATURE_FOLDER)) { ?>

			<div class="header-form" id="search_banner" >
				<?=string_ucwords(system_showText(LANG_SITEMGR_MENU_SEARCH))?>
			</div>
			<form name="banner" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="get" id="search_banner_form">
				<? if ($error_message) echo "<p class=\"errorMessage\">".$error_message."</p>"; ?>
				<? include(INCLUDES_DIR."/forms/form_searchbanner.php"); ?>
					<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="search_submit" value="Search" class="input-button-form"><?=system_showText(LANG_SITEMGR_SEARCH)?></button>
						</td>
						<td>
							<button type="button" onclick="emptySearchAccount();searchResetBanner(this.form, <?=SELECTED_DOMAIN_ID?>);" class="input-button-form"><?=system_showText(LANG_SITEMGR_CLEAR)?></button>
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