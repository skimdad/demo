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
	# * FILE: /includes/tables/table_locationContry.php
	# ----------------------------------------------------------------------------------------------------


if ($operation) {
	if ($operation=="insert") { ?>
		<div id="warning" class="successMessage"><?=string_ucwords(constant("LANG_SITEMGR_LOCATION_".constant("LOCATION".$_location_level."_SYSTEM")))." ".$_GET["loc_name"]." ".system_showText(LANG_SITEMGR_LOCATION_WASSUCCESSADDED);?></div>
		<?
	} else
	if ($operation=="update") { ?>
		<div id="warning" class="successMessage"><?=string_ucwords(constant("LANG_SITEMGR_LOCATION_".constant("LOCATION".$_location_level."_SYSTEM")))." ".$_GET["loc_name"]." ".system_showText(LANG_SITEMGR_LOCATION_WASSUCCESSUPDATED);?></div>
		<?
	} else
	if ($operation=="delete") { ?>
		<div id="warning" class="successMessage"><?=string_ucwords(constant("LANG_SITEMGR_LOCATION_".constant("LOCATION".$_location_level."_SYSTEM")))." ".$_GET["loc_name"]." ".system_showText(LANG_SITEMGR_LOCATION_WASSUCCESSDELETED);?></div>
		<?
	}
}
?>

<? if ($locations) { ?>

	<?
		$db = db_getDBObject(DEFAULT_DB, true);

		$locations_info = db_getFromDB("settinglocation", "id", $_location_level, 1, "", "array", SELECTED_DOMAIN_ID);
		$featured = true;
		if ($locations_info["default_id"]) {
			$featured = false;
		}
	?>

	<ul class="standard-iconDESCRIPTION">
		<? if ($_location_child_level!==false) { ?>
			<li class="add-icon"><?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_ADD".constant("LOCATION".$_location_child_level."_SYSTEM"))))?></li>
			<li class="view-icon"><?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_VIEW".constant("LOCATION".$_location_child_level."_SYSTEM"))))?></li>
		<? } ?>
		<li class="edit-icon"><?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_EDIT".constant("LOCATION".$_location_level."_SYSTEM"))))?></li>
		<li class="delete-icon"><?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_DELETE".constant("LOCATION".$_location_level."_SYSTEM"))))?></li>
	</ul>

	<form name="item_table">

		<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

			<tr>
				<th style="width: auto;"><?=string_ucwords(constant("LANG_SITEMGR_LOCATION_".constant("LOCATION".$_location_level."_SYSTEM")))?></th>
				<? if ($featured) { ?>
					<th style="width: 100px; align: center"><?=system_showText(LANG_SITEMGR_FEATURED)?></th>
				<? } ?>
				<?
				foreach ($_locations as $i_child_level) {
					system_retrieveLocationRelationship ($_locations, $i_child_level, $i_location_father_level, $i_location_child_level);
					if (($i_location_child_level!==false) and ($_location_level < $i_location_child_level)) {
				?>
					<th style="width: 100px;"><?=string_ucwords(constant("LANG_SITEMGR_NAVBAR_".constant("LOCATION".($i_location_child_level)."_SYSTEM_PLURAL")))?></th>
				<?
					}
				}
				?>
				<th style="width: 8%;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
			</tr>

			<?
			$cont=0;
			foreach ($locations as $location) {
				$cont++;
				$id = $location->getNumber("id");

				$aux_node_params = array();
				foreach ($_locations as $i_level) {
					if ($location->getNumber('location_'.$i_level))
						$aux_node_params['location_'.$i_level] = $location->getNumber('location_'.$i_level);
				}
				$aux_node_params = array_merge($aux_node_params, $_GET);
				$_location_node_params = system_buildLocationNodeParams($aux_node_params);
				?>

				<tr>
					<td>
						<fieldset title="<?=$location->getString("name");?>">
							<? if (($_location_father_level!==false) and ($location->getNumber('id') > 0)) { ?>
							<input id="location_id<?=$cont?>" type="checkbox" value="<?=$id?>" name="item_check[]" onclick="javascript:setLocationSelect();" style="display: none" />
							<? } ?>

							<? if (($_location_child_level!==false) and ($location->getNumber('id') > 0)) { ?>
							<a href="<?=$url_base?>/locations/location_<?=($_location_child_level)?>/index.php?<?=($_location_node_params?$_location_node_params."&":"")?>location_<?=$_location_level?>=<?=$id?>" class="link-table">
								<?=$location->getString("name");?>
							</a>
							<? } else { ?>
								<?=$location->getString("name");?>
							<? } ?>

						</fieldset>

					</td>
					<? if ($featured) { ?>
						<?
							unset($is_featured, $locationFeatObj);
							$locationFeatObj = new LocationFeatured(SELECTED_DOMAIN_ID, $_location_level, $location->getNumber("id"));
							if ($locationFeatObj->getNumber("location_id")) $is_featured = "y";
							else  $is_featured = "n";
						?>
						<td id="tableLocation_rowId_<?=$cont?>">
							<? if ($location->getNumber('id') > 0) { ?>
							<a href="javascript:void(0);" onclick="javascript:updateFeatured(<?=$location->getNumber("id")?>,'<?=$is_featured?>',<?=$_location_level?>,<?=$cont?>)">
								<img src="<?=DEFAULT_URL?>/images/<?=$is_featured == 'y' ? 'icon_check.gif' : 'icon_uncheck.gif'?>" border="0" alt="<?=($is_featured == 'y' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" title="<?=($is_featured == 'y' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" />
							</a>
							<? } else echo '&nbsp'; ?>
						</td>
					<? } ?>

					<?
					foreach ($_locations as $i_child_level) {
						system_retrieveLocationRelationship ($_locations, $i_child_level, $i_location_father_level, $i_location_child_level);
						if (($i_location_child_level!==false) and ($_location_level < $i_location_child_level)) {
							$i_locations_child = db_getFromDB("location".($i_location_child_level), "location_".$_location_level, $id, "all");
					?>
						<td>
							<? if (count($i_locations_child)>0) { ?>
							<a href="<?=$url_base?>/locations/location_<?=($i_location_child_level)?>/index.php?<?=($_location_node_params?$_location_node_params."&":"")?>location_<?=$_location_level?>=<?=$id?>" class="link-table">
							<?=count($i_locations_child);?>
							</a>
							<? } else { echo count($i_locations_child); } ?>
						</td>
					<?
						}
					}
					?>

					<td nowrap="nowrap">

						<? if ($location->getNumber('id') > 0) { ?>
							<? if ($_location_child_level!==false) { ?>
								<a href="<?=$url_base?>/locations/location_<?=$_location_child_level?>/location_<?=$_location_child_level?>.php?<?=($_location_node_params?$_location_node_params."&":"")?>location_<?=$_location_level?>=<?=$id?>&operation=add" class="link-table">
									<img src="<?=DEFAULT_URL?>/images/bt_add.gif" border="0" alt="<?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_CLICK_TOADD".constant("LOCATION".$_location_child_level."_SYSTEM"))))?>" title="<?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_CLICK_TOADD".constant("LOCATION".$_location_child_level."_SYSTEM"))))?>" />
								</a>

								<a href="<?=$url_base?>/locations/location_<?=$_location_child_level?>/index.php?<?=($_location_node_params?$_location_node_params."&":"")?>location_<?=$_location_level?>=<?=$id?>" class="link-table">
									<img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_CLICK_TOVIEW".constant("LOCATION".$_location_child_level."_SYSTEM"))))?>" title="<?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_CLICK_TOVIEW".constant("LOCATION".($_location_child_level)."_SYSTEM"))))?>" />
								</a>
							<? } ?>

							<a href="<?=$url_redirect?>/location_<?=($_location_level)?>.php?<?=($_location_node_params?$_location_node_params."&":"")?>id=<?=$id?>&operation=edit" class="link-table">
								<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" alt="<?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_CLICK_TOEDIT".constant("LOCATION".$_location_level."_SYSTEM"))))?>" title="<?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_CLICK_TOEDIT".constant("LOCATION".($_location_level)."_SYSTEM"))))?>" />
							</a>

							<a href="<?=$url_redirect?>/delete.php?<?=($_location_node_params?$_location_node_params."&":"")?>id=<?=$id?>" class="link-table">
								<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" alt="<?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_CLICK_TODELETE".constant("LOCATION".$_location_level."_SYSTEM"))))?>" title="<?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_CLICK_TODELETE".constant("LOCATION".($_location_level)."_SYSTEM"))))?>" />
							</a>
						<? } else echo '&nbsp'; ?>

					</td>
				</tr>

				<?
				}
				unset ($cont);
			?>

		</table>
	</form>
	<ul class="standard-iconDESCRIPTION">
		<? if ($_location_child_level!==false) { ?>
			<li class="add-icon"><?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_ADD".constant("LOCATION".$_location_child_level."_SYSTEM"))))?></li>
			<li class="view-icon"><?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_VIEW".constant("LOCATION".$_location_child_level."_SYSTEM"))))?></li>
		<? } ?>
		<li class="edit-icon"><?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_EDIT".constant("LOCATION".$_location_level."_SYSTEM"))))?></li>
		<li class="delete-icon"><?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_DELETE".constant("LOCATION".$_location_level."_SYSTEM"))))?></li>
	</ul>

