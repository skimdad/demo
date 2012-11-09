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
	# * FILE: /blog/includes/tables/table_tags_submenu.php
	# ----------------------------------------------------------------------------------------------------

?>

<?
$openPMedit = (isset($id)&& $id!="");
$openPMhome = string_strpos($_SERVER["PHP_SELF"], "index");
$openPMadd = (string_strpos($_SERVER["PHP_SELF"], "category.php")&&!$openPMedit);
setting_get("wp_enabled", $wp_enabled);

if (BLOG_WITH_WORDPRESS == "on"){
	$wp_enabled = "";
}

?>

<div class="submenu">
	<ul>

		<li id="privateMenu_home"><a href="<?=BLOG_DEFAULT_URL?>/sitemgr/blogcategs/index.php"><?=system_showText(LANG_SITEMGR_MANAGE)?></a></li>
		<? if ($wp_enabled != "on"){ ?>
		<li id="privateMenu_add"><a href="<?=BLOG_DEFAULT_URL?>/sitemgr/blogcategs/category.php<?=(isset($category_id)?'?category_id='.$category_id:'')?>"><?=system_showText(LANG_SITEMGR_MENU_ADD)?></a></li>
		<?}
		$pos = string_strpos($_SERVER["REQUEST_URI"],"/sitemgr");
		$aux = $_SERVER["REQUEST_URI"];
		$aux2 = string_substr($aux,$pos);
		?>		
		<li id="privateMenu_edit" <?if ($openPMedit) echo "style=\"display: \"\"\""; else echo "style=\"display: none\""; ?> ><a href="<?=BLOG_DEFAULT_URL.$aux2?>"><?=system_showText(LANG_SITEMGR_EDIT)?></a></li>
		
	</ul>
</div>
<br clear="all" style="height:0; line-height:0" />

<? if ($openPMhome) { ?> <script type="text/javascript"> addClass('home') </script><? } ?>
<? if ($openPMadd) { ?> <script type="text/javascript"> addClass('add') </script><? } ?>
<? if ($openPMedit) { ?> <script type="text/javascript"> addClass('edit') </script><? } ?>
