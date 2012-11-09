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
	# * FILE: /sitemgr/listing/deal.php
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

	$url_redirect = "".DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/listing_promotion.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

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

<div id="main-right">

	<div id="top-content">
		<div id="header-content"><h1><?=system_showText(LANG_SITEMGR_PROMOTION_SING)?> - <?=$listing->getString("title")?></h1></div>
	</div>

	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<?if (CUSTOM_PROMOTION_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? } else { ?>

                <? include(INCLUDES_DIR."/tables/table_listing_submenu.php"); ?>

                <p class="informationMessage">
                    <?=system_showText(LANG_SITEMGR_PROMOTION_TIP1)?><br />
                    <?=system_showText(LANG_SITEMGR_PROMOTION_TIP2)?><br />
                    <?=system_showText("&#149;&nbsp".LANG_SITEMGR_PROMOTION_TIP3)?><br />
                    <?=system_showText("&#149;&nbsp".LANG_SITEMGR_PROMOTION_TIP4)?><br />
                </p>
                
                <? if (!$promotion_id){ ?>
                    <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
                        <tr>
                            <th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_NEW)?> <?=system_showText(LANG_SITEMGR_PROMOTION_SING)?></th>
                        </tr>
                        <tr>
                            <td class="alignTop width100">
                                <input type="button" name="new_promotion" value="<?=system_showText(LANG_SITEMGR_ADDNEW)?> <?=system_showText(LANG_SITEMGR_PROMOTION)?>" class="input-button-form" onclick="javascript:document.location='<?=DEFAULT_URL?>/sitemgr/<?=PROMOTION_FEATURE_FOLDER?>/deal.php?listing_id=<?=$listing->getNumber("id")?><?=(($url_search_params) ? "&$url_search_params" : "");?>';" style="width: 200px; height: 29px; border: none; font-weight: bold; color: #FFF; font-size:12px;" />
                                <span><a href="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/preview.php?id=<?=$listing->getNumber("id")?>&listings_promotion_page=true" class="iframe fancy_window_preview"><?=system_showText(LANG_SITEMGR_PROMOTION_WILLAPPEARHERE)?></a></span>
                            </td>
                        </tr>
                    </table>
                <? } ?>
                
				<table border="0" cellpadding="0" cellspacing="0" class="standard-table" style="margin-bottom: 0;">
					<tr>
						<th class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_PROMOTION_ASSOCIATE)?></th>
					</tr>
				</table>
				
                <div class="baseForm">

                    <form name="promotion" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?=$id?>" />
                        <input type="hidden" name="listing_id" value="<?=$listing_id?>">
                        <input type="hidden" name="promotion_id" id="promotion_id" value="<?=$promotion_id?>" />
                        <input type="hidden" name="letter" value="<?=$letter?>" />
                        <input type="hidden" name="screen" value="<?=$screen?>" />
                        <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>

                        <? include(INCLUDES_DIR."/forms/form_listingpromotion.php"); ?>
                        <div id="promotion_list"></div>

                        <button type="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

                        <button type="button" value="Cancel" class="input-button-form" onclick="document.getElementById('formlistingpromotioncancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

                    </form>
                    <form id="formlistingpromotioncancel" action="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">
                        <input type="hidden" name="letter" value="<?=$letter?>" />
                        <input type="hidden" name="screen" value="<?=$screen?>" />
                        <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
                    </form>
			
                </div>
			<? } ?>

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
