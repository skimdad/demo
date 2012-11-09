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
	# * FILE: /members/event/delete.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on" || CUSTOM_EVENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();

	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$event = new Event($id);
		if (sess_getAccountIdFromSession() != $event->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/members/".EVENT_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/members/".EVENT_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$event = new Event($_POST['id']);
		$event->delete();
		header("Location: ".DEFAULT_URL."/members/".EVENT_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
		exit;
	}

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

				<h2><?=system_showText(LANG_EVENT_DELETE)?></h2>

				<form title="event" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
					<input type="hidden" name="id" value="<?=$id?>" />
					<input type="hidden" name="letter" value="<?=$letter?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />

						<p><?=system_showText(LANG_EVENT_DELETE_INFORMATION)?> - <strong><?=$event->getString("title")?></strong></p>

						<p class="informationMessage"><?=system_showText(LANG_EVENT_DELETE_CONFIRM)?></p>
						
						<div class="baseButtons floatButtons">

							<p class="standardButton">
								<button type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
							</p>
							
						</div>
							
					</form>
					<form action="<?=DEFAULT_URL?>/members/<?=EVENT_FEATURE_FOLDER;?>/index.php" method="get">
						<input type="hidden" name="letter" value="<?=$letter?>" />
						<input type="hidden" name="screen" value="<?=$screen?>" />
						
						<div class="baseButtons floatButtons noPadding">

							<p class="standardButton">
								<button type="submit" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
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