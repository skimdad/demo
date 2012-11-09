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
	# * FILE: /includes/code/google_analytics.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# * DEFINES
	# ----------------------------------------------------------------------------------------------------
	$googleSettingObj = new GoogleSettings(GOOGLE_ANALYTICS_SETTING);

	if ($google_analytics_page == "front")       $setting_id = GOOGLE_ANALYTICS_FRONT_SETTING;
	elseif ($google_analytics_page == "members") $setting_id = GOOGLE_ANALYTICS_MEMBERS_SETTING;
	elseif ($google_analytics_page == "sitemgr") $setting_id = GOOGLE_ANALYTICS_SITEMGR_SETTING;

	$googleAnalyticsSettingObj = new GoogleSettings($setting_id);

	if ($googleAnalyticsSettingObj->getString("value") == "on" && $googleSettingObj->getString("value")) {
		?>
		<script type="text/javascript">
			var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
			document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
			try {
				var pageTracker = _gat._getTracker("<?=$googleSettingObj->getString("value")?>");
				pageTracker._initData();
				pageTracker._trackPageview();
			} catch(err) {}	
		</script>
		<?
	}

?>
