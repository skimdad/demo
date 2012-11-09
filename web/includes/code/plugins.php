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
	# * FILE: /includes/code/plugins.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	
	if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["plugin_type"] == "sugar" && SUGARCRM_FEATURE == "on") {

		if(validate_form("sugar_crm", $_POST, $error)){
		
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
		}
		
	} elseif ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["plugin_type"] == "wordpress") {
		
		$message_wp_options = system_showText(LANG_SITEMGR_PLUGINS_WP_SUCCESS);	
		
		if(!setting_set("wp_enabled", $_POST["wp_enabled"])) {
			if(!setting_new("wp_enabled", $_POST["wp_enabled"])) {
				$error = true;
				$message_wp_options = system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
			}
		}
		
		
	} else {
		
		if($_GET["download"] && $_GET["type"] == "sugar" && SUGARCRM_FEATURE == "on"){
			/*
			 * Create Files to Sugar
			 */
			sugar_CreateFiles();
			
			sugar_ZipAndDownloadFiles();
			
			
		} elseif($_GET["download"] && $_GET["type"] == "wordpress"){
			/*
			 * Create Files to WordPress
			 */
			wordpress_CreateFiles();
			wordpress_ZipAndDownloadFiles();
			
		} elseif($_GET["download"] && $_GET["type"] == "wordpress_help"){
			wordpress_ZipAndDownloadFiles(true);
			
		}
		
		setting_get("sugar_url", $sugar_url);
		setting_get("sugar_user", $sugar_user);
		setting_get("sugar_password", $sugar_password);
		setting_get("wp_enabled", $wp_enabled);
		setting_get("wordpress_url", $wordpress_url);
		
		if($sugar_url && $sugar_user && $sugar_password){
			$show_download_button = true;
		}else{
			$show_download_button = false;
		}

	}

	extract($_POST);
	extract($_GET);
?>