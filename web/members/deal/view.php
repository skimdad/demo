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
    # * FILE: /members/deal/view.php
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
    } elseif ( !$hasPromotion ){
        exit;
    }

    # ----------------------------------------------------------------------------------------------------
    # SESSION
    # ----------------------------------------------------------------------------------------------------
    sess_validateSession();

    if (!system_enableDealForUser(sess_getAccountIdFromSession())){
        exit; 	
    }

    extract($_GET);
    extract($_POST);

    # ----------------------------------------------------------------------------------------------------
    # AUX
    # ----------------------------------------------------------------------------------------------------

    if ($id) {
        $promotion = new Promotion($id);
        $listing = db_getFromDB("listing", "promotion_id", db_formatNumber($id), 1, "", "object", SELECTED_DOMAIN_ID);
        if (sess_getAccountIdFromSession() != $promotion->getNumber("account_id")) {
            header("Location: ".DEFAULT_URL."/members/".PROMOTION_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
            exit;
        }
        $account = new Account($promotion->getNumber("account_id"));
    } else {
        header("Location: ".DEFAULT_URL."/members/".PROMOTION_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
        exit;
    }

    setting_get("commenting_edir", $commenting_edir);
    setting_get("review_promotion_enabled", $review_enabled);

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
            <?=system_showText(LANG_PROMOTION_DETAIL);?>
        </h2>

        <ul class="list-view">
            <li class="list-back">
                <a href="<?=DEFAULT_URL?>/members/<?=PROMOTION_FEATURE_FOLDER;?>/index.php?screen=<?=$screen?>&letter=<?=$letter?>">
                    <?=system_showText(LANG_LABEL_BACK);?>
                </a>
            </li>
        </ul>

        <h2 class="standardSubTitle">
            <?=system_showText(LANG_MANAGE_PROMOTION);?> - <?=$promotion->getString("name", true, 60);?>
        </h2>

        <ul class="list-view">
            <li>
                <a href="<?=DEFAULT_URL?>/members/<?=PROMOTION_FEATURE_FOLDER;?>/deal.php?id=<?=$promotion->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>">
                    <?=system_showText(LANG_LABEL_EDIT);?> <?=system_showText(LANG_LABEL_INFORMATION);?>
                </a>
            </li>
            <? 
            if ($listing->getString("title")) { 
                ?>
                <li>
                    <a href="<?=DEFAULT_URL?>/members/<?=PROMOTION_FEATURE_FOLDER;?>/relationship.php?id=<?=$promotion->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>">
                        <?=system_showText(LANG_REMOVE_ASSOCIATION_WITH)?> <?=system_showText(LANG_LISTING_FEATURE_NAME)?></a>: 
                    <a href="<?=DEFAULT_URL?>/members/<?=LISTING_FEATURE_FOLDER;?>/view.php?id=<?=$listing->getNumber("id")?>" class="link-view">
                        <span class="link-view-second"><b><?=$listing->getString("title")?></b></span>
                    </a>
                </li>
                <? 
            } 
            ?>
            <li>
                <a href="<?=DEFAULT_URL?>/members/<?=PROMOTION_FEATURE_FOLDER;?>/delete.php?id=<?=$promotion->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>">
                    <?=system_showText(LANG_PROMOTION_DELETE);?>
                </a>
            </li>
        </ul>

        <ul class="list-view columnListView secondaryListView">
            <?
            if ($review_enabled == "on" && $commenting_edir) { 
                ?>
                <li>
                    <span class="ratings">
                        <a href="<?=DEFAULT_URL?>/members/review/index.php?item_type=promotion&item_id=<?=$id?>&filter_id=1&item_screen=<?=$item_screen?>&item_letter=<?=$item_letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                            <?=string_ucwords(system_showText(LANG_REVIEW_PLURAL))?>
                        </a>
                    </span>
                </li>
                <?
            } 
            ?>
        </ul>

        <h2 class="standardSubTitle">
            <?=system_showText(LANG_PROMOTION_PREVIEW);?>
        </h2>
        <center>
            <a href="<?=DEFAULT_URL?>/members/<?=PROMOTION_FEATURE_FOLDER;?>/preview.php?id=<?=$promotion->getNumber("id")?>" class="standardLINK iframe fancy_window_preview">
                <?=system_showText(LANG_MSG_CLICK_TO_PREVIEW_THIS_PROMOTION);?>
            </a>
        </center>

        <?
        include(INCLUDES_DIR."/views/view_deal.php");
        ?>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){

            $(".checkout").click(function(){
                code=$(this).attr("code");

                $("div[code="+code+"]").html("<?=LANG_DEAL_SAVING?>");
                $("input:checkbox[code="+code+"]").attr("disabled", "disabled");
                if ($(this).attr("checked")){
                    // turned on
                    $("input:checkbox[code="+code+"]").attr("checked", "checked");
                    $.post("<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=PROMOTION_FEATURE_FOLDER?>/deal.php",{action:"useDeal",promotion_id:code}, function(data) {
                        $("div[code="+code+"]").html("<?=DEAL_SITEMGR_USED?>");
                    });
                } else {
                    // turned off
                    $("input:checkbox[code="+code+"]").removeAttr("checked");
                    $.post("<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=PROMOTION_FEATURE_FOLDER?>/deal.php",{action:"freeUpDeal",promotion_id:code}, function(data) {
                        $("div[code="+code+"]").html("<?=DEAL_SITEMGR_AVAILABLE?>");
                    });
                }
                $("input:checkbox[code="+code+"]").removeAttr("disabled");

            });
        });
    </script>

<?
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>