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
	# * FILE: /order_listing.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSessionFront();

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	$listLevelObj = new ListingLevel();
	$listLevelValue = $listLevelObj->getValues();
	if (!in_array($level, $listLevelValue)) {
		header("Location: ".DEFAULT_URL."/advertise.php?listing");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if (($_SERVER['REQUEST_METHOD'] == "POST") && !$_POST["account_sugar_id"]) {

		$_POST["friendly_url"] = str_replace(".htm", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = str_replace(".html", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = trim($_POST["friendly_url"]);
		$_POST["friendly_url"] = system_denyInjections($_POST["friendly_url"]);
		$_POST["friendly_url"] = $_POST["friendly_url"].FRIENDLYURL_SEPARATOR.uniqid();
		$friendly_url = $_POST["friendly_url"];

		$request_method_seckey = "post";
		include(EDIRECTORY_ROOT."/includes/code/seckey.php");

		$validate_account = validate_addAccount($_POST, $message_account);
		$validate_contact = validate_form("contact", $_POST, $message_contact);
		$tmpEMAIL = $_POST["email"];
		unset($_POST["email"]);

		/*
		 * Integration with suggarCRM
		 */
		if($_POST["account_suggar_id"]){
			$boolean_seckey = true;
			$validate_listing = validate_form("listing", $_POST, $message_listing,"signup");
		}else{
			$validate_listing = validate_form("listing", $_POST, $message_listing,$_POST["categories"]);
		}
		$_POST["email"] = $tmpEMAIL;
		$validate_discount = is_valid_discount_code($_POST["discount_id"], "listing", $_POST["id"], $message_discount, $discount_error_num);

		if ($boolean_seckey && $validate_account && $validate_contact && $validate_listing && $validate_discount) {

			$_POST['notify_traffic_listing'] = ($_POST['notify_traffic_listing'] ? 'y' : 'n');
			
			$account = new Account($_POST);
			$account->save();

			$account->changeMemberStatus(true);

			$contact = new Contact($_POST);
			$contact->setNumber("account_id", $account->getNumber("id"));
			$contact->save();

			$profileObj = new Profile($account->getNumber("id"));
			$profileObj->setNumber("account_id", $account->getNumber("id"));
			if (!$profileObj->getString("nickname")) {
				$profileObj->setString("nickname", $_POST["first_name"]." ".$_POST["last_name"]);
			}
			$profileObj->Save();

			$accDomain = new Account_Domain($account->getNumber("id"), SELECTED_DOMAIN_ID);
			$accDomain->Save();
			$accDomain->saveOnDomain($account->getNumber("id"), $account, $contact, $profileObj);

			unset($_POST["email"]);
			unset($_POST["phone"]);
			unset($_POST["address"]);
			unset($_POST["address2"]);
			$listing = new Listing($_POST);
			$listing->setNumber("account_id", $account->getNumber("id"));
			$status = new ItemStatus();
			$listing->setDate("renewal_date", "00/00/0000");

			/*
			 * Used for package
			 */
			if($listing->getNumber("domain_id") == 0){
				$listing->setNumber("domain_id",SELECTED_DOMAIN_ID);
			}
			
			// the following code is added by Debiprasad Sahoo (Indibits) on 18th Aug., 2012
			for ($promo = 2; $promo <= 5; $promo++) {
				if ($_POST['extra_promotion'][$promo] != '1')
					break;
			}
			
			if ($promo > 2)
				$listing->setNumber("extra_promotion", $promo - 1);

			$listing->Save();
			$return_categories_array = explode(",", $return_categories);
			$listing->setCategories($return_categories_array);

			$gallery = new Gallery($id);

			$aux = array("account_id"=>0,"title"=>$_POST["title"],"entered"=>"NOW()","updated"=>"now()");
			$gallery->makeFromRow($aux);
			$gallery->save();
			$listing->setGalleries($gallery->getNumber("id"));

			/**************************************************************************************************/
			/*                                                                                                */
			/* E-mail notify																				  */
			/*                                                                                                */
			/**************************************************************************************************/
			setting_get("sitemgr_send_email",$sitemgr_send_email);
			setting_get("sitemgr_email",$sitemgr_email);
			$sitemgr_emails = explode(",",$sitemgr_email);
			if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
			setting_get("sitemgr_account_email",$sitemgr_account_email);
			$sitemgr_account_emails = explode(",",$sitemgr_account_email);
			setting_get("sitemgr_listing_email",$sitemgr_listing_email);
			$sitemgr_listing_emails = explode(",",$sitemgr_listing_email);

			// sending e-mail to user //////////////////////////////////////////////////////////////////////////
			if ($emailNotificationObj = system_checkEmail(SYSTEM_LISTING_SIGNUP, $contact->getString("lang"))) {
				$subject = $emailNotificationObj->getString("subject");
				$body = $emailNotificationObj->getString("body");
				$login_info = trim(system_findTranslationFor("LANG_LABEL_USERNAME", $emailNotificationObj->getString("lang"))).": ".$_POST["username"];
				$login_info .= ($emailNotificationObj->getString("content_type") == "text/html"? "<br />": "\n");
				$login_info .= trim(system_findTranslationFor("LANG_LABEL_PASSWORD", $emailNotificationObj->getString("lang"))).": ".$_POST["password"];
				$body = str_replace("ACCOUNT_LOGIN_INFORMATION",$login_info,$body);
				$body = system_replaceEmailVariables($body, $listing->getNumber('id'), 'listing');
				$subject = system_replaceEmailVariables($subject, $listing->getNumber('id'), 'listing');
				$body = html_entity_decode($body);
				$subject = html_entity_decode($subject);
				system_mail($contact->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
			}
			////////////////////////////////////////////////////////////////////////////////////////////////////

			// site manager warning message ////////////////////////////////////////////////////////////////////
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
							New signup in ".EDIRECTORY_TITLE.".<br /><br />
							Account:<br /><br />";
							$sitemgr_msg .= "<b>Username: </b>".$account->getString("username")."<br />";
							$sitemgr_msg .= "<b>First name: </b>".$contact->getString("first_name")."<br />";
							$sitemgr_msg .= "<b>Last name: </b>".$contact->getString("last_name")."<br />";
							$sitemgr_msg .= "<b>Company: </b>".$contact->getString("company")."<br />";
							$sitemgr_msg .= "<b>Address: </b>".$contact->getString("address")." ".$contact->getString("address2")."<br />";
							$sitemgr_msg .= "<b>City: </b>".$contact->getString("city")."<br />";
							$sitemgr_msg .= "<b>State: </b>".$contact->getString("state")."<br />";
							$sitemgr_msg .= "<b>Zipcode: </b>".$contact->getString("zip")."<br />";
							$sitemgr_msg .= "<b>Country: </b>".$contact->getString("country")."<br />";
							$sitemgr_msg .= "<b>Phone: </b>".$contact->getString("phone")."<br />";
							$sitemgr_msg .= "<b>E-mail: </b>".$contact->getString("email")."<br />";
							$sitemgr_msg .= "<br /><a href=\"".DEFAULT_URL."/sitemgr/account/view.php?id=".$account->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/sitemgr/account/view.php?id=".$account->getNumber("id")."</a><br /><br />";
							$sitemgr_msg .= "Listing:<br /><br />";
							$sitemgr_msg .= "<b>Title: </b>".$listing->getString("title")."<br />";
							$sitemgr_msg .= "<br /><a href=\"".DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER."/view.php?id=".$listing->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER."/view.php?id=".$listing->getNumber("id")."</a><br /><br />
						</div>
					</body>
				</html>";

			setting_get("new_listing_email",$new_listing_email);

			if ($new_listing_email){

				if ($sitemgr_send_email == "on") {
					if ($sitemgr_emails[0]) {
						foreach ($sitemgr_emails as $sitemgr_email) {
							system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] Signup Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
						}
					}
				}
				if ($sitemgr_account_emails[0]) {
					foreach ($sitemgr_account_emails as $sitemgr_account_email) {
						system_mail($sitemgr_account_email, "[".EDIRECTORY_TITLE."] Signup Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_account_email>", "text/html", '', '', $error);
					}
				}
				if ($sitemgr_listing_emails[0]) {
					foreach ($sitemgr_listing_emails as $sitemgr_listing_email) {
						system_mail($sitemgr_listing_email, "[".EDIRECTORY_TITLE."] Signup Notification", $sitemgr_msg, EDIRECTORY_TITLE." <".$sitemgr_listing_email.">", "text/html", '', '', $error);
					}
				}

			}
			////////////////////////////////////////////////////////////////////////////////////////////////////


			if ($checkout && !$payment_method) $payment_method = "checkout";

			sess_registerAccountInSession($account->getString("username"));
			setcookie("username_members", $account->getString("username"), time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
			setcookie("automatic_login_members", "false", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

			$host = string_strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));

			setcookie($host."_DOMAIN_ID_MEMBERS", SELECTED_DOMAIN_ID, time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

			/*
			 * Check if exists package
			 */
			$packageObj = new Package();
			$array_package_offers = $packageObj->getPackagesByDomainID(SELECTED_DOMAIN_ID, "listing", $listing->level);
			$hasPackage = false;
			if ((is_array($array_package_offers)) and (count($array_package_offers)>0) and $array_package_offers[0]) {
				$hasPackage = true;
			}
			
			setting_get("listing_approve_free", $listing_approve_free);
			
			if ($payment_method == "checkout" && !$listing_approve_free){
				$listing->setString("status", "A");
				$listing->save();
			}

			if ($payment_method == "checkout") {
				if ($hasPackage){
					header("Location: ".DEFAULT_URL."/members/signup/packages.php?item_type=listing&item_level=".$level."&checkout=true&payment_method=checkout&item_id=".$listing->getNumber("id"));
				} else {
					header("Location: ".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER."/listing.php?id=".$listing->getNumber("id")."&process=signup");
				}
			} elseif ($payment_method == "invoice") {
				if ($hasPackage){
					header("Location: ".DEFAULT_URL."/members/signup/packages.php?item_type=listing&item_level=".$level."&checkout=false&payment_method=invoice&item_id=".$listing->getNumber("id"));
				} else {
					header("Location: ".DEFAULT_URL."/members/signup/invoice.php");
				}
			} else {
				if ($hasPackage){
					header("Location: ".DEFAULT_URL."/members/signup/packages.php?item_type=listing&item_level=".$level."&checkout=false&payment_method=".$payment_method."&item_id=".$listing->getNumber("id"));
				} else {
					header("Location: ".DEFAULT_URL."/members/signup/payment.php?payment_method=".$payment_method);
				}
			}
			exit;

		} else {

			if (($pos = string_strrpos($_POST["friendly_url"], FRIENDLYURL_SEPARATOR)) !== false) {
				$_POST["friendly_url"] = string_substr($_POST["friendly_url"], 0, $pos);
			}

			// removing slashes added if required
			$_POST = format_magicQuotes($_POST);
			$_GET  = format_magicQuotes($_GET);
			extract($_POST);
			extract($_GET);

		}

	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$lang_order = language_getIndex(EDIR_LANGUAGE);
	
	if ($return_categories){
		$return_categories_array = explode(",", $return_categories);
		if ($return_categories_array){
			foreach ($return_categories_array as $each_category){
				$categories[] = new ListingCategory($each_category);
			}
		}
	}

	$feedDropDown = "<select name=\"feed\" id=\"feed\" multiple=\"multiple\" size=\"5\">";
	$catSelected = 0;
	if ($categories) {

		$auxListing = new ListingCategory();

		foreach ($categories as $category) {

			if ($category instanceof $auxListing){
				$name = $category->getString("title".$lang_order);
				$feedDropDown .= "<option value='".$category->getNumber("id")."'>$name</option>";
				$feedAjaxCategory[] = $category->getNumber("id");
				$catSelected++;
			}
		}
	} else {
		$feedDropDown .= "<option></option>";
	}

	$feedDropDown .= "</select>";

	$listingLevelObj = new ListingLevel();
	$levelValue = $listingLevelObj->getValues();

	$formloginaction = ((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)."/members/login.php?destiny=".EDIRECTORY_FOLDER.(EDIR_LANG_URL ? "/".EDIR_LANGUAGEABBREVIATION : "")."/members/".LISTING_FEATURE_FOLDER."/listinglevel.php";

	/*
	 * TAX SECTION
	 */
	setting_get("payment_tax_status", $payment_tax_status);
	setting_get("payment_tax_value", $payment_tax_value);
	customtext_get("payment_tax_label", $payment_tax_label, EDIR_LANGUAGE);

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(system_getFrontendPath("header.php", "layout"));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
	
	unset($loginTypes, $openIDEnabled, $googleEnabled, $facebookEnabled, $cUserEnabled);
	
	setting_get("foreignaccount_openid", $foreignaccount_openid);
	if ($foreignaccount_openid == "on") {
		$openIDEnabled		= true;
	}
	
	setting_get("foreignaccount_google", $foreignaccount_google);
	if ($foreignaccount_google == "on") {
		$googleEnabled		= true;
	}
	
	if (FACEBOOK_APP_ENABLED == "on") {
		$facebookEnabled	= true;
	}
	
	if (sess_isAccountLogged() && SOCIALNETWORK_FEATURE == "on") {
		$cUserEnabled		= true;
	}	
	
	$loginTypes							.= "formNewUser,";
	$loginTypes							.= "formDirectoryUser,";
	if ($openIDEnabled)		$loginTypes	.= "formOpenIDUser,";
	if ($googleEnabled)		$loginTypes	.= "formGoogleUser,";
	if ($facebookEnabled)	$loginTypes	.= "formFacebookUser,";
	if ($cUserEnabled)		$loginTypes	.= "formCurrentUser,";
	$loginTypes							= string_substr($loginTypes, 0, -1);
	
	$unique_id = system_generatePassword();
?>

<a href="#" id="info_window" class="iframe fancy_window_categPath" style="display:none"></a>   

	<script language="javascript" type="text/javascript">
		<!--

		function orderCalculate() {

			var xmlhttp;

			try {
				xmlhttp = new XMLHttpRequest();
			} catch (e) {
				try {
					xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try {
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e) {
						xmlhttp = false;
					}
				}
			}

			if (document.getElementById("check_out_payment")) document.getElementById("check_out_payment").className = "isHidden";
			if (document.getElementById("check_out_free")) document.getElementById("check_out_free").className = "isHidden";
			if (document.getElementById("loadingOrderCalculate")) document.getElementById("loadingOrderCalculate").style.display = "";
			if (document.getElementById("loadingOrderCalculate")) document.getElementById("loadingOrderCalculate").innerHTML = "<?=system_showText(LANG_WAITLOADING)?>";
			if (xmlhttp) {
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4) {
						if (xmlhttp.status == 200) {
							var price = xmlhttp.responseText;
							var arrPrice = price.split("|");
							var html = "";
							var tax_status = '<?=$payment_tax_status;?>';
							var tax_info = "";
							<? if ((PAYMENT_FEATURE == "on") && ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on"))) { ?>
								if (arrPrice[0] > 0) {
									if (tax_status == "on") {
										html += "<strong><?=system_showText(LANG_SUBTOTALAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?>"+arrPrice[0].substring(0, arrPrice[0].length-2)+"."+arrPrice[0].substring(arrPrice[0].length-2, arrPrice[0].length);
										html += "<br /><strong><?=system_showText(LANG_TAXAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?>"+arrPrice[1].substring(0, arrPrice[1].length-2)+"."+arrPrice[1].substring(arrPrice[1].length-2, arrPrice[1].length);
										html += "<br /><strong><?=system_showText(LANG_TOTALPRICEAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?>"+arrPrice[2].substring(0, arrPrice[2].length-2)+"."+arrPrice[2].substring(arrPrice[2].length-2, arrPrice[2].length);
										tax_info = "<?="+".$payment_tax_value."% ".$payment_tax_label;?> (" + "<?=CURRENCY_SYMBOL?>"+arrPrice[2].substring(0, arrPrice[2].length-2)+"."+arrPrice[2].substring(arrPrice[2].length-2, arrPrice[2].length) + ")";
									} else {
										html += "<strong><?=system_showText(LANG_TOTALPRICEAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?>"+arrPrice[0].substring(0, arrPrice[0].length-2)+"."+arrPrice[0].substring(arrPrice[0].length-2, arrPrice[0].length);
									}
									$('#trTax').addClass('isVisible');
									$('#trTax').removeClass('isHidden');
									if (document.getElementById("check_out_payment")) document.getElementById("check_out_payment").className = "isVisible";
									if (document.getElementById("checkoutpayment_total")) document.getElementById("checkoutpayment_total").innerHTML = html;
								} else {
									$('#trTax').addClass('isHidden');
									$('#trTax').removeClass('isVisible');
									if (document.getElementById("check_out_free")) document.getElementById("check_out_free").className = "isVisible";
									if (document.getElementById("checkoutfree_total")) document.getElementById("checkoutfree_total").innerHTML = "<strong><?=system_showText(LANG_TOTALPRICEAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?><?=system_showText(LANG_FREE)?>";
								}
								if (tax_status == "on") document.getElementById("taxInfo").innerHTML = tax_info;
							<? } else { ?>
								if (document.getElementById("check_out_free")) document.getElementById("check_out_free").className = "isVisible";
								if (arrPrice[0] > 0) {
									if (tax_status == "on") {
										html += "<strong><?=system_showText(LANG_SUBTOTALAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?>"+arrPrice[0].substring(0, arrPrice[0].length-2)+"."+arrPrice[0].substring(arrPrice[0].length-2, arrPrice[0].length);
										html += "<br /><strong><?=system_showText(LANG_TAXAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?>"+arrPrice[1].substring(0, arrPrice[1].length-2)+"."+arrPrice[1].substring(arrPrice[1].length-2, arrPrice[1].length);
										html += "<br /><strong><?=system_showText(LANG_TOTALPRICEAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?>"+arrPrice[2].substring(0, arrPrice[2].length-2)+"."+arrPrice[2].substring(arrPrice[2].length-2, arrPrice[2].length);
										tax_info = "<?="+".$payment_tax_value."% ".$payment_tax_label;?> (" + "<?=CURRENCY_SYMBOL?>"+arrPrice[2].substring(0, arrPrice[2].length-2)+"."+arrPrice[2].substring(arrPrice[2].length-2, arrPrice[2].length) + ")";
									} else {
										html += "<strong><?=system_showText(LANG_TOTALPRICEAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?>"+arrPrice[0].substring(0, arrPrice[0].length-2)+"."+arrPrice[0].substring(arrPrice[0].length-2, arrPrice[0].length);
									}
									$('#trTax').addClass('isVisible');
									$('#trTax').removeClass('isHidden');
									if (document.getElementById("checkoutfree_total")) document.getElementById("checkoutfree_total").innerHTML = html;
								} else {
									$('#trTax').addClass('isHidden');
									$('#trTax').removeClass('isVisible');
									if (document.getElementById("checkoutfree_total")) document.getElementById("checkoutfree_total").innerHTML = "<strong><?=system_showText(LANG_TOTALPRICEAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?><?=system_showText(LANG_FREE)?>";
								}
								if (tax_status == "on") document.getElementById("taxInfo").innerHTML = tax_info;
							<? } ?>
							if (document.getElementById("loadingOrderCalculate")) document.getElementById("loadingOrderCalculate").style.display = "none";
							if (document.getElementById("loadingOrderCalculate")) document.getElementById("loadingOrderCalculate").innerHTML = "";
						}
					}
				}
				var get_level = 0;
				if (document.order_listing.level) get_level = document.order_listing.level.value;
				var get_categories = 0;
				if (document.order_listing.feed) get_categories = document.order_listing.feed.length;
				var get_listingtemplate_id = 0;
				if (document.order_listing.listingtemplate_id) get_listingtemplate_id = document.order_listing.listingtemplate_id.value;
				var get_discount_id = "";				
				if (document.order_listing.discount_id) get_discount_id = document.order_listing.discount_id.value;
				
				for (var promo = 2; promo <= 5; promo++) {
					if (document.getElementById('extra_promotion_' + promo).checked == false) {
						break;
					}
				}
				
				if (promo > 2)
					var extra_promotion = promo - 1;
				else
					var extra_promotion = '';
				
				xmlhttp.open("GET", "<?=DEFAULT_URL;?>/ordercalculateprice.php?item=listing&item_id=<?=$unique_id;?>&level="+get_level+"&categories="+get_categories+"&listingtemplate_id="+get_listingtemplate_id+"&discount_id="+get_discount_id+"&extra_promotion="+extra_promotion, true);
				xmlhttp.send(null);
			}
		}

		function switchFormUserDisplay(user) {
			var loginOptions = ("<?=$loginTypes;?>").split(',');
			for (var i = 0; i < loginOptions.length; i++) {
				$('#' + loginOptions[i]).removeClass('isVisible');
				$('#' + loginOptions[i]).addClass('isHidden');
			}

			$('#' + user).removeClass('isHidden');
			$('#' + user).addClass('isVisible');
		}

		<? if (LISTINGTEMPLATE_FEATURE == "on") { ?>
			function templateSwitch(template) {
				if (!template) template = 0;
				<?
				$dbObjLT = db_getDBObJect();
				$sqlLT = "SELECT id FROM ListingTemplate WHERE status = 'enabled' AND editable = 'y' ORDER BY title";
				$resultLT = $dbObjLT->query($sqlLT);
				echo "var title_template_0 = '".system_showText(LANG_LABEL_TITLE).":';";
				while ($rowLT = mysql_fetch_assoc($resultLT)) {
					$listingtemplate = new ListingTemplate($rowLT["id"]);
					$template_title_field = $listingtemplate->getListingTemplateFields("title");
					echo "var title_template_".$listingtemplate->getNumber("id")." = '".addslashes(($template_title_field!==false) ? $template_title_field[0]["label"] : system_showText(LANG_LABEL_TITLE)).":';";
				}
				?>
				document.order_listing.listingtemplate_id.value = template;
				if (document.getElementById("title_label")) document.getElementById("title_label").innerHTML = eval("title_template_" + template);
				orderCalculate();
				loadCategoryTree('template', 'listing_', 'ListingCategory', 0, template, '<?=EDIRECTORY_FOLDER."/".(EDIR_LANG_URL ? EDIR_LANGUAGEABBREVIATION."/" : "").LISTING_FEATURE_FOLDER?>',<?=SELECTED_DOMAIN_ID?>);
				if (document.formDirectory != undefined)	document.formDirectory.action = "<?=$formloginaction?>&query=level=" + document.order_listing.level.value + "&listingtemplate_id=" + document.order_listing.listingtemplate_id.value;
				if (document.formOpenID != undefined)		document.formOpenID.action = "<?=$formloginaction?>&query=level=" + document.order_listing.level.value + "&listingtemplate_id=" + document.order_listing.listingtemplate_id.value;
				if (document.formCurrentUser != undefined)	document.formCurrentUser.action = "<?=$formloginaction?>&query=level=" + document.order_listing.level.value + "&listingtemplate_id=" + document.order_listing.listingtemplate_id.value;
			}
		<? } ?>

		function levelSwitch(level, hasPromotion) {
			if (hasPromotion == 'y') {
				document.getElementById('purchase_promotion').style.display = '';
			} else {
				for (var promo = 2; promo <= 5; promo++) {
					document.getElementById('extra_promotion_' + promo).checked = false;
				}
				document.getElementById('purchase_promotion').style.display = 'none';
			}
		
			<?
			foreach ($levelValue as $value) {
				echo "var extracat_note_".$value." = '".system_showText(($listingLevelObj->getFreeCategory($value) > 1) ? LANG_CATEGORY_PLURAL : LANG_CATEGORY)." <strong>".system_showText(LANG_FREE).": ".$listingLevelObj->getFreeCategory($value)."</strong>. ".system_showText(LANG_CATEGORIES_PRICEDESC1)." <strong>".system_showText(LANG_CATEGORIES_PRICEDESC2)." ".CURRENCY_SYMBOL." ".$listingLevelObj->getCategoryPrice($value)."</strong> ".system_showText(LANG_CATEGORIES_PRICEDESC3)."';";
			}
			?>
			document.order_listing.level.value = level;
			if (document.getElementById("extracategory_note")) document.getElementById("extracategory_note").innerHTML = eval("extracat_note_" + level);
			orderCalculate();
			if (document.formDirectory != undefined)	document.formDirectory.action = "<?=$formloginaction?>&query=level=" + document.order_listing.level.value + "&listingtemplate_id=" + document.order_listing.listingtemplate_id.value;
			if (document.formOpenID != undefined)		document.formOpenID.action = "<?=$formloginaction?>&query=level=" + document.order_listing.level.value + "&listingtemplate_id=" + document.order_listing.listingtemplate_id.value;
			if (document.formCurrentUser != undefined)	document.formCurrentUser.action = "<?=$formloginaction?>&query=level=" + document.order_listing.level.value + "&listingtemplate_id=" + document.order_listing.listingtemplate_id.value;
		}

		function JS_addCategory(text, id) {
			seed = document.order_listing.seed;
			feed = document.order_listing.feed;
			var flag=true;
			for (i=0;i<feed.length;i++) {
				if (feed.options[i].value==id) flag=false;
				if (!feed.options[i].value){
					feed.remove(feed.options[i]);
				}
			}
			if (text && id && flag) {
				feed.options[feed.length] = new Option(text, id);
				$('#categoryAdd'+id).after("<span class=\"categorySuccessMessage\"><?=system_showText(LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED)?></span>").css('display', 'none');
				$('.categorySuccessMessage').fadeOut(5000);
				orderCalculate();
			} else {
				if (!flag) $('#categoryAdd'+id).after("</a> <span class=\"categoryErrorMessage\"><?=system_showText(LANG_MSG_CATEGORY_ALREADY_INSERTED)?></span> </li>");
                else ('#categoryAdd'+id).after("</a> <span class=\"categoryErrorMessage\"><?=system_showText(LANG_MSG_SELECT_VALID_CATEGORY)?></span> </li>");
			}
		}

		function JS_submit() {
			feed = document.order_listing.feed;
			return_categories = document.order_listing.return_categories;
			if(return_categories.value.length > 0) return_categories.value = "";
			for (i=0;i<feed.length;i++) {
				if (!isNaN(feed.options[i].value)) {
					if (return_categories.value.length > 0) return_categories.value = return_categories.value + "," + feed.options[i].value;
					else return_categories.value = return_categories.value + feed.options[i].value;
				}
			}
		}

		//-->
	</script>

	<?
	$checkoutpayment_class = "isHidden";
	$checkoutfree_class = "isHidden";
	?>

	<ul class="standardStep">
		<li class="standardStepAD"><?=system_showText(LANG_EASYANDFAST)?> <span><?=($backlinks && BACKLINK_FEATURE == "on" ? system_showText(LANG_FOURSTEPS)  : system_showText(LANG_THREESTEPS))?> &raquo;</span></li>
		<li class="stepActived"><span>1</span>&nbsp;<?=system_showText(LANG_ORDER)?></li>
		<li><span>2</span>&nbsp;<?=system_showText(LANG_CHECKOUT)?></li>
		<li><span>3</span>&nbsp;<?=system_showText(LANG_CONFIGURATION)?></li>
	</ul>
	
	<div class="content content-full">
	
		<div class="content-main">

			<table border="0" cellpadding="0" cellspacing="0" class="orderTable">
				<tr>
					<th class="standardSubTitle"><?=system_showText(LANG_SELECTPACKAGE)?></th>
				</tr>
				<tr>
					<td>
						<table align="center" cellspacing="2" cellpadding="2" border="0" class="standardChooseLevel">
							<? if (LISTINGTEMPLATE_FEATURE == "on" && !USING_THEME_TEMPLATE) { ?>
								<tr>
									<th><?=system_showText(LANG_LISTING_LABELTEMPLATE)?>:</th>
									<td colspan="2">
										<select name="listingtemplate_id" onchange="templateSwitch(this.value);">
											<option value=""><?=system_showText(LANG_BUSINESS);?></option>
											<?
											$dbObjLT = db_getDBObJect();
											$sqlLT = "SELECT id FROM ListingTemplate WHERE status = 'enabled' AND editable = 'y' ORDER BY title";
											$resultLT = $dbObjLT->query($sqlLT);
											while ($rowLT = mysql_fetch_assoc($resultLT)) {
												$listingtemplate = new ListingTemplate($rowLT["id"]);
												echo "<option value=\"".$listingtemplate->getNumber("id")."\"";
												if ($listingtemplate_id == $listingtemplate->getNumber("id")) {
													echo " selected";
												}
												echo ">".$listingtemplate->getString("title");
												if ($listingtemplate->getString("price") > 0) echo " (+".CURRENCY_SYMBOL.$listingtemplate->getString("price").")";
												else echo " (".system_showText(LANG_FREE).")";
												echo "</option>";
											}
											?>
										</select>
										<?
										if ($listingtemplate_id) {
											$templateObj = new ListingTemplate($listingtemplate_id);
											if ($templateObj && $templateObj->getString("status")=="enabled") {
												$template_title_field = $templateObj->getListingTemplateFields("title");
											}
										} else {
											$template_title_field = false;
										}
										?>
									</td>
								</tr>
							<? } elseif (USING_THEME_TEMPLATE) { 
                                
                                    $templateObj = new ListingTemplate(THEME_TEMPLATE_ID);
                                    if ($templateObj && $templateObj->getString("status") == "enabled") {
                                        $template_title_field = $templateObj->getListingTemplateFields("title");
                                    }
                            ?>
                                <input type="hidden" name="listingtemplate_id" value="<?=THEME_TEMPLATE_ID?>" />
                            <? } ?> 
							<? foreach ($levelValue as $value) { ?>
								<tr>
									<th><?=$listingLevelObj->showLevel($value)?></th>
									<td>
										<?
										if ($listingLevelObj->getPrice($value) > 0) {
											echo CURRENCY_SYMBOL.$listingLevelObj->getPrice($value)." ".system_showText(LANG_PER)." ";
											if (payment_getRenewalCycle("listing") > 1) {
												echo payment_getRenewalCycle("listing")." ";
												echo payment_getRenewalUnitNamePlural("listing");
											}else {
												echo payment_getRenewalUnitName("listing");
											}
										} else {
											echo CURRENCY_SYMBOL.system_showText(LANG_FREE);
										}
										?>
									</td>
									<th class="radioChooseLevel">
										<input type="radio" name="level" value="<?=$value?>" <? if ($value == $level) { echo "checked=\"checked\""; } ?> onclick="levelSwitch('<?=$value?>', '<?php echo $listingLevelObj->getHasPromotion($value) ?>');" />
									</th>
								</tr>
							<? } ?>
							<? if ($payment_tax_status == "on") { ?>
								<tr id="trTax" class="isHidden">
									<td id="taxInfo" colspan="2"></td>
									<th class="radioChooseLevel"></th>
								</tr>
							<? } ?>
						</table>
		
					</td>
				</tr>
			</table>
		
			<table border="0" cellpadding="0" cellspacing="0" class="orderTable">
				<tr>
					<td colspan="2" class="standardSubTitle"><?=system_showText(LANG_ALREADYHAVEACCOUNT)?></td>
				</tr>
				<tr>
					<td class="orderUserTable">
		
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<th class="radioChooseLevel"><input type="radio" name="usertype" value="newuser" checked="checked" onclick="javascript:switchFormUserDisplay('formNewUser');" /></th>
								<td class="warning"><?=system_showText(LANG_ACCOUNTNEWUSER)?></td>
							</tr>
		
							<tr>
								<th class="radioChooseLevel"><input type="radio" name="usertype" value="directoryuser" <? if ($usertype == "directoryuser") echo "checked=\"checked\""; ?> onclick="javascript:switchFormUserDisplay('formDirectoryUser');" /></th>
								<td><?=system_showText(LANG_ACCOUNTDIRECTORYUSER)?></td>
							</tr>
		
							<? if ($openIDEnabled) { ?>
								<tr>
									<th class="radioChooseLevel"><input type="radio" name="usertype" value="openiduser" <? if ($usertype == "openiduser") echo "checked=\"checked\""; ?> onclick="javascript:switchFormUserDisplay('formOpenIDUser');" /></th>
									<td><?=system_showText(LANG_ACCOUNTOPENIDUSER)?></td>
								</tr>
							<? } ?>
		
							<? if ($facebookEnabled) { ?>
								<tr>
									<th class="radioChooseLevel"><input type="radio" name="usertype" value="facebookuser" <? if ($usertype == "facebookuser") echo "checked=\"checked\""; ?> onclick="javascript:switchFormUserDisplay('formFacebookUser');" /></th>
									<td><?=system_showText(LANG_ACCOUNTFACEBOOKUSER)?></td>
								</tr>
							<? } ?>
								
							<? if ($googleEnabled) { ?>
								<tr>
									<th class="radioChooseLevel"><input type="radio" name="usertype" value="googleuser" <? if ($usertype == "googleuser") echo "checked=\"checked\""; ?> onclick="javascript:switchFormUserDisplay('formGoogleUser');" /></th>
									<td><?=system_showText(LANG_ACCOUNTGOOGLEUSER)?></td>
								</tr>
							<? } ?>
		
							<? if ($cUserEnabled) { ?>
								<? $usertype = "currentuser";?>
								<tr>
									<th class="radioChooseLevel"><input type="radio" name="usertype" value="currentuser" checked onclick="javascript:switchFormUserDisplay('formCurrentUser');" /></th>
									<td><?=system_showText(LANG_MSG_USE_LOGGED_ACCOUNT)?></td>
								</tr>
							<? } ?>
								
							<tr>
								<td colspan="2">
		
									<div id="formDirectoryUser" class="<? if ($usertype == "directoryuser") echo "isVisible"; else echo "isHidden"; ?>">
		
										<form name="formDirectory" method="post" action="<?=$formloginaction;?>&amp;query=level=<?=($_POST["level"]?$_POST["level"]:$_GET["level"])?>&amp;listingtemplate_id=<?=($_POST["listingtemplate_id"]?$_POST["listingtemplate_id"]:$_GET["listingtemplate_id"])?>">
		
											<input type="hidden" name="userform" value="directory" />
											<input type="hidden" name="advertise" value="yes" />
		
											<?
											$members_section = true;
											$automatically = false;
											include(INCLUDES_DIR."/forms/form_login.php");
											?>
		
										</form>
		
									</div>
		
								</td>
							</tr>
		
							<? if ($openIDEnabled) { ?>
								<tr>
									<td colspan="2">
		
										<div id="formOpenIDUser" class="<? if ($usertype == "openiduser") echo "isVisible"; else echo "isHidden"; ?>">
		
											<form name="formOpenID" method="post" action="<?=$formloginaction;?>&amp;query=level=<?=($_POST["level"]?$_POST["level"]:$_GET["level"])?>&amp;listingtemplate_id=<?=($_POST["listingtemplate_id"]?$_POST["listingtemplate_id"]:$_GET["listingtemplate_id"])?>">
		
												<input type="hidden" name="userform" value="openid" />
												<input type="hidden" name="advertise" value="yes" />
		
												<? include(INCLUDES_DIR."/forms/form_openidlogin.php"); ?>
		
											</form>
		
										</div>
		
									</td>
								</tr>
							<? } ?>
							
							<? if ($facebookEnabled) { ?>
								<tr>
									<td colspan="2">
		
										<div id="formFacebookUser" class="<? if ($usertype == "facebookuser") echo "isVisible"; else echo "isHidden"; ?>">
											<? $urlRedirect = "?advertise=yes&advertise_item=listing&item_id=".$unique_id."&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/".LISTING_FEATURE_FOLDER."/listinglevel.php"); ?>
											<? include(INCLUDES_DIR."/forms/form_facebooklogin.php"); ?>
										</div>
		
									</td>
								</tr>
							<? } ?>
								
							<? if ($googleEnabled) { ?>
								<tr>
									<td colspan="2">
		
										<div id="formGoogleUser" class="<? if ($usertype == "googleuser") echo "isVisible"; else echo "isHidden"; ?>">
		
											<? $urlRedirect = "&advertise=yes&advertise_item=listing&item_id=".$unique_id."&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/".LISTING_FEATURE_FOLDER."/listinglevel.php"); ?>

											<? include(INCLUDES_DIR."/forms/form_googlelogin.php"); ?>
		
										</div>
		
									</td>
								</tr>
							<? } ?>
							
							<? if ($cUserEnabled) { ?>
								<tr>
									<td colspan="2">
										<div id="formCurrentUser" class="<? if ($usertype == "currentuser") echo "isVisible"; else echo "isHidden"; ?>">
											<form name="formCurrentUser" method="post" action="<?=$formloginaction;?>&amp;query=level=<?=($_POST["level"]?$_POST["level"]:$_GET["level"])?>&amp;listingtemplate_id=<?=($_POST["listingtemplate_id"]?$_POST["listingtemplate_id"]:$_GET["listingtemplate_id"])?>">
												<input type="hidden" name="userform" value="currentuser" />
												<input type="hidden" name="advertise" value="yes" />
												<input type="hidden" name="acc" value="<?=sess_getAccountIdFromSession()?>" />
		
												<h2 class="standardTitle">
												<?
													if (sess_getAccountIdFromSession()) {
														$sqlWelcome = "SELECT C.first_name, C.last_name, A.has_profile, P.friendly_url, P.nickname FROM Contact C
															LEFT JOIN Account A ON (C.account_id = A.id)
															LEFT JOIN Profile P ON (P.account_id = A.id)
															WHERE A.id = ".sess_getAccountIdFromSession();
														$resultWelcome = $dbObjWelcome->query($sqlWelcome);
														$contactWelcome = mysql_fetch_assoc($resultWelcome);
		
														if ($contactWelcome["has_profile"] == "y") {
															echo $contactWelcome["nickname"];
														} else {
															echo $contactWelcome["first_name"]." ".$contactWelcome["last_name"];
														}
													}
												?>
												</h2>
												<br />
												<p class="standardButton" style="margin-right:5px; float:left">
												<button type="submit">
													<?=system_showText(LANG_BUTTON_NEXT)?>
												</button>
												</p>
												<p style="float:left; margin-top:5px">
												<?=system_showText(LANG_OR)?>
												<a href="<?=SOCIALNETWORK_URL?>/logout.php">
													<?=system_showText(LANG_BUTTON_LOGOUT)?>
												</a>
												</p>
											</form>
										</div>
									</td>
								</tr>
							<? } ?>
						</table>
					</td>
				</tr>
			</table>
		
			<div id="formNewUser" class="<? if ((!$usertype) || ($usertype == "newuser")) echo "isVisible"; else echo "isHidden"; ?>">
		
				<? if ($message_account || $message_listing || $message_discount || $message_contact) { ?>
					<table align="center" border="0" cellpadding="2" cellspacing="2" class="standardSIGNUPTable">
						<? if ($message_account) { ?>
							<tr>
								<th colspan="2" class="SIGNUPTable-title errorTitle"><?=system_showText(LANG_ACCOUNTINFO_ERROR)?></th>
							</tr>
							<tr>
								<td colspan="2"><p class="errorMessage"><?=$message_account?></p></td>
							</tr>
						<? } ?>
						<? if ($message_listing || $message_discount) { ?>
							<tr>
								<th colspan="2" class="SIGNUPTable-title errorTitle"><?=system_showText(LANG_LISTINGINFO_ERROR)?></th>
							</tr>
							<? if ($message_listing) { ?>
								<tr>
									<td colspan="2"><p class="errorMessage"><?=$message_listing?><p></td>
								</tr>
							<? } ?>
							<? if ($message_discount) { ?>
								<tr>
									<td colspan="2"><p class="errorMessage"><?=$message_discount?></p></td>
								</tr>
							<? } ?>
						<? } ?>
						<? if ($message_contact) { ?>
							<tr>
								<th colspan="2" class="SIGNUPTable-title errorTitle"><?=system_showText(LANG_BILLINGINFO_ERROR)?></th>
							</tr>
							<tr>
								<td colspan="2"><p class="errorMessage"><?=$message_contact?></p></td>
							</tr>
						<? } ?>
					</table>
				<? } ?>
		
				<form name="order_listing" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" class="standardForm" onsubmit="JS_submit();">
					<input type="hidden" name="advertise" value="yes" />
					<input type="hidden" name="ieBugFix" value="1" />
					<input type="hidden" name="signup" value="true" />
					<input type="hidden" name="listingtemplate_id" id="listingtemplate_id" value="<?=$listingtemplate_id?>" />
					<input type="hidden" name="level" id="level" value="<?=$level?>" />
		
					<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/checkpasswordstrength.js"></script>
		
					<table align="center" border="0" cellpadding="2" cellspacing="2" class="standardSIGNUPTable">
						<tr>
							<th colspan="2" class="SIGNUPTable-title"><h2 class="standardSubTitle"><?=system_showText(LANG_ACCOUNTINFO)?> <span><?=system_showText(LANG_ACCOUNTINFOMSG)?></span></h2></th>
						</tr>
						<tr>
							<th>* <?=system_showText(LANG_LABEL_USERNAME)?>:</th>
							<td>
								<input type="text" name="username" id="usernameSugar" value="<?=$username?>" maxlength="<?=USERNAME_MAX_LEN?>" onblur="checkUsername(this.value, '<?=DEFAULT_URL;?>', 'members');populateField(this.value,'email');" />
								<span><?=system_showText(LANG_USERNAME_MSG1)." ".USERNAME_MIN_LEN." ".system_showText(LANG_USERNAME_MSG2)." ".USERNAME_MAX_LEN." ".system_showText(LANG_USERNAME_MSG3)?></span>
								<div id="checkUsername">&nbsp;</div>
							</td>
						</tr>
						<tr>
							<th>* <?=system_showText(LANG_LABEL_PASSWORD)?>:</th>
							<td>
								<input type="password" name="password" maxlength="<?=PASSWORD_MAX_LEN?>" class="input-form-account" <?if (PASSWORD_STRENGTH=='on') echo "onkeyup=\"checkPasswordStrength(this.value, '<?=EDIRECTORY_FOLDER;?>')\"";?> />
								<?if (PASSWORD_STRENGTH=='on'){?>
								<div class="checkPasswordStrength">
									<span><?=system_showText(LANG_LABEL_PASSWORDSTRENGTH);?>:</span>
									<div id="checkPasswordStrength" class="strengthNoPassword">&nbsp;</div>
								</div>
								<?}?>
								<span><?=system_showText(LANG_PASSWORD_MSG1)." ".PASSWORD_MIN_LEN." ".system_showText(LANG_PASSWORD_MSG2)." ".PASSWORD_MAX_LEN." ".system_showText(LANG_PASSWORD_MSG3)?></span>
							</td>
						</tr>
						<tr>
							<th>* <?=system_showText(LANG_LABEL_RETYPEPASSWORD)?>:</th>
							<td><input type="password" name="retype_password"  class="input-form-account" /></td>
						</tr>
						<tr>
							<th><input type="checkbox" name="agree_tou" value="1" <?=($agree_tou) ? "checked=\"checked\"" : ""?> class="inputRadio" /></th>
							<td>* <a href="<?=DEFAULT_URL?>/popup/popup.php?pop_type=terms" class="iframe fancy_window_terms"><?=system_showText(LANG_IGREETERMS)?></a></td>
						</tr>
						<tr>
							<th colspan="2" class="SIGNUPTable-title"><h2 class="standardSubTitle"><?=system_showText(LANG_LISTINGINFO)?></h2></th>
						</tr>
						<tr>
							<th id="title_label">* <?=($template_title_field!==false) ? $template_title_field[0]["label"] : system_showText(LANG_LABEL_TITLE)?>:</th>
							<td>
								<input type="text" name="title" value="<?=$title?>" class="input-form-listing" maxlength="100" onblur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" />
								<input type="hidden" name="friendly_url" id="friendly_url" value="<?=$friendly_url?>" maxlength="150" />
							</td>
						</tr>
						<? if (PAYMENT_FEATURE == "on") { ?>
							<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
								<tr>
									<th><?=string_ucwords(system_showText(LANG_LABEL_DISCOUNTCODE))?>:</th>
									<td><input type="text" name="discount_id" value="<?=$discount_id?>" class="input-form-listing" maxlength="10" onblur="orderCalculate();" /></td>
								</tr>
							<? } ?>
						<? } ?>
						<tr>
							<th colspan="2" class="SIGNUPTable-title">
								<h2 class="standardSubTitle">
									<?=system_showText(LANG_CATEGORIES_TITLE)?>
										<span id="extracategory_note"><?=string_ucwords(system_showText(($listingLevelObj->getFreeCategory($level) > 1) ? LANG_CATEGORY_PLURAL : LANG_CATEGORY))?> <strong><?=system_showText(LANG_FREE)?>: <?=$listingLevelObj->getFreeCategory($level)?></strong>. <?=system_showText(LANG_CATEGORIES_PRICEDESC1)?> <strong><?=system_showText(LANG_CATEGORIES_PRICEDESC2)?> <?=CURRENCY_SYMBOL?> <?=$listingLevelObj->getCategoryPrice($level)?></strong> <?=system_showText(LANG_CATEGORIES_PRICEDESC3)?></span>
										<span><?=system_showText(LANG_CATEGORIES_CATEGORIESMAXTIP1)." <strong>".system_showText(LISTING_MAX_CATEGORY_ALLOWED)."</strong> ".system_showText(LANG_CATEGORIES_CATEGORIESMAXTIP2)?></span>
									</h2>
							</th>
						</tr>
						<tr>
							<td colspan="2" class="autoWidth">
								<p class="warningBOXtext"><?=system_showText(LANG_CATEGORIES_MSG1)?><br /><?=system_showText(LANG_CATEGORIES_MSG2)?>
								</p>
							</td>
						</tr>
		
						<tr>
							<td colspan="2" class="treeView">
		
								<input type="hidden" name="return_categories" value="" />
		
								<ul id="listing_categorytree_id_0" class="categoryTreeview"><li>&nbsp;</li></ul>
		
								<table width="100%" border="0" cellpadding="2" class="tableCategoriesADDED" cellspacing="0">
									<tr>
										<th colspan="2" class="tableCategoriesTITLE alignLeft"><strong>* <?=system_showText(LANG_LISTING_CATEGORIES);?>:</strong></th>
									</tr>
									<tr>
										<td colspan="2" class="tableCategoriesCONTENT"><?=$feedDropDown?></td>
									</tr>
									<tr>
										<td class="tableCategoriesBUTTONS" colspan="2">
											<button type="button" onclick="JS_displayCategoryPath(document.order_listing.feed, '<?=system_showText(LANG_MSG_SELECT_CATEGORY_FIRST)?>', '<?=DEFAULT_URL?>/members/<?=LISTING_FEATURE_FOLDER;?>', 'info_window', false, 300, 100);"><?=system_showText(LANG_CATEGORY_VIEWPATH)?></button>&nbsp;
											<button type="button" onclick="JS_removeCategory(document.order_listing.feed, true);"><?=system_showText(LANG_CATEGORY_REMOVESELECTED)?></button>
										</td>
									</tr>
								</table>
		
							</td>
						</tr>
					</table>
					
					<?php // for purchasing extra deals ?>
					<div id="purchase_promotion" style="display: <?php echo ($listingLevelObj->getHasPromotion($level) == 'y') ? '' : 'none' ?>;">
						<table border="0" cellpadding="0" cellspacing="0" class="orderTable">
							<tr>
								<th class="standardSubTitle">
									<?=system_showText(PROMOTION_FEATURE_NAME_PLURAL)?>
								</th>
							</tr>
							<tr>
								<td>
									<table  align="center" cellspacing="2" cellpadding="2" border="0" class="standardChooseLevel">
										<tr>
											<th>
												First <?=system_showText(PROMOTION_FEATURE_NAME)?> 
												<span>(included)</span>:
											</th>
											<td colspan="2">
												FREE
											</td>
										</tr>
										<?php
										$promotionPricingObj = new PromotionPrice();
										foreach ($promotionPricingObj->price as $promotion => $price) {
											?>
											<tr>
												<th class="autoWidth">
													<?=$promotionPricingObj->extra_promotions[$promotion]?> <?=system_showText(PROMOTION_FEATURE_NAME)?>:
												</th>
												<td class="autoWidth">
													$<?=$price?>
												</td>
												<td class="radioChooseLevel">
													<input type="checkbox" name="extra_promotion[<?=$promotion?>]" id="extra_promotion_<?=$promotion?>" value="1" style="width: 20px;" onclick="purchasePromotion(<?=$promotion?>)">
												</td>
											</tr>
											<?
										}
										?>
									</table>
								</td>
							</tr>
						</table>
					</div>
		
					<table align="center" border="0" cellpadding="2" cellspacing="2" class="standardSIGNUPTable">
						<tr>
							<th class="SIGNUPTable-title" colspan="2">
								<h2 class="standardSubTitle"><?=system_showText(LANG_BILLINGINFO)?><span>(<?=system_showText(LANG_BILLINGINFO_MSG1)." ".system_showText(LANG_BILLINGINFO_MSG2_LISTING)?>)</span></h2>
							</th>
						</tr>
					</table>
					
					<? $advertise = true; ?>
		
					<? include(EDIRECTORY_ROOT."/includes/forms/form_contact.php"); ?>
		
					<? include(EDIRECTORY_ROOT."/includes/code/seckey.php"); ?>
		
					<input type="hidden" name="ieBugFix" value="1" />
		
					<? if (PAYMENT_FEATURE == "on") { ?>
						<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
							<div id="check_out_payment" class="<?=$checkoutpayment_class?>">
								<div id="checkoutpayment_total" class="orderTotalAmount"></div>
								<? include(INCLUDES_DIR."/forms/form_paymentmethod.php"); ?>
								<p class="standardButton checkoutButton">
									<button type="submit" name="continue" value=""><?=system_showText(LANG_BUTTON_CONTINUE)?></button>
								</p>
							</div>
						<? } ?>
					<? } ?>
		
					<div id="check_out_free" class="<?=$checkoutfree_class?>">
						<div id="checkoutfree_total" class="orderTotalAmount"></div>
							<p class="standardButton checkoutButton">
								<button type="submit" name="checkout" value="<?=system_showText(LANG_BUTTON_CONTINUE)?>"><?=system_showText(LANG_BUTTON_CONTINUE)?></button>
							</p>
					</div>
		
				</form>
		
			</div>
			
		</div>
		
		<? include(system_getFrontendPath("banner_bottom.php")); ?>
		
	</div>

	<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/categorytree.js"></script>
	<script language="javascript" type="text/javascript">
		<? if ($listingtemplate_id) { ?>
			loadCategoryTree('template', 'listing_', 'ListingCategory', 0, <?=$listingtemplate_id?>, '<?=EDIRECTORY_FOLDER."/".(EDIR_LANG_URL ? EDIR_LANGUAGEABBREVIATION."/" : "").LISTING_FEATURE_FOLDER?>',<?=SELECTED_DOMAIN_ID?>);
		<? } else {  ?>
			loadCategoryTree('all', 'listing_', 'ListingCategory', 0, 0, '<?=EDIRECTORY_FOLDER."/".(EDIR_LANG_URL ? EDIR_LANGUAGEABBREVIATION."/" : "").LISTING_FEATURE_FOLDER?>',<?=SELECTED_DOMAIN_ID?>);
		<? } ?>
	</script>

	<script language="javascript" type="text/javascript">
		orderCalculate();
		
		function purchasePromotion(promotion) {
			if (document.getElementById('extra_promotion_' + promotion).checked == true) {
				for (var promo = promotion - 1; promo >= 2; promo--) {
					if (document.getElementById('extra_promotion_' + promo).checked == false) {
						alert('Please select previous deals before selecting this deal');
						document.getElementById('extra_promotion_' + promotion).checked = false;
						return;
					}
				}
			} else {
				for (var promo = promotion + 1; promo <= 5; promo++) {
					if (document.getElementById('extra_promotion_' + promo).checked == true) {
						alert('Please deselect next deals before deselecting this deal');
						document.getElementById('extra_promotion_' + promotion).checked = true;
						return;
					}
				}
			}
			orderCalculate();
		}
	</script>
	

<?

	if($_POST["account_sugar_id"]){
		?>
		<script>
			$(document).ready(function() {
				checkUsername(document.getElementById('usernameSugar').value, '<?=DEFAULT_URL;?>', 'members');
				populateField(document.getElementById('usernameSugar').value,'email');
			});
		</script>
		<?
	}

	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(system_getFrontendPath("footer.php", "layout"));
?>