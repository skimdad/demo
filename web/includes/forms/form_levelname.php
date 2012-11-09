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
	# * FILE: /includes/forms/form_levelname.php
	# ----------------------------------------------------------------------------------------------------

    unset($moduleName);
    unset($moduleMessage);
    unset($levelObj);

    switch ($module) {
        case "listing":
            $moduleName = system_showText(LANG_SITEMGR_LISTING);
            $moduleMessage = $message_listinglevelnames;
            $levelObj = new ListingLevel(EDIR_DEFAULT_LANGUAGE, true);
            break;
        case "event":
            $moduleName = system_showText(LANG_SITEMGR_EVENT);
            $moduleMessage = $message_eventlevelnames;
            $levelObj = new EventLevel(EDIR_DEFAULT_LANGUAGE, true);
            break;
        case "banner":
            $moduleName = system_showText(LANG_SITEMGR_BANNER);
            $moduleMessage = $message_bannerlevelnames;
            $levelObj = new BannerLevel(EDIR_DEFAULT_LANGUAGE, true);
            break;
        case "classified":
            $moduleName = system_showText(LANG_SITEMGR_CLASSIFIED);
            $moduleMessage = $message_classifiedlevelnames;
            $levelObj = new ClassifiedLevel(EDIR_DEFAULT_LANGUAGE, true);
            break;
        case "article":
            $moduleName = system_showText(LANG_SITEMGR_ARTICLE);
            $moduleMessage = $message_articlelevelnames;
            $levelObj = new ArticleLevel(EDIR_DEFAULT_LANGUAGE, true);
            break;
    }
?>

<? if(is_numeric($message) && isset($msg_levels[$message]) && $levelModule == $module) { ?>
    <a name="link">&nbsp;</a>
    <p class="successMessage"><?=$msg_levels[$message]?></p>
<? } ?>

<? if ($moduleMessage) { ?> <a name="link">&nbsp;</a><? } ?>
<div class="header-form"><?=string_ucwords($moduleName);?> - <?=ucfirst(system_showText(LANG_SITEMGR_SETTINGS_LEVELS_LEVELNAMES))?></div>

<? if ($moduleMessage) { ?>
    <div id="warning" class="<?=$message_style?>"><?=$moduleMessage?></div>
<? } ?>

<table cellpadding="2" cellspacing="0" class="table-form table-nowrap" border="0">

	<tr class="tr-form">
        <td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ACTIVE)?></b></div></td>
        <? if ($module == 'listing' && PROMOTION_FEATURE == 'on') {  ?>
            <td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b><?=ucfirst(system_showText(LANG_SITEMGR_PROMOTION))?></b></div></td>
        <? } ?>
        <? if ($module == 'listing' && $review_listing_enabled) { ?>
            <td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b><?=ucfirst(system_showText(LANG_SITEMGR_REVIEW))?></b></div></td>
        <? } ?>
		<? if ($module == 'listing' && TWILIO_APP_ENABLED == "on" && TWILIO_APP_ENABLED_SMS == "on") { ?>
            <td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b><?=ucfirst(system_showText(LANG_SITEMGR_SEND_PHONE))?></b></div></td>
		<? } ?>
		<? if ($module == 'listing' && TWILIO_APP_ENABLED == "on" && TWILIO_APP_ENABLED_CALL == "on") { ?>
			<td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b><?=ucfirst(system_showText(LANG_SITEMGR_CLICK_CALL))?></b></div></td>
        <? } ?>
        <? if ($module == 'listing' && BACKLINK_FEATURE == "on") { ?>
			<td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b><?=ucfirst(system_showText(LANG_LABEL_BACKLINK))?></b></div></td>
        <? } ?>
		<? //TODO: Mavencrew ?>    
		<? if ($module == 'listing' && MobileApp_FEATURE == "on") { ?>
			<td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b><?=ucfirst(system_showText(LANG_LABEL_MOBILE_APP))?></b></div></td>
        <? } ?>  
        <? if ($module != 'banner') { ?>
        <td align="center" class="td-form"><div class="label-form" style="text-align: right;"><b><?=system_showText(LANG_SITEMGR_LABEL_ORDER)?></b></div></td>
        <? } ?>
		<td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ACTUALNAME)?></b></div></td>
        <td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_NEWNAME)?></b></div></td>
        <td align="center" class="td-form">&nbsp;</td>
	</tr>

