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
	# * FILE: /sitemgr/emailnotifications/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");
	unset($_SESSION["emailSession"]);

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();
		
	$url_redirect = "".DEFAULT_URL."/sitemgr/emailnotifications";
	
	
	extract($_GET);
    extract($_POST);
	
	//increases frequently actions
	system_setFreqActions('prefs_emailnotific','emailnotif');

	# ----------------------------------------------------------------------------------------------------
	# ENABLE/DISABLE NOTIFICATION
	# ----------------------------------------------------------------------------------------------------	
	if (($deactive=='0') || ($deactive=='1')) {	
        $emailObj = new EmailNotification($id);
        $activation = $emailObj->changeStatus();  
		if ( $activation ) {
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
        	header("Location: $url_redirect");
        	exit;
		}		
    }

	# ----------------------------------------------------------------------------------------------------
	# PAGE BROWSING
	# ----------------------------------------------------------------------------------------------------
	$pageObj  = new pageBrowsing("Email_Notification", $screen, RESULTS_PER_PAGE, "id", "id", $letter);
	$emails = $pageObj->retrievePage();

	$paging_url = DEFAULT_URL."/sitemgr/emailnotifications/index.php";

	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------

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
			<h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=string_ucwords(system_showText(LANG_SITEMGR_MENU_EMAILNOTIF))?></h1>
		</div>
	</div>
	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<br />

			<div id="header-export">
			<?=system_showText(LANG_SITEMGR_EMAILNOTIFICATION_TITLEMANAGE)?>
			</div>
			<?
			include(INCLUDES_DIR."/tables/table_paging.php");
			include(INCLUDES_DIR."/tables/table_notifications.php");
			?>
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
