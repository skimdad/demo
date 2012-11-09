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
	# * FILE: /includes/forms/form_socialnetwork.php
	# ----------------------------------------------------------------------------------------------------

	$modules = array("general", "listing", "event", "classified", "article", "promotion");
?>
<input type="hidden" id="settingSection" name="settingSection" value="<?=!$settingSection? $modules[0]."_setting_title": $settingSection; ?>"/>

<? if ($settingSection) { ?>
	<p class="successMessage">
		<?=system_showText(LANG_SITEMGR_SN_SUCCESS_MESSAGE);?>
	</p>
<? } ?>

	<?
	foreach($modules as $module){
		if($module == "general" || $module == "listing"){
			?>
			<table id="<?=$module?>_setting_title" onclick="showSettings(this.id);" class="standard-table">
			<tr class="standard-tabletitle-parent">
				<th class="standard-tabletitle">
					<?=ucfirst(constant("LANG_SITEMGR_".string_strtoupper($module)."_SETTINGS"));?>
				</th>
			</tr>
			</table>
			<div id="<?=$module?>_setting" class="defaultItems">
				<table class="standard-table left-table">
					<?
					$settings = $socialObj->getSectionSettings($module, SELECTED_DOMAIN_ID);
					$cSetting = count($settings);
					$allCheck = true;
					foreach($settings as $key => $setting){
						unset($check);
						if($setting->getString("value") == "yes"){
							$check = "checked";
						} else {
							$allCheck = false;
						}
						?>

						<? if (($key % 2) == 0) echo "<tr>"; ?>

						<th>
							<input type="checkbox" name="<?=$setting->getString("name");?>" <?=$check?> value="yes" align="absmiddle" class="inputCheck" />
						</th>
						<td class="td-form">
							<div class="label-form"><?=constant($setting->getString("label"));?></div>
						</td>

						<? if (($key % 2) != 0) echo "</tr>"; ?>
					<? } ?>
					<? if ($cSetting > 1) { ?>
						<tr><th colspan="4"><div class="divisor"></div><th/></tr>
						<tr>
							<th>
								<input type="checkbox" id="<?=$module?>_setting_check" name="<?=$module?>_setting_check" <?= $allCheck? "checked": ""; ?> onclick="manageAll(this.id);" align="absmiddle" class="inputCheck" />
							</th>
							<td>
								<a href="javascript:void(0);" onclick="manageAll('<?=$module?>_setting_check', 'link');">(<?=system_showText(LANG_CHECK_UNCHECK_ALL);?>)</a>
							</td>
						</tr>
					<? } ?>
					</table>
				</div>
			<?
		} else {
			if (constant(string_strtoupper($module)."_FEATURE") == "on" && constant("CUSTOM_".string_strtoupper($module)."_FEATURE") == "on") { ?>
				<table  id="<?=$module?>_setting_title" onclick="showSettings(this.id);" class="standard-table">
				<tr class="standard-tabletitle-parent">
					<th class="standard-tabletitle">
						<?=ucfirst(constant("LANG_SITEMGR_".string_strtoupper($module)."_SETTINGS"));?>
					</th>
				</tr>
				</table>
				<div id="<?=$module?>_setting" class="defaultItems">
					<table class="standard-table">
						<?
						$settings = $socialObj->getSectionSettings($module, SELECTED_DOMAIN_ID);
						$cSetting = count($settings);
						$allCheck = true;
						foreach($settings as $key => $setting){
							unset($check);
							if($setting->getString("value") == "yes"){
								$check = "checked";
							} else {
								$allCheck = false;
							}
							?>
							<? if (($key % 2) == 0) echo "<tr>"; ?>

							<th>
								<input type="checkbox" name="<?=$setting->getString("name");?>" <?=$check?> value="yes" align="absmiddle" class="inputCheck" />
							</th>
							<td class="td-form">
								<div class="label-form"><?=constant($setting->getString("label"));?></div>
							</td>

							<? if (($key % 2) != 0) echo "</tr>"; ?>
						<? } ?>
						<? if ($cSetting > 1) { ?>
							<tr><th colspan="4"><div class="divisor"></div><th/></tr>
							<tr>
								<th>
									<input type="checkbox" id="<?=$module?>_setting_check" name="<?=$module?>_setting_check" <?= $allCheck? "checked": ""; ?> onclick="manageAll(this.id);" align="absmiddle" class="inputCheck" />
								</th>
								<td>
									<a href="javascript:void(0);" onclick="manageAll('<?=$module?>_setting_check', 'link');">(<?=system_showText(LANG_CHECK_UNCHECK_ALL);?>)</a>
								</td>
							</tr>
						<? } ?>
					</table>
				</div>
			<? }
		}
	}
	?>
	<div class="divisor"></div>
	
<script type="text/javascript">
	function showSettings(id){
		var modules = '<?=implode(",", $modules);?>';
		modules = modules.split(",");
		var click = "#" + id;
		click = click.substr(0, (click.length - 6));
		var mod = "";
		for(var i = 0; i < modules.length; i++){
			mod = "#" + modules[i] + "_setting";
			if (mod != click) {
				if($(mod).css("display") != "none"){
					$(mod).hide('blind','', 500);
				}
				$(mod + "_title").css('cursor', 'pointer');
				$(mod + "_title tr th").removeClass('active');
				$(mod + "_span").fadeTo("slow", 0);
			} else {
				if($(click).css("display") == "none"){
					$(click).show('blind','', 500);
				}
				$(mod + "_title tr th").addClass('active');
				$("#" + id).css('cursor', '');
				$(click + "_span").fadeTo("slow", 1);
				$("#settingSection").val(id);
			}
		}
	}

	function manageAll(id, type){

		var check = $('#' + id).attr('checked');
		if (type == 'link') {
			if (check) {
				$('#' + id).attr('checked', '');
			} else {
				$('#' + id).attr('checked', 'checked');
			}
		}
		check = $('#' + id).attr('checked');

		var click = "#" + id;
		click = click.substr(0, (click.length - 6));
		$(click).find('input[type=checkbox]').attr("checked", check);
	}

	showSettings($("#settingSection").val());
</script>