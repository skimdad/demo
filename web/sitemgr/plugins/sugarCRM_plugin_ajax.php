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
	# * FILE: /sitemgr/plugins/sugarCRM_plugin_ajax.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");
	
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	header("Accept-Encoding: gzip, deflate");
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check", FALSE);
	header("Pragma: no-cache");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if(validate_form("sugar_crm",$_POST,$error)){
		
			/*
			 * Save url of sugar
			 */
			if(!setting_set("sugar_url", $_POST["sugar_url"])) {
				if(!setting_new("sugar_url", $_POST["sugar_url"])) {
					$error = true;
				}
			}
			
			/*
			 * Save url of sugar
			 */
			if(!setting_set("sugar_user", $_POST["sugar_user"])) {
				if(!setting_new("sugar_user", $_POST["sugar_user"])) {
					$error = true;
				}
			}
			
			/*
			 * Save url of sugar
			 */
			if(!setting_set("sugar_password", $_POST["sugar_password"])) {
				if(!setting_new("sugar_password", $_POST["sugar_password"])) {
					$error = true;
				}
			}
			
			if ($error) {
               $message_style = "errorMessage";
			   $message = system_showText(LANG_SITEMGR_SUGAR_ERROR_MESSAGE_SAVE);
            }
			
			if(sugar_login()){
				?>
					<p><?=system_showText(LANG_SITEMGR_SUGAR_DOWNLOAD_PLUGIN)?></p> 
					<div class="sugarCRMDownload standardSugarButton">
						<a href="javascript:void(0)" onclick="download_sugar_plugin();">
							<?=system_showText(LANG_SITEMGR_SUGAR_DOWNLOAD)?>
						</a>
					</div>
				<?	
			}else{
				?>
					<p class="redText"><?=system_showText(LANG_SITEMGR_SUGAR_CHECK_INFORMATION)?></p>
				<?
			}
		}
	}
	?>