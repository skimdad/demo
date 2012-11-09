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
	# * FILE: /includes/forms/form_themetemplate.php
	# ----------------------------------------------------------------------------------------------------

?>

<br />

<? if ($message_listingtemplate) {?>
	<br /><br /><p class="errorMessage"><?=$message_listingtemplate?></p>
<? } ?>

<script language="javascript" type="text/javascript">
	
    function JS_submit() {
		document.listingtemplate.submit();
	}
</script>

<div class="tip-base">
    <p style="text-align: justify; font-size: 13px;"><b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TIPS_INTRO)?></b></p><br />
    <p style="text-align: left; font-size: 12px;"><b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_FIELD)?>: </b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TIPS_FIELD)?></p><br />
    <p style="text-align: left; font-size: 12px;"><b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LABEL)?>: </b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TIPS_LABEL)?></p><br />
    <p style="text-align: left; font-size: 12px;"><b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TOOLTIP)?>: </b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TIPS_TOOLTIP)?></p><br />
    <p style="text-align: left; font-size: 12px;"><b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_REQUIRED)?>: </b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TIPS_REQUIRED)?></p><br />
    <p style="text-align: left; font-size: 12px;"><b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCH)?>: </b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TIPS_SEARCH)?></p><br />
    <p style="text-align: left; font-size: 12px;"><b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCHBYKEYWORD)?>: </b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TIPS_SEARCHBYKEYWORD)?></p><br />
    <p style="text-align: left; font-size: 12px;"><b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCHBYRANGE)?>: </b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TIPS_SEARCHBYRANGE)?></p><br />
    <p style="text-align: left; font-size: 12px;"><b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_VALUES)?>: </b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TIPS_VALUES)?></p>
</div>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">
    
    <tr>
		<th colspan="4" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_COMMONFIELDS)?></th>
	</tr>
    
	<tr>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_FIELD)?>
		</th>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LABEL)?>
		</th>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TOOLTIP)?>
		</th>
	</tr>

	<tr>
		<td class="extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LISTINGTITLE)?>
		</td>
		<td>
			<input type="text" name="label[title]" value="<?=$label["title"]?>" class="commonFieldExplode" />
		</td>
		<td>
			<input type="text" name="instructions[title]" value="<?=$instructions["title"]?>" class="commonFieldExplode" />
		</td>
	</tr>

	<tr>
		<td class="extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_ADDRESSLINE1)?>
		</td>
		<td>
			<input type="text" name="label[address]" value="<?=$label["address"]?>" class="commonFieldExplode" />
		</td>
		<td>
			<input type="text" name="instructions[address]" value="<?=$instructions["address"]?>" class="commonFieldExplode" />
		</td>
	</tr>

	<tr>
		<td class="extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_ADDRESSLINE2)?>
		</td>
		<td>
			<input type="text" name="label[address2]" value="<?=$label["address2"]?>" class="commonFieldExplode" />
		</td>
		<td>
			<input type="text" name="instructions[address2]" value="<?=$instructions["address2"]?>" class="commonFieldExplode" />
		</td>
	</tr>

</table>


<?
$count_customcheckbox = 7;
$count_customdropdown = 3;
$count_customtext = 4;
?>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="3" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EXTRACHECKBOXFIELDS)?></th>
	</tr>

	<tr>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LABEL)?>
		</th>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TOOLTIP)?>
		</th>
		<th class="extraFieldsLabel extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCH)?>
		</th>
        <th class="extraFieldsLabel extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LABEL_ENABLED)?>
		</th>
	</tr>

	<? for ($i=0; $i<$count_customcheckbox; $i++) { ?>
		<tr>
            <td class="extraFieldsShort">
                <?=@constant($label["custom_checkbox$i"])?>
                <input type="hidden" name="label[custom_checkbox<?=$i?>]" value="<?=$label["custom_checkbox$i"]?>" />
            </td>
			<td class="center">
				<input type="text" name="instructions[custom_checkbox<?=$i?>]" value="<?=$instructions["custom_checkbox$i"]?>" class="extraCheckboxExplode" />
			</td>
			<td class="alignCenter extraFieldsShort">
				<input type="checkbox" name="search[custom_checkbox<?=$i?>]" value="y" <?=($search["custom_checkbox$i"]=="y") ? "checked" : ""?> class="inputRadio" />
			</td>
            <td class="alignCenter extraFieldsShort">
				<input type="checkbox" name="enabled[custom_checkbox<?=$i?>]" value="y" <?=($enabled["custom_checkbox$i"]=="y") ? "checked" : ""?> class="inputRadio" />
			</td>
		</tr>
		<?
	}
	?>
	
