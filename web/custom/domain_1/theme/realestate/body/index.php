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
	# * FILE: /theme/realestate/body/index.php
	# ----------------------------------------------------------------------------------------------------

?>
	
    <div class="content-center">
	
        <div class="content">
			<? include(system_getFrontendPath("sitecontent_top.php")); ?>
            <div class="listing-home">
            	<? include(system_getFrontendPath("featured_listing.php")); ?>
			</div>
            <? include(system_getFrontendPath("featured_listing_review.php")); ?>
            <? include(system_getFrontendPath("sitecontent_bottom.php")); ?>
            <? include(system_getFrontendPath("banner_bottom.php")); ?>
        </div>
    
        <div class="sidebar">
        	<? include(system_getFrontendPath("searchSidebar.php")); ?>
			<? include(LISTING_EDIRECTORY_ROOT."/locations.php"); ?>
            <div id="sidebar_ajax"></div>
            <? include(system_getFrontendPath("twitter.php")); ?>
            <? include(system_getFrontendPath("banner_featured.php")); ?>
            <? include(system_getFrontendPath("banner_sponsoredlinks.php")); ?>
            <? include(system_getFrontendPath("googleads.php")); ?>
        </div>
    
    </div>