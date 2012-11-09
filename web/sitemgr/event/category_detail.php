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
	# * FILE: /sitemgr/event/category_detail.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/sitemgr/".EVENT_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
	<head>
		<title><?=system_showText(LANG_SITEMGR_HOME_WELCOME) . " - " . string_ucwords(system_showText(LANG_SITEMGR_CATEGORYDETAIL))?></title>
        <link href="<?=DEFAULT_URL?>/sitemgr/layout/general_sitemgr.css" rel="stylesheet" type="text/css" media="all" />
		<link href="<?=DEFAULT_URL?>/sitemgr/layout/popup.css" rel="stylesheet" type="text/css" media="all" />
		<script>window.focus();</script>
	</head>
	<body>
		<div>
			<h2 class="standardTitle"><?=system_showText(LANG_SITEMGR_CATEGORYVIEWPATH)?></h2>
			<? include(EDIRECTORY_ROOT."/includes/views/view_event_category_detail.php"); ?>
		</div>
	</body>
</html>
