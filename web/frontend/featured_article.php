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
	# * FILE: /frontend/featured_article.php
	# ----------------------------------------------------------------------------------------------------
	// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedArticle-->
	<?
	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {

		# ----------------------------------------------------------------------------------------------------
		# CODE
		# ----------------------------------------------------------------------------------------------------

		$numberOfArticles = 6;
		$specialItem = 2;

		$level = implode(",", system_getLevelDetail("ArticleLevel"));

		if ($level) {
			unset($searchReturn);
			$searchReturn = search_frontArticleSearch($_GET, "random");
			$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." (Article.level IN (".$level.")) ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ORDER BY `random_number` LIMIT ".$numberOfArticles."";
			$array_articles = db_getFromDBBySQL("article", $sql);
		}

		if ($array_articles) {
			$seeAllText = system_showText(LANG_LABEL_VIEW_ALL_ARTICLES);
			
			?>

			<h2>
				<span><?=system_showText(LANG_RECENT_ARTICLE);?></span>
			</h2>

			<div class="featured featured-article">

				<?
				$countSpecialItem = 0;
				$ids_report_lote = "";
				foreach ($array_articles as $article) {
					
					$ids_report_lote .= $article->getString("id").",";
					
					/**
					 * Prepare detail Link
					 */
					if (MODREWRITE_FEATURE == "on") {
						$detailLink = "".ARTICLE_DEFAULT_URL."/".$article->getString("friendly_url").".html";
					} else {
						$detailLink = "".ARTICLE_DEFAULT_URL."/detail.php?id=".$article->getNumber("id")."";
					}
					
					unset($image_tag,$publication_string,$itemStyle,$summary,$author_string);
					
					if($countSpecialItem < $specialItem){
						
						/*
						 * Article with image and summary
						 */
						$itemStyle = "featured-item-special";
						
						$imageObj = new Image($article->getNumber("thumb_id"));
						if ($imageObj->imageExists()) {
							$image_tag = $imageObj->getTag(true, IMAGE_FRONT_ARTICLE_WIDTH, IMAGE_FRONT_ARTICLE_HEIGHT, $article->getString("title"), true);
						} else {
							$image_tag = "<span class=\"no-image\"></span>";
						}
						
                        if(ARTICLE_SCALABILITY_OPTIMIZATION == "on"){
                            $article_moreInfo = "<a href=\"javascript: void(0);\" onclick=\"showCategory(".htmlspecialchars($article->getNumber("id")).", 'article', ".(true).", ".$article->getNumber("account_id").", ".(true).", 0);\" \>".system_showText(LANG_VIEWCATEGORY)."</a>";
                            $publication_info = "<p id=\"showCategory_article".$article->getNumber("id")."\">$article_moreInfo</p>";

                        } else {
                            
                            /*
                             * Prepare author String
                             */
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
                            
                            /*
                             * Prepare publication date text 
                             */
                            if ($article->getString("publication_date", true)) {
                                $publication_string = system_showText(LANG_ARTICLE_PUBLISHED).": ".$article->getDate("publication_date");
                            }

                            $publication_info = "<p>".$publication_string." ".$author_string." ".system_itemRelatedCategories($article->getNumber("id"), "article", true)."</p>";
                        }
						$summary = system_showTruncatedText($article->getString("abstract".$languageIndex), 140);
						
					}else{
						if($countSpecialItem==($numberOfArticles-1)){
							$itemStyle = "last";
						}elseif($countSpecialItem==$specialItem){
							$itemStyle = "first";
						}else{
							$itemStyle = "";
						}
                        
                        if(ARTICLE_SCALABILITY_OPTIMIZATION == "on"){
                            $article_moreInfo = "<a href=\"javascript: void(0);\" onclick=\"showCategory(".htmlspecialchars($article->getNumber("id")).", 'article', ".(true).", ".$article->getNumber("account_id").", ".(true).", ".(true).");\" \>".system_showText(LANG_VIEWCATEGORY)."</a>";
                            $publication_info = "<p id=\"showCategory_article".$article->getNumber("id")."\">$article_moreInfo</p>";

                        } else {
						
                            /*
                             * Prepare publication date text 
                             */
                            if ($article->getString("publication_date", true)) {
                                $publication_string = $article->getDate("publication_date");
                            }

                            $categoriesInfo =  system_itemRelatedCategories($article->getNumber("id"), "article", true);
                            $publication_info = ($categoriesInfo ? $categoriesInfo." - ".$publication_string : $publication_string);
                            $categoriesInfo = "";
                        }
						
					}
					
					
					/*
					 * Write HTML
					 */
					
					if($countSpecialItem == 0){
						?>
						<div class="left">
						<?
					}
					?>
					<div class="featured-item <?=$itemStyle?>">
						<?
						if($image_tag){
							?>
							<a href="<?=$detailLink?>" class="image">
								<?=$image_tag?>
							</a>
							<?
						}
						?>
						<h3>
							<a href="<?=$detailLink?>">
								<?=$article->getString("title")?>
							</a>
						</h3>
						<?
						echo $publication_info;
						
						if($summary){
							?>
							<p><?=$summary?></p>
							<?
						}
						?>
					</div>
					<?
					if($countSpecialItem==($specialItem-1) || (count($array_articles) < $specialItem)){
						?>
						</div>
						<?
					}
					$countSpecialItem++;	
				}
				$ids_report_lote = string_substr($ids_report_lote, 0, -1);
				report_newRecord("article", $ids_report_lote, ARTICLE_REPORT_SUMMARY_VIEW, true);
			?>
			</div>	
			<h2><a class="view-more" href="<?=ARTICLE_DEFAULT_URL?>"><?=$seeAllText;?></a></h2>
	<? } 
	}
?>
<!--cachemarkerFeaturedArticle-->