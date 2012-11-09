<?

	/*!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==*\
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
	\*!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /sitemgr/getstarted.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	include("../conf/loadconfig.inc.php");

	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="en" lang="en">
	<head>
		<?
			customtext_get("header_title", $headertag_title, EDIR_LANGUAGE);
			$headertag_title = (($headertag_title) ? ($headertag_title) : (EDIRECTORY_TITLE));
		?>
		<title><?= ((string_strpos($_SERVER["PHP_SELF"], "registration.php")) ? '' : system_showText(LANG_SITEMGR_HOME_WELCOME). " - ") . $headertag_title?></title>
		<meta name="author" content="Arca Solutions" />
		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
		<meta name="ROBOTS" content="noindex, nofollow" />

		<?=system_getNoImageStyle($cssfile = true);?>
        <? /* GENERAL STYLE */ ?>
        <link href="<?=DEFAULT_URL?>/sitemgr/layout/general_sitemgr.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript">
		<!--
		DEFAULT_URL = "<?=DEFAULT_URL?>";
		-->
		</script>

		<script type="text/javascript" src="<?=DEFAULT_URL?>/lang/<?=EDIR_LANGUAGE?>.js"></script>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery.js"></script>

	</head>

	<body>
		<div class="wrapper wrapper-start">
			<?
			include(INCLUDES_DIR."/forms/form_getstarted.php");
			?>
		</div>
	</body>
</html>
