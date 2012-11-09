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
	# * FILE: /sitemgr/article/preview.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/sitemgr/".ARTICLE_FEATURE_FOLDER;
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
		$article = new Article($id);
		if ((!$article->getNumber("id")) || ($article->getNumber("id") <= 0)) {
			$error = true;
		}
	} else {
		$error = true;
	}

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	# ----------------------------------------------------------------------------------------------------
	# REVIEWS
	# ----------------------------------------------------------------------------------------------------
	if ($id)  $sql_where[] = " item_type = 'article' AND item_id = ".db_formatNumber($id)." ";
	if (true) $sql_where[] = " review IS NOT NULL AND review != '' ";
	if (true) $sql_where[] = " approved = '1' ";
	if ($sql_where) $sqlwhere .= " ".implode(" AND ", $sql_where)." ";
	$pageObj  = new pageBrowsing("Review", $screen, 3, "added DESC", "", "", $sqlwhere);
	$reviewsArr = $pageObj->retrievePage("object");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
		<title><?=system_showText(LANG_SITEMGR_HOME_WELCOME) . " - " . system_showText(LANG_SITEMGR_ARTICLE_SING)?> <?=system_showText(LANG_SITEMGR_PREVIEW)?></title>
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
		<?if (CUSTOM_ARTICLE_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>
			<?
			if (!$error) {

				$level = new ArticleLevel();
				
				?>
				
				<div class="level level-preview">
					
					<div class="level-summary">	

						<p class="preview-desc"><?=system_showText(LANG_SITEMGR_SUMMARYPAGE);?></p>

						<?
						$type = "summary";
						include(INCLUDES_DIR."/views/view_article_summary.php");
						?>

					</div>
					
					<?
					
					$type = "detail";
					$typePreview = "detail"; 
					
					if ($level->getDetail($article->getNumber("level")) == "y") { ?>
					
						<div class="level-detail">

							<p class="preview-desc"><?=system_showText(LANG_SITEMGR_DETAILPAGE);?></p>

							<div class="content">
								<? include(INCLUDES_DIR."/views/view_article_detail.php"); ?>
							</div>

							<div class="sidebar">
								<? include(ARTICLE_EDIRECTORY_ROOT."/detail_reviews.php"); ?>
							</div>

						</div>
					<? } ?>
					
				</div>
				
				<?
			} else { ?>
				<p class="errorMessage"><?=system_showText(LANG_MSG_NOTFOUND);?></p>
			<? } 
			}
		?>

	</body>
</html>