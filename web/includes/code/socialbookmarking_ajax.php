<?php

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
    # * FILE: /includes/code/socialbookmarking_ajax.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../../conf/loadconfig.inc.php");

    //extract($_POST);
	$id = $_POST['id'];
	$module = $_POST['module'];
	$comments = $_POST['comments'];

	// SOCIAL BOOKMARKING
	if (SOCIAL_BOOKMARKING == "on") {

		unset($labelsuffix);
		$array_edir_languages = explode(",", EDIR_LANGUAGES);
		$labelsuffix = "";
		for ($i=0; $i<count($array_edir_languages); $i++) {
			if ($lang == $array_edir_languages[$i]) {
				if ($i) $labelsuffix = $i;
			}
		}

		// LISTING
		if ($module == "Listing") {
			$listing = new Listing($id);
			$aux = $listing->data_in_array;

			$icon_listing_level = $aux["level"];

			$listingLevelObj = new ListingLevel();
			if ($listingLevelObj->getDetail($icon_listing_level) == "y") {
				if (MODREWRITE_FEATURE == "on") {
					if ($comments) {
						$sbmLink = LISTING_DEFAULT_URL."/reviews/".$aux["friendly_url"];
					} else {
						$sbmLink = LISTING_DEFAULT_URL."/".$aux["friendly_url"].".html";
					}
				} else {
					if ($comments) {
						$sbmLink = LISTING_DEFAULT_URL."/comments.php?item_id=".$aux["id"];
					} else {
						$sbmLink = LISTING_DEFAULT_URL."/detail.php?id=".$aux["id"];
					}
				 }
			} else {
				if ($comments) {
					 if (MODREWRITE_FEATURE == "on") {
						$sbmLink = LISTING_DEFAULT_URL."/reviews/".$aux["friendly_url"];
					 } else {
						$sbmLink = LISTING_DEFAULT_URL."/comments.php?item_id=".$aux["id"];
					 }
				} else {
					$sbmLink = LISTING_DEFAULT_URL."/results.php?id=".$aux["id"];
				}
			}

			$sbmId = $aux["id"];
			$sbmTitle = $aux["title"];
			$sbmDescription = $aux["description".$labelsuffix];
			$sbmKeywords = $aux["keywords".$labelsuffix];
		}
		
		// ARTICLE
		elseif ($module == "Article") {
			$article = new Article($id);
			$articleLevelObj = new ArticleLevel();
			$icon_article_level = $article->getNumber("level");
			if ($articleLevelObj->getDetail($icon_article_level) == "y") {
				if (MODREWRITE_FEATURE == "on") {
					if ($comments) {
						$sbmLink = ARTICLE_DEFAULT_URL."/reviews/".$article->getString("friendly_url");
					} else {
						$sbmLink = ARTICLE_DEFAULT_URL."/".$article->getString("friendly_url").".html";
					}
				} else {
					if ($comments) {
						$sbmLink = ARTICLE_DEFAULT_URL."/comments.php?item_id=".$article->getNumber("id");
					} else {
						$sbmLink = ARTICLE_DEFAULT_URL."/detail.php?id=".$article->getNumber("id");
					}
				}
			} else {
				if ($comments) {
					 if (MODREWRITE_FEATURE == "on") {
						$sbmLink = ARTICLE_DEFAULT_URL."/reviews/".$article->getString("friendly_url");
					 } else {
						$sbmLink = ARTICLE_DEFAULT_URL."/comments.php?item_id=".$article->getNumber("id");
					 }
				} else {
					$sbmLink = ARTICLE_DEFAULT_URL."/results.php?id=".$article->getNumber("id");
				}
			}

			$sbmId = $article->getNumber("id");
			$sbmTitle = $article->getString("title");
			$sbmDescription = $article->getStringLang(EDIR_LANGUAGE,"abstract");
			$sbmKeywords = $article->getStringLang(EDIR_LANGUAGE,"keywords");
		}
		
		// CLASSIFIED
		elseif ($module == "Classified") {
			$classified = new Classified($id);
			$classifiedLevelObj = new ClassifiedLevel();
			$icon_classified_level = $classified->getNumber("level");
			if ($classifiedLevelObj->getDetail($icon_classified_level) == "y") {
				if (MODREWRITE_FEATURE == "on") {
					$sbmLink = CLASSIFIED_DEFAULT_URL."/".$classified->getString("friendly_url").".html";
				} else {
					$sbmLink = CLASSIFIED_DEFAULT_URL."/detail.php?id=".$classified->getNumber("id");
				}
			} else {
				$sbmLink = CLASSIFIED_DEFAULT_URL."/results.php?id=".$classified->getNumber("id");
			}

			$sbmId = $classified->getNumber("id");
			$sbmTitle = $classified->getString("title");
			$sbmDescription = $classified->getStringLang(EDIR_LANGUAGE,"summarydesc");
			$sbmKeywords = $classified->getStringLang(EDIR_LANGUAGE,"keywords");
		}
		
		// PROMOTION / DEALS
		elseif ($module == "Promotion") {
			$promotion = new Promotion($id);
			$sbmLink = PROMOTION_DEFAULT_URL."/results.php?id=".$promotion->getNumber("id");

			$sbmId = $promotion->getNumber("id");
			$sbmTitle = $promotion->getString("name");
			$sbmDescription = $promotion->getStringLang(EDIR_LANGUAGE,"description");
			$sbmKeywords = $promotion->getStringLang(EDIR_LANGUAGE,"keywords");
		}
		
		// EVENT
		elseif ($module == "Event") {
			$event = new Event($id);
			$eventLevelObj = new EventLevel();
			$icon_event_level = $event->getNumber("level");
			if ($eventLevelObj->getDetail($icon_event_level) == "y") {
				if (MODREWRITE_FEATURE == "on") {
					$sbmLink = EVENT_DEFAULT_URL."/".$event->getString("friendly_url").".html";
				} else {
					$sbmLink = EVENT_DEFAULT_URL."/detail.php?id=".$event->getNumber("id");
				}
			} else {
				$sbmLink = EVENT_DEFAULT_URL."/results.php?id=".$event->getNumber("id");
			}

			$sbmId = $event->getNumber("id");
			$sbmTitle = $event->getString("title");
			$sbmDescription = $event->getStringLang(EDIR_LANGUAGE,"description");
			$sbmKeywords = $event->getStringLang(EDIR_LANGUAGE,"keywords");
		}
		
		// POST / BLOG
		elseif ($module == "Post") {
			$post = new Post($id);
			if (MODREWRITE_FEATURE == "on") {
				$sbmLink = BLOG_DEFAULT_URL."/".$post->getString("friendly_url").".html";
			} else {
				$sbmLink = BLOG_DEFAULT_URL."/detail.php?id=".$post->getNumber("id");
			}

			$sbmId = $post->getNumber("id");
			$sbmTitle = $post->getString("title");
			$sbmDescription = $post->getStringLang(EDIR_LANGUAGE,"abstract");
			$sbmKeywords = $post->getStringLang(EDIR_LANGUAGE,"keywords");
		}

		$digg        = "href=\"http://digg.com/submit?phase=2&amp;url=".$sbmLink."&amp;title=".urlencode(htmlspecialchars($sbmTitle))."\" target=\"_blank\"";
		$delicious   = "href=\"http://del.icio.us/post?url=".$sbmLink."&amp;title=".urlencode(htmlspecialchars($sbmTitle))."\" target=\"_blank\"";
		$linkedin    = "href=\"http://www.linkedin.com/shareArticle?mini=true&url=".$sbmLink."&amp;title=".urlencode(htmlspecialchars($sbmTitle))."\" target=\"_blank\"";
		$myspace     = "href=\"javascript:void(0)\" onclick=\"window.open('http://www.myspace.com/index.cfm?fuseaction=postto&t=".urlencode(htmlspecialchars($sbmTitle))."&c=".urlencode(htmlspecialchars($sbmDescription))."&u=".$sbmLink."&l=5')\"";
		$google      = "href='https://www.google.com/bookmarks/mark?op=edit&output=popup&bkmk=".$sbmLink."&amp;title=".urlencode(htmlspecialchars($sbmTitle))."&amp;labels=".urlencode(htmlspecialchars($sbmKeywords))."&amp;annotation=".urlencode(htmlspecialchars($sbmDescription))."' target=\"_blank\"";

		$friend_style = "";
		$include_favorites_style = "";
		$print_style = "";
		$map_style = "";
		$claim_style = "";
		$socialbookmarking_style = "";

		unset($listingLevelObj);

        $digg_img        = "<img src=\"".DEFAULT_URL."/images/icon_digg.gif\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Digg\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Digg\" />";
        $delicious_img   = "<img src=\"".DEFAULT_URL."/images/icon_delicious.gif\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Delicious\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Delicious\" />";
        $linkedin_img    = "<img src=\"".DEFAULT_URL."/images/icon_linkedin.gif\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." LinkedIn\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." LinkedIn\" />";
		$myspace_img     = "<img src=\"".DEFAULT_URL."/images/icon_myspace.gif\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." MySpace\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." MySpace\" />";
		$google_img      = "<img src=\"".DEFAULT_URL."/images/icon_google.gif\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Google\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Google\" />";

        $bookmarking = "

		<ul>
			<li><a ".$delicious." title=\"Delicious\">".$delicious_img."</a></li>
			<li><a ".$digg." title=\"Digg\">".$digg_img."</a></li>
			<li><a ".$linkedin." title=\"LinkedIn\">".$linkedin_img."</a></li>
			<li><a ".$myspace." title=\"Myspace\">".$myspace_img."</a></li>
			<li><a ".$google." title=\"Google\">".$google_img."</a></li>
			<li class=\"close\"><a href=\"javascript:void(0);\" class=\"Close\" onclick=\"disableSocialBookMarking();\" title=\"".LANG_CLOSE."\">".system_showText(LANG_CLOSE)."</a></li>
		</ul>

        ";
	}
	
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	header("Accept-Encoding: gzip, deflate");
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check", FALSE);
	header("Pragma: no-cache");

	echo $bookmarking;
?>