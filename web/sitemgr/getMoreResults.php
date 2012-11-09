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
	# * FILE: /sitemgr/getMoreResults.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	session_start();

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;


	$promoLevelListing = new ListingLevel();
	$levels_all = $promoLevelListing->getLevelValues();
	foreach ($levels_all as $level_each) {
		if ( $promoLevelListing->getHasPromotion($level_each) == 'y' ) $hasPromotion = true;
	}


	if(isset($keywords))
		if ($keywords == string_ucwords(system_showText(LANG_SITEMGR_LABEL_KEYWORDS)))
			$keywords = "";

	unset ($search_for_keyword_fields);
	unset ($sql_where);
	unset ($where);

	# ----------------------------------------------------------------------------------------------------
	# DEFAULT PAGE BROWSING
	# ----------------------------------------------------------------------------------------------------
	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));
	//$paging_url = DEFAULT_URL."/sitemgr/search.php";


	if (!isset($screen))
		$screen = 1;
	else
		if ($direction=="next")
			$screen++;
		elseif ($direction=="prev")
			$screen--;
		else
			$screen=$direction;

	#---------------------------------------------------------------------------------------------------
	#---------------------------------------------------------------------------------------------------

	if ($searchFor=='listing') {

		# ----------------------------------------------------------------------------------------------------
		# FORMS DEFINES
		# ----------------------------------------------------------------------------------------------------

		if ($keywords) {
			$keywords = str_replace("\\", "", $keywords);
			$search_for_keyword_fields[] = "Listing_Summary.fulltextsearch_keyword";
			$sql_where[] = search_getSQLFullTextSearch($keywords, $search_for_keyword_fields, "keyword_score", $order_by_keyword_score, $search_for["match"], $order_by_keyword_score2, "keyword_score2");
		}

		if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";

		# ----------------------------------------------------------------------------------------------------
		# PAGE BROWSING
		# ----------------------------------------------------------------------------------------------------

		$url_redirect = "".DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER;
		if ($searchFor) {
			$pageObj = new pageBrowsing("Listing_Summary", $screen, $search_limit, "level DESC, title", "title", "", $where);
			$listings = $pageObj->retrievePage("object");
		}

		$feature_plural = "listings";
		$feature_label  = system_showText(string_ucwords(LANG_SITEMGR_LISTING_PLURAL));

	} elseif ($searchFor=='banner') {

		# ----------------------------------------------------------------------------------------------------
		# FORMS DEFINES
		# ----------------------------------------------------------------------------------------------------
		
		$langIndex = language_getIndex(EDIR_LANGUAGE);
		if ($keywords) { $sql_where[] = " caption".$langIndex." LIKE ".db_formatString('%'.$keywords.'%')." "; }
		if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";

		# ----------------------------------------------------------------------------------------------------
		# PAGE BROWSING
		# ----------------------------------------------------------------------------------------------------

		$arrLangs = explode(",", EDIR_LANGUAGENUMBERS);
		$endExpr = ")";

		if (count($arrLangs) > 1) {
			$fields = "id, type, status, account_id, expiration_setting, renewal_date, impressions, ";
			$fields .= "IF (`caption".$langIndex."` != '', `caption".$langIndex."`, ";
			$letterField = "IF (`caption".$langIndex."` != '', `caption".$langIndex."`, ";
			foreach ($arrLangs as $lang) {
				if ($langIndex != $lang) {
					$fields .= "IF (`caption".$lang."` != '', `caption".$lang."`, ";
					$letterField .= "IF (`caption".$lang."` != '', `caption".$lang."`, ";
					$endExpr .= ")";
				}
			}

			$fields .= "''".$endExpr." AS `caption`";
			$letterField .= "''".$endExpr."";
		} else {
			$fields = "id, type, status, account_id, expiration_setting, renewal_date, impressions, `caption".$langIndex."` AS `caption`";
			$letterField = "`caption".$langIndex."`";
		}

		$url_redirect = "".DEFAULT_URL."/sitemgr/".BANNER_FEATURE_FOLDER;

		if ($searchFor) {
			$pageObj = new pageBrowsing("Banner", $screen, $search_limit, "type, caption", $letterField, $letter, $where, $fields);
			$banners = $pageObj->retrievePage("array");
		}
		$feature_plural = "banners";
		$feature_label  = system_showText(string_ucwords(LANG_SITEMGR_BANNER_PLURAL));

	} elseif ($searchFor=='event') {

		# ----------------------------------------------------------------------------------------------------
		# FORMS DEFINES
		# ----------------------------------------------------------------------------------------------------

		if ($keywords) {
			$keywords = str_replace("\\", "", $keywords);
			$search_for_keyword_fields[] = "Event.fulltextsearch_keyword";
			$sql_where[] = search_getSQLFullTextSearch($keywords, $search_for_keyword_fields, "keyword_score", $order_by_keyword_score, $search_for["match"], $order_by_keyword_score2, "keyword_score2");
		}

		if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";

		# ----------------------------------------------------------------------------------------------------
		# PAGE BROWSING
		# ----------------------------------------------------------------------------------------------------

		$url_redirect = "".DEFAULT_URL."/sitemgr/".EVENT_FEATURE_FOLDER;

		if ($searchFor) {
			$pageObj = new pageBrowsing("Event", $screen, $search_limit, "level DESC, title", "title", $letter, $where);
			$events = $pageObj->retrievePage("object");
		}
		$feature_plural = "events";
		$feature_label  = system_showText(string_ucwords(LANG_SITEMGR_EVENT_PLURAL));


	} elseif ($searchFor=='classified') {

		# ----------------------------------------------------------------------------------------------------
		# FORMS DEFINES
		# ----------------------------------------------------------------------------------------------------

		if ($keywords) {
			$keywords = str_replace("\\", "", $keywords);
			$search_for_keyword_fields[] = "Classified.fulltextsearch_keyword";
			$sql_where[] = search_getSQLFullTextSearch($keywords, $search_for_keyword_fields, "keyword_score", $order_by_keyword_score, $search_for["match"], $order_by_keyword_score2, "keyword_score2");
		}

		if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";

		# ----------------------------------------------------------------------------------------------------
		# PAGE BROWSING
		# ----------------------------------------------------------------------------------------------------

		$url_redirect = "".DEFAULT_URL."/sitemgr/".CLASSIFIED_FEATURE_FOLDER;

		if ($searchFor) {
			$pageObj = new pageBrowsing("Classified", $screen, $search_limit, "level DESC, title", "title", $letter, $where);
			$classifieds = $pageObj->retrievePage("object");
		}
		$feature_plural = "classifieds";
		$feature_label  = system_showText(string_ucwords(LANG_SITEMGR_CLASSIFIED_PLURAL));

	} elseif ($searchFor=='article') {

		# ----------------------------------------------------------------------------------------------------
		# FORMS DEFINES
		# ----------------------------------------------------------------------------------------------------

		if ($keywords) {
			$keywords = str_replace("\\", "", $keywords);
			$search_for_keyword_fields[] = "Article.fulltextsearch_keyword";
			$sql_where[] = search_getSQLFullTextSearch($keywords, $search_for_keyword_fields, "keyword_score", $order_by_keyword_score, $search_for["match"], $order_by_keyword_score2, "keyword_score2");
		}

		if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";

		# ----------------------------------------------------------------------------------------------------
		# PAGE BROWSING
		# ----------------------------------------------------------------------------------------------------

		$url_redirect = "".DEFAULT_URL."/sitemgr/".ARTICLE_FEATURE_FOLDER;

		if ($searchFor) {
			$pageObj = new pageBrowsing("Article", $screen, $search_limit, "level DESC, title", "title", "", $where);
			$articles = $pageObj->retrievePage("object");
		}
		$feature_plural = "articles";
		$feature_label  = system_showText(string_ucwords(LANG_SITEMGR_ARTICLE_PLURAL));

	} elseif ($searchFor=='promotion') {

		# ----------------------------------------------------------------------------------------------------
		# FORMS DEFINES
		# ----------------------------------------------------------------------------------------------------

		if ($keywords) {
			$keywords = str_replace("\\", "", $keywords);
			$search_for_keyword_fields_promotion[] = "Promotion.fulltextsearch_keyword";
			$sql_where[] = "( (".search_getSQLFullTextSearch($keywords, $search_for_keyword_fields_promotion, "keyword_score", $order_by_keyword_score, $search_for["match"], $order_by_keyword_score2, "keyword_score2").") )";
		}
		if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";

		# ----------------------------------------------------------------------------------------------------
		# PAGE BROWSING
		# ----------------------------------------------------------------------------------------------------

		$url_redirect = "".DEFAULT_URL."/sitemgr/".PROMOTION_FEATURE_FOLDER;

		if ($searchFor) {
			$pageObj = new pageBrowsing("Promotion", $screen, 10, "name", "name", $letter, $where, "Promotion.*", "Promotion");
			$promotions = $pageObj->retrievePage();
		}

		$feature_plural = "promotions";
		$feature_label  = system_showText(string_ucwords(LANG_SITEMGR_PROMOTION_PLURAL));

	}  elseif ($searchFor=='blog') {

        # ----------------------------------------------------------------------------------------------------
        # FORMS DEFINES
        # ----------------------------------------------------------------------------------------------------

        if ($keywords) {
            $keywords = str_replace("\\", "", $keywords);
            $search_for_keyword_fields[] = "Post.fulltextsearch_keyword";
            $sql_where[] = search_getSQLFullTextSearch($keywords, $search_for_keyword_fields, "keyword_score", $order_by_keyword_score, $search_for["match"], $order_by_keyword_score2, "keyword_score2");
        }
        if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";

        # ----------------------------------------------------------------------------------------------------
        # PAGE BROWSING
        # ----------------------------------------------------------------------------------------------------

        $url_redirect = "".BLOG_DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER;

        if ($searchFor) {
            $pageObj = new pageBrowsing("Post", $screen, 10, "title DESC", "title", $letter, $where);
            $posts = $pageObj->retrievePage("object");
        }

        $feature_plural = "posts";
        $feature_label  = system_showText(string_ucwords(LANG_SITEMGR_POST_BLOG_SING));

    } elseif ($searchFor=='account') {

		# ----------------------------------------------------------------------------------------------------
		# FORMS DEFINES
		# ----------------------------------------------------------------------------------------------------

		$sql_where[] = " username not like ".db_formatString('%::%')." ";
		if ($keywords) $sql_where[] = " username like ".db_formatString('%'.$keywords.'%')." ";
		if ($sql_where)       $where .= " ".implode(" AND ", $sql_where)." ";

		# ----------------------------------------------------------------------------------------------------
		# PAGE BROWSING
		# ----------------------------------------------------------------------------------------------------

		$url_redirect = "".DEFAULT_URL."/sitemgr/account";

		if ($searchFor) {
			$pageObj  = new pageBrowsing("Account", $screen, $search_limit, "lastlogin DESC, username", "username", $letter, $where, "*", false, false, true);
			$accounts = $pageObj->retrievePage();
		}

		$feature_plural = "accounts";
		$feature_label  = (SOCIALNETWORK_FEATURE == "on" ? system_showText(LANG_SITEMGR_LABEL_SPONSOR) : system_showText(LANG_SITEMGR_NAVBAR_ACCOUNTS));


	} elseif ($searchFor=='smaccount') {

		# ----------------------------------------------------------------------------------------------------
		# FORMS DEFINES
		# ----------------------------------------------------------------------------------------------------

		if ($keywords) $sql_where[] = " username like ".db_formatString('%'.$keywords.'%')." ";
		if ($sql_where)       $where .= " ".implode(" AND ", $sql_where)." ";

		# ----------------------------------------------------------------------------------------------------
		# PAGE BROWSING
		# ----------------------------------------------------------------------------------------------------

		$url_redirect = "".DEFAULT_URL."/sitemgr/account";
		if ($searchFor) {
			$pageObj  = new pageBrowsing("SMAccount", $screen, $search_limit, "username", "username", $letter, $where, "*", false, false, true);
			$smaccounts = $pageObj->retrievePage();
		}

		$feature_plural = "smaccounts";
		$feature_label  = system_showText(LANG_SITEMGR_NAVBAR_SITEMGRACCOUNTS);

	} elseif ($searchFor=='transaction') {

		# ----------------------------------------------------------------------------------------------------
		# FORMS DEFINES
		# ----------------------------------------------------------------------------------------------------

		if ($keywords)           $sql_where[] = " transaction_id = ".db_formatString($keywords)." ";
		if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";

		# ----------------------------------------------------------------------------------------------------
		# PAGE BROWSING
		# ----------------------------------------------------------------------------------------------------

		$url_redirect = "".DEFAULT_URL."/sitemgr/transaction";

		if ($searchFor) {
			$pageObj  = new pageBrowsing("Payment_Log", $screen, $search_limit, "transaction_datetime DESC", "", "", $where);
			$transactions = $pageObj->retrievePage("array");
		}

		$feature_plural = "transactions";
		$feature_label  = system_showText(LANG_SITEMGR_TRANSACTIONS);

	} elseif ($searchFor=='invoice') {

		# ----------------------------------------------------------------------------------------------------
		# FORMS DEFINES
		# ----------------------------------------------------------------------------------------------------

		if ($keywords)                       $sql_where[] = " id = ".db_formatString($keywords)." ";
		if ($search_status)                   $sql_where[] = " status != N ";

		if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";

		# ----------------------------------------------------------------------------------------------------
		# PAGE BROWSING
		# ----------------------------------------------------------------------------------------------------

		$url_redirect = "".DEFAULT_URL."/sitemgr/invoices";

		if ($searchFor) {
			$pageObj  = new pageBrowsing("Invoice", $screen, $search_limit, "date DESC", "", "",$where);
			$invoices = $pageObj->retrievePage("array");
		}

		$feature_plural = "invoices";
		$feature_label  = string_ucwords(system_showText(LANG_SITEMGR_INVOICE_PLURAL));

	} elseif ($searchFor=='custominvoice') {

		# ----------------------------------------------------------------------------------------------------
		# FORMS DEFINES
		# ----------------------------------------------------------------------------------------------------

		if ($keywords) $sql_where[] = " title LIKE '%".addslashes($keywords)."%' ";

		if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";

		# ----------------------------------------------------------------------------------------------------
		# PAGE BROWSING
		# ----------------------------------------------------------------------------------------------------

		$url_redirect = "".DEFAULT_URL."/sitemgr/custominvoices";

		if ($searchFor) {
			$pageObj  = new pageBrowsing("CustomInvoice", $screen, $search_limit, "date DESC", "", "", $where);
			$custominvoices = $pageObj->retrievePage("object");
		}

		$feature_plural = "custominvoices";
		$feature_label  = string_ucwords(system_showText(LANG_SITEMGR_CUSTOMINVOICE_PLURAL));

	}

	$total_records = $pageObj->getString("record_amount");

	# SEE MORE BUTTON  ----------------------------------------------------------------------------------------------
	$seeMoreButton = $pageObj->getPagesButtons($_GET, $searchFor, $screen, $search_limit, $total_records, "this.form.submit();");

	if (${$feature_plural}) { ?>

		<? $legend=false; ?>
		<?=$seeMoreButton?>
		<table border="0" cellpadding="0" cellspacing="0" align="center" class="pagingContent">
			<tr><td><?=system_showText(LANG_PAGING_SHOWINGPAGE)?> <strong><?=$pageObj->getString("screen")?></strong> <?=system_showText(LANG_PAGING_PAGEOF)?> <strong><?=$pageObj->getString("pages")?></strong> <?=(intval($pageObj->getString("record_amount")) <= 1 ? system_showText(LANG_PAGING_PAGEOF) : system_showText(LANG_PAGING_PAGE_PLURAL))?></td></tr>
		</table>

		<? include(constant(($feature_plural=="posts"?"BLOG_":"")."INCLUDES_DIR")."/tables/table_".string_strtolower($searchFor).".php"); ?>
		<input id="lm_<?=string_strtolower($searchFor)?>" name="limit_multiplier_<?=string_strtolower($searchFor)?>" type="hidden" value="<?=$screen?>" />
		<?
	} ?>