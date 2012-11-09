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
	# * FILE: blog/includes/forms/form_blogcategory.php
	# ----------------------------------------------------------------------------------------------------

?>
<script type="text/javascript" src="<?=NON_LANG_URL?>/includes/tiny_mce/tiny_mce_src.js"></script>
<script type="text/javascript">

	function system_displayTinyMCEJS(txId) {
    	tinyMCE.execCommand('mceAddControl', false, txId);
    }

  	function enableCategory(languages){
		var arrLangNumbers = ('<?=EDIR_LANGUAGENUMBERS;?>').split(',');
		var alreadyCheck = false;
		$('#multilanguageContent').show();
		for(j = 0; j <= languages; j++){
			i = arrLangNumbers[j];
			if (languages > 1) $('#lang_' + i).show();
			if ($('#language_' + i).attr('checked')){
				$('#tab_abstract_' + i).show();
				if (!alreadyCheck) {
					$('#divLang_' + i).show();
					$('#tab_abstract_' + i).addClass('tabActived');
					system_displayTinyMCEJS('content' + i);
					alreadyCheck = true;
				}
			} else {
				$('#tab_abstract_' + i).hide();
				$('#divLang_' + i).hide();
			}
			
			if (!alreadyCheck) {
				var k = <?=EDIR_DEFAULT_LANGUAGENUMBER?>;
				$('#language_' + k).attr('checked', 'checked');
				$('#tab_abstract_' + k).show();
				$('#divLang_' + k).show();
				$('#tab_abstract_' + k).addClass('tabActived');
				system_displayTinyMCEJS('content' + k);
			}
		}
    }

	function showLangInfo (num_language, languages) {
		var arrLangNumbers = ('<?=EDIR_LANGUAGENUMBERS;?>').split(',');
        for (j = 0; j <= languages; j++) {
			i = arrLangNumbers[j];
			if (i == num_language) {
				if ($('#language_' + i).attr('checked') == true) {
					$('#divLang_' + i).show();
				}
				$('#tab_abstract_' + i).addClass('tabActived');
			} else {
				$('#divLang_' + i).hide();
				$('#tab_abstract_' + i).removeClass('tabActived');
			}
		}
		
		system_displayTinyMCEJS('content' + num_language);
    }

	function showLangFields (num_language, languages) {
		var li_id = "";
		var aLi = null;
		var li_count = 0;
		var auxLi = "";
		var auxALi = null;
		if ($('#language_'+num_language).attr('checked') == true) {
			$('#tab_abstract_' + num_language).show();
		} else {
			$('#tab_abstract_' + num_language).hide();
			$('#tab_abstract_' + num_language).removeClass('tabActived');
		}

		$('.tabs li').each(function(){
			if ($(this).css('display') != "none" && li_id == "") {
				li_id = $(this).attr('id');
				aLi = li_id.split("_");
				num_language = aLi[2];
			} else if ($(this).hasClass('tabActived')) {
				li_id = $(this).attr('id');
				aLi = li_id.split("_");
				num_language = aLi[2];
			}

			if ($(this).css('display') == "none") {
				auxLi = $(this).attr('id');
				auxALi = auxLi.split("_");
				$('#divLang_' + auxALi[2]).hide();
				li_count++;
			}
		});

		if (li_count != languages) {
			$('#multilanguageContent').show();
			showLangInfo(num_language, languages);
		} else {
			$('#multilanguageContent').hide();
		}
	}
	
	var arrLangNumbers	= ('<?=EDIR_LANGUAGENUMBERS;?>').split(',');

	$(document).ready(function(){
		$('#title1').blur(function() {
			$('#page_title1').attr('value', $('#title1').val());
		});
		$('#title2').blur(function() {
			$('#page_title2').attr('value', $('#title2').val());
		});
		$('#title3').blur(function() {
			$('#page_title3').attr('value', $('#title3').val());
		});
		$('#title4').blur(function() {
			$('#page_title4').attr('value', $('#title4').val());
		});
		$('#title5').blur(function() {
			$('#page_title5').attr('value', $('#title5').val());
		});
		$('#title6').blur(function() {
			$('#page_title6').attr('value', $('#title6').val());
		});
		$('#title7').blur(function() {
			$('#page_title7').attr('value', $('#title7').val());
		});
		
		for (j=0;j<arrLangNumbers.length;j++) {
			i = arrLangNumbers[j];
			var field_name = 'seo_description'+i;
			var field_name2 = 'seo_keywords'+i;
			var count_field_name = 'seo_description_remLen'+i;
			var count_field_name2 = 'seo_keywords_remLen'+i;

			var options = {
						'maxCharacterSize': 250,
						'originalStyle': 'originalTextareaInfo',
						'warningStyle' : 'warningTextareaInfo',
						'warningNumber': 40,
						'displayFormat' : '<span><input readonly="readonly" type="text" id="'+count_field_name+'" name="'+count_field_name+'" size="3" maxlength="3" value="#left" class="textcounter" disabled="disabled" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>' 
				};
				
			var options2 = {
						'maxCharacterSize': 250,
						'originalStyle': 'originalTextareaInfo',
						'warningStyle' : 'warningTextareaInfo',
						'warningNumber': 40,
						'displayFormat' : '<span><input readonly="readonly" type="text" id="'+count_field_name2+'" name="'+count_field_name2+'" size="3" maxlength="3" value="#left" class="textcounter" disabled="disabled" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>' 
				};
			
			$('#'+field_name).textareaCount(options);
			$('#'+field_name2).textareaCount(options2);

		}
	});

