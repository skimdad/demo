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
	# * FILE: /theme/realestate/body/promotion_index.php
	# ----------------------------------------------------------------------------------------------------
        
?>

	<div class="content-center">

		<? include(system_getFrontendPath("breadcrumb.php")); ?>
        
        <? include(PROMOTION_EDIRECTORY_ROOT."/special_deal.php"); ?>
        <div class="special-deal-shadow"></div>
    
        <div class="content">
        
            <div class="content-top">
                <? include(system_getFrontendPath("sitecontent_top.php")); ?>
            </div>
            
            <div class="content-main">	
                <? include(PROMOTION_EDIRECTORY_ROOT."/featured.php"); ?>
                <? include(PROMOTION_EDIRECTORY_ROOT."/categories.php"); ?>
                <? include(system_getFrontendPath("sitecontent_bottom.php")); ?>
            </div>
            
            <? include(system_getFrontendPath("banner_bottom.php")); ?>
            
        </div>
    
        <div class="sidebar">
            <? include(system_getFrontendPath("searchSidebar.php")); ?>
            <? include(PROMOTION_EDIRECTORY_ROOT."/locations.php"); ?>
            <? include(system_getFrontendPath("banner_featured.php")); ?>
            <? include(system_getFrontendPath("banner_sponsoredlinks.php")); ?>
            <? include(system_getFrontendPath("googleads.php")); ?>
        </div>
        
	</div>