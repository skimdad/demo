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
    # * FILE: /sitemgr/deal/view.php
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
        if ( $promoLevelListing->getHasPromotion($level_each) == "y" ) $hasPromotion = true;
    }
    if ( PROMOTION_FEATURE != "on" ){
        exit;
    }elseif ( !$hasPromotion ){ 
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

    $url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

    # ----------------------------------------------------------------------------------------------------
    # AUX
    # ----------------------------------------------------------------------------------------------------

    if ($id) {
        $promotion = new Promotion($id);
        $listing = db_getFromDB("listing", "promotion_id", db_formatNumber($id), 1, "", "object", SELECTED_DOMAIN_ID);
        if ($promotion->getNumber("account_id")){
            $account = new Account($promotion->getNumber("account_id"));
        }
    } else {
        header("Location: ".DEFAULT_URL."/sitemgr/".PROMOTION_FEATURE_FOLDER."/".(($search_page) ? "search.php" : "index.php")."?screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
        exit;
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
                <h1><?=system_showText(LANG_SITEMGR_PROMOTION_SING)?> - <?=string_ucwords(system_showText(LANG_SITEMGR_DETAIL))?></h1>
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
                    ?>
                    <br />
                    <div id="header-view" title="<?=$promotion->getString("name")?>">
                        <?=string_ucwords(system_showText(LANG_SITEMGR_MANAGE))?> <?=system_showText(LANG_SITEMGR_PROMOTION_SING)?> - <?=$promotion->getString("name", true, 35);?>
                    </div>
                    <ul class="list-view columnListView">
                        <li>
                            <a href="<?=DEFAULT_URL?>/sitemgr/<?=PROMOTION_FEATURE_FOLDER?>/deal.php?id=<?=$promotion->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view">
                                <?=string_ucwords(system_showText(LANG_SITEMGR_EDIT))?> <?=string_ucwords(system_showText(LANG_SITEMGR_INFORMATION))?>
                            </a>
                        </li>
                        <? 
                        if ($listing->getString("title")) { ?>
                            <li>
                                <a href="<?=DEFAULT_URL?>/sitemgr/<?=PROMOTION_FEATURE_FOLDER?>/relationship.php?id=<?=$promotion->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view">
                                    <?=system_showText(LANG_SITEMGR_PROMOTION_RMASSOCWITH)?> <?=system_showText(LANG_SITEMGR_LISTING_SING)?></a>:
                                <a href="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/view.php?id=<?=$listing->getNumber("id")?>" class="link-view">
                                    <span class="link-view-second" title="<?=$listing->getString("title", true)?>"><b><?=$listing->getString("title", true, 35);?></b></span>
                                </a>
                            </li>
                            <? 
                        } 
                        ?>  
                        <li>
                            <a href="<?=DEFAULT_URL?>/sitemgr/<?=PROMOTION_FEATURE_FOLDER?>/delete.php?id=<?=$promotion->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view">
                                <?=string_ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=system_showText(LANG_SITEMGR_PROMOTION_SING)?>
                            </a>
                        </li>
                        <li>
                            <? 
                            if (!$account) {
                                ?>
                                <em>
                                    <?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER)?>
                                </em>
                                <?
                            } else { 
                                ?>
                                <a href="<?=DEFAULT_URL?>/sitemgr/account/view.php?id=<?=$promotion->getNumber("account_id")?>" class="link-view"> <?=string_ucwords(system_showText(LANG_SITEMGR_LABEL_ACCOUNT))?></a>: <span class="label-field-account" title="<?=$account->getString("username");?>">( <b><?=system_showTruncatedText(system_showAccountUserName($account->getString("username")), 50);?></b> )</span>
                                <? 
                            } 
                            ?>
                        </li>
                    </ul>
                    <ul class="list-view columnListView secondaryListView">
                        <li>
                            <span class="ratings">
                                <a href="<?=DEFAULT_URL?>/sitemgr/review/index.php?item_type=promotion&item_id=<?=$id?>&filter_id=1&item_screen=<?=$item_screen?>&item_letter=<?=$item_letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>"><?=string_ucwords(system_showText(LANG_SITEMGR_VIEW))?> <?=string_ucwords(system_showText(LANG_SITEMGR_REVIEWS))?></a>
                            </span>
                        </li>
                        <li>
                            <strong>
                                <?=system_showText(LANG_SITEMGR_LASTUPDATED)?>:
                            </strong> 
                            <span class="label-field-account">
                                <?=format_date($promotion->getNumber("updated"),DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($promotion->getNumber("entered"))?>
                            </span>
                        </li>
                        <li>
                            <strong>
                                <?=system_showText(LANG_SITEMGR_DATECREATED)?>:
                            </strong> 
                            <span class="label-field-account">
                                <?=format_date($promotion->getNumber("entered"),DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($promotion->getNumber("entered"))?>
                            </span>
                        </li>
                    </ul>

                    <br class="clear" />

                    <div id="header-view">
                        <?=system_showText(LANG_SITEMGR_PROMOTION_SING)?> <?=string_ucwords(system_showText(LANG_SITEMGR_PREVIEW))?>
                    </div>
                    <center>
                        <a href="<?=DEFAULT_URL?>/sitemgr/<?=PROMOTION_FEATURE_FOLDER?>/preview.php?id=<?=$promotion->getNumber("id")?>" class="standardLINK iframe fancy_window_preview"><?=ucfirst(system_showText(LANG_SITEMGR_CLICKHERETOPREVIEW))?> <?=system_showText(LANG_SITEMGR_PROMOTION_SING)?></a>
                    </center>

                    <br class="clear" />

                    <?
                    include(INCLUDES_DIR."/views/view_deal.php");
                    ?>

                    <script type="text/javascript">

                        $(document).ready(function(){

                            $(".checkout").click(function(){
                                code=$(this).attr("code");

                                $("div[code="+code+"]").html("<?=LANG_DEAL_SAVING?>");
                                $("input:checkbox[code="+code+"]").attr("disabled", "disabled");
                                if ($(this).attr("checked")){
                                    // turned on
                                    $("input:checkbox[code="+code+"]").attr("checked", "checked");
                                    $.post("<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=PROMOTION_FEATURE_FOLDER?>/deal.php",{action:"useDeal",promotion_id:code}, function(data) {
                                        $("div[code="+code+"]").html("<?=DEAL_SITEMGR_USED?>");
                                    });
                                } else {
                                    // turned off
                                    $("input:checkbox[code="+code+"]").removeAttr("checked");
                                    $.post("<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=PROMOTION_FEATURE_FOLDER?>/deal.php",{action:"freeUpDeal",promotion_id:code}, function(data) {
                                        $("div[code="+code+"]").html("<?=DEAL_SITEMGR_AVAILABLE?>");
                                    });
                                }
                                $("input:checkbox[code="+code+"]").removeAttr("disabled");

                            });
                        });
                    </script>
                    <? 
                    $sbmLink = PROMOTION_DEFAULT_URL."/results.php?id=".$promotion->getNumber("id");
                } 
                ?>
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