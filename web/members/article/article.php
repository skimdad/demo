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
	# * FILE: /members/article/article.php
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
	$item_form = 1;


	/*
	 * Check if need show package
	 */
	if(!$id && !$show_package && $_SERVER['REQUEST_METHOD'] != "POST"){
		/*
		 * Check if exists package
		 */
		$articleLevelObj = new ArticleLevel();
		$level = $articleLevelObj->getDefault();

		$packageObj = new Package();
		$array_package_offers = $packageObj->getPackagesByDomainID(SELECTED_DOMAIN_ID, "article", $level);
		$hasPackage = false;
		if ((is_array($array_package_offers)) and (count($array_package_offers)>0) and $array_package_offers[0]) {
			header("Location: ".DEFAULT_URL."/members/".ARTICLE_FEATURE_FOLDER."/order_package.php?show_package=1&level=".$level);
			exit;
		}
	}
	
	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/article.php");

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

		<? if ($process == "signup") { ?>

            <ul class="standardStep">
                <li class="standardStepAD"><?=system_highlightWords(system_showText(LANG_ENJOY_OUR_SERVICES))?></li>
                <li class="stepDone"><span>1</span>&nbsp;<?=system_showText(LANG_LABEL_ORDER)?></li>
                <li class="stepDone"><span>2</span>&nbsp;<?=system_showText(LANG_LABEL_CHECKOUT)?></li>
                <li class="stepActived"><span>3</span>&nbsp;<?=system_showText(LANG_LABEL_CONFIGURATION)?></li>
            </ul>

		<? } ?>

		<h2><?=system_showText(LANG_ARTICLE_INFORMATION)?></h2>

		<form name="article" id="article" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">

			<? /* Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted) */ ?>

			<input type="hidden" name="ieBugFix" value="1" />

			<? /* Microsoft IE Bug */ ?>

			<input type="hidden" name="process" id="process" value="<?=$process?>" />
			<input type="hidden" name="id" id="id" value="<?=$id?>" />
			<input type="hidden" name="account_id" id="account_id" value="<?=$acctId?>" />
			<input type="hidden" name="level" id="level" value="<?=$level?>" />
			<input type="hidden" name="screen" id="screen" value="<?=$screen?>" />
			<input type="hidden" name="letter" id="letter" value="<?=$letter?>" />
			<input type="hidden" name="using_package" id="using_package" value="<?=($package_id ? "y" : "n")?>" />
			<input type="hidden" name="package_id" id="package_id" value="<?=$package_id?>" />
            <input type="hidden" name="gallery_hash" value="<?=$gallery_hash?>" />

			<? include(INCLUDES_DIR."/forms/form_article.php"); ?>

			<? /* Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted)*/ ?>

			<input type="hidden" name="ieBugFix2" value="1" /> 

			<? /* Microsoft IE Bug */ ?>

		</form>
		<br />
		<form action="<?=DEFAULT_URL?>/members/<?=ARTICLE_FEATURE_FOLDER;?>/index.php" method="post">

			<input type="hidden" name="screen" value="<?=$screen?>" />
			<input type="hidden" name="letter" value="<?=$letter?>" />

			<div class="baseButtons">

				<p class="standardButton">
					<button type="button" onclick="JS_submit()"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
				</p>
				<p class="standardButton">
					<button type="submit" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
				</p>

			</div>

		</form>

	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			//DATE PICKER
			<?
			if ( DEFAULT_DATE_FORMAT == "m/d/Y" ) $date_format = "mm/dd/yy";
			elseif ( DEFAULT_DATE_FORMAT == "d/m/Y" ) $date_format = "dd/mm/yy";
			?>

			$('#publication_date').datepicker({
				dateFormat: '<?=$date_format?>',
				changeMonth: true,
				changeYear: true,
                yearRange: '<?=date("Y")-1?>:<?=date("Y")+10?>'
			});
		});
	</script>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>