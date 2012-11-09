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
	# * FILE: /includes/views/view_post_summary_realestate.php
	# ----------------------------------------------------------------------------------------------------
?>

	<div class="summary">
		<h2>
			<a href="<?=$detailLink?>" title="<?=$title;?>" <?=$postStyle?>><?=$truncatedTitle;?></a>
		</h2>

		<p class="desc">
			<?=system_showText(LANG_BY);?> <strong><?=EDIRECTORY_TITLE;?></strong>
			<?=$postOn;?>
			<br />
			<?=$postCategoryTree;?>
		</p>
		
		<? if ($wp_enabled != "on" || ($force_blog_module && $postImage)){ ?>
		<div class="image">
			<a href="<?=$detailLink;?>" title="<?=$title;?>" <?=$postStyle?>>
				<?=$postImage;?>
			</a>
		</div>
		<? } ?>

		<p><?=$postContent;?></p>
		<? if ($more) { ?>
			<p><a class="read-more" href="<?=$detailLink;?>" <?=$postStyle?>><?=system_showText(LANG_READMORE);?></a></p>
		<? } ?>
	</div>