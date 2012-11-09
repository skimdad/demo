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
# * FILE: /article/results_events.php
# ----------------------------------------------------------------------------------------------------

if ($show_results) {

    if (!$articles) {

        if ($search_lock) {
            ?>
            <p class="errorMessage">
            <?= system_showText(LANG_MSG_LEASTONEPARAMETER) ?>
            </p>
            <?
        } else {
            $db = db_getDBObject();
            if ($db->getRowCount("Article") > 0) {
                ?>
                <div class="resultsMessage">
                    <? //=system_showText(LANG_MSG_NORESULTS); ?>
                    <? //=system_showText(LANG_MSG_TRYAGAIN);?>

                    <?
                   unset($aux_lang_msg_noresults);
                    $aux_lang_msg_noresults = "<li data-corners='false' data-shadow='false' data-iconshadow=='true' data-wrapperels='div' data-icon='false' data-iconpos='right' data-theme='c' class='ui-btn ui-btn-icon-right ui-li ui-li-has-alt ui-li-has-thumb ui-corner-top ui-btn-up-c'><h3 class='ui-li-heading'>Sorry!</h3 ><p class='phone'>Your search return no results. Although this is unusual, it happens from time to time when the search term you have used is a little generic or when we really do not have any matched content.</p><h3 class='ui-li-heading'>Suggestions:</h3>Be more specific with your search terms.<br />Check your spelling.</li>";
                        echo $aux_lang_msg_noresults;
                        ?>
                </div>
                <?
                /*
                  if ($keyword) {
                  ?>
                  <p class="informationMessage">
                  <?=system_showText(LANG_MSG_USE_SPECIFIC_KEYWORD);?>
                  </p>
                  <?
                  }
                 * 
                 */
            } else {
                ?>
                <p class="informationMessage">
                <?= system_showText(LANG_MSG_NOARTICLES); ?>
                </p>
                <?
            }
        }
    } elseif ($articles) {

        $level = new ArticleLevel(EDIR_DEFAULT_LANGUAGE, true);
        $count = 10;
       // $ids_report_lote = "";
        echo '<ul data-role="listview" data-inset="true" class="ui-listview ui-listview-inset ui-corner-all ui-shadow">';
        foreach ($articles as $article) {
            //$ids_report_lote .= $article->getString("id").",";

            include("./view_article_summary1.php");

            $count--;
        }
        echo '</ul>';
        //$ids_report_lote = string_substr($ids_report_lote, 0, -1);
        //report_newRecord("article", $ids_report_lote, ARTICLE_REPORT_SUMMARY_VIEW, true);
    }
}
?>
