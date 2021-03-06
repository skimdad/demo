<?php

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
	# * FILE: /includes/views/view_calendar.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

?>

<html>

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />

		<title><?=system_showText(LANG_LABEL_SELECTDATE);?></title>

		<script language="JavaScript">

			// months as they appear in the calendar's title
			var ARR_MONTHS = [
			<?
			$monthsArray = explode(",", LANG_DATE_MONTHS);
			for ($i=0; $i<count($monthsArray); $i++) {
				$monthsArray[$i] = string_ucwords($monthsArray[$i]);
			}
			echo "\"".implode("\", \"", $monthsArray)."\"";
			?>
			];
			// week day titles as they appear on the calendar
			var ARR_WEEKDAYS = [
			<?
			$weekdaysArray = explode(",", LANG_DATE_WEEKDAYS);
			for ($i=0; $i<count($weekdaysArray); $i++) {
				$weekdaysArray[$i] = string_substr(string_ucwords($weekdaysArray[$i]), 0, 1);
			}
			echo "\"".implode("\", \"", $weekdaysArray)."\"";
			?>
			];
			// day week starts from (normally 0-Su or 1-Mo)
			var NUM_WEEKSTART = 0;
			// path to the directory where calendar images are stored. trailing slash req.
			var STR_ICONPATH = '../../images/calendar/';

			var re_url = new RegExp('datetime=(\\-?\\d+)');
			var dt_current = (re_url.exec(String(window.location)) ? new Date(new Number(RegExp.$1)) : new Date());
			var re_id = new RegExp('id=(\\d+)');
			var num_id = (re_id.exec(String(window.location)) ? new Number(RegExp.$1) : 0);
			var obj_caller = (window.opener ? window.opener.calendars[num_id] : null);

			if (obj_caller && obj_caller.year_scroll) {
				// get same date in the previous year
				var dt_prev_year = new Date(dt_current);
				dt_prev_year.setFullYear(dt_prev_year.getFullYear() - 1);
				if (dt_prev_year.getDate() != dt_current.getDate()) {
					dt_prev_year.setDate(0);
				}
				// get same date in the next year
				var dt_next_year = new Date(dt_current);
				dt_next_year.setFullYear(dt_next_year.getFullYear() + 1);
				if (dt_next_year.getDate() != dt_current.getDate()) {
					dt_next_year.setDate(0);
				}
			}

			// get same date in the previous month
			var dt_prev_month = new Date(dt_current);
			dt_prev_month.setMonth(dt_prev_month.getMonth() - 1);
			if (dt_prev_month.getDate() != dt_current.getDate()) {
				dt_prev_month.setDate(0);
			}

			// get same date in the next month
			var dt_next_month = new Date(dt_current);
			dt_next_month.setMonth(dt_next_month.getMonth() + 1);
			if (dt_next_month.getDate() != dt_current.getDate()) {
				dt_next_month.setDate(0);
			}

			// get first day to display in the grid for current month
			var dt_firstday = new Date(dt_current);
			dt_firstday.setDate(1);
			dt_firstday.setDate(1 - (7 + dt_firstday.getDay() - NUM_WEEKSTART) % 7);

			// function passing selected date to calling window
			function set_datetime(n_datetime, b_close) {

				if (!obj_caller) return;

				var dt_datetime = obj_caller.prs_time(
					(document.cal ? document.cal.time.value : ''),
					new Date(n_datetime)
				);

				if (!dt_datetime) return;
				if (b_close) {
					window.close();
					obj_caller.target.value = (document.cal
						? obj_caller.gen_tsmp(dt_datetime)
						: obj_caller.gen_date(dt_datetime)
					);
				}
				else obj_caller.popup(dt_datetime.valueOf());

			}

		</script>

		<style type="text/css" media="all">

			body, html { margin: 0; padding: 0; }

			table.baseCalendar { width: 100%; font: normal 11px/25px Verdana, Arial, Helvetica, sans-serif; }

				table.baseCalendar table { font-size: 11px; text-align: center; vertical-align: middle; }

				table.baseCalendar table.baseCalendarHeader { background: #EEE; font: normal 10px Verdana, Arial, Helvetica, sans-serif; }

					table.baseCalendar table.baseCalendarHeader th { width: 100%; text-align: center; font-size: 11px; }

					.baseCaledarWeekDays { color: #FFF; height: 25px; background: #6699CC; }

					.currentDay { background: #F0F7FF; border: 1px solid #D5E9FF; }

					.weekendDay { background: #F5F5F5; }

		</style>

	</head>

	<body>

		<table class="baseCalendar" cellspacing="0" border="0">
			<tr>
				<td>

					<table cellspacing="0" cellpadding="2" border="0" width="100%">
						<tr>
							<td colspan="7">
								<table cellspacing="0" cellpadding="0" border="0" width="100%" class="baseCalendarHeader">
									<tr>
										<script language="JavaScript">
											document.write('<td style=padding:5px;>' + (obj_caller&&obj_caller.year_scroll ? '<a href="javascript:set_datetime(' + dt_prev_year.valueOf() + ')"><img src="' + STR_ICONPATH + 'prev_year.gif" border="0" alt="previous year" title="previous year" /></a>&nbsp;' : '') + '<a href="javascript:set_datetime(' + dt_prev_month.valueOf() + ')"><img src="' + STR_ICONPATH + 'prev.gif" border="0" alt="previous month" title="previous month" /></a></td>' + '<th>' + ARR_MONTHS[dt_current.getMonth()] + ' ' + dt_current.getFullYear() + '</th>' + '<td><a href="javascript:set_datetime(' + dt_next_month.valueOf() + ')"><img src="' + STR_ICONPATH + 'next.gif" border="0" alt="next month" title="next month" /></a>' + (obj_caller && obj_caller.year_scroll ? '&nbsp;<a href="javascript:set_datetime(' + dt_next_year.valueOf() + ')"><img src="' + STR_ICONPATH + 'next_year.gif" border="0" alt="next year" title="next year" /></a>' : '') + '</td>');
										</script>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<script language="JavaScript">
								// print weekdays titles
								for (var n=0; n<7; n++) {
									document.write('<td class="baseCaledarWeekDays">'+ARR_WEEKDAYS[(NUM_WEEKSTART+n)%7]+'</td>');
								}
								document.write('</tr>');
								// print calendar table
								var dt_current_day = new Date(dt_firstday);
								while (dt_current_day.getMonth() == dt_current.getMonth() || dt_current_day.getMonth() == dt_firstday.getMonth()) {
									// print row heder
									document.write('<tr>');
									for (var n_current_wday=0; n_current_wday<7; n_current_wday++) {
										if (dt_current_day.getDate() == dt_current.getDate() && dt_current_day.getMonth() == dt_current.getMonth()) {
											// print current date
											document.write('<td class="currentDay">');
										} else if (dt_current_day.getDay() == 0 || dt_current_day.getDay() == 6) {
											// weekend days
											document.write('<td class="weekendDay">');
										} else {
											// print working days of current month
											document.write('<td bgcolor="#ffffff" align="center" width="14%">');
										}
										document.write('<a href="javascript:set_datetime('+dt_current_day.valueOf() +', true);">');
										if (dt_current_day.getMonth() == this.dt_current.getMonth()) {
											// print days of current month
											document.write('<font color="#000000">');
										} else {
											// print days of other months
											document.write('<font color="#606060">');
										}
										document.write(dt_current_day.getDate()+'</font></a></td>');
										dt_current_day.setDate(dt_current_day.getDate()+1);
									}
									// print row footer
									document.write('</tr>');
								}
								if (obj_caller && obj_caller.time_comp) {
									document.write('<form onsubmit="javascript:set_datetime('+dt_current.valueOf()+', true)" name="cal"><tr><td colspan="7" bgcolor="#FBAC20"><font color="White" face="tahoma, verdana" size="2">Time: <input type="text" name="time" value="'+obj_caller.gen_time(this.dt_current)+'" size="8" maxlength="8" /></font></td></tr></form>');
								}
							</script>
						</tr>
					</table>

				</td>
			</tr>
		</table>

	</body>

</html>
