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
	# * FILE: /theme/default/body/listing_index.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="content">
	
		<? include(system_getFrontendPath("breadcrumb.php")); ?>
	
		<div class="content-top">
			<? include(system_getFrontendPath("sitecontent_top.php")); ?>
			<? include(system_getFrontendPath("slider.php")); ?>
			<? include(LISTING_EDIRECTORY_ROOT."/featured.php"); ?>
		</div>
		
		<div class="content-main">
			<? //wtc include(LISTING_EDIRECTORY_ROOT."/categories.php");  ?>

			<? include(system_getFrontendPath("sitecontent_bottom.php")); ?>
		</div>
		
		<? include(system_getFrontendPath("banner_bottom.php")); ?>
		
	</div>

	<div class="sidebar">
		<? include(EDIRECTORY_ROOT."/custom/domain_1/theme/realestate/frontend/searchSidebar.php"); ?>
		<? include(system_getFrontendPath("featured_listing_review.php")); ?>
		<? //include(LISTING_EDIRECTORY_ROOT."/join.php"); <div id="sidebar_ajax"></div>?>
		<? include(LISTING_EDIRECTORY_ROOT."/locations.php"); ?>
		<? include(system_getFrontendPath("banner_featured.php")); ?>
		<? include(system_getFrontendPath("banner_sponsoredlinks.php")); ?>
		<? include(system_getFrontendPath("googleads.php")); ?>
	</div>
