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
	# * FILE: /includes/tables/table_langs.php
	# ----------------------------------------------------------------------------------------------------

?>

<? if(is_numeric($message) && isset($msg_lang[$message])) { ?>
	<p class="<?=(!$error) ? 'successMessage' : 'errorMessage'?>"><?=$msg_lang[$message]?></p>
<? } ?>

<? 
$langObj = new Lang();
if (!$langObj->hasDefaultLang()) {
	echo "<p class=\"errorMessage\">".system_showText(LANG_SITEMGR_MSGERROR_NODEFAULTLANGUAGE)."</p>";
}
if ($langObj->hasDuplicatedOrder()) {
	echo "<p class=\"errorMessage\">".system_showText(LANG_SITEMGR_MSGERROR_DUPLICATEDORDER)."</p>";
}
?>
	
<ul class="standard-iconDESCRIPTION">
	<li class="orderup-icon"><?=system_showText(LANG_SITEMGR_ORDERUP);?></li>
    <li class="orderdown-icon"><?=system_showText(LANG_SITEMGR_ORDERDOWN);?></li>
    <li class="enabled-icon"><?=system_showText(LANG_SITEMGR_ACTIVATED);?></li>
    <li class="disabled-icon"><?=system_showText(LANG_SITEMGR_DEACTIVATED);?></li>
	<li class="default-icon"><?=system_showText(LANG_LABEL_DEFAULT);?></li>
</ul>

<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

	<tr>
		<th style="width: 13px;">&nbsp;</th> 
        <th><?=system_showText(LANG_LABEL_NAME);?></th>
		<th style="width: 45px;"><?=system_showText(LANG_SITEMGR_LABEL_ORDER);?></th>
		<th style="width: 45px;"><?=system_showText(LANG_SITEMGR_LABEL_ENABLED);?></th>
	</tr>

    <? if ($langs) foreach ($langs as $lang) { ?>
    
	<tr>
        <td>
			<? if($lang->getString('lang_default') == 'y') { ?>
                <img src="<?=DEFAULT_URL?>/images/icon_default.gif">
            <? } else { ?>
                <? if ($lang->getString('lang_enabled') == 'y') { ?>
                    <a href="<?=$url_redirect?>/index.php?id=<?=$lang->getString("id")?>&default=1">
                <? } ?>
                <img src="<?=DEFAULT_URL?>/images/icon_default_off.gif" title="<?=$lang->getString('lang_enabled') == 'y' ?system_showText(LANG_SITEMGR_SETASDEFAULT):''?>">
                <? if ($lang->getString('lang_enabled') == 'y') { ?>
                    </a>
                <? } ?>
            <? } ?>
        </td>
		<td>
			<a href="javascript:void(0)" onclick="showLangEdit('<?=$lang->getString("id")?>','<?=$lang->getString("lang_order")?>')" class="link-table"><?=$lang->getString("name");?></a>
		</td>
		<td style="text-align:center">
            <?=$lang->getNumber("lang_order")?>&nbsp;&nbsp;&nbsp;
            <?=($lang->getString('lang_order') > 0 && $lang->getString('lang_order') < count($lang->getAll())-1) ? (
            	"<a href=\"".$url_redirect."/index.php?id=".$lang->getString("id")."&direction=down\">
            		<img src=\"".DEFAULT_URL."/images/icon_arrow_down.gif\" title=\"".LANG_SITEMGR_MOVEDOWN."\"></a>") 
            	: "<img src=\"".DEFAULT_URL."/images/icon_arrow_down_off.gif\">"?>&nbsp;&nbsp;
            <?=($lang->getString('lang_order') <= count($lang->getAll())-1 && $lang->getString('lang_order') > 1) ? (
            	"<a href=\"".$url_redirect."/index.php?id=".$lang->getString("id")."&direction=up\">
            		<img src=\"".DEFAULT_URL."/images/icon_arrow_up.gif\" title=\"".LANG_SITEMGR_MOVEUP."\"></a>") 
            	: "<img src=\"".DEFAULT_URL."/images/icon_arrow_up_off.gif\">"?>
        </td>
        <td style="text-align:center">
            <? if($lang->getString('lang_default') == 'n') { ?>
                 <a href="<?=$url_redirect?>/index.php?id=<?=$lang->getString("id")?>&active=<?=$lang->getString("lang_enabled")?>">
            <? } ?>
            <img src="<?=DEFAULT_URL?>/images/<?=$lang->getString('lang_enabled') == 'y' ? 'icon_check.gif' : 'icon_uncheck.gif'?>" border="0" alt="<?=($lang->getString('lang_enabled') == 'y' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" title="<?=($lang->getString('lang_enabled') == 'y' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" />
            <? if($lang->getString('lang_default') == 'n') { ?>
                </a>
            <? } ?>
        </td> 
	</tr>
    <tr id="tr_langEdit<?=$lang->getString("id")?>" style="display:none" class="langEditForm">
        <td>&nbsp;
            
        </td>
        <td class="innerTable">
            <form name="langEdit" action="<?=$url_redirect?>/index.php">
                <p class="errorMessage"  style="display:none"></p>
                <input type="hidden" name="edit_name" value="<?=$lang->getString("id")?>">
                <table style="margin:0;">
                    <tr>
                        <td> 
                            <input type="text" name="lang_name" id="lang_name<?=$lang->getString('id')?>" value="<?=$lang->getString('name')?>" maxlength="20">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" name="submit" value="Submit" class="input-button-form" style="margin-top:0;"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                            <button type="reset"  name="cancel" value="Cancel" onclick="hideLangEdit('<?=$lang->getString("id")?>')" class="input-button-form" style="margin-top:0;"><?=system_showText(LANG_BUTTON_CANCEL);?></button>
                        </td>
                    </tr>
                </table>
            </form>
        <td>
    </tr>
    
    <? } ?>

