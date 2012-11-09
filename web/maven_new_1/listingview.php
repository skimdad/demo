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
# * FILE: /mobile/listingview.php
# ----------------------------------------------------------------------------------------------------
# ----------------------------------------------------------------------------------------------------
# VALIDATE FEATURE
# ----------------------------------------------------------------------------------------------------
if (MOBILE_FEATURE != "on") {
    exit;
}

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------

$langIndex = language_getIndex(EDIR_LANGUAGE);
$dbMain = db_getDBObject(DEFAULT_DB, true);
if ($listing["location_3"]) {
    if (!$stateArray[$listing["location_3"]]) {
        $sqlState = "SELECT name FROM Location_3 WHERE id = " . $listing["location_3"] . "";
        $resultState = $dbMain->query($sqlState);
        if ($resultState) {
            if ($state = mysql_fetch_assoc($resultState)) {
                $stateArray[$listing["location_3"]] = $state["name"];
            }
        }
    }
}

if ($listing["location_4"]) {
    if (!$regionArray[$listing["location_4"]]) {
        $sqlRegion = "SELECT name FROM Location_4 WHERE id = " . $listing["location_4"] . "";
        $resultRegion = $dbMain->query($sqlRegion);
        if ($resultRegion) {
            if ($region = mysql_fetch_assoc($resultRegion)) {
                $regionArray[$listing["location_4"]] = $region["name"];
            }
        }
    }
}

/*
 * Prepare link to detail
 */
if (($levelObj->getDetail(htmlspecialchars($listing["level"])) == "y") || $levelObj->getActive(htmlspecialchars($listing["level"])) == 'n') {
    if (MODREWRITE_FEATURE == "on") {
        $detailLink = MOBILE_DEFAULT_URL . "/listing/" . $listing["friendly_url"] . ".html";
    } else {
        $detailLink = "" . MOBILE_DEFAULT_URL . "/listingdetail.php?id=" . htmlspecialchars($listing["id"]);
    }
} else {
    $detailLink = false;
}
?>
<li data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-icon="false" data-iconpos="right" data-theme="c" class="ui-btn ui-btn-icon-right ui-li ui-li-has-alt ui-li-has-thumb ui-corner-top ui-btn-up-c">
    <div class="ui-btn-inner ui-li ui-li-has-alt ui-corner-top">
        <div class="ui-btn-text" style="font-weight: normal">
            <a href="<?= $detailLink ?>" class="ui-link-inherit" data-transition="slideup" style="padding:0px; padding-left:10px;">
                <h3 class="ui-li-heading">
                    <?= $listing["title"]; ?>
                </h3>
                <? if($listing["address"] || $listing["address2"] || $listing["location_3"] || $listing["location_4"] || $listing["zip_code"]) { ?>
                    <address style="font-style: normal;margin-bottom: 5px;">
                        <? if ($listing["address"]) { ?>
                            <div><?= $listing["address"] ?></div>
                        <? } ?>
                        <? if ($listing["address2"]) { ?>
                            <div><?= $listing["address2"] ?></div>
                        <? } ?>
                        <? if ($listing["location_3"] || $listing["location_4"] || $listing["zip_code"]) { ?>
                            <div>
                                <?
                                if ($listing["location_4"])
                                    echo $regionArray[$listing["location_4"]];
                                if ($listing["location_3"] && $listing["location_4"])
                                    echo ", ";
                                if ($listing["location_3"])
                                    echo $stateArray[$listing["location_3"]];
                                if ($listing["location_3"] || $listing["location_4"])
                                    echo " ";
                                if ($listing["zip_code"])
                                    echo $listing["zip_code"];
                                ?>
                            </div>
                        <? } ?>
                    </address>
                <? } ?>
                <? if ($listing["phone"]) { ?>
                    <div class="phone" style="font-style: normal;margin-bottom: 5px;"><span class="bold"><?= system_showText(LANG_LISTING_LETTERPHONE); ?>:</span> <?= $listing["phone"] ?></div>
                <? } ?>
                <? if ($listing["description" . $langIndex]) { ?>
                    <div style="font-style: normal;margin-bottom: 5px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden"> <?= $listing["description" . $langIndex] ?></div>
                <? } ?>
            </a>
        </div>
    </div>
    <a style="padding:0px;" href="<?= $detailLink ?>" data-transition="slideup" title="Purchase album" class="ui-li-link-alt ui-btn ui-btn-icon-notext ui-corner-tr ui-btn-up-c" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-icon="false" data-iconpos="notext" data-theme="c"><span class="ui-btn-inner ui-corner-tr"><span class="ui-btn-text ui-corner-tr"></span><span data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-icon="arrow-r" data-iconpos="notext" data-theme="b" title="" class="ui-btn ui-btn-up-b ui-shadow ui-btn-corner-all ui-btn-icon-notext"><span class="ui-btn-inner ui-btn-corner-all ui-corner-tr"><span class="ui-btn-text ui-corner-tr"></span><span class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</span></span></span></span></a>
</li>


