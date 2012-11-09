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
	# * FILE: /sitemgr/content/delete.php
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
	extract($_GET);
	extract($_POST);

	if ($id) {
		$content = new Content($id);
		if (!$content->getNumber("id")) {
			header("Location: ".DEFAULT_URL."/sitemgr/content/client.php");
			exit;
		}
		if ($content->getString("section") != "client") {
			header("Location: ".DEFAULT_URL."/sitemgr/content/client.php");
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/sitemgr/content/client.php");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$content = new Content($_POST['id']);
		$content->Delete();
        $message = 5;
		header("Location: ".DEFAULT_URL."/sitemgr/content/client.php?message=".$message."");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

<script>
	function redirect(){
		document.location.href="<?=DEFAULT_URL?>/sitemgr/content/client.php";
	}
</script>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=string_ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=string_ucwords(system_showText(LANG_SITEMGR_CONTENT))?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
			
			<div class="baseForm">

			<form name="content" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

				<input type="hidden" name="id" value="<?=$id?>" />

				<div class="header-form"><?=string_ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=string_ucwords(system_showText(LANG_SITEMGR_CONTENT))?> - <?=$content->getString("type")?></div>

				<p class="informationMessage"><?=system_showText(LANG_SITEMGR_CONTENT_DELETEQUESTION)?></p>

				<button type="submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

			</form>

			<button type="button" title="cancel" class="input-button-form" onclick="javascript:redirect();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
			
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
