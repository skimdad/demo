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
	# * FILE: /mobile/search.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (MOBILE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	if (string_strpos($_SERVER["PHP_SELF"], "/".LISTING_FEATURE_FOLDER) !== false) {
		$formAction = "listingresults.php";
                $searchType = "listing";
	} elseif (string_strpos($_SERVER["PHP_SELF"], "/".EVENT_FEATURE_FOLDER) !== false) {
		$formAction = "eventresults.php";
$searchType = "event";
	} elseif (string_strpos($_SERVER["PHP_SELF"], "/".CLASSIFIED_FEATURE_FOLDER) !== false) {
		$formAction = "classifiedresults.php";
$searchType = "classified";
	} elseif (string_strpos($_SERVER["PHP_SELF"], "/".ARTICLE_FEATURE_FOLDER) !== false) {
		$formAction = "articleresults.php";
$searchType = "article";
	} else {
		$formAction = "results.php";
$searchType = "all";
	}

?>

	<form method="get" action="<?=MOBILE_DEFAULT_URL?>/<?=$formAction?>">
		<div class="search">
			<? if ($_GET["lang"]) { ?>
				<input type="hidden" name="lang" value="<?=$_GET["lang"]?>" />
			<? } ?>
                        <input type="text" class="txt-search"   name="keyword" value="<?=$keyword?>" placeholder="<?=system_showText(LANG_LABEL_SEARCHKEYWORD);?>"/>
			<input type="submit" data-theme="b"  value="<?=system_showText(LANG_BUTTON_SEARCH);?>" class="searchButtonch btn-seach" />
		</div>
	</form>
<a href="advance_search.php?type=<?= $searchType ?>" data-transition="slidedown">Advance Search </a>
