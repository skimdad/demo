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
	# * FILE: /sitemgr/prefs/template.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

    extract($_GET);
	extract($_POST);
    
	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (!USING_THEME_TEMPLATE || $id != THEME_TEMPLATE_ID) { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	//increases frequently actions
	if (!isset($id)) system_setFreqActions('prefs_theme','prefstheme');

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if (validate_listingtemplate($_POST, $message_listingtemplate, false)) {

			$listingtemplate = new ListingTemplate($_POST);
//			$listingtemplate->save();

			$template_id = $listingtemplate->getNumber("id");
			$listingtemplate->clearListingTemplateFields();

			$show_order = 0;
			foreach ($label as $fieldname=>$labelname) {
				if (trim($labelname)) {
					$ltf["field"] = $fieldname;
					$ltf["label"] = $labelname;
					unset($aux_fieldvalues);
					if ($fieldvalues[$fieldname]) {
						$auxfieldvalues = explode("\n", $fieldvalues[$fieldname]);
						foreach ($auxfieldvalues as $fieldvalue) {
							$fieldvalue = str_replace("\n", "", $fieldvalue);
							$fieldvalue = str_replace("\r", "", $fieldvalue);
							if (trim($fieldvalue)) {
								$aux_fieldvalues[] = $fieldvalue;
							}
						}
					}
					if ($aux_fieldvalues) $ltf["fieldvalues"] = implode(",", $aux_fieldvalues);
					else $ltf["fieldvalues"] = "";
					$ltf["instructions"] = $instructions[$fieldname];
					$ltf["required"] = $required[$fieldname];
					$ltf["search"] = $search[$fieldname];
					$ltf["searchbykeyword"] = $searchbykeyword[$fieldname];
					$ltf["searchbyrange"] = $searchbyrange[$fieldname];
					$ltf["show_order"] = $show_order;
					$ltf["enabled"] = $enabled[$fieldname];
					$listingtemplate->addListingTemplateField($ltf);
					$show_order++;
				}
			}

			header("Location: ".DEFAULT_URL."/sitemgr/prefs/theme.php?status=success");
            exit;

		}

		// removing slashes added if required
		$_POST = format_magicQuotes($_POST);
		$_GET  = format_magicQuotes($_GET);
		extract($_POST);
		extract($_GET);

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	if ($id) {
		$listingtemplate = new ListingTemplate($id);
		$listingtemplate->extract();
		$template_fields = $listingtemplate->getListingTemplateFields();
		if ($template_fields) {
			foreach ($template_fields as $template_field) {
				$label[$template_field["field"]] = $template_field["label"];
				$fieldvalues[$template_field["field"]] = str_replace(",", "\n", $template_field["fieldvalues"]);
				$instructions[$template_field["field"]] = $template_field["instructions"];
				$required[$template_field["field"]] = $template_field["required"];
				$search[$template_field["field"]] = $template_field["search"];
				$searchbykeyword[$template_field["field"]] = $template_field["searchbykeyword"];
				$searchbyrange[$template_field["field"]] = $template_field["searchbyrange"];
                $enabled[$template_field["field"]] = $template_field["enabled"];
			}
		}
	}

    extract($_POST);
	extract($_GET);

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

            <div class="baseForm">

                <form id="listingtemplate" name="listingtemplate" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="POST" style="margin:0; padding:0">
                    <input type="hidden" name="id" value="<?=$id?>" />

                    <? include(INCLUDES_DIR."/forms/form_themetemplate.php"); ?>

                    <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
                    <input type="hidden" name="letter" value="<?=$letter?>" />
                    <input type="hidden" name="screen" value="<?=$screen?>" />
                    <input type="hidden" name="preview" id="preview" value="0">

                    <input type="button" name="submit_button" value="<?=system_showText(LANG_SITEMGR_SUBMIT)?>" class="input-button-form" onclick="JS_submit();" />
                    <input type="button" name="submit_button" value="<?=system_showText(LANG_SITEMGR_CANCEL)?>" class="input-button-form" onclick="document.getElementById('formlistingtemplatecancel').submit();" />

                </form>
                
                <form id="formlistingtemplatecancel" action="<?=DEFAULT_URL?>/sitemgr/prefs/theme.php" method="POST">

                    <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
                    <input type="hidden" name="letter" value="<?=$letter?>" />
                    <input type="hidden" name="screen" value="<?=$screen?>" />

                </form>

            </div>

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
