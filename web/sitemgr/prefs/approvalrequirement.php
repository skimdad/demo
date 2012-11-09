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
	# * FILE: /sitemgr/prefs/approvalrequirement.php
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
	if (!isset($actions)) system_setFreqActions('prefs_aprovalrequirement','settingsapproval');
	
	// Default CSS class for message
	$message_style = "successMessage";
	
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
	
		if ($approvalrequirement) {

			if(!setting_set("listing_approve_paid", $listing_approve_paid)) {
				if(!setting_new("listing_approve_paid", $listing_approve_paid)) {
					$error = true;
				}
			}
			if(!setting_set("listing_approve_free", $listing_approve_free)) {
				if(!setting_new("listing_approve_free", $listing_approve_free)) {
					$error = true;
				}
			}
			if(!setting_set("listing_approve_updated", $listing_approve_updated)) {
				if(!setting_new("listing_approve_updated", $listing_approve_updated)) {
					$error = true;
				}
			}
			if(!setting_set("new_listing_email", $new_listing_email)) {
				if(!setting_new("new_listing_email", $new_listing_email)) {
					$error = true;
				}
			}

			if(!setting_set("update_listing_email", $update_listing_email)) {
				if(!setting_new("update_listing_email", $update_listing_email)) {
					$error = true;
				}
			}

			if(!setting_set("event_approve_paid", $event_approve_paid)) {
				if(!setting_new("event_approve_paid", $event_approve_paid)) {
					$error = true;
				}
			}
			if(!setting_set("event_approve_free", $event_approve_free)) {
				if(!setting_new("event_approve_free", $event_approve_free)) {
					$error = true;
				}
			}
			if(!setting_set("event_approve_updated", $event_approve_updated)) {
				if(!setting_new("event_approve_updated", $event_approve_updated)) {
					$error = true;
				}
			}
			if(!setting_set("new_event_email", $new_event_email)) {
				if(!setting_new("new_event_email", $new_event_email)) {
					$error = true;
				}
			}

			if(!setting_set("update_event_email", $update_event_email)) {
				if(!setting_new("update_event_email", $update_event_email)) {
					$error = true;
				}
			}
			if(!setting_set("classified_approve_paid", $classified_approve_paid)) {
				if(!setting_new("classified_approve_paid", $classified_approve_paid)) {
					$error = true;
				}
			}
			if(!setting_set("classified_approve_free", $classified_approve_free)) {
				if(!setting_new("classified_approve_free", $classified_approve_free)) {
					$error = true;
				}
			}
			if(!setting_set("classified_approve_updated", $classified_approve_updated)) {
				if(!setting_new("classified_approve_updated", $classified_approve_updated)) {
					$error = true;
				}
			}
			if(!setting_set("new_classified_email", $new_classified_email)) {
				if(!setting_new("new_classified_email", $new_classified_email)) {
					$error = true;
				}
			}

			if(!setting_set("update_classified_email", $update_classified_email)) {
				if(!setting_new("update_classified_email", $update_classified_email)) {
					$error = true;
				}
			}
			if(!setting_set("article_approve_paid", $article_approve_paid)) {
				if(!setting_new("article_approve_paid", $article_approve_paid)) {
					$error = true;
				}
			}
			if(!setting_set("article_approve_free", $article_approve_free)) {
				if(!setting_new("article_approve_free", $article_approve_free)) {
					$error = true;
				}
			}
			if(!setting_set("article_approve_updated", $article_approve_updated)) {
				if(!setting_new("article_approve_updated", $article_approve_updated)) {
					$error = true;
				}
			}
			if(!setting_set("new_article_email", $new_article_email)) {
				if(!setting_new("new_article_email", $new_article_email)) {
					$error = true;
				}
			}

			if(!setting_set("update_article_email", $update_article_email)) {
				if(!setting_new("update_article_email", $update_article_email)) {
					$error = true;
				}
			}
			if(!setting_set("banner_approve_paid", $banner_approve_paid)) {
				if(!setting_new("banner_approve_paid", $banner_approve_paid)) {
					$error = true;
				}
			}
			if(!setting_set("banner_approve_free", $banner_approve_free)) {
				if(!setting_new("banner_approve_free", $banner_approve_free)) {
					$error = true;
				}
			}
			if(!setting_set("banner_approve_updated", $banner_approve_updated)) {
				if(!setting_new("banner_approve_updated", $banner_approve_updated)) {
					$error = true;
				}
			}
			if(!setting_set("new_banner_email", $new_banner_email)) {
				if(!setting_new("new_banner_email", $new_banner_email)) {
					$error = true;
				}
			}

			if(!setting_set("update_banner_email", $update_banner_email)) {
				if(!setting_new("update_banner_email", $update_banner_email)) {
					$error = true;
				}
			}
			
			if (!$error) {
				$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_APPROVAL_CONFIGURATIONWASCHANGED);
			} else {
				$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
				$message_style = "errorMessage";
			}
			if($actions) {
				$message_approval_options .= implode("<br />", $actions);
			}
		}
	}
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	setting_get("listing_approve_paid", $listing_approve_paid);
	if ($listing_approve_paid) $listing_approve_paid_checked = "checked";

	setting_get("listing_approve_free", $listing_approve_free);
	if ($listing_approve_free) $listing_approve_free_checked = "checked";

	setting_get("listing_approve_updated", $listing_approve_updated);
	if ($listing_approve_updated) $listing_approve_updated_checked = "checked";

	setting_get("new_listing_email", $new_listing_email);
	if ($new_listing_email) $new_listing_email_checked = "checked";

	setting_get("update_listing_email", $update_listing_email);
	if ($update_listing_email) $update_listing_email_checked = "checked";

	setting_get("article_approve_paid", $article_approve_paid);
	if ($article_approve_paid) $article_approve_paid_checked = "checked";

	setting_get("article_approve_free", $article_approve_free);
	if ($article_approve_free) $article_approve_free_checked = "checked";

	setting_get("article_approve_updated", $article_approve_updated);
	if ($article_approve_updated) $article_approve_updated_checked = "checked";

	setting_get("new_article_email", $new_article_email);
	if ($new_article_email) $new_article_email_checked = "checked";

	setting_get("update_article_email", $update_article_email);
	if ($update_article_email) $update_article_email_checked = "checked";

	setting_get("classified_approve_paid", $classified_approve_paid);
	if ($classified_approve_paid) $classified_approve_paid_checked = "checked";

	setting_get("classified_approve_free", $classified_approve_free);
	if ($classified_approve_free) $classified_approve_free_checked = "checked";

	setting_get("classified_approve_updated", $classified_approve_updated);
	if ($classified_approve_updated) $classified_approve_updated_checked = "checked";

	setting_get("new_classified_email", $new_classified_email);
	if ($new_classified_email) $new_classified_email_checked = "checked";

	setting_get("update_classified_email", $update_classified_email);
	if ($update_classified_email) $update_classified_email_checked = "checked";

	setting_get("event_approve_paid", $event_approve_paid);
	if ($event_approve_paid) $event_approve_paid_checked = "checked";

	setting_get("event_approve_free", $event_approve_free);
	if ($event_approve_free) $event_approve_free_checked = "checked";

	setting_get("event_approve_updated", $event_approve_updated);
	if ($event_approve_updated) $event_approve_updated_checked = "checked";

	setting_get("new_event_email", $new_event_email);
	if ($new_event_email) $new_event_email_checked = "checked";

	setting_get("update_event_email", $update_event_email);
	if ($update_event_email) $update_event_email_checked = "checked";

	setting_get("banner_approve_paid", $banner_approve_paid);
	if ($banner_approve_paid) $banner_approve_paid_checked = "checked";

	setting_get("banner_approve_free", $banner_approve_free);
	if ($banner_approve_free) $banner_approve_free_checked = "checked";

	setting_get("banner_approve_updated", $banner_approve_updated);
	if ($banner_approve_updated) $banner_approve_updated_checked = "checked";

	setting_get("new_banner_email", $new_banner_email);
	if ($new_banner_email) $new_banner_email_checked = "checked";

	setting_get("update_banner_email", $update_banner_email);
	if ($update_banner_email) $update_banner_email_checked = "checked";
	
?>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_APPROVAL))?></h1>
		</div>
	</div>
	
	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
	
			<p><strong><?=system_showText(LANG_SITEMGR_APPROVE_CONFIGURE_MSG1);?></strong></p>
			<p><?=system_showText(LANG_SITEMGR_APPROVE_CONFIGURE_MSG2);?> <?=system_showText(LANG_SITEMGR_APPROVE_CONFIGURE_MSG3);?></p><br />
			<p><?=system_showText(LANG_SITEMGR_APPROVE_CONFIGURE_MSG4);?></p>
			
			<form class="default-form" name="approvalrequirement" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				<? include(INCLUDES_DIR."/forms/form_approvalrequirement.php"); ?>
                	<span class="clear"></span>
					<button type="submit" name="approvalrequirement" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
			</form>

		</div>

	</div>

</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
