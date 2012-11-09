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
	# * FILE: /frontend/socialnetwork/featured_review.php
	# ----------------------------------------------------------------------------------------------------

	if ($message){ ?>
		<p class="<?=$message_style?>"><?=$message?></p>
	<? }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	unset($pageObj);
	unset($searchResults);
	$aux_items_per_page = ($_COOKIE["profilereviews_per_page"] ? $_COOKIE["profilereviews_per_page"] : 10);
	$showLetter = false;
	$pageObj = new pageBrowsing("profile_review", $screen, $aux_items_per_page, "", "", $letter, "", "", "", "");
	$reviews = $pageObj->retrievePage("array");
	$aux_module_items = $reviews; 


	if ($members) {

		if ($members != "profile") {
			$paging_url = DEFAULT_URL."/members/account/reviews.php";
		} else {
			if ($pag_content == "reviews") {
				if (MODREWRITE_FEATURE == "on") {
					$paging_url = SOCIALNETWORK_URL."/".$info["friendly_url"]."";
				} else {
					$paging_url = SOCIALNETWORK_URL."/index.php?id=".$id;
				}
			} else if ($pag_content == "favorites") {
				if (MODREWRITE_FEATURE == "on") {
					$paging_url = SOCIALNETWORK_URL."/".$info["friendly_url"]."/favorites";
				} else {
					$paging_url = SOCIALNETWORK_URL."/index.php?id=".$id."&c=favorites";
				}
			}
		}

		$array_pages_code = system_preparePagination($paging_url, "", $pageObj, "", $screen, $aux_items_per_page, (MODREWRITE_FEATURE == "on" && $_GET["url_full"] ? false : true));

		$user = true;

	}

	if (count($reviews) > 0) {

		include(system_getFrontendPath("results_filter.php"));
		include(system_getFrontendPath("results_pagination.php"));

		$mapNumber = 0;
		$currentReview = 1;
		$ListingTitleView = true;
		$ArticleTitleView = true;
		$PromotionTitleView = true;
		$langIndex = language_getIndex(EDIR_LANGUAGE);

		$totalReviewsPage = count($reviews);

		foreach($reviews as $k => $row) {

			$forceLast = false;
			if ($row["item_type"] != $reviews[$k + 1]["item_type"]) {
				$forceLast = true;
			}

			if ($ListingTitleView && $row["item_type"] == "listing") {
				echo "<h2 class=\"standardSubTitle\">".system_showText(LANG_LABEL_LISTING_REVIEW)."</h2>";
				$ListingTitleView = false;
				$item_type = "listing";
			} else if ($ArticleTitleView && $row["item_type"] == "article") {
				echo "<h2 class=\"standardSubTitle\">".system_showText(LANG_LABEL_ARTICLE_REVIEW)."</h2>";
				$ArticleTitleView = false;
				$item_type = "article";
			} else if ($PromotionTitleView && $row["item_type"] == "promotion") {
				echo "<h2 class=\"standardSubTitle\">".system_showText(LANG_LABEL_PROMOTION_REVIEW)."</h2>";
				$PromotionTitleView = false;
				$item_type = "promotion";
			}

			$item_id = $row["id"];
			$rating = $row['rating'];
			$user = true;
			$review_title = $row["review_title"];
			$review = $row["review"];
			$reviewer_location = $row["reviewer_location"];
			$added = $row["added"];

			$reviewArea = "profile";
			$totalReviewsPage = count($reviews);

			if ($row["item_type"] == "listing") {
				$itemTitle = $row["title"];
				unset($listing);
				$listing = new Listing($row["id"]);
				$categories = $listing->getCategories(false,false,false,true,true);
				$c = 0;
				if ($categories) {
					unset($cats);
					foreach ($categories as $categoryObj) {

						if (MODREWRITE_FEATURE == "on") {
							$href = "".LISTING_DEFAULT_URL."/guide";
						} else {
							$href = "".LISTING_DEFAULT_URL."/results.php?category_id=";
						}

						if (MODREWRITE_FEATURE == "on") {
							$path_elem_arr = $categoryObj->getFullPath();
							if ($path_elem_arr) {
								foreach ($path_elem_arr as $each_category_node) {
									$href .= "/".$each_category_node["friendly_url".$langIndex];
								}
							}
						} else {
							$href .= $categoryObj->getNumber("id");
						}

						if ($categoryObj->getString("lang") != "") {
							if ($categoryObj->getStringLang(EDIR_LANGUAGE, "title") != "") {
								$cats .= "<a href=\"".$href."\" title=\"".$categoryObj->getStringLang(EDIR_LANGUAGE, "title")."\">".$categoryObj->getStringLang(EDIR_LANGUAGE, "title")."</a>, ";
								$c++;
							}
						}
					}
				}
                $levelObj = new ListingLevel();
				if (MODREWRITE_FEATURE == "on") {
					$detailLink 	= "".LISTING_DEFAULT_URL."/reviews/".$listing->getString("friendly_url");
                    if ($levelObj->getDetail($listing->getString('level')) == "y") {
						$detailItemLink = "".LISTING_DEFAULT_URL."/".$listing->getString("friendly_url").".html";
					} else {
						$detailItemLink = "".LISTING_DEFAULT_URL."/results.php?id=".$listing->getString("id");
					}
				} else {
					$detailLink 	= "".LISTING_DEFAULT_URL."/comments.php?item_type=listing&item_id=".$listing->getString("id");
					if ($levelObj->getDetail($listing->getString('level')) == "y") {
						$detailItemLink = "".LISTING_DEFAULT_URL."/detail.php?id=".$listing->getNumber("id");
					} else {
						$detailItemLink = "".LISTING_DEFAULT_URL."/results.php?id=".$listing->getNumber("id");
					}
				}
			} else if ($row["item_type"] == "article") {
				$itemTitle = $row["title"];
				unset($article);
				$article = new Article($row["id"]);
				$c = 0;
				$categories = $article->getCategories();
				if ($categories) {
					unset($cats);
					foreach ($categories as $categoryObj) {
						if (MODREWRITE_FEATURE == "on") {
							$href = "".constant("ARTICLE_DEFAULT_URL")."/guide";
						} else {
							$href = "".constant("ARTICLE_DEFAULT_URL")."/results.php?category_id=";
						}

						if (MODREWRITE_FEATURE == "on") {
							$path_elem_arr = $categoryObj->getFullPath();
							if ($path_elem_arr) {
								foreach ($path_elem_arr as $each_category_node) {
									$href .= "/".$each_category_node["friendly_url".$langIndex];
								}
							}
						} else {
							$href .= $categoryObj->getNumber("id");
						}

						if ($categoryObj->getString("lang") != "") {
							if ($categoryObj->getStringLang(EDIR_LANGUAGE, "title") != "") {
								$cats .= "<a href=\"".$href."\" title=\"".$categoryObj->getStringLang(EDIR_LANGUAGE, "title")."\">".$categoryObj->getStringLang(EDIR_LANGUAGE, "title")."</a>, ";
								$c++;
							}
						}
					}
				}

				if (MODREWRITE_FEATURE == "on") {
					$detailLink 		= "".ARTICLE_DEFAULT_URL."/reviews/".$article->getString("friendly_url");
					$detailItemLink 	= "".ARTICLE_DEFAULT_URL."/".$article->getString("friendly_url").".html";
				} else {
					$detailLink 		= "".ARTICLE_DEFAULT_URL."/comments.php?item_type=article&item_id=".$article->getString("id");
					$detailItemLink 	= "".ARTICLE_DEFAULT_URL."/detail.php?id=".$article->getNumber("id");
				}
			} else if ($row["item_type"] == "promotion") {
				$itemTitle = $row["name"];
				unset($promotion);
				$promotion = new Promotion($row["id"]);
				$c = 0;
				if (MODREWRITE_FEATURE == "on") {
					$detailLink 		= "".PROMOTION_DEFAULT_URL."/reviews/".$promotion->getString("friendly_url");
					$detailItemLink 	= "".PROMOTION_DEFAULT_URL."/".$promotion->getString("friendly_url").".html";
				} else {
					$detailLink 		= "".PROMOTION_DEFAULT_URL."/comments.php?item_type=promotion&item_id=".$promotion->getString("id");
					$detailItemLink 	= "".PROMOTION_DEFAULT_URL."/detail.php?id=".$promotion->getNumber("id");
				}
			}

			if ($c >= 1) {
				$cats = "<p>". system_showText(LANG_IN)." ".string_substr($cats, 0, -2) ."</p>";
			} else {
				$cats = "";
			}

			$review_title = "<a href=\"$detailLink\">$review_title</a>";

			 ?>

				<div class="item-summary">
					<? if ($id == sess_getAccountIdFromSession() || string_strpos($_SERVER["PHP_SELF"], "members")) { ?>
					<a href="javascript:void(0);" onclick="dialogBox('confirm', '<?=system_showText(LANG_MESSAGE_MSGAREYOUSURE);?>', '<?=$row["rID"];?>', 'reviews_post', '150','<?=system_showText(LANG_BUTTON_OK);?>','<?=system_showText(LANG_BUTTON_CANCEL);?>');" title="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_REVIEW);?>" class="delete"><?=system_showText(LANG_LABEL_DELETE)?></a>
					<? } ?>
					<h3><a href="<?=$detailItemLink;?>"> <?=$itemTitle;?></a></h3>
					<?=$cats;?>
				</div>

			<?

			include(INCLUDES_DIR."/views/view_review_detail.php");
			echo $item_reviewcomment;					
		}

		include(system_getFrontendPath("results_pagination.php"));
	} else {
		echo "<p class=\"informationMessage\">".system_showText(LANG_LABEL_NOREVIEWS)."</p>";
	}
?>