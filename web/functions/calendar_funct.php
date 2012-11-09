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
	# * FILE: /functions/calendar_funct.php
	# ----------------------------------------------------------------------------------------------------

	function cal_display_month($property_id = false, $this_date=false, $hilight="Y", $next_links="Y", $price_type="week", $link_all_days=false) {

		if (empty($this_date)) $this_date = date("Ymd"); 

		/////////////////////////////
		//build legend
		$bookedcolor = "#AAAAAA";
		$availablecolor = "#a8f3a5";

		///////////////////////////////////////////////
		
		echo "<div class=\"calendar\">";
		
			echo "<h2>".system_showText(LANG_BROWSEEVENTSBYDATE)."</h2>";

			for ($monthCount=0;$monthCount<1;$monthCount++){
				if ($next_date != "") {
					$this_date = $next_date;
				}
				# THIS MONTH
				$this_year = date("Y",strtotime($this_date));
				$this_month = date("m",strtotime($this_date));
				$this_day = date("d",strtotime($this_date));
				$this_month_txt = system_showDate("F",strtotime($this_date));
				if ($hilight=="N") { $this_day = ""; }
				# LAST MONTH
				$last_date = date("Ymd",mktime(0,0,0,(int)$this_month-1,1,(int)$this_year));
				# NEXT MONTH
				$next_date = date("Ymd",mktime(0,0,0,(int)$this_month+1,1,(int)$this_year));
				$fotm = mktime(0,0,0,(int)$this_month,1,(int)$this_year);
				$this_ndays = date("t",$fotm);
				$this_fdow  = date("w",$fotm);
				$this_month_txt = system_showDate("F",$fotm);
				$this_date = sprintf("%04s%02s%02s",$this_year,$this_month,1);
	
				echo "<table class=\"table-calendar\" border=\"0\" cellspacing=\"4\" cellpadding=\"0\" width=\"100%\"><tr>";

					# MONTH-YEAR HEADER
					echo "<td colspan=\"7\" class=\"pd-0\">";
						echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" class=\"calendar-header\"><tr>";
							echo "<th align=\"left\">";
							if (($next_links == "Y" || $next_links == "L") && $monthCount==0 ) {
								if (MODREWRITE_FEATURE == "on"){
									echo "<a class=\"calendar-button left\" href=\"".EVENT_DEFAULT_URL."/search/month/".string_substr($last_date,0,6)."/this_date/$last_date\"></a>";
								}else{
									echo "<a class=\"calendar-button left\" href=\"".EVENT_DEFAULT_URL."/results.php?month=".string_substr($last_date,0,6)."&amp;this_date=$last_date\"></a>";
								}
							} else {
								echo "&nbsp;&nbsp;&nbsp;&nbsp;";
							}
							echo "</th>";
							echo "<th>";
							if (MODREWRITE_FEATURE == "on"){
								echo "<a href=\"".EVENT_DEFAULT_URL."/search/month/$this_year$this_month/this_date/$this_date\">$this_month_txt $this_year</a></th>";
							} else {
								echo "<a href=\"".EVENT_DEFAULT_URL."/results.php?month=$this_year$this_month&amp;this_date=$this_date\">$this_month_txt $this_year</a></th>";
							}
							if (($next_links == "Y")) {
								if (MODREWRITE_FEATURE == "on"){
									echo "<th align=\"right\"><a class=\"calendar-button right\" href=\"".EVENT_DEFAULT_URL."/search/month/".string_substr($next_date,0,6)."/this_date/$next_date\"></a>";
								} else {
									echo "<th align=\"right\"><a class=\"calendar-button right\" href=\"".EVENT_DEFAULT_URL."/results.php?month=".string_substr($next_date,0,6)."&amp;this_date=$next_date\"></a>";
								}
							} else {
								echo "&nbsp;&nbsp;&nbsp;&nbsp;";
							}
							echo "</th>";
							echo "</tr></table>";

						echo "</td>";
					echo "</tr>";

					# WEEKDAY HEADERS
					$weekdays_list = explode(",", LANG_DATE_WEEKDAYS);
					echo "<tr>";
						for ($i=0;$i<count($weekdays_list);$i++) {
							echo "<th class=\"calendar-weekday\">".string_ucwords(string_substr($weekdays_list[$i], 0, 1))."</th>";
						}
					echo "</tr>";
	
				# DAYS OF MONTH
				echo "<tr>";
				for($this_dow=0; $this_dow<$this_fdow; $this_dow++) { echo "<td>&nbsp;</td>"; }
				for($i=1; $i<=$this_ndays; $i++) {
	
					$i = sprintf("%02s",$i);
					$this_date = sprintf("%04s%02s%02s",$this_year,$this_month,$i);
					if (++$this_dow == "8") {
						$this_dow = "1";
						echo "</tr><tr>";
					}
	
					/////////////////
					//AVAILABILITY change cell color
	
					$this_date_timestamp = strtotime($this_date);
	
					//first reset availability flag
					if ($this_date_timestamp == $a_end_date ){
						if ($row = mysql_fetch_row($a_rs)){;
							$a_start_date = strtotime($row[0]);
							$a_end_date = strtotime($row[1]);
							$a_available = $row[2];  
						}
					}
	
					echo "<td align=\"center\" width=\"22\" class=\"calendar-day\">";
	
					$new_date = $this_date;
	
					$current_year = date("Y");
					$current_month = date("m");
					$current_day = date("d");
					$current_month_txt = system_showDate("F");
	
					$current_yyyy_mm = $current_year.$current_month;
					$current_yyyy_mm_dd = $current_year.$current_month.$current_day;
	
						//not a check in day
						if (($_GET["this_date"]) && ($_GET["this_date"] == $this_date) && (!$_GET["month"]) && ($_GET["search_by_day"])) {
	
							$date_style = $i;
							$day_class = "selected";
	
						} elseif ((($_GET["month"] == $current_yyyy_mm) && ($current_yyyy_mm_dd == $this_date)) || (($current_yyyy_mm_dd == $this_date) && (!$_GET["month"]))) {
							$date_style = $i;
							$day_class = "today";
						} else {
							$date_style = $i;
							$day_class = "normal";
						}
	
						echo "<a href=\"javascript:set_cal_date('".$this_date."')\" class=\"$day_class\">".$date_style."</a>";
	
					echo "</td>";
				}
				for($i=$this_dow;$i<7;$i++) { echo "<td>&nbsp;</td>"; }
				echo "</tr></table>\n";
			}
		echo "</div>";

	}



	function cal_display_event_month($property_id = false, $this_date=false, $hilight="Y", $next_links="Y", $price_type="week", $link_all_days=false) {

		if (empty($this_date)) $this_date = date("Ymd"); 

		/////////////////////////////
		//build legend
		$bookedcolor = "#AAAAAA";
		$availablecolor = "#a8f3a5";

		///////////////////////////////////////////////
		
		echo "<div class=\"calendar\">";
		
			echo "<h2>".system_showText(LANG_BROWSEEVENTSBYDATE)."</h2>";

			for ($monthCount=0;$monthCount<1;$monthCount++){
				if ($next_date != "") {
					$this_date = $next_date;
				}
				# THIS MONTH
				$this_year = date("Y",strtotime($this_date));
				$this_month = date("m",strtotime($this_date));
				$this_day = date("d",strtotime($this_date));
				$this_month_txt = system_showDate("F",strtotime($this_date));
				if ($hilight=="N") { $this_day = ""; }
				# LAST MONTH
				$last_date = date("Ymd",mktime(0,0,0,(int)$this_month-1,1,(int)$this_year));
				# NEXT MONTH
				$next_date = date("Ymd",mktime(0,0,0,(int)$this_month+1,1,(int)$this_year));
				$fotm = mktime(0,0,0,(int)$this_month,1,(int)$this_year);
				$this_ndays = date("t",$fotm);
				$this_fdow  = date("w",$fotm);
				$this_month_txt = system_showDate("F",$fotm);
				$this_date = sprintf("%04s%02s%02s",$this_year,$this_month,1);
	
				echo "<table class=\"table-calendar\" border=\"0\" cellspacing=\"4\" cellpadding=\"0\" width=\"100%\"><tr>";

					# MONTH-YEAR HEADER
					echo "<td colspan=\"7\" class=\"pd-0\">";
						echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" class=\"calendar-header\"><tr>";
							echo "<th align=\"left\">";
							if (($next_links == "Y" || $next_links == "L") && $monthCount==0 ) {
								if (MODREWRITE_FEATURE == "on"){
									echo "<a class=\"calendar-button left\" href=\"".EVENT_DEFAULT_URL."/search/month/".string_substr($last_date,0,6)."/this_date/$last_date\"></a>";
								}else{
									echo "<a class=\"calendar-button left\" href=\"".EVENT_DEFAULT_URL."/results.php?month=".string_substr($last_date,0,6)."&amp;this_date=$last_date\"></a>";
								}
							} else {
								echo "&nbsp;&nbsp;&nbsp;&nbsp;";
							}
							echo "</th>";
							echo "<th>";
							if (MODREWRITE_FEATURE == "on"){
								echo "<a href=\"".EVENT_DEFAULT_URL."/search/month/$this_year$this_month/this_date/$this_date\">$this_month_txt $this_year</a></th>";
							} else {
								echo "<a href=\"".EVENT_DEFAULT_URL."/results.php?month=$this_year$this_month&amp;this_date=$this_date\">$this_month_txt $this_year</a></th>";
							}
							if (($next_links == "Y")) {
								if (MODREWRITE_FEATURE == "on"){
									echo "<th align=\"right\"><a class=\"calendar-button right\" href=\"".EVENT_DEFAULT_URL."/search/month/".string_substr($next_date,0,6)."/this_date/$next_date\"></a>";
								} else {
									echo "<th align=\"right\"><a class=\"calendar-button right\" href=\"".EVENT_DEFAULT_URL."/results.php?month=".string_substr($next_date,0,6)."&amp;this_date=$next_date\"></a>";
								}
							} else {
								echo "&nbsp;&nbsp;&nbsp;&nbsp;";
							}
							echo "</th>";
							echo "</tr></table>";

						echo "</td>";
					echo "</tr>";

					# WEEKDAY HEADERS
					$weekdays_list = explode(",", LANG_DATE_WEEKDAYS);
					echo "<tr>";
						for ($i=0;$i<count($weekdays_list);$i++) {
							echo "<th class=\"calendar-weekday\">".string_ucwords(string_substr($weekdays_list[$i], 0, 1))."</th>";
						}
					echo "</tr>";
	
				# DAYS OF MONTH
				echo "<tr>";
				for($this_dow=0; $this_dow<$this_fdow; $this_dow++) { echo "<td>&nbsp;</td>"; }
				for($i=1; $i<=$this_ndays; $i++) {
	
					$i = sprintf("%02s",$i);
					$this_date = sprintf("%04s%02s%02s",$this_year,$this_month,$i);
					if (++$this_dow == "8") {
						$this_dow = "1";
						echo "</tr><tr>";
					}
	
					/////////////////
					//AVAILABILITY change cell color
	
					$this_date_timestamp = strtotime($this_date);
	
					//first reset availability flag
					if ($this_date_timestamp == $a_end_date ){
						if ($row = mysql_fetch_row($a_rs)){;
							$a_start_date = strtotime($row[0]);
							$a_end_date = strtotime($row[1]);
							$a_available = $row[2];  
						}
					}
	
					echo "<td align=\"center\" width=\"22\" class=\"calendar-day\">";
	
					$new_date = $this_date;
	
					$current_year = date("Y");
					$current_month = date("m");
					$current_day = date("d");
					$current_month_txt = system_showDate("F");
	
					$current_yyyy_mm = $current_year.$current_month;
					$current_yyyy_mm_dd = $current_year.$current_month.$current_day;
	
						//not a check in day
						if (($_GET["this_date"]) && ($_GET["this_date"] == $this_date) && (!$_GET["month"]) && ($_GET["search_by_day"])) {
	
							$date_style = $i;
							$day_class = "selected";
	
						} elseif ((($_GET["month"] == $current_yyyy_mm) && ($current_yyyy_mm_dd == $this_date)) || (($current_yyyy_mm_dd == $this_date) && (!$_GET["month"]))) {
							$date_style = $i;
							$day_class = "today";
						} else {
							$date_style = $i;
							$day_class = "normal";
						}
						$dbObj = db_getDBObject();
						$sql = "SELECT start_date, end_Date, until_Date FROM `Event` WHERE Event.status = 'A' AND ((Event.end_date >= DATE_FORMAT(NOW(), '%Y-%m-%d') OR Event.until_date >= DATE_FORMAT(NOW(), '%Y-%m-%d') AND repeat_event = 'N') OR (repeat_event = 'Y'))";
						$resultdates = $dbObj->query($sql);
						if ($resultdates) {
							while($row = mysql_fetch_assoc($resultdates)) {
								if ( $this_date >= str_replace("-","",$row['start_date']) && $this_date <= str_replace("-","",$row['end_Date']) ) {
									$date_style = $i;
									$day_class = "eventday";
								}								
							}
						}					
						unset($dbCatObj);
						echo "<a href=\"javascript:set_cal_date('".$this_date."')\" class=\"$day_class\">".$date_style."</a>";
	
					echo "</td>";
				}
				for($i=$this_dow;$i<7;$i++) { echo "<td>&nbsp;</td>"; }
				echo "</tr></table>\n";
			}
		echo "</div>";

	}

	
?>
