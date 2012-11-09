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
	# * FILE: /includes/code/cronjobreport.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	setting_get("last_datetime_dailymaintenance", $last_datetime_dailymaintenance);
	setting_get("last_datetime_listingtraffic", $last_datetime_listingtraffic);
	setting_get("last_datetime_import", $last_datetime_import);
	setting_get("last_datetime_prepare_import", $last_datetime_prepare_import);
	setting_get("last_datetime_rollback_import", $last_datetime_rollback_import);
	setting_get("last_datetime_import_events", $last_datetime_import_events);
	setting_get("last_datetime_prepare_import_events", $last_datetime_prepare_import_events);
	setting_get("last_datetime_rollback_import_events", $last_datetime_rollback_import_events);
	setting_get("last_datetime_randomizer", $last_datetime_randomizer);
	setting_get("last_datetime_renewalreminder", $last_datetime_renewalreminder);
	setting_get("last_datetime_reportrollup", $last_datetime_reportrollup);
	setting_get("last_datetime_sitemap", $last_datetime_sitemap);
	setting_get("last_datetime_statisticreport", $last_datetime_statisticreport);
	setting_get("last_datetime_location_update", $last_datetime_location_update);
	?>

	<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
		<tr>
			<td width="60%"><strong><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_CRONJOB);?></strong></td>
			<td width="20%"><strong><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_PERIOD);?></strong></td>
			<td width="20%"><strong><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_UPDATED);?></strong></td>
		</tr>
		<tr>
			<td>Daily Maintenance</td>
			<td><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_DAILY);?></td>
			<? if (!$last_datetime_dailymaintenance || $last_datetime_dailymaintenance == "0000-00-00 00:00:00") { ?>
				<td> 00-00-0000 - 00:00:00 </td>
			<? } else { ?>
				<td><?=format_date($last_datetime_dailymaintenance, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($last_datetime_dailymaintenance);?></td>
			<? } ?>
		</tr>
		<tr>
			<td>Import - <?=system_showText(LANG_LISTING_FEATURE_NAME_PLURAL);?></td>
			<td><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_AUTOMATIC);?></td>
			<? if (!$last_datetime_import || $last_datetime_import == "0000-00-00 00:00:00") { ?>
				<td> 00-00-0000 - 00:00:00 </td>
			<? } else {?>
				<td><?=format_date($last_datetime_import, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($last_datetime_import);?></td>
			<? } ?>
		</tr>
		<tr>
			<td>Prepare Import - <?=system_showText(LANG_LISTING_FEATURE_NAME_PLURAL);?></td>
			<td><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_AUTOMATIC);?></td>
			<? if (!$last_datetime_prepare_import || $last_datetime_prepare_import == "0000-00-00 00:00:00") { ?>
				<td> 00-00-0000 - 00:00:00 </td>
			<? } else { ?>
				<td><?=format_date($last_datetime_prepare_import, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($last_datetime_prepare_import);?></td>
			<? } ?>
		</tr>
		<tr>
			<td>RollBack Import - <?=system_showText(LANG_LISTING_FEATURE_NAME_PLURAL);?></td>
			<td><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_AUTOMATIC);?></td>
			<? if (!$last_datetime_rollback_import || $last_datetime_rollback_import == "0000-00-00 00:00:00") { ?>
				<td> 00-00-0000 - 00:00:00 </td>
			<? } else { ?>
				<td><?=format_date($last_datetime_rollback_import, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($last_datetime_rollback_import);?></td>
			<? } ?>
		</tr>
		<tr>
			<td>Import - <?=system_showText(LANG_EVENT_FEATURE_NAME_PLURAL);?></td>
			<td><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_AUTOMATIC);?></td>
			<? if (!$last_datetime_import_events || $last_datetime_import_events == "0000-00-00 00:00:00") { ?>
				<td> 00-00-0000 - 00:00:00 </td>
			<? } else {?>
				<td><?=format_date($last_datetime_import_events, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($last_datetime_import_events);?></td>
			<? } ?>
		</tr>
		<tr>
			<td>Prepare Import - <?=system_showText(LANG_EVENT_FEATURE_NAME_PLURAL);?></td>
			<td><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_AUTOMATIC);?></td>
			<? if (!$last_datetime_prepare_import_events || $last_datetime_prepare_import_events == "0000-00-00 00:00:00") { ?>
				<td> 00-00-0000 - 00:00:00 </td>
			<? } else { ?>
				<td><?=format_date($last_datetime_prepare_import_events, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($last_datetime_prepare_import_events);?></td>
			<? } ?>
		</tr>
		<tr>
			<td>RollBack Import - <?=system_showText(LANG_EVENT_FEATURE_NAME_PLURAL);?></td>
			<td><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_AUTOMATIC);?></td>
			<? if (!$last_datetime_rollback_import_events || $last_datetime_rollback_import_events == "0000-00-00 00:00:00") { ?>
				<td> 00-00-0000 - 00:00:00 </td>
			<? } else { ?>
				<td><?=format_date($last_datetime_rollback_import_events, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($last_datetime_rollback_import_events);?></td>
			<? } ?>
		</tr>
		<tr>
			<td>Randomizer</td>
			<td>20 <?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_MINUTES);?></td>
			<? if (!$last_datetime_randomizer || $last_datetime_randomizer == "0000-00-00 00:00:00") { ?>
				<td> 00-00-0000 - 00:00:00 </td>
			<? } else { ?>
				<td><?=format_date($last_datetime_randomizer, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($last_datetime_randomizer);?></td>
			<? } ?>
		</tr>
		<tr>
			<td>Renewal Reminder</td>
			<td>20 <?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_MINUTES);?></td>
			<? if (!$last_datetime_renewalreminder || $last_datetime_renewalreminder == "0000-00-00 00:00:00") { ?>
				<td> 00-00-0000 - 00:00:00 </td>
			<? } else { ?>
				<td><?=format_date($last_datetime_renewalreminder, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($last_datetime_renewalreminder);?></td>
			<? } ?>
		</tr>
		<tr>
			<td>E-mail Traffic Reports</td>
			<td>20 <?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_MINUTES);?></td>
			<? if (!$last_datetime_listingtraffic || $last_datetime_listingtraffic == "0000-00-00 00:00:00") { ?>
				<td> 00-00-0000 - 00:00:00 </td>
			<? } else { ?>
				<td><?=format_date($last_datetime_listingtraffic, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($last_datetime_listingtraffic);?></td>
			<? } ?>
		</tr>
		<tr>
			<td>Report Rollup</td>
			<td><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_DAILY);?></td>
			<? if (!$last_datetime_reportrollup || $last_datetime_reportrollup == "0000-00-00 00:00:00") { ?>
				<td> 00-00-0000 - 00:00:00 </td>
			<? } else { ?>
				<td><?=format_date($last_datetime_reportrollup, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($last_datetime_reportrollup);?></td>
			<? } ?>
		</tr>
		<tr>
			<td>Sitemap</td>
			<td><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_DAILY);?></td>
			<? if (!$last_datetime_sitemap || $last_datetime_sitemap == "0000-00-00 00:00:00") { ?>
				<td> 00-00-0000 - 00:00:00 </td>
			<? } else { ?>
				<td><?=format_date($last_datetime_sitemap, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($last_datetime_sitemap);?></td>
			<? } ?>
		</tr>
		<tr>
			<td>Statistic Report</td>
			<td><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_DAILY);?></td>
			<? if (!$last_datetime_statisticreport || $last_datetime_statisticreport == "0000-00-00 00:00:00") { ?>
				<td> 00-00-0000 - 00:00:00 </td>
			<? } else { ?>
				<td><?=format_date($last_datetime_statisticreport, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($last_datetime_statisticreport);?></td>
			<? } ?>
		</tr>
		<tr>
			<td>Location Update</td>
			<td><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_AUTOMATIC);?></td>
			<? if (!$last_datetime_location_update || $last_datetime_location_update == "0000-00-00 00:00:00") { ?>
				<td> 00-00-0000 - 00:00:00 </td>
			<? } else { ?>
				<td><?=format_date($last_datetime_location_update, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($last_datetime_location_update);?></td>
			<? } ?>
		</tr>
		<tr>
			<td colspan="3"><strong><?=system_showText(LANG_SITEMGR_CRONJOBREPORT_LABEL_CURRENTSYSTEMTIME).": ".format_date(date("Y-m-d"), DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString(date("Y-m-d H:i:s"));?></strong></td>
		</tr>
	</table>
