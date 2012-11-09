<?
$isMobileApp_MOBI = TRUE;
include './save_params_to_session.php';
?>



<div class="content">
    <div class="content-main">
        <? if ($promotions): ?>
            <div data-theme="c" data-role="header" data-position="fixed" style="height:40px;padding:0px; margin:0px;"> 
                <img style="width: 120px; height: auto; float:left; margin-left:10px;" src="http://www.dealcloudusa.com/custom/domain_1/content_files/img_logo.png" />
                <div data-role="fieldcontain" style="padding:0px; margin:0px; float:right; position:absolute; top:0; right:0">
                    <fieldset data-role="controlgroup" style="padding:0px; margin:0px;">
                        <select name="flag" id="flag" data-role="slider" onChange="list_map() ; return false;">
                            <option value="off">Map</option>
                            <option value="on" selected="selected">List</option>
                        </select>
                    </fieldset>
                </div>
            </div>
        <? endif; ?>
        <?
        //get featured items
        $numberOfPromotions = 15;
        unset($searchReturn);
        $searchReturn = search_frontPromotionSearch($_GET, "random", true);
        $sql = "SELECT " . $searchReturn["select_columns"] . " FROM " . $searchReturn["from_tables"] . " " . (($searchReturn["where_clause"]) ? ("WHERE " . $searchReturn["where_clause"]) : ("")) . " " . (($searchReturn["group_by"]) ? ("GROUP BY " . $searchReturn["group_by"]) : ("")) . " " . (($searchReturn["order_by"]) ? ("ORDER BY " . $searchReturn["order_by"]) : ("")) . " LIMIT " . ($numberOfPromotions) . "";
        $promotions_feature = db_getFromDBBySQL("promotion", $sql);
        ?>
        <? if ($promotions_feature): ?>
            <div data-role="content" id="gallery">
                <div id='slider4' class='swipe'>
                    <div>
                        <?
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
            <script>
                var slider4;
                //$(document).ready(function(){
                $(document).bind ('pageshow', function (e, data) {
                    window.slider4 = new Swipe(document.getElementById('slider4'));
                                    	 
                })
                                           
            </script>
        <? endif; ?>
        <!--header-->

        <div data-role="content" style="padding: 15px;" class="list_map">
            <? include('./searchresultsheader.php'); ?>
            <? include("./results_info1.php"); ?>
        </div>
        <? if (!$promotions) : ?>

            <div data-role="content" style="padding: 15px;"
            <? if ($search_lock) { ?>
                     <p class="errorMessage">
                             <?= system_showText(LANG_MSG_LEASTONEPARAMETER) ?>
                    </p>
                    <?
                } else {
                    $db = db_getDBObject();
                    if ($db->getRowCount("Promotion") > 0) {
                        ?>
                        <div class="informationMessage txt-block">
                            <?
                            unset($aux_lang_msg_noresults);
                            ?>
                            <h3 class="ui-li-heading">Sorry!</h3>
                            Your search return no results. Although this is unusual, it happens from time to time when the search term you have used is a little generic or when we really do not have any matched content.
                            <h3 class="ui-li-heading">Suggestions:</h3>Be more specific with your search terms.<br />Check your spelling.
                        </div>
                        <?
                    } else {
                        ?>
                        <p class="informationMessage">
                            <?= system_showText(LANG_MSG_NOPROMOTIONS); ?>
                        </p>
                        <?
                    }
                }
                ?>
            </div>
        <? elseif ($promotions): ?>

            <div data-role="content" style="padding: 15px;" class="list_map">

                <? include("./results_filter_mobile.php"); ?>
                <? include("./results_pagination_mobile.php"); ?>
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

            <script type="text/javascript">
                function list_map()
                {$(".list_map").toggle();
                    initialize();  
                }
                                             
                function initialize() 
                {
                    var locations =[
                                                
    <? foreach ($promotions as $promotion) : ?>
                    ['<a href="<?= MOBILE_DEFAULT_URL . "/promotion_detail.php?id=" . $promotion->getNumber("id"); ?>"> <?= $promotion->getString("name") ?></a>',"<?= $listings[0]->getString("latitude") ?>","<?= $listings[0]->getString("longitude") ?>"],
    <? endforeach; ?>
                                            
            ];
                                                             
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

            <div style="display:none" class="list_map" >
                <div id="map_canvas" style="height:350px;width: 100%" ></div>
            </div>

            <?
        endif;
        ?>



    </div>
</div>


