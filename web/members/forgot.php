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
	# * FILE: /members/forgot.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	$cancel_section = MEMBERS_ALIAS;
	if (sess_isAccountLogged()) {
		$accObj = new Account(sess_getAccountIdFromSession());
		if ($accObj->getString("is_sponsor") == "y") $cancel_section = MEMBERS_ALIAS;
		else $cancel_section = SOCIALNETWORK_FEATURE_NAME;
	}
	$section = "members";
	include(INCLUDES_DIR."/code/forgot_password.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

?>

		<div class="sidebar">

			<h2><?=system_showText(LANG_LABEL_MEMBER_OPTIONS);?></h2>

			<ul class="memberMenu">
				<li><a href="<?=NON_SECURE_URL?>/index.php"><?=system_showText(LANG_LABEL_BACK_TO_SEARCH);?></a></li>
				<li><a href="<?=NON_SECURE_URL?>/advertise.php"><?=system_showText(LANG_LABEL_ADD_NEW_ACCOUNT);?></a></li>
			</ul>

		</div>

		<div class="content">

			<h2><?=system_showText(LANG_LABEL_FORGOTTEN_PASSWORD)?></h2>

			<form name="forgotpassword" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">
				<? include(INCLUDES_DIR."/forms/form_forgot_password.php"); ?>
			</form>

			<p style="text-align: center; padding: 10px;">
				<a href="<?=DEFAULT_URL?>/members/login.php" class="linkLogin"><?=system_showText(LANG_MSG_CLICK_IF_YOU_HAVE_PASSWORD);?></a>
			</p>

			<p style="text-align: center;"><?=system_showText(LANG_MSG_NOT_A_MEMBER)?>  <a href="<?=NON_SECURE_URL?>/advertise.php" class="linkLogin"><b><?=ucfirst(system_showText(LANG_LABEL_CLICK_HERE))?></b></a> <?=system_showText(LANG_MSG_FOR_INFORMATION_ON_ADDING_YOUR_ITEM)?> <?=EDIRECTORY_TITLE?>.</p>

		</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
