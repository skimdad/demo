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
	# * FILE: /blog/recentmembers.php
	# ----------------------------------------------------------------------------------------------------
	//
	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BLOG_FEATURE != "on" || CUSTOM_BLOG_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$newMembers = blog_retrieveNewMembers();
	
?>
<?
	if ($newMembers) { ?>

		<h2><?=system_showText(LANG_BLOG_RECENTMEMBERS)?></h2>
		
		<div class="blog-item blog-item-members">

		<? for ($i = 0; $i < count($newMembers["account_id"]); $i++) {?>

			<?
			echo "<div class=\"item\">";
			echo socialnetwork_writeLink($newMembers["account_id"][$i], "profile", "general_see_profile", $newMembers["image_id"][$i], false, false, "class='image'");
			echo "<p>".socialnetwork_writeLink($newMembers["account_id"][$i], "profile", "general_see_profile", false, false, false, "", "recentMembers")."</p>";
			echo "<p>".system_showText(LANG_LABEL_MEMBER_SINCE).": ".format_date($newMembers["entered"][$i])."</p>";
			echo "</div>";
			?>

		 <? } ?>
		 
		 </div>
			
	<? }
?>
	