<? } else {
	if ($_location_father_level !== false) {
		if (isset(${"location_".$_location_father_level}) && ${"location_".$_location_father_level} != "") { ?>
			<p class="informationMessage">
				<?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_".constant("LOCATION".$_location_level."_SYSTEM")."_NORECORD")))?>
				<a href="<?=DEFAULT_URL?>/sitemgr/locations/location_<?=$_location_level?>/location_<?=$_location_level?>.php?<?=($_location_node_params?$_location_node_params."&":"")?>operation=add">
					<?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_ADD".constant("LOCATION".$_location_level."_SYSTEM"))))?>
				</a>
			</p>

			<?
		} else { ?>
			<p class="informationMessage">
				<?=system_showText(string_ucwords(LANG_SITEMGR_LOCATION_NORECORD))?>
			</p>
	<?	}

	} else { ?>
		<p class="informationMessage">
			<?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_".constant("LOCATION".$_location_level."_SYSTEM")."_NORECORD")))?>
			<a href="<?=DEFAULT_URL?>/sitemgr/locations/location_<?=$_location_level?>/location_<?=$_location_level?>.php?<?=($_location_node_params?$_location_node_params."&":"")?>operation=add">
				<?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_ADD".constant("LOCATION".$_location_level."_SYSTEM"))))?>
			</a>
		</p>
		<?
	}
 }
 ?>