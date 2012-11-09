<?

$id = getUriSegments(4);
$redeemit = TRUE;
$nofacebook = true;
//the next included file used for validate redeem request and add it to the database 
include(EDIRECTORY_ROOT . "/includes/code/deal_redeem.php");
?>

<?
if ($promotion && !$promotionMsg && $errorNumber != 2) {

    //Listing info
    $listingtemplate_address = "";
    if ($listing->getString("address")) {
        $listingtemplate_address = nl2br($listing->getString("address", true));
    }

    $listingtemplate_address2 = "";
    if ($listing->getString("address2")) {
        $listingtemplate_address2 = nl2br($listing->getString("address2", true));
    }

    $listingtemplate_phone = "";
    if ($listing->getString("phone")) {
        $listingtemplate_phone = $listing->getString("phone", true);
    }

    $listingtemplate_email = "";
    if (htmlspecialchars($listing->getString("email"))) {
        $listingtemplate_email = $listing->getString("email");
    }

    $listingtemplate_url = "";
    if (htmlspecialchars($listing->getString("url"))) {
        $display_url = htmlspecialchars($listing->getString("url"));
        if (htmlspecialchars($listing->getString("display_url"))) {
            $display_url = htmlspecialchars($listing->getString("display_url"));
        }
        $listingtemplate_url = $display_url;
    }

    $listingtemplate_location = "";
    $locationsToshow = system_retrieveLocationsToShow();
    $locationsParam = $locationsToshow . " z";
    $listingtemplate_location = $listing->getLocationString($locationsParam, true);

    if ($promotion->getNumber("realvalue") > 0) {
        $offer = round(100 - (($promotion->getNumber("dealvalue") * 100) / $promotion->getNumber("realvalue"))) . '%';
    } else {
        $offer = system_showText(LANG_NA);
    }
    $promotionInfo = $promotion->getDealInfo(sess_getAccountIdFromSession());
    $contact = new Contact(sess_getAccountIdFromSession());

    customtext_get("promotion_default_conditions", $promotion_default_conditions, EDIR_LANGUAGE);
    ?>
    <div data-role="content" style="padding: 15px">
        <div class="txt_block">
            <h3 style="text-align: center; text-shadow: none; margin: 0px;"><?= $promotion->getString("name"); ?></h3>
        </div>
        <? if ($errorNumber): ?>
            <div class="txt_block"  <? if($errorNumber == 1 && isset($_GET['just_show'])) echo 'style="display:none"' ?>>
                <p id="errorMessage" style="padding: 0;margin:0;text-align: center" class="<?= $errorNumber == 1 ? "informationMessage" : "errorMessage" ?>"><?= $errorNumber == 1 ? system_showText(DEAL_REDEEM_DONEALREADY) : system_showText(DEAL_REDEEMINFO_2) ?></p>
            </div>
        <? endif; ?>
        <a data-role="button" data-transition="fade" data-theme="b" href="" class="ui-btn-left" style="display: block; height: 40px"><?= $errorNumber ? $redeemCheck : $redeem_code; ?> </a>

        <ul data-role="listview" data-inset="true" class="ui-listview ui-listview-inset ui-corner-all ui-shadow">
            <li data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div"
                data-icon="false" data-iconpos="right" data-theme="c" class="ui-btn ui-btn-icon-right ui-li ui-li-has-alt ui-li-has-thumb ui-corner-bottom ui-btn-up-c"
                style="padding: 5px; height: 100px;">
                <div style="width: 100%; text-align: left; float: left; padding-bottom: 5px; margin-top: 10px;">
                    <p>
                        <strong><?= system_showText(LANG_LABEL_NAME) ?></strong> : <?= $contact->getString("first_name") . " " . $contact->getString("last_name") ?>
                    </p>
                    <p>
                        <strong><?= system_showText(LANG_DEAL_REMEEDED_AT) ?></strong> :  <?= format_date($promotionInfo["account"]["datetime"], DEFAULT_DATE_FORMAT, "date") ?> - <?= format_date($promotionInfo["account"]["datetime"], "H:i", "datetime") ?>
                    </p>
                    <p>
                        <strong><?= system_showText(DEAL_VALIDUNTIL) ?></strong> :  <?= $promotion->getDate("end_date"); ?>
                    </p>
                    <div style="width: 100%; text-align: center; border-top: 1px solid #999; float: left; padding-top: 0; font-weight: normal">
                        <div style="float: left; width: 47%; border-right: 1px solid #999; font-weight: normal;padding: 1px">
                            <strong><?= system_showText(DEAL_ORIGINALVALUE) ?></strong><br />
                            <?= CURRENCY_SYMBOL . format_money($promotion->getNumber("realvalue"), 2) ?>
                        </div>
                        <div style="float: left; width: 47%; padding: 1px">
                            <strong><?= CURRENCY_SYMBOL . format_money($promotion->getNumber("dealvalue"), 2) ?></strong><br />
                            $0.00</div>
                    </div>
                </div>
            </li>
        </ul>

        <ul data-role="listview" data-inset="true" class="ui-listview ui-listview-inset ui-corner-all ui-shadow">
            <li data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div"
                data-icon="false" data-iconpos="right" data-theme="c" class="ui-btn ui-btn-icon-right ui-li ui-li-has-alt ui-corner-bottom ui-btn-up-c"
                style="padding: 5px;">
                <div style="width: 100%; text-align: left; padding-bottom: 5px;">
                    <? if ($listingtemplate_phone) { ?>
                        <p><strong><?= system_showText(ucfirst(LANG_LISTING_LETTERPHONE)) ?>: </strong><?= $listingtemplate_phone ?></p>
                    <? } ?>
                    <? if ($listingtemplate_email) { ?>
                        <p><strong><?= system_showText(ucfirst(LANG_LISTING_LETTEREMAIL)) ?>: </strong><?= $listingtemplate_email ?></p>
                    <? } ?>
                    <? if ($listingtemplate_url) { ?>
                        <p><strong><?= system_showText(ucfirst(LANG_LISTING_LETTERWEBSITE)) ?>: </strong><?= $listingtemplate_url ?></p>
                    <? } ?>
                    <? if (($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) { ?>
                        <p style="white-space: inherit;"><strong><?= system_showText(LANG_LABEL_ADDRESS) ?>: </strong>
                            <? if ($listingtemplate_address) { ?>
                                <span><?= $listingtemplate_address . ($listingtemplate_address2 || $listingtemplate_location ? ", " : "" ) ?></span>
                            <? } ?>
                            <? if ($listingtemplate_address2) { ?>
                                <span><?= $listingtemplate_address2 . ($listingtemplate_location ? ", " : "") ?></span>
                            <? } ?>
                            <? if ($listingtemplate_location) { ?>
                                <span><?= $listingtemplate_location ?></span>
                            <? } ?>
                        </p>
                    <? } ?>
                </div>
            </li>
        </ul>



        <?
        $langIndex = language_getIndex(EDIR_LANGUAGE);
        if ($promotion->getString("conditions$langIndex")) {
            ?>
            <div class="terms txt_block">
                <p><?= nl2br($promotion->getString("conditions$langIndex")); ?></p>
            </div>
        <? } ?>


    <? } else { ?>
        <div class="terms txt_block">
            <p class="<?= $errorNumber == 2 ? "errorMessage" : "informationMessage" ?>"><?= $errorNumber == 2 ? system_showText(DEAL_REDEEMINFO_2) : $promotionMsg; ?></p>
        </div>           
    <? } ?>

</div>


