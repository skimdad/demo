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
	# * FILE: /includes/views/view_promotion_detail_code_realestate.php
	# ----------------------------------------------------------------------------------------------------
	 
?>

	<div class="detail detail-deal">

		<h1><?=$deal_name;?></h1>
		
        <span class="clear">&nbsp;</span>

		<div class="deal">

			<div class="deal-price">
				<? if ($dealsDone) { ?>
				<div class="deal-tag deal-tag-sold-out">
					<span class="price"><?=system_showText(DEAL_SOLDOUT);?></span>
					<span class="discount"><?=$deal_offer?> OFF</span>
				</div>
				<? }else{ ?>
				<div class="deal-tag">
					<span class="price"><?=$deal_value.($deal_cents ? "<span class=\"cents\">".$deal_cents."</span>" : "")?></span>
					<span class="discount"><?=$deal_offer?> OFF</span>
				</div>
				<? } ?>
			</div>

			<div class="image-shadow">
                <div class="image">
                    <?=$imageTag;?>
                </div>
            </div>

		</div>
        
        <span class="clear"></span>
        
        <div class="share">
			<?=$deal_icon_navbar;?>
            <? if ($map_link) { ?>
                <ul class="share-actions">
                    <li><a href="javascript: void(0);" <?=$map_link?> <?=$map_style?>><?=system_showText(LANG_ICONMAP)?></a></li>
                </ul>
            <? } ?>
        </div>
        
        <? if ($deal_category_tree){?>
		<?=$deal_category_tree;?>
		<? } ?>

		<? if ($deal_conditions) { ?>
			<h2><?=system_showText(LANG_LABEL_DEAL_CONDITIONS);?></h2>
			<p> <?=nl2br($deal_conditions);?></p>
		<? } ?>
		<? if ($deal_description) { ?>
			<h2><?=system_showText(LANG_LABEL_DESCRIPTION);?></h2>
			<p> <?=nl2br($deal_description);?></p>
		<? } ?>
	
    </div>

    <script language="javascript" type="text/javascript">
    //<![CDATA[
    function updateDeals(value){
        $("#updateDeals").text(value);
    }
    //]]>
    </script>