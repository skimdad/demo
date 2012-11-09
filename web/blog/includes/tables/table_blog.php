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
	# * FILE: /includes/tables/table_blog.php
	# ----------------------------------------------------------------------------------------------------

	setting_get('commenting_fb', $commenting_fb);
	setting_get("wp_enabled", $wp_enabled);
	
	if (BLOG_WITH_WORDPRESS == "on"){
		$wp_enabled = "";
	}
?>

<? if(is_numeric($message) && isset($msg_post[$message])) { ?>
	<p class="successMessage"><?=$msg_post[$message]?></p>
<? } ?>

<? if ((!isset($legend))||($legend)) { ?>
	<ul class="standard-iconDESCRIPTION">
		<li class="view-icon"><?=system_showText(LANG_LABEL_VIEW);?></li>
		<? if (!$wp_enabled){ ?>
		<li class="edit-icon"><?=system_showText(LANG_LABEL_EDIT);?></li>
		<? } ?>
		<li class="traffic-icon"><?=system_showText(LANG_TRAFFIC_REPORTS);?></li>
		<? if (string_strpos($url_base, "/sitemgr") && $commenting_fb == "on") { ?>
			<li class="facebook-icon"><?=system_showText(LANG_LABEL_FACEBOOK_COMMENTS);?></li>
		<? } ?>
		<li class="delete-icon"><?=system_showText(LANG_LABEL_DELETE);?></li>
	</ul>
<? } ?>

<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

	<tr>
		<th style="width: auto;"><?=system_showText(LANG_SITEMGR_BLOG_POST_TITLE);?></th>
		<th style="width: 100px;"><?=system_showText(LANG_LABEL_STATUS);?></th>
		<th style="width: 5%;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
	</tr>

	<?
	if ($posts) foreach ($posts as $post_info) {

		$id = $post_info->getNumber("id");
		?>

		<tr>
			<td>					
				<a title="<?=$post_info->getString("title");?>" href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<?= $post_info->getString("title", true, 100);?>
				</a>				
			</td>
			<td>
				<?
				$changeStatus = true;
				$status = new ItemStatus();
				if ((!(string_strpos($url_base, "/sitemgr")))&&(($post_info->getString("status")=="P")||($post_info->getString("status")=="E")))
					$changeStatus = false; ?>
				<a title="<?=$status->getStatus($post_info->getString("status"));?>" <? if ($changeStatus) { ?> href="<?=$url_redirect?>/settings.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" <? } else { ?> href="javascript:void(0)" style="cursor:default" <? } ?> class="link-table"><?  echo $status->getStatusWithStyle($post_info->getString("status")); ?></a>
			</td>
			
			<td nowrap>

				<a href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_POST)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_POST)?>" />
				</a>
				<? if (!$wp_enabled){ ?>
				<a href="<?=$url_redirect?>/blog.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_POST)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_POST)?>" />
				</a>
				<? } ?>
				<a href="<?=$url_redirect?>/report.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/icon_traffic.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_BLOG_REPORTS)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_BLOG_REPORTS)?>" />
				</a>
				
				<? if (string_strpos($url_base, "/sitemgr") && $commenting_fb == "on") { ?>
					<a href="<?=$url_redirect?>/facebook.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/icon-facebook-comments.gif" border="0" alt="<?=system_showText(LANG_LABEL_FACEBOOK_COMMENTS)?>" title="<?=system_showText(LANG_LABEL_FACEBOOK_COMMENTS)?>" />
					</a>
				<? } ?>

				<a href="<?=$url_redirect?>/delete.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_POST)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_POST)?>" />
				</a>

			</td>
		</tr>

		<? } ?>
		
</table>
	
<? if ((!isset($legend))||($legend)) { ?>
	<ul class="standard-iconDESCRIPTION">
		<li class="view-icon"><?=system_showText(LANG_LABEL_VIEW);?></li>
		<? if (!$wp_enabled){ ?>
		<li class="edit-icon"><?=system_showText(LANG_LABEL_EDIT);?></li>
		<? } ?>
		<li class="traffic-icon"><?=system_showText(LANG_TRAFFIC_REPORTS);?></li>
		<? if (string_strpos($url_base, "/sitemgr") && $commenting_fb == "on") { ?>
			<li class="facebook-icon"><?=system_showText(LANG_LABEL_FACEBOOK_COMMENTS);?></li>
		<? } ?>
		<li class="delete-icon"><?=system_showText(LANG_LABEL_DELETE);?></li>
	</ul>
<? } ?>
