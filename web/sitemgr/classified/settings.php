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
	# * FILE: /sitemgr/classified/settings.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/sitemgr/".CLASSIFIED_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$classifiedObj = new Classified($id);
	} else {
		header("Location: ".DEFAULT_URL."/sitemgr/".CLASSIFIED_FEATURE_FOLDER."/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
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

		if (validate_form("classifiedsettings", $_POST, $message_classifiedsettings)) {

			$classifiedObj->setString("status", $_POST['status']);
			$classifiedObj->setDate("renewal_date", $_POST['renewal_date']);

			if (!$classifiedObj->hasRenewalDate()) {
				$classifiedObj->setString("renewal_date", "0000-00-00");
			}

			$classifiedObj->Save();

			if($_POST["add_transaction"] == 1){

				$accountObj = new Account($_POST["account_id"]);
				$contactObj = new Contact($_POST["account_id"]);

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
                
                $levelObj = new ClassifiedLevel();

				$payment_classified_log["payment_log_id"]	= $paymentLogObj->getString("id");
				$payment_classified_log["classified_id"]	= $classifiedObj->getString("id");
				$payment_classified_log["classified_title"]	= $classifiedObj->getString("title",false);
				$payment_classified_log["discount_id"]		= $classifiedObj->getString("discount_id");
				$payment_classified_log["level"]            = $classifiedObj->getString("level");
				$payment_classified_log["level_label"]		= $levelObj->getName($classifiedObj->getString("level"));
				$payment_classified_log["renewal_date"]		= $classifiedObj->getString("renewal_date");
				$payment_classified_log["amount"]           = str_replace(",", "", $_POST["amount"]);

				$paymentClassifiedLogObj = new PaymentClassifiedLog($payment_classified_log);
				$paymentClassifiedLogObj->Save();

			}

			# ------------------------------------------------------------------------------
			# SENDING EMAIL OF ACTIVATION CLASSIFIED TO MEMBER
			# ------------------------------------------------------------------------------
			if ($_POST['email_notification'] == 1 && $_POST['status'] == "A") {
				if ($classifiedObj->getNumber("account_id") > 0) {
					$contactObj = new Contact($classifiedObj->getNumber("account_id"));
					if ($emailNotificationObj = system_checkEmail(SYSTEM_ACTIVE_CLASSIFIED, $contactObj->getString("lang"))) {
						setting_get("sitemgr_send_email", $sitemgr_send_email);
						setting_get("sitemgr_email", $sitemgr_email);
						$sitemgr_emails = explode(",", $sitemgr_email);
						if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
						$domain = new Domain(SELECTED_DOMAIN_ID);
						$subject = $emailNotificationObj->getString("subject");
						$body 	 = $emailNotificationObj->getString("body");
						$body 	 = system_replaceEmailVariables($body, $classifiedObj->getNumber('id'), 'classified');
						$body	 = str_replace($_SERVER["HTTP_HOST"], $domain->getstring("url"), $body);
						$subject = system_replaceEmailVariables($subject, $classifiedObj->getNumber('id'), 'classified');
						$body = html_entity_decode($body);
						$subject = html_entity_decode($subject);
						system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
					}
				}
			}

			$message = 1;
            header("Location: ".DEFAULT_URL."/sitemgr/".CLASSIFIED_FEATURE_FOLDER."/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;

		}

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$renewal_date = $classifiedObj->getDate("renewal_date");

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
			$arrayValueDD[] = string_ucwords($arrayValue[$i]);
			$arrayNameDD[] = string_ucwords($arrayName[$i]);
		}
	}
	$statusDropDown = html_selectBox("status", $arrayNameDD, $arrayValueDD, $classifiedObj->getString("status"), "", "class='input-dd-form-settings'", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");

	if(!$_POST["account_id"]) $account_id = $classifiedObj->getString("account_id");

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
		<div id="header-content"><h1><?=string_ucwords(system_showText(LANG_SITEMGR_CLASSIFIED))?> <?=string_ucwords(system_showText(LANG_SITEMGR_STATUS))?></h1></div>
	</div>

	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
			<?if (CUSTOM_CLASSIFIED_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>
			<? include(INCLUDES_DIR."/tables/table_classified_submenu.php"); ?>

			<br />
			
			<div class="baseForm">

			<form name="classified_setting" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				<input type="hidden" name="id" value="<?=$id?>" />

				<? include(INCLUDES_DIR."/forms/form_classifiedsettings.php"); ?>

				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<button type="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

				<button type="button" name="back" value="Back" class="input-button-form" onclick="document.getElementById('formclassifiedsettingscancel').submit();"><?=system_showText(LANG_SITEMGR_BACK)?></button>

			</form>
			<form id="formclassifiedsettingscancel" action="<?=DEFAULT_URL?>/sitemgr/<?=CLASSIFIED_FEATURE_FOLDER;?>/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">

				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />

			</form>
			
			</div>
			<? } ?>

		</div>

	</div>

	<div id="bottom-content">&nbsp;</div>

</div>

<? if ($classifiedObj->hasRenewalDate()) { ?>
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