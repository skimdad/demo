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
	# * FILE: /event/detail_info.php
	# ----------------------------------------------------------------------------------------------------

    if (EXTRA_FIELDS_SIDEBAR){ ?>

        <p class="button-back">
            <a href="<?=$tPreview || !$user ? "javascript: void(0);" : EVENT_DEFAULT_URL?>" <?=($tPreview || !$user ? "style=\"cursor:default\"" : "")?>><?=system_showText(LANG_BACKTO.LANG_EVENT_FEATURE_NAME_PLURAL);?></a>
        </p>
    
        <span class="clear">&nbsp;</span>

    <? } ?>