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
# * FILE: /mobile/index.php
# ----------------------------------------------------------------------------------------------------
# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../conf/mobile.inc.php");

include("../conf/loadconfig.inc.php");



# ----------------------------------------------------------------------------------------------------
# VALIDATE FEATURE
# ----------------------------------------------------------------------------------------------------
if (MOBILE_FEATURE != "on") {
    exit;
}

# ----------------------------------------------------------------------------------------------------
# VALIDATION
# ----------------------------------------------------------------------------------------------------
include(EDIRECTORY_ROOT . "/includes/code/validate_querystring.php");


# ----------------------------------------------------------------------------------------------------
# SITE CONTENT
# ----------------------------------------------------------------------------------------------------
$contentObj = new Content();
$sitecontentinfo = $contentObj->retrieveContentInfoByType("Home Page");
if ($sitecontentinfo) {
    $headertagtitle = $sitecontentinfo["title"];
} else {
    $headertagtitle = "";
}

# ----------------------------------------------------------------------------------------------------
# HEADER
# ----------------------------------------------------------------------------------------------------
$headertag_title = $headertagtitle;

include(MOBILE_EDIRECTORY_ROOT . "/layout/header.php");
echo '<script>alert("'.MOBILE_EDIRECTORY_ROOT.'")</script>';
?>

<div data-role="content" style=" padding:0px;">
    <div style=" text-align:center">
        <img style="width: 30%; height: auto" src="<?= MOBILE_DEFAULT_URL ?>/assets/logo.png" />
        <h2 id="title_deal">Deal Cloud USA</h2>
    </div>
</div>

<div data-role="content">
    <div class="comic_font">Click a Group to get  <br/>started</div>

    <div style="width:70px; float:left; margin-left:11px; margin-top:51px;">
        <img src="<?= MOBILE_DEFAULT_URL ?>/assets/arrow.png" width="70" height="auto" alt="arrow"/>
    </div>

</div>

<div data-role="content" style="padding: 15px">
    <ul class="footer-nav-bar" data-role="listview" data-divider-theme="a" data-inset="true">
        <li data-theme="c">
            <a href="<?= MOBILE_DEFAULT_URL ?>/advanced_search_new.php?type=deal" accesskey="D">
                <img src="<?= DEFAULT_URL ?>/images/icon_home_mobile.png" />Deals
            </a>
        </li>
        <li data-theme="c">
            <a href="<?= MOBILE_DEFAULT_URL ?>/advanced_search_new.php?type=listing" accesskey="L">
                <img src="<?= DEFAULT_URL ?>/images/icon_listing_mobile.png" /><?= system_showText(LANG_MENU_LISTING); ?>
            </a>
        </li>
        <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
            <li data-theme="c">
                <a href="<?= MOBILE_DEFAULT_URL ?>/advanced_search_new.php?type=event" accesskey="E">
                    <img src="<?= DEFAULT_URL ?>/images/icon_events_mobile.png" /><?= system_showText(LANG_MENU_EVENT); ?>
                </a>
            </li>
        <? } ?>
        <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
            <li data-theme="c">
                <a href="<?= MOBILE_DEFAULT_URL ?>/advanced_search_new.php?type=classified" accesskey="C">
                    <img src="<?= DEFAULT_URL ?>/images/icon_classified_mobile.png" /><?= system_showText(LANG_MENU_CLASSIFIED); ?>
                </a>
            </li>
        <? } ?>
        <? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
            <li data-theme="c">
                <a href="<?= MOBILE_DEFAULT_URL ?>/advanced_search_new.php?type=article" accesskey="A">
                    <img src="<?= DEFAULT_URL ?>/images/icon_articles_mobile.png" /><?= system_showText(LANG_MENU_ARTICLE); ?>
                </a>
            </li>
        <? } ?>
    </ul>
</div>

<?
# ----------------------------------------------------------------------------------------------------
# FOOTER
# ----------------------------------------------------------------------------------------------------
include(MOBILE_EDIRECTORY_ROOT . "/layout/footer_new.php");
?>
