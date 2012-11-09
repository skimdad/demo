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
	# * FILE: /mobile/eventview.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on" || CUSTOM_EVENT_FEATURE != "on") { exit; }
	if (MOBILE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$dbMain = db_getDBObject(DEFAULT_DB,true);
	if ($event["location_3"]) {
		if (!$stateArray[$event["location_3"]]) {
			$sqlState = "SELECT name FROM Location_3 WHERE id = ".$event["location_3"]."";
			$resultState = $dbMain->query($sqlState);
			if ($resultState) {
				if ($state = mysql_fetch_assoc($resultState)) {
					$stateArray[$event["location_3"]] = $state["name"];
				}
			}
		}
	}

	if ($event["location_4"]) {
		if (!$regionArray[$event["location_4"]]) {
			$sqlRegion = "SELECT name FROM Location_4 WHERE id = ".$event["location_4"]."";
			$resultRegion = $dbMain->query($sqlRegion);
			if ($resultRegion) {
				if ($region = mysql_fetch_assoc($resultRegion)) {
					$regionArray[$event["location_4"]] = $region["name"];
				}
			}
		}
	}

	$auxEvent = new Event($event["id"]);
	$str_date = "";
	$str_date = $auxEvent->getDateString();
	$str_recurring = "";
	if ($auxEvent->getString("recurring")=="Y"){
		$str_recurring = $auxEvent->getDateStringRecurring();
	}
	
	$when = ($auxEvent->getString("recurring") != "Y" ? $str_date : $str_recurring);
	
//	if ($event["start_date"] == $event["end_date"]) $str_date = $event["start_date"];
//	else $str_date = $event["start_date"]." - ".$event["end_date"];

	$str_time = "";
	if ($event["has_start_time"] == "y") {
		$startTimeStr = explode(":", $event["start_time"]);
		if (CLOCK_TYPE == '24') {
			$end_time_hour = $endTimeStr[0];
		} elseif (CLOCK_TYPE == '12') {
			if ($startTimeStr[0] > "12") {
				$start_time_hour = $startTimeStr[0] - 12;
				$start_time_am_pm = "pm";
			} elseif ($startTimeStr[0] == "12") {
				$start_time_hour = 12;
				$start_time_am_pm = "pm";
			} elseif ($startTimeStr[0] == "00") {
				$start_time_hour = 12;
				$start_time_am_pm = "am";
			} else {
				$start_time_hour = $startTimeStr[0];
				$start_time_am_pm = "am";
			}
		}
		if ($start_time_hour < 10) $start_time_hour = "0".($start_time_hour+0);
		$start_time_min = $startTimeStr[1];
		$str_time .= $start_time_hour.":".$start_time_min." ".$start_time_am_pm;
	} else {
		$str_time .= "No Info";
	}
	$str_time .= " - ";
	if ($event["has_end_time"] == "y") {
		$endTimeStr = explode(":", $event["end_time"]);
		if (CLOCK_TYPE == '24') {
			$end_time_hour = $endTimeStr[0];
		} elseif (CLOCK_TYPE == '12') {
			if ($endTimeStr[0] > "12") {
				$end_time_hour = $endTimeStr[0] - 12;
				$end_time_am_pm = "pm";
			} elseif ($endTimeStr[0] == "12") {
				$end_time_hour = 12;
				$end_time_am_pm = "pm";
			} elseif ($endTimeStr[0] == "00") {
				$end_time_hour = 12;
				$end_time_am_pm = "am";
			} else {
				$end_time_hour = $endTimeStr[0];
				$end_time_am_pm = "am";
			}
		}
		if ($end_time_hour < 10) $end_time_hour = "0".($end_time_hour+0);
		$end_time_min = $endTimeStr[1];
		$str_time .= $end_time_hour.":".$end_time_min." ".$end_time_am_pm;
	} else {
		$str_time .= "No Info";
	}
	if (($event["has_start_time"] == "n") && ($event["has_end_time"] == "n")) {
		$str_time = "";
	}

?>

	<div class="itemView eventView">
		<h1><?=$event["title"]?></h1>
		<? if ($str_date) { ?>
			<p class="eventDateTime"><span class="bold"><?=system_showText(LANG_EVENT_WHEN);?>:</span> <?=$when?></p>
		<? } ?>
		<? if ($str_time) { ?>
			<p class="eventDateTime"><span class="bold"><?=system_showText(LANG_EVENT_TIME);?>:</span> <?=$str_time?></p>
		<? } ?>
		<? if ($event["address"] || $event["address2"] || $event["location_3"] || $event["location_4"] || $event["zip_code"]) { ?>
			<address class="event-address">
				<? if ($event["address"]) { ?>
					<span><?=$event["address"]?></span>
				<? } ?>
				<? if ($event["address2"]) { ?>
					<span><?=$event["address2"]?></span>
				<? } ?>
				<? if ($event["location_3"] || $event["location_4"] || $event["zip_code"]) { ?>
					<span>
						<?
						if ($event["location_4"]) echo $regionArray[$event["location_4"]];
						if ($event["location_3"] && $event["location_4"] ) echo ", ";
						if ($event["location_3"]) echo $stateArray[$event["location_3"]];
						if ($event["location_3"] || $event["location_4"] ) echo " ";
						if ($event["zip_code"]) echo $event["zip_code"];
						?>
					</span>
				<? } ?>
			</address>
		<? } ?>
		<? if ($event["phone"]) { ?>
			<p class="event-phone"><span class="bold"><?=system_showText(LANG_LISTING_LETTERPHONE);?>:</span> <?=$event["phone"]?></p>
		<? } ?>
		<? if ($event["description".$langIndex]) { ?>
			<p><?=$event["description".$langIndex]?></p>
		<? } ?>
	</div>
