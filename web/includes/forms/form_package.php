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
	# * FILE: /includes/forms/form_package.php
	# ----------------------------------------------------------------------------------------------------

	?>
	<script type="text/javascript" src="<?=NON_LANG_URL?>/includes/tiny_mce/tiny_mce_src.js"></script>
	<script language="javascript" type="text/javascript">
	// ---------------------------------- //

    function showLangFields(type1, type2, type3, num_language, languages) {
        
        var arrLangNumbers = ('<?=EDIR_LANGUAGENUMBERS;?>').split(',');

        for (j=0;j<languages;j++) {
			i = arrLangNumbers[j];
			jQuery('#'+type1+'_'+i).addClass('isHidden').removeClass('isVisible');
			jQuery('#tab_'+type1+'_'+i).removeClass("tabActived");
			jQuery('#'+type2+'_'+i).addClass('isHidden').removeClass('isVisible');
			jQuery('#tab_'+type2+'_'+i).removeClass("tabActived");
			jQuery('#'+type3+'_'+i).addClass('isHidden').removeClass('isVisible');
			jQuery('#tab_'+type3+'_'+i).removeClass("tabActived");
        }    
		jQuery('#'+type1+'_'+num_language).removeClass('isHidden').addClass('isVisible');
		jQuery('#tab_'+type1+'_'+num_language).addClass("tabActived");
		jQuery('#'+type2+'_'+num_language).removeClass('isHidden').addClass('isVisible');
		jQuery('#tab_'+type2+'_'+num_language).addClass("tabActived");
		jQuery('#'+type3+'_'+num_language).removeClass('isHidden').addClass('isVisible');
		jQuery('#tab_'+type3+'_'+num_language).addClass("tabActived");

    }

    // ---------------------------------- //

	function ShowOptionPackage(optionValue){
		/*
		 * Hidden field to save type of package
		 */
		if(optionValue == "custom_package"){
			document.getElementById('div_editor').style.display = 'block';
			document.getElementById('th_content').innerHTML = '* '+'<?=system_showText(LANG_LABEL_CONTENT)?>';
			document.getElementById('table_custom').style.display = '';
			document.getElementById('div_domains').style.display = 'none';
		}else{
			document.getElementById('th_content').innerHTML = '<?=system_showText(LANG_LABEL_CONTENT)?>';
			document.getElementById('table_custom').style.display = 'none';
			document.getElementById('div_domains').style.display = 'block';
		}

	}

	function enablePriceField(obj){
		var field_id = "value_domain_"+obj.value;
		if (obj.checked == true)
			document.getElementById(field_id).disabled=false;
		else
			document.getElementById(field_id).disabled=true;
	}

	function checkAll(obj, num) {

		var value = obj.checked;

		if(value == true){
			obj.checked = false;
			value = false;

			for (i=0;i<num;i++) {
				document.getElementById('package_'+i).checked = false;
				enablePriceField(document.getElementById('package_'+i));
			}
		} else {
			obj.checked = true;
			value = true;

			for (i=0;i<num;i++) {
				document.getElementById('package_'+i).checked = true;
				enablePriceField(document.getElementById('package_'+i));
			}
		}
	}

	function system_displayTinyMCEJS(txId) {

    	tinyMCE.execCommand('mceAddControl', false, txId);

    }

	</script>
	<p class="informationMessage">* <?=system_showText(LANG_LABEL_REQUIRED_FIELD)?> </p>

	<?
	if ($message_package) {
		echo "<p class=\"errorMessage\">".$message_package."</p>";
	}
	?>

	<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_PACKAGE_SETTINGS_LABEL);?></th>
		</tr>
		<tr>
			<th>
				* <?=system_showText(LANG_SITEMGR_PACKAGE_WHEN_SOMEONE_ORDER)?>
			</th>
			<td>
				<?
				if(is_array($array_dropdown_module_level_actual)){
					?>
					<select name="ordered_item">
						<option value="" >--<?=system_showText(LANG_CHOOSE_PERIOD)?>--</option>
						<?
						for($i=0;$i<count($array_dropdown_module_level_actual);$i++){
							?>
							<option value="<?=$array_dropdown_module_level_actual[$i]["option_id"]?>" <?=($array_dropdown_module_level_actual[$i]["option_id"] == $ordered_item ? " selected " : "")?>>
								<?=$array_dropdown_module_level_actual[$i]["label"]?>
							</option>
							<?
						}
						?>
					</select>
					<?
				}
				
				?>
			</td>
		</tr>
		
		<tr>
			<th>
				* <?=system_showText(LANG_SITEMGR_PACKAGE_OFFER_ITEM)?>
			</th>
			<td>
				<?
				if(is_array($array_commom_domain)){
					?>
					<select name="offer_item" onchange="javascript:ShowOptionPackage(this.value);">
						<option value="" >--<?=system_showText(LANG_CHOOSE_PERIOD)?>--</option>
						<?
						for($i=0;$i<count($array_commom_domain);$i++){
							?>
							<option value="<?=$array_commom_domain[$i]["option_id"]?>" <?=($array_commom_domain[$i]["option_id"] == $offer_item ? " selected " : "")?>>
								<?=$array_commom_domain[$i]["label"]?>
							</option>
							<?
						}
						?>
						<option value="custom_package" <?=($offer_item == "custom_package" ? " selected " : "")?>><?=system_showText(LANG_SITEMGR_PACKAGE_CUSTOM_OPTION_LABEL)?></option>
					</select>
					<?
				}
				?>
			</td>
		</tr>
		
	</table>

	<div id="div_domains">
		<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

			<tr>
				<th style="width: auto;">&nbsp;</th>
				<th style="width: auto;">* <?=system_showText(LANG_SITEMGR_DOMAIN_PLURAL);?></th>
				<th style="width: 70px;"><?=system_showText(LANG_SITEMGR_LABEL_PRICE);?></th>
			</tr>
			<?
			for($i=0;$i<count($array_domains);$i++){
				/*
				 * When edit, check domain_id as item of this package
				 * $aux_package_items_domains = Array with domains on Package
				 * $aux_package_items_values  = Array with values per domain of package
				 */
				unset($aux_checked_true,$aux_value);

					/*
					 * Check if domain_id exists on this package
					 */
					if(is_array($aux_package_items_domains)){
						if(in_array($array_domains[$i]["id"], $aux_package_items_domains)){
							$aux_checked_true = "checked";
						}else{
							$aux_checked_true = "";
						}
					}else{
						$aux_checked_true = "";
					}

					/*
					 * Get value of item on domain of package
					 */
					if(is_array($aux_package_items_values)){
						if(array_key_exists($array_domains[$i]["id"], $aux_package_items_values)){
							$aux_value = $aux_package_items_values[$array_domains[$i]["id"]];
						}else{
							$aux_value = "";
						}
					}else{
						if ($_POST["value_domain_".$array_domains[$i]["id"]]){
							$aux_value = $_POST["value_domain_".$array_domains[$i]["id"]];
						} else {
							$aux_value = "";
						}
					}

				if (!$aux_value && !$aux_checked_true){
					$auxDisable = "disabled";
				} else {
					$auxDisable = "";
				}

				?>
				<tr>
					<td style="width: 10px;">
						<input type="checkbox" id="package_<?=$i?>" value="<?=$array_domains[$i]["id"]?>" name="packageItem_domain_id[]" onclick="enablePriceField(this)" <?=$aux_checked_true;?>/>
					</td>
					<td style="width: 600px;">
						<?=$array_domains[$i]["name"]?>
					</td>
					<td class="packagePrice">
						<?echo CURRENCY_SYMBOL;?> <input type="text" id="value_domain_<?=$array_domains[$i]["id"]?>" name="value_domain_<?=$array_domains[$i]["id"]?>" value="<?=$aux_value?>" <?=$auxDisable;?>  maxlength="8" style="width:55px; text-align:right;"/>
					</td>
				</tr>
				<?
			}
			?>
		</table>
	</div>

	<table border="0" cellpadding="0" cellspacing="0" class="standard-table noMargin">
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_PACKAGEINFORMATION);?></th>
		</tr>
		<tr>
			<th>* <?=system_showText(LANG_SITEMGR_PACKAGE_TITLE);?>:</th>
			<td>
				<input type="text" name="title" value="<?=$title?>" maxlength="100"  />
				<input type="hidden" name="offer_domain_id" value="<?=SELECTED_DOMAIN_ID?>" />
			</td>
		</tr>

		<?
		if ($thumb_id) {
			$imageObj = new Image($thumb_id);
			if ($imageObj->imageExists()) {
				?>
				<tr>
					<th>&nbsp;</th>
					<td class="image-space" colspan="2">
						<?=$imageObj->getTag(true, IMAGE_PACKAGE_THUMB_WIDTH, IMAGE_PACKAGE_THUMB_HEIGHT, $name);?>
					</td>
				</tr>
				<?
			}
		}
		?>

		<?include(EDIRECTORY_ROOT."/includes/code/thumbnail.php");?>

		<? if ($thumb_id) { ?>
			<tr>
				<th>
					<input type="checkbox" name="remove_image" class="inputCheck" value="1" style="vertical-align:middle;" />
				</th>
				<td><?=system_showText(LANG_MSG_CHECK_TO_REMOVE_IMAGE)?>
				</td>
			</tr>
		<? } ?>

		<tr>
			<th><?=system_showText(LANG_LABEL_IMAGE_SOURCE)?>: </th>
			<td>
				<input type="file" name="image" id="image" size="50" onchange="UploadImage('package');" class="inputExplode" /><span class="subSpan"><?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED);?></span>
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
	<table cellpadding="0" cellspacing="0" border="0" class="standard-table" id="table_custom" style="display:none">
		<tr>
			<th><?=system_showText(LANG_SITEMGR_LABEL_PRICE);?>:</th>
			<td>
				<?=CURRENCY_SYMBOL;?>
				<input type="text" name="price" value="<?=$price?>" maxlength="8" style="width:55px; text-align:right;" />
			</td>
		</tr>
	</table>
	<br />

	<div class="multilanguageContent" id="div_editor">
		<table cellpadding="0" cellspacing="0" border="0" class="standard-table">

			<tr>
				<th colspan="2" class="tabsBase">
					<?
					$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
					$num_languages = count(explode(",", EDIR_LANGUAGENAMES));
					$language_numbers = explode(",", EDIR_LANGUAGENUMBERS);
					$labelsuffix = "";
					?>
					<ul class="tabs">
						<? foreach ($language_numbers as $k=>$i) { ?>
							<li id="tab_abstract_<?=$i?>" <?=($k == 0) ? "class=\"tabActived\"" : ""?>><a href="javascript:void(0)" onclick="showLangFields('abstract', 'content', 'keywords', '<?=$i?>', '<?=$num_languages?>'), system_displayTinyMCEJS('content<?=$i?>')"><?=$array_edir_languagenames[$k]?></a></li>
						<? } ?>
					</ul>
				</th>
			</tr>
		</table>

		<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
			<tr>
				<th class="standard-tabletitle" id="th_content"><?=system_showText(LANG_LABEL_CONTENT)?></th>
			</tr>
				<?
				foreach ($language_numbers as $k=>$i) {
					$labelsuffix = $i;
				?>
				<tr id="content_<?=$i?>" <?=($k == 0) ? "class=\"isVisible\"" : "class=\"isHidden\""?>>
					
                    <td class="packageEditor">
						<? // TinyMCE Editor Init
							// getting language
							$pos = string_strpos(EDIR_LANGUAGE, "_");
							$lang = string_substr(EDIR_LANGUAGE, 0, $pos);
							// getting content
							//$content = $contentObj->getString("content", false);

							//fix ie bug with images
							if (!(${"content".$labelsuffix})) ${"content".$labelsuffix} =  "&nbsp;".${"content".$labelsuffix};

							// calling TinyMCE
							system_addTinyMCE($lang, "none", "advanced", "content$labelsuffix", "30", "15", "500", ${"content".$labelsuffix}, false);
						?>
					</td>
               </tr>
			<? } ?>
		</table>	
	</div>

	<?
	system_displayTinyMCE('content'.EDIR_DEFAULT_LANGUAGENUMBER);

	if ($_POST["offer_item"]) $offer_item = $_POST["offer_item"];?>
	<script language="javascript" type="text/javascript">
		ShowOptionPackage('<?=$offer_item?>');
	</script>