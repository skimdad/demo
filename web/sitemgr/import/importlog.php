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
	# * FILE: /sitemgr/import/importlog.php
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
	system_setFreqActions('import_log','import');

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	if ($_GET["import_type"] == "event"){
		include(INCLUDES_DIR."/code/import_event.php");
		$includeFile = "import_event.php";
		$importType = "event"; 
	} else {
		include(INCLUDES_DIR."/code/import.php");
		$includeFile = "import.php";
		$importType = "listing"; 
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

	$import = new ImportLog();
	$imports = $import->getImports($importType);
	
	//Tabs controler
	unset($array_edir_import);
	unset($import_numbers);
	$num_import = 1;
	
	$array_edir_import["listing"] = LANG_LISTING_FEATURE_NAME_PLURAL;
	if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on"){
		$array_edir_import["event"] = LANG_EVENT_FEATURE_NAME_PLURAL;
		$num_import++;
	}
	$import_numbers["listing"] = "0";
	if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on"){
		$import_numbers["event"] = "1";
	}
	$labelsuffix = "";

?>

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

			<div id="header-export"><?=system_showText(LANG_SITEMGR_IMPORT_IMPORTLOG)?></div>

			<div class="tip-base">
				<p style="text-align: justify;"><a href="<?=DEFAULT_URL;?>/sitemgr/faq/faq.php?keyword=<?=urlencode("import");?>" target="_blank"><?=system_showText(LANG_SITEMGR_IMPORT_HOMETIP1_3)?></a></p>
			</div>
			
			<br />
			
			<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
		
				<tr>
					<th class="tabsBase">
						<ul class="tabs">
							<? foreach ($import_numbers as $k=>$i) { ?>
								<li id="tab_importInfo_<?=$i?>" <?=($k == $importType) ? "class=\"tabActived\"" : ""?>><a href="<?=DEFAULT_URL."/sitemgr/import/importlog.php".($k != "listing" ? "?import_type=$k" : "" )?>" ><?=$array_edir_import[$k]?></a></li>
							<? } ?>
						</ul>
					</th>
				</tr>
				
			</table>

			<?
			if ($_GET["type"]) {
				$importObj = new ImportLog($_GET["log_id"]);
				$uploadname = $importObj->getString("filename");
				if (!$uploadname) $_GET["type"] = "0";
			}
			?>

			<div id="logMessages">
				<? if ($_GET["type"] == "1") { ?>
					<p class="successMessage"><?=system_showText(LANG_SITEMGR_IMPORT_SUCCESSUPLOADED1)?> "<?=$uploadname?>" <?=system_showText(LANG_SITEMGR_IMPORT_SUCCESSUPLOADED2)?></p>
				<? } else if ($_GET["type"] == "2") { ?>
					<p class="successMessage"><?=system_showText(LANG_SITEMGR_IMPORT_WILLBEIMPORTED1)?> "<?=$uploadname?>" <?=system_showText(LANG_SITEMGR_IMPORT_WILLBEIMPORTED2)?> <?=IMPORT_FOLDER_RELATIVE_PATH?> <?=system_showText(LANG_SITEMGR_IMPORT_WILLBEIMPORTED3)?></p>
				<? } ?>
			</div>
			
			<br class="clear" />

			<? if ($imports){ ?>

				<ul class="standard-iconDESCRIPTION">
					<li class="view-icon"><?=system_showText(LANG_SITEMGR_PREVIEW)?></li>
					<li class="rollback-icon"><?=system_showText(LANG_SITEMGR_IMPORT_ROLLBACK)?></li>
					<li class="stop-icon"><?=system_showText(LANG_SITEMGR_IMPORT_STOPIMPORT)?></li>
					<li class="delete-icon"><?=system_showText(LANG_SITEMGR_IMPORT_DELETELOG)?></li>
				</ul>

				<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE" >
					<tr>
						<th width="15px" nowrap="nowrap">&nbsp;</th>
						<th width="130px" nowrap="nowrap"><?=system_showText(LANG_SITEMGR_IMPORT_DATETIME)?></th>
						<th nowrap="nowrap"><?=system_showText(LANG_SITEMGR_IMPORT_FILENAME)?></th>
						<th width="85px" nowrap="nowrap"><?=system_showText(LANG_SITEMGR_IMPORT_TOTALLINES)?></th>
						<th width="85px" nowrap="nowrap"><?=system_showText(LANG_SITEMGR_IMPORT_ADDEDLINES)?></th>
						<th width="200px" nowrap="nowrap"><?=system_showText(LANG_SITEMGR_STATUS)?></th>
						<th width="50px" nowrap="nowrap"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
					</tr>
					<? foreach ($imports as $import) include (INCLUDES_DIR."/tables/table_import.php"); ?>
				</table>

			<? } else { ?>
				<p class="informationMessage"><?=system_showText(LANG_SITEMGR_IMPORT_LOGS_NORECORD)?></p>
			<? } ?>

		</div>
	</div>
	<div id="bottom-content">
		&nbsp;
	</div>
