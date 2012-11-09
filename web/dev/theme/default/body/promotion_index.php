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
	# * FILE: /theme/default/body/promotion_index.php
	# ----------------------------------------------------------------------------------------------------
        
?>

	<div class="content">
	
		<? include(system_getFrontendPath("breadcrumb.php")); ?>
	
		<div class="content-top">
			<? include(system_getFrontendPath("sitecontent_top.php")); ?>
			<? include(PROMOTION_EDIRECTORY_ROOT."/special_deal.php"); ?>
		</div>
		
		<div class="content-main">	
			<? include(PROMOTION_EDIRECTORY_ROOT."/featured.php"); ?>
			<? include(PROMOTION_EDIRECTORY_ROOT."/categories.php"); ?>
			<? include(system_getFrontendPath("sitecontent_bottom.php")); ?>
		</div>
		
		<? include(system_getFrontendPath("banner_bottom.php")); ?>
		
	</div>

	<div class="sidebar">
		<? include(PROMOTION_EDIRECTORY_ROOT."/join.php"); ?>
		<? include(PROMOTION_EDIRECTORY_ROOT."/locations.php"); ?>
		<? include(system_getFrontendPath("banner_featured.php")); ?>
		<? include(system_getFrontendPath("banner_sponsoredlinks.php")); ?>
		<? include(system_getFrontendPath("googleads.php")); ?>
	</div>