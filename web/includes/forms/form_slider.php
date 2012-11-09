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
	# * FILE: /includes/forms/form_slider.php
	# ----------------------------------------------------------------------------------------------------

	if ($message_approval_options) { ?>
		<div id="warning" class="<?=$message_style?>">
			<?=$message_approval_options?>
		</div>
	<? } 
	
	for($slider_number=1;$slider_number<=TOTAL_SLIDER_ITEMS;$slider_number++){ ?>

		<table id="slider_setting_title_<?=$slider_number?>" class="standard-table">
			<tr class="standard-tabletitle-parent">
				<th class="standard-tabletitle" style="cursor: pointer;">
					<?=LANG_SITEMGR_ITEM_SLIDER?> <?=$slider_number?>
				</th>
				<th class="standard-tabletitle" style="cursor: pointer;width:42px;height:32px;">

                        <div class="slideImage" style="width:42px;height:32px;margin-top:0;" id="<?=$slider_number?>_div_slider_image">
                            
								<?
								if($array_slider[$slider_number]["image_id"]){
									$imageObj = new Image($array_slider[$slider_number]["image_id"]);
									if ($imageObj->imageExists()) {

										echo $imageObj->getTag(true, 40, 30, ($array_slider[$slider_number]["alternative_text"]));

									} else {
										echo "<div class=\"imgDetail\" style=\"width:40px;height:30px;\">";
										echo "<div class=\"noimage\" style=\"width:40px;height:30px;\">&nbsp;</div>";
										echo "</div>";
									}
								}
								?>
                                
                            
                        </div>
				</th>				
			</tr>
		</table>

		<div id="slider_setting_<?=$slider_number?>" class="defaultItems noSpace"  style="display: none">

			<?
			/*
			 * Title of Slider
			 */
			?>
			<table class="standard-table item-title">
				<tr>
					<th>
						<h4><?=system_showText(LANG_SITEMGR_SLIDER_TITLE)?> </h4><?=system_showText(LANG_SITEMGR_SLIDER_TITLE_EXPLAIN)?>
					</th>
				</tr>
				<tr>
					<td>
						<input type="text" id="<?=$slider_number?>_title" name="<?=$slider_number?>_title" value="<?=$array_slider[$slider_number]["title"]?>" maxlength="50" />
						<input type="hidden"  id="<?=$slider_number?>_id" name="<?=$slider_number?>_id" value="<?=$array_slider[$slider_number]["id"]?>" />
						
					</td>
				</tr>
                <? if (SLIDER_HAS_PRICE) { ?>
                <tr>
                    <th>
                        <h4><?=system_showText(LANG_LABEL_PRICE);?></h4>
                    </th>
                </tr>
                <tr>
                    <td>
                        <?
                        unset($price_value);
                        if ( $array_slider[$slider_number]["price"] != 'NULL' ) {
                            $price_value = explode(".", $array_slider[$slider_number]["price"]);	
                        }
                        echo CURRENCY_SYMBOL;
                        ?>
                        <input type="text" name="<?=$slider_number?>_price_int" value="<?=($price_value[0]) ? $price_value[0] : ${$slider_number."_price_int"} ?>" id="<?=$slider_number?>_price_int" maxlength="7" style="width:55px !important; text-align:right;" />
                        <strong> &nbsp;.&nbsp; </strong>
                        <input type="text" name="<?=$slider_number?>_price_cent" value="<?=($price_value[1] ? $price_value[1] : ${$slider_number."_price_cent"})?>" id="<?=$slider_number?>_price_cent" maxlength="2" style="width:20px !important;" />
                    </td>
                </tr>
                <? } ?>
			</table>

			

			<?
			/*
			 * Description of Slider
			 */
			?>
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
								foreach ($language_numbers as $k=>$i) { 
									?>
									<li id="<?=$slider_number?>_tab_summary_<?=$i?>" <?=($k == 0) ? "class=\"tabActived\"" : ""?>>
										<a href="javascript:void(0)" onclick="showLangFields('<?=$slider_number?>_tab_summary_','<?=$slider_number?>_summary_', '<?=$i?>', '<?=$num_languages?>')">
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
							<?=system_showText(LANG_LABEL_SUMMARY_DESCRIPTION)?> <span style="display:inline">(<?=string_strtolower(system_showText(constant("LANG_MSG_MAX_".SLIDER_MAX_CHARS."_CHARS")))?>)</span>
						</th>
					</tr>
					<?
					foreach ($language_numbers as $k=>$i) {
						$labelsuffix = $i;
						?>
						<tr id="<?=$slider_number?>_summary_<?=$i?>" <?=($k == 0) ? "class=\"isVisible\"" : "class=\"isHidden\""?> >
							<td>
								<textarea id="<?=$slider_number?>_summary<?=$labelsuffix;?>" name="<?=$slider_number?>_summary<?=$labelsuffix;?>" rows="5" cols="1" class="input-textarea-form-listing"><?=$array_slider[$slider_number]["summary".$labelsuffix]?></textarea>
								<div id="textAreaCallback_<?=$i?>"></div>
							</td>

						</tr>
						<? 
					} 
					?>
				</table>

			</div>

			<?
			/*
			 * Image to slider
			 */
			?>
			<table class="standard-table item-table form-standard-table">
				<tr>
					<th class="standard-tabletitle no-tabletitle" colspan="2">
						<?=system_showText(LANG_LABEL_IMAGE)?> <span>(<?=IMAGE_SLIDER_WIDTH?>px x <?=IMAGE_SLIDER_HEIGHT?>px) (JPG, GIF <?=system_showText(LANG_OR);?> PNG)</span>
					</th>
				</tr>
				<tr>
					<td colspan="2">
						<?=system_showText(LANG_SITEMGR_SLIDER_ADVICE_IMAGE_SIZE)?>
					</td>
				</tr>
                <tr>
                	<td>
                    	<table class="addSlideImage">
                        	<tr>
                                <th>
                                    <?=system_showText(LANG_LABEL_IMAGE_SOURCE)?>:
                                </th>
                                <td>
                                    <input size="38" type="file" name="<?=$slider_number?>_image" />
                                    <input type="hidden" id="<?=$slider_number?>_image_id" name="<?=$slider_number?>_image_id" value="<?=$array_slider[$slider_number]["image_id"]?>" /><br />
                                    <span><?=system_showText(LANG_SITEMGR_MSGERROR_MAXFILESIZEALLOWEDIS." ".UPLOAD_MAX_SIZE."MB.");?></span>
                                </td>
                            </tr>
                		</table>
                	</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="slideImage" id="<?=$slider_number?>_div_slider_image">
                            
								<?
								if($array_slider[$slider_number]["image_id"]){
									$imageObj = new Image($array_slider[$slider_number]["image_id"]);
									if ($imageObj->imageExists()) {

										echo $imageObj->getTag(true, 440, 248, ($array_slider[$slider_number]["alternative_text"]));

									} else {
										echo "<div class=\"imgDetail\" style=\"width:440px;\">";
										echo "<div class=\"noimage\" style=\"height:248px;\">&nbsp;</div>";
										echo "</div>";

									}
								}else{
									?>
									<div class="slideImageText">
										<h6><?=LANG_LABEL_IMAGE?> <span><?=LANG_SITEMGR_SLIDER_NO_IMAGE_EXPLAIN?></span></h6>
									</div>
									<?
								}
								?>
                                
                            
                        </div>
                    </td>
                </tr>
			</table>
            
            <div class="multilanguageContent">
				<table border="0" cellpadding="2" cellspacing="0" class="standard-table">
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
									<li id="<?=$slider_number?>_tab_image_<?=$i?>" <?=($k == 0) ? "class=\"tabActived\"" : ""?>>
										<a href="javascript:void(0)" onclick="showLangFields('<?=$slider_number?>_tab_image_','<?=$slider_number?>_image_text_fields_', '<?=$i?>', '<?=$num_languages?>')">
											<?=$array_edir_languagenames[$k]?>
										</a>
									</li>
								<? } ?>
							</ul>
						</td>
					</tr>

					<? 
					foreach ($language_numbers as $k=>$i) {
						$labelsuffix = $i;
						?>
						<tr id="<?=$slider_number?>_image_text_fields_<?=$i?>" <?=($k == 0) ? "class=\"isVisible\"" : "class=\"isHidden\""?> >
							<td>
								<table>
                                    <? if (SLIDER_USE_NEWEST) { ?>
									<tr>
										<th class="wrapcaption">
											<?=system_showText(LANG_SITEMGR_SLIDER_ALTERNATIVE_TEXT)?><?=((count(explode(",", EDIR_LANGUAGES))>1)?(" (".$array_edir_languagenames[$k]."):"):(":"));?>
										</th>
										<td class="wrapcaption">
											<input id="<?=$slider_number?>_alternative_text<?=$labelsuffix;?>" type="text" name="<?=$slider_number?>_alternative_text<?=$labelsuffix;?>" value="<?=$array_slider[$slider_number]["alternative_text".$labelsuffix]?>" class="inputExplode" maxlength="250" />
										</td>
									</tr>

									<tr>
										<th class="wrapcaption">
												<?=system_showText(LANG_SITEMGR_SLIDER_IMAGE_TITLE)?><?=((count(explode(",", EDIR_LANGUAGES))>1)?(" (".$array_edir_languagenames[$k]."):"):(":"));?>
										</th>
										<td class="wrapcaption">
											<input id="<?=$slider_number?>_title_text<?=$labelsuffix;?>" type="text" name="<?=$slider_number?>_title_text<?=$labelsuffix;?>" value="<?=$array_slider[$slider_number]["title_text".$labelsuffix]?>" class="inputExplode" maxlength="250"/>
										</td>
									</tr>
                                    <? } ?>
									
									<tr>
										<th class="wrapcaption">
											<?=system_showText(LANG_SITEMGR_SLIDER_LINK_LABEL)?><?=((count(explode(",", EDIR_LANGUAGES))>1)?(" (".$array_edir_languagenames[$k]."):"):(":"));?>
										</th>
										<td class="wrapcaption">
											<input id="<?=$slider_number?>_link<?=$labelsuffix;?>" type="text" name="<?=$slider_number?>_link<?=$labelsuffix;?>" value="<?=$array_slider[$slider_number]["link".$labelsuffix]?>" class="inputExplode"/>
											<span><?=system_showText(LANG_SITEMGR_SLIDER_EXPLAIN_LINK)?></span>
										</td>
									</tr>

								</table>
							</td>
						</tr>
						<? } ?>				
				</table>
			</div>
			<?
			if($array_slider[$slider_number]["image_id"]){
				$imageObj = new Image($array_slider[$slider_number]["image_id"]);
				if ($imageObj->imageExists() || $array_slider[$slider_number]["title"]) {
					?>
					<input type="button" value="<?=system_showText(LANG_SITEMGR_CLEAR)?>" class="input-button-form" onclick="<?=DEMO_LIVE_MODE ? "livemodeMessage('".system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE2)."');" : "clearSlider($slider_number);"?>" />
					<?
				}
			}
			?>
			
		</div>
		
		<? } ?>		

	<script type="text/javascript">
		var arrLangNumbers	= ('<?=EDIR_LANGUAGENUMBERS;?>').split(',');
			
		$(document).ready(function(){
	
			<? for($slider_number=1;$slider_number<=TOTAL_SLIDER_ITEMS;$slider_number++){ ?>
				$('#slider_setting_title_<?=$slider_number?>').click(function () {
					if ($('#slider_setting_<?=$slider_number?>').is(':hidden')) {
						$('#slider_setting_title_<?=$slider_number?>').css('cursor', 'pointer');
						$('#slider_setting_title_<?=$slider_number?> tr th').addClass('active');
						$('#slider_setting_<?=$slider_number?>').slideDown('slow');
					} else {
						$('#slider_setting_<?=$slider_number?>').slideUp('slow');
						$('#slider_setting_title_<?=$slider_number?> tr th').removeClass('active');
						$('#slider_setting_title_<?=$slider_number?>').css('cursor', 'pointer');

					}
				});

				for (j=0;j<arrLangNumbers.length;j++) {
					i = arrLangNumbers[j];
					var field_name = <?=$slider_number?>+'_summary'+i;
					var count_field_name = <?=$slider_number?>+'_remLen'+i;
					
					var options = {
								'maxCharacterSize': <?=SLIDER_MAX_CHARS?>,
								'originalStyle': 'originalTextareaInfo',
								'warningStyle' : 'warningTextareaInfo',
								'warningNumber': 40,
								'displayFormat' : '<span><input readonly="readonly" type="text" id="'+count_field_name+'" name="'+count_field_name+'" size="3" maxlength="3" value="#left" class="textcounter" disabled="disabled" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>' 
						};
					$('#'+field_name).textareaCount(options);

				}
                
                $.mask.definitions['~']='[+-]';
                $("#<?=$slider_number?>_price_int").mask("9?999999",{placeholder:""});
                $("#<?=$slider_number?>_price_cent").mask("9?9",{placeholder:""});
                
			<? } ?>
                    
		});
			
		function showLangFields(tabs,fields,num_language, languages) {

			var arrLangNumbers	= ('<?=EDIR_LANGUAGENUMBERS;?>').split(',');
			var fields_array	= fields.split(',');
			var tabs_array		= tabs.split(',');
			
			for (j=0;j<languages;j++) {
				i = arrLangNumbers[j];
				for(k=0;k<fields_array.length;k++){
					if(i != num_language){
						jQuery('#'+fields_array[k]+i).addClass('isHidden').removeClass('isVisible');
						jQuery('#'+tabs_array[k]+i).removeClass("tabActived");
					}else{
						
						jQuery('#'+fields_array[k]+num_language).removeClass('isHidden').addClass('isVisible');
						jQuery('#'+tabs_array[k]+num_language).addClass("tabActived");
					}
					
				}
				
			}
			
			
		}
		
		function clearSlider(id){
			
			if(confirm("<?=LANG_SITEMGR_SLIDER_CONFIRM_DELETE?>")){
				
				$.ajax({
				   type: "POST",
				   url: "<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/delete_slider_image.php",
				   data: "clear_slider=true&image_id="+document.getElementById(id+"_image_id").value+"&slider_id="+document.getElementById(id+"_id").value
				 });
				
				document.getElementById(id+"_title").value = "";
				document.getElementById(id+"_image_id").value = "";
                if (document.getElementById(id+"_price_int")){
                    document.getElementById(id+"_price_int").value = "";
                }
                if (document.getElementById(id+"_price_cent")){
                    document.getElementById(id+"_price_cent").value = "";
                }
				<?
				/*
				 * Cleaning language fields
				 */
				$language_numbers = explode(",", EDIR_LANGUAGENUMBERS);
				foreach ($language_numbers as $k=>$i) { 
					?>
					document.getElementById(id+"_summary<?=$i?>").value = "";
                    if (document.getElementById(id+"_alternative_text<?=$i;?>")){
                        document.getElementById(id+"_alternative_text<?=$i;?>").value="";
                    }
                    if (document.getElementById(id+"_title_text<?=$i;?>")){
                        document.getElementById(id+"_title_text<?=$i;?>").value="";
                    }
					document.getElementById(id+"_link<?=$i;?>").value="";
					<?
				}
				?>
							
				aux_text = "<div class=\"slideImageText\"><h6><?=LANG_LABEL_IMAGE?> <span><?=LANG_SITEMGR_SLIDER_NO_IMAGE_EXPLAIN?></span></h6></div>";
				document.getElementById(id+'_div_slider_image').innerHTML = aux_text;
			}
		}
	</script> 