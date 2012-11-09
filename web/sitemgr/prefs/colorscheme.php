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
	# * FILE: /sitemgr/prefs/colorscheme.php
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
	
	unset($array);

	// Default CSS class for message
	$message_style = "successMessage";
	
	if ($_SERVER['REQUEST_METHOD'] != "POST" && (!$_GET["theme"] || !$_GET["label"])){
		header("Location: ".DEFAULT_URL."/sitemgr/prefs/theme.php");
		exit;
	}
	
	$themes = explode(",", EDIR_THEMES);
	$schemesnames = explode(",", EDIR_SCHEMENAMES);
	
	if (!in_array($theme, $themes) || !in_array($label, $schemesnames) || !($scheme) || $theme=="realestate"){
		header("Location: ".DEFAULT_URL."/sitemgr/prefs/theme.php");
		exit;
	}

	if (($_SERVER['REQUEST_METHOD'] == "POST") && (!DEMO_LIVE_MODE)) {
	
		if ($action == "submit"){

			$array["colorBackground"] = $colorBackground;
			$array["colorContentBackground"] = $colorContentBackground;
			$array["colorMainContent"] = $colorMainContent;
			$array["colorSlider"] = $colorSlider;
			$array["colorTitle"] = $colorTitle;
			$array["colorTitleBorder"] = $colorTitleBorder;
			$array["colorText"] = $colorText;
			$array["colorLink"] = $colorLink;
			$array["colorUserNavbar"] = $colorUserNavbar;
			$array["colorUserNavbarText"] = $colorUserNavbarText;
			$array["colorUserNavbarLink"] = $colorUserNavbarLink;
			$array["colorNavbar"] = $colorNavbar;
			$array["colorNavbarLink"] = $colorNavbarLink;
			$array["colorNavbarLinkActive"] = $colorNavbarLinkActive;
			$array["colorFooter"] = $colorFooter;
			$array["colorFooterText"] = $colorFooterText;
			$array["colorFooterLink"] = $colorFooterLink;
			$array["alignOption"] = $align;
			$array["repeatOption"] = $repeat;
			$array["fontOption"] = $font;
			$array["backgroundimage"] = $aux_imageID;
			$errorMessage = "";

			//Clean Image
			if ($remove_image) {
				$old_image_id = $aux_imageID;
				if (is_numeric($old_image_id)){
					if ($idm = $old_image_id) {
						$image = new Image($idm);
						if ($image) $image->Delete();
					}
				}
				$array["backgroundimage"] = 0;
				$image_id = 0;
			}
			
			if (($colorBackground == "SCHEME_EMPTY" || !$align || !$repeat) && $aux_imageID && !$remove_image){
				if ($colorBackground == "SCHEME_EMPTY"){
					$errorMessage .= system_showText(LANG_SITEMGR_COLOR_ERROR1)."<br />";
				} 
				if (!$align){
					$errorMessage .= system_showText(LANG_SITEMGR_COLOR_ERROR2)."<br />";
				} 
				if (!$repeat){
					$errorMessage .= system_showText(LANG_SITEMGR_COLOR_ERROR3)."<br />";
				}
			}

			/****************************************************************************
			* Background Image upload
			****************************************************************************/
			if ($_FILES["background_image"] && $_FILES["background_image"]["error"] == 0 && !$errorMessage){

				if ($colorBackground != "SCHEME_EMPTY" && $align && $repeat){
					if (validate_ImageforTheme($_FILES["background_image"]["tmp_name"], $_FILES['background_image']['type'], $_FILES["background_image"]["size"], $error)){

						$imageObj = image_upload($_FILES["background_image"]["tmp_name"], "", "", 'sitemgr_', false, false);
						if($imageObj){

							$old_image_id = $aux_imageID;
							if (is_numeric($old_image_id)){
								if ($old_image_id){
									$imageObjAux = new Image($old_image_id);
									$imageObjAux->delete();
									unset($imageObjAux);
								}
							}
							$image_id = $imageObj->getNumber("id");
							unset($imageObj);
							$array["backgroundimage"] = $image_id;

						} else {
							$errorMessage = system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
						}
					} else {
						$errorMessage = system_showText($error);
					}
				} else {
					if ($colorBackground == "SCHEME_EMPTY"){
						$errorMessage .= system_showText(LANG_SITEMGR_COLOR_ERROR1)."<br />";
					} 
					if (!$align){
						$errorMessage .= system_showText(LANG_SITEMGR_COLOR_ERROR2)."<br />";
					} 
					if (!$repeat){
						$errorMessage .= system_showText(LANG_SITEMGR_COLOR_ERROR3)."<br />";
					}
				}
			}

			if (!$errorMessage){
				colorscheme_themeSchemeFile($array, $scheme, EDIR_THEME, ($aux_action ? $scheme : EDIR_SCHEME), $status);
				colorscheme_generateDealImages($array, $scheme, EDIR_THEME);
				colorscheme_generateMenuImage($array, $scheme, EDIR_THEME);
				colorscheme_generateMarkerImage($array, $scheme, EDIR_THEME);

				if ($scheme == EDIR_SCHEME || $aux_action){
					if(!setting_set("scheme_updatefile", "on")) {
						if(!setting_new("scheme_updatefile", "on")) {
							$error = true;
						}
					}
				}

				if(!setting_set("scheme_custom", "on")) {
					if(!setting_new("scheme_custom", "on")) {
						$error = true;
					}
				}
				
				if(!setting_set("scheme_".$scheme."_customized", "on")) {
					if(!setting_new("scheme_".$scheme."_customized", "on")) {
						$error = true;
					}
				}
				
				if(!setting_set("scheme_change_images", ($change_images == "on" ? "on" : "off"))) {
					if(!setting_new("scheme_change_images", ($change_images == "on" ? "on" : "off"))) {
						$error = true;
					}
				}

				$successMessage = system_showText(LANG_SITEMGR_COLOR_SAVED);
			}
		} elseif ($action == "reset") {
			
			$arrayDefault = unserialize(ARRAY_DEFAULT_COLORS);
			$arrayCurValues = unserialize(EDIR_CURR_SCHEME_VALUES);
			
			$array["colorBackground"] = $arrayDefault[$theme][$scheme]["colorBackground"] ? $arrayDefault[$theme][$scheme]["colorBackground"] : "SCHEME_EMPTY";
			$colorBackground = $arrayDefault[$theme][$scheme]["colorBackground"] ? $arrayDefault[$theme][$scheme]["colorBackground"] : false;
			
			$array["colorContentBackground"] = $arrayDefault[$theme][$scheme]["colorContentBackground"] ? $arrayDefault[$theme][$scheme]["colorContentBackground"] : "SCHEME_EMPTY";
			$colorContentBackground = $arrayDefault[$theme][$scheme]["colorContentBackground"] ? $arrayDefault[$theme][$scheme]["colorContentBackground"] : false;
			
			$array["colorMainContent"] = $arrayDefault[$theme][$scheme]["colorMainContent"] ? $arrayDefault[$theme][$scheme]["colorMainContent"] : "SCHEME_EMPTY";
			$colorMainContent = $arrayDefault[$theme][$scheme]["colorMainContent"] ? $arrayDefault[$theme][$scheme]["colorMainContent"] : false;
			
			$array["colorSlider"] = $arrayDefault[$theme][$scheme]["colorSlider"] ? $arrayDefault[$theme][$scheme]["colorSlider"] : "SCHEME_EMPTY";
			$colorSlider = $arrayDefault[$theme][$scheme]["colorSlider"] ? $arrayDefault[$theme][$scheme]["colorSlider"] : false;
			
			$array["colorTitle"] = $arrayDefault[$theme][$scheme]["colorTitle"] ? $arrayDefault[$theme][$scheme]["colorTitle"] : "SCHEME_EMPTY";
			$colorTitle = $arrayDefault[$theme][$scheme]["colorTitle"] ? $arrayDefault[$theme][$scheme]["colorTitle"] : false;
			
			$array["colorTitleBorder"] = $arrayDefault[$theme][$scheme]["colorTitleBorder"] ? $arrayDefault[$theme][$scheme]["colorTitleBorder"] : "SCHEME_EMPTY";
			$colorTitleBorder = $arrayDefault[$theme][$scheme]["colorTitleBorder"] ? $arrayDefault[$theme][$scheme]["colorTitleBorder"] : false;
			
			$array["colorText"] = $arrayDefault[$theme][$scheme]["colorText"] ? $arrayDefault[$theme][$scheme]["colorText"] : "SCHEME_EMPTY";
			$colorText = $arrayDefault[$theme][$scheme]["colorText"] ? $arrayDefault[$theme][$scheme]["colorText"] : false;
			
			$array["colorLink"] = $arrayDefault[$theme][$scheme]["colorLink"] ? $arrayDefault[$theme][$scheme]["colorLink"] : "SCHEME_EMPTY";
			$colorLink = $arrayDefault[$theme][$scheme]["colorLink"] ? $arrayDefault[$theme][$scheme]["colorLink"] : false;
			
			$array["colorUserNavbar"] = $arrayDefault[$theme][$scheme]["colorUserNavbar"] ? $arrayDefault[$theme][$scheme]["colorUserNavbar"] : "SCHEME_EMPTY";
			$colorUserNavbar = $arrayDefault[$theme][$scheme]["colorUserNavbar"] ? $arrayDefault[$theme][$scheme]["colorUserNavbar"] : false;
			
			$array["colorUserNavbarText"] = $arrayDefault[$theme][$scheme]["colorUserNavbarText"] ? $arrayDefault[$theme][$scheme]["colorUserNavbarText"] : "SCHEME_EMPTY";
			$colorUserNavbarText = $arrayDefault[$theme][$scheme]["colorUserNavbarText"] ? $arrayDefault[$theme][$scheme]["colorUserNavbarText"] : false;
			
			$array["colorUserNavbarLink"] = $arrayDefault[$theme][$scheme]["colorUserNavbarLink"] ? $arrayDefault[$theme][$scheme]["colorUserNavbarLink"] : "SCHEME_EMPTY";
			$colorUserNavbarLink = $arrayDefault[$theme][$scheme]["colorUserNavbarLink"] ? $arrayDefault[$theme][$scheme]["colorUserNavbarLink"] : false;
			
			$array["colorNavbar"] = $arrayDefault[$theme][$scheme]["colorNavbar"] ? $arrayDefault[$theme][$scheme]["colorNavbar"] : "SCHEME_EMPTY";
			$colorNavbar = $arrayDefault[$theme][$scheme]["colorNavbar"] ? $arrayDefault[$theme][$scheme]["colorNavbar"] : false;
			
			$array["colorNavbarLink"] = $arrayDefault[$theme][$scheme]["colorNavbarLink"] ? $arrayDefault[$theme][$scheme]["colorNavbarLink"] : "SCHEME_EMPTY";
			$colorNavbarLink = $arrayDefault[$theme][$scheme]["colorNavbarLink"] ? $arrayDefault[$theme][$scheme]["colorNavbarLink"] : false;
			
			$array["colorNavbarLinkActive"] = $arrayDefault[$theme][$scheme]["colorNavbarLinkActive"] ? $arrayDefault[$theme][$scheme]["colorNavbarLinkActive"] : "SCHEME_EMPTY";
			$colorNavbarLinkActive = $arrayDefault[$theme][$scheme]["colorNavbarLinkActive"] ? $arrayDefault[$theme][$scheme]["colorNavbarLinkActive"] : false;
			
			$array["colorFooter"] = $arrayDefault[$theme][$scheme]["colorFooter"] ? $arrayDefault[$theme][$scheme]["colorFooter"] : "SCHEME_EMPTY";
			$colorFooter = $arrayDefault[$theme][$scheme]["colorFooter"] ? $arrayDefault[$theme][$scheme]["colorFooter"] : false;
			
			$array["colorFooterText"] = $arrayDefault[$theme][$scheme]["colorFooterText"] ? $arrayDefault[$theme][$scheme]["colorFooterText"] : "SCHEME_EMPTY";
			$colorFooterText = $arrayDefault[$theme][$scheme]["colorFooterText"] ? $arrayDefault[$theme][$scheme]["colorFooterText"] : false;
			
			$array["colorFooterLink"] = $arrayDefault[$theme][$scheme]["colorFooterLink"] ? $arrayDefault[$theme][$scheme]["colorFooterLink"] : "SCHEME_EMPTY";
			$colorFooterLink = $arrayDefault[$theme][$scheme]["colorFooterLink"] ? $arrayDefault[$theme][$scheme]["colorFooterLink"] : false;
			
			$array["alignOption"] = "SCHEME_EMPTY";
			$align = "";
			
			$array["repeatOption"] = "SCHEME_EMPTY";
			$repeat = "";
			$font = 1;
			
			$oldImage_id = $arrayCurValues[$scheme]["backgroundimage"];
			if ($oldImage_id && is_numeric($oldImage_id)){
				$imageObj = new Image($oldImage_id);
				$imageObj->Delete();
			}
			
			$image_id = 0;
			$restore = true;
			
			$array["fontOption"] = $arrayDefault[$theme][$scheme]["fontOption"] ? $arrayDefault[$theme][$scheme]["fontOption"] : "SCHEME_EMPTY";
			$array["backgroundimage"] = 0;
			colorscheme_themeSchemeFile($array, $scheme, EDIR_THEME, EDIR_SCHEME, $status);
			
			if(!setting_set("scheme_custom", "off")) {
				if(!setting_new("scheme_custom", "off")) {
					$error = true;
				}
			}
			
			if(!setting_set("scheme_".$scheme."_customized", "off")) {
				if(!setting_new("scheme_".$scheme."_customized", "off")) {
					$error = true;
				}
			}
			
			if(!setting_set("scheme_change_images", "off")) {
				if(!setting_new("scheme_change_images", "off")) {
					$error = true;
				}
			}

			$successMessage = system_showText(LANG_SITEMGR_COLOR_SAVED);
			
		}
	}
	
	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] != "POST"){
		
		if (!DEMO_LIVE_MODE){
			$arrayCurValues = unserialize(EDIR_CURR_SCHEME_VALUES);
		} else {
			$arrayDefault = unserialize(ARRAY_DEFAULT_COLORS);
			$arrayCurValues = $arrayDefault[$theme];
		}
			
		$colorBackground = $arrayCurValues[$scheme]["colorBackground"];
		$colorContentBackground = $arrayCurValues[$scheme]["colorContentBackground"];
		$colorMainContent = $arrayCurValues[$scheme]["colorMainContent"];
		$colorSlider = $arrayCurValues[$scheme]["colorSlider"];
		$colorTitle = $arrayCurValues[$scheme]["colorTitle"];
		$colorTitleBorder = $arrayCurValues[$scheme]["colorTitleBorder"];
		$colorText = $arrayCurValues[$scheme]["colorText"];
		$colorLink = $arrayCurValues[$scheme]["colorLink"];
		$colorUserNavbar = $arrayCurValues[$scheme]["colorUserNavbar"];
		$colorUserNavbarText = $arrayCurValues[$scheme]["colorUserNavbarText"];
		$colorUserNavbarLink = $arrayCurValues[$scheme]["colorUserNavbarLink"];
		$colorNavbar = $arrayCurValues[$scheme]["colorNavbar"];
		$colorNavbarLink = $arrayCurValues[$scheme]["colorNavbarLink"];
		$colorNavbarLinkActive = $arrayCurValues[$scheme]["colorNavbarLinkActive"];
		$colorFooter = $arrayCurValues[$scheme]["colorFooter"];
		$colorFooterText = $arrayCurValues[$scheme]["colorFooterText"];
		$colorFooterLink = $arrayCurValues[$scheme]["colorFooterLink"];
		$fontOption = $arrayCurValues[$scheme]["fontOption"];
		$alignOption = $arrayCurValues[$scheme]["alignOption"];
		$repeatOption = $arrayCurValues[$scheme]["repeatOption"];
		$theme_imageID = $arrayCurValues[$scheme]["backgroundimage"];
	
	} else {
		$alignOption = $align;
		$repeatOption = $repeat;
		$fontOption = $font;
		$theme_imageID = ($image_id || $remove_image || $restore ? $image_id : $aux_imageID);
	}
	
	unset($arrayAlign);
	unset($arrayNameAlign);
	unset($arrayValueAlign);
	unset($arrayRepeat);
	unset($arrayNameRepeat);
	unset($arrayValueRepeat);
	unset($arrayFont);
	unset($arrayNameFont);
	unset($arrayValueFont);
	
	$arrayNameAlign[] = system_showText(LANG_SITEMGR_COLOR_ALIGN_CENTER);
	$arrayNameAlign[] = system_showText(LANG_SITEMGR_COLOR_ALIGN_LEFT);
	$arrayNameAlign[] = system_showText(LANG_SITEMGR_COLOR_ALIGN_RIGHT);
	
	$arrayValueAlign[] = "center";
	$arrayValueAlign[] = "left";
	$arrayValueAlign[] = "right";
	
	$arrayNameRepeat[] = system_showText(LANG_SITEMGR_COLOR_REPEAT);
	$arrayNameRepeat[] = system_showText(LANG_SITEMGR_COLOR_REPEAT_NO);
	$arrayNameRepeat[] = system_showText(LANG_SITEMGR_COLOR_REPEAT_VERTICAL);
	$arrayNameRepeat[] = system_showText(LANG_SITEMGR_COLOR_REPEAT_HORIZONTAL);
	
	$arrayValueRepeat[] = "repeat";
	$arrayValueRepeat[] = "no-repeat";
	$arrayValueRepeat[] = "repeat-y";
	$arrayValueRepeat[] = "repeat-x";
	
	$arrayNameFont[] = "Arial, Helvetica, Sans-serif";
	$arrayNameFont[] = "Courier New, Courier, monospace";
	$arrayNameFont[] = "Georgia, Times New Roman, Times, serif";
	$arrayNameFont[] = "Tahoma, Geneva, sans-serif";
	$arrayNameFont[] = "Trebuchet MS, Arial, Helvetica, sans-serif";
	$arrayNameFont[] = "Verdana, Geneva, sans-serif";
	
	$arrayValueFont[] = 1; //Arial, Helvetica, Sans-serif
	$arrayValueFont[] = 2; //'Courier New', Courier, monospace
	$arrayValueFont[] = 3; //Georgia, 'Times New Roman', Times, serif
	$arrayValueFont[] = 4; //Tahoma, Geneva, sans-serif
	$arrayValueFont[] = 5; //'Trebuchet MS', Arial, Helvetica, sans-serif
	$arrayValueFont[] = 6; //Verdana, Geneva, sans-serif

	$arrayAlign = html_selectBox("align", $arrayNameAlign, $arrayValueAlign, $alignOption, "", "", "-- ".system_showText(LANG_PAGING_ORDERBYPAGE_SELECT)." --");
	$arrayRepeat = html_selectBox("repeat", $arrayNameRepeat, $arrayValueRepeat, $repeatOption, "", "", "-- ".system_showText(LANG_PAGING_ORDERBYPAGE_SELECT)." --");
	$arrayFont = html_selectBox("font", $arrayNameFont, $arrayValueFont, $fontOption, "", "", "");

	$arrayDefault = unserialize(ARRAY_DEFAULT_COLORS);
	
	setting_get("scheme_change_images", $change_images);
	if ($change_images == "on"){
		$change_images_checked = "checked =\"checked\"";
	} else {
		$change_images_checked = "";
	}
	
	if ($theme == "default"){
		
		if ($scheme == "beauty"){
			$table_colors_1 = array(0 => "ContentBackground", 1 => "MainContent", 2 => "Slider", 3 => "Title", 4 => "TitleBorder", 5 => "Text", 6 => "Link");
			$table_colors_2 = array(0 => "UserNavbarText", 1 => "UserNavbarLink", 2 => "Navbar", 3 => "NavbarLink", 4 => "NavbarLinkActive", 5 => "FooterText", 6 => "FooterLink");
		} elseif($scheme == "buyersguide"){
			$table_colors_1 = array(0 => "MainContent", 1 => "Slider", 2 => "Title", 3 => "TitleBorder", 4 => "Text", 5 => "Link", 6 => "UserNavbar", 7 => "UserNavbarText");
			$table_colors_2 = array(0 => "UserNavbarLink", 1 => "Navbar", 2 => "NavbarLink", 3 => "NavbarLinkActive", 4 => "Footer", 5 => "FooterText", 6 => "FooterLink");
		} elseif($scheme == "cityguide"){
			$table_colors_1 = array(0 => "Background", 1 => "ContentBackground", 2 => "MainContent", 3 => "Slider", 4 => "Title", 5 => "TitleBorder", 6 => "Text", 7 => "Link");
			$table_colors_2 = array(0 => "UserNavbar", 1 => "UserNavbarText", 2 => "UserNavbarLink", 3 => "Navbar", 4 => "NavbarLink", 5 => "NavbarLinkActive", 6 => "FooterText", 7 => "FooterLink");
		} elseif($scheme == "cityguideyellow"){
			$table_colors_1 = array(0 => "Background", 1 => "ContentBackground", 2 => "MainContent", 3 => "Slider", 4 => "Title", 5 => "TitleBorder", 6 => "Text", 7 => "Link");
			$table_colors_2 = array(0 => "UserNavbar", 1 => "UserNavbarText", 2 => "UserNavbarLink", 3 => "Navbar", 4 => "NavbarLink", 5 => "NavbarLinkActive", 6 => "FooterText", 7 => "FooterLink");
		} elseif($scheme == "companies"){
			$table_colors_1 = array(0 => "MainContent", 1 => "Slider", 2 => "Title", 3 => "TitleBorder", 4 => "Text", 5 => "Link", 6 => "UserNavbar");
			$table_colors_2 = array(0 => "UserNavbarText", 1 => "UserNavbarLink", 2 => "Navbar", 3 => "NavbarLink", 4 => "NavbarLinkActive", 5 => "FooterText", 6 => "FooterLink");
		} elseif($scheme == "dentist"){
			$table_colors_1 = array(0 => "MainContent", 1 => "Slider", 2 => "Title", 3 => "TitleBorder", 4 => "Text", 5 => "Link", 6 => "UserNavbar", 7 => "UserNavbarText", );
			$table_colors_2 = array(0 => "UserNavbarLink", 1 => "Navbar", 2 => "NavbarLink", 3 => "NavbarLinkActive", 4 => "Footer", 5 => "FooterText", 6 => "FooterLink");
		} elseif($scheme == "environment"){
			$table_colors_1 = array(0 => "MainContent", 1 => "Slider", 2 => "Title", 3 => "TitleBorder", 4 => "Text", 5 => "Link", 6 => "UserNavbar", 7 => "UserNavbarText", );
			$table_colors_2 = array(0 => "UserNavbarLink", 1 => "Navbar", 2 => "NavbarLink", 3 => "NavbarLinkActive", 4 => "Footer", 5 => "FooterText", 6 => "FooterLink");
		} elseif($scheme == "financial"){
			$table_colors_1 = array(0 => "ContentBackground", 1 => "MainContent", 2 => "Slider", 3 => "Title", 4 => "TitleBorder", 5 => "Text", 6 => "Link", 7 => "UserNavbar");
			$table_colors_2 = array(0 => "UserNavbarText", 1 => "UserNavbarLink", 2 => "Navbar", 3 => "NavbarLink", 4 => "NavbarLinkActive", 5 => "FooterText", 6 => "FooterLink");
		} elseif($scheme == "golfcourse"){
			$table_colors_1 = array(0 => "MainContent", 1 => "Slider", 2 => "Title", 3 => "TitleBorder", 4 => "Text", 5 => "Link", 6 => "UserNavbar", 7 => "UserNavbarText", );
			$table_colors_2 = array(0 => "UserNavbarLink", 1 => "Navbar", 2 => "NavbarLink", 3 => "NavbarLinkActive", 4 => "Footer", 5 => "FooterText", 6 => "FooterLink");
		} elseif($scheme == "magazine"){
			$table_colors_1 = array(0 => "ContentBackground", 1 => "MainContent", 2 => "Slider", 3 => "Title", 4 => "TitleBorder", 5 => "Text", 6 => "Link");
			$table_colors_2 = array(0 => "UserNavbarText", 1 => "UserNavbarLink", 2 => "Navbar", 3 => "NavbarLink", 4 => "NavbarLinkActive", 5 => "FooterText", 6 => "FooterLink");
		} elseif($scheme == "medical"){
			$table_colors_1 = array(0 => "Background", 1 => "ContentBackground", 2 => "MainContent", 3 => "Slider", 4 => "Title", 5 => "TitleBorder", 6 => "Text", 7 => "Link");
			$table_colors_2 = array(0 => "UserNavbar", 1 => "UserNavbarText", 2 => "UserNavbarLink", 3 => "NavbarLink", 4 => "NavbarLinkActive", 5 => "Footer", 6 => "FooterText", 7 => "FooterLink");
		} elseif($scheme == "restaurant"){
			$table_colors_1 = array(0 => "ContentBackground", 1 => "MainContent", 2 => "Slider", 3 => "Title", 4 => "TitleBorder", 5 => "Text", 6 => "Link");
			$table_colors_2 = array(0 => "UserNavbarText", 1 => "UserNavbarLink", 2 => "Navbar", 3 => "NavbarLink", 4 => "NavbarLinkActive", 5 => "FooterText", 6 => "FooterLink");
		} elseif($scheme == "spa"){
			$table_colors_1 = array(0 => "Background", 1 => "ContentBackground", 2 => "MainContent", 3 => "Slider", 4 => "Title", 5 => "TitleBorder", 6 => "Text", 7 => "Link");
			$table_colors_2 = array(0 => "UserNavbar", 1 => "UserNavbarText", 2 => "UserNavbarLink", 3 => "NavbarLink", 4 => "NavbarLinkActive", 5 => "Footer", 6 => "FooterText", 7 => "FooterLink");
		} elseif($scheme == "sports"){
			$table_colors_1 = array(0 => "ContentBackground", 1 => "MainContent", 2 => "Slider", 3 => "Title", 4 => "TitleBorder", 5 => "Text", 6 => "Link");
			$table_colors_2 = array(0 => "UserNavbar", 1 => "UserNavbarText", 2 => "UserNavbarLink", 3 => "NavbarLink", 4 => "NavbarLinkActive", 5 => "FooterText", 6 => "FooterLink");
		} else{
			$table_colors_1 = array(0 => "Background", 1 => "ContentBackground", 2 => "MainContent", 3 => "Slider", 4 => "Title", 5 => "TitleBorder", 6 => "Text", 7 => "Link", 8 => "UserNavbar");
			$table_colors_2 = array(0 => "UserNavbarText", 1 => "UserNavbarLink", 2 => "Navbar", 3 => "NavbarLink", 4 => "NavbarLinkActive", 5 => "Footer", 6 => "FooterText", 7 => "FooterLink");
		}
	} else {
		$table_colors_1 = array(0 => "Background", 1 => "ContentBackground", 2 => "MainContent", 3 => "Slider", 4 => "Title", 5 => "TitleBorder", 6 => "Text", 7 => "Link", 8 => "UserNavbar");
		$table_colors_2 = array(0 => "UserNavbarText", 1 => "UserNavbarLink", 2 => "Navbar", 3 => "NavbarLink", 4 => "NavbarLinkActive", 5 => "Footer", 6 => "FooterText", 7 => "FooterLink");
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
				<h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=system_showText(LANG_SITEMGR_COLOR_OPTIONS)?></h1>
			</div>
		</div>

		<div id="content-content">
			<div class="default-margin">

				<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
				<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
				<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>		

				<br />

				<ul class="list-view">
					<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/theme.php"><?=system_showText(LANG_SITEMGR_BACK)?></a></li>
				</ul>
				
				<form name="color_scheme" id="color_scheme" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">

					<? include(INCLUDES_DIR."/forms/form_colorscheme.php"); ?>
					
					<input type="hidden" name="theme" value="<?=$theme?>">
					<input type="hidden" name="label" value="<?=$label?>">
					<input type="hidden" name="scheme" value="<?=$scheme?>">
					<input type="hidden" name="action" id="action" value="submit">
					<input type="hidden" name="aux_action" id="aux_action" value="0">
					
				
					<? if (DEMO_LIVE_MODE) { ?>
						<button type="button" name="submit_button" class="input-button-form" value="Submit" onclick="livemodeMessage('<?=system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE)?>');"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
					<? } else { ?>
						<button type="button" name="submit_button" class="input-button-form" value="Submit" onclick="JS_submit('submit');"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
					<? } ?>
					
					<? if (EDIR_SCHEME != $scheme) { ?>	
						<? if (DEMO_LIVE_MODE) { ?>
							<button type="button" name="submit_button" class="input-button-form" value="Submit" onclick="livemodeMessage('<?=system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE)?>');"><?=system_showText(LANG_SITEMGR_APPLY_SCHEME)?></button>
						<? } else { ?>
							<button type="button" name="submit_button" class="input-button-form" value="Submit" onclick="JS_submit('apply');"><?=system_showText(LANG_SITEMGR_APPLY_SCHEME)?></button>
						<? } ?>
					<? } ?>
						
					<? if (DEMO_LIVE_MODE) { ?>
						<button type="button" name="reset_button" class="input-button-form" value="Submit" onclick="livemodeMessage('<?=system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE)?>');"><?=system_showText(LANG_SITEMGR_RESET)?></button>
					<? } else { ?>
						<button type="button" name="reset_button" class="input-button-form" value="Submit" onclick="JS_submit('reset');"><?=system_showText(LANG_SITEMGR_RESET)?></button>
					<? } ?>
						
					<button type="button" name="cancel" class="input-button-form" value="Cancel" onclick="Redirect('<?=DEFAULT_URL."/sitemgr/prefs/theme.php"?>');"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
					
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
