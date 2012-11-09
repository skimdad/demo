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
	# * FILE: /deal/facebook_share.php
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
			$promotionObj = new Promotion($cid);
			$type = "review";
		} else if ($did) {
			$promotionObj = new Promotion($did);
			$type = "detail";
		} else if ($rid) {
			$promotionObj = new Promotion($rid);
			$type = "result";
		} else $promotionObj = db_getFromDB("promotion", "friendly_url", db_formatString($friendly_url));

		$id = $promotionObj->getNumber("id");
		$friendly_url = $promotionObj->getString("friendly_url");

		if ($aFrom[0] == "share" || $aFrom[0] == "reviews" || $type == "detail" || $type == "review") {
			if (MODREWRITE_FEATURE == "on") {
				if (string_strtolower($aFrom[0]) == "reviews" || $type == "review") {
					$sbmLink = PROMOTION_DEFAULT_URL."/reviews/".$friendly_url;
				} else {
					$sbmLink = PROMOTION_DEFAULT_URL."/".$friendly_url.".html";
				}
			} else {
				if (string_strtolower($aFrom[0]) == "reviews" || $type == "review") {
					$sbmLink = PROMOTION_DEFAULT_URL."/comments.php?item_id=".$id;
				} else {
					$sbmLink = PROMOTION_DEFAULT_URL."/detail.php?id=".$id;
				}
			 }
		} else {
			$sbmLink = PROMOTION_DEFAULT_URL."/results.php?id=".$id;
		}

		if (string_strpos($_SERVER["HTTP_USER_AGENT"], "http://www.facebook.com/externalhit_uatext.php") === false) {
			header("Location: ".$sbmLink);
			exit;
		}
		$labelsuffix = language_getIndex(EDIR_LANGUAGE);
		$description = $promotionObj->getString("description".$labelsuffix);
		$title = $promotionObj->getString("title");


		?>
		<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="en" lang="en">
			<head>
				<title><?=$title;?></title>
				<meta name="description" content="<?=$description;?>" />
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			</head>
			<body>
				<?
					if ($promotionObj->getNumber("image_id")){
						$imgObj = new Image($promotionObj->getNumber("image_id"));
						
						echo $imgObj->getTag(false, 0, 0);
					}
				?>
			</body>
		</html>
		<?
	} else {
		header("Location: ".PROMOTION_DEFAULT_URL);
		exit;
	}
?>