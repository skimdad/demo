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
	# * FILE: /functions/wordpress_funct.php
	# ----------------------------------------------------------------------------------------------------

	function wordpress_validate_plugin($domain, $key, $create_key = false){
		
		$key_value = getKey($domain);
		if($key_value){
			if($create_key){
				return $key_value;
			}elseif($key_value == $key){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function wordpress_CreateFiles(){
		
		
		/*
		 * Creating file with settings
		 */
		
		unset($return_message);
		$return_message = array();
		$aux = false;
		
		$fileConstPath = PLUGIN_FILE_PATH."/wordPress/eDirectoryPlugin/plugin_settings.php";
		if ($fileConst = fopen($fileConstPath, "w+")) {
			
			$buffer = "";
			$buffer .= "<?php".PHP_EOL;
			$buffer .= "/**".PHP_EOL;
			$buffer .= " * eDirectory Plugin - Configuration File".PHP_EOL;
			$buffer .= " * Description: Integration with eDirectory blog".PHP_EOL;
			$buffer .= " * Author: Arca Solutions".PHP_EOL;
			$buffer .= " * Version: 0.1".PHP_EOL;
			$buffer .= " * Author URI: http://www.arcasolutions.com/".PHP_EOL;
			$buffer .= " * ".PHP_EOL;
			$buffer .= " * @author Arca Solutions".PHP_EOL;
			$buffer .= " * @package DMS".PHP_EOL;
			$buffer .= " *".PHP_EOL;
			$buffer .= " */".PHP_EOL;
			$buffer .= "define(\"EDIRECTORY_URL\",\"".DEFAULT_URL."/\");".PHP_EOL;
			$buffer .= "define(\"PROJECT_NAME\",\"".EDIRECTORY_TITLE."\");".PHP_EOL;
			$buffer .= "?>".PHP_EOL;

			fwrite($fileConst, $buffer, strlen($buffer));
			fclose($fileConst);
			
			
			/*
			 * Files to plugin
			 */
			unset($array_files);
			$array_files = array();
			$array_files[] = "eDirectoryPlugin.php";
			$array_files[] = "admin_tpl.htm";

			for($i=0;$i<count($array_files);$i++){
				/*
				 * Read the model files with buttons
				 */
				$filename = WORDPRESS_FILE_PATH."/eDirectoryPlugin/".$array_files[$i];
				$handle = fopen ($filename, "r");
				$content = fread ($handle, filesize ($filename));

				/*
				 * Write the file with buttons to wordPress
				 */
				$filename_plugin = PLUGIN_FILE_PATH."/wordPress/eDirectoryPlugin/".$array_files[$i];
				$fp = fopen($filename_plugin, 'w');
				fwrite($fp, $content);
				fclose($fp);
			}
			
		} 	
		
		return $return_message;
		
	}
	
	function wordpress_ZipAndDownloadFiles($help = false){
		if ($help){
			$fileName = EXTRAFILE_DIR."/wordpressHelp.zip";
		} else {
			$fileName = EXTRAFILE_DIR."/wordpress.zip";
		}
		
		@unlink($fileName);
		
		$zipObj = new Zip();
		
		$zipObj->setZipFile($fileName);
		
		if (!$help){
			/*
			 * Adding files to zip file
			 */
			unset($array_files);
			$array_files = array();
			$array_files[] = "eDirectoryPlugin.php";
			$array_files[] = "admin_tpl.htm";
			$array_files[] = "plugin_settings.php";

			for($i=0;$i<count($array_files);$i++){
				$filename_plugin_buttons = PLUGIN_FILE_PATH."/wordPress/eDirectoryPlugin/".$array_files[$i];
				$file_name_button = "eDirectoryPlugin/".$array_files[$i];
				$fileContents_button = file_get_contents($filename_plugin_buttons);
				$zipObj->addFile($fileContents_button, $file_name_button);
			}
		} else {
			$filename_plugin_readMe = WORDPRESS_FILE_PATH."/wordPress_Readme_V1.pdf";
			$file_name_readMe = "wordPress_Readme_V1.pdf";
			$fileContents_readMe_file = file_get_contents($filename_plugin_readMe);
			$zipObj->addFile($fileContents_readMe_file, $file_name_readMe);
		}
		$zipObj->finalize();
		if (!$help){
			$zipObj->sendZip('wordpress.zip');
		} else {
			$zipObj->sendZip('wordpressHelp.zip');
		}
		
		exit;
		
	}
	
?>