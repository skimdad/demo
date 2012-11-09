<?
$isMobileApp_MOBI = TRUE;
/* ==================================================================*\
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
  \*================================================================== */

# ----------------------------------------------------------------------------------------------------
# * FILE: /mobile/layout/header.php
# ----------------------------------------------------------------------------------------------------

header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", FALSE);
header("Pragma: no-cache");
header("Content-Type: text/html; charset=" . EDIR_CHARSET, TRUE);

include(INCLUDES_DIR . "/code/headertag.php");
$headertag_title = $headertag_title . " Mobile";

$querystringLang = ($_GET["lang"]) ? ("?lang=" . $_GET["lang"]) : ("");
include(MOBILE_EDIRECTORY_ROOT . "/includes/comman.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- original designs -->
        <!--<link href="<?= MOBILE_DEFAULT_URL ?>/layout/general_mobile.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?= MOBILE_DEFAULT_URL ?>/layout/general_mobile.css" rel="stylesheet" type="text/css" media="handheld" />-->
        <!-- end original designs -->

        <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
        <link rel="stylesheet" href="<?= MOBILE_DEFAULT_URL; ?>/assets/my.css" />
        <style>
            /* App custom styles */
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js">
        </script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.js">
        </script>
        <script src="<?= MOBILE_DEFAULT_URL; ?>/assets/my.js">
        </script>
        
        
        <script src="<?= MOBILE_DEFAULT_URL; ?>/assets/1.js">
        
        </script>
        
        
        
         <script src="<?=  MOBILE_DEFAULT_URL; ?>/assets/swipe.js"></script>
        <!-- iphone bookmark -->
        <link rel="apple-touch-icon" href="http://dealcloudusa.com/custom/domain_1/content_files/favicon_9.ico">
        <link rel="apple-touch-icon" sizes="72x72" href="http://dealcloudusa.com/custom/domain_1/content_files/favicon_9.ico">
        <link rel="apple-touch-icon" sizes="114x114" href="http://dealcloudusa.com/custom/domain_1/content_files/favicon_9.ico">

        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <script type="text/javascript">

            var addToHomeConfig = {
                touchIcon: true
            };

        </script>

        <link rel="stylesheet" href="<?= MOBILE_DEFAULT_URL ?>/assets/add2home.css">
        <script type="applicati on/javascript" src="<?= MOBILE_DEFAULT_URL ?>/assets/add2home.js" charset="utf-8"></script>  
        <!-- end of iphone bookmark -->

        <? $headertag_title = (($headertag_title) ? ($headertag_title) : (EDIRECTORY_TITLE)); ?>
        <title><?= $headertag_title ?></title>

        <?= system_getFavicon(); ?>
        <script>
            //globals
            AUTOCOMPLETE_MINCHARS = '<?= AUTOCOMPLETE_MINCHARS ?>';  
            AUTOCOMPLETE_LOCATION_URL="<?= AUTOCOMPLETE_LOCATION_URL ?>"
            AUTOCOMPLETE_MAXITENS="<?= AUTOCOMPLETE_MAXITENS ?>"
          
        </script>
 <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyB4ytvX-W_YoqtsbJnuFfk4TGXTZWN2uD0&sensor=false"></script>
        <? if (true): ?>
           
            <script>
                var  postal_code,locality,state,country;
                var NEW_MOBILE_APP_URL = '<?= NEW_MOBILE_APP_URL ?>';
                var  lat;
                var long1;
            </script>

            <script>
                navigator.geolocation.getCurrentPosition(foundLocation, noLocation);
                function foundLocation(position)
                {
                   //window.lat  = position.coords.latitude;
                   //window.lang1  = position.coords.longitude;
                     window.lat  = '43.15990';
                     window.lang1  = '-77.5592';
                   
                    var geocoder = new google.maps.Geocoder();
                    //var input =  lat+","+long1;
                    var input =  '43.15990,-77.5592';
                    var latlngStr = input.split(",", 2);
                    var lat = parseFloat(latlngStr[0]);
                    var lng = parseFloat(latlngStr[1]);
                    var latlng = new google.maps.LatLng(lat, lng);
                    geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results[0]) {
                                for(i = 0; i < results[0].address_components.length; ++i)
                                {
                                    if(results[0].address_components[i].types[0] == "postal_code")
                                    {
                                        postal_code = results[0].address_components[i];
        				//alert(postal_code.long_name)		
        						
                                    }
        					 
        					 
                                    if(results[0].address_components[i].types[0] == "locality")
                                    {
                                        locality = results[0].address_components[i];
                                        //alert(locality.long_name)
                                    } 
        					
                                    if(results[0].address_components[i].types[0] == "administrative_area_level_1")
                                    {
                                        state = results[0].address_components[i];
                                        //alert(state.long_name)
                                    } 
        					
                                    if(results[0].address_components[i].types[0] == "country")
                                    {
                                        country = results[0].address_components[i];
                                        //alert(country.long_name)
                                    } 
        					
        					
        					
                                }
                                if(locality !== undefined && state !== undefined && country !== undefined )
                                    $('#where').val(locality.long_name +', '+ state.long_name + ', ' + country.long_name);
                                
                                if(postal_code !== undefined)
                                    $('#zip').val(postal_code.long_name);
                                
                                //$('#where').val(locality.long_name +', '+ state.long_name + ', ' + country.long_name);
                            }
                        } else {
                            alert("Geocoder failed due to: " + status);
                        }
                    });
                }
                function noLocation()
                {
                    alert('Could not find location');
                }
          
                
            </script>
        <? endif; ?>
    </head>

    <body>

        <div data-role="page" class="main" >
            <? 
            //if (FALSE || loadPlain() === false) : 
            if (FALSE) : 
                ?>
                <div data-role="content" style="padding: 15px">
                    <div style=" text-align:center">
                        <!-- <img style="width: 100%; height: auto" src="http://www.dealcloudusa.com/custom/domain_1/content_files/img_logo.png" /> -->
                        <a href="<?= MOBILE_DEFAULT_URL ?>/index.php<?= $querystringLang ?>" accesskey="H">
                            <?
                            $image_logo_path = system_getHeaderMobileLogo();
                            list($width, $height) = getimagesize(EDIRECTORY_ROOT . $image_logo_path);
                            image_getNewDimension(200, 85, $width, $height, $image_logo_width, $image_logo_height);
                            ?>
                            <img style="width: 100%; height: auto" src="<?= DEFAULT_URL . $image_logo_path ?>" alt="<?= $headertag_title ?>" title="<?= $headertag_title ?>" />
                        </a>
                    </div>
                    <?
                    //if (string_strpos($_SERVER["PHP_SELF"], "/index.php") !== false) {
                    //    include("./search.php");
                    //}
                    ?>

                </div>
            <? endif; ?>
            <div data-role="content" style="padding: 0px">
