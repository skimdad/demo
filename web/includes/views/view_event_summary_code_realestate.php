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
	# * FILE: /includes/views/view_event_summary_code_realestate.php
	# ----------------------------------------------------------------------------------------------------

?>

	<? if ($friendly_url) { ?>
		<a name="<?=$friendly_url;?>"></a>
	<? } ?>
	
	<div class="summary summary-modules">
        
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
                                <a class="map-link" href="javascript:void(0)" onclick="javascript:myclick(<?=($mapNumber);?>);scrollPage();">
                                    <?=$mapNumber;?>.
                                </a>
                            </span>
                        <? } ?>	
                        <?=$title?>
                    </h3>
                    <p <?=($event->getNumber("id") ? "id=\"showCategory_".$event->getNumber("id")."\"" : "")?>>
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
                    
                    <? if ($event_location) { ?>
                        <p>
                            <strong>
                                <?=system_showText(LANG_SEARCH_LABELLOCATION)?>:
                            </strong> 
                            <?=nl2br($event_location)?></p>
                    <? } ?>
                
                    <? if ($when) { ?>
                        <p>
                            <strong>
                                <?=system_showText(LANG_EVENT_WHEN);?>:
                            </strong> 
                            <?=$when;?>
                        </p>
                    <? } ?>
                    
                    <? if ($str_time) { ?>
                        <p>
                            <strong>
                                <?=system_showText(LANG_EVENT_TIME)?>:
                            </strong> 
                            <?=$str_time?>
                        </p>
                        <?
                    }
                    
                    if($phone){ ?>
                        <p>
                            <strong>
                                <?=system_showText(LANG_EVENT_LETTERPHONE)?>: 
                            </strong>
                            <?=$phone?>
                        </p>
                    <? } ?>
                    
                    <? if ($description) { ?>
                        <p><?=nl2br($description)?></p>
                    <? } ?>
                </div>
            </div>
            
		</div>
		
	</div>
		