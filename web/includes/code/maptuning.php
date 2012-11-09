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
	# * FILE: /includes/code/maptuning.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $latitude_longitude = str_replace("(", "", $_POST["latitude_longitude"]);
        $latitude_longitude = str_replace(")", "", $latitude_longitude);
        $latitude_longitude = str_replace(" ", "", $latitude_longitude);
		$itemObj->setMapTuning($latitude_longitude, $_POST["map_zoom"]);
        system_updateMaptuningDate($itemTable, $itemObj->getNumber("id"), $_POST["maptuning_done"]);
        $message_maptunning = 0;
		header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?message_maptunning=".$message_maptunning."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : ""));
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# GOOGLE MAPS
	# ----------------------------------------------------------------------------------------------------

	$googlemaps_message = "";
	$googlemaps_code = "";

    $latitude = $itemObj->getString("latitude");
    $longitude = $itemObj->getString("longitude");
    if ($latitude && $longitude){
        $latitude_longitude = $latitude.",".$longitude;
    }
    $map_zoom = ($itemObj->getString("map_zoom") ? $itemObj->getString("map_zoom") : 15);
    $google_city = $itemObj->getLocationString("4", true);
    $google_location = "";
    if ($itemObj->getString("address") && $itemObj->getString("zip_code")) {
        $google_location = $itemObj->getLocationString("A, 4, z", true);
    } else {
        $google_location = $itemObj->getLocationString("A, 4, 3", true);
    }
    
    $keyStr = "";
    $googleSettingObj = new GoogleSettings(GOOGLE_MAPS_SETTING, $_SERVER["HTTP_HOST"]);
        
    /* key for demodirectory.com */
    if (DEMO_LIVE_MODE) {
        $googleMapsKey = GOOGLE_MAPS_APP_DEMO;
    } else {
        $googleMapsKey = ($googleSettingObj->getString("value"));
    }
    
    if ($googleMapsKey){
       $keyStr = "&key=$googleMapsKey";
    }

    $googleMapCode = "";
    
    $googlemaps_code .= "
        <script src=\"http://maps.google.com/maps/api/js?sensor=false$keyStr\" type=\"text/javascript\"></script>\n
        <script type=\"text/javascript\">\n
            var geocoder;
            var map;
            function initialize() {
                geocoder = new google.maps.Geocoder();
                var myOptions = {
                  scrollwheel: false,
                  zoom: ".($map_zoom ? $map_zoom : 15).",
                  mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                map = new google.maps.Map(document.getElementById(\"map\"), myOptions);
                codeAddress();
            }

            function codeAddress() {
                var address = '".$google_location."';
                var address_city = '".$google_city."';
                var marker = new google.maps.Marker({
                    map: map, 
                    draggable: true
                });\n";

                if ($latitude_longitude){
                   $googlemaps_code .=  "               var latlng = new google.maps.LatLng($latitude_longitude);
                                                        marker.setPosition(latlng);
                                                        map.setCenter(latlng);";
                } else {

    $googlemaps_code .= "           if (geocoder) {
                    geocoder.geocode( { 'address': address}, function(results, status) {
                        if (status != google.maps.GeocoderStatus.OK) {
                            geocoder.geocode( { 'address': address_city}, function(results, status) {
                                if (status != google.maps.GeocoderStatus.OK) {
                                    alert(\"Location not found!\");
                                }
                              });
                        }
                        if (status == google.maps.GeocoderStatus.OK) {
                            map.setCenter(results[0].geometry.location);
                            marker.setPosition(results[0].geometry.location);
                        }
                    });
                }\n";
            }
    $googlemaps_code .= "                           google.maps.event.addListener(marker, 'dragend', function(event) {
                                                        document.getElementById('myLatitudeLongitude').value = event.latLng; \n
                                                        document.getElementById('maptuning_done').value = 'y'; \n
                                                    });
                          }";  

    $googlemaps_code .= "         $(document).ready(function(){
                initialize();
            });
        </script>\n";

?>
