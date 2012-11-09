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
	# * FILE: blog/blog/facebook_comment.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	extract($_GET);

	if ($id) {

		$postObj = new Post($id);
		$friendly_url = $postObj->getString("friendly_url");

		if (MODREWRITE_FEATURE == "on") {
			$sbmLink = BLOG_DEFAULT_URL."/".$friendly_url.".html?fb_comment_id=".$_GET["fb_comment_id"];
		} else {
			$sbmLink = BLOG_DEFAULT_URL."/detail.php?id=".$id."&fb_comment_id=".$_GET["fb_comment_id"];
		 }

		if (string_strpos($_SERVER["HTTP_USER_AGENT"], "http://www.facebook.com/externalhit_uatext.php") === false) {
			header("Location: ".$sbmLink);
			exit;
		}
		$labelsuffix = language_getIndex(EDIR_LANGUAGE);
		$description = nl2br(blog_getContentbyCharacters($postObj->getStringLang(EDIR_LANGUAGE, "content", false), BLOG_MAX_CHARACTERS, $sbmLink));
		$title = $postObj->getString("title");
		$image_id = $postObj->getNumber("image_id");

		?>
		<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="en" lang="en">
			<head>
				<title><?=$title;?></title>
				<meta name="description" content="<?=$description;?>" />
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				<?
				
				echo Facebook::getMetaTags("admins", FACEBOOK_USER_ID);
				echo Facebook::getMetaTags("app_id", FACEBOOK_API_ID);
				
				?>
			</head>
			<body>
				<?
				$imgObj = new Image($image_id);
				echo $imgObj->getTag(false, 0, 0, $title);	
				?>
			</body>
		</html>
		<?
	} else {
		header("Location: ".BLOG_DEFAULT_URL);
		exit;
	}
?>