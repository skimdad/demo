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
	# * FILE: /blog/facebook_share.php
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

	$aFrom = explode("/", $from);

	if ($id || $friendly_url) {

		if ($id) $postObj = new Post($id);
		else {
			$dbObj = db_getDBObject();
			$sql = "SELECT * FROM `Post` WHERE `friendly_url` = '".$friendly_url."'";
			$res = $dbObj->Query($sql);
			if (mysql_num_rows($res)) {
				$row = mysql_fetch_assoc($res);
				$postObj = new Post($row);
			}
		}

		$id = $postObj->getNumber("id");
		$friendly_url = $postObj->getString("friendly_url");

		if (MODREWRITE_FEATURE == "on") {
			$sbmLink = BLOG_DEFAULT_URL."/".$postObj->getString("friendly_url").".html";
		} else {
			$sbmLink = BLOG_DEFAULT_URL."/detail.php?id=".$postObj->getNumber("id");
		}

		if (string_strpos($_SERVER["HTTP_USER_AGENT"], "http://www.facebook.com/externalhit_uatext.php") === false) {
			header("Location: ".$sbmLink);
			exit;
		}
		
		$description = nl2br(blog_getContentbyCharacters($postObj->getStringLang(EDIR_LANGUAGE, "content", false), BLOG_MAX_CHARACTERS, $sbmLink));
		$title = $postObj->getString("title");
		?>
		<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="en" lang="en">
			<head>
				<title><?=$title;?></title>
				<meta name="description" content="<?=$description;?>" />
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			</head>
			<body>
				<?
					if ($postObj->getNumber("image_id")) {
						$imgObj = new Image($postObj->getNumber("image_id"));
						echo $imgObj->getTag();
					}
				?>
			</body>
		</html>
		<?
	} else {
		header("Location: ".BLOG_DEFAULT_URL);
		exit;
	}
?>