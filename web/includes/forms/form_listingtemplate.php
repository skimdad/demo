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
	# * FILE: /includes/forms/form_listingtemplate.php
	# ----------------------------------------------------------------------------------------------------

?>

<br />

<? if ($message_listingtemplate) {?>
	<br /><br /><p class="errorMessage"><?=$message_listingtemplate?></p>
<? } ?>

<a href="#" id="info_window" class="iframe fancy_window_categPath" style="display:none"></a> 

<script language="javascript" type="text/javascript">
	
	function JS_addCategory(text, id) {
			
		seed = document.listingtemplate.seed;
		feed = document.listingtemplate.feed;

		var flag=true;
		for (i=0;i<feed.length;i++)
			if (feed.options[i].value==id)
				flag=false;
		
		if(text && id && flag){
			feed.options[feed.length] = new Option(text, id);
			$('#categoryAdd'+id).after("<span class=\"categorySuccessMessage\"><?=system_showText(LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED)?></span>").css('display', 'none');
			$('.categorySuccessMessage').fadeOut(5000);
		} else {
			if (!flag) $('#categoryAdd'+id).after("</a> <span class=\"categoryErrorMessage\"><?=system_showText(LANG_MSG_CATEGORY_ALREADY_INSERTED)?></span> </li>");  
			else ('#categoryAdd'+id).after("</a> <span class=\"categoryErrorMessage\"><?=system_showText(LANG_MSG_SELECT_VALID_CATEGORY)?></span> </li>"); 
		}

	}

	// ---------------------------------- //
	
	function JS_submit(preview) {
		if (preview == 1){
			$("#preview").attr('value','1');
		}
		feed = document.listingtemplate.feed;
		return_categories = document.listingtemplate.return_categories;
		if (return_categories.value.length > 0) return_categories.value="";
		for (i=0;i<feed.length;i++) {
			if (!isNaN(feed.options[i].value)) {
				if (return_categories.value.length > 0) return_categories.value = return_categories.value + "," + feed.options[i].value;
				else return_categories.value = return_categories.value + feed.options[i].value;
			}
		}
		document.listingtemplate.submit();
	}
</script>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="2" class="standard-tabletitle"><?=string_ucwords(system_showText(LANG_SITEMGR_LISTINGTEMPLATE))?> - <?=system_showText(LANG_SITEMGR_INFORMATION)?></th>
	</tr>

	<tr>
		<th><?=system_showText(LANG_SITEMGR_TITLE)?>:</th>
		<td>
			<input type="text" name="title" value="<?=$title?>" maxlength="100" onblur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" />
		</td>
	</tr>

	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_PAGENAME)?>:</th>
		<td>
			<input type="text" name="friendly_url" id="friendly_url" value="<?=$friendly_url?>" maxlength="150" onblur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" />
		</td>
	</tr>

	<tr>
		<th><?=system_showText(LANG_SITEMGR_STATUS)?>:</th>
		<td>
			<table class="table-status">
				<tr>
					<td class="td-checkbox"><input type="radio" name="status" value="enabled" <? if ((!$status) || ($status == "enabled")) echo "checked"; ?> class="inputCheck" /></td>
					<td><?=system_showText(LANG_SITEMGR_LABEL_ENABLED)?></td>
					<td class="td-checkbox"><input type="radio" name="status" value="disabled" <? if ($status == "disabled") echo "checked"; ?> class="inputCheck" /></td>
					<td><?=system_showText(LANG_SITEMGR_LABEL_DISABLED)?></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<th><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_ADDITIONALPRICE)?>:</th>
		<td>
			<input type="text" name="price" value="<?=$price?>" />
		</td>
	</tr>

</table>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="3" class="standard-tabletitle">
			<?=string_ucwords(system_showText(LANG_SITEMGR_LISTINGTEMPLATE))?> - <?=string_ucwords(system_showText(LANG_SITEMGR_LISTINGTEMPLATE_DETAILLAYOUT))?>
			<span>
				<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_DETAILLAYOUT_TIP);?>
			</span>
		</th>
	</tr>

	<?
	$templateLayoutIDs = explode(",", TEMPLATE_LAYOUTIDS);
