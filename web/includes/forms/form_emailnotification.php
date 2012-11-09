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
	# * FILE: /includes/forms/form_emailnotification.php
	# ----------------------------------------------------------------------------------------------------

?>

<script type="text/javascript">
	function confirmSubmit(pId, pForm) {
		$("input[name='hiddenValue']").attr('value', pId);
		document.getElementById(pForm).submit();
	}

	function confirm(pText, pId, pForm) {
		var valYes = '<?=system_showText(LANG_SITEMGR_YES)?>';
		var valNo = '<?=system_showText(LANG_SITEMGR_NO)?>';
        $.fancybox(
            "<p id=\"confirmMessage\" class=\"informationMessage\">"+pText+"</p>\n\
             <p class=\"baseForm\" id=\"confirmButtons\">\n\
                <input type=\"submit\" onclick=\"confirmSubmit('" + pId + "', '" + pForm + "');\" value=\"" + valYes + "\" class=\"input-button-form button-space\" />\n\
                <input type=\"button\" value=\"" + valNo + "\" onclick=\"parent.$.fancybox.close();\" class=\"input-button-form button-space\" />\n\
            </p>",
            {
                'autoDimensions'	: false,
                'width'         	: 350,
                'height'        	: 160
            }
        );
	}
</script>

<? if($message){ ?>
	<div class="<?=$message_style?>">
		<?=$message?>
	</div>
<? } ?>

<table width="500" cellpadding="2" cellspacing="0" border="0" class="table-form">
	
	<? if ($emailNotificationObj->getNumber("id") == 36){ ?>
	
		<tr class="tr-form">
			<td align="right" class="td-form">
				<div class="label-form">
					<?=system_showText(LANG_SITEMGR_SEND_LISTINGLEVELS)?>:
				</div>
			</td>
			<td align="left" class="td-form">
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<? foreach ($levelValue as $value) { ?>
							<td style="width:20px;"><input type="checkbox" name="email_traffic_listing_<?=$value?>" value="on" <?=((${"email_traffic_listing_".$value} == "on") ? "checked": "")?> style="width: auto; border: 0;" class="inputCheck" /></td>
							<td  style="width:40px;"><?=$listingLevelObj->showLevel($value)?></td>
						<? } ?>
					</tr>
				</table>

			</td>
		</tr>
	
	<? } ?>
	
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LANGUAGE)?>:</th>
		<td>
		<?=language_writeComboLang('clang', $clang, 'changeComboLang (this.value)')?>
		</td>
	</tr>
	
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_CONTENTTYPE)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<?
			$disable_str  = "";
			$disable_name = "";
			if ($lang != EDIR_DEFAULT_LANGUAGE) {
				$disable_str = "disabled=\"disabled\"";
				$disable_name = "_disabled";
				echo "<input type=\"hidden\" name=\"content_type\" value=\"".$content_type."\">\n";
			}
			?>
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:20px;"><input <?=$disable_str?> type="radio" name="content_type<?=$disable_name?>" value="text/plain" <?=(($content_type == "text/plain") ? "checked": "")?> style="width: auto; border: 0;" class="inputCheck" /></td>
					<td  style="width:40px;"><?=system_showText(LANG_SITEMGR_LABEL_TEXT)?></td>
					<td style="width:20px;"><input <?=$disable_str?> type="radio" name="content_type<?=$disable_name?>" value="text/html" <?=(($content_type == "text/html") ? "checked": "")?> style="width: auto; border: 0;" /></td>
					<td><?=system_showText(LANG_SITEMGR_LABEL_HTML)?></td>
				</tr>
			</table>
			
		</td>
	</tr>
	
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_BCC)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="bcc" maxlength="255" size="35" value="<?=$bcc?>" <? if ($lang != EDIR_DEFAULT_LANGUAGE && $message_style != "errorMessage") { ?>readonly="readonly" class="inputReadOnly"<? } ?> />
		</td>
	</tr>	
	
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_SUBJECT)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="subject" maxlength="255" size="35" value="<?=$subject?>" /> <a href="help.php?id=<?=$id?>" style="cursor:pointer; color:#000000" class="iframe fancy_window"><span style="font:11px Arial"><?=system_showText(LANG_SITEMGR_EMAILNOTIFICATION_CLICKHERETOUSEVARS)?></span></a>
		</td>
	</tr>
	
	<?
	if ($lang == EDIR_DEFAULT_LANGUAGE) {
	?>
	<tr>
		<td align="center" class="label-form" colspan="2">
			<?=system_showText(LANG_SITEMGR_LABEL_RESTOREDEFAULTMESSAGE)?>:
			<input type="button" name="reset_html" id="reset_html" value="<?=system_showText(LANG_SITEMGR_LABEL_HTML)?>" onclick="confirm('<?=system_showText(LANG_SITEMGR_EMAILNOTIFICATION_OVERWRITEDEFAULTQUESTION)?>',this.id,this.form.name)" class="input-button-form2 button-space" />
			<input type="button" name="reset_text" id="reset_text" value="<?=system_showText(LANG_SITEMGR_LABEL_TEXT)?>" onclick="confirm('<?=system_showText(LANG_SITEMGR_EMAILNOTIFICATION_OVERWRITEDEFAULTQUESTION)?>',this.id,this.form.name)" class="input-button-form2 button-space" />
			<input type="hidden" name="hiddenValue">
		</td>
	</tr>
	<? } ?>
	
	<tr class="tr-form">
		<td align="right" class="td-form" valign="top">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_BODY)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<textarea name="body" style="height:200px; width:400px;"><?=$body?></textarea>
		</td>
	</tr>
</table>