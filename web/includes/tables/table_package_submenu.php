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
	# * FILE: /includes/tables/table_package_submenu.php
	# ----------------------------------------------------------------------------------------------------

	$openPMhome		= string_strpos($_SERVER["PHP_SELF"], "index");
	$openPMadd		= (string_strpos($_SERVER["PHP_SELF"], "package.php") && !$id);
	$openPMsearch	= string_strpos($_SERVER["PHP_SELF"], "search.php");
	$openPMreports	= string_strpos($_SERVER["PHP_SELF"], "reports.php");
	$openPMview		= (string_strpos($_SERVER["PHP_SELF"], "view"));
	$openPMedit		= ($id || string_strpos($_SERVER["PHP_SELF"], "settings")) && !string_strpos($_SERVER["PHP_SELF"], "view");

	?>

	<div class="submenu">
		<ul>
			<li id="privateMenu_home">
				<a href="<?=DEFAULT_URL?>/sitemgr/package/index.php"><?=system_showText(LANG_SITEMGR_MANAGE)?></a>
			</li>
			<li id="privateMenu_add">
				<a href="<?=DEFAULT_URL?>/sitemgr/package/package.php"><?=system_showText(LANG_SITEMGR_MENU_ADD)?></a>
			</li>
			<li id="privateMenu_search">
				<a href="<?=DEFAULT_URL?>/sitemgr/package/search.php"><?=system_showText(LANG_SITEMGR_MENU_SEARCH)?></a>
			</li>
			<li id="privateMenu_reports">
				<a href="<?=DEFAULT_URL?>/sitemgr/package/reports.php"><?=system_showText(LANG_SITEMGR_NAVBAR_REPORTS)?></a>
			</li>
			<li id="privateMenu_view" <?if ($openPMview) echo "style=\"display: \"\"\""; else echo "style=\"display: none\""; ?> >
				<a href="<?=DEFAULT_URL.$aux2?>"><?=system_showText(LANG_SITEMGR_VIEW)?></a>
			</li>
			<li id="privateMenu_edit" <?if ($openPMedit) echo "style=\"display: \"\"\""; else echo "style=\"display: none\""; ?> >
				<a href="<?=DEFAULT_URL.$aux2?>"><?=system_showText(LANG_SITEMGR_EDIT)?></a>
			</li>
		</ul>
	</div>
	<br clear="all" style="height:0; line-height:0">

	<? if ($openPMhome)		{ ?> <script type="text/javascript"> addClass('home')	</script>	<? } ?>
	<? if ($openPMadd)		{ ?> <script type="text/javascript"> addClass('add')	</script>	<? } ?>
	<? if ($openPMsearch)	{ ?> <script type="text/javascript"> addClass('search') </script>	<? } ?>
	<? if ($openPMreports)	{ ?> <script type="text/javascript"> addClass('reports') </script>	<? } ?>
	<? if ($openPMview)		{ ?> <script type="text/javascript"> addClass('view')	</script>	<? } ?>
	<? if ($openPMedit)		{ ?> <script type="text/javascript"> addClass('edit')	</script>	<? } ?>