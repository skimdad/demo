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
	# * FILE: /frontend/featured_event.php
	# ----------------------------------------------------------------------------------------------------
	?>
	<!--cachemarkerFeaturedEvent-->
	<?
	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$numberOfEvents = 12;
	$lastItemStyle = 0;

	$level = implode(",", system_getLevelDetail("EventLevel"));

	if ($level) {
		unset($searchReturn);
		$searchReturn = search_frontEventSearch($_GET, "random");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." (Event.level IN (".$level.")) ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ORDER BY `random_number` LIMIT ".$numberOfEvents."";
		$array_events = db_getFromDBBySQL("event", $sql);
	}

	if ($array_events) {
		$seeAllText = system_showText(LANG_LABEL_VIEW_ALL_EVENTS);
	
		?>
		
		<h2>
			<span><?=system_showText(LANG_UPCOMING_EVENT);?></span>
		</h2>
			
		<?
	
		echo "<div class=\"featured featured-event\">";
	
			$ids_report_lote = "";
		
			foreach ($array_events as $event) {
				
				$lastItemStyle++;
				
				$ids_report_lote .= $event->getString("id").",";
	
				if (MODREWRITE_FEATURE == "on") {
					$detailLink = "".EVENT_DEFAULT_URL."/".$event->getString("friendly_url").".html";
				} else {
					$detailLink = "".EVENT_DEFAULT_URL."/detail.php?id=".$event->getNumber("id")."";
				}
									
				echo "<div class=\"featured-item ".(($lastItemStyle==$numberOfEvents) ? ("pd-0") : (""))."\">";
					
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
	
			}
			$ids_report_lote = string_substr($ids_report_lote, 0, -1);
			report_newRecord("event", $ids_report_lote, EVENT_REPORT_SUMMARY_VIEW, true);
	
		echo '</div><h2><a class="view-more" href="'.EVENT_DEFAULT_URL.'">'.$seeAllText.'</a></h2>';

	}

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	}

?>
<!--cachemarkerFeaturedEvent-->
