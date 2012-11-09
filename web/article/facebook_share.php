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
	# * FILE: /article/facebook_share.php
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

	if (($cid || $did || $rid) || $friendly_url) {

		if ($cid) {
			$articleObj = new Article($cid);
			$type = "review";
		} else if ($did) {
			$articleObj = new Article($did);
			$type = "detail";
		} else if ($rid) {
			$articleObj = new Article($rid);
			$type = "result";
		} else $articleObj = db_getFromDB("article", "friendly_url", db_formatString($friendly_url));

		$id = $articleObj->getNumber("id");
		$friendly_url = $articleObj->getString("friendly_url");

		if ($aFrom[0] == "share" || $aFrom[0] == "reviews" || $type == "detail" || $type == "review") {
			if (MODREWRITE_FEATURE == "on") {
				if (string_strtolower($aFrom[0]) == "reviews" || $type == "review") {
					$sbmLink = ARTICLE_DEFAULT_URL."/reviews/".$friendly_url;
				} else {
					$sbmLink = ARTICLE_DEFAULT_URL."/".$friendly_url.".html";
				}
			} else {
				if (string_strtolower($aFrom[0]) == "reviews" || $type == "review") {
					$sbmLink = ARTICLE_DEFAULT_URL."/comments.php?item_id=".$id;
				} else {
					$sbmLink = ARTICLE_DEFAULT_URL."/detail.php?id=".$id;
				}
			 }
		} else {
			$sbmLink = ARTICLE_DEFAULT_URL."/results.php?id=".$id;
		}

		if (string_strpos($_SERVER["HTTP_USER_AGENT"], "http://www.facebook.com/externalhit_uatext.php") === false) {
			header("Location: ".$sbmLink);
			exit;
		}
		$labelsuffix = language_getIndex(EDIR_LANGUAGE);
		$description = $articleObj->getString("abstract".$labelsuffix);
		$title = $articleObj->getString("title");
		$dbObj = db_getDBObject();

		$sqlGI = "SELECT `gallery_id` FROM `Gallery_Item` WHERE `item_id` = ".$articleObj->getNumber("id")." AND `item_type` = 'article' LIMIT 1";
		$resGI = $dbObj->Query($sqlGI);

		$rowGI = mysql_fetch_assoc($resGI);

		$galObj = new Gallery();

		$images = $galObj->getAllImages($rowGI["gallery_id"]);

		?>
		<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="en" lang="en">
			<head>
				<title><?=$title;?></title>
				<meta name="description" content="<?=$description;?>" />
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			</head>
			<body>
				<?
					if (is_array($images) && $images[0]) {
						foreach ($images as $image) {
							$imgObj = new Image($image["image_id"]);
							echo $imgObj->getTag(false, 0, 0, $image["image_caption"]);
						}
					}
				?>
			</body>
		</html>
		<?
	} else {
		header("Location: ".ARTICLE_DEFAULT_URL);
		exit;
	}
?>