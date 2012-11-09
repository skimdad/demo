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
	# * FILE: /includes/views/view_event_summary_code.php
	# ----------------------------------------------------------------------------------------------------

?>
<?/*?>
	<? if ($friendly_url) { ?>
		<a name="<?=$friendly_url;?>"></a>
	<? } ?>

		<div class="share">
			<?=$event_icon_navbar;?>
		</div>	
<?*/?>	
<div class="featured-item featured-item-special" style="float:left;clear: none; width:166px; height:215px;margin-right:3px;">
	<div class="left"  style="padding-left: 0px; float: left; height: 52px; width: 155px;">
            <? if ($imageTag) { ?>
                <div class="image">
                    <?=$imageTag?>
                </div>
            <? } ?>
			<div style="float:left;background-color:#BBE7FF;width:152px;margin-bottom:3px;height:30px;padding:3px;">
			<?  if ($when) {
					if (strpos($when,"-")) {
				?>
					<p>
						<strong>
							<?=system_showText(LANG_EVENT_WHEN);?>:
						</strong> 
				<? } 
					$to = "<br/><div style='width:36px;float:left;'><p><strong>".system_showText(LANG_EVENT_TO).":</strong></p></div><p>";
					$when = str_replace("-",$to,$when);
				?>
						<?=$when;?>
					</p>
			<? } ?>
			</div>
			<div class="title">
				<h3>
					<? if($show_map && false){ ?>
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
            
            <? if ($description && false) { ?>
                <p><?=nl2br($description)?></p>
            <? } ?>
		</div>
	</div>		
		<?/*?>
		<div class="right">
		
			<div class="empty"></div>
			
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
                
				if($phone_display_code){ ?>
					<p>
						<strong>
							<?=system_showText(LANG_EVENT_LETTERPHONE)?>: 
						</strong>
						<?=$phone_display_code?>
					</p>
				<? } ?>
			</div>
			
		</div>
		<?/*?>		
	
		