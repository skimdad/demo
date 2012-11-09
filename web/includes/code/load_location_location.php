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
    ?><script type="text/javascript" language="JavaScript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.selectbox.js"></script><?
	# ----------------------------------------------------------------------------------------------------
?>

	<div id="formsLocation">
		<table cellpadding="0" cellspacing="0" border="0" class="standard-table standardSIGNUPTable"> <?

			if ($_default_locations_info) {
				foreach($_default_locations_info as $_default_location_info) {
					if ($_default_location_info['type'] != $_location_level && $_default_location_info['type'] < $_location_level) { //do not show the default location if we are adding a new location of the same level as the default location
						
					if ($_GET["location_".$_default_location_info['type']]){ //if we are adding or editing a location, do not set it with the values of the default location
						$aux = "Location".$_default_location_info['type'];
						$locationAux = new $aux ($_GET["location_".$_default_location_info['type']]);
						$_default_location_info['name'] = $locationAux->getString("name");
						$_default_location_info['id'] = $_GET["location_".$_default_location_info['type']];
					}
						?>
						<tr>
							<th> <label for="location_<?=$_default_location_info['type']?>"><?=system_showText(constant("LANG_LABEL_".constant("LOCATION".$_default_location_info['type']."_SYSTEM")))?>:</label></th>
							<td> <?=$_default_location_info['name']?> </td>
							<td>&nbsp;</td>
						</tr>
						<?
					} ?>
					<input type="hidden" name="location_<?=$_default_location_info['type']?>" value="<?=$_default_location_info['id']?>"><?
				}
			}

			if ($_non_default_locations) {
				foreach($_non_default_locations as $each_location_level) {
					if ($each_location_level < $_location_level) {
						system_retrieveLocationRelationship ($_non_default_locations, $each_location_level, $each_location_father_level, $each_location_child_level);
						$each_location_name = system_showText(constant("LANG_LABEL_".constant("LOCATION".$each_location_level."_SYSTEM")));
					?>

					<tr id="div_location_<?=$each_location_level?>" <?=(${"locations".$each_location_level} & $_POST["new_location".$each_location_level."_field"]=="" /*&& ($each_location_father_level !== false? ${"location_".$each_location_father_level} : true)*/) ? "" : "style=\"display:none;\""?>>
						<th>
							<label for="location_<?=$each_location_level?>"><?=$each_location_name?>:</label>
						</th>
						<td class="field" id="div_img_loading_<?=$each_location_level?>" style="display:none;">
							<img id="img_loading" src="<?=DEFAULT_URL?>/images/content/img_loading_bar.gif" alt="loading..." />
						</td>
						<td id="div_select_<?=$each_location_level?>" class="field">
							<select name="location_<?=$each_location_level?>" id="location_<?=$each_location_level?>" <? if (($each_location_child_level) and ($_location_father_level != $each_location_level)) { ?> onchange="loadLocationSitemgrMembers('<?=DEFAULT_URL?>', '<?=EDIR_LOCATIONS?>', <?=$each_location_level?>, <?=$each_location_child_level?>, this.value);" <? } ?>>
								<option id="l_location_<?=$each_location_level?>" value=""><?=system_showText(constant("LANG_SEARCH_LABELCB".constant("LOCATION".$each_location_level."_SYSTEM")))?></option>
								<?
								foreach(${"locations".$each_location_level} as $each_location) {
									$selected = (${"location_".$each_location_level} == $each_location["id"]) ? "selected" : "";
									?><option <?=$selected?> value="<?=$each_location["id"]?>"><?=$each_location["name"]?></option><?
									unset($selected);
								}
								?>
							</select>
							<div class="field" id="box_no_location_found_<?=$each_location_level?>" style="display: none;"><?=system_showText(constant("LANG_LABEL_NO_LOCATIONS_FOUND"))?>.</div>
						</td>
						<td class="field">
							<div id="div_new_location<?=$each_location_level?>_link" <?=($_POST["new_location".$each_location_level."_field"]==""?"":"style=\"display:none;\"")?> >
								<? if ($each_location_level != 1 and !string_strpos($_SERVER["PHP_SELF"], "search.php") and ($_location_level != $each_location_level)) { ?>
									<a href="javascript:void(0);" onclick="showNewLocationField('<?=$each_location_level?>', '<?=EDIR_LOCATIONS?>', true);" style=" cursor: pointer">+ <?=system_showText(constant("LANG_LABEL_ADD_A_NEW_".constant("LOCATION".$each_location_level."_SYSTEM")))?></a>
								<? } else echo '&nbsp;'; ?>
							</div>
						</td>
					</tr>

						<? if ($each_location_level != 1 and !string_strpos($_SERVER["PHP_SELF"], "search.php") and ($_location_level != $each_location_level)) { ?>

							<tr id="div_new_location<?=$each_location_level?>_field" <?=($_POST["new_location".$each_location_level."_field"]!=""?"":($_POST["new_location".$each_location_father_level."_field"]!=""?"":"style=\"display:none;\""))?>>
								<th>
									<label for="newlocation"><?=system_showText(constant("LANG_LABEL_ADD_A_NEW_".constant("LOCATION".$each_location_level."_SYSTEM")))?>:</label>
								</th>
								<td class="field">
									<input type="text" name="new_location<?=$each_location_level?>_field" id="new_location<?=$each_location_level?>_field" value="<?=$_POST["new_location".$each_location_level."_field"]?>" <? if ($each_location_child_level) { ?> onfocus="showNewLocationField('<?=$each_location_child_level?>', '<?=EDIR_LOCATIONS?>', false);" <? } ?> onblur="easyFriendlyUrl(this.value, 'new_location<?=$each_location_level?>_friendly', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');"   />
									<input type="hidden" name="new_location<?=$each_location_level?>_friendly" id="new_location<?=$each_location_level?>_friendly" value="<?=$_POST["new_location".$each_location_level."_friendly"]?>" />
								</td>
								<td class="field">
									<div id="div_new_location<?=$each_location_level?>_back" <?=($_POST["new_location".$each_location_father_level."_field"]==""?"":"style=\"display:none;\"")?>>
										<a href="javascript:void(0);" onclick="hideNewLocationField('<?=$each_location_level?>', '<?=EDIR_LOCATIONS?>');" style=" cursor: pointer">- <?=system_showText(constant("LANG_LABEL_CHOOSE_AN_EXISTING_".constant("LOCATION".$each_location_level."_SYSTEM")))?></a>
									</div>
								</td>
							</tr>
							<?
						}
					}

				}
				unset ($each_location_father_level);
				unset ($each_location_child_level);
				unset ($each_location_level);
			}
			?>
		</table>
	</div>