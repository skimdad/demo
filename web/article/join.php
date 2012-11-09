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
	# * FILE: /article/join.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	if (SOCIALNETWORK_FEATURE == "on") {
		if (!sess_getAccountIdFromSession()) { ?>
		<div class="button button-profile">
			<h2><a href="<?=SOCIALNETWORK_URL;?>/add.php"><?=system_showText(LANG_JOIN_PROFILE);?></a></h2>			
		</div>
	<?	}
	}else{
	?>
		<div class="button button-profile">
			<h2><a href="<?=DEFAULT_URL;?>/advertise.php?article"><?=system_showText(LANG_BUTTON_ADDARTICLE);?></a></h2>		
		</div>
	<?
	} ?>