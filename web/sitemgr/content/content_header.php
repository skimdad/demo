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
	# * FILE: /sitemgr/content/content_header.php
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
	if (!isset($crop_submit)) system_setFreqActions('content_header','content');
	
	$clang = $clang ? $clang : EDIR_DEFAULT_LANGUAGE;
	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	
	include(INCLUDES_DIR."/code/content_header.php");
	
    
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
function changeComboLang (value) {
	if (value)
		window.location.href = "content_header.php?clang="+value;
	return true;
}

function JS_submit() {
	$("#submit_button").attr("value", 1);
	document.header.submit();
}
-->
</script>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=ucfirst(system_showText(LANG_SITEMGR_CONTENT_MANAGEHEADERCONTENT))?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_content_submenu.php"); ?>

			<br />

			<? if ($message_header) { ?>
				<p class="<? if ($error) echo "errorMessage"; else echo "successMessage"; ?>"><?=$message_header?></p>
			<? } ?>

			<div class="baseForm">

			<form name="header" id="header" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" enctype="multipart/form-data">
                
                <input type="hidden" name="crop_submit" id="crop_submit">
                <input type="hidden" name="submit_button" id="submit_button" />

				<? include(INCLUDES_DIR."/forms/form_content_header.php"); ?>

				<button type="button" name="submit_button" value="Submit" class="input-button-form" onclick="<?=DEMO_LIVE_MODE ? "livemodeMessage('".system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE2)."');" : "JS_submit();"?>"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
				<button type="button" value="Cancel" class="input-button-form" onclick="document.getElementById('formcontentheadercancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

				<input type="hidden" name="ieBugFix2" value="1" /> 

			</form>

			<form id="formcontentheadercancel" action="<?=DEFAULT_URL?>/sitemgr/content/index.php" method="post">
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
