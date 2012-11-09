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
	# * FILE: /article/featured.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on" || CUSTOM_ARTICLE_FEATURE != "on") { exit; }
	
	// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedArticle2-->
	<?

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$numberOfArticles = 9;
	$lastItemStyle = 0;
	$specialItem = 3;

	$level = implode(",", system_getLevelDetail("ArticleLevel"));

	if ($level) {
		unset($searchReturn);
		$searchReturn = search_frontArticleSearch($_GET, "random");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." (Article.level IN (".$level.")) ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ORDER BY `random_number` LIMIT ".$numberOfArticles."";
		$random_articles = db_getFromDBBySQL("article", $sql);
	}

	if ($random_articles) {
		$top_featured_article = "";
		$featured_article = "";
		?>
		
		<h2>
			<span><?=system_showText(LANG_FEATURED_ARTICLE)?></span>
			<?
			if (ARTICLE_SCALABILITY_OPTIMIZATION != "on"){
				$seeAllText = system_showText(LANG_LABEL_VIEW_ALL_ARTICLES);
				$seeAllTextLink = (MODREWRITE_FEATURE == "on" ? ARTICLE_DEFAULT_URL."/search/empty/where/empty" : ARTICLE_DEFAULT_URL."/results.php"); ?>
			
				
			<? } ?>
		</h2>
		
		<div class="featured featured-article">		

		<?
		$user = true;
		$count = 0;
		$countSpecialItem = 0;
		$ids_report_lote = "";
		foreach ($random_articles as $article) {

			$ids_report_lote .= $article->getString("id").",";

			if (MODREWRITE_FEATURE == "on") {
				$detailLink = "".ARTICLE_DEFAULT_URL."/".$article->getString("friendly_url").".html";
			} else {
				$detailLink = "".ARTICLE_DEFAULT_URL."/detail.php?id=".$article->getNumber("id")."";
			}
			
			$lastItemStyle++;
			
			if($countSpecialItem<$specialItem){
				
				if($countSpecialItem==0){
					echo "<div class=\"left\">";
				}
				
				if(($lastItemStyle%2) && ($lastItemStyle!=1)){
					echo "<br class=\"clear\" />";
				}
				
				echo "<div class=\"featured-item featured-item-special\">";

				echo "<div class=\"image\">";

				$imageObj = new Image($article->getNumber("thumb_id"));
				if ($imageObj->imageExists()) {
					echo "<a href=\"".$detailLink."\" class=\"image\">";
					echo $imageObj->getTag(true, IMAGE_FRONT_ARTICLE_WIDTH, IMAGE_FRONT_ARTICLE_HEIGHT, $article->getString("title"), true);
					echo "</a>";
				} else {
					echo "<a href=\"".$detailLink."\" class=\"image\">";
					echo "<span class=\"no-image\"></span>";
					echo "</a>";
				}

				echo "</div>";

				echo "<h3><a href=\"".$detailLink."\">".$article->getString("title", true)."</a></h3>";

                if(ARTICLE_SCALABILITY_OPTIMIZATION == "on"){
                    
                    $article_moreInfo = "<a href=\"javascript: void(0);\" onclick=\"showCategory(".htmlspecialchars($article->getNumber("id")).", 'article', ".(true).", ".$article->getNumber("account_id").", ".(true).", 0);\" \>".system_showText(LANG_VIEWCATEGORY)."</a>";
                    echo  "<p id=\"showCategory_article".$article->getNumber("id")."\">$article_moreInfo</p>";
                    
                } else {

                    $publication_string = "";
                    if ($article->getString("publication_date", true)) {
                        $publication_string .= system_showText(LANG_ARTICLE_PUBLISHED).": ".$article->getDate("publication_date");
                    }

                    $author_string = "";
                    if ($article->getString("author", true)) {
                        $author_string .= system_showText(LANG_BY)." ";
                        if ($article->getString("author_url", true)) {
                            $author_string .= "<a href=\"".$article->getString("author_url", true)."\" target=\"_blank\">\n";
                        }
                        $author_string .= " ".$article->getString("author", true);
                        if ($article->getString("author_url", true)) {
                            $author_string .= "</a>\n";
                        }
                    } else {
                        $name = socialnetwork_writeLink($article->getNumber("account_id"), "profile", "general_see_profile");
                        if ($name) {
                            $author_string .= " ".system_showText(LANG_BY)." ".$name;
                        }
                    }

                    echo "<p>".$publication_string." ".$author_string." ".system_itemRelatedCategories($article->getNumber("id"), "article", true)."</p>";
                }
                
				echo "<p>".$article->getStringLang(EDIR_LANGUAGE, "abstract", true, 140)."</p>";

				echo "</div>";
			
				if($countSpecialItem == ($specialItem-1) || (count($random_articles) == $countSpecialItem +1)){
					echo "</div>";
				}
				
				$countSpecialItem++;

			} else {

				if($lastItemStyle==$numberOfArticles){
					$itemStyle = "last";
				}elseif($lastItemStyle==($specialItem+1)){
					$itemStyle = "first";
				}else{
					$itemStyle = "";
				}
			
				echo "<div class=\"featured-item ".$itemStyle."\">";

				echo "<h3><a href=\"".$detailLink."\">".$article->getString("title", true)."</a></h3>";

                if(ARTICLE_SCALABILITY_OPTIMIZATION == "on"){
                    
                    $article_moreInfo = "<a href=\"javascript: void(0);\" onclick=\"showCategory(".htmlspecialchars($article->getNumber("id")).", 'article', ".(true).", ".$article->getNumber("account_id").", ".(true).", 0);\" \>".system_showText(LANG_VIEWCATEGORY)."</a>";
                    echo  "<p id=\"showCategory_article".$article->getNumber("id")."\">$article_moreInfo</p>";
                    
                } else {
                
                    $publication_string = "";
                    if ($article->getString("publication_date", true)) {
                        $publication_string .= system_showText(LANG_ARTICLE_PUBLISHED).": ".$article->getDate("publication_date");
                    }

                    $author_string = "";
                    if ($article->getString("author", true)) {
                        $author_string .= system_showText(LANG_BY)." ";
                        if ($article->getString("author_url", true)) {
                            $author_string .= "<a href=\"".$article->getString("author_url", true)."\" target=\"_blank\">\n";
                        }
                        $author_string .= " ".$article->getString("author", true);
                        if ($article->getString("author_url", true)) {
                            $author_string .= "</a>\n";
                        }
                    } else {
                        $name = socialnetwork_writeLink($article->getNumber("account_id"), "profile", "general_see_profile");
                        if ($name) {
                            $author_string .= " ".system_showText(LANG_BY)." ".$name;
                        }
                    }

                    echo "<p>".$publication_string." ".$author_string." ".system_itemRelatedCategories($article->getNumber("id"), "article", true)."</p>\n\n";
                    
                }
				echo "</div>";

			}

		}
		$ids_report_lote = string_substr($ids_report_lote, 0, -1);
		report_newRecord("article", $ids_report_lote, ARTICLE_REPORT_SUMMARY_VIEW, true);
		
		echo "</div>";
			?> <h2><a class="view-more" href="<?=$seeAllTextLink?>"><?=$seeAllText;?></a></h2>	<?
	}
	// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedArticle2-->