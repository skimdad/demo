<?php
    class GoogleMap {
        var $divName;
        var $googleMapKey;
        var $cssClass;
        var $address = array();
        var $numbered = true;
	var $isMobileApp_MOBI = FALSE;

        /**
        * constructor
        */
        function GoogleMap() { }

        /**
        * atributes gets and sets
        */
        function getDivName() { return $this->divName; }
        function setDivName($divNameIn) { $this->divName = $divNameIn; }

        function getGoogleMapKey() { return $this->googleMapKey; }
        function setGoogleMapKey($googleMapKeyIn) { $this->googleMapKey = $googleMapKeyIn; }

        function getCssClass() { return $this->cssClass; }
        function setCssClass($cssClassIn) { $this->cssClass = $cssClassIn; }

        function getNumbered() { return $this->numbered; }
        function setNumbered($numberedIn) { $this->numbered = $numberedIn; }
 
        /**
        * getMapCodev3
        * this code uses Google Maps v3
        */
        function getMapCodev3() {
            
            /**
            * Get pointer to theme
            */
            $pointer_path = THEMEFILE_URL."/".EDIR_THEME."/schemes/".(EDIR_SCHEME != "custom" ? EDIR_SCHEME : "default");
            $pointer_path_custom = DEFAULT_URL."/custom/domain_".SELECTED_DOMAIN_ID."/theme_images";
            setting_get("scheme_custom", $scheme_custom);
            setting_get("scheme_change_images", $change_images);
            
            $hasAddress = false;
            foreach($this->address as $each_address){
               if ((string_strlen(trim($each_address['location_1'])) > 0) || (string_strlen(trim($each_address['location_3'])) > 0) || (string_strlen(trim($each_address['location_4'])) > 0) || (string_strlen(trim($each_address['zipcode'])) > 0)) {
                   $hasAddress = true;
                   break;
               }
            }

            $array_points = Array();
            $srt_points = "";
            
            $pointCount = 0;
            foreach($this->address as $each_address) {
                $each_address['address1']  = preg_replace("/\"/", "", $each_address['address1']);
                $each_address['address1']  = preg_replace("/\'/", "", $each_address['address1']);
                $each_address['zipcode']  = preg_replace("/\"/", "", $each_address['zipcode']);
                $each_address['zipcode']  = preg_replace("/\'/", "", $each_address['zipcode']);

                if(string_strlen(trim($each_address['optionalLatLng'])) == 0) {
                        $aux_locations = "";
                        $aux_locations[] = ($each_address['address1']?$each_address['address1']:"");
                        $aux_locations[] = ($each_address['location_4']?$each_address['location_4']:"");
                        $aux_locations[] = ($each_address['location_3']?$each_address['location_3']:"");
                        $aux_locations[] = ($each_address['location_1']?$each_address['location_1']:"");
                        $aux_locations[] = ($each_address['zipcode']?$each_address['zipcode']:"");
                        $aux_locations = implode(", ", $aux_locations);

                        $array_points[] = "['address', '$aux_locations', '".addslashes($each_address['optionalHtml'])."', ".($pointCount+1)."]";
                } else {
                    $array_points[] = "['latlong', '".$each_address['optionalLatLng']."', '".addslashes($each_address['optionalHtml'])."', ".($pointCount+1)."]";
                }
                $pointCount++;
            }
            $srt_points = implode(",",$array_points);
            
            $auxKey = "";
            if ($this->googleMapKey){
                $auxKey = "&amp;key=".$this->googleMapKey;
            }
			$zoomLevel = 15;
			$googleMapInitCode = 		                 
                                  "$(document).ready(function(){			  
                                        initialize();
                                    });
                                    //]]> \n";
									
									
			if($this->isMobileApp_MOBI){
			    $zoomLevel = 15;
				$googleMapInitCode = 		                 
                                  "$(document).ready(function(){
					//$(document).bind('pageinit',function() {         
                                        initialize();
					//google.maps.event.trigger(map, 'resize');
					//map.setZoom($zoomLevel);
                                    });
				      //$(document).bind( \"pageshow\", function( event, data ){
										
									//});
                                    //]]> \n";
			}			
			

            $returnCode  = "    <script src=\"http://maps.google.com/maps/api/js?sensor=false$auxKey\" type=\"text/javascript\"></script>\n";
            $returnCode .= "    <script type='text/javascript'>\n";
            $returnCode .= "	//<![CDATA[ \n
                                    var geocoder;
                                    var map;
                                    var last_post = 0;
                                    var infoWindow;
                                    var gmarkers = [];
                                    var points = [
                                            $srt_points
                                    ];
   
                                    var arrayPoints = new Array(points.length);
            
                                    for (var i = 0; i < points.length; i++) {
                                       arrayPoints[i] = new Array(3); 
                                    }
            
                                    function myclick(i){
                                        if (gmarkers[i]){
                                            google.maps.event.trigger(gmarkers[i], 'click');
                                        }
                                    }

                                    function initialize() {
                                        geocoder = new google.maps.Geocoder();
                                        
                                        var myOptions = {
                                            scrollwheel: false,
                                            scaleControl: true,   
                                            zoom: ".$zoomLevel.",
                                            center: new google.maps.LatLng(0, 0),
                                            mapTypeId: google.maps.MapTypeId.ROADMAP
                                        }
                                        map = new google.maps.Map(document.getElementById('".$this->divName."'), myOptions);
                                        infoWindow = new google.maps.InfoWindow();
                                        codeAddress(points);
                                    }
                                    
                                    function codeAddress(locations) {
                                        
                                        for (var i = 0; i < locations.length; i++) {
                                            var location = locations[i];
                                            var address = '';
                                            if (location[0] == 'address') {
                                                address = location[1];
                                                geocoder.geocode( { 'address': address}, function(results, status) { 
                                                    if (status == google.maps.GeocoderStatus.OK) {
                                                       fillArrayPositions(results[0].geometry.location, 0, locations[last_post][2], locations[last_post][3]);
                                                    } else {
                                                    }
                                                });
                                            } else {
                                                var lat_long = location[1].split(',');
                                                var myLatLng = new google.maps.LatLng(lat_long[0], lat_long[1]);
                                                fillArrayPositions(myLatLng, i, location[2], location[3]);
                                            }
                                        }
                                        
                                        google.maps.event.addListenerOnce(map, 'idle', function(){
                                           setMarkerPosition(arrayPoints);
					   map.setZoom($zoomLevel);
                                        });
                                    }
                                    
                                    function fillArrayPositions(myLatLng, pos, html, number){
                                        if (!pos || pos == 'undefined'){
                                             pos = last_post;
                                             last_post = last_post + 1;
                                        }
                                        arrayPoints[pos][0] = myLatLng;
                                        arrayPoints[pos][1] = html;
                                        arrayPoints[pos][2] = number;
                                    }
                                    
                                    function setMarkerPosition(points){
                                        
                                        var bounds = new google.maps.LatLngBounds();
                                        
                                        function createMarker(map, position, html, number, bounds){
                    
                                            var imageMarkerPath = '';
                                            var imageShadowPath = '';";
                                        
            $returnCode .= "                if(number > 0 && number <= 40 && " . ((!$this->numbered) ? "false" : "true") . ") {";
			if ($scheme_custom == "on" && $change_images == "on" || (EDIR_SCHEME == "custom")){
				$returnCode .= "                imageMarkerPath = '".$pointer_path_custom."/".EDIR_SCHEME."_marker_'+number+'.png';";
			} else {
				$returnCode .= "                imageMarkerPath = '".$pointer_path."/images/markers/marker_'+number+'.png';";
			}
            $returnCode .= "                } else {";
			if ($scheme_custom == "on" && $change_images == "on" || (EDIR_SCHEME == "custom")){
				$returnCode .= "                imageMarkerPath = '".$pointer_path_custom."/".EDIR_SCHEME."_marker.png';";
			} else {
				$returnCode .= "                imageMarkerPath = '".$pointer_path."/images/markers/marker.png';";
			}
            $returnCode .= "                }";
			if ($scheme_custom == "on" && $change_images == "on" || (EDIR_SCHEME == "custom")){
				$returnCode .= "            imageShadowPath = '".$pointer_path."/images/markers/shadow_custom.png';";
			} else {
				$returnCode .= "            imageShadowPath = '".$pointer_path."/images/markers/shadow.png';";
			}
                                            
            $returnCode .= "                var image = new google.maps.MarkerImage(imageMarkerPath,
                                                new google.maps.Size(23.0, 23.0),
                                                new google.maps.Point(0, 0),
                                                new google.maps.Point(17.0, 5.0)
                                            );
                                            var shadow = new google.maps.MarkerImage(imageShadowPath,
                                                new google.maps.Size(23.0, 27.0),
                                                new google.maps.Point(0, 0),
                                                new google.maps.Point(20.0, 5.0)
                                            );
                                            
                                            var marker = new google.maps.Marker({
                                                position: position,
                                                map: map,
                                                shadow: shadow,
                                                icon: image
                                            });
                                            
                                            bounds.extend(position);
                                            map.fitBounds(bounds);

                                            google.maps.event.addListener(marker, 'click', function() {
                                                infoWindow.setContent(html);
                                                infoWindow.open(map, marker);
                                            }); 
                                            
                                            gmarkers[number] = marker;
                                            
                                             // Make the info window close when clicking anywhere on the map.
                                             google.maps.event.addListener(map, 'click', function() { infoWindow.close(); });
                                            
                                         }
                                            
                                        for (var i = 0; i < points.length; i++) {
                                            var point = points[i];
                                            if (point[0]){

                                                createMarker(map, point[0], point[1], point[2], bounds);

                                            }
                                        }";
    
            if(($each_address['optionalZoomIn']) != 0) {
                $returnCode .= "        map.setZoom(".$each_address['optionalZoomIn'].");";
            } elseif (string_strpos($_SERVER["PHP_SELF"], "/detail.php") !== false) {
                $returnCode .= "        map.setZoom($zoomLevel);";
            }

            $returnCode .= "            }";
                     
						
            $returnCode .= $googleMapInitCode."    </script>\n";

            return $returnCode;
        }

        /**
        * function addAddress
        */
       function addAddress($address1In, $address2In, $location1In, $location3In, $location4In, $zipcodeIn, $optionalLatLngIn = "",$optionalZoomIn = "", $optionalHtmlIn = "",$level = "",$type = "") {
            $this->address[] = array("address1"         => $address1In,
                                     "address2"         => $address2In,
                                     "location_1"       => $location1In,
                                     "location_3"       => $location3In,
                                     "location_4"       => $location4In,
                                     "zipcode"          => $zipcodeIn,
                                     "optionalLatLng"   => $optionalLatLngIn,
                                     "optionalZoomIn"   => $optionalZoomIn,
                                     "optionalHtml"     => $optionalHtmlIn,
                                     "level"			=> $level,
									 "type"				=> $type);
		}

        /**
        * function clearAddress
        */
        function clearAddress() {
            $this->address = array();
            $this->showHTML = array();
        }
    }
?>
