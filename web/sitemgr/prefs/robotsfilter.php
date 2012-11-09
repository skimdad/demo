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
    # * FILE: /sitemgr/prefs/robotsfilter.php
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
	if (!isset($robots_list)) system_setFreqActions('prefs_robotsfilter','prefsrobots');
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        $robotsObj = new RobotsFilter();
        $robotsObj->Clear();
        
        if ($robots_list) {
            unset($robotsObj);
            $array = explode("\r", $robots_list);
            foreach($array as $robot) {
                if (string_strlen(trim($robot)) > 0) {
                    $robotsObj = new RobotsFilter();
                    $robotsObj->setString('value', trim($robot));
                    $robotsObj->Save();
                }
            }
        }
        
        $message_robotsfilter = system_showText(LANG_SITEMGR_SETTINGS_ROBOTS_SAVED);
        $message_style = "successMessage";
        
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
            <h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=system_showText(LANG_SITEMGR_SETTINGS_ROBOTS)?></h1>
        </div>
    </div>

    <div id="content-content">
        <div class="default-margin">

            <? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
            <? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
            <? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>            

            <br />

            <form name="robotsfilter" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                <? include(INCLUDES_DIR."/forms/form_robotsfilter.php"); ?>
                <table style="margin: 0 auto 0 auto;">
                    <tr>
                        <td>
                            <button type="submit" name="robotsfilter_submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                        </td>
                    </tr>
                </table>
            </form>

        </div>
    </div>

	<div id="tip" class="tip-base">
		<p>&#8226; <?php echo system_showText(LANG_SITEMGR_SETTINGS_ROBOTS_TIP1) ?></p>
		<p>&#8226; <?php echo system_showText(LANG_SITEMGR_SETTINGS_ROBOTS_TIP2) ?></p>
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
