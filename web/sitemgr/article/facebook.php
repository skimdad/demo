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
	# * FILE: /sitemgr/article/facebook.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/sitemgr/".ARTICLE_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;
	
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	setting_get("commenting_fb", $commenting_fb);
	if (!$commenting_fb){
		header("Location: ".DEFAULT_URL."/sitemgr/".ARTICLE_FEATURE_FOLDER."/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}
	
	if ($id) {
		$article = new Article($id);
		if ((!$article->getNumber("id")) || ($article->getNumber("id") <= 0)) {
			header("Location: ".DEFAULT_URL."/sitemgr/".ARTICLE_FEATURE_FOLDER."/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/sitemgr/".ARTICLE_FEATURE_FOLDER."/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}
	$facebookScript = true;
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");
?>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=string_ucwords(system_showText(LANG_LABEL_FACEBOOK_COMMENTS))?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_article_submenu.php"); ?>

			<br />

			<div id="header-view">
				<?=LANG_SITEMGR_ARTICLE_SING;?> <?=string_ucwords(system_showText(LANG_LABEL_FACEBOOK_COMMENTS))?> - <?=$article->getString("title")?>
			</div>

			<div class="baseForm">

				<form name="facebook_form" id="facebook_form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
					
					<p class="informationMessage">
						<?=system_showText(LANG_LABEL_FACEBOOK_TIP1)?>
						<br />
						<?=system_showText(LANG_LABEL_FACEBOOK_TIP2)?> <a href="http://developers.facebook.com/tools/comments">http://developers.facebook.com/tools/comments</a>
					</p>
					
					<?
					$detailLink = NON_LANG_URL."/".ARTICLE_FEATURE_FOLDER."/facebook_comment.php?id=".$article->getNumber("id");

					setting_get("commenting_fb_number_comments", $commenting_fb_number_comments);

					?>

					<script>
						(function(d){
						  var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
						  js = d.createElement('script'); js.id = id; js.async = true;
						  js.src = "//connect.facebook.net/<?=EDIR_LANGUAGEFACEBOOK?>/all.js#xfbml=1";
						  d.getElementsByTagName('head')[0].appendChild(js);
						}(document));
					</script>
					<div class="fb-comments" data-href="<?=$detailLink?>" data-num-posts="<?=$commenting_fb_number_comments?>" data-width="500"></div>
							
					<br /><br />

					<button type="button" name="cancel" value="Cancel" class="input-button-form" onclick="document.getElementById('formfacebookcancel').submit();">
						<?=system_showText(LANG_BUTTON_CANCEL)?>
					</button>
				</form>
				<form id="formfacebookcancel" action="<?=DEFAULT_URL?>/sitemgr/<?=ARTICLE_FEATURE_FOLDER;?>/<?=(($search_page) ? "search.php" : "index.php");?>" method="get">

					<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
					<input type="hidden" name="letter" value="<?=$letter?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />

				</form>

			</div>
		</div>
	</div>

	<div id="bottom-content">

	</div>

</div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>