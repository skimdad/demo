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
	# * FILE: /includes/tables/table_googleprefs_submenu.php
	# ----------------------------------------------------------------------------------------------------

?>

<div class="submenu">
	<ul>
		<? if (GOOGLE_MAPS_ENABLED == "on") { ?>
			<? $has_menu_item = true; ?>
			<li id="privateMenu_maps"><a href="<?=DEFAULT_URL?>/sitemgr/googleprefs/googlemaps.php"><?=string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_GOOGLEMAPS))?></a></li>
		<? } ?>
		<? if (GOOGLE_ADS_ENABLED == "on") { ?>
			<li id="privateMenu_ads"><a href="<?=DEFAULT_URL?>/sitemgr/googleprefs/googleads.php"><?=string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_GOOGLEADS))?></a></li>
		<? } ?>		
		<? if (GOOGLE_ANALYTICS_ENABLED == "on") { ?>
			<? $has_menu_item = true; ?>
			<li id="privateMenu_analytics"><a href="<?=DEFAULT_URL?>/sitemgr/googleprefs/googleanalytics.php"><?=string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_GOOGLEANALYTICS))?></a></li>
		<? } ?>
	</ul>
</div>
<br clear="all" style="height:0; line-height:0">
<?
$openPMmaps = string_strpos($_SERVER["PHP_SELF"], "maps");
$openPMads = string_strpos($_SERVER["PHP_SELF"], "ads");
$openPManalytics = string_strpos($_SERVER["PHP_SELF"], "analytics");
?>

<? if ($openPMmaps) { ?> <script type="text/javascript"> addClass('maps') </script><? } ?>
<? if ($openPMads) { ?> <script type="text/javascript"> addClass('ads') </script><? } ?>
<? if ($openPManalytics) { ?> <script type="text/javascript"> addClass('analytics') </script><? } ?>
