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
    # * FILE: /frontend/browsebycategory.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------

	$lang_order = language_getIndex(EDIR_LANGUAGE);
	
	unset($catObj);
    $catObj = new $aux_CategoryObj($category_id);
    $subcategories = $catObj->retrieveAllSubCatById($category_id, EDIR_LANGUAGE);
    $num_cols = $aux_CategoryNumColumn;
	
	$path_elem_arr = $catObj->getFullPath();
	
	
	/*
	 * Prepare URL with mode_rewrite ON
	 */
    if (MODREWRITE_FEATURE == "on") {
		$href = "";
        if ($path_elem_arr){
			foreach ($path_elem_arr as $each_category) {
				$friendly_url_path[] = $each_category["friendly_url".$lang_order];
			}
        }
		
		$href = $aux_CategoryModuleURL."/guide/".implode("/",$friendly_url_path);
		
    }
	
	unset($categories_content);
	if ($subcategories){
		
		echo "<ul class=\"browse-category\">";
		
		for ($j = 0; $j < count($subcategories); $j++) {
			if ($subcategories[$j]["friendly_url".$lang_order]) {
				if (MODREWRITE_FEATURE == "on") {
					$aux_url_subcategory = $href."/".$subcategories[$j]["friendly_url".$lang_order];
				}else{
					$aux_url_subcategory = $aux_CategoryModuleURL."/results.php?category_id=".$subcategories[$j]["id"];
				}
				?>
				<li>
					<a href="<?=$aux_url_subcategory?>" title = "<?=string_htmlentities($subcategories[$j]["title".$lang_order])?>">
						<?
						echo system_showTruncatedText($subcategories[$j]["title".$lang_order], 35);
						?>
					</a>
					<?
					if ((SHOW_CATEGORY_COUNT == "on") && $aux_CategoryActiveField){
						echo " <span>(".$subcategories[$j][$aux_CategoryActiveField].")</span>";
					}
					?>
				</li>
				
				<?				
			}
		}
		echo "</ul>";
	}
	
	echo $catObj->getString('content'.$lang_order, false);
	
	?>