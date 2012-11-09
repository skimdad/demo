<?
$isMobileApp_MOBI = TRUE;
?>
<div data-theme="c" data-role="header" data-position="fixed" style="height:40px;padding:0px; margin:0px;"> <img style="width: 120px; height: auto; float:left; margin-left:10px;" src="http://www.dealcloudusa.com/custom/domain_1/content_files/img_logo.png" />
    <div data-role="fieldcontain" style="padding:0px; margin:0px; float:right; position:absolute; top:0; right:0">
        <fieldset data-role="controlgroup" style="padding:0px; margin:0px;">


            <select name="flag" id="flag" data-role="slider" onChange="list_map() ; return false;">
                <option value="off">Map</option>
                <option value="on" selected="selected">List</option>
            </select>

        </fieldset>
    </div>
</div>
<div data-role="content" id="gallery">
    <div id='slider4' class='swipe'>
        <div>
            <?
         
            $numberOfListings = FEATURED_LISTING_MAXITEMS;
           
            $level = implode(",", system_getLevelDetail("ListingLevel"));
            if ($level) {
                unset($searchReturn);
                
                $searchReturn = search_frontListingSearch($_GET, "random");
                $sql = "SELECT " . $searchReturn["select_columns"] . " FROM " . $searchReturn["from_tables"] . " WHERE " . (($searchReturn["where_clause"]) ? ($searchReturn["where_clause"] . " AND") : ("")) . " (Listing_Summary.level IN (" . $level . ")) " . (($searchReturn["group_by"]) ? ("GROUP BY " . $searchReturn["group_by"]) : ("")) . " ORDER BY " . ($searchReturn["order_by"] ? $searchReturn["order_by"] : " `Listing_FeaturedTemp`.`random_number` ") . " LIMIT " . $numberOfListings . "";

                $random_listings = db_getFromDBBySQL("listing", $sql);
          
            }
            if ($random_listings) {
                foreach ($random_listings as $listing) {
                                 
                        $imageObj = new Image($listing->getNumber("thumb_id"));
                        
                                     

                    if ($imageObj->imageExists()) {
                     //  echo '1'.$imageObj->getTag(true, IMAGE_FEATURED_LISTING_WIDTH, IMAGE_FEATURED_LISTING_HEIGHT, $listing->getString("title"), true);
                        
                        ?>
                        <div style='display:block'><div><a href="<?= MOBILE_DEFAULT_URL . "/listingdetail.php?id=" . $listing->getNumber("id") ?>" class="image">
                        <?echo $imageObj->getTag(true, IMAGE_FEATURED_LISTING_WIDTH, IMAGE_FEATURED_LISTING_HEIGHT, $listing->getString("title"), true); ?>
                                </a></div></div>
                        <?   } else {
                        ?>
                        <div style='display:block'><div>
                                <a href="<?= MOBILE_DEFAULT_URL . "/listingdetail.php?id=" . $listing->getNumber("id") ?>" class="image"><span class=no-image"></span>
                                </a></div></div>

                        <?
                    }
                
            
            }
              }
            ?>




          
        </div>
    </div>

    <nav>
        <a id="prev" onclick='window.slider4.prev();return false;' href="#">
            <em>prev</em>
        </a> 
        <a id="next" href='#' onclick='window.slider4.next();return false;'>
            <em>next</em>
        </a>

    </nav>
</div>
<!--header-->
<div  class="list_map">
<? include('./searchresultsheader.php');
?>
    <div class="content-top">

    <? include("./results_info1.php"); ?>
    </div>

        <? include("./results_filter_mobile.php"); ?>
        <? include("./results_pagination_mobile.php"); ?>
 
</div>


<?
# -----------------------------------------------------------------------------------
# --

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
# * FILE: /listing/results_listings.php
# ----------------------------------------------------------------------------------------------------
$rvw_str = "";


