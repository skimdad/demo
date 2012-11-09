<?php
// include(EDIRECTORY_ROOT."/includes/views/icon_listing.php");
$mapObj = new GoogleSettings(GOOGLE_MAPS_STATUS);
$isMobileApp_MOBI = true;
$listingtemplate_google_maps = "";
if (GOOGLE_MAPS_ENABLED == "on" && $mapObj->getString("value") == "on") {
	$google_image_id = $listing->getNumber("image_id");
	$google_title = addslashes($listing->getString('title'));
	$google_phone = $listing->getString('phone');
	
	if ($tPreview) {
		
		$google_address = "";
		$google_address2 = "";
		$google_location1 = "";
		$google_location3 = "";
		$google_location4 = "";
		$google_zip = "";
		$google_maptuning = "";
		$google_mapzoom = "";
		$google_location_showaddress = "";
	} else {
		
		$google_address = $listing->getString('address');
		$google_address2 = $listing->getString('address2');
		$google_location1 = $listing->getLocationString("1", true);
		$google_location3 = $listing->getLocationString("3", true);
		$google_location4 = $listing->getLocationString("4", true);
		$google_zip = $listing->getLocationString("z", true);
		if ($listing->getString('latitude') && $listing->getString('longitude')){
			$google_maptuning = $listing->getString('latitude').",".$listing->getString('longitude');
		}
		$google_mapzoom = $listing->getString('map_zoom');
		$google_location_showaddress = $listing->getLocationString("A, 4, 3, 1", true);
	}
	$show_html = true;
	
	include(INCLUDES_DIR."/views/view_google_maps.php");
	$listingtemplate_google_maps = $google_maps;
	$google_maps = "";
	
	if (GOOGLE_MAPS_ENABLED == "on" && $mapObj->getString("value") == "on") {
		
		echo "";
		echo $listingtemplate_google_maps;
	}
}


//showing direction button:
if ($listing->getString("latitude") && $listing->getString("longitude")){
	$location_map = urlencode($listing->getString("latitude").",".$listing->getString("longitude"));
} else {
	$location_map = urlencode($listing->getLocationString("A, 4, 3, 1, z", true)); /* 1=country, 3=state, 4=city */	
}
$map_link = "http://maps.google.com/maps?q=".$location_map;	



?>

<div data-role="content" style="padding: 15px;">
    <style>
	  .map-info-view *{
	  	margin:0;
	  }
	  .map-info-view{
	  	font-size: 0.6em;

	  }
	</style> 
	<div id="map" class="map" style="width: 300px; height: 288px;">&nbsp;</div>
</div>

 <a data-role="button" data-transition="fade" data-theme="c" href="<?= $map_link?>" class="ui-btn-left" target="_blank">
    <?=system_showText(LANG_EVENT_DRIVINGDIRECTIONS)?>
 </a>
