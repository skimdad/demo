<?
$isMobileApp_MOBI = TRUE;
include("../conf/mobile.inc.php");
include("../conf/loadconfig.inc.php");
include(MOBILE_EDIRECTORY_ROOT . "/layout/header.php");
$langIndex = language_getIndex(EDIR_LANGUAGE);
$promotionObj = new Promotion($_GET['id']);
?>
<script type="text/javascript">

    
    var directionsService = new google.maps.DirectionsService();
    var directionsDisplay = new google.maps.DirectionsRenderer();         
   

    function initialize()
    {
        
        var map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom: 12,
            center: new google.maps.LatLng(window.lat,window.lang1),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();
        

       

        directionsDisplay.setMap(map);
        //directionsDisplay.setPanel($("#instructions-content"));

        var currentPositionMarker = new google.maps.Marker({
            position: new google.maps.LatLng(window.lat,window.lang1),
            map: map
           
        });

       
        google.maps.event.addListener(currentPositionMarker, 'click', function() {
            infowindow.setContent("Deal position");
            infowindow.open(map, currentPositionMarker);
            
        });
    }

    $(document).ready(function() 
    {
        });
     

    $(function() { 
        $(document).bind ('pageshow', function (e, data) {
    
            initialize();
        });
    });
   
</script>


<?
#get deals details


$imageObj = new Image($promotionObj->getNumber("thumb_id"));
$promotionImage = '';
if ($imageObj->imageExists()) {
    $promotionImage = $imageObj->getPath();
}

#deals valuse prep
$price = string_substr($promotionObj->dealvalue, 0, (string_strpos($promotionObj->dealvalue, ".")));
$cents = string_substr($promotionObj->dealvalue, (string_strpos($promotionObj->dealvalue, ".")), 3);
if ($cents == ".00")
    $cents = "";
if ($promotionObj->realvalue > 0 && $promotionObj->dealvalue > 0) {
    $offer = round(100 - (($promotionObj->dealvalue * 100) / $promotionObj->realvalue)) . '% ' . system_showText(LANG_DEAL_OFF) . "! " . CURRENCY_SYMBOL . format_money($promotionObj->dealvalue, 2);
    $summary_offer = round(100 - (($promotionObj->dealvalue * 100) / $promotionObj->realvalue)) . '% ' . system_showText(LANG_DEAL_OFF);
} else {
    $offer = system_showText(LANG_NA);
}



$promotionDeals = $promotionObj->getDealInfo();




if (DEFAULT_DATE_FORMAT == "m/d/Y") {
    $sd_date = date("m") . "/" . date("d") . "/" . date("Y");
    $ed_date = $promotionDeals['timeleft'][1] . "/" . $promotionDeals['timeleft'][2] . "/" . $promotionDeals['timeleft'][0];
} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
    $sd_date = date("d") . "/" . date("m") . "/" . date("Y");
    $ed_date = $promotionDeals['timeleft'][2] . "/" . $promotionDeals['timeleft'][1] . "/" . $promotionDeals['timeleft'][0];
}

$sd_timestamp = system_getTimeStamp($sd_date);
/*
 * Get timestamp from $enddate
 */
$ed_timestamp = system_getTimeStamp($ed_date);

/*
 * Get the difference in days beteween two dates
 */
$diffdays = system_getDiffDays($sd_timestamp, $ed_timestamp);

if ($diffdays) {
    $format = "dHM";
} else {
    $format = "HMS";
}


############################redeem
$dealsDone = $promotionDeals['doneByAmount'] || $promotionDeals['doneByendDate'] ? true : false;
//$linkRedeem = $mobile_base_url . 'index.php/' . $listing->id . '/redeem/' . $promotionObj->id . '?from=fb';
//prep facebook link 
//$TBLink = DEFAULT_URL."/popup/popup.php?pop_type=deal_redeem&amp;redeemit=true&amp;id=".$promotion->getNumber("id");
Facebook::getFBInstance($facebook);
//echo MOBILE_DEFAULT_URL.'<br/>';
$promotionUrl = MOBILE_DEFAULT_URL . "/promotion_detail.php?id=" . $promotionObj->getNumber("id");
//$mobile_base_url . 'index.php/' . $listing->id . '/promotion_detail/' . $promotionObj->id.'?show_redeem=true';

if (sess_getAccountIdFromSession()) {
    $linkRedeem = $promotionUrl;
} else {
    $linkRedeem = MOBILE_DEFAULT_URL . '/login.php?redirecturl=' . $promotionUrl;
}

$urlRedirect = "&action=check_session&type=redeem_deal&item_id=" . $promotionObj->getNumber("id") . "&tb_link=" . urlencode($promotionUrl) . "&destiny=" . urlencode($promotionUrl);

$fbLinkRedeem = $facebook->getLoginStatusUrl(
        array(
            "ok_session" => FACEBOOK_REDIRECT_URI . "?fb_session=ok" . $urlRedirect,
            "no_session" => FACEBOOK_REDIRECT_URI . "?fb_session=no_session" . $urlRedirect,
            "no_user" => FACEBOOK_REDIRECT_URI . "?fb_session=no_user" . $urlRedirect
        )
);

#####################################
?>

<div data-role="content" style="padding: 15px;">
    <div style=" text-align:center">

        <div class="txt_block"> <h3 style="text-shadow:none; margin:0px;"><?= $promotionObj->name; ?> </h3> </div>
        <img src="<?= $promotionImage; ?>" alt="image" style="width: 100%; height: auto; margin-top:25px;"></div></div>



