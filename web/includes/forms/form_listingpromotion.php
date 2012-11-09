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
    # * FILE: /includes/forms/form_listingpromotion.php
    # ----------------------------------------------------------------------------------------------------

    if ($message_listingpromotion) {
        echo "<p class=\"errorMessage\">$message_listingpromotion</p>";
    } 
    ?>
    <table border="0" cellpadding="0" cellspacing="0" class="standard-table">    
        <tr>
            <th>* <?=system_showText(LANG_PROMOTION_TITLE)?>:</th>
            <td>
                <? if($promotion_name){ ?>
                    <a href="javascript:void(0);" onclick="javascript:showSearchPromotion('show');" id="aux_promotion_name">
                        <?=$promotion_name;?>
                    </a>
                <? } ?>
                <input type="text" name="promotion_name" value="<?=($promotion_name ? $promotion_name : "")?>" id="promotion_name" style="display:<?=($promotion_name ? "none" : "block")?>"/>
                <span id="promotion_name_tip" style="display:<?=($promotion_name ? "none" : "block")?>"><?=system_showText(LANG_DEAL_LISTING_TIP)?></span>
                <span id="promotion_name_cancel_button" style="display:none">
                    <a href="javascript:void(0)" onclick="javascript:showSearchPromotion('hide')">
                        <?=($members ? system_showText(LANG_CANCEL) : system_showText(LANG_SITEMGR_CANCEL))?>
                    </a>
                    |
                    <a href="javascript:void(0)" onclick="javascript:showSearchPromotion('empty')">
                        <?=($members ? system_showText(LANG_EMPTY) : system_showText(LANG_SITEMGR_EMPTY))?>
                    </a>
                </span>
            </td>
        </tr>
    </table>