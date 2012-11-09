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
	# * FILE: /includes/forms/form_location.php
	# ----------------------------------------------------------------------------------------------------

?>

<script type="text/javascript">

function doSubmitLocation(formName, operationName) {
    if (!document.forms[formName].elements['operation']) {
        alert('doSubmitLocation: Error !');
        return false;
    }
    document.forms[formName].elements['operation'].value = operationName;
    document.forms[formName].submit();
    return true;
}


	$(document).ready(function(){
		
		var field_name = 'seo_description';
		var field_name2 = 'seo_keywords';
		var count_field_name = 'seo_description_remLen';
		var count_field_name2 = 'seo_keywords_remLen';

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
		
	});
</script>
<form action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" name="location_data_in" id="location_data_in" method="post">

	<? if ($location_message) { ?>
		<div id="warning" class="<?=$message_style?>"><?=$location_message?></div>
	<? } ?>

	<?
		$edirLocConf = explode(",", EDIR_LOCATIONS);
		$edirLocConfNames = explode(",", EDIR_ALL_LOCATIONNAMES);
	?>
	<? if ($_location_level != $edirLocConf[0]) {?>
		<table  border="0" cellpadding="0" cellspacing="0" class="standard-table nomargin">
			<tr>
				<th class="standard-tabletitle">
					<?=system_showText(constant("LANG_SITEMGR_".$edirLocConfNames[$_location_level-1]."_HIERARCHY"))?>
				</th>
			</tr>
		</table>
	<? } ?>

	<? include(EDIRECTORY_ROOT."/includes/code/load_location_location.php");?>

	<table  border="0" cellpadding="0" cellspacing="0" class="standard-table nomargin">

		<? if (($location_message == "" && (string_strtolower($operation) == "add" || string_strtolower($operation) == "edit" || string_strtolower($operation) == "delete")) || (string_strtolower($operation) == "insert" && !$success) || (string_strtolower($operation) == "update" && !$success)) { ?>
			<tr>
				<th class="standard-tabletitle" colspan="2">
					<?
					$prefix = "";
					if ((string_strtolower($operation) == "add") || (string_strtolower($operation) == "insert")) $prefix = string_ucwords(system_showText(LANG_SITEMGR_ADD))." ";
					elseif ((string_strtolower($operation) == "edit") || (string_strtolower($operation) == "update")) $prefix = string_ucwords(system_showText(LANG_SITEMGR_EDIT))." ";
					elseif (string_strtolower($operation) == "delete") $prefix = string_ucwords(system_showText(LANG_SITEMGR_DELETE))." ";
					echo $prefix.LOCATION_TITLE;
					?>

				</th>
			</tr>
		<? } ?>
	</table>

	<table  border="0" cellpadding="0" cellspacing="0" class="standard-table">
		<?
		if (($location_message == "" && string_strtolower($operation) == "add") || (string_strtolower($operation) == "insert" && !$success) || (string_strtolower($operation) == "update" && !$success) || (string_strtolower($operation) == "edit" && $id)) {
			$btn_label  = system_showText(LANG_SITEMGR_UPDATE);
			$btn_action = 'update';
			if ((string_strtolower($operation) == "add") || (string_strtolower($operation) == "insert")) {
				  $btn_label  = system_showText(LANG_SITEMGR_INSERT);
				  $btn_action = 'insert';
			}
			?>
				<tr>
					<th class="alignTop wrap">
						<input type="hidden" name="default" id="default" value="<?=$location_default?>" />
                        <input type="hidden" name="id" id="id" value="<?=$id?>" />

						* <?=LOCATION_TITLE?>:
					</th>
					<td><input type="text" name="location_name" value="<?=htmlspecialchars($location_name)?>" onblur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" />
						<span style="font-size: 11px; color:#666;"><?=system_showText(LANG_SITEMGR_LOCATION_NAMEMSG1)?> <?="\"$btn_label\"";?> <?=system_showText(LANG_SITEMGR_LOCATION_NAMEMSG2)?></span>
					</td>
				</tr>
				
				<tr>
					<th class="alignTop">
						<?=LOCATION_TITLE?> - <?=string_ucwords(system_showText(LANG_SITEMGR_ABBREVIATION))?> (<?=system_showText(LANG_SITEMGR_LOCATION_USEDFORSEARCH)?>):
						<br />
					</th>
					<td><input type="text" name="location_abbreviation" value="<?=htmlspecialchars($location_abbreviation);?>" />
						<span style="font-size: 11px; color:#666;"><?=system_showText(LANG_SITEMGR_LOCATION_ABBMSG)?></span>
					</td>
				</tr>
				<?
					$locations_info = db_getFromDB("settinglocation", "id", $_location_level, 1, "", "array", SELECTED_DOMAIN_ID);
					if (!$locations_info["default_id"]) { ?>
						<tr>
							<th class="alignTop">
								<?=system_showText(LANG_SITEMGR_FEATURED)?>:
							</th>
							<td>
								<input type="checkbox" name="location_featured" class="inputCheck" <?=($location_featured=='y'?'checked':($_POST['location_featured']?'checked':''))?> />
							</td>
						</tr>
					<? } ?>
		</table>
		
		<table  border="0" cellpadding="0" cellspacing="0" class="standard-table nomargin">
				<tr>
					<th class="standard-tabletitle" colspan="2">
						<?=system_showText(LANG_SITEMGR_SEOCENTER)?>
					</th>
				</tr>
				<tr>
					<td colspan="2">
						<span style="font-size: 11px; color:#666;"><?=system_showText(LANG_SITEMGR_LOCATION_FRIENDLY_URL1)?> <br /><br /><strong><?=system_showText(LANG_SITEMGR_FOREXAMPLE)?>:</strong><br /><br /><?=system_showText(LANG_SITEMGR_LOCATION_FRIENDLY_URL2)?><br />"<?=LISTING_DEFAULT_URL?>/location/united-states"<br /><br /><?=system_showText(LANG_SITEMGR_LOCATION_FRIENDLY_URL3)?><br />"<?=LISTING_DEFAULT_URL?>/location/united-states/california"<br /><br /><?=system_showText(LANG_SITEMGR_LOCATION_FRIENDLY_URL4)?><br /><br /><?=system_showText(LANG_SITEMGR_LOCATION_FRIENDLY_URL5)?></span>
					</td>
				</tr>
		</table>
		
		<table  border="0" cellpadding="0" cellspacing="0" class="standard-table">
				<tr>
					<th>* <?=string_ucwords(system_showText(LANG_SITEMGR_LABEL_FRIENDLYTITLE))?>:</th>
					<td><input type="text" id="friendly_url" name="friendly_url" value="<?=$friendly_url?>" onblur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" /></td>
				</tr>
				<tr>
					<th class="alignTop"><?=string_ucwords(system_showText(LANG_SITEMGR_LABEL_METADESCRIPTION))?>:</th>
					<td>
						<textarea id="seo_description" name="seo_description" rows="5" cols="1" ><?=$seo_description?></textarea>
						<div id="textAreaCallback1"></div>
					</td>
				</tr>
				<tr>
					<th class="alignTop"><?=string_ucwords(system_showText(LANG_SITEMGR_LABEL_METAKEYWORDS))?>:</th>
					<td>
						<textarea id="seo_keywords" name="seo_keywords" rows="5" cols="1" ><?=$seo_keywords?></textarea>
						<div id="textAreaCallback2"></div>
					</td>
				</tr>
			</table>		
		<br />
		<div class="baseForm">
	
			<button class="input-button-form" type="button" name="bt_operation_submit" id="bt_operation_submit" value="<?=$btn_label?>" onclick="doSubmitLocation('location_data_in', '<?=$btn_action?>')" class="input-button-form2"><?=$btn_label?></button>
			<button type="button" value="Cancel" class="input-button-form" onclick="document.getElementById('formlocationcancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
			<input type="hidden" name="operation"  id="operation"  value="<?=$btn_action?>" />
		</div>
			
			<?
		} 
		?>	

</form>

<? if ($lastLoc) { ?>
	<script type="text/javascript">
		loadLocationSitemgrMembers('<?=DEFAULT_URL?>', '<?=EDIR_LOCATIONS?>', <?=$lastLoc["up_level"]?>, <?=$lastLoc["level"]?>, <?=($lastLoc["up_val"] ? $lastLoc["up_val"] : 0)?>);
	</script>
<? } ?>
<? if ($newLoc) { ?>
	<script type="text/javascript">
		$(document).ready(function() {
			var i = 0;
			<? foreach ($newLoc as $loc) { ?>
				showNewLocationField('<?=$loc["level"]?>', '<?=EDIR_LOCATIONS?>', i == 0? true: false, '<?=$loc["val"]?>');
				easyFriendlyUrl('<?=$loc["val"]?>', 'new_location<?=$loc["level"]?>_friendly', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');
				i++;
			<? } ?>
			<?if ($newLocLevelBlank) { ?>
				showNewLocationField('<?=$newLocLevelBlank?>', '<?=EDIR_LOCATIONS?>', false);
			<? } ?>
		});
	</script>
<? } ?>