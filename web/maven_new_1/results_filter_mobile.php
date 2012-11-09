<?
$isMobileApp_MOBI = TRUE;
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
# * FILE: /frontend/results_filter.php
# ----------------------------------------------------------------------------------------------------
//this used for paging

if (!$hideResults) {
    ?>

    <div class="filter">
        <div class="left">
    <?= $orderbyDropDown ?>
        </div>
        <div class="right">

            <p><?= $array_pages_code["total"] != 1 ? system_showText(LANG_PAGING_FOUND_PLURAL) : system_showText(LANG_PAGING_FOUND) ?>
                <strong><?= $array_pages_code["total"] ?></strong> 
    <?= (($array_pages_code["total"] != 1) ? (system_showText(LANG_PAGING_RECORD_PLURAL)) : (system_showText(LANG_PAGING_RECORD))) ?>  | <?= system_showText(LANG_SEARCHRESULTS_PAGE) ?> <strong><?= $array_pages_code["current"] ?></strong> <?= system_showText(LANG_PAGING_PAGEOF) ?> <strong><?= $array_pages_code["last_page"] ?></strong><? (CACHE_FULL_FEATURE != "on" ? " |" : "") ?></p>
        </div>
    </div>
    <?
}
?>
