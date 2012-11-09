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
    # * FILE: /members/deal/index.php
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
    if ( PROMOTION_FEATURE != 'on' || CUSTOM_PROMOTION_FEATURE != "on" ) {
        header("Location: ".DEFAULT_URL."/members/");
        exit;
    }elseif ( !$hasPromotion ) {
        header("Location: ".DEFAULT_URL."/members/");
        exit; 
    }

    # ----------------------------------------------------------------------------------------------------
    # SESSION
    # ----------------------------------------------------------------------------------------------------
    sess_validateSession();
    $acctId = sess_getAccountIdFromSession();

    if (!system_enableDealForUser($acctId)){
        header("Location: ".DEFAULT_URL."/members/");
        exit; 	
    }

    $url_redirect = "".DEFAULT_URL."/members/deal";
    $url_base     = "".DEFAULT_URL."/members";

    extract($_GET);
    extract($_POST);

    // Page Browsing /////////////////////////////////////////

    $sql_where[] = " account_id = $acctId ";
    if ($sql_where){
        $where .= " ".implode(" AND ", $sql_where)." ";
    }

    $pageObj = new pageBrowsing("Promotion", $screen, RESULTS_PER_PAGE, (($_GET["newest"])?("id DESC"):"name"), "name", $letter, $where);
    $promotions = $pageObj->retrievePage();

	
    $paging_url = DEFAULT_URL."/members/".PROMOTION_FEATURE_FOLDER."/index.php";

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
    $pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_PAGING_GOTOPAGE).": ", "this.form.submit();");
    # --------------------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # SUBMIT
    # ----------------------------------------------------------------------------------------------------
    include(INCLUDES_DIR."/code/promotion_attachlisting.php");

    # ----------------------------------------------------------------------------------------------------
    # HEADER
    # ----------------------------------------------------------------------------------------------------
    include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

    # ----------------------------------------------------------------------------------------------------
    # NAVBAR
    # ----------------------------------------------------------------------------------------------------
    include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

?>

    <div class="content">

        <? 
        require(EDIRECTORY_ROOT."/sitemgr/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); 
        ?>

        <h2>
            <?=system_showText(LANG_MENU_MANAGEPROMOTION);?>
        </h2>

        <?
        $contentObj = new Content("", EDIR_LANGUAGE);
        $content = $contentObj->retrieveContentByType("Manage Deals");
        if ($content) {
            echo "<blockquote>";
            echo "<div class=\"dynamicContent\">".$content."</div>";
            echo "</blockquote>";
        }
      
	
        if ($promotions) { 
            ?>
            <form name="deal_attach" id="deal_attach" action="<?=system_getFormAction(($_SERVER["QUERY_STRING"]) ? $_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"] : $_SERVER["PHP_SELF"])?>" method="post">
                <? include(INCLUDES_DIR."/tables/table_promotion.php"); ?>
                <br />
                <p class="standardButton standardButtonLarge">
                    <button type="button" onclick="JS_submit()">
                        <?=system_showText(LANG_MSG_SAVE_CHANGES)?>
                    </button>
                </p>
            </form>
            <?
        } else { 
            include(INCLUDES_DIR."/tables/table_paging.php"); 
            ?>
            <p class="informationMessage"><?=system_showText(LANG_NO_PROMOTIONS_IN_THE_SYSTEM)?></p>
            <? 
        
        }
        
        $contentObj = new Content("", EDIR_LANGUAGE);
        $content = $contentObj->retrieveContentByType("Manage Deals Bottom");
        if ($content) { 
            ?>
            <table border="0" cellpadding="2" cellspacing="0" class="standard-table item-title">
                <tr>
                    <th colspan="2" class="standard-tabletitle">
                        <?=system_showText(LANG_MSG_MORE_INFO);?>
                    </th>
                </tr>
            </table>
            <?
            echo "<blockquote>";
            echo "<div class=\"dynamicContent dealContent\">".$content."</div>";
            echo "</blockquote>";
        }
        ?>

    </div>

    <script language="javascript" type="text/javascript">
        function JS_submit() {
                document.deal_attach.submit();
        }
    </script>

<?
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
