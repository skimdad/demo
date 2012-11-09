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
	# * FILE: blog/sitemgr/blog/preview.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BLOG_FEATURE != "on") { exit; }

	
	/*
     * Session variable to force connection with second DB
     */
    $_SESSION["FORCE_SECOND"] = false;
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER;
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
		$post = new Post($id);
		if ((!$post->getNumber("id")) || ($post->getNumber("id") <= 0)) {
			$error = true;
		}
	} else {
		$error = true;
	}

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	$user = false;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
		<title><?=system_showText(LANG_SITEMGR_HOME_WELCOME) . " - " . system_showText(LANG_SITEMGR_POST_SING)?> <?=system_showText(LANG_SITEMGR_PREVIEW)?></title>
		<?
		include(THEMEFILE_DIR."/".EDIR_THEME."/".EDIR_THEME.".php");
		?>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery.js"></script>
		<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/socialbookmarking.js"></script>
		<?=system_getNoImageStyle($cssfile = true);?>
	</head>
	<body>
		<?if (CUSTOM_BLOG_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>
		<?
			if (!$error) {
				
				?>
				
				<div class="level level-preview">

					<div class="level-summary">	
						<p class="preview-desc"><?=system_showText(LANG_SITEMGR_SUMMARYPAGE);?></p>
						<?
						$type = "summary";
						include(BLOG_EDIRECTORY_ROOT."/prepare_blog_content.php");
						include(BLOG_INCLUDES_DIR."/views/icon_post.php");
                        
                        $summaryFileName = BLOG_INCLUDES_DIR."/views/view_post_summary.php";
                        $themesummaryFileName = BLOG_INCLUDES_DIR."/views/view_post_summary_".EDIR_THEME.".php";

                        if (file_exists($themesummaryFileName)){
                            include($themesummaryFileName);
                        } else {
                            include($summaryFileName);
                        }
                        
						$type = "detail";
						$isDetail = true;
						?>
					</div>
					
					<div class="level-detail">

						<p class="preview-desc"><?=system_showText(LANG_SITEMGR_DETAILPAGE);?></p>

						<div class="content">
							<? include(BLOG_EDIRECTORY_ROOT."/prepare_blog_content.php"); ?>
							<? 
                            $summaryFileName = BLOG_INCLUDES_DIR."/views/view_post_detail.php";
                            $themeSummaryFileName = BLOG_INCLUDES_DIR."/views/view_post_detail_".EDIR_THEME.".php";

                            if (file_exists($themeSummaryFileName)){
                                include($themeSummaryFileName);
                            } else {
                                include($summaryFileName);
                            }
                            ?>
						</div>

					</div>
					
				</div>
				
				<?
			} else { ?>
				<p class="errorMessage"><?=system_showText(LANG_MSG_NOTFOUND);?></p>
			<? }
		}
		?>

	</body>
</html>
