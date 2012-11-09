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
	# * FILE: /includes/code/reviewformpopup.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if (!$_GET['review'] && !$_POST['review']) {
		unset($review);
	}

	reset($_POST); foreach($_POST as $key=>$value) { $_POST[$key] = trim($value); }
	reset($_GET);  foreach($_GET as $key=>$value) { $_GET[$key] = trim($value); }
	
	extract($_POST);
	extract($_GET);

	$rating = $_POST["rating"];
	include(INCLUDES_DIR."/code/review.php");
    
?>