//	$templateLayoutNames = explode(",", TEMPLATE_LAYOUTNAMES);
	$templateLayoutSamples = explode(",", TEMPLATE_LAYOUTSAMPLES);
	for ($i=0; $i<count($templateLayoutIDs); $i++) {
	?>
		<tr>
			<td style="text-align: right; width: 30px;"><input type="radio" name="layout_id" value="<?=$templateLayoutIDs[$i];?>" class="inputRadio" <? if (($templateLayoutIDs[$i] == $layout_id) || (!$i && !$layout_id)) { echo "checked"; } ?> /></td>
			<td style="width: 150px;"><img src="<?=DEFAULT_URL;?>/images/content/<?=$templateLayoutSamples[$i];?>" /></td>
			<td style="text-align: left;">&nbsp;</td>
		</tr>
	<?
	}
	?>

</table>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="4" class="standard-tabletitle wrap"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SELECTCATEGORIES)?>&nbsp;<span>(<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_CATEGORYTIP)?>)</span></th>
	</tr>

	<input type="hidden" name="return_categories" value="">
	<tr>
		<td colspan="2" class="treeView">
			<ul id="listing_categorytree_id_0" class="categoryTreeview">&nbsp;</ul>
			<table width="100%" border="0" cellpadding="2" class="tableCategoriesADDED" cellspacing="0">
				<tr>
					<th colspan="2" class="tableCategoriesTITLE alignLeft"><strong><?=ucfirst(system_showText(LANG_SITEMGR_CATEGORIES))?>:</strong></th>
				</tr>
				<tr>
					<td colspan="2" class="tableCategoriesCONTENT"><?=$feedDropDown?></td>
				</tr>
				<tr>
					<td class="tableCategoriesBUTTONS" colspan="2">
						<center>
							<button class="input-button-form" type="button" value="<?=system_showText(LANG_BUTTON_VIEWCATEGORYPATH)?>" onclick="JS_displayCategoryPath(document.listingtemplate.feed, '<?=system_showText(LANG_MSG_SELECT_CATEGORY_FIRST)?>', '../<?=LISTING_FEATURE_FOLDER;?>', 'info_window', false, 300, 100);"><?=system_showText(LANG_BUTTON_VIEWCATEGORYPATH)?></button>
							<button class="input-button-form" type="button" value="<?=system_showText(LANG_BUTTON_REMOVESELECTEDCATEGORY)?>" onclick="JS_removeCategory(document.listingtemplate.feed, false);"><?=system_showText(LANG_BUTTON_REMOVESELECTEDCATEGORY)?></button>
						</center>
					</td>
				</tr>
			</table>
		</td>
	</tr>

</table>

<div class="tip-base">
        <p style="text-align: justify; font-size: 13px;"><b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TIPS_INTRO)?></b></p><br />
        <p style="text-align: left; font-size: 12px;"><b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_FIELD)?>: </b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TIPS_FIELD)?></p><br />
        <p style="text-align: left; font-size: 12px;"><b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LABEL)?>: </b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TIPS_LABEL)?></p><br />
        <p style="text-align: left; font-size: 12px;"><b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TOOLTIP)?>: </b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TIPS_TOOLTIP)?></p><br />
        <p style="text-align: left; font-size: 12px;"><b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_REQUIRED)?>: </b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TIPS_REQUIRED)?></p><br />
        <?/*<p style="text-align: left; font-size: 12px;"><b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCH)?>: </b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TIPS_SEARCH)?></p><br />
        <p style="text-align: left; font-size: 12px;"><b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCHBYKEYWORD)?>: </b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TIPS_SEARCHBYKEYWORD)?></p><br />
        <p style="text-align: left; font-size: 12px;"><b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCHBYRANGE)?>: </b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TIPS_SEARCHBYRANGE)?></p><br />
        */?><p style="text-align: left; font-size: 12px;"><b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_VALUES)?>: </b><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TIPS_VALUES)?></p>
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

