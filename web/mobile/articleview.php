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
	# * FILE: /mobile/articleview.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on" || CUSTOM_ARTICLE_FEATURE != "on") { exit; }
	if (MOBILE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$langIndex = language_getIndex(EDIR_LANGUAGE);

?>

	<div class="itemView articleView">
		<h1><?=$article["title"]?></h1>
		<? if ($article["publication_date"] || $article["author"]) { ?>
			<p class="articleInfo">
				<?
				if ($article["publication_date"]) echo $article["publication_date"];
				if ($article["publication_date"] && $article["author"]) echo " - ";
				if ($article["author"]) echo system_showText(LANG_BY)." ".$article["author"];
				?>
			</p>
		<? } ?>
		<? if ($article["abstract".$langIndex]) { ?>
			<p><?=$article["abstract".$langIndex]?></p>
		<? } ?>
	</div>
