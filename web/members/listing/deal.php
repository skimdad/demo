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
    # * FILE: /members/listing/deal.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # VALIDATION
    # ----------------------------------------------------------------------------------------------------
    if ( PROMOTION_FEATURE != 'on' || CUSTOM_PROMOTION_FEATURE != "on" ) exit;

    # ----------------------------------------------------------------------------------------------------
    # SESSION
    # ----------------------------------------------------------------------------------------------------
    sess_validateSession();
    $acctId = sess_getAccountIdFromSession();

    # ----------------------------------------------------------------------------------------------------
    # AUX
    # ----------------------------------------------------------------------------------------------------
    extract($_GET);
    extract($_POST);

    $url_redirect = "".DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER;
    $url_base = "".DEFAULT_URL."/members";
    $members = 1;

    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/listing_promotion.php");

    # ----------------------------------------------------------------------------------------------------
    # HEADER
    # ----------------------------------------------------------------------------------------------------
    include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

    # ----------------------------------------------------------------------------------------------------
    # NAVBAR
    # ----------------------------------------------------------------------------------------------------
    include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

    $level = new ListingLevel($listing->getNumber("level"));

?>
    <script type="text/javascript">
        
        function getPromotions(){
        
            $('#promotion_name').autocomplete(
                '<?=DEFAULT_URL;?>/includes/code/promotion_ajax.php?<?=($_GET["id"] ? "listing_id=".$_GET["id"] : "");?>&domain_id=<?=SELECTED_DOMAIN_ID?>&account_id=<?=$account_id?>',{
                delay:1000,
                dataType:'html',
                minChars:3,
                matchSubset:0,
                selectFirst:0,
                matchContains:1,
                cacheLength:100,
                autoFill:false,
                maxItemsToShow:100,
                max:100
            }).result(function(event, item) {
                $('#promotion_id').val(item[1]);                
            });
        }

        function showSearchPromotion(option_show){
            if(option_show == 'show'){
                $("#aux_promotion_name").hide('slow');
                $("#promotion_name_tip").show('slow');
                $("#promotion_name").show('slow',function(){
                    $("#promotion_name_cancel_button").show();
                });
            }else if(option_show == 'hide'){
                $("#promotion_name_tip").hide('slow');
                $("#promotion_name").hide('slow',function(){
                    $("#promotion_name_cancel_button").hide();
                });
                $("#aux_promotion_name").show('slow');
            }else if(option_show == 'empty'){

                /**
                * Will remove the promotion_id on Listing table
                */
                $.post('<?=DEFAULT_URL;?>/includes/code/promotion_attachlisting.php', {
                        request: 'ajax',
                        domain_id: '<?=SELECTED_DOMAIN_ID;?>',
                        remove_listing: true,
                        listing_id: <?=($id ? $id : 0)?>
                        }, function(res){
                            if(res == "ok"){
                                $("#promotion_name_cancel_button").hide();
                                $("#promotion_name").val('');
                                $("#promotion_id").val(0);
                        }
                });
            }
        }
    
        $(document).ready(function(){
            getPromotions();

        });
        
    </script>
    
    
    <div class="content">

        <? 
        require(EDIRECTORY_ROOT."/sitemgr/registration.php"); 
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); 
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); 
        ?>

        <h2>
            <?=system_showText(LANG_LISTING_PROMOTION)?> - <?=$listing->getString("title")?>
        </h2>
        
        <p class="informationMessage">
            <?=system_showText(LANG_LISTING_PROMOTION_IS_LINKED)?><br />
            <?=system_showText(LANG_LISTING_TO_BE_ACTIVE_PROMOTION)?>:<br />
            <?=system_showText("&#149;&nbsp".LANG_LISTING_END_DATE_IN_FUTURE)?><br />
            <?=system_showText("&#149;&nbsp".LANG_LISTING_ASSOCIATED_WITH_LISTING)?><br />
        </p>
        
        <? if (!$promotion_id){ ?>
            <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
                <tr>
                    <th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_ADDNEWPROMOTION)?></th>
                </tr>
                <tr>
                    <td class="alignTop width100">
                        <input type="button" name="new_promotion" value="<?=system_showText(LANG_LABEL_ADDANEWPROMOTION)?>" class="input-button-form" onclick="javascript:document.location='<?=DEFAULT_URL?>/members/<?=PROMOTION_FEATURE_FOLDER?>/deal.php?listing_id=<?=$listing->getNumber("id")?><?=(($url_search_params) ? "&$url_search_params" : "");?>';" style="width: 200px; height: 29px; border: none; font-weight: bold; color: #FFF; font-size:12px;" />
                        <span><a href="<?=DEFAULT_URL?>/members/<?=LISTING_FEATURE_FOLDER;?>/preview.php?id=<?=$listing->getNumber("id")?>&listings_promotion_page=true" class="iframe fancy_window_preview"><?=system_showText(LANG_MSG_PROMOTION_WILL_APPEAR_HERE)?></a></span>
                    </td>
                </tr>
            </table>
        <? } ?>

        <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
            <tr>
                <th class="standard-tabletitle">
                    <?=system_showText(LANG_MSG_ASSOCIATE_EXISTING_PROMOTION)?>:
                </th>
            </tr>
        </table>
        
        <form name="promotion" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$id?>" />    
            <input type="hidden" name="listing_id" value="<?=$listing_id?>" />
            <input type="hidden" name="promotion_id" id="promotion_id" value="<?=$promotion_id?>" />
            <input type="hidden" name="letter" value="<?=$letter?>" />
            <input type="hidden" name="screen" value="<?=$screen?>" />

            <? include(INCLUDES_DIR."/forms/form_listingpromotion.php"); ?>
            <div id="promotion_list"></div>
            <div class="baseButtons floatButtons">
                <p class="standardButton">
                    <button type="submit" value="Submit">
                        <?=system_showText(LANG_BUTTON_SUBMIT)?>
                    </button>
                </p>
            </div>

        </form>
        <form action="<?=DEFAULT_URL?>/members/<?=LISTING_FEATURE_FOLDER;?>/index.php" method="post" style=" margin: 0; padding: 0; ">
            <input type="hidden" name="letter"  value="<?=$letter?>" />
            <input type="hidden" name="screen" value="<?=$screen?>" />

            <div class="baseButtons floatButtons noPadding">
                <p class="standardButton">
                    <button type="submit" value="Cancel">
                        <?=system_showText(LANG_BUTTON_CANCEL)?>
                    </button>
                </p>
            </div>
        </form>
    </div>

<?
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>