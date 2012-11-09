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
	# * FILE: /includes/forms/form_locationsettings.php
	# ----------------------------------------------------------------------------------------------------

?>
<table cellpadding="2" cellspacing="0" border="0" class="table-form" width="100%">
	<?if (!$step){?>
	<tr>
		<td colspan="2">
			<div class="tip-base">
				<span class="warning" style="text-align: justify; font-size: 11px;">
                    <a href="<?=DEFAULT_URL;?>/sitemgr/faq/faq.php?keyword=<?=urlencode("location");?>" target="_blank">
                    <?=system_showText(LANG_SITEMGR_LOCATIONTIP)?></a>
                </span>
			</div>
		</td>
	</tr>
	<tr class="tr-form">
		<input type="hidden" name="maintenance_mode" id="maintenance_mode" value="<?=$maintenance_mode?>" maxlength="3" />
	</tr>
	<? } ?>
</table>
<?

if ($message) { ?>
	<div id="warning" class="<?=$message_style?>">
		<?=$message?>
	</div>
<? } ?>

<br />
<table cellpadding="2" cellspacing="0" border="0" class="table-form">
	<tr class="tr-form" align="left">
		<th>
			<?=string_ucwords(system_showText(LANG_SITEMGR_ENABLE))?>
		</th>
		<th style="width: 120px;" align="left">
			<?=string_ucwords(system_showText(LANG_SITEMGR_LOCATION))?>
		</th>		
		<th style="width: 100px;" align="left">
			<?=string_ucwords(system_showText(LANG_SITEMGR_LOCATION_DEFAULT))?>
		</th>
		<th align="left">
			<?=string_ucwords(system_showText(LANG_SITEMGR_LOCATION_SHOWDEFAULT))?>
		</th>		
		
	</tr>
	<? for ($i=1; $i<=5; $i++) {		

		$index = ($i-1);
		$tmp_location_enabled[$i] = $locations_info[$index]['enabled'];
		$tmp_location_show[$i] = $locations_info[$index]['show'];
		$tmp_default[$i]=false;
		if ($tmp_location_enabled[$i] == 'y') {
			$tmp_default_location[$i] = db_getFromDB("location".$i, "Location_".$i.".id", $locations_info[$index]['default_id'], 1, false, "object");
			$tmp_default_location_id[$i] = $tmp_default_location[$i]->getNumber("id");
			$tmp_default_location_name[$i] = $tmp_default_location[$i]->getString("name");
			if ($tmp_default_location_id[$i])
				$tmp_default[$i]=true;
		}
		
		$objLocationLabel = "Location".$i;
		${"Location".$i} = new $objLocationLabel;

		$location_father = false;
		$location_father_id =false;
		$j=$i-1;
		while ($j>=1 && !$location_father) {
			if (${"location_".$j."_checked"}) {
				$location_father=$j;
				if ($tmp_default_location_id[$j]) {
					$location_father_id = $tmp_default_location_id[$j];
				}
			}
			$j--;
		}
		if (!$location_father)
			${"locations".$i}  = ${"Location".$i}->retrieveAllLocation();
		elseif ($location_father_id) {
			${"Location".$i}->SetString("location_".$location_father, $location_father_id);
			${"locations".$i} = ${"Location".$i}->retrieveLocationByLocation($location_father);
		}

		?>
		<tr class="tr-form">
			<td align="left" class="td-form">
				<input type="checkbox" name="location_<?=$i?>_enabled" id="location_<?=$i?>_enabled" <?=${"location_".$i."_checked"}?> class="inputCheck" <?=(($i!=5)?'onclick="controlLocationActivation('.$i.')"':'')?> />
			</td>
			<td>
				<div class="label-form" align="left"><label for="location_<?=$i?>_enabled"><?=system_showText(constant ("LANG_SITEMGR_LOCATION_".constant("LOCATION".$i."_SYSTEM")))?></label></div>
				
			</td>			
			<td>
				<?
				$enable_location = (${"location_".$i."_checked"}&&(!$location_father ||($tmp_default[$location_father])));
				?>
				<div style="float:left">
					<select name="default_L<?=$i?>_id" id="default_L<?=$i?>_id" <?=($enable_location?"":"disabled")?> onchange="changeSettings(this.value, <?=$i?>)">
						<option id="l_location_<?=$i?>" value=""><?=system_showText(LANG_SITEMGR_LOCATION_NODEFAULT)?></option>

						<?
						foreach(${"locations".$i} as $each_location) {
							$selected = ($tmp_default_location_id[$i] == $each_location["id"]) ? "selected" : "";
							?><option <?=$selected?> id="option_L<?=$i?>_ID<?=$each_location["id"]?>" value="<?=$each_location["id"]?>"><?=$each_location["name"]?></option><?
							unset($selected);
						}
						?>
					</select>
				</div>
			</td>
			<td>
				<input name="check_L<?=$i?>_show" id="check_L<?=$i?>_show" type="checkbox" class="inputCheck" <?=($tmp_location_show[$i]=='y'?'checked':'')?> <?=($tmp_location_show[$i]!='b'?"":"disabled")?> onclick="changeShowOption(<?=$i?>)"  />
			</td>			
		</tr>
	<? } ?>
