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
	# * FILE: /sitemgr/prefs/featuredcategory.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");
	
	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (FEATURED_CATEGORY != "on") {        
        exit();
    }

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
	if (!isset($review_admin)) system_setFreqActions('prefs_featuredcategory','prefscategory');
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");
	
	// Default CSS class for message
	$message_style = "successMessage";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if(!setting_set("featuredcategory", $featuredcategory_enabled))
			$error = true;
		if(!setting_set("listing_featuredcategory", $listing_featuredcategory_enabled))
			$error = true;	
		if(!setting_set("event_featuredcategory", $event_featuredcategory_enabled))
			$error = true;	
		if(!setting_set("classified_featuredcategory", $classified_featuredcategory_enabled))
			$error = true;
		if(!setting_set("article_featuredcategory", $article_featuredcategory_enabled))
			$error = true;	
				

		if (!$error) {
			$message_featuredcategory_admin = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_FEATUREDCATEGORIES_CONFIGURATIONWASCHANGED);
		} else {
			$message_featuredcategory_admin = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
			$message_style = "errorMessage";
			
		}
		
		
	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	setting_get("featuredcategory", $featuredcategory);
	if ($featuredcategory=="on") $featuredcategory_enabled_checked = "checked";
	
	setting_get("listing_featuredcategory", $listing_featuredcategory);
	if ($listing_featuredcategory=="on") $listing_featuredcategory_enabled_checked = "checked";
	
	if (EVENT_FEATURE == 'on' && CUSTOM_EVENT_FEATURE == 'on') {
		setting_get("event_featuredcategory", $event_featuredcategory);
		if ($event_featuredcategory=="on") $event_featuredcategory_enabled_checked = "checked";
	}
	if (CLASSIFIED_FEATURE == 'on' && CUSTOM_CLASSIFIED_FEATURE == 'on') {
		setting_get("classified_featuredcategory", $classified_featuredcategory);
		if ($classified_featuredcategory=="on") $classified_featuredcategory_enabled_checked = "checked";
	}
	if (ARTICLE_FEATURE == 'on' && CUSTOM_ARTICLE_FEATURE == 'on') {
		setting_get("article_featuredcategory", $article_featuredcategory);
		if ($article_featuredcategory=="on") $article_featuredcategory_enabled_checked = "checked";
	}	
	

?>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=system_showText(LANG_SITEMGR_FEATUREDCATEGORY_PLURAL )?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<br />
			<div class="tip-base">
				<p style="text-align: justify;">
					<a href="<?=DEFAULT_URL;?>/sitemgr/faq/faq.php?keyword=<?=urlencode("featured");?>" target="_blank"><?=system_showText(LANG_SITEMGR_FEATUREDCATEGORIES_TIP)?></a>
				</p>
			</div>

			<form name="review_admin" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				<? include(INCLUDES_DIR."/forms/form_featuredcategory_admin.php"); ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="review_admin" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
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
