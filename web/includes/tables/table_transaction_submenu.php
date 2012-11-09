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
	# * FILE: /includes/tables/table_transaction_submenu.php
	# ----------------------------------------------------------------------------------------------------

$openPMhome = string_strpos($_SERVER["PHP_SELF"], "index");
$openPMsearch = string_strpos($_SERVER["PHP_SELF"], "search");
$openPMview = string_strpos($_SERVER["PHP_SELF"], "view");

?>
<div class="submenu">
	<ul>
		<li id="privateMenu_home"><a href="<?=$url_redirect?>/index.php"><?=system_showText(LANG_SITEMGR_MENU_HISTORY)?></a></li>
		<li id="privateMenu_search"><a href="<?=$url_redirect?>/search.php"><?=system_showText(LANG_SITEMGR_MENU_SEARCH)?></a></li>
		<li><a href="<?=$url_base?>/export/payment.php?type=online"><?=system_showText(LANG_SITEMGR_MENU_EXPORTPAYMENTRECORDS)?></a></li>
		
		<?
		$pos = string_strpos($_SERVER["REQUEST_URI"],"/sitemgr");
		$aux = $_SERVER["REQUEST_URI"];
		$aux2 = string_substr($aux,$pos);
		?>
		
		<li id="privateMenu_view" <?if ($openPMview) echo "style=\"display: \"\"\""; else echo "style=\"display: none\""; ?>  ><a href="<?=DEFAULT_URL.$aux2?>"><?=system_showText(LANG_SITEMGR_VIEW)?></a></li>
	</ul>
</div>
<br clear="all" style="height:0; line-height:0">


<? if ($openPMhome) { ?> <script type="text/javascript"> addClass('home') </script><? } ?>
<? if ($openPMsearch) { ?> <script type="text/javascript"> addClass('search') </script><? } ?>
<? if ($openPMview) { ?> <script type="text/javascript"> addClass('view') </script><? } ?>