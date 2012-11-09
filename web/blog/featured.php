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
	# * FILE: /blog/featured.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BLOG_FEATURE != "on" || CUSTOM_BLOG_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	
	extract($_GET);
	if (is_numeric($pn) || !$pn) {
		$numberOfPosts = 4;
		$dbObj = db_getDBObJect();
		unset($posts);
		$select = "SELECT Post.* FROM Post";
		$where = " WHERE Post.publication_date <= NOW( ) AND Post.status = 'A'";
		$order = " ORDER BY Post.entered DESC";
		$limit = " LIMIT $numberOfPosts";

		$sql = $select.$where.$order.$limit;
		$db = db_getDBObject();
		$posts = db_getFromDBBySQL_Blog("post", $sql);

		$showLetter = true;
		if (!$posts){
			$showLetter = false;
		}
		
		$user = true;
		$show_results = true;
		$i = $count;	
		
	}
?>