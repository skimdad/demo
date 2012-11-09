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
	# * FILE: /sitemgr/export/index.php
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
	# INCREASES FREQUENTLY ACTIONS
	# ----------------------------------------------------------------------------------------------------
	system_setFreqActions('export_data','export');

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(INCLUDES_DIR."/code/export.php");
	
	if (LISTING_SCALABILITY_OPTIMIZATION == "on") {
		$listingExportFunct = "showListingOptions();";
	} else {
		$listingExportFunct = "exportFile('Listing');";
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

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=string_ucwords(LANG_SITEMGR_NAVBAR_DATA_MANAGEMENT);?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin export-list">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include (INCLUDES_DIR."/tables/table_data_submenu.php"); ?>

			<div id="header-export"><?=system_showText(LANG_SITEMGR_EXPORT_TITLEEXPORTLISTINGSAMEFORMAT)?></div>

			<ul class="list-view">
				<li>
					<a href="<?=DEFAULT_URL?>/sitemgr/export/listingexport.php" class="link-export">
						<?=system_showText(LANG_SITEMGR_EXPORT_TITLEEXPORTCSVFILE)?>
					</a>
				</li>
                <li style="list-style:none;list-style-image:none;background-image:none;">&nbsp;</li>
			</ul>
			
			<br /><br />
			
			<? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on"){ ?>
				<div id="header-export"><?=system_showText(LANG_SITEMGR_EXPORT_TITLEEXPORTEVENTSAMEFORMAT)?></div>

				<ul class="list-view">
					<li>
						<a href="<?=DEFAULT_URL?>/sitemgr/export/eventexport.php" class="link-export">
							<?=system_showText(LANG_SITEMGR_EXPORT_TITLEEXPORTCSVFILE_EVENT)?>
						</a>
					</li>
					<li style="list-style:none;list-style-image:none;background-image:none;">&nbsp;</li>
				</ul>

				<br /><br />
			<? } ?>

			<div id="header-export"><?=system_showText(LANG_SITEMGR_EXPORT_CLICKTODOWNLOADDATA);?></div>
			
            <div class="export-view">
				<p id="exportMessage" class="<?=$messageStyle? $messageStyle: ""; ?>" style="<?=$messageStyle? "": "display: none;"; ?>">
					<?=$exportMessage? $exportMessage: ""; ?>
				</p>

				<p id="export_loading" style="padding-top: 5px; padding-bottom: 5px; text-align: center; display: none;">
					<span>
						<?=system_showText(LANG_SITEMGR_EXPORT_WAITING_CRON);?>
						<br />
						<img src="<?=DEFAULT_URL;?>/images/img_loading.gif">
					</span>
				</p>
                
                <div class="export-left">

                    <ul class="list-view">
                        <li>
                            <a href="javascript:void(0);" onclick="exportFile('Location');" class="link-export">
                                <?=system_showText(LANG_SITEMGR_EXPORT_LOCATION_DATA);?>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" onclick="exportFile('Account');" class="link-export">
                                <?=system_showText(LANG_SITEMGR_EXPORT_ACCOUNT_DATA);?>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" onclick="showEmailOptions();" class="link-export">
                                <?=ucfirst(system_showText(LANG_SITEMGR_EXPORT_GENERATEEMAILLIST));?>
                            </a>
                        </li>
                        <li class="exportBox" id="emailDataFields" style="display: none;">
                            <p style="padding-top: 10px; text-align: center;">
                                <input style="margin: 0 3px 0 0;" type="radio" name="item_filter" onclick="changeEmailOption(this.value);" value="all" checked>All</input>
                                <input style="margin: 0 3px 0 10px;" type="radio" name="item_filter" onclick="changeEmailOption(this.value);" value="category">Category</input>
                                <input style="margin: 0 3px 0 10px" type="radio" name="item_filter" onclick="changeEmailOption(this.value);" value="location">Location</input>
                            </p>
                            <p id="categoryDropDown" style="display: none; margin: 0 auto; padding-top: 10px; text-align: center;"><?=$categoryDropDown;?></p>
                            <p id="locationDropDown" style="display: none; margin: 0 auto; padding-top: 10px; text-align: center;"><?=$locationDropDown;?></p>
                            <p style="padding-top: 10px; text-align: center;">
                                <a href="javascript:void(0);" onclick="exportFile('Email');" class="standardLink" style="margin: 0; padding: 0; font-size: 14px;">
                                    <strong><?=system_showText(LANG_SITEMGR_EXPORT_EMAIL_LIST);?></strong>
                                </a>
                            </p>
                        </li>
                    </ul>
                    
                    <? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") { ?>
                        <ul class="list-view">
                            <li>
                                <a href="javascript:void(0);" onclick="exportFile('Banner');" class="link-export">
                                    <?=system_showText(LANG_SITEMGR_EXPORT_BANNER_DATA);?>
                                </a>
                            </li>
                            <li style="list-style:none;list-style-image:none;background-image:none;">&nbsp;</li>
                        </ul>
                    <? } ?>
                    
                    <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
                        <ul class="list-view">
                            <li>
                                <a href="javascript:void(0);" onclick="exportFile('Classified');" class="link-export">
                                    <?=system_showText(LANG_SITEMGR_EXPORT_CLASSIFIED_DATA);?>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="exportFile('ClassifiedCategory');" class="link-export">
                                    <?=system_showText(LANG_SITEMGR_EXPORT_CLASSIFIED_CATEGORY_DATA);?>
                                </a>
                            </li>
                        </ul>
                    <? } ?>
                    
            	</div>
                
                <div class="export-right">
                
                	<ul class="list-view">
                        <li>
                            <a href="javascript:void(0);" onclick="<?=$listingExportFunct;?>" class="link-export">
                                <?=system_showText(LANG_SITEMGR_EXPORT_LISTING_DATA);?>
                            </a>
                        </li>
                        <li class="exportBox" id="exportlisting" style="background: none; <?=(LISTING_SCALABILITY_OPTIMIZATION == "on" && $export["finished"] == "N"? "": "display: none;");?>">
                            <input type="hidden" id="nextFileName" value="<?=$exportFile?>" />
                            <p style="padding-bottom: 10px;">
                                <strong><?=system_showText(LANG_SITEMGR_EXPORT_EXPORTITEM_AFTEREXPORTDONE)?></strong> <?=$exportFilePath?>
                            </p>
                            <p style="padding-bottom: 10px;">
                                <strong><?=system_showText(LANG_SITEMGR_EXPORT_EXPORTITEM_FILENAME)?></strong> <span id="showFileName"><?=$exportFile?></span>
                            </p>
                            <p id="export_cron_loading" style="padding-top: 5px; padding-bottom: 5px; text-align: center; <?=$export["finished"] == "N"? "": "display: none;"?>">
                                <?=system_showText(LANG_SITEMGR_EXPORT_EXPORTINGPLEASEWAIT);?>
                                <br />
                                <img src="<?=DEFAULT_URL;?>/images/img_loading.gif">
                            </p>
                            <p id="export_progress" style="padding-top: 10px; text-align: center; <?=$export["finished"] == "N"? "": "display: none;"?>">&nbsp;
                                
                            </p>
                            <p id="export_link_start" style="padding-top: 10px; text-align: center; <?=$export["finished"] == "N"? "display: none;": "";?>">
                                <span>
                                    <a href="javascript:void(0);" onclick="scheduleExport();" class="standardLink" style="margin: 0; padding: 0; font-size: 14px;">
                                        <strong><?=system_showText(LANG_SITEMGR_EXPORT_CLICKHERETOSTART)?></strong>
                                    </a>
                                    <p id="file_link" style="text-align: center; <?=$exportedFileName? "": "display: none; "?>">
                                    <? if ($exportedFileName){ ?>
                                        <a href="<?=$_SERVER["PHP_SELF"]."?action=cron&download=".$exportedFileName;?>"><?=system_showText(LANG_SITEMGR_EXPORT_LASTFILE_MESSAGE)?></a>
                                    <? } ?>
                                    </p>
                                </span>
                            </p>
                        </li>
                        <li>
                            <a href="javascript:void(0);" onclick="exportFile('ListingCategory');" class="link-export">
                                <?=system_showText(LANG_SITEMGR_EXPORT_LISTING_CATEGORY_DATA);?>
                            </a>
                        </li>
                    </ul>
                    
                    <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
                        <ul class="list-view">
                            <li>
                                <a href="javascript:void(0);" onclick="exportFile('Event');" class="link-export">
                                    <?=system_showText(LANG_SITEMGR_EXPORT_EVENT_DATA);?>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="exportFile('EventCategory');" class="link-export">
                                    <?=system_showText(LANG_SITEMGR_EXPORT_EVENT_CATEGORY_DATA);?>
                                </a>
                            </li>
                        </ul>
                    <? } ?>
                    
                    <? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
                        <ul class="list-view">
                            <li>
                                <a href="javascript:void(0);" onclick="exportFile('Article');" class="link-export">
                                    <?=system_showText(LANG_SITEMGR_EXPORT_ARTICLE_DATA);?>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="exportFile('ArticleCategory');" class="link-export">
                                    <?=system_showText(LANG_SITEMGR_EXPORT_ARTICLE_CATEGORY_DATA);?>
                                </a>
                            </li>
                        </ul>
                    <? } ?>
                    
                </div>
                
            </div>

		</div>

	</div>

	<div id="bottom-content">&nbsp;</div>

