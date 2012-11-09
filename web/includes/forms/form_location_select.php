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
    # * FILE: /includes/forms/form_location_select.php
    # ----------------------------------------------------------------------------------------------------

	$itemCount = count($locations);

	if ($_location_father_level !== false ) { ?>

		<script type="text/javascript">
		<!--
		function doSubmitChangeFather() {
			$('#idlist').val('');

			$('input[name="item_check[]"]').each(function () {
				if ($(this).attr('checked')) {
					var comma = '';
					if (($('#idlist').val()).length > 0) {
						comma = ',';
					}

					$('#idlist').val($('#idlist').val() + comma + $(this).val());
				}
			});

			//document.forms['location_setting'].submit();
			dialogBox('confirm', '<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?>', '', 'location_setting' , 180, '<?=system_showText(LANG_SITEMGR_OK);?>', '<?=system_showText(LANG_SITEMGR_CANCEL);?>');
			return true;
		}
		-->
		</script>

		<? if ($error_msg) { ?>
			<p class="errorMessage"><?=$error_msg;?></p>
		<? } else if ($success_msg) { ?>
			<p class="successMessage"><?=$success_msg;?></p>
		<? } ?>

		<? if (string_strpos($url_base, "/sitemgr")) { ?>
			<table class="bulkTable" border="0" cellpadding="2" cellspacing="2" >
				<tr>
					<td><a class="bulkUpdate" href="javascript:void(0)" onclick="showBulkUpdate( <?=RESULTS_PER_PAGE?>, 'location', '<?=system_showText(LANG_SITEMGR_CLOSE_BULK);?>', '<?=system_showText(LANG_SITEMGR_BULK_UPDATE);?>')" id="open_bulk"><?=system_showText(LANG_SITEMGR_BULK_UPDATE);?></a></td>
				</tr>
			</table>
		<? } ?>

		<form name="location_setting" id="location_setting" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">
			<div id="table_bulk" style="display: none">
			<table cellspacing="0" cellpadding="0" border="0" align="center" class="standard-table"> <?

				$dbMain = db_getDBObject(DEFAULT_DB, true);

				$_aux_loc = explode(",", EDIR_LOCATIONS);

				if ($_GET["location_".$_aux_loc[0]]) {
					if ($_aux_loc[0] == $_location_father_level) {
						$sqlLoc = "SELECT * FROM `Location_$_location_father_level`";
					} else {
						$sqlLoc = "SELECT * FROM `Location_$_location_father_level` WHERE `location_".$_aux_loc[0]."` = ".$_GET["location_".$_aux_loc[0]];
					}
				} else {
					$sqlLoc = "SELECT * FROM `Location_$_location_father_level`";
				}
				$resLoc = $dbMain->Query($sqlLoc);
				while ($rowLoc = mysql_fetch_assoc($resLoc)) {
					${"_select_locations".$_location_father_level}[] = $rowLoc;
				}
				?>
					<tr>
						<th>
							<?=system_showText(constant("LANG_SITEMGR_CHANGE"))?> <?=system_showText(constant("LANG_SITEMGR_LOCATION_".constant("LOCATION".$_location_father_level."_SYSTEM")))?>:
						</th>

						<td style="width: auto;">
							<?

							$_aux_up_key = array_search($_location_father_level, $_aux_loc) - 1;
							$_new_up_loc_level = $_aux_loc[$_aux_up_key];

							if ($_new_up_loc_level) {

								if ($_GET["location_".$_aux_loc[0]]) {
									if ($_aux_loc[0] == $_new_up_loc_level) {
										$sqlLoc = "SELECT * FROM `Location_$_new_up_loc_level` WHERE `id` = ".$_GET["location_".$_aux_loc[0]];
									} else {
										$sqlLoc = "SELECT * FROM `Location_$_new_up_loc_level` WHERE `location_".$_aux_loc[0]."` = ".$_GET["location_".$_aux_loc[0]];
									}
								} else {
									$sqlLoc = "SELECT * FROM `Location_$_new_up_loc_level`";
								}
								$resLoc = $dbMain->Query($sqlLoc);
								while ($rowLoc = mysql_fetch_assoc($resLoc)) {
									${"_select_locations".$_new_up_loc_level}[] = $rowLoc;
								}
							}

							if (${"_select_locations".$_new_up_loc_level}) {
								$selectBox = "<select name=\"location_father_id\">";
								$selectBox .= "<option value=\"0\">-- " . constant("LANG_LABEL_SELECT_".constant("LOCATION".$_location_father_level."_SYSTEM")) . " --</option>";
								foreach (${"_select_locations".$_new_up_loc_level} as $k=>$each_location) {
									$selectBox .= "<optgroup label=\"".$each_location["name"]."\">";

									$nLocs = 0;
									foreach (${"_select_locations".$_location_father_level} as $each_loc_child) {
										if ($each_loc_child["location_$_new_up_loc_level"] == $each_location["id"]) {
											$selectBox .= "<option value=\"".$each_loc_child["id"]."\">".$each_loc_child["name"]."</option>";
											unset(${"_select_locations".$_new_up_loc_level}[$k]);
											$nLocs++;
										}
									}

									if (!$nLocs) {
										$selectBox .= "<option disabled>".system_showText(LANG_SITEMGR_EMPTY)."</option>";
									}
									$selectBox .= "</optgroup>";
								}
								$selectBox .= "</select>";

								echo $selectBox;
							} else if (${"_select_locations".$_location_father_level}) {
								$selectBox = "<select name=\"location_father_id\">";
								foreach (${"_select_locations".$_location_father_level} as $each_loc_child) {
									if ($each_loc_child["location_$_new_up_loc_level"] == $each_location["id"]) {
										$selectBox .= "<option value=\"".$each_loc_child["id"]."\">".$each_loc_child["name"]."</option>";
										unset(${"_select_locations".$_new_up_loc_level}[$k]);
									}
								}
								$selectBox .= "</select>";

								echo $selectBox;
							}
							?>
						</td>
					</tr>
			</table>
			<?
				$_aux_loc_level = explode(",", EDIR_LOCATIONS);
				$_aux_key = array_search($_location_father_level, $_aux_loc_level) + 1;
				$_new_location_child_level = $_aux_loc_level[$_aux_key];
			?>
			<div class="baseForm">
				<input type="hidden" name="location_father_level" id="location_father_level" value="<?=$_location_father_level;?>"/>
				<input type="hidden" name="location_child_level" id="location_child_level" value="<?=$_new_location_child_level;?>"/>
				<input type="hidden" name="hiddenValue" />
				<div id="idlist"></div>
				<button class="input-button-form" type="button" name="bt_operation_submit" id="bt_operation_submit" value="<?=system_showText(LANG_BUTTON_SUBMIT)?>" onclick="doSubmitChangeFather()" class="input-button-form2"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
			</div>
			<br />
			</div>
		</form>
		<br />
		<div id="bulk_check" style="display:none">
			<table class="bulkTable" border="0" cellpadding="2" cellspacing="2">
				<tr>
					<th><input type="checkbox" id="check_all" name="check_all" onclick="checkAll('location', document.getElementById('check_all'), false, <?=$itemCount;?>);" /></th>
					<td><a class="CheckUncheck" href="javascript:void(0);" onclick="checkAll('location', document.getElementById('check_all'), true, <?=$itemCount;?>);"><?=system_showText(LANG_CHECK_UNCHECK_ALL);?></a></td>
				</tr>
			</table>
		</div>
<? } ?>