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
	# * FILE: /sitemgr/prefs/email.php
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
	
	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);	

	//increases frequently actions
	if (!isset($sitemgr_email)) system_setFreqActions('prefs_systememail','prefsemail');

	// Default CSS class for message
	$message_style = "errorMessage";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		// Admin E-mail
		if ($adminemail) {

			if (validate_form("adminemail", $_POST, $message_adminemail)) {

				$error = false;

				$sitemgr_email = str_replace(" ", "", $sitemgr_email);
				if ($sitemgr_email) {
					if (!setting_set("sitemgr_email", $sitemgr_email)) {
						if (!setting_new("sitemgr_email", $sitemgr_email)) {
							$error = true;
						}
					}
				}

				if (!setting_set("sitemgr_send_email", $send_email)) {
					if (!setting_new("sitemgr_send_email", $send_email)) {
						$error = true;
					}
				}

				$sitemgr_listing_email = str_replace(" ", "", $sitemgr_listing_email);
				if (!setting_set("sitemgr_listing_email", $sitemgr_listing_email)) {
					if (!setting_new("sitemgr_listing_email", $sitemgr_listing_email)) {
						$error = true;
					}
				}

				$sitemgr_event_email = str_replace(" ", "", $sitemgr_event_email);
				if (!setting_set("sitemgr_event_email", $sitemgr_event_email)) {
					if (!setting_new("sitemgr_event_email", $sitemgr_event_email)) {
						$error = true;
					}
				}

				$sitemgr_banner_email = str_replace(" ", "", $sitemgr_banner_email);
				if (!setting_set("sitemgr_banner_email", $sitemgr_banner_email)) {
					if (!setting_new("sitemgr_banner_email", $sitemgr_banner_email)) {
						$error = true;
					}
				}

				$sitemgr_classified_email = str_replace(" ", "", $sitemgr_classified_email);
				if (!setting_set("sitemgr_classified_email", $sitemgr_classified_email)) {
					if (!setting_new("sitemgr_classified_email", $sitemgr_classified_email)) {
						$error = true;
					}
				}

				$sitemgr_article_email = str_replace(" ", "", $sitemgr_article_email);
				if (!setting_set("sitemgr_article_email", $sitemgr_article_email)) {
					if (!setting_new("sitemgr_article_email", $sitemgr_article_email)) {
						$error = true;
					}
				}

				$sitemgr_account_email = str_replace(" ", "", $sitemgr_account_email);
				if (!setting_set("sitemgr_account_email", $sitemgr_account_email)) {
					if (!setting_new("sitemgr_account_email", $sitemgr_account_email)) {
						$error = true;
					}
				}

				$sitemgr_contactus_email = str_replace(" ", "", $sitemgr_contactus_email);
				if (!setting_set("sitemgr_contactus_email", $sitemgr_contactus_email)) {
					if (!setting_new("sitemgr_contactus_email", $sitemgr_contactus_email)) {
						$error = true;
					}
				}

				$sitemgr_support_email = str_replace(" ", "", $sitemgr_support_email);
				if (!setting_set("sitemgr_support_email", $sitemgr_support_email)) {
					if (!setting_new("sitemgr_support_email", $sitemgr_support_email)) {
						$error = true;
					}
				}

				$sitemgr_payment_email = str_replace(" ", "", $sitemgr_payment_email);
				if (!setting_set("sitemgr_payment_email", $sitemgr_payment_email)) {
					if (!setting_new("sitemgr_payment_email", $sitemgr_payment_email)) {
						$error = true;
					}
				}

				$sitemgr_rate_email = str_replace(" ", "", $sitemgr_rate_email);
				if (!setting_set("sitemgr_rate_email", $sitemgr_rate_email)) {
					if (!setting_new("sitemgr_rate_email", $sitemgr_rate_email)) {
						$error = true;
					}
				}

				$sitemgr_claim_email = str_replace(" ", "", $sitemgr_claim_email);
				if (!setting_set("sitemgr_claim_email", $sitemgr_claim_email)) {
					if (!setting_new("sitemgr_claim_email", $sitemgr_claim_email)) {
						$error = true;
					}
				}

				$sitemgr_blog_email = str_replace(" ", "", $sitemgr_blog_email);
				if (!setting_set("sitemgr_blog_email", $sitemgr_blog_email)) {
					if (!setting_new("sitemgr_blog_email", $sitemgr_blog_email)) {
						$error = true;
					}
				}

				$sitemgr_import_email = str_replace(" ", "", $sitemgr_import_email);
				if (!setting_set("sitemgr_import_email", $sitemgr_import_email)) {
					if (!setting_new("sitemgr_import_email", $sitemgr_import_email)) {
						$error = true;
					}
				}

				if (!$error) {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_YOURSETTINGSWERECHANGED);
					$message_style = "successMessage";
				} else {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
				}

				if($actions) {
					$message_adminemail .= implode("<br />", $actions);
				}

			}

		}

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	if (!$sitemgr_email) setting_get("sitemgr_email", $sitemgr_email);
	setting_get("sitemgr_send_email", $send_email); if ($send_email) $send_email_checked = "checked";
	if (!$sitemgr_listing_email) setting_get("sitemgr_listing_email", $sitemgr_listing_email);
	if (!$sitemgr_event_email) setting_get("sitemgr_event_email", $sitemgr_event_email);
	if (!$sitemgr_banner_email) setting_get("sitemgr_banner_email", $sitemgr_banner_email);
	if (!$sitemgr_classified_email) setting_get("sitemgr_classified_email", $sitemgr_classified_email);
	if (!$sitemgr_article_email) setting_get("sitemgr_article_email", $sitemgr_article_email);
	if (!$sitemgr_account_email) setting_get("sitemgr_account_email", $sitemgr_account_email);
	if (!$sitemgr_contactus_email) setting_get("sitemgr_contactus_email", $sitemgr_contactus_email);
	if (!$sitemgr_support_email) setting_get("sitemgr_support_email", $sitemgr_support_email);
	if (!$sitemgr_payment_email) setting_get("sitemgr_payment_email", $sitemgr_payment_email);
	if (!$sitemgr_rate_email) setting_get("sitemgr_rate_email", $sitemgr_rate_email);
	if (!$sitemgr_claim_email) setting_get("sitemgr_claim_email", $sitemgr_claim_email);
	if (!$sitemgr_blog_email) setting_get("sitemgr_blog_email", $sitemgr_blog_email);
	if (!$sitemgr_import_email) setting_get("sitemgr_import_email", $sitemgr_import_email);

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
			<h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL)?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>		

			<br />

			<form name="adminemail" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				<? include(INCLUDES_DIR."/forms/form_adminemail.php"); ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="adminemail" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
						</td>
					</tr>
				</table>
			</form>

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
