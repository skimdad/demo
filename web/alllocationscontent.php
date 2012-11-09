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
	# * FILE: /alllocationscontent.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	$default_url = DEFAULT_URL;
	if (defined(string_strtoupper($module_name).'_DEFAULT_URL')) {
		$default_url = constant(string_strtoupper($module_name).'_DEFAULT_URL');
	}

	$location_open  = "switchOpen";
	$location_close = "switchClose";
	$location_blank = "switchBlank";

	function buttonSwitch($loc_level, $loc_fat_level, $loc_fat_id) {

		$btId = 'btSwitchLoc'.$loc_level.'_'.$loc_fat_id;
		$divId = 'loc'.$loc_level.'_from'.$loc_fat_id;

		global $location_open, $location_close, $location_blank;

		$objLocationLabel = "Location".$loc_level;
		$Location = new $objLocationLabel;
		$Location->SetString("location_".$loc_fat_level, $loc_fat_id);
		$locations = $Location->retrieveLocationByLocation($loc_fat_level);
		if ($locations) {
			return "<a href=\"javascript:void(0)\" onclick=\"divSwitch('$btId', '$divId')\" id=\"$btId\" class=\"$location_open\">+</a>";
		} else {
			return "<a href=\"javascript:void(0)\" id=\"$btId\" class=\"$location_blank\">&nbsp;</a>";
		}
	}

	function build_location_tree($_locations, $_location_level, $_location_father_level_id, $location_father_url, $default_url) {

		system_retrieveLocationRelationship ($_locations, $_location_level, $_location_father_level, $_location_child_level);

		$objLocationLabel = "Location".$_location_level;
		${"Location".$_location_level} = new $objLocationLabel;
		${"Location".$_location_level}->SetString("location_".$_location_father_level, $_location_father_level_id);
		${"locations".$_location_level} = ${"Location".$_location_level}->retrieveLocationByLocation($_location_father_level);

		if (${"locations".$_location_level}) { ?>
			<li class="child" id="loc<?=$_location_level?>_from<?=$_location_father_level_id?>" style="display:none">
				<ul>
					<?
					$i=0;
					foreach (${"locations".$_location_level} as $each_location) {
						$i++;
						if (MODREWRITE_FEATURE != "on")
							$location_url = $location_father_url."&location_".$_location_level."=".$each_location['id'];
						else
							$location_url = $location_father_url."/".$each_location['friendly_url'];

						if ($_location_child_level) {
							?>
							<li><?=buttonSwitch($_location_child_level, $_location_level, $each_location["id"])?><a href="<?=$default_url?><?=$location_url?>"><?=string_htmlentities(string_strtoupper($each_location['name']));?></a></li>
							<?=build_location_tree($_locations, $_location_child_level, $each_location['id'], $location_url, $default_url);
						} else {
							?><li class="link"><a href="<?=$default_url?><?=$location_url?>"><?=string_htmlentities($each_location['name'])?></a></li><?
						}
					} ?>
				</ul>
			</li>
		<? }
	}
