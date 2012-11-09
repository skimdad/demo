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
# * FILE: /mobile/layout/footer.php
# ----------------------------------------------------------------------------------------------------
?>

</div>
<? if (loadPlain() === false) : ?>
<div data-role="content" style="padding: 15px">
    <ul class="footer-nav-bar" data-role="listview" data-divider-theme="c" data-inset="true">
        <li data-theme="c">
            <a href="<?= MOBILE_DEFAULT_URL ?>/advance_search.php?type=deals" accesskey="D">
                <img src="<?= DEFAULT_URL ?>/images/icon_home_mobile.png" />Deals
            </a>
        </li>
        <li data-theme="c">
            <a href="<?= MOBILE_DEFAULT_URL ?>/listings.php<?= $querystringLang ?>" accesskey="L">
                <img src="<?= DEFAULT_URL ?>/images/icon_listing_mobile.png" /><?= system_showText(LANG_MENU_LISTING); ?>
            </a>
        </li>
        <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
            <li data-theme="c">
                <a href="<?= MOBILE_DEFAULT_URL ?>/events.php<?= $querystringLang ?>" accesskey="E">
                    <img src="<?= DEFAULT_URL ?>/images/icon_events_mobile.png" /><?= system_showText(LANG_MENU_EVENT); ?>
                </a>
            </li>
        <? } ?>
        <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
            <li data-theme="c">
                <a href="<?= MOBILE_DEFAULT_URL ?>/classifieds.php<?= $querystringLang ?>" accesskey="C">
                    <img src="<?= DEFAULT_URL ?>/images/icon_classified_mobile.png" /><?= system_showText(LANG_MENU_CLASSIFIED); ?>
                </a>
            </li>
        <? } ?>
        <? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
            <li data-theme="c">
                <a href="<?= MOBILE_DEFAULT_URL ?>/articles.php<?= $querystringLang ?>" accesskey="A">
                    <img src="<?= DEFAULT_URL ?>/images/icon_articles_mobile.png" /><?= system_showText(LANG_MENU_ARTICLE); ?>
                </a>
            </li>
        <? } ?>
    </ul>
</div>
<?endif; ?>
<div data-theme="a" data-role="footer" data-position="fixed">
    <h3>
        <? if (BRANDED_PRINT == "on") { ?>
            <p class="basePowered">Powered by <a href="http://www.iConnectedMarketing.com" accesskey="D">iConnectedMarketing.com</a></p>
        <? } ?>

        <?
        customtext_get("footer_copyright", $footer_copyright);
        if (!$footer_copyright) {
            $footer = "Copyright &copy; " . date("Y") . ". All Rights Reserved.";
        } else {
            $footer = $footer_copyright;
        }
        ?>
        <p class="copyright"><?= $footer ?></p>
    </h3>
     <? include(MOBILE_EDIRECTORY_ROOT . "/layout/langnavbar.php"); ?>
</div>




</body>

</html>
