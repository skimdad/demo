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
	# * FILE: /includes/tables/table_category_submenu.php
	# ----------------------------------------------------------------------------------------------------

?>

<?
if (string_strpos($_SERVER["PHP_SELF"], "listing")) $feature_submenu = "listing";
elseif (string_strpos($_SERVER["PHP_SELF"], "event")) $feature_submenu = "event";
elseif (string_strpos($_SERVER["PHP_SELF"], "classified")) $feature_submenu = "classified";
elseif (string_strpos($_SERVER["PHP_SELF"], "article")) $feature_submenu = "article";
?>


<?
if (FEATURED_CATEGORY == "on") {
	setting_get("featuredcategory", $featuredcategory_submenu);
	if ($featuredcategory_submenu == "on")
		setting_get($feature_submenu."_featuredcategory", $featuredcategory_actived);

}
?>

<?
$openPMedit = (isset($id)&& $id!="");
$openPMhome = string_strpos($_SERVER["PHP_SELF"], "index");
$openPMadd = (string_strpos($_SERVER["PHP_SELF"], "category.php")&&!$openPMedit&&(!string_strpos($_SERVER["PHP_SELF"], "review")));
$openPMfeatured = string_strpos($_SERVER["PHP_SELF"], "featured");
$openPMdisabled = string_strpos($_SERVER["PHP_SELF"], "disabled");
?>

<div class="submenu">
	<ul>

		<li id="privateMenu_home"><a href="<?=DEFAULT_URL?>/sitemgr/<?=$feature_submenu?>categs/index.php"><?=system_showText(LANG_SITEMGR_MANAGE)?></a></li>
		<li id="privateMenu_add"><a href="<?=DEFAULT_URL?>/sitemgr/<?=$feature_submenu?>categs/category.php<?=(isset($category_id)?'?category_id='.$category_id:'')?>"><?=system_showText(LANG_SITEMGR_MENU_ADD)?></a></li>
		<? if ($featuredcategory_actived == "on") { ?>
			<li id="privateMenu_featured"><a href="<?=DEFAULT_URL?>/sitemgr/<?=$feature_submenu?>categs/featured.php"><?=system_showText(LANG_SITEMGR_FEATURED)?></a></li>
		<? } ?>
		<li id="privateMenu_disabled"><a href="<?=DEFAULT_URL?>/sitemgr/<?=$feature_submenu?>categs/disabled.php<?=(isset($category_id)?'?category_id='.$category_id:'')?>"><?=system_showText(LANG_SITEMGR_DISABLED2)?></a></li>
		<?
		$pos = string_strpos($_SERVER["REQUEST_URI"],"/sitemgr");
		$aux = $_SERVER["REQUEST_URI"];
		$aux2 = string_substr($aux,$pos);
		?>		
		<li id="privateMenu_edit" <?if ($openPMedit) echo "style=\"display: \"\"\""; else echo "style=\"display: none\""; ?> ><a href="<?=DEFAULT_URL.$aux2?>"><?=system_showText(LANG_SITEMGR_EDIT)?></a></li>
		
	</ul>
</div>

<? if ($openPMhome) { ?> <script type="text/javascript"> addClass('home') </script><? } ?>
<? if ($openPMadd) { ?> <script type="text/javascript"> addClass('add') </script><? } ?>
<? if ($openPMfeatured) { ?> <script type="text/javascript"> addClass('featured') </script><? } ?>
<? if ($openPMdisabled) { ?> <script type="text/javascript"> addClass('disabled') </script><? } ?>
<? if ($openPMedit) { ?> <script type="text/javascript"> addClass('edit') </script><? } ?>