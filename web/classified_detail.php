<?
   $classifiedObj = new Classified(getUriSegments(4));
   $imageObj = new Image($classifiedObj->image_id);
   $classfiedImage = '';
   if ($imageObj->imageExists()){
		$classfiedImage = $imageObj->getPath();
   }
   
    $classfied_location = $classifiedObj->getString("location", true);
	$locationsToshow = system_retrieveLocationsToShow();
	$locationsParam = $locationsToshow." z";
	$location = $classifiedObj->getLocationString($locationsParam, true);
	
	$classfied_address = $classifiedObj->getString("address", true);
	$classfied_address2 = $classifiedObj->getString("address2", true);
   
   $classified_contactName = $classifiedObj->getString("contactname");
   $classified_email = $classifiedObj->getString("email");
   $classified_url = $classifiedObj->getString("url");   
   $classified_phone = $classifiedObj->getString("phone");
	
	$classified_description = $classifiedObj->getStringLang(EDIR_LANGUAGE, "summarydesc", true); 
?>

<div data-role="content" style="padding: 15px;">
    <div style=" text-align:center">
         <h3 style="color:#fff; text-shadow:none; margin:0px;"><?= $classifiedObj->title; ?></h3>
         <img src="<?= $classfiedImage ?>" alt="image" style="width: 100%; height: auto; margin-top:25px;">
	</div>
	<h3 class="ui-li-heading" style="color:#f2f2f2; text-shadow:none">Overview</h3>
	<p><?= $classified_description ?></p>
	<h3 class="ui-li-heading" style="color:#f2f2f2; text-shadow:none">Contact Information</h3>
    <p style=" white-space:normal;color:#f2f2f2; text-shadow:none;" class="ui-li-desc"> 
		<? if ( ($location)||($classified_address) || ($classified_address2)) echo "<address>\n";  ?>
	
	    <? if($classified_address) { ?>
	       <span> address 1: <?=nl2br($classified_address)?></span><br />
	    <? } ?>
	
	    <? if($classified_address2) { ?>
	       <span> address 2: <?=nl2br($classified_address2)?></span><br />
	    <? } ?>
	
	    <? if($location) { ?>
	       <span> location: <?=$location ?></span><br />
	    <? } ?>
	
	    <? if ( ($location)||($classified_address) || ($classified_address2)) echo "</address>\n";  ?>
    </p>
	<? if($classified_url) { ?>
        <p><strong><?=system_showText(LANG_EVENT_WEBSITE)?>:</strong>
        
           <a href="<?= $classified_url ?>" target="_blank"><?= $classified_url ?></a>
        
        </p>
    <? } ?>
	<? if ($classified_email){ ?>
        <p><strong><?=system_showText(LANG_LABEL_EMAIL)?>:</strong> <a href="mailto:<?=$classified_email ?>"><?=system_showText(LANG_SEND_AN_EMAIL);?></a></p>
    <? } ?>	

    <? if($classified_contactName) { ?>
        <p><strong><?=system_showText(LANG_LABEL_CONTACTNAME)?>:</strong> <?=$classified_contactName ?></p>
    <? } ?>

    <? if($classified_phone) { ?>
	<p><strong><?=system_showText(LANG_LABEL_PHONE)?>:</strong><a href="tel:<?= $classified_phone ?>"><?= $classified_phone ?></a>  </p>
    <? } ?>
</div>	
