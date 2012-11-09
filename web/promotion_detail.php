<?
     
	 
	
	$langIndex = language_getIndex(EDIR_LANGUAGE);  
	#get deals details
	$promotionObj = new Promotion(getUriSegments(4));
	
	$imageObj = new Image($promotionObj->getNumber("thumb_id"));
    $promotionImage = '';
	if ($imageObj->imageExists()){
		$promotionImage = $imageObj->getPath();
	}
	
	#deals valuse prep
	$price = string_substr($promotionObj->dealvalue,0,(string_strpos($promotionObj->dealvalue,".")));
	$cents = string_substr($promotionObj->dealvalue,(string_strpos($promotionObj->dealvalue,".")),3);
	if ($cents == ".00") $cents = "";
	if ($promotionObj->realvalue>0 && $promotionObj->dealvalue >0){
		$offer = round(100-(($promotionObj->dealvalue*100)/$promotionObj->realvalue)).'% '.system_showText(LANG_DEAL_OFF)."! ".CURRENCY_SYMBOL.format_money($promotionObj->dealvalue,2);
		$summary_offer = round(100-(($promotionObj->dealvalue*100)/$promotionObj->realvalue)).'% '.system_showText(LANG_DEAL_OFF);
	}else{
		$offer = system_showText(LANG_NA);
	}
	
	
	
	$promotionDeals = $promotionObj->getDealInfo();
	
	
	if (DEFAULT_DATE_FORMAT == "m/d/Y") {
		$sd_date = date("m")."/".date("d")."/".date("Y");
		$ed_date = $promotionDeals['timeleft'][1]."/".$promotionDeals['timeleft'][2]."/".$promotionDeals['timeleft'][0];
	} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
		$sd_date = date("d")."/".date("m")."/".date("Y");
		$ed_date = $promotionDeals['timeleft'][2]."/".$promotionDeals['timeleft'][1]."/".$promotionDeals['timeleft'][0];
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

	if ($diffdays){
		$format = "dHM";
	} else {
		$format = "HMS";
	}
	
	#####################################

?>
<div data-role="content" style="padding: 15px;">
                <div style=" text-align:center">
                
                <h3 style="color:#fff; text-shadow:none; margin:0px;"><?= $promotionObj->name; ?> </h3>
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
			<?=string_ucwords(system_showText(LANG_LABEL_DAY));?>
		</div>
		<div style="float:left; width:33%; border-right: 1px solid #999" class="countdown_section">
			<span class="countdown_amount">00</span>
			<strong><?=string_ucwords(system_showText(LANG_LABEL_HOUR));?></strong>
		</div>
		<div style="float:left; width:33%; " class="countdown_section">
			<span class="countdown_amount">00</span>
			<strong><?=string_ucwords(system_showText(LANG_LABEL_MINUTE));?></strong>
		</div>
	
</div>
</div>
<div style=" width:100%; text-align:left; float:left; padding-bottom:5px; margin-top:10px;"><div class="price" style="float:right; margin:0px;"><?=CURRENCY_SYMBOL.$price.($cents ? "<span class=\"cents\">".$cents."</span>" : "")?></div>
<p>Value: <?= CURRENCY_SYMBOL.format_money($promotionObj->realvalue,2) ?> <br/>
Deals Left: <?= $promotionDeals['left']; ?><br/>
Deals Done: <?= $promotionDeals['sold']; ?><br/>

</p>


</div>


     

	  </li>
			</ul>






<script type="text/javascript">
			//<![CDATA[
			$(document).bind('pageinit',function() {
				newDate = new Date(<?=$promotionDeals['timeleft'][0]?>,<?=($promotionDeals['timeleft'][1]-1)?>,<?=$promotionDeals['timeleft'][2]?>,23,59,59);
				$('#timeLeft').countdown({
					until: newDate,
					format:'<?=$format?>'
				});
			});
			//]]>
		</script>
	
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/countdown/jquery.countdown.min.js"></script>
	

<h3 class="ui-li-heading" style="color:#f2f2f2; text-shadow:none">Terms and Conditions</h3>
				<p style=" white-space:normal;color:#f2f2f2; text-shadow:none;" class="ui-li-desc">
					<?= $promotionObj->getString("conditions".$langIndex); ?>
	
	
				</p><br/>
                
                
                
                <h3 class="ui-li-heading" style="color:#f2f2f2; text-shadow:none">Description</h3>
				<p style=" white-space:normal;color:#f2f2f2; text-shadow:none;" class="ui-li-desc">
				<?= $promotionObj->getString("long_description".$langIndex); ?>
				</p>

            </div>
            
            
            
            
            
            
            
            
        