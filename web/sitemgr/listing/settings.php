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
	# * FILE: /sitemgr/listing/settings.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	if ($id) {
		$listingObj = new Listing($id);
	} else {
		header("Location: ".DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER."/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($_POST["amount"]) $_POST["amount"] = format_money($_POST["amount"]);
		else $_POST["amount"] = false;

		if ($hasrenewaldate == "no") {
			unset($_POST['renewal_date']);
		}

		if (validate_form("listingsettings", $_POST, $message_listingsettings)) {

			$listingObj->setString("status", $_POST['status']);
			$listingObj->setDate("renewal_date", $_POST['renewal_date']);

			if (!$listingObj->hasRenewalDate()) {
				$listingObj->setString("renewal_date", "0000-00-00");
			}

			$listingObj->Save();

			if ($_POST["add_transaction"] == 1) {

				$accountObj = new Account($_POST["account_id"]);
				$contactObj = new Contact($_POST["account_id"]);

				// retrieving categories related with listing
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

				$category_amount = 0;
				$sql = "SELECT category_id FROM Listing_Category WHERE listing_id = ".$listingObj->getNumber("id");
				$result = $db->query($sql);
				if(mysql_num_rows($result)){
					while($row = mysql_fetch_assoc($result)){
						$category_amount++;
					}

				}

				$log["account_id"]				= $_POST["account_id"];
				$log["username"]				= $accountObj->getString("username");;
				$log["ip"]						= $_SERVER["REMOTE_ADDR"];
				$log["transaction_id"]			= "MAN_".string_strtoupper(uniqid(""));
				$log["transaction_status"]		= MANUAL_STATUS;
				$log["transaction_datetime"]	= date("Y-m-d H:i:s");
				$log["transaction_amount"]		= str_replace(",", "", $_POST["amount"]);
				$log["transaction_currency"]	= MANUAL_CURRENCY;
				$log["system_type"]				= "manual";
				$log["notes"]					= $_POST["notes"];

				$paymentLogObj = new PaymentLog($log);
				$paymentLogObj->Save(SELECTED_DOMAIN_ID);
                
                $levelObj = new ListingLevel();

				$payment_listing_log["payment_log_id"]	= $paymentLogObj->getString("id");
				$payment_listing_log["listing_id"]		= $listingObj->getString("id");
				$payment_listing_log["listing_title"]	= $listingObj->getString("title", false);
				$payment_listing_log["discount_id"]		= $listingObj->getString("discount_id");
				$payment_listing_log["level"]			= $listingObj->getString("level");
				$payment_listing_log["level_label"]		= $levelObj->getName($listingObj->getString("level"));
				$payment_listing_log["renewal_date"]	= $listingObj->getString("renewal_date");
				$payment_listing_log["categories"]		= $category_amount;
				$payment_listing_log["amount"]			= str_replace(",", "", $_POST["amount"]);

				$payment_listing_log["extra_categories"] = 0;
				
				if (($category_amount > 0) && (($category_amount - $levelObj->getFreeCategory($listingObj->getString("level"))) > 0)) {
					$payment_listing_log["extra_categories"] = $category_amount - $levelObj->getFreeCategory($listingObj->getString("level"));
				} else {
					$payment_listing_log["extra_categories"] = 0;
				}

				$payment_listing_log["listingtemplate_title"] = "";
				if (LISTINGTEMPLATE_FEATURE == "on") {
					if ($listingObj->getString("listingtemplate_id")) {
						$listingTemplateObj = new ListingTemplate($listingObj->getString("listingtemplate_id"));
						$payment_listing_log["listingtemplate_title"] = $listingTemplateObj->getString("title", false);
					}
				}

				$paymentListingLogObj = new PaymentListingLog($payment_listing_log);

				$paymentListingLogObj->Save();

			}

			# ------------------------------------------------------------------------------
			# SENDING EMAIL OF ACTIVATION LISTING TO MEMBER
			# ------------------------------------------------------------------------------
			if ($_POST['email_notification'] == 1 && $_POST['status'] == "A") {
				if ($listingObj->getNumber("account_id") > 0) {
					$contactObj = new Contact($listingObj->getNumber("account_id"));
					if($emailNotificationObj = system_checkEmail(SYSTEM_ACTIVE_LISTING, $contactObj->getString("lang"))) {
						setting_get("sitemgr_send_email", $sitemgr_send_email);
						setting_get("sitemgr_email", $sitemgr_email);
						$sitemgr_emails = explode(",", $sitemgr_email);
						if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
						$domain = new Domain(SELECTED_DOMAIN_ID);
						$subject = $emailNotificationObj->getString("subject");
						$body 	 = $emailNotificationObj->getString("body");
						$body 	 = system_replaceEmailVariables($body, $listingObj->getNumber('id'), 'listing');
						$body	 = str_replace($_SERVER["HTTP_HOST"], $domain->getstring("url"), $body);
//wtc

	$blogo = "uscb.png";
	$sql = "SELECT MIN( category_root_id ) category_root_id, title1, Listing.level FROM `Listing` INNER JOIN `Listing_Category` ON `Listing_Category`.listing_id = Listing.id INNER JOIN ListingCategory ON ListingCategory.id = category_root_id WHERE Listing.id = ".$id."";
	$dbObj = db_getDBObject();
	$result = $dbObj->query($sql);
	if (mysql_numrows($result)) {
		$row = mysql_fetch_array($result);
		$catlink = $row["title1"];
		if($row["level"] == 70) $blogo = "dealcloudusa.png";
		$backlinkcode = 'You are entitled for a free SEO for your listing by placing our backlink code at your website. (click this link to get the code) '.'http://www.dealcloudusa.com/members/listing/backlinks.php?id='.$id.'&screen=&letter=';	
		$_SESSION['backlinkcode'] = $backlinkcode;
	} else {
		$catlink = "You have no listing";	
	}

						//$body = str_replace("BACKLINK_URL",$listingObj->getString("backlinkcode"),$body);				
						$body = str_replace("BACKLINK_URL",$backlinkcode,$body);				
//end wtc
						$subject = system_replaceEmailVariables($subject, $listingObj->getNumber('id'), 'listing');
						$body = html_entity_decode($body);
						$subject = html_entity_decode($subject);
						//system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
						system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", "webadmin@dealcloudusa.com", $error);						
					}
				}
			}

            $message = 1;
			header("Location: ".DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER."/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;

		}

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$renewal_date = $listingObj->getDate("renewal_date");
	
	// Status Drop Down
	$statusObj = new ItemStatus();
	unset($arrayValue);
	unset($arrayName);
	$arrayValue = $statusObj->getValues();
	$arrayName = $statusObj->getNames();
	unset($arrayValueDD);
	unset($arrayNameDD);
	for ($i=0; $i<count($arrayValue); $i++) {
		if ($arrayValue[$i] != "E") {
			$arrayValueDD[] = $arrayValue[$i];
			$arrayNameDD[] = $arrayName[$i];
		}
	}
	$statusDropDown = html_selectBox("status", $arrayNameDD, $arrayValueDD, $listingObj->getString("status"), "", "class='input-dd-form-settings'", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");

	if(!$_POST["account_id"]) $account_id = $listingObj->getString("account_id");

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
		<div id="header-content"><h1><?=system_showText(LANG_SITEMGR_LISTING_SING)?> <?=string_ucwords(system_showText(LANG_SITEMGR_STATUS))?></h1></div>
	</div>

	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_listing_submenu.php"); ?>

			<br />
			
			<div class="baseForm">

			<form name="listing_setting" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				<input type="hidden" name="id" value="<?=$id?>" />

				<? include(INCLUDES_DIR."/forms/form_listingsettings.php"); ?>

							<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
							<input type="hidden" name="letter" value="<?=$letter?>" />
							<input type="hidden" name="screen" value="<?=$screen?>" />
							<button type="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
							<button type="button" name="back" value="Back" class="input-button-form" onclick="document.getElementById('formlistingsettingscancel').submit();"><?=system_showText(LANG_SITEMGR_BACK)?></button>

			</form>
			<form id="formlistingsettingscancel" action="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">
							<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
							<input type="hidden" name="letter" value="<?=$letter?>" />
							<input type="hidden" name="screen" value="<?=$screen?>" />
			</form>
			
			</div>

		</div>

	</div>

	<div id="bottom-content">&nbsp;</div>

</div>

<? if ($listingObj->hasRenewalDate()) { ?>
	<script type="text/javascript">
		$(document).ready(function() {
			//DATE PICKER
			<?
			if ( DEFAULT_DATE_FORMAT == "m/d/Y" ) $date_format = "mm/dd/yy";
			elseif ( DEFAULT_DATE_FORMAT == "d/m/Y" ) $date_format = "dd/mm/yy";
			?>

			$('#renewal_date').datepicker({
				dateFormat: '<?=$date_format?>',
				changeMonth: true,
				changeYear: true,
                yearRange: '<?=date("Y")?>:<?=date("Y")+10?>'
			});
	    });
</script>
<? } ?>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>