<?
	$levelvalues = $levelObj->getLevelValues();
    $levelvalues = array_reverse($levelvalues);

	foreach ($levelvalues as $levelvalue) {
?>
		<tr>
            <td align="left" class="td-form">
                <? if($levelvalue == $levelObj->getDefaultLevel() && $module != 'banner') { ?>
                    <input type="checkbox" name="deactiveLevel[<?=$levelvalue?>]" class="inputCheck" id="check_<?=$module;?>_<?=$levelvalue;?>" value="y" checked="checked" disabled="disabled" />
                    <input type="hidden" name="activeLevel[<?=$levelvalue?>]" value="y" />
                <? } else { ?>
                    <input type="checkbox" name="activeLevel[<?=$levelvalue?>]" id="check_<?=$module;?>_<?=$levelvalue;?>" onclick="disableLevelField('<?=$module;?>', '<?=$levelvalue;?>');" class="inputCheck" value="y" <?=($levelObj->getActive($levelvalue) == 'y') ? 'checked' : '';?> />
                <? } ?>
            </td>

            <? if ($module == 'listing' && (PROMOTION_FEATURE == 'on' || CUSTOM_PROMOTION_FEATURE == 'on')) { ?>
                <td align="left" class="td-form">
                    <input type="checkbox" name="hasPromotion[<?=$levelvalue?>]"  class="inputCheck" value="y" <?=$levelObj->getHasPromotion($levelvalue) == 'y'?'checked':''; ?> />
                </td>
            <? } ?>

            <? if ($module == 'listing' && $review_listing_enabled) { ?>
                <td align="left" class="td-form">
                    <input type="checkbox" name="hasReview[<?=$levelvalue?>]" class="inputCheck" value="y" <?=($levelObj->getHasReview($levelvalue) == 'y') ? 'checked' : '';?> />
                </td>
            <? } ?>
				
			<? if ($module == 'listing' && TWILIO_APP_ENABLED == "on" && TWILIO_APP_ENABLED_SMS == "on") { ?>
				<td align="left" class="td-form td-center">
                    <input type="checkbox" name="hasSms[<?=$levelvalue?>]" class="inputCheck" value="y" <?=($levelObj->getHasSms($levelvalue) == 'y') ? 'checked' : '';?> />
                </td>
			<? } ?>
			<? if ($module == 'listing' && TWILIO_APP_ENABLED == "on" && TWILIO_APP_ENABLED_CALL == "on") { ?>
                <td align="left" class="td-form td-center">
                    <input type="checkbox" name="hasCall[<?=$levelvalue?>]" class="inputCheck" value="y" <?=($levelObj->getHasCall($levelvalue) == 'y') ? 'checked' : '';?> />
                </td>
            <? } ?>
           <? if ($module == 'listing' && BACKLINK_FEATURE == "on") { ?>
                <td align="left" class="td-form td-center">
                    <input type="checkbox" name="backlink[<?=$levelvalue?>]" class="inputCheck" value="y" <?=($levelObj->getBacklink($levelvalue) == 'y') ? 'checked' : '';?> />
                </td>
            <? } ?>   
			<? //TODO: MavenCrew - add has mobile application column, need to check if the feature is on or not ?>
			<? if ($module == 'listing' && MobileApp_FEATURE == "on") { ?>
                <td align="left" class="td-form td-center">
                    <input type="checkbox" name="hasMobileApp[<?=$levelvalue?>]" class="inputCheck" value="y" <?=($levelObj->getHasMobileApp($levelvalue) == 'y') ? 'checked' : '';?> />
                </td>
            <? } ?>   
            <? if ($module != 'banner') { ?>
				<td align="left" class="td-form"><div class="label-form" style="text-align:right"><?=ucfirst($levelObj->getLevelOrdering($levelvalue));?></div></td>
            <? } ?>
			<? if($module == "banner") { ?>
                <td align="left" class="td-form" width="20%"><div class="label-form"><?=string_ucwords($levelObj->getDisplayName($levelvalue));?></div></td>
                <td align="left" class="td-form"><input type="text" name="nameLevel[<?=$levelvalue?>]" id="text_<?=$module;?>_<?=$levelvalue;?>" class="input-form-listing" style="width:250px" value="<?=string_ucwords($levelObj->getDisplayName($levelvalue));?>" <?=($levelObj->getActive($levelvalue) != 'y') ? 'readonly="readonly"' : '';?>/></td>
                <td align="left" class="td-form" width="15%">&nbsp;</td>
            <? } else { ?>
                <td align="left" class="td-form" width="20%"><div class="label-form"><?=string_ucwords($levelObj->getName($levelvalue));?></div></td>
                <td align="left" class="td-form"><input type="text" name="nameLevel[<?=$levelvalue?>]" id="text_<?=$module;?>_<?=$levelvalue;?>" class="input-form-listing" style="width:250px" value="<?=string_ucwords($levelObj->getName($levelvalue));?>" <?=($levelObj->getActive($levelvalue) != 'y') ? 'readonly="readonly"' : '';?>/></td>
                <td align="left" class="td-form"  width="30%" style="color:#174C7E; font-weight:bold;"><? if ($levelvalue == $levelObj->getDefault() && $module != 'banner') echo system_showText(LANG_SITEMGR_SETTINGS_LEVELS_DEFAULTLEVEL); ?></td>
            <? } ?>
		</tr>
<?
	}
?>

</table>
