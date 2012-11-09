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
	# * FILE: /listing/allcategoriescontent.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
	
?>

	<h2><?=system_showText(LANG_BROWSEBYCATEGORY)?></h2>

	<?
	$left_categories_content  = "";
	$right_categories_content = "";
	
	$catObj = new ListingCategory();
	$langIndex = language_getIndex(EDIR_LANGUAGE);
	unset($categories_content);
	$total = 0;

	$categories = $catObj->retrieveAllCategoriesXML(EDIR_LANGUAGE);
	if($categories){
		
		echo "<ul class=\"browse-category\">";
		
		$xml_categories = simplexml_load_string($categories);
		if(count($xml_categories->info) > 0){
			for($i=0;$i<count($xml_categories->info);$i++){
	
				unset($categories);
				foreach($xml_categories->info[$i]->children() as $key => $value){
					$categories[$key] = $value;
				}
				
				if($categories){
					$total++;
					echo "<li ".(($total == 3) ? ("class=\"last\"") : ("")).">";
					if (MODREWRITE_FEATURE == "on") {
						echo "<a href=\"".LISTING_DEFAULT_URL."/guide/".$categories["friendly_url".$langIndex]."\" title = \"".string_htmlentities($categories["title".$langIndex])."\">";
					} else {
						echo "<a href=\"".LISTING_DEFAULT_URL."/results.php?category_id=".$categories["id"]."\" title = \"".string_htmlentities($categories["title".$langIndex])."\">";
					}
					echo system_showTruncatedText($categories["title".$langIndex], 50);

					if (SHOW_CATEGORY_COUNT == "on") {
						echo " <span class=\"complementaryInfo\">(".$categories["active_listing"].")</span>";
					}
					echo "</a>";
					echo "</li>";

				}
				
				if($total == 3){
					echo "<li class=\"clear\">&nbsp;</li>";
					$total = 0;
				}

			}

		}
		
		echo "</ul>";
	} ?>