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
	# * FILE: /theme/realestate/body/general.php
	# ----------------------------------------------------------------------------------------------------

?>
	<div class="content-center">
        <div class="content content-general">
            
            <? include(system_getFrontendPath("breadcrumb.php")); ?>
            
            <div class="content-main">
                <? include(system_getFrontendPath("sitecontent_top.php")); ?>
                <? include(system_getFrontendPath("general.php")); ?>
            </div>
            
            <? include(system_getFrontendPath("sitecontent_bottom.php")); ?>
            
            <? include(system_getFrontendPath("banner_bottom.php")); ?>
            
        </div>
    
        <div class="sidebar">
            <? include(system_getFrontendPath("banner_featured.php")); ?>
            <? include(system_getFrontendPath("banner_sponsoredlinks.php")); ?>
            <? include(system_getFrontendPath("googleads.php")); ?>
        </div>
	</div>