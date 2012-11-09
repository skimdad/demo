<?
$isMobileApp_MOBI = TRUE;
$detectCurrentLocation = TRUE;
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
# * FILE: /mobile/events.php
# ----------------------------------------------------------------------------------------------------
# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../conf/mobile.inc.php");
include("../conf/loadconfig.inc.php");
include(MOBILE_EDIRECTORY_ROOT . "/layout/header.php");

$classifiedObj = new Classified($_GET["id"]);
$imageObj = new Image($classifiedObj->image_id);

$classfiedImage = '';
if ($imageObj->imageExists()) {
    $classfiedImage = $imageObj->getPath();
}

$classfied_location = $classifiedObj->getString("location", true);
$locationsToshow = system_retrieveLocationsToShow();
$locationsParam = $locationsToshow . " z";
$location = $classifiedObj->getLocationString($locationsParam, true);

$classfied_address = $classifiedObj->getString("address", true);
$classfied_address2 = $classifiedObj->getString("address2", true);

$classified_contactName = $classifiedObj->getString("contactname");
$classified_email = $classifiedObj->getString("email");
$classified_url = $classifiedObj->getString("url");
$classified_phone = $classifiedObj->getString("phone");

$classified_description = $classifiedObj->getStringLang(EDIR_LANGUAGE, "summarydesc", true);
?>

<div data-role="content" style="padding: 15px;">
    <div class="txt_block txt_center">

        <h3 style="color:#222222; text-shadow:none; margin:0px;"><?= $classifiedObj->title; ?></h3> 
    </div>    
    <img src="<?= $classfiedImage ?>" alt="image" style="width: 100%; height: auto; margin-top:25px;">


    <div class="txt_block">
        <h3 class="ui-li-heading" style="color:#222222; text-shadow:none">Overview</h3>
        <p><?= $classified_description ?></p>
    </div>
    <div class="txt_block">
        <h3 class="ui-li-heading" style="color:#222222; text-shadow:none">Contact Information</h3>

        <p style=" white-space:normal;color:#222222; text-shadow:none;" class="ui-li-desc"> 
            <? if (($location) || ($classified_address) || ($classified_address2)) echo "<address>\n"; ?>

            <? if ($classified_address) { ?>
                <span><strong>address 1:</strong> <?= nl2br($classified_address) ?></span><br />
            <? } ?>

            <? if ($classified_address2) { ?>
                <span><strong> address 2:</strong> <?= nl2br($classified_address2) ?></span><br />
            <? } ?>

            <? if ($location) { ?>
                <span><strong> location: </strong><?= $location ?></span><br />
            <? } ?>

            <? if (($location) || ($classified_address) || ($classified_address2)) echo "</address>\n"; ?>
        </p>
        <? if ($classified_url) { ?>
            <p><strong><?= system_showText(LANG_EVENT_WEBSITE) ?>:</strong>

                <a href="<?= $classified_url ?>" target="_blank"><?= $classified_url ?></a>

            </p>
        <? } ?>
        <? if ($classified_email) { ?>
            <p><strong><?= system_showText(LANG_LABEL_EMAIL) ?>:</strong> <a href="mailto:<?= $classified_email ?>"><?= system_showText(LANG_SEND_AN_EMAIL); ?></a></p>
        <? } ?>	

        <? if ($classified_contactName) { ?>
            <p><strong><?= system_showText(LANG_LABEL_CONTACTNAME) ?>:</strong> <?= $classified_contactName ?></p>
        <? } ?>

        <? if ($classified_phone) { ?>
            <p><strong><?= system_showText(LANG_LABEL_PHONE) ?>:</strong><a href="tel:<?= $classified_phone ?>"><?= $classified_phone ?></a>  </p>
        <? } ?>
    </div>
</div>
