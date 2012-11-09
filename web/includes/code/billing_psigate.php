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
	# * FILE: /includes/code/billing_psigate.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_psigate.inc.php");

	include_once(EDIRECTORY_ROOT."/members/billing/class.psigate_xml.php");

	extract($_POST);
	extract($_GET);

	if ($_POST["pay"]) {

		if (
				(($_POST["x_card_exp_month"]) && ($_POST["x_card_exp_year"]))
				&&
				(((int)$_POST["x_card_exp_month"] < (int)date("m")) && ((int)$_POST["x_card_exp_year"] <= (int)date("y")))
			) {

				$payment_message = "<p class=\"errorMessage\">\n";
				$payment_message .= system_showText(LANG_LABEL_TRANSACTION_STATUS).": ".string_strtoupper(system_showText(LANG_LABEL_ERROR))."<br />\n";
				$payment_message .= system_showText(LANG_MSG_CARD_EXPIRE_DATE_IN_FUTURE)."<br />\n";
				if ($process == "signup") $try_again_message = "<a href=\"".DEFAULT_URL."/members/".$process."/payment.php?payment_method=psigate\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
				elseif ($process == "claim") $try_again_message = "<a href=\"".DEFAULT_URL."/members/".$process."/payment.php?payment_method=psigate&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
				else $try_again_message = "<a href=\"".DEFAULT_URL."/members/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
				$payment_message .= $try_again_message."\n</p>";

		} else {

			$psi = new PsiGatePayment;

			$psi->setGatewayURL(PSIGATE_URL);
			$psi->setStoreID(PSIGATE_STOREID);
			$psi->setPassPhrase(PSIGATE_PASSPHRASE);
			$psi->setOrderID("");
			$psi->setPaymentType("CC");
			$psi->setCardAction("0");
			$psi->setTaxTotal1($_POST["x_taxtotal"]);
			$psi->setTaxTotal2("");
			$psi->setTaxTotal3("");
			$psi->setTaxTotal4("");
			$psi->setTaxTotal5("");
			$psi->setShiptotal("");
			$psi->setSubTotal($_POST["x_subtotal"]);
			$psi->setCardNumber($_POST["x_card_number"]);
			$psi->setCardExpMonth($_POST["x_card_exp_month"]);
			$psi->setCardExpYear($_POST["x_card_exp_year"]);
			$psi->setUserID($acctId);
			$psi->setBname($_POST["x_bname"]);
			$psi->setBcompany($_POST["x_bcompany"]);
			$psi->setBaddress1($_POST["x_baddress1"]);
			$psi->setBaddress2($_POST["x_baddress2"]);
			$psi->setBcity($_POST["x_bcity"]);
			$psi->setBprovince($_POST["x_bprovince"]);
			$psi->setBpostalCode($_POST["x_bpostalcode"]);
			$psi->setBcountry($_POST["x_bcountry"]);
			$psi->setSname($_POST["x_bname"]);
			$psi->setScompany($_POST["x_bcompany"]);
			$psi->setSaddress1($_POST["x_baddress1"]);
			$psi->setSaddress2($_POST["x_baddress2"]);
			$psi->setScity($_POST["x_bcity"]);
			$psi->setSprovince($_POST["x_bprovince"]);
			$psi->setSpostalCode($_POST["x_bpostalcode"]);
			$psi->setScountry($_POST["x_bcountry"]);
			$psi->setPhone($_POST["x_phone"]);
			$psi->setEmail($_POST["x_email"]);
			$psi->setComments(EDIRECTORY_TITLE." Order");
			$psi->setCustomerIP($_SERVER["REMOTE_ADDR"]);
			$psi->setCardIDCode("");
			$psi->setCardIDNumber($_POST["x_card_id_number"]);

			// TestResult may be set to simulate a response from the bank.
			// A simulated transaction result shall be returned once the transaction request passes the fulfillment and fraud rule checks.
			// A -> Simulates an approved response.
			// D -> Simulates a declined response.
			// R -> Randomly approves or declines orders.
			// F -> Simulates a fraud response.
			//$psi->setTestResult("A");

			$x_listing_ids           = $_POST["x_listing_ids"];
			$x_listing_amounts       = $_POST["x_listing_amounts"];
			$x_event_ids             = $_POST["x_event_ids"];
			$x_event_amounts         = $_POST["x_event_amounts"];
			$x_banner_ids            = $_POST["x_banner_ids"];
			$x_banner_amounts        = $_POST["x_banner_amounts"];
			$x_classified_ids        = $_POST["x_classified_ids"];
			$x_classified_amounts    = $_POST["x_classified_amounts"];
			$x_article_ids           = $_POST["x_article_ids"];
			$x_article_amounts       = $_POST["x_article_amounts"];
			$x_custominvoice_ids     = $_POST["x_custominvoice_ids"];
			$x_custominvoice_amounts = $_POST["x_custominvoice_amounts"];

			$package_id				 = $_POST["x_package_id"];

			$psi_xml_error = (!($psi->doPayment() == PSIGATE_TRANSACTION_OK));

			if ($psi_xml_error != PSIGATE_TRANSACTION_OK) {

				$transaction_psigate["ResultTrxnTransTime"]      = $psi->getTrxnTransTime();
				$transaction_psigate["ResultTrxnOrderID"]        = $psi->getTrxnOrderID();
				$transaction_psigate["ResultTrxnApproved"]       = $psi->getTrxnApproved();
				$transaction_psigate["ResultTrxnReturnCode"]     = $psi->getTrxnReturnCode();
				$transaction_psigate["ResultTrxnErrMsg"]         = $psi->getTrxnErrMsg();
				$transaction_psigate["ResultTrxnTaxTotal"]       = $psi->getTrxnTaxTotal();
				$transaction_psigate["ResultTrxnShipTotal"]      = $psi->getTrxnShipTotal();
				$transaction_psigate["ResultTrxnSubTotal"]       = $psi->getTrxnSubTotal();
				$transaction_psigate["ResultTrxnFullTotal"]      = $psi->getTrxnFullTotal();
				$transaction_psigate["ResultTrxnPaymentType"]    = $psi->getTrxnPaymentType();
				$transaction_psigate["ResultTrxnCardNumber"]     = $psi->getTrxnCardNumber();
				$transaction_psigate["ResultTrxnCardExpMonth"]   = $psi->getTrxnCardExpMonth();
				$transaction_psigate["ResultTrxnCardExpYear"]    = $psi->getTrxnCardExpYear();
				$transaction_psigate["ResultTrxnTransRefNumber"] = $psi->getTrxnTransRefNumber();
				$transaction_psigate["ResultTrxnCardIDResult"]   = $psi->getTrxnCardIDResult();
				$transaction_psigate["ResultTrxnAVSResult"]      = $psi->getTrxnAVSResult();
				$transaction_psigate["ResultTrxnCardAuthNumber"] = $psi->getTrxnCardAuthNumber();
				$transaction_psigate["ResultTrxnCardRefNumber"]  = $psi->getTrxnCardRefNumber();
				$transaction_psigate["ResultTrxnCardType"]       = $psi->getTrxnCardType();
				$transaction_psigate["ResultTrxnIPResult"]       = $psi->getTrxnIPResult();
				$transaction_psigate["ResultTrxnIPCountry"]      = $psi->getTrxnIPCountry();
				$transaction_psigate["ResultTrxnIPRegion"]       = $psi->getTrxnIPRegion();
				$transaction_psigate["ResultTrxnIPCity"]         = $psi->getTrxnIPCity();
				$transaction_psigate["Error"]                    = $psi->getError();
				$transaction_psigate["ErrorMessage"]             = $psi->getErrorMessage();

				$accountObj                          = new Account($acctId);
				$transaction["account_id"]           = $accountObj->getNumber("id");
				$transaction["username"]             = $accountObj->getString("username");
				$transaction["ip"]                   = $_SERVER["REMOTE_ADDR"];
				$transaction["transaction_id"]       = $transaction_psigate["ResultTrxnOrderID"];
				$transaction["transaction_status"]   = $transaction_psigate["ResultTrxnApproved"];
				$transaction["transaction_datetime"] = date("Y-m-d H:i:s");
				$transaction["transaction_subtotal"] = $_SESSION["psigate_subtotal"];
				$transaction["transaction_tax"]		 = $_SESSION["psigate_tax"];
				$transaction["transaction_amount"]   = $transaction_psigate["ResultTrxnFullTotal"];
				$transaction["transaction_currency"] = PSIGATE_CURRENCY;
				$transaction["system_type"]          = "psigate";
				$transaction["recurring"]            = "n";
				$transaction["notes"]                = "";

				if ($transaction["transaction_status"] != "APPROVED") {
				
					$payment_message = "<p class=\"errorMessage\">\n";

					$payment_message .= system_showText(LANG_LABEL_TRANSACTION_STATUS).": ".$transaction_psigate["Error"]."<br />\n";
					$payment_message .= $transaction_psigate["ErrorMessage"]."<br />\n";
					if ($process == "signup") $try_again_message = "<a href=\"".DEFAULT_URL."/members/".$process."/payment.php?payment_method=psigate\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
					elseif ($process == "claim") $try_again_message = "<a href=\"".DEFAULT_URL."/members/".$process."/payment.php?payment_method=psigate&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
					else $try_again_message = "<a href=\"".DEFAULT_URL."/members/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";

				} elseif ($transaction["transaction_status"] == "APPROVED") {

					$payment_success = "y";
					
					$payment_message = "<p class=\"successMessage\">\n";

					$payment_message .= system_showText(LANG_LABEL_TRANSACTION_STATUS).": ".$transaction["transaction_status"]."<br />\n";
					$payment_message .= system_showText(LANG_LABEL_TRANSACTION_ORDERID).": ".$transaction["transaction_id"]."<br />\n";
					if ($process == "claim") $payment_message .= system_showText(LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND)."<br />\n".system_showText(LANG_MSG_IN_YOUR_TRANSACTION_HISTORY)."\n";
					else $payment_message .= system_showText(LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND)."<br />\n".system_showText(LANG_MSG_IN_YOUR)." <a href=\"".DEFAULT_URL."/members/transactions/index.php\">".system_showText(LANG_LABEL_TRANSACTION_HISTORY)."</a>\n";

					$transaction["return_fields"] = system_array2nvp($transaction_psigate, " || ");
					$paymentLogObj = new PaymentLog($transaction);
					$paymentLogObj->Save();
					unset($_SESSION["psigate_subtotal"], $_SESSION["psigate_tax"]);

					$listing_ids = explode("::",$x_listing_ids);
					$listing_amounts = explode("::",$x_listing_amounts);
					$event_ids = explode("::",$x_event_ids);
					$event_amounts = explode("::",$x_event_amounts);
					$banner_ids = explode("::",$x_banner_ids);
					$banner_amounts = explode("::",$x_banner_amounts);
					$classified_ids = explode("::",$x_classified_ids);
					$classified_amounts = explode("::",$x_classified_amounts);
					$article_ids = explode("::",$x_article_ids);
					$article_amounts = explode("::",$x_article_amounts);
					$custominvoice_ids = explode("::",$x_custominvoice_ids);
					$custominvoice_amounts = explode("::",$x_custominvoice_amounts);

					if (!empty($listing_ids[0])) {

						$listingStatus = new ItemStatus();

						$amountAux = 0;
						$levelObj = new ListingLevel();
						foreach($listing_ids as $each_listing_id){

							$listingObj = new Listing($each_listing_id);
							$listingObj->setString("renewal_date", $listingObj->getNextRenewalDate());
							
							$dbObjCat = db_getDBObject();
							
							setting_get("listing_approve_paid", $listing_approve_paid);

							if ($listing_approve_paid){
								$listingObj->setString("status", $listingStatus->getDefaultStatus());
							}else{
								$listingObj->setString("status", "A");
							}
							
							$listingObj->Save();

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
							$transaction_listing_log["renewal_date"]   = $listingObj->getString("renewal_date");
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

							$paymentListingLogObj = new PaymentListingLog($transaction_listing_log);
							$paymentListingLogObj->Save();

						}

						unset($listingObj);

					}

					if (!empty($event_ids[0])) {

						$eventStatus = new ItemStatus();

						$amountAux = 0;
						foreach($event_ids as $each_event_id){

							$eventObj = new Event($each_event_id);
                            $levelObj = new EventLevel();
                            
							$eventObj->setString("renewal_date", $eventObj->getNextRenewalDate());
							
							setting_get("event_approve_paid", $event_approve_paid);
										
							if ($event_approve_paid){
								$eventObj->setString("status", $eventStatus->getDefaultStatus());
							}else{
								$eventObj->setString("status", "A");
							}
							
							$eventObj->Save();

							$transaction_event_log["payment_log_id"] = $paymentLogObj->getNumber("id");
							$transaction_event_log["event_id"]       = $each_event_id;
							$transaction_event_log["event_title"]    = $eventObj->getString("title",false);
                            $transaction_event_log["level"]          = $eventObj->getString("level");
							$transaction_event_log["level_label"]    = $levelObj->showLevel($eventObj->getString("level"));
							$transaction_event_log["renewal_date"]   = $eventObj->getString("renewal_date");
							$transaction_event_log["discount_id"]    = $eventObj->getString("discount_id");
							$transaction_event_log["amount"]         = str_replace(",","",$event_amounts[$amountAux]);
							$amountAux++;

							$paymentEventLogObj = new PaymentEventLog($transaction_event_log);
							$paymentEventLogObj->Save();

						}

						unset($eventObj);

					}

					if (!empty($banner_ids[0])) {

						$bannerStatus = new ItemStatus();

						$amountAux = 0;
						foreach($banner_ids as $each_banner_id){

							$bannerObj = new Banner($each_banner_id);
                            $levelObj = new BannerLevel();

							if($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_IMPRESSION){

								$dbObj = db_getDBObject();

								setting_get("banner_approve_paid", $banner_approve_paid);

								if ($banner_approve_paid){
									$sql = "UPDATE Banner set impressions = impressions + ".$bannerObj->getNumber("unpaid_impressions").", renewal_date = '0000-00-00', unpaid_impressions = 0 WHERE id = ".$bannerObj->getNumber("id");
								}else{
									$sql = "UPDATE Banner set impressions = impressions + ".$bannerObj->getNumber("unpaid_impressions").", renewal_date = '0000-00-00', unpaid_impressions = 0, status = 'A' WHERE id = ".$bannerObj->getNumber("id");
								}

								$result = $dbObj->query($sql);

								$id = $bannerObj->getNumber("id");
								$unpaid_impressions[$id] = $bannerObj->getNumber("unpaid_impressions");

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

							$transaction_banner_log["payment_log_id"] = $paymentLogObj->getNumber("id");
							$transaction_banner_log["banner_id"]      = $each_banner_id;
							$transaction_banner_log["banner_caption"] = $bannerObj->getString("caption",false);
                            $transaction_banner_log["level"]          = $bannerObj->getString("type");
							$transaction_banner_log["level_label"]    = $levelObj->showLevel($bannerObj->getString("type"));
							$transaction_banner_log["renewal_date"]   = $bannerObj->getString("renewal_date");
							$transaction_banner_log["discount_id"]    = $bannerObj->getString("discount_id");
							$transaction_banner_log["impressions"]    = ($unpaid_impressions[$each_banner_id]) ? $unpaid_impressions[$each_banner_id] : 0;
							$transaction_banner_log["amount"]         = str_replace(",","",$banner_amounts[$amountAux]);
							$amountAux++;

							$paymentBannerLogObj = new PaymentBannerLog($transaction_banner_log);
							$paymentBannerLogObj->Save();

						}

						unset($bannerObj);

					}

					if (!empty($classified_ids[0])) {

						$classifiedStatus = new ItemStatus();

						$amountAux = 0;
						foreach($classified_ids as $each_classified_id){

							$classifiedObj = new Classified($each_classified_id);
                            $levelObj = new ClassifiedLevel();
                            
							$classifiedObj->setString("renewal_date", $classifiedObj->getNextRenewalDate());
							
							setting_get("classified_approve_paid", $classified_approve_paid);
											
							if ($classified_approve_paid){
								$classifiedObj->setString("status", $classifiedStatus->getDefaultStatus());
							}else{
								$classifiedObj->setString("status", "A");
							}

							$classifiedObj->save();

							$transaction_classified_log["payment_log_id"]   = $paymentLogObj->getNumber("id");
							$transaction_classified_log["classified_id"]    = $each_classified_id;
							$transaction_classified_log["classified_title"] = $classifiedObj->getString("title",false);
                            $transaction_classified_log["level"]            = $classifiedObj->getString("level");
							$transaction_classified_log["level_label"]      = $levelObj->showLevel($classifiedObj->getString("level"));
							$transaction_classified_log["renewal_date"]     = $classifiedObj->getString("renewal_date");
							$transaction_classified_log["discount_id"]      = $classifiedObj->getString("discount_id");
							$transaction_classified_log["amount"]           = str_replace(",","",$classified_amounts[$amountAux]);
							$amountAux++;

							$paymentClassifiedLogObj = new PaymentClassifiedLog($transaction_classified_log);
							$paymentClassifiedLogObj->Save();

						}

						unset($classifiedObj);

					}

					if (!empty($article_ids[0])) {

						$articleStatus = new ItemStatus();

						$amountAux = 0;
						foreach($article_ids as $each_article_id){

							$articleObj = new Article($each_article_id);
                            $levelObj = new ArticleLevel();
                            
							$articleObj->setString("renewal_date", $articleObj->getNextRenewalDate());
							
							setting_get("article_approve_paid", $article_approve_paid);
											
							if ($article_approve_paid){
								$articleObj->setString("status", $articleStatus->getDefaultStatus());
							}else{
								$articleObj->setString("status", "A");
							}
							
							$articleObj->Save();

							$transaction_article_log["payment_log_id"] = $paymentLogObj->getNumber("id");
							$transaction_article_log["article_id"]     = $each_article_id;
							$transaction_article_log["article_title"]  = $articleObj->getString("title",false);
                            $transaction_article_log["level"]          = $articleObj->getString("level");
							$transaction_article_log["level_label"]    = $levelObj->showLevel($articleObj->getString("level"));
							$transaction_article_log["renewal_date"]   = $articleObj->getString("renewal_date");
							$transaction_article_log["discount_id"]    = $articleObj->getString("discount_id");
							$transaction_article_log["amount"]         = str_replace(",","",$article_amounts[$amountAux]);
							$amountAux++;

							$paymentArticleLogObj = new PaymentArticleLog($transaction_article_log);
							$paymentArticleLogObj->Save();

						}

						unset($articleObj);

					}

					if (!empty($custominvoice_ids[0])) {

						$amountAux = 0;
						foreach($custominvoice_ids as $each_custominvoice_id){

							$customInvoiceObj = new CustomInvoice($each_custominvoice_id);
							if ($paymentLogObj->getNumber("transaction_tax") > 0) {
								$cInvoiceAmount = payment_calculateTax($customInvoiceObj->getNumber("amount"), $paymentLogObj->getNumber("transaction_tax"));
							} else {
								$cInvoiceAmount = $customInvoiceObj->getNumber("amount");
							}
							$customInvoiceObj->setNumber("tax", $paymentLogObj->getNumber("transaction_tax"));
							$customInvoiceObj->setNumber("subtotal", $customInvoiceObj->getNumber("amount"));
							$customInvoiceObj->setNumber("amount", $cInvoiceAmount);
							$customInvoiceObj->setString("paid", "y");
							$customInvoiceObj->Save();

							$transaction_custominvoice_log["payment_log_id"]    = $paymentLogObj->getNumber("id");
							$transaction_custominvoice_log["custom_invoice_id"] = $each_custominvoice_id;
							$transaction_custominvoice_log["title"]             = $customInvoiceObj->getString("title");
							$transaction_custominvoice_log["date"]              = $customInvoiceObj->getString("date");
							$transaction_custominvoice_log["items"]             = $customInvoiceObj->getTextItems();
							$transaction_custominvoice_log["items_price"]       = $customInvoiceObj->getTextPrices();
							$transaction_custominvoice_log["amount"]            = $customInvoiceObj->getNumber("subtotal");
							$amountAux++;

							$paymentCustomInvoiceLogObj = new PaymentCustomInvoiceLog($transaction_custominvoice_log);
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
									$dbMain = db_getDBObject(DEFAULT_DB, true);
									$sql = "SELECT module_id, module, domain_id FROM PackageModules WHERE parent_domain_id = ".SELECTED_DOMAIN_ID." AND package_id = ".$package_id." AND account_id = ".$acctId;
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

						//////////////////////////////

						$amountAux = 0;

						$packageObj = new Package($package_id);

						$transaction_package_log["payment_log_id"]    = $paymentLogObj->getNumber("id");
						$transaction_package_log["package_id"]		  = $package_id;
						$transaction_package_log["package_title"]     = $packageObj->getString("title");
						$transaction_package_log["items"]             = $item_name." ".$item_levelName."\n".str_replace("-","",$auxdomains_names);
						$transaction_package_log["items_price"]       = str_replace(CURRENCY_SYMBOL." ", "",str_replace("<br />","\n",$aux_package_item_price));
						$transaction_package_log["amount"]            = payment_calculateTax(str_replace(",","",$aux_package_total), $payment_tax_value, false);
						$amountAux++;

						$paymentPacakgeObj = new PaymentPackageLog($transaction_package_log, $domain_id);
						$paymentPacakgeObj->Save();

						unset($packageObj);

					}

					$paymentLogObj->sendNotification(false, $package_id);

				}

			} else {
			
				$payment_message .= "<p class=\"errorMessage\">\n";

				$payment_message .= system_showText(LANG_LABEL_TRANSACTION_STATUS).": ".$psi->getError()."<br />\n";
				$payment_message .= $psi->getErrorMessage()."<br />\n";
				if ($process == "signup") $try_again_message = "<a href=\"".DEFAULT_URL."/members/".$process."/payment.php?payment_method=psigate\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
				elseif ($process == "claim") $try_again_message = "<a href=\"".DEFAULT_URL."/members/".$process."/payment.php?payment_method=psigate&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
				else $try_again_message = "\n<a href=\"".DEFAULT_URL."/members/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";

			}

			$payment_message .= $try_again_message."</p>";

		}

	} else {
		$payment_message .= "<p class=\"errorMessage\">".system_showText(LANG_LABEL_STATUS).": ".system_showText(LANG_LABEL_ERROR)."<br />\n";
		$payment_message .= system_showText(LANG_MSG_PAYMENT_INVALID_PARAMS)."<br />\n";
		$payment_message .= "<a href=\"".DEFAULT_URL."/members/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
	}

?>