<script language="javascript" type="text/javascript">
	<!--

	function checkboxLabelChanging(pos) {
		if (document.getElementById('custom_checkbox' + (pos+1))) {
			document.getElementById('custom_checkbox' + (pos+1)).className = "isVisible";
		}
	}

	function dropdownLabelChanging(pos) {
		if (document.getElementById('custom_dropdown' + (pos+1))) {
			document.getElementById('custom_dropdown' + (pos+1)).className = "isVisible";
		}
	}

	function textLabelChanging(pos) {
		if (document.getElementById('custom_text' + (pos+1))) {
			document.getElementById('custom_text' + (pos+1)).className = "isVisible";
		}
	}

	function shortdescLabelChanging(pos) {
		if (document.getElementById('custom_short_desc' + (pos+1))) {
			document.getElementById('custom_short_desc' + (pos+1)).className = "isVisible";
		}
	}

	function longdescLabelChanging(pos) {
		if (document.getElementById('custom_long_desc' + (pos+1))) {
			document.getElementById('custom_long_desc' + (pos+1)).className = "isVisible";
		}
	}

	//-->
</script>

<?
$count_customcheckbox = 0;
$count_customdropdown = 0;
$count_customtext = 0;
$count_customshortdesc = 0;
$count_customlongdesc = 0;
$dbMain = db_getDBObject(DEFAULT_DB, true);
$dbObjCustom = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
$sqlCustom = "DESC Listing";
$resultCustom = $dbObjCustom->query($sqlCustom);
while ($rowCustom = mysql_fetch_assoc($resultCustom)) {
	if (string_strpos($rowCustom["Field"], "custom_checkbox") !== false) {
		$count_customcheckbox++;
	} elseif (string_strpos($rowCustom["Field"], "custom_dropdown") !== false) {
		$count_customdropdown++;
	} elseif (string_strpos($rowCustom["Field"], "custom_text") !== false) {
		$count_customtext++;
	} elseif (string_strpos($rowCustom["Field"], "custom_short_desc") !== false) {
		$count_customshortdesc++;
	} elseif (string_strpos($rowCustom["Field"], "custom_long_desc") !== false) {
		$count_customlongdesc++;
	}
}
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
		<?/*<th class="extraFieldsLabel extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCH)?>
		</th>*/?>
	</tr>

	<?
	$showextrafield = 0;
	for ($i=0; $i<$count_customcheckbox; $i++) {
		?>
		<tr id="custom_checkbox<?=$i?>"
		<?
		if ($label["custom_checkbox$i"]) {
			echo "class=\"isVisible\"";
			$showextrafield = $i+1;
		} elseif ($i == $showextrafield) {
			echo "class=\"isVisible\"";
		} else {
			echo "class=\"isHidden\"";
		}
		?>
		>
			<td class="center">
				<input type="text" name="label[custom_checkbox<?=$i?>]" value="<?=$label["custom_checkbox$i"]?>" onkeydown="checkboxLabelChanging(<?=$i?>)" class="extraCheckboxExplode" />
			</td>
			<td class="center">
				<input type="text" name="instructions[custom_checkbox<?=$i?>]" value="<?=$instructions["custom_checkbox$i"]?>" class="extraCheckboxExplode" />
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
		<?/*<th class="extraFieldsLabel extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCH)?>
		</th>*/?>
	</tr>

	<?
	$showextrafield = 0;
	for ($i=0; $i<$count_customdropdown; $i++) {
		?>
		<tr id="custom_dropdown<?=$i?>"
		<?
		if ($label["custom_dropdown$i"]) {
			echo "class=\"isVisible\"";
			$showextrafield = $i+1;
		} elseif ($i == $showextrafield) {
			echo "class=\"isVisible\"";
		} else {
			echo "class=\"isHidden\"";
		}
		?>
		>
			<td>
				<input type="text" name="label[custom_dropdown<?=$i?>]" value="<?=$label["custom_dropdown$i"]?>" onkeydown="dropdownLabelChanging(<?=$i?>)" class="extraFieldExplode" style="width: 160px;" />
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
		<?/*<th class="extraFieldsLabel extraFieldsShort wrap">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCHBYKEYWORD)?>
		</th>
		<th class="extraFieldsLabel extraFieldsShort wrap">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCHBYRANGE)?>
		</th>*/?>
	</tr>

	<?
	$showextrafield = 0;
	for ($i=0; $i<$count_customtext; $i++) {
		?>
		<tr id="custom_text<?=$i?>"
		<?
		if ($label["custom_text$i"]) {
			echo "class=\"isVisible\"";
			$showextrafield = $i+1;
		} elseif ($i == $showextrafield) {
			echo "class=\"isVisible\"";
		} else {
			echo "class=\"isHidden\"";
		}
		?>
		>
			<td>
				<input type="text" name="label[custom_text<?=$i?>]" value="<?=$label["custom_text$i"]?>" onkeydown="textLabelChanging(<?=$i?>)" class="extraFieldExplode" />
			</td>
			<td>
				<input type="text" name="instructions[custom_text<?=$i?>]" value="<?=$instructions["custom_text$i"]?>" class="extraFieldExplode" />
			</td>
			<td class="alignCenter extraFieldsShort">
				<input type="checkbox" name="required[custom_text<?=$i?>]" value="y" <?=($required["custom_text$i"]=="y") ? "checked" : ""?> class="inputRadio" />
			</td>
		</tr>
		<?
	}
	?>

</table>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="4" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EXTRASHORTDESCRIPTIONFIELDS)?></th>
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
		<?/*<th class="extraFieldsLabel extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCHBYKEYWORD)?>
		</th>*/?>
	</tr>

	<?
	$showextrafield = 0;
	for ($i=0; $i<$count_customshortdesc; $i++) {
		?>
		<tr id="custom_short_desc<?=$i?>"
		<?
		if ($label["custom_short_desc$i"]) {
			echo "class=\"isVisible\"";
			$showextrafield = $i+1;
		} elseif ($i == $showextrafield) {
			echo "class=\"isVisible\"";
		} else {
			echo "class=\"isHidden\"";
		}
		?>
		>
			<td>
				<input type="text" name="label[custom_short_desc<?=$i?>]" value="<?=$label["custom_short_desc$i"]?>" onkeydown="shortdescLabelChanging(<?=$i?>)" class="extraFieldExplode" />
			</td>
			<td>
				<input type="text" name="instructions[custom_short_desc<?=$i?>]" value="<?=$instructions["custom_short_desc$i"]?>" class="extraFieldExplode" />
			</td>
			<td class="alignCenter extraFieldsShort">
				<input type="checkbox" name="required[custom_short_desc<?=$i?>]" value="y" <?=($required["custom_short_desc$i"]=="y") ? "checked" : ""?> class="inputRadio" />
			</td>
		</tr>
		<?
	}
	?>

</table>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="4" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EXTRALONGDESCRIPTIONFIELDS)?></th>
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
		<?/*<th class="extraFieldsLabel extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCHBYKEYWORD)?>
        </th>*/?>
	</tr>

	<?
	$showextrafield = 0;
	for ($i=0; $i<$count_customlongdesc; $i++) {
		?>
		<tr id="custom_long_desc<?=$i?>"
		<?
		if ($label["custom_long_desc$i"]) {
			echo "class=\"isVisible\"";
			$showextrafield = $i+1;
		} elseif ($i == $showextrafield) {
			echo "class=\"isVisible\"";
		} else {
			echo "class=\"isHidden\"";
		}
		?>
		>
			<td>
				<input type="text" name="label[custom_long_desc<?=$i?>]" value="<?=$label["custom_long_desc$i"]?>" onkeydown="longdescLabelChanging(<?=$i?>)" class="extraFieldExplode" />
			</td>
			<td>
				<input type="text" name="instructions[custom_long_desc<?=$i?>]" value="<?=$instructions["custom_long_desc$i"]?>" class="extraFieldExplode" />
			</td>
			<td class="alignCenter extraFieldsShort">
				<input type="checkbox" name="required[custom_long_desc<?=$i?>]" value="y" <?=($required["custom_long_desc$i"]=="y") ? "checked" : ""?> class="inputRadio" />
			</td>
		</tr>
		<?
	}
	?>

</table>

<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/categorytree.js"></script>
<script language="javascript" type="text/javascript">
	loadCategoryTree('main', 'listing_', 'ListingCategory', 0, 0, '<?=LISTING_DEFAULT_URL?>', '<?=SELECTED_DOMAIN_ID;?>');
</script>