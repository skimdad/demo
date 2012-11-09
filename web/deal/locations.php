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
	# * FILE: /deal/locations.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

?>

    <? if (FEATURED_LOCATION == "on") {
		
		// CREATING CACHE
		$objCache = new cache("sidebar_location_deal");
		
		if ($objCache->caching) {

			$locationsToShow = system_retrieveLocationsToShow($type="array");

			if ($locationsToShow) {

				$_locations = explode(",", EDIR_LOCATIONS);

				$found_featLocations = false;
				$defaultLocationsToShow = false;
				$nonDefaultLocationsToShow = false;
				$flag_showNonFeatures = false;
				$last_default_level = false;
				$last_default_id = false;

				if (EDIR_DEFAULT_LOCATIONS) {
					$defaultLocations = explode (",", EDIR_DEFAULT_LOCATIONS);
					$defaultLocationsToShow = array_intersect($defaultLocations, $locationsToShow);
					$nonDefaultLocationsToShow = array_diff($locationsToShow, $defaultLocationsToShow);
					if ($defaultLocationsToShow) {
						$count_locationFeatLevels = 0;
						foreach($defaultLocationsToShow as $_location_level) {
							$count_locationFeatLevels++;
							if ($count_locationFeatLevels<=FEATUREDLOCATION_LEVEL_AMOUNT) {
								$objLocationLabel = "Location".$_location_level;
								${"Location".$_location_level} = new $objLocationLabel;
								$locations_info = db_getFromDB("settinglocation", "id", $_location_level, 1, "", "array", SELECTED_DOMAIN_ID);

								${"locations".$_location_level} = ${"Location".$_location_level}->retrieveFeatureds($_locations, $locations_info["default_id"]);
								if (count(${"locations".$_location_level}))
									if (!$found_featLocations)
										$found_featLocations = true;
							}
						}
						$found_featLocations = true;
					}
				} else {
					$nonDefaultLocationsToShow = $locationsToShow;
				}

				system_retrieveLastDefaultLevel ($last_default_level, $last_default_id);

				if ($nonDefaultLocationsToShow) {
					$count_locationFeatLevels = ($defaultLocationsToShow?count($defaultLocationsToShow):0);
					foreach($nonDefaultLocationsToShow as $_location_level) {
						$count_locationFeatLevels++;
						if ($count_locationFeatLevels<=FEATUREDLOCATION_LEVEL_AMOUNT) {
							$objLocationLabel = "Location".$_location_level;
							${"Location".$_location_level} = new $objLocationLabel;
							${"locations".$_location_level} = ${"Location".$_location_level}->retrieveFeatureds($_locations, false, $last_default_level, $last_default_id);
							if (count(${"locations".$_location_level}))
								if (!$found_featLocations)
									$found_featLocations = true;
						}
					}
				}

				if ($found_featLocations) { ?>

					<h2><?=system_showText(LANG_FEATUREDLOCATIONS)?></h2>
					<ul id="accordion">
						<?
						$count_locationFeatLevels = 0;

						foreach($locationsToShow as $_location_level) {

							$count_locationFeatLevels++;
							if (count(${"locations".$_location_level}) && $count_locationFeatLevels<=FEATUREDLOCATION_LEVEL_AMOUNT) { ?>
								<li class="accordion-item">
									<h3><a href="#deals"><?=system_showText((constant("LANG_LABEL_".constant("LOCATION".$_location_level."_SYSTEM")."_PL")))?></a></h3>
									<ul class="list <?=$count_locationFeatLevels == 1 ? "current" : ""?>">
									<?
									$noBorder = " noBorder";

									foreach (${"locations".$_location_level} as $each_location) {

										$i=0;
										$location_path["friendly"] = false;
										$location_path["nonfriendly"] = false;
										while ($_location_level > $_locations[$i]) {
											$location_path["friendly"][] = $each_location["location".$_locations[$i]."_friendly_url"];
											$location_path["nonfriendly"][] = "location_".$_locations[$i]."=".$each_location["location_".$_locations[$i]];
											$i++;
										}

										if (MODREWRITE_FEATURE != "on") { ?>
												<li><a href="<?=PROMOTION_DEFAULT_URL?>/results.php?<?=($location_path["nonfriendly"] === false ? '' : implode("&",$location_path["nonfriendly"])."&" )?>location_<?=$_location_level?>=<?=$each_location["id"];?>"><?=$each_location["name"];?></a></li>
										<? } else { ?>
												<li><a href="<?=PROMOTION_DEFAULT_URL?>/location/<?=($location_path["friendly"] === false ? '' : implode("/",$location_path["friendly"])."/" )?><?=$each_location["friendly_url"];?>"><?=$each_location["name"];?></a></li>
										<? }
										unset ($location_path);
									}
									?>
									</ul>
								</li>
								<?
							}
						}
						?>
							<li class="view-all"><a href="<?=PROMOTION_DEFAULT_URL?>/alllocations.php"><?=system_showText(LANG_VIEWALLLOCATIONSCATEGORIES)?></a></li>
					</ul>
					<?
				}
				unset ($count_locationFeatLevels);
				unset ($found_featLocations);
				unset ($found_featLocations);
				unset ($defaultLocationsToShow);
				unset ($nonDefaultLocationsToShow);
				unset ($flag_showNonFeatures);
				unset ($last_default_level);
				unset ($last_default_id);
			}
		}
		$objCache->close();
	}
	?>