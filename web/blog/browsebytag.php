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
	# * FILE: /blog/browsebytag.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	unset($tagObj);
	$tagObj = new BlogCategory();
	unset($categories);
	setting_get("wp_enabled", $wp_enabled);
	
	$post_featuredcategory="";
	if (FEATURED_CATEGORY == "on")
		setting_get("blog_featuredcategory", $blog_featuredcategory);


	if (BLOG_SCALABILITY_OPTIMIZATION == "on") {
		$dbCatObj = db_getDBObJect();
		$sql = "SELECT * FROM BlogCategory WHERE category_id = '0' ".($blog_featuredcategory? "AND featured = 'y'" : "")." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY active_post DESC LIMIT 20";
		$result = $dbCatObj->query($sql);
		$categories = false;
		while ($row = mysql_fetch_assoc($result)) $categories[] = $row;
		unset($dbCatObj);
	} else {
		$categories = $tagObj->retrieveAllCategories(EDIR_LANGUAGE, $blog_featuredcategory);
	}

	$langIndex = language_getIndex(EDIR_LANGUAGE);
	
	unset($categories_content);

	$total = 0;

	if ($categories) {
		
		echo "<h2>";
		echo "<span>".system_showText(LANG_BLOG_TAGS)."</span>";
		if (BLOG_SCALABILITY_OPTIMIZATION == "on") { 
			echo "<p class=\"viewMore\"><a href=\"".BLOG_DEFAULT_URL."/allcategories.php\">".system_showText(LANG_LISTING_VIEWALLCATEGORIES)."</a></p>";
		} 
		echo "</h2>";
		
		echo "<ul class=\"list ".($wp_enabled == "on" ? "list-category-blog" : "")."\">";
		
		for ($i=0; $i<count($categories); $i++) {
			
			$count_this_category = 0;

			if (MODREWRITE_FEATURE == "on") {
				echo "<li><a href=\"".BLOG_DEFAULT_URL."/guide/".$categories[$i]["friendly_url".$langIndex]."\" title = \"".string_htmlentities(ucfirst($categories[$i]["title".$langIndex]))."\">";
			} else {
				echo "<li><a href=\"".BLOG_DEFAULT_URL."/results.php?category_id=".$categories[$i]["id"]."\" title = \"".string_htmlentities(ucfirst($categories[$i]["title".$langIndex]))."\">";
			}

			echo (string_strlen($categories[$i]["title".$langIndex]) > 25 ? (string_htmlentities(string_substr($categories[$i]["title".$langIndex], 0, 22)."...")) : string_htmlentities($categories[$i]["title".$langIndex]));

			echo "</a>";

			if (SHOW_CATEGORY_COUNT == "on"){
				echo " <span>(".$categories[$i]["active_post"].")</span>";
			}

			echo "</li>";
			
			if ($wp_enabled == "on"){
				blog_generateBrowseByTag($categories[$i]["id"], $blog_featuredcategory, $tagObj);
			}

			$total++;
			$count_this_category++;
			$categories_content[$i]["content"] = $code_include;
			$categories_content[$i]["count"] = $count_this_category;

		}
		
		echo "</ul>";

	}

?>