<div data-role="content" style="padding: 15px;">

    <ul data-role="listview" data-inset="true" class="ui-listview ui-listview-inset ui-corner-all ui-shadow">

        <li data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-icon="false" data-iconpos="right" data-theme="c" class="ui-btn ui-btn-icon-right ui-li ui-li-has-alt ui-li-has-thumb ui-corner-bottom ui-btn-up-c" style="padding:5px; height:90px;">


            <style>
                .countdown li{
                    float: left;
                    width: 32%;
                    margin: 2px;
                    border-left: 1px solid;
                }

                .countdown li:first-child{
                    border-left: 0 none;
                }
                .countdown strong{
                    display:block;
                }
            </style>

            <div class="countdown">

                <div id="timeLeft" style=" width:100%; text-align:center; border-bottom: 1px solid #999; float:left; padding-bottom:5px;">

                    <div style="float:left; width:33%; border-right: 1px solid #999" class="countdown_section">
                        <span class="countdown_amount">00</span><br/>
                        <?= string_ucwords(system_showText(LANG_LABEL_DAY)); ?>
                    </div>
                    <div style="float:left; width:33%; border-right: 1px solid #999" class="countdown_section">
                        <span class="countdown_amount">00</span>
                        <strong><?= string_ucwords(system_showText(LANG_LABEL_HOUR)); ?></strong>
                    </div>
                    <div style="float:left; width:33%; " class="countdown_section">
                        <span class="countdown_amount">00</span>
                        <strong><?= string_ucwords(system_showText(LANG_LABEL_MINUTE)); ?></strong>
                    </div>

                </div>
            </div>
            <div style=" width:100%; text-align:left; float:left; padding-bottom:5px; margin-top:10px;"><div class="price" style="float:right; margin:0px;"><?= CURRENCY_SYMBOL . $price . ($cents ? "<span class=\"cents\">" . $cents . "</span>" : "") ?></div>
                <p>Value: <?= CURRENCY_SYMBOL . format_money($promotionObj->realvalue, 2) ?> <br/>
                    Deals Left: <?= $promotionDeals['left']; ?><br/>
                    Deals Done: <?= $promotionDeals['sold']; ?><br/>

                </p>


            </div>
            <!-- <div style=" width:100%; text-align:left; float:left; padding-bottom:5px; margin-top:10px;">
                 <a href="http://test.dealcloudusa.com/mobi/index.php/50915/popuptest?is_popup=true" class="openpoup">open popup</a>
             </div>
            -->


        </li>
    </ul>






    <script type="text/javascript">
        //<![CDATA[
        $(document).bind('pageinit',function() {
            newDate = new Date(<?= $promotionDeals['timeleft'][0] ?>,<?= ($promotionDeals['timeleft'][1] - 1) ?>,<?= $promotionDeals['timeleft'][2] ?>,23,59,59);
            $('#timeLeft').countdown({
                until: newDate,
                format:'<?= $format ?>'
            });
        });
        //]]>
    </script>

    <script type="text/javascript" src="<?= DEFAULT_URL ?>/scripts/jquery/countdown/jquery.countdown.min.js"></script>
    <?
    if (sess_getAccountIdFromSession()) {
        $check_value = $promotionObj->alreadyRedeemed($promotionObj->id);
    }
    if (/* !empty($check_value) */false):
        ?>
        <a data-role="button" data-transition="fade" data-theme="b" href="" class="ui-btn-left" style="width: 100%; height: 40px"><?= $check_value ?></a>
    <? elseif (!$dealsDone): ?>
        <p class="redeem-option" style="text-align:right">
            <a style="width: 100%" data-role="button" data-transition="fade" data-theme="c" href="<?= $linkRedeem ?>" class="ui-btn-left">
                Redeem without Facebook
            </a>

        </p>

        <p class="redeem-option" style="text-align:right">
            <a style="width: 100%" data-role="button" data-transition="fade" data-theme="c" href="<?= $fbLinkRedeem ?>" class="ui-btn-left fb_login">
                Redeem with Facebook
            </a>

        </p>
    <? else: ?>
        <div class="txt_block txt_center">This deal is not available any more</div>
    <? endif; ?>

    <div class="txt_block">
        <h3 class="ui-li-heading" >Terms and Conditions</h3>
        <p style=" white-space:normal" class="ui-li-desc">
            <?= $promotionObj->getString("conditions" . $langIndex); ?>
        </p>
    </div>
    <div class="txt_block">

        <h3 class="ui-li-heading" >Description</h3>
        <p style=" white-space:normal" class="ui-li-desc">
            <?= $promotionObj->getString("long_description" . $langIndex); ?>
        </p>
    </div>
    <div class="ui-bar-c ui-corner-all ui-shadow" style="padding:1em;">
        <div id="map_canvas1" style="height:350px;"></div>
    </div>

    <a href="#" id="directions-button" data-role="button" data-inline="true" data-mini="true">Get Directions</a>
    <? if ($_GET['show_redeem'] && sess_getAccountIdFromSession()): ?>
        <div style="display: none" class="redeem-detail" data-options='{"mode":"blank","headerText":"  ","headerClose":true,"blankContent":true}' >
            <? include 'redeem.php'; ?>
        </div>
    <? endif; ?>
</div>





<? include(MOBILE_EDIRECTORY_ROOT . "/layout/footer_new.php"); ?>








