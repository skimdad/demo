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
	# * FILE: /frontend/twitter.php
	# ----------------------------------------------------------------------------------------------------
    $twitterObj = new Twitter();
    if($twitterObj->getRandonAccount()){
        $tweetInfo = $twitterObj->userInfo();
    
        if ($tweetInfo["id"] && $tweetInfo["protected"] != "true"){ ?>

            <h2><span><?=system_showText(LANG_TWITTER)?></span></h2>
            <div class="last-tweets">
                <ul id="twitter_update_list_footer">
                    <li id="twitter_loading_footer" class="loading"></li>
                </ul>
            </div>
        <? }
    }
?>
