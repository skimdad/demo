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
	# * FILE: /frontend/body/profile_add.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="content">
	
		<? if ($sitecontent) { ?>
		<div class="content-top">
		<? include(EDIRECTORY_ROOT."/frontend/sitecontent_top.php"); ?>
		</div>
		<? } ?>
		
		<div class="content-main">
			<h2><?=LANG_CREATE_MEMBER_PROFILE?></h2>
			<? include(EDIRECTORY_ROOT."/frontend/socialnetwork/add_account.php"); ?>
			<? include(EDIRECTORY_ROOT."/frontend/sitecontent_bottom.php"); ?>
		</div>
		
		<? include(EDIRECTORY_ROOT."/frontend/banner_bottom.php"); ?>
		
	</div>

	<div class="sidebar">
		<? include(EDIRECTORY_ROOT."/frontend/banner_featured.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/banner_sponsoredlinks.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/googleads.php"); ?>
	</div>