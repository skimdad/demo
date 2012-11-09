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
	# * FILE: /sitemgr/prefs/deal.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	$promoLevelListing = new ListingLevel();
	$levels_all = $promoLevelListing->getLevelValues();
	foreach ($levels_all as $level_each) {
		if ( $promoLevelListing->getHasPromotion($level_each) == 'y' ) $hasPromotion = true;
	}
	if ( PROMOTION_FEATURE != 'on' ) exit;
	elseif ( !$hasPromotion ) exit;
	
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
	if (!isset($promotion_default_conditions)) system_setFreqActions('prefs_promotion','prefspromotion');
	
	// Default CSS class for message
	$message_style = "successMessage";

	$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
	$num_languages = count(explode(",", EDIR_LANGUAGENAMES));
	$language_numbers = explode(",", EDIR_LANGUAGENUMBERS);
	$edir_languages = explode(",", EDIR_LANGUAGES);
	$labelsuffix = "";
				
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		
		if ($promotion_force_redeem_by_facebook>0){
			 if (!setting_set("promotion_force_redeem_by_facebook", $promotion_force_redeem_by_facebook))
				if (!setting_new("promotion_force_redeem_by_facebook", $promotion_force_redeem_by_facebook))
					$error = true;
		}else{
		   if (!setting_set("promotion_force_redeem_by_facebook", 0))
				if (!setting_new("promotion_force_redeem_by_facebook", 0))
					$error = true;
		}

		foreach ($language_numbers as $k=>$i) {
			$promVar="promotion_default_conditions".$i;
			$promotion_default_conditions=$$promVar;

			if(!customtext_set("promotion_default_conditions", $promotion_default_conditions, $edir_languages[$k])) {
				if(!customtext_new("promotion_default_conditions", $promotion_default_conditions, $edir_languages[$k])) {
					$error = true;
				}
			}
		}

		if (!$error) {
			$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_PROMOTION_CONFIGURATIONWASCHANGED);
		} else {
			$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
			$message_style = "errorMessage";
		}
		if($actions) {
			$message_promotion_conditions .= implode("<br />", $actions);
		}
	}

    setting_get("promotion_force_redeem_by_facebook", $promotion_force_redeem_by_facebook);
    setting_get("promotion_associated_listing_noowner", $promotion_associated_listing_noowner);

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

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
			<h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=string_ucwords(system_showText(LANG_SITEMGR_PROMOTION_PLURAL))?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<br />
			
			<?if (CUSTOM_PROMOTION_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>
			<form name="promotion_conditions" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				<? include(INCLUDES_DIR."/forms/form_promotion_conditions.php"); ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="promotion_conditions" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
						</td>
					</tr>
				</table>
			</form>
			<? } ?>
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
