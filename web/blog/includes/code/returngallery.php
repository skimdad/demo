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
	# * FILE: blog/includes/code/returngallery.php
	# ----------------------------------------------------------------------------------------------------

    $aux_domain_id = $_GET["domain_id"] ? $_GET["domain_id"] : SELECTED_DOMAIN_ID;

    if (!defined("SELECTED_DOMAIN_ID")){
        define("SELECTED_DOMAIN_ID", $aux_domain_id);
    }

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	// HTTPS ON NEED TO REWRITE URL FOR AJAX REQUEST
    if (SSL_ENABLED == "on" && $_SERVER["HTTPS"] == "on"){
        $blog_default_url = SECURE_URL."/".BLOG_FEATURE_FOLDER;
	} else {
        $blog_default_url = NON_SECURE_URL."/".BLOG_FEATURE_FOLDER;
	}
        
	$id = $_GET["id"] ? $_GET["id"] : 0;
	$new_image = $_GET["new_image"];
	$gallery_hash = $_GET["gallery_hash"];
	
	if ($id != 0) {
		$post = db_getFromDB_Blog("post", "id", db_formatNumber($id), 1, "", "object", $aux_domain_id);
		$post->extract();
	} 

	$langIndex = language_getIndex(EDIR_LANGUAGE);
	
	$return_code = "";
	if ($thumb_id) {
		$thumbObj = new Image($thumb_id);

		$thumb_caption = ${"thumb_caption".$langIndex};

		$return_code .= $thumbObj->getTag(true, IMAGE_BLOG_THUMB_WIDTH, IMAGE_BLOG_THUMB_HEIGHT, $thumb_caption, true);
		$return_code .= "<h5>".system_showTruncatedText($thumb_caption, 40)."</h5>";
		$return_code .= "<a href=\"".$blog_default_url."/sitemgr/uploadimage.php?item_type=post&item_id=".$id."&image_id=".$image_id."&thumb_id=".$thumb_id."&captions=y\" class=\"ImageEditCaptions iframe fancy_window_imgAdd\">".LANG_LABEL_EDIT_CAPTIONS."</a>";
		$return_code .= "<a href=\"".DEFAULT_URL."/sitemgr/delete_image.php?item_type=post&item_id=".$id."\" class=\"ImageDelete iframe fancy_window_imgDelete\" >".LANG_LABEL_DELETE."</a>";

	}
	
	if ($new_image == "y"){
		
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$db = db_getDBObjectByDomainID($aux_domain_id, $dbMain);
		$sess_id = $gallery_hash;

		$sql = "SELECT * FROM Gallery_Temp WHERE sess_id = '$sess_id'";
		$r = $db->query($sql);
		while ($row = mysql_fetch_array($r)) {
			$thumbObj = new Image($row["thumb_id"]);

			$thumb_caption = $row["thumb_caption".$langIndex];
			$thumb_caption = system_showTruncatedText($row["thumb_caption".$langIndex], 40);

			$return_code .= $thumbObj->getTag(true, IMAGE_BLOG_THUMB_WIDTH, IMAGE_BLOG_THUMB_HEIGHT, $thumb_caption, true);
			$return_code .= "<h5>".$thumb_caption."</h5>";
			$return_code .= "<a href=\"".$blog_default_url."/sitemgr/uploadimage.php?temp=y&item_type=post&item_id=".$id."&gallery_id=".$gallery_id."&image_id=".$row["image_id"]."&thumb_id=".$row["thumb_id"]."&captions=y\" class=\"ImageEditCaptions iframe fancy_window_imgAdd\">".LANG_LABEL_EDIT_CAPTIONS."</a>";
			$return_code .= "<a href=\"".DEFAULT_URL."/sitemgr/delete_image.php?temp=y&item_type=post&item_id=".$id."&gallery_image_id=".$row["image_id"]."&gallery_id=".$gallery_id."\" class=\"ImageDelete iframe fancy_window_imgDelete\" >".LANG_LABEL_DELETE."</a>";
		}
	}
	
	$return_code .= "";
	if ($return_code == "") {
		$return_code = "no image";
	}

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
    header("Accept-Encoding: gzip, deflate");
    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check", FALSE);
    header("Pragma: no-cache");
	
	echo $return_code;
?>