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
	# * FILE: /body/index.php
	# ----------------------------------------------------------------------------------------------------

?>
	
	<div class="content">
		<? include(EDIRECTORY_ROOT."/frontend/slider.php"); ?>
		<div class="content-main">
			<? include(EDIRECTORY_ROOT."/frontend/sitecontent_top.php"); ?>
			<? include(EDIRECTORY_ROOT."/frontend/featured_listing.php"); ?>
			<? include(EDIRECTORY_ROOT."/frontend/featured_promotion.php"); ?>
			<? include(EDIRECTORY_ROOT."/frontend/featured_classified.php"); ?>
			<? include(EDIRECTORY_ROOT."/frontend/featured_event.php"); ?>
			<? include(EDIRECTORY_ROOT."/frontend/featured_article.php"); ?>
			<? include(EDIRECTORY_ROOT."/frontend/sitecontent_bottom.php"); ?>		
		</div>
		
		<? include(EDIRECTORY_ROOT."/frontend/banner_bottom.php"); ?>
		
	</div>

	<div class="sidebar">
	
		<? include(EDIRECTORY_ROOT."/frontend/join.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/categories_front.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/featured_listing_review.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/banner_featured.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/banner_sponsoredlinks.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/googleads.php"); ?>	
	</div>