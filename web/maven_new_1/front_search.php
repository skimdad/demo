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
# * FILE: /includes/forms/form_advanced_search_front.php
# ----------------------------------------------------------------------------------------------------

if (!$hideSearchTip) {
    ?>
    <div class="left search-tips">
        <h4><?= system_showText(LANG_SEARCH_MESSAGE_TITLE) ?></h4>
        <p>&quot;<?= system_showText(LANG_SEARCH_MESSAGE_TEXT) ?>&quot;</p>
    </div>
<? } ?>

<div class="left match">

    <ul data-role="listview" data-inset="true" class="ui-listview ui-listview-inset ui-corner-all ui-shadow">

        <li data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-icon="false" data-iconpos="right" data-theme="c" class="ui-btn ui-btn-icon-right ui-li ui-li-has-alt ui-li-has-thumb ui-corner-bottom ui-btn-up-c" style="padding:5px; height:330px;">





            <div style=" width:100%; text-align:left; float:left; padding-bottom:5px; margin-top:10px;">
                <label><?= system_showText(LANG_SEARCH_LABELMATCH) ?>:</label>
                <fieldset data-role="controlgroup" data-type="vertical">
                    <div><input type="radio" name="match" value="exactmatch" class="radio" /> <?= system_showText(LANG_SEARCH_LABELMATCH_EXACTMATCH) ?></div>


                    <div><input type="radio" name="match" value="anyword" class="radio" checked="yes"/> <?= system_showText(LANG_SEARCH_LABELMATCH_ANYWORD) ?></div>


                    <div><input type="radio" name="match" value="allwords" class="radio"  /> <?= system_showText(LANG_SEARCH_LABELMATCH_ALLWORDS) ?></div>
                    <input type="hidden" name="advsearch" value="yes" />
            </div>

            </fieldset>

            <div class="left">
                <label><?= system_showText(LANG_SEARCH_LABELCATEGORY) ?>:</label>
                <div id="advanced_search_category_dropdown">
                    <?= $categoryDD; ?>
                </div>
            </div>

            <?
            unset($showLoc);
            if ($_default_locations_info) {
                foreach ($_default_locations_info as $info) {
                    if ($info["show"] == "y") {
                        $showLoc = true;
                        break;
                    }
                }
            }

            if (${"locations" . $_non_default_locations[0]} || $showLoc) {
                ?>
                <div class="left">
                    <div id="LocationbaseAdvancedSearch">
                        <? $advanced_search = true; ?>
                        <? include(EDIRECTORY_ROOT . "/includes/code/load_location.php"); ?>
                    </div>
                </div>
            <?
            }

            if ($hasWhereSearch) {
                ?>

                <div class="left zipcode">
                    <label><?= string_ucwords(ZIPCODE_LABEL) ?>:</label>
    <? if (ZIPCODE_PROXIMITY == "on") { ?>
                        <div>
                            <input type="text" name="dist" value="50" class="text" />
                        <?= string_ucwords(ZIPCODE_UNIT_LABEL_PLURAL) . " " . system_showText(LANG_SEARCH_LABELZIPCODE_OF) ?>
                        </div>
    <? } ?>
                    <div>
                        <input type="text" id="zip" name="zip" value="<?php
    if ($_REQUEST['where'] != '' && $_REQUEST['zip'] != '')
        echo $_REQUEST['zip']; else
        echo $value->Zipcode;
    ?>" class="text" />
    <?= (ZIPCODE_PROXIMITY == "on" ? string_ucwords(ZIPCODE_LABEL) : "") ?>
                    </div>
                </div>
                </div>
            </li>
        </ul>
<? } ?>
