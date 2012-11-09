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
	# * FILE: /frontend/body/promotion_detail.php
	# ----------------------------------------------------------------------------------------------------

?>
	<div class="content">
	
		<div class="content-main">
			<? include(PROMOTION_EDIRECTORY_ROOT."/detailview.php"); ?>
		</div>
		
		<? include(EDIRECTORY_ROOT."/frontend/banner_bottom.php"); ?>
		
	</div>

	<div class="sidebar">
		<? include(PROMOTION_EDIRECTORY_ROOT."/join.php"); ?>
		<? include(PROMOTION_EDIRECTORY_ROOT."/detail_listing.php"); ?>
		<? include(PROMOTION_EDIRECTORY_ROOT."/detail_reviews.php"); ?>
		<? include(PROMOTION_EDIRECTORY_ROOT."/deal_code.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/banner_featured.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/banner_sponsoredlinks.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/googleads.php"); ?>
	</div>