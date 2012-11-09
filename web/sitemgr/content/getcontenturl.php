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
	# * FILE: /sitemgr/content/getcontenturl.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
	<head>
		<title><?=system_showText(LANG_SITEMGR_HOME_WELCOME) . " - " . string_ucwords(system_showText(LANG_SITEMGR_CONTENT_CONTENTURL))?></title>
		<link href="<?=DEFAULT_URL?>/sitemgr/layout/general_sitemgr.css" rel="stylesheet" type="text/css" media="all" />
		<link href="<?=DEFAULT_URL?>/sitemgr/layout/popup.css" rel="stylesheet" type="text/css" media="all" />
		<script>window.focus();</script>
	</head>
	<body>
		<div>
			<h2 class="standardTitle"><?=string_ucwords(system_showText(LANG_SITEMGR_VIEW))?> <?=string_ucwords(system_showText(LANG_SITEMGR_CONTENT_CONTENTURL))?></h2>
			<?
			$thisurl = $_GET["newurl"]."/content/";
			if (MODREWRITE_FEATURE != "on") {
				$thisurl .= "index.php?content=";
			}
			$thisurl .= $_GET["c"];
			if (MODREWRITE_FEATURE == "on") {
				$thisurl .= ".html";
			}
			$str = "<a href=\"$thisurl\" target=\"_blank\">$thisurl</a>";
			
			echo "<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$str."<br /><br />";
			?>
		</div>
	</body>
</html>
