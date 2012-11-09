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
    # * FILE: /includes/forms/form_promotion.php
    # ----------------------------------------------------------------------------------------------------

    if (!is_numeric($realvalue)){
        $realvalue = 0;
    }
    if (!is_numeric($dealvalue)){
        $dealvalue = 0;
    }
    
    if ($deal_type == "percentage") {
        $aux_deal_type = "%";
    } else {
        $aux_deal_type = CURRENCY_SYMBOL;
    }

    $amount = (int)$amount;
    if ($amount<0){
        $amount = ($amount*(-1));
    }
    ?>
    <? if (!$members) { ?>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>
    <? } ?>
    
    <script language="javascript" type="text/javascript">
        
        var arrLangNumbers	= ('<?=EDIR_LANGUAGENUMBERS;?>').split(',');
        
        function calculateDiscount(){

            var percentage = false;
            var realvalue = Number($('#real_price_int').val() + "." + $('#real_price_cent').val());
            var dealvalue = Number($('#deal_price_int').val() + "." + $('#deal_price_cent').val());

            if (document.getElementById("type_percentage").checked){
                percentage = true;
            }

            if (realvalue!='NaN' && dealvalue!='NaN' ){
                if (realvalue<0)
                    realvalue=realvalue*(-1);
                
                if (dealvalue<0)
                    dealvalue=dealvalue*(-1);

                if ((dealvalue>realvalue) && (percentage == false)){
                    $('#amountDiscountMessage').html("<?=system_showText(LANG_MSG_VALID_MINOR)?>");
                    $('#discountAmount').html('');
                } else {
                    $('#amountDiscountMessage').html('');
                    if (percentage){
                        discount = realvalue - ((dealvalue*realvalue)/100);
                    } else {
                        discount = 100 - ((dealvalue*100)/realvalue);
                    }
                    if (!isNaN(discount) && discount>=0){
                        if (discount > 100 && !percentage)
                            discount = 100;
                        
                        if (percentage){
                            $('#discountAmount').html('<?=CURRENCY_SYMBOL?>'+discount.toFixed(2));
                        } else {
                            $('#discountAmount').html(parseInt(discount)+'%');
                        }

                    }
                }

            }
        }

        function showAmountType(type, show) {
            if (type == '%') {
                document.getElementById('amount_monetary').innerHTML = ':';
                document.getElementById('amount_percentage').innerHTML = type;
                document.getElementById('amount_percentage').style.display = '';
                document.getElementById('label_deal_cent').style.display = 'none';
                $('#discountAmount').html('');
                $('#amountDiscountMessage').html('');
                if (show == "not"){
                    document.getElementById('deal_price_int').value = '';
                    document.getElementById('deal_price_cent').value = '';
                }
                document.getElementById('deal_price_int').setAttribute('maxlength', 2);
            } else {
                document.getElementById('amount_monetary').innerHTML = " ("+type+"):";
                document.getElementById('amount_percentage').innerHTML = '';
                document.getElementById('label_deal_cent').style.display = '';
                $('#discountAmount').html('');
                $('#amountDiscountMessage').html('');
                if (show == "not"){
                    document.getElementById('deal_price_int').value = '';
                }
                document.getElementById('deal_price_int').setAttribute('maxlength', 5);
            }
        }

        function showLangFields(type1, type2, type3, type4, type5, num_language, languages) {

            var arrLangNumbers = ('<?=EDIR_LANGUAGENUMBERS;?>').split(',');

            for (j=0;j<languages;j++) {
                i = arrLangNumbers[j];
                jQuery('#'+type1+'_'+i).addClass('isHidden').removeClass('isVisible');
                jQuery('#tab_'+type1+'_'+i).removeClass("tabActived");
                jQuery('#'+type2+'_'+i).addClass('isHidden').removeClass('isVisible');
                jQuery('#tab_'+type2+'_'+i).removeClass("tabActived");
                jQuery('#'+type3+'_'+i).addClass('isHidden').removeClass('isVisible');
                jQuery('#tab_'+type3+'_'+i).removeClass("tabActived");
                jQuery('#'+type4+'_'+i).addClass('isHidden').removeClass('isVisible');
                jQuery('#tab_'+type4+'_'+i).removeClass("tabActived");
                jQuery('#'+type5+'_'+i).addClass('isHidden').removeClass('isVisible');
                jQuery('#tab_'+type5+'_'+i).removeClass("tabActived");
            }    
            jQuery('#'+type1+'_'+num_language).removeClass('isHidden').addClass('isVisible');
            jQuery('#tab_'+type1+'_'+num_language).addClass("tabActived");
            jQuery('#'+type2+'_'+num_language).removeClass('isHidden').addClass('isVisible');
            jQuery('#tab_'+type2+'_'+num_language).addClass("tabActived");
            jQuery('#'+type3+'_'+num_language).removeClass('isHidden').addClass('isVisible');
            jQuery('#tab_'+type3+'_'+num_language).addClass("tabActived");
            jQuery('#'+type4+'_'+num_language).removeClass('isHidden').addClass('isVisible');
            jQuery('#tab_'+type4+'_'+num_language).addClass("tabActived");
            jQuery('#'+type5+'_'+num_language).removeClass('isHidden').addClass('isVisible');
            jQuery('#tab_'+type5+'_'+num_language).addClass("tabActived");
        }

        function showDealTime(op, aux){
            if (op == "up"){
                $('#img_customtime').html("<img src=\""+DEFAULT_URL+"/images/bg_arrow_close_black.gif\" />");
                $('#tableDealtime').slideUp('slow');	
            } else {
                if (aux == "check")
                $('#visibility2').attr('checked', true);
                $('#img_customtime').html("<img src=\""+DEFAULT_URL+"/images/bg_arrow_open_black.gif\" />");
                $('#tableDealtime').slideDown('slow');
            }
        }

        function showSearchListing(option_show){
            if(option_show == 'show'){
                $("#aux_listing_title").hide('slow');
                $("#listing_title_tip").show('slow');
                $("#listing_title").show('slow',function(){
                    $("#listing_title_cancel_button").show();
                });
            }else if(option_show == 'hide'){
                $("#listing_title_tip").hide('slow');
                $("#listing_title").hide('slow',function(){
                    $("#listing_title_cancel_button").hide();
                });
                $("#aux_listing_title").show('slow');
            }else if(option_show == 'empty'){

                /**
                * Will remove the promotion_id on Listing table
                */
                $.post('<?=DEFAULT_URL;?>/includes/code/promotion_attachlisting.php', {
                    request: 'ajax',
                    domain_id: '<?=SELECTED_DOMAIN_ID;?>',
                    remove_listing: true,
                    <?php //listing_id: <?=($aux_listing_id ? $aux_listing_id : 0)?>
                    promotion_id: <? echo ($id ? $id : 0)?>
                    }, function(res){
                        if(res == "ok"){
                            $("#listing_title_cancel_button").hide();
                            $("#listing_title").val('');
                            $("#listing_id").val(0);
                    }
                });
            }
        }
        
        function showListings(acc_id) {
            var child = document.getElementById("listing_title");
            var parent = document.getElementById("listing_title_div");
            var new_title = document.createElement("input");
            
            parent.removeChild(child);
            new_title.setAttribute("id", "listing_title");
            new_title.setAttribute("type", "text");
            new_title.setAttribute("name", "listing_title");
            parent.appendChild(new_title);
            
            $("#aux_listing_title").hide();
            showSearchListing("empty");
            
            $('#listing_title').autocomplete(
                '<?=DEFAULT_URL;?>/includes/code/promotion_attachlisting.php?<?=($aux_listing_id ? "listing_id=".$aux_listing_id : "");?>&domain_id=<?=SELECTED_DOMAIN_ID?>&account_id='+acc_id,{
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
                $('#listing_id').val(item[1]);                
            });
        }
       
        $(document).ready(function(){ 
            for (j=0;j<arrLangNumbers.length;j++) {
                i = arrLangNumbers[j];
                var field_name = 'promotiondesc'+i;
                var field_name2 = 'conditions'+i;
                var count_field_name = 'promotiondesc_remLen'+i;
                var count_field_name2 = 'conditions_remLen'+i;

                var options = {
                    'maxCharacterSize': 250,
                    'originalStyle': 'originalTextareaInfo',
                    'warningStyle' : 'warningTextareaInfo',
                    'warningNumber': 40,
                    'displayFormat' : '<span><input readonly="readonly" type="text" id="'+count_field_name+'" name="'+count_field_name+'" size="3" maxlength="3" value="#left" class="textcounter" disabled="disabled" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>' 
                };

                var options2 = {
                    'maxCharacterSize': 1000,
                    'originalStyle': 'originalTextareaInfo',
                    'warningStyle' : 'warningTextareaInfo',
                    'warningNumber': 40,
                    'displayFormat' : '<span><input readonly="readonly" type="text" id="'+count_field_name2+'" name="'+count_field_name2+'" size="3" maxlength="3" value="#left" class="textcounter" disabled="disabled" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>' 
                };

                $('#'+field_name).textareaCount(options);
                $('#'+field_name2).textareaCount(options2);

            }

            $('#listing_title').autocomplete(
                '<?=DEFAULT_URL;?>/includes/code/promotion_attachlisting.php?<?=($aux_listing_id ? "listing_id=".$aux_listing_id : "");?>&domain_id=<?=SELECTED_DOMAIN_ID?>&account_id='+<?=$account_id ? $account_id : 0?>,{
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
                $('#listing_id').val(item[1]);                
            });

            showAmountType('<?=$aux_deal_type?>','show');
            calculateDiscount();
        });

    </script>

    <p class="informationMessage">* <?=system_showText(LANG_LABEL_REQUIRED_FIELD)?> </p>
    <?
    if ($message_promotion) { 
        echo "<p class=\"errorMessage\">";
        echo $message_promotion ;
        echo "</p>";
    }
    ?>
    
    <? // Account Search ////////////////////////////////////////////////////////////////// ?>
    <? if (!$members ) {
        ?>

        <table cellpadding="0" cellspacing="0" border="0" class="standard-table" style="margin-bottom: 0;">
            <tr>
                <th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_LABEL_ACCOUNT)?> <span><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_TOACCOUNT_SPAN)?></span></th>
            </tr>
        </table>

        <?
        $acct_search_table_title = system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECT_DEFAULT);
        $acct_search_field_name = "account_id";
        $acct_search_field_value = $account_id;
        $acct_search_required_mark = false;
        $acct_search_form_width = "95%";
        $acct_search_cell_width = "";
        $return = system_generateAjaxAccountSearch($acct_search_table_title, $acct_search_field_name, $acct_search_field_value, $acct_search_required_mark, $acct_search_form_width, $acct_search_cell_width,true);
        echo $return;
        ?>

    <? } ?>
    <? //////////////////////////////////////////////////////////////////////////////////// ?>

    <input type="hidden" name="listing_id" id="listing_id" value="<?=($aux_listing_id ? $aux_listing_id : ($_GET["listing_id"] ? $_GET["listing_id"] : ""));?>" />

    <table border="0" cellpadding="2" cellspacing="0" class="standard-table">
        <tr>
            <th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_INFORMATION);?></th>
        </tr>
            <th>* <?=system_showText(LANG_PROMOTION_TITLE)?>:</th>
            <td>
                <input type="text" name="name" value="<?=$name?>" maxlength="100" <?=(!$id) ? " onblur=\"easyFriendlyUrl(this.value, 'friendly_url', '".FRIENDLYURL_VALIDCHARS."', '".FRIENDLYURL_SEPARATOR."');\" " : ""?> />
                <span><?=system_showText(LANG_MSG_DEALTITLE_TIP)?></span>
                <input type="hidden" name="friendly_url" id="friendly_url" value="<?=$friendly_url?>" maxlength="150" />
            </td>
        </tr>
        <tr>
            <th class="nowrap">
                <?=system_showText(LANG_DEAL_LISTING_SELECT);?>:
            </th>
            <td id="listingContent">
                <?
                if($aux_listing_title){
                    ?>
                    <a href="javascript:void(0);" onclick="showSearchListing('show');" id="aux_listing_title">
                        <?=$aux_listing_title;?>
                    </a>
                    <?
                }
                ?>
                <div id="listing_title_div">
                    <input type="text" name="listing_title" value="<?=($aux_listing_title ? $aux_listing_title : "")?>" id="listing_title" style="display:<?=($aux_listing_id ? "none" : "block")?>"/>
                </div>
                <span id="listing_title_tip" style="display:<?=($aux_listing_id ? "none" : "block")?>"><?=system_showText(LANG_DEAL_LISTING_TIP)?></span>
                <span id="listing_title_cancel_button" style="display:none">
                    <a href="javascript:void(0)" onclick="showSearchListing('hide');">
                        <?=($members ? system_showText(LANG_CANCEL) : system_showText(LANG_SITEMGR_CANCEL))?>
                    </a>
                    |
                    <a href="javascript:void(0)" onclick="showSearchListing('empty');">
                        <?=($members ? system_showText(LANG_EMPTY) : system_showText(LANG_SITEMGR_EMPTY))?>
                    </a>
                </span>
            </td>
        </tr>

    </table>
    
    <div class="multilanguageContent">

        <table border="0" cellpadding="2" cellspacing="0" class="standard-table">
            <tr>
                <td class="tabsBase">
                <?
                $array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
                $num_languages = count(explode(",", EDIR_LANGUAGENAMES));
                $language_numbers = explode(",", EDIR_LANGUAGENUMBERS);
                $labelsuffix = "";
                ?>
                <ul class="tabs">
                    <? 
                    foreach ($language_numbers as $k=>$i) { ?>
                        <li id="tab_offer_<?=$i?>" <?=($k == 0) ? "class=\"tabActived\"" : ""?>>
                            <a href="javascript:void(0)" onclick="showLangFields('offer', 'description', 'long_description', 'conditions', 'keywords', '<?=$i?>', '<?=$num_languages?>')">
                                <?=$array_edir_languagenames[$k]?>
                            </a>
                        </li>
                        <? 
                    } 
                    ?>
                    </ul>
                </td>
            </tr>
        </table>

        <table border="0" cellpadding="2" cellspacing="0" class="standard-table">

            <tr>
                <th colspan="2" class="standard-tabletitle">
                    <?=system_showText(LANG_LABEL_SUMMARY_DESCRIPTION)?> <span>(<?=string_strtolower(system_showText(LANG_MSG_MAX_250_CHARS))?>)</span>
                </th>
            </tr>
            <?
            foreach ($language_numbers as $k=>$i) {
                $labelsuffix = $i;
                ?>
                <tr id="description_<?=$i?>" <?=($k == 0) ? "class=\"isVisible\"" : "class=\"isHidden\""?> >
                    <td>
                        <textarea id="promotiondesc<?=$labelsuffix;?>" name="description<?=$labelsuffix;?>" rows="5" cols="1" class="input-textarea-form-listing"><?=${"description".$labelsuffix};?></textarea>
                        <div id="textAreaCallback1_<?=$labelsuffix;?>"></div>
                    </td>
                </tr>
                <?
            } 
            ?>
        </table>

        <table border="0" cellpadding="2" cellspacing="0" class="standard-table">

            <tr>
                <th colspan="2" class="standard-tabletitle">
                    <?=system_showText(LANG_LABEL_DESCRIPTION)?>
                </th>
            </tr>
            <?
            foreach ($language_numbers as $k=>$i) {
                $labelsuffix = $i;
                ?>
                <tr id="long_description_<?=$i?>" <?=($k == 0) ? "class=\"isVisible\"" : "class=\"isHidden\""?> >
                    <td>
                        <textarea name="long_description<?=$labelsuffix;?>" rows="5"  class="input-textarea-form-listing"><?=${"long_description".$labelsuffix};?></textarea>
                    </td>
                </tr>
                <?
            } 
            ?>
        </table>

        <table border="0" cellpadding="0" cellspacing="0" class="standard-table">

            <tr>
                <th class="standard-tabletitle">
                    <?=system_showText(LANG_LABEL_CONDITIONS)?> <span>(<?=string_strtolower(system_showText(LANG_MSG_MAX_1000_CHARS))?>)</span>
                </th>
            </tr>
            <?
            foreach ($language_numbers as $k=>$i) {
                $labelsuffix = $i;
                ?>
                <tr id="conditions_<?=$i?>" <?=($k == 0) ? "class=\"isVisible\"" : "class=\"isHidden\""?> >
                    <td>
                        <textarea id="conditions<?=$labelsuffix;?>" name="conditions<?=$labelsuffix;?>" rows="5" cols="1" class="input-textarea-form-listing"><?=${"conditions".$labelsuffix};?></textarea>
                        <div id="textAreaCallback2_<?=$labelsuffix;?>"></div>
                    </td>
                </tr>
                <?
            } 
            ?>
        </table>

        <table cellpadding="0" cellspacing="0" border="0" class="standard-table noMargin">
            <tr>
                <th colspan="2" class="standard-tabletitle">
                    <?=system_showText(LANG_LABEL_KEYWORDS_FOR_SEARCH)?> 
                    <span>
                        (<?=system_showText(LANG_LABEL_MAX);?> <?=MAX_KEYWORDS?> <?=system_showText(LANG_LABEL_KEYWORDS);?>)
                    </span>
                    <img src="<?=DEFAULT_URL?>/images/icon_interrogation.gif" alt="?" title="<?=system_showText(LANG_MSG_INCLUDE_UP_TO_KEYWORDS)?> <?=MAX_KEYWORDS?> <?=system_showText(LANG_MSG_KEYWORDS_WITH_MAXIMUM_50)?>" border="0" />
                </th>
            </tr>
            <tr>
                <td colspan="2" class="standard-tableContent">
                    <table border="0" cellpadding="0" cellspacing="0" align="center">
                        <tr>
                            <th><?=system_showText(LANG_MSG_KEYWORD_PER_LINE)?></th>
                            <td>
                            <?=system_showText(LANG_KEYWORD_SAMPLE_1);?><br />
                            <?=system_showText(LANG_KEYWORD_SAMPLE_2);?><br />
                            <?=system_showText(LANG_KEYWORD_SAMPLE_3);?><br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?
            foreach ($language_numbers as $k=>$i) {
                $labelsuffix = $i;
                ?>
                <tr id="keywords_<?=$i?>" <?=($k == 0) ? "class=\"isVisible\"" : "class=\"isHidden\""?> >
                    <td>
                        <textarea name="keywords<?=$labelsuffix;?>" rows="5"><?=${"keywords".$labelsuffix}?></textarea>
                    </td>
                </tr>
                <? 
            } 
            ?>
        </table>

    </div>

    <table border="0" cellpadding="2" cellspacing="0" class="standard-table noBackground">
        <tr>
            <th colspan="4" class="standard-tabletitle">
                <?=system_showText(LANG_LABEL_PROMOTION_DATE)?>
            </th>
        </tr>
        <tr>
            <th class="alignTop" style="padding-left:20px;">
                * <?=system_showText(LANG_LABEL_START_DATE)?>:
            </th>
            <td>
                <input type="text" name="start_date" id="start_date" value="<?=$start_date?>" style="width:85px" /><span> (<?=format_printDateStandard()?>)</span>
            </td>
            <th class="alignTop">
                * <?=system_showText(LANG_LABEL_END_DATE)?>:
            </th>
            <td style="padding-right:120px;">
                <input type="text" name="end_date" id="end_date" value="<?=$end_date?>" style="width:85px" /><span> (<?=format_printDateStandard()?>)</span>
            </td>
        </tr>
    </table>

    <table border="0" cellpadding="2" cellspacing="0" class="standard-table noBackground">
        <tr>
            <th colspan="2" class="standard-tabletitle">
                <?=system_showText(LANG_SITEMGR_VISIBILITY)?>
            </th>
        </tr>
        <tr>
            <th class="table-subtitle" colspan="4">
                * <?=system_showText(LANG_SITEMGR_DEALSHOWUP)?> <?=system_showText(LANG_SITEMGR_DEALSEARCHES_NEARBY)?>.
            </th>
        </tr>
        <tr>
            <td class="center-line">
                <input type="radio" id="visibility1" class="visibility" name="visibility" onclick="showDealTime('up', '');" value="0" <?=( ($visibility_start==24 && $visibility_end==24) || (!$id) )?' checked="checked" ':''?> style="width:auto" /> <span><?=system_showText(LANG_SITEMGR_TWFOURHOURSDAY)?></span>
                <input type="radio" id="visibility2" class="visibility" name="visibility" onclick="showDealTime('down', '');" value="1"<?= ($visibility_start!=24 && $visibility_end!=24) && $id||$visibility?' checked="checked" ':''?> style="width:auto" /> <span><?=system_showText(LANG_SITEMGR_CUSTOMPERIOD)?> <label id="img_customtime" onclick="showDealTime('down', 'check');" style="cursor:pointer;"><img src="<?=DEFAULT_URL?>/images/bg_arrow_<?=($visibility_start!=24 && $visibility_end!=24) && $id||$visibility? "open":"close"?>_black.gif" /></label></span>
            </td>
        </tr>

        <tr>
            <td class="table-column">
                <div class="table-box" id="tableDealtime" style="display:<?=(($visibility || ($visibility_start!=24 && $visibility_end!=24)) && ($id || $visibility))? "":"none"?>">
                    <table>
                        <tr>
                            <th class="alignTop auto-size">
                                * <?=system_showText(LANG_LABEL_START_TIME)?>:
                            </th>
                            <td>
                                <?=$start_time_hour_DD?> : <?=$start_time_min_DD?>
                                <? 
                                if (CLOCK_TYPE == '12') { 
                                    ?>
                                    <input type="radio" name="start_time_am_pm" value="am" <? if ($start_time_am_pm == "am") echo "checked"; ?> class="inputRadio" /> AM <input type="radio" name="start_time_am_pm" value="pm" <? if ($start_time_am_pm == "pm") echo "checked"; ?> class="inputRadio" /> PM (hh:mm)
                                    <? 
                                } 
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="alignTop auto-size">
                                * <?=system_showText(LANG_LABEL_END_TIME)?>:
                            </th>
                            <td>
                                <?=$end_time_hour_DD?> : <?=$end_time_min_DD?>
                                <? 
                                if (CLOCK_TYPE == '12') { 
                                    ?>
                                    <input type="radio" name="end_time_am_pm" value="am" <? if ($end_time_am_pm == "am") echo "checked"; ?> class="inputRadio" /> AM <input type="radio" name="end_time_am_pm" value="pm" <? if ($end_time_am_pm == "pm") echo "checked"; ?> class="inputRadio" /> PM (hh:mm)
                                    <?
                                } 
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    
    <?
    unset($price_value);
    if ($realvalue != 'NULL' ) {
        $price_value = explode(".", $realvalue);
    }
    ?>

    <table border="0" cellpadding="2" cellspacing="0" class="standard-table noBackground">
        <tr>
            <th colspan="2" class="standard-tabletitle">
                <?=system_showText(LANG_SITEMGR_DISCINFO)?>
            </th>
        </tr>

        <tr>
            <th class="table-subtitle" colspan="4">
                * <?=system_showText(LANG_MSG_ADD_DEAL_TIP)?>
            </th>
        </tr>

        <tr>
            <td class="table-column">
                <div class="table-box table-box-small">
                    <table>
                        <tr>
                            <th>
                                * <?=system_showText(LANG_SITEMGR_ITEMVALUE)?> (<?=CURRENCY_SYMBOL?>):
                            </th>
                            <td>
                                <input type="text" id="real_price_int" name="real_price_int" value="<?=$price_value[0]?>" onkeyup="calculateDiscount();" maxlength="5" style="width:55px; text-align:right;"/>
                                <strong> &nbsp;.&nbsp; </strong>
                                <input type="text" id="real_price_cent" name="real_price_cent" value="<?=$price_value[1]?>" onkeyup="calculateDiscount();" maxlength="2" style="width:20px;" />
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" class="center-info">
                                <input type="radio" id="type_monetary" name="deal_type" value="monetary value" class="inputCheck" <?=((!$deal_type || $deal_type == "monetary value") ? "checked=true" : "")?> onclick="showAmountType('<?=CURRENCY_SYMBOL?>','not');" /> <?=system_showText(ucfirst(LANG_LABEL_FIXEDVALUE_DISC))?>
                                <br />
                                <input type="radio" id="type_percentage" name="deal_type" value="percentage" class="inputCheck" <?=(($deal_type == "percentage") ? "checked=true" : "")?> onclick="showAmountType('%','not');" /> <?=system_showText(ucfirst(LANG_LABEL_PERCENTAGE_DISC))?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                * <?=system_showText(LANG_LABEL_DISC_AMOUNT)?>
                                <label id="amount_monetary">
                                    (<?=CURRENCY_SYMBOL?>):
                                </label>
                            </th>
                            <td> 
                                <?
                                unset($price_value);
                                if ( $dealvalue != 'NULL' && $deal_type != "percentage") {
                                    $price_value = explode(".", $dealvalue);
                                } else {
                                    $price_value[0] = $deal_price_int;
                                }
                                ?>
                                <input type="text" id="deal_price_int" name="deal_price_int" value="<?=$price_value[0]?>" onkeyup="calculateDiscount();" <?=(($deal_type == "percentage") ? "maxlength=\"2\"" : "maxlength=\"5\"")?> style="width:55px; text-align:right;" />
                                <label id="label_deal_cent">
                                    <strong> &nbsp;.&nbsp; </strong>
                                    <input type="text" id="deal_price_cent" name="deal_price_cent" value="<?=$price_value[1]?>" onkeyup="calculateDiscount();" maxlength="2" style="width:20px;" />
                                </label>
                                <label id="amount_percentage" style="display:none">
                                    %
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th id="th_label_discount"><strong><?=system_showText(LANG_LABEL_DISC_CALCULATED)?>:</strong></th>
                            <td>
                                <span id="discountAmount"> <?=(($realvalue > 0 && $dealvalue) && ($realvalue > $dealvalue) ) ? round(100 -( ($dealvalue*100) / $realvalue ) ).'%' : ''?> </span>
                                <span id="amountDiscountMessage" class="required"><?=($realvalue < $dealvalue ? system_showText(LANG_MSG_VALID_MINOR) : "")?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>* <?=system_showText(LANG_LABEL_DEALS_OFFER)?>:</th>
                            <td> 
                               <input type="text" name="amount" id="amount" style="width:55px;" maxlength="10" value="<?=(int)$amount?>">
                                <?
                                $dealInfo = $promotion->getDealInfo();
                                if ($dealInfo['sold']){
                                    ?>
                                    <span>*<?=$dealInfo['sold']?> <?=$dealInfo['sold']>1? system_showText(LANG_SITEMGR_DONEUNTIL_PLURAL) : system_showText(LANG_SITEMGR_DONEUNTIL_SINGULAR)?>.</span>
                                    <?
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <table border="0" cellpadding="2" cellspacing="0" class="standard-table noBackground">
        <tr>
            <th colspan="2" class="standard-tabletitle">
                <?=system_showText(LANG_LABEL_IMAGE)?><span> (<?=IMAGE_PROMOTION_FULL_WIDTH;?>px x <?=IMAGE_PROMOTION_FULL_HEIGHT;?>px) (JPG, GIF <?=system_showText(LANG_OR);?> PNG)</span>
            </th>
        </tr>

        <tr>
            <th class="table-subtitle" colspan="4"><?=system_showText(LANG_MSG_ADD_DEAL_TIP2)?></th>
        </tr>

        <?
        if ($thumb_id) {
            $imageObj = new Image($thumb_id);
            if ($imageObj->imageExists()) {
                ?>
                <tr>
                    <th>&nbsp;</th>
                    <td class="image-space" colspan="2">
                        <?=$imageObj->getTag(true, IMAGE_PROMOTION_THUMB_WIDTH, IMAGE_PROMOTION_THUMB_HEIGHT, $name);?>
                    </td>
                </tr>
                <?
            }
        }
        
        include(EDIRECTORY_ROOT."/includes/code/thumbnail.php");
        if ($thumb_id) { 
            ?>
            <tr>
                <th>&nbsp;</th>
                <td align="left">
                   <input type="checkbox" name="remove_image" class="inputCheck" value="1" style="vertical-align:middle;" /> <?=system_showText(LANG_MSG_CHECK_TO_REMOVE_IMAGE)?>
                </td>
            </tr>
            <?
        } 
        ?>

        <tr>
            <th class="formLabelAlign"><?=system_showText(LANG_LABEL_IMAGE_SOURCE)?>:<br /><br /></th>
            <td class="columnFile">
                <input type="file" name="image" id="image" size="50" onchange="UploadImage('promotion');" class="inputExplode" /><span><?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED);?></span>
                <input type="hidden" name="image_id" value="<?=$image_id?>" />
                <?//Crop Tool Inputs?>
                <input type="hidden" name="x" id="x">
                <input type="hidden" name="y" id="y">
                <input type="hidden" name="x2" id="x2">
                <input type="hidden" name="y2" id="y2">
                <input type="hidden" name="w" id="w">
                <input type="hidden" name="h" id="h">
                <input type="hidden" name="image_width" id="image_width">
                <input type="hidden" name="image_height" id="image_height">
                <input type="hidden" name="image_type" id="image_type">
                <input type="hidden" name="crop_submit" id="crop_submit">
            </td>
        </tr>
    </table>