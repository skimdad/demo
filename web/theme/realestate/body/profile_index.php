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
	# * FILE: /theme/realestate/body/profile_index.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="content-center">

        <div class="sidebar">
            <? include(system_getFrontendPath("socialnetwork/user_info.php")); ?>
            <? include(system_getFrontendPath("banner_featured.php")); ?>
            <? include(system_getFrontendPath("banner_sponsoredlinks.php")); ?>
        </div>
    
        <div class="content">
        
            <? if ($sitecontent) { ?>
                <div class="content-top">
                    <? include(system_getFrontendPath("sitecontent_top.php")); ?>
                </div>
            <? } ?>
            
            <? include(system_getFrontendPath("socialnetwork/page_tabs.php")); ?>
            
            <div class="content-main">
                <? include(system_getFrontendPath("socialnetwork/user_contents.php")); ?>
                <? include(system_getFrontendPath("sitecontent_bottom.php")); ?>
            </div>
            
            <? include(system_getFrontendPath("banner_bottom.php")); ?>
            
        </div>
        
	</div>