?>

	<script type="text/javascript">

	function divSwitch(btId, divId) {

		 if ($('#'+divId).css('display') == 'none') {
		 	 $('#'+divId).css('display', 'block');
		 	 $('#'+btId).attr('class', '<?=$location_close?>');
			 $('#'+btId).html('-');
		 } else {
		 	 $('#'+divId).css('display', 'none');
		 	 $('#'+btId).attr('class', '<?=$location_open?>');
			 $('#'+btId).html('+');
		 }
	}
	</script>

	<h2><?=system_showText(LANG_BROWSEBYLOCATION)?></h2>
	<?

	$locationsToShow = system_retrieveLocationsToShow($type="array");

	if ($locationsToShow) {

		$_locations = explode(",", EDIR_LOCATIONS);

		if (MODREWRITE_FEATURE != "on")
			$location_url_base = "/results.php?";
		else
			$location_url_base = "/location/";

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

			foreach($defaultLocations as $_location_level) {

				$objLocationLabel = "Location".$_location_level;
				${"Location".$_location_level} = new $objLocationLabel;
				$locations_info = db_getFromDB("settinglocation", "id", $_location_level, 1, "", "array", SELECTED_DOMAIN_ID);

				${"location".$_location_level} = ${"Location".$_location_level}->retrieveFeatureds($_locations, $locations_info["default_id"]);
				$i=0;
				$location_url_base = "";
				$location_path["friendly"] = false;
				$location_path["nonfriendly"] = false;
				while ($_location_level > $_locations[$i]) {
					$location_path["friendly"][] = ${"location".$_location_level}[0]["location".$_locations[$i]."_friendly_url"];
					$location_path["nonfriendly"][] = "location_".$_locations[$i]."=".${"location".$_location_level}[0]["location_".$_locations[$i]];
					$i++;
				}

				if (MODREWRITE_FEATURE != "on") {
					$location_url_base = "/results.php?".($location_path["nonfriendly"] === false ? '' : implode("&",$location_path["nonfriendly"]).'&')."location_".$_location_level."=".${"location".$_location_level}[0]["id"];
				} else {
					$location_url_base = "/location/".($location_path["friendly"] === false ? '' : implode("/",$location_path["friendly"])."/").${"location".$_location_level}[0]["friendly_url"];
				}

				if (in_array($_location_level, $defaultLocationsToShow)) {
					?>
					<h2>
						<a href="<?=$default_url?><?=$location_url_base?>"><?=${"location".$_location_level}[0]["name"];?></a>
					</h2>
					<?
				}
				$found_featLocations = true;
			}
			system_retrieveLastDefaultLevel ($last_default_level, $last_default_id);

		} else {
			$nonDefaultLocationsToShow = $locationsToShow;
		}

		if ($nonDefaultLocationsToShow) {

			reset($nonDefaultLocationsToShow);
			$_location_level = current($nonDefaultLocationsToShow);
			$_location_father_level = $last_default_level;
			$_location_father_level_id = $last_default_id;

			$objLocationLabel = "Location".$_location_level;
			${"Location".$_location_level} = new $objLocationLabel;

			if ($_location_father_level) {
				${"Location".$_location_level}->SetString("location_".$_location_father_level, $_location_father_level_id);
				${"locations".$_location_level} = ${"Location".$_location_level}->retrieveLocationByLocation($_location_father_level);
			} else {
				${"locations".$_location_level} = ${"Location".$_location_level}->retrieveAllLocation();
			}

			system_retrieveLocationRelationship ($_locations, $_location_level, $_location_father_level, $_location_child_level);

			if (${"locations".$_location_level}) {
				?>
				<div class="browse-locations"><?
					$i=0;
					
                    foreach (${"locations".$_location_level} as $each_location) {
						
						echo "<ul class=\"parent\">";
						
                        $i++;
						if (MODREWRITE_FEATURE != "on") {
							$location_url = $location_url_base.(EDIR_DEFAULT_LOCATIONS?"&":"")."location_".$_location_level."=".$each_location['id'];
						} else
							$location_url = $location_url_base.(EDIR_DEFAULT_LOCATIONS?"/":"").$each_location['friendly_url'];

						if ($_location_child_level) {
							?>
							<li><?=buttonSwitch($_location_child_level, $_location_level, $each_location["id"])?><a href="<?=$default_url?><?=$location_url?>"><?=string_strtoupper($each_location['name']);?></a></li>
							<?=build_location_tree($_locations, $_location_child_level, $each_location['id'], $location_url, $default_url);
						} else { ?>
							<li><a href="<?=$default_url?><?=$location_url?>"><?=$each_location['name'];?></a></li>
						<? }
						
						echo "</ul>";
					}
				?></div><?
			}
		}
		unset ($found_featLocations);
		unset ($defaultLocationsToShow);
		unset ($nonDefaultLocationsToShow);
		unset ($flag_showNonFeatures);
		unset ($last_default_level);
		unset ($last_default_id);
	}



