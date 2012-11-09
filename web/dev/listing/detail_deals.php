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
	# * FILE: /listing/detail_deals.php
	# ----------------------------------------------------------------------------------------------------

	if ($hasDeal) {
		?>
	
		<h2><?=string_ucwords(system_showText(LANG_PROMOTION_FEATURE_NAME))?></h2>

		<div class="featured featured-deal">
			<div class="featured-item featured-item-special">
				<div class="left">
					<div class="deal-tag"><?=CURRENCY_SYMBOL.$promotionInfo['price'].($promotionInfo['cents'] ? "<span class=\"cents\">".$promotionInfo['cents']."</span>" : "")?></div>
					<div class="deal-discount"><?=$promotionInfo['summary_offer']?></div>
				</div>
				<div class="right">
					<?=$promotionInfo['image']?>
					<h3><a href="<?=$promotionInfo['url']?>" <?=$promotionInfo['style']?>><?=$promotionInfo['name']?></a></h3>
				</div>
			</div>		
		</div>
		<?php if ($promotionInfoTwo) { ?>
		<div class="featured featured-deal">
			<div class="featured-item featured-item-special">
				<div class="left">
					<div class="deal-tag"><?=CURRENCY_SYMBOL.$promotionInfoTwo['price'].($promotionInfoTwo['cents'] ? "<span class=\"cents\">".$promotionInfoTwo['cents']."</span>" : "")?></div>
					<div class="deal-discount"><?=$promotionInfoTwo['summary_offer']?></div>
				</div>
				<div class="right">
					<?=$promotionInfoTwo['image']?>
					<h3><a href="<?=$promotionInfoTwo['url']?>" <?=$promotionInfoTwo['style']?>><?=$promotionInfoTwo['name']?></a></h3>
				</div>
			</div>		
		</div>		
		<?php } ?>
		<?php if ($promotionInfoThree) { ?>
		<div class="featured featured-deal">
			<div class="featured-item featured-item-special">
				<div class="left">
					<div class="deal-tag"><?=CURRENCY_SYMBOL.$promotionInfoThree['price'].($promotionInfoThree['cents'] ? "<span class=\"cents\">".$promotionInfoThree['cents']."</span>" : "")?></div>
					<div class="deal-discount"><?=$promotionInfoThree['summary_offer']?></div>
				</div>
				<div class="right">
					<?=$promotionInfoThree['image']?>
					<h3><a href="<?=$promotionInfoThree['url']?>" <?=$promotionInfoThree['style']?>><?=$promotionInfoThree['name']?></a></h3>
				</div>
			</div>		
		</div>		
		<?php } ?>
		<?php if ($promotionInfoFour) { ?>
		<div class="featured featured-deal">
			<div class="featured-item featured-item-special">
				<div class="left">
					<div class="deal-tag"><?=CURRENCY_SYMBOL.$promotionInfoFour['price'].($promotionInfoFour['cents'] ? "<span class=\"cents\">".$promotionInfoFour['cents']."</span>" : "")?></div>
					<div class="deal-discount"><?=$promotionInfoFour['summary_offer']?></div>
				</div>
				<div class="right">
					<?=$promotionInfoFour['image']?>
					<h3><a href="<?=$promotionInfoFour['url']?>" <?=$promotionInfoFour['style']?>><?=$promotionInfoFour['name']?></a></h3>
				</div>
			</div>		
		</div>		
		<?php } ?>
		<?php if ($promotionInfoFive) { ?>
		<div class="featured featured-deal">
			<div class="featured-item featured-item-special">
				<div class="left">
					<div class="deal-tag"><?=CURRENCY_SYMBOL.$promotionInfoFive['price'].($promotionInfoFive['cents'] ? "<span class=\"cents\">".$promotionInfoFive['cents']."</span>" : "")?></div>
					<div class="deal-discount"><?=$promotionInfoFive['summary_offer']?></div>
				</div>
				<div class="right">
					<?=$promotionInfoFive['image']?>
					<h3><a href="<?=$promotionInfoFive['url']?>" <?=$promotionInfoFive['style']?>><?=$promotionInfoFive['name']?></a></h3>
				</div>
			</div>		
		</div>		
		<?php } ?>
	<? } ?>