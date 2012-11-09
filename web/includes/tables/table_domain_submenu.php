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
	# * FILE: /includes/tables/table_domain_submenu.php
	# ----------------------------------------------------------------------------------------------------

$openPMhome = string_strpos($_SERVER["PHP_SELF"], "index.php");
$openPMadd = string_strpos($_SERVER["PHP_SELF"], "domain.php");
$openPMview = string_strpos($_SERVER["PHP_SELF"], "view.php");
?>

<div class="submenu">
	<ul>
		<li id="privateMenu_home"><a href="<?=DEFAULT_URL?>/sitemgr/domain/index.php"><?=system_showText(LANG_SITEMGR_MANAGE)?></a></li>
		<li id="privateMenu_add"><a href="<?=DEFAULT_URL?>/sitemgr/domain/domain.php"><?=system_showText(LANG_SITEMGR_MENU_ADD)?></a></li>
		
		<?
		$pos = string_strpos($_SERVER["REQUEST_URI"],"/sitemgr");
		$aux = $_SERVER["REQUEST_URI"];
		$aux2 = string_substr($aux,$pos);
		?>	
			
		<li id="privateMenu_view" <?if ($openPMview) echo "style=\"display: \"\"\""; else echo "style=\"display: none\""; ?> ><a href="<?=DEFAULT_URL.$aux2?>"><?=system_showText(LANG_SITEMGR_VIEW)?></a></li>
		<li id="privateMenu_edit" <?if ($openPMedit) echo "style=\"display: \"\"\""; else echo "style=\"display: none\""; ?> ><a href="<?=DEFAULT_URL.$aux2?>"><?=system_showText(LANG_SITEMGR_EDIT)?></a></li>
	</ul>
</div>
<br clear="all">	

<? if ($openPMhome) { ?> <script type="text/javascript"> addClass('home') </script><? } ?>
<? if ($openPMadd) { ?> <script type="text/javascript"> addClass('add') </script><? } ?>
<? if ($openPMview) { ?> <script type="text/javascript"> addClass('view') </script><? } ?>
