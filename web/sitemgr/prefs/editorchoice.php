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
	# * FILE: /sitemgr/prefs/editorchoice.php
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
	if (!isset($crop_submit)) system_setFreqActions('prefs_designation','editorchoice');

	if ($delete && $id) {
		$editorChoice = new EditorChoice($id);
	} elseif ($delete && !$id) {
		header("Location: ".DEFAULT_URL."/sitemgr/prefs/editorchoice.php");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($delete) {
			$editorChoice = new EditorChoice($id);
			$editorChoice->delete();
			$message = 0;
			header("Location: ".DEFAULT_URL."/sitemgr/prefs/editorchoice.php?message=".$message."");
			exit;
		} else {
			include(INCLUDES_DIR."/code/editor_choice.php");
		}

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

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1>
				<? if ($delete) { ?>
					<?=system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_DELETECHOICE)?>
				<? } else { ?>
					<?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_DESIGNATIONS)?>
				<? } ?>
			</h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>	

			<br />

			<? if ($delete) { ?>

				<div class="baseForm">

					<form name="account" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

						<input type="hidden" name="id" value="<?=$id?>" />
						<input type="hidden" name="delete" value="y" />

						<div class="header-form">
							<?=system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_DELETELISTINGDESIGNATION)?> - <?=$editorChoice->getString("name")?>
						</div>

						<p class="informationMessage">
							<?
							$imageObj = new Image($editorChoice->getString("image_id"));
							if ($imageObj->imageExists()) {
								echo $imageObj->getTag(true, IMAGE_DESIGNATION_WIDTH, IMAGE_DESIGNATION_HEIGHT, $editorChoice->getString("name"))."<br />";
							}
							?>
							<?=system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_DELETEQUESTION)?>
						</p>

						<button type="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
						<button type="button" value="Cancel" class="input-button-form" onclick="document.getElementById('formeditorchoicecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

					</form>

					<form id="formeditorchoicecancel" action="<?=DEFAULT_URL?>/sitemgr/prefs/editorchoice.php" method="post">
					</form>

				</div>

			<? } else { ?>

				<div class="baseForm">

					<form name="editorchoice" id="editorchoice" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">

						<input type="hidden" name="crop_submit" id="crop_submit">

						<? include(INCLUDES_DIR."/forms/form_editorchoice.php"); ?>

						<button type="submit" name="editorchoice" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

					</form>

				</div>

			<? } ?>

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
