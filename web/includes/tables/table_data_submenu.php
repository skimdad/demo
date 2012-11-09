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
	# * FILE: /includes/tables/table_data_submenu.php
	# ----------------------------------------------------------------------------------------------------

?>

<div class="submenu">
	<ul>
		<li id="privateMenu_home"><a href="<?=DEFAULT_URL?>/sitemgr/import/index.php"><?=string_ucwords(system_showText(LANG_SITEMGR_MENU_IMPORTHOME))?></a></li>
		<li id="privateMenu_log"><a href="<?=DEFAULT_URL?>/sitemgr/import/importlog.php"><?=system_showText(LANG_SITEMGR_IMPORT_IMPORTLOG)?></a></li>
		<li id="privateMenu_settings"><a href="<?=DEFAULT_URL?>/sitemgr/import/settings.php"><?=system_showText(LANG_SITEMGR_IMPORT_IMPORTSETTINGS)?></a></li>
		<li id="privateMenu_export"><a href="<?=DEFAULT_URL?>/sitemgr/export/index.php"><?=ucfirst(system_showText(LANG_SITEMGR_EXPORT))?></a></li>
		<li id="privateMenu_payment"><a href="<?=DEFAULT_URL?>/sitemgr/export/payment.php"><?=system_showText(LANG_SITEMGR_MENU_EXPORTPAYMENTRECORDS)?></a></li>
	</ul>
</div>
<br /><br clear="all" style="height: 0; line-height: 0;">
<?
$openPMhome = string_strpos($_SERVER["PHP_SELF"], "import/index.php");
$openPMlog = (string_strpos($_SERVER["PHP_SELF"], "importlog.php") || string_strpos($_SERVER["PHP_SELF"], "import/delete.php") || string_strpos($_SERVER["PHP_SELF"], "import/stop.php") || string_strpos($_SERVER["PHP_SELF"], "import/rollback.php"));
$openPMsettings = string_strpos($_SERVER["PHP_SELF"], "settings.php");
$openPMexport = (string_strpos($_SERVER["PHP_SELF"], "export/index.php") || string_strpos($_SERVER["PHP_SELF"], "export/listingexport.php") || string_strpos($_SERVER["PHP_SELF"], "export/eventexport.php") || string_strpos($_SERVER["PHP_SELF"], "export/emailgenerate.php"));
$openPMpayment = string_strpos($_SERVER["PHP_SELF"], "export/payment.php");
?>
<? if ($openPMhome) { ?> <script type="text/javascript"> addClass('home') </script><? } ?>
<? if ($openPMlog) { ?> <script type="text/javascript"> addClass('log') </script><? } ?>
<? if ($openPMsettings) { ?> <script type="text/javascript"> addClass('settings') </script><? } ?>
<? if ($openPMexport) { ?> <script type="text/javascript"> addClass('export') </script><? } ?>
<? if ($openPMpayment) { ?> <script type="text/javascript"> addClass('payment') </script><? } ?>

