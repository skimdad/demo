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
	# * FILE: /sitemgr/content/content_noimage.php
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

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);	

	//increases frequently actions
	if (!isset($image_type)) system_setFreqActions('content_noimage','content');

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(INCLUDES_DIR."/code/content_noimage.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");
?>

<script type="text/javascript">
<!--
function JS_submit() {
	$("#submit_button").attr("value", 1);
	document.noimage.submit();
}
-->
</script>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=system_showText(LANG_SITEMGR_CONTENT_MANAGENOIMAGE)?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_content_submenu.php"); ?>
			
		<div class="tip-base"><p style="text-align: left;">
			<a href="<?=DEFAULT_URL;?>/sitemgr/faq/faq.php?keyword=<?=urlencode("default image");?>" target="_blank"><?=system_showText(LANG_SITEMGR_CONTENT_FAQTITLE)?></a></p>
		</div>
        
        <br />

			<? if ($message_noimage) { ?>
				<? if ($success) { ?>
					<p class="successMessage"><?=$message_noimage?></p>
				<? } else { ?>
					<p class="errorMessage"><?=$message_noimage?></p>
				<? } ?>
			<? } ?>
			
			<div class="baseForm">

			<form name="noimage" id="noimage" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" enctype="multipart/form-data">

				<? include(INCLUDES_DIR."/forms/form_content_noimage.php"); ?>

				<button type="button" name="submit_button" value="Submit" class="input-button-form" onclick="<?=DEMO_LIVE_MODE ? "livemodeMessage('".system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE2)."');" : "JS_submit();"?>"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
				<button type="button" value="Cancel" class="input-button-form" onclick="document.getElementById('formcontentnoimagecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

				<input type="hidden" name="ieBugFix2" value="1" />
				<input type="hidden" name="submit_button" id="submit_button" />

			</form>
			<form id="formcontentnoimagecancel" action="<?=DEFAULT_URL?>/sitemgr/content/index.php" method="post">
			</form>
			
			</div>

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
