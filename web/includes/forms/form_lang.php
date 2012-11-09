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
	# * FILE: /includes/forms/form_lang.php
	# ----------------------------------------------------------------------------------------------------
?>
<script type="text/javascript">

    function defaultClick() {
        if ($('#lang_default').attr('checked') == '') {
            $('#lang_order').attr('disabled', '');
        } else {
            $('#lang_order').attr('disabled', 'disabled');
        }
    }

</script>

	<div class="header-form">
		<?=string_ucwords(system_showText(LANG_SITEMGR_LANGCENTER_LANGUAGEINFORMATION))?>
	</div>

	<br />
	
	<table cellpadding="2" cellspacing="0" border="0" class="table-form">
    <tr class="tr-form">
        <td align="right" class="td-form">
	    <input type="checkbox" class="inputCheck" name="lang_default" id="lang_default" value="y" <? if ($lang_default == 'y') { echo "checked=\"checked\""; } ?> onclick="defaultClick();"/>&nbsp;&nbsp;<?=system_showText(LANG_SITEMGR_DEFAULT)?>
        </td>
    </tr>
    <tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
			<div class="label-form"><br />
				<?=system_showText(LANG_SITEMGR_LABEL_CODE)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="id" maxlength="5" value="<?=$id?>" style="width:50px" <? if ($id) echo "readonly=\"readonly\" class=\"inputReadOnly\""; else echo "class=\"input-form-adminemail\""; ?> />
		</td>
	</tr>
	
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_NAME)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="name" value="<?=$name?>" style="width:200px" />
		</td>
	</tr>
	
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_ORDER)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<select name="lang_order" id="lang_order" class="input-form-adminemail" style="width:50px"<?=($lang_default == 'y') ? "disabled=\"disabled\" ><option value></option>" : ''?>>
			<?
			$i=0;
            $enabled_langs = count($lang->getAll());
			for ($i=1; $i<$enabled_langs; $i++) {
				$selected = "";
				if ($lang_order == $i) {
					$selected = "selected=\"selected\"";
				}
				echo "<option value=\"$i\" $selected>$i</option>\n";
			}
			?>
			</select>
		</td>
	</tr>
    
    <tr class="tr-form">
        <td align="right" class="td-form">&nbsp;</td>
        <td align="left" class="td-form" nowrap="nowrap">
            <input type="hidden" name="current_order" value="<?=(!$lang->getString('lang_order') ? '' : $lang->getString('lang_order'))?>" />
            <input type="hidden" name="_lang_enabled" value="<?=(!$lang->getString('lang_enabled') ? 'n' : $lang->getString('lang_enabled'))?>" />
            <input type="checkbox" class="inputCheck" name="lang_enabled" id="lang_enabled" value="y" <? if ($lang_enabled == 'y') { echo "checked"; } ?> />&nbsp;&nbsp;<?=system_showText(LANG_SITEMGR_LABEL_ENABLED)?>
            &nbsp;&nbsp;&nbsp;
        </td>
    </tr>
	
	</table>
	
	<br />