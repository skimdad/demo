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
	# * FILE: /includes/views/view_promotion_summary_code.php
	# ----------------------------------------------------------------------------------------------------
	
?>

		
<div class="featured-item featured-item-special" style="float:left;clear: none; width:166px; height:245px;margin-right:3px;">

	<div class="left"  style="padding-left: 0px; float: left; height: 52px; width: 155px;">
		<? if ($sold_out) { ?>
			<div class="deal-tag deal-tag-sold-out"><?=system_showText(DEAL_SOLDOUT);?></div>
		<? } else { ?>
			<div class="deal-tag"><?=CURRENCY_SYMBOL.$deal_price.($deal_cents ? "<span class=\"cents\">".$deal_cents."</span>" : "");?></div>
		<? } ?>
		<div class="deal-discount"style="float:left;margin-right: 0px; width: 70px; padding-left: 0px; margin-left: 10px;">
			<?=$offer." ".OFF?>
		</div>
		<div style="float: right; position: relative; margin-left: 5px; width: 50px; height: 20px; border-bottom-width: 0px; padding-bottom: 0px; padding-top: 0px; margin-top: -2px; margin-right: 0px; right: 0px; left: -10px;">
			<?=$deal_icon_navbar;?> 
		</div>
	</div>

			
	<div class="right" style="height:185px;width:166px;">
			<?=$imageTag;?>
				
			<div class="title" style="padding-bottom: 0px;">
				
				<h3>
					<? if ($show_map && false) { ?>
						<span id="summaryNumberID<?=$mapNumber;?>" class="map <?=(($_COOKIE['showMap'] == 0) ? ('isVisible') : ('isHidden'))?>">
							<a class="map-link" href="javascript:void(0)" onclick="javascript:myclick(<?=($mapNumber);?>);scrollPage();">
								<?=$mapNumber;?>.
							</a>
						</span>
					<? } ?>
						
					<a style="font-size:11px;" href="<?=$promotionLink?>" <?=$promotionStyle?> title="<?=$promotion->getString("name")?>"><?=$promotion->getString("name", true, false).$promotionDistance?></a>
				</h3>
					
			</div>				
				
		<div style="width: 160px; height: 50px; float: left; text-align: left;">
			<?=$promotion_review;?>
		</div>
				
	</div>
			
</div>
	

		<?/*?>
		<div class="right">
		
			<div class="title">
			
				<h3>
					<? if ($show_map) { ?>
						<span id="summaryNumberID<?=$mapNumber;?>" class="map <?=(($_COOKIE['showMap'] == 0) ? ('isVisible') : ('isHidden'))?>">
							<a class="map-link" href="javascript:void(0)" onclick="javascript:myclick(<?=($mapNumber);?>);scrollPage();">
								<?=$mapNumber;?>.
							</a>
						</span>
					<? } ?>
					
					<a href="<?=$promotionLink?>" <?=$promotionStyle?> title="<?=$promotion->getString("name")?>"><?=$promotion->getString("name", true, false).$promotionDistance?></a>
				</h3>
				
				<? if ($listingTitle) {?>
                    <p><?=system_showText(LANG_BY)?> <a href="<?=$listing_link?>" <?=$promotionStyle?> title="<?=string_htmlentities($listingTitle)?>"><?=$listingTitle?></a></p>
				<? } ?>
				
			</div>
			
			<p><?=$promotion_desc;?></p>
			
		</div>
		<?*/?>
		