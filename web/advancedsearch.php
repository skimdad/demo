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
	# * FILE: /advancedsearch.php
	# ----------------------------------------------------------------------------------------------------

	/*
	* Preparing loading gif to ajax
	*/
	$categoryDD = "<img src=\"".DEFAULT_URL."/theme/".EDIR_THEME."/images/iconography/icon-loading-location.gif\" alt=\"".system_showText(LANG_WAITLOADING)."\"/>";

	if ($hasWhereSearch){
		//locations
		$_non_default_locations = "";
		$_default_locations_info = "";
		if (EDIR_DEFAULT_LOCATIONS) {

			system_retrieveLocationsInfo ($_non_default_locations, $_default_locations_info);

			$last_default_location	  =	$_default_locations_info[count($_default_locations_info)-1]['type'];
			$last_default_location_id = $_default_locations_info[count($_default_locations_info)-1]['id'];

			if ($_non_default_locations) {
				$objLocationLabel = "Location".$_non_default_locations[0];
				${"Location".$_non_default_locations[0]} = new $objLocationLabel;
				${"Location".$_non_default_locations[0]}->SetString("location_".$last_default_location, $last_default_location_id);
				${"locations".$_non_default_locations[0]} = ${"Location".$_non_default_locations[0]}->retrieveLocationByLocation($last_default_location);
			}

		} else {
			$_non_default_locations = explode(",", EDIR_LOCATIONS);
			$objLocationLabel = "Location".$_non_default_locations[0];
			${"Location".$_non_default_locations[0]} = new $objLocationLabel;
			${"locations".$_non_default_locations[0]}  = ${"Location".$_non_default_locations[0]}->retrieveAllLocation();
		}
		//end locations
	}
	
	/*
	 * Include form to advanced search
	 */
	include(INCLUDES_DIR."/forms/form_advanced_search_front.php"); 
	?>