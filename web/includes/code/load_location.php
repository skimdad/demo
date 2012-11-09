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
    # * FILE: /includes/code/load_location.php
    # ----------------------------------------------------------------------------------------------------
    
    # ----------------------------------------------------------------------------------------------------
    # SCRIPTS
    # ----------------------------------------------------------------------------------------------------
    ?>

	<script type="text/javascript" language="JavaScript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.selectbox.js"></script>

	<?	
	/*
	 * Check if is on sitemgr / members to use different function to get locations
	 */
	$use_sitemgr_function = false;
	if(string_strpos($_SERVER["REQUEST_URI"], SITEMGR_ALIAS) || string_strpos($_SERVER["REQUEST_URI"],MEMBERS_ALIAS)){
		$use_sitemgr_function = true;
	}
	if ( $advanced_search ) { ?> 	
		<? 
		$show_legend = false;
		$has_default_location = false;
		if ($_default_locations_info ) { 
			$last_default_location = 0;
			$has_default_location = true;
			$locations_default_where = "";
			foreach($_default_locations_info as $_default_location_info) {
				if ($_default_location_info["show"] == "y") {
					if (!$show_legend && (is_array($_non_default_locations) && count($_non_default_locations) > 0)) {
						$show_legend = true;
						?><label><?=system_showText(LANG_SEARCH_LABELLOCATION)?>:</label><?
					}
				}
				$locations_default_where .= $_default_location_info["name"].", ";
				?>
				<input type="hidden" name="location_<?=$_default_location_info["type"]?>" value="<?=$_default_location_info["id"]?>" /><?
				$last_default_location = $_default_location_info["type"]; 
			}
			$locations_default_where = string_substr($locations_default_where, 0, -2);
			$locations_default_where_replace = "yes";
			
			if (is_array($_non_default_locations) && ($_non_default_locations[0])){
				foreach($_non_default_locations as $_location_level) {
					if (${"location_".$_location_level}){
						$locations_default_where_replace = "no";
						break;
					}
				}
			}
			
			?>
			<input type="hidden" name="locations_default_where" id="locations_default_where" value="<?=$locations_default_where?>" />	
			<input type="hidden" name="locations_default_where_replace" id="locations_default_where_replace" value="<?=$locations_default_where_replace?>" />
			<?
		}

		if ($_non_default_locations) {
			if (!$show_legend) {
				$show_legend = true;
				?>
				
				<label>
					<?=system_showText(LANG_SEARCH_LABELLOCATION)?>:
				</label>
				
				<?
			}
			$firstLoc = true;
			foreach($_non_default_locations as $_location_level) {
				system_retrieveLocationRelationship ($_non_default_locations, $_location_level, $_location_father_level, $_location_child_level);
				?>

				<div class="field loading-location" id="div_img_loading_<?=$_location_level?>" style="display:none;">
					<img src="<?=DEFAULT_URL?>/theme/<?=EDIR_THEME?>/images/iconography/icon-loading-location.gif" alt="<?=system_showText(LANG_WAITLOADING)?>"/>
				</div>

				<div id="div_location_<?=$_location_level?>" <?=(${"locations".$_location_level} && ($_location_father_level !== false? ${"location_".$_location_father_level} : true) || ($has_default_location && $_location_level == ($last_default_location + 1) && ${"locations".$_location_level}) ) ? "" : "style=\"display:none;\""?>>
					<?
					if($use_sitemgr_function){ ?>
						<select name="location_<?=$_location_level?>" id="location_<?=$_location_level?>" <? if ($_location_child_level) { ?> onchange="loadLocationSitemgrMembers('<?=DEFAULT_URL?>', '<?=EDIR_LOCATIONS?>', <?=$_location_level?>, <?=$_location_child_level?>, this.value);" <? } ?>>
					<? } else { ?>
						<select class="select" name="location_<?=$_location_level?>" id="location_<?=$_location_level?>" <? if ($_location_child_level) { ?> onchange="loadLocation('<?=DEFAULT_URL?>', '<?=EDIR_LOCATIONS?>', <?=$_location_level?>, <?=$_location_child_level?>, this.value, <?=($firstLoc ? "true" : "false")?>);" <? }else{ ?> onchange="fillLocations('<?=EDIR_LOCATIONS?>')"<?} ?>>
					<? } ?>
						<option id="l_location_<?=$_location_level?>" value=""><?=system_showText(constant("LANG_SEARCH_LABELCB".constant("LOCATION".$_location_level."_SYSTEM")))?></option>
						<?
						if(${"locations".$_location_level}){
							foreach(${"locations".$_location_level} as $each_location) {
								//$selected = (${"location_".$_location_level} == $each_location["id"]) ? "selected" : "";
								?><option <?=$selected?> value="<?=$each_location["id"]?>"><?=$each_location["name"]?></option><?
								unset($selected);
							}
						}
						$firstLoc = false;
					?>
					</select>
					<div class="field" id="box_no_location_found_<?=$_location_level?>" style="display: none;">&nbsp;</div>
				</div>

				<?
			}
			
			$showClear = false;
			if ($location_1 || $location_2 || $location_3 || $location_4 || $location_5){
				$showClear = true;
			}
			
			?>
			<span class="clear-location" id="locations_clear" <?=($showClear ? "" : "style=\"display: none\"" )?>>
				<a href="javascript:void(0);" class="view-button" onclick="clearLocations('<?=EDIR_LOCATIONS?>', <?=$has_default_location ? $has_default_location : 0?>, <?=$last_default_location ? $last_default_location : 0?>);">
					<?=system_showText(LANG_BUTTON_CLEAR)?>
				</a>
			</span>
			<?
		}
		unset ($_location_father_level);
		unset ($_location_child_level);
		unset ($_location_level); 
		unset ($show_legend);
		unset($advanced_search);

	} else { ?>
		<div id="formsLocation">
			<table cellpadding="0" cellspacing="0" border="0" class="standard-table standardSIGNUPTable <?=$contact? "noMargin": "";?>"> <?
				if ($_default_locations_info) {
					foreach($_default_locations_info as $_default_location_info) {
						if ($_default_location_info["show"] == "y") {
							?>
							<tr>
								<th> <label for="location_<?=$_default_location_info["type"]?>"><?=system_showText(constant("LANG_LABEL_".constant("LOCATION".$_default_location_info["type"]."_SYSTEM")))?>:</label></th>
								<td> <?=$_default_location_info["name"]?> </td>
								<td>&nbsp;</td>
							</tr>
							<?
						} ?>
						<input type="hidden" name="location_<?=$_default_location_info["type"]?>" value="<?=$_default_location_info["id"]?>"><?
					}
				}

				if ($_non_default_locations) {
					foreach($_non_default_locations as $_location_level) {
						system_retrieveLocationRelationship ($_non_default_locations, $_location_level, $_location_father_level, $_location_child_level);
						$location_name = system_showText(constant("LANG_LABEL_".constant("LOCATION".$_location_level."_SYSTEM")));
						?>
						<tr id="div_location_<?=$_location_level?>" <?=(${"locations".$_location_level} & $_POST["new_location".$_location_level."_field"]=="" /*&& ($_location_father_level !== false? ${"location_".$_location_father_level} : true)*/) ? "" : "style=\"display:none;\""?>>
							<th>
								<label for="location_<?=$_location_level?>"><?=$location_name?>:</label>
							</th>
							<td class="field" id="div_img_loading_<?=$_location_level?>" style="display:none;">
								<img src="<?=DEFAULT_URL?>/images/content/img_loading_bar.gif" alt="<?=system_showText(LANG_WAITLOADING)?>"/>
							</td>
							<td id="div_select_<?=$_location_level?>" class="field locationSelect">
								<?
								if($use_sitemgr_function){
									?>
									<select class="select" name="location_<?=$_location_level?>" id="location_<?=$_location_level?>" <? if ($_location_child_level) { ?> onchange="loadLocationSitemgrMembers('<?=DEFAULT_URL?>', '<?=EDIR_LOCATIONS?>', <?=$_location_level?>, <?=$_location_child_level?>, this.value); <? if ($loadMap) { ?> loadMap(<?=$formLoadMap?>); <? } ?> " <? } elseif ($loadMap){ ?> onchange="loadMap(<?=$formLoadMap?>);" <? } ?>>
									<?
								}else{
									?>
									<select class="select" name="location_<?=$_location_level?>" id="location_<?=$_location_level?>" <? if ($_location_child_level) { ?> onchange="loadLocation('<?=DEFAULT_URL?>', '<?=EDIR_LOCATIONS?>', <?=$_location_level?>, <?=$_location_child_level?>, this.value);" <? } ?>>
									<?
								}
								?>
									<option id="l_location_<?=$_location_level?>" value=""><?=system_showText(constant("LANG_SEARCH_LABELCB".constant("LOCATION".$_location_level."_SYSTEM")))?></option>
									<?
									foreach(${"locations".$_location_level} as $each_location) {
										$selected = (${"location_".$_location_level} == $each_location["id"]) ? "selected" : "";
										?><option <?=$selected?> value="<?=$each_location["id"]?>"><?=$each_location["name"]?></option><?
										unset($selected);
									}
									?>
								</select>
								<div class="field" id="box_no_location_found_<?=$_location_level?>" style="display: none;"><?=system_showText(constant("LANG_LABEL_NO_LOCATIONS_FOUND"))?>.</div>
							</td>						
							<td class="field">
								<div id="div_new_location<?=$_location_level?>_link" <?=($_POST["new_location".$_location_level."_field"]==""?"":"style=\"display:none;\"")?> >
									<? if ($_location_level != 1 && !string_strpos($_SERVER["PHP_SELF"], "search.php")) { ?>
										<a href="javascript:void(0);" onclick="showNewLocationField('<?=$_location_level?>', '<?=EDIR_LOCATIONS?>', true);" style=" cursor: pointer">+ <?=system_showText(constant("LANG_LABEL_ADD_A_NEW_".constant("LOCATION".$_location_level."_SYSTEM")))?></a>
									<? } else echo "&nbsp;"; ?>
								</div>								
							</td>						
						</tr>

						<? if ($_location_level != 1 && !string_strpos($_SERVER["PHP_SELF"], "search.php")) { ?>

							<tr id="div_new_location<?=$_location_level?>_field" <?=($_POST["new_location".$_location_level."_field"]!=""?"":($_POST["new_location".$_location_father_level."_field"]!=""?"":"style=\"display:none;\""))?>>
								<th>
									<label for="newlocation"><?=system_showText(constant("LANG_LABEL_ADD_A_NEW_".constant("LOCATION".$_location_level."_SYSTEM")))?>:</label>
								</th>
								<td class="field">
									<input type="text" name="new_location<?=$_location_level?>_field" id="new_location<?=$_location_level?>_field" value="<?=$_POST["new_location".$_location_level."_field"]?>" <? if ($_location_child_level) { ?> onfocus="showNewLocationField('<?=$_location_child_level?>', '<?=EDIR_LOCATIONS?>', false);" <? } ?> onblur="easyFriendlyUrl(this.value, 'new_location<?=$_location_level?>_friendly', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>'); <? if ($loadMap) { ?> loadMap(<?=$formLoadMap?>); " <? } elseif ($loadMap){ ?> onchange="loadMap(<?=$formLoadMap?>);" <? } ?>   />
									<input type="hidden" name="new_location<?=$_location_level?>_friendly" id="new_location<?=$_location_level?>_friendly" value="<?=$_POST["new_location".$_location_level."_friendly"]?>" />
								</td>
								<td class="field">
									<div id="div_new_location<?=$_location_level?>_back" <?=($_POST["new_location".$_location_father_level."_field"]==""?"":"style=\"display:none;\"")?>>
										<a href="javascript:void(0);" onclick="hideNewLocationField('<?=$_location_level?>', '<?=EDIR_LOCATIONS?>');" style=" cursor: pointer">- <?=system_showText(constant("LANG_LABEL_CHOOSE_AN_EXISTING_".constant("LOCATION".$_location_level."_SYSTEM")))?></a>
									</div>
								</td>
							</tr>
						<?
						}
					}				
					unset ($_location_father_level);
					unset ($_location_child_level);
					unset ($_location_level);
				}			
				?>
			</table>
		</div> <?
	} ?>