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
	# * FILE: /sitemgr/import/instructions.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		
		<script type="text/javascript">
			<!--
			DEFAULT_URL = "<?=DEFAULT_URL?>";
			-->
		</script>
		
		<script type="text/javascript" src="<?=DEFAULT_URL;?>/scripts/jquery.js"></script>

		<link href="<?=DEFAULT_URL;?>/sitemgr/layout/general_sitemgr.css" rel="stylesheet" type="text/css"/>
		
	</head>
	<body>
		<div class="wrapper import-wrapper">
			<div class="header-form">
				<?=string_ucwords(system_showText(LANG_SITEMGR_IMPORT_HOMETIP1_1));?>
			</div>
            <ul class="import-instructions">
				<?
				echo "<li>".system_showText(LANG_SITEMGR_IMPORT_HOMETEXT2)."</li>";
				echo "<li>".system_showText(LANG_SITEMGR_IMPORT_HOMETIP1_4)."</li>";
				echo "<li>".system_showText(LANG_SITEMGR_IMPORT_HOMETEXT4)." (/ | * . ; _ :).</li>";
				if ($_GET["type"] == "event" && EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on"){
					setting_get("import_update_events", $import_update);
				} else {
					setting_get("import_update_listings", $import_update);
				}
				$message = "";
				if (function_exists("mb_detect_encoding") && function_exists("mb_convert_encoding")) $message = "<li>".system_showText(LANG_SITEMGR_MSG_IMPORT_CONVERT_UTF8)."</li>";
				else $message = system_showText(LANG_SITEMGR_MSG_IMPORT_CHECK_UTF8);
				if ($import_update){
					$message = $message."<li>".system_showText(LANG_SITEMGR_MSG_IMPORT_UPDATE_ITENS)."</li>";
				}
				echo $message;
				echo "<li>".system_showText(LANG_SITEMGR_IMPORT_HOMETEXT1_2)."</li>";
				echo "<li>".system_showText(LANG_SITEMGR_IMPORT_HOMETEXT1_3)."</li>";
				?>
        	</ul>
		</div>
	</body>
</html>