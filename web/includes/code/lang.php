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
	# * FILE: /sitemgr/langcenter/lang.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
    # SUBMIT
    # ----------------------------------------------------------------------------------------------------
    
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $lang = new Lang();
        
        $messageError = '';
        
        if (!$id) {
            $messageError = system_showText(LANG_SITEMGR_MSGERROR_CODEISREQUIRED);
        }
        
        if (!$name) {
            $messageError = system_showText(LANG_SITEMGR_MSGERROR_NAMEISREQUIRED);
        }
        
        if ($_POST['_lang_enabled'] == 'n' && $_POST['lang_enabled'] == 'y') {
			if (($lang->getCountEnabledLang()+1) > MAX_ENABLED_LANGUAGES) {
				$messageError = system_showText(LANG_SITEMGR_MSGERROR_MAXLANGENABLED);
			}
        }
        
        if ($_POST['lang_default'] == 'y' && !$_POST['lang_enabled']) {
            $messageError = system_showText(LANG_SITEMGR_MSGERROR_YOUCANNOTDISABLEDEFAULTLANG);
        }
        
        if (!$_POST['lang_default'] && !$_POST['lang_order']) {
        	$messageError = system_showText(LANG_SITEMGR_MSGERROR_DEFINEORDER);
		}
        
        if (!$messageError) {
            
            if ($_POST['lang_default'] == 'y') {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
                $query  = "UPDATE Lang SET lang_default='n' WHERE 1";
                $result = $dbObj->query($query);
                $_POST['lang_order'] = '0';
            }
        
            $lang->makeFromRow($_POST);
            $lang->newOrder($current_order);
            $lang->defineDefault();
            
            $error = '';
            if ($lang->Save()) {
				//$message = LANG_SITEMGR_LANGUAGE.' '.LANG_SITEMGR_SUCCESSUPDATED;
                $message = 0;
				
            } else  {
                //$message = LANG_SITEMGR_MSGERROR_SYSTEMERROR;
                $message = 1;
                $error = 1;
            }
            
            header("Location: $url_redirect/index.php?message=".$message."&error=$error&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : ""));
              
            
        }
        
        
    }
    
    # ----------------------------------------------------------------------------------------------------
    # FORMS DEFINES
    # ----------------------------------------------------------------------------------------------------
    $id = $_GET["id"] ? $_GET["id"] : $_POST["id"];
    
    if ($id) {
        $lang = new Lang($id);
        $lang->extract();
    } else {
         $lang = new Lang();
         $lang->makeFromRow($_POST);
    }
    
    extract($_POST);
    extract($_GET);

?>