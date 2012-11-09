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
	# * FILE: /frontend/body/blog_results.php
	# ----------------------------------------------------------------------------------------------------

	/*
	 * Prepare content to results
	 */
	include(BLOG_EDIRECTORY_ROOT."/searchresults.php");	
?>
	<div class="content">
		
		<? include(EDIRECTORY_ROOT."/frontend/breadcrumb.php");?>
		
		<div class="content-top">
			<? include(EDIRECTORY_ROOT."/frontend/sitecontent_top.php"); ?>
			<? include(EDIRECTORY_ROOT."/frontend/results_info.php"); ?>
		</div>
		
		<? include(EDIRECTORY_ROOT."/frontend/results_filter.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/results_pagination.php"); ?>
		
		<div class="content-main">
			<? include(BLOG_EDIRECTORY_ROOT."/results_blog.php"); ?>
		</div>
		
		<? 
		$pagination_bottom = true;
		include(EDIRECTORY_ROOT."/frontend/results_pagination.php"); 
		?>
		<? include(EDIRECTORY_ROOT."/frontend/sitecontent_bottom.php"); ?>
		
		<? include(EDIRECTORY_ROOT."/frontend/banner_bottom.php"); ?>
	</div>

	<div class="sidebar">
		<? include(BLOG_EDIRECTORY_ROOT."/browsebytag.php"); ?>
		<? include(BLOG_EDIRECTORY_ROOT."/archive.php"); ?>
		<? include(BLOG_EDIRECTORY_ROOT."/recenttopics.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/banner_featured.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/banner_sponsoredlinks.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/googleads.php"); ?>
	</div>