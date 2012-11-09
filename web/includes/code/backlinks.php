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
	# * FILE: /includes/code/backlinks.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (validate_form("backlink", $_POST, $message_backlink)) {
            $listingObj = new Listing($id);
            
            $backlink_url = trim($backlink_url);
            
            // fixing url field if needed.
			if ($backlink_url != "") {
				if (string_strpos($backlink_url, "://") !== false) {
					$aux_url = explode("://", $backlink_url);
					$aux_url = $aux_url[1];
					$backlink_url = $aux_url;
				}
				$backlink_url = "http://".$backlink_url;
			}
            
            if ($sitemgr){
                $listingObj->setString("backlink", ($backlink ? "y" : "n"));
                $listingObj->setString("backlink_url", $backlink_url);
            } else {
                $listingObj->setString("backlink", "y");
                $listingObj->setString("backlink_url", $backlink_url);
				$listingObj->setString("backlinkcode", $_SESSION['backlinkcode']);
            }
            $listingObj->save();

            if ($sitemgr){
                header("Location: $url_redirect/index.php?message=1");
            } else {
                header("Location: $url_redirect/index.php?messageBacklink=10");
            }
            exit;
        }
        
        // removing slashes added if required
		$_POST = format_magicQuotes($_POST);
		$_GET  = format_magicQuotes($_GET);

		extract($_POST);
		extract($_GET);
		
	}
    
    # ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
    if ($id){
        $listingObj = new Listing($id);
        if ($listingObj->getString("backlink") == "y"){
            $backlinkCheck = true;
        } else {
            $backlinkCheck = false;
        }
        $backlink_url = $listingObj->getString("backlink_url");
        
        $backlinks = "<a href=\"";
        if (MODREWRITE_FEATURE == "on"){
            $backlinks .= LISTING_DEFAULT_URL."/backlink/".$listingObj->getString("friendly_url").".html";
        } else {
            $backlinks .= LISTING_DEFAULT_URL."/backlink_return.php?friendly_url=".$listingObj->getString("friendly_url");
        }
        $backlinks .= "\">".$listingObj->getString("title")."</a>";
    }
?>