</script>
<?
	$array_edir_languages = explode(",", EDIR_LANGUAGES);
	$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
	$num_languages = count(explode(",", EDIR_LANGUAGENAMES));
	$language_numbers = explode(",", EDIR_LANGUAGENUMBERS);
?>

<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle">
			<?=string_ucwords(system_showText(LANG_SITEMGR_BLOG))?> - <?=system_showText(LANG_SITEMGR_TAG_INFORMATION)?>
		</th>
	</tr>
	<?
		$firstCheck = "";
		if ($num_languages == 1) $langDisplay = "style=\"display: none;\"";
		else $langDisplay = "style=\"display:table-row;\"";
		foreach ($language_numbers as $k=>$i) { ?>
		<tr id="lang_<?=$i?>" <?=$langDisplay;?>>
			<th>
				<?
					if ($k == 0) {
						echo system_showText(LANG_SITEMGR_ENABLE_LANGUAGE).":";
					} else {
						echo "&nbsp;";
					}
				?>
			</th>
			<td>
				<?
					$langCheck = "";
					if (count($languages) && $languages[0] != "") {
						if (in_array($array_edir_languages[$k], $languages)) {
							$langCheck = "checked";
//							$firstCheck = $k;
						}
					} else if (!$id && $k == 0) {
						$langCheck = "checked";
//						$firstCheck = $i;
					}
					
					if ($i == EDIR_DEFAULT_LANGUAGENUMBER) $langCheck = "checked";
				?>
				<?
					$langDisabled = "";
					if (($i == EDIR_DEFAULT_LANGUAGENUMBER) || ($category_id && ($category_id != 0) && ($fatherCategoryArray["id"]) && (string_strpos($fatherCategoryArray["lang"], $array_edir_languages[$k])) === false)) {
						$langDisabled = "disabled";
					}
				?>
				<input type="checkbox" id="language_<?=$i?>" name="languages[]" value="<?=$array_edir_languages[$k];?>" class="inputCheck" <?=$langCheck;?> <?=$langDisabled;?> onclick="showLangFields('<?=$i?>', '<?=$num_languages;?>')" />
				<?=$array_edir_languagenames[$k];?>
			</td>
		</tr>
	<? } ?>
</table>

