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
	# * FILE: /includes/forms/form_level_name_domain.php
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
		case "coupon":
            $moduleName = system_showText(LANG_SITEMGR_PROMOTION);
            $moduleMessage = $message_promotionlevelnames;
            break;
		case "blog":
            $moduleName = system_showText(LANG_SITEMGR_BLOG);
            $moduleMessage = $message_bloglevelnames;
            break;
    }
?>

<table cellpadding="0" cellspacing="0" border="0" class="standard-table noMargin">
	<tr>
		<?if ($module=="listing"){?>
			<th>
				<input type="checkbox" name="enable<?=ucfirst($module)?>" class="inputCheck" value="y" checked="checked" disabled="disabled" onclick="<?=($module!='coupon' && $module != 'blog' ? "openModules('$module',this)" : "");?>" />
				<input type="hidden" name="enable<?=ucfirst($module)?>" value="y" />
			</th>
		<? } else { ?>
			<th>
				<input type="checkbox" name="enable<?=ucfirst($module)?>" class="inputCheck" value="y" onclick="<?=($module!='coupon' && $module != 'blog' ? "openModules('$module',this)" : "");?>" <?=(($$module || $_POST["enable".ucfirst($module)])? "checked=\"checked\"": "");?>/>
			</th>
		<? } ?>
		<td>
			<b><?=system_showText(ucfirst($moduleName))?></b>
		</td>
	</tr>
	<? if ($module != "coupon" && $module != 'blog'){
		
	if ($module != "listing" && (!$$module && !$_POST["enable".ucfirst($module)])) {
		$str_style = "none";
	} else {
		$str_style = "";
	}
	?>

	<tr id="<?="modules1_".$module;?>"  style="display:<?=$str_style?>">
		<th>&nbsp;
			
		</th>
		<td>
			<?=system_showText(LANG_SITEMGR_CHOOSE_LEVELS)?>
		</td>
	</tr>
	<? } ?>

<?
	if ($module != "coupon" && $module != 'blog'){
		$levelvalues = $levelObj->getLevelValues();
		$levelvalues = array_reverse($levelvalues);
    
		$selectedLevel = explode(",", $$module);
		$selectedLevelPost = $_POST["activeLevel".ucfirst($module)];

		foreach ($levelvalues as $levelvalue) {
			
		$hasPost = false;
		if ($selectedLevelPost){
			if (array_key_exists($levelvalue,$selectedLevelPost))
				$hasPost = true;
			else $hasPost = false;
		}
	?>
			
			<tr id="<?="modules2_".$module."_".$levelvalue;?>" style="display:<?=$str_style?>">
				<th>
					 <? if($levelvalue == $levelObj->getDefaultLevel() && $module != 'banner') { ?>
						<input type="checkbox" name="activeLevel<?=ucfirst($module)?>[<?=$levelvalue?>]" class="inputCheck" value="y" checked="checked" disabled="disabled"/>
						<input type="hidden" name="activeLevel<?=ucfirst($module)?>[<?=$levelvalue?>]" value="y" />
					  <? } else { ?>
						<input type="checkbox" name="activeLevel<?=ucfirst($module)?>[<?=$levelvalue?>]" class="inputCheck" value="y" <?=((in_array($levelvalue, $selectedLevel) || $hasPost)? "checked=\"checked\"": "");?>/>
					<? } ?>
				</th>

				<? if($module == "banner") { ?>
					<td>
						<?=string_ucwords($levelObj->getDisplayName($levelvalue));?>
					</td>
				<? } else { ?>
					<td>
						<?=string_ucwords($levelObj->getName($levelvalue));?>
					</td>
				<? } ?>
			</tr>
	<?
		}
	} 
?>
</table>
