<?
	$eventObj = new Event(getUriSegments(4));
	$imageObj = new Image($eventObj->image_id);
	$eventImage = '';
	if ($imageObj->imageExists()){
	   $eventImage = $imageObj->getPath();
	}
	$str_date = $eventObj->getDateString();
	if ($eventObj->getString("recurring")=="Y"){
		$str_recurring = $eventObj->getDateStringRecurring();
	}
	
    $str_time = $eventObj->getTimeString();
	
	$event_location = $eventObj->getString("location", true);
	$locationsToshow = system_retrieveLocationsToShow();
	$locationsParam = $locationsToshow." z";
	$location = $eventObj->getLocationString($locationsParam, true);
	
	$event_address = $eventObj->getString("address", true);
	$event_address2 = $eventObj->getString("address2", true);
	
	if ($eventObj->getString("latitude") && $eventObj->getString("longitude")){
        $location_map = urlencode($eventObj->getString("latitude").",".$eventObj->getString("longitude"));
    } else {
        $location_map = urlencode($eventObj->getLocationString("A, 4, 3, 1, z", true)); /* 1=country, 3=state, 4=city */	
    }
	$map_link = "http://maps.google.com/maps?q=".$location_map;		
	
	$event_contactName = $eventObj->getString("contact_name");
	$event_email = $eventObj->getString("email");
    $event_url = $eventObj->getString("url");   
	$event_phone = $eventObj->getString("phone");
	
	$event_description = $eventObj->getStringLang(EDIR_LANGUAGE, "long_description", true); 
?>

<div data-role="content" style="padding: 15px;">
    <div style=" text-align:center">
         <h3 style="color:#fff; text-shadow:none; margin:0px;"><?= $eventObj->title; ?></h3>
         <img src="<?= $eventImage ?>" alt="image" style="width: 100%; height: auto; margin-top:25px;">
	</div>


   <h3 class="ui-li-heading" style="color:#f2f2f2; text-shadow:none">Overview</h3>
	<p style=" white-space:normal;color:#f2f2f2; text-shadow:none;" class="ui-li-desc">
	    <strong><?=system_showText(LANG_EVENT_WHEN);?>:</strong> <?=($eventObj->getString("recurring") != "Y" ? $str_date : $str_recurring);?><br>
	
	    <? if ($str_time) { ?>
	        <strong><?=system_showText(LANG_EVENT_TIME)?>:</strong> <?=$str_time?><br />
	    <? } ?>
	
	    <? if ($event_location) { ?>
             <strong><?=system_showText(LANG_SEARCH_LABELLOCATION)?>:</strong> <?=nl2br($event_location)?><br />
        <? } ?>
    </p>
	
	<? if ($location_map) { ?>
       <a data-role="button" data-transition="fade" data-theme="c" href="<?= $map_link?>" class="ui-btn-left">
    		<?=system_showText(LANG_EVENT_DRIVINGDIRECTIONS)?>
	   </a>
    <? } ?>
	
	                
   <h3 class="ui-li-heading" style="color:#f2f2f2; text-shadow:none">Contact Information</h3>
   <p style=" white-space:normal;color:#f2f2f2; text-shadow:none;" class="ui-li-desc"> 
	 <? if (($location) || ($event_address) || ($event_address2)) echo "<address>\n";  ?>

    <? if($event_address) { ?>
       <span> address 1: <?=nl2br($event_address)?></span><br />
    <? } ?>

    <? if($event_address2) { ?>
       <span> address 2: <?=nl2br($event_address2)?></span><br />
    <? } ?>

    <? if($location) { ?>
       <span> location:<?=$location?></span>
    <? } ?>

    <? if (($location) || ($event_address) || ($event_address2)) echo "</address>\n";  ?>
    </p>
    <? if($event_url) { ?>
        <p><strong><?=system_showText(LANG_EVENT_WEBSITE)?>:</strong>
        
           <a href="<?= $event_url ?>" target="_blank"><?= $event_url ?></a>
        
        </p>
    <? } ?>

    <? if ($event_email){ ?>
        <p><strong><?=system_showText(LANG_LABEL_EMAIL)?>:</strong> <a href="mailto:<?=$event_email ?>"><?=system_showText(LANG_SEND_AN_EMAIL);?></a></p>
    <? } ?>	

    <? if($event_contactName) { ?>
        <p><strong><?=system_showText(LANG_LABEL_CONTACTNAME)?>:</strong> <?=$event_contactName ?></p>
    <? } ?>

    <? if($event_phone) { ?>
	<p><strong><?=system_showText(LANG_LABEL_PHONE)?>:</strong> <a href="tel:<?= $event_phone ?>"><?= $event_phone ?></a></p>
    <? } ?>

	

<h3 class="ui-li-heading" style="color:#f2f2f2; text-shadow:none">Discription</h3>
<p style=" white-space:normal;color:#f2f2f2; text-shadow:none;" class="ui-li-desc">
	<?= $event_description; ?>
</p><br/>


</div>
