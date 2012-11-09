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
	# * FILE: /includes/forms/form_banner.php
	# ----------------------------------------------------------------------------------------------------

	// Price description ---------------------------------------------
	
	setting_get("payment_tax_status", $payment_tax_status);
	setting_get("payment_tax_value", $payment_tax_value);
	customtext_get("payment_tax_label", $payment_tax_label, EDIR_LANGUAGE);

	$levelObj = new BannerLevel(EDIR_DEFAULT_LANGUAGE, true);
	$levelObjAux = new BannerLevel();
	$levelValue = $levelObj->getValues();
	unset($strArray);
	foreach ($levelValue as $value) {
		if ($levelObjAux->getActive($value)) {
			$strAux = $levelObj->showLevel($value).": <b>";
			if ($levelObj->getPrice($value) > 0) {
				$strAux .= CURRENCY_SYMBOL.$levelObj->getPrice($value);
			} else {
				$strAux .= CURRENCY_SYMBOL.system_showText(LANG_LABEL_FREE);
			}
			$strAux .= "</b> ".system_showText(LANG_PER)." ";
			if (payment_getRenewalCycle("banner") > 1) {
				$strAux .= payment_getRenewalCycle("banner")." ";
				$strAux .= payment_getRenewalUnitName("banner")."s";
			}else {
				$strAux .= payment_getRenewalUnitName("banner");
			}
			$strAux2 = $levelObj->showLevel($value).": <b>";
			if ($levelObj->getImpressionPrice($value) > 0) {
				$strAux2 .= CURRENCY_SYMBOL.$levelObj->getImpressionPrice($value);
			} else {
				$strAux2 .= CURRENCY_SYMBOL.system_showText(LANG_LABEL_FREE);
			}
			$strAux2 .= "</b> ".system_showText(LANG_EACH)." ".$levelObj->getImpressionBlock($value)." ".system_showText(LANG_IMPRESSIONSBLOCK);
			$strArray[] = $strAux;
			$strArray2[] = $strAux2;
		}
	}
	unset($levelObjAux);
	// ---------------------------------------------------------------

	if (string_strpos($_SERVER["HTTP_REFERER"], "members/advertise.php") == true) { ?>
		<input type="hidden" name="from_advertise" value="yes" />
	<? }
?>

<?  // Account Search Javascript /////////////////////////////////////////////////////// ?>

<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>

<?  //////////////////////////////////////////////////////////////////////////////////// ?>

<?  // Banner Javascript /////////////////////////////////////////////////////////////// ?>

<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/banner.js"></script>

<?  //////////////////////////////////////////////////////////////////////////////////// ?>

<script type="text/javascript">

	function toogleTrans(obj) {
		if (obj.checked == true) {
			document.getElementById("trans_form").style.display = 'block';
		} else {
			document.getElementById("trans_form").style.display = 'none';
		}
	}
    
    // ---------------------------------- // 
    
	function emptyDate(obj) {
		if (obj.value == "00/00/0000") {
			return true;
		} else {
			return false;
		}
	}
    
    // ---------------------------------- //

    function showLangFields(type1, type2, type3, type4, type5, num_language, languages) {
        
		var arrLangNumbers = ('<?=EDIR_LANGUAGENUMBERS;?>').split(',');

        for (j=0;j<languages;j++) {
			i = arrLangNumbers[j];
			jQuery('#'+type1+'_'+i).css('display', 'none');
			jQuery('#tab_'+type1+'_'+i).removeClass("tabActived");
			jQuery('#'+type2+'_'+i).css('display', 'none');
			jQuery('#tab_'+type2+'_'+i).removeClass("tabActived");
			jQuery('#'+type3+'_'+i).css('display', 'none');
			jQuery('#tab_'+type3+'_'+i).removeClass("tabActived");
			jQuery('#'+type4+'_'+i).css('display', 'none');
			jQuery('#tab_'+type4+'_'+i).removeClass("tabActived");
			jQuery('#'+type5+'_'+i).css('display', 'none');
			jQuery('#tab_'+type5+'_'+i).removeClass("tabActived");
        }    
		jQuery('#'+type1+'_'+num_language).css('display', '');
		jQuery('#tab_'+type1+'_'+num_language).addClass("tabActived");
		jQuery('#'+type2+'_'+num_language).css('display', '');
		jQuery('#tab_'+type2+'_'+num_language).addClass("tabActived");
		jQuery('#'+type3+'_'+num_language).css('display', '');
		jQuery('#tab_'+type3+'_'+num_language).addClass("tabActived");
		jQuery('#'+type4+'_'+num_language).css('display', '');
		jQuery('#tab_'+type4+'_'+num_language).addClass("tabActived");
		jQuery('#'+type5+'_'+num_language).css('display', '');
		jQuery('#tab_'+type5+'_'+num_language).addClass("tabActived");
    }
