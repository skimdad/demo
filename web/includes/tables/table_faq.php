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
    # * FILE: /includes/tables/table_faq.php
    # ----------------------------------------------------------------------------------------------------
    
?>

<script language="javascript" type="text/javascript">

    var thisId = '';

    function showFormFaq() {
        $('document').ready(function() {
        
            $('.errorMessage').css('display','none');
            $('.successMessage').css('display','none');
            $('#new_faq').fadeIn(500);
            $('textarea[name=faq_question]').focus();
        
        });
        
    }
    
    function hideFormFaq(form_id) {
        $('document').ready(function() {
        
            $('.errorMessage').css('display','none');
            $('.successMessage').css('display','none');
            $('#'+form_id).fadeOut(500);
        
        });
        
    }
    
    function faq_showEdit(faq_id) {
    
        thisId = faq_id; 
        
        $('document').ready(function() {
        
            $('.hideForm').css('display', 'none');
            $('.errorMessage').css('display','none');
            $('.successMessage').css('display','none');
            $('#FAQ_edit'+faq_id).css('display', '')
            $('button[name=FAQ_edit_cancel]').focus();
        
        });   
    
    }
    
    function show_faq(faq_id){
        $("a#link_FAQ_show"+faq_id).fancybox({
            height: 300,
            width: 800,
            autoDimensions: false
        });
        $("#link_FAQ_show"+faq_id).trigger('click');
    }
    
    $('document').ready(function() {
        $('.successMessage').fadeOut(4500);    
    });

</script>

