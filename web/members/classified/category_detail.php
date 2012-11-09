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
	# * FILE: /members/classified/category_detail.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on" || CUSTOM_CLASSIFIED_FEATURE != "on") { exit; }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
	<head>
		<title><?=system_showText(LANG_MSG_WELCOME) . " - " . system_showText(LANG_LABEL_CATEGORY_DETAIL)?></title>
		<?
		/* MEMBERS AREA WITH THEME STYLE */
		include(THEMEFILE_DIR."/".EDIR_THEME_MEMBERS."/".EDIR_THEME_MEMBERS.".php");
		?>
	</head>
	<body>
		<div class="popupWrapper">
			<h2><?=system_showText(LANG_BUTTON_VIEWCATEGORYPATH)?></h2>
			<? include(EDIRECTORY_ROOT."/includes/views/view_classified_category_detail.php"); ?>
		</div>
	</body>
</html>
