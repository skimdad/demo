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
	# * FILE: /theme/default/body/article_detail.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="content">
	
		<div class="content-main">	
			<? include(ARTICLE_EDIRECTORY_ROOT."/detailview.php"); ?>
		</div>
		
		<? include(system_getFrontendPath("banner_bottom.php")); ?>
		
	</div>
	
	<div class="sidebar">
        <? //include(ARTICLE_EDIRECTORY_ROOT."/join.php"); ?>
		<? include(EDIRECTORY_ROOT."/custom/domain_1/theme/realestate/frontend/searchSidebar.php"); ?>
        <? include(ARTICLE_EDIRECTORY_ROOT."/detail_reviews.php"); ?>
        <? include(system_getFrontendPath("banner_featured.php")); ?>
        <? include(system_getFrontendPath("banner_sponsoredlinks.php")); ?>
        <? include(system_getFrontendPath("googleads.php")); ?>
	</div>