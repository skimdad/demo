<?
# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------
$isMobileApp_MOBI = TRUE;
include("../conf/mobile.inc.php");
include("../conf/loadconfig.inc.php");
if (MOBILE_FEATURE != "on") {
    exit;
}
include(EDIRECTORY_ROOT . "/includes/code/validate_querystring.php");
include(EDIRECTORY_ROOT . "/includes/code/validate_frontrequest.php");

$id = sess_getAccountIdFromSession();


if ($id) {
    $dealObj = new Promotion();
  //  $dealsArr = $dealObj->getDealsFromUserAndListing($id, $listing->id);
    $dealsArr = $dealObj->getDealsFromUser($id);
}
?>
<div data-role="content" style="padding: 15px;">
    <? if ($dealsArr) : ?>
        <ul data-role="listview" data-inset="true" class="ui-listview ui-listview-inset ui-corner-all ui-shadow">
            <?
            foreach ($dealsArr as $dealdone) :

                $auxMessage = "";
                if ($dealdone["facebooked"] && $dealdone["twittered"])
                    $auxMessage = system_showText(LANG_DEAL_POSTFACEBOOK_TWITTER); else if ($dealdone["facebooked"] && !$dealdone["twittered"])
                    $auxMessage = system_showText(LANG_DEAL_POSTFACEBOOK); else if (!$dealdone["facebooked"] && $dealdone["twittered"])
                    $auxMessage = system_showText(LANG_DEAL_TWITTER);

                $promotionObj = new Promotion($dealdone["promotion_id"]);
                ?>
                <li data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-icon="false" data-iconpos="right" data-theme="c" class="ui-btn ui-btn-icon-right ui-li ui-li-has-alt ui-corner-bottom ui-btn-up-c" style="padding: 5px;">
                    <strong style="display: block"><a class="openpoup" href="<?= $mobile_base_url . 'index.php/' . $listing->id . '/redeem/' . $promotionObj->getNumber("id").'?is_popup=true&just_show=true' ?>"><?= $promotionObj->getString("name") ?></a></strong>
                    <div>
                        <div>
                            <?= format_date($dealdone["datetime"], DEFAULT_DATE_FORMAT) ?> - <?= format_getTimeString($dealdone["datetime"]); ?>
                        </div>
                        <div> <?= $dealdone["used"] ? " (" . LANG_DEAL_CHECKOUT . ") " : " (" . LANG_DEAL_OPENED . ") " ?></div>
                        <div><span><?= $auxMessage ?></span></div>
                        <a data-role="button" data-transition="fade" data-theme="b" href="" class="ui-btn-left" style="display: block;width: 100%; height: 40px;margin: 0"><?= $dealdone["redeem_code"] ?></a>
                        <a class="openpoup" href="<?= $mobile_base_url . 'index.php/' . $listing->id . '/redeem/' . $promotionObj->getNumber("id").'?is_popup=true&just_show=true' ?>" style="display: block;text-align: center">show details</a>
                    </div>
                </li>
            <? endforeach; ?>
        </ul>
    <? else : ?>
        <p class="informationMessage"><?= system_showText(DEAL_DIDNTNOTFINISHED) ?></p>
    <? endif; ?>
</div>