</script>

<? 
	echo "<p class=\"informationMessage\">* ".system_showText(LANG_LABEL_REQUIRED_FIELD)." </p>";
	if($message) { ?>
		<p class="successMessage"><?=$message?></p>
	<? } ?>
	<? if($error_message) { ?>
		<p class="errorMessage"><?=$error_message?></p>
	<? } ?>

<? // Account Search ////////////////////////////////////////////////////////////////// ?>
<? if (!$members) { ?>

	<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_LABEL_ACCOUNT)?> <span><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_TOACCOUNT_SPAN)?></span></th>
		</tr>
	</table>

	<?
	$acct_search_table_title = system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECT_DEFAULT);
	$acct_search_field_name = "account_id";
	$acct_search_field_value = $account_id;
	$acct_search_required_mark = false;
	$acct_search_form_width = "95%";
	$acct_search_cell_width = "";
	$return = system_generateAjaxAccountSearch($acct_search_table_title, $acct_search_field_name, $acct_search_field_value, $acct_search_required_mark, $acct_search_form_width, $acct_search_cell_width);
	echo $return;
	?>

<? } ?>

<? //////////////////////////////////////////////////////////////////////////////////// ?>
	<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_BANNER_TYPE);?></th>
		</tr>
		<?if (count($strArray) > 1){?>
		<tr>
			<th colspan="2" class="tableOption"><a href="<?=NON_SECURE_URL?>/advertise.php?banner" target="_blank"><?=system_showText(LANG_BANNER_OPTIONS);?></a></th>
		</tr>
		<?}?>
		<? // ================== TYPE ==========================?>
		<tr>
			<th>* <?=system_showText(LANG_LABEL_TYPE);?>:</th>
			<?
            if(!isset($id) || ($id == null) || ($process == "signup")) {
                ?><td><?=$bannerTypeDropDown?></td><?
            } else {
                ?>
                <td>
                    <?=$levelObj->showLevel($type)." (".$levelObj->getWidth($type)."px x ".$levelObj->getHeight($type)."px)".($levelObj->getStatus($type) == "n"? " (".LANG_BANNER_DISABLED.")": "")?>
                    <input type="hidden" name="type" value="<?=$type?>" />
                </td>
                <?
            }
			?>
		</tr>
	</table>

	<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
		<tr>
			<th colspan="2" class="standard-tabletitle">
				<?=system_showText(LANG_ORDER_BANNER);?>
				<?
				if ($payment_tax_status == "on") {
						echo " (+".$payment_tax_value."% ".$payment_tax_label.")";
					}
				?>
			</th>
		</tr>
		<? 
			if ((sess_isSitemgrLogged() && $sitemgr) && (string_strpos($url_base, "/sitemgr"))) {
			/* SITEMGR SECTION */
		?>
		
			<tr>
				<th>
					<input type="radio" name="expiration_setting" id="expiration_setting" value="<?=BANNER_EXPIRATION_RENEWAL_DATE?>" <?=((!$expiration_setting || $expiration_setting == BANNER_EXPIRATION_RENEWAL_DATE) ? "checked" : "" )?> onclick="bannerDisableImpressions()" class="inputRadio" />
				</th>
				<td>
					<label id="labelRenewal"><?=((!$expiration_setting || $expiration_setting == BANNER_EXPIRATION_RENEWAL_DATE) ? "* " : "" )?></label><?=system_showText(LANG_LABEL_RENEWAL_DATE);?>: <input type="text" name="renewal_date" id="renewal_date" value="<?=$renewal_date?>" <?=(($expiration_setting && $expiration_setting != BANNER_EXPIRATION_RENEWAL_DATE) ? "disabled=true" : "" )?> maxlength="10" style="width:100px" />&nbsp;&nbsp;<span class="warning" style="display: inline;">(<?=format_printDateStandard()?>)</span>
				</td>
			</tr>

			<tr>
				<th>&nbsp;</th>
				<td><? echo implode(" <br /> ", $strArray); ?></td>
			</tr>

		<tr>
			<th><input type="radio" name="expiration_setting" id="expiration_setting" value="<?=BANNER_EXPIRATION_IMPRESSION?>" <?=(($expiration_setting == BANNER_EXPIRATION_IMPRESSION) ? "checked" : "" )?> onclick="bannerDisableRenewalDate()" class="inputRadio" /></th>
			<td>
                <label id="labelImpressions"><?=(($expiration_setting == BANNER_EXPIRATION_IMPRESSION) ? "* " : "" )?></label><?=system_showText(LANG_LABEL_IMPRESSIONS);?>: <input type="text" name="impressions" id="impressions" value="<?=$impressions?>" maxlength="6" <?=((!$expiration_setting || $expiration_setting != BANNER_EXPIRATION_IMPRESSION) ? "disabled=true" : "")?> style="width:100px" />
            </td>
		</tr>

		<tr>
			<th>&nbsp;</th>
			<td><? echo implode(" <br /> ", $strArray2); ?></td>
		</tr>

		<? 
			/* MEMBERS SECTION */
			} elseif ((sess_isAccountLogged()) && (string_strpos($url_base, "/members"))) {
		?>
		<tr>
			<th>
				<input <? if ($process == "signup") { echo "disabled=disabled"; } ?> type="radio" name="expiration_setting" id="expiration_setting" value="<?=BANNER_EXPIRATION_RENEWAL_DATE?>" <?=((!$expiration_setting || $expiration_setting == BANNER_EXPIRATION_RENEWAL_DATE) ? "checked" : "" )?> onclick="bannerDisableImpressions()" class="inputRadio" />
				<? if ($process == "signup") { if (!$expiration_setting || $expiration_setting == BANNER_EXPIRATION_RENEWAL_DATE) { ?> <input type="hidden" name="expiration_setting" value="<?=BANNER_EXPIRATION_RENEWAL_DATE?>" /> <? } } ?>
			</th>
			<td><?=system_showText(LANG_BANNER_BY_TIME_PERIOD)?></td>
		</tr>
		<tr>
			<th>&nbsp;</th>
			<td>
				<? echo implode(" <br /> ", $strArray); ?>
			</td>
		</tr>
		<tr>
			<th>
				<input <? if ($process == "signup") { echo "disabled=disabled"; } ?> type="radio" name="expiration_setting" id="expiration_setting" value="<?=BANNER_EXPIRATION_IMPRESSION?>" <?=(($expiration_setting == BANNER_EXPIRATION_IMPRESSION) ? "checked" : "" )?> onclick="bannerDisableRenewalDate()" class="inputRadio" />
				<? if ($process == "signup") { if ($expiration_setting == BANNER_EXPIRATION_IMPRESSION) { ?> <input type="hidden" name="expiration_setting" value="<?=BANNER_EXPIRATION_IMPRESSION?>" /> <? } } ?>
			</th>
			<td>
				<?=system_showText(LANG_LABEL_IMPRESSIONS)?>: <?=system_showText(LANG_ADD);?> <?=$bannerImpressionDropDown?> <?=system_showText(LANG_IMPRESSIONPAIDOF);?>: <strong><?=(($impressions) ? $impressions : "0")?></strong>.
			</td>
		</tr>

		<tr>
			<th>&nbsp;</th>
			<td><? echo implode(" <br /> ", $strArray2); ?></td>
		</tr>
	<? } ?>

	</table>

	<table cellpadding="0" cellspacing="0" border="0" class="standard-table noMargin">
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_BANNER_DETAIL_PLURAL)?></th>
		</tr>
	</table>

	<table cellpadding="0" cellspacing="0" border="0" class="standard-table noMargin">
        
		<tr>
			<th><?=system_showText(LANG_SECTION);?>:</th><? /* SECTION */ ?>
			<td nowrap>
				<input type="radio" id="section" name="section" value="general" checked="checked"  onclick="fillBannerCategorySelect('<?=DEFAULT_URL?>', this.form.category_id, this.value, this.form, <?=SELECTED_DOMAIN_ID?>, 'banner');" class="inputAlign" style="margin-right:1px; margin-left:10px; margin-bottom:4px;" /> <?=system_showText(LANG_GENERALPAGES);?>
				<input type="radio" id="section" name="section" value="listing" <? if ($section == "listing") echo "checked=\"checked\""; ?> onclick="fillBannerCategorySelect('<?=DEFAULT_URL?>', this.form.category_id, this.value, this.form, <?=SELECTED_DOMAIN_ID?>, 'banner');" class="inputAlign" style="margin-right:1px; margin-left:10px; margin-bottom:4px;" /> <?=system_showText(LANG_LISTING_FEATURE_NAME);?>
				<? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
					<input type="radio" id="section" name="section" value="event" <? if ($section == "event") echo "checked=\"checked\""; ?> onclick="fillBannerCategorySelect('<?=DEFAULT_URL?>', this.form.category_id, this.value, this.form, <?=SELECTED_DOMAIN_ID?>, 'banner');" class="inputAlign" style="margin-right:1px; margin-left:10px; margin-bottom:4px;" /> <?=system_showText(LANG_EVENT_FEATURE_NAME);?>
				<? } ?>
				<? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
					<input type="radio" id="section" name="section" value="classified" <? if ($section == "classified") echo "checked=\"checked\""; ?> onclick="fillBannerCategorySelect('<?=DEFAULT_URL?>', this.form.category_id, this.value, this.form, <?=SELECTED_DOMAIN_ID?>, 'banner');" class="inputAlign" style="margin-right:1px; margin-left:10px; margin-bottom:4px;" /> <?=system_showText(LANG_CLASSIFIED_FEATURE_NAME);?>
				<? } ?>
				<? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
					<input type="radio" id="section" name="section" value="article" <? if ($section == "article") echo "checked=\"checked\""; ?> onclick="fillBannerCategorySelect('<?=DEFAULT_URL?>', this.form.category_id, this.value, this.form, <?=SELECTED_DOMAIN_ID?>, 'banner');" class="inputAlign" style="margin-right:1px; margin-left:10px; margin-bottom:4px;" /> <?=system_showText(LANG_ARTICLE_FEATURE_NAME);?>
				<? } ?>
                <? if ( string_strpos($url_base, "/sitemgr") ) { ?>
                    <input type="radio" id="section" name="section" value="global" <? if ($section == "global") echo "checked=\"checked\""; ?> onclick="fillBannerCategorySelect('<?=DEFAULT_URL?>', this.form.category_id, this.value, this.form, <?=SELECTED_DOMAIN_ID?>, 'banner');" class="inputAlign" style="margin-right:1px; margin-left:10px; margin-bottom:4px;" /> <?=system_showText(LANG_SITEMGR_BANNER_GLOBAL);?>
                <? } ?>
			</td>
		</tr>
		<tr>
			<th><?=system_showText(LANG_LABEL_CATEGORY)?>:</th>
			<td>
				<?=$categoryDropDown?>
			</td>
		</tr>
		<tr>
			<th class="wrap"><?=system_showText(LANG_OPENNEWWINDOW);?>:</th>
			<td>
				<div class="label-form">
					<input type="radio" name="target_window" value="1" <? if ($target_window == "1") echo "checked";?> class="inputAlign" /> <?=system_showText(LANG_NO);?>
					<input type="radio" name="target_window" value="2" <? if (($target_window == "2") || (!$target_window)) echo "checked";?> class="inputAlign" /> <?=system_showText(LANG_YES);?>
				</div>
			</td>
		</tr>
		<tr>
			<th style="vertical-align:top"><?=system_showText(LANG_LABEL_DESTINATION_URL)?>:</th>
			<td>
				<select name="destination_protocol" class="httpSelect">
					<?
					$url_protocols 	= explode(",", URL_PROTOCOL);
					$sufix = "://";
					for ($i=0; $i<count($url_protocols); $i++) {
						$selected = false;
						$protocol = $url_protocols[$i].$sufix;
						if ($destination_protocol) {
							if (trim($protocol) == trim($destination_protocol)) {
								$selected = true;
							}
						}
						?><option value="<?=$protocol?>"  <?=($selected==true  ? "selected=\"selected\"" : "")?> ><?=$protocol?></option><?
					}
					?>
				</select>
				<input style="width:79%" type="text" name="destination_url" value="<?=$destination_url?>" class="input-form-banner" maxlength="500" />
				<span><?=system_showText(LANG_MSG_MAX_500_CHARS)?></span>
			</td>
		</tr>
		<tr>
			<th><?=system_showText(LANG_LABEL_DISPLAY_URL)?>:</th>
			<td><input type="text" name="display_url" value="<?=$display_url?>"class="input-form-banner" maxlength="30" /><span><?=system_showText(LANG_MSG_MAX_30_CHARS)?></span></td>
		</tr>
	</table>

	<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
		<tr>
			<th class="wrap" style="vertical-align:top"><?=system_showText(LANG_SCRIPT_BANNER)?>:</th>
			<td>
                <input type="checkbox" name="show_type" value="1" <?=($show_type=="1") ? "checked" : "";?> class="inputAlign" /><?=system_showText(LANG_SHOWSCRIPTCODE);?>
                <span style="text-align: justify;"><?=system_showText(LANG_SCRIPTCODEHELP);?></span>
                <span style="text-align: justify;"><?=system_showText(LANG_SCRIPTCODEHELP2)?></span>
            </td>
		</tr>
		<tr id="show_type_banner">
			<th style="vertical-align:top"><?=system_showText(LANG_LABEL_SCRIPT)?>:</th>
			<td>
				<textarea rows="4" cols="50" name="script" class="input-form-banner"><?=$script?></textarea> 
				<span></span>
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
				        <li id="tab_caption_<?=$i?>" <?=($k == 0) ? "class=\"tabActived\"" : ""?>><a href="javascript:void(0)" onclick="showLangFields('caption', 'file', 'preview', 'description1', 'description2', '<?=$i?>', '<?=$num_languages?>')"><?=$array_edir_languagenames[$k]?></a></li>
				    <? } ?>
                </ul>
            </td>
        </tr>
        
	</table>
	
	<div id="banner_with_images">
		<table cellpadding="0" cellspacing="0" border="0" class="standard-table noMargin">
			<?
			$array_edir_languages = explode(",", EDIR_LANGUAGES);
			foreach ($language_numbers as $k=>$i) {
				$labelsuffix = $i;
			?>
			<tr id="caption_<?=$i?>" <?=($k == 0) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?>>
				<th style="vertical-align:top"><? if (!$k) echo "*"; ?> <?=system_showText(LANG_LABEL_CAPTION)?><?=((count(explode(",", EDIR_LANGUAGES))>1)?(" (".$array_edir_languagenames[$k]."):"):(":"));?></th>
				<td>
					<input type="text" name="caption<?=$labelsuffix;?>" value="<?=${"caption".$labelsuffix}?>" class="input-form-banner" maxlength="25" /><span><?=system_showText(LANG_MSG_MAX_25_CHARS)?></span>
				</td>
			</tr>

			<tr id="file_<?=$i?>" <?=($k == 0) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
				<th style="vertical-align:top"><? if (!$k) echo "*"; ?> <?=system_showText(LANG_LABEL_FILE)?><?=((count(explode(",", EDIR_LANGUAGES))>1)?(" (".$array_edir_languagenames[$k]."):"):(":"));?></th>
				<td>
					<input type="file" name="file<?=$labelsuffix;?>" class="input-form-banner" size="60" />
					<span><?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=BANNER_UPLOAD_MAX_SIZE;?> KB.</span>
					<span><?=system_showText(LANG_MSG_ALLOWED_FILE_TYPES)?>: SWF, GIF, JPEG, PNG</span>
					<span><strong><?=system_showText(LANG_LABEL_WARNING)?>:</strong></span>
					<span><?=system_showText(LANG_BANNERFILEHELP);?></span>
				</td>
			</tr>
			<? if (${"image_id".$labelsuffix} > 0 && $id) { ?>
				<tr id="preview_<?=$i?>" <?=($k == 0) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
					<td colspan="2" class="standard-tableContent" style="text-align: center; display:table-cell;">
						<a href="<?=$url_base?>/<?=BANNER_FEATURE_FOLDER;?>/preview.php?id=<?=$id?>&lang=<?=$array_edir_languages[$k]?>" class="standardLINK iframe fancy_window_preview_banner"><?=system_showText(LANG_MSG_CLICK_TO_PREVIEW_THIS_BANNER);?></a>
					</td>
				</tr>
			<? } ?>
		<? }?>
	</table>
    </div>

	<div id="banner_with_text">
		
        <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
			<?
			foreach ($language_numbers as $k=>$i) {
				$labelsuffix = $i;
			?>
			<tr id="caption_<?=$i?>" <?=($k == 0) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?>>
				<th style="vertical-align:top"><? if (!$k) echo "*"; ?> <?=system_showText(LANG_LABEL_CAPTION)?><?=((count(explode(",", EDIR_LANGUAGES))>1)?(" (".$array_edir_languagenames[$k]."):"):(":"));?></th>
				<td>
					<input type="text" name="caption<?=$labelsuffix;?>" value="<?=${"caption".$labelsuffix}?>" class="input-form-banner" maxlength="25" /><span><?=system_showText(LANG_MSG_MAX_25_CHARS)?></span>
				</td>
			</tr>

			<tr id="description1_<?=$i?>" <?=($k == 0) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
				<th><? if (!$k) echo "*"; ?> <?=system_showText(LANG_LABEL_DESCRIPTION_LINE1)?><?=((count(explode(",", EDIR_LANGUAGES))>1)?(" (".$array_edir_languagenames[$k]."):"):(":"));?></th>
				<td>
					<input type="text" name="content_line1<?=$labelsuffix;?>" value="<?=${"content_line1".$labelsuffix}?>" class="input-form-banner" maxlength="30" /><span><?=system_showText(LANG_MSG_MAX_30_CHARS)?></span>
				</td>
			</tr>
			<tr id="description2_<?=$i?>" <?=($k == 0) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
				<th><? if (!$k) echo "*"; ?> <?=system_showText(LANG_LABEL_DESCRIPTION_LINE2)?><?=((count(explode(",", EDIR_LANGUAGES))>1)?(" (".$array_edir_languagenames[$k]."):"):(":"));?></th>
				<td><input type="text" name="content_line2<?=$labelsuffix;?>" value="<?=${"content_line2".$labelsuffix}?>" class="input-form-banner" maxlength="30" /><span><?=system_showText(LANG_MSG_MAX_30_CHARS)?></span></td>
			</tr>
			<? } ?>
		</table>
	</div>
	
	</div>

