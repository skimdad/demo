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
	# * FILE: /includes/tables/table_category.php
	# ----------------------------------------------------------------------------------------------------

?>

<? if (is_numeric($message) && isset($msg_category[$message])) { ?>
	<p class="successMessage"><?=$msg_category[$message]?></p>
<? } ?>


<? if (is_numeric($langmessage) && isset($msg_category[$langmessage])) { ?>
	<? if (is_numeric($featmessage)) { ?>
		<p class="informationMessage"><?=$msg_category[$langmessage]."<br />".$msg_category[$featmessage]?></p>
	<? } else { ?>
		<p class="informationMessage"><?=$msg_category[$langmessage]?></p>
	<? } ?>
<? } else if (is_numeric($featmessage))  { ?>
	<p class="informationMessage"><?=$msg_category[$featmessage]?></p>
<? } ?>

<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
	<tr>
		<td colspan="3">
			<a href="<?=$url_redirect?>/index.php"><?=system_showText(LANG_SITEMGR_MENU_HOME)?></a>
			<?
			$path_count = 1;
			if ($category_id) {
				$categoryObj = new $table_category($category_id);
				$path_elem_array = $categoryObj->getFullPath();
				if ($path_elem_array) {
					foreach ($path_elem_array as $each_category) {
						echo " <a href=\"".$url_redirect."/index.php?category_id=".$each_category["id"]."&screen=".$screen."&letter=".$letter.(($url_search_params) ? "&$url_search_params" : "")."\">&raquo; ".$each_category["title"]."</a>";
						$path_count++;
					}
				}
			}
			?>
		</td>
	</tr>
</table>

<? if ($categories) { ?>

	<ul class="standard-iconDESCRIPTION">
		<li class="add-icon"><?=system_showText(LANG_SITEMGR_CATEGORY_ADDSUBCATEGORY)?></li>
		<li class="view-icon"><?=string_ucwords(system_showText(LANG_SITEMGR_VIEW))?> <?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORY))?></li>
		<li class="edit-icon"><?=string_ucwords(system_showText(LANG_SITEMGR_EDIT))?> <?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORY))?></li>
		<li class="seof-icon"><?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?></li>
		<li class="delete-icon"><?=string_ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORY))?></li>
	</ul>
    
	<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

		<tr>
			<th><?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORY))?> <?=string_ucwords(system_showText(LANG_SITEMGR_TITLE))?></th>
			<? if ($path_count < CATEGORY_LEVEL_AMOUNT) { ?>
				<th style="width: 100px;"><?=system_showText(LANG_SITEMGR_SUBCATEGORIES)?></th>
			<? } ?>
			<th style="width: 100px;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
		</tr>

		<?
		foreach ($categories as $category) {
			$categoryObj = new $table_category($category);
			$id = $categoryObj->getNumber("id");
			$subcategories = db_getFromDB(strtolower($table_category), "category_id", $id, "all", "title", "object", SELECTED_DOMAIN_ID, false, $fields);
			?>

			<tr>
				<td>
					<? if ($path_count < CATEGORY_LEVEL_AMOUNT) { ?>
						<a href="<?=$url_redirect?>/index.php?category_id=<?=$id?>" class="link-table"  title="<?=$categoryObj->getString("title");?>">
							<?=$categoryObj->getString("title", true, 90); ?>
						</a>
					<? } else { ?>
						<?=$categoryObj->getString("title", true, 90); ?>
					<? } ?>

				</td>
				<? if ($path_count < CATEGORY_LEVEL_AMOUNT) { ?>
					<td><?=count($subcategories);?></td>
				<? } ?>
				<td nowrap="nowrap">

					<? if ($path_count < CATEGORY_LEVEL_AMOUNT) { ?>
						<a href="<?=$url_redirect?>/category.php?category_id=<?=$id?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/bt_add.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOADDSUBCATEGORY)?>" title="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOADDSUBCATEGORY)?>" />
						</a>
					<? } else { ?>
						<img src="<?=DEFAULT_URL?>/images/bt_add_off.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOADDSUBCATEGORY)?>" title="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOADDSUBCATEGORY)?>" />
					<? } ?>

					<? if ($path_count < CATEGORY_LEVEL_AMOUNT) { ?>
						<a href="<?=$url_redirect?>/index.php?category_id=<?=$id?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOVIEW)?>" title="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOVIEW)?>" />
						</a>
					<? } else { ?>
						<img src="<?=DEFAULT_URL?>/images/bt_view_off.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOVIEW)?>" title="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOVIEW)?>" />
					<? } ?>

					<a href="<?=$url_redirect?>/category.php?id=<?=$id?>&category_id=<?=$category_id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOEDIT)?>" title="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOEDIT)?>" />
					</a>

					<a href="<?=$url_redirect?>/category.php?id=<?=$id?>&category_id=<?=$category_id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/icon_seof.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" />
					</a>

					<a href="<?=$url_redirect?>/delete.php?id=<?=$id?>&category_id=<?=$category_id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TODELETE)?>" title="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TODELETE)?>" />
					</a>

				</td>
			</tr>

			<?
			}
		?>

	</table>

	<ul class="standard-iconDESCRIPTION">
		<li class="add-icon"><?=system_showText(LANG_SITEMGR_CATEGORY_ADDSUBCATEGORY)?></li>
		<li class="view-icon"><?=string_ucwords(system_showText(LANG_SITEMGR_VIEW))?> <?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORY))?></li>
		<li class="edit-icon"><?=string_ucwords(system_showText(LANG_SITEMGR_EDIT))?> <?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORY))?></li>
		<li class="seof-icon"><?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?></li>
		<li class="delete-icon"><?=string_ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORY))?></li>
	</ul>

<? } else { ?>
	<p class="informationMessage"><?=system_showText($message_no_record)?></p>
<? } ?>
