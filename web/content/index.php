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
	# * FILE: /content/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# MAINTENANCE MODE
	# ----------------------------------------------------------------------------------------------------
	verify_maintenanceMode();
	
	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	$contentObj = new Content();
	$content_id = $contentObj->retrieveIDByURL($content);
	if ($content_id) {
		$contentObj = new Content($content_id, EDIR_LANGUAGE);
		$content_show = $contentObj->retrieveContentByURL($content);
		$content_title = $contentObj->getString("title");
		$headertagtitle = $contentObj->getString("title");
		$headertagdescription = $contentObj->getString("description");
		$headertagkeywords = $contentObj->getString("keywords");
	} else {
		$content_show = "";
		$headertagtitle = "";
		$headertagdescription = "";
		$headertagkeywords = "";
	}

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSessionFront();

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$headertag_title = $headertagtitle;
	$headertag_description = $headertagdescription;
	$headertag_keywords = $headertagkeywords;
	include(system_getFrontendPath("header.php", "layout"));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

?>

	<div class="content content-full">

		<div class="content-main">
		
			<h2><?=$content_title?></h2>
			
			<?
			if ($content_show) {
				echo "<div class=\"content-custom\">".$content_show."</div>";
			} else {
				echo "<p class=\"errorMessage\">".system_showText(LANG_MSG_NOTAVAILABLE)."</p>";
			}
			?>
		
		</div>
		
		<? include(system_getFrontendPath("banner_bottom.php")); ?>
	
	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(system_getFrontendPath("footer.php", "layout"));
?>
