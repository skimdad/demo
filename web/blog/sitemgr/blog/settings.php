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
	# * FILE: /blog/sitemgr/blog/settings.php
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

	$url_redirect = "".BLOG_DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER;
	$url_base = "".BLOG_DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$postObj = new Post($id);
	} else {
		header("Location: ".BLOG_DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER."/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if (validate_formBlog("postsettings", $_POST, $message_postsettings)) {
			$categories=$postObj->getCategories($id);
			foreach ($categories as $category){
				$cont = $category->getNumber("active_post");
				$old_status = $postObj->getString("status");
				if (($_POST['status']=="A") && ($_POST['status']!=$old_status)){
					$cont++;
					$category->setNumber("active_post", $cont);
					$category->Save();
				} elseif (($_POST['status']=="S") && ($_POST['status']!=$old_status)){
					$cont--;
					$category->setNumber("active_post", $cont);
					$category->Save();
				}
			}
			$postObj->setString("status", $_POST['status']);
			$postObj->Save();
			$message = 1;
			header("Location: ".BLOG_DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER."/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	
	// Status Drop Down

	unset($arrayValueDD);
	unset($arrayNameDD);
	
	$arrayNameDD = Array("Active", "Suspended");
	$arrayValueDD = Array("A", "S");
	
	$statusDropDown = html_selectBox("status", $arrayNameDD, $arrayValueDD, $postObj->getString("status"), "", "class='input-dd-form-settings'", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");


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
		<div id="header-content"><h1><?=string_ucwords(system_showText(LANG_SITEMGR_POST_BLOG_SING))?> <?=system_showText(LANG_SITEMGR_STATUS)?></h1></div>
	</div>

	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<?if (CUSTOM_BLOG_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>

			<? include(BLOG_INCLUDES_DIR."/tables/table_blog_submenu.php"); ?>

			<br />
			
			<div class="baseForm">

			<form name="post_setting" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				<input type="hidden" name="id" value="<?=$id?>" />

				<? include(BLOG_INCLUDES_DIR."/forms/form_postsettings.php"); ?>

				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<button type="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
				<button type="button" name="back" value="Back" class="input-button-form" onclick="document.getElementById('formpostsettingscancel').submit();"><?=system_showText(LANG_SITEMGR_BACK)?></button>

			</form>
			<form id="formpostsettingscancel" action="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">

				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />

			</form>
			
			</div>
			<? } ?>

		</div>

	</div>

	<div id="bottom-content">&nbsp;</div>

</div>


<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>