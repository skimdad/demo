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
	# * FILE: /frontend/body/profile_index.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="sidebar">
		<? include(EDIRECTORY_ROOT."/frontend/socialnetwork/user_info.php"); ?>
	</div>

	<div class="content">
	
		<? if ($sitecontent) { ?>
		<div class="content-top">
			<? include(EDIRECTORY_ROOT."/frontend/sitecontent_top.php"); ?>
		</div>
		<? } ?>
		
		<? include(EDIRECTORY_ROOT."/frontend/socialnetwork/page_tabs.php"); ?>
		
		<div class="content-main">
			<? include(EDIRECTORY_ROOT."/frontend/socialnetwork/user_contents.php"); ?>	
			<? include(EDIRECTORY_ROOT."/frontend/sitecontent_bottom.php"); ?>
		</div>
		
		<? include(EDIRECTORY_ROOT."/frontend/banner_bottom.php"); ?>
		
	</div>