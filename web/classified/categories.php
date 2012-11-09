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
	# * FILE: /classified/categories.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on" || CUSTOM_CLASSIFIED_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$langIndex = language_getIndex(EDIR_LANGUAGE);

	unset($catObj);
	$catObj = new ClassifiedCategory();
	unset($categories);

	$classified_featuredcategory="";
	if (FEATURED_CATEGORY == "on")
		setting_get("classified_featuredcategory", $classified_featuredcategory);

	if (CLASSIFIEDCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
		$dbCatObj = db_getDBObJect();
		$sql = "SELECT id, title$langIndex, friendly_url$langIndex, active_classified FROM ClassifiedCategory WHERE category_id = '0' ".($classified_featuredcategory?"AND featured = 'y'":"")." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title$langIndex <> '' AND friendly_url$langIndex <> '' AND enabled = 'y' ORDER BY active_classified DESC LIMIT 20";
		$result = $dbCatObj->query($sql);
		$categories = false;
		while ($row = mysql_fetch_assoc($result)) $categories[] = $row;
		unset($dbCatObj);
	} else {
		$categories = $catObj->retrieveAllCategories(EDIR_LANGUAGE, $classified_featuredcategory);
	}

	unset($categories_content);

	$total = 0;

	if ($categories) {
	?>

	<h2>
		<span><?=system_showText(LANG_BROWSEBYCATEGORY)?></span>
		<? if (CLASSIFIEDCATEGORY_SCALABILITY_OPTIMIZATION == "on") { ?>
			<a class="view-more" href="<?=CLASSIFIED_DEFAULT_URL?>/allcategories.php"><?=system_showText(LANG_CLASSIFIED_VIEWALLCATEGORIES)?></a>
		<? } ?>
	</h2>
	
		<ul class="browse-category">
		
		<?
		for ($i=0; $i<count($categories); $i++) {

			$code_include = "";
			$count_this_category = 0;
			$hasImage = false;

			if (MODREWRITE_FEATURE == "on") {
				$categoryLink = CLASSIFIED_DEFAULT_URL."/guide/".$categories[$i]["friendly_url".$langIndex];
			} else {
				$categoryLink = CLASSIFIED_DEFAULT_URL."/results.php?category_id=".$categories[$i]["id"];
			}
			
			echo "<li ".(($total==2) ? ("class=\"last\"") : ("")).">";
					
			echo "<a href=\"".$categoryLink."\">".system_showTruncatedText($categories[$i]["title".$langIndex], 25)."</a>";

			if (SHOW_CATEGORY_COUNT == "on"){
				echo " <span>(".$categories[$i]["active_classified"].")</span>";
			}

			$total++;
			$count_this_category++;

			if (CLASSIFIEDCATEGORY_SCALABILITY_OPTIMIZATION != "on") {

				unset($subcategories);
				$subcategories = $catObj->retrieveAllSubCatById($categories[$i]["id"], EDIR_LANGUAGE, $classified_featuredcategory);

				if ($subcategories) {
					
					echo "<ul>";

					unset($code_include_aux);

					for ($j=0; $j<count($subcategories); $j++) {

						if (MODREWRITE_FEATURE == "on") {
							$subCategoryLink = CLASSIFIED_DEFAULT_URL."/guide/".$categories[$i]["friendly_url".$langIndex]."/".$subcategories[$j]["friendly_url".$langIndex];
						} else {
							$subCategoryLink = CLASSIFIED_DEFAULT_URL."/results.php?category_id=".$subcategories[$j]["id"];
						}

						echo "<li>";

						echo "<a href=\"".$subCategoryLink."\">".system_showTruncatedText($subcategories[$j]["title".$langIndex], 25)."</a>";
						
						if (SHOW_CATEGORY_COUNT == "on"){
							echo " <span>(".$subcategories[$j]["active_classified"].")</span>";
						}
						
						echo "</li>";

						$count_this_category++;

					}
					
					echo "</ul>";

				}

			}
			
			echo "</li>";
			
			if($total==3){
				echo "<li class=\"clear\">&nbsp;</li>";
				$total=0;
			}

		} ?>
		
		</ul>
		
		<?
	} ?>
	
	
