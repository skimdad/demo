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
	# * FILE: /members/banner/preview.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BANNER_FEATURE != "on" || CUSTOM_BANNER_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$error = false;
	if ($id) {
		$banner = new Banner($id);
		if ((!$banner->getNumber("id")) || ($banner->getNumber("id") <= 0)) {
			$error = true;
		}
		if (sess_getAccountIdFromSession() != $banner->getNumber("account_id")) {
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
		<? if (sess_getAccountIdFromSession()) {
					$dbObjWelcome = db_getDBObJect(DEFAULT_DB, true);
					$sqlWelcome = "SELECT first_name, last_name FROM Contact WHERE account_id = ".sess_getAccountIdFromSession();
					$resultWelcome = $dbObjWelcome->query($sqlWelcome);
					$contactWelcome = mysql_fetch_assoc($resultWelcome);
		} ?>
		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
		<title><?=( ($contactWelcome) ? $contactWelcome["first_name"]." ".$contactWelcome["last_name"].", " : "" ) . system_showText(LANG_MSG_WELCOME) . " - " . system_showText(LANG_BANNER_PREVIEW);?></title>
		<?
		include(THEMEFILE_DIR."/".EDIR_THEME."/".EDIR_THEME.".php");
		?>
		<?=system_getNoImageStyle($cssfile = true);?>
	</head>
	<body class="previewmember">

		<?
		if (!$error) {
			?>
			<br />
			<?
			$bannerObj = new Banner();
			$banner_info = $bannerObj->retrieve($id);
			$banner = $bannerObj->makeBanner($banner_info, $_GET["lang"]);

		?>
				<div class="level">

					<div class="level-summary">
						<?=$banner?>
					</div>

				</div>

				<?
			} else {?>
				<p class="errorMessage"><?=system_showText(LANG_MSG_NOTFOUND);?></p>
			<?}
		?>
	</body>
</html>