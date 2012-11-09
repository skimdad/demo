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
	# * FILE: /sitemgr/import/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	extract($_GET);
	extract($_POST);

	//increases frequently actions
	system_setFreqActions('import_home','import');

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# FORM DEFINES
	# ----------------------------------------------------------------------------------------------------
	//Listing
	$levelObj = new ListingLevel();
	$levelvalues = $levelObj->getLevelValues();
	setting_get("import_from_export", $import_from_export);
	setting_get("import_enable_listing_active", $import_enable_listing_active);
	setting_get("import_update_listings", $import_update_listings);
	setting_get("import_automatic_start", $import_automatic_start);
	setting_get("import_featured_categs", $import_featured_categs);
	setting_get("import_defaultlevel", $import_defaultlevel);
	setting_get("import_sameaccount", $import_sameaccount);
	setting_get("import_account_id", $import_account_id);
	
	if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on"){
		//Event
		$levelEventObj = new EventLevel();
		$levelEventvalues = $levelEventObj->getLevelValues();
		setting_get("import_from_export_event", $import_from_export_event);
		setting_get("import_enable_event_active", $import_enable_event_active);
		setting_get("import_update_events", $import_update_events);
		setting_get("import_automatic_start_event", $import_automatic_start_event);
		setting_get("import_featured_categs_event", $import_featured_categs_event);
		setting_get("import_defaultlevel_event", $import_defaultlevel_event);
		setting_get("import_sameaccount_event", $import_sameaccount_event);
		setting_get("import_account_id_event", $import_account_id_event);
	}
	
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

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

<style>
	#TB_window { padding: 15px 0 !important; }
</style>

<script language="javascript" type="text/javascript">
	
	function showImportFields(type1, num_import, imports) {
        
        var arrImportNumbers = ('0,1').split(',');

        for (j=0;j<imports;j++) {
			i = arrImportNumbers[j];
			jQuery('#'+type1+'_'+i).css('display', 'none');
			jQuery('#tab_'+type1+'_'+i).removeClass("tabActived");
        }    
		jQuery('#'+type1+'_'+num_import).css('display', '');
		jQuery('#tab_'+type1+'_'+num_import).addClass("tabActived");
		
    }
    
    function openWindow(url){
        $("#import_window").attr("href", url);
        $("#import_window").trigger('click');
    }
	
</script>

