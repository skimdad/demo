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
	# * FILE: /theme/default/body/blog_detail.php
	# ----------------------------------------------------------------------------------------------------

?>
	<div class="content">
		
		<? include(system_getFrontendPath("breadcrumb.php")); ?>
		
		<div class="content-main pd-0">
			<? $isDetail = true; $user = true; ?>
			<? include(BLOG_EDIRECTORY_ROOT."/prepare_blog_content.php"); ?>
			<? include(BLOG_EDIRECTORY_ROOT."/detailview.php"); ?>
		</div>
		
		<? include(system_getFrontendPath("banner_bottom.php")); ?>
	
	</div>

	<div class="sidebar">
		<? include(BLOG_EDIRECTORY_ROOT."/browsebytag.php"); ?>
		<? include(BLOG_EDIRECTORY_ROOT."/archive.php"); ?>
		<? $aux_show_related_topics = true; ?>
		<? include(BLOG_EDIRECTORY_ROOT."/recenttopics.php"); ?>
		<? include(system_getFrontendPath("banner_featured.php")); ?>
		<? include(system_getFrontendPath("banner_sponsoredlinks.php")); ?>
		<? include(system_getFrontendPath("googleads.php")); ?>
	</div>