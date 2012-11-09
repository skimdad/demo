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
	# * FILE: /functions/zipproximity_funct.php
	# ----------------------------------------------------------------------------------------------------

	// ---------------------------------------------------------------------------------------------------- \\
	// PRIVATE FUNCTIONS                                                                                    \\
	// ---------------------------------------------------------------------------------------------------- \\

	function zipproximity_getZip5($zip, &$zip5) {

		$zip = trim($zip);
		$zip5 = "";

		if (($zip) && (string_strlen($zip) > 0)) {

			##################################################
			# United States ZipCode (US)
			##################################################
			if (ZIPCODE_US == "on") {
				if (preg_match("/^[0-9]/", string_substr($zip, 0, 1))) {
					while (preg_match("/^[0-9]/", string_substr($zip, 0, 1))) {
						$zip5 .= string_substr($zip, 0, 1);
						$zip = string_substr($zip, 1);
					}
					if (($zip5) && (string_strlen($zip5) > 0)) {
						if (string_strlen($zip5) > 5) {
							$zip5 = string_substr($zip5, 0, 5);
						}
						$zip5 = $zip5 + 0;
						if (($zip5) && ($zip5 > 0)) {
							while (string_strlen($zip5) < 5) {
								$zip5 = "0" . $zip5;
							}
							$zip5 = string_strtoupper($zip5);
							return true;
						}
					}
				}
			}
			##################################################

			##################################################
			# Canada ZipCode (CA)
			##################################################
			if (ZIPCODE_CA == "on") {
				if (preg_match("/^[a-zA-Z]/", string_substr($zip, 0, 1))) {
					if (!preg_match("/^(\s{1})/", string_substr($zip, 3, 1))) {
						$zip = string_substr($zip, 0, 3)." ".string_substr($zip, 3);
					}
					if (!preg_match("/^[0-9]/", string_substr($zip, 4, 1))) {
						$zip = string_substr($zip, 0, 4).string_substr($zip, 5);
					}
					$zip5 = string_substr($zip, 0, 7);
					if (preg_match("/^([a-zA-Z]{1})([0-9]{1})([a-zA-Z]{1})(\s{1})([0-9]{1})([a-zA-Z]{1})([0-9]{1})/", $zip5)) {
						$zip5 = string_strtoupper($zip5);
						return true;
					}
				}
			}
			##################################################

			##################################################
			# United Kingdom ZipCode (UK)
			##################################################
			if (ZIPCODE_UK == "on") {
				if (preg_match("/^[0-9a-zA-Z]/", string_substr($zip, 0, 1))) {
					while (preg_match("/^[0-9a-zA-Z]/", string_substr($zip, 0, 1))) {
						$zip5 .= string_substr($zip, 0, 1);
						$zip = string_substr($zip, 1);
					}
					if (($zip5) && (string_strlen($zip5) > 0)) {
						if (string_strlen($zip5) > 4) {
							$zip5 = string_substr($zip5, 0, 4);
						}
						if (($zip5) && (string_strlen($zip5) > 0)) {
							$zip5 = string_strtoupper($zip5);
							return true;
						}
					}
				}
			}
			##################################################

			##################################################
			# Australia ZipCode (AU)
			##################################################
			if (ZIPCODE_AU == "on") {
				if (preg_match("/^[0-9]/", string_substr($zip, 0, 1))) {
					while (preg_match("/^[0-9]/", string_substr($zip, 0, 1))) {
						$zip5 .= string_substr($zip, 0, 1);
						$zip = string_substr($zip, 1);
					}
					if (($zip5) && (string_strlen($zip5) > 0)) {
						if (string_strlen($zip5) > 4) {
							$zip5 = string_substr($zip5, 0, 4);
						}
						$zip5 = $zip5 + 0;
						if (($zip5) && ($zip5 > 0)) {
							while (string_strlen($zip5) < 4) {
								$zip5 = "0" . $zip5;
							}
							$zip5 = string_strtoupper($zip5);
							return true;
						}
					}
				}
			}
			##################################################

		}

		return false;

	}

	function zipproximity_validateZip5($zip5) {
		$dbObj = db_getDBObject(DEFAULT_DB, true);
		$sql = "SELECT ZipCode FROM ZipCode_Data WHERE ZipCode = '".$zip5."' LIMIT 1";
		$result = $dbObj->query($sql);
		if ((mysql_num_rows($result)) && (mysql_num_rows($result)) > 0) {
			return true;
		}
		return false;
	}

	function zipproximity_getZip5Fields($zip5, &$latitude, &$longitude) {
		$dbObj = db_getDBObject(DEFAULT_DB, true);
		$sql = "SELECT ZipCode, Latitude, Longitude FROM ZipCode_Data WHERE ZipCode = '".$zip5."' LIMIT 1";
		$r = $dbObj->query($sql);
		if ($row = mysql_fetch_array($r)) {
			$latitude = $row["Latitude"];
			$longitude = $row["Longitude"];
			return true;
		}
		return false;
	}

	function zipproximity_saveZip5($table, $id, $zip5, $lati, $long) {
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		if (zipproximity_getZip5Fields($zip5, $latitude, $longitude)) {
            if ($lati){
                $latitude = $lati;
            }
            if ($long){
                $longitude = $long;
            }
			$sql = "UPDATE ".$table." SET zip5 = '".$zip5."', latitude = '".$latitude."', longitude = '".$longitude."' WHERE id = '".$id."'";
			$r = $dbObj->query($sql);
            
            if ($table == "Listing"){
                $sql = "UPDATE Promotion SET listing_zip5 = '".$zip5."', listing_latitude = '$lati', listing_longitude = '$long' WHERE listing_id = '".$id."'";
                $r = $dbObj->query($sql);
            }
            
			return true;
		}
		$sql = "UPDATE ".$table." SET zip5 = '0', latitude = '$lati', longitude = '$long' WHERE id = '".$id."'";
		$r = $dbObj->query($sql);
        
        if ($table == "Listing"){
            $sql = "UPDATE Promotion SET listing_zip5 = '0', listing_latitude = '$lati', listing_longitude = '$long' WHERE listing_id = '".$id."'";
            $r = $dbObj->query($sql);
        }
		return false;
	}

	// ---------------------------------------------------------------------------------------------------- \\
	// PUBLIC FUNCTIONS                                                                                     \\
	// ---------------------------------------------------------------------------------------------------- \\

	function zipproximity_validate($zip) {
		if (zipproximity_getZip5($zip, $zip5)) {
			if (zipproximity_validateZip5($zip5)) {
				return true;
			}
		}
		return false;
	}

	function zipproximity_updateDB($table, $id) {
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		$sql = "SELECT zip_code, latitude, longitude FROM ".$table." WHERE id = '".$id."'";
		$r = $dbObj->query($sql);
		if ($row = mysql_fetch_array($r)) {
			$zip = $row["zip_code"];
			$lat = $row["latitude"];
			$lon = $row["longitude"];
			if (zipproximity_getZip5($zip, $zip5)) {
				if (zipproximity_validateZip5($zip5)) {
					zipproximity_saveZip5($table, $id, $zip5, $lat, $lon);
					return true;
				}
			}
		}
		zipproximity_saveZip5($table, $id, "0", $lat, $lon);
		return false;
	}

	function zipproximity_getWhereZipCodeProximity($zip, $dist, &$whereZipCodeProximity, &$order_by_zipcode_score,$latitudeIPhone=false,$longitudeIPhone=false, $promotion = false) {

		$constMile = 0.014473204925797298063067594227;
		$constKm   = 0.008993232600237922265686778139;
		$order_by_zipcode_score = "";
		if (ZIPCODE_UNIT == "mile") $constDist = $constMile;
		elseif (ZIPCODE_UNIT == "km") $constDist = $constKm;
		$dist = $dist + 0;
		if (zipproximity_getZip5($zip, $zip5)  || ($latitudeIPhone && $longitudeIPhone)) {
			if (zipproximity_validateZip5($zip5)  || ($latitudeIPhone && $longitudeIPhone)) {
				if (zipproximity_getZip5Fields($zip5, $latitude, $longitude) || ($latitudeIPhone && $longitudeIPhone)) {

					if($latitudeIPhone && $longitudeIPhone){
						$latitude = $latitudeIPhone;
						$longitude = $longitudeIPhone;
					}
                    
                    if ($promotion){
                        $latitudeField = "listing_latitude";
                        $longitudeField = "listing_longitude";
                        $zip5Field = "listing_zip5";
                    } else {
                        $latitudeField = "latitude";
                        $longitudeField = "longitude";
                        $zip5Field = "zip5";
                    }

					$HighLatitude = $latitude + $dist * $constDist;
					$LowLatitude = $latitude - $dist * $constDist;
					$HighLongitude = $longitude + $dist * $constDist;
					$LowLongitude = $longitude - $dist * $constDist;
					$whereZipCodeProximity = "";
					$whereZipCodeProximity .= "(";
					$whereZipCodeProximity .= "$latitudeField <= ".$HighLatitude;
					$whereZipCodeProximity .= " AND ";
					$whereZipCodeProximity .= "$latitudeField >= ".$LowLatitude;
					$whereZipCodeProximity .= " AND ";
					$whereZipCodeProximity .= "$longitudeField <= ".$HighLongitude;
					$whereZipCodeProximity .= " AND ";
					$whereZipCodeProximity .= "$longitudeField >= ".$LowLongitude;
					$whereZipCodeProximity .= " AND ";
					$whereZipCodeProximity .= "$zip5Field != '0'";
					$whereZipCodeProximity .= " AND ";
					$whereZipCodeProximity .= "$zip5Field != ''";
					$whereZipCodeProximity .= ")";
					if (ZIPCODE_UNIT == "mile") {
						$order_by_zipcode_score = "SQRT(POW((69.1 * (".$latitude." - $latitudeField)), 2) + POW((53.0 * (".$longitude." - $longitudeField)), 2)) AS zipcode_score";
					} elseif (ZIPCODE_UNIT == "km") {
						$order_by_zipcode_score = "SQRT(POW((69.1 * (".$latitude." - $latitudeField)), 2) + POW((53.0 * (".$longitude." - $longitudeField)), 2)) * 1.609344 AS zipcode_score";
					}
					return true;
				}
			}
		}
		return false;
	}

	function zipproximity_getDistanceLabel($zip, $item, $id, &$distance_label, $have_data = false, $data = "") {
		$distance_label = "";
		if ($zip && $item && $id && ZIPCODE_PROXIMITY == "on") {
			if (zipproximity_getZip5($zip, $zip5)) {
				if (zipproximity_validateZip5($zip5)) {
					if (zipproximity_getZip5Fields($zip5, $zip_latitude, $zip_longitude)) {
						if ($have_data) {
							$item_latitude = $data["latitude"];
							$item_longitude = $data["longitude"];
							if (ZIPCODE_UNIT == "mile") {
								$distance_label = (round(sqrt(pow((69.1 * ($zip_latitude - $item_latitude)), 2) + pow((53.0 * ($zip_longitude - $item_longitude)), 2)), 2))." ".ZIPCODE_UNIT_LABEL_PLURAL;
							} elseif (ZIPCODE_UNIT == "km") {
								$distance_label = (round(sqrt(pow((69.1 * ($zip_latitude - $item_latitude)), 2) + pow((53.0 * ($zip_longitude - $item_longitude)), 2)) * 1.609344, 2))." ".ZIPCODE_UNIT_LABEL_PLURAL;
							}
						} else {
							$dbObjMain = db_getDBObject(DEFAULT_DB, true);
							$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObjMain);
							$sql = "SELECT latitude, longitude FROM ".string_ucwords($item)." WHERE id = '".$id."'";
							$result = $dbObj->query($sql);
							if ($row = mysql_fetch_array($result)) {
								$item_latitude = $row["latitude"];
								$item_longitude = $row["longitude"];
								if (ZIPCODE_UNIT == "mile") {
									$distance_label = (round(sqrt(pow((69.1 * ($zip_latitude - $item_latitude)), 2) + pow((53.0 * ($zip_longitude - $item_longitude)), 2)), 2))." ".ZIPCODE_UNIT_LABEL_PLURAL;
								} elseif (ZIPCODE_UNIT == "km") {
									$distance_label = (round(sqrt(pow((69.1 * ($zip_latitude - $item_latitude)), 2) + pow((53.0 * ($zip_longitude - $item_longitude)), 2)) * 1.609344, 2))." ".ZIPCODE_UNIT_LABEL_PLURAL;
								}
							}
						}
						if ($distance_label) {
							return true;
						}
					}
				}
			}
		}
		return false;
	}

?>
