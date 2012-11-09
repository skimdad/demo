<?php

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
	# * FILE: /functions/package_funct.php
	# ----------------------------------------------------------------------------------------------------


	 function package_buying_package($aux_post, $getPackageID = false, $members = false){
		 /*
		 * Get items by package ID
		 */
		unset($packageItemObj);
		$packageItemObj = new PackageItems();

		$contactObj = new Contact($_SESSION["SESS_ACCOUNT_ID"]);
		$account = new Account($_SESSION["SESS_ACCOUNT_ID"]);

		for($i=0;$i<count($aux_post["package_id"]);$i++){
			unset($array_package_items);
			$array_package_items = $packageItemObj->getItemsByPackageId($aux_post["package_id"][$i]);

			$packageObj = new Package($aux_post["package_id"][$i]);
			$packageName = $packageObj->getString("title");
			$itemMailLink = "";

			if($array_package_items){

				for($j=0;$j<count($array_package_items);$j++){

					unset($aux_item_object);

					/*
					 * Check if domain is active
					 */
					unset($aux_domainObj);
					$aux_domainObj = new Domain($array_package_items[$j]["domain_id"]);
                    
                    $aux_domain_id = $array_package_items[$j]["domain_id"];
                    
					if($aux_domainObj->getString("status") == "A" || $aux_domainObj->getString("status") == "P"){

						if ($array_package_items[$j]["module"] != "custom_package"){

							$dbObj_main = db_getDBObject(DEFAULT_DB, true);
							$dbObj = db_getDBObjectByDomainID($array_package_items[$j]["domain_id"], $dbObj_main);
							$sqlFriendlyURL = "";
							$sqlFriendlyURL .= " SELECT friendly_url FROM ".ucfirst($aux_post["item_type"])." WHERE friendly_url = ".db_formatString($aux_post["item_friendlyurl"])." ";
							$sameTable = false;

							if ($aux_post["item_type"] == $array_package_items[$j]["module"] && $array_package_items[$j]["domain_id"] == SELECTED_DOMAIN_ID){ //check if the new item is the same of the ordered item in the same domain
								$sameTable = true;
								$sqlFriendlyURL .= " AND id != ".$aux_post["item_id"];
							}

							$sqlFriendlyURL .= " LIMIT 1 ";
							$resultFriendlyURL = $dbObj->query($sqlFriendlyURL);
							if (mysql_num_rows($resultFriendlyURL) > 0) {
								if ($sameTable) $aux_post["item_friendlyurl"] = $aux_post["item_friendlyurl"].FRIENDLYURL_SEPARATOR.$aux_post["item_id"];
								else $aux_post["item_friendlyurl"] = $aux_post["item_friendlyurl"].FRIENDLYURL_SEPARATOR.uniqid();
							}
						}

						if($array_package_items[$j]["module"] == "listing"){
							$aux_item_object = new Listing();
							$aux_item_object->setNumber("domain_id", $aux_domain_id);
							$aux_item_object->setNumber("account_id", $_SESSION["SESS_ACCOUNT_ID"]);
							
							setting_get("listing_approve_free", $listing_approve_free);
							
							if (!$listing_approve_free && $array_package_items[$j]["price"] <=0){
								$aux_item_object->setString("status","A");
							} else {
								$aux_item_object->setString("status","P");
							}
							
							$aux_item_object->setString("title",$aux_post["item_name"]);
							$aux_item_object->setString("friendly_url",$aux_post["item_friendlyurl"]);
							$aux_item_object->setNumber("level",$array_package_items[$j]["level"]);
							$aux_item_object->setNumber("package_id",$array_package_items[$j]["package_id"]);
							$aux_item_object->setNumber("package_price",$array_package_items[$j]["price"]);
							$aux_item_object->Save();

							$domain_url = DEFAULT_URL;
							$domain_url = str_replace($_SERVER["HTTP_HOST"], $aux_domainObj->getstring("url"), $domain_url);
							$itemMailLink .= ucfirst(LISTING_FEATURE_NAME)." \"".$aux_post["item_name"]."\"<br />";
							$itemMailLink .= "<a href=\"".$domain_url."/sitemgr/".LISTING_FEATURE_FOLDER."/view.php?id=".$aux_item_object->getNumber("id")."\" target=\"_blank\">".$domain_url."/sitemgr/".LISTING_FEATURE_FOLDER."/view.php?id=".$aux_item_object->getNumber("id")."</a><br /><br />";
						}

						if($array_package_items[$j]["module"] == "event"){
							$aux_item_object = new Event();
                            $aux_item_object->setNumber("domain_id", $aux_domain_id);
							$aux_item_object->setNumber("account_id",$_SESSION["SESS_ACCOUNT_ID"]);
							$aux_item_object->setNumber("domain_id",$array_package_items[$j]["domain_id"]);
							
							setting_get("event_approve_free", $event_approve_free);
							
							if (!$event_approve_free && $array_package_items[$j]["price"] <=0){
								$aux_item_object->setString("status","A");
							} else {
								$aux_item_object->setString("status","P");
							}
							
							$aux_item_object->setString("title",$aux_post["item_name"]);
							$aux_item_object->setString("friendly_url",$aux_post["item_friendlyurl"]);
							$aux_item_object->setNumber("level",$array_package_items[$j]["level"]);
							$aux_item_object->setNumber("package_id",$array_package_items[$j]["package_id"]);
							$aux_item_object->setNumber("package_price",$array_package_items[$j]["price"]);
							$aux_item_object->Save();

							$domain_url = DEFAULT_URL;
							$domain_url = str_replace($_SERVER["HTTP_HOST"], $aux_domainObj->getstring("url"),$domain_url);
							$itemMailLink .= ucfirst(EVENT_FEATURE_NAME)." \"".$aux_post["item_name"]."\"<br />";
							$itemMailLink .= "<a href=\"".$domain_url."/sitemgr/".EVENT_FEATURE_FOLDER."/view.php?id=".$aux_item_object->getNumber("id")."\" target=\"_blank\">".$domain_url."/sitemgr/".EVENT_FEATURE_FOLDER."/view.php?id=".$aux_item_object->getNumber("id")."</a><br /><br />";
						}

						if($array_package_items[$j]["module"] == "article"){
							$aux_item_object = new Article();
                            $aux_item_object->setNumber("domain_id", $aux_domain_id);
							$aux_item_object->setNumber("account_id",$_SESSION["SESS_ACCOUNT_ID"]);
							$aux_item_object->setNumber("domain_id",$array_package_items[$j]["domain_id"]);
							
							setting_get("article_approve_free", $article_approve_free);
							
							if (!$article_approve_free && $array_package_items[$j]["price"] <=0){
								$aux_item_object->setString("status","A");
							} else {
								$aux_item_object->setString("status","P");
							}
							
							$aux_item_object->setString("title",$aux_post["item_name"]);
							$aux_item_object->setString("friendly_url",$aux_post["item_friendlyurl"]);
							$aux_item_object->setNumber("level",$array_package_items[$j]["level"]);
							$aux_item_object->setNumber("package_id",$array_package_items[$j]["package_id"]);
							$aux_item_object->setNumber("package_price",$array_package_items[$j]["price"]);
							$aux_item_object->Save();

							$domain_url = DEFAULT_URL;
							$domain_url = str_replace($_SERVER["HTTP_HOST"], $aux_domainObj->getstring("url"),$domain_url);
							$itemMailLink .= ucfirst(ARTICLE_FEATURE_NAME)." \"".$aux_post["item_name"]."\"<br />";
							$itemMailLink .= "<a href=\"".$domain_url."/sitemgr/".ARTICLE_FEATURE_FOLDER."/view.php?id=".$aux_item_object->getNumber("id")."\" target=\"_blank\">".$domain_url."/sitemgr/".ARTICLE_FEATURE_FOLDER."/view.php?id=".$aux_item_object->getNumber("id")."</a><br /><br />";
						}

						if($array_package_items[$j]["module"] == "classified"){
							$aux_item_object = new Classified();
                            $aux_item_object->setNumber("domain_id", $aux_domain_id);
							$aux_item_object->setNumber("account_id",$_SESSION["SESS_ACCOUNT_ID"]);
							$aux_item_object->setNumber("domain_id",$array_package_items[$j]["domain_id"]);
							
							setting_get("classified_approve_free", $classified_approve_free);
							
							if (!$classified_approve_free && $array_package_items[$j]["price"] <=0){
								$aux_item_object->setString("status","A");
							} else {
								$aux_item_object->setString("status","P");
							}
							
							$aux_item_object->setString("title",$aux_post["item_name"]);
							$aux_item_object->setString("friendly_url",$aux_post["item_friendlyurl"]);
							$aux_item_object->setNumber("level",$array_package_items[$j]["level"]);
							$aux_item_object->setNumber("package_id",$array_package_items[$j]["package_id"]);
							$aux_item_object->setNumber("package_price",$array_package_items[$j]["price"]);
							$aux_item_object->Save();

							$domain_url = DEFAULT_URL;
							$domain_url = str_replace($_SERVER["HTTP_HOST"], $aux_domainObj->getstring("url"),$domain_url);
							$itemMailLink .= ucfirst(CLASSIFIED_FEATURE_NAME)." \"".$aux_post["item_name"]."\"<br />";
							$itemMailLink .= "<a href=\"".$domain_url."/sitemgr/".CLASSIFIED_FEATURE_FOLDER."/view.php?id=".$aux_item_object->getNumber("id")."\" target=\"_blank\">".$domain_url."/sitemgr/".CLASSIFIED_FEATURE_FOLDER."/view.php?id=".$aux_item_object->getNumber("id")."</a><br /><br />";
						}

						if($array_package_items[$j]["module"] == "banner"){
							
							$langIndex = language_getIndex(EDIR_LANGUAGE);
							
							$aux_item_object = new Banner();
                            $aux_item_object->setNumber("domain_id", $aux_domain_id);
							$aux_item_object->setNumber("account_id",$_SESSION["SESS_ACCOUNT_ID"]);
							$aux_item_object->setNumber("domain_id",$array_package_items[$j]["domain_id"]);
							
							setting_get("banner_approve_free", $banner_approve_free);
							
							if (!$banner_approve_free && $array_package_items[$j]["price"] <=0){
								$aux_item_object->setString("status","A");
							} else {
								$aux_item_object->setString("status","P");
							}					
							
							$aux_item_object->setString("caption".$langIndex,$aux_post["item_name"]);
							$aux_item_object->setString("friendly_url",$aux_post["item_friendlyurl"]);
							$aux_item_object->setNumber("type",$array_package_items[$j]["level"]);
							$aux_item_object->setNumber("package_id",$array_package_items[$j]["package_id"]);
							$aux_item_object->setNumber("package_price",$array_package_items[$j]["price"]);
							$aux_item_object->setNumber("expiration_setting",BANNER_EXPIRATION_RENEWAL_DATE);
							$aux_item_object->setString("unlimited_impressions","y");
							$aux_item_object->Save();

							$domain_url = DEFAULT_URL;
							$domain_url = str_replace($_SERVER["HTTP_HOST"], $aux_domainObj->getstring("url"),$domain_url);
							$itemMailLink .= ucfirst(BANNER_FEATURE_NAME)." \"".$aux_post["item_name"]."\"<br />";
							$itemMailLink .= "<a href=\"".$domain_url."/sitemgr/".BANNER_FEATURE_FOLDER."/view.php?id=".$aux_item_object->getNumber("id")."\" target=\"_blank\">".$domain_url."/sitemgr/".BANNER_FEATURE_FOLDER."/view.php?id=".$aux_item_object->getNumber("id")."</a><br /><br />";
						}

						if($array_package_items[$j]["module"] == "custom_package"){

							if ($members){ 

								if ($array_package_items[$j]["price"]>0){

									$itemMailLink .= "Custom Option<br />";

									$customInvoiceObj = new CustomInvoice();

									$item_prices[] = $array_package_items[$j]["price"];
									$item_desc[] = $packageName;
									$subtotal = 0;
									$subtotal += $array_package_items[$j]["price"];
									$array_custominvoice["account_id"] = $_SESSION["SESS_ACCOUNT_ID"];
									$array_custominvoice["title"] = system_showText(LANG_CHARGING_PACKAGE)."\"".$packageName."\"";
									$array_custominvoice["subtotal"] = $subtotal;
									$array_custominvoice["tax"] = 0;
									$array_custominvoice["amount"] = $subtotal;
									$array_custominvoice["completed"] = "y";
									$array_custominvoice["sent"] = "y";
									$array_custominvoice["sent_date"] = date("Y-m-d");
									$array_custominvoice["domain_id"] = $aux_domain_id;
									$customInvoiceObj->makeFromRow($array_custominvoice);

									$customInvoiceObj->Save();

									$customInvoiceObj->setItems($item_desc, $item_prices);
									$domain = new Domain(SELECTED_DOMAIN_ID);
									$itemMailLink .= "A custom invoice was sent to the user. You can see it in <br />";
									$itemMailLink .= (HTTPS_MODE == "on" ? "https://".$domain->getstring("url") : "http://".$domain->getstring("url"));
									$itemMailLink .= "/sitemgr/custominvoices/view.php?id=".$customInvoiceObj->getNumber("id");
									$itemMailLink .= "<br />";

									///////////////////Email Notif to Member////////////////////////

									$emailNotification = new EmailNotification(SYSTEM_NEW_CUSTOMINVOICE);

									setting_get("sitemgr_email", $sitemgr_email);
									$sitemgr_emails = explode(",", $sitemgr_email);
									if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];

									$body = stripslashes($emailNotification->getString("body"));
									$subject = stripslashes($emailNotification->getString("subject"));
									$subject = str_replace("EDIRECTORY_TITLE", EDIRECTORY_TITLE, $subject);
									$body = str_replace(ACCOUNT_NAME, $contactObj->getString("first_name")." ".$contactObj->getString("last_name"), $body);


									$body = str_replace("DEFAULT_URL", HTTPS_MODE == "on" ? "https://".$domain->getstring("url") : "http://".$domain->getstring("url"), $body);
									$body = str_replace("CUSTOM_INVOICE_AMOUNT", CURRENCY_SYMBOL.format_money($subtotal), $body);

									customtext_get("payment_tax_label", $payment_tax_label, EDIR_LANGUAGE);

									$body = str_replace("CUSTOM_INVOICE_TAX", "+ ".$payment_tax_label, $body);
									$body = str_replace("EDIRECTORY_TITLE", EDIRECTORY_TITLE, $body);
									$error = false;
									$return = system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotification->getString("content_type"), "", $emailNotification->getString("bcc"), $error);

									////////////////////////////////////////////////////////

								}
							}
						}
						$arrayPackModule["account_id"] = sess_getAccountIdFromSession();
						$arrayPackModule["package_id"] = $array_package_items[$j]["package_id"];
						$arrayPackModule["domain_id"] = $array_package_items[$j]["domain_id"];
						$arrayPackModule["parent_domain_id"] = SELECTED_DOMAIN_ID;
						$arrayPackModule["module"] = $array_package_items[$j]["module"];
						$package_id = $arrayPackModule["package_id"];

						if ($array_package_items[$j]["module"] != "custom_package"){
							$arrayPackModule["module_id"] = $aux_item_object->getNumber("id");
							if ($array_package_items[$j]["module"] != "banner"){
								$arrayPackModule["module_name"] = $aux_item_object->getString("title");
							} else {
								$arrayPackModule["module_name"] = $aux_item_object->getString("caption".$langIndex);
							}
						} else {
							$arrayPackModule["module_id"] = 0;
						}

						$packageModule = new PackageModules($arrayPackModule);
						$packageModule->makeFromRow();
						$packageModule->Save();

					}
				}

				///////////////////Email Notif to Sitemgr////////////////////////

					setting_get("sitemgr_send_email",$sitemgr_send_email);
					setting_get("sitemgr_email",$sitemgr_email);
					$sitemgr_emails = explode(",",$sitemgr_email);

					$sitemgr_msg = "
						<html>
							<head>
								<style>
									.email_style_settings{
										font-size:12px;
										font-family:Verdana, Arial, Sans-Serif;
										color:#000;
									}
								</style>
							</head>
							<body>
								<div class=\"email_style_settings\">
									Site Manager,<br /><br />
									The package \"".$packageName."\" was bought by the administrator \"".system_showAccountUserName($account->getString("username"))."\" and needs to be revised by you.<br /><br />
									Purchased items:<br /><br />
									".$itemMailLink."
								</div>
							</body>
						</html>";


					// sending e-mail to site manager
					$error = false;

					if ($sitemgr_send_email == "on") {
						if ($sitemgr_emails[0]) {
							foreach ($sitemgr_emails as $sitemgr_email) {
								system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] Package Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
							}
						}
					}

				//////////////////////////////////

			}

		}

		if($getPackageID){
			return $package_id;
		}		
	 }
?>