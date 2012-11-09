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
	# * FILE: /includes/tables/table_faq_submenu.php
	# ----------------------------------------------------------------------------------------------------

?>

<div class="submenu">
	<ul>
		<li id="privateMenu_faq"><a href="<?=DEFAULT_URL?>/sitemgr/faq/faq.php"><?=system_showText(LANG_MENU_FAQ)?></a></li>
		<li id="privateMenu_search"><a href="<?=DEFAULT_URL?>/sitemgr/faq/search.php"><?=system_showText(LANG_SITEMGR_MENU_SEARCH)?></a></li>
	</ul>
</div>
<br clear="all" style="height:0; line-height:0">

<?
$openPMfaq = string_strpos($_SERVER["PHP_SELF"], "faq.php");
$openPMsearch = string_strpos($_SERVER["PHP_SELF"], "search.php");
?>

<? if ($openPMfaq) { ?> <script type="text/javascript"> addClass('faq') </script><? } ?>
<? if ($openPMsearch) { ?> <script type="text/javascript"> addClass('search') </script><? } ?>