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
	# * FILE: /includes/forms/form_invoiceinfo.php
	# ----------------------------------------------------------------------------------------------------

?>
<script language="javascript" type="text/javascript">

	$(document).ready(function(){
		
		var field_name = 'invoice_notes';
		var count_field_name = 'invoice_notes';

		var options = {
					'maxCharacterSize': 250,
					'originalStyle': 'originalTextareaInfo',
					'warningStyle' : 'warningTextareaInfo',
					'warningNumber': 40,
					'displayFormat' : '<span><input readonly="readonly" type="text" id="'+count_field_name+'" name="'+count_field_name+'" size="3" maxlength="3" value="#left" class="textcounter" disabled="disabled" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>' 
			};
		$('#'+field_name).textareaCount(options);

		
	});

</script>
<div class="header-form">
	<?=system_showText(LANG_SITEMGR_INVOICE_INVOICEINFO_DIRECTORYACCOUNTINFORMATION)?>
</div>

<? if ($message_invoiceinfo) { ?>
	<?=$message_invoiceinfo?>
<? } ?>

<table cellpadding="2" cellspacing="0" border="0" class="table-form">

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_COMPANYNAME)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="invoice_company" value="<?=$invoice_company?>" class="input-form-adminemail" />
		</td>
	</tr>

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_ADDRESS)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="invoice_address" value="<?=$invoice_address?>" class="input-form-adminemail" />
		</td>
	</tr>

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_CITY)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="invoice_city" value="<?=$invoice_city?>" class="input-form-adminemail" />
		</td>
	</tr>

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_LABEL_SELECT_STATE)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="invoice_state" value="<?=$invoice_state?>" class="input-form-adminemail" />
		</td>
	</tr>

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form"><?=system_showText(LANG_SITEMGR_LABEL_COUNTRY)?>:</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="invoice_country" value="<?=$invoice_country?>" class="input-form-adminemail" />
		</td>
	</tr>

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=string_ucwords(ZIPCODE_LABEL)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="invoice_zipcode" value="<?=$invoice_zipcode?>" class="input-form-adminemail" />
		</td>
	</tr>

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_PHONE)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="invoice_phone" value="<?=$invoice_phone?>" class="input-form-adminemail" />
		</td>
	</tr>

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_FAX)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="invoice_fax" value="<?=$invoice_fax?>" class="input-form-adminemail" />
		</td>
	</tr>

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="invoice_email" value="<?=$invoice_email?>" class="input-form-adminemail" />
		</td>
	</tr>
	
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_NOTES)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<textarea id="invoice_notes" name="invoice_notes" rows="5" cols="1" ><?=$invoice_notes?></textarea>
			<div id="textAreaCallback"></div>
		</td>
	</tr>
	
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_PAYABLETO)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="invoice_payableto" value="<?=$invoice_payableto?>" class="input-form-adminemail" maxlength="80" />
		</td>
	</tr>

	<?include(EDIRECTORY_ROOT."/includes/code/thumbnail.php");?>
	
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_INVOICELOGO)?> <span style="font-size: 9px;">(<?=IMAGE_INVOICE_LOGO_WIDTH?>px x <?=IMAGE_INVOICE_LOGO_HEIGHT?>px):</span><br /><br />
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="file" name="image" id="image" class="input-form-adminemail" onchange="UploadImage('invoiceinfo'); $('#remove_image').attr('disabled','disabled').attr('checked','');" /><br /><span style="font-family: Verdana; font-size: 10px; color: #6A6A6A;"><?=system_showText(LANG_SITEMGR_MSGMAXFILESIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED);?></span>
			<input type="hidden" name="invoice_image" value="<?=$invoice_image?>" />
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

	<? if ($invoice_image) { ?>
		<tr class="imageSpace">
			<td colspan="2">
				<?
				$imageObj = new Image($invoice_image);
				if ($imageObj->imageExists()) {
					echo $imageObj->getTag(true, IMAGE_INVOICE_LOGO_WIDTH, IMAGE_INVOICE_LOGO_HEIGHT, system_showText(LANG_SITEMGR_LABEL_INVOICELOGO));
				}
				?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<center><input type="checkbox" name="remove_image" id="remove_image" value="1" style="width: auto;" class="inputCheck" /><?=system_showText(LANG_SITEMGR_CHECKTOREMOVEIMAGE)?></center>
			</td>
		</tr>
	<? } ?>

</table>
