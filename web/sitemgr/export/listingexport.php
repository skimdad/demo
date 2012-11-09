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
	# * FILE: /sitemgr/export/listingexport.php
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

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	/*
	 * Check if export is running
	 */

	$db = db_getDBObject(DEFAULT_DB, true);
	$sql = "SELECT finished, filename FROM Control_Export_Listing WHERE domain_id = ".SELECTED_DOMAIN_ID." AND type= 'csv'";
	$result = $db->query($sql);
	if(mysql_num_rows($result)){
		$aux_export_running = mysql_fetch_assoc($result);
		$aux_download_file_name = $aux_export_running["filename"];
	}
	if($aux_export_running["finished"] == "N" && LISTING_SCALABILITY_OPTIMIZATION == "on"){
		$exportFile = $aux_export_running["filename"];
	}else{
	$exportFile = md5(uniqid(rand(), true)).".csv";
		if(LISTING_SCALABILITY_OPTIMIZATION == "on"){
			$old_export_file = $aux_export_running["filename"];
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

	<script language="javascript" type="text/javascript">
		var check_progress_time = 5*1000;
		var lastprogress = 0;
		function startExportProcess() {
			try {
				xmlhttp_startexportprocess = new XMLHttpRequest();
			} catch (e) {
				try {
					xmlhttp_startexportprocess = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try {
						xmlhttp_startexportprocess = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e) {
						xmlhttp_startexportprocess = false;
					}
				}
			}
			if (xmlhttp_startexportprocess) {
				xmlhttp_startexportprocess.open("GET", "./itemexportfile.php?export_type=listing&file=<?=$exportFile?>&domain_id=<?=SELECTED_DOMAIN_ID?>", true);
				xmlhttp_startexportprocess.send(null);
			}
		}
		function removeExportControl() {
			try {
				xmlhttp_removeexportcontrol = new XMLHttpRequest();
			} catch (e) {
				try {
					xmlhttp_removeexportcontrol = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try {
						xmlhttp_removeexportcontrol = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e) {
						xmlhttp_removeexportcontrol = false;
					}
				}
			}
			if (xmlhttp_removeexportcontrol) {
				xmlhttp_removeexportcontrol.open("GET", "./itemexportfile.php?export_type=listing&file=<?=$exportFile?>&removecontrol=true&domain_id=<?=SELECTED_DOMAIN_ID;?>", true);
				xmlhttp_removeexportcontrol.send(null);
			}
		}
		function checkExportProgress() {

			try {
				xmlhttp_checkexportprogress = new XMLHttpRequest();
			} catch (e) {
				try {
					xmlhttp_checkexportprogress = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try {
						xmlhttp_checkexportprogress = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e) {
						xmlhttp_checkexportprogress = false;
					}
				}
			}
			if (xmlhttp_checkexportprogress) {
				xmlhttp_checkexportprogress.onreadystatechange = function() {
					if (xmlhttp_checkexportprogress.readyState == 4) {
						if (xmlhttp_checkexportprogress.status == 200) {
							string_status = xmlhttp_checkexportprogress.responseText;
							current_progress = parseInt(string_status);
							<? if (LISTING_SCALABILITY_OPTIMIZATION != "on") {?>
							lastprogress = current_progress;
							<?} ?>
							if (isNaN(current_progress)) {
								<?
								if(LISTING_SCALABILITY_OPTIMIZATION == "on"){
									?>
									document.getElementById("export_message").innerHTML = string_status+"<br /><img src='<?=DEFAULT_URL?>/images/img_loading.gif' />";
									document.getElementById("export_progress").innerHTML = "0";
									document.getElementById("export_progress_percentage").innerHTML = "%";
									setTimeout("checkExportProgress()", check_progress_time);
									<?
								}else{
									?>
								document.getElementById("export_message").style.color = "#FF0000";
								document.getElementById("export_message").innerHTML = string_status;
								document.getElementById("export_progress").innerHTML = "&nbsp;";
								document.getElementById("export_progress_percentage").innerHTML = "&nbsp;";
								removeExportControl();
									<?
								}
								?>
							} else {
								<?
								if($aux_export_running["finished"] == "N" && LISTING_SCALABILITY_OPTIMIZATION == "on"){
									?>
									document.getElementById("export_message").innerHTML = "<?=system_showText(LANG_SITEMGR_EXPORT_WAITING_CRON)?><br /><img src='<?=DEFAULT_URL?>/images/img_loading.gif' />";
									document.getElementById("export_progress").innerHTML = current_progress;
									document.getElementById("export_progress_percentage").innerHTML = "%";
									<?
								}else{
									?>
									document.getElementById("export_progress").innerHTML = current_progress;
									<?
								}
								?>

								if (parseInt(document.getElementById("export_progress").innerHTML) >= 100) {
									document.getElementById("export_message").style.fontSize = "15px";
									document.getElementById("export_message").style.color = "#466E1E";
									document.getElementById("export_message").style.fontWeight = "bold";
									document.getElementById("export_message").innerHTML = "<?=system_showText(LANG_SITEMGR_EXPORT_EXPORTDONE).(LISTING_SCALABILITY_OPTIMIZATION == "on" ? " <br /><a href=".DEFAULT_URL."/sitemgr/export/exportfile.php?export_type=listing&filename=".$exportFile."&type=csv>".system_showText(LANG_SITEMGR_EXPORT_LASTFILE_MESSAGE)."</a>" : "");?>";
									document.getElementById("export_progress").innerHTML = "&nbsp;";
									document.getElementById("export_progress_percentage").innerHTML = "&nbsp;";
									removeExportControl();
								} else {
									setTimeout("checkExportProgress()", check_progress_time);
								}
							}
						} else {
							document.getElementById("export_message").style.color = "#FF0000";
							document.getElementById("export_message").innerHTML = "<?=system_showText(LANG_SITEMGR_EXPORT_EXPORTERROR)?><br /><?=system_showText(LANG_SITEMGR_EXPORT_PLEASETRYAGAIN)?>";
							document.getElementById("export_progress").innerHTML = "&nbsp;";
							document.getElementById("export_progress_percentage").innerHTML = "&nbsp;";
							removeExportControl();
						}
					}
				}
				xmlhttp_checkexportprogress.open("GET", "./itemexportcheck.php?export_type=listing&file=<?=$exportFile?>&lastprogress="+lastprogress+"&domain_id=<?=SELECTED_DOMAIN_ID?>", true);
				xmlhttp_checkexportprogress.send(null);
			} else {
				document.getElementById("export_message").style.color = "#FF0000";
				document.getElementById("export_message").innerHTML = "<?=system_showText(LANG_SITEMGR_EXPORT_EXPORTERROR)?><br /><?=system_showText(LANG_SITEMGR_EXPORT_PLEASETRYAGAIN)?>";
				document.getElementById("export_progress").innerHTML = "&nbsp;";
				document.getElementById("export_progress_percentage").innerHTML = "&nbsp;";
				removeExportControl();
			}
		}
		function startExport() {
			document.getElementById("export_message").innerHTML = "<?=system_showText(LANG_SITEMGR_EXPORT_EXPORTINGPLEASEWAIT)?><br /><img src='<?=DEFAULT_URL?>/images/img_loading.gif' />";
			document.getElementById("export_progress").innerHTML = "0";
			document.getElementById("export_progress_percentage").innerHTML = "%";
			startExportProcess();
			setTimeout("checkExportProgress()", check_progress_time);
		}
	</script>

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

				<div id="header-export"><?=system_showText(LANG_SITEMGR_EXPORT_TITLEEXPORTLISTINGSAMEFORMAT)?></div>

				<br /><br />

				<p class="informationMessage"><?=system_showText(LANG_SITEMGR_EXPORT_EXPORTLISTING_TIP)?></p>

				<br /><br />

				<p style="padding-top: 10px;"><strong><?=system_showText(LANG_SITEMGR_EXPORT_EXPORTITEM_AFTEREXPORTDONE)?></strong> <?=IMPORT_FOLDER_RELATIVE_PATH?></p>
				<?
				/*
				 * Check if SCALABILITY is " on " and if cron is running to show progress of export
				 */
				if($aux_export_running["finished"] == "N" && LISTING_SCALABILITY_OPTIMIZATION == "on"){
					?>
					<p style="padding-top: 10px;">
						<strong><?=system_showText(LANG_SITEMGR_EXPORT_EXPORTITEM_FILENAME)?></strong> <?=$exportFile?>
					</p>
					<br /><br />
					<p style="padding-top: 10px; text-align: center;">
						<span id="export_message"></span>
					</p>
					<p style="padding-top: 10px; text-align: center;">
						<span id="export_progress">&nbsp;</span>
						<span id="export_progress_percentage">&nbsp;</span>
					</p>
					<script type="text/javascript">
						setTimeout("checkExportProgress()", 500);
					</script>
					<?
				}else{

					?>
					<p style="padding-top: 10px;">
						<strong><?=system_showText(LANG_SITEMGR_EXPORT_EXPORTITEM_FILENAME)?></strong> <?=$exportFile?>
					</p>
					<br /><br />
					<p style="padding-top: 10px; text-align: center;">
						<span id="export_message">
							<a href="javascript:startExport();" class="standardLink" style="margin: 0; padding: 0; font-size: 15px;">
								<strong><?=system_showText(LANG_SITEMGR_EXPORT_CLICKHERETOSTART)?></strong><br /></a>
								<?
								if(LISTING_SCALABILITY_OPTIMIZATION == "on"){
									if ($old_export_file){
									?>
									<a href="<?=DEFAULT_URL."/sitemgr/export/exportfile.php?export_type=listing&filename=".$old_export_file."&type=csv"?>"><?=system_showText(LANG_SITEMGR_EXPORT_LASTFILE_MESSAGE)?></a>
									<?
									}
								}
								?>

						</span>
					</p>
					<p style="padding-top: 10px; text-align: center;">
						<span id="export_progress">&nbsp;</span>
						<span id="export_progress_percentage">&nbsp;</span>
					</p>
					<?
				}
				?>

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
