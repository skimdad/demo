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
	# * FILE: /sitemgr/banner/preview.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BANNER_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_redirect = "".DEFAULT_URL."/sitemgr/".BANNER_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$error = false;
	if ($id) {
		$banner = new Banner($id);
		if ((!$banner->getNumber("id")) || ($banner->getNumber("id") <= 0)) {
			$error = true;
		}
	} else {
		$error = true;
	}

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
		<title><?=system_showText(LANG_SITEMGR_HOME_WELCOME) . " - " . string_ucwords(system_showText(LANG_SITEMGR_BANNER))?> <?=string_ucwords(system_showText(LANG_SITEMGR_PREVIEW))?></title>
		<?
		include(THEMEFILE_DIR."/".EDIR_THEME."/".EDIR_THEME.".php");
		?>  
		<?=system_getNoImageStyle($cssfile = true);?>
	</head>
	<body>

		<?
		if (CUSTOM_BANNER_FEATURE != "on"){ ?>
			<p class="informationMessage">
				<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
			</p>
		<? }else {
			if (!$error) {
				$bannerObj = new Banner();
				$banner_info = $bannerObj->retrieve($id);
				$banner = $bannerObj->makeBanner($banner_info, $_GET["lang"]);

				?>
				<div class="level level-preview level-banner">
					<?=$banner?>
				</div>

				<?
			} else {?>
				<p class="errorMessage"><?=system_showText(LANG_MSG_NOTFOUND);?></p>
			<?}
		}
		?>
	</body>
</html>