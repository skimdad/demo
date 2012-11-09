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
            $numberOfPromotions = 15;
            $lastItemStyle = 0;
            $specialItem = 5;
            unset($searchReturn);
            $searchReturn = search_frontPromotionSearch($_GET, "random", true);
            $sql = "SELECT " . $searchReturn["select_columns"] . " FROM " . $searchReturn["from_tables"] . " " . (($searchReturn["where_clause"]) ? ("WHERE " . $searchReturn["where_clause"]) : ("")) . " " . (($searchReturn["group_by"]) ? ("GROUP BY " . $searchReturn["group_by"]) : ("")) . " " . (($searchReturn["order_by"]) ? ("ORDER BY " . $searchReturn["order_by"]) : ("")) . " LIMIT " . ($numberOfPromotions) . "";
            $promotions_feature = db_getFromDBBySQL("promotion", $sql);
            if ($promotions_feature) {
                foreach ($promotions_feature as $promotion) {
                    $imageObj = new Image($promotion->getNumber("thumb_id"));
                    if ($imageObj->imageExists()) {
                        ?>
                        <div style='display:block'><div><a href="<?= MOBILE_DEFAULT_URL . "/promotion_detail.php?id=" . $promotion->getNumber("id") ?>" class="image"> 
                                    <? echo $imageObj->getTag(true, IMAGE_FRONT_PROMOTION_WIDTH, IMAGE_FRONT_PROMOTION_HEIGHT, $promotion->getString("name"), true); ?>
                                </a></div></div> <? } else {
                                    ?>
                        <div style='display:block'><div><a href="<?= MOBILE_DEFAULT_URL . "/promotion_detail.php?id=" . $promotion->getNumber("id") ?>" class="image"><span class="no-image"></span>";
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
# * FILE: /deal/results_events.php
# ----------------------------------------------------------------------------------------------------

if (true) {

    if (!$promotions) {

        if ($search_lock) {
            ?>
            <p class="errorMessage">
                <?= system_showText(LANG_MSG_LEASTONEPARAMETER) ?>
            </p>
            <?
        } else {
            $db = db_getDBObject();
            if ($db->getRowCount("Promotion") > 0) {
                ?>
                <div class="resultsMessage">
                    <? //=system_showText(LANG_MSG_NORESULTS);?>
                    <? //=system_showText(LANG_MSG_TRYAGAIN); ?>

                    <?
                    unset($aux_lang_msg_noresults);
                    // $aux_lang_msg_noresults = str_replace("[EDIR_LINK_SEARCH_ERROR]", DEFAULT_URL . "/contactus.php", LANG_SEARCH_NORESULTS);
                    // echo $aux_lang_msg_noresults;
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
                    <?= system_showText(LANG_MSG_NOPROMOTIONS); ?>
                </p>
                <?
            }
        }
    } elseif ($promotions) {
        ?>
        <div data-role="content" style="padding: 0px;" class="list_map">
            <ul data-role="listview" data-inset="true" class="ui-listview ui-listview-inset ui-corner-all ui-shadow" id="deals_table">
                <?
                $mapNumber = 0;
                $count = 10;

                foreach ($promotions as $promotion) {

                    $listingObj = new Listing();
                    $listings = $listingObj->retrieveListingsbyPromotion_id($promotion->getNumber("id"));

                    if ($listings) {
                        if ($listings[0]->getString("latitude") && $listings[0]->getString("longitude")) {
                            $mapNumber++;
                        }
                    }

                    include("./view_promotion_summary_mobile.php");
                    $count--;
                }
                ?>
            </ul>
        </div>
        <?
    }
}
?>

<script type="text/javascript">
                   
    function initialize() 
    {
        var locations =[
                
<?
foreach ($promotions as $promotion) :

    // $listingObj = new Listing();
    // $listings = $listingObj->retrieveListingsbyPromotion_id($promotion->getNumber("id"));
    //  if ($listings) :
    ?>

                    ['<a href="<?= MOBILE_DEFAULT_URL . "/promotion_detail.php?id=" . $promotion->getNumber("id"); ?>"> <?= $promotion->getString("name") ?></a>',"<?= $listings[0]->getString("latitude") ?>","<?= $listings[0]->getString("longitude") ?>"],
                                                                         
                                                                        
    <?
    //  endif;
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
                    infowindow.setContent('<div class="iwContainer">'+ locations[i][0] + '</div>');
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