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
	# * FILE: /members/article/seocenter.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on" || CUSTOM_ARTICLE_FEATURE != "on") { exit; }

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

	$url_redirect = "".DEFAULT_URL."/members/".ARTICLE_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/members";
	$members = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$errorPage = "".DEFAULT_URL."/members/".ARTICLE_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter";
	if ($id) {
		$article = new Article($id);
		if ((!$article->getNumber("id")) || ($article->getNumber("id") <= 0)) {
			header("Location: ".$errorPage);
			exit;
		}
		if (sess_getAccountIdFromSession() != $article->getNumber("account_id")) {
			header("Location: ".$errorPage);
			exit;
		}
	} else {
		header("Location: ".$errorPage);
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/article_seocenter.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

?>

			<div class="content">

					<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
					<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
					<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

					<h2><?=ucfirst(system_showText(LANG_ARTICLE));?> - <?=ucfirst(system_showText(LANG_MSG_SEO_CENTER));?></h2>

					<form name="articleseocenter" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

						<input type="hidden" name="id" id="id" value="<?=$id?>" />
						<input type="hidden" name="letter" id="letter" value="<?=$letter?>" />
						<input type="hidden" name="screen" id="screen" value="<?=$screen?>" />
						<? include(INCLUDES_DIR."/forms/form_article_seocenter.php"); ?>
						
						<div class="baseButtons floatButtons">

							<p class="standardButton">
								<button type="submit" name="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
							</p>
							
						</div>

					</form>

					<form action="<?=DEFAULT_URL?>/members/<?=ARTICLE_FEATURE_FOLDER;?>/index.php" method="post">

						<input type="hidden" name="letter" value="<?=$letter?>" />
						<input type="hidden" name="screen" value="<?=$screen?>" />
						
						<div class="baseButtons floatButtons noPadding">
						
							<p class="standardButton">
								<button type="submit" name="cancel" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
							</p>
						
						</div>

					</form>

			</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