</div>

<a href="#" id="import_window" class="iframe fancy_window_import" style="display:none"></a>

<script type="text/javascript">

	function linkRedirect(url, fancybox){
		if (fancybox){
            $("#import_window").attr("href", url);
            $("#import_window").trigger('click');
		} else {
			window.location = url;
		}
	}

	var check_progress_time = 1*1000;
	var last_progress = 0;
	var current_import_id = 0;
	var last_progress_import_id = 0;
	var pending_imports = 0;

	checkRunningProgress();

	function checkRunningProgress(){
		$.post(DEFAULT_URL + "/includes/code/<?=$includeFile?>", {
			domain_id: <?=SELECTED_DOMAIN_ID?>,
			type: 'ajax',
			option: 'verify_import'
		}, function (ret) {
			var aRet = ret.split("||");
			if (aRet[0] != 'no pending process' && aRet[0] != 'waiting cron'){
				current_import_id = aRet[0];
				last_progress_import_id = aRet[0];
				last_progress = aRet[1];

				$("#label_id"+aRet[0]).html("");
				$("#span_stop_"+current_import_id).attr("src", DEFAULT_URL+"/images/icon_stop.gif");
				document.getElementById("span_stop_"+current_import_id).onclick = function() {
					linkRedirect('stop.php?import_type=<?=$importType?>&id='+current_import_id, false);
				}
				$("#span_stop_"+current_import_id).css("cursor", "pointer");

				$("#span_delete_"+current_import_id).attr("src", DEFAULT_URL+"/images/bt_delete_off.gif");
				$("#span_delete_"+current_import_id).attr("onclick", "");
				$("#span_delete_"+current_import_id).css("cursor", "default");

				$("#span_view_"+current_import_id).attr("src", DEFAULT_URL+"/images/bt_view_off.gif");
				$("#span_view_"+current_import_id).attr("onclick", "");
				$("#span_view_"+current_import_id).css("cursor", "default");

				$("#progresslabel_"+aRet[0]).html("<span class=\"status-running\"><?=system_showText(LANG_SITEMGR_IMPORT_RUNNING)?></span> - "+aRet[1]+"%");

				$("#progress_added_"+aRet[0]).html(aRet[2]);
				setTimeout("checkRunningProgress()", check_progress_time);

			} else {

				if (aRet[0] == "waiting cron"){
					pending_imports = aRet[1];
					last_progress_import_id = aRet[2];
					last_status = aRet[3];
					action = aRet[4];
				} else {
					last_progress_import_id = aRet[1];
					last_progress = aRet[2];
					pending_imports = aRet[3];
					last_status = aRet[4];
				}

				if (aRet[0] == 'waiting cron' && pending_imports >= 1){
					setTimeout("checkRunningProgress()", check_progress_time);
					if (document.getElementById("tdprogress_"+last_progress_import_id) && last_status == "F" && action != "NR"){
				
						$("#tdprogress_"+last_progress_import_id).html("<span class=\"status-finished\"><?=system_showText(LANG_SITEMGR_IMPORT_FINISHED)?></span>");
						$("#progress_added_"+last_progress_import_id).html(document.getElementById("total_lines_"+last_progress_import_id).innerHTML);

						$("#span_stop_"+last_progress_import_id).attr("src", DEFAULT_URL+"/images/icon_stop_off.gif");
						$("#span_stop_"+last_progress_import_id).attr("onclick", "");
						$("#span_stop_"+last_progress_import_id).css("cursor", "default");

						$("#span_rollback_"+last_progress_import_id).attr("src", DEFAULT_URL+"/images/icon_rollback.gif");
						document.getElementById("span_rollback_"+last_progress_import_id).onclick = function() {
							linkRedirect('rollback.php?import_type=<?=$importType?>&id='+last_progress_import_id, false);
						}
						$("#span_rollback_"+last_progress_import_id).css("cursor", "pointer");

						$("#span_view_"+last_progress_import_id).attr("src", DEFAULT_URL+"/images/bt_view_off.gif");
						$("#span_view_"+last_progress_import_id).attr("onclick", "");
						$("#span_view_"+last_progress_import_id).css("cursor", "default");
					}

				}else{
					current_import_id = aRet[1];
					last_progress_import_id = aRet[1];
					last_progress = aRet[2];

					if (aRet[0] == 'no pending process' && last_progress != 0 && current_import_id != 0 && aRet[4] == "F" && aRet[5] != "NR"){
						if (document.getElementById("tdprogress_"+current_import_id)){

							$("#tdprogress_"+last_progress_import_id).html("<span class=\"status-finished\"><?=system_showText(LANG_SITEMGR_IMPORT_FINISHED)?></span>");
							$("#progress_added_"+last_progress_import_id).html(document.getElementById("total_lines_"+last_progress_import_id).innerHTML);

							$("#span_stop_"+last_progress_import_id).attr("src", DEFAULT_URL+"/images/icon_stop_off.gif");
							$("#span_stop_"+last_progress_import_id).attr("onclick", "");
							$("#span_stop_"+last_progress_import_id).css("cursor", "default");

							$("#span_rollback_"+last_progress_import_id).attr("src", DEFAULT_URL+"/images/icon_rollback.gif");
							document.getElementById("span_rollback_"+last_progress_import_id).onclick = function() {
								linkRedirect('rollback.php?import_type=<?=$importType?>&id='+last_progress_import_id, false);
							}
							$("#span_rollback_"+last_progress_import_id).css("cursor", "pointer");

							$("#span_delete_"+last_progress_import_id).attr("src", DEFAULT_URL+"/images/bt_delete.gif");
							document.getElementById("span_delete_"+last_progress_import_id).onclick = function() {
								linkRedirect('delete.php?import_type=<?=$importType?>&id='+last_progress_import_id, false);
							}
							$("#span_delete_"+last_progress_import_id).css("cursor", "pointer");

							$("#span_view_"+last_progress_import_id).attr("src", DEFAULT_URL+"/images/bt_view_off.gif");
							$("#span_view_"+last_progress_import_id).attr("onclick", "");
							$("#span_view_"+last_progress_import_id).css("cursor", "default");
						}
						if (pending_imports > 1){
							setTimeout("checkRunningProgress()", check_progress_time);
						}
					}
				}
			}
			
		});
	}

