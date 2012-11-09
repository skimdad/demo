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
	# * FILE: /blog/populartopics.php
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

	$numberOfPosts = 5;
	$sql = "SELECT Post.* FROM Post WHERE Post.publication_date <= DATE_FORMAT( NOW( ) , '%Y-%m-%d' ) AND Post.status = 'A' ORDER BY Post.number_views DESC LIMIT $numberOfPosts";
	$pop_posts = db_getFromDBBySQL_Blog("post", $sql);

	$user = true;

	if (is_array($pop_posts) &&  $pop_posts[0]) {
		foreach ($pop_posts as $pop_post) {

			if (MODREWRITE_FEATURE == "on") {
				$detailLink = "".BLOG_DEFAULT_URL."/".$pop_post->getString("friendly_url").".html";
			} else {
				$detailLink = "".BLOG_DEFAULT_URL."/detail.php?id=".$pop_post->getNumber("id");
			}

			$popular_post .= "<div class=\"item\">";

			$imageObj = new Image($pop_post->getNumber("thumb_id"));
			$thumbcaption = $pop_post->getStringLang(EDIR_LANGUAGE, "thumb_caption");
			if ($imageObj->imageExists()) {
				$popular_post .= "<div class=\"image\"><a href=\"".$detailLink."\">";
				$popular_post .= $imageObj->getTag(true, SIDEBAR_FEATURED_WIDTH, SIDEBAR_FEATURED_HEIGHT, ($thumbcaption ? $thumbcaption : $pop_post->getString("title", true)), true);
				$popular_post .= "</a></div>";
			} else {
				$popular_post .= "<div class=\"image\">";
				$popular_post .= "<a href=\"".$detailLink."\" title=\"".($pop_post->getString("title"))."\"><span class=\"no-image\"></span></a>";
				$popular_post .= "</div>";
			}

			$popular_post .= "<h3><a href=\"".$detailLink."\" title=\"".($pop_post->getString("title"))."\">".$pop_post->getString("title")."</a></h3>";

			if ($pop_post->getString("publication_date", true)) {
				$popular_post .= "<p>".LANG_BLOG_ON." ".format_date($pop_post->getString("publication_date"),DEFAULT_DATE_FORMAT, "datetime")." - ".$pop_post->getTimeString()."</p>";
			}
			$popular_post .= "</div>";
		}
	}
	if ($popular_post){?>

		<h2><?=system_showText(LANG_BLOG_POPULARTOPICS)?></h2>
		<div class="blog-item">
			<?=$popular_post?>
		</div>
		
<? } ?>