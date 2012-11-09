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
	# * FILE: /sitemgr/listing/twilio_report.php
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

	extract($_GET);
	extract($_POST);

    # ----------------------------------------------------------------------------------------------------
    # OBJECTS
    # ----------------------------------------------------------------------------------------------------
	if (TWILIO_APP_ENABLED == "on" && TWILIO_APP_ENABLED_CALL == "on"){
		if (($item_id && $item_type) && ($item_type == "listing")) {
			$listing = new Listing($item_id);
		} else {
			exit;
		}
	} else {
		exit;
	}

	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
		<link href="<?=DEFAULT_URL?>/sitemgr/layout/general_sitemgr.css" rel="stylesheet" type="text/css" />
		<link href="<?=DEFAULT_URL?>/sitemgr/layout/popup.css" rel="stylesheet" type="text/css" media="all" />
        <? include(EDIRECTORY_ROOT."/includes/code/ie6pngfix.php"); ?>
	</head>
	
	<body>
		<h2 class="standardTitle">
			<?=system_showText(LANG_LISTING_FEATURE_NAME)?> - <?=system_showText(LANG_CLICKTOCALL_REPORT)?> - <?=$listing->getString("title", true, 35);?>
		</h2>
		<?
		include(INCLUDES_DIR."/tables/table_twilio_report.php");			
		?>
	</body>
</html>