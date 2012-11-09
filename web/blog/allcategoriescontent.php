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
	# * FILE: /blog/allcategoriescontent.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

?>

	<h2><?=system_showText(LANG_BROWSEBYTAG)?></h2>
	
	<?
	
	$catObj = new BlogCategory();
	$categories = $catObj->retrieveAllCategories(EDIR_LANGUAGE);
	$langIndex = language_getIndex(EDIR_LANGUAGE);
	
	unset($categories_content);
	$total = 0;
	if ($categories) {
		
		echo "<ul class=\"browse-category\">";
		
		for ($i=0; $i<count($categories); $i++) {
			$total++;
			
			echo "<li ".(($total==3) ? ("class=\"last\"") : ("")).">";
			if (MODREWRITE_FEATURE == "on") {
				echo "<a href=\"".BLOG_DEFAULT_URL."/guide/".$categories[$i]["friendly_url".$langIndex]."\" title = \"".string_htmlentities($categories[$i]["title".$langIndex])."\">";
			} else {
				echo "<a href=\"".BLOG_DEFAULT_URL."/results.php?category_id=".$categories[$i]["id"]."\" title = \"".string_htmlentities($categories[$i]["title".$langIndex])."\">";
			}
			echo system_showTruncatedText($categories[$i]["title".$langIndex], 50);
			if (SHOW_CATEGORY_COUNT == "on") {
				echo " <span class=\"complementaryInfo\">(".$categories[$i]["active_post"].")</span>";
			}
			echo "</a>";
			echo "</li>";
			
			if($total==3){
				echo "<li class=\"clear\">&nbsp;</li>";
				$total=0;
			}
		}
		echo "</ul>";
	}
	?>