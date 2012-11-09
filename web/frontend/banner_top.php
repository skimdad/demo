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
	# * FILE: /frontend/banner_top.php
	# ----------------------------------------------------------------------------------------------------

	// Preparing markers to Full Cache
	?>
	<!--cachemarkerBannerTop-->
	<?

	$banner = system_showBanner("TOP", $category_id, $banner_section);
	if ($banner) { ?>
		<div class="advertisement">
			<div class="banner"><?=$banner?></div>
			<div class="info">
				<h4><?=system_showText(LANG_ADVERTISER);?></h4>
				<p class="info-advertise">
					<a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on" && FORCE_ORDER_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/order_banner.php?type=1">
						<?=system_showText(LANG_DOYOUWANT_ADVERTISEWITHUS);?>
					</a>
				</p>
			</div>
		</div>
	<? } else { ?>
		<div class="advertisement-space"></div>
	<? }

	// Preparing markers to full cache
	?>
	<!--cachemarkerBannerTop-->