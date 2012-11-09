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
	# * FILE: /classified/detail_maps.php
	# ----------------------------------------------------------------------------------------------------
	
	if ($tPreview) {
		echo "<div class=\"map\">";
		echo "<img src=\"".THEMEFILE_URL."/".EDIR_THEME."/images/imagery/img-google-map-sample.gif\" alt=\"\" title=\"\"/>";
		echo "</div>";
	} else {
		if (!$classifiedMsg && !$hideDetail){
			if (GOOGLE_MAPS_ENABLED == "on" && $mapObj->getString("value") == "on") {
				echo "<div id=\"map\" class=\"map\">&nbsp;</div>";
				echo $classified_googlemaps;
			}
		}
	}
	?>