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
	# * FILE: /includes/forms/form_modules_options.php
	# ----------------------------------------------------------------------------------------------------

?>

<br />

<div class="header-form">
	<?=system_showText(LANG_SITEMGR_SETTINGS_MODULES_TIP1)?>
</div>

<p class="informationMessage"><?=system_showText(LANG_SITEMGR_SETTINGS_MODULES_TIP2)?></p>

<? if ($message_modules_options) { ?>
	<div id="warning" class="<?=$message_style?>">
		<?=$message_modules_options?>
	</div>
<? } ?>

<table cellpadding="2" cellspacing="0" border="0" class="table-form">
    
    <? if (BANNER_FEATURE == "on") { ?>
    
        <tr class="tr-form">
            <td align="right" class="td-form">
                <input type="checkbox" name="check_banner_feature" value="on" <?=$custom_banner_feature_checked?> class="inputCheck" />
            </td>
            <td>
                <div class="label-form" align="left"><?=system_showText(LANG_BANNER_FEATURE_NAME_PLURAL)?></div>
            </td>
        </tr>
    
    <? } ?>
        
    <? if (EVENT_FEATURE == "on" && FORCE_DISABLE_EVENT_FEATURE != "on") { ?>    
    
        <tr class="tr-form">
            <td align="right" class="td-form">
                <input type="checkbox" name="check_event_feature" value="on" <?=$custom_event_feature_checked?> class="inputCheck" />
            </td>
            <td>
                <div class="label-form" align="left"><?=system_showText(LANG_EVENT_FEATURE_NAME_PLURAL)?></div>
            </td>
        </tr>
    
    <? } ?>
        
    <? if (CLASSIFIED_FEATURE == "on" && FORCE_DISABLE_CLASSIFIED_FEATURE != "on") { ?>
    
        <tr class="tr-form">
            <td align="right" class="td-form">
                <input type="checkbox" name="check_classified_feature" value="on" <?=$custom_classified_feature_checked?> class="inputCheck" />
            </td>
            <td>
                <div class="label-form" align="left"><?=system_showText(LANG_CLASSIFIED_FEATURE_NAME_PLURAL)?></div>
            </td>
        </tr>
    
    <? } ?>
        
    <? if (ARTICLE_FEATURE == "on" && FORCE_DISABLE_ARTICLE_FEATURE != "on") { ?>    
     
        <tr class="tr-form">
            <td align="right" class="td-form">
                <input type="checkbox" name="check_article_feature" value="on" <?=$custom_article_feature_checked?> class="inputCheck" />
            </td>
            <td>
                <div class="label-form" align="left"><?=system_showText(LANG_ARTICLE_FEATURE_NAME_PLURAL)?></div>
            </td>
        </tr>
    
    <? } ?>
        
    <? if (PROMOTION_FEATURE == "on" && FORCE_DISABLE_PROMOTION_FEATURE != "on") { ?>    
    
        <tr class="tr-form">
            <td align="right" class="td-form">
                <input type="checkbox" name="check_promotion_feature" value="on" <?=$custom_promotion_feature_checked?> class="inputCheck" />
            </td>
            <td>
                <div class="label-form" align="left"><?=system_showText(LANG_PROMOTION_FEATURE_NAME_PLURAL)?></div>
            </td>
        </tr>
    
    <? } ?>
    
    <? if (BLOG_FEATURE == "on") { ?>    
        
    <tr class="tr-form">
		<td align="right" class="td-form">
			<input type="checkbox" name="check_blog_feature" value="on" <?=$custom_blog_feature_checked?> class="inputCheck" />
		</td>
		<td>
			<div class="label-form" align="left"><?=system_showText(LANG_MENU_BLOG)?></div>
		</td>
	</tr>
    
    <? } ?>
    
</table>