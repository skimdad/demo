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
	# * FILE: /includes/code/billing_linkpoint.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_linkpoint.inc.php");

	extract($_POST);
	extract($_GET);

	if ($pay) {

		$validationok = "yes";

		if (!is_array($listing_id) && !is_array($event_id) && !is_array($banner_id) && !is_array($classified_id) && !is_array($article_id) && !is_array($custominvoice_id)) {
			$validationok = "no";
			if ($process == "signup") $payment_message = "<p class=\"errorMessage\">".system_showText(LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN)."<br />\n<a href=\"".DEFAULT_URL."/members/".$process."/payment.php?payment_method=linkpoint\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
			elseif ($process == "claim") $payment_message = "<p class=\"errorMessage\">".system_showText(LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN)."<br />\n<a href=\"".DEFAULT_URL."/members/".$process."/payment.php?payment_method=linkpoint&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
			else $payment_message = "<p class=\"errorMessage\">".system_showText(LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN)."<br />\n<a href=\"".DEFAULT_URL."/members/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
		}

		if (!$cardnumber || !$cardexpmonth || !$cardexpyear || !$name || !$country || (!$state && !$state2)  || !$city || !$address1 || !$zip || !$phone || !$email) {
			$validationok = "no";
			if ($process == "signup") $payment_message = "<p class=\"errorMessage\">".system_showText(LANG_MSG_FILL_ALL_REQUIRED_FIELDS)."<br />\n<a href=\"".DEFAULT_URL."/members/".$process."/payment.php?payment_method=linkpoint\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
			elseif ($process == "claim") $payment_message = "<p class=\"errorMessage\">".system_showText(LANG_MSG_FILL_ALL_REQUIRED_FIELDS)."<br /><a href=\"".DEFAULT_URL."/members/".$process."/payment.php?payment_method=linkpoint&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
			else $payment_message = "<p class=\"errorMessage\">".system_showText(LANG_MSG_FILL_ALL_REQUIRED_FIELDS)."<br />\n<a href=\"".DEFAULT_URL."/members/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
		}

		// installments calculation
		$installments = 0;
		if ($recurring_type == "m") {
			if ($cardexpyear == date("y")) {
				$installments = $cardexpmonth - date("m");
			} else {
				$installments = (12 - date("m")) + (($cardexpyear - date("y") - 1) * 12) + $cardexpmonth;
			}
		}
		if ($recurring_type == "y") {
			if ($cardexpmonth >= date("m")) $installments = ($cardexpyear-date("y"));
			else $installments = (($cardexpyear-date("y"))-1);
		}

		if ($installments < 0) {
			$validationok = "no";
			if ($process == "signup") $payment_message = "<p class=\"errorMessage\">".system_showText(LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN)."<br />\n<a href=\"".DEFAULT_URL."/members/".$process."/payment.php?payment_method=linkpoint\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
			elseif ($process == "claim") $payment_message = "<p class=\"errorMessage\">".system_showText(LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN)."<br />\n<a href=\"".DEFAULT_URL."/members/".$process."/payment.php?payment_method=linkpoint&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
			else $payment_message = "<p class=\"errorMessage\">".system_showText(LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN)."<br />\n<a href=\"".DEFAULT_URL."/members/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
		} else {
			$installments += 1; // increase one installment because the first is charged immediately.
			$renewal_increase = $installments;
		}

	}

	if ($pay && $validationok == "yes") {

		if ($item_price) {

			$cart_id = string_strtoupper(uniqid("")); // Unique cart identification, internal use.

			// Mercant info data fields
			$myorder["host"]       = LINKPOINT_HOST;
			$myorder["port"]       = LINKPOINT_PORT;
			$myorder["keyfile"]    = EDIRECTORY_ROOT."/members/billing/".LINKPOINT_KEYFILE;
			$myorder["configfile"] = LINKPOINT_CONFIGFILE;

			// Billing data fields
			$myorder["name"]     = $name;
			$myorder["country"]  = $country;
			$myorder["state"]    = ($state2) ? $state2 : $state;
			$myorder["city"]     = $city;
			$myorder["address1"] = $address1;
			$myorder["zip"]      = $zip;
			$myorder["phone"]    = $phone;
			$myorder["email"]    = $email;
			$myorder["zip"]      = $zip;

			// Transaction Details fields
			$myorder["ip"] = $_SERVER["REMOTE_ADDR"];

			// Order data fields
			$myorder["ordertype"] = "SALE";

			// Credit Card data fields
			$myorder["cardnumber"]   = $cardnumber;
			$myorder["cardexpmonth"] = $cardexpmonth;
			$myorder["cardexpyear"]  = $cardexpyear;

			// Payment data fields
			$charge_total = 0;
			for($itemCount=0 ; $itemCount < count($item_id); $itemCount++) {
				$charge_total = $charge_total + $item_price[$itemCount];
			}
			$charge_total = format_money($charge_total);
			$myorder["chargetotal"] = str_replace(",","",$charge_total);

			// Periodic params (recurring)
			if ($installments > 1) {
				$myorder["action"]       = "SUBMIT";
				$myorder["installments"] = $installments;
				$myorder["threshold"]    = "3";
				$myorder["startdate"]    = "immediate";
				$myorder["periodicity"]  = $recurring_type;
			}

			// Itens and options data fields (Just for not recurring billings)
			if ($installments == 1) {
				for($i=0 ; $i < count($item_id); $i++) {
					$myorder["items"][$i]["id"]          = $item_id[$i];
					$myorder["items"][$i]["description"] = $item_description[$i];
					$myorder["items"][$i]["quantity"]    = "1";
					$myorder["items"][$i]["price"]       = $item_price[$i];
				}
			}

			// Debuging on/off
			if ($debugging) $myorder["debugging"] = "off";

			// Send transaction
			include_once(EDIRECTORY_ROOT."/members/billing/lphp.php");
			$mylphp = new lphp;
			$order_result = $mylphp->curl_process($myorder);
			unset($mylphp);

			if (!is_array($order_result)) { // Transaction failure

				$order_result = array();
				$order_result["r_approved"] = (!$order_result["r_approved"]) ? string_strtoupper(system_showText(LANG_LABEL_FAILURE))  : $order_result["r_approved"];
				$order_result["r_error"]    = (!$order_result["r_error"])    ? system_showText(LANG_MSG_COULD_NOT_CONNECT)      : $order_result["r_error"];

				$payment_message .=  "<p class=\"errorMessage\">".system_showText(LANG_LABEL_TRANSACTION_STATUS).": ".string_strtoupper(system_showText(LANG_LABEL_FAILURE))." <br />\n";
				if ($process == "signup") $try_again_message .=  system_showText(LANG_LABEL_TRANSACTION_ERROR).":  ".system_showText(LANG_MSG_COULD_NOT_CONNECT)." <a href=\"".DEFAULT_URL."/members/".$process."/payment.php?payment_method=linkpoint\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
				elseif ($process == "claim") $try_again_message .=  system_showText(LANG_LABEL_TRANSACTION_ERROR).":  ".system_showText(LANG_MSG_COULD_NOT_CONNECT)." <a href=\"".DEFAULT_URL."/members/".$process."/payment.php?payment_method=linkpoint&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
				else $try_again_message .=  system_showText(LANG_LABEL_TRANSACTION_ERROR).":  ".system_showText(LANG_MSG_COULD_NOT_CONNECT)." <a href=\"".DEFAULT_URL."/members/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";

			} elseif ($order_result["r_approved"] != "APPROVED") {

				$order_result["r_approved"] = (!$order_result["r_approved"]) ? string_strtoupper(system_showText(LANG_LABEL_FAILURE)) : $order_result["r_approved"];

				if ($signup) {
					$payment_message .= "<p class=\"successMessage\">".system_showText(LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT)."<br />\n";
					$payment_message .= system_showText(LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS)."</p>\n";
				}

				$payment_message .=  "<p class=\"errorMessage\">".system_showText(LANG_LABEL_TRANSACTION_STATUS).": ".$order_result["r_approved"]." <br />\n";
				$payment_message .=  system_showText(LANG_LABEL_TRANSACTION_ERROR).": ".$order_result["r_error"]." <br />\n";

				if ($process == "signup") $try_again_message .=  "<a href=\"".DEFAULT_URL."/members/".$process."/payment.php?payment_method=linkpoint\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
				elseif ($process == "claim") $try_again_message .=  "<a href=\"".DEFAULT_URL."/members/".$process."/payment.php?payment_method=linkpoint&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
				else $try_again_message .=  "<a href=\"".DEFAULT_URL."/members/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";

			} else { // Transaction success

				$payment_success = "y";

				$payment_message .= "<p class=\"successMessage\">";

				if ($recurring_type == "m") {
					if ($signup) {
						$payment_message .= system_showText(LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT)."<br />\n";
						$payment_message .= system_showText(LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS)."<br />\n<br />\n";
					}
					$payment_message .= system_showText(LANG_LABEL_MONTHLY_BILL_AMOUNT).": ".CURRENCY_SYMBOL." {$charge_total}<br />\n";
					$payment_message .= system_showText(LANG_LABEL_TRANSACTION_STATUS).": $order_result[r_approved]<br />\n";
					$payment_message .= system_showText(LANG_LABEL_TRANSACTION_OID).": $order_result[r_ordernum]<br />\n";
					$payment_message .= system_showText(LANG_LABEL_TRANSACTION_CODE).": $order_result[r_code]<br />\n";
				} elseif ($recurring_type == "y") {
					if ($signup) {
						$payment_message .= system_showText(LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT)."<br />\n";
						$payment_message .= system_showText(LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS)."<br />\n<br />\n";
					}
					$payment_message .= system_showText(LANG_LABEL_YEARLY_BILL_AMOUNT).": ".CURRENCY_SYMBOL." {$charge_total}<br />\n";
					$payment_message .= system_showText(LANG_LABEL_TRANSACTION_STATUS).": $order_result[r_approved]<br />\n";
					$payment_message .= system_showText(LANG_LABEL_TRANSACTION_OID).": $order_result[r_ordernum]<br />\n";
					$payment_message .= system_showText(LANG_LABEL_TRANSACTION_CODE).": $order_result[r_code]<br />\n";
				} else {
					if ($signup) {
						$payment_message .= system_showText(LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT)."<br />\n";
						$payment_message .= system_showText(LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS)."<br />\n<br />\n";
					}
					$payment_message .= system_showText(LANG_LABEL_BILL_AMOUNT).": ".CURRENCY_SYMBOL." {$charge_total}<br />\n";
					$payment_message .= system_showText(LANG_LABEL_TRANSACTION_STATUS).": $order_result[r_approved]<br />\n";
					$payment_message .= system_showText(LANG_LABEL_TRANSACTION_OID).": $order_result[r_ordernum]<br />\n";
					$payment_message .= system_showText(LANG_LABEL_TRANSACTION_CODE).": $order_result[r_code]<br />\n";
				}
				if ($process == "claim") $payment_message .= system_showText(LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND)."<br />\n".system_showText(LANG_MSG_IN_YOUR_TRANSACTION_HISTORY)."<br />\n";
				else $payment_message .= system_showText(LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND)."<br />\n".system_showText(LANG_MSG_IN_YOUR)." <a href=\"".DEFAULT_URL."/members/transactions/index.php\">".system_showText(LANG_LABEL_TRANSACTION_HISTORY)."</a>\n";

				$payment_message .= "</p>";

				if (is_array($order_result)) {
					foreach($order_result as $key => $value){
						if($key == "r_time"){
							$value = strtotime($value);
							$value = date("Y-m-d H:i:s",$value);
						}
						$log_linkpoint["$key"] = $value;
					}
				}

				$log_linkpoint["cart_id"]                = $cart_id;
				$log_linkpoint["chargetotal"]            = $myorder["chargetotal"];
				$log_linkpoint["ordertype"]              = $myorder["ordertype"];
				$log_linkpoint["threshold"]              = $myorder["threshold"];
				$log_linkpoint["installments"]           = $myorder["installments"];
				$log_linkpoint["server_time"]            = date("Y-m-d H:i:s");
				$log_linkpoint["periodicity"]            = $myorder["periodicity"];
				$log_linkpoint["startdate"]              = $myorder["startdate"];
				$log_linkpoint["action"]                 = $myorder["action"];
				$log_linkpoint["last_cardnumber_digits"] = string_substr($myorder["cardnumber"], -4, string_strlen($myorder["cardnumber"]));
				$log_linkpoint["cardexpmonth"]           = $myorder["cardexpmonth"];
				$log_linkpoint["cardexpyear"]            = $myorder["cardexpyear"];
				$log_linkpoint["description"]            = ($recurring_type == "m") ? ("Monthly Recurring") : (($recurring_type == "y") ? ("Yearly Recurring") : ("Normal Payment"));

				$log["account_id"]           = $acctId;
				$accountObj                  = new Account($log["account_id"]);
				$log["username"]             = $accountObj->getString("username");
				$log["ip"]                   = $_SERVER["REMOTE_ADDR"];
				$log["transaction_id"]       = $log_linkpoint["cart_id"];
				$log["transaction_status"]   = $log_linkpoint["r_approved"];
				$log["transaction_datetime"] = $log_linkpoint["server_time"];
				$log["transaction_tax"]		 = $_SESSION["linkpoint_tax_value"];
				$log["transaction_subtotal"] = $_SESSION["linkpoint_subtotal"];
				$log["transaction_amount"]   = $log_linkpoint["chargetotal"];
				$log["transaction_currency"] = LINKPOINT_CURRENCY;
				$log["system_type"]          = "linkpoint";
				$log["recurring"]            = "n";
				$log["notes"]                = "";
				$package_id					 = $_SESSION["linkpoint_package_id"];
				if ($log_linkpoint["periodicity"]) $log["recurring"] = "y";

				$log["return_fields"] = system_array2nvp($log_linkpoint, " || ");
				$paymentLogObj = new PaymentLog($log);
				$paymentLogObj->Save();
				unset($_SESSION["linkpoint_tax_value"], $_SESSION["linkpoint_subtotal"]);
				if (!empty($listing_id[0])) {

					$listingStatus = new ItemStatus();

					$priceAux = 0;
					$levelObj = new ListingLevel();
					foreach($listing_id as $each_listing_id){

						$listingObj = new Listing($each_listing_id);
						$listingObj->setString("renewal_date", $listingObj->getNextRenewalDate($renewal_increase));

						$dbMain = db_getDBObject(DEFAULT_DB, true);
						$dbObjCat = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
						
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

						$log_listing["payment_log_id"] = $paymentLogObj->getNumber("id");
						$log_listing["listing_id"]     = $listingObj->getString("id");
						$log_listing["listing_title"]  = $listingObj->getString("title", false);
                        $log_listing["level"]          = $listingObj->getString("level");
						$log_listing["level_label"]    = $levelObj->showLevel($listingObj->getString("level"));
						$log_listing["renewal_date"]   = $listingObj->getString("renewal_date");
						$log_listing["discount_id"]    = $listingObj->getString("discount_id");
						$log_listing["categories"]     = ($category_amount) ? $category_amount : 0;
						$log_listing["amount"]         = str_replace(",","",$listing_price[$priceAux]);
						$priceAux++;

						$log_listing["extra_categories"] = 0;
						if (($category_amount > 0) && (($category_amount - $levelObj->getFreeCategory($listingObj->getString("level"))) > 0)) {
							$log_listing["extra_categories"] = $category_amount - $levelObj->getFreeCategory($listingObj->getString("level"));
						} else {
							$log_listing["extra_categories"] = 0;
						}

						$log_listing["listingtemplate_title"] = "";
						if (LISTINGTEMPLATE_FEATURE == "on") {
							if ($listingObj->getString("listingtemplate_id")) {
								$listingTemplateObj = new ListingTemplate($listingObj->getString("listingtemplate_id"));
								$log_listing["listingtemplate_title"] = $listingTemplateObj->getString("title", false);
							}
						}

						$paymentListingLogObj = new PaymentListingLog($log_listing);
						$paymentListingLogObj->Save();

					}

					unset($listingObj);

				}

				if (!empty($event_id[0])) {

					$eventStatus = new ItemStatus();

					$priceAux = 0;
					foreach($event_id as $each_event_id){

						$eventObj = new Event($each_event_id);
                        $levelObj = new EventLevel();

						$eventObj->setString("renewal_date", $eventObj->getNextRenewalDate($renewal_increase));

						setting_get("event_approve_paid", $event_approve_paid);

						if ($event_approve_paid){
							$eventObj->setString("status", $eventStatus->getDefaultStatus());
						}else{
							$eventObj->setString("status", "A");
						}

						$eventObj->Save();

						$log_event["payment_log_id"] = $paymentLogObj->getNumber("id");
						$log_event["event_id"]       = $eventObj->getString("id");
						$log_event["event_title"]    = $eventObj->getString("title",false);
                        $log_event["level"]          = $eventObj->getString("level");
						$log_event["level_label"]    = $levelObj->showLevel($eventObj->getString("level"));
						$log_event["renewal_date"]   = $eventObj->getString("renewal_date");
						$log_event["discount_id"]    = $eventObj->getString("discount_id");
						$log_event["amount"]         = str_replace(",","",$event_price[$priceAux]);
						$priceAux++;

						$paymentEventLogObj = new PaymentEventLog($log_event);
						$paymentEventLogObj->Save();
					}

					unset($eventObj);

				}

				if (!empty($banner_id[0])) {

					$bannerStatus = new ItemStatus();

					$priceAux = 0;
					foreach($banner_id as $each_banner_id){

						$bannerObj = new Banner($each_banner_id);
                        $levelObj = new BannerLevel();

						if($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_IMPRESSION){

							$dbMain = db_getDBObject(DEFAULT_DB, true);
							$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

							setting_get("banner_approve_paid", $banner_approve_paid);

							if ($banne_approve_paid){
								$sql = "UPDATE Banner set impressions = impressions + ".$bannerObj->getNumber("unpaid_impressions").", renewal_date = '0000-00-00', unpaid_impressions = 0 WHERE id = ".$bannerObj->getNumber("id");
							}else{
								$sql = "UPDATE Banner set impressions = impressions + ".$bannerObj->getNumber("unpaid_impressions").", renewal_date = '0000-00-00', unpaid_impressions = 0, status = 'A' WHERE id = ".$bannerObj->getNumber("id");
							}

							$result = $dbObj->query($sql);

							$id = $bannerObj->getNumber("id");
							$unpaid_impressions[$id] = $bannerObj->getNumber("unpaid_impressions");

						} elseif ($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE){

							$bannerObj->setString("renewal_date", $bannerObj->getNextRenewalDate($renewal_increase));

							setting_get("banner_approve_paid", $banner_approve_paid);

							if ($banner_approve_paid){
								$bannerObj->setString("status", $bannerStatus->getDefaultStatus());
							}else{
								$bannerObj->setString("status", "A");
							}

							$bannerObj->Save();

						}

						$log_banner["payment_log_id"] = $paymentLogObj->getNumber("id");
						$log_banner["banner_id"]      = $bannerObj->getString("id");
						$log_banner["banner_caption"] = $bannerObj->getString("caption",false);
                        $log_banner["level"]          = $bannerObj->getString("type");
						$log_banner["level_label"]    = $levelObj->showLevel($bannerObj->getString("type"));
						$log_banner["renewal_date"]   = $bannerObj->getString("renewal_date");
						$log_banner["discount_id"]    = $bannerObj->getString("discount_id");
						$log_banner["impressions"]    = ($unpaid_impressions[$each_banner_id]) ? $unpaid_impressions[$each_banner_id] : 0;
						$log_banner["amount"]         = str_replace(",","",$banner_price[$priceAux]);
						$priceAux++;

						$paymentBannerLogObj = new PaymentBannerLog($log_banner);
						$paymentBannerLogObj->Save();

					}

					unset($bannerObj);

				}

				if (!empty($classified_id[0])) {

					$classifiedStatus = new ItemStatus();

					$priceAux = 0;
					foreach($classified_id as $each_classified_id){

						$classifiedObj = new Classified($each_classified_id);
                        $levelObj = new ClassifiedLevel();

						$classifiedObj->setString("renewal_date", $classifiedObj->getNextRenewalDate($renewal_increase));

						setting_get("classified_approve_paid", $classified_approve_paid);

						if ($classified_approve_paid){
							$classifiedObj->setString("status", $classifiedStatus->getDefaultStatus());
						}else{
							$classifiedObj->setString("status", "A");
						}

						$classifiedObj->save();

						$log_classified["payment_log_id"]   = $paymentLogObj->getNumber("id");
						$log_classified["classified_id"]    = $classifiedObj->getString("id");
						$log_classified["classified_title"] = $classifiedObj->getString("title",false);
                        $log_classified["level"]            = $classifiedObj->getString("level");
						$log_classified["level_label"]      = $levelObj->showLevel($classifiedObj->getString("level"));
						$log_classified["renewal_date"]     = $classifiedObj->getString("renewal_date");
						$log_classified["discount_id"]      = $classifiedObj->getString("discount_id");
						$log_classified["amount"]           = str_replace(",","",$classified_price[$priceAux]);
						$priceAux++;

						$paymentClassifiedLogObj = new PaymentClassifiedLog($log_classified);
						$paymentClassifiedLogObj->Save();

					}

					unset($classifiedObj);

				}

				if (!empty($article_id[0])) {

					$articleStatus = new ItemStatus();

					$priceAux = 0;
					foreach($article_id as $each_article_id){

						$articleObj = new Article($each_article_id);
                        $levelObj = new ArticleLevel();

						$articleObj->setString("renewal_date", $articleObj->getNextRenewalDate($renewal_increase));

						setting_get("article_approve_paid", $article_approve_paid);

						if ($article_approve_paid){
							$articleObj->setString("status", $articleStatus->getDefaultStatus());
						}else{
							$articleObj->setString("status", "A");
						}

						$articleObj->Save();

						$log_article["payment_log_id"] = $paymentLogObj->getNumber("id");
						$log_article["article_id"]     = $articleObj->getString("id");
						$log_article["article_title"]  = $articleObj->getString("title",false);
                        $log_article["level"]          = $articleObj->getString("level");
						$log_article["level_label"]    = $levelObj->showLevel($articleObj->getString("level"));
						$log_article["renewal_date"]   = $articleObj->getString("renewal_date");
						$log_article["discount_id"]    = $articleObj->getString("discount_id");
						$log_article["amount"]         = str_replace(",","",$article_price[$priceAux]);
						$priceAux++;

						$paymentArticleLogObj = new PaymentArticleLog($log_article);
						$paymentArticleLogObj->Save();

					}

					unset($articleObj);

				}

				if (!empty($custominvoice_id[0])) {

					$priceAux = 0;
					foreach($custominvoice_id as $each_custominvoice_id){

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

						$log_custominvoice["payment_log_id"]    = $paymentLogObj->getNumber("id");
						$log_custominvoice["custom_invoice_id"] = $customInvoiceObj->getString("id");
						$log_custominvoice["title"]             = $customInvoiceObj->getString("title");
						$log_custominvoice["date"]              = $customInvoiceObj->getString("date");
						$log_custominvoice["items"]             = $customInvoiceObj->getTextItems();
						$log_custominvoice["items_price"]       = $customInvoiceObj->getTextPrices();
						$log_custominvoice["amount"]            = $customInvoiceObj->getNumber("subtotal");
						$priceAux++;

						$paymentCustomInvoiceLogObj = new PaymentCustomInvoiceLog($log_custominvoice);
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

						$paymentPacakgeObj = new PaymentPackageLog($transaction_package_log, SELECTED_DOMAIN_ID);
						$paymentPacakgeObj->Save();

						unset($packageObj);

					}

				$paymentLogObj->sendNotification(false, $package_id);

			}

			$payment_message .= $try_again_message."</p>";

		}

	}

?>