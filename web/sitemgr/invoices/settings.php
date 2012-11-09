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
	# * FILE: /sitemgr/invoices/settings.php
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
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	if ($id) {
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		$sql = "SELECT * FROM Invoice WHERE id = ".$id;
		$r = $db->query($sql);
		if(mysql_num_rows($r)==0) {
			header("Location: ".DEFAULT_URL."/sitemgr/invoices/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;
		} else {
			$res = mysql_fetch_assoc($r);
			if ($res["status"]=="R") {
				header("Location: ".DEFAULT_URL."/sitemgr/invoices/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
				exit;
			}
		}
		$invoiceObj = new Invoice($id);
	} else {
		header("Location: ".DEFAULT_URL."/sitemgr/invoices/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if (validate_form("invoicesettings", $_POST, $message_invoicesettings)) {

			if($status) {
				$invoiceObj->setString("status", $status);
				$invoiceObj->Save();
			}

			if($status == "R") {

				domain_updateDashboard("revenue","",$invoiceObj->getString("amount"), SELECTED_DOMAIN_ID);

				$invoiceObj->setString("payment_date", date("Y")."-".date("m")."-".date("d")." ".date("H").":".date("i").":".date("s"));
				$invoiceObj->Save(true);

				$dbMain = db_getDBObject(DEFAULT_DB, true);
				$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				$sql = "SELECT * FROM Invoice_Listing WHERE invoice_id = ".$invoiceObj->getString("id")."";
				$r = $db->query($sql);

				while($row = mysql_fetch_assoc($r)) $listing_ids[] = $row["listing_id"];

				if ($listing_ids) {

					$listingStatus = new ItemStatus();

					foreach ($listing_ids as $each_listing_id) $listings[] = new Listing($each_listing_id);

					if ($listings) foreach ($listings as $listing) {

						$sql = "UPDATE Invoice_Listing SET renewal_date = '".$listing->getNextRenewalDate()."' WHERE invoice_id = ".$invoiceObj->getString("id")." AND listing_id = ".$listing->getString("id")."";
						$r = $db->query($sql);

						$listing->setString("renewal_date", $listing->getNextRenewalDate());

						setting_get("listing_approve_paid", $listing_approve_paid);

						if ($listing_approve_paid){
							$listing->setString("status", $listingStatus->getDefaultStatus());
						}else{
							$listing->setString("status", "A");
						}

						$listing->Save();

					}

				}

				$sql = "SELECT * FROM Invoice_Event WHERE invoice_id = ".$invoiceObj->getString("id")."";
				$r = $db->query($sql);

				while($row = mysql_fetch_assoc($r)) $event_ids[] = $row["event_id"];

				if ($event_ids) {

					$eventStatus = new ItemStatus();

					foreach ($event_ids as $each_event_id) $events[] = new Event($each_event_id);

					if ($events) foreach ($events as $event) {

						$sql = "UPDATE Invoice_Event SET renewal_date = '".$event->getNextRenewalDate()."' WHERE invoice_id = ".$invoiceObj->getString("id")." AND event_id = ".$event->getString("id")."";
						$r = $db->query($sql);

						$event->setString("renewal_date", $event->getNextRenewalDate());

						setting_get("event_approve_paid",$event_approve_paid);

						if ($event_approve_paid){
							$event->setString("status", $eventStatus->getDefaultStatus());
						}else{
							$event->setString("status", "A");
						}

						$event->Save();

					}

				}

				$sql = "SELECT * FROM Invoice_Banner WHERE invoice_id = ".$invoiceObj->getString("id")."";
				$r = $db->query($sql);

				while ($row = mysql_fetch_assoc($r)) $banner_ids[] = $row["banner_id"];

				if ($banner_ids) {

					$bannerStatus = new ItemStatus();

					foreach ($banner_ids as $each_banner_id) $banners[] = new Banner($each_banner_id);

					if ($banners) foreach ($banners as $banner) {
						
						setting_get("banner_approve_paid", $banner_approve_paid);

						if($banner->getString("expiration_setting") == BANNER_EXPIRATION_IMPRESSION){

							if ($banner_approve_paid){
								$sql = "UPDATE Banner set impressions = impressions + ".$banner->getNumber("unpaid_impressions").", renewal_date = '0000-00-00', unpaid_impressions = 0 WHERE id = ".$banner->getNumber("id");
							} else {
								$sql = "UPDATE Banner set impressions = impressions + ".$banner->getNumber("unpaid_impressions").", renewal_date = '0000-00-00', unpaid_impressions = 0, status = 'A' WHERE id = ".$banner->getNumber("id");	
							}
							$result = $db->query($sql);

						} elseif ($banner->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE){

							$sql = "UPDATE Invoice_Banner SET renewal_date = '".$banner->getNextRenewalDate()."' WHERE invoice_id = ".$invoiceObj->getString("id")." AND banner_id = ".$banner->getString("id")."";
							$r = $db->query($sql);

							$banner->setString("renewal_date", $banner->getNextRenewalDate());

							if ($banner_approve_paid){
								$banner->setString("status", $bannerStatus->getDefaultStatus());
							}else{
								$banner->setString("status", "A");
							}

							$banner->Save();

						}

					}

				}

				$sql = "SELECT * FROM Invoice_Classified WHERE invoice_id = ".$invoiceObj->getString("id")."";
				$r = $db->query($sql);

				while($row = mysql_fetch_assoc($r)) $classified_ids[] = $row["classified_id"];

				if ($classified_ids) {

					$classifiedStatus = new ItemStatus();

					foreach ($classified_ids as $each_classified_id) $classifieds[] = new Classified($each_classified_id);

					if ($classifieds) foreach ($classifieds as $classified) {

						$sql = "UPDATE Invoice_Classified SET renewal_date = '".$classified->getNextRenewalDate()."' WHERE invoice_id = ".$invoiceObj->getString("id")." AND classified_id = ".$classified->getString("id")."";
						$r = $db->query($sql);

						$classified->setString("renewal_date", $classified->getNextRenewalDate());
						setting_get("classified_approve_paid", $classified_approve_paid);

						if ($classified_approve_paid){
							$classified->setString("status", $classifiedStatus->getDefaultStatus());
						}else{
							$classified->setString("status", "A");
						}
						$classified->Save();

					}

				}

				$sql = "SELECT * FROM Invoice_Article WHERE invoice_id = ".$invoiceObj->getString("id")."";
				$r = $db->query($sql);

				while($row = mysql_fetch_assoc($r)) $article_ids[] = $row["article_id"];

				if ($article_ids) {

					$articleStatus = new ItemStatus();

					foreach ($article_ids as $each_article_id) $articles[] = new Article($each_article_id);

					if ($articles) foreach ($articles as $article) {

						$sql = "UPDATE Invoice_Article SET renewal_date = '".$article->getNextRenewalDate()."' WHERE invoice_id = ".$invoiceObj->getString("id")." AND article_id = ".$article->getString("id")."";
						$r = $db->query($sql);

						$article->setString("renewal_date", $article->getNextRenewalDate());

						setting_get("article_approve_paid",$article_approve_paid);

						if ($article_approve_paid){
							$article->setString("status", $articleStatus->getDefaultStatus());
						}else{
							$article->setString("status", "A");
						}
						$article->Save();

					}

				}

				$sql = "SELECT * FROM Invoice_CustomInvoice WHERE invoice_id = ".$invoiceObj->getString("id")."";
				$r = $db->query($sql);

				while($row = mysql_fetch_assoc($r)) {
					$custominvoice_ids[] = $row["custom_invoice_id"];
					$custominvoice_tax[] = $row["tax"];
				}

				if ($custominvoice_ids) {
					$k = 0;
					foreach ($custominvoice_ids as $each_custominvoice_id) $customInvoices[] = new CustomInvoice($each_custominvoice_id);

					if ($customInvoices) foreach ($customInvoices as $customInvoice) {

						$customInvoice->setString("paid", "y");

						$taxT = $custominvoice_tax[$k];
						$tax = payment_calculateTax($customInvoice->getNumber("subtotal"),$taxT,true,false);
						$k++;

						$customInvoice->setNumber("tax", $taxT);
						$customInvoice->setNumber("amount", $customInvoice->getNumber("subtotal") + $tax);
						$customInvoice->Save();
					}
				}

				////////////////////////////////////

				$sql = "SELECT package_id FROM Invoice_Package WHERE invoice_id = ".$invoiceObj->getString("id")."";
				$r = $db->query($sql);

				while($row = mysql_fetch_assoc($r)) $package_id = $row["package_id"];

				if ($package_id) {

					$sql = "SELECT module_id, module, domain_id FROM PackageModules WHERE parent_domain_id = ".SELECTED_DOMAIN_ID." AND package_id = ".$package_id." AND account_id = ".$invoiceObj->getString("account_id");
					$r = $dbMain->query($sql);
					$i=0;
					while($row = mysql_fetch_assoc($r)){
						$itemsInfo[$i]["module_id"] = $row["module_id"];
						$itemsInfo[$i]["module"] = $row["module"];
						$itemsInfo[$i]["domain_id"] = $row["domain_id"];
						$i++;
					}

					foreach($itemsInfo as $item){
						if ($item["module"] != "custom_package"){
							$className = ucfirst($item["module"]);
							$item_id = $item["module_id"];
							$domain_idItem = $item["domain_id"];

							$itemObj = new $className($item_id);

							$itemStatus = new ItemStatus();

							setting_get($item["module"]."_approve_paid", $item_approve_paid);

							if ($item_approve_paid){
								$stritemStatus = $itemStatus->getDefaultStatus();
							}else{
								$stritemStatus = "A";
							}


							$sql = "UPDATE $className SET status = ".db_formatString($stritemStatus).", renewal_date = ".db_formatString($itemObj->getNextRenewalDate())." WHERE id = ".$item_id;
							$dbItem = db_getDBObjectByDomainID($domain_idItem, $dbMain);
							$dbItem->query($sql);
						}

					}

				}
				/////////////////////////////////////
			}

			header("Location: ".DEFAULT_URL."/sitemgr/invoices/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;

		}

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$invoiceStatusObj = new InvoiceStatus();
	unset($arrayValue);
	unset($arrayName);
	$arrayValue = $invoiceStatusObj->getValues();
	$arrayName = $invoiceStatusObj->getNames();
	unset($arrayValueDD);
	unset($arrayNameDD);
	for ($i=0; $i<count($arrayValue); $i++) {
		if ($arrayValue[$i] != "E") {
			$arrayValueDD[] = $arrayValue[$i];
			$arrayNameDD[] = $arrayName[$i];
		}
	}
	$statusDropDown = html_selectBox("status", $arrayNameDD, $arrayValueDD, $invoiceObj->getString("status"), "", "class='input-dd-form-settings'", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");

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
			<h1><?=string_ucwords(system_showText(LANG_SITEMGR_INVOICE))?> <?=system_showText(LANG_SITEMGR_MENU_SETTINGS)?></h1>
		</div>
	</div>
	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_invoice_submenu.php"); ?>
			
			<div class="baseForm">

			<form name="invoicesettings" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				<input type="hidden" name="id" value="<?=$id?>" />
				<? include(INCLUDES_DIR."/forms/form_invoicesettings.php"); ?>
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<button type="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
				<button type="button" name="back" value="Back" class="input-button-form" onclick="document.getElementById('forminvoicesettignscancel').submit();"><?=system_showText(LANG_SITEMGR_BACK)?></button>
			</form>
			<form id="forminvoicesettignscancel" action="<?=DEFAULT_URL?>/sitemgr/invoices/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
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