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
	# * FILE: /includes/tables/table_review_submenu.php
	# ----------------------------------------------------------------------------------------------------

?>

<div class="submenu">
	<ul>
		<li id="privateMenu_listing"><a href="<?=DEFAULT_URL?>/sitemgr/review/index.php?item_type=listing"><?=system_showText(LANG_SITEMGR_LISTINGREVIEWS)?></a></li>
		<? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
		<li id="privateMenu_article"><a href="<?=DEFAULT_URL?>/sitemgr/review/index.php?item_type=article"><?=system_showText(LANG_SITEMGR_ARTICLEREVIEWS)?></a></li>
		<? } ?>
        <? if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on") { ?>
		<li id="privateMenu_promotion"><a href="<?=DEFAULT_URL?>/sitemgr/review/index.php?item_type=promotion"><?=system_showText(LANG_SITEMGR_PROMOTIONREVIEWS)?></a></li>
        <? } ?>
	</ul>
</div>
<br clear="all" style="height:0; line-height:0">
<?
$openPMlisting = string_strpos($_SERVER["REQUEST_URI"], "listing");
$openPMarticle = string_strpos($_SERVER["REQUEST_URI"], "article");
$openPMpromotion = string_strpos($_SERVER["REQUEST_URI"], "promotion");
?>

<? if ($openPMlisting) { ?> <script type="text/javascript"> addClass('listing')</script><? } ?>
<? if ($openPMarticle) { ?> <script type="text/javascript"> addClass('article')</script><? } ?>
<? if ($openPMpromotion) { ?> <script type="text/javascript"> addClass('promotion')</script><? } ?>
