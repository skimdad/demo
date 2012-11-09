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
	# * FILE: /includes/views/view_event_detail_code_realestate.php
	# ----------------------------------------------------------------------------------------------------
	
?>

	<div class="detail">
		
		<h1><?=$event_title;?></h1>
        
        <div class="content-box pd-0">
            <?=$event_facebook_buttons;?>
            <?=$event_googleplus_button;?>
        </div>
        
        <span class="clear">&nbsp;</span>
        
		<div class="columns">
        
        	<? if (($imageTag && !$eventGallery && $onlyMain) || $tPreview) { ?>
                <div class="image-shadow">
                    <div class="image">
                        <?=$imageTag?>
                    </div>
                </div>
            <? } ?>
    
            <? if($eventGallery) { ?>
                 <div class="ad-gallery <?=$tPreview ? "gallery" : ""?>">
                    <?=$eventGallery?>
                </div>
            <? } ?>
            
            <div class="share">
                <?=$event_icon_navbar?>
            </div>
            
            <? if ($event_category_tree) { ?>
                <?=$event_category_tree?>
            <? } ?>
			
            <p><strong><?=system_showText(LANG_EVENT_WHEN);?>:</strong> <?=($event->getString("recurring") != "Y" ? $str_date : $str_recurring);?></p>

            <? if ($str_time) { ?>
                <p><strong><?=system_showText(LANG_EVENT_TIME)?>:</strong> <?=$str_time?></p>
            <? } ?>

            <? if ($event_location) { ?>
                <p><strong><?=system_showText(LANG_SEARCH_LABELLOCATION)?>:</strong> <?=nl2br($event_location)?></p>
            <? } ?>

            <? if ($location_map) { ?>
                <? if ($user) { ?>
                    <p><a href="<?=$map_link?>" target="_blank"><?=system_showText(LANG_EVENT_DRIVINGDIRECTIONS)?> &raquo;</a></p>
                <? } else { ?>
                    <p><a href="javascript:void(0);" style="cursor:default"><?=system_showText(LANG_EVENT_DRIVINGDIRECTIONS)?> &raquo;</a></p>
                <? } ?>
            <? } ?>

            <? if (($location) || ($event_address) || ($event_address2)) echo "<address>\n";  ?>

            <? if($event_address) { ?>
                <span><?=nl2br($event_address)?></span>
            <? } ?>

            <? if($event_address2) { ?>
                <span><?=nl2br($event_address2)?></span>
            <? } ?>

            <? if($location) { ?>
                <span><?=$location?></span>
            <? } ?>

            <? if (($location) || ($event_address) || ($event_address2)) echo "</address>\n";  ?>

            <? if($event_url) { ?>
                <p><strong><?=system_showText(LANG_EVENT_WEBSITE)?>:</strong>
                <? if (!$user){
                    echo "<a href=\"javascript:void(0);\" style=\"cursor:default\">".$dispurl."</a>";
                } else {
                    echo "<a href=\"".$event_url."\" target=\"_blank\">".$event_url."</a>";
                }?>
                </p>
            <? } ?>

            <? if ($event_email){ ?>
                <p><strong><?=system_showText(LANG_LABEL_EMAIL)?>:</strong> <a href="<?=$contact_email?>" class="<?=!$tPreview? "iframe fancy_window_tofriend": "";?>" style="<?=$contact_email_style?>"><?=system_showText(LANG_SEND_AN_EMAIL);?></a></p>
            <? } ?>	

            <? if($event_contactName) { ?>
                <p><strong><?=system_showText(LANG_LABEL_CONTACTNAME)?>:</strong> <?=$event_contactName?></p>
            <? } ?>

            <? if($event_phone) { ?>
                <p><strong><?=system_showText(LANG_LABEL_PHONE)?>:</strong> <?=$event_phone?></p>
            <? } ?>
			
		</div>
		
		<? if ($event_description) { ?>
			<div class="content-box">
				<p><?=$event_description?></p>
			</div>
		<? }?>
	
	</div>