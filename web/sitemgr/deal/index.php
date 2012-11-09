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
    # * FILE: /sitemgr/deal/index.php
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
    if ( PROMOTION_FEATURE != 'on' ) {
        header("Location: ".DEFAULT_URL."/sitemgr/");
        exit;
    }
    elseif ( !$hasPromotion ) {
        header("Location: ".DEFAULT_URL."/sitemgr/");
        exit;
    }

    # ----------------------------------------------------------------------------------------------------
    # SESSION
    # ----------------------------------------------------------------------------------------------------
    sess_validateSMSession();
    permission_hasSMPerm();

    $url_redirect = "".DEFAULT_URL."/sitemgr/".PROMOTION_FEATURE_FOLDER;
    $url_base = "".DEFAULT_URL."/sitemgr";
    $sitemgr = 1;

    extract($_GET);
    extract($_POST);

    //increases frequently actions
    if (!isset($message)) system_setFreqActions('promotion_manage','PROMOTION_FEATURE');

    $url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

    // Page Browsing ////////////////////////////////////////
    $pageObj  = new pageBrowsing("Promotion", $screen, RESULTS_PER_PAGE, (($_GET["newest"])?("id DESC"):((PROMOTION_SCALABILITY_OPTIMIZATION == "on")?(""):("updated DESC, name"))), "name", $letter);

    $promotions = $pageObj->retrievePage();

    $paging_url = DEFAULT_URL."/sitemgr/".PROMOTION_FEATURE_FOLDER."/index.php";

    // Letters Menu
    $letters = $pageObj->getString("letters");
    foreach ($letters as $each_letter) {
        if ($each_letter == "#") {
            $letters_menu .= "<a href=\"$paging_url?letter=no\" ".(($letter == "no") ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
            //$letters_menu .= "<a href=\"$paging_url\" ".((!$letter) ? "class=\"firstLetter\"" : "" ).">".string_strtoupper($each_letter)."</a>";
        } else {
            $letters_menu .= "<a href=\"$paging_url?letter=".$each_letter."\" ".(($each_letter == $letter) ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
        }
    }

    # PAGES DROP DOWN ----------------------------------------------------------------------------------------------
    $pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE), "this.form.submit();");
    # --------------------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # SUBMIT
    # ----------------------------------------------------------------------------------------------------
    include(INCLUDES_DIR."/code/bulkupdate.php");

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
                <h1><?=string_ucwords(system_showText(LANG_SITEMGR_PROMOTION_PLURAL))?></h1>
            </div>
        </div>
        <div id="content-content">
            <div class="default-margin">
                <?
                require(EDIRECTORY_ROOT."/sitemgr/registration.php"); 
                require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
                require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
		
                if (CUSTOM_PROMOTION_FEATURE != "on"){ 
                    ?>
                    <p class="informationMessage">
                        <?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
                    </p>
                    <? 
                }else { 
                    
                    include(INCLUDES_DIR."/tables/table_promotion_submenu.php"); 
                    
                    if ($promotions) { 
                        include(INCLUDES_DIR."/tables/table_promotion.php"); 
                    } else { 
                        include(INCLUDES_DIR."/tables/table_paging.php"); 
                        ?>
                        <p class="informationMessage">
                            <?=system_showText(LANG_SITEMGR_PROMOTION_NORECORD)?>
                        </p>
                        <?
                    }
                }
                ?>
		
            </div>
        </div>
        <div id="bottom-content">&nbsp;</div>
    </div>

<?
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>