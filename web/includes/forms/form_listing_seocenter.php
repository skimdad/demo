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
	# * FILE: /includes/forms/form_listing_seocenter.php
	# ----------------------------------------------------------------------------------------------------

	if ($message) {
		echo "<p class='errorMessage'>";
			echo $message;
		echo "</p>";
	}

?>

<script type="text/javascript">

    function showLangFields(type1, type2, num_language, languages) {
        
        var arrLangNumbers = ('<?=EDIR_LANGUAGENUMBERS;?>').split(',');

        for (j=0;j<languages;j++) {
			i = arrLangNumbers[j];
			jQuery('#'+type1+'_'+i).css('display', 'none');
			jQuery('#tab_'+type1+'_'+i).removeClass("tabActived");
			jQuery('#'+type2+'_'+i).css('display', 'none');
			jQuery('#tab_'+type2+'_'+i).removeClass("tabActived");
        }    
		jQuery('#'+type1+'_'+num_language).css('display', '');
		jQuery('#tab_'+type1+'_'+num_language).addClass("tabActived");
		jQuery('#'+type2+'_'+num_language).css('display', '');
		jQuery('#tab_'+type2+'_'+num_language).addClass("tabActived");
    
    }
	
	var arrLangNumbers	= ('<?=EDIR_LANGUAGENUMBERS;?>').split(',');
	
	$(document).ready(function(){
		
		for (j=0;j<arrLangNumbers.length;j++) {
			i = arrLangNumbers[j];
			var field_name = 'seo_description'+i;
			var count_field_name = 'seo_description_remLen'+i;

			var options = {
						'maxCharacterSize': 250,
						'originalStyle': 'originalTextareaInfo',
						'warningStyle' : 'warningTextareaInfo',
						'warningNumber': 40,
						'displayFormat' : '<span><input readonly="readonly" type="text" id="'+count_field_name+'" name="'+count_field_name+'" size="3" maxlength="3" value="#left" class="textcounter" disabled="disabled" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>' 
				};
			$('#'+field_name).textareaCount(options);

		}
		
	});

</script>

<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
	<tr>
		<th class="standard-tabletitle"><?=system_showText(LANG_LABEL_SEO_TUNING)?> <?=system_showText(LANG_LABEL_TITLE)?></th>
	</tr>
	<tr>
		<td>
			<input type="text" name="seo_title" value="<?=$seo_title?>" maxlength="100" onblur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" />
		</td>
	</tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_FRIENDLY_URL)?></th>
	</tr>
	<tr>
		<td colspan="2" class="standard-tableContent">
			<?=system_showText(LANG_MSG_FRIENDLY_URL1)?><br /><br /><strong><?=system_showText(LANG_LABEL_FOR_EXAMPLE);?>:</strong><br /><br /><?=system_showText(LANG_MSG_FRIENDLY_URL2)?><br />"<?=LISTING_DEFAULT_URL?>/john-auto-repair.html"
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_LABEL_PAGE_NAME)?>:</th>
		<td style="width:597px;">
			<input type="text" name="friendly_url" id="friendly_url" value="<?=$friendly_url?>" maxlength="150" onblur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" />
		</td>
	</tr>
</table>

<div class="multilanguageContent">

<table cellpadding="0" cellspacing="0" border="0" class="standard-table noMargin">
	
	<tr>
        <td colspan="2" class="tabsBase">
           <?
			$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
			$num_languages = count(explode(",", EDIR_LANGUAGENAMES));
			$language_numbers = explode(",", EDIR_LANGUAGENUMBERS);
			$labelsuffix = "";
			?>
			<ul class="tabs">
				<? foreach ($language_numbers as $k=>$i) { ?>
					<li id="tab_description_<?=$i?>" <?=($k == 0) ? "class=\"tabActived\"" : ""?>><a href="javascript:void(0)" onclick="showLangFields('description', 'keywords', '<?=$i?>', '<?=$num_languages?>')"><?=$array_edir_languagenames[$k]?></a></li>
				<? } ?>
			</ul>
        </td>
    </tr>
    <tr>
        <th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SEO_DESCRIPTION)?>&nbsp;<span>(<?=system_showText(LANG_SEO_LINEBREAK)?>)</span></th>
    </tr>
    <?
	foreach ($language_numbers as $k=>$i) {
		$labelsuffix = $i;
	?>
	<tr id="description_<?=$i?>" <?=($k == 0) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
		<td colspan="2">
			<textarea id="seo_description<?=$labelsuffix;?>" name="seo_description<?=$labelsuffix;?>" rows="5" cols="1"><?=${"seo_description".$labelsuffix};?></textarea>
			<div id="textAreaCallback_<?=$labelsuffix;?>"></div>
		</td>
	</tr>
	<? } ?>
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SEO_KEYWORDS)?>&nbsp;<span>(<?=ucfirst(system_showText(LANG_SEO_COLON))?>)</span></th>
	</tr>
	<?
	foreach ($language_numbers as $k=>$i) {
		$labelsuffix = $i;
	?>
	<tr id="keywords_<?=$i?>" <?=($k == 0) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
		<td colspan="2">
			<input type="text" name="seo_keywords<?=$labelsuffix;?>" value="<?=${"seo_keywords".$labelsuffix}?>" />
		</td>
	</tr>
	<? } ?>

</table>

</div>
