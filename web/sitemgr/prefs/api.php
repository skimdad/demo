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
	# * FILE: /sitemgr/prefs/api.php
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
	if ($_SERVER['REQUEST_METHOD'] != "POST" && !$_GET["download"]) system_setFreqActions("prefs_api", "prefs_api");

	// Default CSS class for message
	$message_style = "successMessage";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($api_options) {
			if(!setting_set("edirectory_api_enabled", $edirectory_api_enabled)) {
				if(!setting_new("edirectory_api_enabled", $edirectory_api_enabled)) {
					$error = true;
				}
			}
            
            if ($edirectory_api_enabled != "on"){
                $edirectory_api_key = "";
            }
            
            if(!setting_set("edirectory_api_key", $edirectory_api_key)) {
                if(!setting_new("edirectory_api_key", $edirectory_api_key)) {
                    $error = true;
                }
            }
            
			if (!$error) {
				$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_API_CONFIGURATIONWASCHANGED);
			} else {
				$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
				$message_style = "errorMessage";
			}
			if($actions) {
				$message_api_options .= implode("<br />", $actions);
			}
		}
	} elseif ($_GET["download"]){
        system_downloadAPIDoc();
    }
	
	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	setting_get("edirectory_api_enabled", $edirectory_api_enabled);
	if ($edirectory_api_enabled) $edirectory_api_enabled_checked = "checked";
	setting_get("edirectory_api_key", $edirectory_api_key);
    
    //Generate new eDirectory API key
    $domainObj = new Domain(SELECTED_DOMAIN_ID);
    $domain = $domainObj->getString("url");
    $edir_key = getKey($domain);
    $edirectory_api_key_new = md5($domain.VERSION.$edir_key);

    unset($new_key);
    $j=0;
    for($i=0;$i<strlen($edirectory_api_key_new);$i++){
        if($j < 4){
            $new_key .= substr($edirectory_api_key_new, $i, 1);	
        }else{
            $new_key .= "-".substr($edirectory_api_key_new, $i, 1);
            $j=0;
        }
        $j++;
    }
    $edirectory_api_key_new = $new_key;

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

<script type="text/javascript" language="javascript">
    function setNewKey() {
        $("#edirectory_api_key_disabled").attr("value", $("#new_key").val());
        $("#edirectory_api_key").attr("value", $("#new_key").val());
    }
    
    function download_doc(){
        <? if (!DEMO_LIVE_MODE) { ?>
            document.location = "<?=DEFAULT_URL?>/sitemgr/prefs/api.php?download=1";
        <? } else { ?>
            livemodeMessage("<?=system_showText(LANG_SITEMGR_PLUGIN_DEMO_MESSAGE);?>");
        <? } ?>
    }
</script>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=system_showText(LANG_SITEMGR_API)?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<form name="api_options" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                <? include(INCLUDES_DIR."/forms/form_api_options.php"); ?>
                <table style="margin: 0 auto 0 auto;">
                    <tr>
                        <td>
                            <button type="submit" name="api_options" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
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
