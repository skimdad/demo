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
	} elseif (string_strpos($_SERVER["PHP_SELF"], "/".EVENT_FEATURE_FOLDER) !== false) {
		$formAction = "eventresults.php";
	} elseif (string_strpos($_SERVER["PHP_SELF"], "/".CLASSIFIED_FEATURE_FOLDER) !== false) {
		$formAction = "classifiedresults.php";
	} elseif (string_strpos($_SERVER["PHP_SELF"], "/".ARTICLE_FEATURE_FOLDER) !== false) {
		$formAction = "articleresults.php";
	} else {
		$formAction = "results.php";
	}

?>

	<form method="get" action="<?=MOBILE_DEFAULT_URL?>/<?=$formAction?>">
		<div class="search">
			<? if ($_GET["lang"]) { ?>
				<input type="hidden" name="lang" value="<?=$_GET["lang"]?>" />
			<? } ?>
			<p><?=system_showText(LANG_LABEL_SEARCHKEYWORD);?></p>
			<input type="text" name="keyword" value="<?=$keyword?>" />
			<input type="submit" value="<?=system_showText(LANG_BUTTON_SEARCH);?>" class="searchButton" />
		</div>
	</form>
