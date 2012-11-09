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
	# * FILE: /includes/forms/form_import.php
	# ----------------------------------------------------------------------------------------------------

	//Tabs controler
	unset($array_edir_import);
	unset($import_numbers);
	$num_import = 1;
	
	$array_edir_import[] = LANG_LISTING_FEATURE_NAME_PLURAL;
	if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on"){
		$array_edir_import[] = LANG_EVENT_FEATURE_NAME_PLURAL;
		$num_import++;
	}
	$import_numbers[] = "0";
	if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on"){
		$import_numbers[] = "1";
	}
	$labelsuffix = "";

?>

	<script language="javascript" type="text/javascript">
	
		function showImportFields(type1, num_import, imports) {

			var arrImportNumbers = ('0,1').split(',');

			for (j=0;j<imports;j++) {
				i = arrImportNumbers[j];
				jQuery('#'+type1+'_'+i).css('display', 'none');
				//jQuery('#submit_'+i).css('display', 'none');
				jQuery('#tab_'+type1+'_'+i).removeClass("tabActived");
			}    
			jQuery('#'+type1+'_'+num_import).css('display', '');
			//jQuery('#submit_'+num_import).css('display', '');
			jQuery('#tab_'+type1+'_'+num_import).addClass("tabActived");

		}

	</script>
	
	<? if ($message_imports) { ?>
		<div id="warning" class="<?=$message_style?>"><?=$message_imports?></div>
	<? } ?>

	<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
		
		<tr>
			<th class="tabsBase">
				<ul class="tabs">
					<? foreach ($import_numbers as $k=>$i) { ?>
						<li id="tab_importInfo_<?=$i?>" <?=(($k == 0 && !$_GET["type"]) || ($k==1 && $_GET["type"] == "event")) ? "class=\"tabActived\"" : ""?>><a href="javascript:void(0)" onclick="showImportFields('importInfo', '<?=$i?>', '<?=$num_import?>')"><?=$array_edir_import[$k]?></a></li>
					<? } ?>
				</ul>
			</th>
		</tr>

	</table>

	<!-- LISTINGS -->
	<div id="importInfo_0" <?=$_GET["type"] == "event" ? "style=\"display:none\"" : ""?>>
		<div class="header-form"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_IMPORTSETTINGS." - ".LANG_LISTING_FEATURE_NAME_PLURAL)?></div>

		

		<?  // Account Search Javascript /////////////////////////////////////////////////////// ?>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>
		<script type="text/javascript">
			function JS_ShowHideAccount() {
				if (document.getElementById('import_sameaccount').checked) document.getElementById('import_account_id').style.display = "";
				else document.getElementById('import_account_id').style.display = "none";
			}
		</script>
		<table cellpadding="2" cellspacing="0" class="table-form table-form-settings table-form-margin">
			<tr>
				<td align="right" class="td-form"><div class="label-form"><?=system_showText(LANG_SITEMGR_IMPORT_FROMEXPORT)?></div></td>
				<td align="left" class="td-form">
					<input type="checkbox" id="import_from_export" name="import_from_export" value="1" align="absmiddle" <?=$import_from_export?> style="width: auto; border: 0;" class="inputCheck" />
				</td>
			</tr>
			<tr>
				<td align="right" class="td-form"><div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_ALLASACTIVE)?></div></td>
				<td align="left" class="td-form">
					<input type="checkbox" id="import_enable_listing_active" name="import_enable_listing_active" value="1" align="absmiddle" <?=$import_enable_listing_active?> style="width: auto; border: 0;" class="inputCheck" />
				</td>
			</tr>
			<tr>
				<td align="right" class="td-form"><div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_UPDATE)?></div></td>
				<td align="left" class="td-form">
					<input type="checkbox" id="import_update_listings" name="import_update_listings" value="1" align="absmiddle" <?=$import_update_listings?> style="width: auto; border: 0;" class="inputCheck" />
				</td>
			</tr>
			<tr>
				<td align="right" class="td-form"><div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_AUTOMATIC_START)?></div></td>
				<td align="left" class="td-form">
					<input type="checkbox" id="import_automatic_start" name="import_automatic_start" value="1" align="absmiddle" <?=$import_automatic_start?> style="width: auto; border: 0;" class="inputCheck" />
				</td>
			</tr>
			<tr>
				<td align="right" class="td-form"><div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_FEATURED_CATEGS)?></div></td>
				<td align="left" class="td-form">
					<input type="checkbox" id="import_featured_categs" name="import_featured_categs" value="1" align="absmiddle" <?=$import_featured_categs?> style="width: auto; border: 0;" class="inputCheck" />
				</td>
			</tr>
			<tr>
				<td align="right" class="td-form"><div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_DEFAULTLEVEL)?></div></td>
				<td align="left" class="td-form">
					<select name="import_defaultlevel" style="width: 150px;">
					<?
					$levelObj = new ListingLevel();
					$levelvalues = $levelObj->getLevelValues();
					foreach ($levelvalues as $levelvalue) {
						if ($import_defaultlevel==$levelvalue)
							$selected=" selected=\"selected\"";
						else $selected="";
						echo "<option value=\"".$levelvalue."\" $selected>".$levelObj->showLevel($levelvalue)."</option> ";
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right" class="td-form"><div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_SAMEACCOUNT)?></div></td>
				<td align="left" class="td-form"><input type="checkbox" id="import_sameaccount"  name="import_sameaccount" value="1"  align="absmiddle" <?=$import_sameaccount?> style="width: auto; border: 0;" class="inputCheck" onclick="JS_ShowHideAccount();"/></td>
			</tr>
		</table>

		<div id="import_account_id" class="base-table-form-account" <?=($import_sameaccount!="checked") ? "style=\"display:none;\"" : ""?>>
			<? // Account Search ////////////////////////////////////////////////////////////////// ?>
				<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
					<tr>
						<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_TOACCOUNT)?> <span><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_TOACCOUNT_SPAN)?></span></th>
					</tr>
				</table>
				<?
				$acct_search_table_title = system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECT_DEFAULT);
				$acct_search_field_name = "account_id";
				$acct_search_field_value = $account_id;
				$acct_search_required_mark = false;
				$acct_search_form_width = "95%";
				$acct_search_cell_width = "";
				$return = system_generateAjaxAccountSearch($acct_search_table_title, $acct_search_field_name, $acct_search_field_value, $acct_search_required_mark, $acct_search_form_width, $acct_search_cell_width);
				echo $return;
				?>
			<? //////////////////////////////////////////////////////////////////////////////////// ?>
		</div>
	</div>

	<? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {?>
		<!-- EVENTS -->
		<div id="importInfo_1" <?=$_GET["type"] == "event" ? "" : "style=\"display:none\""?>>
			<div class="header-form"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_IMPORTSETTINGS." - ".LANG_EVENT_FEATURE_NAME_PLURAL)?></div>

			<?  // Account Search Javascript /////////////////////////////////////////////////////// ?>
			<script type="text/javascript">
				function JS_ShowHideAccountEvent() {
					if (document.getElementById('import_sameaccount_event').checked) document.getElementById('import_account_id_event').style.display = "";
					else document.getElementById('import_account_id_event').style.display = "none";
				}
			</script>
			<table cellpadding="2" cellspacing="0" class="table-form table-form-settings table-form-margin">
				<tr>
					<td align="right" class="td-form"><div class="label-form"><?=system_showText(LANG_SITEMGR_IMPORT_FROMEXPORT)?></div></td>
					<td align="left" class="td-form">
						<input type="checkbox" id="import_from_export_event" name="import_from_export_event" value="1" align="absmiddle" <?=$import_from_export_event?> style="width: auto; border: 0;" class="inputCheck" />
					</td>
				</tr>
				<tr>
					<td align="right" class="td-form"><div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_ALLASACTIVE)?></div></td>
					<td align="left" class="td-form">
						<input type="checkbox" id="import_enable_event_active" name="import_enable_event_active" value="1" align="absmiddle" <?=$import_enable_event_active?> style="width: auto; border: 0;" class="inputCheck" />
					</td>
				</tr>
				<tr>
					<td align="right" class="td-form"><div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_UPDATE)?></div></td>
					<td align="left" class="td-form">
						<input type="checkbox" id="import_update_events" name="import_update_events" value="1" align="absmiddle" <?=$import_update_events?> style="width: auto; border: 0;" class="inputCheck" />
					</td>
				</tr>
				<tr>
					<td align="right" class="td-form"><div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_AUTOMATIC_START)?></div></td>
					<td align="left" class="td-form">
						<input type="checkbox" id="import_automatic_start_event" name="import_automatic_start_event" value="1" align="absmiddle" <?=$import_automatic_start_event?> style="width: auto; border: 0;" class="inputCheck" />
					</td>
				</tr>
				<tr>
					<td align="right" class="td-form"><div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_FEATURED_CATEGS)?></div></td>
					<td align="left" class="td-form">
						<input type="checkbox" id="import_featured_categs_event" name="import_featured_categs_event" value="1" align="absmiddle" <?=$import_featured_categs_event?> style="width: auto; border: 0;" class="inputCheck" />
					</td>
				</tr>
				<tr>
					<td align="right" class="td-form"><div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_DEFAULTLEVEL)?></div></td>
					<td align="left" class="td-form">
						<select name="import_defaultlevel_event" style="width: 150px;">
						<?
						$levelObj = new EventLevel();
						$levelvalues = $levelObj->getLevelValues();
						foreach ($levelvalues as $levelvalue) {
							if ($import_defaultlevel_event==$levelvalue)
								$selected=" selected=\"selected\"";
							else $selected="";
							echo "<option value=\"".$levelvalue."\" $selected>".$levelObj->showLevel($levelvalue)."</option> ";
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right" class="td-form"><div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_SAMEACCOUNT)?></div></td>
					<td align="left" class="td-form"><input type="checkbox" id="import_sameaccount_event"  name="import_sameaccount_event" value="1"  align="absmiddle" <?=$import_sameaccount_event?> style="width: auto; border: 0;" class="inputCheck" onclick="JS_ShowHideAccountEvent();"/></td>
				</tr>
			</table>

			<div id="import_account_id_event" class="base-table-form-account" <?=($import_sameaccount_event!="checked") ? "style=\"display:none;\"" : ""?>>
				<? // Account Search ////////////////////////////////////////////////////////////////// ?>
					<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
						<tr>
							<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_TOACCOUNT)?> <span><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_TOACCOUNT_SPAN)?></span></th>
						</tr>
					</table>
					<?
					$acct_search_table_title = system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECT_DEFAULT);
					$acct_search_field_name = "account_id_event";
					$acct_search_field_value = $account_id_event;
					$acct_search_required_mark = false;
					$acct_search_form_width = "95%";
					$acct_search_cell_width = "";
					$return = system_generateAjaxAccountSearch($acct_search_table_title, $acct_search_field_name, $acct_search_field_value, $acct_search_required_mark, $acct_search_form_width, $acct_search_cell_width, 0, true);
					echo $return;
					?>
				<? //////////////////////////////////////////////////////////////////////////////////// ?>
			</div>
		</div>
	<? } ?>