</script>

	<?
	if ($log_id) {
		$import_logAux = new ImportLog($log_id);
		$total_lines = $import_logAux->getNumber("totallines");
		$file = $import_logAux->getString("phisicalname");
		$file = str_replace(".csv", "", $file);
		$checkTempTable = false;
		if (string_strpos($import_logAux->getString("history"), "LANG_MSG_IMPORT_CSVIMPORTEDTOTEMPORARYTABLE") !== false){
			$checkTempTable = true;
		}
		if (file_exists(IMPORT_FOLDER."/".$file.".txt") && !$checkTempTable){?>

			<script type="text/javascript">
				var check_progress_time = 1*5000;

				$(document).ready(function () {
					var file_name = '<?=$file?>';
					
					$.post(DEFAULT_URL + "/includes/code/<?=$includeFile?>", {
						domain_id: <?=SELECTED_DOMAIN_ID;?>,
						type: "ajax",
						option: "import_temporary",
						log_id: <?=$log_id?>,
						file_name: file_name
					}, function (res) {
						if (!res){ //sucess
							checkProgress();
						}
					});
				})

				function checkProgress() {
					$.post(DEFAULT_URL + "/includes/code/<?=$includeFile?>", {
						domain_id: <?=SELECTED_DOMAIN_ID;?>,
						type: 'ajax',
						option: 'verify_temporary',
						log_id: <?=$log_id?>,
						total_lines: <?=$total_lines?>
					}, function (ret) {
						var aRet = ret.split("||");
						if (aRet[1] == 0) {
							if (aRet[0]<100){
								document.getElementById("message_progress_<?=$log_id?>").innerHTML = "<?=system_showText(LANG_SITEMGR_IMPORT_IMPORTINGDATATOTEMPORARYTABLE)?><br /><img src='<?=DEFAULT_URL?>/images/img_loading.gif' />"+aRet[0]+"%";
								setTimeout("checkProgress()", check_progress_time);
							} else if (aRet[0]>=100) {
								$("#logMessages").append("<p class=\"successMessage\"><?=system_showText(LANG_MSG_IMPORT_CSVIMPORTEDTOTEMPORARYTABLE);?></p>");
							}
						} else {
							$("#logMessages").append("<p class=\"errorMessage\"><?=system_showText(LANG_MSG_IMPORT_ERRORONIMPORTTOTEMPABLE);?></p>");
						}
					});
				}
			</script>
		<?} else { ?>
			<script type="text/javascript">
				$(document).ready(function () {
					var log_id = '<?=$_GET["log_id"];?>';
					var preview = '<?=$_GET["preview"];?>';
					if (log_id && preview == "true") {
                        $("#import_window").attr("href", DEFAULT_URL + "/sitemgr/import/<?=$includeFile?>?id=" + log_id);
                        $("#import_window").trigger('click');
					}
				});
			</script>
		<? }
	}?>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