<? if (!$faqs) { ?>
    <p class="informationMessage"><?=system_showText(LANG_SITEMGR_SETTINGS_FAQ_NOFAQ);?></p>
<? } else { ?> 
	 <ul class="standard-iconDESCRIPTION">
        <li class="view-icon"><?=system_showText(LANG_LABEL_VIEW);?></li>
        <li class="edit-icon"><?=system_showText(LANG_LABEL_EDIT);?></li>
        <li class="delete-icon"><?=system_showText(LANG_LABEL_DELETE);?></li>
    </ul>	
    <table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

        <tr>
            <th style="width: 320px;"><?=system_showText(LANG_SITEMGR_SETTINGS_FAQ_QUESTION)?></th>
			<th style="width: 320px;"><?=system_showText(LANG_SITEMGR_SETTINGS_FAQ_ANSWER)?></th>
			<th style="width: 150px;"><?=system_showText(LANG_SITEMGR_LABEL_SECTION)?></th>
            <th style="width: 65px;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
        </tr>

            <? foreach ($faqs as $faq) { ?>
                <tr>
                    <td>
                        <?=$faq["question"]?>
                    </td>
                    <td>
                        <?=$faq["answer"]?>
                    </td>
                    <?
                    $section = '';
                    if ( $faq['frontend'] == 'y' ) $section .= system_showText(LANG_SITEMGR_FRONT)."<br />";
                    if ( $faq['member'] == 'y' ) $section .= system_showText(LANG_SITEMGR_MEMBERS)."<br />";
                    if ( $faq['sitemgr'] == 'y' ) $section .= system_showText(LANG_SITEMGR_SITEMGR)."";
					$section .= "<br />";
                    ?>
                    <td>
                        <?=$section?>
                    </td>
                    <td class="nowrap">

                        <a href="javascript: void(0);" onclick="show_faq(<?=$faq["id"]?>)">
                            <img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(LANG_LABEL_VIEW)?>" title="<?=system_showText(LANG_LABEL_VIEW)?>" />
                        </a>
                        <a href="javascript:void(0)" onclick="faq_showEdit(<?=$faq["id"]?>)" class="link-table">
                            <img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" alt="<?=system_showText(LANG_LABEL_EDIT)?>" title="<?=system_showText(LANG_LABEL_EDIT)?>" />
                        </a>
                        <a href="javascript:void(0)" onclick="dialogBox('confirm','<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>',<?=$faq['id']?>,'FAQ_post','','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');" class="link-table">
                            <img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" alt="<?=system_showText(LANG_LABEL_DELETE)?>" title="<?=system_showText(LANG_LABEL_DELETE)?>" />
                        </a>

                    </td>
                </tr>
                
                <tr id="FAQ_edit<?=$faq["id"]?>" style="display:none" class="hideForm">
                    <td colspan="3" id="FAQ_editTD<?=$faq["id"]?>" class="innerTable">
                        <form name="FAQ_edit" action="<?=DEFAULT_URL?>/sitemgr/prefs/faq.php" method="post">
                            <input type="hidden" name="faq_id" value="<?=$faq["id"]?>">
                            <p class="errorMessage" id="jMessageEdit<?=$faq["id"]?>" style="display:none;"></p>
                            <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
                                <tr>
                                    <th>
                                        <?=system_showText(LANG_SITEMGR_SETTINGS_FAQ_QUESTION)?>
                                    </th>
                                    <td colspan="6">
                                        <textarea name="faq_question_edit" id="faq_question_edit<?=$faq["id"]?>" rows="5"><?=$faq["question"]?></textarea> 
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <?=system_showText(LANG_SITEMGR_SETTINGS_FAQ_ANSWER)?>
                                    </th>
                                    <td colspan="6">
                                        <textarea name="faq_answer_edit" id="faq_answer_edit<?=$faq["id"]?>" rows="5"><?=$faq["answer"]?></textarea> 
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <?=system_showText(LANG_SITEMGR_LABEL_SECTION)?>        
                                    </th>
                                    <td class="td-checkbox"><input type="checkbox" name="faq_section_front_edit" class="inputCheck" <?=($faq["frontend"] == 'y') ? "checked=\"checked\"" : ""?>></td>
                                    <td style="width: 150px;"><?=system_showText(LANG_SITEMGR_FRONT)?></td>
                                    <td class="td-checkbox"><input type="checkbox" name="faq_section_members_edit" class="inputCheck" <?=($faq["member"] == 'y') ? "checked=\"checked\"" : ""?>></td>
                                    <td style="width: 150px;"><?=system_showText(LANG_SITEMGR_MEMBERS)?></td>
                                    <td class="td-checkbox"><input type="checkbox" name="faq_section_sitemgr_edit" class="inputCheck" <?=($faq["sitemgr"] == 'y') ? "checked=\"checked\"" : ""?>></td>
                                    <td style="width: 150px;"><?=system_showText(LANG_SITEMGR_SITEMGR)?></td>
                                </tr>
                            </table>
                            <table border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto 0 auto;" align="center">
                                <tr>
                                    <td>
                                        <button type="submit" name="FAQ_edit_submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                                        <button type="reset"  name="FAQ_edit_cancel" value="Cancel" class="input-button-form" onclick="hideFormFaq('FAQ_edit<?=$faq["id"]?>');"><?=system_showText(LANG_BUTTON_CANCEL);?></button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </td>
                </tr>
                <a id="link_FAQ_show<?=$faq["id"]?>" href="#FAQ_show<?=$faq["id"]?>" style="display:none"></a>
                <div style="display:none">
                    <div id="FAQ_show<?=$faq["id"]?>">
                        <h2 id="header-view"><?=$faq["question"]?></h2>
                        <p class="TB_text"><?=$faq["answer"]?></p>
                    </div>
                </div>
                
            <? } ?>

    </table>
    <ul class="standard-iconDESCRIPTION">
        <li class="view-icon"><?=system_showText(LANG_LABEL_VIEW);?></li>
        <li class="edit-icon"><?=system_showText(LANG_LABEL_EDIT);?></li>
        <li class="delete-icon"><?=system_showText(LANG_LABEL_DELETE);?></li>
    </ul>	
    
<? } ?>