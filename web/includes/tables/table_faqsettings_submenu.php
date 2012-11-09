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
	# * FILE: /includes/tables/table_faqsettings_submenu.php
	# ----------------------------------------------------------------------------------------------------

	$openPMhome = string_strpos($_SERVER["PHP_SELF"], "prefs/faq.php");
	$openPMadd = string_strpos($_SERVER["PHP_SELF"], "prefs/faqadd");
?>

<div class="submenu">
	<ul>
		<li id="privateMenu_home"><a href="<?=DEFAULT_URL?>/sitemgr/prefs/faq.php"><?=system_showText(LANG_SITEMGR_MANAGE)?></a></li>
		<li id="privateMenu_faq"><a href="<?=DEFAULT_URL?>/sitemgr/prefs/faqadd.php"><?=system_showText(LANG_SITEMGR_MENU_ADD)?></a></li>
	</ul>
</div>
<br clear="all" style="height:0; line-height:0">

<? if ($openPMhome) { ?> <script type="text/javascript"> addClass('home') </script><? } ?>
<? if ($openPMadd) { ?> <script type="text/javascript"> addClass('faq') </script><? } ?>
