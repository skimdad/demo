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
    # * FILE: /includes/tables/table_promotion.php
    # ----------------------------------------------------------------------------------------------------

    setting_get('commenting_edir', $commenting_edir);
    setting_get('commenting_fb', $commenting_fb);
    setting_get("review_promotion_enabled", $review_enabled);
    
    ?>
    <script type="text/javascript">
        function getValuesBulkPromotion(){

            if(document.getElementById('change_no_owner').value == "on"){
                document.getElementById("account_search_bulk").value = "0";
            }else if (document.getElementById("change_account_id")) {
                document.getElementById("account_search_bulk").value = document.getElementById("change_account_id").value;
            }

            if (document.getElementById('delete_all').checked){
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION);?>','Submit','promotion_setting','200','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            } else {
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?>','Submit','promotion_setting','180','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            }
        }

        function confirmBulk(){
            if (document.getElementById('delete_all').checked){
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION);?>','Submit','promotion_setting','200','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            } else {
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?>','Submit','promotion_setting','180','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            }
        }   
    </script>

    <?
    $itemCount = count($promotions);

    if ($errorAttachMessage) {
        echo "<p class=\"errorMessage\">".$errorAttachMessage."</p>";
    } elseif ($successAttachMessage == "success") {
        echo "<p class=\"successMessage\">".LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATE."</p>";
    }

    if(is_numeric($message) && isset($msg_promotion[$message]) && !$errorAttachMessage && $successAttachMessage != "success"){ ?>
        <p class="successMessage"><?=$msg_promotion[$message]?></p>
        <? 
        if($extra_message && string_strpos($url_base, "/sitemgr")) { 
            ?>
            <p class="informationMessage"><?=system_showText(LANG_PROMOTION_EXTRAMESSAGE);?></p>
            <? 
        } 
    } 
    
    
    if (is_numeric($error_message)) {
        echo "<p class=\"errorMessage\">".$msg_bulkupdate[$error_message]."</p>";
    } elseif ($msg == "success") {
        echo "<p class=\"successMessage\">".LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATE."</p>";
    } elseif ($msg == "successdel") {
        echo "<p class=\"successMessage\">".LANG_MSG_PROMOTION_SUCCESSFULLY_DELETE."</p>";
    }
    unset($msg);

    if (string_strpos($_SERVER["PHP_SELF"], "search.php") === false){
        echo "<p class=\"informationMessage\">".LANG_MS_MANGE_DEAL_TIP."</p>";
    }


    if ((!string_strpos($_SERVER["PHP_SELF"], "sitemgr/search")) && (!string_strpos($_SERVER["PHP_SELF"], "getMoreResults"))){
        if (string_strpos($url_base, "/sitemgr")) { ?>
            <table class="bulkTable" border="0" cellpadding="2" cellspacing="2" >
                <tr>
                    <td>
                        <a class="bulkUpdate" href="javascript:void(0)" onclick="showBulkUpdate(<?=RESULTS_PER_PAGE?>, 'promotion', '<?=system_showText(LANG_SITEMGR_CLOSE_BULK);?>', '<?=system_showText(LANG_SITEMGR_BULK_UPDATE);?>')" id="open_bulk"><?=system_showText(LANG_SITEMGR_BULK_UPDATE);?></a>
                    </td>
                </tr>
            </table>

            <?
            if (string_strpos($_SERVER["PHP_SELF"], "/sitemgr/deal/search") !== false) {
                $actionBulk = system_getFormAction($_SERVER["REQUEST_URI"]);
            } else {
                $actionBulk = system_getFormAction($_SERVER["PHP_SELF"]);
            }
            ?>

            <form name="promotion_setting" id="promotion_setting" action="<?=$actionBulk?>" method="post">

                <input type="hidden" name="account_search_bulk" id="account_search_bulk" value="" />
                <input type="hidden" name="bulkSubmit" id="bulkSubmit" value="" />
                <div id="table_bulk" style="display: none">
                    <? include(INCLUDES_DIR."/tables/table_bulkupdate.php"); 
                    if (string_strpos($_SERVER["PHP_SELF"], "search.php") == true) { 
                        ?>
                        <button type="button" name="bulkSubmit" value="Submit" class="input-button-form" onclick="javascript:getValuesBulkPromotion();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                        <?
                    } else { 
                        ?>
                        <button type="button" name="bulkSubmit" value="Submit" class="input-button-form" onclick="javascript:confirmBulk();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                        <? 
                    } 
                    ?>
                </div>
                <div id="idlist"></div>
            </form>
            <?

        }
        include(INCLUDES_DIR."/tables/table_paging.php");
        ?>

        <div id="bulk_check" style="display:none">
            <table class="bulkTable" border="0" cellpadding="2" cellspacing="2">
                <tr>
                    <th>
                        <input type="checkbox" id="check_all" name="check_all" onclick="checkAll('promotion', document.getElementById('check_all'), false, <?=$itemCount;?>); removeCategoryDropDown('promotion', '<?=DEFAULT_URL?>');" />
                    </th>
                    <td>
                        <a class="CheckUncheck" href="javascript:void(0);" onclick="checkAll('promotion', document.getElementById('check_all'), true, <?=$itemCount;?>); removeCategoryDropDown('promotion', '<?=DEFAULT_URL?>');"><?=system_showText(LANG_CHECK_UNCHECK_ALL);?></a>
                    </td>
                </tr>
            </table>
        </div>
        <?
    }
    
    
    if ((!isset($legend))||($legend)) { 
        ?>
	<ul class="standard-iconDESCRIPTION">
            <li class="view-icon"><?=system_showText(LANG_LABEL_VIEW);?></li>
            <li class="edit-icon"><?=system_showText(LANG_LABEL_EDIT);?></li>
            <li class="seo-icon"><?=system_showText(LANG_LABEL_SEO_TUNING);?></li>
            <? 
            if (($review_enabled == "on" && $commenting_edir) || string_strpos($url_base, "/sitemgr")) { 
                ?>
                <li class="rating-icon"><?=system_showText(LANG_REVIEW);?></li>
                <? 
            } 
            if ($commenting_fb == "on") { 
                ?>
                <li class="facebook-icon"><?=system_showText(LANG_LABEL_FACEBOOK_COMMENTS);?></li>
                <? 
            } 
            ?>
            <li class="delete-icon"><?=system_showText(LANG_LABEL_DELETE);?></li>
	</ul>
        <? 
    } 
    ?>

    <form name="item_table">
	<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

            <tr>
                <th  style="width: auto;"><?=system_showText(LANG_PROMOTION_TITLE);?></th>
                <? 
                if (string_strpos($url_base, "/members")) { 
                    ?>
                    <th  style="width: 180px;"><?=system_showText(LANG_LABEL_ATTACHED_LISTING)?></th>
                    <? 
                } 
                if (string_strpos($url_base, "/sitemgr")) { 
                    ?>
                    <th style="width: 90px;"><?=system_showText(LANG_LABEL_ACCOUNT);?></th>
                    <? 
                }
                if (string_strpos($url_base, "/sitemgr")) { 
                    ?>
                    <th style="width: 16%;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
                    <? 
                } else { 
                    ?>
                    <th style="width: 18%;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
                    <? 
                } 
                ?>

            </tr>

            <?
            $cont = 0;
            foreach($promotions as $promotion) {
                $cont++;
                $id = $promotion->getNumber("id");
                ?>
                <tr class="tr-table">
                    <td class="td-table">
                        <input type="checkbox" id="promotion_id<?=$cont?>" name="item_check[]" value="<?=$id?>" class="inputCheck" style="display:none" onclick="removeCategoryDropDown('promotion', '<?=DEFAULT_URL?>');"/>
                        <a title="<?=$promotion->getString("name")?>" href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
                            <?=$promotion->getString("name", true, 40);?>
                        </a>
                    </td>
                    <? 
                    if (string_strpos($url_base, "/sitemgr")) { 
                        ?>
                        <td class="td-table">
                            <? 
                            if ($promotion->getNumber("account_id")) {
                                $account = db_getFromDB("account", "id", db_formatNumber($promotion->getNumber("account_id")));
                                ?>
                                <a title="<?=system_showAccountUserName($account->getString("username"));?>" href="<?=$url_base?>/account/view.php?id=<?=$promotion->getNumber("account_id")?>" class="link-table">
                                    <?=system_showTruncatedText(system_showAccountUserName($account->getString("username")), 15);?>
                                </a>
                                <? 
                            } else { 
                                ?>
                                <span title="<?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER)?>" style="cursor:default">
                                    <em><?=system_showTruncatedText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER, 15);?></em>
                                </span>
                                <?  
                            } 
                            ?>
                        </td>
                        <? 
                    } 

                    if (string_strpos($url_base, "/members")) { 
                        ?>
                        <td class="td-table">
                            <?=system_getAttachListingDropdown(sess_getAccountIdFromSession(), $id, $cont);?>
                        </td>
                        <?
                    }
                    ?>
                    <td class="td-table">

                        <a href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
                            <img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION)?>" />
                        </a>

                        <a href="<?=$url_redirect?>/deal.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
                            <img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_PROMOTION)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_PROMOTION)?>" />
                        </a>

                        <a href="<?=$url_redirect?>/seocenter.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table" >
                            <img src="<?=DEFAULT_URL?>/images/icon_seo.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_SEOCENTER)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_SEOCENTER)?>" />
                        </a>

                        <?
                        if (($review_enabled == "on" && $commenting_edir) || string_strpos($url_base, "/sitemgr")) {
                            $dbMain = db_getDBObject(DEFAULT_DB, true);
                            $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
                            $sql ="SELECT * FROM Review WHERE item_type = 'promotion' AND item_id = '".$promotion->getString("id")."' LIMIT 1";
                            $r = $db->query($sql);
                            if(mysql_affected_rows() > 0) {
                                ?>
                                <a href="<?=$url_base?>/review/index.php?item_type=promotion&item_id=<?=$id?>&filter_id=1&item_screen=<?=$screen?>&item_letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
                                    <img src="<?=DEFAULT_URL?>/images/img_rateMiniStarOn.png" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS);?>" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS);?>" />
                                </a>
                                <?
                            } else {
                                ?>
                                <img src="<?=DEFAULT_URL?>/images/img_rateMiniStarOff.png" border="0" alt="<?=system_showText(LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE);?>" title="<?=system_showText(LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE);?>" />
                                <?
                            }
                        }

                        if ($commenting_fb == "on") { 
                            ?>
                            <a href="<?=$url_redirect?>/facebook.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
                                <img src="<?=DEFAULT_URL?>/images/icon-facebook-comments.gif" border="0" alt="<?=system_showText(LANG_LABEL_FACEBOOK_COMMENTS)?>" title="<?=system_showText(LANG_LABEL_FACEBOOK_COMMENTS)?>" />
                            </a>
                            <? 
                        } 
                        ?>

                        <a href="<?=$url_redirect?>/delete.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table" >
                            <img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_PROMOTION)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_PROMOTION)?>" />
                        </a>

                    </td>
                </tr>
                <? 
            } 
            ?>
	</table>
	<? 
        if (string_strpos($url_base, "/members")) { 
            ?>
            <input type="hidden" name="total_promotion" id="total_promotion" value="<?=$cont?>" />
            <?
        }
        ?>
    </form>
    <? 
    if ((!isset($legend))||($legend)) { ?>
	<ul class="standard-iconDESCRIPTION">
            <li class="view-icon"><?=system_showText(LANG_LABEL_VIEW);?></li>
            <li class="edit-icon"><?=system_showText(LANG_LABEL_EDIT);?></li>
            <li class="seo-icon"><?=system_showText(LANG_LABEL_SEO_TUNING);?></li>
            <? 
            if (($review_enabled == "on" && $commenting_edir) || string_strpos($url_base, "/sitemgr")) { 
                ?>
                <li class="rating-icon"><?=system_showText(LANG_REVIEW);?></li>
                <? 
            } 
            if ($commenting_fb == "on") { 
                ?>
                <li class="facebook-icon"><?=system_showText(LANG_LABEL_FACEBOOK_COMMENTS);?></li>
                <?
            } 
            ?>
            <li class="delete-icon"><?=system_showText(LANG_LABEL_DELETE);?></li>
	</ul>
        <? 
    } 
    ?>