</div>

<script type="text/javascript">
	var check_progress_time = 5*1000;
	
	function showEmailOptions () {
		$("#exportlisting").hide();
		if ($("#emailDataFields").css("display") == "none") {
			$("#emailDataFields").show();
		} else {
			$("#emailDataFields").hide();
		}		
	}
	
	function showListingOptions () {
		$("#emailDataFields").hide();
		if ($("#exportlisting").css("display") == "none") {
			$("#exportlisting").show();
		} else {
			$("#exportlisting").hide();
		}
	}
	
	function showLoading () {
		showMessages('clear');
		if ($("#export_loading").css("display") == "none") {
			$("#export_loading").show();
		} else {
			$("#export_loading").hide();
		}
	}
	
	function showMessages (type, message) {
		if (type == 'success') {
			$('#exportMessage').addClass('successMessage');
		} else if (type == 'error') {
			$('#exportMessage').addClass('errorMessage');
			if (!message) message = "<?=LANG_SITEMGR_EXPORT_ERROR;?>";
		}
		
		if (type != 'clear') {
			$('#exportMessage').text(message);
			$('#exportMessage').show();
		} else {
			$('#exportMessage').text('');
			$('#exportMessage').hide();
			if ($('#exportMessage').hasClass('successMessage')) {
				$('#exportMessage').removeClass('successMessage');
			} else if ($('#exportMessage').hasClass('errorMessage')) {
				$('#exportMessage').removeClass('errorMessage');
			}
		}
	}
	
	function changeEmailOption (option) {
		if (option == "category") {
			$("#categoryDropDown").show();
			$("#locationDropDown").hide();
		} else if (option == "location") {
			$("#categoryDropDown").hide();
			$("#locationDropDown").show();
		} else {
			$("#categoryDropDown").hide();
			$("#locationDropDown").hide();
		}
	}
	
	function exportFile (type) {
		showLoading();
	
		var category = 0;
		var filter = $('input[name="item_filter"]:checked').val();
		var location = ($("#location").val()).split(":");
		var locationLevel = location[0];
		var locationId = location[1];
		var ajaxURL = '<?=system_getFormAction($_SERVER["PHP_SELF"]);?>';
		var domain = '<?=SELECTED_DOMAIN_ID;?>';
		
		if (type != "Email") $("#emailDataFields").hide();
		if (type != "Listing") $("#exportlisting").hide();

		if ($("#category_id").val()) {
			category = $("#category_id").val();
		}

		$.post(ajaxURL, {
			item_type: type,
			item_filter: filter,
			file_extension: 'csv',
			filter_categoryId: category,
			filter_locationLevel: locationLevel,
			filter_locationId: locationId,
			ajax_action: 'generate_data',
			domain_id: domain
		}, function (res) {
			/**
			 * options[0] = message type (Success / Error)
			 * options[1] = message (Status message from process)
			 * options[2] = zip filename ([TYPE].zip)
			 */
			var options = res.split(' - ');
			showLoading();
		
			if (options[0] == 'success' && options[2] != '') {
				showMessages(options[0], options[1]);
				window.location = ajaxURL + '?download=' + options[2];
			} else {
				if (options[2] == '') showMessages('error', "<?=system_showText(LANG_SITEMGR_EXPORT_NO_DATAFOUND);?>");
				else showMessages('error');
			}
		});
	}
	
	function scheduleExport () {
		showMessages('clear');
		var ajaxURL = '<?=$_SERVER["PHP_SELF"];?>';
		var filename = $('#nextFileName').val();
		var domain = '<?=SELECTED_DOMAIN_ID;?>';

		$("#export_cron_loading").show();
		$("#export_progress").show();
		$("#export_link_start").hide();
		$("#file_link").hide();
		$("#export_progress").html('<span>0%</span>');

		$.post(ajaxURL, {
			ajax_action: 'schedule_export',
			file_name: filename,
			domain_id: domain
		}, function (res) {
			if (res != 0 && res == 1) {
				showMessages('error', "<?=system_showText(LANG_SITEMGR_EXPORT_ALREADY_SCHEDULED);?>");
				$("#export_progress").html('');
			} else if (res != 0) {
				showMessages('error', "<?=system_showText(LANG_SITEMGR_EXPORT_ERROR_SCHEDULE);?>");
				$("#export_progress").html('');
			}
			
			if (res != 0) {
				$("#export_link_start").show();
				$("#export_cron_loading").hide();
			} else {
				setTimeout("checkExportProgress()", check_progress_time);
			}
		});
	}
	
	function checkExportProgress () {
		var ajaxURL = '<?=$_SERVER["PHP_SELF"];?>';
		var domain = '<?=SELECTED_DOMAIN_ID;?>';
		var filename = $('#nextFileName').val();
		var nextFileName = '<?=md5(uniqid(rand(), true)).".zip";?>';

		$.post(ajaxURL, {
			ajax_action: 'check_progress',
			file_name: filename,
			domain_id: domain
		}, function (res) {
			var options = res.split(" - ");
			if (options[0] == "waiting") {
				$("#export_cron_loading").show();
				$("#export_progress").show();
				$("#export_link_start").hide();
				$("#export_progress").html('<span>0%</span>');
				setTimeout("checkExportProgress()", check_progress_time);
			} else if (options[0] == "progress") {
				if (options[1] >= 0 && options[1] < 100) {
					$("#export_progress").html('<span>' + options[1] + '%</span>');
					setTimeout("checkExportProgress()", check_progress_time);
				} else if (options[1] == 100) {
					showMessages('success', "<?=system_showText(LANG_SITEMGR_EXPORT_SUCCESSFULLY);?>");
					$("#export_progress").html('');
					$("#export_link_start").show();
					$("#export_cron_loading").hide();
					$('#nextFileName').val(nextFileName);
					$('#showFileName').text(nextFileName);
					$("#file_link").html('<a href="' + ajaxURL + '?action=cron&download=' + filename + '"><?=system_showText(LANG_SITEMGR_EXPORT_LASTFILE_MESSAGE)?></a>');
					$("#file_link").show();
				}
			} else if (options[0] == "error") {
				showMessages('error', "<?=system_showText(LANG_SITEMGR_EXPORT_ERROR_SCHEDULE);?>");
				$("#export_progress").html('');
				$("#export_link_start").show();
				$("#export_cron_loading").hide();
			}
		});
	}
	
	<? if ($export["finished"] == "N" && LISTING_SCALABILITY_OPTIMIZATION == "on") { ?>
		$(document).ready(function () {
			checkExportProgress();
		});
	<? } ?>
</script>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>