if (!$listings && !$bronze_listings) {

    if ($search_lock) {
        ?>
        <p class="errorMessage">
        <?= system_showText(LANG_MSG_LEASTONEPARAMETER) ?>
        </p>
        <?
    } else {
        $db = db_getDBObject();
        if ($db->getRowCount("Listing_Summary") > 0) {
            ?>
            <div class="resultsMessage">
            <? //=system_showText(LANG_MSG_NORESULTS);?>
            <? //=system_showText(LANG_MSG_TRYAGAIN); ?>

                <?
                unset($aux_lang_msg_noresults);
                $aux_lang_msg_noresults = "<li data-corners='false' data-shadow='false' data-iconshadow=='true' data-wrapperels='div' data-icon='false' data-iconpos='right' data-theme='c' class='ui-btn ui-btn-icon-right ui-li ui-li-has-alt ui-li-has-thumb ui-corner-top ui-btn-up-c'><h3 class='ui-li-heading'>Sorry!</h3 ><p class='phone'>Your search return no results. Although this is unusual, it happens from time to time when the search term you have used is a little generic or when we really do not have any matched content.</p><h3 class='ui-li-heading'>Suggestions:</h3>Be more specific with your search terms.<br />Check your spelling.</li>";
                echo $aux_lang_msg_noresults;
                ?>

            </div>
                <?
                /*
                  if ($keyword) {
                  ?>
                  <p class="informationMessage">
                  <?=system_showText(LANG_MSG_USE_SPECIFIC_KEYWORD);?>
                  </p>
                  <?
                  }
                 * 
                 */
            } else {
                ?>
            <p class="informationMessage">
            <?= system_showText(LANG_MSG_NOLISTINGS); ?>
            </p>
            <?
        }
    }
} elseif ($listings) {

    $levelObj = new ListingLevel(EDIR_DEFAULT_LANGUAGE, true);
    $locationManager = new LocationManager();
    $mapNumber = 0;
    $count = 10;
    $ids_report_lote = "";

    /**
     * This variable is used on view_listing_summary.php

      if (TWILIO_APP_ENABLED == "on"){
      if (TWILIO_APP_ENABLED_SMS == "on"){
      $levelsWithSendPhone = system_retrieveLevelsWithInfoEnabled("has_sms");
      }else{
      $levelsWithSendPhone = false;
      }
      if (TWILIO_APP_ENABLED_CALL == "on"){
      $levelsWithClicktoCall = system_retrieveLevelsWithInfoEnabled("has_call");
      }else{
      $levelsWithClicktoCall = false;
      }
      }else{
      $levelsWithSendPhone = false;
      $levelsWithClicktoCall = false;
      }
     */
    /* $loc = array();
      foreach ($listings as $listing) :
      if (is_object($listing)) {
      $is_object = true;
      $listingAux = $listing;
      $listing = $listing->data_in_array;
      }

      if ($listing["latitude"] && $listing["longitude"]) :

      $loc = array($listing["title"], $listings["latitude"], $listings["longitude"]);
      endif;
      endforeach;
      echo $loc; */
    ?>
    <div data-role="content" style="padding: 0px;" class="list_map">
        <ul data-role="listview" data-inset="true" class="ui-listview ui-listview-inset ui-corner-all ui-shadow" id="deals_table">



    <?
    foreach ($listings as $listing) {

        // $ids_report_lote .= $listing["id"] . ",";
        include("./view_listing_summary.mobile.php");

        if ($count % 2 && ($count != 10) && ITEM_RESULTS_CLEAR) {
            echo "<br class=\"clear\" />";
        }
        $count--;
    }
    ?>
        </ul> </div>
            <?
            //$ids_report_lote = string_substr($ids_report_lote, 0, -1);$rvw_str = $ids_report_lote;
            //report_newRecord("listing", $ids_report_lote, LISTING_REPORT_SUMMARY_VIEW, true);
        }
        ?>
<script type="text/javascript">
                   
    function initialize() 
    {
        var locations =[
<? foreach ($listings as $listing) : ?>
                ['<a href="<?= MOBILE_DEFAULT_URL . "/listingdetail.php?id=" . htmlspecialchars($listing["id"]); ?>"> <?= $listing["title"] ?></a>',"<?= $listing["latitude"] ?>","<?= $listing["longitude"] ?>"],
                             
                            
    <?
endforeach;
?>
            
        ];
                             
        // alert(locations);        
                           
                

        var map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom: 12,
            center: new google.maps.LatLng(window.lat,window.lang1),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) 
        {  
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent('<div class="iwContainer">' + locations[i][0]  + '</div>');
                    infowindow.open(map, marker);                    
                }
            })(marker, i));
        }
    }

    $(function() { 
        $(document).bind ('pageshow', function (e, data) {
            initialize();
        });
    });
</script>
</div>
<div style="display:none" class="list_map" >
    <div id="map_canvas" style="height:350px;width: 100%" ></div>
</div>
<script>
    var slider4;
    //$(document).ready(function(){
    $(document).bind ('pageshow', function (e, data) {
        window.slider4 = new Swipe(document.getElementById('slider4'));
	 
    })

    function list_map()
    {$(".list_map").toggle();
        //google.maps.event.trigger(map_canvas, 'resize');
        initialize();
    
    
    }


</script>








