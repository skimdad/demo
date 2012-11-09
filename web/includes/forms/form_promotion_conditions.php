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
	# * FILE: /includes/forms/form_promotion_conditions.php
	# ----------------------------------------------------------------------------------------------------

if ($promotion_force_redeem_by_facebook)
    $promotion_force_redeem_by_facebook_checked = " checked='checked' ";
?>

<? if ($message_promotion_conditions) { ?>
	<div id="warning" class="<?=$message_style?>">
		<?=$message_promotion_conditions?>
	</div>
<? } ?>

<div class="header-form">
	<?=system_showText(LANG_SITEMGR_OPTIONS)?>
</div>
<?if (FACEBOOK_APP_ENABLED == "on"){?>
<table cellpadding="2" cellspacing="0" border="0" class="standard-table noMargin">
	<tr class="tr-form">
		<th>
			<input type="checkbox" id="promotion_force_redeem_by_facebook" name="promotion_force_redeem_by_facebook" <?=$promotion_force_redeem_by_facebook_checked?> value="1" />
		</th>
		<td><?=system_showText(LANG_SITEMGR_REDEEMALSO_WOUT_FB)?></td>
	</tr>
</table>
<?}?>

<div class="multilanguageContent">
	<table cellpadding="2" cellspacing="0" border="0" class="standard-table">
		<tr>
			<td class="tabsBase">
				<ul class="tabs">
				<?
				if ($num_languages)
					foreach ($language_numbers as $k=>$i) { ?>
						<li id="tab_cond_<?=$i?>" <?=($k == 0) ? "class=\"tabActived\"" : ""?>><a href="javascript:void(0)" onclick="showLangFields('cond', 'conditional', '<?=$i?>', '<?=$num_languages?>')"><?=$array_edir_languagenames[$k]?></a></li>
					<?
					}
				?>
				</ul>
			</td>
		</tr>
	</table>
	<table cellpadding="2" cellspacing="0" border="0" class="standard-table">
		<tr class="tr-form">
			<th colspan="2" class="standard-tabletitle">
				<?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_PROMOTION_DEFAULTCONDITIONTEXT))?>
			</th>
		</tr>
		<?


		if ($num_languages){
			foreach ($language_numbers as $k=>$i) {
				$displayThis=false;
				if ( strtolower($edir_languages[$i])==strtolower(EDIR_LANGUAGE) ){
					$displayThis=true;
					$currentSelectedId=$i;
				}
				customtext_get("promotion_default_conditions", $promotion_default_conditions, $edir_languages[$k]);

				?>
				<tr id="conditional_<?=$i?>" <?=($k == 0) ? "class=\"isVisible\"" : "class=\"isHidden\""?> >
					<th><?=system_showText(LANG_SITEMGR_SETTINGS_PROMOTION_CONDITIONS)?></th>
					<td>
						<textarea id="promotion_default_conditions<?=$i?>" name="promotion_default_conditions<?=$i?>" rows="10" cols="1" class="input-textarea-form-listing"><?=$promotion_default_conditions?></textarea>
						<div id="textAreaCallback_<?=$i;?>"></div>
					</td>
				</tr>
				<?

			}
		}

		?>


	</table>
</div>
<script type="text/javascript">

	function showLangFields(type1, type2, num_language, languages) {
		
		 var arrLangNumbers = ('<?=EDIR_LANGUAGENUMBERS;?>').split(',');

        for (j=0;j<languages;j++) {
			i = arrLangNumbers[j];
            jQuery('#'+type1+'_'+i).addClass('isHidden').removeClass('isVisible');
			jQuery('#tab_'+type1+'_'+i).removeClass("tabActived");
            jQuery('#'+type2+'_'+i).addClass('isHidden').removeClass('isVisible');
			jQuery('#tab_'+type2+'_'+i).removeClass("tabActived");

        }
        jQuery('#'+type1+'_'+num_language).removeClass('isHidden').addClass('isVisible');
		jQuery('#tab_'+type1+'_'+num_language).addClass("tabActived");
        jQuery('#'+type2+'_'+num_language).removeClass('isHidden').addClass('isVisible');
		jQuery('#tab_'+type2+'_'+num_language).addClass("tabActived");
    }
	
	var arrLangNumbers	= ('<?=EDIR_LANGUAGENUMBERS;?>').split(',');
	<? if ($num_languages){ ?>
	$(document).ready(function(){
		
		for (j=0;j<arrLangNumbers.length;j++) {
			i = arrLangNumbers[j];
			var field_name = 'promotion_default_conditions'+i;
			var count_field_name = 'promotion_default_conditions_remLen'+i;

			var options = {
						'maxCharacterSize': 1000,
						'originalStyle': 'originalTextareaInfo',
						'warningStyle' : 'warningTextareaInfo',
						'warningNumber': 40,
						'displayFormat' : '<span><input readonly="readonly" type="text" id="'+count_field_name+'" name="'+count_field_name+'" size="3" maxlength="3" value="#left" class="textcounter" disabled="disabled" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>' 
				};
			$('#'+field_name).textareaCount(options);

		}
		
	});
	<? } ?>
</script>