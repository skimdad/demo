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
	# * FILE: /sitemgr/lancenter/index.php
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
	# VALIDATING FEATURES
	# ----------------------------------------------------------------------------------------------------
	if (MULTILANGUAGE_FEATURE != "on") { exit; }

    $url_redirect = "".DEFAULT_URL."/sitemgr/langcenter";
    $url_base = "".DEFAULT_URL."/sitemgr";
    $sitemgr = 1;

    $url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

    extract($_GET);
    extract($_POST);

	# ----------------------------------------------------------------------------------------------------
    # SUBMIT
    # ----------------------------------------------------------------------------------------------------
    if ($direction) {   
        $langObj = new Lang($id);
        $langObj->changeOrder($direction);
        $langObj->writeLanguageFile();
		if ($direction=='up') $url_redirect .= "/index.php?message=1"; elseif ($direction=='down') $url_redirect .= "/index.php?message=2";
        header("Location: $url_redirect");
        exit;
    } elseif ($default) {
        $langObj = new Lang($id);
        $langObj->setDefault();
        $langObj->writeLanguageFile();
		$url_redirect .= "?message=3";
        header("Location: $url_redirect");
        exit;  
    } elseif ($active) {
        $message = 4;
		if ($active=='y')  $url_redirect .= "/index.php?message=5";
		if ($active=='n')  $url_redirect .= "/index.php?message=4";
		$langObj = new Lang($id);
        $activation = $langObj->changeStatus();
        if ( $activation ) {
			$url_redirect = "".DEFAULT_URL."/sitemgr/langcenter";
			unset($message);
        	echo "
        		<script type='text/javascript'' src='".DEFAULT_URL."/scripts/common.js'></script>
        		<script type='text/javascript'' src='".DEFAULT_URL."/scripts/jquery.js'></script>
        		<script type='text/javascript'' src='".DEFAULT_URL."/scripts/jquery/jquery_ui/js/jquery-ui-1.7.2.custom.min.js'></script>
        		<script type='text/javascript'>
        			dialogBox('alert','".system_showText(LANG_SITEMGR_MSGERROR_MAXLANGENABLED)."');
        		</script>
        	";			
        }
        else {
        	$langObj->writeLanguageFile(); 
        	header("Location: $url_redirect");
        	exit;
		}
    } elseif ($edit_name) {
        $langObj = new Lang($edit_name);
        $langObj->setString('name', $lang_name);
        $langObj->Save();
        header("Location: $url_redirect/index.php?message=6");
        exit;
    }
	
	if ($message) {
		if ($message==1)
			$message = system_showText(LANG_SITEMGR_LANGUAGE_SUCCESSFULLY_MOVEDUP);
		elseif ($message==2)
			$message = system_showText(LANG_SITEMGR_LANGUAGE_SUCCESSFULLY_MOVEDDOWN);
		elseif ($message==3)
			$message = system_showText(LANG_SITEMGR_DEFAULT_LANGUAGE_SUCCESSFULLY_CHANGED);
		elseif ($message==4)
			$message = system_showText(LANG_SITEMGR_LANGUAGE_SUCCESSFULLY_ACTIVATED);
		elseif ($message==5)
			$message = system_showText(LANG_SITEMGR_LANGUAGE_SUCCESSFULLY_DEACTIVATED);
        elseif ($message==6)
			$message = system_showText(LANG_SITEMGR_LANGUAGE_NAME_SUCCESSFULLY_CHANGED);
	}

    # ----------------------------------------------------------------------------------------------------
    // Page Browsing /////////////////////////////////////////
    $pageObj  = new pageBrowsing("Lang", $screen, 10, "lang_default DESC, lang_order", "name", $letter);
    $langs    = $pageObj->retrievePage();

    $paging_url = DEFAULT_URL."/sitemgr/langcenter/index.php";

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

	//increases frequently actions
	if (!isset($message)) system_setFreqActions('prefs_langcenter','MULTILANGUAGE_FEATURE');


?>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=system_showText(LANG_SITEMGR_LANGCENTER_LANGUAGECENTER)?></h1>
		</div>
	</div>
	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			
            <div class="langPagingContent">
				<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
            </div>
            
			<? 			
	        if ($message) {
	         echo "<p class=\"successMessage\">".$message."</p>";
	        } 
	        ?>
			
            <? if ($langs) { ?>
                <? include(INCLUDES_DIR."/tables/table_lang.php"); ?>
            <? } else { ?>
                <p class="informationMessage">
                    <?=system_showText(LANG_SITEMGR_LANGCENTER_NORECORDS)?>
                </p>
            <? } ?>

		</div>
	</div>

	<div id="bottom-content">
		&nbsp;
	</div>

</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
