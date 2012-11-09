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
    # * FILE: /sitemgr/prefs/searchverify.php
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
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        // Google Code
        $searchMetaObj = new SearchMetaTag('google');
        
        if($_POST["google_tag"]) {

            if (validate_form("search_metatag", $_POST, $error)) {

				$metatagaux = $_POST["google_tag"];
				$metatagaux = str_replace("<META ", "<meta ", $metatagaux);
				$metatagaux = str_replace(" NAME=", " name=", $metatagaux);
				$metatagaux = str_replace(" CONTENT=", " content=", $metatagaux);
				if (string_strpos($metatagaux, "/>") === false) {
					$metatagaux = str_replace(">", " />", $metatagaux);
				}
				$_POST["google_tag"] = $metatagaux;

                if ($searchMetaObj->isSetField()) {
                    $searchMetaObj->setString('value', $_POST["google_tag"]);
                    $searchMetaObj->Save();
                } else {
                    $searchMetaObj->setString('name', 'google');
                    $searchMetaObj->setString('value', $_POST["google_tag"]);
                    $searchMetaObj->Save(false);    
                }    
                $success = true;
                
            }
            
        } else $searchMetaObj->Delete();
        
        // Yahoo Code
        $searchMetaObj = new SearchMetaTag('yahoo');
        
        if($_POST["yahoo_tag"]) {

            if (validate_form("search_metatag", $_POST, $error)) {

				$metatagaux = $_POST["yahoo_tag"];
				$metatagaux = str_replace("<META ", "<meta ", $metatagaux);
				$metatagaux = str_replace(" NAME=", " name=", $metatagaux);
				$metatagaux = str_replace(" CONTENT=", " content=", $metatagaux);
				if (string_strpos($metatagaux, "/>") === false) {
					$metatagaux = str_replace(">", " />", $metatagaux);
				}
				$_POST["yahoo_tag"] = $metatagaux;

                if ($searchMetaObj->isSetField()) {
                    $searchMetaObj->setString('value', $_POST["yahoo_tag"]);
                    $searchMetaObj->Save();
                } else {
                    $searchMetaObj->setString('name', 'yahoo');
                    $searchMetaObj->setString('value', $_POST["yahoo_tag"]);
                    $searchMetaObj->Save(false);    
                }
                $success = true;
                
            }
            
        } else $searchMetaObj->Delete();
        
        // Live Code
        $searchMetaObj = new SearchMetaTag('live');

        if($_POST["live_tag"]) {

            if (validate_form("search_metatag", $_POST, $error)) {

				$metatagaux = $_POST["live_tag"];
				$metatagaux = str_replace("<META ", "<meta ", $metatagaux);
				$metatagaux = str_replace(" NAME=", " name=", $metatagaux);
				$metatagaux = str_replace(" CONTENT=", " content=", $metatagaux);
				if (string_strpos($metatagaux, "/>") === false) {
					$metatagaux = str_replace(">", " />", $metatagaux);
				}
				$_POST["live_tag"] = $metatagaux;

                if ($searchMetaObj->isSetField()) {
                    $searchMetaObj->setString('value', $_POST["live_tag"]);
                    $searchMetaObj->Save();
                } else {
                    $searchMetaObj->setString('name', 'live');
                    $searchMetaObj->setString('value', $_POST["live_tag"]);
                    $searchMetaObj->Save(false);    
                }
                $success = true;
                
            }
            
        } else $searchMetaObj->Delete(); 
        
    }
    # ----------------------------------------------------------------------------------------------------
    # DEFINES
    # ----------------------------------------------------------------------------------------------------
    $searchMetaObj_google = new SearchMetaTag('google');
    $google_tag = html_entity_decode($searchMetaObj_google->getString('value'));
    $searchMetaObj_yahoo = new SearchMetaTag('yahoo');
    $yahoo_tag = html_entity_decode($searchMetaObj_yahoo->getString('value'));
    $searchMetaObj_live = new SearchMetaTag('live');
    $live_tag = html_entity_decode($searchMetaObj_live->getString('value'));
    
    # ----------------------------------------------------------------------------------------------------
    # HEADER
    # ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT."/layout/header.php");

    # ----------------------------------------------------------------------------------------------------
    # NAVBAR
    # ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT."/layout/navbar.php");
    
    # ----------------------------------------------------------------------------------------------------
    # MESSAGES
    # ----------------------------------------------------------------------------------------------------
    $msg_success = system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_MSGSUCCESS);

?>

<div id="main-right">

    <div id="top-content">
        <div id="header-content">
            <h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY))?></h1>
        </div>
    </div>

    <div id="content-content">

        <div class="default-margin">

            <? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>

            <br />

            <form id="searchmetatag" name="searchmetatag" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                <? include(INCLUDES_DIR."/forms/form_searchverify.php"); ?>
                <input type="hidden" name="itemedit" value="" />
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
