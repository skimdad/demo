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
	# * FILE: /includes/tables/table_blogcategory.php
	# ----------------------------------------------------------------------------------------------------

	setting_get("wp_enabled", $wp_enabled);
	
	if (BLOG_WITH_WORDPRESS == "on"){
		$wp_enabled = "";
	}

?>

<? if (is_numeric($message) && isset($msg_tag[$message])) { ?>
	<p class="successMessage"><?=$msg_tag[$message]?></p>
<? } ?>

<? if (is_numeric($langmessage) && isset($msg_tag[$langmessage])) { ?>
	<p class="informationMessage"><?=$msg_tag[$langmessage]?></p>
<? } ?>

<? if ($categories) { ?>
	
	<ul class="standard-iconDESCRIPTION">
		<? if ($wp_enabled == "on") { ?>
		<li class="view-icon"><?=string_ucwords(system_showText(LANG_SITEMGR_VIEW))?> <?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORY))?></li>
		<? } ?>
		<li class="edit-icon"><?=string_ucwords(system_showText(LANG_SITEMGR_EDITTAG))?></li>
		<li class="seof-icon"><?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?></li>
		<li class="delete-icon"><?=string_ucwords(system_showText(LANG_SITEMGR_DELETETAG))?></li>
	</ul>

	<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

		<tr>
			<th><?=string_ucwords(system_showText(LANG_SITEMGR_TAG))?> <?=string_ucwords(system_showText(LANG_SITEMGR_TITLE))?></th>
			<th style="width: 55px;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
		</tr>

		<?
		foreach ($categories as $category) {
			$categoryObj = new BlogCategory($category);
			$id = $categoryObj->getNumber("id");
			$subcategories = db_getFromDB_Blog("blogcategory", "category_id", $id, "all", "title", "object", SELECTED_DOMAIN_ID, $fields);
			?>

			<tr>
				<td>
					<? if ($path_count < CATEGORY_LEVEL_AMOUNT) { ?>
						<a href="<?=$url_redirect?>/category.php?id=<?=$id?>&category_id=<?=$category_id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
							<?= $categoryObj->getString("title", true, 90);?>
						</a>
					<? } else { ?>
						<?= $categoryObj->getString("title", true, 90);?>
					<? } ?>
				</td>
				
				<td nowrap="nowrap">
					
					<? if ($wp_enabled == "on") { ?>
					
						<? if ($path_count < CATEGORY_LEVEL_AMOUNT) { ?>
						<a href="<?=$url_redirect?>/index.php?category_id=<?=$id?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOVIEW)?>" title="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOVIEW)?>" />
						</a>
						<? } else { ?>
							<img src="<?=DEFAULT_URL?>/images/bt_view_off.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOVIEW)?>" title="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOVIEW)?>" />
						<? } ?>

					<? } ?>

					<a href="<?=$url_redirect?>/category.php?id=<?=$id?>&category_id=<?=$category_id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CLICK_TOEDITTAG)?>" title="<?=system_showText(LANG_SITEMGR_CLICK_TOEDITTAG)?>" />
					</a>

					<a href="<?=$url_redirect?>/category.php?id=<?=$id?>&category_id=<?=$category_id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/icon_seof.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" />
					</a>

					<a href="<?=$url_redirect?>/delete.php?id=<?=$id?>&category_id=<?=$category_id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CLICK_TODELETETAG)?>" title="<?=system_showText(LANG_SITEMGR_CLICK_TODELETETAG)?>" />
					</a>

				</td>
			</tr>

			<?
			}
		?>

	</table>

	<ul class="standard-iconDESCRIPTION">
		<? if ($wp_enabled == "on") { ?>
		<li class="view-icon"><?=string_ucwords(system_showText(LANG_SITEMGR_VIEW))?> <?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORY))?></li>
		<? } ?>
		<li class="edit-icon"><?=string_ucwords(system_showText(LANG_SITEMGR_EDITTAG))?></li>
		<li class="seof-icon"><?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?></li>
		<li class="delete-icon"><?=string_ucwords(system_showText(LANG_SITEMGR_DELETETAG))?></li>
	</ul>

<? } else { ?>
	<p class="informationMessage"><?=system_showText(LANG_SITEMGR_TAGS_NORECORD)?></p>
<? } ?>
