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
	# * FILE: /includes/views/view_classified_detail_code_realestate.php
	# ----------------------------------------------------------------------------------------------------

?>
	
	<div class="detail">
		
		<h1><?=$classified_title;?></h1>
        
        <div class="content-box pd-0">
            <?=$classified_facebook_buttons;?>
            <?=$classified_googleplus_button;?>
        </div>
        
        <span class="clear">&nbsp;</span>
        
		<div class="columns">
        	
			<? if (($imageTag && !$classifiedGallery && $onlyMain) || $tPreview) { ?>
            	<div class="image-shadow">
                    <div class="image">
                        <?=$imageTag?>
                    </div>
				</div>
            <? } ?>

            <? if ($classifiedGallery) { ?>
                <div class="ad-gallery <?=$tPreview ? "gallery" : ""?>">
                    <?=$classifiedGallery?>
                </div>
            <? } ?>
            
            <div class="share">
                <?=$classified_icon_navbar?>
            </div>
			
			<div>
                
                <? if ($classified_category_tree) { ?>
                    <?=$classified_category_tree?>
                <? } ?>
								
				<? if (($location) || ($classified_address) || ($classified_address2)) echo "<address>\n";  ?>
				
				<? if($classified_address) { ?>
					<span><?=nl2br($classified_address)?></span>
				<? } ?>

				<? if($classified_address2) { ?>
					<span><?=nl2br($classified_address2)?></span>
				<? } ?>

				<? if($location) { ?>
					<span><?=$location?></span>
				<? } ?>

				<? if (($location) || ($classified_address) || ($classified_address2)) echo "</address>\n";  ?>
				
				<? if ($classified_contactName){ ?>
					<p><strong><?=system_showText(LANG_LABEL_CONTACTNAME)?>:</strong> <?=nl2br($classified_contactName)?></p>
				<? } ?>
					
				<? if ($classified_phone){ ?>
					<p><strong><?=system_showText(LANG_LABEL_PHONE)?>:</strong> <?=nl2br($classified_phone)?></p>
				<? } ?>
					
				<? if ($classified_fax){ ?>
					<p><strong><?=system_showText(LANG_LABEL_FAX)?>:</strong> <?=nl2br($classified_fax)?></p>
				<? } ?>
					
				<? if ($classified_email){ ?>
					<p><strong><?=system_showText(LANG_LABEL_EMAIL)?>:</strong> <a href="<?=$contact_email?>" class="<?=!$tPreview? "iframe fancy_window_tofriend": "";?>" style="<?=$contact_email_style?>"><?=system_showText(LANG_SEND_AN_EMAIL);?></a></p>
				<? } ?>	
			
				<? if ($classified_url){ ?>
					<? if ($user){ ?>
						<p><strong><?=system_showText(LANG_LABEL_URL)?>:</strong> <a href="<?=nl2br($classified_url)?>" target="_blank"><?=nl2br($classified_url)?></a></p>
					<? } else { ?>
						<p><strong><?=system_showText(LANG_LABEL_URL)?>:</strong> <a href="javascript:void(0);" style="cursor:default"><?=nl2br($classified_url)?></a></p>
					<? } ?>
				<? } ?>
                
                <? if ($classified_price != 'NULL') {?>
					<br />
					<p><strong><?=system_showText(LANG_LABEL_PRICE);?>:</strong>
					<?=CURRENCY_SYMBOL." ".$classified_price;?></p>
				<? } ?>
				
			</div>
            
		</div>
			
		<? if ($classified_description) { ?>
			<div class="content-box">
				<p class="long"><?=$classified_description?></p>
			</div>
		<? }?>
		
	</div>