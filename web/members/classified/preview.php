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
	# * FILE: /members/classified/preview.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on" || CUSTOM_CLASSIFIED_FEATURE != "on") { exit; }

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
		$classified = new Classified($id);
		if ((!$classified->getNumber("id")) || ($classified->getNumber("id") <= 0)) {
			$error = true;
		}
		if (sess_getAccountIdFromSession() != $classified->getNumber("account_id")) {
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
		<title><?=( ($contactWelcome) ? $contactWelcome["first_name"]." ".$contactWelcome["last_name"].", " : "" ) . system_showText(LANG_MSG_WELCOME) . " - " . system_showText(LANG_CLASSIFIED_PREVIEW);?></title>
		<?
		include(THEMEFILE_DIR."/".EDIR_THEME."/".EDIR_THEME.".php");
		?>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery.js"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/socialbookmarking.js"></script>
        <? if (USE_GALLERY_PLUGIN){ ?>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/ad-gallery/jquery.ad-gallery.js"></script>
        <? } ?>
		<?=system_getNoImageStyle($cssfile = true);?>
	</head>
	<body class="previewmember">

		<?
		if (!$error) {

			$level = new ClassifiedLevel();
					
			?>
					
			<div class="level level-preview">

				<div class="level-summary">	

					<p class="preview-desc"><?=system_showText(LANG_LABEL_SUMMARY_PAGE);?></p>

					<?
					$type = "summary";
					include(INCLUDES_DIR."/views/view_classified_summary.php");
					?>

				</div>

				<?

				$type = "detail";
				$typePreview = "detail"; 
				if ($level->getDetail($classified->getNumber("level")) == "y") { ?>

					<div class="level-detail">

						<p class="preview-desc"><?=system_showText(LANG_LABEL_DETAIL_PAGE);?></p>

						<div class="content">
							<? include(INCLUDES_DIR."/views/view_classified_detail.php"); ?>
						</div>

						<div class="sidebar">
							<? include(CLASSIFIED_EDIRECTORY_ROOT."/detail_maps.php"); ?>
						</div>

					</div>

				<? } ?>

			</div>
		<? } else { ?>
			<p class="errorMessage"><?=system_showText(LANG_MSG_NOTFOUND);?></p>
		<? } ?>
	</body>
</html>