</table>


<? for ($i=1; $i<=5; $i++) { ?>
	<input id="default_L<?=$i?>_show" name="default_L<?=$i?>_show" type="hidden" value="<?=($tmp_location_show[$i])?>">
	<input id="default_L<?=$i?>_name" name="default_L<?=$i?>_name" type="hidden" value="<?=($tmp_default_location_name[$i]?$tmp_default_location_name[$i]:'')?>">
	<?
	if ($i<5) { ?>
        <a id="link_enable_location<?=$i?>" href="#enable_location<?=$i?>"></a>
        <div style="display:none">
            <div id="enable_location<?=$i?>">

                <h2 style="border-bottom:3px double #ccc; font-size:18px; padding:0 0 10px; margin-bottom:10px">
                    <?=system_showText(LANG_SITEMGR_LOCATION_MSGSORRYYOUCANTENABLE)?> <?=system_showText(constant ("LANG_SITEMGR_LOCATION_".constant("LOCATION".$i."_SYSTEM")))?>
                </h2>

                <p style="font-size:12px;">

                    <?=system_showText(LANG_SITEMGR_LOCATION_MSGACTIVATELOCATION)?>

                </p>
                <div style="text-align:center">
                    <? /* <input type="button" class="input-button-form" value="<?=system_showText(LANG_SITEMGR_YES)?>" style="margin-left: 20px; width: 80px;" onclick="tb_response(<?=$i?>, true);" > */ ?>
                    <input type="button" class="input-button-form" value="<?=system_showText(LANG_SITEMGR_OK)?>" style="width: 80px;" onclick="tb_response(<?=$i?>, false);">
                </div>
            </div>
		</div>
<?
	}
} ?>

<?
unset($tmp_location_enabled);
unset($tmp_location_show);
unset($tmp_default_location);
unset($tmp_default_location_id);
unset($tmp_default_location_name);
?>

