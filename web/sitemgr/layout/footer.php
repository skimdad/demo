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
	# * FILE: /sitemgr/layout/footer.php
	# ----------------------------------------------------------------------------------------------------

?>

				<span class="clear"></span>

			</div>

		</div>

		<div class="footer">

			<div class="wrapper">
            	
				<? if (string_strpos($_SERVER["PHP_SELF"], "registration.php") === false){?>
                <div class="backLinks">
					<h2><?=system_showText(LANG_SITEMGR_MENU_LOGINOPTIONS)?></h2>
                    <a href="<?=NON_SECURE_URL?>/index.php"><?=system_showText(LANG_SITEMGR_MENU_BACKTOSITE)?></a>
                    <a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/members/"><?=system_showText(LANG_SITEMGR_MEMBERSSECTION)?></a>
                </div>
				<?}?>
        
				<p class="copyright">
					<span class="basePowered">Powered by <a href="http://www.iConnectedMarketing.com" target="_blank">iConnectedMarketing.com <?=VERSION?></a>.</span>
					Interface design Copyright &copy; iConnectedMarketing Inc.
				</p>

			</div>

		</div>

		<?
		// GOOGLE ANALYTICS FEATURE 
		if (!DEMO_DEV_MODE && !DEMO_LIVE_MODE && (GOOGLE_ANALYTICS_ENABLED == "on")) {
			$google_analytics_page = "sitemgr";
			include(INCLUDES_DIR."/code/google_analytics.php");
		}
		?>
    </div>

	</body>

</html>