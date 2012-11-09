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
	# * FILE: /sitemgr/domain/delete.php
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

	if (sess_getSMIdFromSession() || $_GET["id"] == SELECTED_DOMAIN_ID) header("Location: ".DEFAULT_URL."/sitemgr/domain");

	$url_redirect = "".DEFAULT_URL."/sitemgr/domain";
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	extract($_GET);
	extract($_POST);


	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$domain = new Domain($id);
	} else {
		//$message = system_showText(LANG_SITEMGR_DOMAIN_MIGHTBEDELETED);
        $message = 2;
		header("Location: ".DEFAULT_URL."/sitemgr/domain/index.php?message=".$message."&screen=$screen&letter=$letter");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		$domain = new Domain($_POST['id']);
		$domain->Delete();
		//$message = system_showText(LANG_SITEMGR_DOMAIN_SING)." ".system_showText(LANG_SITEMGR_WASSUCCESSDELETED);
        $message = 1;
		header("Location: ".DEFAULT_URL."/sitemgr/domain/index.php?message=".$message."&screen=$screen&letter=$letter");
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

	if (DEMO_LIVE_MODE) { ?>

		<script language="javascrip" type="text/javascript">
            $(document).ready(function(){
                fancy_alert('<?=system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE3);?>', 'informationMessage', false, 450, 100, true);
                setTimeout("window.location=\"<?=DEFAULT_URL;?>/sitemgr/domain/\"", 5000);
            });
		</script>
        
    <? } ?>
        
<div id="main-right">
	<div id="top-content">
		<div id="header-content">
			<h1><?=string_ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=LANG_SITEMGR_DOMAIN;?></h1>
		</div>
	</div>
	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<div class="baseForm">

			<form name="domain" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">
				<input type="hidden" name="id" value="<?=$id?>" />
				<div class="header-form">
					<?=string_ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=system_showText(LANG_SITEMGR_DOMAIN_SING)?> - <?=$domain->getString("name")?>
				</div>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_DOMAIN_DELETEQUESTION)?>
					<br />
					<?=system_showText(LANG_SITEMGR_DOMAIN_DELETEQUESTION2)?> <a href="<?=DEFAULT_URL;?>/sitemgr/faq/faq.php?keyword=<?=urlencode("delete a site");?>" target="_blank"><?=system_showText(LANG_SITEMGR_DOMAIN_DELETEQUESTION3)?></a>
				</p>
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<button type="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
				<button type="button" value="Cancel" class="input-button-form" onclick="document.getElementById('formdomaindeletecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
			</form>
			<form id="formdomaindeletecancel" action="<?=DEFAULT_URL?>/sitemgr/domain/index.php" method="post">
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
			</form>
		</div>
	</div>
	<div id="bottom-content">
		&nbsp;
	</div>
</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
