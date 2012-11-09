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
	# * FILE: /event/featured.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on" || CUSTOM_EVENT_FEATURE != "on") { exit; }
	
	// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedEvent2-->
	<?

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$numberOfEvents = 24; //FEATURED_EVENT_MAXITEMS;
	$lastItemStyle = 0;
	$specialItem = 24; //FEATURED_EVENT_MAXITEMS_SPECIAL;

	$level = implode(",", system_getLevelDetail("EventLevel"));

    if ($level) {
		unset($searchReturn);
		$searchReturn = search_frontEventSearch($_GET, "random");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." (Event.level IN (".$level.")) ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ORDER BY `random_number` LIMIT ".$numberOfEvents."";
		$highlight_events = db_getFromDBBySQL("event", $sql);
	}

	if ($highlight_events) {
		$top_featured_event = "";
		$featured_event = "";
		?>
		
		<h2>
			<span><?=system_showText(LANG_EVENT_FEATURED)?></span>
			<?
			if (EVENT_SCALABILITY_OPTIMIZATION != "on"){
				$seeAllText = system_showText(LANG_LABEL_VIEW_ALL_EVENTS);
				$seeAllTextLink = (MODREWRITE_FEATURE == "on" ? EVENT_DEFAULT_URL."/search/empty/where/empty" : EVENT_DEFAULT_URL."/results.php"); ?>
			
				
			<? } ?>
		</h2>
		
		<div class="featured featured-event">

			<?
			$user = true;
			$count = 0;
			$ids_report_lote = "";
			foreach ($highlight_events as $event) {
				
				$ids_report_lote .= $event->getString("id").",";

				if (MODREWRITE_FEATURE == "on") {
					$detailLink = "".EVENT_DEFAULT_URL."/".$event->getString("friendly_url").".html";
				} else {
					$detailLink = "".EVENT_DEFAULT_URL."/detail.php?id=".$event->getNumber("id")."";
				}

				$lastItemStyle++;
			
				if($countSpecialItem < $specialItem){
					
					if($countSpecialItem == 0){
						echo "<div class=\"left\" style = \"width: 690px;\">";
					}
					
					/* if(($lastItemStyle % 2) && ($lastItemStyle != 1) && !ITEM_RESULTS_CLEAR){
						echo "<br class=\"clear\" />";
					} */

					echo "<div class=\"featured-item featured-item-special\" style = \"clear: none; width:150px; height:200px;margin-right:1px;\">";
					
					
					echo "<div class=\"image\">";
					$imageObj = new Image($event->getNumber("thumb_id"));
					if ($imageObj->imageExists()) {
						echo "<a href=\"".$detailLink."\" class=\"image\">";
						echo $imageObj->getTag(true, IMAGE_FRONT_EVENT_WIDTH, IMAGE_FRONT_EVENT_HEIGHT, $event->getString("title"), true);
						echo "</a>";
					} else {
						echo "<a href=\"".$detailLink."\" class=\"image\">";
						echo "<span class=\"no-image\"></span>";
						echo "</a>";
					}
					echo "</div>";
					
					$str_date = $event->getDateString(true);
					$str_recurring = $event->getDateStringRecurring();
					
					echo "<div class=\"date\">";
					
						if($event->checkStartDate()){
							$str_monthAbbr = $event->getMonthAbbr();
							$str_day = $event->getDayStr();
							echo "<div class=\"calendar\">";
								echo "<span class=\"month\">$str_monthAbbr</span>";
								echo "<span class=\"day\">$str_day</span>";
							echo "</div>";
						}
						
						echo ($event->getString("recurring") != "Y" ? $str_date : "<p class=\"recurring\">".system_showTruncatedText($str_recurring, 45)."</p>");
					echo "</div>";
					
					echo "<h3><a href=\"".$detailLink."\">".$event->getString("title")."</a></h3>";
					
                    if(EVENT_SCALABILITY_OPTIMIZATION == "on"){
                        $event_moreInfo = "<a href=\"javascript: void(0);\" onclick=\"showCategory(".htmlspecialchars($event->getNumber("id")).", 'event', ".(true).", ".$event->getNumber("account_id").", ".(true).");\" \>".system_showText(LANG_VIEWCATEGORY)."</a>";
                        echo "<p id=\"showCategory_event".$event->getNumber("id")."\">$event_moreInfo</p>";

                    } else {
                        echo "<p>";
                        echo system_itemRelatedCategories($event->getNumber("id"), "event", true);
                        $name = socialnetwork_writeLink($event->getNumber("account_id"), "profile", "general_see_profile");
                        if ($name) {
                            echo " ".system_showText(LANG_BY)." ".$name;
                        }
                        echo "</p>";
                    }
					
					echo "</div>";
                    
                    if(!(($lastItemStyle-3)%3) && ITEM_RESULTS_CLEAR){
                        echo "<br class=\"clear\" />";
                    }
			
					if($countSpecialItem == ($specialItem-1) || (count($highlight_events) == $countSpecialItem +1)){
						echo "</div>";
					}
					
					$countSpecialItem++;

				} else {

					if($lastItemStyle == $numberOfEvents){
						$itemStyle = "last";
					}elseif($lastItemStyle == ($specialItem+1)){
						$itemStyle = "first";
					}else{
						$itemStyle = "";
					}
				
					echo "<div class=\"featured-item ".$itemStyle."\">";

					echo "<h3><a href=\"".$detailLink."\">".$event->getString("title", true)."</a></h3>";

					$str_date = $event->getDateString();
					$str_recurring = $event->getDateStringRecurring();
					
					echo "<p>".($event->getString("recurring") != "Y" ? $str_date : $str_recurring)."</p>";
                    
                    if(EVENT_SCALABILITY_OPTIMIZATION == "on"){
                        $event_moreInfo = "<a href=\"javascript: void(0);\" onclick=\"showCategory(".htmlspecialchars($event->getNumber("id")).", 'event', ".(true).", ".$event->getNumber("account_id").", ".(true).");\" \>".system_showText(LANG_VIEWCATEGORY)."</a>";
                        echo "<p id=\"showCategory_event".$event->getNumber("id")."\">$event_moreInfo</p>";
                    } else {
                        echo "<p>";
                        echo system_itemRelatedCategories($event->getNumber("id"), "event", true);
                        $name = socialnetwork_writeLink($event->getNumber("account_id"), "profile", "general_see_profile");
                        if ($name) {
                            echo " ".system_showText(LANG_BY)." ".$name;
                        }
                        echo "</p>";
                    }
					

					echo "</div>";
				}
			}
			$ids_report_lote = string_substr($ids_report_lote, 0, -1);
			report_newRecord("event", $ids_report_lote, EVENT_REPORT_SUMMARY_VIEW, true);
			echo "</div>";
			?> <h2><a class="view-more" href="<?=$seeAllTextLink?>"><?="VIEW ALL EVENTS. . .";?></a></h2> <?
		} 

// Preparing markers to full cache
?>
	<!--cachemarkerFeaturedEvent2-->
