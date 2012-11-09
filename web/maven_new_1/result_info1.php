<?
/* ==================================================================*\
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
  \*================================================================== */

# ----------------------------------------------------------------------------------------------------
# * FILE: /frontend/results_info.php
# ----------------------------------------------------------------------------------------------------

if ($show_results) {
    ?>
    <? if ($str_search) {
        ?>
        <h2 class="search-info">
            <?= system_showText(LANG_SEARCHRESULTS) ?> <?= $str_search ?>
        </h2>
        <?
    }

    /*
     * These variables are prepared on MODULE/results.php file
     */
    if ($category_id && $aux_CategoryObj && $aux_CategoryModuleURL && $aux_CategoryNumColumn) {
        $objCache = new cache("{$aux_CategoryObj}_results_category_{$category_id}.php");
        if ($objCache->caching) {
            //  include(system_getFrontendPath("browsebycategory.php"));
        }
        $objCache->close();
    }

    if ($aux_module_items) {
        $itemRSSSection = $aux_module_itemRSSSection;
    }
}
?>

