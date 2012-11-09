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
	# * FILE: /sitemgr/emailnotifications/email.php
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

	if (!isset($_POST["nav_page"])) $_POST["nav_page"] = 0;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	if ($_REQUEST['id'] && $_REQUEST['id'] <= 36) {
		$_GET = format_magicQuotes($_GET);
		extract($_GET);
		$_POST = format_magicQuotes($_POST);
		extract($_POST);
		$clang = !$_REQUEST['clang'] ? EDIR_DEFAULT_LANGUAGE : $_REQUEST['clang'];
		include(INCLUDES_DIR."/code/email_notification.php");
	} else {
		header("Location: ./");
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

	if ($_SERVER['REQUEST_METHOD'] != 'POST') {
		$_GET = format_magicQuotes($_GET);
		extract($_GET);
		$_POST = format_magicQuotes($_POST);
		extract($_POST);
	}

	$nav_page++;
	if ($nav_page > 2) $nav_page = 1;

?>

<script language="javascript">

	function showWarning() {
		if(document.emailnotifications.deactivate.checked) {
			document.getElementById("box-warning").style.display = 'block'
		} else {
			document.getElementById("box-warning").style.display = 'none'
		}
	}

	function changeComboLang (value) {
		if (value)
			window.location.href = "email.php?id=<?=$id?>&clang="+value;
		return true;
	}

</script>

<div id="main-right">
	<div id="top-content">
		<div id="header-content">
			<h1><?=string_ucwords(system_showText(LANG_SITEMGR_MENU_EMAILNOTIF))?></h1>
		</div>
	</div>
	<div id="content-content">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<form name="emailnotifications" id="emailnotifications" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" style="margin:0px; padding: 0px;">
			<input name="id" type="hidden" value="<?=$_REQUEST['id']?>" />
			<input name="email" type="hidden" value="<?=$emailNotificationObj->getString("email")?>" />
			<input name="nav_page" id="nav_page" type="hidden" value="<?=$nav_page?>" />
			<br />
			<div class="default-margin">
				<div id="header-export"><?=system_showText(LANG_SITEMGR_EMAILNOTIFICATION_TITLEMANAGE)?></div>
				<? if($nav_page==1) { ?>
					<ul class="list-view">
						<li><a href="<?=DEFAULT_URL?>/sitemgr/emailnotifications/"><?=system_showText(LANG_SITEMGR_BACK)?></a></li>
					</ul>
				<? } ?>
				<p class="informationMessage">
                    <?=system_showText(@constant("LANG_SITEMGR_EMAILNOTIF_DESC_".$emailNotificationObjAux->getNumber("id")))?>
				</p>
			</div>

			<table class="table-form">
				<tr>
					<td>
						<table width="500" class="table-form" border="0" cellpadding="2" cellspacing="2">
							<tr>
								<td>
								<?
								if ($nav_page==1) {
									include(INCLUDES_DIR."/forms/form_emailnotification.php");
								} else if($nav_page==2) {
									include(INCLUDES_DIR."/forms/form_emailnotification2.php");
								}
								?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>

			<table style="margin: 0 auto 0 auto;" cellspacing="4">
				<tr>
					<td>
						<? if ($nav_page==1) { ?>
							<input type="submit" name="next" value="<?=system_showText(LANG_SITEMGR_NEXT)?>" class="input-button-form" />
						<? } elseif($nav_page==2) { ?>
							<input type="button" name="back" value="<?=system_showText(LANG_SITEMGR_BACK)?>" class="input-button-form" onclick="JS_Back();" />
					</td>
					<td>
							<input type="submit" name="save" value="<?=system_showText(LANG_SITEMGR_SAVE)?>" class="input-button-form" />
						<? } ?>
					</td>
				</tr>
			</table>

		</form>

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