</table>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="5" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EXTRADROPDOWNFIELDS)?></th>
	</tr>

	<tr>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LABEL)?>
		</th>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_VALUES)?>
		</th>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TOOLTIP)?>
		</th>
		<th class="extraFieldsLabel extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_REQUIRED)?>
		</th>
		<th class="extraFieldsLabel extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCH)?>
		</th>
        <th class="extraFieldsLabel extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LABEL_ENABLED)?>
		</th>
	</tr>

	<? for ($i=0; $i<$count_customdropdown; $i++) { ?>
		<tr>
            <td class="extraFieldsShort">
                <?=@constant($label["custom_dropdown$i"])?>
                <input type="hidden" name="label[custom_dropdown<?=$i?>]" value="<?=$label["custom_dropdown$i"]?>" />
            </td>
			<td>
				<textarea name="fieldvalues[custom_dropdown<?=$i?>]" style="width: 160px;"><?=$fieldvalues["custom_dropdown$i"]?></textarea>
			</td>
			<td>
				<input type="text" name="instructions[custom_dropdown<?=$i?>]" value="<?=$instructions["custom_dropdown$i"]?>" class="extraFieldExplode" style="width: 160px;" />
			</td>
			<td class="alignCenter extraFieldsShort">
				<input type="checkbox" name="required[custom_dropdown<?=$i?>]" value="y" <?=($required["custom_dropdown$i"]=="y") ? "checked" : ""?> class="inputRadio" />
			</td>
			<td class="alignCenter extraFieldsShort">
				<input type="checkbox" name="search[custom_dropdown<?=$i?>]" value="y" <?=($search["custom_dropdown$i"]=="y") ? "checked" : ""?> class="inputRadio" />
			</td>
            <td class="alignCenter extraFieldsShort">
				<input type="checkbox" name="enabled[custom_dropdown<?=$i?>]" value="y" <?=($enabled["custom_dropdown$i"]=="y") ? "checked" : ""?> class="inputRadio" />
			</td>
		</tr>
		<?
	}
	?>

</table>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="5" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EXTRATEXTFIELDS)?></th>
	</tr>

	<tr>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LABEL)?>
		</th>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TOOLTIP)?>
		</th>
		<th class="extraFieldsLabel extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_REQUIRED)?>
		</th>
		<th class="extraFieldsLabel extraFieldsShort wrap">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCHBYKEYWORD)?>
		</th>
		<th class="extraFieldsLabel extraFieldsShort wrap">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCHBYRANGE)?>
		</th>
        <th class="extraFieldsLabel extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LABEL_ENABLED)?>
		</th>
	</tr>

	<? for ($i=0; $i<$count_customtext; $i++) { ?>
		<tr >
            <td class="extraFieldsShort">
                <?=@constant($label["custom_text$i"])?>
                <input type="hidden" name="label[custom_text<?=$i?>]" value="<?=$label["custom_text$i"]?>" />
            </td>
			<td>
				<input type="text" name="instructions[custom_text<?=$i?>]" value="<?=$instructions["custom_text$i"]?>" class="extraFieldExplode" />
			</td>
			<td class="alignCenter extraFieldsShort">
				<input type="checkbox" name="required[custom_text<?=$i?>]" value="y" <?=($required["custom_text$i"]=="y") ? "checked" : ""?> class="inputRadio" />
			</td>
			<td class="alignCenter extraFieldsShort">
				<input type="checkbox" name="searchbykeyword[custom_text<?=$i?>]" value="y" <?=($searchbykeyword["custom_text$i"]=="y") ? "checked" : ""?> class="inputRadio" />
			</td>
			<td class="alignCenter extraFieldsShort">
				<input type="checkbox" name="searchbyrange[custom_text<?=$i?>]" value="y" <?=($searchbyrange["custom_text$i"]=="y") ? "checked" : ""?> class="inputRadio" />
			</td>
            <td class="alignCenter extraFieldsShort">
				<input type="checkbox" name="enabled[custom_text<?=$i?>]" value="y" <?=($enabled["custom_text$i"]=="y") ? "checked" : ""?> class="inputRadio" />
			</td>
		</tr>
		<?
	}
	?>

</table>