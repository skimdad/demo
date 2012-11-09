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
	# * FILE: /sitemgr/prefs/theme.php
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

	$filethemeConfigPath    = EDIRECTORY_ROOT.'/custom/domain_'.$_POST["domain_id"].'/theme/theme.inc.php';
	$folderthemesPath       = EDIRECTORY_ROOT.'/theme';

	// Default CSS class for message
	$message_style = "successMessage";

	if (($_SERVER['REQUEST_METHOD'] == "POST") && (!DEMO_LIVE_MODE)) {

		if ($select_theme) {
			$status = 'success';

			$src = EDIRECTORY_ROOT."/theme/$select_theme";
			$dst = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/theme/".$select_theme;
			if (!is_dir($dst)){
				$domain = new Domain(SELECTED_DOMAIN_ID);
				$domain->copyThemeToDomain($src, $dst);
			} 

			if (!$filethemeConfig = fopen($filethemeConfigPath, 'w+')) {
				$status = 'error';

			} else {
				                
                if (CACHE_PARTIAL_FEATURE == "on"){
                    cachepartial_removecache('footer');
                }

                if (CACHE_FULL_FEATURE == "on"){
                    cachefull_forceExpiration();
                }

				$buffer  = "<?php".PHP_EOL."\$edir_theme=\"$select_theme\";".PHP_EOL;

				if (!fwrite($filethemeConfig, $buffer, strlen($buffer))) {
					$status = 'error';
				}

                if ($select_theme == EDIR_THEME){
                    $auxCurValues = unserialize(EDIR_CURR_SCHEME_VALUES);

                    $array["colorBackground"] = $auxCurValues[$scheme]["colorBackground"];
                    $array["colorContentBackground"] = $auxCurValues[$scheme]["colorContentBackground"];
                    $array["colorMainContent"] = $auxCurValues[$scheme]["colorMainContent"];
                    $array["colorSlider"] = $auxCurValues[$scheme]["colorSlider"];
                    $array["colorTitle"] = $auxCurValues[$scheme]["colorTitle"];
                    $array["colorTitleBorder"] = $auxCurValues[$scheme]["colorTitleBorder"];
                    $array["colorText"] = $auxCurValues[$scheme]["colorText"];
                    $array["colorLink"] = $auxCurValues[$scheme]["colorLink"];
                    $array["colorUserNavbar"] = $auxCurValues[$scheme]["colorUserNavbar"];
                    $array["colorUserNavbarText"] = $auxCurValues[$scheme]["colorUserNavbarText"];
                    $array["colorUserNavbarLink"] = $auxCurValues[$scheme]["colorUserNavbarLink"];
                    $array["colorNavbar"] = $auxCurValues[$scheme]["colorNavbar"];
                    $array["colorNavbarLink"] = $auxCurValues[$scheme]["colorNavbarLink"];
                    $array["colorNavbarLinkActive"] = $auxCurValues[$scheme]["colorNavbarLinkActive"];
                    $array["colorFooter"] = $auxCurValues[$scheme]["colorFooter"];
                    $array["colorFooterText"] = $auxCurValues[$scheme]["colorFooterText"];
                    $array["colorFooterLink"] = $auxCurValues[$scheme]["colorFooterLink"];
                    $array["alignOption"] = $auxCurValues[$scheme]["alignOption"];
                    $array["repeatOption"] = $auxCurValues[$scheme]["repeatOption"];
                    $array["fontOption"] = $auxCurValues[$scheme]["fontOption"];
                    $array["backgroundimage"] = $auxCurValues[$scheme]["backgroundimage"];

                    colorscheme_themeSchemeFile($array, $scheme, $select_theme, $scheme, $status);
                } else {
                   @include_once(EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/theme/'.$select_theme.'_scheme.inc.php'); 
                   $scheme = $edir_scheme;
                }
                
                if ($scheme != "custom"){

                    setting_get("scheme_".$scheme."_customized", $aux_value);

                    if(!setting_set("scheme_custom", $aux_value)) {
                        if(!setting_new("scheme_custom", $aux_value)) {
                            $error = true;
                        }
                    }

                    if ($aux_value){
                        if(!setting_set("scheme_updatefile", "on")) {
                            if(!setting_new("scheme_updatefile", "on")) {
                                $error = true;
                            }
                        }
                    }

                } else {
                    if(!setting_set("scheme_custom", "on")) {
                        if(!setting_new("scheme_custom", "on")) {
                            $error = true;
                        }
                    }
                    if(!setting_set("scheme_updatefile", "on")) {
                        if(!setting_new("scheme_updatefile", "on")) {
                            $error = true;
                        }
                    }	
                }
			}

		} else {
			$status = 'error';
		}

		header("Location: ".DEFAULT_URL."/sitemgr/prefs/theme.php?status=$status");
		exit;
	}

	//increases frequently actions
	if (!isset($status)) system_setFreqActions('prefs_theme','prefstheme');

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	unset($folders);
	$folderthemes = opendir($folderthemesPath);
	$folders = array();
	while ($folder = readdir($folderthemes)) {
		if ($folder != 'sample' && $folder != '.' && $folder != '..') {
			$folders[] = $folder;
		}
	}
	unset($valuesArray);
	unset($namesArray);

	$_valuesArray = explode(',', EDIR_THEMES);
	$_namesArray  = explode(',', EDIR_THEMENAMES);
	for ($i=0;$i<count($_valuesArray);$i++) {
		if (in_array($_valuesArray[$i], $folders)) {
			if ($_namesArray[$i]) {
				$valuesArray[] = $_valuesArray[$i];
				$namesArray[]  = $_namesArray[$i];
			}
		}
	}

	$edir_theme = EDIR_THEME == '' ? 'edirectory' : EDIR_THEME;

	$selectthemes = html_selectBox('select_theme', $namesArray, $valuesArray, $edir_theme, "style=\"width:220px;\" onchange=\"JS_submit();\"", '', '', (!DEMO_LIVE_MODE ? false : true));

	//Messages
	if ($status == 'success') {
		$message = system_showText(LANG_SITEMGR_SETTINGS_THEMES_THEMEWASCHANGED);
		$message_style = 'successMessage';
	} else if ($status == 'failed') {
		$message = system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
		$message_style = 'errorMessage';
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
				<h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=system_showText(LANG_SITEMGR_MENU_THEMES)?></h1>
			</div>
		</div>

		<div id="content-content">
			<div class="default-margin">

				<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
				<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
				<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>		

				<br />

				<form name="theme" id="theme" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
					<? include(INCLUDES_DIR."/forms/form_themesettings.php"); ?>
					<input type="hidden" name="domain_id" value="<?=SELECTED_DOMAIN_ID?>" />
					<input type="hidden" name="scheme" id="scheme" value="<?=EDIR_SCHEME?>" />
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
