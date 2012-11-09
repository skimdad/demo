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
	# * FILE: /deal/detail_listing.php
	# ----------------------------------------------------------------------------------------------------

	if (!$hideDetail){
		if ($listing->getNumber("id")) { ?>
			<h2><?=system_showText(LANG_PROMOTION_OFFEREDBY);?></h2>

			<div class="featured featured-listing">

				<div class="featured-item">

					<div class="title">

						<h3><a href="<?=$listingDetailLink?>" <?=(!$user ? "style=\"cursor:default\"" : "")?>><?=$listing->getString('title')?></a></h3>	

						<p><?=$listingtemplate_complementaryinfo?></p>
					</div>

					<div class="image">
						<?=$listingtemplate_image;?>
					</div>	

					<? if ($listingtemplate_phone) { ?>
						<p><strong><?=system_showText(LANG_LISTING_LETTERPHONE)?>:</strong> <?=$listingtemplate_phone?></p>
					<? } ?>

					<? if ($listingtemplate_email){?>
					<p><strong><?=system_showText(LANG_LISTING_LETTEREMAIL)?>:</strong> <?=$listingtemplate_email;?></p>
					<? } ?>

					<? if ($listingtemplate_url) {?>
					<p><strong><?=system_showText(LANG_LISTING_LETTERWEBSITE)?>:</strong> <?=$listingtemplate_url?></p>
					<? } ?>

					<div class="address">
						<? if(($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) echo "<address>\n"; ?>
						<? if ($listingtemplate_address) { ?>
							<span><?=$listingtemplate_address?></span>
						<? } ?>
						<? if ($listingtemplate_address2) { ?>
							<span><?=$listingtemplate_address2?></span>
						<? } ?>
						<? if ($listingtemplate_location) { ?>
							<span><?=$listingtemplate_location?></span>
						<? } ?>
						<? if(($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) echo "\n</address>\n"; ?>
					</div>

				</div>
			</div>
		<? }
	} ?>