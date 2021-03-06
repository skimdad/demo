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
	# * FILE: /article/categories.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on" || CUSTOM_ARTICLE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$langIndex = language_getIndex(EDIR_LANGUAGE);

	unset($catObj);
	$catObj = new ArticleCategory();
	unset($categories);

	$article_featuredcategory="";
	if (FEATURED_CATEGORY == "on")
		setting_get("article_featuredcategory", $article_featuredcategory);

	if (ARTICLECATEGORY_SCALABILITY_OPTIMIZATION == "on") {
		$dbCatObj = db_getDBObJect();
		$sql = "SELECT id, title$langIndex, friendly_url$langIndex, active_article FROM ArticleCategory WHERE category_id = '0' ".($article_featuredcategory ? "AND featured = 'y'" : "")." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title$langIndex <> '' AND friendly_url$langIndex <> '' AND enabled = 'y' ORDER BY active_article DESC LIMIT 20";
		$result = $dbCatObj->query($sql);
		$categories = false;
		while ($row = mysql_fetch_assoc($result)) $categories[] = $row;
		unset($dbCatObj);
	} else {
		$categories = $catObj->retrieveAllCategories(EDIR_LANGUAGE, $article_featuredcategory);
	}

	unset($categories_content);

	$total = 0; 
	
	if ($categories) { ?>

		<h2>
			<span><?=system_showText(LANG_BROWSEBYCATEGORY)?></span>
			<? if (ARTICLECATEGORY_SCALABILITY_OPTIMIZATION == "on") { ?>
				<a class="view-more" href="<?=ARTICLE_DEFAULT_URL?>/allcategories.php"><?=system_showText(LANG_ARTICLE_VIEWALLCATEGORIES)?></a>
			<? } ?>
		</h2>
	
		<ul class="browse-category">
		
		<?
		for ($i=0; $i<count($categories); $i++) {

			$code_include = "";
			$count_this_category = 0;
			$hasImage = false;

			if (MODREWRITE_FEATURE == "on") {
				$categoryLink = ARTICLE_DEFAULT_URL."/guide/".$categories[$i]["friendly_url".$langIndex];
			} else {
				$categoryLink = ARTICLE_DEFAULT_URL."/results.php?category_id=".$categories[$i]["id"];
			}
			
			echo "<li ".(($total==2) ? ("class=\"last\"") : ("")).">";
					
			echo "<a href=\"".$categoryLink."\">".system_showTruncatedText($categories[$i]["title".$langIndex], 25)."</a>";

			if (SHOW_CATEGORY_COUNT == "on"){
				echo " <span>(".$categories[$i]["active_article"].")</span>";
			}

			$total++;
			$count_this_category++;

			if (ARTICLECATEGORY_SCALABILITY_OPTIMIZATION != "on") {

				unset($subcategories);
				$subcategories = $catObj->retrieveAllSubCatById($categories[$i]["id"], EDIR_LANGUAGE, $article_featuredcategory);

				if ($subcategories) {
					
					echo "<ul>";

					unset($code_include_aux);

					for ($j=0; $j<count($subcategories); $j++) {

						if (MODREWRITE_FEATURE == "on") {
							$subCategoryLink = ARTICLE_DEFAULT_URL."/guide/".$categories[$i]["friendly_url".$langIndex]."/".$subcategories[$j]["friendly_url".$langIndex];
						} else {
							$subCategoryLink = ARTICLE_DEFAULT_URL."/results.php?category_id=".$subcategories[$j]["id"];
						}

						echo "<li>";

						echo "<a href=\"".$subCategoryLink."\">".system_showTruncatedText($subcategories[$j]["title".$langIndex], 25)."</a>";
						
						if (SHOW_CATEGORY_COUNT == "on"){
							echo " <span>(".$subcategories[$j]["active_article"].")</span>";
						}
						
						echo "</li>";

						$count_this_category++;

					}
					
					echo "</ul>";

				}

			}
			
			echo "</li>";
			
			if($total==3){
				echo "<li class=\"clear\">&nbsp;</li>";
				$total=0;
			}

		} ?>
		
		</ul>
		
		<?
	} ?>
	
	
