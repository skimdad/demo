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
	# * FILE: /includes/code/checkin.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if (!$item_type && !$item_id) {
		header("location: ".DEFAULT_URL."/index.php");
		exit;
	}

	$itemObj = new Listing($item_id);

	$hostCheckin = string_strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));
	$host_cookieCheckin = str_replace(".", "_", $hostCheckin);


	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$success_checkin = false;

	$socialObj = new SettingSocialNetwork($item_type."_rate");
	$status = $socialObj->getString('value');
	if ($status == "yes" || sess_getAccountIdFromSession()) {
		$id = sess_getAccountIdFromSession();
		$checkinerAcc = new Account($id);
		$checkinerInfo = new Contact($id);
		$checkinerProfile = new Profile($id);
	}
		
	# ----------------------------------------------------------------------------------------------------
	# FORM DEFINES
	# ----------------------------------------------------------------------------------------------------

	$_POST = format_magicQuotes($_POST);
	$_GET  = format_magicQuotes($_GET);
	extract($_POST);
	extract($_GET);

?>