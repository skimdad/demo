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
	# * FILE: /includes/code/location.php
	# ----------------------------------------------------------------------------------------------------

	/**
	* Default CSS class for Location messages
	**/
	$message_style = "errorMessage";

	//Verify if needed to disable the fulltext update
	//$updFullText = ($_POST['disableFullTextUpdate'] ? false : true);
	$updFullText = false;

	//Replacing spacing greater than 2 between strings in locations
	if ($_POST["location_name"]) {
		$_POST["location_name"] = preg_replace('/\s\s+/', ' ', $_POST["location_name"]);
	}
	if ($_POST["location_abbreviation"]) {
		$_POST["location_abbreviation"] = preg_replace('/\s\s+/', ' ', $_POST["location_abbreviation"]);
	}

	$locationObjName = "Location".$_location_level;
	$objLocation = new $locationObjName;

	// Insert operation for Locations
	if(string_strtolower($operation) == "insert"){

		$loc_level = explode(",", EDIR_LOCATIONS);
		$lastLoc = null;
		$newLoc = null;
		$hasLast = false;
		foreach ($loc_level as $k=>$level) {
			if (!$_POST["location_$level"]) {
				if ($k - 1 >= 0 && !$hasLast) {
					$lastLoc["level"] = $level;
					$lastLoc["up_level"] = $loc_level[$k - 1];
					$lastLoc["up_val"] = $_POST["location_".$loc_level[$k - 1]];
					$hasLast = true;
				}

				if ($_POST["new_location".$level."_field"]) {
					$newLoc[$k]["level"] = $level;
					$newLoc[$k]["val"] = $_POST["new_location".$level."_field"];
					if ($k+1 < count($loc_level)) {
						$newLocLevelBlank = $loc_level[$k+1];
					}
				}
			}
		}

		$i=0;
		if ($_location_father_level !== false) {
			while ($_locations[$i]<$_location_level) {
				if ($_POST["location_".$_locations[$i]]) {
					$_GET["location_".$_locations[$i]] = $_POST["location_".$_locations[$i]];
					$objLocation->setString("location_".$_locations[$i], $_POST["location_".$_locations[$i]]);
				}
				else {
					if (!$_POST["new_location".$_locations[$i]."_field"] && !$_POST["new_location".$_locations[$i]."_friendly"] && !$_POST["location_".$_locations[$i]]) {
						$each_location_name = system_showText(constant("LANG_LABEL_".constant("LOCATION".$_locations[$i]."_SYSTEM")));
						$error_message[] = ucfirst(system_showText(LANG_SITEMGR_MSGERROR_FIELD))." \"".string_ucwords($each_location_name)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
					}
				}
				$i++;
			}
		}
		unset($i);

		if (!trim($_POST["location_name"])) $error_message[] = ucfirst(system_showText(LANG_SITEMGR_MSGERROR_FIELD))." \"".string_ucwords(LOCATION_TITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
		if (!trim($_POST["friendly_url"]))  $error_message[] = ucfirst(system_showText(LANG_SITEMGR_MSGERROR_FIELD))." \"".system_showText(LANG_SITEMGR_LABEL_FRIENDLYTITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);

		if ($error_message) $location_message = implode("<br />", $error_message);

		if(!$error_message){

			$edir_locations = explode(",", EDIR_LOCATIONS);


			// adding new locations if posted
			if ($_POST["new_location2_field"]!="" || $_POST["new_location3_field"]!="" || $_POST["new_location4_field"]!="" || $_POST["new_location5_field"]!="") {

				$locationsToSave = array();

				$_locations = explode(",", EDIR_LOCATIONS);
				$_defaultLocations = explode (",", EDIR_DEFAULT_LOCATIONS);
				$_nonDefaultLocations = array_diff_assoc($_locations, $_defaultLocations);

				foreach ($_defaultLocations as $defLoc)
					$locationsToSave[$defLoc] = $_POST["location_".$defLoc];

				$stop_insert_location = false;

				foreach ($_nonDefaultLocations as $nonDefLoc) {
					if (trim($_POST["location_".$nonDefLoc])!="")
						$locationsToSave[$nonDefLoc] = $_POST["location_".$nonDefLoc];
					else {
						if (!$stop_insert_location) {
							if (!$_POST['new_location'.$nonDefLoc.'_field']) {
								$stop_insert_location = true;
							} else {
								$objNewLocationLabel = "Location".$nonDefLoc;
								$objNewLocation = new $objNewLocationLabel;

								foreach ($locationsToSave as $level => $value)
									$objNewLocation->setString("location_".$level, $value);

								$objNewLocation->setString("name", $_POST['new_location'.$nonDefLoc.'_field']);
								$objNewLocation->setString("friendly_url", $_POST['new_location'.$nonDefLoc.'_friendly']);
								$objNewLocation->setString("default", "n");
								$objNewLocation->setString("featured", "n");

								$newLocationFlag = $objNewLocation->retrievedIfRepeated($_locations);
								if ($newLocationFlag) $objNewLocation->setNumber("id", $newLocationFlag);
								else $objNewLocation->Save();
								$_POST["location_".$nonDefLoc] = $objNewLocation->getNumber("id");
								$_GET["location_".$nonDefLoc] = $objNewLocation->getNumber("id");
								$locationsToSave[$nonDefLoc] = $_POST["location_".$nonDefLoc];
							}
						}
					}
				}
			}

			foreach ($edir_locations as $k=>$edir_location) {
				if ($edir_location <= $_location_father_level) {
					if ($_POST["location_$edir_location"]) {
						$objLocation->setNumber("location_$edir_location", $_POST["location_$edir_location"]);
					}
				}
			}

			$objLocation->setString("name", trim($_POST["location_name"]));
			$objLocation->setString("abbreviation", trim($_POST["location_abbreviation"]));
			$objLocation->setString("default", "n");
            $objLocation->setString("friendly_url",$_POST["friendly_url"]);
			$objLocation->setString("seo_description",$_POST["seo_description"]);
			$objLocation->setString("seo_keywords",$_POST["seo_keywords"]);

			if (!$objLocation->isRepeated($_location_father_level, $location_message)){
				if($objLocation->isValidFriendlyUrl($_location_father_level, $location_message)){
					$objLocation->Save();

					$locations_info = db_getFromDB("settinglocation", "id", $_location_level, 1, "", "array", SELECTED_DOMAIN_ID);
					if (!$locations_info["default_id"]) {
						$locationFeatObj = new LocationFeatured();

						if ($_POST["location_featured"]) {
							$locationFeatObj->setFeatured(SELECTED_DOMAIN_ID, $_location_level, $objLocation->getNumber("id"));
						} else {
							$locationFeatObj->deleteFeatured(SELECTED_DOMAIN_ID, $_location_level, $objLocation->getNumber("id"));
						}
					}

					$location_name = $objLocation->getString("name");
					$success = true;
				}
			}
		}
	}

	// Edit operation for Locations
	if(string_strtolower($operation) == "edit"){
		if(!$id){
			$location_message = ucfirst(system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT1))." ".string_strtolower(LOCATION_TITLE)." ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT2);
		} else {
			unset($is_featured, $locationFeatObj);
			$locationFeatObj = new LocationFeatured(SELECTED_DOMAIN_ID, $_location_level, $id);
			if ($locationFeatObj->getNumber("location_id")) $is_featured = "y";
			else  $is_featured = "n";

			$objLocation->SetString("id", $id);
			$location_data = $objLocation->retrieveLocationById();
			$location_name = $location_data["name"];
			$location_default = $location_data["default"];
            $location_abbreviation = $location_data["abbreviation"];
			$location_featured = $is_featured;
			$friendly_url = $location_data["friendly_url"];
			$seo_description = $location_data["seo_description"];
			$seo_keywords = $location_data["seo_keywords"];
		}
	}


	// Update operation for Locations
	if(string_strtolower($_POST["operation"]) == "update"){

		$loc_level = explode(",", EDIR_LOCATIONS);
		$lastLoc = null;
		$newLoc = null;
		$hasLast = false;
		foreach ($loc_level as $k=>$level) {
			if (!$_POST["location_$level"]) {
				if ($k - 1 >= 0 && !$hasLast) {
					$lastLoc["level"] = $level;
					$lastLoc["up_level"] = $loc_level[$k - 1];
					$lastLoc["up_val"] = $_POST["location_".$loc_level[$k - 1]];
					$hasLast = true;
				}

				if ($_POST["new_location".$level."_field"]) {
					$newLoc[$k]["level"] = $level;
					$newLoc[$k]["val"] = $_POST["new_location".$level."_field"];
					if ($k+1 < count($loc_level)) {
						$newLocLevelBlank = $loc_level[$k+1];
					}
				}
			}
		}

		$i=0;
		if ($_location_father_level !== false) {
			while ($_locations[$i]<$_location_level) {
				if ($_POST["location_".$_locations[$i]]) {
					$objLocation->setString("location_".$_locations[$i], $_POST["location_".$_locations[$i]]);
					$_GET["location_".$_locations[$i]] = $_POST["location_".$_locations[$i]];

				}
				else {
					if (!$_POST["new_location".$_locations[$i]."_field"] && !$_POST["new_location".$_locations[$i]."_friendly"] && !$_POST["location_".$_locations[$i]]) {
						$each_location_name = system_showText(constant("LANG_LABEL_".constant("LOCATION".$_locations[$i]."_SYSTEM")));
						$error_message[] = ucfirst(system_showText(LANG_SITEMGR_MSGERROR_FIELD))." \"".string_ucwords($each_location_name)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
					}
				}
				$i++;
			}
		}
		unset($i);

		if(!$_POST["id"]) $error_message[] = system_showText(LANG_SITEMGR_LOCATION_IDMISSING);
		if(!trim($_POST["location_name"])) $error_message[] = ucfirst(system_showText(LANG_SITEMGR_LABEL_FIELD))." \"".string_ucwords(LOCATION_TITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
		if(!trim($_POST["friendly_url"])) $error_message[] = ucfirst(system_showText(LANG_SITEMGR_LABEL_FIELD))." \"".system_showText(LANG_SITEMGR_LABEL_FRIENDLYTITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);

		if($error_message) $location_message = implode("<br />", $error_message);

		if(!$error_message) {

			if ($_location_father_level !== false) {
				$objLocation->setString("location_".$_location_father_level, $_POST["location_".$_location_father_level]);
			}

			$edir_locations = explode(",", EDIR_LOCATIONS);


			// adding new locations if posted
			if ($_POST["new_location2_field"]!="" || $_POST["new_location3_field"]!="" || $_POST["new_location4_field"]!="" || $_POST["new_location5_field"]!="") {

				$locationsToSave = array();

				$_locations = explode(",", EDIR_LOCATIONS);
				$_defaultLocations = explode (",", EDIR_DEFAULT_LOCATIONS);
				$_nonDefaultLocations = array_diff_assoc($_locations, $_defaultLocations);

				foreach ($_defaultLocations as $defLoc)
					$locationsToSave[$defLoc] = $_POST["location_".$defLoc];

				$stop_insert_location = false;

				foreach ($_nonDefaultLocations as $nonDefLoc) {
					if (trim($_POST["location_".$nonDefLoc])!="")
						$locationsToSave[$nonDefLoc] = $_POST["location_".$nonDefLoc];
					else {
						if (!$stop_insert_location) {
							if (!$_POST['new_location'.$nonDefLoc.'_field']) {
								$stop_insert_location = true;
							} else {
								$objNewLocationLabel = "Location".$nonDefLoc;
								$objNewLocation = new $objNewLocationLabel;

								foreach ($locationsToSave as $level => $value)
									$objNewLocation->setString("location_".$level, $value);

								$objNewLocation->setString("name", $_POST['new_location'.$nonDefLoc.'_field']);
								$objNewLocation->setString("friendly_url", $_POST['new_location'.$nonDefLoc.'_friendly']);
								$objNewLocation->setString("default", "n");
								$objNewLocation->setString("featured", "n");

								$newLocationFlag = $objNewLocation->retrievedIfRepeated($_locations);
								if ($newLocationFlag) $objNewLocation->setNumber("id", $newLocationFlag);
								else $objNewLocation->Save();
								$_POST["location_".$nonDefLoc] = $objNewLocation->getNumber("id");
								$_GET["location_".$nonDefLoc] = $objNewLocation->getNumber("id");
								$locationsToSave[$nonDefLoc]=$_POST["location_".$nonDefLoc];
							}
						}
					}
				}
			}

			foreach ($edir_locations as $k=>$edir_location) {
				if ($edir_location <= $_location_father_level) {
					if ($_POST["location_$edir_location"]) {
						$objLocation->setNumber("location_$edir_location", $_POST["location_$edir_location"]);
					}
				}
			}

			$objLocation->setString("id",$_POST["id"]);
			$objLocation->setString("name",trim($_POST["location_name"]));
			$objLocation->setString("abbreviation",trim($_POST["location_abbreviation"]));
			$objLocation->setString("friendly_url",$_POST["friendly_url"]);
            $objLocation->setString("default",$_POST["default"]);
			$objLocation->setString("seo_description",$_POST["seo_description"]);
			$objLocation->setString("seo_keywords",$_POST["seo_keywords"]);
			if(!$objLocation->isRepeated($_location_father_level, $location_message)){
				if($objLocation->isValidFriendlyUrl($_location_father_level, $location_message)){
					$objLocation->Save();

					$locations_info = db_getFromDB("settinglocation", "id", $_location_level, 1, "", "array", SELECTED_DOMAIN_ID);
					if (!$locations_info["default_id"]) {
						$locationFeatObj = new LocationFeatured();

						if ($_POST["location_featured"]) {
							$locationFeatObj->setFeatured(SELECTED_DOMAIN_ID, $_location_level, $objLocation->getNumber("id"));
						} else {
							$locationFeatObj->deleteFeatured(SELECTED_DOMAIN_ID, $_location_level, $objLocation->getNumber("id"));
						}
					}

					$success = true;
				}
			}
		}
	}


	// Delete operation for Locations
	if(string_strtolower($operation) == "delete"){
		if(!$id){
			$location_message = ucfirst(system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT1))." ".string_strtolower(LOCATION_TITLE)." ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT2);
		} else {
			$objLocation->SetString("id",$id);
			$location_data = $objLocation->retrieveLocationById();
			$objLocation->Delete($updFullText);
			$location_name = $location_data["name"];
			$success = true;
		}
	}

	$locations = $objLocation->retrieveAllLocation();

	// Location General Defines
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
	// End Location General Defines

	// Location defines begin for insert / edit location
	//if there is at least one non default location
	if ($_non_default_locations) {
		foreach($_non_default_locations as $each_location_level) {
			system_retrieveLocationRelationship ($_non_default_locations, $each_location_level, $each_location_father_level, $each_location_child_level);
			if (${'location_'.$each_location_level} && $each_location_child_level) {
				if (!$stop_search_locations) {
					$objLocationLabel = "Location".$each_location_child_level;
					${"Location".$each_location_child_level} = new $objLocationLabel;
					${"Location".$each_location_child_level}->SetString("location_".$each_location_level, ${"location_".$each_location_level});
					${"locations".$each_location_child_level} = ${"Location".$each_location_child_level}->retrieveLocationByLocation($each_location_level);
				} else 	${"locations".$each_location_child_level} = "";
			} else $stop_search_locations = true;
		}
		unset ($each_location_father_level);
		unset ($each_location_child_level);
		unset ($each_location_level);
	}
	// End Locations

?>