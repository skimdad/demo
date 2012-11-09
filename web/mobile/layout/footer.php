<?

	/*==================================================================*\
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
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /mobile/layout/footer.php
	# ----------------------------------------------------------------------------------------------------

?>

			</div>

			<ul class="navbar">
				<li><a href="<?=MOBILE_DEFAULT_URL?>/index.php<?=$querystringLang?>" accesskey="H"><img src="<?=DEFAULT_URL?>/images/icon_home_mobile.gif" /><p><?=system_showText(LANG_MENU_HOME);?></p></a></li>
				<li><a href="<?=MOBILE_DEFAULT_URL?>/listings.php<?=$querystringLang?>" accesskey="L"><img src="<?=DEFAULT_URL?>/images/icon_listing_mobile.gif" /><p><?=system_showText(LANG_MENU_LISTING);?></p></a></li>
				<? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
					<li><a href="<?=MOBILE_DEFAULT_URL?>/events.php<?=$querystringLang?>" accesskey="E"><img src="<?=DEFAULT_URL?>/images/icon_events_mobile.gif" /><p><?=system_showText(LANG_MENU_EVENT);?></p></a></li>
				<? } ?>
				<? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
					<li><a href="<?=MOBILE_DEFAULT_URL?>/classifieds.php<?=$querystringLang?>" accesskey="C"><img src="<?=DEFAULT_URL?>/images/icon_classified_mobile.gif" /><p><?=system_showText(LANG_MENU_CLASSIFIED);?></p></a></li>
				<? } ?>
				<? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
					<li><a href="<?=MOBILE_DEFAULT_URL?>/articles.php<?=$querystringLang?>" accesskey="A"><img src="<?=DEFAULT_URL?>/images/icon_articles_mobile.gif" /><p><?=system_showText(LANG_MENU_ARTICLE);?></p></a></li>
				<? } ?>
			</ul>

			<div class="footer">
				<div class="box-copyright">
					<? if (BRANDED_PRINT == "on") { ?>
                        <p class="basePowered">Powered by <a href="http://www.iConnectedMarketing.com" accesskey="D">iConnectedMarketing.com</a></p>
                    <? } ?>
    
                    <?
                    customtext_get("footer_copyright", $footer_copyright);
                    if (!$footer_copyright) {
                        $footer = "Copyright &copy; ".date("Y").". All Rights Reserved.";
                    } else {
                        $footer = $footer_copyright;
                    }
                    ?>
                    <p class="copyright"><?=$footer?></p>
                </div>

				<? include(MOBILE_EDIRECTORY_ROOT."/layout/langnavbar.php"); ?>
			</div>

		</div>

	</body>

</html>
