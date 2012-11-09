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
	# * FILE: /deal/categories.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$langIndex = language_getIndex(EDIR_LANGUAGE);

	unset($catObj);
	$catObj = new ListingCategory();
	unset($categories);

	$listing_featuredcategory="";
	if (FEATURED_CATEGORY == "on")
		setting_get("listing_featuredcategory", $listing_featuredcategory);

	if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
		$sql = "SELECT id, title$langIndex, friendly_url$langIndex, active_listing FROM ListingCategory WHERE category_id = '0' ".($listing_featuredcategory ?"AND featured = 'y'":"")." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title$langIndex <> '' AND friendly_url$langIndex <> '' AND enabled = 'y' ORDER BY active_listing DESC LIMIT 20";
		$categories = system_generateXML("categories", $sql, SELECTED_DOMAIN_ID);
	} else {
		$categories = $catObj->retrieveAllCategoriesXML(EDIR_LANGUAGE, $listing_featuredcategory);
	}

	unset($categories_content);

	$total = 0;

	if (is_string($categories)) { ?>
	
		<h2>
			<span><?=system_showText(LANG_BROWSEBYCATEGORY)?></span>
			<? if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") { ?>
				<a class="view-more" href="<?=PROMOTION_DEFAULT_URL?>/allcategories.php"><?=system_showText(LANG_PROMOTION_VIEWALLCATEGORIES)?></a>
			<? } ?>
		</h2>
		
		<ul class="browse-category">
	
		<?
		$xml_categories = simplexml_load_string($categories);
		if(count($xml_categories->info) > 0) {
			for($i=0;$i<count($xml_categories->info);$i++){
				unset($categories);
				foreach($xml_categories->info[$i]->children() as $key => $value){
					$categories[$key] = $value;
				}
				
				$total++;
				
				if($categories){

					if (MODREWRITE_FEATURE == "on") {
						$categoryLink = PROMOTION_DEFAULT_URL."/guide/".$categories["friendly_url".$langIndex];
					} else {
						$categoryLink = PROMOTION_DEFAULT_URL."/results.php?category_id=".$categories["id"];
					}

					echo "<li ".(($total==3) ? ("class=\"last\"") : ("")).">";
					
					echo "<a href=\"".$categoryLink."\">".system_showTruncatedText($categories["title".$langIndex], 25)."</a>";

					if (string_strpos($_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"], $_SERVER["SERVER_NAME"].EDIRECTORY_FOLDER."/index.php") === false) {

						if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION != "on") {

							unset($subcategories);

							$subcategories = $catObj->getAllCategoriesHierarchyXML(EDIR_LANGUAGE, $listing_featuredcategory, $categories["id"], 0, SELECTED_DOMAIN_ID);

							if ($subcategories) {
								
								echo "<ul>";

								$xml_subcategories = simplexml_load_string($subcategories);
								if(count($xml_subcategories->info) > 0) {
									unset($code_include_aux);
									for($j=0;$j<count($xml_subcategories->info);$j++){
										unset($subcategories);
										foreach($xml_subcategories->info[$j]->children() as $key => $value){
											$subcategories[$key] = $value;
										}
										if($subcategories){

											if (MODREWRITE_FEATURE == "on") {
												$subCategoryLink = PROMOTION_DEFAULT_URL."/guide/".$categories["friendly_url".$langIndex]."/".$subcategories["friendly_url".$langIndex];
											} else {
												$subCategoryLink = PROMOTION_DEFAULT_URL."/results.php?category_id=" . $subcategories["id"];
											}
											
											echo "<li>";

											echo "<a href=\"".$subCategoryLink."\">".system_showTruncatedText($subcategories["title".$langIndex], 25)."</a>";
											
											echo "</li>";

										}
									}
								}
								echo "</ul>";
							}
						}
					}
					echo "</li>";
					
					if($total==3){
						echo "<li class=\"clear\">&nbsp;</li>";
						$total=0;
					}
					
				}
			}
		} ?>
		
		</ul>
		
	<?
	}
?>