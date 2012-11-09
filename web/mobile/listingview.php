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
	# * FILE: /mobile/listingview.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (MOBILE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$dbMain = db_getDBObject(DEFAULT_DB, true);
	if ($listing["location_3"]) {
		if (!$stateArray[$listing["location_3"]]) {
			$sqlState = "SELECT name FROM Location_3 WHERE id = ".$listing["location_3"]."";
			$resultState = $dbMain->query($sqlState);
			if ($resultState) {
				if ($state = mysql_fetch_assoc($resultState)) {
					$stateArray[$listing["location_3"]] = $state["name"];
				}
			}
		}
	}

	if ($listing["location_4"]) {
		if (!$regionArray[$listing["location_4"]]) {
			$sqlRegion = "SELECT name FROM Location_4 WHERE id = ".$listing["location_4"]."";
			$resultRegion = $dbMain->query($sqlRegion);
			if ($resultRegion) {
				if ($region = mysql_fetch_assoc($resultRegion)) {
					$regionArray[$listing["location_4"]] = $region["name"];
				}
			}
		}
	}

	/*
	 * Prepare link to detail
	 */
	if(($levelObj->getDetail(htmlspecialchars($listing["level"])) == "y") || $levelObj->getActive(htmlspecialchars($listing["level"])) == 'n'){
		if(MODREWRITE_FEATURE == "on"){
			$detailLink = MOBILE_DEFAULT_URL."/listing/".$listing["friendly_url"].".html";	
		}else{
			$detailLink = "".MOBILE_DEFAULT_URL."/listingdetail.php?id=".htmlspecialchars($listing["id"]);
		}
	}else{
		$detailLink = false;
	}

?>

	<div class="itemView listingView">
		<h1>
			<? if($detailLink){ ?>
				<a href="<?=$detailLink?>">
			<? }
			
			echo $listing["title"];
			
			if($detailLink){ ?>
				</a>
			<? } ?>
		</h1>
		
		<? if ($listing["address"] || $listing["address2"] || $listing["location_3"] || $listing["location_4"] || $listing["zip_code"]) { ?>
			<address>
				<? if ($listing["address"]) { ?>
					<span><?=$listing["address"]?></span>
				<? } ?>
				<? if ($listing["address2"]) { ?>
					<span><?=$listing["address2"]?></span>
				<? } ?>
				<? if ($listing["location_3"] || $listing["location_4"] || $listing["zip_code"]) { ?>
					<span>
						<?
						if ($listing["location_4"]) echo $regionArray[$listing["location_4"]];
						if ($listing["location_3"] && $listing["location_4"] ) echo ", ";
						if ($listing["location_3"]) echo $stateArray[$listing["location_3"]];
						if ($listing["location_3"] || $listing["location_4"] ) echo " ";
						if ($listing["zip_code"]) echo $listing["zip_code"];
						?>
					</span>
				<? } ?>
			</address>
		<? } ?>
		<? if ($listing["phone"]) { ?>
			<p class="phone"><span class="bold"><?=system_showText(LANG_LISTING_LETTERPHONE);?>:</span> <?=$listing["phone"]?></p>
		<? } ?>
		<? if ($listing["description".$langIndex]) { ?>
			<p><?=$listing["description".$langIndex]?></p>
		<? } ?>
	</div>