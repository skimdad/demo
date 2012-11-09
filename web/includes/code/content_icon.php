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
	# * FILE: /includes/code/content_icon.php
	# ----------------------------------------------------------------------------------------------------

	extract($_POST);
	extract($_GET);

	$success = false;

    if ($_SERVER['REQUEST_METHOD'] == "POST" && (!DEMO_LIVE_MODE)) {

        if ($_FILES['favicon_file']['name']) {
			$array_allowed_types = array('ico');
			$arr_favicon = explode(".",$_FILES['favicon_file']['name']);
			$favicon_extension = $arr_favicon[count($arr_favicon)-1];
			if (in_array(string_strtolower($favicon_extension),$array_allowed_types)) {
				$allow_favicon_file = true;
			} else {
				$allow_favicon_file = false;
			}
		}
        
        setting_get("last_favicon_id", $last_favicon_id);
        
        if (!$last_favicon_id){
            setting_new("last_favicon_id", "1");
            $last_favicon_id = "1";
        }

        // Clean Favicon
        if (($remove_icon) && file_exists(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/content_files/favicon_".$last_favicon_id.".ico")) {
            @unlink(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/content_files/favicon_".$last_favicon_id.".ico");
            $success = true;
            $message_icon = system_showText(LANG_SITEMGR_CONTENT_ICON_SUCCESS);
        }
        
        if (!$remove_icon){
            // FAVICON FILE UPLOAD
            if ($allow_favicon_file){
                if (file_exists($_FILES['favicon_file']['tmp_name']) && filesize($_FILES['favicon_file']['tmp_name'])) {
                                    
                    if ($last_favicon_id){
                        if (file_exists(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/content_files/favicon_".$last_favicon_id.".ico")){
                            @unlink(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/content_files/favicon_".$last_favicon_id.".ico");
                        }
                        $last_favicon_id++;
                    }
                    
                    $file_path = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/content_files/favicon_".$last_favicon_id.".ico";
                    copy($_FILES['favicon_file']['tmp_name'], $file_path);
                    setting_set("last_favicon_id", $last_favicon_id);
                    $message_icon = system_showText(LANG_SITEMGR_CONTENT_ICON_SUCCESS);
                    $success = true;
                } else {
                    $message_icon = system_showText(LANG_MSGERROR_ERRORUPLOADINGIMAGE);
                }
            } else {
                if ($_FILES['favicon_file']['name']) {
                    $message_icon = system_showText(LANG_UPLOAD_MSG_NOTALLOWED_WRONGFILETYPE);
                }
            }
        }
    }
?>