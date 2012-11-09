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
	# * FILE: /includes/code/billing_simplepay.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_simplepay.inc.php");

	####################################################################################################
	####################################################################################################
	####################################################################################################
	if (string_strpos($_SERVER["PHP_SELF"], "simplepayprocess.php") !== false) {

		$accountObj                             = new Account($_POST["extra_account_id"]);
		$_SESSION["simplepay_account_id"]		= $_POST["extra_account_id"];
		$transactionLog["account_id"]           = $accountObj->getNumber("id");
		$transactionLog["username"]             = $accountObj->getString("username");
		$transactionLog["ip"]                   = $_SERVER["REMOTE_ADDR"];
		$transactionLog["transaction_id"]       = "---";
		$transactionLog["transaction_status"]   = "SIMPLEPAYPENDING";
		$transactionLog["transaction_datetime"] = date("Y-m-d H:i:s");
		$transactionLog["transaction_amount"]   = $_POST["amount"];
		$transactionLog["transaction_currency"] = SIMPLEPAY_CURRENCY;
		$transactionLog["system_type"]          = "simplepay";
		if (SIMPLEPAYRECURRING_FEATURE == "on") {
			$transactionLog["recurring"]        = "y";
		} else {
			$transactionLog["recurring"]        = "n";
		}
		$transactionLog["notes"]                = "";
		$transactionLog["return_fields"]        = $_POST["referenceId"];
		$domain_id								= $_POST["extra_domain_id"];
		$paymentLogObj = new PaymentLog($transactionLog);
		$paymentLogObj->Save($domain_id);

		$listing_ids = explode("::",$_POST["extra_listing_ids"]);
		$listing_amounts = explode("::",$_POST["extra_listing_amounts"]);
		$event_ids = explode("::",$_POST["extra_event_ids"]);
		$event_amounts = explode("::",$_POST["extra_event_amounts"]);
		$banner_ids = explode("::",$_POST["extra_banner_ids"]);
		$banner_amounts = explode("::",$_POST["extra_banner_amounts"]);
		$classified_ids = explode("::",$_POST["extra_classified_ids"]);
		$classified_amounts = explode("::",$_POST["extra_classified_amounts"]);
		$article_ids = explode("::",$_POST["extra_article_ids"]);
		$article_amounts = explode("::",$_POST["extra_article_amounts"]);
		$custominvoice_ids = explode("::",$_POST["extra_custominvoice_ids"]);
		$custominvoice_amounts = explode("::",$_POST["extra_custominvoice_amounts"]);
		$package_id = $_POST["extra_package_id"];

		if (!empty($listing_ids[0])) {

			$listingStatus = new ItemStatus();

			$amountAux = 0;
			$levelObj = new ListingLevel();
			foreach($listing_ids as $each_listing_id){

				$listingObj = new Listing($each_listing_id);

				$dbMain = db_getDBObject(DEFAULT_DB, true);
				$dbObjCat = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				$category_amount = 0;
				$sql = "SELECT category_id FROM Listing_Category WHERE listing_id = ".$listingObj->getString("id")."";
				$result = $dbObjCat->query($sql);
				if(mysql_num_rows($result)){
					while($row = mysql_fetch_assoc($result)){
						$category_amount++;
					}

				}

				$transaction_listing_log["payment_log_id"] = $paymentLogObj->getNumber("id");
				$transaction_listing_log["listing_id"]     = $each_listing_id;
				$transaction_listing_log["listing_title"]  = $listingObj->getString("title", false);
				$transaction_listing_log["level"]          = $listingObj->getString("level");
				$transaction_listing_log["level_label"]    = $levelObj->showLevel($listingObj->getString("level"));
				$transaction_listing_log["renewal_date"]   = "---";
				$transaction_listing_log["discount_id"]    = $listingObj->getString("discount_id");
				$transaction_listing_log["categories"]     = ($category_amount) ? $category_amount : 0;
				$transaction_listing_log["amount"]         = str_replace(",","",$listing_amounts[$amountAux]);
				$amountAux++;

				$transaction_listing_log["extra_categories"] = 0;
				if (($category_amount > 0) && (($category_amount - $levelObj->getFreeCategory($listingObj->getString("level"))) > 0)) {
					$transaction_listing_log["extra_categories"] = $category_amount - $levelObj->getFreeCategory($listingObj->getString("level"));
				} else {
					$transaction_listing_log["extra_categories"] = 0;
				}

				$transaction_listing_log["listingtemplate_title"] = "";
				if (LISTINGTEMPLATE_FEATURE == "on") {
					if ($listingObj->getString("listingtemplate_id")) {
						$listingTemplateObj = new ListingTemplate($listingObj->getString("listingtemplate_id"));
						$transaction_listing_log["listingtemplate_title"] = $listingTemplateObj->getString("title", false);
					}
				}

				$paymentListingLogObj = new PaymentListingLog($transaction_listing_log, $domain_id);
				$paymentListingLogObj->Save();

			}

			unset($listingObj);

		}

		if (!empty($event_ids[0])) {

			$eventStatus = new ItemStatus();

			$amountAux = 0;
			$levelObj = new EventLevel();
			foreach($event_ids as $each_event_id){

				$eventObj = new Event($each_event_id);

				$transaction_event_log["payment_log_id"] = $paymentLogObj->getNumber("id");
				$transaction_event_log["event_id"]       = $each_event_id;
				$transaction_event_log["event_title"]    = $eventObj->getString("title",false);
				$transaction_event_log["level"]          = $eventObj->getString("level");
				$transaction_event_log["level_label"]    = $levelObj->showLevel($eventObj->getString("level"));
				$transaction_event_log["renewal_date"]   = "---";
				$transaction_event_log["discount_id"]    = $eventObj->getString("discount_id");
				$transaction_event_log["amount"]         = str_replace(",","",$event_amounts[$amountAux]);
				$amountAux++;

				$paymentEventLogObj = new PaymentEventLog($transaction_event_log, $domain_id);
				$paymentEventLogObj->Save();

			}

			unset($eventObj);

		}

		if (!empty($banner_ids[0])) {

			$bannerStatus = new ItemStatus();

			$amountAux = 0;
			$levelObj = new BannerLevel();
			foreach($banner_ids as $each_banner_id){

				$bannerObj = new Banner($each_banner_id);

				$transaction_banner_log["payment_log_id"] = $paymentLogObj->getNumber("id");
				$transaction_banner_log["banner_id"]      = $each_banner_id;
				$transaction_banner_log["banner_caption"] = $bannerObj->getString("caption",false);
				$transaction_banner_log["level"]          = $bannerObj->getString("type");
				$transaction_banner_log["level_label"]    = $levelObj->showLevel($bannerObj->getString("type"));
				$transaction_banner_log["renewal_date"]   = "---";
				$transaction_banner_log["discount_id"]    = $bannerObj->getString("discount_id");
				$transaction_banner_log["impressions"]    = 0;
				$transaction_banner_log["amount"]         = str_replace(",","",$banner_amounts[$amountAux]);
				$amountAux++;

				$paymentBannerLogObj = new PaymentBannerLog($transaction_banner_log, $domain_id);
				$paymentBannerLogObj->Save();

			}

			unset($bannerObj);

		}

		if (!empty($classified_ids[0])) {

			$classifiedStatus = new ItemStatus();

			$amountAux = 0;
			$levelObj = new ClassifiedLevel();
			foreach($classified_ids as $each_classified_id){

				$classifiedObj = new Classified($each_classified_id);

				$transaction_classified_log["payment_log_id"]   = $paymentLogObj->getNumber("id");
				$transaction_classified_log["classified_id"]    = $each_classified_id;
				$transaction_classified_log["classified_title"] = $classifiedObj->getString("title",false);
				$transaction_classified_log["level"]            = $classifiedObj->getString("level");
				$transaction_classified_log["level_label"]      = $levelObj->showLevel($classifiedObj->getString("level"));
				$transaction_classified_log["renewal_date"]     = "---";
				$transaction_classified_log["discount_id"]      = $classifiedObj->getString("discount_id");
				$transaction_classified_log["amount"]           = str_replace(",","",$classified_amounts[$amountAux]);
				$amountAux++;

				$paymentClassifiedLogObj = new PaymentClassifiedLog($transaction_classified_log, $domain_id);
				$paymentClassifiedLogObj->Save();

			}

			unset($classifiedObj);

		}

		if (!empty($article_ids[0])) {

			$articleStatus = new ItemStatus();

			$amountAux = 0;
			$levelObj = new ArticleLevel();
			foreach($article_ids as $each_article_id){

				$articleObj = new Article($each_article_id);

				$transaction_article_log["payment_log_id"] = $paymentLogObj->getNumber("id");
				$transaction_article_log["article_id"]     = $each_article_id;
				$transaction_article_log["article_title"]  = $articleObj->getString("title",false);
				$transaction_article_log["level"]          = $articleObj->getString("level");
				$transaction_article_log["level_label"]    = $levelObj->showLevel($articleObj->getString("level"));
				$transaction_article_log["renewal_date"]   = "---";
				$transaction_article_log["discount_id"]    = $articleObj->getString("discount_id");
				$transaction_article_log["amount"]         = str_replace(",","",$article_amounts[$amountAux]);
				$amountAux++;

				$paymentArticleLogObj = new PaymentArticleLog($transaction_article_log, $domain_id);
				$paymentArticleLogObj->Save();

			}

			unset($articleObj);

		}

		if (!empty($custominvoice_ids[0])) {

			$amountAux = 0;
			foreach($custominvoice_ids as $each_custominvoice_id){

				$customInvoiceObj = new CustomInvoice($each_custominvoice_id);

				$transaction_custominvoice_log["payment_log_id"]    = $paymentLogObj->getNumber("id");
				$transaction_custominvoice_log["custom_invoice_id"] = $each_custominvoice_id;
				$transaction_custominvoice_log["title"]             = $customInvoiceObj->getString("title");
				$transaction_custominvoice_log["date"]              = $customInvoiceObj->getString("date");
				$transaction_custominvoice_log["items"]             = $customInvoiceObj->getTextItems();
				$transaction_custominvoice_log["items_price"]       = $customInvoiceObj->getTextPrices();
				$transaction_custominvoice_log["amount"]            = $customInvoiceObj->getNumber("subtotal");
				$amountAux++;

				$paymentCustomInvoiceLogObj = new PaymentCustomInvoiceLog($transaction_custominvoice_log, $domain_id);
				$paymentCustomInvoiceLogObj->Save();

			}

			unset($customInvoiceObj);

		}

		if ($package_id) {

			/////////////////////////////
			$packageObj = new Package($package_id);
			$array_package_offers = $packageObj->getPackagesByDomainID();

			$auxitem_name = $array_package_offers[0]["items"][0]["module"];
			$auxpackage_name = $packageObj->getString("title");
			if ($auxitem_name) {
				switch($auxitem_name) {
						 case 'listing': $item_name = ucfirst(LANG_LISTING_FEATURE_NAME);
										 $level = new ListingLevel();
										 $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

										 $msg_packagetr = system_showText(LANG_ADD_A)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

										 break;

						 case 'banner': $item_name = ucfirst(LANG_BANNER_FEATURE_NAME);
										 $level = new BannerLevel();
										 $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

										 $msg_packagetr = system_showText(LANG_ADD_A)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

										 break;

						 case 'event': $item_name = ucfirst(LANG_EVENT_FEATURE_NAME);
										 $level = new EventLevel();
										 $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

										 $msg_packagetr = system_showText(LANG_ADD_AN)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

										break;

						case 'classified': $item_name = ucfirst(LANG_CLASSIFIED_FEATURE_NAME);
											 $level = new ClassifiedLevel();
											 $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

											 $msg_packagetr = system_showText(LANG_ADD_A)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

											break;

						case 'article': $item_name = ucfirst(LANG_ARTICLE_FEATURE_NAME);
										 $level = new ArticleLevel();
										 $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

										 $msg_packagetr = system_showText(LANG_ADD_AN)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

										 break;

						case 'custom_package': $item_name = ucfirst(LANG_GIFT);
												break;

					}

					$auxdomains_names = "";
					$aux_package_item_price = "";
					foreach ($array_package_offers as $package_offer) {
						foreach ($package_offer['items'] as $package_offer_item) {
							if ($package_offer_item['domain_id']>0) {
								$aux_domain_obj = new Domain($package_offer_item['domain_id']);
								$auxdomains_names .= "&nbsp;&nbsp;&nbsp;-".$aux_domain_obj->getString('name')."<br />";
								$auxlevel_names .= $item_levelName."<br />";
							}

							if ($package_offer_item['price']==0) {
								$aux_package_item_price .= CURRENCY_SYMBOL." ".system_showText(LANG_FREE)."<br />";
							} else {
								$aux_package_item_price .= CURRENCY_SYMBOL." ".$package_offer_item['price']."<br />";
								$aux_package_total += $package_offer_item['price'];
							}
						}

						$auxdomains_names = string_substr($auxdomains_names, 0, -4);
						$auxlevel_names = string_substr($auxlevel_names, 0, -4);
						$aux_package_item_price = string_substr($aux_package_item_price, 0, -4);
					 }
			}

			$transaction_package_log["payment_log_id"]    = $paymentLogObj->getNumber("id");
			$transaction_package_log["package_id"]		  = $package_id;
			$transaction_package_log["package_title"]     = $packageObj->getString("title");
			$transaction_package_log["items"]             = $item_name." ".$item_levelName."\n".str_replace("-","",$auxdomains_names);
			$transaction_package_log["items_price"]       = str_replace(CURRENCY_SYMBOL." ", "",str_replace("<br />","\n",$aux_package_item_price));
			$transaction_package_log["amount"]            = payment_calculateTax(str_replace(",","",$aux_package_total), $payment_tax_value, false);

			$paymentPacakgeObj = new PaymentPackageLog($transaction_package_log, $domain_id);
			$paymentPacakgeObj->Save();

			unset($packageObj);

		}


		?>
		<html>
			<head>
				<title>Simple Pay Process</title>
			</head>
			<body>
				<img src="<?=DEFAULT_URL;?>/images/img_loading.gif" border="0" alt="loading" title="loading" />
				<form name="simplepayprocessform" id="simplepayprocessform" action="<?=SIMPLEPAY_URL;?>" method="post">
					<?
					if ($_POST) {
						if (is_array($_POST)) {
							foreach ($_POST as $key => $value) {
								if (string_strpos($key, "extra_") === false) {
									echo "<input type=\"hidden\" name=\"$key\" value=\"$value\" />\n";
								}
							}
						}
					}
					?>
				</form>
				<script type="text/javascript">
					document.getElementById('simplepayprocessform').submit();
				</script>
			</body>
		</html>
		<?

	}

	####################################################################################################
	####################################################################################################
	####################################################################################################

	elseif (string_strpos($_SERVER["PHP_SELF"], "simplepayreturn.php") !== false) {

		if (($_POST["status"] == "PS") || ($_POST["status"] == "SS")) {

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$db = db_getDBObjectByDomainID(defined("SELECTED_DOMAIN_ID") ? SELECTED_DOMAIN_ID : $_SESSION["domain_id"], $dbMain);

			$sql = "SELECT id FROM Payment_Log WHERE return_fields = '".$_POST["referenceId"]."' AND system_type = 'simplepay'";
			$r = $db->query($sql);
			if (!mysql_num_rows($r)) {

				$transaction_id = (($_POST["subscriptionId"])?($_POST["subscriptionId"]):($_POST["transactionId"]));

				$sql = "SELECT id FROM Payment_Log WHERE return_fields LIKE '%referenceId=".$_POST["referenceId"]."%' AND transaction_id = '".$transaction_id."' AND DATE_FORMAT(DATE_ADD(transaction_datetime, INTERVAL 2 DAY), '%Y%m%d') < DATE_FORMAT(NOW(), '%Y%m%d') AND system_type = 'simplepay' ORDER BY id DESC";
				$r = $db->query($sql);
				if (mysql_num_rows($r) > 0) {

					$row = mysql_fetch_assoc($r);

					$edirectory_transaction_id = $row["id"];

					$transactionLog["transaction_id"]       = $transaction_id;
					$transactionLog["transaction_status"]   = "SIMPLEPAYSUCCESS";
					$transactionLog["transaction_datetime"] = date("Y-m-d H:i:s");
					$transaction_amount_aux                 = explode(" ", $_POST["transactionAmount"]);
					$transactionLog["transaction_amount"]   = $transaction_amount_aux[1];
					$transactionLog["transaction_currency"] = $transaction_amount_aux[0];
					$transactionLog["notes"]                = "";
					$transactionLog["return_fields"]        = system_array2nvp($_POST, " || ");
					$paymentLogObj = new PaymentLog($edirectory_transaction_id, $_SESSION["domain_id"]);
					$paymentLogObj->MakeFromRow($transactionLog);
					$paymentLogObj->setNumber("id", 0);
					$paymentLogObj->Save();
					$listingStatus = new ItemStatus();
					$levelObj = new ListingLevel();
					$sql = "SELECT * FROM Payment_Listing_Log WHERE payment_log_id = '".$edirectory_transaction_id."'";
					$r = $db->query($sql);
					while($row = mysql_fetch_assoc($r)){

						$listingObj = new Listing($row["listing_id"]);
						$listingObj->setString("renewal_date", $listingObj->getNextRenewalDate());

						setting_get("listing_approve_paid", $listing_approve_paid);

						if ($listing_approve_paid){
							$listingObj->setString("status", $listingStatus->getDefaultStatus());
						}else{
							$listingObj->setString("status", "A");
						}
						
						$listingObj->Save();

						$transaction_listing_log["payment_log_id"]        = $paymentLogObj->getNumber("id");
						$transaction_listing_log["renewal_date"]          = $listingObj->getString("renewal_date");
						$transaction_listing_log["listing_id"]            = $row["listing_id"];
						$transaction_listing_log["listing_title"]         = $row["listing_title"];
						$transaction_listing_log["discount_id"]           = $row["discount_id"];
						$transaction_listing_log["level"]                 = $row["level"];
						$transaction_listing_log["level_label"]           = $row["level_label"];
						$transaction_listing_log["categories"]            = $row["categories"];
						$transaction_listing_log["extra_categories"]      = $row["extra_categories"];
						$transaction_listing_log["listingtemplate_title"] = $row["listingtemplate_title"];
						$transaction_listing_log["amount"]                = $row["amount"];

						$paymentListingLogObj = new PaymentListingLog($transaction_listing_log, $_SESSION["domain_id"]);
						$paymentListingLogObj->Save();

						unset($listingObj);

					}

					$eventStatus = new ItemStatus();
					$levelObj = new EventLevel();
					$sql = "SELECT * FROM Payment_Event_Log WHERE payment_log_id = '".$edirectory_transaction_id."'";
					$r = $db->query($sql);
					while($row = mysql_fetch_assoc($r)){

						$eventObj = new Event($row["event_id"]);
						$eventObj->setString("renewal_date", $eventObj->getNextRenewalDate());
					
						setting_get("event_approve_paid", $event_approve_paid);

						if ($event_approve_paid){
							$eventObj->setString("status", $eventStatus->getDefaultStatus());
						}else{
							$eventObj->setString("status", "A");
						}
							
						$eventObj->Save();

						$transaction_event_log["payment_log_id"] = $paymentLogObj->getNumber("id");
						$transaction_event_log["renewal_date"]   = $eventObj->getString("renewal_date");
						$transaction_event_log["event_id"]       = $row["event_id"];
						$transaction_event_log["event_title"]    = $row["event_title"];
						$transaction_event_log["discount_id"]    = $row["discount_id"];
						$transaction_event_log["level"]          = $row["level"];
						$transaction_event_log["level_label"]    = $row["level_label"];
						$transaction_event_log["amount"]         = $row["amount"];

						$paymentEventLogObj = new PaymentEventLog($transaction_event_log, $_SESSION["domain_id"]);
						$paymentEventLogObj->Save();

						unset($eventObj);

					}

					$bannerStatus = new ItemStatus();
					$levelObj = new BannerLevel();
					$sql ="SELECT * FROM Payment_Banner_Log WHERE payment_log_id = '".$edirectory_transaction_id."'";
					$r = $db->query($sql);
					while($row = mysql_fetch_assoc($r)){

						$bannerObj = new Banner($row["banner_id"]);
						if ($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE){
							$bannerObj->setString("renewal_date", $bannerObj->getNextRenewalDate());
							
							setting_get("banner_approve_paid", $banner_approve_paid);
											
							if ($banner_approve_paid){
								$bannerObj->setString("status", $bannerStatus->getDefaultStatus());
							}else{
								$bannerObj->setString("status", "A");
							}
							
							$bannerObj->Save();
							
							$transaction_banner_log["payment_log_id"] = $paymentLogObj->getNumber("id");
							$transaction_banner_log["renewal_date"]   = $bannerObj->getString("renewal_date");
							$transaction_banner_log["banner_id"]      = $row["banner_id"];
							$transaction_banner_log["banner_caption"] = $row["banner_caption"];
							$transaction_banner_log["discount_id"]    = $row["discount_id"];
							$transaction_banner_log["level"]          = $row["level"];
							$transaction_banner_log["level_label"]    = $row["level_label"];
							$transaction_banner_log["impressions"]    = $row["impressions"];
							$transaction_banner_log["amount"]         = $row["amount"];

							$paymentBannerLogObj = new PaymentBannerLog($transaction_banner_log, $_SESSION["domain_id"]);
							$paymentBannerLogObj->Save();

							unset($bannerObj);
						}
					}

					$classifiedStatus = new ItemStatus();
					$levelObj = new ClassifiedLevel();
					$sql ="SELECT * FROM Payment_Classified_Log WHERE payment_log_id = '".$edirectory_transaction_id."'";
					$r = $db->query($sql);
					while($row = mysql_fetch_assoc($r)){

						$classifiedObj = new Classified($row["classified_id"]);
						$classifiedObj->setString("renewal_date", $classifiedObj->getNextRenewalDate());
						
						setting_get("classified_approve_paid", $classified_approve_paid);

						if ($classified_approve_paid){
							$classifiedObj->setString("status", $classifiedStatus->getDefaultStatus());
						}else{
							$classifiedObj->setString("status", "A");
						}

						$classifiedObj->save();

						$transaction_classified_log["payment_log_id"]   = $paymentLogObj->getNumber("id");
						$transaction_classified_log["renewal_date"]     = $classifiedObj->getString("renewal_date");
						$transaction_classified_log["classified_id"]    = $row["classified_id"];
						$transaction_classified_log["classified_title"] = $row["classified_title"];
						$transaction_classified_log["discount_id"]      = $row["discount_id"];
						$transaction_classified_log["level"]            = $row["level"];
						$transaction_classified_log["level_label"]      = $row["level_label"];
						$transaction_classified_log["amount"]           = $row["amount"];

						$paymentClassifiedLogObj = new PaymentClassifiedLog($transaction_classified_log, $_SESSION["domain_id"]);
						$paymentClassifiedLogObj->Save();

						unset($classifiedObj);

					}

					$articleStatus = new ItemStatus();
					$levelObj = new ArticleLevel();
					$sql ="SELECT * FROM Payment_Article_Log WHERE payment_log_id = '".$edirectory_transaction_id."'";
					$r = $db->query($sql);
					while($row = mysql_fetch_assoc($r)){

						$articleObj = new Article($row["article_id"]);
						$articleObj->setString("renewal_date", $articleObj->getNextRenewalDate());

						setting_get("article_approve_paid", $article_approve_paid);

						if ($article_approve_paid){
							$articleObj->setString("status", $articleStatus->getDefaultStatus());
						}else{
							$articleObj->setString("status", "A");
						}

						$articleObj->Save();

						$transaction_article_log["payment_log_id"] = $paymentLogObj->getNumber("id");
						$transaction_article_log["renewal_date"]   = $articleObj->getString("renewal_date");
						$transaction_article_log["article_id"]     = $row["article_id"];
						$transaction_article_log["article_title"]  = $row["article_title"];
						$transaction_article_log["discount_id"]    = $row["discount_id"];
						$transaction_article_log["level"]          = $row["level"];
						$transaction_article_log["level_label"]    = $row["level_label"];
						$transaction_article_log["amount"]         = $row["amount"];

						$paymentArticleLogObj = new PaymentArticleLog($transaction_article_log, $_SESSION["domain_id"]);
						$paymentArticleLogObj->Save();

						unset($articleObj);

					}

					////////////////////////////////////

					$sql = "SELECT package_id FROM Payment_Package_Log WHERE payment_log_id = ".$edirectory_transaction_id."";
					$r = $db->query($sql);

					while($row = mysql_fetch_assoc($r)) $package_id = $row["package_id"];

					if ($package_id) {

						$sql = "SELECT module_id, module, domain_id FROM PackageModules WHERE parent_domain_id = ".$_SESSION["domain_id"]." AND package_id = ".$package_id." AND account_id = ".$_SESSION["simplepay_account_id"];
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

					$paymentLogObj->sendNotification($_SESSION["domain_id"], $package_id);

				}

			}

		}

	}

	####################################################################################################
	####################################################################################################
	####################################################################################################

	else {

		if (($_GET["status"] == "PS") || ($_GET["status"] == "SS")) {

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$db = db_getDBObjectByDomainID(defined("SELECTED_DOMAIN_ID") ? SELECTED_DOMAIN_ID : $_SESSION["domain_id"], $dbMain);
			$sql = "SELECT id FROM Payment_Log WHERE return_fields = '".$_GET["referenceId"]."' AND system_type = 'simplepay'";
			$r = $db->query($sql);
			if (mysql_num_rows($r) > 0) {

				$row = mysql_fetch_assoc($r);

				$transactionLog["transaction_id"] = (($_GET["subscriptionId"])?($_GET["subscriptionId"]):($_GET["transactionId"]));

				if ($transactionLog["transaction_id"]) {

					$payment_success = "y";

					$transactionLog["transaction_status"]   = "SIMPLEPAYSUCCESS";
					$transactionLog["transaction_datetime"] = date("Y-m-d H:i:s");
					$transactionLog["return_fields"]        = system_array2nvp($_GET, " || ");
					$transactionLog["transaction_subtotal"] = $_SESSION["simplepay_subtotal"];
					$transactionLog["transaction_tax"]		= $_SESSION["simplepay_tax_value"];
					$paymentLogObj = new PaymentLog($row["id"], $_SESSION["domain_id"]);
					$paymentLogObj->MakeFromRow($transactionLog);
					$paymentLogObj->Save();
					unset($_SESSION["simplepay_subtotal"], $_SESSION["simplepay_tax_value"]);
					
					$payment_message = "<p class=\"successMessage\">\n";
					$payment_message .= system_showText(LANG_LABEL_TRANSACTION_STATUS).": ".@constant(string_strtoupper(("LANG_LABEL_".$transactionLog["transaction_status"])))."<br />\n";
					$payment_message .= system_showText(LANG_LABEL_TRANSACTION_ID).": ".$transactionLog["transaction_id"]."<br />\n";
					if ($process == "claim") $payment_message .= system_showText(LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND)." ".system_showText(LANG_MSG_IN_YOUR_TRANSACTION_HISTORY).".\n";
					else $payment_message .= system_showText(LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND)." ".system_showText(LANG_MSG_IN_YOUR)." <a href=\"".DEFAULT_URL."/members/transactions/index.php\">".system_showText(LANG_LABEL_TRANSACTION_HISTORY)."</a>.\n";
					$payment_message .= "</p>\n";

					$listingStatus = new ItemStatus();
					$levelObj = new ListingLevel();
					$sql = "SELECT * FROM Payment_Listing_Log WHERE payment_log_id = '".$paymentLogObj->getNumber("id")."'";
					$r = $db->query($sql);
					while($row = mysql_fetch_assoc($r)){

						$listingObj = new Listing($row["listing_id"]);
						$listingObj->setString("renewal_date", $listingObj->getNextRenewalDate());
						
						
						setting_get("listing_approve_paid", $listing_approve_paid);

						if ($listing_approve_paid){
							$listingObj->setString("status", $listingStatus->getDefaultStatus());
						}else{
							$listingObj->setString("status", "A");
						}
						
						$listingObj->Save();

						$sql = "UPDATE Payment_Listing_Log SET renewal_date = '".$listingObj->getString("renewal_date")."' WHERE payment_log_id = '".$paymentLogObj->getNumber("id")."' AND listing_id = '".$listingObj->getNumber("id")."'";
						$db->query($sql);

						unset($listingObj);

					}

					$eventStatus = new ItemStatus();
					$levelObj = new EventLevel();
					$sql = "SELECT * FROM Payment_Event_Log WHERE payment_log_id = '".$paymentLogObj->getNumber("id")."'";
					$r = $db->query($sql);
					while($row = mysql_fetch_assoc($r)){

						$eventObj = new Event($row["event_id"]);
						$eventObj->setString("renewal_date", $eventObj->getNextRenewalDate());
						
						setting_get("event_approve_paid", $event_approve_paid);
									
						if ($event_approve_paid){
							$eventObj->setString("status", $eventStatus->getDefaultStatus());
						}else{
							$eventObj->setString("status", "A");
						}
						
						$eventObj->Save();

						$sql = "UPDATE Payment_Event_Log SET renewal_date = '".$eventObj->getString("renewal_date")."' WHERE payment_log_id = '".$paymentLogObj->getNumber("id")."' AND event_id = '".$eventObj->getNumber("id")."'";
						$db->query($sql);

						unset($eventObj);

					}

					$bannerStatus = new ItemStatus();
					$levelObj = new BannerLevel();
					$sql = "SELECT * FROM Payment_Banner_Log WHERE payment_log_id = '".$paymentLogObj->getNumber("id")."'";
					$r = $db->query($sql);
					while($row = mysql_fetch_assoc($r)){

						$bannerObj = new Banner($row["banner_id"]);
						if($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_IMPRESSION){

							setting_get("banner_approve_paid", $banner_approve_paid);

							if ($banner_approve_paid){
								$sql = "UPDATE Banner set impressions = impressions + ".$bannerObj->getNumber("unpaid_impressions").", renewal_date = '0000-00-00', unpaid_impressions = 0 WHERE id = ".$bannerObj->getNumber("id");
							}else{
								$sql = "UPDATE Banner set impressions = impressions + ".$bannerObj->getNumber("unpaid_impressions").", renewal_date = '0000-00-00', unpaid_impressions = 0, status = 'A' WHERE id = ".$bannerObj->getNumber("id");
							}
							
							$db->query($sql);

						} elseif ($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE){
							$bannerObj->setString("renewal_date", $bannerObj->getNextRenewalDate());
							
							setting_get("banner_approve_paid", $banner_approve_paid);

							if ($banner_approve_paid){
								$bannerObj->setString("status", $bannerStatus->getDefaultStatus());
							}else{
								$bannerObj->setString("status", "A");
							}
							
							$bannerObj->Save();
						}

						$sql = "UPDATE Payment_Banner_Log SET renewal_date = '".$bannerObj->getString("renewal_date")."', impressions = '".(($bannerObj->getNumber("unpaid_impressions"))?($bannerObj->getNumber("unpaid_impressions")):(0))."' WHERE payment_log_id = '".$paymentLogObj->getNumber("id")."' AND banner_id = '".$bannerObj->getNumber("id")."'";
						$db->query($sql);

						unset($bannerObj);

					}

					$classifiedStatus = new ItemStatus();
					$levelObj = new ClassifiedLevel();
					$sql = "SELECT * FROM Payment_Classified_Log WHERE payment_log_id = '".$paymentLogObj->getNumber("id")."'";
					$r = $db->query($sql);
					while($row = mysql_fetch_assoc($r)){

						$classifiedObj = new Classified($row["classified_id"]);
						$classifiedObj->setString("renewal_date", $classifiedObj->getNextRenewalDate());
						
						setting_get("classified_approve_paid", $classified_approve_paid);
		
						if ($classified_approve_paid){
							$classifiedObj->setString("status", $classifiedStatus->getDefaultStatus());
						}else{
							$classifiedObj->setString("status", "A");
						}
						
						$classifiedObj->save();

						$sql = "UPDATE Payment_Classified_Log SET renewal_date = '".$classifiedObj->getString("renewal_date")."' WHERE payment_log_id = '".$paymentLogObj->getNumber("id")."' AND classified_id = '".$classifiedObj->getNumber("id")."'";
						$db->query($sql);

						unset($classifiedObj);

					}

					$articleStatus = new ItemStatus();
					$levelObj = new ArticleLevel();
					$sql = "SELECT * FROM Payment_Article_Log WHERE payment_log_id = '".$paymentLogObj->getNumber("id")."'";
					$r = $db->query($sql);
					while($row = mysql_fetch_assoc($r)){

						$articleObj = new Article($row["article_id"]);
						$articleObj->setString("renewal_date", $articleObj->getNextRenewalDate());
						
						setting_get("article_approve_paid",$article_approve_paid);
										
						if ($article_approve_paid){
							$articleObj->setString("status", $articleStatus->getDefaultStatus());
						}else{
							$articleObj->setString("status", "A");
						}
						
						$articleObj->Save();

						$sql = "UPDATE Payment_Article_Log SET renewal_date = '".$articleObj->getString("renewal_date")."' WHERE payment_log_id = '".$paymentLogObj->getNumber("id")."' AND article_id = '".$articleObj->getNumber("id")."'";
						$db->query($sql);

						unset($articleObj);

					}

					$sql ="SELECT * FROM Payment_CustomInvoice_Log WHERE payment_log_id = '".$paymentLogObj->getNumber("id")."'";
					$r = $db->query($sql);
					while($row = mysql_fetch_assoc($r)){

						$customInvoiceObj = new CustomInvoice($row["custom_invoice_id"]);
						$cInvoiceAmount = payment_calculateTax($customInvoiceObj->getNumber("amount"), $paymentLogObj->getNumber("transaction_tax"));
						$customInvoiceObj->setString("paid", "y");
						$customInvoiceObj->setNumber("tax", $paymentLogObj->getNumber("transaction_tax"));
						$customInvoiceObj->setNumber("subtotal", $customInvoiceObj->getNumber("amount"));
						$customInvoiceObj->setNumber("amount", $cInvoiceAmount);
						$customInvoiceObj->Save();

						unset($customInvoiceObj);

					}

					////////////////////////////////////

					$sql = "SELECT package_id FROM Payment_Package_Log WHERE payment_log_id = ".$paymentLogObj->getNumber("id")."";
					$r = $db->query($sql);

					while($row = mysql_fetch_assoc($r)) $package_id = $row["package_id"];

					if ($package_id) {

						$sql = "SELECT module_id, module, domain_id FROM PackageModules WHERE parent_domain_id = ".$_SESSION["domain_id"]." AND package_id = ".$package_id." AND account_id = ".$_SESSION["simplepay_account_id"];
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

					$paymentLogObj->sendNotification($_SESSION["domain_id"], $package_id);

				} else {

					$payment_message .= "<p class=\"errorMessage\">\n";
					$payment_message .= system_showText(LANG_LABEL_STATUS).": ".system_showText(LANG_LABEL_ERROR)." (55001)<br />\n";
					$payment_message .= system_showText(LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN)."<br />\n";
					$payment_message .= "<a href=\"".DEFAULT_URL."/members/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";

				}

			} else {

				$payment_message .= "<p class=\"errorMessage\">\n";
				$payment_message .= system_showText(LANG_LABEL_STATUS).": ".system_showText(LANG_LABEL_ERROR)." (55000)<br />\n";
				$payment_message .= system_showText(LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN)."<br />\n";
				$payment_message .= "<a href=\"".DEFAULT_URL."/members/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";

			}

		} else {

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$db = db_getDBObjectByDomainID(defined("SELECTED_DOMAIN_ID") ? SELECTED_DOMAIN_ID : $_SESSION["domain_id"], $dbMain);
			$sql = "SELECT id FROM Payment_Log WHERE return_fields = '".$_GET["referenceId"]."' AND system_type = 'simplepay'";
			$r = $db->query($sql);
			if (mysql_num_rows($r) > 0) {
				$row = mysql_fetch_assoc($r);
				$transactionLog["transaction_id"]         = (($_GET["subscriptionId"])?($_GET["subscriptionId"]):($_GET["transactionId"]));
				if ($_GET["status"] == "A") {
					$transactionLog["transaction_status"] = "SIMPLEPAYABORTED";
				} elseif ($_GET["status"] == "PF") {
					$transactionLog["transaction_status"] = "SIMPLEPAYFAILED";
				} elseif ($_GET["status"] == "PI") {
					$transactionLog["transaction_status"] = "SIMPLEPAYDECLINED";
				} else {
					$transactionLog["transaction_status"] = "SIMPLEPAYUNKNOW";
				}
				$transactionLog["transaction_datetime"]   = date("Y-m-d H:i:s");
				$transactionLog["return_fields"]          = system_array2nvp($_GET, " || ");
				$paymentLogObj = new PaymentLog($row["id"]);
				$paymentLogObj->MakeFromRow($transactionLog);
				$paymentLogObj->Save();
			}

			$payment_message .= "<p class=\"errorMessage\">".system_showText(LANG_LABEL_STATUS).": ".@constant(string_strtoupper(("LANG_LABEL_".$transactionLog["transaction_status"])))."<br />\n";
			$payment_message .= $_GET["statusReason"]."<br />\n";
			if ($process == "signup") $try_again_message = "\n<a href=\"".DEFAULT_URL."/members/".$process."/payment.php?payment_method=simplepay\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
			elseif ($process == "claim") $try_again_message = "\n<a style=\"cursor:pointer\" href=\"".DEFAULT_URL."/members/".$process."/payment.php?payment_method=simplepay&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
			else $try_again_message = "\n<a href=\"".DEFAULT_URL."/members/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
			$payment_message .= $try_again_message."</p>\n";

		}

	}

	####################################################################################################
	####################################################################################################
	####################################################################################################

?>
