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
	# * FILE: /frontend/sitecontent_bottom.php
	# ----------------------------------------------------------------------------------------------------

	$contentObj = new Content("", EDIR_LANGUAGE);
	$content = $contentObj->retrieveContentByType($sitecontentSection." Bottom");
	if ($content) {
		echo "<div class=\"content-custom\">".$content."</div>";
	}

?>
