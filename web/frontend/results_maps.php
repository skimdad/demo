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
	# * FILE: /frontend/results_maps.php
	# ----------------------------------------------------------------------------------------------------

	if($show_results){
		if (GOOGLE_MAPS_ENABLED == "on") {
			if ($aux_module_items && $mapObj->getString("value") == "on") {
				?>
				
				<div class="map-control">
					<a id="linkDisplayMap" href="javascript:void(0)" onclick="displayMap()">
						<?=(($_COOKIE['showMap'] == 0) ? (system_showText(LANG_LABEL_HIDEMAP)) : (system_showText(LANG_LABEL_SHOWMAP)))?>
					</a>
				</div>
				
				<div id="resultsMap" class="map" style="display:<?=(($_COOKIE['showMap'] == 0) ? ('') : ('none'))?>"></div>
				<?
			}
		}
	}
?>
