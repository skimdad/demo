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
	# * FILE: /listing/detail_checkin.php
	# ----------------------------------------------------------------------------------------------------

	if ($listingtemplate_checkin) {
		
		if ($tPreview || !$user) {
			$checkinsLink = "javascript:void(0);";
			$linkStyle = "style=\"cursor:default;\"";
		}

	?>
	
		<h2>
			<span><?=system_showText(LANG_CHECKINCOUNT_PLURAL)?></span>
			<?if ($checkin_amount > $numberOfCheckins){?>
			<a class="view-more" href="<?=$checkinsLink?>" <?=$linkStyle?>><?=system_showText(LANG_LABEL_VIEW_ALL)?></a>
			<?}?>
		</h2>

		<div class="featured featured-checkin">
			<?=$listingtemplate_checkin?>
		</div>
	
	<? } ?>