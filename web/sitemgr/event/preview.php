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
	# * FILE: /sitemgr/event/preview.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

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

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$error = false;
	if ($id) {
		$event = new Event($id);
		if ((!$event->getNumber("id")) || ($event->getNumber("id") <= 0)) {
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
		<title><?=system_showText(LANG_SITEMGR_HOME_WELCOME) . " - " . system_showText(LANG_SITEMGR_EVENT_SING)?> <?=string_ucwords(system_showText(LANG_SITEMGR_PREVIEW))?></title>
		<?
		include(THEMEFILE_DIR."/".EDIR_THEME."/".EDIR_THEME.".php");
		?>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery.js"></script>
		<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/socialbookmarking.js"></script>
        <? if (USE_GALLERY_PLUGIN){ ?>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/ad-gallery/jquery.ad-gallery.js"></script>
        <? } ?>
		<?=system_getNoImageStyle($cssfile = true);?>
	</head>
	<body>
		<?if (CUSTOM_EVENT_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>
		<?
		if (!$error) {

			$level = new EventLevel();
			
			?>
			
			<div class="level level-preview">

				<div class="level-summary">

					<p class="preview-desc"><?=system_showText(LANG_SITEMGR_SUMMARYPAGE);?></p>

					<?
					$type = "summary";
					include(INCLUDES_DIR."/views/view_event_summary.php");
					?>

				</div>

				<?
				$type = "detail";
				$typePreview = "detail";

				if ($level->getDetail($event->getNumber("level")) == "y") {
				?>

				<div class="level-detail">

					<p class="preview-desc"><?=system_showText(LANG_SITEMGR_DETAILPAGE);?></p>

					<div class="content">
						<?
						include(INCLUDES_DIR."/views/view_event_detail.php");
						?>
					</div>
					
					<div class="sidebar">
						<? include(EVENT_EDIRECTORY_ROOT."/detail_maps.php"); ?>
					</div>

				</div>

				<? } ?>

			</div>
			
			<?
	
		} else { ?>
			<p class="errorMessage"><?=system_showText(LANG_MSG_NOTFOUND);?></p>
		<?}
		}
		?>

	</body>
</html>
