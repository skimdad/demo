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
	# * FILE: /classidied/facebook_share.php
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

	if (($did || $rid) || $friendly_url) {

		if ($did) {
			$classifiedObj = new Classified($did);
			$type = "detail";
		} else if ($rid) {
			$classifiedObj = new Classified($rid);
			$type = "result";
		} else $classifiedObj = db_getFromDB("classified", "friendly_url", db_formatString($friendly_url));

		$id = $classifiedObj->getNumber("id");
		$friendly_url = $classifiedObj->getString("friendly_url");

		if ($aFrom[0] == "share" || $type == "detail") {
			if (MODREWRITE_FEATURE == "on") {
				$sbmLink = CLASSIFIED_DEFAULT_URL."/".$friendly_url.".html";
			} else {
				$sbmLink = CLASSIFIED_DEFAULT_URL."/detail.php?id=".$id;
			 }
		} else {
			$sbmLink = CLASSIFIED_DEFAULT_URL."/results.php?id=".$id;
		}

		if (string_strpos($_SERVER["HTTP_USER_AGENT"], "http://www.facebook.com/externalhit_uatext.php") === false) {
			header("Location: ".$sbmLink);
			exit;
		}
		$labelsuffix = language_getIndex(EDIR_LANGUAGE);
		$description = $classifiedObj->getString("summarydesc".$labelsuffix);
		$title = $classifiedObj->getString("title");
        $level = $classifiedObj->getNumber("level");
		$dbObj = db_getDBObject();

		$sqlGI = "SELECT `gallery_id` FROM `Gallery_Item` WHERE `item_id` = ".$classifiedObj->getNumber("id")." AND `item_type` = 'classified' LIMIT 1";
		$resGI = $dbObj->Query($sqlGI);

		$rowGI = mysql_fetch_assoc($resGI);

		$galObj = new Gallery();

		$images = $galObj->getAllImages($rowGI["gallery_id"]);
        
        $levelObj = new ClassifiedLevel();
        //Get fields according to level
        unset($array_fields);
        $array_fields = system_getFormFields("Classified", $level);
        $levelMaxImages = $levelObj->getImages($level);
        $hasImage = false;
        if ((is_array($array_fields) && in_array("main_image", $array_fields)) || $levelMaxImages > 0){
            $hasImage = true;
        }

		?>
		<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="en" lang="en">
			<head>
				<title><?=$title;?></title>
				<meta name="description" content="<?=$description;?>" />
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			</head>
			<body>
				<?
					if ($hasImage) {
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
		header("Location: ".CLASSIFIED_DEFAULT_URL);
		exit;
	}
?>