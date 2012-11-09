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
	# * FILE: /includes/tables/table_article_submenu.php
	# ----------------------------------------------------------------------------------------------------

$openPMhome = string_strpos($_SERVER["PHP_SELF"], "index");
$openPMadd = ((string_strpos($_SERVER["PHP_SELF"], "articlelevel"))||((string_strpos($_SERVER["PHP_SELF"], "article.php"))&&(!string_strpos($_SERVER["REQUEST_URI"], "?id")))&&!(isset($id)&& $id!=""));
$openPMsearch = string_strpos($_SERVER["PHP_SELF"], "search");
$openPMview = string_strpos($_SERVER["PHP_SELF"], "view") || (string_strpos($_SERVER["PHP_SELF"], "report"));
$openPMedit = (isset($id)&& $id!="")&&!$openPMview&&(!string_strpos($_SERVER["PHP_SELF"], "report") && (!string_strpos($_SERVER["PHP_SELF"], "search")) && (!string_strpos($_SERVER["PHP_SELF"], "index")));

?>

<div class="submenu">
	<ul>
		<li id="privateMenu_home"><a href="<?=DEFAULT_URL?>/sitemgr/<?=ARTICLE_FEATURE_FOLDER;?>/index.php"><?=system_showText(LANG_SITEMGR_MANAGE)?></a></li>
		<li id="privateMenu_add"><a href="<?=DEFAULT_URL?>/sitemgr/<?=ARTICLE_FEATURE_FOLDER;?>/article.php"><?=system_showText(LANG_SITEMGR_MENU_ADD)?></a></li>
		<li id="privateMenu_search"><a href="<?=DEFAULT_URL?>/sitemgr/<?=ARTICLE_FEATURE_FOLDER;?>/search.php"><?=system_showText(LANG_SITEMGR_MENU_SEARCH)?></a></li>
		<li><a href="<?=DEFAULT_URL?>/sitemgr/articlecategs/index.php"><?=system_showText(LANG_SITEMGR_MENU_MANAGECATEGORIES)?></a></li>
		<li><a href="<?=DEFAULT_URL?>/sitemgr/review/index.php?item_type=article"><?=system_showText(LANG_SITEMGR_MENU_REVIEWS)?></a></li>
		
		<?
		$pos = string_strpos($_SERVER["REQUEST_URI"],"/sitemgr");
		$aux = $_SERVER["REQUEST_URI"];
		$aux2 = string_substr($aux,$pos);
		?>
		
		<li id="privateMenu_view" <?if ($openPMview) echo "style=\"display: \"\"\""; else echo "style=\"display: none\""; ?>  ><a href="<?=DEFAULT_URL.$aux2?>"><?=system_showText(LANG_SITEMGR_VIEW)?></a></li>
		<li id="privateMenu_edit" <?if ($openPMedit) echo "style=\"display: \"\"\""; else echo "style=\"display: none\""; ?> ><a href="<?=DEFAULT_URL.$aux2?>"><?=system_showText(LANG_SITEMGR_EDIT)?></a></li>
	</ul>
</div>
<br clear="all" style="height:0; line-height:0">

<? if ($openPMhome) { ?> <script type="text/javascript"> addClass('home') </script><? } ?>
<? if ($openPMadd) { ?> <script type="text/javascript"> addClass('add') </script><? } ?>
<? if ($openPMsearch) { ?> <script type="text/javascript"> addClass('search') </script><? } ?>
<? if ($openPMview) { ?> <script type="text/javascript"> addClass('view') </script><? } ?>
<? if ($openPMedit) { ?> <script type="text/javascript"> addClass('edit') </script><? } ?>