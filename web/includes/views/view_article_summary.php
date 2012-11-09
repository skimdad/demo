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
	# * FILE: /includes/views/view_article_summary.php
	# ----------------------------------------------------------------------------------------------------

	if (MODREWRITE_FEATURE == "on") {
		$detailLink = "".ARTICLE_DEFAULT_URL."/".$article->getString("friendly_url").".html";
	} else {
		$detailLink = "".ARTICLE_DEFAULT_URL."/detail.php?id=".$article->getNumber("id");
	}
	
	if (!$user) {
		$detailLink = "javascript: void(0);";
	}
	
	$summaryTitle = "";
	if (($user) && ($level->getDetail($article->getNumber("level")) == "y")) {
		$summaryTitle = "<a href=\"$detailLink\">";
	}
	$summaryTitle .= $article->getString("title");
	if (($user) && ($level->getDetail($article->getNumber("level")) == "y")) {
		$summaryTitle .= "</a>";
	}
	
	if ($article->getString("publication_date", true)) {
		$publication_date = system_showText(LANG_ARTICLE_PUBLISHED).": ".$article->getDate("publication_date");
	}
	
	if ($article->getString("author", true)) {
		$author = " ".system_showText(LANG_BY)." ";
		if ($article->getString("author_url", true)) {

			if ($user) {
				$author .= "<a href=\"".$article->getString("author_url", true)."\" target=\"_blank\">\n";
			} else {
				$author .= "<a href=\"javascript:void(0);\" style=\"cursor:default\">\n";
			}
			$author .= $authorLink;
		}
		$author .= $article->getString("author", true);
		if ($article->getString("author_url", true)) {
			$author .= "</a>\n";
		}
	} else {
		$name = socialnetwork_writeLink($article->getNumber("account_id"), "profile", "general_see_profile", false, false, false, "", $user);
		if ($name) {
			$author = " ".system_showText(LANG_BY)." ".$name;
		}
	}
	if ($tPreview) {
		$relatedCategories = system_showText(LANG_IN)." "; 
		$relatedCategories .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">".system_showText(LANG_LABEL_ADVERTISE_CATEGORY)."</a>";
	} else {
		if(ARTICLE_SCALABILITY_OPTIMIZATION == "on"){
			$complementary_info = "<a href=\"javascript: void(0);\" ".($user ? "onclick=\"showCategory(".htmlspecialchars($article->getNumber("id")).", 'article', ".($user ? true : false).", ".$article->getNumber("account_id").")\"" : "style=\"cursor: default;\"").">".system_showText(LANG_VIEWCATEGORY)."</a>";
		} else {
			$relatedCategories = " ".system_itemRelatedCategories($article->getNumber("id"), "article", $user);
			$complementary_info = $publication_date . $author . $relatedCategories;
		}
	}
	
	$summaryImage = "";
	if ($user){
		$summaryImageStyle = "";
	} else {
		$summaryImageStyle = "style=\"cursor:default\"";
	}
	
	if ($tPreview) {
		$summaryImage = "<span class=\"no-image\" style=\"cursor: default;\"></span>";
	} else {
		if ($article->getNumber("thumb_id")){
			$imageObj = new Image($article->getNumber("thumb_id"));
			if ($imageObj->imageExists()) {
				if (($user) && ($level->getDetail($article->getNumber("level")) == "y")) $summaryImage = "<a href=\"".$detailLink."\">";
				if (!$user) $summaryImage = "<a href=\"javascript: void(0);\" style=\"cursor:default\">";
				$summaryImage .= $imageObj->getTag(true, IMAGE_ARTICLE_THUMB_WIDTH, IMAGE_ARTICLE_THUMB_HEIGHT, $article->getString("title"), true);
				if (!$user) $summaryImage .= "</a>";
				if (($user) && ($level->getDetail($article->getNumber("level")) == "y")) $summaryImage .= "</a>";
			} else {
				if (($user) && ($level->getDetail($article->getNumber("level")) == "y")){
					$summaryImage =  "<a href=\"".$detailLink."\">";
					$summaryImage .=  "<span class=\"no-image\"></span>";
					$summaryImage .=  "</a>";
				} else {
					$summaryImage = "<span class=\"no-image\"></span>";
				}
			}
		} else {
			$summaryImage =  "<a href=\"".$detailLink."\">";
			$summaryImage .=  "<span class=\"no-image\" $summaryImageStyle></span>";
			$summaryImage .=  "</a>";
		}
	}
	
	$summaryDescription = nl2br($article->getStringLang(EDIR_LANGUAGE, "abstract", true));
	
	setting_get('commenting_edir', $commenting_edir);
	setting_get('review_article_enabled', $review_enabled);
	if ($review_enabled == 'on' && $commenting_edir) {
		$item_type = 'article';
		$item_id   = $article->getNumber('id');
		$itemObj   = $article;
	    include(INCLUDES_DIR."/views/view_review.php");
	} else {
		$item_review = "";
	}
	
	include(EDIRECTORY_ROOT. "/includes/views/icon_article.php");
    
    $summaryFileName = INCLUDES_DIR."/views/view_article_summary_code.php";
    $themeSummaryFileName = INCLUDES_DIR."/views/view_article_summary_code_".EDIR_THEME.".php";

    if (file_exists($themeSummaryFileName)){
        include($themeSummaryFileName);
    } else {
        include($summaryFileName);
    }
?>