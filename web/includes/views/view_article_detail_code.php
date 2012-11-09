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
	# * FILE: /includes/views/view_article_detail_code.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="share">
		<?=$article_icon_navbar?>
	</div>

	<div class="detail">
		
		<h1><?=$article_title;?></h1>
		
		<div class="columns">
			
			<div class="left left-column-full">
				
				<? if ($article_category_tree) { ?>
					<?=$article_category_tree?>
				<? } ?>
				
				<div class="content-box pd-0">
					<?=$article_facebook_buttons;?>
					<?=$article_googleplus_button;?>
				</div>
				
				<h2><?=system_showText(LANG_LABEL_OVERVIEW);?></h2>
				
				<? if ($article_publicationDate) {?>
					<p><strong><?=system_showText(LANG_ARTICLE_PUBLISHED)?>:</strong> <?=$article_publicationDate?></p>
				<? }?>
					
				<? if ($article_author){?>
					<p><strong><?=system_showText(LANG_BY)?> </strong> <?=$article_authorStr?></p>	
				<? } elseif ($article_name){?>
					<p><strong><?=system_showText(LANG_BY)?> </strong> <?=$article_name?></p>
				<? } ?>	
				
				<? if ($imageTag) { ?>
                    <h2><?=LANG_GALLERYTITLE?></h2>
                    <div class="image">
                        <?=$imageTag?>
                    </div>
				<? } ?>

				<? if($articleGallery) { ?>
                    <div class="gallery">
                        <?=$articleGallery?>
                    </div>
				<? } ?>
				
			</div>
			
			<div class="content-custom">
				<? if($article_content) { ?>
					<?=($article_content)?>
				<? } ?>
			</div>
			
		</div>	

	</div>