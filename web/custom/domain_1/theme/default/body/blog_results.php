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
	# * FILE: /theme/default/body/blog_results.php
	# ----------------------------------------------------------------------------------------------------

	/*
	 * Prepare content to results
	 */
	include(BLOG_EDIRECTORY_ROOT."/searchresults.php");	
?>
	<div class="content">
		
		<? include(system_getFrontendPath("breadcrumb.php")); ?>
		
		<div class="content-top">
			<? include(system_getFrontendPath("sitecontent_top.php")); ?>
			<? include(system_getFrontendPath("results_info.php")); ?>
		</div>
		
		<? include(system_getFrontendPath("results_filter.php")); ?>
		<? include(system_getFrontendPath("results_pagination.php")); ?>
		
		<div class="content-main">
			<? include(BLOG_EDIRECTORY_ROOT."/results_blog.php"); ?>
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
		<? include(BLOG_EDIRECTORY_ROOT."/browsebytag.php"); //<div id="sidebar_ajax"></div> ?>
		<? include(BLOG_EDIRECTORY_ROOT."/archive.php"); ?>
		<? include(BLOG_EDIRECTORY_ROOT."/recenttopics.php"); ?>
        <? include(system_getFrontendPath("banner_featured.php")); ?>
		<? include(system_getFrontendPath("banner_sponsoredlinks.php")); ?>
		<? include(system_getFrontendPath("googleads.php")); ?>
	</div>