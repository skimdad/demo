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
	# * FILE: /frontend/body/classified_index.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="content">

		<? include(EDIRECTORY_ROOT."/frontend/breadcrumb.php"); ?>

		<div class="content-top">
			<? include(EDIRECTORY_ROOT."/frontend/sitecontent_top.php"); ?>
			<? include(CLASSIFIED_EDIRECTORY_ROOT."/featured.php"); ?>
		</div>
		
		<div class="content-main">	
			<? include(CLASSIFIED_EDIRECTORY_ROOT."/categories.php"); ?>
			<? include(EDIRECTORY_ROOT."/frontend/sitecontent_bottom.php"); ?>
		</div>
		
		<? include(EDIRECTORY_ROOT."/frontend/banner_bottom.php"); ?>
	
	</div>

	<div class="sidebar">
		<? include(CLASSIFIED_EDIRECTORY_ROOT."/join.php"); ?>
		<? include(CLASSIFIED_EDIRECTORY_ROOT."/locations.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/banner_featured.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/banner_sponsoredlinks.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/googleads.php"); ?>
	</div>