<? if (PAYMENT_FEATURE == "on") { ?>
	<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
		<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
			<tr>
				<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
			</tr>
			<? if (
					(
						(!$thisBannerObject) ||
						(($expiration_setting == BANNER_EXPIRATION_IMPRESSION) && ($impressions <= 0)) ||
						(($expiration_setting == BANNER_EXPIRATION_RENEWAL_DATE) && ($thisBannerObject) && ($thisBannerObject->needToCheckOut())) ||
						($url_base == DEFAULT_URL."/sitemgr") ||
						(($thisBannerObject) && ($thisBannerObject->getPrice() <= 0))
					)
					&&
					($process != "signup")
				) {
			?>
				<tr>
					<th><?=system_showText(LANG_LABEL_CODE)?>:</th>
					<td><input type="text" name="discount_id" value="<?=$discount_id?>" maxlength="10" /></td>
				</tr>
			<? } else { ?>
				<tr>
					<th><?=system_showText(LANG_LABEL_CODE)?>:</th>
					<td><?=(($discount_id) ? $discount_id : system_showText(LANG_NA) )?></td>
				</tr>
			<? } ?>
		</table>
	<? } ?>
<? } ?>

<script type="text/javascript">
	var banner_tmp_form_images_content = document.getElementById("banner_with_images").innerHTML;
	var banner_tmp_form_text_content = document.getElementById("banner_with_text").innerHTML;
</script>
<script type="text/javascript">
	<?
	if ($type < 50)       echo "bannerDisableTextForm();";
	else if ($type >= 50) echo "bannerDisableImagesForm();";
    if ($forceTextForm) echo "bannerDisableImagesForm();";
	?>
</script> 
    
