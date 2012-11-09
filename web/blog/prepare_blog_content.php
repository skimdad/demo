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
	# * FILE: /blog/prepare_results.php
	# ----------------------------------------------------------------------------------------------------

	report_newRecordPost("post", $post->getString("id"), POST_REPORT_SUMMARY_VIEW);
	
	setting_get("wp_enabled", $wp_enabled);
	
	if (BLOG_WITH_WORDPRESS == "on"){
		$force_blog_module = true;
	}
				
	if (MODREWRITE_FEATURE == "on") {
		$detailLink = "".BLOG_DEFAULT_URL."/".$post->getString("friendly_url").".html";
	} else {
		$detailLink = "".BLOG_DEFAULT_URL."/detail.php?id=".$post->getNumber("id");
	}
	$styleLink = "";
	if (!$user) {
		$detailLink = "javascript:void(0);";
		$styleLink = "style=\"cursor:default\"";
	}
	
	$postStyle = "";
	if (!$user){
		$postStyle = "style=\"cursor:default\"";
	}

	$truncatedTitle = $post->getString("title", true, 40);
	$title = $post->getString("title");
	$categories = $post->getCategories($post->id);
	if ($categories) {
		$post_category = blog_generateTag($categories, $user);
        if ($post_category)
		$postCategoryTree = system_showText(((count($categories) > 1) ? (LANG_BLOG_TAGS) : (LANG_BLOG_TAG))).": ".$post_category;
	}
	$postOn = LANG_BLOG_ON." ".format_date($post->getString("publication_date"),DEFAULT_DATE_FORMAT, "datetime")." - ".$post->getTimeString();

	$imageObj = new Image($post->getNumber("image_id"));
	if ($imageObj->imageExists()) {
		$thumbcaption = $post->getStringLang(EDIR_LANGUAGE, "thumb_caption");
		$postImage = $imageObj->getTag(true, IMAGE_BLOG_THUMB_WIDTH_FULL, IMAGE_BLOG_THUMB_HEIGHT_FULL, ($thumbcaption ? $thumbcaption : $post->getString("title", true)), true);
	} else {
		if ($wp_enabled == "on" && $force_blog_module){
			$postImage = "";
		} else {
			$postImage = "<span class=\"no-image\"></span>";
		}
		
	}

	$more = false;
	if($post->getStringLang(EDIR_LANGUAGE, "content", false)) {
		if($wp_enabled == "on"){
			$postContent = $post->getStringLang(EDIR_LANGUAGE, "content", false);
		}else{
			$postContent = nl2br(blog_getContentbyCharacters($post->getStringLang(EDIR_LANGUAGE, "content", false, $more), BLOG_MAX_CHARACTERS, $detailLink, $more));
		}
		
	} else {
		$postContent = "";
	}	
	
	if ($isDetail){
		$imageObj = new Image($post->getNumber("image_id"));
		$thumbcaption = $post->getStringLang(EDIR_LANGUAGE, "thumb_caption");
		$imagecaption = $post->getStringLang(EDIR_LANGUAGE, "image_caption");
		if ($imageObj->imageExists()) {
			$imageTag .= "<div class=\"no-link\" ".(RESIZE_IMAGES_UPGRADE == "off" ? "style=\"text-align:center\"" : "").">";
			$imageTag .= $imageObj->getTag(true, IMAGE_BLOG_FULL_WIDTH, IMAGE_BLOG_FULL_HEIGHT, ($thumbcaption ? $thumbcaption : $post->getString("title", true)), true);
			$imageTag .= "</div>";
            $aux_thumbcaption = "";
            if (USE_GALLERY_PLUGIN){
                $aux_thumbcaption = "<strong style=\"display:block\">$thumbcaption</strong>";
            }
            if ($imagecaption) $imageTag .= "<p class=\"image-caption\">$aux_thumbcaption".$imagecaption."</p>";
		} else {
			if ($wp_enabled == "on" && $force_blog_module){
				$imageTag = "";
			} else{
				$imageTag = "<span class=\"no-image no-link\"></span>";
			}
		}
		
		include(BLOG_INCLUDES_DIR."/views/icon_post.php");
		
		$content = $post->getStringLang(EDIR_LANGUAGE, "content", false);
		
		if (!$user) {

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			$sql_comment = "SELECT * FROM Comments WHERE post_id = $id AND reply_id = 0 AND approved = 1 ORDER BY `added` DESC";
			$result = $dbObj->query($sql_comment);
			while ($row = mysql_fetch_assoc($result)) {
				$commentArr[] = $row;
			}
		}
		if ($commentArr) {
			for ($i = 0; $i < count($commentArr); $i++) {
				
				if($i==0){
					$className = "first";
				}else{
					$className = "";
				}
				
				include(BLOG_INCLUDES_DIR . "/views/view_comment_detail.php");
				$detail_comment .= $item_reviewcomment;
			}
		}		
	}
?>