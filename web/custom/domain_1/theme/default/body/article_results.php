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
	# * FILE: /theme/default/body/article_results.php
	# ----------------------------------------------------------------------------------------------------

	/*
	 * Prepare content to results
	 */
	include(ARTICLE_EDIRECTORY_ROOT."/searchresults.php");
?>
	<div class="content">
	
		<? include(system_getFrontendPath("breadcrumb.php")); ?>
		
		<div class="content-top">
			<? //include(system_getFrontendPath("sitecontent_top.php")); ?>
			<? include(system_getFrontendPath("slider.php")); ?>		
			<? include(system_getFrontendPath("results_info.php")); ?>
		</div>
		
		<? include(system_getFrontendPath("results_filter.php")); ?>
		<? include(system_getFrontendPath("results_pagination.php")); ?>
		
		<div class="content-main">
			<? include(ARTICLE_EDIRECTORY_ROOT."/results_article.php"); ?>
		</div>
		
		<? 
		$pagination_bottom = true;
		include(system_getFrontendPath("results_pagination.php"));
		?>
		<? include(system_getFrontendPath("sitecontent_bottom.php")); ?>
		
		<? include(system_getFrontendPath("banner_bottom.php")); ?>
		
	</div>

	<div class="sidebar">
		<? include(EDIRECTORY_ROOT."/custom/domain_1/theme/realestate/frontend/searchSidebar.php"); ?>
		<? //include(ARTICLE_EDIRECTORY_ROOT."/join.php"); <div id="sidebar_ajax"></div> ?>
		<? include(ARTICLE_EDIRECTORY_ROOT."/relatedcategories.php"); ?>
		<? include(system_getFrontendPath("featured_article_review.php")); ?>
        <? include(system_getFrontendPath("banner_featured.php")); ?>
		<? include(system_getFrontendPath("banner_sponsoredlinks.php")); ?>
		<? include(system_getFrontendPath("googleads.php")); ?>
	</div>
