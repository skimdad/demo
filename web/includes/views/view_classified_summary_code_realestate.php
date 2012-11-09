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
	# * FILE: /includes/views/view_classified_summary_code_realestate.php
	# ----------------------------------------------------------------------------------------------------

?>

	<? if ($friendly_url) { ?>
		<a name="<?=$friendly_url;?>"></a>
	<? } ?>

	<div <?=$classified->getNumber("id") ? "id=\"classified_summary_".$classified->getNumber("id")."\"" : ""?> class="summary summary-modules">
        
        <div class="full">

            <div class="left">
                <? if ($imageTag) { ?>
                	<div class="summary-shadow">
                        <div class="image">
                            <?=$imageTag?>
                        </div>
                    </div>
                <? } ?>
            </div>
    
            <div class="right">
            	<div class="title">
                    <h3>
                        <? if($show_map){ ?>
                            <span id="summaryNumberID<?=$mapNumber;?>" class="map <?=(($_COOKIE['showMap'] == 0) ? ('isVisible') : ('isHidden'))?>">
                                <a class="map-link" href="javascript:void(0);" onclick="javascript:myclick(<?=($mapNumber);?>);scrollPage();">
                                    <?=$mapNumber;?>.
                                </a>
                            </span>
                        <? } ?>
                        <?=$title?>
                    </h3>
    
                    <p <?=($classified->getNumber("id") ? "id=\"showCategory_".$classified->getNumber("id")."\"" : "")?>>
                        <?=$complementary_info?>
                    </p>
                </div>
                
                <span class="clear"></span>
                               
                <div class="info">
                    <? if ($address1 || $address2 || $location) { ?>
                        <address>
                            <?=$address1?>
                            <?=$address2?>
                            <?=$location?>
                        </address>
                    <? } ?>
                    
                    <? if ($price){ ?>
                        <p>
                            <strong><?=system_showText(LANG_LABEL_PRICE);?></strong>
                            <?=$price;?>
                        </p>
                    <? } ?>
            
                    <? if ($phone){ ?>
                        <p>
                            <strong>
                                <?=system_showText(LANG_EVENT_LETTERPHONE)?>: 
                            </strong>
                            <?=$phone?>
                        </p>
                    <? } ?>
                    
                    <? if ($display_url){ ?>
                        <p>
                            <strong><?=system_showText(LANG_LISTING_LETTERWEBSITE)?>: </strong>
                            <a href="<?=nl2br($display_url)?>" <?=$target?> <?=$style?> title="<?=$display_urlStr?>"><?=nl2br($display_urlStr);?></a>
                        </p>
                    <? } ?>
    
                    <? if ($contact_email){ ?>
                        <p>
                            <strong><?=system_showText(LANG_LISTING_LETTEREMAIL)?>: </strong>
                            <a href="<?=$contact_email?>" class="<?=!$tPreview? "iframe fancy_window_tofriend": "";?>" style="<?=$contact_email_style?>"><?=system_showText(LANG_SEND_AN_EMAIL);?></a>
                        </p>
                    <? } ?>
                    
                    
					<? if ($summaryDescription){?>
                        <p><?=$summaryDescription?></p>
                    <? } ?>
                </div>
            </div>
            
		</div>
	
	</div>