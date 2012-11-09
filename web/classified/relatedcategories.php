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
	# * FILE: /classified/relatedcategories.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	unset($related_categories);
	unset($category_tree);

	if ($keyword) {

		$search_for_keyword = str_replace("\\", "", $keyword);
		$search_for_keyword_fields[] = "title1";
		$search_for_keyword_fields[] = "title2";
		$search_for_keyword_fields[] = "title3";
		$search_for_keyword_fields[] = "title4";
		$search_for_keyword_fields[] = "title5";
		$search_for_keyword_fields[] = "title6";
		$search_for_keyword_fields[] = "title7";
		$search_for_keyword_fields[] = "keywords1";
		$search_for_keyword_fields[] = "keywords2";
		$search_for_keyword_fields[] = "keywords3";
		$search_for_keyword_fields[] = "keywords4";
		$search_for_keyword_fields[] = "keywords5";
		$search_for_keyword_fields[] = "keywords6";
		$search_for_keyword_fields[] = "keywords7";
		$where_clause = search_getSQLFullTextSearch($search_for_keyword, $search_for_keyword_fields, "keyword_score", $order_by_keyword_score, "anyword", $order_by_keyword_score2, "keyword_score2");

		if (CLASSIFIEDCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
			$sql = "SELECT * FROM ClassifiedCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND enabled = 'y' AND ".$where_clause."";
		} else {
			$sql = "SELECT * FROM ClassifiedCategory WHERE lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND enabled = 'y' AND ".$where_clause."";
		}

		unset($search_for_keyword);
		unset($search_for_keyword_fields);
		unset($order_by_keyword_score);
		unset($order_by_keyword_score2);
		unset($where_clause);

		$dbObj = db_getDBObject();
		$rs = $dbObj->query($sql);
		while ($row = mysql_fetch_assoc($rs)) {
			$related_categories[] = new ClassifiedCategory($row["id"]);
		}

	}

	if ($related_categories) {
		foreach ($related_categories as $categoryObj) $arr_full_path[] = $categoryObj->getFullPath();
		$category_tree = system_generateCategoryTree($related_categories, $arr_full_path, "classified", $user, EDIR_LANGUAGE);
	}

?>

<? if ($related_categories && $category_tree) { ?>
    <h2><?=system_showText(LANG_RELATEDCATEGORIES)?></h2>
    <?=$category_tree?>
<? } ?>
