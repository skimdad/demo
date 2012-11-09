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
	# * FILE: /sitemgr/prefs/levels.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # VALIDATE FEATURE
    # ----------------------------------------------------------------------------------------------------
    if (ABLE_RENAME_LEVEL != "on") { exit; }
    
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
	if (!isset($activeLevel)) system_setFreqActions('prefs_managelevel','prefslevels');
    
	// Default CSS class for message
	$message_style = "successMessage";

    setting_get('review_listing_enabled', $review_listing_enabled);

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		// Listing Level Names
		if($_POST["listinglevelnames"]) {

			if (validate_form("listinglevelnames", $_POST, $error)) {

                $levelObj = new ListingLevel(EDIR_DEFAULT_LANGUAGE, true);
				$levelsArray = $levelObj->getLevelValues();
                foreach ($levelsArray as $levelValue) {

                    if(!isset($nameLevel[$levelValue])) { $nameLevel[$levelValue] = ""; }
                    if(!isset($activeLevel[$levelValue])) { $activeLevel[$levelValue] = "n"; }
                    if(!isset($hasPromotion[$levelValue])) { $hasPromotion[$levelValue] = "n"; } else { $hasPromotionCheck = true; }
                    if(!isset($hasReview[$levelValue])) { $hasReview[$levelValue] = "n"; }
                    //TODO: MavenCrew - pass hasmobileApp parameter
                    $levelObj->updateValues(string_strtolower($nameLevel[$levelValue]),
					 $activeLevel[$levelValue],
					  ($_POST["activeLevel"][$levelValue] == 'y' ? $hasPromotion[$levelValue] : 'n'), 
					  ($_POST["activeLevel"][$levelValue] == 'y' ? $hasReview[$levelValue] : 'n'), 
					  ($_POST["activeLevel"][$levelValue] == 'y' ? $hasSms[$levelValue] : 'n'), 
					  ($_POST["activeLevel"][$levelValue] == 'y' ? $hasCall[$levelValue] : 'n'), 
					  ($_POST["activeLevel"][$levelValue] == 'y' ? $hasMobileApp[$levelValue] : 'n') , 
					  ($_POST["activeLevel"][$levelValue] == 'y' ? $backlink[$levelValue] : 'n'), $levelValue);
                }
			
				if ($hasPromotionCheck){
					if(!setting_set("custom_has_promotion", "on")) {
						if(!setting_new("custom_has_promotion", "on")) {
							$error = true;
						}
					}
				} else {
					if(!setting_set("custom_has_promotion", "")) {
						if(!setting_new("custom_has_promotion", "")) {
							$error = true;
						}
					}
				}

			} else {
                $actions[] = $error;
                $message_style = "errorMessage";
			}
            
            if (!$error) {
                header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/levels.php?message=0&levelModule=listing#link");
                exit;
            } else {
                $message_style = "errorMessage";
            }

            if($actions) {
                $message_listinglevelnames = implode('<br />', $actions);
            }

		}

		// Event Level Names
		else if($_POST["eventlevelnames"]) {

            if (validate_form("eventlevelnames", $_POST, $error)) {

                $levelObj = new EventLevel(EDIR_DEFAULT_LANGUAGE, true);
                $levelsArray = $levelObj->getLevelValues();
                foreach ($levelsArray as $levelValue) {

                    if(!isset($nameLevel[$levelValue])) { $nameLevel[$levelValue] = ""; }
                    if(!isset($activeLevel[$levelValue])) { $activeLevel[$levelValue] = "n"; }

                    $levelObj->updateValues(string_strtolower($nameLevel[$levelValue]), $activeLevel[$levelValue], $levelValue);
                }

            } else {
                $actions[] = $error;
                $message_style = "errorMessage";
            }
            
            if (!$error) {
                header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/levels.php?message=0&levelModule=event#link");
                exit;
            } else {
                $message_style = "errorMessage";
            }

            if($actions) {
                $message_eventlevelnames .= implode('<br />', $actions);
            }

        }

		// Banner Level Names
		else if($_POST["bannerlevelnames"]) {

            if (validate_form("bannerlevelnames", $_POST, $error)) {

                $levelObj = new BannerLevel(EDIR_DEFAULT_LANGUAGE, true);
                $levelsArray = $levelObj->getLevelValues();
                foreach ($levelsArray as $levelValue) {

                    if(!isset($nameLevel[$levelValue])) { $nameLevel[$levelValue] = ""; }
                    if(!isset($activeLevel[$levelValue])) { $activeLevel[$levelValue] = "n"; }

                    $levelObj->updateValues(string_strtolower($nameLevel[$levelValue]), $activeLevel[$levelValue], $levelValue);
                }

            } else {
                $actions[] = $error;
                $message_style = "errorMessage";
            }

            if (!$error) {
                 header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/levels.php?message=0&levelModule=banner#link");
                exit;
            } else {
                $message_style = "errorMessage";
            }

            if($actions) {
                $message_bannerlevelnames .= implode('<br />', $actions);
            }
            
        }

		// Classified Level Names
        else if($_POST["classifiedlevelnames"]) {

            if (validate_form("classifiedlevelnames", $_POST, $error)) {

                $levelObj = new ClassifiedLevel(EDIR_DEFAULT_LANGUAGE, true);
                $levelsArray = $levelObj->getLevelValues();
                foreach ($levelsArray as $levelValue) {

                    if(!isset($nameLevel[$levelValue])) { $nameLevel[$levelValue] = ""; }
                    if(!isset($activeLevel[$levelValue])) { $activeLevel[$levelValue] = "n"; }

                    $levelObj->updateValues(string_strtolower($nameLevel[$levelValue]), $activeLevel[$levelValue], $levelValue);
                }

            } else {
                $actions[] = $error;
                $message_style = "errorMessage";
            }

            if (!$error) {
                 header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/levels.php?message=0&levelModule=classified#link");
                exit;
            } else {
                $message_style = "errorMessage";
            }

            if($actions) {
                $message_classifiedlevelnames .= implode('<br />', $actions);
            }

        }


		// Article Level Names
        else if($_POST["articlelevelnames"]) {

            if (validate_form("articlelevelnames", $_POST, $error)) {

                $levelObj = new ArticleLevel(EDIR_DEFAULT_LANGUAGE, true);
                $levelsArray = $levelObj->getLevelValues();
                foreach ($levelsArray as $levelValue) {

                    if(!isset($nameLevel[$levelValue])) { $nameLevel[$levelValue] = ""; }
                    if(!isset($activeLevel[$levelValue])) { $activeLevel[$levelValue] = "n"; }

                    $levelObj->updateValues(string_strtolower($nameLevel[$levelValue]), $activeLevel[$levelValue], $levelValue);
                }

            } else {
                $actions[] = $error;
                $message_style = "errorMessage";
            }

            if (!$error) {
                 header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/levels.php?message=0&levelModule=article#link");
                exit;
            } else {
                $message_style = "errorMessage";
            }

            if($actions) {
                $message_articlelevelnames .= implode('<br />', $actions);
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

?>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=ucfirst(system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS))?> - <?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_LEVELS))?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
			
			<br />
            
            <p class="informationMessage">
                <?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_TIP1)?>
            </p>

			<? $module = "listing"; ?>
            <form name="<?=$module;?>levelnames" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>#link" method="post">
				<? include(INCLUDES_DIR."/forms/form_levelname.php"); ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="<?=$module;?>levelnames" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
						</td>
					</tr>
				</table>
			</form>

            <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
                <? $module = "event"; ?>
                <form name="<?=$module;?>levelnames" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>#link" method="post">
                    <? include(INCLUDES_DIR."/forms/form_levelname.php"); ?>
                    <table style="margin: 0 auto 0 auto;">
                        <tr>
                            <td>
                                <button type="submit" name="<?=$module;?>levelnames" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                            </td>
                        </tr>
                    </table>
                </form>
            <? } ?>

            <? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") { ?>
                <? $module = "banner"; ?>
                <form name="<?=$module;?>levelnames" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>#link" method="post">
                    <? include(INCLUDES_DIR."/forms/form_levelname.php"); ?>
                    <table style="margin: 0 auto 0 auto;">
                        <tr>
                            <td>
                                <button type="submit" name="<?=$module;?>levelnames" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                            </td>
                        </tr>
                    </table>
                </form>
            <? } ?>
            
            <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
                <? $module = "classified"; ?>
                <form name="<?=$module;?>levelnames" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>#link" method="post">
                    <? include(INCLUDES_DIR."/forms/form_levelname.php"); ?>
                    <table style="margin: 0 auto 0 auto;">
                        <tr>
                            <td>
                                <button type="submit" name="<?=$module;?>levelnames" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                            </td>
                        </tr>
                    </table>
                </form>
            <? } ?>
            
            <? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
                <? $module = "article"; ?>
                <form name="<?=$module;?>levelnames" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>#link" method="post">
                    <? include(INCLUDES_DIR."/forms/form_levelname.php"); ?>
                    <table style="margin: 0 auto 0 auto;">
                        <tr>
                            <td>
                                <button type="submit" name="<?=$module;?>levelnames" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
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

<script type="text/javascript">
	function disableLevelField (from, level) {
		var check = $('#check_' + from + "_" + level).attr('checked');
		if (check == true) {
			$('#text_' + from + "_" + level).attr("readonly", "");
		} else {
			$('#text_' + from + "_" + level).attr("readonly", "readonly");
		}
	}
</script>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>