<a href="#" id="import_window" class="iframe fancy_window_import" style="display:none"></a>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=string_ucwords(LANG_SITEMGR_NAVBAR_DATA_MANAGEMENT);?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include (INCLUDES_DIR."/tables/table_data_submenu.php"); ?>
			
			<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
		
				<tr>
					<th class="tabsBase">
						<ul class="tabs">
							<? foreach ($import_numbers as $k=>$i) { ?>
								<li id="tab_importInfo_<?=$i?>" <?=($k == 0) ? "class=\"tabActived\"" : ""?>><a href="javascript:void(0)" onclick="showImportFields('importInfo', '<?=$i?>', '<?=$num_import?>')"><?=$array_edir_import[$k]?></a></li>
							<? } ?>
						</ul>
					</th>
				</tr>
				
			</table>
			
			<!-- LISTINGS -->
			
			<div id="importInfo_0">
				<div id="header-export"><?=system_showText(LANG_SITEMGR_IMPORT_LISTINGS);?></div>

				<p class="data-title"><?=system_showText(LANG_SITEMGR_IMPORT_REMEMBER)?></p>
				<table class="standard-table import-table">
					<tr>
						<td class="standard-tablenote" style="text-align: justify;">
							<?
							if ($import_from_export) {
							?>
							<b><?=system_showText(string_substr(LANG_SITEMGR_IMPORT_FROMEXPORT, 0, -1))?>.</b><br /><?
							}
							?>
							<?
							if ($import_enable_listing_active) {
								?><?=system_showText(LANG_SITEMGR_IMPORT_ALLIMPORTEDASACTIVE)?><br /><?
							}
							?>
							<?
							if ($import_update_listings) {
								?><?=system_showText(LANG_SITEMGR_IMPORT_ALLIMPORTEDUPDATED)?><br /><?
							}
							?>
							<?
							if ($import_automatic_start) {
								?><?=system_showText(LANG_SITEMGR_IMPORT_AUTOMATICSTARTS)?><br /><?
							}
							?>
							<?
							if ($import_featured_categs) {
								?><?=system_showText(LANG_SITEMGR_IMPORT_FEATURED_CATEGS)?><br /><?
							}
							?>
							<?=system_showText(LANG_SITEMGR_IMPORT_DEFAULTLEVELSETTO)?> <?=$levelObj->showLevel($import_defaultlevel)?>.<br />
							<?
							if ($import_sameaccount) {
								$sameAccountObj = new Account($import_account_id);
								?><?=system_showText(LANG_SITEMGR_IMPORT_IMPORTEDSAMEACCOUNT)?> <b><?=$sameAccountObj->getString('username')?>.</b><br /><?
							} else {
								?><?=system_showText(LANG_SITEMGR_IMPORT_LISTINGWILLBEASSOCIATESEPARATEACCOUNT)?><br /><?
							}
							?>
						</td>
					</tr>
					<tr>
						<td class="button-box">
							<button type="button" class="input-button-form" onclick="openWindow('<?=DEFAULT_URL?>/sitemgr/import/import.php')"><?=system_showText(LANG_SITEMGR_IMPORT_CLICKHERE_TOIMPORTFILE)?></button>
							<a href="<?=DEFAULT_URL?>/sitemgr/import/settings.php" class="standardLINK"><?=system_showText(LANG_SITEMGR_IMPORT_CLICKHERE_TOCHANGETHESESETTINGS)?></a>
						</td>
					</tr>
				</table>

				<p class="data-title"><?=system_showText(LANG_SITEMGR_FILES_CSV);?></p>
				<table class="standard-table import-tip import-table">
					<tr>
						<td class="standard-tablenote" style="text-align: justify;">
							<a href="<?=DEFAULT_URL;?>/sitemgr/faq/faq.php?keyword=<?=urlencode("import");?>" target="_blank"><?=system_showText(LANG_SITEMGR_IMPORT_HOMETIP1_3)?></a><br />
							<?=system_showText(LANG_SITEMGR_DOWNLOAD_TEMPLATE);?>
						</td>
					</tr>
					<tr>
						<td class="button-box">
							<form name="importsample" action="importsample.php" method="post" target="_blank">
								<button type="submit" class="input-button-form input-largebutton-form"><?=system_showText(LANG_SITEMGR_DOWNLOAD_TEMPLATE2);?></button>
								<a href="<?=DEFAULT_URL?>/sitemgr/import/instructions.php" class="standardLINK iframe fancy_window"><?=system_showText(LANG_SITEMGR_DOWNLOAD_MORE_INFO);?></a>
							</form>
						</td>
					</tr>
				</table>
			</div>
			
			<? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
				<!-- EVENTS -->
				<div id="importInfo_1" style="display:none">
					<div id="header-export"><?=system_showText(LANG_SITEMGR_IMPORT_EVENTS);?></div>

					<p class="data-title"><?=system_showText(LANG_SITEMGR_IMPORT_REMEMBER)?></p>
					<table class="standard-table import-table">
						<tr>
							<td class="standard-tablenote" style="text-align: justify;">
								<?
								if ($import_from_export_event) {
								?>
								<b><?=system_showText(string_substr(LANG_SITEMGR_IMPORT_FROMEXPORT, 0, -1))?>.</b><br /><?
								}
								?>
								<?
								if ($import_enable_event_active) {
									?><?=system_showText(LANG_SITEMGR_IMPORT_ALLIMPORTEDASACTIVE)?><br /><?
								}
								?>
								<?
								if ($import_update_events) {
									?><?=system_showText(LANG_SITEMGR_IMPORT_ALLIMPORTEDUPDATED)?><br /><?
								}
								?>
								<?
								if ($import_automatic_start_event) {
									?><?=system_showText(LANG_SITEMGR_IMPORT_AUTOMATICSTARTS)?><br /><?
								}
								?>
								<?
								if ($import_featured_categs_event) {
									?><?=system_showText(LANG_SITEMGR_IMPORT_FEATURED_CATEGS)?><br /><?
								}
								?>
								<?=system_showText(LANG_SITEMGR_IMPORT_DEFAULTLEVELSETTO)?> <?=$levelEventObj->showLevel($import_defaultlevel_event)?>.<br />
								<?
								if ($import_sameaccount_event) {
									$sameAccountObj = new Account($import_account_id_event);
									?><?=system_showText(LANG_SITEMGR_IMPORT_IMPORTEDSAMEACCOUNT)?> <b><?=$sameAccountObj->getString('username')?>.</b><br /><?
								} else {
									?><?=system_showText(LANG_SITEMGR_IMPORT_LISTINGWILLBEASSOCIATESEPARATEACCOUNT)?><br /><?
								}
								?>
							</td>
						</tr>
						<tr>
							<td class="button-box">
								<button type="button" class="input-button-form" onclick="openWindow('<?=DEFAULT_URL?>/sitemgr/import/import.php?import_type=event')"><?=system_showText(LANG_SITEMGR_IMPORT_CLICKHERE_TOIMPORTFILE)?></button>
								<a href="<?=DEFAULT_URL?>/sitemgr/import/settings.php?type=event" class="standardLINK"><?=system_showText(LANG_SITEMGR_IMPORT_CLICKHERE_TOCHANGETHESESETTINGS)?></a>
							</td>
						</tr>
					</table>

					<p class="data-title"><?=system_showText(LANG_SITEMGR_FILES_CSV);?></p>
					<table class="standard-table import-tip import-table">
						<tr>
							<td class="standard-tablenote" style="text-align: justify;">
								<a href="<?=DEFAULT_URL;?>/sitemgr/faq/faq.php?keyword=<?=urlencode("import");?>" target="_blank"><?=system_showText(LANG_SITEMGR_IMPORT_HOMETIP1_3)?></a><br />
								<?=system_showText(LANG_SITEMGR_DOWNLOAD_TEMPLATE);?>
							</td>
						</tr>
						<tr>
							<td class="button-box">
								<form name="importsample" action="importsample.php?type=event" method="post" target="_blank">
									<button type="submit" class="input-button-form input-largebutton-form"><?=system_showText(LANG_SITEMGR_DOWNLOAD_TEMPLATE2);?></button>
									<a href="<?=DEFAULT_URL?>/sitemgr/import/instructions.php?type=event" class="standardLINK iframe fancy_window"><?=system_showText(LANG_SITEMGR_DOWNLOAD_MORE_INFO);?></a>
								</form>
							</td>
						</tr>
					</table>
				</div>
			<? } ?>
		</div>

	</div>

	<div id="bottom-content">&nbsp;</div>
</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
