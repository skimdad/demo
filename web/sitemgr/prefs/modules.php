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
	# * FILE: /sitemgr/prefs/modules.php
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
	if (!isset($actions)) system_setFreqActions('prefs_modules', 'modules');

	// Default CSS class for message
	$message_style = "successMessage";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($modules_options) {
            
            if (ARTICLE_FEATURE == "on") {               
                if(!setting_set("custom_article_feature", $check_article_feature)) {
                    if(!setting_new("custom_article_feature", $check_article_feature)) {
                        $error = true;
                    }
                }
            }
            
            if (BANNER_FEATURE == "on") {
                if(!setting_set("custom_banner_feature", $check_banner_feature)) {
                    if(!setting_new("custom_banner_feature", $check_banner_feature)) {
                        $error = true;
                    }
                }
            }
            
            if (BLOG_FEATURE == "on") {
                if(!setting_set("custom_blog_feature", $check_blog_feature)) {
                    if(!setting_new("custom_blog_feature", $check_blog_feature)) {
                        $error = true;
                    }
                }
            }
            
            if (CLASSIFIED_FEATURE == "on") {
                if(!setting_set("custom_classified_feature", $check_classified_feature)) {
                    if(!setting_new("custom_classified_feature", $check_classified_feature)) {
                        $error = true;
                    }
                }
            }
            
            if (EVENT_FEATURE == "on") {
                if(!setting_set("custom_event_feature", $check_event_feature)) {
                    if(!setting_new("custom_event_feature", $check_event_feature)) {
                        $error = true;
                    }
                }
            }
            
            if (PROMOTION_FEATURE == "on") {
                if(!setting_set("custom_promotion_feature", $check_promotion_feature)) {
                    if(!setting_new("custom_promotion_feature", $check_promotion_feature)) {
                        $error = true;
                    }
                }
            }
			
			if (!$error) {
				header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/modules.php?message=success");
                exit;
			} else {
				$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
				$message_style = "errorMessage";
			}
			if($actions) {
				$message_modules_options .= implode("<br />", $actions);
			}
		}
	}
	
	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	setting_get("custom_article_feature", $check_article_feature);
	if ($check_article_feature) $custom_article_feature_checked = "checked";
    setting_get("custom_banner_feature", $check_banner_feature);
	if ($check_banner_feature) $custom_banner_feature_checked = "checked";
    setting_get("custom_blog_feature", $check_blog_feature);
	if ($check_blog_feature) $custom_blog_feature_checked = "checked";
    setting_get("custom_classified_feature", $check_classified_feature);
	if ($check_classified_feature) $custom_classified_feature_checked = "checked";
    setting_get("custom_event_feature", $check_event_feature);
	if ($check_event_feature) $custom_event_feature_checked = "checked";
    setting_get("custom_promotion_feature", $check_promotion_feature);
	if ($check_promotion_feature) $custom_promotion_feature_checked = "checked";
    
    if ($_GET["message"] == "success"){
        $message_modules_options = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_MODULES_CONFIGURATIONWASCHANGED);
    }
	

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
			<h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_MANAGE_MODULES))?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<form name="modules_options" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				<? include(INCLUDES_DIR."/forms/form_modules_options.php"); ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="modules_options" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
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
