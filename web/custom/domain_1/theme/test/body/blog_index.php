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
	# * FILE: /frontend/body/blog_index.php
	# ----------------------------------------------------------------------------------------------------
	
	
	include(BLOG_EDIRECTORY_ROOT."/searchresults.php");
?>
	<div class="content">
		
		<? include(EDIRECTORY_ROOT."/frontend/breadcrumb.php");?>
		
		<? if ($sitecontent) { ?>
		<div class="content-top">
			<? include(EDIRECTORY_ROOT."/frontend/sitecontent_top.php"); ?>
		</div>
		<? } ?>
		
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
		<? include(BLOG_EDIRECTORY_ROOT."/join.php"); ?>
		<? include(BLOG_EDIRECTORY_ROOT."/browsebytag.php"); ?>
		<? include(BLOG_EDIRECTORY_ROOT."/archive.php"); ?>
		<? include(BLOG_EDIRECTORY_ROOT."/populartopics.php"); ?>
		<? if(SOCIALNETWORK_FEATURE == "on") {
			include(BLOG_EDIRECTORY_ROOT."/recentmembers.php"); 
		} ?>
		<? include(EDIRECTORY_ROOT."/frontend/banner_featured.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/banner_sponsoredlinks.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/googleads.php"); ?>
	</div>