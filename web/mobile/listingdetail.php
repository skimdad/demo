<?

	/*==================================================================*\
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
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /mobile/listingdetail.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/mobile.inc.php");
	include("../conf/loadconfig.inc.php");

	/*
	 * Mod Rewrite
	 */
	if(!is_numeric($_GET["id"])){
		$listingObj = new Listing();
		if(!$listingObj->getListingByFriendlyURL($_GET["id"])){
			header("Location: ".DEFAULT_URL."");
			exit;
		}
	}else{
		$listingObj = new Listing($_GET["id"]);
	} 
	
	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (MOBILE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# QUERY STRING
	# ----------------------------------------------------------------------------------------------------
	include("./query_string.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$headertag_title = $headertagtitle;
	include(MOBILE_EDIRECTORY_ROOT."/layout/header.php");

	if($listingObj){
	
		$langIndex = language_getIndex(EDIR_LANGUAGE);
		
		$listing = $listingObj->data_in_array;
					
		$module_item_title = $listing["title"];
		include("./breadcrumb.php"); 
				
		$location_map = false;
		
		if ($listing["latitude"] && $listing["longitude"]){
			$location_map = $listing["latitude"].",".$listing["longitude"];
            $location_map = urlencode($location_map);
		}

		$icon = THEMEFILE_URL."/".EDIR_THEME."/images/markers/marker.png";

		if ($location_map){ ?>
			<img src="http://maps.google.com/maps/api/staticmap?center=<?=$location_map?>&zoom=15&size=320x150&maptype=roadmap&mobile=true&markers=icon:<?=$icon?>|<?=$location_map?>&sensor=false" />
		<? } ?>
		
		<div class="itemView listingView">
			<h1>
				<?=$listing["title"]?>
			</h1>
			<? 
			if ($listing["address"] || $listing["address2"] || $listing["location_3"] || $listing["location_4"] || $listing["zip_code"]) {
				?>
				<address>
					<? 
					if ($listing["address"]) { 
						?>
						<span><?=$listing["address"]?></span>
						<? 
					} 
					if ($listing["address2"]) { 
						?>
						<span><?=$listing["address2"]?></span>
						<? 
					} 
					if ($listing["location_3"] || $listing["location_4"] || $listing["zip_code"]) { 
						?>
						<span>
							<?
							if($listing["location_4"]){
								unset($location4);
								$location4 = new Location4($listing["location_4"]);
								$string_location4 = $location4->getString("name");
							}
							if($listing["location_3"]){
								unset($location3);
								$location3 = new Location3($listing["location_3"]);
								$string_location3 = $location3->getString("name");
							}
							
							if ($listing["location_4"]) echo $string_location4;
							if ($listing["location_3"] && $listing["location_4"] ) echo ", ";
							if ($listing["location_3"]) echo $string_location3;
							if ($listing["location_3"] || $listing["location_4"] ) echo " ";
							if ($listing["zip_code"]) echo $listing["zip_code"];
							?>
						</span>
						<? 
					} 
					?>
				</address>
				<? 
			} 
			if ($listing["phone"]) { 
				?>
				<p class="phone">
					<span class="bold"><?=system_showText(LANG_LISTING_LETTERPHONE);?>:</span> <?=$listing["phone"]?>
				</p>
				<? 
			} 
			if ($listing["long_description".$langIndex]) { 
				?>	
				<p><?=$listing["long_description".$langIndex]?></p>
				<? 
			} 
			?>
		</div>
		<?
	}
	
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MOBILE_EDIRECTORY_ROOT."/layout/footer.php");
?>