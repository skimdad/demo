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
	# * FILE: /frontend/banner_sponsoredlinks.php
	# ----------------------------------------------------------------------------------------------------

	// Preparing markers to Full Cache
	?>
	<!--cachemarkerBannerLinks-->
	<?

	$banner = system_showBanner("SPONSORED_LINKS", $category_id, $banner_section, $amount = 2);
	if ($banner) {
		?>
		<div class="advertisement">
			<div class="banner"><?=$banner?></div>
			<div class="info">
				<p>
					<a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on" && FORCE_ORDER_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/order_banner.php?type=50">
						<?=system_showText(LANG_BUY_LINK);?>
					</a>
				</p>
			</div>
		</div>
		<? }

	// Preparing markers to full cache
	?>
	<!--cachemarkerBannerLinks-->