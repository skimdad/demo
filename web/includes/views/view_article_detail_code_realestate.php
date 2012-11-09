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
	# * FILE: /includes/views/view_article_detail_code_realestate.php
	# ----------------------------------------------------------------------------------------------------

?>
	<div class="detail">
		
		<h1><?=$article_title;?></h1>
        
        <div class="content-box pd-0">
			<?=$article_facebook_buttons;?>
            <?=$article_googleplus_button;?>
        </div>
        
        <span class="clear">&nbsp;</span>
				
		<div class="columns">
        
        	<? if (($imageTag && !$articleGallery && $onlyMain) || $tPreview) { ?>
            	<div class="image-shadow">
                    <div class="image">
                        <?=$imageTag?>
                    </div>
                </div>
            <? } ?>

            <? if($articleGallery) { ?>
               <div class="ad-gallery <?=$tPreview ? "gallery" : ""?>">
                    <?=$articleGallery?>
                </div>
            <? } ?>
            
            <div class="share">
                <?=$article_icon_navbar?>
            </div>
			
			<div>
                
                <? if ($article_category_tree) { ?>
                    <?=$article_category_tree?>
                <? } ?>
				
				<? if ($article_publicationDate) {?>
					<p><strong><?=system_showText(LANG_ARTICLE_PUBLISHED)?>:</strong> <?=$article_publicationDate?></p>
				<? }?>
					
				<? if ($article_author){?>
					
					<p><strong><?=system_showText(LANG_BY)?> </strong> <?=$article_authorStr?></p>	
					
				<? } elseif ($article_name){?>
					
					<p><strong><?=system_showText(LANG_BY)?> </strong> <?=$article_name?></p>	
					
				<? } ?>	
				
			</div>
			
			<div class="content-custom">
				<br /><? if($article_content) { ?>
					<?=($article_content)?>
				<? } ?>
			</div>
			
		</div>	

	</div>