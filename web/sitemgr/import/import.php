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
	# * FILE: /sitemgr/import/import.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	if ($_GET["import_type"] == "event"){
		include(INCLUDES_DIR."/code/import_event.php");
		$includeFile = "import_event.php";
		$label = LANG_EVENT_FEATURE_NAME_PLURAL;
	} else {
		include(INCLUDES_DIR."/code/import.php");
		$includeFile = "import.php";
		$label = LANG_LISTING_FEATURE_NAME_PLURAL;
	}

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>

		<script type="text/javascript">
			var DEFAULT_URL = '<?=DEFAULT_URL;?>';
		</script>

		<script type="text/javascript" src="<?=DEFAULT_URL;?>/scripts/jquery.js"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL;?>/scripts/jquery/jquery.csv2table.js"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL;?>/lang/<?=EDIR_LANGUAGE?>.js"></script>

		<link href="<?=DEFAULT_URL;?>/sitemgr/layout/general_sitemgr.css" rel="stylesheet" type="text/css"/>
		
	</head>
	
	<body class="import-body">
		<div class="wrapper import-wrapper">
			<div class="header-form">
				<?=string_ucwords(system_showText(LANG_SITEMGR_IMPORT." - ".$label));?>
			</div>

			<? if (!$_GET["id"]) { ?>
				<p class="informationMessage">
					<?
						if ($_GET["import_type"] == "event"){
							setting_get("import_update_events", $import_update);
						} else {
							setting_get("import_update_listings", $import_update);
						}

						$message = "";

						if (function_exists("mb_detect_encoding") && function_exists("mb_convert_encoding")) $message = system_showText(LANG_SITEMGR_MSG_IMPORT_CONVERT_UTF8);
						else $message = system_showText(LANG_SITEMGR_MSG_IMPORT_CHECK_UTF8);

						if ($import_update){
							$message = "&#149;&nbsp;".$message."<br />&#149;&nbsp;".system_showText(LANG_SITEMGR_MSG_IMPORT_UPDATE_ITENS);
						}

						echo $message;
					?>
				</p>

				<? if ($messageErrorUpload) { ?>
					<p class="errorMessage"><?=$messageErrorUpload;?></p>
				<? } ?>
				<p id="separator_message_id" class="errorMessage" style="display: none"><?=LANG_SITEMGR_IMPORT_INVALID_SEPARATOR?></p>
				<p id="cron_message" class="successMessage" style="<?=!$urlFileName && $ftp_type == "schedule_cron"? "" : "display: none;"; ?>"><?=system_showText(LANG_SITEMGR_IMPORT_CORRECTION_SCHEDULED);?></p>

                <div id="tools">
                    <form id ="importInfo" name="importInfo" action="<?=DEFAULT_URL."/".SITEMGR_ALIAS;?>/import/import.php?import_type=<?=$_GET["import_type"]?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="type" name="type" value="<?=$type? $type: "upload"?>"/>
                        <input type="hidden" id="ftp_type" name="ftp_type" value="correct"/>
                        <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
                            <tr>
                                <td class="tabsLang" colspan="2">
                                    <ul>
                                        <li id="tab_upload" <?=($type == "upload" || !$type? "class=\"tabActived\"": "");?>>
                                            <a href="javascript:void(0);" onclick="changeFileForm('upload', false, false);"><?=system_showText(LANG_SITEMGR_UPLOAD_FILE);?></a>
                                        </li>
                                        <li id="tab_select" <?=($type == "select"? "class=\"tabActived\"": "");?>>
                                            <a href="javascript:void(0);" onclick="changeFileForm('select', '<?=$file_name;?>', false);"><?=system_showText(LANG_SITEMGR_SELECT_FILE);?></a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr id="uploadFile">
                                <td class="tools-table">  
                                    <p><b><?=system_showText(LANG_SITEMGR_FILES_CSV);?></b></p>
                                    <p><b><?=system_showText(LANG_SITEMGR_IMPORT_UPLOAD_YOURCSVFILEUSINGTHEFORMBELOW);?></b></p>
                                    <p class="import-allow"><?=system_showText(LANG_SITEMGR_IMPORT_MAXFILESIZE_ALLOWED)?> <?=MAX_MB_FILE_SIZE_ALLOWED;?> MB.</p>
                                    <input type="file" class="importFile" name="importFile" onchange="uploadFile('upload');" size="64" />
                                </td>
                            </tr>
                            <tr id="selectFile" style="display: none;">
                                <td class="tools-table">
                                	<p><b><?=system_showText(LANG_SITEMGR_FILES_CSV);?></b></p>
                                    <p><?=system_showText(LANG_SITEMGR_IMPORT_AFTERUPLOAD_CRON);?></p>
                                    <p id="msgFileList" style="<?=$file_name && !$messageErrorUpload? "display: none;": "";?>"><strong><?=system_showText(LANG_SITEMGR_IMPORT_USEFORMTHEFORMBELOW);?></strong></p>

									<table id="tblHeader" cellpadding="0" cellspacing="0" border="0" class="standard-table load-ftp-table" style="<?=$file_name? "display: none;": "";?>">
										<tr>
											<th class="table-select-file">&nbsp;</th>
											<th class="table-file-name"><?=system_showText(LANG_SITEMGR_IMPORT_FILENAME);?></th>
											<th class="table-file-size"><?=system_showText(LANG_SITEMGR_IMPORT_FILESIZE);?></th>
											<th class="table-file-date"><?=system_showText(LANG_SITEMGR_IMPORT_UPDATEDDATE);?></th>
										</tr>
									</table>
									<div id="fileList" class="fileList" style="<?=$file_name && !$messageErrorUpload? "display: none;": "";?>">
										<?=import_renderFileList($fileInfo);?>
									</div>
                                    <span class="clear"></span>
									<div id="dvButtons" class="import-button" style="<?=$file_name && !$messageErrorUpload? "display: none;": "";?>">
										<input type="button" name="Submit" id="buttonSelectFile" value="<?=system_showText(LANG_SITEMGR_IMPORT_FILELIST_SELECT_FILE);?>" class="input-button-form <?=count($fileInfo) && $fileInfo[0]? "": "input-button-form-disabled";?>" onclick="uploadFile('select');" <?=count($fileInfo) && $fileInfo[0]? "": "disabled=\"disabled\"";?> style="width:113px;"/>
										<input type="button" name="Reload" value="<?=system_showText(LANG_SITEMGR_IMPORT_FILELIST_RELOAD);?>" class="input-button-form" onclick="reloadFileList(false);" style="width:113px;"/>
										<? if ($file_name && !$messageErrorUpload) { ?>
											<a href="javascript:void(0);" onclick="cancelFile();"><?=($_GET["preview"] ? system_showText(LANG_SITEMGR_BACK) :system_showText(LANG_SITEMGR_BACK));?></a>
										<? } ?>
									</div>
                                </td>
                            </tr>
                            <tr id="selectFile2" style="display: none;">
                                <td class="tools-table">
                                    <input type="text" id="file_name" name="file_name" class="inputButtonFile" value="<?=!$messageErrorUpload? $file_name: "";?>" style="width: 333px;" readonly="readyonly"/>
									<a href="javascript:void(0);" onclick="changeFile();"><?=system_showText(LANG_SITEMGR_IMPORT_CHANGEFILE);?></a>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>

				<div id="pageLoad" style="display: none;">
					<img src="<?=DEFAULT_URL;?>/images/img_loading.gif" alt="<?=system_showText(LANG_SITEMGR_WAITLOADING);?>" title="<?=system_showText(LANG_SITEMGR_WAITLOADING);?>"/>
					<p class="import-loading"><?=system_showText(LANG_SITEMGR_WAITLOADING);?></p>
				</div>

				<div id="wait_loading_file" style="display: none" align="center">
					<img src="<?=DEFAULT_URL;?>/images/img_loading.gif" alt="<?=system_showText(LANG_SITEMGR_WAITLOADING);?>" title="<?=system_showText(LANG_SITEMGR_WAITLOADING);?>"/>
					<p class="import-loading"><?=system_showText(LANG_SITEMGR_IMPORT_PROCESSING);?></p>
				</div>

				<form id="importOptions" name="importOptions" target="_parent" action="<?=DEFAULT_URL."/".SITEMGR_ALIAS;?>/import/importlog.php?import_type=<?=$_GET["import_type"]?>" method="post">
					<input type="hidden" name="type" value="options"/>
					<input type="hidden" name="upload_name" value="<?=$upload_name;?>"/>
					<input type="hidden" name="file_name" value="<?=$file_name;?>"/>
					<input type="hidden" name="ftp_type" value="<?=$ftp_type;?>"/>
					<table id="tableCSV"  class="standard-table standard-import-table" style="<?=$urlFileName? "" : "display: none;"; ?>">
						<tr>
							<th colspan="3" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_IMPORT_OPTIONS);?></th>
						</tr>
                        <tr>
                        	<td class="import-table-title"><?=system_showText(LANG_SITEMGR_SEPARATOR);?></td>
                            <td class="import-table-title">
								<?=system_showText(LANG_SITEMGR_PREVIEW)." ".system_showText(LANG_SITEMGR_IMPORT_SHOWING_PREVIEWLINES);?>
								<span><?=system_showText(LANG_SITEMGR_IMPORT_PREVIEW_MESSAGE);?></span>
							</td>
                        </tr>
                        <tr class="import-preview-height">
                        	<td class="import-column-separator">
                            	<table class="import-separator">
                                    <tr>
                                    	<th><input type="radio" name="csvOption" value="automatic" onclick="changeCSVOptions(this.value);" checked="checked"/></th>
										<td><?=system_showText(LANG_SITEMGR_IMPORT_AUTOMATIC);?></td>
                                    </tr>
                                    <tr>
                                    	<th><input type="radio" name="csvOption" value="tab" onclick="changeCSVOptions(this.value);"/></th>
										<td><?=system_showText(LANG_SITEMGR_IMPORT_TAB);?></td>
                                    </tr>
                                    <tr>
                                    	<th><input type="radio" name="csvOption" value=","  onclick="changeCSVOptions(this.value);"/></th>
										<td><?=system_showText(LANG_SITEMGR_IMPORT_COMMA);?></td>
                                    </tr>
                                    <tr>
                                    	<th><input type="radio" id="csvCustom" name="csvOption" value="custom" /></th>
										<td>
											<?=system_showText(LANG_SITEMGR_IMPORT_CUSTOM);?>
											<input type="text" name="customOption" id="customOptionText" value="" maxlength="1" onclick="$('#csvCustom').attr('checked',true);" onkeyup="changeCSVOptions(this.value);"/>
											<span>
												<?=LANG_SITEMGR_IMPORT_VALID_SEPARATORS?> / | * . ; _ :
											</span>
										</td>
									</tr>
                                </table>
                            </td>
                            
                            <td>
                            	<table>
                                	<tr>
                                        <td>
                                            <div id="csvPreview">
                                                <img src="<?=DEFAULT_URL;?>/images/img_loading.gif" alt="<?=system_showText(LANG_SITEMGR_WAITLOADING);?>" title="<?=system_showText(LANG_SITEMGR_WAITLOADING);?>"/>
                                                <p class="import-loading"><?=system_showText(LANG_SITEMGR_WAITLOADING);?></p>
                                            </div>
                                        </td>
                                	</tr>
                                </table>
                            </td>
						</tr>
					</table>

					<div id="toScroll" class="import-button">
						<button type="submit" id="btnISubmit" value="Submit" onclick="changeDisplayForm();" class="input-button-form <?=$urlFileName || $ftp_type == "schedule_cron"? "" : "input-button-form-disabled";?>" <?=$urlFileName || $ftp_type == "schedule_cron"? "" : "disabled=\"disabled\"";?>><?=$ftp_type == "schedule_cron"? system_showText(LANG_SITEMGR_SUBMIT): system_showText(LANG_SITEMGR_IMPORT_SUBMIT);?></button>
                        <a id="closeLink" href="javascript: void(0)" onclick="parent.$.fancybox.close();"><?=system_showText(LANG_SITEMGR_CLOSE);?></a>
					</div>
				</form>
			<? } else {

				if($_GET["id"]){
					$import = new ImportLog($_GET["id"]);
					$phisicalPath = IMPORT_FOLDER."/preview_".$import->getString("phisicalname");
					$colSeparator = $import->getString("delimiter");
					?>
					<div>
						<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE" >
							<tr>
								<th>
									<?=system_showText(LANG_SITEMGR_IMPORT_DATETIME)?>
								</th>
								<th>
									<?=system_showText(LANG_SITEMGR_IMPORT_FILENAME)?>
								</th>
								<th>
									<?=system_showText(LANG_SITEMGR_IMPORT_TOTALLINES)?>
								</th>
								<th>
									<?=system_showText(LANG_SITEMGR_IMPORT_ADDEDLINES)?>
								</th>
								<th>
									<?=system_showText(LANG_SITEMGR_STATUS)?>
								</th>
							</tr>
							<tr>
								<td>
									<?=format_date($import->getString("date"))?>&nbsp; - <?=format_getTimeString($import->getNumber("time"))?>
								</td>
								<td>
									<?=$import->getString("filename", true, 23);?>
								</td>
								<td>
									<?=(int)$import->getNumber("totallines")?>
								</td>
								<td>
									<?=(int)$import->getNumber("linesadded")?>
								</td>
								<td>
									<?
									$status = new ImportStatus();
									if ($import->getString("status") == "R") echo $status->getStatusWithStyle($import->getString("status"), $import->getNumber("id"))."<abbr id=\"progresslabel_".$import->getNumber("id")."\"> - <abbr id=\"progress_".$import->getNumber("id")."\">".$import->getString("progress")."</abbr></abbr>";
									else echo $status->getStatusWithStyle($import->getString("status"), $import->getNumber("id"))."<abbr id=\"progresslabel_".$import->getNumber("id")."\"><abbr id=\"progress_".$import->getNumber("id")."\"></abbr></abbr>";
									?>
								</td>
							</tr>
							<tr>
								<td colspan="5">
									<?=import_getHistory($import->getString("history"));?>
								</td>
							</tr>
						</table>
					</div>
					<?
					if ($messageErrorUpload) { ?>
						<p class="errorMessage"><?=$messageErrorUpload;?></p>
						<?
					}
					?>
					<div id="csvPreview" class="csvPreviewLog" style="<?=$urlFileName && !$messageErrorUpload? "" : "display: none;";?>">
						<img src="<?=DEFAULT_URL;?>/images/img_loading.gif" alt="<?=system_showText(LANG_SITEMGR_WAITLOADING);?>" title="<?=system_showText(LANG_SITEMGR_WAITLOADING);?>"/>
						<p class="import-loading"><?=system_showText(LANG_SITEMGR_WAITLOADING);?></p>
					</div>

					<form name="approveImport" class="approveImport" target="_parent" action="<?=DEFAULT_URL."/".SITEMGR_ALIAS;?>/import/importlog.php?import_type=<?=$_GET["import_type"]?>" method="post">
						<input type="hidden" name="type" value="approve" />
						<input type="hidden" name="import_id" value="<?=$_GET["id"];?>" />
						<div id="toScroll" class="import-button">
							<button type="submit" value="Submit" class="input-button-form <?=$urlFileName && $import_action == "NA"? "" : "input-button-form-disabled"; ?>" <?=$urlFileName && $import_action == "NA"? "" : " disabled=\"disabled\""; ?>><?=system_showText(LANG_SITEMGR_APPROVE);?></button>
							<a href="javascript:void(0);" onclick="parent.$.fancybox.close();"><?=system_showText(LANG_SITEMGR_CLOSE);?></a>
						</div>
					</form>
					<?
				}

			} ?>
		</div>

		<script type="text/javascript">
			var fileName = '<?=$urlFileName;?>';
			var errorMessage = '<?=$messageErrorUpload;?>';
			var colSeparator = '<?=($colSeparator ? $colSeparator : ",")?>';
			var fileForm = '<?=$type;?>';
			var ftpType = '<?=$ftp_type == "schedule_cron"? $ftp_type: "";?>';

			function changeFileForm (type, file_name, ftpType) {
				$("#type").attr("value", type);
				if (type == "upload") {
					$("#tab_select").removeClass("tabActived");
					$("#tab_upload").addClass("tabActived");
					$('#uploadFile').show();
					$('#selectFile').hide();
					$('#selectFile2').hide();
				} else {
					$("#tab_upload").removeClass("tabActived");
					$("#tab_select").addClass("tabActived");
					$('#uploadFile').hide();
					$('#selectFile').show();
					if ((file_name || ftpType) && !$("#btnISubmit").attr("disabled")) {
						$('#selectFile2').show();
					}
				}
			}

			function uploadFile (type) {
				$("#cron_message").css("display", "none");
				$("#pageLoad").css("display", "");
				$("#tableCSV").css("display", "none");
				$("#closeLink").css("display", "none");
				if (type == "select") {

					$("#tblHeader").hide();
					$("#dvButtons").hide();
					$("#fileList").hide();
					$("#msgFileList").hide();

					var row_file = $("#rowFile").val();
					if (row_file != "") {
						$("#file_name").val(row_file);
					}
					var file_name = $("#file_name").val();
					$.post(DEFAULT_URL + "/includes/code/<?=$includeFile?>", {
						type: "ajax",
						option: "verify_lines",
						domain_id: "<?=SELECTED_DOMAIN_ID;?>",
						file_name: file_name
					}, function (res) {
						/*
						 * 1 - ftp_type = correct;
						 * 2 - ftp_type = generate_preview;
						 * 3 - ftp_type = schedule_cron;
						 */
						if (res == 1) {
							$("#ftp_type").attr("value", "correct");
						} else if (res == 2) {
							$("#ftp_type").attr("value", "generate_preview");
						} else {
							$("#cron_message").css("display", "");
							$("#ftp_type").attr("value", "schedule_cron");
						}
						$("#importInfo").submit();
					});
				} else {
					$("#ftp_type").attr("value", "correct");
					$("#importInfo").submit();
				}
			}

			function cancelFile() {
				$("#tableCSV").show();
				$("#selectFile2").show();
				$("#tblHeader").hide();
				$("#dvButtons").hide();
				$("#msgFileList").hide();
				$("#fileList").hide();
				$("#btnISubmit").removeClass("input-button-form-disabled");
				$("#btnISubmit").attr("disabled", "");
				$("#rowFile").val("");
			}

			function changeFile() {
				$("#cron_message").hide();
				$("#tableCSV").hide();
				$("#selectFile2").hide();
				$("#tblHeader").show();
				$("#dvButtons").show();
				$("#msgFileList").show();
				$("#fileList").show();
				$("#btnISubmit").addClass("input-button-form-disabled");
				$("#btnISubmit").attr("disabled", "disabled");
				reloadFileList(false);
			}

			function selectRow(radioId) {
				$("#" + radioId).attr("checked", "checked");
				$("#rowFile").val($("#" + radioId).val());
			}

			function changeDisplayForm() {
				$('#importOptions').hide();
				$('#wait_loading_file').show();
				$('#toScroll').hide();
			}

			function reloadFileList(autoLoad) {
				if (autoLoad == false) {
					var loading = "<div class=\"import-loading-align\"><img src=\"<?=DEFAULT_URL;?>/images/img_loading.gif\" alt=\"<?=system_showText(LANG_SITEMGR_WAITLOADING);?>\" title=\"<?=system_showText(LANG_SITEMGR_WAITLOADING);?>\"/>";
					loading += "<p class=\"import-loading\"><?=system_showText(LANG_SITEMGR_WAITLOADING);?></p></div>";

					$("#fileList").html(loading);
				}

				$.post(DEFAULT_URL + "/includes/code/<?=$includeFile?>", {
					type: "ajax",
					option: "reload_fileList",
					domain_id: "<?=SELECTED_DOMAIN_ID?>"
				}, function (res) {
					var arRes = res.split("[||]");
					if (arRes[1] == "EMPTY") {
						$("#fileList").html(arRes[0]);
						setTimeout("reloadFileList(true)", 5000);
					} else {
						$("#fileList").html(arRes[0]);
						$("#buttonSelectFile").removeClass("input-button-form-disabled");
						$("#buttonSelectFile").attr("disabled", "");
					}
				});
			}

			function changeCSVOptions(separator) {

				var RgExItem = new RegExp("[/|*.:_;,]");

				var validate_separator = true;

				if ($("#csvCustom").attr("checked") == false){
					$("#customOptionText").val("");
					validate_separator = false;
				}

				if (!separator){
					validate_separator = false;
				}

				if ((!validate_separator) || (separator.match(RgExItem))){
					if (separator && (separator != colSeparator)) {
						$("#csvPreview").html('');
						colSeparator = (separator == "automatic" ? ",": separator);
						preview();
					}
				} else {
					$('#separator_message_id').show('fast');
					$('html, body, div').animate({
						scrollTop: $("#separator_message_id").offset().top
					}, 500);
					setTimeout("$('#separator_message_id').hide('fast');", 3000);
				}
			}

			function preview () {
				if (colSeparator == "tab" || colSeparator == '\t') {
					$(function(){
						$('#csvPreview').csv2table(
						fileName , {
							limit: [0, 5],
							nowloadingMsg: LANG_JS_LOADING,
							col_sep: '\t',
							sortable: false,
							className_table: "standard-tableTOPBLUE"
						});
					});
				} else {
					$(function(){
						$('#csvPreview').csv2table(
						fileName , {
							limit: [0, 10],
							nowloadingMsg: LANG_JS_LOADING,
							col_sep: colSeparator,
							sortable: false,
							className_table: "standard-tableTOPBLUE"
						});
					});
				}
				$('html, body, div').animate({
					scrollTop: $("#toScroll").offset().top
				}, 500);
			}

			if (fileForm) {
				changeFileForm(fileForm, fileName, ftpType);
			}

			$(document).ready(function () {
				if (fileName && !errorMessage) {
					preview();
				}
			})
		</script>
	</body>
</html>