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
    # * FILE: /members/deal/deal.php
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
        if ( $promoLevelListing->getHasPromotion($level_each) == "y" ){
            $hasPromotion = true;
        }
    }
    if ( PROMOTION_FEATURE != "on" || CUSTOM_PROMOTION_FEATURE != "on" ){
        exit;
    }elseif ( !$hasPromotion ){
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

    # ----------------------------------------------------------------------------------------------------
    # AUX
    # ----------------------------------------------------------------------------------------------------
    extract($_GET);
    extract($_POST);

    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
    $url_base = "".DEFAULT_URL."/members";
    $members = 1;

    if ($_POST["action"] == "useDeal" && $_POST["promotion_id"]){
        $dealObj = new Promotion();
        $dealObj->setPromoCode($_POST["promotion_id"], 1);
        die("OK");
    }
    if ($_POST["action"]== "freeUpDeal" && $_POST["promotion_id"]){
        $dealObj = new Promotion();
        $dealObj->setPromoCode($_POST["promotion_id"], 0);
        die("OK");
    }


    include(EDIRECTORY_ROOT."/includes/code/promotion.php");

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
        
        if($id) {
            $prefix = string_ucwords(system_showText(LANG_LABEL_EDIT));
        }else{ 
            $prefix = string_ucwords(system_showText(LANG_MENU_CREATE));
        }
        ?>
        
        <h2>
            <?=$prefix?> <?=string_ucwords(system_showText(LANG_PROMOTION_FEATURE_NAME))?>
        </h2>

        <form name="promotion" id="promotion" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$id?>" />
            <input type="hidden" name="listing_id" value="<?=$listing_id?>" />
            <input type="hidden" name="account_id" id="account_id" value="<?=$acctId?>" />
            <input type="hidden" name="letter" value="<?=$letter?>" />
            <input type="hidden" name="screen" value="<?=$screen?>" />

            <? include(INCLUDES_DIR."/forms/form_promotion.php"); ?>

            <div class="baseButtons floatButtons">

                <p class="standardButton">
                    <button type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
                </p>

            </div>

        </form>

        <form action="<?=DEFAULT_URL?>/members/<?=PROMOTION_FEATURE_FOLDER;?>/index.php" method="post" style=" margin: 0; padding: 0; ">
            <input type="hidden" name="letter" value="<?=$letter?>" />
            <input type="hidden" name="screen" value="<?=$screen?>" />

            <div class="baseButtons floatButtons noPadding">

                <p class="standardButton">
                        <button type="submit" name="cancel" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
                </p>

            </div>

        </form>

    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            //DATE PICKER
            <?
            if ( DEFAULT_DATE_FORMAT == "m/d/Y" ){
                $date_format = "mm/dd/yy";
            }elseif ( DEFAULT_DATE_FORMAT == "d/m/Y" ){
                $date_format = "dd/mm/yy";
            }
            ?>

            $("#start_date").datepicker({
                dateFormat: "<?=$date_format?>",
                changeMonth: true,
                changeYear: true,
                yearRange: "<?=date("Y")?>:<?=date("Y")+10?>"
            });
            $("#end_date").datepicker({
                dateFormat: "<?=$date_format?>",
                changeMonth: true,
                changeYear: true,
                yearRange: "<?=date("Y")?>:<?=date("Y")+10?>"
            });
        });
    </script>
			
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>