</table>

<ul class="standard-iconDESCRIPTION">
	<li class="orderup-icon"><?=system_showText(LANG_SITEMGR_ORDERUP);?></li>
    <li class="orderdown-icon"><?=system_showText(LANG_SITEMGR_ORDERDOWN);?></li>
    <li class="enabled-icon"><?=system_showText(LANG_SITEMGR_ACTIVATED);?></li>
    <li class="disabled-icon"><?=system_showText(LANG_SITEMGR_DEACTIVATED);?></li>
	<li class="default-icon"><?=system_showText(LANG_LABEL_DEFAULT);?></li>
</ul>

<script type="text/javascript">

    var this_id = '';
    
    function showLangEdit(id,order) {
        $('form[name=langEdit]')[order].reset();
        $('.langEditForm').css('display', 'none');
        $('#tr_langEdit'+id).css('display', '');
        $('#tr_langEdit'+id).fadeIn();
        $('.errorMessage').css('display', 'none');        
        $('.errorMessage').empty();
        this_id = id;        
    }
    
    function hideLangEdit(id) {
        $('#tr_langEdit'+id).fadeOut();
        $('.errorMessage').css('display', 'none');        
        $('.errorMessage').empty();        
    }
    
    function jLangDefault(this_id) {
        $('document').ready(function() {
            var link = "<?=$url_redirect?>/index.php?id="+this_id+"&default=1";
            window.location.href=link;
        });
    }
    
    function jLangOrder(this_id, direction) {
        $('document').ready(function() {
            var link = "<?=$url_redirect?>/index.php?id="+this_id+"&direction="+direction; 
            window.location.href=link;
        });
    }
    
    function jLangActive(this_id, status) {
        $('document').ready(function() {
            var link = "<?=$url_redirect?>/index.php?id="+this_id+"&active="+status;
            window.location.href=link;
        });
    }
    
    $('document').ready(function() {
    
        $('form[name=langEdit]').submit(function() {
            
            $('.errorMessage').empty();
            if ( $('#lang_name'+this_id).val() == '' ) {
                $('.errorMessage').append("<?=system_showText(LANG_REVIEW_EMPTY_NAME)?><br />");
            }
            if ($('.errorMessage').text() != '') {
                $('.errorMessage').css('display', '');
                return false;   
            } else {
                return true;        
            }
            
        });
        
    });    

</script>