<div id="multilanguageContent" class="multilanguageContent">
	<table cellpadding="0" cellspacing="0" border="0" class="standard-table noMargin">

		<tr>
			<th colspan="2" class="tabsBase">
				<ul class="tabs"><?
					foreach ($language_numbers as $k=>$i) {
						$labelsuffix = $i;

							$tabDisplay = "style=\"display: none;\"";
							if (count($languages) && $languages[0] != "") {
							if (in_array($array_edir_languages[$k], $languages)) {
									$tabDisplay = "";
								}
						} else if (!$id && $k == 0) {
								$tabDisplay = "";
							}

							$tabActived = "";
							if ($i == EDIR_DEFAULT_LANGUAGENUMBER) {
								$tabActived =  "class=\"tabActived\"";
							}
						?>
						<li id="tab_abstract_<?=$i?>" <?=$tabDisplay;?> <?=$tabActived;?>><a href="javascript:void(0)" onclick="showLangInfo('<?=$i?>', '<?=$num_languages?>'), system_displayTinyMCEJS('content<?=$labelsuffix?>')"><?=$array_edir_languagenames[$k]?></a></li>
					<? } ?>
				</ul>
			</th>
		</tr>
	</table>

	<? foreach ($language_numbers as $k=>$i) {
		$labelsuffix = $i;

			$divDisplay = "style=\"display: block;\"";
			if ($i != $firstCheck) {
				$divDisplay = "style=\"display: none;\"";
			}
		?>
		<div id="divLang_<?=$i?>" <?=$divDisplay;?>>
			<table cellpadding="0" cellspacing="0" border="0" class="standard-table noMargin">
				<tr>
					<th>* <?=system_showText(LANG_SITEMGR_TITLE)?>:</th>
					<td>
						<input type="text" id="title<?=$labelsuffix;?>" name="title<?=$labelsuffix;?>" class="input-form" value="<?=${"title".$labelsuffix};?>" onblur="easyFriendlyUrl(this.value, 'friendly_url<?=$labelsuffix;?>', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" />
						<span><?=system_showText(LANG_SITEMGR_CATEGORY_INFOTEXT1)?></span>
					</td>
				</tr>
			</table>

			<table cellpadding="0" cellspacing="0" border="0" class="standard-table noMargin">
				<tr>
					<th colspan="2" class="standard-tabletitle">
						<?=system_showText(LANG_SITEMGR_KEYWORDSFORTHESEARCH)?>
					</th>
				</tr>
				<tr>
					<th style="width: 350px;">
						<span class="label-login">
							<p>
								<?=system_showText(LANG_SITEMGR_ADDONEKEYWORDPERLINE)?>. <?=system_showText(LANG_SITEMGR_FOREXAMPLE)?>:
							</p>
						</span>
					</th>
					<th style="width: 350px;">
						<span class="label-login">
							<p style="text-align: justify;">
								<?=system_showText(LANG_SITEMGR_KEYWORD_SAMPLE_1)?><br />
								<?=system_showText(LANG_SITEMGR_KEYWORD_SAMPLE_2)?><br />
								<?=system_showText(LANG_SITEMGR_KEYWORD_SAMPLE_3)?><br />
							</p>
						</span>
					</th>
				</tr>
				<tr>
					<td colspan=2 style="text-align:center">
						<textarea name="keywords<?=$labelsuffix;?>" rows="5" cols="1"><?=${"keywords".$labelsuffix};?></textarea>
					</td>
				</tr>
			</table>

			<table cellpadding="0" cellspacing="0" border="0" class="standard-table noMargin">
				<tr>
					<th colspan="2" class="standard-tabletitle">
						<?=string_ucwords(system_showText(LANG_SITEMGR_CONTENT_SEOCENTER))?>
					</th>
				</tr>
				<tr>
					<td colspan="2">
                        <table class="categoryExampleTable">
                            <tr>
                                <td class="categoryExampleLine">
                                    <span class="label-login">
                                        <p style="text-align: justify;"><?=system_showText(LANG_SITEMGR_CATEGORY_FRIENDLYURL1)?><br /><br /><strong><?=system_showText(LANG_SITEMGR_FOREXAMPLE)?>:</strong><br /><br /><?=system_showText(LANG_SITEMGR_CATEGORY_FRIENDLYURL2)?><br />"<?=$default_url?>/guide/computer"</p>
									</span>
								</td>
                            </tr>
                        </table>
					</td>
				</tr>
				<tr>
					<th>
						* <?=system_showText(LANG_SITEMGR_LABEL_PAGETITLE)?>:
					</th>
					<td class="categorySEOLine">
						<input type="text" id="page_title<?=$labelsuffix;?>" name="page_title<?=$labelsuffix;?>" class="input-form" value="<?=${"page_title".$labelsuffix};?>" />
					</td>
				</tr>
				<tr>
					<th>
						* <?=system_showText(LANG_SITEMGR_LABEL_FRIENDLYTITLE)?>:
					</th>
					<td>
						<input type="text" id="friendly_url<?=$labelsuffix;?>" name="friendly_url<?=$labelsuffix;?>" class="input-form" value="<?=${"friendly_url".$labelsuffix};?>" onblur="easyFriendlyUrl(this.value, 'friendly_url<?=$labelsuffix;?>', '<?=FRIENDLYURL_VALIDCHARS?>\n', '<?=FRIENDLYURL_SEPARATOR?>');" />
					</td>
				</tr>
				<tr>
					<th>
						<?=system_showText(LANG_SITEMGR_LABEL_METADESCRIPTION)?>:
					</th>
					<td>
						<textarea id="seo_description<?=$labelsuffix;?>" name="seo_description<?=$labelsuffix;?>" rows="5" cols="1"><?=${"seo_description".$labelsuffix};?></textarea>
						<div id="textAreaCallback1_<?=$labelsuffix;?>"></div>
					</td>
				</tr>
				<tr>
					<th>
						<?=system_showText(LANG_SITEMGR_LABEL_METAKEYWORDS)?>:
					</th>
					<td>
						<textarea id="seo_keywords<?=$labelsuffix;?>" name="seo_keywords<?=$labelsuffix;?>" rows="5" cols="1" ><?=${"seo_keywords".$labelsuffix};?></textarea>
						<div id="textAreaCallback2_<?=$labelsuffix;?>"></div>
					</td>
				</tr>
			</table>

			<table cellpadding="0" cellspacing="0" border="0" class="standard-table noMargin">
				<tr>
					<th colspan="2" class="standard-tabletitle">
						<?=string_ucwords(system_showText(LANG_SITEMGR_CONTENT));?>:
					</th>
				</tr>
				<tr>
					<td colspan="2">
						<? // TinyMCE Editor Init
							$pos = string_strpos(EDIR_LANGUAGE, "_");
							$lang = string_substr(EDIR_LANGUAGE, 0, $pos);
							//fix ie bug with images
							if (!(${"content".$labelsuffix})) ${"content".$labelsuffix} = "&nbsp;".${"content".$labelsuffix};

							// calling TinyMCE
							system_addTinyMCE($lang, "none", "advanced", "content".$labelsuffix, "30", "15", "300", ${"content".$labelsuffix}, false);
						?>
					</td>
				</tr>
			</table>
		</div>
	<? } ?>
</div>

<script type="text/javascript">
	enableCategory('<?=$num_languages;?>');
</script>