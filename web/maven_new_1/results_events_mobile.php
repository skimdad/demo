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
            <? $numberOfEvents = FEATURED_EVENT_MAXITEMS;
$level = implode(",", system_getLevelDetail("EventLevel"));

    if ($level) {
		unset($searchReturn);
		$searchReturn = search_frontEventSearch($_GET, "random");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." (Event.level IN (".$level.")) ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ORDER BY `random_number` LIMIT ".$numberOfEvents."";
		$highlight_events = db_getFromDBBySQL("event", $sql);
	}
         if ($highlight_events) {
                foreach ($highlight_events as $event) {
                                 
                    $imageObj = new Image($event->getNumber("thumb_id"));
                        
                                     

                    if ($imageObj->imageExists()) {
                     //  echo '1'.$imageObj->getTag(true, IMAGE_FEATURED_LISTING_WIDTH, IMAGE_FEATURED_LISTING_HEIGHT, $listing->getString("title"), true);
                        
                        ?>
                        <div style='display:block'><div><a href="<?= MOBILE_DEFAULT_URL . "/event_detail.php?id=" .$event->getString("id"); ?> ?>" class="image">
                        <?echo $imageObj->getTag(true, IMAGE_FRONT_EVENT_WIDTH, IMAGE_FRONT_EVENT_HEIGHT, $event->getString("title"), true); ?>
                                </a></div></div>
                        <?   } else {
                        ?>
                        <div style='display:block'><div>
                                <a href="<?= MOBILE_DEFAULT_URL . "/event_detail.php?id=" .$event->getString("id"); ?> " class="image"><span class=no-image"></span>
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
  
  <?  include("./results_filter_mobile.php"); ?>
  <?  include("./results_pagination_mobile.php");?>

</div>


    <?
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
# * FILE: /event/results_events.php
# ----------------------------------------------------------------------------------------------------

if (true) {

    if (!$events) {

        if ($search_lock) {
            ?>
            <p class="errorMessage">
            <?= system_showText(LANG_MSG_LEASTONEPARAMETER) ?>
            </p>
            <?
        } else {
            $db = db_getDBObject();
            if ($db->getRowCount("Event") > 0) {
                ?>
                <div class="resultsMessage">
                    <? //=system_showText(LANG_MSG_NORESULTS); ?>
                    <? //=system_showText(LANG_MSG_TRYAGAIN);?>

                    <?
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
                <?= system_showText(LANG_MSG_NOEVENTS); ?>
                </p>
                <?
            }
        }
    } elseif ($events) {

        $level = new EventLevel(EDIR_DEFAULT_LANGUAGE, true);
        //$locationManager = new LocationManager();
        //$mapNumber = 0;
        $count = 10;
        //$ids_report_lote = "";
?>
            <div data-role="content" style="padding: 0px;" class="list_map">
            <ul data-role="listview" data-inset="true" class="ui-listview ui-listview-inset ui-corner-all ui-shadow" id="deals_table">
                

   
   <?
        foreach ($events as $event) {
            //$ids_report_lote .= $event->getString("id").",";
            //$event->setLocationManager($locationManager);

            /* if ($event->getString("latitude") && $event->getString("longitude")) {
              $mapNumber++;
              } */

            include("./view_event_summary_mobile.php");
            $count--;
        }
        //$ids_report_lote = string_substr($ids_report_lote, 0, -1);
        //report_newRecord("event", $ids_report_lote, EVENT_REPORT_SUMMARY_VIEW, true);
    }
}
?>
<script type="text/javascript">
                   
    function initialize() 
    {
        var locations =[
<? foreach ($events as $event) : ?>
              ['<a href="<?= MOBILE_DEFAULT_URL . "/event_detail.php?id=" .$event->getString("id"); ?>"> <?= $event->getString("title") ?></a>',"<?= $event->getString("latitude") ?>","<?=$event->getString("longitude")?>"],
                     
                    
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
                    infowindow.setContent('<div class="iwContainer">'+ locations[i][0] + '</a>'+ locations[i][0] + '</div>');
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
    
    