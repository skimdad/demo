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
    # * FILE: /includes/forms/form_tax.php
    # ----------------------------------------------------------------------------------------------------
?>
	<div class="header-form">
        <?=string_ucwords(system_showText(LANG_SITEMGR_OPTIONS))?>
    </div>
<? /*
    <div class="tip-base">
		<p style="text-align: justify;">
			<a href="<?=DEFAULT_URL?>/sitemgr/faq/faq.php?keyword=tax" target="_blank"><?=system_showText(LANG_SITEMGR_TAX_FAQ_LINK)?></a>
		</p>
	</div>
*/ ?>
	<p class="informationMessage">* <?=system_showText(LANG_LABEL_REQUIRED_FIELD);?></p>

    <? if ($message) { ?>
		<p class="<?=$messageStyle;?>">
			<?=$message?>
		</p>
	<? } ?>
    
	<br />

    <table cellpadding="2" cellspacing="0" border="0" class="table-form">
		<tr class="tr-form">
			<td align="right" class="td-form">
				<input type="checkbox" name="payment_tax_status" value="on" class="inputCheck" <?=$payment_tax_status == "on"? "checked": "";?>/>
			</td>
			<td align="left" class="td-form" style="padding-bottom:20px;">
				<div class="label-form">
					<?=system_showText(LANG_SITEMGR_SETTINGS_ENABLE_TAX)?>
				</div>
			</td>
		</tr>
		<tr class="tr-form">
			<td align="right" class="td-form" style="padding-bottom:20px;">
				<div class="label-form">
					<?=system_showText(LANG_SITEMGR_LANGUAGE)?>:
				</div>
			</td>
			<td align="left" class="td-form">
				<select name="language_label" style="width: 100px;" onchange="changeLanguageForm(this.value);">
					<? for ($i = 0; $i < count($languages); $i++) { ?>
						<? if ($languages[$i] == $language_label) { ?>
							<option value="<?=$languages[$i];?>" selected><?=$languagenames[$i];?></option>
						<? } else { ?>
							<option value="<?=$languages[$i];?>"><?=$languagenames[$i];?></option>
						<? } ?>
					<? } ?>
				</select>
			</td>
		</tr>
		<? for ($i = 0; $i < count($languages); $i++) { ?>
			<? if ($languages[$i] == $language_label) {
				$display = "";
			} else {
				$display = "style=\"display: none\"";
			} ?>
			<tr id="tax_label_<?=$languages[$i];?>" class="tr-form" <?=$display;?>>
				<td align="right" class="td-form" style="padding-bottom:20px;">
					<div class="label-form">
						<?=($languages[$i] == $edir_default_language? "* ": " ").system_showText(LANG_SITEMGR_SETTINGS_TAX_LABEL);?>:
					</div>
				</td>
				<td align="left" class="td-form">
					<input type="text" name="payment_tax_label_<?=$languages[$i];?>" value="<?=${"payment_tax_label_".$languages[$i]};?>" style="width: 100px;"/>
					<span><?=system_showText(LANG_SITEMGR_SETTINGS_TAX_EG)?></span>
				</td>
			</tr>
		<? } ?>
		<tr class="tr-form">
			<td align="right" class="td-form" style="padding-bottom:20px;">
				<div class="label-form">
					<?="* ".system_showText(LANG_SITEMGR_SETTINGS_TAX_VALUE)?>:
				</div>
			</td>
			<td align="left" class="td-form">
				<input type="text" name="payment_tax_value" value="<?=$payment_tax_value;?>" style="width: 40px;"/> %
			</td>
		</tr>
    </table>
	<table style="margin: 0 auto 0 auto;">
		<tr>
			<td>
				<button type="submit" name="tax_submit" value="Submit" class="input-button-form" ><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
			</td>
		</tr>
	</table>