<script type="text/javascript">

	function changeSettings(value, level) {
		resetLevelsChild(level);		
		if (value=='') {
			$('#check_L'+level+"_show").attr('checked', '');
			$('#check_L'+level+"_show").attr('disabled', 'disabled');
			$("#default_L"+level+"_show").attr('value', 'b');
			$('#default_L'+level+'_name').attr('value', '');
			//resetLevelsChild(level);
		} else { 
			$('#check_L'+level+"_show").attr('disabled', '');
            $('#check_L'+level+"_show").attr('checked', 'checked');
			$("#default_L"+level+"_show").attr('value', 'y');
			$('#default_L'+level+'_name').attr('value', $('#option_L'+level+'_ID'+value).text());
			next_enabled_location = retrieveNextEnabledLocation (level);
			if (next_enabled_location) {
				enableLevel (next_enabled_location);
				loadLocationsChild('<?=DEFAULT_URL?>', level, value, next_enabled_location);
			}			
		}		
	}	

	function controlLocationActivation(level) {
		if ($('#location_'+level+'_enabled').is(':checked')) {
			non_activatable_locations = '<?=$non_activatable_locations?>';			
			if (non_activatable_locations) {
				non_activatable_locations = [<?=$non_activatable_locations?>];
				if (in_array (level, non_activatable_locations)) {
                    $('#location_'+level+'_enabled').attr('checked', '');
                    $("a#link_enable_location"+level).fancybox({
                        'autoDimensions': false,
                        'modal': true,
                        'width': 400,
                        'height': 160
                    });
                    $("#link_enable_location"+level).trigger('click');
				} else
					activeLocation(level);
			} else
				activeLocation(level);
		} else
			activeLocation(level);
	}	

	function tb_response(level, flag) {
        parent.$.fancybox.close();
		if (flag) {
			$('#location_'+level+'_enabled').attr('checked', 'checked');
			activeLocation(level);
		}	
	}

	function activeLocation(level) {
		resetLevelsChild(level);
		if ($('#location_'+level+'_enabled').is(':checked')) {					
			prev_enabled_location = retrievePrevEnabledLocation(level);
			active_option_default=true;
			if (prev_enabled_location)
				if ($('#default_L'+prev_enabled_location+'_id').val()=='')
					active_option_default = false;

			if (active_option_default) {
				enableLevel (level);
				if(prev_enabled_location)
					loadLocationsChild('<?=DEFAULT_URL?>', prev_enabled_location, $('#default_L'+prev_enabled_location+'_id').val(), level);
				else
					loadAllLocations('<?=DEFAULT_URL?>', level);
			}
		} else {
			disableLevel (level);
			active_option_default=true;
			next_enabled_location = retrieveNextEnabledLocation(level)
			if (next_enabled_location) {
				prev_enabled_location = retrievePrevEnabledLocation (level);
				if (prev_enabled_location)
					if ($('#default_L'+prev_enabled_location+'_id').val()=='')
						active_option_default=false;
			} else
				active_option_default = false;
			if (active_option_default) {
				enableLevel (next_enabled_location);
				if(prev_enabled_location) {
					loadLocationsChild('<?=DEFAULT_URL?>', prev_enabled_location, $('#default_L'+prev_enabled_location+'_id').val(), next_enabled_location);
				} else {
					loadAllLocations('<?=DEFAULT_URL?>', next_enabled_location);
				}
			}
		}
	}

	function retrievePrevEnabledLocation(level) {
		prev_enabled_location = false;
		if (level>1) {
			i=level-1;
			while (i>=1 && !prev_enabled_location) {
				if ($('#location_'+i+'_enabled').is(':checked'))
					prev_enabled_location = i;
				i--;
			}
		}
		return prev_enabled_location;
	}

	function retrieveNextEnabledLocation(level) {
		next_enabled_location = false;		
		if (level<5) {
			i=level+1;
			while (i<=5 && !next_enabled_location) {
				if ($('#location_'+i+'_enabled').is(':checked'))
					next_enabled_location = i;
				i++;
			}
		}
		return next_enabled_location;
	}

	function resetLevelsChild(level) {
		if (level<5) {
			for (i=(level+1); i<=5; i++) {
				$("#default_L"+i+"_id").attr('value', '');
				$('#default_L'+i+"_id").attr('disabled', 'disabled');	
				$('#check_L'+i+"_show").attr('checked', '');
				$('#check_L'+i+"_show").attr('disabled', 'disabled');
				$("#default_L"+i+"_show").attr('value', 'b');
				$("#default_L"+i+"_name").attr('value', '');
			}
		}
	}

	function enableLevel(level) {
		$('#default_L'+level+"_id").attr('disabled', '');		
	}

	function disableLevel(level) {		
		$("#default_L"+level+"_id").attr('value', '');
		$('#default_L'+level+"_id").attr('disabled', 'disabled');
		$('#check_L'+level+"_show").attr('checked', '');
		$('#check_L'+level+"_show").attr('disabled', 'disabled');
		$("#default_L"+level+"_show").attr('value', 'b');
		$("#default_L"+level+"_name").attr('value', '');
	}

	function changeShowOption(level) {
		if ($('#check_L'+level+"_show").is(':checked'))
			$("#default_L"+level+"_show").attr('value', 'y');
		else
			$("#default_L"+level+"_show").attr('value', 'n');
	}
</script>


