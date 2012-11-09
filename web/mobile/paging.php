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
	# * FILE: /mobile/paging.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (MOBILE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	if (($pos = string_strrpos($_SERVER["PHP_SELF"], "/")) !== false) {
		$selfpage = string_substr($_SERVER["PHP_SELF"], ($pos+1));
	} else {
		$selfpage = $_SERVER["PHP_SELF"];
	}

	if ($item_total_amount > MAX_ITEM_PER_PAGE) {
		?><p class="paging"><?
			if ($page > 1) {
				?><span><a href="<?=MOBILE_DEFAULT_URL?>/<?=$selfpage?>?<?=(($query_string_mobile) ? ($query_string_mobile."&") : (""))?>page=<?=($page-1)?>">&laquo; <?=system_showText(LANG_PAGING_PREVIOUSPAGEMOBILE);?></a></span><?
			}
			if (($page*MAX_ITEM_PER_PAGE) < $item_total_amount) {
				?><span><a href="<?=MOBILE_DEFAULT_URL?>/<?=$selfpage?>?<?=(($query_string_mobile) ? ($query_string_mobile."&") : (""))?>page=<?=($page+1)?>"><?=system_showText(LANG_PAGING_NEXTPAGEMOBILE);?> &raquo;</a></span><?
			}
		?></p><?
	}

?>
