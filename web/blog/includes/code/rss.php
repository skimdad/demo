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
	# * FILE: /blog/includes/code/rss.php
	# ----------------------------------------------------------------------------------------------------

	if (!function_exists("getRSSTreeCategory")) {
		function getRSSTreeCategory($categoryID, $itemRSSSection) {
			unset($strRet);
			$dbObj = db_getDBObject();
			if ($itemRSSSection == "listing") $categoryObj = new ListingCategory($categoryID);
			elseif ($itemRSSSection == "event") $categoryObj = new EventCategory($categoryID);
			elseif ($itemRSSSection == "classified") $categoryObj = new ClassifiedCategory($categoryID);
			elseif ($itemRSSSection == "article") $categoryObj = new ArticleCategory($categoryID);
			elseif ($itemRSSSection == "blog") $categoryObj = new BlogCategory($categoryID);
			$sql = "SELECT id FROM ".string_ucwords($itemRSSSection)."Category WHERE id = ".$categoryObj->getNumber("category_id")."";
			$result = $dbObj->query($sql);
			if (mysql_num_rows($result) > 0) {
				while ($row = mysql_fetch_assoc($result)) {
					$strRet = getRSSTreeCategory($row["id"], $itemRSSSection);
				}
			}
			$strRet[] = $categoryObj->getStringLang(EDIR_LANGUAGE, "friendly_url");
			return $strRet;
		}
	}
   
	unset($rss_querystring, $rss_friendlyurl);

	if ($_GET["category_id"]) {
		$rss_querystring[] = "category_id=".$_GET["category_id"];
		$rss_treecategory = getRSSTreeCategory($_GET["category_id"], $itemRSSSection);
		$rss_friendlyurl["category_id"] = "guide_".implode("_", $rss_treecategory);
		unset($rss_treecategory);
	}
    
    if ($_GET["template_id"]) {
        $listingtypeObj = new ListingTemplate($_GET["template_id"]);
        $rss_listingtype = $listingtypeObj->getString("friendly_url");
        $rss_querystring[] = "template_id=".$_GET["template_id"];
        $rss_friendlyurl["template_id"] = "type_".$rss_listingtype;
        unset($listingtypeObj);
        unset($rss_listingtype);
    }

	if ($_GET["keyword"]) {
		$rss_querystring[] = "keyword=".urlencode($_GET["keyword"]);
		$rss_friendlyurl["keyword"] = "";
	}
    
    if ($_GET["where"]) {
        $rss_querystring[] = "where=".urlencode($_GET["where"]);
        $rss_friendlyurl["where"] = "";
    }

	if ($_GET["zip"]) {
		$rss_querystring[] = "zip=".$_GET["zip"];
		$rss_friendlyurl["zip"] = "";
	}

	if ($_GET["dist"]) {
		$rss_querystring[] = "dist=".$_GET["dist"];
		$rss_friendlyurl["dist"] = "";
	}
    
    if ($_GET["month"]) {
        $rss_querystring[] = "month=".$_GET["month"];
        $rss_friendlyurl["month"] = "month_".$_GET["month"];
    } elseif ($_GET["this_date"]) {
        $rss_querystring[] = "this_date=".$_GET["this_date"];
        $rss_friendlyurl["this_date"] = "day_".$_GET["this_date"];    
    }
    
	if ($_GET["id"]) {
		$rss_querystring[] = "id=".$_GET["id"];
		if ($itemRSSSection == "listing") ${"rss_".$itemRSSSection} = new Listing($_GET["id"]);
		elseif ($itemRSSSection == "event") ${"rss_".$itemRSSSection} = new Event($_GET["id"]);
		elseif ($itemRSSSection == "classified") ${"rss_".$itemRSSSection} = new Classified($_GET["id"]);
		elseif ($itemRSSSection == "article") ${"rss_".$itemRSSSection} = new Article($_GET["id"]);
		elseif ($itemRSSSection == "blog") ${"rss_".$itemRSSSection} = new Post($_GET["id"]);
		$rss_friendlyurl["id"] = ${"rss_".$itemRSSSection}->getString("friendly_url");
		unset(${"rss_".$itemRSSSection});
	}

	if ($rss_querystring) {
		$rssLink = "".constant(string_strtoupper($itemRSSSection."_DEFAULT_URL"))."/rss/index.php?".implode("&", $rss_querystring);
	} else {
		$rssLink = "".constant(string_strtoupper($itemRSSSection."_DEFAULT_URL"))."/rss/index.php";
	}

	if (MODREWRITE_FEATURE == "on") {
		if ($rss_friendlyurl) {
			if (!array_key_exists("keyword", $rss_friendlyurl) && !array_key_exists("where", $rss_friendlyurl) && !array_key_exists("zip", $rss_friendlyurl) && !array_key_exists("dist", $rss_friendlyurl)) {
				if (array_key_exists("id", $rss_friendlyurl) && (count($rss_friendlyurl) == 1)) {
					$rssLink = "".constant(string_strtoupper($itemRSSSection."_DEFAULT_URL"))."/rss/".$itemRSSSection."_".$rss_friendlyurl["id"].".xml";
				} elseif (!array_key_exists("id", $rss_friendlyurl)) {
					$rssLink = "".constant(string_strtoupper($itemRSSSection."_DEFAULT_URL"))."/rss/".$itemRSSSection."_".implode("_", $rss_friendlyurl).".xml";
				}
			}
		} else {
			$rssLink = "".constant(string_strtoupper($itemRSSSection."_DEFAULT_URL"))."/rss/";
		}
	}

	echo "<a class=\"rssResults\" href=\"".$rssLink."\" target=\"_blank\" title=\"".system_showText(LANG_LABEL_SUBSCRIBERSS)."\"><img src=\"".DEFAULT_URL."/images/content/icon_rss.gif\" alt=\"".system_showText(LANG_LABEL_SUBSCRIBERSS)."\" /></a>";

	unset($rss_querystring, $rss_friendlyurl, $rssLink);

?>
