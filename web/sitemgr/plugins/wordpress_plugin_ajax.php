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
	# * FILE: /sitemgr/plugins/wordpress_plugin_ajax.php
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

		if(validate_form("wordpress",$_POST, $error)){
		
			/*
			 * Save url of WordPress
			 */
			if(!setting_set("wordpress_url", $_POST["wordpress_url"])) {
				if(!setting_new("wordpress_url", $_POST["wordpress_url"])) {
					$error = true;
				}
			}
			
			if ($error) {
               $message_style = "errorMessage";
			   $message = system_showText(LANG_SITEMGR_WORDPRESS_ERROR_MESSAGE_SAVE);
            }
			
			/*
			 * Generate key to worpress
			 */
			$domainObj = new Domain(SELECTED_DOMAIN_ID);
			$domain = $domainObj->getString("url");
			$edir_key = getKey($domain);

            $wordpress_key = md5($_POST["wordpress_url"].VERSION.$edir_key);

            unset($new_Key);
            $j=0;
            for($i=0;$i<strlen($wordpress_key);$i++){
                if($j < 4){
                    $new_key .= substr($wordpress_key, $i, 1);	
                }else{
                    $new_key .= "-".substr($wordpress_key, $i, 1);
                    $j=0;
                }
                $j++;

            }
            if(!setting_set("wordpress_key", $new_key)) {
                if(!setting_new("wordpress_key", $new_key)) {
                    $error = true;
                }
            }

            if($_POST["wordpress_url"] && $new_key){
                ?>
                <p><?=system_showText(LANG_SITEMGR_WORDPRESS_DOWNLOAD_PLUGIN)?></p> 
                <div class="wordPressDownload standardwordPressButton">
                    <a href="javascript:void(0);" onclick="download_wordpress_plugin('wordpress');">
                        <?=system_showText(LANG_SITEMGR_WORDPRESS_DOWNLOAD)?>
                    </a>
                </div>
                <p class="wordPressKey">
                    <?=system_showText(LANG_SITEMGR_WORDPRESS_KEY)?>: <?=$new_key?>
                </p>
                <?	
            }else{
                ?>
                    <p class="redText"><?=system_showText(LANG_SITEMGR_WORDPRESS_CHECK_INFORMATION)?></p>
                <?
            }
		}
	}
	?>